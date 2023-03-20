<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class BeautyUX_A11y_Customizer {

	private $css_rules = array();
	private $css_code = '';

	public function get_customizer_fields() {
		$fields = array();

		$fields[] = array(
			'id' => 'a11y_toolbar_icon',
			'title' => __( 'Toolbar Icon', 'BeautyUX-accessibility' ),
			'type' => 'select',
			'choices' => array(
				'one-click' => __( 'One Click', 'BeautyUX-accessibility' ),
				'wheelchair' => __( 'Wheelchair', 'BeautyUX-accessibility' ),
				'accessibility' => __( 'Accessibility', 'BeautyUX-accessibility' ),
			),
			'std' => 'one-click',
			'description' => __( 'Set Toolbar Icon', 'BeautyUX-accessibility' ),
		);

		$fields[] = array(
			'id' => 'a11y_toolbar_position',
			'title' => __( 'Toolbar Position', 'BeautyUX-accessibility' ),
			'type' => 'select',
			'choices' => array(
				'left' => __( 'Left', 'BeautyUX-accessibility' ),
				'right' => __( 'Right', 'BeautyUX-accessibility' ),
			),
			'std' => is_rtl() ? 'right' : 'left',
			'description' => __( 'Set Toolbar Position', 'BeautyUX-accessibility' ),
		);

		$fields[] = array(
			'id' => 'a11y_toolbar_distance_top',
			'title' => __( 'Offset from Top (Desktop)', 'BeautyUX-accessibility' ),
			'type' => 'text',
			'std' => '100px',
			'description' => __( 'Set Toolbar top offset (Desktop)', 'BeautyUX-accessibility' ),
		);

		$fields[] = array(
			'id' => 'a11y_toolbar_distance_top_mobile',
			'title' => __( 'Offset from Top (Mobile)', 'BeautyUX-accessibility' ),
			'type' => 'text',
			'std' => '50px',
			'description' => __( 'Set Toolbar top offset (Mobile)', 'BeautyUX-accessibility' ),
		);

		$fields[] = array(
			'id' => 'a11y_bg_toolbar',
			'title' => __( 'Toolbar Background', 'BeautyUX-accessibility' ),
			'type' => 'color',
			'std' => '#ffffff',
			'selector' => '#BeautyUX-a11y-toolbar .BeautyUX-a11y-toolbar-overlay',
			'change_type' => 'bg_color',
			'description' => __( 'Set Toolbar background color', 'BeautyUX-accessibility' ),
		);

		$fields[] = array(
			'id' => 'a11y_color_toolbar',
			'title' => __( 'Toolbar Color', 'BeautyUX-accessibility' ),
			'type' => 'color',
			'std' => '#333333',
			'selector' => '#BeautyUX-a11y-toolbar .BeautyUX-a11y-toolbar-overlay ul.BeautyUX-a11y-toolbar-items li.BeautyUX-a11y-toolbar-item a, #BeautyUX-a11y-toolbar .BeautyUX-a11y-toolbar-overlay p.BeautyUX-a11y-toolbar-title',
			'change_type' => 'color',
			'description' => __( 'Set Toolbar text color', 'BeautyUX-accessibility' ),
		);

		$fields[] = array(
			'id' => 'a11y_toggle_button_bg_color',
			'title' => __( 'Toggle Button Background', 'BeautyUX-accessibility' ),
			'type' => 'color',
			'std' => '#4054b2',
			'description' => __( 'Set Toolbar toggle button background color', 'BeautyUX-accessibility' ),
		);

		$fields[] = array(
			'id' => 'a11y_toggle_button_color',
			'title' => __( 'Toggle Button Color', 'BeautyUX-accessibility' ),
			'type' => 'color',
			'std' => '#ffffff',
			'selector' => '#BeautyUX-a11y-toolbar .BeautyUX-a11y-toolbar-toggle a',
			'change_type' => 'color',
			'description' => __( 'Set Toolbar toggle button icon color', 'BeautyUX-accessibility' ),
		);

		$fields[] = array(
			'id' => 'a11y_bg_active',
			'title' => __( 'Active Background', 'BeautyUX-accessibility' ),
			'type' => 'color',
			'std' => '#4054b2',
			'selector' => '#BeautyUX-a11y-toolbar .BeautyUX-a11y-toolbar-overlay ul.BeautyUX-a11y-toolbar-items li.BeautyUX-a11y-toolbar-item a.active',
			'change_type' => 'bg_color',
			'description' => __( 'Set Toolbar active background color', 'BeautyUX-accessibility' ),
		);

		$fields[] = array(
			'id' => 'a11y_color_active',
			'title' => __( 'Active Color', 'BeautyUX-accessibility' ),
			'type' => 'color',
			'std' => '#ffffff',
			'selector' => '#BeautyUX-a11y-toolbar .BeautyUX-a11y-toolbar-overlay ul.BeautyUX-a11y-toolbar-items li.BeautyUX-a11y-toolbar-item a.active',
			'change_type' => 'color',
			'description' => __( 'Set Toolbar active text color', 'BeautyUX-accessibility' ),
		);

		$fields[] = array(
			'id' => 'a11y_focus_outline_style',
			'title' => __( 'Focus Outline Style', 'BeautyUX-accessibility' ),
			'type' => 'select',
			'choices' => array(
				'solid' => __( 'Solid', 'BeautyUX-accessibility' ),
				'dotted' => __( 'Dotted', 'BeautyUX-accessibility' ),
				'dashed' => __( 'Dashed', 'BeautyUX-accessibility' ),
				'double' => __( 'Double', 'BeautyUX-accessibility' ),
				'groove' => __( 'Groove', 'BeautyUX-accessibility' ),
				'ridge' => __( 'Ridge', 'BeautyUX-accessibility' ),
				'outset' => __( 'Outset', 'BeautyUX-accessibility' ),
				'initial' => __( 'Initial', 'BeautyUX-accessibility' ),
			),
			'std' => 'solid',
			'description' => __( 'Set Focus outline style', 'BeautyUX-accessibility' ),
		);

		$fields[] = array(
			'id' => 'a11y_focus_outline_width',
			'title' => __( 'Focus Outline Width', 'BeautyUX-accessibility' ),
			'type' => 'select',
			'choices' => array(
				'1px' => '1px',
				'2px' => '2px',
				'3px' => '3px',
				'4px' => '4px',
				'5px' => '5px',
				'6px' => '6px',
				'7px' => '7px',
				'8px' => '8px',
				'9px' => '9px',
				'10px' => '10px',
			),
			'std' => '1px',
			'description' => __( 'Set Focus outline width', 'BeautyUX-accessibility' ),
		);

		$fields[] = array(
			'id' => 'a11y_focus_outline_color',
			'title' => __( 'Focus Outline Color', 'BeautyUX-accessibility' ),
			'type' => 'color',
			'std' => '#FF0000',
			'description' => __( 'Set Focus outline color', 'BeautyUX-accessibility' ),
		);

		return $fields;
	}

	public function customize_a11y( $wp_customize ) {
		$fields = $this->get_customizer_fields();

		$section_description = '<p>' . __( 'Use the control below to customize the appearance and layout of the Accessibility Toolbar', 'BeautyUX-accessibility' ) . '</p><p>' .
			sprintf( __( 'Additional Toolbar settings can be configured at the %s page.', 'BeautyUX-accessibility' ),
				'<a href="' . admin_url( 'admin.php?page=accessibility-toolbar' ) . '" target="blank">' . __( 'Accessibility Toolbar', 'BeautyUX-accessibility' ) . '</a>'
			) . '</p>';

		$wp_customize->add_section( 'accessibility', array(
			'title' => __( 'Accessibility', 'BeautyUX-accessibility' ),
			'priority'   => 30,
			'description' => $section_description,
		) );

		foreach ( $fields as $field ) {
			$customizer_id = BeautyUX_A11Y_CUSTOMIZER_OPTIONS . '[' . $field['id'] . ']';
			$wp_customize->add_setting( $customizer_id, array(
				'default' => $field['std'] ? $field['std'] : null,
				'type' => 'option',
			) );
			switch ( $field['type'] ) {
				case 'color':
					$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $field['id'], array(
						'label'    => $field['title'],
						'section'  => 'accessibility',
						'settings' => $customizer_id,
						'description' => isset( $field['description'] ) ? $field['description'] : null,
					) ) );
					break;
				case 'select':
				case 'text':
					$wp_customize->add_control( $field['id'], array(
						'label'    => $field['title'],
						'section'  => 'accessibility',
						'settings' => $customizer_id,
						'type'     => $field['type'],
						'choices'  => isset( $field['choices'] ) ? $field['choices'] : null,
						'description' => isset( $field['description'] ) ? $field['description'] : null,
					) );
					break;
			}
		}
	}

	public function get_custom_css_code() {
		$options = $this->get_customizer_options();
		$bg_color = $options['a11y_toggle_button_bg_color']; // get_theme_mod( 'a11y_toggle_button_bg_color', '#4054b2' );
		if ( ! empty( $bg_color ) ) {
			$this->add_css_rule( '#BeautyUX-a11y-toolbar .BeautyUX-a11y-toolbar-toggle a', 'background-color', $bg_color );
			$this->add_css_rule( '#BeautyUX-a11y-toolbar .BeautyUX-a11y-toolbar-overlay, #BeautyUX-a11y-toolbar .BeautyUX-a11y-toolbar-overlay ul.BeautyUX-a11y-toolbar-items.BeautyUX-a11y-links', 'border-color', $bg_color );
		}

		$outline_style = $options['a11y_focus_outline_style']; //get_theme_mod( 'a11y_focus_outline_style', 'solid' );
		if ( ! empty( $outline_style ) ) {
			$this->add_css_rule( 'body.BeautyUX-a11y-focusable a:focus', 'outline-style', $outline_style . ' !important' );
		}

		$outline_width = $options['a11y_focus_outline_width']; // get_theme_mod( 'a11y_focus_outline_width', '1px' );
		if ( ! empty( $outline_width ) ) {
			$this->add_css_rule( 'body.BeautyUX-a11y-focusable a:focus', 'outline-width', $outline_width . ' !important' );
		}

		$outline_color = $options['a11y_focus_outline_color']; //get_theme_mod( 'a11y_focus_outline_color', '#FF0000' );
		if ( ! empty( $outline_color ) ) {
			$this->add_css_rule( 'body.BeautyUX-a11y-focusable a:focus', 'outline-color', $outline_color . ' !important' );
		}

		$distance_top = $options['a11y_toolbar_distance_top']; //get_theme_mod( 'a11y_toolbar_distance_top', '100px' );
		if ( ! empty( $distance_top ) ) {
			$this->add_css_rule( '#BeautyUX-a11y-toolbar', 'top', $distance_top . ' !important' );
		}

		$distance_top_mobile = $options['a11y_toolbar_distance_top_mobile']; // get_theme_mod( 'a11y_toolbar_distance_top_mobile', '50px' );
		if ( ! empty( $distance_top_mobile ) ) {
			$this->add_css_code( "@media (max-width: 767px) { #BeautyUX-a11y-toolbar { top: {$distance_top_mobile} !important; } }" );
		}

		$fields = $this->get_customizer_fields();
		foreach ( $fields as $field ) {
			if ( empty( $field['selector'] ) || empty( $field['change_type'] ) ) {
				continue;
			}

			$option = $options[ $field['id'] ];

			if ( 'color' === $field['change_type'] ) {
				$this->add_css_rule( $field['selector'], 'color', $option );
			} elseif ( 'bg_color' === $field['change_type'] ) {
				$this->add_css_rule( $field['selector'], 'background-color', $option );
			}
		}
	}

	private function get_customizer_options() {
		static $options = false;
		if ( false === $options ) {
			$options = get_option( BeautyUX_A11Y_CUSTOMIZER_OPTIONS );
		}
		return $options;
	}

	private function add_css_rule( $selector, $rule, $value ) {
		if ( ! isset( $this->css_rules[ $selector ] ) ) {
			$this->css_rules[ $selector ] = array();
		}
		$this->css_rules[ $selector ][] = $rule . ': ' . $value . ';';
	}

	private function add_css_code( $code ) {
		$this->css_code .= "\n" . $code;
	}

	public function print_css_code() {
		$this->get_custom_css_code();
		$css = '';
		foreach ( $this->css_rules as $selector => $css_rules ) {
			$css .= "\n" . $selector . '{ ' . implode( "\t", $css_rules ) . '}';
		}
		echo '<style type="text/css">' . $css . $this->css_code . '</style>';
	}

	public function __construct() {
		add_filter( 'customize_register', array( &$this, 'customize_a11y' ), 610 );
		add_filter( 'wp_head', array( &$this, 'print_css_code' ) );
	}
}