<?php
/**
 * This is written to help with proper syncrhonization and
 * use of events.
 *
 * It does the following:
 *  - Create new mailing list per event
 *  - Add user to a mailing list if they book for an event
 *
 * @author Jonathon McDonald <jon@onewebcentric.com>
 */
class JM_EventManager
{
	/**
	 * Hooks into actions
	 *
	 * @since 0.1
	 */
	public function __construct()
	{
		// Save an event as a mailing list
		add_action( 'wp_insert_post', array( $this, 'new_post_list' ) );
	
		// When a user creates a booking, add them to the mailing list
		add_action( 'em_bookings_added', array( $this, 'add_user_to_list' ) );

		// For testing purposes
		wp_set_object_terms( 11, 40, 'MailPress_mailing_list' );

	}

	/**
	 * Checks a new post, and creates a new mailing list if 
	 * needed
	 *
	 * @since 0.1
	 * @param int Post ID
	 */
	public function new_post_list( $post_id )
	{
		// Get the post object, and format a name
		$post = get_post( $post_id );
		$name = 'Event: ' . $post->post_title . '-' . $post->ID;

		// If valid, add this as a new mailing list
		if( $post->post_type == 'event' && !term_exists( $name, 'MailPress_mailing_list' ) && $post->post_status == "publish" )
		{
			wp_insert_term(
  				'Event: ' . $post->post_title . '-' . $post->ID, // the term 
  				'MailPress_mailing_list', // the taxonomy
  					array(
  				)
			);
		}	


	}

	/**
	 * Adds a user to the mailing list corresponding to the event
	 * they registered for.
	 *
	 * @since 0.2 
	 * @param object EM_Booking object
	 */
	public function add_user_to_list( $EM_Booking )
	{
		// Get the user ID, and MailPress ID
		$user_id    = $EM_Booking->person_id;
		$user_mp_id = get_user_meta( $user_id, '_MailPress_sync_wordpress_user' );
	
		// Get the event
		$event      = $EM_Booking->get_event();
		$event_name = $event->event_name;

		// Get the term
		$term       = get_term( 'Event: ' . $event_name . '-' . $event->post_id );
		$term_id    = $term->term_id;
		$current    = wp_get_object_terms( $user_mp_id, 'MailPress_mailing_list' );

		$curret[]   = $term;
		wp_set_object_terms( $user_mp_id, $term_id, 'MailPress_mailing_list', true );
	}
}

new JM_EventManager();
?>