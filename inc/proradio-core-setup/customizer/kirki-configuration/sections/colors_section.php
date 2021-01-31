<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @subpackage kirki
 * @version 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/* = Main colors
=============================================*/
Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_body_bg',
	'label'       => esc_html__( 'Body background', "proradio" ),
	'section'     => 'proradio_colors_section',
	'default'	  => '#f2f2f2',
	'transport'   => 'auto',
	'priority'    => 0,
	'choices'     => [
		'alpha' => true,
	],
	'output'    => array(
		array(
			'element'       => 'body',
			'property'      => 'background-color',
		),
	),
));

Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_background',
	'label'       => esc_html__( 'Main container background', "proradio" ),
	'section'     => 'proradio_colors_section',
	'default'	  => '#f8f8f8',
	'transport'   => 'auto',
	'priority'    => 0,
	'choices'     => [
		'alpha' => true,
	],
	'output'    => array(
		array(
			'element'       => '.proradio-bg, .proradio-comments-section .comment-respond',
			'property'      => 'background-color',
		),
	),
));

Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_paper',
	'label'       => esc_html__( 'Paper and cards backgorund', "proradio" ),
	'section'     => 'proradio_colors_section',
	'default'	  => '#ffffff',
	'priority'    => 0,
	'transport'   => 'auto',
	'choices'     => [
		'alpha' => true,
	],
	'output'    => array(
		array(
			'element'       => '.proradio-paper,  .proradio-arrow, #add_payment_method #payment, .woocommerce-cart #payment, .woocommerce-checkout #payment, .proradio-menubar ul li li , .proradio-menu-horizontal .proradio-menubar > li ul li, blockquote::before, .woocommerce-Tabs-panel, .woocommerce-customer-details address',
			'property'      => 'background-color',
		),

	),
));

Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_ink',
	'label'       => esc_html__( 'Text color', "proradio" ),
	'section'     => 'proradio_colors_section',
	'default'	  => '#5e5e5e',
	'priority'    => 0,
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'	=> '.wp-block-separator ',
			'property'	=> 'border-color',
			'value_pattern' => esc_attr( ' $;' ),
			'sanitize_callback' => 'proradio_rgba_border'
		),
		array(
			'element'       => 'body, .proradio-arrow, .proradio-bg, .proradio-comments-section .comment-respond, #add_payment_method #payment, .woocommerce-cart #payment, .woocommerce-checkout #payment, .proradio-paper, .proradio-menubar ul li li , .proradio-menu-horizontal .proradio-menubar > li ul li, blockquote::before, .wp-block-separator.is-style-dots::before',
			'property'      => 'color',
		),
		array(
			'element'		=> '.proradio-entrycontent p.has-drop-cap, .proradio-entrycontent blockquote, .proradio-entrycontent .wp-block-quote, blockquote, blockquote::before, .proradio-single .proradio-entrycontent .wp-block-quote, .proradio-entrycontent .wp-block-quote::before, .proradio-entrycontent .wp-block blockquote::before',
			'property'	=> 'border-color',
			'value_pattern' => esc_attr( ' $;' ),
			'sanitize_callback' => 'proradio_rgba_border'
		)


		
		
	),
));



Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_titles',
	'label'       => esc_html__( 'Titles color', "proradio" ),
	'section'     => 'proradio_colors_section',
	'default'	  => '#1c1c1c',
	'priority'    => 0,
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'       => 'h1, h2, h3, h4, h5, h6, .proradio-color-h, .elementor-widget-heading .elementor-heading-title, .elementor-editor-active .elementor-widget-heading .elementor-heading-title',
			'property'      => 'color',
		),
		array(
			'element'       => '.proradio-paper .proradio-color-h',
			'property'      => 'color',
			'suffix'      => ' !important'
		),
		array(
			'element'	=> '.proradio-negative h1, .proradio-negative h2, .proradio-negative h3, .proradio-negative h4, .proradio-negative h5, .proradio-negative h6, .proradio-negative .elementor-widget-heading .elementor-heading-title',
			'property'	=> 'color',
			'value_pattern' =>  ' #ffffff;', // always white!
		),
		array(
			'element'       => '.proradio-paper > h1, .proradio-paper > h2, .proradio-paper > h3, .proradio-paper > h4, .proradio-paper > h5, .proradio-paper > h6',
			'property'      => 'color',
		),
	),
));

Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_accent',
	'label'       => esc_html__( 'Accent color', "proradio" ),
	'section'     => 'proradio_colors_section',
	'default'	  => '#ff0056',
	'priority'    => 0,
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'       => '.proradio-btn i, .proradio-btn--playmenu i, a, .proradio-meta i, .proradio-meta > span i,  .proradio-menubar > li:hover > a > span, .proradio-btn__white, .proradio-menu-tree li ul li.proradio-open > a:not(.proradio-openthis), .proradio-widget ul li .comment-author-link a, .proradio-widget ul li::before  ',
			'property'      => 'color',
		),
		array(
			'element'		=> '.proradio-btn-primary, .proradio-entrycontent .wp-block-button .wp-block-button__link::before, .proradio-entrycontent .wp-block-button .wp-block-button__link::after, .proradio-entrycontent .wp-block-button .wp-block-file__button::before, .proradio-entrycontent .wp-block-button .wp-block-file__button::after, input[type="submit"]::before, input[type="submit"]::after, button::before, button::after, button.button::before, button.button::after , [class*="-catid-"]::before, .proradio-reaktions-accent, .proradio-accent,.proradio-scard:hover .proradio-btn__ghost,  .proradio-menubar li::before, .proradio-slider__c .proradio-container::after , .proradio-circlesanimation::after, .proradio-gradtext, .proradio-gradicon::before,.proradio-post__sticky::after, input[type="submit"],  .proradio-authorbox::after,  .proradio-p-catz::after, #proradio-body.woocommerce #proradio-master #respond input#submit, #proradio-body.woocommerce #proradio-master .woocommerce #respond input#submit, #proradio-body.woocommerce #proradio-master .woocommerce a.button, #proradio-body.woocommerce #proradio-master .woocommerce button.button, #proradio-body.woocommerce #proradio-master .woocommerce input.button,.proradio-entrycontent .wp-block-button .wp-block-button__link, .proradio-entrycontent .wp-block-button .wp-block-file__button , .woocommerce a.button',
			'property'		=> 'background-color'
		),

		array(
			'element' => '.proradio-post__social a, .proradio-btn::after, .proradio-btn::before, .proradio-btn.proradio-active, .proradio-btn::after, .proradio-btn-primary::before, .proradio-btn-primary::after, button[type="submit"]::before, button[type="submit"]::after, .proradio-entrycontent .wp-block-button .wp-block-button__link::before, .proradio-entrycontent .wp-block-button .wp-block-button__link::after, .proradio-entrycontent .wp-block-button .wp-block-file__button::before, .proradio-entrycontent .wp-block-button .wp-block-file__button::after, input[type="submit"]::before, input[type="submit"]::after, button::before, button::after, button.button::before, button.button::after',
			'property'		=> 'background-color'
		),
		array(
			'element' 		=> '.proradio-post .proradio-post__headercont--ex, .proradio-post__event__c, .proradio-form-wrapper input[type="text"]:focus, .proradio-form-wrapper input[type="email"]:focus, .proradio-form-wrapper input[type="password"]:focus, .proradio-form-wrapper textarea:focus,.proradio-btn:hover,.proradio-btn.proradio-active, input[type="submit"]:hover, #proradio-body.woocommerce input[type="submit"]:hover,.proradio-post__title, .proradio-scard__t, .proradio-menu-horizontal .proradio-menubar > li > a::after',
			'property' 		=> 'border-color'

		),
		array(
			'element'		=> '.proradio-form-wrapper input[type="text"]:focus, .proradio-form-wrapper input[type="email"]:focus, .proradio-form-wrapper input[type="password"]:focus, .proradio-form-wrapper textarea:focus, .proradio-btn:hover,.proradio-btn.proradio-active, input[type="submit"]:hover, #proradio-body.woocommerce input[type="submit"]:hover,.proradio-post__title, .proradio-scard__t, .proradio-menu-horizontal .proradio-menubar > li > a::after ',
			'property'		=> 'border-color'
		),
		array(
			'element'       => '.proradio-menu-horizontal .proradio-menubar > li > ul li a',
			'property'      => 'background-image',
			'value_pattern' =>'linear-gradient(45deg, $ 0%, $ 100%);',
		),
	),
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_accent_hover',
	'label'       => esc_html__( 'Accent hover color', "proradio" ),
	'section'     => 'proradio_colors_section',
	'default'	  => '#be024a',
	'priority'    => 0,
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'       => '.proradio-btn.proradio-active, .proradio-btn.proradio-active , .proradio-slider__c .proradio-container::before, .proradio-circlesanimation::before, .proradio-btn-primary:hover ',
			'property'      => 'background-color',
		),
		array(
			'element'       => 'a:hover, .proradio-menu-tree li ul li.proradio-open > a:not(.proradio-openthis):hover, .proradio-widget ul li .comment-author-link a:hover, .proradio-widget ul li:hover::before, .proradio-widget ul li a:hover , .proradio-widget .tagcloud a:hover',
			'property'      => 'color',
			// 'media_query' => '@media (min-width: 1200px)'
		),
		array(
			'element'       => '.proradio-post__social a:hover, #proradio-body.woocommerce #proradio-master .woocommerce button.button:hover, #proradio-body.woocommerce #proradio-master .woocommerce a.button:hover, .woocommerce a.button:hover,#proradio-body.woocommerce #proradio-master .woocommerce a.button:hover, .woocommerce a.button:hover,.proradio-btn-primary:hover, #proradio-body #proradio-master form input[type="submit"]:hover, #proradio-body #proradio-master form button:hover, .woocommerce a.button:hover, .proradio-btn__white:hover, .proradio-btn-primary:hover, #proradio-body #proradio-master form input[type="submit"]:hover, #proradio-body #proradio-master form button:hover, .woocommerce a.button:hover',
			'property'      => 'background-color',
			// 'media_query' => '@media (min-width: 1200px)'
		),
		array(
			'element'       => '.proradio-btn:hover, #proradio-body #proradio-master form button.button:hover,#proradio-body.woocommerce #proradio-master .woocommerce button.button:hover',
			'property'      => 'background-color',
			// 'media_query' => '@media (min-width: 1200px)'
		),
	),
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_accenttext',
	'label'       => esc_html__( 'Text color on accent', "proradio" ),
	'section'     => 'proradio_colors_section',
	'default'	  => '#ffffff',
	'priority'    => 0,
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'       => '.proradio-btn-primary i, .proradio-post__social a i, .proradio-btn-primary, .proradio-btn-primary:hover, [class*="-catid-"]::before, .proradio-reaktions-accent, .proradio-accent, .proradio-scard:hover .proradio-btn__ghost,  .proradio-menubar li::before, .proradio-slider__c .proradio-container::after , .proradio-circlesanimation::after',
			'property'      => 'color',
			'value_pattern' => esc_attr( '$ !important;' ),
		),
		array(
			'element'       => '.proradio-gradtext, .proradio-gradicon::before,.proradio-post__sticky::after, input[type="submit"],  .proradio-authorbox::after,  .proradio-p-catz::after, .proradio-caption__s::before,.proradio-caption__xs::before,#proradio-body.woocommerce #proradio-master #respond input#submit, #proradio-body.woocommerce #proradio-master .woocommerce #respond input#submit, #proradio-body.woocommerce #proradio-master .woocommerce a.button, #proradio-body.woocommerce #proradio-master .woocommerce button.button, #proradio-body.woocommerce #proradio-master .woocommerce input.button,.proradio-entrycontent .wp-block-button .wp-block-button__link, .proradio-entrycontent .wp-block-button .wp-block-file__button ',
			'property'      => 'color',
		),
		array(
			'element'       => '.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover',
			'property'      => 'color',
		),
		array(
			'element'       => '.proradio-btn:hover i',
			'property'      => 'color',
			// 'media_query' => '@media (min-width: 1200px)'
		),

	),
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_primary',
	'label'       => esc_html__( 'Primary background color', "proradio" ),
	'section'     => 'proradio_colors_section',
	'default'	  => '#111618',
	'priority'    => 0,
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'       => '.proradio-primary',
			'property'      => 'background-color',
		),
		array(
			'element'       => '.proradio-menu-horizontal .proradio-menubar>li:hover>ul ',
			'property'      => 'border-color',

		),
	),
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_primarylight',
	'label'       => esc_html__( 'Primary light background color', "proradio" ),
	'section'     => 'proradio_colors_section',
	'default'	  => '#12181b',
	'priority'    => 0,
	'transport'   => 'auto',
	'output'		=> array(
		array(
			'element' => '.proradio-primary-light',
			'property'=>'background-color'
		)
	)
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_primarydark',
	'label'       => esc_html__( 'Primary light background color', "proradio" ),
	'section'     => 'proradio_colors_section',
	'default'	  => '#050505',
	'priority'    => 0,
	'transport'   => 'auto',
	'output'		=> array(
		array(
			'element' => '.proradio-primary-dark',
			'property'=>'background-color'
		)
	)
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_primarytext',
	'label'       => esc_html__( 'Primary text color', "proradio" ),
	'section'     => 'proradio_colors_section',
	'default'	  => '#ffffff',
	'priority'    => 0,
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'       => '.proradio-primary-light, .proradio-primary, .proradio-primary-light > h1, .proradio-primary-light > h2, .proradio-primary-light > h3, .proradio-primary-light > h4, .proradio-primary-light > h5, .proradio-primary-light > h6, .proradio-primary h1, .proradio-primary h2, .proradio-primary h3, .proradio-primary h4, .proradio-primary h5, .proradio-primary h6, .proradio-primary-light .proradio-caption ',
			'property'      => 'color',
		),
		array(
			'element'       => '.proradio-primary-dark, .proradio-primary-dark h1, .proradio-primary-dark h2, .proradio-primary-dark h3, .proradio-primary-dark h4, .proradio-primary-dark h5, .proradio-primary-dark h6 ',
			'property'      => 'color',
		),
		array(
			'element'       => '.proradio-primary .proradio-btn, .proradio-primary-light .proradio-caption__s, .proradio-primary-light .proradio-btn',
			'property'      => 'border-color',
			'sanitize_callback' => 'proradio_rgba_border'
		),

		

	),
));





Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_header_duotone_c1',
	'label'       => esc_html__( 'Duotone color light', "proradio" ),
	'description' => esc_html__( 'Requires the activation of duotone effect', "proradio" ),
	'section'     => 'proradio_colors_section',
	'default'	  => '#ff0056',
	'priority'    => 10,
	'output'    => array(
		array(
			'element'       => '.proradio-duotone::before',
			'property'      => 'background-color',
		),
	),
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_header_duotone_c2',
	'label'       => esc_html__( 'Duotone color dark', "proradio" ),
	'description' => esc_html__( 'Requires the activation of duotone effect', "proradio" ),
	'section'     => 'proradio_colors_section',
	'default'	  => '#053b6a',
	'priority'    => 10,
	'output'    => array(
		array(
			'element'       => '.proradio-duotone::after',
			'property'      => 'background-color',
		),
	),
));






Kirki::add_field( 'proradio_config', [
    'type'        => 'multicolor',
    'settings'    => 'gradient_background',
    'label'       => esc_html__( 'Gradient backgrounds', 'proradio' ),
    'section'     => 'proradio_colors_section',
    'priority'    => 10,
    'choices'     => [
        'start'    	=> esc_html__( 'Start', 'proradio' ),
        'middle'    => esc_html__( 'Middle', 'proradio' ),
        'end'   	=> esc_html__( 'End', 'proradio' ),
    ],
    'default'     	=> [
        'start'    	=> '#05141c',
        'middle'    => '#00364f',
        'end'   	=> '#12516b',
    ],
] );



Kirki::add_field( 'proradio_config', [
    'type'        => 'multicolor',
    'settings'    => 'gradient_primary',
    'label'       => esc_html__( 'Gradient primary boxes', 'proradio' ),
    'section'     => 'proradio_colors_section',
    'priority'    => 10,
    'choices'     => [
        'start'    	=> esc_html__( 'Start', 'proradio' ),
        'end'   	=> esc_html__( 'End', 'proradio' ),
    ],
    'default'     	=> [
        'start'    	=> '#111618',
        'end'   	=> '#2e3f4c',
    ],
] );

