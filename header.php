<?php
/**
 * @package WordPress
 * @subpackage Industrial
 * @since Industrial 2.3.5
 * 
 * Website Header Template
 * Created by CMSMasters
 * 
 */


$cmsms_option = cmsms_get_global_options();

global $woocommerce;


if ( 
	!is_404() && 
	!is_archive() && 
	!is_search() && 
	!is_home() || 
	(class_exists('woocommerce') && is_shop()) 
) {
	if (class_exists('woocommerce') && is_shop()) {
		$cmsms_page_id = wc_get_page_id('shop');
	} else {
		$cmsms_page_id = get_the_ID();
	}
	
	
	$cmsms_breadcrumbs = get_post_meta(get_the_ID(), 'cmsms_breadcrumbs', true);
	
	$cmsms_layout = get_post_meta($cmsms_page_id, 'cmsms_layout', true);
	
	$cmsms_top_sidebar = get_post_meta($cmsms_page_id, 'cmsms_top_sidebar', true);
	
	$cmsms_heading = get_post_meta($cmsms_page_id, 'cmsms_heading', true);
	$cmsms_heading_title = get_post_meta($cmsms_page_id, 'cmsms_heading_title', true);
	$cmsms_heading_subtitle = get_post_meta($cmsms_page_id, 'cmsms_heading_subtitle', true);
	$cmsms_heading_icon = get_post_meta($cmsms_page_id, 'cmsms_heading_icon', true);

	$cmsms_slider = get_post_meta($cmsms_page_id, 'cmsms_slider', true);
	$cmsms_slider_rev_shortcode = get_post_meta($cmsms_page_id, 'cmsms_slider_rev_shortcode', true);
	$cmsms_slider_lay_shortcode = get_post_meta($cmsms_page_id, 'cmsms_slider_lay_shortcode', true);

	$cmsms_seo_title = get_post_meta($cmsms_page_id, 'cmsms_seo_title', true);
	$cmsms_seo_description = get_post_meta($cmsms_page_id, 'cmsms_seo_description', true);
} else if (is_archive()) {
	$cmsms_layout = $cmsms_option[CMSMS_SHORTNAME . '_archive_layout'];
	$cmsms_top_sidebar = $cmsms_option[CMSMS_SHORTNAME . '_archive_top_sidebar'];
} else if (is_search()) {
	$cmsms_layout = $cmsms_option[CMSMS_SHORTNAME . '_search_layout'];
	$cmsms_top_sidebar = $cmsms_option[CMSMS_SHORTNAME . '_search_top_sidebar'];
}

if (class_exists('woocommerce')) {
	$cmsms_woocommerce_top_widgets_columns = isset($cmsms_option[CMSMS_SHORTNAME . '_woocommerce_top_widgets_columns']) ? $cmsms_option[CMSMS_SHORTNAME . '_woocommerce_top_widgets_columns'] : 'one_fourth_woocommerce';
}

?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="description" content="<?php 
if ($cmsms_option[CMSMS_SHORTNAME . '_seo']) {
	if ( 
		!is_home() && 
		!is_404() && 
		!is_archive() && 
		!is_search() && 
		$cmsms_seo_description !== '' 
	) {
		echo $cmsms_seo_description;
	} else {
		if ($cmsms_option[CMSMS_SHORTNAME . '_seo_description'] !== '') {
			echo $cmsms_option[CMSMS_SHORTNAME . '_seo_description'];
		} else {
			bloginfo('description');
		}
	}
} else {
	bloginfo('description');
} 
?>" />
<meta name="keywords" content="<?php 
if ($cmsms_option[CMSMS_SHORTNAME . '_seo']) {
	if ( 
		!is_home() && 
		!is_404() && 
		!is_archive() && 
		!is_search() && 
		$cmsms_seo_keywords !== '' 
	) {
		echo $cmsms_seo_keywords;
	} else {
		if ($cmsms_option[CMSMS_SHORTNAME . '_seo_keywords'] !== '') {
			echo $cmsms_option[CMSMS_SHORTNAME . '_seo_keywords'];
		} else {
			bloginfo('name');
		}
	}
} else {
	bloginfo('name');
} 
?>" />
<title><?php
if ($cmsms_option[CMSMS_SHORTNAME . '_seo']) {
	if ( 
		!is_home() && 
		!is_404() && 
		!is_archive() && 
		!is_search() && 
		$cmsms_seo_title != '' 
	) {
		echo $cmsms_seo_title;
	} else {
		if ($cmsms_option[CMSMS_SHORTNAME . '_seo_title'] !== '') {
			echo $cmsms_option[CMSMS_SHORTNAME . '_seo_title'];
		} else {
			wp_title('·', true, 'right');
			
			bloginfo('name');
		}
	}
} else {
	wp_title('|', true, 'right');
	
	bloginfo('name');
} 
?></title>

<?php 
if ($cmsms_option[CMSMS_SHORTNAME . '_favicon']) {
	if ($cmsms_option[CMSMS_SHORTNAME . '_favicon_url'] !== '') { 
		echo '<link rel="shortcut icon" href="' . ((is_numeric($cmsms_option[CMSMS_SHORTNAME . '_favicon_url'])) ? array_shift(wp_get_attachment_image_src($cmsms_option[CMSMS_SHORTNAME . '_favicon_url'], 'full')) : $cmsms_option[CMSMS_SHORTNAME . '_favicon_url']) . '" type="image/x-icon" />';
	} else {
		echo '<link rel="shortcut icon" href="' . get_template_directory_uri() . '/img/favicon.ico" type="image/x-icon" />';
	}
}
?>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php 
$ua = $_SERVER['HTTP_USER_AGENT'];

$checker = array( 
	'ios'=>preg_match('/iPhone|iPod|iPad/', $ua), 
	'blackberry'=>preg_match('/BlackBerry/', $ua), 
	'android'=>preg_match('/Android/', $ua), 
	'mac'=>preg_match('/Macintosh/', $ua) 
);

if (is_singular() && get_option('thread_comments')) {
	wp_enqueue_script('comment-reply');
}

wp_head();

?>
</head>
<body <?php body_class(); ?>>

<!-- _________________________ Start Page _________________________ -->
<section id="page" class="<?php 
if ( 
	!$checker['ios'] && 
	!$checker['blackberry'] && 
	!$checker['android'] && 
	!$checker['mac'] 
) { 
	echo 'csstransition '; 
} 

if ($cmsms_option[CMSMS_SHORTNAME . '_responsive']) {
	echo 'cmsms_responsive ';
}
?>hfeed site">
	<a href="#" id="slide_top"></a>
<!-- _________________________ Start Container _________________________ -->
<div class="container<?php echo ($cmsms_option[CMSMS_SHORTNAME . '_header_nav_fixed']) ? ' set_fixed' : ''; ?>">
	
<!-- _________________________ Start Header _________________________ -->
<header class="
	<?php 
		echo ($cmsms_option[CMSMS_SHORTNAME . '_header_nav_fixed']) ? ' header_position' : '';
		echo (is_admin_bar_showing()) ? ' h_mt' : ''; 
	?>
" id="header">
	<div class="header_inner">
		<?php 
			if ($cmsms_option[CMSMS_SHORTNAME . '_header_custom_html']) {
				echo '<div class="header_html">' . "\n";
				echo stripslashes($cmsms_option[CMSMS_SHORTNAME . '_header_html']) . "\n";
				echo '</div>' . "\n";
			}
			
			if ($cmsms_option[CMSMS_SHORTNAME . '_text_logo']) {
				if ($cmsms_option[CMSMS_SHORTNAME . '_text_logo_title'] !== '') {
					$blog_title = $cmsms_option[CMSMS_SHORTNAME . '_text_logo_title'];
				} else {
					$blog_title = (get_bloginfo('name')) ? get_bloginfo('name') : 'Industrial';
				}
				
				if ($cmsms_option[CMSMS_SHORTNAME . '_text_logo_subtitle_text'] !== '') {
					$blog_descr = $cmsms_option[CMSMS_SHORTNAME . '_text_logo_subtitle_text'];
				} else {
					$blog_descr = (get_bloginfo('description')) ? get_bloginfo('description') : 'Portfolio &amp; Photography';
				}
				
				echo '<a href="' . home_url() . '/" title="Home" class="logo">' . "\n\t" . 
					'<span class="title">' . $blog_title . '</span>' . "\n";
				
				if ($cmsms_option[CMSMS_SHORTNAME . '_text_logo_subtitle']) { 
					echo '<br />' . "\n" . 
					'<span class="title_text">' . $blog_descr . '</span>' . "\r"; 
				}
				
				echo '</a>';
			} else {
				if ($cmsms_option[CMSMS_SHORTNAME . '_logo_url'] === '') {
					echo '<a href="' . home_url() . '/" title="Home" class="logo">' . "\n\t" . 
						'<img src="' . get_template_directory_uri() . '/img/logo.png" alt="' . get_bloginfo('name') . '" />' . "\r" . 
					'</a>' . "\n";
				} else {
					echo '<a href="' . home_url() . '/" title="Home" class="logo">' . "\n\t" . 
						'<img src="' . ((is_numeric($cmsms_option[CMSMS_SHORTNAME . '_logo_url'])) ? array_shift(wp_get_attachment_image_src($cmsms_option[CMSMS_SHORTNAME . '_logo_url'], 'full')) : $cmsms_option[CMSMS_SHORTNAME . '_logo_url']) . '" alt="' . get_bloginfo('name') . '" />' . "\r" . 
					'</a>' . "\n";
				}
			}
            echo '<div class="phone_number_but"><a href="tel:01453828642" title="">01453 828 642</a></div>';
			
			if (class_exists('woocommerce')) {
				cmsms_woocommerce_cart_dropdown(); 
			}
			
			if ($cmsms_option[CMSMS_SHORTNAME . '_header_social'] && isset($cmsms_option[CMSMS_SHORTNAME . '_social_icons'])) {
				echo '<a class="social_but' . (($cmsms_option[CMSMS_SHORTNAME . '_header_search']) ? ' social_but_fixed' : '') . '" href="javascript:void(0);"></a>';
			}
            
            
			
			
			if ($cmsms_option[CMSMS_SHORTNAME . '_header_search']) {
				echo '<a class="search_but" href="javascript:void(0);"></a>';
			}
			
			echo '<a class="responsive_nav" href="javascript:void(0);"></a>';
		?>
		<!-- _________________________ Start Navigation _________________________ -->
		<nav role="navigation" class="<?php echo ($cmsms_option[CMSMS_SHORTNAME . '_nav_numbering']) ? ' nav_numbering' : ''; ?>">
		<?php
			echo "\t";
			
			if (has_nav_menu('primary')) {
				wp_nav_menu(array( 
					'theme_location' => 'primary', 
					'container' => false, 
					'menu_id' => 'navigation', 
					'menu_class' => 'navigation', 
					'link_before' => '<span>', 
					'link_after' => '</span>'
				));
			} else {
				echo '<ul id="navigation">';
				
				wp_list_pages(array( 
					'title_li' => '' 
				));
				
				echo '</ul>';
			}
			
			echo "\r";
		
		?>
		</nav>
		<?php
			if ($cmsms_option[CMSMS_SHORTNAME . '_header_search']) {
				get_search_form();
			}
		
			if ($cmsms_option[CMSMS_SHORTNAME . '_header_social'] && isset($cmsms_option[CMSMS_SHORTNAME . '_social_icons'])) {
				echo '<ul class="social_icons">' . "\n";
				
					foreach ($cmsms_option[CMSMS_SHORTNAME . '_social_icons'] as $cmsms_social_icons) {
						$cmsms_social_icon = explode('|', str_replace(' ', '', $cmsms_social_icons));
						
						if (is_numeric($cmsms_social_icon[0])) {
							$image = wp_get_attachment_image_src($cmsms_social_icon[0], 'full');
							
							$image = $image[0];
						} else {
							$image = $cmsms_social_icon[0];
						}
						
						echo '<li>' . "\n\t" . 
							'<a' . (($cmsms_social_icon[4] == 'true') ? ' target="_blank"' : '') . ' href="' . $cmsms_social_icon[2] . '" title="' . $cmsms_social_icon[3] . '">' . "\n\t\t" . 
								'<img src="' . $image . '" alt="' . $cmsms_social_icon[2] . '" />' . "\r\t" . 
							'</a>' . "\r" . 
							'<a class="cmsms_icon_title" href="' . $cmsms_social_icon[2] . '" title="' . $cmsms_social_icon[3] . '">' . 
								$cmsms_social_icon[3] . 
							'</a>' . 
						'</li>' . "\n";
					}
				
				echo '</ul>';
			}
		?>
		<div class="cl"></div>
		<!-- _________________________ Finish Navigation _________________________ -->
	</div>
</header>
<!-- _________________________ Finish Header _________________________ -->


<!-- _________________________ Start Middle _________________________ -->
<section id="middle"<?php 
	if (is_page_template('portfolio.php') || is_singular('project')) {
		echo ' class="portfolio_page' . (($cmsms_option[CMSMS_SHORTNAME . '_header_nav_fixed']) ? ' cmsms_middle_margin' : '') . '"';
	} else if (is_404()) {
		echo ' class="error_page' . (($cmsms_option[CMSMS_SHORTNAME . '_header_nav_fixed']) ? ' cmsms_middle_margin' : '') . '"';
	} else {
		echo ' class="' . (($cmsms_option[CMSMS_SHORTNAME . '_header_nav_fixed']) ? ' cmsms_middle_margin' : '') . '"';
	}
?>>

<?php 
if (!isset($cmsms_slider)) {
	$cmsms_slider = 'disabled';
} 

if ($cmsms_slider == 'rev_slider' && $cmsms_slider_rev_shortcode != '') {
	echo '<!-- __________________________________________________ Start Top -->' . "\n" . 
		'<section id="top">' . "\n" . 
			'<div class="wrap_rev_slider">' . "\n" . 
				do_shortcode(stripslashes($cmsms_slider_rev_shortcode)) . "\n" . 
				'<div class="cl"></div>' . "\n" .
			'</div>' . "\n" . 
		'</section>' . "\n" . 
	'<!-- __________________________________________________ Finish Top -->';
} else if ($cmsms_slider == 'lay_slider' && $cmsms_slider_lay_shortcode != '') {	
	echo '<!-- __________________________________________________ Start Top -->' . "\n" . 
		'<section id="top">' . "\n" . 
			'<div class="wrap_lay_slider">' . "\n" . 
				
				do_shortcode(stripslashes($cmsms_slider_lay_shortcode)) . "\n" . 
			'</div>' . "\n" . 
		'</section>' . "\n" . 
	'<!-- __________________________________________________ Finish Top -->';
}else if(is_page_template('pt-header-banner.php') || is_page_template('pt-product.php')) {
	$banner_image_url = !function_exists('get_field') ? get_field( 'banner_image', get_queried_object_id()) : get_post_meta( get_queried_object_id(), 'banner_image', true);
	$banner_image_url = wp_get_attachment_image_src($banner_image_url, 'full');
	if($banner_image_url){
		$banner_image_url = $banner_image_url[0];
	}else{
		$banner_image_url = get_theme_file_uri('images/page-banner.jpg');
	}
    echo '<div class="page-static-banner"><img src="'. $banner_image_url .'"/></div>';
}
 
if ( 
	is_home() || 
	!isset($cmsms_layout) 
) {
	$cmsms_layout = 'r_sidebar';
}

if ( 
	is_404() || 
	is_attachment() || 
	is_page_template('portfolio.php') 
) {
	$cmsms_layout = 'fullwidth';
}


if (!isset($cmsms_heading)) {
	$cmsms_heading = 'default';
}


if (!is_404() && !is_home() && $cmsms_heading != 'disabled') {
	if (
		(
			(
				class_exists('woocommerce') && 
				!is_shop()
			) || 
			!class_exists('woocommerce')
		) && 
		is_archive() || 
		is_search()
	) {
		echo '<div class="headline">' . "\n" .
			'<div' . ((!is_front_page() && isset($cmsms_breadcrumbs) && $cmsms_breadcrumbs != 'disabled') ? ' class="width100"' : '') . '>';
		
		echo '<h1>';
		
		if (is_search()) {
			echo __('Search Results for', 'cmsmasters') . ': &laquo;' . get_search_query() . '&raquo;';
		} elseif (is_archive()) {
			if (is_day()) {
				echo __('Daily Archives', 'cmsmasters') . ': &laquo;' . get_the_date() . '&raquo;';
			} elseif (is_month()) {
				echo __('Monthly Archives', 'cmsmasters') . ': &laquo;' . get_the_date('F Y') . '&raquo;';
			} elseif (is_year()) {
				echo __('Yearly Archives', 'cmsmasters') . ': &laquo;' . get_the_date('Y') . '&raquo;';
			} elseif (is_category()) {
				echo __('Category Archives', 'cmsmasters') . ': &laquo;' . single_cat_title('', false) . '&raquo;';
			} elseif (is_tag()) {
				echo __('Tag Archives', 'cmsmasters') . ': &laquo;' . single_tag_title('', false) . '&raquo;';
			} elseif (is_author()) {
				the_post();
				
				echo __('Author Archives', 'cmsmasters') . ': &laquo;' . get_the_author() . '&raquo;';
				
				rewind_posts();
			} elseif (is_tax('tl-categs')) {
				_e('Testimonial Archives', 'cmsmasters');
			} elseif (is_tax('pj-sort-categs') || is_tax('pj-tags')) {
				_e('Portfolio Archives', 'cmsmasters');
			} elseif (class_exists('woocommerce')) {
				if (is_product_category()) {
					echo __('Product Categories', 'cmsmasters') . ': &laquo;' . single_cat_title('', false) . '&raquo;';
				} elseif (is_product_tag()) {
					echo __('Product Tags', 'cmsmasters') . ': &laquo;' . single_cat_title('', false) . '&raquo;';
				}
			} else {
				_e('Website Archives', 'cmsmasters');
			}
		} else {
			the_title();
		}
		
		echo '</h1>' . "\r";
		
		
		if (
			!is_404() && 
			!is_home() && 
			!is_front_page() && 
			isset($cmsms_breadcrumbs) && 
			$cmsms_breadcrumbs != 'disabled'
		) {
			if (
				class_exists('woocommerce') && 
				is_shop() && 
				isset($cmsms_breadcrumbs) && 
				$cmsms_breadcrumbs != 'custom'
			) {
				woocommerce_breadcrumb();
			} else {
				breadcrumbs();
			}
		}
		
		
		echo '</div>' . "\r" . 
		'</div>';
	} elseif ($cmsms_heading == 'default') {
		echo '<div class="headline">' . "\n" .
		'<div' . ((!is_front_page() && isset($cmsms_breadcrumbs) && $cmsms_breadcrumbs != 'disabled') ? ' class="width100"' : '') . '>' . "\n" .
		'<div>' . 
		'<h1 class="heading_title_nomg">';
		
		if (class_exists('woocommerce') && is_shop()) {
			woocommerce_page_title();
		} else {
			the_title();
		}
		
		echo '</h1>' . "\n" . 
		'</div>' . "\n";
		
		if (
			!is_404() && 
			!is_home() && 
			!is_front_page() && 
			isset($cmsms_breadcrumbs) && 
			$cmsms_breadcrumbs != 'disabled'
		) {
			if (
				class_exists('woocommerce') && 
				is_shop() && 
				isset($cmsms_breadcrumbs) && 
				$cmsms_breadcrumbs != 'custom'
			) {
				woocommerce_breadcrumb();
			} else {
				breadcrumbs();
			}
		}
		
		echo '</div>' . "\n" . 
		'</div>' . "\r";
	} elseif ($cmsms_heading == 'custom') {
		echo '<div class="headline">' . "\n" .
			'<div' . ((!is_front_page() && isset($cmsms_breadcrumbs) && $cmsms_breadcrumbs != 'disabled') ? ' class="width100"' : '') . '>';
		
		
		if ($cmsms_heading_subtitle == '') {
			if ($cmsms_heading_icon != '') {
				$image = wp_get_attachment_image_src($cmsms_heading_icon, 'full');
				
				echo '<div>' . 
					'<img alt="" src="' . $image[0] . '" />' . 
				'</div>' . "\n\t";
			}
			
			echo '<div>' . 
				'<h1' . (($cmsms_heading_icon == '') ? ' class="heading_title_nomg"' : '') . '>' . (($cmsms_heading_title != '') ? $cmsms_heading_title : get_the_title()) . '</h1>' . 
			'</div>' . "\n";
		} else {
			if ($cmsms_heading_icon != '') {
				$image = wp_get_attachment_image_src($cmsms_heading_icon, 'full');
				
				echo '<div>' . 
					'<img alt="" src="' . $image[0] . '" />' . 
				'</div>' . "\n\t";
			}
			
			echo '<div>' . "\n\t\t" .
				'<h1' . (($cmsms_heading_icon == '') ? ' class="heading_title_nomg"' : '') . '>' . (($cmsms_heading_title != '') ? $cmsms_heading_title : get_the_title()) . '</h1>' . "\n\t\t" . 
				'<h6 class="heading_subtitle' . (($cmsms_heading_icon == '') ? ' heading_title_nomg' : '') . '">' . str_replace("\n", "<br />", $cmsms_heading_subtitle) . '</h6>' . "\n\t" . 
			'</div>' . "\n";
		}
		
		if (
			!is_404() && 
			!is_home() && 
			!is_front_page() && 
			isset($cmsms_breadcrumbs) && 
			$cmsms_breadcrumbs != 'disabled'
		) {
			if (
				class_exists('woocommerce') && 
				is_shop() && 
				isset($cmsms_breadcrumbs) && 
				$cmsms_breadcrumbs != 'custom'
			) {
				woocommerce_breadcrumb();
			} else {
				breadcrumbs();
			}
		}
		
		echo '</div>' . "\r" . 
		'</div>';
	} elseif ($cmsms_heading == 'parallax') {
		if (has_post_thumbnail()) {
			$thumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($cmsms_page_id), 'full');
			
			echo '<div class="cmsms_fullwidth_thumb" style="background-image:url(' . $thumb_src[0] . ');"></div>';
		}
		
		if (
			!is_404() && 
			!is_home() && 
			!is_front_page() && 
			isset($cmsms_breadcrumbs) && 
			$cmsms_breadcrumbs != 'disabled'
		) {
			if (
				class_exists('woocommerce') && 
				is_shop() && 
				isset($cmsms_breadcrumbs) && 
				$cmsms_breadcrumbs != 'custom'
			) {
				woocommerce_breadcrumb();
			} else {
				breadcrumbs();
			}
		}
		
		echo '<div class="headline cmsms-with-parallax">' . "\n" .
			'<div>';
		
		if ($cmsms_heading_subtitle == '') {
			if ($cmsms_heading_icon != '') {
				$image = wp_get_attachment_image_src($cmsms_heading_icon, 'full');
				
				echo '<div>' . 
					'<img alt="" src="' . $image[0] . '" />' . 
				'</div>' . "\n\t";
			}
			
			echo '<div>' . 
				'<h1' . (($cmsms_heading_icon == '') ? ' class="heading_title_nomg"' : '') . '>' . (($cmsms_heading_title != '') ? $cmsms_heading_title : get_the_title()) . '</h1>' . 
			'</div>' . "\n";
		} else {
			if ($cmsms_heading_icon != '') {
				$image = wp_get_attachment_image_src($cmsms_heading_icon, 'full');
				
				echo '<div>' . 
					'<img alt="" src="' . $image[0] . '" />' . 
				'</div>' . "\n\t";
			}
			
			echo '<div>' . "\n\t\t" .
				'<h1' . (($cmsms_heading_icon == '') ? ' class="heading_title_nomg"' : '') . '>' . (($cmsms_heading_title != '') ? $cmsms_heading_title : get_the_title()) . '</h1>' . "\n\t\t" . 
				'<h6 class="heading_subtitle' . (($cmsms_heading_icon == '') ? ' heading_title_nomg' : '') . '">' . str_replace("\n", "<br />", $cmsms_heading_subtitle) . '</h6>' . "\n\t" . 
			'</div>' . "\n";
		}
		
		echo '</div>' . "\r" . 
		'</div>';
	} 
} elseif ( 
	$cmsms_heading == 'disabled' && 
	!is_front_page() &&  
	isset($cmsms_breadcrumbs) && 
	$cmsms_breadcrumbs != 'disabled' 
) {
	echo '<div class="headline noborder">' . "\n" .
		'<div>';
	
	if (
		!is_404() && 
		!is_home() && 
		!is_front_page() && 
		isset($cmsms_breadcrumbs) && 
		$cmsms_breadcrumbs != 'disabled'
	) {
		if (
			class_exists('woocommerce') && 
			is_shop() && 
			isset($cmsms_breadcrumbs) && 
			$cmsms_breadcrumbs != 'custom'
		) {
			woocommerce_breadcrumb();
		} else {
			breadcrumbs();
		}
	}
	
	echo '</div>' . "\r" . 
	'</div>';
}

if (
	!is_home() && 
	!is_404() && 
	$cmsms_top_sidebar != 'false' && 
	$cmsms_top_sidebar != ''
) {
	echo '<!-- _________________________ Start Top Sidebar _________________________ -->' . "\n" . 
		'<section class="top_sidebar">' . "\n" .
		'<div class="top_sidebar_inner' . ((class_exists('woocommerce') && $cmsms_woocommerce_top_widgets_columns != '') ? ' ' . $cmsms_woocommerce_top_widgets_columns : '') . '">' . "\n";
		
		get_sidebar('top');
		
		echo '</div>' . "\n" . 
		'</section>' . "\n" . 
	'<!-- _________________________ Finish Top Sidebar _________________________ -->' . "\n";
}


if (is_page_template('portfolio.php')) {
	wp_enqueue_script('isotope');
	wp_enqueue_script('isotopeRun');
	
	
	$cmsms_page_sort = get_post_meta($cmsms_page_id, 'cmsms_page_sort', true);
	$cmsms_page_order = get_post_meta($cmsms_page_id, 'cmsms_page_order', true);
	$cmsms_page_order_type = get_post_meta($cmsms_page_id, 'cmsms_page_order_type', true);
	
	
	if ($cmsms_page_sort == 'true') {
?>
<div class="pj_sort_block">
	<div class="pj_options_loader"></div>
	<div class="pj_options_block">
		<div class="pj_sort">
			<a name="pj_name" title="<?php _e('Name', 'cmsmasters'); ?>" href="#" class="<?php 
				if ($cmsms_page_order_type == 'name') {
					echo ' current' . (($cmsms_page_order == 'DESC') ? ' reversed' : '');
				}
			?>">
				<span><?php _e('Name', 'cmsmasters'); ?></span>
			</a>
			<a name="pj_date" title="<?php _e('Date', 'cmsmasters'); ?>" href="#" class="<?php 
				if ($cmsms_page_order_type == 'date') {
					echo ' current' . (($cmsms_page_order == 'DESC') ? ' reversed' : '');
				}
			?>">
				<span><?php _e('Date', 'cmsmasters'); ?></span>
			</a>
		</div>
		<div class="pj_filter">
			<div class="pj_filter_container">
				<a class="pj_cat_filter" data-filter="article.project" title="<?php _e('All Categories', 'cmsmasters'); ?>" href="#">
					<span><?php _e('All Categories', 'cmsmasters'); ?></span>
				</a>
				<ul class="pj_filter_list">
					<li class="current">
						<a data-filter="article.project" title="<?php _e('All Categories', 'cmsmasters'); ?>" href="#" class="current"><?php _e('All Categories', 'cmsmasters'); ?></a>
					</li>
			<?php 
					$pj_categs = get_terms('pj-sort-categs', array( 
						'orderby' => 'name' 
					));
					
					if (is_array($pj_categs) && !empty($pj_categs)) {
						foreach ($pj_categs as $pj_categ) {
							echo '<li>' . "\n\t" . 
								'<a href="#" data-filter="article.project[data-category~=\'' . $pj_categ->slug . '\']" title="' . $pj_categ->name . '">' . $pj_categ->name . '</a>' . "\r" . 
							'</li>' . "\n";
						}
					}
			?>
				</ul>
			</div>
		</div>
		<div class="cl"></div>
	</div>
</div>
<?php 
	}
}


echo '<div class="content_wrap clearfix ' . $cmsms_layout . ((is_singular('project')) ? ' project_page' : '') . '">' . "\n\n";

