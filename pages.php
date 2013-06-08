<?php

// Most Recent Posts Management Pages Include

function MRPOverview()
{
	checkMRPAPIKey();
	$content = "<h2>Most Recent Posts Plugin</h2>";	
	$content .= "<h3>Proudly brought to you by the Open Source Development Team at </h3><br/><ul><img src='http://i1.wp.com/www.buildautomate.com/en/wp-content/uploads/2013/04/8.png?resize=300%2C50'></ul>";
	$content .= "<h4>Check out our website and other plugins</h4>";
	$content .= "<table width='50%'>";
	$content .= "<tr><td>Main Site                  </td><td><a href='http://www.buildautomate.com/en' target='newWin'>http://www.buildautomate.com/en</a></td></tr>";
	$content .= "<tr><td>XData Toolkit Plugin       </td><td><a href='http://www.buildautomate.com/en/products/xdata-toolkit' target='newWin'>http://www.buildautomate.com/en/products/xdata-toolkit</a></td></tr>";	
	$content .= "<tr><td>XPandable Author Tab Plugin       </td><td><a href='http://www.buildautomate.com/en/products/xpandable-author-tab' target='newWin'>http://www.buildautomate.com/en/products/xpandable-author-tab</a></td></tr>";		
	$content .= "<tr><td>'From Scratch' Blog        </td><td><a href='http://www.buildautomate.com/en/category/from-scratch/' target='newWin'>http://www.buildautomate.com/en/category/from-scratch/</a></td></tr>";	
	$content .= "<tr><td>'Redefining Strategy' Blog </td><td><a href='http://www.buildautomate.com/en/category/redefining-strategy/' target='newWin'>http://www.buildautomate.com/en/category/redefining-strategy/</a></td></tr>";		
	$content .= "<tr><td>'Tech Bytes' Blog          </td><td><a href='http://www.buildautomate.com/en/category/tech-bytes/' target='newWin'>http://www.buildautomate.com/en/category/tech-bytes/</a></td></tr>";			
	$content .= "</table>";
	echo $content;
}
function MRPTechSupport()
{
	checkMRPAPIKey();
	$content = "";
	if(checkMRPAPIKeyForSupport())
	{
		$content .= '<div id="panelOne" class="tabdiv">';
		$content .= "<h2>Most Recent Posts - Technical Support</h2>";		
		$content .= '<iframe src="http://www.buildautomate.com/helpdesk/" id="helpdeskWin" width="100" height="600" style="width: 1000px;height: 600px"></iframe>';	
		$content .= '</div>';
	}else
	{
		$content .= "<h2>Most Recent Posts - Technical Support</h2>";	
		$content .= "<h3>Please register your Most Recent Posts plugin for Support.</h3>";
	}
	echo $content;
}
function MRPHelp()
{
	checkMRPAPIKey();
	$content = "<h2>Most Recent Posts - Help</h2>";	
	$content .= "<h3>Most Recent Posts Video</h3>";	
	$content .= '<iframe width="560" height="315" src="http://www.youtube.com/embed/U8Zi9z4C69I" frameborder="0" allowfullscreen></iframe>';
	$content .= "<h3>Most Recent Posts Plugin Documentation</h3>";	
	$content .= "<h4>Installation and Usage</h4>";		
	$content .= "<ol>";			
	$content .= "<li>Activate Most Recent Posts Plugin and Most Recent Posts Widget in Plugins menu.</li>";				
	$content .= "<li>Register for an API Key.  Hey, we have to know who's using our plugin!  It helps us also get alerts and updates out to you quicker!  We take our responsibilities very seriously!</li>";			
	$content .= "<li>Insert shortcode into posts, pages or themes OR drag and drop the Most Recent Posts widget onto a sidebar under the widget settings panel.</li>";								
	$content .= "<li>Check out your posts, pages, themes and/or widgets!</li>";											
	$content .= "</ol>";				
	$content .= "<h4>Widget Configuration</h4>";		
	$content .= "<ol>";			
	$content .= "<li>Drag and drop the Most Recent Posts Widget to the sidebar of your choice.</li>";				
	$content .= "<li>Change settings in the widget to modify the display of your recent posts.  Don't forget to click Show Text! ;)</li>";			
	$content .= "<li>Change the title that will be displayed above the widget title.</li>";				
	$content .= "<li>Click Save</li>";				
	$content .= "<li>View changes in sidebar of your WordPress site.</li>";		
	$content .= "</ol>";		
	
	echo $content;
}
function MRPShortcodes()
{
	checkMRPAPIKey();
	$content = "<h2>Most Recent Posts - Shortcodes</h2>";	
	$content .= 'The following example show one how to embed a basic Most Recent Posts shortcode into their pages, posts or themes.<br/><br/>';
	$content .= '<pre>[mostrecentposts numposts="5" orderby="DESC" post_type="post" post_status="publish" showtext="1" linktext="1" ]</pre><br/>';	
	$content .= 'The following table shows the possible attribute switches that will allow you to customize the Most Recent Posts experience.<br/><br/>';	
	$content .= '<table class="widefat" style="width:90%;">';
	$content .= '<tr><th>Shortcode Attribute</th><th>Shortcode Possible Values</th><th>Shortcode Description</th></tr>';
	$content .= '<tr><td>numposts</td><td>1 to X (Integer) </td><td>Maximum Number of Posts To Display</td></tr>';	
	$content .= '<tr><td>showtext</td><td>1</td><td>Show text.  Should always set to 1.  Can be left out when a featured image is used instead of a textual link.</td></tr>';						
	$content .= '<tr><td>category</td><td>1,5</td><td>Comma Separated IDs of categories of posts.  If all categories are needed, leave blank in widget or have no category attribute.</td></tr>';							
	$content .= '<tr><td>orderby</td><td>ASC or DESC </td><td>Display by Ascending or Descending Order</td></tr>';		
	$content .= '<tr><td>include</td><td>1,2,3</td><td>Comma Separated IDs of posts to include in list</td></tr>';		
	$content .= '<tr><td>exclude</td><td>1,2,3</td><td>Comma Separated IDs of posts to exclude in list</td></tr>';			
	$content .= '<tr><td>post_type</td><td>post,page,attachment,revision,nav_menu_item</td><td>Type of Posts to display. If you have custom post types you can also include them in this attribute value.</td></tr>';			
	$content .= '<tr><td>post_status</td><td>publish,pending,draft,auto-draft,future,private</td><td>Status of Post</td></tr>';				
	$content .= '<tr><td>show_date</td><td>1</td><td>If show_date is an attribute in the shortcode, you must have dateformat attribute as well.</td></tr>';				
	$content .= '<tr><td>dateformat</td><td>d M</td><td>Refer to <a href="http://codex.wordpress.org/Formatting_Date_and_Time" target="newWin">PHP Date Guide</a> for proper formatting.</td></tr>';				
	$content .= '<tr><td>thumbnails</td><td>1</td><td>Display Thumnails Before Post</td></tr>';				
	$content .= '<tr><td>thumbnailwidth</td><td>20px;20cm;20%</td><td>Thumbnail width.  If no value is entered, default size will be 100%.</td></tr>';	
	$content .= '<tr><td>thumbnailheight</td><td>20px;20cm;20%</td><td>Thumbnail height.  If no value is entered, default size will be 100%.</td></tr>';		
	$content .= '<tr><td>linktext</td><td>1</td><td>Link text to post.  Should be always used.</td></tr>';				
	$content .= '<tr><td>linkimage</td><td>1</td><td>Link thumbnail to post if thumbnails if displaye</td></tr>';					
	$content .= '<tr><td>linkdate</td><td>1</td><td>Link date to post if displayed.</td></tr>';					
	$content .= '<tr><td>linkauthor</td><td>1</td><td>Link author to post if displayed.</td></tr>';					
	$content .= '<tr><td>showauthor</td><td>1</td><td>Show Author of Post</td></tr>';					
	$content .= '</table>';
	$content .= '';
	$content .= '';
	$content .= '';				
	echo $content;
}

function MRPRegistration()
{
	checkMRPAPIKey();
	$content = "<h2>Most Recent Posts - Registration Settings</h2>";
	$content .= "<h3>By registering your product, you will receive important updates, including security update information and email updates, about your plugin. </h3>";	
	$content .= '<form method="post" id="myform" enctype="multipart/form-data" action="'. $_SERVER["REQUEST_URI"] . '">';	
	settings_fields( 'xpandable-author-tab-settings-group' );
	$option2 = 'most_recent_posts_firstname';
	$option3 = 'most_recent_posts_lastname';
	$option4 = 'most_recent_posts_emailaddress';	
	$option5 = 'most_recent_posts_city';	
	$option6 = 'most_recent_posts_country';	
	$option7 = 'most_recent_posts_stateprovince';
	$option8 = 'most_recent_posts_apikey';		
	$siteurl = get_site_url();
	$xprod	  = "Most Recent Posts";	
	global $mrp_version;
	
	$mrp_version = "1.0";	

	// Read in existing option's values from database
	$xfn		= get_option($option2);

	if( isset($_POST['most_recent_posts_firstname'])  )
	{
		$opt_val = $_POST[ 'most_recent_posts_firstname' ];
		update_option( $option2, $opt_val );	
	}

	$xln		= get_option($option3);

	if( isset($_POST['most_recent_posts_lastname'])  )
	{
		$opt_val = $_POST[ 'most_recent_posts_lastname' ];
		update_option( $option3, $opt_val );	
	}
	$xem		= get_option($option4);

	if( isset($_POST['most_recent_posts_emailaddress'])  )
	{
		$opt_val = $_POST[ 'most_recent_posts_emailaddress' ];
		update_option( $option4, $opt_val );	
	}	
	$xct		= get_option($option5);

	if( isset($_POST['most_recent_posts_city'])  )
	{
		$opt_val = $_POST[ 'most_recent_posts_city' ];
		update_option( $option5, $opt_val );	
	}	
	$xcy		= get_option($option6);

	if( isset($_POST['most_recent_posts_country'])  )
	{
		$opt_val = $_POST[ 'most_recent_posts_country' ];
		update_option( $option6, $opt_val );	
	}	
	$xsp		= get_option($option7);

	if( isset($_POST['most_recent_posts_stateprovince'])  )
	{
		$opt_val = $_POST[ 'most_recent_posts_stateprovince' ];
		update_option( $option7, $opt_val );	

	}			
	// Read in existing option's values from database
	$apikey		= get_option($option8);

	if( isset($_POST['most_recent_posts_firstname'])  )
	{
		$opt_val = $_POST[ 'most_recent_posts_apikey' ];
		update_option( $option8, $opt_val );	
	}		
	
	$content .= "<h4>Please enter plugin registration details below:</h4>";
	$content .= '<ul>';
	$xfn	  = get_option('most_recent_posts_firstname');
	$xln	  = get_option('most_recent_posts_lastname');
	$xem	  = get_option('most_recent_posts_emailaddress');		
	$xct	  = get_option('most_recent_posts_city');	
	$xsp	  = get_option('most_recent_posts_stateprovince');	
	$xcy	  = get_option('most_recent_posts_country');

	$content .= '<table width="50%">';
	$content .= '<tr><td>First Name:</td><td><input type="text" size="50" name="most_recent_posts_firstname" value="'.$xfn.'"/></td></tr>';
	$content .= '<tr><td>Last Name:</td><td><input type="text" size="50" name="most_recent_posts_lastname" value="'.$xln.'"/></td></tr>';	
	$content .= '<tr><td>Email Address:</td><td><input type="text" size="50" name="most_recent_posts_emailaddress" value="'.$xem.'"/></td></tr>';	
	$content .= '<tr><td>City:</td><td><input type="text" size="50" name="most_recent_posts_city" value="'.$xct.'"/></td></tr>';
	$content .= '<tr><td>State/Province:</td><td><input type="text" size="50" name="most_recent_posts_stateprovince" value="'.$xsp.'"/></td></tr>';	
	$content .= '<tr><td>Country:</td><td><input type="text" size="50" name="most_recent_posts_country" value="'.$xcy.'"/></td></tr>';

	if(isset($_POST['most_recent_posts_apikey'])  )
	{		
		$apikey = $_POST[ 'most_recent_posts_apikey' ];
		update_option( $option8, $apikey );
	}else
	 {
		if( isset($_POST['most_recent_posts_stateprovince'])  )
		{	 
			$apikey = MRPregisterProductRemote($xfn,$xln,$xem,$xct,$xsp,$xcy,$siteurl,$xprod,$mrp_version);
			update_option( $option8, $apikey );	 
		}
	 }		
	$content .= '<tr><td><strong>API KEY</strong>:</td><td><input type="text" size="50" name="APIKEY" value="'.$apikey.'"/></td></tr>';	
	$content .= '<tr><td colspan="2"><h4>By clicking "Save Changes and Register", you agree that you are registering your installation of the Most Recent Posts Plugin and that you agree to receive regular email updates and news from Build.Automate. </h4></td></tr>';		
	$content .= '</table><br/>';
	$content .= '<input type="hidden" name="most_recent_posts_siteurl" value="'.$siteurl.'">';		
	$content .= '<input type="hidden" name="xtools_product" value="'.$xprod.'">';			
	$content .= '<input type="hidden" name="xtools_version" value="'.$mrp_version.'">';		
	$content .= '<input type="submit" class="button-primary" value="Save Changes and Register" /></ul>';
	$content .= '</form>';		
	
	echo $content;

}

?>