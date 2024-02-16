<?php

/**
 * Protect direct access
 */
if ( ! defined( 'ABSPATH' ) ) die( GSL_HACK_MSG );
    
function gs_logo_echo_return( $content, $echo = false ) {

    if ( $echo ) {
        echo gs_wp_kses( $content );
    } else {
        return $content;
    }

}

function gs_logo_minimizeCSSsimple($css) {
    // https://datayze.com/howto/minify-css-with-php
    $css = preg_replace('/\/\*((?!\*\/).)*\*\//', '', $css); // negative look ahead
    $css = preg_replace('/\s{2,}/', ' ', $css);
    $css = preg_replace('/\s*([:;{}])\s*/', '$1', $css);
    $css = preg_replace('/;}/', '}', $css);
    return $css;
}

if ( ! function_exists('gs_wp_kses') ) {
    function gs_wp_kses( $content ) {

        $allowed_tags = wp_kses_allowed_html('post');

        
        $input_common_atts = [ 'class' => true, 'id' => true, 'style' => true, 'novalidate' => true, 'name' => true, 'width' => true, 'height' => true, 'data' => true, 'title' => true, 'placeholder' => true, 'value' => true ];
        
        $allowed_tags = array_merge_recursive( $allowed_tags, [
            'select' => $input_common_atts,
            'input' => array_merge( $input_common_atts, [ 'type' => true, 'checked' => true ] ),
            'option' => [ 'class' => true, 'id' => true, 'selected' => true, 'data' => true, 'value' => true ]
        ]);

        return wp_kses( stripslashes_deep( $content ), $allowed_tags );

    }
}

if( ! function_exists( 'gs_allowed_tags' ) ) {
    function gs_allowed_tags( $tags ) {
        return $tags;
    }
}

function gs_logo_wp_validate_boolean( $var ) {

    if ( empty($var) ) return false;

    if ( gettype($var) == 'string' && strtolower($var) == 'on' ) return true;
    if ( gettype($var) == 'string' && strtolower($var) == 'off' ) return false;

    return wp_validate_boolean( $var );
    
}

function gs_logo_is_divi_active() {

    if ( ! defined('ET_BUILDER_PLUGIN_ACTIVE') || ! ET_BUILDER_PLUGIN_ACTIVE ) return false;

    return et_core_is_builder_used_on_current_request();

}

function gs_logo_is_pro_active() {

    require_once ABSPATH . 'wp-admin/includes/plugin.php';

    return is_plugin_active( 'gs-logo-slider-pro/gs-logo-slider-pro.php' );

}

if ( ! function_exists( 'gsLogoIsElementorActive' ) ) {
    function gsLogoIsElementorActive() {
        return defined( 'ELEMENTOR_PATH' );
    }
}

function get_gs_logo_query( $atts ) {

    $args = shortcode_atts([
        'order'				=> 'DESC',
        'orderby'			=> 'date',
        'posts_per_page'	=> -1,
        'tax_query' => [],
    ], $atts);

    $args['post_type'] = 'gs-logo-slider';

    return new WP_Query( apply_filters( 'gs_logo_wp_query_args', $args ) );
    
}

function gs_logo_getoption( $option, $default = '' ) {

    $options = get_option( 'gs_logo_slider_shortcode_prefs' );
    
    if ( isset( $options[$option] ) ) {
        return $options[$option];
    }
    
    return $default;
    
}

function gs_logo_get_meta_values( $meta_key = '', $post_type = 'gs-logo-slider', $status = 'publish', $order_by = true, $order = 'ASC' ) {

    global $wpdb;

    if ( empty( $meta_key ) ) return [];

    if ( $order_by ) {
        $order == 'ASC' ? $order : 'DESC';
        $order_by = sprintf( 'ORDER BY pm.meta_value %s', $order );
    } else {
        $order_by = '';
    }

    $result = $wpdb->get_col( $wpdb->prepare("
        SELECT pm.meta_value FROM {$wpdb->postmeta} pm
        LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
        WHERE pm.meta_key = %s 
        AND p.post_status = %s 
        AND p.post_type = %s 
        {$order_by}
    ", $meta_key, $status, $post_type) );

    return $result;
}

function gs_logo_get_meta_values_options( $meta_key = '', $post_type = 'gs-logo-slider', $status = 'publish', $echo = true ) {

    $meta_values = gs_logo_get_meta_values( $meta_key, $post_type, $status );

    $html = '';

    foreach ( $meta_values as $meta_value ) {
        $html.= sprintf( '<option value=".%s">%s</option>', sanitize_title($meta_value), esc_html($meta_value) );
    }

    return gs_logo_echo_return( $html, $echo );

}

function gs_logo_get_carousel_data( $cols_desktop, $cols_tablet, $cols_mobile_portrait, $cols_mobile, $echo = true ) {

    $carousel_data = [
        'data-carousel-desktop' 		=> $cols_desktop,
        'data-carousel-tablet' 			=> $cols_tablet,
        'data-carousel-mobile-portrait' => $cols_mobile_portrait,
        'data-carousel-mobile' 			=> $cols_mobile
    ];

    $carousel_data = array_map( function($key, $val) {
        return $key . '=' . $val;
    }, array_keys($carousel_data), array_values($carousel_data) );

    $carousel_data = implode( ' ', $carousel_data );

    return gs_logo_echo_return( $carousel_data, $echo );

}

function gs_logo_get_terms( $term_name, $order = 'ASC', $orderby = 'name' ) {

    $terms = get_terms([
        'taxonomy' => $term_name,
        'orderby'  => $orderby,
        'order'    => $order,
    ]);

    return wp_list_pluck( $terms, 'name', 'slug' );

}

function gs_logo_get_terms_options( $term_name, $echo = true, $order = 'ASC', $orderby = 'name' ) {

    $terms = gs_logo_get_terms( $term_name, $order, $orderby );
    
    $html = '';

    foreach ( $terms as $term_slug => $term_name ) {
        $html.= sprintf( '<option value=".%s">%s</option>', $term_slug, $term_name );
    }

    return gs_logo_echo_return( $html, $echo );

}

function gs_logo_get_item_terms_slugs( $term_name, $separator = ' ' ) {

    global $post;

    $terms = get_the_terms( $post->ID, $term_name );

    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
        $terms = implode( $separator, wp_list_pluck( $terms, 'slug' ) );
        return $terms;
    }

}

function gs_logo_get_shortcodes() {

    return GS_Logo_Slider_Shortcode_Builder::get_instance()->_get_shortcodes( null, false, true );

}

function gs_logo_select_builder( $name, $options, $selected = "", $selecttext = "", $class = "", $optionvalue = 'value' ) {

    if ( is_array($options) ) {

        $select_html = sprintf( '<select name="%s" id="%s", class="%s">', esc_attr($name), esc_attr($name), esc_attr($class) );

        if ( $selecttext ) {
            $select_html .= '<option value="">' . $selecttext . '</option>';
        }

        foreach ( $options as $key => $option ) {

            if ( $optionvalue == 'value' ) {
                $value = $option;
            } else {
                $value = $key;
            }

            $select_html .= sprintf( '<option value="%s"', $value );

            if ( $value == $selected ) {
                $select_html .= ' selected="selected"';
            }

            $select_html .= sprintf( '><option>%s</option>', $value );

        }

        $select_html .= '</select>';
        echo gs_wp_kses( $select_html );

    }

}

function gs_logo_get_terms_names( $term_name, $separator = ', ' ) {

    global $post;

    $terms = get_the_terms( $post->ID, $term_name );

    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
        $terms = implode( $separator, wp_list_pluck( $terms, 'name' ) );
        return $terms;
    }

}

function gs_logo_pagination( $echo = true ) {

    $gs_tm_paged = get_query_var('paged') ? get_query_var('paged') : get_query_var('page');
    $gsbig = 999999999; // need an unlikely integer

    $paginate_params = [
        'base' => str_replace( $gsbig, '%#%', esc_url( get_pagenum_link( $gsbig ) ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, $gs_tm_paged ),
        'total' => $GLOBALS['gs_logo_loop']->max_num_pages
    ];
    $paginate_params = (array) apply_filters( 'gs_logo_paginate_params', $paginate_params );
    
    $paginate_links = paginate_links( $paginate_params );
    $paginate_links = apply_filters( 'gs_logo_paginate_links', $paginate_links );

    $html = '<div class="gs-roow"><div class="col-md-12 gs-pagination">'.$paginate_links.'</div></div>';
    
    return gs_logo_echo_return( $html, $echo );

}

function gslogo_is_preview() {
    return isset( $_REQUEST['gslogo_shortcode_preview'] ) && !empty($_REQUEST['gslogo_shortcode_preview']);
}

function gs_logo_should_custom_script_render() {

    $render = false;
    
    // For VC
    if ( ! empty( $_GET['vc_editable'] ) ) return true;

    // For Elementor
    if ( ( !empty($_GET['action']) && $_GET['action'] == 'elementor' ) || ( !empty($_POST['action']) && $_POST['action'] == 'elementor_ajax' ) ) return true;

    // For gutenberg
    if ( !empty($_GET['context']) && $_GET['context'] == 'edit' ) return true;

    // Beaver Builder
    if ( isset($_GET['fl_builder_ui_iframe']) || !empty($_POST['fl_builder_data']) ) return true;

    // Oxygen Builder
    if ( !empty($_GET['action']) && $_GET['action'] == 'oxy_render_oxy-solid-testimonial' ) return true;

    return $render;

}

function gs_logo_get_shortcode_defaults() {
    return [
        'id' 		=> '',
        'posts' 	=> -1,
        'order'		=> 'DESC',
        'orderby'   => 'date',
        'gs_l_title' => 'on',
        'logo_cat'	=> '',
        'gs_l_ctrl' => 'on',
        'gs_l_ctrl_pos' => 'bottom',
        'gs_l_pagi' => 'off',
        'gs_l_pagi_dynamic' => 'on',
        'gs_l_play_pause' => 'off',
        'gs_l_inf_loop'	=> 'on',
        'gs_l_slider_stop' => 'on',
        'gs_l_tooltip' 	=> 'off',
        'gs_l_slide_speed'		=> 500,
        'gs_l_autop_pause' => 2000,
        'gs_l_theme'		=> 'slider1',
        'image_size' => 'medium',
        'custom_image_size_width' => '',
        'custom_image_size_height' => '',
        'custom_image_size_crop' => 'hard-crop',
        'gs_l_clkable' => '_blank',
        'gs_l_is_autop' => 'on',
        'gs_reverse_direction' => 'off',
        'gs_l_gray' => 'default',
        'gs_l_align' => 'center',
        'gs_l_margin' => 10,
        'gs_l_min_logo' => 5,
        'gs_l_tab_logo' => 3,
        'gs_l_mob_logo' => 2,
        'gs_l_move_logo' => 1,
        'gs_logo_filter_name' => 'All',
        'gs_logo_filter_align' => 'center',
        'show_cat'  => 'on',
        'row_heading_image' => 'Image',
        'row_heading_name' => 'Name',
        'row_heading_desc' => 'Description',
    ];
}