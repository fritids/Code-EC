<?php
/**
 * Provides a class used to provide userful shortcodes
 * and helpful actions for styling an event page properly.
 *
 * @author Jonathon McDonald <jon@onewebcentric.com>
 * @since 0.3
 */

class JM_EventSingle
{
	/**
	 * Adds actions, shortcodes, etc
	 *
	 * @since 0.3
	 */
	public function __construct()
	{
		// Enqueue custom event CSS
		add_action( 'wp_enqueue_scripts', array( $this, 'css' ) );

		// Add [eventauthor] shortcode
		add_shortcode( 'eventauthor', array( $this, 'event_author' ) );
	}

	/**
	 * Enqueues a custom CSS file specifically for events
	 *
	 * @since 0.3
	 */
	public function css()
	{
		global $post;

		if( get_post_type( $post ) == 'event' )
		{
			wp_register_style( 'jm-single-event', JM_STYLE . '/single-event.css' );
			wp_enqueue_style( 'jm-single-event' );
		}
	}

	/**
	 * Shortcode to display event author
	 *
	 * @since 0.3
	 * @todo Needs proper checking
	 */
	public function event_author($atts, $content = null) 
	{
		$out .=
	
		'<div class="author-info event-author"><div class="author-info-fold"></div>'.
	
			'<a href="'.home_url( '/' ).'members/'.get_the_author_meta('user_login').'/profile/">'.get_avatar(get_the_author_id(), 50).'</a>
	
			<div class="author-meta">
		
				<div class="author-meta-top">
					<h1 class="page-title">The Host</h1>
					<div class="author-name"><a href="'.home_url( '/' ).'members/'.get_the_author_meta('user_login').'/profile/">'.get_the_author().'</a></div>'.
				
					'
			
				</div>
			
				<div class="author-desc">'.get_the_author_meta('description').'</div>
		
			</div>
		
		</div>
		';
				
    	return $out;
	}
}

new JM_EventSingle();
?>