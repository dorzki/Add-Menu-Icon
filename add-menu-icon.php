<?php
/**
 * Plugin Name: Add Menu Icon
 * Plugin URI: https://www.dorzki.co.il
 * Description: Adding a menu icon to menu links.
 * Version: 1.0.0
 * Author: dorzki
 * Author URI: https://www.dorzki.co.il
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: dorzki-add-menu-icon
 * Domain Path: /languages
 *
 * @package WordPress
 * @subpackage addMenuIcon
 * @since  1.0.0
 * @version 1.0.0
 * @author  Dor Zuberi <me@dorzki.co.il>
 * @link https://www.dorzki.co.il
 */


// If trying to access the file directly, die...
if ( ! defined( 'WPINC' ) ) {
  die;
}



/**
 * AI_PLUGIN CONTANTS
 */
if ( ! defined( 'AI_PLUGIN_ROOT_URL' ) ) {
  define( 'AI_PLUGIN_ROOT_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'AI_PLUGIN_ROOT_DIR' ) ) {
  define( 'AI_PLUGIN_ROOT_DIR', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'AI_PLUGIN_VERSION' ) ) {
  define( 'AI_PLUGIN_VERSION', '1.0.0' );
}



/**
 * AI_PLUGIN CLASSES
 */
require_once( ABSPATH . 'wp-admin/includes/nav-menu.php' );
require_once( AI_PLUGIN_ROOT_DIR . 'classes/edit-menu-add-icon-walker.php' );
require_once( AI_PLUGIN_ROOT_DIR . 'classes/display-menu-add-icon-walker.php' );
require_once( AI_PLUGIN_ROOT_DIR . 'classes/add-icon.php' );



/**
 * INITATE AI_PLUGIN
 */
$plugin = new addIcon();