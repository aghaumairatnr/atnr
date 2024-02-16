<?php

/**
 * Protect direct access
 */
if ( ! defined( 'ABSPATH' ) ) exit;

// Integration Class
if ( ! class_exists( 'GS_Logo_Slider_Integration_Beaver' ) ) :

    class GS_Logo_Slider_Integration_Beaver {

        private static $_instance = null;
        
        public static function get_instance() {

            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
            
        }

        public function __construct() {

            add_action( 'init', array( $this, 'init' ) );
            
        }

        public function init() {

            if ( class_exists( 'FLBuilder' ) ) {
                FLBuilder::register_module( 'GS_Logo_Slider_Beaver', array(
                    'my-tab-1'      => array(
                        'title'         => __( 'Tab 1', 'gslogo' ),
                        'sections'      => array(
                            'my-section-1'  => array(
                                'title'         => __( 'Shortcode', 'gslogo' ),
                                'fields'        => array(
                                    'shortcode_id' => array(
                                        'type'          => 'select',
                                        'label'         => __('Select Shortcode', 'gslogo'),
                                        'options'       => $this->get_shortcode_list(),
                                        // 'preview'      => array(
                                        //     'type'         => 'none'
                                        // )
                                    ),
                                )
                            )
                        )
                    )
                ));
            }

        }

        protected function get_shortcode_list() {
    
            $shortcodes = gs_logo_get_shortcodes();

            if ( !empty($shortcodes) ) {
                return wp_list_pluck( $shortcodes, 'shortcode_name', 'id' );
            }
            
            return [];

        }
    
    }
    
endif;

if ( class_exists( 'FLBuilder' ) ) {

    class GS_Logo_Slider_Beaver extends FLBuilderModule {
    
        public function __construct() {
            
            parent::__construct(array(
                'name'            => __( 'GS Logo Slider', 'gslogo' ),
                'description'     => __( 'A totally awesome module!', 'gslogo' ),
                'group'           => __( 'GS Plugins', 'gslogo' ),
                'category'        => __( 'Basic', 'gslogo' ),
                'dir'             => GSL_PLUGIN_DIR . '/includes/integrations/beaver/',
                'url'             => GSL_PLUGIN_URI . '/includes/integrations/beaver/',
                'icon'            => 'icon.svg'
            ));
            
        }

        function replace_first_str( $search_str, $replacement_str, $src_str ) {
            return (false !== ($pos = strpos($src_str, $search_str))) ? substr_replace($src_str, $replacement_str, $pos, strlen($search_str)) : $src_str;
        }

        public function get_icon( $icon = '' ) {

            $path = GSL_PLUGIN_DIR . 'assets/img/' . $icon;

            // check if $icon is referencing an included icon.
            if ( '' != $icon && file_exists( $path ) ) {
                $icon = file_get_contents( $path );
                $icon = $this->replace_first_str( 'width="50"', 'width="20"', $icon );
                return $icon = $this->replace_first_str( 'height="50"', 'height="20"', $icon );
            }

            return '';
        }

    }

}