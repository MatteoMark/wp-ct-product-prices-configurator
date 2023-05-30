<?php
// /wp-content/plugins/wp-ct-product-prices-configurator/wp-ct-product-prices-configurator.php
/**
 * Plugin Name:       CT WP Admin Form Example
 * Description:       Create custom wp-admin forms
 * Version:           1.0.0
 * Text Domain:       ct-admin
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
  die;
}

define('CT_WP_ADMIN_VERSION', '1.0.0');

define('CT_WP_ADMIN_DIR', 'wp-ct-product-prices-configurator');

/**
 * Helpers
 */
require plugin_dir_path(__FILE__) . 'includes/helpers.php';


/**
 * The core plugin class
 */
require plugin_dir_path(__FILE__) . 'includes/class-ct-product-prices-configurator.php';


function run_ct_wp_admin_form()
{

  $plugin = new Ct_Admin_Form();
  $plugin->init();

}
run_ct_wp_admin_form();

register_activation_hook(__FILE__, 'panels_create_page');
function panels_create_page()
{
  if (!function_exists('wp_get_current_user')) {
    include(ABSPATH . "wp-includes/pluggable.php");
  }
  if (!function_exists('post_exists')) {
    require_once(ABSPATH . 'wp-admin/includes/post.php');
  }
  $title = "title";

  if (!current_user_can('activate_plugins'))
    return;

  global $wpdb;

  if (null === $wpdb->get_row("SELECT post_name FROM {$wpdb->prefix}posts WHERE post_name = 'new-page-slug'", 'ARRAY_A')) {

    $current_user = wp_get_current_user();
    $title = get_option("panels-admin-datas")["panels_page_title"];
    $wp_content = '
        <div id="wp_panels"></div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script> 
          $(function(){$("#wp_panels").load("http://localhost:8888/websites/gc/wp-content/plugins/wp-ct-product-prices-configurator/includes/panels_list.php"); });
        </script>';

    $page = array(
      'post_title' => __($title),
      'post_status' => 'publish',
      'post_author' => $current_user->ID,
      'post_type' => 'page',
      'post_content' => $wp_content,
    );
    if (post_exists($title) == false)
      wp_insert_post($page);
  }
}