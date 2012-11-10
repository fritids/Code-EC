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


	// ----------------------- Home Page Events ------------------------ //

	/**
	 * Used to render [home-events] shortcode, this currently
	 * shows the two most recent events.  Styled for homepage
	 *
	 * @since 0.4
	 */
	public function home_page_events( $atts, $content = null ) 
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

			// Check if this is the beginning or the ending div
			if( $i == 0 )
				$out .= '<div class="columns two first blank ">';
			else
				$out .= '<div class="columns two last blank ">';

			// Output the data
			$out .= '<div class="columns two first blank" style="border:none;">';
			$out .= '<h5><a href="' . get_permalink( $EM_Event->ID )
			. '">' . $EM_Event->event_name
			. '</a></h5>';
			$out .= '' . self::get_date( $EM_Event )
			. '<br />';
			$out .= '' . self::get_location( $EM_Event );
			$out .= '</div>';

			$out .= '<div style="columns two last blank" style="border:none;">' . self::get_attendees_string( $EM_Event );
			$out .= '<br />';
			$out .= '<div style="float: right;">';
			$out .= self::get_attendee_count( $EM_Event ) . ' attending.  
			<a class="sc-button yellow medium" href="' . get_permalink( $EM_Event->ID );
			$out .= '">RSVP »</a></div>
			</div>
			</div>';
			$i++;
		}

		return $out;
	}

	/**
	 * Private helper method that gets a location string for HTML output
	 *
	 * @param object EM_Event Must be a valid event
	 * @return string Location of event, or 'No physical location'
	 * @since 0.4
	 */
	private function get_location( $EM_Event )
	{
		if( !$EM_Event )
			return;

		// Get the location
		$EM_Location = new EM_Location( $EM_Event->location_id );

		// Sanitize the location
		$location = ( $EM_Location->location_name ) ? $EM_Location->location_name : 'No physical location';

		return $location;
	}

	/**
	 * Private helper method that will format a date to a more user friendly format
	 *
	 * @param object EM_Event Must be a valid event
	 * @return string Date of event, in style of "Day, Month Year"
	 * @since 0.4
	 */
	private function get_date( $EM_Event )
	{
		if( !$EM_Event )
			return;

		// Get the event date
		$unformatted_date = $EM_Event->event_start_date;

		// Get the unix time and convert it using PHP's date
		$unix_time        = strtotime( $unformatted_date );
		$formatted_date   = date( 'l, F jS, Y', $unix_time );

		return $formatted_date;
	}

	/**
	 * Get array of attendees, unformatted but perfect for easy formatting
	 * 
	 * @param object EM_Event Must be a valid event
	 * @return array EM_Person An array of EM_Person objects
	 * @since 0.4
	 */
	private function get_attendees( $EM_Event )
	{
		if( !$EM_Event )
			return;

		// Load the bookings, and prepare an array
		$bookings = new EM_Bookings( $EM_Event );
		$people   = array();

		// Loop through and get all the people
		foreach( $bookings->bookings as $booking )
		{
			$people[] = $booking->get_person();
		}

		return $people;
	}

	private function get_attendee_count( $EM_Event )
	{
		if( !$EM_Event )
			return;

		// Load the bookings, and retrieve the count, super simple!
		$bookings = new EM_Bookings( $EM_Event );

		return $bookings->get_booked_spaces();
	}

	/**
	 * Returns a formatted string of user avatars for a given event
	 *
	 * @param object EM_Event Must be a valid event
	 * @param int count Defaults to 4
	 * @return string User avatars
	 * @since 0.4
	 */
	private function get_attendees_string( $EM_Event, $count = 4 )
	{
		if( !$EM_Event )
			return;

		// Get the people attending, and prepare a string
		$people           = self::get_attendees( $EM_Event );
		$i                = 0;
		$formatted_string = "";

		// Create and add the users to the string
		foreach( $people as $person )
		{
			// Ensure proper count
			if( $i >= $count )
				break;

			// Add this user's avatar
			$formatted_string .= '<div style="padding-right: 10px; display:inline-block; float:right;">';
			$formatted_string .= '<a href="' . bp_core_get_userlink( $person->ID, false, true) . '">';
			$formatted_string .= get_avatar($person->ID, 40, 'Mystery Man');
			$formatted_string .= '</a>';
			$formatted_string .= '</div>';

			// Increment our counter
			$i++;
		}

		// Return the users, or if empty a blanket statement.  
		return ( $formatted_string == "") ? 'Just announced, be the first to RSVP' : $formatted_string;
	}
}

new JM_Events();
?>