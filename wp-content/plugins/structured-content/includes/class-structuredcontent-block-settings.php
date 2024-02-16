<?php
/**
 * structured-content
 * class-structuredcontent-block-settings.php
 *
 * @category Production
 * @author antonioleutsch
 * @package  Default
 * @date     2019-05-26 17:40
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers setting for the StructuredContent Block Manager.
 *
 * @since 1.0.0
 */
class StructuredContent_Block_Settings {


	/**
	 * This plugin's instance.
	 *
	 * @var StructuredContent_Block_Settings
	 */
	private static $instance;
	/**
	 * The base URL path (without trailing slash).
	 *
	 * @var string $_url
	 */
	private $_url;
	/**
	 * The Plugin version.
	 *
	 * @var string $_version
	 */
	private $_version;
	/**
	 * The Plugin version.
	 *
	 * @var string $_slug
	 */
	private $_slug;

	/**
	 * The Constructor.
	 */
	private function __construct() {
		$this->_version = STRUCTURED_CONTENT_VERSION;
		$this->_slug    = 'structured-content';
		$this->_url     = untrailingslashit( plugins_url( '/', dirname( __FILE__ ) ) );

		add_action( 'init', array( $this, 'register_settings' ) );
	}

	/**
	 * Registers the plugin.
	 */
	public static function register() {
		if ( null === self::$instance ) {
			self::$instance = new StructuredContent_Block_Settings();
		}
	}

	/**
	 * Register block settings.
	 *
	 * @access public
	 */
	public function register_settings() {
		register_setting(
			'structuredcontent_settings_api',
			'structuredcontent_settings_api',
			array(
				'type'              => 'string',
				'description'       => __( 'Enable or disable blocks', 'structured-content' ),
				'sanitize_callback' => 'sanitize_text_field',
				'show_in_rest'      => true,
				'default'           => '',
			)
		);
	}

}

StructuredContent_Block_Settings::register();
