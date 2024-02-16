<?php
/**
 *
 * @package   GS_Logo_Slider
 * @author    GS Plugins <hello@gsplugins.com>
 * @license   GPL-2.0+
 * @link      https://www.gsplugins.com
 * @copyright 2015 GS Plugins
 *
 * @wordpress-plugin
 * Plugin Name:			GS Logo Slider Lite
 * Plugin URI:			https://www.gsplugins.com/wordpress-plugins
 * Description:       	Best Responsive Logo slider to display partners, clients or sponsors Logo on WordPress site. Display anywhere at your site using shortcode like [gslogo id=1] / [gs_logo theme="slider1"] (old style) & widget. Check demo site at <a href="https://logo.gsplugins.com">GS Logo Slider Demo</a> & <a href="https://docs.gsplugins.com/gs-logo-slider">Installation, Documention & Shortcode Usage Guide</a>.
 * Version:           	3.5.1
 * Author:       		GS Plugins
 * Author URI:       	https://www.gsplugins.com
 * Text Domain:       	gslogo
 * License:           	GPL-2.0+
 * License URI:       	http://www.gnu.org/licenses/gpl-2.0.txt
 */

if ( ! defined( 'GSL_HACK_MSG' ) ) define( 'GSL_HACK_MSG', __( 'Sorry cowboy! This is not your place', 'gslogo' ) );

/**
 * Protect direct access
 */
if ( ! defined( 'ABSPATH' ) ) die( GSL_HACK_MSG );


/**
 * Defining constants
 */
if ( ! defined( 'GSL_VERSION' ) ) define( 'GSL_VERSION', '3.5.1' );
if ( ! defined( 'GSL_MENU_POSITION' ) ) define( 'GSL_MENU_POSITION', 33 );
if ( ! defined( 'GSL_PLUGIN_DIR' ) ) define( 'GSL_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
if ( ! defined( 'GSL_PLUGIN_URI' ) ) define( 'GSL_PLUGIN_URI', plugins_url( '', __FILE__ ) );

require_once GSL_PLUGIN_DIR . 'includes/gs-logo-functions.php';
require_once GSL_PLUGIN_DIR . 'includes/gs-logo-template-loader.php';
require_once GSL_PLUGIN_DIR . 'includes/gs-logo-scripts.php';
require_once GSL_PLUGIN_DIR . 'includes/gs-logo-cpt.php';
require_once GSL_PLUGIN_DIR . 'includes/gs-logo-metabox.php';
require_once GSL_PLUGIN_DIR . 'includes/gs-logo-shortcode.php';
require_once GSL_PLUGIN_DIR . 'includes/integrations/gs-logo-integrations.php';
require_once GSL_PLUGIN_DIR . 'includes/shortcode-builder/gs-logo-shortcode-builder.php';

require_once GSL_PLUGIN_DIR . 'includes/gs-logo-notices.php';
require_once GSL_PLUGIN_DIR . 'includes/gs-logo-column.php';
require_once GSL_PLUGIN_DIR . 'includes/asset-generator/gs-load-assets-generator.php';
require_once GSL_PLUGIN_DIR . 'includes/demo-data/gs-logo-dummy-data.php';
// require_once GSL_PLUGIN_DIR . 'includes/gs-pages/gs-other-plugins.php';
require_once GSL_PLUGIN_DIR . 'includes/gs-common-pages/gs-logo-common-pages.php';
require_once GSL_PLUGIN_DIR . 'includes/gs-logo-disable-notices.php';

/**
 * Activation redirects
 *
 * @since v1.0.0
 */
function gslogo_activate() {
    add_option('gslogo_activation_redirect', true);
}
register_activation_hook(__FILE__, 'gslogo_activate');

/**
 * Redirect to options page
 *
 * @since v1.0.0
 */
function gslogo_redirect() {

    if ( get_option('gslogo_activation_redirect', false) ) {

        delete_option('gslogo_activation_redirect');

        if ( !isset($_GET['activate-multi']) ) {
            wp_redirect("edit.php?post_type=gs-logo-slider&page=gs-logo-plugins-help");
        }
    }
}
add_action('admin_init', 'gslogo_redirect');

/**
 * Remove Reviews Metadata on plugin Deactivation.
 */
function gslogo_deactivate() {
    delete_option('gslogo_active_time');
    delete_option('gslogo_maybe_later');
    delete_option('gsadmin_maybe_later');

}
register_deactivation_hook(__FILE__, 'gslogo_deactivate');

// Plugin row meta data
if ( ! function_exists('gslogo_row_meta') ) {

    function gslogo_row_meta( $meta_fields, $file ) {
  
        if ( strpos($file, basename(__FILE__)) === false ) return $meta_fields;
        
        echo "<style>.gslogo-rate-stars { display: inline-block; color: #ffb900; position: relative; top: 3px; }.gslogo-rate-stars svg{ fill:#ffb900; } .gslogo-rate-stars svg:hover{ fill:#ffb900 } .gslogo-rate-stars svg:hover ~ svg{ fill:none; } </style>";

        $plugin_rate   = "https://wordpress.org/support/plugin/gs-logo-slider/reviews/?rate=5#new-post";
        $plugin_filter = "https://wordpress.org/support/plugin/gs-logo-slider/reviews/?filter=5";
        $svg_xmlns     = "https://www.w3.org/2000/svg";
        $svg_icon      = '';

        for ( $i = 0; $i < 5; $i++ ) {
            $svg_icon .= "<svg xmlns='" . esc_url( $svg_xmlns ) . "' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>";
        }

        // Set icon for thumbsup.
        $meta_fields[] = '<a href="' . esc_url( $plugin_filter ) . '" target="_blank"><span class="dashicons dashicons-thumbs-up"></span>' . __( 'Vote!', 'gscs' ) . '</a>';

        // Set icon for 5-star reviews. v1.1.22
        $meta_fields[] = "<a href='" . esc_url( $plugin_rate ) . "' target='_blank' title='" . esc_html__( 'Rate', 'gscs' ) . "'><i class='gslogo-rate-stars'>" . $svg_icon . "</i></a>";

        return $meta_fields;

    }

    add_filter( 'plugin_row_meta', 'gslogo_row_meta', 10, 2 );

}

// Plugins action links
if ( ! function_exists('gs_logo_pro_link') ) {
    function gs_logo_pro_link( $gsLogo_links ) {
        if ( ! gs_logo_is_pro_active() ) {
            $gsLogo_links[] = '<a style="color: red; font-weight: bold;" class="gs-pro-link" href="https://www.gsplugins.com/product/gs-logo-slider" target="_blank">Go Pro!</a>';
        }
        $gsLogo_links[] = '<a href="https://www.gsplugins.com/wordpress-plugins" target="_blank">GS Plugins</a>';
        return $gsLogo_links;
    }
    add_filter( 'plugin_action_links_' .plugin_basename(__FILE__), 'gs_logo_pro_link' );
}

function gs_logo_plugin_update_version() {
    if ( GSL_VERSION !==  get_option('gs_logo_slider_version') ) {
        update_option( 'gs_logo_slider_version', GSL_VERSION );
        return true;
    }
    return false;
}

// Plugin On Loaded
function gs_logo_plugin_loaded() {
    gs_logo_plugin_update_version();
    GS_Logo_Slider_Shortcode_Builder::get_instance()->maybe_create_shortcodes_table();
}
add_action('plugins_loaded', 'gs_logo_plugin_loaded');


/**
 * Initialize the plugin tracker
 *
 * @return void
 */
function gs_logo_slider_appsero_init() {

    if ( !class_exists( 'GSLogoAppSero\Insights' ) ) {
        require_once GSL_PLUGIN_DIR . 'includes/appsero/Client.php';
    }

    $client = new GSLogoAppSero\Client( '2f95117b-b1c6-4486-88c0-6b6d815856bf', 'GS Logo Slider', __FILE__ );
    // Active insights
    $client->insights()->init();
 
}

gs_logo_slider_appsero_init();

function gs_logo_i18n() {
    load_plugin_textdomain( 'gslogo', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'init', 'gs_logo_i18n' );