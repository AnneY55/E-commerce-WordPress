<?php

/**
 * [food_business_enqueue_style description]
 * @return [type] [description]
 */
function food_business_enqueue_style() {
	// Parent theme CSS.
	wp_enqueue_style( 'di-restaurant-style-default', get_template_directory_uri() . '/style.css' );

	// Child theme CSS file.
	wp_enqueue_style( 'food-business-style',  get_stylesheet_directory_uri() . '/style.css', array( 'bootstrap', 'font-awesome', 'di-restaurant-style-default', 'di-restaurant-style-core' ), wp_get_theme()->get('Version'), 'all' );
}
add_action( 'wp_enqueue_scripts', 'food_business_enqueue_style' );

/**
 * [food_business_setup description]
 * @return [type] [description]
 */
function food_business_setup() {
	register_nav_menus( array(
		'footer'	=> __( 'Footer Menu', 'food-business' ),
	) );
}
add_action( 'after_setup_theme', 'food_business_setup' );

/**
 * [food_business_woo_options description]
 * @return [type] [description]
 */
function food_business_woo_options() {
	Kirki::add_field( 'di_restaurant_config', array(
		'type'			 => 'select',
		'settings'		=> 'woo_product_img_effect',
		'label'			=> __( 'Product Image Effect', 'food-business' ),
		'description'	=> __( 'Product image effect on shop page', 'food-business' ),
		'section'		=> 'woocommerce_options',
		'default'		=> 'zoomin',
		'priority'		=> 10,
		'choices'		=> array(
			'none'			=> esc_attr__( 'None', 'food-business' ),
			'zoomin'		=> esc_attr__( 'Zoom In', 'food-business' ),
			'zoomout'		=> esc_attr__( 'Zoom Out', 'food-business' ),
			'rotate'		=> esc_attr__( 'Rotate', 'food-business' ),
			'blur'			=> esc_attr__( 'Blur', 'food-business' ),
			'grayscale'		=> esc_attr__( 'Gray Scale', 'food-business' ),
			'sepia'			=> esc_attr__( 'Sepia', 'food-business' ),
			'opacity'		=> esc_attr__( 'Opacity', 'food-business' ),
			'flash'			=> esc_attr__( 'Flash', 'food-business' ),
			'shine'			=> esc_attr__( 'Shine', 'food-business' ),
		),
	) );
}
add_action( 'di_restaurant_woo_settings', 'food_business_woo_options' );

/**
 * [food_business_product_img_effec_css description]
 * @return [type] [description]
 */
function food_business_product_img_effec_css() {
	$custom_css = "";
	$effect = get_theme_mod( 'woo_product_img_effect', 'zoomin' );
	if( $effect == 'zoomin' ) {
		$custom_css .= "
		.woocommerce ul.products li.product a img {
			-webkit-transition: opacity 0.5s ease, transform 0.5s ease;
			transition: opacity 0.5s ease, transform 0.5s ease;
		}

		.woocommerce ul.products li.product:hover a img {
			opacity: 0.9;
			transform: scale(1.1);
		}
		";
	} elseif( $effect == 'zoomout' ) {
		$custom_css .= "
		.woocommerce ul.products li.product a img {
			-webkit-transition: opacity 0.5s ease, transform 0.5s ease;
			transition: opacity 0.5s ease, transform 0.5s ease;
		}

		.woocommerce ul.products li.product a img {
			opacity: 0.9;
			transform: scale(1.1);
		}

		.woocommerce ul.products li.product:hover a img {
			opacity: 0.9;
			transform: scale(1);
		}
		";
	} elseif( $effect == 'rotate' ) {
		$custom_css .= "
		.woocommerce ul.products li.product a img {
			-webkit-transition: transform 0s ease;
			transition: transform 0s ease;
		}
		.woocommerce ul.products li.product:hover a img {
			-webkit-transition: transform 0.7s ease;
			transition: transform 0.7s ease;
		}
		.woocommerce ul.products li.product:hover img {
			-ms-transform: rotate(360deg);
			-webkit-transform: rotate(360deg);
			transform: rotate(360deg);
		}
		";
	} elseif( $effect == 'blur' ) {
		$custom_css .= "
		.woocommerce ul.products li.product img {
			-webkit-filter: blur(3px);
			filter: blur(3px);
			-webkit-transition: .3s ease-in-out;
			transition: .3s ease-in-out;
		}

		.woocommerce ul.products li.product:hover img {
			-webkit-filter: blur(0px);
			filter: blur(0px);
		}
		";
	} elseif( $effect == 'grayscale' ) {
		$custom_css .= "
		.woocommerce ul.products li.product img {
			-webkit-filter: grayscale(100%);
			filter: grayscale(100%);
			-webkit-transition: .3s ease-in-out;
			transition: .3s ease-in-out;
		}

		.woocommerce ul.products li.product:hover img {
			-webkit-filter: grayscale(0%);
			filter: grayscale(0%);
		}
		";
	} elseif( $effect == 'sepia' ) {
		$custom_css .= "
		.woocommerce ul.products li.product img {
			-webkit-filter: sepia(100%);
			filter: sepia(100%);
			-webkit-transition: .3s ease-in-out;
			transition: .3s ease-in-out;
		}

		.woocommerce ul.products li.product:hover img {
			-webkit-filter: sepia(0%);
			filter: sepia(0%);
		}
		";
	} elseif( $effect == 'opacity' ) {
		$custom_css .= "
		.woocommerce ul.products li.product a img {
			-webkit-transition: opacity 0.5s ease;
			transition: opacity 0.5s ease;
		}

		.woocommerce ul.products li.product:hover a img {
			opacity: 0.7;
		}
		";
	} elseif( $effect == 'flash' ) {
		$custom_css .= "
		.woocommerce ul.products li.product:hover a img {
			opacity: 1;
			-webkit-animation: recflash 1.5s;
			animation: recflash 1.5s;
		}
		@-webkit-keyframes recflash {
			0% {
				opacity: .4;
			}
			100% {
				opacity: 1;
			}
		}
		@keyframes recflash {
			0% {
				opacity: .4;
			}
			100% {
				opacity: 1;
			}
		}
		";
	} elseif( $effect == 'shine' ) {
		$custom_css .= "
		.woocommerce ul.products li.product::before {
			position: absolute;
			top: 0;
			left: -83%;
			z-index: 2;
			display: block;
			content: '';
			width: 50%;
			height: 100%;
			background: -webkit-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255,255,255,.3) 100%);
			background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,.3) 100%);
			-webkit-transform: skewX(-25deg);
			transform: skewX(-25deg);
		}
		.woocommerce ul.products li.product:hover::before {
			-webkit-animation: recshine .75s;
			animation: recshine .75s;
		}
		@-webkit-keyframes recshine {
			100% {
				left: 125%;
			}
		}
		@keyframes recshine {
			100% {
				left: 125%;
			}
		}
		";
	} else {
		$custom_css .= "";
	}

	// Show Only on Small Devices? callnow_hideonlarge kirki option inline css
	if( get_theme_mod( 'callnow_hideonlarge', '1' ) ) {
		$custom_css .= "
		@media (max-width: 767px) {
			.callnowfooter {
				position: fixed;
				right: 0px;
				padding: 8px 12px;
				border-top: 1px solid;
				border-left: 1px solid;
				border-bottom: 1px solid;
				border-top-left-radius: 20px;
				border-bottom-left-radius: 20px;
				top: 50%;
				display: block;
			}
		}
		";
	} else {
		$custom_css .= "
		.callnowfooter {
			position: fixed;
			right: 0px;
			padding: 8px 12px;
			border-top: 1px solid;
			border-left: 1px solid;
			border-bottom: 1px solid;
			border-top-left-radius: 20px;
			border-bottom-left-radius: 20px;
			top: 50%;
			display: block;
		}
		";
	}

	wp_add_inline_style( 'food-business-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'food_business_product_img_effec_css' );

/**
 * [food_business_kirki_options description]
 * @return [type] [description]
 */
function food_business_kirki_options() {

	// Call now section
	Kirki::add_section( 'callnow_options', array(
		'title'          => esc_attr__( 'Call Now Button Options', 'food-business' ),
		'panel'          => 'di_restaurant_options',
		'capability'     => 'edit_theme_options',
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'        => 'toggle',
		'settings'    => 'callnow_endis',
		'label'       => esc_attr__( 'Enable / Disable?', 'food-business' ),
		'description' => esc_attr__( 'Enable or disable call now button.', 'food-business' ),
		'section'     => 'callnow_options',
		'default'     => '1',
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'        => 'toggle',
		'settings'    => 'callnow_hideonlarge',
		'label'       => esc_attr__( 'Show Only on Small Devices?', 'food-business' ),
		'description' => esc_attr__( 'it will show call now button only on tablets and mobiles.', 'food-business' ),
		'section'     => 'callnow_options',
		'default'     => '1',
		'active_callback'  => array(
			array(
				'setting'  => 'callnow_endis',
				'operator' => '==',
				'value'    => '1',
			),
		),
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'			=> 'text',
		'settings'		=> 'callnow_text',
		'label'			=> esc_attr__( 'Button Text', 'food-business' ),
		'section'		=> 'callnow_options',
		'default'		=> __( 'Call Now', 'food-business' ),
		'active_callback'  => array(
			array(
				'setting'  => 'callnow_endis',
				'operator' => '==',
				'value'    => '1',
			),
		),
		'partial_refresh' => array(
			'callnow_text' => array(
				'selector'        => '.callnowfooter',
				'render_callback' => function() {
					return wp_kses_post( get_theme_mod( 'callnow_text' ) );
				},
			),
		),
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'			=> 'text',
		'settings'		=> 'callnow_link',
		'label'			=> esc_attr__( 'Button Link', 'food-business' ),
		'section'		=> 'callnow_options',
		'default'		=> 'tel:0123456789',
		'active_callback'  => array(
			array(
				'setting'  => 'callnow_endis',
				'operator' => '==',
				'value'    => '1',
			),
		),
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'        => 'typography',
		'settings'    => 'callnow_typog',
		'label'       => esc_attr__( 'Button Text Typography', 'food-business' ),
		'section'     => 'callnow_options',
		'default'     => array(
			'font-family'    => 'Fauna One',
			'variant'        => 'regular',
			'font-size'      => '14px',
			'line-height'    => '1.7',
			'letter-spacing' => '0',
			'text-transform' => 'inherit',
		),
		'output'      => array(
			array(
				'element' => '.callnowfooter',
			),
		),
		'transport' => 'auto',
		'active_callback'  => array(
			array(
				'setting'  => 'callnow_endis',
				'operator' => '==',
				'value'    => '1',
			),
		),
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'        => 'color',
		'settings'    => 'callnow_clr',
		'label'       => esc_attr__( 'Button Color', 'food-business' ),
		'section'     => 'callnow_options',
		'default'     => '#000000',
		'choices'     => array(
			'alpha' => true,
		),
		'output' => array(
			array(
				'element'	=> '.callnowfooter',
				'property'	=> 'color',
			),
		),
		'transport' => 'auto',
		'active_callback'  => array(
			array(
				'setting'  => 'callnow_endis',
				'operator' => '==',
				'value'    => '1',
			),
		),
	) );

	Kirki::add_field( 'di_restaurant_config', array(
		'type'        => 'color',
		'settings'    => 'callnow_bg_clr',
		'label'       => esc_attr__( 'Button Background Color', 'food-business' ),
		'section'     => 'callnow_options',
		'default'     => '#f5d37e',
		'choices'     => array(
			'alpha' => true,
		),
		'output' => array(
			array(
				'element'	=> '.callnowfooter',
				'property'	=> 'background-color',
			),
		),
		'transport' => 'auto',
		'active_callback'  => array(
			array(
				'setting'  => 'callnow_endis',
				'operator' => '==',
				'value'    => '1',
			),
		),
	) );


}
add_action( 'di_restaurant_cutmzr_theme_info', 'food_business_kirki_options' );

