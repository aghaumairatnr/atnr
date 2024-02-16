<?php

/**
 * Protect direct access
 */
if ( ! defined( 'ABSPATH' ) ) die( GSL_HACK_MSG );

class GS_Logo_Asset_Generator extends GS_Asset_Generator_Base {

	private static $instance = null;

	public static function getInstance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function get_assets_key() {
		return 'gs-logo-slider';
	}

	public function generateCustomCss( $settings, $shortCodeId, $isProActive = false, $isDiviAndProActive = false ) {
		$css = '';

		if ( $isProActive ) {
			$css .= "
			.gs_logo_area_{$shortCodeId} ul.gs-logo-filter-cats { text-align: {$settings['gs_logo_filter_align']} !important; }";
		}

		if ( $isDiviAndProActive ) {
			$css .= "
			#et-boc .et-l div <?php echo '.gs_logo_area_' . $shortCodeId; ?>:not(.verticaltickerdown):not(.verticalticker) .gs_logo_container,";
		}
		
		$marginLeft = intval( $settings['gs_l_margin'] ) / 2;
		$marginRight = intval( $settings['gs_l_margin'] ) / 2;
		$css .= "
		.gs_logo_area_{$shortCodeId}:not(.verticaltickerdown):not(.verticalticker) .gs_logo_container {
			margin-left: -{$marginLeft}px;
			margin-right: -{$marginRight}px;
		}";

		if ( $isDiviAndProActive ) {
			$css .= "
			#et-boc .et-l div .gs_logo_area_{$shortCodeId}:not(.verticaltickerdown):not(.verticalticker) .gs_logo_single--wrapper,";
		}
		
		$padding = intval( $settings['gs_l_margin'] ) / 2;
		$css .= "
		.gs_logo_area_{$shortCodeId}:not(.verticaltickerdown):not(.verticalticker) .gs_logo_single--wrapper {
			padding: {$padding}px;
		}";

		if ( $isDiviAndProActive ) {
			$css .= "
			#et-boc .et-l div .gs_logo_area_{$shortCodeId} ul.gs-logo-filter-cats,";
		}

		$css .= "
		.gs_logo_area_{$shortCodeId} ul.gs-logo-filter-cats {
			text-align: {$settings['gs_logo_filter_align']}!important;
		}";

		$min_desk_items = !empty($settings['gs_l_min_logo']) ? $settings['gs_l_min_logo'] : 1;
		$width = 100 / $min_desk_items;
		$css .= "
		.gs_logo_area_{$shortCodeId} .gs_logo_single--wrapper {
			width: {$width}%;
		}";
		
		$min_tab_items = !empty($settings['gs_l_tab_logo']) ? $settings['gs_l_tab_logo'] : 1;
		$resWidthLarge = 100 / $min_tab_items;
		$css .= "
		@media (max-width: 1023px) {
			.gs_logo_area_{$shortCodeId} .gs_logo_single--wrapper {
				width: {$resWidthLarge}%;
			}
		}";
		
		$min_mob_items = !empty($settings['gs_l_mob_logo']) ? $settings['gs_l_mob_logo'] : 1;
		$resWidthMedium = 100 / $min_mob_items;
		$css .= "
		@media (max-width: 767px) {
			.gs_logo_area_{$shortCodeId}:not(.list1, .list2, .list4, .ticker1, .verticalticker) .gs_logo_single--wrapper {
				width:{$resWidthMedium}% !important;
			}
		}";

		if ( 'list1' === $settings['gs_l_theme'] || 'list2' === $settings['gs_l_theme'] || 'list3' === $settings['gs_l_theme'] || 'list4' === $settings['gs_l_theme'] ) {
			$css .= "@media (max-width: 680px) {
				div.gs_logo_area div.gs_logo_container_list1 .gs_logo_single--wrapper,
				div.gs_logo_area div.gs_logo_container_list2 .gs_logo_single--wrapper,
				div.gs_logo_area div.gs_logo_container_list3 .gs_logo_single--wrapper,
				div.gs_logo_area div.gs_logo_container_list4 .gs_logo_single--wrapper {
					width: 100% !important;
				}
			}";
		}

		return $css;
	}

	public function generate_assets_data( Array $settings ) {

		if ( empty($settings) || !empty($settings['is_preview']) ) return;

		$this->add_item_in_asset_list( 'styles', 'gs-logo-public' );
		$this->add_item_in_asset_list( 'scripts', 'gs-logo-public', ['jquery'] );

		if ( 'slider1' === $settings['gs_l_theme'] ) {
			$this->add_item_in_asset_list( 'styles', 'gs-logo-public', ['gs-swiper'] );
			$this->add_item_in_asset_list( 'scripts', 'gs-logo-public', ['gs-swiper'] );
		}
		
		if ( 'on' === $settings['gs_l_tooltip'] ) {
			$this->add_item_in_asset_list( 'styles', 'gs-logo-public', ['gs-tippyjs'] );
			$this->add_item_in_asset_list( 'scripts', 'gs-logo-public', ['gs-tippyjs'] );
		}

		// Hooked for Pro
		do_action( 'gs_logo_assets_data_generated', $settings );

		if ( gs_logo_is_divi_active() ) {
			$this->add_item_in_asset_list( 'styles', 'gs-logo-divi-public', ['gs-logo-public'] );
		}

		$css = $this->generateCustomCss( $settings, $settings['id'], gs_logo_is_pro_active(), gs_logo_is_divi_active() );

		if ( !empty($css) ) {
			$this->add_item_in_asset_list( 'styles', 'inline', gs_logo_minimizeCSSsimple($css) );
		}

	}

	public function enqueue_plugin_assets( $main_post_id, $assets = [] ) {

		if ( empty($assets) || empty($assets['styles']) || empty($assets['scripts']) ) return;

		foreach ( $assets['styles'] as $asset => $data ) {
			if ( $asset == 'inline' ) {
				if ( !empty($data) ) wp_add_inline_style( 'gs-logo-public', $data );
			} else {
				GS_Logo_Scripts::add_dependency_styles( $asset, $data );
			}
		}

		foreach ( $assets['scripts'] as $asset => $data ) {
			if ( $asset == 'inline' ) {
				if ( !empty($data) ) wp_add_inline_script( 'gs-logo-public', $data );
			} else {
				GS_Logo_Scripts::add_dependency_scripts( $asset, $data );
			}
		}

		wp_enqueue_style( 'gs-logo-public' );
		wp_enqueue_script( 'gs-logo-public' );

		if ( gs_logo_is_divi_active() ) {
			wp_enqueue_style( 'gs-logo-divi-public' );
		}

		$prefs = GS_Logo_Slider_Shortcode_Builder::get_instance()->get_shortcode_pref();

		if ( ! empty($prefs['gs_logo_slider_custom_css']) ) {
			wp_add_inline_style( 'gs-logo-public', $prefs['gs_logo_slider_custom_css'] );
		}

	}

	public function maybe_force_enqueue_assets( Array $settings ) {

		if(empty($settings)) return;

		GS_Logo_Scripts::get_instance()->wp_enqueue_style_all( 'public' );
		GS_Logo_Scripts::get_instance()->wp_enqueue_script_all( 'public' );

		$css = $this->generateCustomCss( $settings, $settings['id'], gs_logo_is_pro_active(), gs_logo_is_divi_active() );

		if ( !empty($css) ) {
			wp_add_inline_style( 'gs-logo-public', gs_logo_minimizeCSSsimple($css) );
		}

	}

}

if ( ! function_exists( 'gsLogoAssetGenerator' ) ) {
	function gsLogoAssetGenerator() {
		return GS_Logo_Asset_Generator::getInstance(); 
	}
}

// Must inilialized for the hooks
gsLogoAssetGenerator();