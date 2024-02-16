<?php
/**
 * structured-content
 * class-structuredcontent-register-blocks.php
 *
 * @category Production
 * @author antonioleutsch
 * @package  Default
 * @date     2019-05-26 17:29
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load registration for our blocks.
 *
 * @since 1.6.0
 */
class StructuredContent_Register_Blocks {


	/**
	 * This plugin's instance.
	 *
	 * @var StructuredContent_Register_Blocks
	 */
	private static $instance;

	/**
	 * This plugin's instance.
	 *
	 * @var StructuredContent_Register_Blocks
	 */
	public $blocks;
	/**
	 * The Slug of the Plugin.
	 *
	 * @var string $_slug
	 */
	private $_slug;

	/**
	 * The Constructor.
	 */
	private function __construct() {
		$this->_slug = 'structured-content';

		$this->blocks = array( 'faq', 'faq-item', 'job', 'event', 'person', 'course', 'local-business' );

		add_action( 'init', array( $this, 'register_blocks' ), 99 );
	}

	/**
	 * Registers the plugin.
	 */
	public static function register() {
		if ( null === self::$instance ) {
			self::$instance = new StructuredContent_Register_Blocks();
		}
	}

	/**
	 * Add actions to enqueue assets.
	 *
	 * @access public
	 */
	public function register_blocks() {

		// Return early if this function does not exist.
		if ( ! function_exists( 'register_block_type' ) ) {
			return;
		}

		// Shortcut for the slug.
		$slug = $this->_slug;

		foreach ( $this->blocks as $block ) {
			register_block_type(
				$slug . '/' . $block,
				array(
					'editor_script'   => $slug . '-editor',
					'editor_style'    => $slug . '-editor',
					'style'           => $slug . '-frontend',
					'render_callback' => function ( $attributes, $content = '' ) use ( $block ) {
						return call_user_func(
							array(
								'StructuredContent_Shortcodes',
								str_replace( '-', '_', $block ),
							),
							$attributes,
							$content
						);
					},
				)
			);
		}
	}
}

StructuredContent_Register_Blocks::register();
