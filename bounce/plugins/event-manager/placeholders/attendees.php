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
			$user      = get_user_meta( $EM_Person->ID );
			?>
			<div style="clear: both;"></div>
			<div class="event-avatar">
				<a href="<?php echo bp_core_get_userlink( $EM_Person->ID, false, true) ?>">
					<?php echo get_avatar($EM_Person->ID, 50); ?> 
				</a>
			</div>
			<div class="event-avatar-desc">
					<?php echo $user['first_name'][0] . ' ' . $user['last_name'][0]; ?>
			</div> 
		<?php
		}elseif($EM_Booking->status == 1 && $guest_bookings && $EM_Booking->get_person()->ID == $guest_booking_user ){
			$EM_Person = $EM_Booking->get_person();
			$user      = get_user_meta( $EM_Person->ID );
			?>
			<div style="clear: both;"></div>
			<div class="event-avatar">
				<a href="<?php echo bp_core_get_userlink( $EM_Person->ID, false, true) ?>">
					<?php echo get_avatar($EM_Person->ID, 50); ?> 
				</a>
			</div>
			<div class="event-avatar-desc">
					<?php echo $user['first_name'][0] . ' ' . $user['last_name'][0]; ?>
			</div> 
		<?php
		}
	}
	?>
	</div>
	<?php
}