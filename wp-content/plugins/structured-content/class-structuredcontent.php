<?php
/**
 * Plugin Name: Structured Content
 * Plugin URI: https://wordpress.org/plugins/structured-content/
 * Description: Pimp your content with some feature boxes, which labels the output with micro formats http://schema.org/
 * Author: Gordon Böhme, Antonio Leutsch
 * Author URI: https://wpsc-plugin.com
 * Version: 1.5.3
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: structured-content
 * Domain Path: /languages/
 *
 * @package STC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const STRUCTURED_CONTENT_VERSION = '1.5.3';
define( 'STRUCTURED_CONTENT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'STRUCTURED_CONTENT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

if ( ! class_exists( 'StructuredContent' ) ) :
	/**
	 * Main StructuredContent Class.
	 *
	 * @since 1.0.0
	 */
	final class StructuredContent {
		/**
		 * This plugin's instance.
		 *
		 * @var StructuredContent
		 * @since 1.0.0
		 */
		private static $instance;

		/**
		 * Main StructuredContent Instance.
		 *
		 * Insures that only one instance of StructuredContent exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @return object|StructuredContent The one true StructuredContent
		 * @since 1.0.0
		 * @static
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof StructuredContent ) ) {
				self::$instance = new StructuredContent();
				self::$instance->init();
				self::$instance->includes();
			}

			return self::$instance;
		}

		/**
		 * Throw error on object clone.
		 *
		 * The whole idea of the singleton design pattern is that there is a single
		 * object therefore, we don't want the object to be cloned.
		 *
		 * @return void
		 * @since 1.0.0
		 * @access protected
		 */
		public function __clone() {
			// Cloning instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Ahh not so funny Dude?', 'structured-content' ), '1.0' );
		}

		/**
		 * Disable unserializing of the class.
		 *
		 * @return void
		 * @since 1.0.0
		 * @access protected
		 */
		public function __wakeup() {
			// Unserializing instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Ahh not so funny Dude?', 'structured-content' ), '1.0' );
		}


		/**
		 * Include required files.
		 *
		 * @access private
		 * @return void
		 * @since 1.0.0
		 */
		private function includes() {
			require_once STRUCTURED_CONTENT_PLUGIN_DIR . 'includes/class-structuredcontent-block-assets.php';
			require_once STRUCTURED_CONTENT_PLUGIN_DIR . 'includes/class-structuredcontent-register-blocks.php';
			require_once STRUCTURED_CONTENT_PLUGIN_DIR . 'includes/class-structuredcontent-body-classes.php';
			require_once STRUCTURED_CONTENT_PLUGIN_DIR . 'includes/class-structuredcontent-block-settings.php';
			require_once STRUCTURED_CONTENT_PLUGIN_DIR . 'includes/class-structuredcontent-register-tinymce.php';
			require_once STRUCTURED_CONTENT_PLUGIN_DIR . 'includes/class-structuredcontent-register-shortcodes.php';
		}

		/**
		 * Load actions
		 *
		 * @return void
		 */
		private function init() {
			add_action( 'plugins_loaded', array( $this, 'load_textdomain' ), 99 );
			add_action( 'enqueue_block_editor_assets', array( $this, 'block_localization' ) );
		}

		/**
		 * If debug is on, serve unminified source assets.
		 *
		 * @param string|string $type The type of resource.
		 * @param string|string $directory Any extra directories needed.
		 *
		 * @since 1.0.0
		 */
		public function asset_source( $type = 'js', $directory = null ) {
			if ( 'js' === $type ) {
				return SCRIPT_DEBUG ? STRUCTURED_CONTENT_PLUGIN_URL . 'src/' . $type . '/' . $directory : STRUCTURED_CONTENT_PLUGIN_URL . 'dist/' . $type . '/' . $directory;
			} else {
				return STRUCTURED_CONTENT_PLUGIN_URL . 'dist/css/' . $directory;
			}
		}


		/**
		 * Loads the plugin language files.
		 *
		 * @access public
		 * @return void
		 * @since 1.0.0
		 */
		public function load_textdomain() {
			load_plugin_textdomain( 'structured-content', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}

		/**
		 * Enqueue localization data for our blocks.
		 *
		 * @access public
		 */
		public function block_localization() {
			if ( function_exists( 'wp_set_script_translations' ) ) {
				wp_set_script_translations( 'structured-content-editor', 'structured-content', STRUCTURED_CONTENT_PLUGIN_DIR . '/languages' );
			}
		}

	}
endif;


/**
 * The main function for that returns StructuredContent
 *
 * The main function responsible for returning the one true StructuredContent
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * @return object|StructuredContent The one true StructuredContent Instance.
 * @since 1.0.0
 */
function StructuredContent() {
	return StructuredContent::instance();
}

// Get the plugin running. Load on plugins_loaded action to avoid issue on multisite.
if ( function_exists( 'is_multisite' ) && is_multisite() ) {
	add_action( 'plugins_loaded', 'StructuredContent', 90 );
} else {
	StructuredContent();
}


/**
 * Helper Function to escape in json-ld string.
 */
function wpsc_esc_jsonld( $string ) {

	$string = str_replace( '"', '\"', $string );

	$string = apply_filters( 'structured_content_esc_jsonld_filter', $string );

	return $string;
}

/**
 * Helper Function to escape in json-ld string.
 */
function wpsc_esc_strip_content( $content ) {

	$allowedTags = array(
		'h1',
		'h2',
		'h3',
		'h4',
		'h5',
		'h6',
		'br',
		'ol',
		'ul',
		'li',
		'a',
		'p',
		'p',
		'div',
		'b',
		'strong',
		'i',
		'em',
	);

	$allowedTags = apply_filters( 'structured_content_allowed_tags', $allowedTags );

	// Remove not allowed Tags
	$content = strip_tags( $content, $allowedTags );
	// Remove Attributes from Tags
	$content = preg_replace( '/<([a-z][a-z0-9]*)[^>]*?(\/?)>/si', '<$1$2>', $content );

	$content = apply_filters( 'structured_content_esc_strip_content_filter', $content );

	if (apply_filters('structured_content_esc_strip_content_trim', true)) {
		// trim whitespace between HTML tags
		$content = preg_replace( '/>\s+</', '><', $content );
		// trim whitespace from the beginning and end of a string
		$content = trim( $content );
	}

	return $content;
}

