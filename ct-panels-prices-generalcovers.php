<?php
// /wp-content/plugins/ct-wp-admin-form/ct-wp-admin-form.php
/**
 * Plugin Name:       GeneralCovers - Pannelli
 * Description:       Configuratore pannelli fotovoltaici GeneralCovers
 * Version:           0.0.9
 * Text Domain:       ct-admin
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

define( 'CT_WP_ADMIN_VERSION', '1.0.0' );

define( 'CT_WP_ADMIN_DIR', 'ct-panels-prices-generalcovers' );

/**
 * Helpers
 */
require plugin_dir_path( __FILE__ ) . 'includes/helpers.php';


/**
 * The core plugin class
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ct-panels-prices-generalcovers.php';


function run_ct_wp_admin_form() {

    $plugin = new Ct_Admin_Form();
    $plugin->init();

}
run_ct_wp_admin_form();

