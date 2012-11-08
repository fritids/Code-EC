<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> class="no-js">
<head>
<meta charset=<?php bloginfo('charset'); ?> />
<title><?php bloginfo('name'); ?> | <?php is_home() || is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<?php require(ghostpool_inc . 'options.php'); ?>

<?php wp_head(); ?>
<?php require(ghostpool_inc . 'page-styling.php'); ?>

</head>

<!--[if !IE]><!-->
<body <?php body_class($gp_settings['browser'].' '.$gp_settings['layout'].' '.$gp_settings['padding'].' '.$gp_settings['frame'].' '.$gp_settings['skin']); ?>>
<!--<![endif]-->
<!--[if gt IE 8]>
<body <?php body_class('ie9 '.$gp_settings['browser'].' '.$gp_settings['layout'].' '.$gp_settings['padding'].' '.$gp_settings['frame'].' '.$gp_settings['skin']); ?>>
<![endif]-->
<!--[if lt IE 9]>
<body <?php body_class('ie8 '.$gp_settings['browser'].' '.$gp_settings['layout'].' '.$gp_settings['padding'].' '.$gp_settings['frame'].' '.$gp_settings['skin']); ?>>
<![endif]-->
 
<!--Begin Header Outer-->
<div id="header-outer" class="page-outer">
	
	<div class="page-inner">	

		<!--Begin Login/Register-->
		<?php if($theme_bp_links == "0" && function_exists('bp_is_active')) { ?>
		
			<div id="bp-links">
			
				<?php if(is_user_logged_in()) { ?>	
									
					<a href="<?php echo wp_logout_url(esc_url($_SERVER['REQUEST_URI'])); ?>" class="bp-logout-link"><?php _e('Logout', 'gp_lang'); ?></a>

				<?php } else { ?>
					
					<a href="<?php if($theme_login_url) { echo $theme_login_url; } else { echo wp_login_url(); } ?>" class="bp-login-link"><?php _e('Login', 'gp_lang'); ?></a>
					
					<?php if(bp_get_signup_allowed()) { ?><a href="<?php echo bp_get_signup_page(false); ?>" class="bp-register-link"><?php _e('Register', 'gp_lang'); ?></a><?php } ?>
					
				<?php } ?>
			
			</div>
			
			<div class="clear"></div>
			
		<?php } ?>
		<!--End Login/Register-->
				
		<!--Begin Header Inner-->
		<div id="header-inner">		
		
			<!--Begin Header Left-->
			<div id="header-left">
			
				<!--Begin Logo-->
				<<?php if(is_home() OR is_front_page()) { ?>h1<?php } else { ?>div<?php } ?> id="logo" style="<?php if($theme_logo_top) { ?> margin-top: <?php echo $theme_logo_top; ?>px;<?php } ?><?php if($theme_logo_left) { ?> margin-left: <?php echo $theme_logo_left; ?>px;<?php } ?><?php if($theme_logo_bottom) { ?> margin-bottom: <?php echo $theme_logo_bottom; ?>px;<?php } ?>">
					
					<span class="logo-details"><?php bloginfo('name'); ?> | <?php is_home() || is_front_page() ? bloginfo('description') : wp_title(''); ?></span>
					
					<?php if($theme_logo) { ?><a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php echo($theme_logo); ?>" alt="<?php bloginfo('name'); ?>" /></a><?php } else { ?><a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><span class="default-logo"></span></a><?php } ?>
					
				</<?php if(is_home() OR is_front_page()) { ?>h1<?php } else { ?>div<?php } ?>>
				<!--End Logo-->
			
			</div>
			<!--End Header Left-->
							
			<?php if($theme_contact_info) { ?>
				<div id="contact-info">
					<?php echo do_shortcode(stripslashes($theme_contact_info)); ?>
				</div>
			<?php } ?>
			
			<!--Begin Header Right-->
			<div id="header-right">
				
				<div id="nav">
				
					<?php wp_nav_menu('sort_column=menu_order&container=ul&theme_location=header-nav&fallback_cb=null'); ?>
					
					<?php wp_nav_menu(array('theme_location' => 'header-nav', 'walker' => new gp_mobile_menu(), 'items_wrap' => '<select class="mobile-menu">%3$s</select>', 'container' => '', 'menu_class' => 'mobile-menu', 'sort_column' => 'menu_order', 'fallback_cb' => 'null')); ?>
										
					<span id="social-icons">
					
						<?php if($theme_rss_button == "1") {} else { ?><a href="<?php if($theme_rss) { ?><?php echo($theme_rss); ?><?php } else { ?><?php bloginfo('rss2_url'); ?><?php } ?>" class="rss-icon" title="<?php _e('RSS Feed', 'gp_lang'); ?>" rel="nofollow" target="_blank"></a><?php } ?>
						
						<?php if($theme_twitter) { ?><a href="<?php echo $theme_twitter; ?>" class="twitter-icon" title="<?php _e('Twitter', 'gp_lang'); ?>" rel="nofollow" target="_blank"></a><?php } ?>
						
						<?php if($theme_facebook) { ?><a href="<?php echo $theme_facebook; ?>" class="facebook-icon" title="<?php _e('Facebook', 'gp_lang'); ?>" rel="nofollow" target="_blank"></a><?php } ?>
						
						<?php if($theme_digg) { ?><a href="<?php echo $theme_digg; ?>" class="digg-icon" title="<?php _e('Digg', 'gp_lang'); ?>" rel="nofollow" target="_blank"></a><?php } ?>
					
						<?php if($theme_delicious) { ?><a href="<?php echo $theme_delicious; ?>" class="delicious-icon" title="<?php _e('Delicious', 'gp_lang'); ?>" rel="nofollow" target="_blank"></a><?php } ?>
			
						<?php if($theme_dribbble) { ?><a href="<?php echo $theme_dribbble; ?>" class="dribbble-icon" title="<?php _e('Dribbble', 'gp_lang'); ?>" rel="nofollow" target="_blank"></a><?php } ?>
						
						<?php if($theme_youtube) { ?><a href="<?php echo $theme_youtube; ?>" class="youtube-icon" title="<?php _e('YouTube', 'gp_lang'); ?>" rel="nofollow" target="_blank"></a><?php } ?>
			
						<?php if($theme_vimeo) { ?><a href="<?php echo $theme_vimeo; ?>" class="vimeo-icon" title="<?php _e('Vimeo', 'gp_lang'); ?>" rel="nofollow" target="_blank"></a><?php } ?>
	
						<?php if($theme_linkedin) { ?><a href="<?php echo $theme_linkedin; ?>" class="linkedin-icon" title="<?php _e('LinkedIn', 'gp_lang'); ?>" rel="nofollow" target="_blank"></a><?php } ?>
						
						<?php if($theme_googleplus) { ?><a href="<?php echo $theme_googleplus; ?>" class="googleplus-icon" title="<?php _e('Google+', 'gp_lang'); ?>" rel="nofollow" target="_blank"></a><?php } ?>
											
						<?php if($theme_myspace) { ?><a href="<?php echo $theme_myspace; ?>" class="myspace-icon" title="<?php _e('MySpace', 'gp_lang'); ?>" rel="nofollow" target="_blank"></a><?php } ?>
												
						<?php if($theme_flickr) { ?><a href="<?php echo $theme_flickr; ?>" class="flickr-icon" title="<?php _e('Flickr', 'gp_lang'); ?>" rel="nofollow" target="_blank"></a><?php } ?>
						
						<?php echo stripslashes($theme_additional_social_icons); ?>

					</span>
					
					
				</div>
		
			</div>
			<!--End Header Right-->
		
			<!--Begin Top Content-->
			<?php if($gp_settings['top_content_panel'] == "Show") { ?>
				
				<div id="top-content" class="<?php if(get_post_meta($post->ID, 'ghostpool_top_content', true)) { ?> top-content-stripes<?php } ?><?php if($gp_settings['title'] == "Show") { ?> page-title-width<?php } ?>">
					
					<?php if($gp_settings['title'] == "Show") { ?>
					
						<div class="left">
						
							<h1 class="page-title">
							<?php if(is_single() OR is_page()) { ?>
								<?php the_title(); ?>
							<?php } elseif(is_search()) { ?>
								<?php echo $wp_query->found_posts; ?> <?php _e('search results for', 'gp_lang'); ?> "<?php echo esc_html($s); ?>"
							<?php } elseif(is_category()) { ?>
								<?php single_cat_title(); ?>
							<?php } elseif(is_tag()) { ?>
								<?php single_tag_title(); ?>
							<?php } elseif(is_author()) { ?>
								<?php wp_title(''); ?><?php _e('\'s Posts'); ?>
							<?php } elseif(is_404()) { ?>
								<?php _e('Page Not Found', 'gp_lang'); ?>
							<?php } elseif(function_exists('is_bbpress') && is_bbpress()) { ?>
								<?php wp_title(''); ?>									
							<?php } elseif(is_archive()) { ?>
								<?php _e('Archives', 'gp_lang'); ?> <?php wp_title(' / '); ?>			
							<?php } ?>
							</h1>					
		
							<?php if(is_singular() && ($gp_settings['meta_date'] == "0" OR $gp_settings['meta_author'] == "0" OR $gp_settings['meta_cats'] == "0" OR $gp_settings['meta_comments'] == "0") && get_post_type() != 'event' ) { ?>
								<div class="post-meta">
									<?php if($gp_settings['meta_author'] == "0") { ?><span class="author-icon"><a href="<?php echo get_author_posts_url($post->post_author); ?>"><?php the_author_meta('display_name', $post->post_author); ?></a></span><?php } ?>
									<?php if($gp_settings['meta_date'] == "0") { ?><span class="clock-icon"><?php the_time(get_option('date_format')); ?></span><?php } ?>
									<?php if($gp_settings['meta_cats'] == "0") { ?><span class="folder-icon"><?php the_category(', '); ?></span><?php } ?>
									<?php if($gp_settings['meta_comments'] == "0" && 'open' == $post->comment_status) { ?><span class="speech-icon"><?php comments_popup_link(__('0', 'gp_lang'), __('1', 'gp_lang'), __('%', 'gp_lang'), 'comments-link', ''); ?></span><?php } ?>
								</div>
							<?php } ?>
					
						</div>
					
					<?php } ?>
					
					<?php if($gp_settings['search'] == "Show" OR $gp_settings['breadcrumbs'] == "Show") { ?>
					
						<div class="right">
							
							<?php if($gp_settings['search'] == "Show") { ?>
								<?php get_search_form(); ?>
							<?php } ?>
							
							<?php if($gp_settings['breadcrumbs'] == "Show") { ?>
								<div id="breadcrumbs"><?php echo the_breadcrumb(); ?></div>
							<?php } ?>
						
						</div>
					
					<?php } ?>
						
					<div class="clear"></div>
					
					<?php echo stripslashes(do_shortcode(get_post_meta($post->ID, 'ghostpool_top_content', true))); ?>
		
				</div>
			
			<?php } ?>
			<!--End Top Content-->
			
			<div class="clear"></div>
	
		</div>
		<!--Header Inner-->
	
	</div>

</div>
<!--End Header Outer-->

<!--Begin Page Outer-->
<div class="page-outer">

	<!--Begin Page Inner-->
	<div class="page-inner">
	
		<!--Begin Content Wrapper-->
		<div id="content-wrapper">