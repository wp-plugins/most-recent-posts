<?php
/*
Plugin Name: Most Recent Posts
Version: 1.0
Description: BuildAutomate’s Most Recent Posts plugin allows you the WordPress developer or administrator to embed the most recent posts in your WordPress sites.  It also allows you to limit posts by number, post type and post status.

Author: Vaughn Bullard, Build.Automate, Inc.
Author URI: http://www.buildautomate.com/en
Plugin URI: http://www.buildautomate.com/en/products/most-recent-posts/
License: GNU GPL v3 or later

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/
include_once dirname( __FILE__ ) . '/pages.php';
include_once dirname( __FILE__ ) . '/functions.php';

Class most_recent_posts {

	public static function init() {
		global $wp_version;

		// Requires Wordpress 3.5.1 or greater
		if (version_compare($wp_version, "3.5.1", "<")) {
			return false;
		}
				

		load_plugin_textdomain('most_recent_posts', false, dirname(plugin_basename(__FILE__ )));
		add_action('admin_menu', 'most_recent_posts_create_menu');	
		add_shortcode('mostrecentposts','mostRecentPosts');				

		return true;
	}

	private static function getMRPPluginDir() {
		return WP_PLUGIN_DIR .'/'. dirname(plugin_basename(__FILE__));
	}

	private static function getMRPPluginUrl() {
		return WP_PLUGIN_URL .'/'. dirname(plugin_basename(__FILE__));
	}
	
}


	function mostRecentPosts($atts)
	{
			global $wp_query;
			extract(shortcode_atts(array('numposts' => '',
										 'orderby' => '',
										 'include' => '',
										 'exclude' => '',
										 'post_type' => '',
										 'post_status' => '',
										 'show_date' => '',
										 'dateformat' => '',
										 'thumbnails' => '',
										 'thumbnailheight'=>'',
										 'thumbnailwidth'=>'',
										 'linktext' =>'',
										 'linkimage' => '',
										 'linkdate' => '',
										 'showauthor' => '',
										 'linkauthor' => '',
										 'showtext' => '',
										 'category' => ''), $atts));
						
			$args = array(
				'numberposts' => $numposts,
				'offset' => 0,
				'category' => $category,
				'orderby' => 'post_date',
				'order' => $orderby,
				'include' => $include,
				'exclude' => $exclude,
				'meta_key' => '',
				'meta_value' => '',
				'post_type' => $post_type,
				'post_status' => $post_status,
				'suppress_filters' => true );
				
			ob_start();
			$recent_posts = wp_get_recent_posts( $args );
			$content = '<div id="most-recent-posts-div">';
			//$content .= '<ol>';

			foreach( $recent_posts as $recent ){
				$content .= '<li>';

				if($thumbnails == 1)
				{	
					$feat_image = wp_get_attachment_url( get_post_thumbnail_id($recent['ID']) );
					if($linkimage == 1)
					{	
						$content .= '<a href="' . get_permalink($recent["ID"]) . '" title="Look '.esc_attr($recent["post_title"]).'" >';					
						$content .= '<img src="'.$feat_image.'" height="'.$thumbnailheight.'" width="'.$thumbnailwidth.'"/>';
						$content .= '</a>';
					}else{
						$content .= '<img src="'.$feat_image.'" height="'.$thumbnailheight.'" width="'.$thumbnailwidth.'"/>';					
					}
					
				}
				if($linktext == 1)
				{
					if($showtext == 1)
					{
						$content .= '<a href="' . get_permalink($recent["ID"]) . '" title="Look '.esc_attr($recent["post_title"]).'" >';					
						$content .=   $recent["post_title"];
						$content .= '</a>';				
					}
				}else{
					if($showtext == 1)
					{
						$content .=   $recent["post_title"];
					}
				}
				
				if($show_date == 1)
				{	
					if($linkdate == 1)
					{	$content .= '<a href="' . get_permalink($recent["ID"]) . '" title="Look '.esc_attr($recent["post_title"]).'" >';		}
						$content .= ' ('.mysql2date($dateformat, $recent['post_date']).') '; 
					if($linkdate == 1)
					{	$content .= '</a>';	}
				}
				if($showauthor == 1)
				{	
					if($linkauthor == 1)
					{	$content .= '<a href="' . get_permalink($recent["ID"]) . '" title="Look '.esc_attr($recent["post_title"]).'" >';		}
						$content .= ' - '.get_the_author_meta('display_name',$recent['post_author']);
					if($linkauthor == 1)
					{	$content .= '</a>';	}
				}				
				$content .= '</li> ';
			}							
			//$content .= '</ol>';
			$content .= '</div>';

		return $content;
	
	}	
if(!most_recent_posts::init()) {
	echo 'Most Recent Posts plugin requires WordPress 3.5.1 or higher. Please upgrade!';
}


function most_recent_posts_create_menu()
{
	//create new top-level menu	
	add_menu_page('MRP Overview',   'Most Recent Posts', 		'administrator', 'MostRecentPostsSettings', 'MRPOverview', 'http://buildautomate.com/favicon.ico');
	add_submenu_page('MostRecentPostsSettings', 'Shortcode', 		'Shortcode', 		'administrator', 'MRPShortcodes',		'MRPShortcodes');	
	add_submenu_page('MostRecentPostsSettings', 'Registration', 		'Registration', 		'administrator', 'MRPRegistration',		'MRPRegistration');			
	add_submenu_page('MostRecentPostsSettings', 'Tech Support', 		'Tech Support', 		'administrator', 'MRPTechSupport', 		'MRPTechSupport');	
	add_submenu_page('MostRecentPostsSettings', 'Help', 		'Help', 		'administrator', 'MRPHelp',		'MRPHelp');				
			
	//call register settings function
	add_action( 'admin_init', 'MRPregister_mysettings' );
}	
function MRPregister_mysettings() {
	//register Most Recent Posts settings
	register_setting( 'most-recent-posts-settings-group', 'most_recent_posts_css' );
}
function MRPregisterProductRemote($xfn,$xln,$xem,$xct,$xsp,$xcy,$siteurl,$xprod,$xat_version)
{
	$url		= "http://buildautomate.com/topaz/receive-registration";
	$response 	= wp_remote_post( $url, array(
		'method' => 'POST',
		'timeout' => 45,
		'redirection' => 5,
		'httpversion' => '1.0',
		'blocking' => true,
		'headers' => array(),
		'body' => array( 	'xtools_firstname' 			=> $xfn, 
							'xtools_lastname' 			=> $xln,
							'xtools_emailaddress' 		=> $xem,
							'xtools_city'	 			=> $xct,														
							'xtools_stateprovince' 		=> $xsp,	
							'xtools_country' 			=> $xcy,													
							'xtools_siteurl' 			=> $siteurl,							
							'xtools_product' 			=> $xprod,							
							'xtools_version' 			=> $xat_version							
							 ),
		'cookies' => array()
    	)
	);
	$body = $response['body'];
	$apikey = "";
	
	if( is_wp_error( $response ) ) {
   		//$error_message = $response->get_error_message();
		  // echo "Something went wrong: $error_message";
	} else {
   	 	$startpos = strpos($body, "<apikey>");
   	 	$endpos   = strpos($body, "</apikey>");
   	 	$chars 		= $endpos - $startpos;
	   	$apikey = substr($body, $startpos+8, $chars-8);
	}
	return $apikey;
}