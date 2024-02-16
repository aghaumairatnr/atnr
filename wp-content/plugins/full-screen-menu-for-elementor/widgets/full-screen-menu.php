<?php

namespace FullScreenMenuForElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit;

class FullScreenMenu extends Widget_Base
{
	public function get_name()
	{
		return 'full-screen-menu-for-elementor';
	}

	public function get_title()
	{
		return __( 'Full Screen Menu', 'full-screen-menu-for-elementor' );
	}

	public function get_icon()
	{
		return 'fsmfe-icon';
	}

	public function get_categories()
	{
		return [ 'general' ];
	}

	public function get_style_depends()
	{
		return [ 'full-screen-menu-style' ];
	}

	protected function register_controls()
	{
		$this->start_controls_section(
			'content',
			[
				'label' => __( 'Layout', 'full-screen-menu-for-elementor' ),
			]
		);

		$this->add_control(
			'content_type',
			[
				'label' => __( 'Content Type', 'full-screen-menu-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'menu',
				'options' => [
					'menu' => __( 'Menu', 'full-screen-menu-for-elementor' ),
					'saved_section' => __( 'Saved Section', 'full-screen-menu-for-elementor' ),
					'saved_page' => __( 'Saved Page', 'full-screen-menu-for-elementor' ),
				],				
			]
		);

		$menus = $this->get_available_menus();

		if ( ! empty( $menus ) ) {
			$this->add_control(
				'menu',
				[
					'label' => __( 'Select Menu', 'full-screen-menu-for-elementor' ),
					'type' => Controls_Manager::SELECT,
					'options' => $menus,
					'default' => array_keys( $menus )[0],
					'separator' => 'after',
					'description' => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'full-screen-menu-for-elementor' ), admin_url( 'nav-menus.php' ) ),
					'label_block' => 'true',
					'condition' => [
						'content_type' => 'menu'
					],
				]
			);
		} else {
			$this->add_control(
				'menu',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => sprintf( __( '<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus</a> screen to create one.', 'full-screen-menu-for-elementor' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'separator' => 'after',
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
					'condition' => [
						'content_type' => 'menu'
					],
				]
			);
		}

		$this->add_control(
			'saved_section',
			[
				'label' => __( 'Select Section', 'full-screen-menu-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => '0',
				'separator' => 'after',
				'description' => sprintf( __( 'Go to the <a href="%s" target="_blank">My Templates</a> screen to manage your templates.', 'full-screen-menu-for-elementor' ), admin_url( 'edit.php?post_type=elementor_library' ) ),
				'options' => $this->get_saved_data( 'section' ),
				'label_block' => 'true',
				'condition' => [
					'content_type' => 'saved_section'
				],
			]
		);

		$this->add_control(
			'saved_page',
			[
				'label' => __( 'Select Page', 'full-screen-menu-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => '0',
				'separator' => 'after',
				'description' => sprintf( __( 'Go to the <a href="%s" target="_blank">My Templates</a> screen to manage your templates.', 'full-screen-menu-for-elementor' ), admin_url( 'edit.php?post_type=elementor_library' ) ),
				'options' => $this->get_saved_data( 'page' ),
				'label_block' => 'true',
				'condition' => [
					'content_type' => 'saved_page'
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'toggle',
			[
				'label' => __( 'Toggle Button', 'full-screen-menu-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_toggle_style' );

		$this->start_controls_tab(
			'tab_toggle_style_normal',
			[
				'label' => __( 'Normal', 'full-screen-menu-for-elementor' ),
			]
		);

		$this->add_control(
			'normal_toggle_color',
			[
				'label' => __( 'Color', 'full-screen-menu-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'separator' => 'none',
				'selectors' => [
					'{{WRAPPER}} .icon-bars .icon-bar' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_toggle_style_hover',
			[
				'label' => __( 'Hover', 'full-screen-menu-for-elementor' ),
			]
		);

		$this->add_control(
			'hover_toggle_color',
			[
				'label' => __( 'Color', 'full-screen-menu-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'separator' => 'none',
				'selectors' => [
					'{{WRAPPER}} .icon-bars:hover .icon-bar' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'toggle_align',
			[
				'label' => __( 'Toggle Align', 'full-screen-menu-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'right',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'full-screen-menu-for-elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'full-screen-menu-for-elementor' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'full-screen-menu-for-elementor' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'selectors_dictionary' => [
					'left' => 'margin-right: auto',
					'center' => 'margin: 0 auto',
					'right' => 'margin-left: auto',
				],
				'selectors' => [
					'{{WRAPPER}} .icon-bars' => '{{VALUE}}',
				],
			]
		);

		$this->add_control(
			'bars_size',
			[
				'label' => __( 'Size', 'full-screen-menu-for-elementor' ),
				'description' => __('Size of bars.', 'full-screen-menu-for-elementor'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30,
				],
				'range' => [
					'px' => [
						'min' => 15,
						'max' => 100,
						'step' => 1,
					],
				],
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .icon-bars' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'bars_space',
			[
				'label' => __( 'Space', 'full-screen-menu-for-elementor' ),
				'description' => __('Space between bars.', 'full-screen-menu-for-elementor'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 50,
						'step' => 1,
					],
				],
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .icon-bars .bar-top' => 'margin-top: -{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .icon-bars .bar-bottom' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'bars_thickness',
			[
				'label' => __( 'Thickness', 'full-screen-menu-for-elementor' ),
				'description' => __('Thickness of bars.', 'full-screen-menu-for-elementor'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 2,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 20,
						'step' => 1,
					],
				],
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .icon-bars .icon-bar' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'overlay',
			[
				'label' => __( 'Overlay', 'full-screen-menu-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'overlay_background_color',
				'label' => __( 'Background', 'full-screen-menu-for-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .menu-overlay',
			]
		);

		$this->add_control(
			'overlay_padding',
			[
				'label' => __( 'Padding', 'full-screen-menu-for-elementor' ),
			   	'type' => Controls_Manager::DIMENSIONS,
			   	'size_units' => [ 'px', '%', 'em' ],
			   	'selectors' => [
					'{{WRAPPER}} .menu-overlay' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			   	],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'text',
			[
				'label' => __( 'Text', 'full-screen-menu-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'content_type' => 'menu',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_text_style' );

		$this->start_controls_tab(
			'tab_text_style_normal',
			[
				'label' => __( 'Normal', 'full-screen-menu-for-elementor' ),
			]
		);

		$this->add_control(
			'normal_text_color',
			[
				'label' => __( 'Text Color', 'full-screen-menu-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'separator' => 'none',
				'selectors' => [
					'{{WRAPPER}} .content-type-menu a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'normal_text_background_color',
			[
				'label' => __( 'Background Color', 'full-screen-menu-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'separator' => 'none',
				'selectors' => [
					'{{WRAPPER}} .content-type-menu a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_text_style_hover',
			[
				'label' => __( 'Hover', 'full-screen-menu-for-elementor' ),
			]
		);

		$this->add_control(
			'hover_text_color',
			[
				'label' => __( 'Text Color', 'full-screen-menu-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'separator' => 'none',
				'selectors' => [
					'{{WRAPPER}} .content-type-menu a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_text_background_color',
			[
				'label' => __( 'Background Color', 'full-screen-menu-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'separator' => 'none',
				'selectors' => [
					'{{WRAPPER}} .content-type-menu a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'menu_typography',
				'scheme' => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .content-type-menu a',
			]
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label' => __( 'Text Align', 'full-screen-menu-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'full-screen-menu-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'full-screen-menu-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'full-screen-menu-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .content-type-menu li' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render()
	{
		$available_menus = $this->get_available_menus();

		if ( ! $available_menus ) {
			return;
		}

		$settings = $this->get_active_settings();

		$content_type = $settings['content_type'];

		$this->add_render_attribute( 'menu-content', [
			'class' => 'content-type-' . $content_type,
		] );

		switch ( $content_type ) {
			case 'menu':
				$args = [
					'echo' => false,
					'menu' => $settings['menu'],
					'menu_class' => 'content-type-menu',
					'menu_id' => '',
					'fallback_cb' => '__return_empty_string',
					'container' => '',
				];
		
				$content_html = wp_nav_menu( $args );
				break;

			case 'saved_section':
				$content_html = \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $settings['saved_section'] );
				break;

			case 'saved_page':
				$content_html = \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $settings['saved_page'] );
				break;

			default:
				return;
				break;
		}

		$uniqid = uniqid();
		$this->add_render_attribute( 'menu-toggle', [
			'id' => 'menu-toggle-' . $uniqid,
			'class' => 'menu-toggle',
		] );
		$this->add_render_attribute( 'icon-bars', [
			'for' => 'menu-toggle-' . $uniqid,
			'class' => 'icon-bars',
		] );

		?>
		<div class="fsmfe-wrapper">
			<input type="checkbox" <?php echo $this->get_render_attribute_string( 'menu-toggle' ); ?>>
			<label <?php echo $this->get_render_attribute_string( 'icon-bars' ); ?>>
				<span class="icon-bar bar-top"></span>
				<span class="icon-bar bar-middle"></span>
				<span class="icon-bar bar-bottom"></span>
			</label>
			<div class="menu-overlay">
				<div <?php echo $this->get_render_attribute_string( 'menu-content' ); ?>>
					<?php echo $content_html; ?>
				</div>
			</div>
		</div>
		<?php
	}

	private function get_saved_data( $type = 'page' )
	{
		$templates = $this->get_post_template( $type );

		$options['0'] = __( 'Select Template', 'full-screen-menu-for-elementor' );

		if ( count( $templates ) ) {
			foreach ( $templates as $template ) {
				$options[ $template['id'] ] = $template['name'];
		}
		} else {
			$options['0'] = __( 'You haven\'t saved any templates yet.', 'full-screen-menu-for-elementor' );
		}

		return $options;
	}

	private function get_post_template( $type = 'page' )
	{
		$posts = get_posts(
			array(
				'post_type' => 'elementor_library',
				'orderby' => 'title',
				'order' => 'ASC',
				'posts_per_page' => '-1',
				'tax_query' => array(
					array(
						'taxonomy' => 'elementor_library_type',
						'field' => 'slug',
						'terms' => $type,
					),
				),
			)
		);

		$templates = array();

		foreach ( $posts as $post ) {
			$templates[] = array(
				'id' => $post->ID,
				'name' => $post->post_title,
			);
		}

		return $templates;
	}

	private function get_available_menus()
	{
		$menus = wp_get_nav_menus();

		$options = [];

		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}

		return $options;
	}
}
