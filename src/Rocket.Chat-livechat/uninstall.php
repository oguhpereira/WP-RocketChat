<?php

/**
 * Fired when the plugin is uninstalled.
 *
 *

 *
 * @package    RocketChatLivechat
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

delete_option( 'rocketchat-livechat-url' );