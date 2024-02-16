<?php
/**
 * structured-content
 * class-structuredcontent-body-classes.php
 *
 * @category Production
 * @author antonioleutsch
 * @package  Default
 * @date     2019-05-26 17:39
 */


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Generate theme-specific body and admin classes.
 *
 * @since 1.0.0
 */
class StructuredContent_Body_Classes {

	/**
	 * The Constructor.
	 */
	public function __construct() {
		add_filter( 'body_class', array( $this, 'body_class' ) );
		add_filter( 'admin_body_class', array( $this, 'admin_body_class' ) );
	}

	/**
	 * Add .is-{theme} class to the frontend for select themes.
	 *
	 * @param array $classes Classes for the body element.
	 *
	 * @return array (Maybe) filtered body classes.
	 *
	 * @access public
	 */
	public function body_class( $classes ) {

		if ( $this->is_active_theme( $this->themes() ) ) {
			$classes[] = 'is-' . $this->theme_slug();
		}

		return $classes;
	}

	/**
	 * See if theme is activate or not.
	 *
	 * @param string|array $theme Theme name or array of theme names to check.
	 *
	 * @return boolean
	 * @since 1.1.0
	 */
	public function is_active_theme( $theme ) {
		return is_array( $theme ) ? in_array( get_template(), $theme, true ) : get_template() === $theme;
	}

	/**
	 * Themes to check for.
	 *
	 * @return array
	 * @since 1.1.0
	 */
	public function themes() {
		$themes = array(
			'twentynineteen',
			'twentyseventeen',
			'twentysixteen',
			'twentyfifteen',
			'twentyfourteen',
			'twentythirteen',
			'twentyeleven',
			'twentytwelve',
		);

		return apply_filters( 'structuredcontent_theme_body_classes', $themes );
	}

	/**
	 * Theme slug.
	 *
	 * @return string
	 * @since 1.1.0
	 */
	public function theme_slug() {
		return esc_attr( wp_get_theme( get_template() )->get( 'TextDomain' ) );
	}

	/**
	 * Add .is-{theme} class to the admin editor for select themes.
	 *
	 * @param array $classes Classes for the admin editor body element.
	 *
	 * @return array (Maybe) filtered body classes.
	 *
	 * @access public
	 */
	public function admin_body_class( $classes ) {
		global $pagenow;

		// Return if not on viewing the editor.
		if ( ! in_array( $pagenow, array( 'post.php' ), true ) ) {
			return $classes;
		}

		if ( $this->is_active_theme( $this->themes() ) ) {
			$classes .= 'is-' . $this->theme_slug();
		}

		return $classes;
	}
}

new StructuredContent_Body_Classes();
