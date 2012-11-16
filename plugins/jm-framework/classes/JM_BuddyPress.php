<?php
/**
 * This provides helpers for BuddyPress integration.  We are currently using a theme
 * that will handle a lot of this for us, so this should be short and sweet.
 *
 * Currently does:
 * -  User must be registered/logged in to view /members/
 *
 * @author Jonathon McDonald <jon@onewebcentric.com>
 * @since 0.5
 */
class JM_BuddyPress
{
	/**
	 * Hooks changes into various actions/filters
	 *
	 * @since 0.5
	 */
	public function __construct()
	{
		// Hook into wp_head, check /members/ directory for logged in
		add_action('wp_head', array( $this, 'members_require_login' ) );
	}

	/**
	 * Requires the user to be logged in.  This is currently given a 
	 * page id, but will eventually be updated to support more dynamic checking,
	 * so it is not reliant on static content.
	 *
	 * @since 0.5
	 */
	public function members_require_login()
	{

		if( is_page( 1487 ) )
		{
			if( !is_user_logged_in() )
			{
				echo'<!-- Hello World -->';
				wp_redirect( bp_get_signup_page(false) );
				exit;
			}
		}
	}
}

new JM_BuddyPress();
?>