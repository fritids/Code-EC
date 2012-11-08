<?php get_header();

global $gp_settings;

?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php $EM_Event = new EM_Event( $post->ID ); ?>
	<div id="content">		
		<div id="post-content">
			<div id="event-header">
				<div class="columns twothirds first joint  text-left">
					<div style="float:left; display:inline-block;">
						<h2>
							<?php echo $EM_Event->event_start_date; ?>
							-
							<?php echo $EM_Event->event_end_date; ?>
						</h2>
						<h4>#_EVENTTIMES</h4>
					</div>
					<div class="clear"></div>
					<div id="event-content">
						#_EVENTNOTES
					</div>
				</div>

				<div class="columns onethird last joint  text-left">
					<div id="event-booking">
						{has_bookings}
						<h3>Join This Event</h3>
						#_BOOKINGFORM
						{/has_bookings}

						<h3>Who's Going?</h3>
						<div style="margin-top: -35px; margin-left: 20px; border: 0;">
							<?php do_shortcode('[eventauthor]'); ?>
						</div>
						#_ATTENDEES
					</div>
				</div>
			</div>
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