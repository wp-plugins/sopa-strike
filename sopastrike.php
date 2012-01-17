<?php
/**
 * @package Sopastrike
 * @version 1.1
 */
/*
Plugin Name: SOPA Strike
Plugin URI: http://extrafuture.com/sopa-strike-wordpress-plugin/
Description: On Wednesday, January 18th 2012 this plugin will redirect all users of your blog to the SOPA Strike page. It logs your website name and URL to be included on a roll call of supporters.
Author: Phil Nelson
Version: 1.1
Author URI: http://extrafuture.com
*/

// Add our JS
function sopastrike() {
	echo "<script>
var a=new Date;if(18==a.getDate()&&0==a.getMonth()&&2012==a.getFullYear())window.location='http://sopastrike.com/strike';
</script>	";
}

function phone_home()
{
	$url = get_bloginfo('siteurl');
	$name = get_bloginfo('name');
	
	$context = stream_context_create(array( 
	  'http' => array( 
	      'timeout' => 1 
	      ) 
	  ) 
	); 
	$content = file_get_contents('http://extrafuture.com/code/sopastrike/track.php?url='.urlencode($url).'&name='.urlencode($name), false,  $context); 
}

register_activation_hook( __FILE__, 'phone_home' );
add_action( 'wp_head', 'sopastrike' );

?>