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
		$first_name = bp_get_profile_field_data('field=First Name&user_id=' . get_the_author_id());
		$last_name  = bp_get_profile_field_data('field=Last Name&user_id=' . get_the_author_id());
		$out .= '<div class="event-avatar">';
		$out .= '<a href="' . bp_core_get_userlink( get_the_author_id(), false, true) . '">';
		$out .= get_avatar(get_the_author_id(), 50) . '</a>';
		$out .= '</div>';
		$out .= '<div class="event-avatar-desc">';
		$out .= '<a href="' . bp_core_get_userlink( get_the_author_id(), false, true) . '">';
		$out .= $first_name . ' ' . $last_name;
		$out .= '<br />';
		$out .= '</a>';
		$out .= 'HOST';
		$out .= '</div>';
				
    	return $out;
	}
}

new JM_EventSingle();
?>