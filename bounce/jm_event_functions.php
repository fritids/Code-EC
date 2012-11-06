<?php
/**
 * This is written to help with proper syncrhonization and
 * use of events.
 *
 * It does the following:
 *  - Create new mailing list per event
 *
 * @author Jonathon McDonald <jon@onewebcentric.com>
 */
class JM_EventManager
{
	/**
	 * Hooks into actions
	 */
	public function __construct()
	{
		// Save an event as a mailing list
		add_action( 'wp_insert_post', array( $this, 'new_post_list' ) );
	}

	/**
	 * Checks a new post, and creates a new mailing list if 
	 * needed
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
}

new JM_EventManager();
?>