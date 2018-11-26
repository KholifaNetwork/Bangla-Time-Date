<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/* Uninstall Plugin */

// if not uninstalled plugin
if( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) 
	exit(); // out!


/*esle:
	if uninstalled plugin, this options will be deleted
*/
delete_option('bntd_options');
delete_option('bntd_wgt1');
delete_option('bntd_wgt2');
delete_option('bntd_wgt3');

?>
