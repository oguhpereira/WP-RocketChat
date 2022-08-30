<?php
/**
 *
 * @link              https://rocket.chat
 * @package           Rocket.chat.Livechat
 * @version           1.1.0
 *	
 * Plugin Name:       Rocket.Chat.LiveChat
 * Plugin URI:        https://github.com/oguhpereira/WP-RocketChat
 * Description:       This is a plugin to enable the use of rocket chat live chat on the site. If you have a rocket chat server with live chat active, you can configure it.
 * Version:           1.1.0
 * Author:            Rocket.Chat
 * Author URI:        https://rocket.chat
 * License:           GPL-3.0
 * License URI:       https://github.com/oguhpereira/WP-RocketChat/blob/develop/LICENSE
 * Text Domain:       rocketchat-livechat
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-rocketchat-livechat-activator.php
 */
function activate_rocketchat_livechat() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rocketchat-livechat-activator.php';
	RocketChatLivechat_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-rocketchat-livechat-deactivator.php
 */
function deactivate_rocketchat_livechat() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rocketchat-livechat-deactivator.php';
	RocketChatLivechat_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_rocketchat_livechat' );
register_deactivation_hook( __FILE__, 'deactivate_rocketchat_livechat' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-rocketchat-livechat.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 
 */
function run_rocketchat_livechat() {

	$plugin = new RocketChatLivechat();
	$plugin->run();

}
run_rocketchat_livechat();
