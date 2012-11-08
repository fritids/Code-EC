<?php
/**
 * Provides a class used to provide userful shortcodes
 * and helpful actions for working with multiple events
 *
 * @author Jonathon McDonald <jon@onewebcentric.com>
 * @since 0.4
 */

class JM_Events
{
	/**
	 * Adds actions, shortcodes, etc
	 *
	 * @since 0.4
	 */
	public function __construct()
	{
		// Add [home-events] shortcode
		add_shortcode( 'home-events', array( $this, 'home_page_events' ) );
	}

	/**
	 * Used to render [home-events] shortcode, this currently
	 * shows the two most recent events.  Styled for homepage
	 *
	 * @since 0.4
	 */
	public function home_page_events($atts, $content = null) 
	{
		// Get an array of events
		$EM_Events = new EM_Events();
		$i         = 0;
		$out       = "";

		// Ensure there are events to show
		if( !$EM_Events || count( $EM_Events ) == 0 )
		{
			$out = 'No upcoming events...';
			return $out;
		}

		// Get the two latest, and output their information
		foreach( $EM_Events as $EM_Event )
		{
			// We've gotten the two latest, break
			if( $i == 2 )
				break;

			// Get the location
			$EM_Location = new EM_Location( $EM_Event->location_id );

			// Sanitize the location
			$location = ( $EM_Location->location_name ) ? $EM_Location->location_name : 'No physical location';

			// Check if this is the beginning or the ending div
			if( $i == 0 )
				$out .= '<div class="columns two first blank ">';
			else
				$out .= '<div class="columns two last blank ">';

			// Output the data
			$out .= '<div class="columns two first blank" style="border:none;">';
			$out .= '<strong><a href="' . get_permalink( $EM_Event->ID )
			. '">' . $EM_Event->event_name
			. '</a></strong><br />';
			$out .= '' . $EM_Event->event_start_date
			. '<br />';
			$out .= '' . $location;
			$out .= '</div>';

			$out .= '<div style="columns two last blank" style="border:none;">' . $EM_Event->post_excerpt
			. '</div></div>';
			$i++;
		}

		return $out;
	}
}

new JM_Events();
?>