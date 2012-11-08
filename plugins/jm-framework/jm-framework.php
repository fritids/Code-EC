<?php
/*
Plugin Name:  jm-framework
Plugin URI:  http://onewebcentric.com
Description:  Brings it all together
Version:  .03
Author URI:  http://onewebcentric.com
Author:  Jon McDonald of OneWebCentric
*/

/*
 * Define our plugin path
 */
define( 'JM_PATH', plugin_dir_path(__FILE__) );
define( 'JM_STYLE', get_bloginfo('url') . '/wp-content/plugins/jm-framework/css' );

// Include for adapter between EventManager and MailPress
require_once( JM_PATH . '/classes/JM_EventManager.php');

// Include for single event helpers
require_once( JM_PATH . '/classes/JM_EventSingle.php');
require_once( JM_PATH . '/classes/JM_Events.php');
?>