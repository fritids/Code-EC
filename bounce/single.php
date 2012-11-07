<?php get_header();

global $gp_settings;

?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div id="content">

		<!--Begin Image-->
		<?php if(has_post_thumbnail() && $gp_settings['show_image'] == "Show") { ?>
		
			<div class="post-thumbnail<?php if($gp_settings['image_wrap'] == "Enable") { ?> wrap<?php } ?>">
				<?php $image = vt_resize(get_post_thumbnail_id(), '', $gp_settings['image_width'], $gp_settings['image_height'], true); ?>
				<img src="<?php echo $image[url]; ?>" alt="<?php if(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)) { echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); } else { echo get_the_title(); } ?>" />			
			</div>					
							
			<?php if($gp_settings['image_wrap'] == "Disable") { ?><div class="clear"></div><?php } ?>
		
		<?php } ?>
		<!--End Image-->
		
		<div id="post-content">
			<?php the_content(__('Read More &raquo;', 'gp_lang')); ?>
		</div>
		
		<?php wp_link_pages('before=<div class="clear"></div><div class="wp-pagenavi post-navi">&pagelink=<span>%</span>&after=</div><div class="clear"></div>'); ?>		

		<?php if($gp_settings['meta_tags'] == "0") { ?>
			<?php the_tags('<div class="post-meta post-tags"><span class="tag-icon">', ', ', '</span></div>'); ?>
		<?php } ?>
		
		<?php if($gp_settings['author_info'] == "0") { ?>			
			<?php echo do_shortcode('[author]'); ?>				
		<?php } ?>
		
		<?php if($gp_settings['related_items'] == "0") { ?>				
			<?php echo do_shortcode('[related_posts id="" cats="" images="true" image_width="'.$theme_post_related_image_width.'" image_height="'.$theme_post_related_image_height.'" image_wrap="false" cols="3" per_page="3" link="both" orderby="random" order="desc" offset="0" content_display="excerpt" excerpt_length="0" title="true" title_size="12" meta="false" read_more="false" pagination="false" preload="false"]'); ?>			
		<?php } ?>					
		
		<?php comments_template(); ?>
	
	</div>
	
	<?php get_sidebar(); ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>