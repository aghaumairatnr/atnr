<?php 
//--------- Getting values from setting panel ---------------- //

function gs_l_get_option( $option, $section, $default = '' ) {

    $options = get_option( $section );
 
    if ( isset( $options[$option] ) ) {
        return $options[$option];
    }
 
    return $default;
}

// ---------- Shortcode [gs_logo] -------------

function gs_logo_shortcode( $atts ) {
	
	$atts = shortcode_atts( gs_logo_get_shortcode_defaults(), $atts );

    $atts = gslogo_change_key( $atts, 'gs_l_title', 'title' );
    $atts = gslogo_change_key( $atts, 'gs_l_mode', 'mode' );
    $atts = gslogo_change_key( $atts, 'gs_l_slide_speed', 'speed' );
    $atts = gslogo_change_key( $atts, 'gs_l_inf_loop', 'inf_loop' );
    $atts = gslogo_change_key( $atts, 'gs_l_gray', 'logo_color' );
    $atts = gslogo_change_key( $atts, 'gs_l_theme', 'theme' );
    $atts = gslogo_change_key( $atts, 'gs_l_tooltip', 'tooltip' );

	extract( $atts );

	$args = [
		'order'				=> $order,
		'orderby'			=> $orderby,
		'posts_per_page'	=> $posts,
	];

	if ( !empty($logo_cat) ) {

		$args['tax_query'] = [
			[
				'taxonomy' => 'logo-category',
				'field'    => 'slug',
				'terms'    => explode(',', $logo_cat),
				'operator' => 'IN'
			],
		];

	}

	$GLOBALS['gs_logo_loop'] = get_gs_logo_query( $args );

	$id = empty($id) ? uniqid() : sanitize_key( $id );

	if ( $theme == '2rows' ) $theme = 'slider-2rows';
	
	$classes = [
		"gs_logo_area",
		"gs_logo_area_$id",
		$theme
	];

	ob_start();
	?>

	<div class="<?php echo implode( ' ', $classes ); ?>" style="opacity: 0; visibility: hidden;">
		<div class="gs_logo_area--inner">

			<?php
				do_action( 'gs_logo_template_before__loaded', $theme );

				if ( $theme == 'slider1' ) {
					include GS_Logo_Template_Loader::locate_template( 'gs-logo-theme-slider-1.php' );
				} else if ( $theme == 'grid1' ) {
					include GS_Logo_Template_Loader::locate_template( 'gs-logo-theme-grid-1.php' );
				} else if ( $theme == 'list1' ) {
					include GS_Logo_Template_Loader::locate_template( 'gs-logo-theme-list-1.php' );
				} else if ( $theme == 'table1' ) {
					include GS_Logo_Template_Loader::locate_template( 'gs-logo-theme-table-1.php' );
				} else if ( !gs_logo_is_pro_active() ) {
					printf('<div class="gs-logo-template-upgrade"><p>%s</p></div>', __('Please upgrade to pro version to use this template', 'gslogo'));
				}

				do_action( 'gs_logo_template_after__loaded', $theme,  $atts );
				
				wp_reset_postdata();
			?>
		</div>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'gs_logo', 'gs_logo_shortcode' );