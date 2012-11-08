<?php
/* @var $EM_Event EM_Event */
$people = array();
$EM_Bookings = $EM_Event->get_bookings();
if( count($EM_Bookings->bookings) > 0 ){
	?>
	<div class="event-attendees">
	<?php
	$guest_bookings = get_option('dbem_bookings_registration_disable');
	$guest_booking_user = get_option('dbem_bookings_registration_user');
	foreach( $EM_Bookings as $EM_Booking){
		if($EM_Booking->status == 1 && !in_array($EM_Booking->get_person()->ID, $people) ){
			$people[] = $EM_Booking->get_person()->ID;
			$EM_Person = $EM_Booking->get_person();
			?>
			<div>
				<a href="<?php echo bloginfo('siteurl') . '/members/' . strtolower($user_info->user_login); ?>">
					<?php echo get_avatar($EM_Person->ID, 50); ?> 
					<br />
					<?php echo $EM_Person->get_name(); ?>
				</a>
			</div> 
		<?php
		}elseif($EM_Booking->status == 1 && $guest_bookings && $EM_Booking->get_person()->ID == $guest_booking_user ){
			$EM_Person = $EM_Booking->get_person();
			?>
			<div>
				<a href="<?php echo bloginfo('siteurl') . '/members/' . strtolower($user_info->user_login); ?>">
					<?php echo get_avatar($EM_Person->ID, 50); ?> 
					<br />
					<?php echo $EM_Person->get_name(); ?>
				</a>
			</div> 
		<?php
		}
	}
	?>
	</div>
	<?php
}