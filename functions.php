<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function st_register_parent__styles(){
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'st_register_parent__styles', 10);
function st_custom_script() {
	wp_enqueue_script( 'prettyPhoto', get_stylesheet_directory_uri() . '/assets/prettyPhoto/js/jquery.prettyPhoto.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'st-scripts', get_stylesheet_directory_uri() . '/js/st-scripts.js', array(
		'jquery',
		'prettyPhoto'
	), null, true );
	wp_deregister_script( 'gMapAPI' );
	wp_register_script( 'gMapAPI', 'https://maps.google.com/maps/api/js?key=AIzaSyDZTYVTd7_ykuVxQiVN-84SxswWXl0s868', array( 'jquery' ), '1.0.0', true );

	//this is the chambers rental page, using ID in case slug or page title is changed
	if ( is_page( 6046 ) ) :

		//wp_enqueue_script('chamber-accordion', get_stylesheet_directory_uri() . '/js/chambers.js', array('jquery'), NULL, true);
		wp_enqueue_style( 'dashicons' );

	endif;
}

add_action( 'wp_enqueue_scripts', 'st_custom_script', 20 );

function st_print_style() {
	wp_enqueue_style( 'prettyPhoto', get_stylesheet_directory_uri() . '/assets/prettyPhoto/css/prettyPhoto.css', array(), null );
	wp_enqueue_style( 'st-print', get_stylesheet_directory_uri() . '/css/st-print.css', array(), null, 'print' );
	echo '<link rel="stylesheet"  href="' . get_stylesheet_directory_uri() . '/css/st-print.css" type="text/css" media="print" />';
}

add_action( 'wp_head', 'st_print_style', 100 );

function st_image_overlay_box_wrap( $atts, $content = null ) {
    $col = '';
	$class = '';
	$single_row = '';
	extract( shortcode_atts( array(
		'col'        => '5',
		'class'      => '',
		'single_row' => 'yes',
	), $atts ) );

	if ( 'yes' == $single_row ) {
		$class .= ' st-image-boxes-single-row';
	}

	return '<div class="st-image-boxes ' . $class . ' st-image-boxes-col-' . $col . '">' .
	       '<div class="st-image-boxes-inner clearfix">' . do_shortcode( $content ) . '</div>' .
	       '</div>';
}

function st_image_overlay_box( $atts, $content = null ) {
    $title = '';
    $link = '';
    $rel = '';
    $image = '';
    $class = '';

	extract( shortcode_atts( array(
		'title' => '',
		'link'  => '',
		'rel'   => '',
		'image' => '',
		'class' => '',
	), $atts ) );

	if ( $title ) {
		$title = '<span>' . $title . '</span>';
	}

	if ( $rel ) {
		$rel = ' rel="' . esc_attr( $rel ) . '"';
	}

	if ( $title && $link ) {
		$title = '<a href="' . esc_url( $link ) . '"' . $rel . '>' . $title . '</a>';
	}

	$style = '';
	if ( $image ) {
		$style = 'style="background-image: url(\'' . esc_url( $image ) . '\')"';
	}
	$html = '<div class="st-image-box ' . $class . '" ' . $style . '>';
	$html .= '<img class="st-image-thumb-dummy" alt="" src="' . get_stylesheet_directory_uri() . '/images/thumb282x283.png' . '"/>';
	if ( $content ) {
		$html .= '<div class="st-image-box-content"><div class="st-image-box-content-inner">' . do_shortcode( $content ) . '</div></div>';
	}
	if ( $title ) {
		$html .= '<div class="st-image-box-title">' . $title . '</div>';
	}
	$html .= '</div>';

	return $html;
}

add_shortcode( 'st_image_overlay_box_wrap', 'st_image_overlay_box_wrap' );
add_shortcode( 'st_image_overlay_box', 'st_image_overlay_box' );

/**
 * Load custom post type function
 */
require 'inc/custom-post-types.php';


/**
 * Create specific user role permissions
 */
require 'inc/custom-permissions.php';

add_action( 'wp_footer', 'redirect_cf7' );

function redirect_cf7() {
	?>
    <script>
        document.addEventListener('wpcf7mailsent', function (event) {
            location = 'https://www.sharetree.co.uk/thank-you/';
        }, false);
    </script>
	<?php
}
function st_page_top_two_col_content(){
    $enable_top_content = get_field('enable_top_content');
    $left_column_content = get_field('left_column_content');
    $enable_search_box = get_field('enable_search_box');
    $right_column_content = get_field('right_column_content');
    if($enable_top_content && ($left_column_content || $enable_search_box || $right_column_content)):
        ?>
        <div class="cmsms_cc clearfix">
            <?php if($left_column_content): ?>
                <div class="two_third st-top-content-col-left first_column">
                    <div class="st-top-content-col-inner">
                        <div class="st-top-content-text"><?php echo do_shortcode($left_column_content); ?></div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if($right_column_content || $enable_search_box): ?>
                <div class="one_third st-top-content-col-right">
                    <div class="st-top-content-col-inner">
                        <?php if($enable_search_box): ?>
                            <div class="st-top-content-search-wrap clearfix"><?php get_search_form(); ?></div>
                        <?php endif; ?>
                        <?php if($right_column_content): ?>
                            <div class="st-top-content-text"><?php echo do_shortcode($right_column_content); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="one_first first_column" data-folder="divider" data-type="divider"><div class="divider"></div></div>
            <div class="cl"></div>
        </div>
    <?php endif;
}