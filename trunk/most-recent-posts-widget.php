<?php
/**
 * Plugin Name: Most Recent Posts Widget
 * Plugin URI: http://www.buildautomate.com/en/products/most-recent-posts
 * Description: BuildAutomate’s Most Recent Posts plugin allows you the WordPress developer or administrator to embed the most recent posts in your WordPress sites.  It also allows you to limit posts by number, post type and post status.
 * Version: 1.1
 * Author: Build.Automate, Inc.
 * Author URI: http://www.buildautomate.com/en
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */
include_once dirname( __FILE__ ) . '/most-recent-posts.php';
add_action( 'widgets_init', 'most_recent_posts_widgets' );

function most_recent_posts_widgets() {
	register_widget( 'Most_Recent_Posts_Widget' );
}

class Most_Recent_Posts_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function Most_Recent_Posts_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'Most Recent Posts', 'description' => __('A widget that displays the Most Recent Posts.', 'mostrecentpostswidget') );

		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'most-recent-posts-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'most-recent-posts-widget', __('Most Recent Posts Widget', 'mostrecentpostswidget'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title 				= apply_filters('widget_title', $instance['title'] );
		$numposts 			= $instance['numposts'];
		$orderby  			= $instance['orderby'];
		$include  			= $instance['include'];
		$exclude  			= $instance['exclude'];
		$post_type			= $instance['post_type'];
		$post_status		= $instance['post_status'];
		$show_date			= $instance['show_date'];
		$dateformat			= $instance['dateformat'];
		$thumbnails			= $instance['thumbnails'];		
		$thumbnailwidth		= $instance['thumbnailwidth'];		
		$thumbnailheight	= $instance['thumbnailheight'];		
		$linktext			= $instance['linktext'];								
		$linkimage			= $instance['linkimage'];	
		$linkdate			= $instance['linkdate'];									
		$showauthor			= $instance['showauthor'];									
		$linkauthor			= $instance['linkauthor'];	
		$showtext			= $instance['showtext'];		
		$category			= $instance['category'];			

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
			
		$np			= '';
		if($numposts)
		{	$np		= ' numposts="'.$numposts.'"';   }
		$ob			= '';
		if($orderby)
		{	$ob		= ' orderby="'.$orderby.'"';   }		
		$in			= '';
		if($include)
		{	$in		= ' include="'.$include.'"';   }		
		$ex			= '';
		if($exclude)
		{	$ex		= ' exclude="'.$exclude.'"';   }				
		$pt			= '';
		if($post_type)
		{	$pt		= ' post_type="'.$post_type.'"';   }				
		$ps			= '';
		if($post_status)
		{	$ps		= ' post_status="'.$post_status.'"';   }				
		if($category)
		{	$ct		= ' category="'.$category.'"';   }	
		if($show_date)
		{	
			$sd		= ' show_date="'.$show_date.'"';   
			if($dateformat == '')
			{	$dateformat = 'Y-m-d';  }
			
			$df		= ' dateformat="'.$dateformat.'"';
		}				
		if($thumbnails)
		{	$tn		= ' thumbnails="'.$thumbnails.'"'; 
			$tw		= ' thumbnailwidth="'.$thumbnailwidth.'"'; 		
			$th		= ' thumbnailheight="'.$thumbnailheight.'"'; 
		}
		$lt		= ' linktext="'.$linktext.'"'; 
		$li		= ' linkimage="'.$linkimage.'"'; 
		$ld		= ' linkdate="'.$linkdate.'"';
		if($showauthor)
		{
			$sa		= ' showauthor="'.$showauthor.'"'; 
			$la		= ' linkauthor="'.$linkauthor.'"';
		}
		if($showtext)
		{	$st		= ' showtext="'.$showtext.'"';	}			
				
		$shortcode = '[mostrecentposts '.$np.$ob.$in.$ct.$st.$ex.$pt.$ps.$sd.$df.$tn.$tw.$th.$lt.$li.$ld.$sa.$la.' ]';
		
			echo '<p>';
			echo (do_shortcode($shortcode));			
			echo '</p>';

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance 						= $old_instance;
		$instance						= $new_instance;
		$instance['title'] 				= strip_tags( $new_instance['title'] );
		$instance['numposts'] 			= strip_tags( $new_instance['numposts'] );		
		$instance['orderby'] 			= strip_tags( $new_instance['orderby'] );
		$instance['include'] 			= strip_tags( $new_instance['include'] );
		$instance['exclude'] 			= strip_tags( $new_instance['exclude'] );	
		$instance['post_type'] 			= strip_tags( $new_instance['post_type'] );			
		$instance['post_status'] 		= strip_tags( $new_instance['post_status'] );	
		$instance['show_date'] 			= strip_tags( $new_instance['show_date'] );		
		$instance['dateformat'] 		= strip_tags( $new_instance['dateformat'] );				
		$instance['thumbnails'] 		= strip_tags( $new_instance['thumbnails'] );	
		$instance['thumbnailwidth'] 	= strip_tags( $new_instance['thumbnailwidth'] );	
		$instance['thumbnailheight'] 	= strip_tags( $new_instance['thumbnailheight'] );									
		$instance['linktext'] 			= strip_tags( $new_instance['linktext'] );												
		$instance['linkimage'] 			= strip_tags( $new_instance['linkimage'] );	
		$instance['linkdate']			= strip_tags( $new_instance['linkdate'] );	
		$instance['showauthor']			= strip_tags( $new_instance['showauthor'] );	
		$instance['linkauthor']			= strip_tags( $new_instance['linkauthor'] );																	
		$instance['showtext']			= strip_tags( $new_instance['showtext'] );	
		$instance['category']			= strip_tags( $new_instance['category'] );			

		return $instance;
	}

	function form( $instance ) {

		/* Set up some default widget settings. */
		//$defaults = array( 'title' => __('Most Recent Posts', 'mostrecentpostswidget'));
		$defaults = array( 'title' => __('Most Recent Posts', 'mostrecentpostswidget') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<table>
		<tr>
		<td>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'mostrecentpostswidget'); ?></label>
		</td>
		<td align="right">
			<input style="float:right" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:60%;"/>
		</td>
		</tr>
		<!-- Widget Title: Number of Posts Input -->
		<tr>
		<td colspan="2">
			<label for="<?php echo $this->get_field_id( 'numposts' ); ?>"><?php _e('Number of Posts to Show:', 'mostrecentpostswidget'); ?></label>
		</td>
		</tr>
		<tr>
		<td colspan="2" align="right">
			<input style="float:right" id="<?php echo $this->get_field_id( 'numposts' ); ?>" name="<?php echo $this->get_field_name( 'numposts' ); ?>" value="<?php echo $instance['numposts']; ?>" style="width:20%;"/>
		</td>
		</tr>
		<!-- Category: Category IDs -->
		<tr>
		<td colspan="2">
			<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e('Category IDs to include:', 'mostrecentpostswidget'); ?></label>
		</td>
		</tr>
		<tr>
		<td colspan="2" align="right">
			<input style="float:right" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" value="<?php echo $instance['category']; ?>" style="width:20%;"/>
		</td>
		</tr>		
		</table>
		<!-- Widget Title: Post Type Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'post_type' ); ?>"><?php _e('Post Type:', 'mostrecentpostswidget'); ?></label>
		
		<?php
		$post_types=get_post_types('','names'); 
		$content = '<select name="'.$this->get_field_name( 'post_type' ).'" id="'.$this->get_field_id( 'post_type' ).'" class="widefat" style="width:100%;">';
		$content .= '<option value=""></option>';
    	
	    foreach ($post_types as $post_type) {
				$content .= '<option value="'.$post_type.'" ';
				if($instance['post_type'] == $post_type)
				{
					$content .= " selected";
				}
				$content .= '>';
				$content .= $post_type;
				$content .= '</option>';
	    }	
		$content .= '</select>';
		echo $content;
		
		
		?>
		</p>			
		
		<!-- Widget Title: Post Status Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'post_status' ); ?>"><?php _e('Post Status:', 'mostrecentpostswidget'); ?></label>
		
		<?php
		$poststatuses[0]			= "publish";
		$poststatuses[1]			= "pending";
		$poststatuses[2]			= "draft";		
		$poststatuses[3]			= "auto-draft";		
		$poststatuses[4]			= "future";		
		$poststatuses[5]			= "private";		
		$poststatuses[6]			= "inherit";
		$poststatuses[7]			= "trash";		
				
		$content = '<select name="'.$this->get_field_name( 'post_status' ).'" id="'.$this->get_field_id( 'post_status' ).'" class="widefat" style="width:100%;">';
		$content .= '<option value=""></option>';
    	
	    foreach ($poststatuses as $poststatus) {
				$content .= '<option value="'.$poststatus.'" ';
				if($instance['post_status'] == $poststatus)
				{
					$content .= " selected";
				}
				$content .= '>';
				$content .= $poststatus;
				$content .= '</option>';
	    }	
		$content .= '</select>';
		echo $content;
		
		?>
		</p>	
		<p>
			
		<?php $showauthorchecked = esc_attr($instance['showauthor']); ?>
			<input id="<?php echo $this->get_field_id('showauthor'); ?>" name="<?php echo $this->get_field_name('showauthor'); ?>" value="1" type="checkbox" <?php checked( '1', $showauthorchecked ); ?> />
			<label for="<?php echo $this->get_field_id( 'showauthor' ); ?>"><?php _e('Show Author?', 'mostrecentpostswidget'); ?></label>
		</p>
		<p>
		<?php $showtextchecked = esc_attr($instance['showtext']); ?>
			<input id="<?php echo $this->get_field_id('showtext'); ?>" name="<?php echo $this->get_field_name('showtext'); ?>" value="1" type="checkbox" <?php checked( '1', $showtextchecked ); ?> />
			<label for="<?php echo $this->get_field_id( 'showtext' ); ?>"><?php _e('Show Text?', 'mostrecentpostswidget'); ?></label>
		</p>										
		<div style="border:1px solid #AAA;padding-right:10px;padding-left:10px;">
		<label><b>Date Options</b></label>				
		<!-- Widget Title: Show Date Input -->
		<p>
		<?php $datechecked = esc_attr($instance['show_date']); ?>
			<input id="<?php echo $this->get_field_id('show_date'); ?>" name="<?php echo $this->get_field_name('show_date'); ?>" value="1" type="checkbox" <?php checked( '1', $datechecked ); ?> />
			<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e('Display Post Date?', 'mostrecentpostswidget'); ?></label>
		</p>		
		<!-- Widget Title: Date Format Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'dateformat' ); ?>"><?php _e('Date Format:', 'mostrecentpostswidget'); ?></label>
			<input id="<?php echo $this->get_field_id( 'dateformat' ); ?>" name="<?php echo $this->get_field_name( 'dateformat' ); ?>" value="<?php echo $instance['dateformat']; ?>" style="width:30%;"/><br/>
			<label for="<?php echo $this->get_field_id( 'dateformat' ); ?>"><?php _e('(Refer to <a href="http://codex.wordpress.org/Formatting_Date_and_Time" target="newWin">PHP Date Guide</a>):', 'mostrecentpostswidget'); ?></label>			
		</p>			
		</div>		
		<br/>
		<div style="border:1px solid #AAA;padding-right:10px;padding-left:10px;">
		<label><b>Linking Options</b></label>				
		<!-- Widget Title: Linking Text Input -->
		<p>
		<?php $linktextchecked = esc_attr($instance['linktext']); ?>
			<input id="<?php echo $this->get_field_id('linktext'); ?>" name="<?php echo $this->get_field_name('linktext'); ?>" value="1" type="checkbox" <?php checked( '1', $linktextchecked ); ?> />
			<label for="<?php echo $this->get_field_id( 'linktext' ); ?>"><?php _e('Text Linked?', 'mostrecentpostswidget'); ?></label>
		</p>		
		<p>
		<?php $linkimagechecked = esc_attr($instance['linkimage']); ?>
			<input id="<?php echo $this->get_field_id('linkimage'); ?>" name="<?php echo $this->get_field_name('linkimage'); ?>" value="1" type="checkbox" <?php checked( '1', $linkimagechecked ); ?> />
			<label for="<?php echo $this->get_field_id( 'linkimage' ); ?>"><?php _e('Image Linked?', 'mostrecentpostswidget'); ?></label>
		</p>		
		<p>
		<?php $linkdatechecked = esc_attr($instance['linkdate']); ?>
			<input id="<?php echo $this->get_field_id('linkdate'); ?>" name="<?php echo $this->get_field_name('linkdate'); ?>" value="1" type="checkbox" <?php checked( '1', $linkdatechecked ); ?> />
			<label for="<?php echo $this->get_field_id( 'linkdate' ); ?>"><?php _e('Date Linked?', 'mostrecentpostswidget'); ?></label>
		</p>			
		<p>
		<?php $linkauthorchecked = esc_attr($instance['linkauthor']); ?>
			<input id="<?php echo $this->get_field_id('linkauthor'); ?>" name="<?php echo $this->get_field_name('linkauthor'); ?>" value="1" type="checkbox" <?php checked( '1', $linkauthorchecked ); ?> />
			<label for="<?php echo $this->get_field_id( 'linkauthor' ); ?>"><?php _e('Author Linked?', 'mostrecentpostswidget'); ?></label>
		</p>		
		</div>		
		<br/>		
		<div style="border:1px solid #AAA;padding-right:10px;padding-left:10px;">
		<label><b>Thumbnail Options</b></label>							
		<!-- Widget Title: Show Thumbnails Input -->
		<p>
		<?php $thumbnailschecked = esc_attr($instance['thumbnails']); ?>
			<input id="<?php echo $this->get_field_id('thumbnails'); ?>" name="<?php echo $this->get_field_name('thumbnails'); ?>" value="1" type="checkbox" <?php checked( '1', $thumbnailschecked ); ?> />
			<label for="<?php echo $this->get_field_id( 'thumbnails' ); ?>"><?php _e('Show Thumbnails?', 'mostrecentpostswidget'); ?></label>
		</p>			
		<!-- Widget Title: Thumbnail Height and Width Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'thumbnailheight' ); ?>"><?php _e('Height:', 'mostrecentpostswidget'); ?></label>
			<input id="<?php echo $this->get_field_id( 'thumbnailheight' ); ?>" name="<?php echo $this->get_field_name( 'thumbnailheight' ); ?>" value="<?php echo $instance['thumbnailheight']; ?>" style="width:20%;"/>
			<label for="<?php echo $this->get_field_id( 'thumbnailwidth' ); ?>"><?php _e('Width:', 'mostrecentpostswidget'); ?></label>
			<input id="<?php echo $this->get_field_id( 'thumbnailwidth' ); ?>" name="<?php echo $this->get_field_name( 'thumbnailwidth' ); ?>" value="<?php echo $instance['thumbnailwidth']; ?>" style="width:20%;"/>
		</p>			
		</div>
		<br/>
		<div style="border:1px solid #AAA;padding-right:10px;padding-left:10px;">
		<label><b>Sorting Options</b></label>						
		<!-- Widget Title: Order By Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e('Order By:', 'mostrecentpostswidget'); ?></label>
		
		<?php
		$orderbys[0]			= "ASC";
		$orderbys[1]			= "DESC";
		$content = '<select name="'.$this->get_field_name( 'orderby' ).'" id="'.$this->get_field_id( 'orderby' ).'" class="widefat" style="width:100%;">';
		$content .= '<option value=""></option>';
    	
	    foreach ($orderbys as $order_by) {
				$content .= '<option value="'.$order_by.'" ';
				if($instance['orderby'] == $order_by)
				{
					$content .= " selected";
				}
				$content .= '>';
				$content .= $order_by;
				$content .= '</option>';
	    }	
		$content .= '</select>';
		echo $content;
		
		?>
		</p>		
		<!-- Widget Title: Include Input -->
		<table>
		<tr>
		<td>
			<label for="<?php echo $this->get_field_id( 'include' ); ?>"><?php _e('Include:', 'mostrecentpostswidget'); ?></label>
		</td>
		<td>	
			<input id="<?php echo $this->get_field_id( 'include' ); ?>" name="<?php echo $this->get_field_name( 'include' ); ?>" value="<?php echo $instance['include']; ?>" style="width:60%;"/>
		</td>
		</tr>
		<tr><td>		
		<!-- Widget Title: Exclude Input -->
			<label for="<?php echo $this->get_field_id( 'exclude' ); ?>"><?php _e('Exclude:', 'mostrecentpostswidget'); ?></label>
		</td>
		<td>
			<input id="<?php echo $this->get_field_id( 'exclude' ); ?>" name="<?php echo $this->get_field_name( 'exclude' ); ?>" value="<?php echo $instance['exclude']; ?>" style="width:60%;"/>
		</td>
		</tr>
		<tr>
		<td colspan="2">
			<label for="<?php echo $this->get_field_id( 'exclude' ); ?>"><?php _e('(Comma Separated IDs of Posts)', 'mostrecentpostswidget'); ?></label>			
		</td>
		</tr>
		</table>			
		
		</div>
	<?php					
	}
}
?>