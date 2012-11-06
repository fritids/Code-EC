<?php

/////////////////////////////////////// Localisation ///////////////////////////////////////


load_theme_textdomain('gp_lang', get_template_directory() . '/languages');
$locale = get_locale();
$locale_file = get_template_directory()."/languages/$locale.php";
if(is_readable($locale_file)) require_once($locale_file);


/////////////////////////////////////// Theme Information ///////////////////////////////////////


$themename = get_option('current_theme'); // Theme Name
$dirname = strtolower(str_replace(" ", "", get_option('current_theme'))); // Directory Name


/////////////////////////////////////// File Directories ///////////////////////////////////////


define("ghostpool", get_template_directory() . '/');
define("ghostpool_inc", get_template_directory() . '/lib/inc/');
define("ghostpool_scripts", get_template_directory() . '/lib/scripts/');
define("ghostpool_admin", get_template_directory() . '/lib/admin/inc/');
define("ghostpool_bp", get_template_directory() . '/lib/buddypress/');
define("BP_THEME_URL", get_template_directory_uri());


/////////////////////////////////////// Additional Functions ///////////////////////////////////////


// Main Theme Options
require_once(ghostpool_admin . 'theme-options.php');
require(ghostpool_inc . 'options.php');

// Meta Options
require_once(ghostpool_admin . 'theme-meta-options.php');

// Sidebars
require_once(ghostpool_admin . 'theme-sidebars.php');

// Shortcodes
require_once(ghostpool_admin . 'theme-shortcodes.php');

// Custom Post Types
require_once(ghostpool_admin . 'theme-post-types.php');

// Update Notification
require_once(ghostpool_admin . 'theme-update-notification.php');

// TinyMCE
if(is_admin()) { require_once (ghostpool_admin . 'tinymce/tinymce.php'); }

// WP Show IDs
if(is_admin()) { require_once(ghostpool_admin . 'wp-show-ids/wp-show-ids.php'); }

// Import/Export Widgets
if(is_admin()) { require_once(ghostpool_admin . 'widget-settings-importexport/widget_data.php'); }

// Auto Install
if(is_admin()) { require_once(ghostpool_admin . 'theme-auto-install.php'); }

// Image Resizer
require_once(ghostpool_scripts . 'image-resizer.php');

// BuddyPress Functions
if(function_exists('bp_is_active') && file_exists(ghostpool_bp.'functions-buddypress.php')) { require_once(ghostpool_bp . 'functions-buddypress.php'); }


/////////////////////////////////////// Enqueue Styles ///////////////////////////////////////


function gp_enqueue_styles() { 
	if(!is_admin()){
	
		global $post;
		require(ghostpool_inc . 'options.php');

		wp_enqueue_style('reset', get_template_directory_uri().'/lib/css/reset.css');

		wp_enqueue_style('gp-style', get_stylesheet_directory_uri().'/style.css');

		wp_enqueue_style('responsive', get_template_directory_uri().'/responsive.css');
	
		wp_enqueue_style('prettyphoto', get_template_directory_uri().'/lib/scripts/prettyPhoto/css/prettyPhoto.css');

		wp_enqueue_style('lato', 'http://fonts.googleapis.com/css?family=Lato:400,300,100');

		wp_enqueue_style('raleway', 'http://fonts.googleapis.com/css?family=Raleway:100');

		if($_GET['skin'] == "default") {
			$skin = $_COOKIE['SkinCookie']; 
			setcookie('SkinCookie', $skin, time()-3600);
			$skin = $theme_skin;
		} elseif(isset($_GET['skin'])) {
			$skin = $_GET['skin'];
			setcookie('SkinCookie', $skin);			
		} elseif(isset($_COOKIE['SkinCookie'])) {
			$skin = $_COOKIE['SkinCookie']; 
		}

		if((isset($_GET['skin']) && $_GET['skin'] != "default") OR (isset($_COOKIE['SkinCookie']) && $_COOKIE['SkinCookie'] != "default")) {
			
			wp_enqueue_style('style-skin', get_template_directory_uri().'/style-'.$skin.'.css');		
		
		} else {

			if((is_singular() && !is_attachment() && !is_404()) && (get_post_meta($post->ID, 'ghostpool_skin', true) && get_post_meta($post->ID, 'ghostpool_skin', true) != "Default")) {

				wp_enqueue_style('style-skin', get_template_directory_uri().'/style-'.get_post_meta($post->ID, 'ghostpool_skin', true).'.css');		
	
			} else {
		
				wp_enqueue_style('style-skin', get_template_directory_uri().'/style-'.$theme_skin.'.css');
				
			}
		
		}
	
		if($theme_custom_stylesheet) {
		
			wp_enqueue_style('style-theme-custom', get_template_directory_uri().'/'.$theme_custom_stylesheet);		
		
		}
		
		if((is_single() OR is_page()) && get_post_meta($post->ID, 'ghostpool_custom_stylesheet', true)) {
		
			wp_enqueue_style('style-page-custom', get_template_directory_uri().'/'.get_post_meta($post->ID, 'ghostpool_custom_stylesheet', true));		
		
		}
	
	}
}
add_action('wp_print_styles', 'gp_enqueue_styles');


/////////////////////////////////////// Enqueue Scripts ///////////////////////////////////////


function gp_enqueue_scripts() { 
	if(!is_admin()){
	
		require(ghostpool_inc . 'options.php');

		wp_enqueue_script('jquery');
		
		wp_enqueue_script('jquery-ui-accordion');
		
		wp_enqueue_script('jquery-ui-tabs');
		
		if(is_singular()) wp_enqueue_script('comment-reply');
		
		wp_enqueue_script('swfobject', 'http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js');
		
		wp_enqueue_script('jwplayer', get_template_directory_uri().'/lib/scripts/mediaplayer/jwplayer.js', array('jquery'));
		
		wp_enqueue_script('flex-slider', get_template_directory_uri().'/lib/scripts/jquery.flexslider.js', array('jquery'));
		
		wp_enqueue_script('prettyphoto', get_template_directory_uri().'/lib/scripts/prettyPhoto/js/jquery.prettyPhoto.js', array('jquery'));

		wp_enqueue_script('custom-js', get_template_directory_uri().'/lib/scripts/custom.js', array('jquery'));
						
	}
}
add_action('wp_print_scripts', 'gp_enqueue_scripts');


/////////////////////////////////////// WP Header Hooks ///////////////////////////////////////


function gp_wp_header() {
	
	require(ghostpool_inc . 'options.php');
		
    if($theme_favicon_ico) echo '<link rel="shortcut icon" href="'.$theme_favicon_ico.'" /><link rel="icon" href="'.$theme_favicon_ico.'" type="image/vnd.microsoft.icon" />';
    
    if($theme_favicon_png) echo '<link rel="icon" type="image/png" href="'.$theme_favicon_png.'" />';
    
    if($theme_apple_icon) echo '<link rel="apple-touch-icon" href="'.$theme_apple_icon.'" />';
   
   	if($theme_custom_css) echo '<style>'.stripslashes($theme_custom_css).'</style>';

	echo stripslashes($theme_scripts);
	
	echo '
	<!--[if lte IE 9]>
	<style>
	.skin-darkblue #header-outer {
	-pie-background: url("'.get_template_directory_uri().'/lib/images/header-bg-darkblue.png") right top no-repeat, linear-gradient(#2d353a, #000);
	}
	.skin-brown #header-outer {
	-pie-background: url("'.get_template_directory_uri().'/lib/images/header-bg-brown.png") right top no-repeat, linear-gradient(#3A312C, #000);
	}
	.skin-darkgrey #header-outer {
	-pie-background: url("'.get_template_directory_uri().'/lib/images/header-bg-darkgrey.png") right top no-repeat, linear-gradient(#333, #000);
	}
	.skin-maroon #header-outer {
	-pie-background: url("'.get_template_directory_uri().'/lib/images/header-bg-maroon.png") right top no-repeat, linear-gradient(#3A2C2E, #000);
	}
	.skin-orange #header-outer {
	-pie-background: url("'.get_template_directory_uri().'/lib/images/header-bg-darkgrey.png") right top no-repeat, linear-gradient(#333, #000);
	}
	.skin-purple #header-outer {
	-pie-background: url("'.get_template_directory_uri().'/lib/images/header-bg-purple.png") right top no-repeat, linear-gradient(#2C2E3A, #000);
	}
	.skin-teal #header-outer {
	-pie-background: url("'.get_template_directory_uri().'/lib/images/header-bg-teal.png") right top no-repeat, linear-gradient(#60807B, #405451);
	}
	.skin-darkblue #top-content.top-content-stripes {
	-pie-background: url("'.get_template_directory_uri().'/lib/images/top-content-bg.png") right bottom no-repeat, linear-gradient(#364046, #15191b);
	}	
	.skin-brown #top-content.top-content-stripes {
	-pie-background: url("'.get_template_directory_uri().'/lib/images/top-content-bg.png") right bottom no-repeat, linear-gradient(#453B35, #1A1614);
	}
	.skin-darkgrey #top-content.top-content-stripes {
	-pie-background: url("'.get_template_directory_uri().'/lib/images/top-content-bg.png") right bottom no-repeat, linear-gradient(#3e3e3e, #181818);
	}
	.skin-maroon #top-content.top-content-stripes {
	-pie-background: url("'.get_template_directory_uri().'/lib/images/top-content-bg.png") right bottom no-repeat, linear-gradient(#453537, #1A1415);
	}
	.skin-orange #top-content.top-content-stripes {
	-pie-background: url("'.get_template_directory_uri().'/lib/images/top-content-bg.png") right bottom no-repeat, linear-gradient(#E66D1A, #B85614);
	}
	.skin-purple #top-content.top-content-stripes {
	-pie-background: url("'.get_template_directory_uri().'/lib/images/top-content-bg.png") right bottom no-repeat, linear-gradient(#353745, #14151A);
	}
	.skin-teal #top-content.top-content-stripes {
	-pie-background: url("'.get_template_directory_uri().'/lib/images/top-content-bg.png") right bottom no-repeat, linear-gradient(#6A8A87, #495F5B);
	}													
	#header-outer, #nav, #top-content, #top-content.top-content-stripe, #top-content #searchform, .author-info, .sc-price-box, .widget_nav_menu a:hover, .widget_nav_menu .current-menu-item > a, .wp-pagenavi span, .wp-pagenavi.cat-navi a, .wp-pagenavi.comment-navi a, .wp-pagenavi.post-navi a span, .gallery img, .frame #content-wrapper, .post-thumbnail, .sc-button, .sc-button:hover, .separate > div, .sc-image.image-border, .dropcap2, .dropcap3, .dropcap4, .dropcap5, .notify, .comment-avatar img, .post-author, #bp-links a, .avatar, .bp-wrapper .button, .button.submit, .bp-wrapper .generic-button a, .bp-wrapper ul.button-nav li a, .bp-wrapper .item-list .activity-meta a, .bp-wrapper .item-list .acomment-options a, .bp-wrapper .activity-meta a:hover span, .widget .item-options a, .widget .item-options a.selected, .widget .swa-wrap ul#activity-filter-links a, .widget .swa-activity-list li.mini div.swa-activity-meta a, .widget .swa-activity-list div.swa-activity-meta a.acomment-reply, .widget .swa-activity-list div.swa-activity-meta a, .widget .swa-activity-list div.acomment-options a 
	{
	behavior: url("'.get_template_directory_uri().'/lib/scripts/pie/PIE.php");
	}
	</style>
	<![endif]-->';
	
}
add_action('wp_head', 'gp_wp_header');


/////////////////////////////////////// Navigation Menus ///////////////////////////////////////


add_action('init', 'register_my_menus');
function register_my_menus() {
	register_nav_menus(array(
		'header-nav' => __('Header Navigation', 'gp_lang')
	));
}


/////////////////////////////////////// Mobile Navigation ///////////////////////////////////////


class gp_mobile_menu extends Walker_Nav_Menu{

	var $to_depth = -1;
	
	function start_lvl(&$output, $depth){
		$indent = str_repeat("\t", $depth);
	}
	
	function end_lvl(&$output, $depth){
		$indent = str_repeat("\t", $depth);
	}
	
	function start_el(&$output, $item, $depth, $args){
		$item->title = str_repeat("-", $depth * 2).'&nbsp;'.$item->title;
		parent::start_el($output, $item, $depth, $args);
		$output = str_replace('<li', '<option value="' . $item->url . '"', $output);
	}
	
	function end_el(&$output, $item, $depth){
		$output .= "</option>\n";
	}

}


/////////////////////////////////////// Other Features ///////////////////////////////////////


// Featured images
add_theme_support('post-thumbnails');
set_post_thumbnail_size(150, 150, true);

// Background customizer
global $wp_version;
if(version_compare($wp_version, '3.4', '>=')) {
		add_theme_support('custom-background');
} else {
	add_custom_background();
}

// This theme styles the visual editor with editor-style.css to match the theme style.
add_editor_style();

// Set the content width based on the theme's design and stylesheet.
if(!isset($content_width)) $content_width = 570;

// Add default posts and comments RSS feed links to <head>.
add_theme_support('automatic-feed-links');

// bbPress Support
if(is_admin() && function_exists('is_bbpress')) { add_theme_support('bbpress'); }


/////////////////////////////////////// Excerpts ///////////////////////////////////////


// Character Length
function new_excerpt_length($length) {
	return 10000;
}
add_filter('excerpt_length', 'new_excerpt_length');

function excerpt($count){
	$excerpt = get_the_excerpt();
	$excerpt = strip_tags($excerpt);
	if(strlen($excerpt) > $count) {
		$excerpt = substr($excerpt, 0, $count);
		$excerpt = $excerpt."...";
	}
	return $excerpt;
}

// Replace Excerpt Ellipsis
function new_excerpt_more($more) {
	return '';
}
add_filter('excerpt_more', 'new_excerpt_more');
remove_filter('the_excerpt', 'wpautop');

// Content More Text
function new_more_link($more_link, $more_link_text) {
	return str_replace('more-link', 'more-link read-more', $more_link);
}
add_filter('the_content_more_link', 'new_more_link', 10, 2);


/////////////////////////////////////// Title Length ///////////////////////////////////////


function the_title_limit($count) {
	$title = the_title('','',FALSE);
	$title = strip_tags($title);
	if(strlen($title) > $count) {
		$title = substr($title, 0, $count);
		$title = $title."...";
	}
	echo $title;
}


/////////////////////////////////////// Add Excerpt Support To Pages ///////////////////////////////////////

add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}


/////////////////////////////////////// Shortcode Support For Text Widget ///////////////////////////////////////

add_filter('widget_text', 'do_shortcode');


/////////////////////////////////////// Breadcrumbs ///////////////////////////////////////


function the_breadcrumb() {
global $post;
	if (!is_home()) {
		echo '<a href="'.home_url().'">'.__('Home', 'gp_lang').'</a>';
		if (is_category()) {
			echo " &rsaquo; ";
			echo single_cat_title();
		}
		elseif(is_singular('post') && !is_attachment()) {
			$cat = get_the_category(); $cat = $cat[0];
			echo " &rsaquo; ";
			if(get_the_category()) { 
				$cat = get_the_category(); $cat = $cat[0];
				echo get_category_parents($cat, TRUE, ' &rsaquo; ');
			}
			echo the_title_limit(40);
		}		
		elseif (is_search()) {
			echo " &rsaquo; ";
			_e('Search', 'gp_lang');
		}		
		elseif (is_page() && $post->post_parent) {
			echo ' &rsaquo; <a href="'.get_permalink($post->post_parent).'">';
			echo get_the_title($post->post_parent);
			echo "</a> &rsaquo; ";
			echo the_title_limit(40);
		}
		elseif (is_page() OR is_attachment()) {
			echo " &rsaquo; "; 
			echo the_title_limit(40);
		}
		
		elseif (is_author()) {
			echo wp_title(' &rsaquo; ', true, 'left');
			echo "'s ".__('Posts', 'gp_lang');
		}
		elseif (is_404()) {
			echo " &rsaquo; "; 
			_e('Page Not Found', 'gp_lang');;
		}
		elseif (is_archive()) {
			echo wp_title(' &rsaquo; ', true, 'left');
		}
	}
}


/////////////////////////////////////// Page Navigation ///////////////////////////////////////


function gp_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     
	 if (get_query_var('paged')) {
		 $paged = get_query_var('paged');
	 } elseif (get_query_var('page')) {
		 $paged = get_query_var('page');
	 } else {
		 $paged = 1;
	 }

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
	
     if(1 != $pages)
     {
        echo "<div class='clear'></div><div class='wp-pagenavi cat-navi'>";
		echo '<span class="pages">'.__('Page', 'gp_lang').' '.$paged.' '.__('of', 'gp_lang').' '.$pages.'</span>';
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}


/////////////////////////////////////// Shortcode Empty Paragraph Fix ///////////////////////////////////////


// Plugin URI: http://www.johannheyne.de/wordpress/shortcode-empty-paragraph-fix/
add_filter('the_content', 'shortcode_empty_paragraph_fix');
function shortcode_empty_paragraph_fix($content)
{   
	$array = array (
		'<p>[' => '[', 
		']</p>' => ']',
		']<br />' => ']'
	);

	$content = strtr($content, $array);

	return $content;
}


/////////////////////////////////////// Custom Media Gallery Field ///////////////////////////////////////


function ghostpool_attachment_fields_to_edit($form_fields, $post) {
	$form_fields["ghostpool_video_url"] = array(
		"label" => __('Audio/Video URL', 'gp_lang'),
		"input" => "text",
		"value" => get_post_meta($post->ID, "_ghostpool_video_url", true),
		"helps" => __('The URL of your video or audio file (YouTube/Vimeo/FLV/MP4/M4V/MP3).', 'gp_lang'),
	);
   return $form_fields;
}
add_filter("attachment_fields_to_edit", "ghostpool_attachment_fields_to_edit", null, 2);

function ghostpool_attachment_fields_to_save($post, $attachment) {
	if(isset($attachment['ghostpool_video_url'])){
		update_post_meta($post['ID'], '_ghostpool_video_url', $attachment['ghostpool_video_url']);
	}	
	return $post;
}
add_filter("attachment_fields_to_save", "ghostpool_attachment_fields_to_save", null , 2);


/////////////////////////////////////// Redirect to Theme Options after Activation ///////////////////////////////////////


if(is_admin() && isset($_GET['activated']) && $pagenow == "themes.php") {
	add_action('admin_head','ct_option_setup');
	header('Location: '.admin_url().'themes.php?page=theme-options.php');
}

/////////////////////////////////////// Include Jon's Files ///////////////////////////////////////
require_once(ghostpool . 'jm_event_functions.php');
?>