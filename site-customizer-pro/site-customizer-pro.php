<?php
/**
 * Plugin Name: Site Customizer Pro
 * Plugin URI:  https://example.com/site-customizer-pro // Optional: Add your plugin's website URL
 * Description: Adds custom CSS and other customizations to the site.
 * Version:     1.0.0
 * Author:      Your Name // Replace with your name or company
 * Author URI:  https://example.com // Optional: Add your website URL
 * License:     GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: site-customizer-pro
 * Domain Path: /languages
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Enqueue custom styles for the front-end.
 */
function scp_enqueue_styles() {
    // Register the stylesheet.
    wp_register_style(
        'scp-custom-styles', // Handle
        plugin_dir_url( __FILE__ ) . 'css/custom-styles.css', // Path to CSS file
        array(), // Dependencies
        '1.0.0', // Version
        'all' // Media type
    );

    // Enqueue the stylesheet.
    wp_enqueue_style( 'scp-custom-styles' );
}
add_action( 'wp_enqueue_scripts', 'scp_enqueue_styles' );

/**
 * Placeholder for adding an admin menu page (we can add this later).
 */
// function scp_add_admin_menu() {
//     // Add menu page logic here
// }
// add_action( 'admin_menu', 'scp_add_admin_menu' );

/**
 * Placeholder for plugin activation/deactivation hooks (if needed).
 */
// function scp_activate() {
//     // Activation code here
// }
// register_activation_hook( __FILE__, 'scp_activate' );

// function scp_deactivate() {
//     // Deactivation code here
// }
// register_deactivation_hook( __FILE__, 'scp_deactivate' );

?>