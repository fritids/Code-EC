<?php



	if(post_password_required()) { ?>
		
	<?php
		return;
	}
	
?>

<?php

/*************************** Comment Template ***************************/

function comment_template($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	
	<div id="comment-<?php comment_ID(); ?>" class="comment-box">

		<div class="comment-avatar">
			<a href="<?php echo bp_core_get_userlink( get_comment()->user_id, false, true) ?>">
			<?php echo get_avatar($comment,$size='60',$default=get_template_directory_uri().'/lib/images/gravatar.png'); ?>
			<span class="post-author"><?php _e('Author', 'gp_lang'); ?></span>
			</a>
		</div>
		
		<div class="comment-body">
			
			<div class="comment-author">
				<?php $aID        = get_comment()->user_id; ?>
				<?php $user       = get_user_meta( $aID ); ?>
				<?php $first_name = bp_get_profile_field_data('field=First Name&user_id=' . $aID); ?>
				<?php $last_name  = bp_get_profile_field_data('field=Last Name&user_id=' . $aID); ?>
				<a href="<?php echo bp_core_get_userlink( get_comment()->user_id, false, true) ?>">
				<?php echo $first_name . ' ' . $last_name; ?>
				</a>
			</div>
			
			<div class="comment-date">
				<?php comment_time(get_option('date_format')); ?>, <?php comment_time(get_option('time_format')); ?> &nbsp;&nbsp;/&nbsp; <?php comment_reply_link(array_merge($args, array('reply_text' => __('Reply', 'gp_lang'), 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
				
			</div>	
					
			<div class="comment-text">
				<?php comment_text() ?>
				<?php if($comment->comment_approved == '0') { ?>
					<div class="error">
						<?php _e('Your comment is awaiting moderation.', 'gp_lang'); ?>
					</div>
				<?php } ?>
			</div>
			
		</div>	
		
	</div>

<?php } ?>

<?php if('open' == $post->comment_status OR have_comments()) { ?>	
	<div id="comments">
<?php } ?>

	<?php if(have_comments()) { // If there are comments ?>
		
		<ol id="commentlist">
			<?php wp_list_comments('callback=comment_template'); ?>
		</ol>
							
		<?php $total_pages = get_comment_pages_count(); if($total_pages > 1) { ?>
			<div class="wp-pagenavi comment-navi"><?php paginate_comments_links(); ?></div>
		<?php } ?>	

		<?php if('open' == $post->comment_status) { // If comments are open, but there are no comments yet ?>
		
		<?php } else { // If comments are closed ?>
		
			<h4><?php _e('Comments are now closed on this post.', 'gp_lang'); ?></h4>
	
		<?php } ?>
		
	<?php } else { // If there are no comments yet ?>
	
	<?php } ?>

	<?php if('open' == $post->comment_status) { ?>
	
		<!--Begin Comment Form-->
		<div id="commentform">
			
			<!--Begin Respond-->
			<div id="respond">
			
				<h4><?php comment_form_title(__('Join the Discussion', 'gp_lang'), __('Respond to %s', 'gp_lang')); ?> <?php cancel_comment_reply_link(__('Cancel Reply', 'gp_lang')); ?></h4>
			
				<?php if(get_option('comment_registration') && !$user_ID) { ?>
			
					<p><?php _e('You must be logged in to post a comment.', 'gp_lang'); ?></p>
			
				<?php } else { ?>
			
					<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">
			
					<?php if ($user_ID) { ?>
						<div style="clear: both;"></div>
						<div class="my-avatar">
							<a href="<?php echo bp_core_get_userlink( $user_ID, false, true) ?>">
								<?php echo get_avatar($user_ID, 50, 'Mystery Man'); ?>
							</a>
						</div>		
					<?php } ?>
						
					<div id="event-comment">
						<textarea name="comment" id="event-comment-box" cols="5" rows="7" tabindex="4" placeholder="Leave a comment..."></textarea></p>
						<div style="clear: both;"></div>
						<input name="submit" type="submit" id="event-submit" tabindex="5" value="<?php _e('Post', 'gp_lang'); ?>" />
					</div>
					<div style="clear: both;"></div>
	
					<?php comment_id_fields(); ?>
		
					<?php do_action('comment_form', $post->ID); ?>
			
					</form>
	
				<?php } ?>
	
			</div>
			<!--End Respond-->
		
		</div>
		<!--End Comment Form-->
	
	<?php } ?>


<?php if('open' == $post->comment_status OR have_comments()) { ?>
	</div>
<?php } ?>