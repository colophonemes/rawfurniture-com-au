<?php

// shortcodes

// Gallery shortcode

// remove the standard shortcode
remove_shortcode('gallery', 'gallery_shortcode');
add_shortcode('gallery', 'gallery_shortcode_tbs');

function gallery_shortcode_tbs($attr) {
	global $post, $wp_locale;

	$output = "";

	$args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $post->ID ); 
	$attachments = get_posts($args);
	
	if ($attachments) {
		$output = '<div id="carousel-gallery" class="carousel slide" data-ride="carousel">';
		
		// carousel indicators
		$output.= '<ol class="carousel-indicators">';
			foreach(array_keys($attachments) as $attachment){
		    	$output.= '<li data-target="#carousel-gallery" data-slide-to="'.$attachment.'"'.($attachment==0 ? ' class="active"' : '').'></li>';
		    }
		$output.= '</ol>';

		//carousel items
		$output.= '<div class="carousel-inner">';
		foreach($attachments as $k=>$attachment){
			$img = wp_get_attachment_image_src( $attachment->ID , 'carousel' );
			$img_lg = wp_get_attachment_image_src( $attachment->ID , 'lightbox' );
			$output.= '<div class="item'.($k==0 ? ' active' : '').'">';
			$output.= '<a href="'.get_bloginfo('template_directory').'/library/modal_image.php?i='.$img_lg[0].'" data-toggle="modal" data-target="#gallery-modal">';
		    $output.= '<img src="'.$img[0].'" alt="" class="thumbnail">';
		    $output.= '</a>';
		    $output.= '</div>';
		}
		$output.= '</div>';

		// carousel controls
		$output.= '<a class="left carousel-control" href="#carousel-gallery" data-slide="prev">';
		$output.= '<span class="glyphicon glyphicon-chevron-left"></span>';
		$output.= '</a>';
		$output.= '<a class="right carousel-control" href="#carousel-gallery" data-slide="next">';
		$output.= '<span class="glyphicon glyphicon-chevron-right"></span>';
		$output.= '</a>';
		$output.= '</div>';
		//modals

		$output.= '<div class="modal fade" id="gallery-modal" tabindex="-1" role="dialog" aria-hidden="true">';
		$output.= '<div class="modal-dialog modal-lg modal-full">';
		$output.= '<div class="modal-content">';
		$output.= '</div>';
		$output.= '</div>';
		$output.= '</div>';
		

		/*

		/*
		$output = '<div class="row-fluid"><ul class="thumbnails">';
		foreach ( $attachments as $attachment ) {
			$output .= '<li class="col-sm-4">';
			$att_title = apply_filters( 'the_title' , $attachment->post_title );
			$output .= wp_get_attachment_link( $attachment->ID , 'thumbnail', true );
			$output .= '</li>';
		}
		$output .= '</ul></div>';*/
	}

	return $output;
}



// Buttons
function buttons( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'default', /* primary, default, info, success, danger, warning, inverse */
	'size' => 'default', /* mini, small, default, large */
	'url'  => '',
	'text' => '', 
	), $atts ) );
	
	if($type == "default"){
		$type = "";
	}
	else{ 
		$type = "btn-" . $type;
	}
	
	if($size == "default"){
		$size = "";
	}
	else{
		$size = "btn-" . $size;
	}
	
	$output = '<a href="' . $url . '" class="btn '. $type . ' ' . $size . '">';
	$output .= $text;
	$output .= '</a>';
	
	return $output;
}

add_shortcode('button', 'buttons'); 

// Alerts
function alerts( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'alert-info', /* alert-info, alert-success, alert-error */
	'close' => 'false', /* display close link */
	'text' => '', 
	), $atts ) );
	
	$output = '<div class="fade in alert alert-'. $type . '">';
	if($close == 'true') {
		$output .= '<a class="close" data-dismiss="alert">×</a>';
	}
	$output .= $text . '</div>';
	
	return $output;
}

add_shortcode('alert', 'alerts');

// Block Messages
function block_messages( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'alert-info', /* alert-info, alert-success, alert-error */
	'close' => 'false', /* display close link */
	'text' => '', 
	), $atts ) );
	
	$output = '<div class="fade in alert alert-block alert-'. $type . '">';
	if($close == 'true') {
		$output .= '<a class="close" data-dismiss="alert">×</a>';
	}
	$output .= '<p>' . $text . '</p></div>';
	
	return $output;
}

add_shortcode('block-message', 'block_messages'); 

// Block Messages
function blockquotes( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'float' => '', /* left, right */
	'cite' => '', /* text for cite */
	), $atts ) );
	
	$output = '<blockquote';
	if($float == 'left') {
		$output .= ' class="pull-left"';
	}
	elseif($float == 'right'){
		$output .= ' class="pull-right"';
	}
	$output .= '><p>' . $content . '</p>';
	
	if($cite){
		$output .= '<small>' . $cite . '</small>';
	}
	
	$output .= '</blockquote>';
	
	return $output;
}

add_shortcode('blockquote', 'blockquotes'); 
 



?>