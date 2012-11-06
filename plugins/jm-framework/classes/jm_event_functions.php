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
	public static function __construct()
	{
		add_action( 'new_event', array( $this, 'new_post_list' ), 10, 2 );
		wp_insert_term(
  			'Apple', // the term 
  			'MailPress_mailing_list', // the taxonomy
  			array(
    			'description'=> 'A yummy apple.',
    			'slug' => 'apple',
    			'parent'=> 0
  			)
		);
	}

	/**
	 * Checks a new post, and creates a new mailing list if 
	 * needed
	 */
	private static new_post_list( $post, $post_id )
	{
		$parent_term = term_exists( 'Apple', 'MailPress_mailing_list' ); // array is returned if taxonomy is given
		$parent_term_id = $parent_term['term_id']; // get numeric term id
		wp_insert_term(
  			'Reuters', // the term 
  			'MailPress_mailing_list', // the taxonomy
  			array(
    			'description'=> 'A yummy apple.',
    			'slug' => 'apple',
    			'parent'=> $parent_term_id
  			)
		);
	}

	/**
	 * Creates a new mailing list
	 */
	private add_new_mailing_list()
	{

	}
}

new JM_EventManager();
?>