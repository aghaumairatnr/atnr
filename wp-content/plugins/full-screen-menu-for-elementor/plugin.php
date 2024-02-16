<?php

namespace FullScreenMenuForElementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Plugin
{
    private static $_instance = null;

    public function __construct()
    {
        $this->add_actions();
    }

    public static function instance()
    {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    private function add_actions()
    {
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );

        add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'enqueue_editor_styles' ] );

        add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'enqueue_frontend_styles' ] );
    }

    public function register_widgets()
    {
        $this->include_widgets_files();

        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\FullScreenMenu() );
    }

    private function include_widgets_files()
    {
        require __DIR__ . '/widgets/full-screen-menu.php';
    }

    public function enqueue_editor_styles()
    {
        $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

        wp_enqueue_style( 'full-screen-menu-editor', plugins_url( '/assets/css/editor' . $suffix . '.css', __FILE__ ), [], \FullScreenMenuForElementor::VERSION );
    }

    public function enqueue_frontend_styles()
    {
        $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

        wp_enqueue_style( 'full-screen-menu-frontend', plugins_url( '/assets/css/frontend' . $suffix . '.css', __FILE__ ), [], \FullScreenMenuForElementor::VERSION );
    }
}

Plugin::instance();
