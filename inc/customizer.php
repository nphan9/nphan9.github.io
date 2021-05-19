<?php
/**
 * Pet Animal Store Theme Customizer
 *
 * @package Pet Animal Store
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function pet_animal_store_customize_register( $wp_customize ) {

	load_template( trailingslashit( get_template_directory() ) . '/inc/icon-changer.php' );

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial(
		'blogname',
		array(
			'selector'        => '.site-title a',
			'render_callback' => 'pet_animal_store_customize_partial_blogname',
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'blogdescription',
		array(
			'selector'        => '.site-description',
			'render_callback' => 'pet_animal_store_customize_partial_blogdescription',
		)
	);

	/* Custom panel type - used for multiple levels of panels */
	if ( class_exists( 'WP_Customize_Panel' ) ) {

		/**
		 * Class Pet_Animal_Store_WP_Customize_Panel
		 */
		class Pet_Animal_Store_WP_Customize_Panel extends WP_Customize_Panel {

			/**
			 * Panel
			 *
			 * @var $panel string Panel
			 */
			public $panel;

			/**
			 * Panel type
			 *
			 * @var $type string Panel type.
			 */
			public $type = 'pet_animal_store_panel';

			/**
			 * Form the json
			 */
			public function json() {

				$array                   = wp_array_slice_assoc(
					(array) $this, array(
						'id',
						'description',
						'priority',
						'type',
						'panel',
					)
				);
				$array['title']          = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
				$array['content']        = $this->get_content();
				$array['active']         = $this->active();
				$array['instanceNumber'] = $this->instance_number;

				return $array;

			}

		}

	}

	$wp_customize->register_panel_type( 'Pet_Animal_Store_WP_Customize_Panel' );

	/**
	 * Upsells
	 */
	load_template( trailingslashit( get_template_directory() ) . 'inc/class-customizer-theme-info-control.php' );

	$wp_customize->add_section(
		'pet_animal_store_theme_info_main_section', array(
			'title'    => __( 'View PRO version', 'pet-animal-store' ),
			'priority' => 1,
		)
	);
	$wp_customize->add_setting(
		'pet_animal_store_theme_info_main_control', array(
			'sanitize_callback' => 'esc_html',
		)
	);

	$wp_customize->add_control(
		new Pet_Animal_Store_Theme_Info(
			$wp_customize, 'pet_animal_store_theme_info_main_control', array(
				'section'     => 'pet_animal_store_theme_info_main_section',
				'priority'    => 100,
				'options'     => array(
					esc_html__( 'Enable-Disable options on every section', 'pet-animal-store' ),
					esc_html__( 'Background Color & Image Option', 'pet-animal-store' ),
					esc_html__( '100+ Font Family Options', 'pet-animal-store' ),
					esc_html__( 'Advanced Color options', 'pet-animal-store' ),
					esc_html__( 'Translation ready', 'pet-animal-store' ),
					esc_html__( 'Gallery, Banner, Post Type Plugin Functionality', 'pet-animal-store' ),
					esc_html__( 'Integrated Google map', 'pet-animal-store' ),
					esc_html__( '1 Year Free Support', 'pet-animal-store' ),
				),
				'button_url'  => esc_url( 'https://www.themescaliber.com/themes/premium-animal-pet-wordpress-theme' ),
				'button_text' => esc_html__( 'View PRO version', 'pet-animal-store' ),
			)
		)
	);

	$pet_animal_store_font_array = array(
        '' =>'No Fonts',
        'Abril Fatface' => 'Abril Fatface',
        'Acme' =>'Acme', 
        'Anton' => 'Anton', 
        'Architects Daughter' =>'Architects Daughter',
        'Arimo' => 'Arimo', 
        'Arsenal' =>'Arsenal',
        'Arvo' =>'Arvo',
        'Alegreya' =>'Alegreya',
        'Alfa Slab One' =>'Alfa Slab One',
        'Averia Serif Libre' =>'Averia Serif Libre', 
        'Bangers' =>'Bangers', 
        'Boogaloo' =>'Boogaloo', 
        'Bad Script' =>'Bad Script',
        'Bitter' =>'Bitter', 
        'Bree Serif' =>'Bree Serif', 
        'BenchNine' =>'BenchNine',
        'Cabin' =>'Cabin',
        'Cardo' =>'Cardo', 
        'Courgette' =>'Courgette', 
        'Cherry Swash' =>'Cherry Swash',
        'Cormorant Garamond' =>'Cormorant Garamond', 
        'Crimson Text' =>'Crimson Text',
        'Cuprum' =>'Cuprum', 
        'Cookie' =>'Cookie',
        'Chewy' =>'Chewy',
        'Days One' =>'Days One',
        'Dosis' =>'Dosis',
        'Droid Sans' =>'Droid Sans', 
        'Economica' =>'Economica', 
        'Fredoka One' =>'Fredoka One',
        'Fjalla One' =>'Fjalla One',
        'Francois One' =>'Francois One', 
        'Frank Ruhl Libre' => 'Frank Ruhl Libre', 
        'Gloria Hallelujah' =>'Gloria Hallelujah',
        'Great Vibes' =>'Great Vibes', 
        'Handlee' =>'Handlee', 
        'Hammersmith One' =>'Hammersmith One',
        'Inconsolata' =>'Inconsolata',
        'Indie Flower' =>'Indie Flower', 
        'IM Fell English SC' =>'IM Fell English SC',
        'Julius Sans One' =>'Julius Sans One',
        'Josefin Slab' =>'Josefin Slab',
        'Josefin Sans' =>'Josefin Sans',
        'Kanit' =>'Kanit',
        'Lobster' =>'Lobster',
        'Lato' => 'Lato',
        'Lora' =>'Lora', 
        'Libre Baskerville' =>'Libre Baskerville',
        'Lobster Two' => 'Lobster Two',
        'Merriweather' =>'Merriweather',
        'Monda' =>'Monda',
        'Montserrat' =>'Montserrat',
        'Muli' =>'Muli',
        'Marck Script' =>'Marck Script',
        'Noto Serif' =>'Noto Serif',
        'Open Sans' =>'Open Sans',
        'Overpass' => 'Overpass', 
        'Overpass Mono' =>'Overpass Mono',
        'Oxygen' =>'Oxygen',
        'Orbitron' =>'Orbitron',
        'Patua One' =>'Patua One',
        'Pacifico' =>'Pacifico',
        'Padauk' =>'Padauk',
        'Playball' =>'Playball',
        'Playfair Display' =>'Playfair Display',
        'PT Sans' =>'PT Sans',
        'Philosopher' =>'Philosopher',
        'Permanent Marker' =>'Permanent Marker',
        'Poiret One' =>'Poiret One',
        'Quicksand' =>'Quicksand',
        'Quattrocento Sans' =>'Quattrocento Sans',
        'Raleway' =>'Raleway',
        'Rubik' =>'Rubik',
        'Rokkitt' =>'Rokkitt',
        'Russo One' => 'Russo One', 
        'Righteous' =>'Righteous', 
        'Slabo' =>'Slabo', 
        'Source Sans Pro' =>'Source Sans Pro',
        'Shadows Into Light Two' =>'Shadows Into Light Two',
        'Shadows Into Light' =>  'Shadows Into Light',
        'Sacramento' =>'Sacramento',
        'Shrikhand' =>'Shrikhand',
        'Tangerine' => 'Tangerine',
        'Ubuntu' =>'Ubuntu',
        'VT323' =>'VT323',
        'Varela Round' =>'Varela Round',
        'Vampiro One' =>'Vampiro One',
        'Vollkorn' => 'Vollkorn',
        'Volkhov' =>'Volkhov',
        'Kavoon' =>'Kavoon',
        'Yanone Kaffeesatz' =>'Yanone Kaffeesatz'
    );

	//add home page setting pannel
	$wp_customize->add_panel( 'pet_animal_store_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Theme Settings', 'pet-animal-store' ),
	    'description' => __( 'Description of what this panel does.', 'pet-animal-store' )
	) );

	//Color / Font Pallete
	$wp_customize->add_section( 'pet_animal_store_typography', array(
    	'title'      => __( 'Color / Font Pallete', 'pet-animal-store' ),
		'priority'   => 30,
		'panel' => 'pet_animal_store_panel_id'
	) );

	// Add the Theme Color Option section.
	$wp_customize->add_setting( 'pet_animal_store_theme_color_first', array(
	    'default' => '#83df00',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'pet_animal_store_theme_color_first', array(
  		'label' => 'Theme Color Option',
	    'section' => 'pet_animal_store_typography',
	    'settings' => 'pet_animal_store_theme_color_first',
  	)));

  	$wp_customize->add_setting( 'pet_animal_store_theme_color_second', array(
	    'default' => '#333',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'pet_animal_store_theme_color_second', array(
  		'label' => 'Theme Color Option',
	    'section' => 'pet_animal_store_typography',
	    'settings' => 'pet_animal_store_theme_color_second',
  	)));
	
	// This is Paragraph Color picker setting
	$wp_customize->add_setting( 'pet_animal_store_paragraph_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'pet_animal_store_paragraph_color', array(
		'label' => __('Paragraph Color', 'pet-animal-store'),
		'section' => 'pet_animal_store_typography',
		'settings' => 'pet_animal_store_paragraph_color',
	)));

	//This is Paragraph FontFamily picker setting
	$wp_customize->add_setting('pet_animal_store_paragraph_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'pet_animal_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'pet_animal_store_paragraph_font_family', array(
	    'section'  => 'pet_animal_store_typography',
	    'label'    => __( 'Paragraph Fonts','pet-animal-store'),
	    'type'     => 'select',
	    'choices'  => $pet_animal_store_font_array,
	));

	$wp_customize->add_setting('pet_animal_store_paragraph_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('pet_animal_store_paragraph_font_size',array(
		'label'	=> __('Paragraph Font Size','pet-animal-store'),
		'section'	=> 'pet_animal_store_typography',
		'setting'	=> 'pet_animal_store_paragraph_font_size',
		'type'	=> 'text'
	));

	// This is "a" Tag Color picker setting
	$wp_customize->add_setting( 'pet_animal_store_atag_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'pet_animal_store_atag_color', array(
		'label' => __('"a" Tag Color', 'pet-animal-store'),
		'section' => 'pet_animal_store_typography',
		'settings' => 'pet_animal_store_atag_color',
	)));

	//This is "a" Tag FontFamily picker setting
	$wp_customize->add_setting('pet_animal_store_atag_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'pet_animal_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'pet_animal_store_atag_font_family', array(
	    'section'  => 'pet_animal_store_typography',
	    'label'    => __( '"a" Tag Fonts','pet-animal-store'),
	    'type'     => 'select',
	    'choices'  => $pet_animal_store_font_array,
	));

	// This is "a" Tag Color picker setting
	$wp_customize->add_setting( 'pet_animal_store_li_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'pet_animal_store_li_color', array(
		'label' => __('"li" Tag Color', 'pet-animal-store'),
		'section' => 'pet_animal_store_typography',
		'settings' => 'pet_animal_store_li_color',
	)));

	//This is "li" Tag FontFamily picker setting
	$wp_customize->add_setting('pet_animal_store_li_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'pet_animal_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'pet_animal_store_li_font_family', array(
	    'section'  => 'pet_animal_store_typography',
	    'label'    => __( '"li" Tag Fonts','pet-animal-store'),
	    'type'     => 'select',
	    'choices'  => $pet_animal_store_font_array,
	));

	// This is H1 Color picker setting
	$wp_customize->add_setting( 'pet_animal_store_h1_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'pet_animal_store_h1_color', array(
		'label' => __('H1 Color', 'pet-animal-store'),
		'section' => 'pet_animal_store_typography',
		'settings' => 'pet_animal_store_h1_color',
	)));

	//This is H1 FontFamily picker setting
	$wp_customize->add_setting('pet_animal_store_h1_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'pet_animal_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'pet_animal_store_h1_font_family', array(
	    'section'  => 'pet_animal_store_typography',
	    'label'    => __( 'H1 Fonts','pet-animal-store'),
	    'type'     => 'select',
	    'choices'  => $pet_animal_store_font_array,
	));

	//This is H1 FontSize setting
	$wp_customize->add_setting('pet_animal_store_h1_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('pet_animal_store_h1_font_size',array(
		'label'	=> __('H1 Font Size','pet-animal-store'),
		'section'	=> 'pet_animal_store_typography',
		'setting'	=> 'pet_animal_store_h1_font_size',
		'type'	=> 'text'
	));

	// This is H2 Color picker setting
	$wp_customize->add_setting( 'pet_animal_store_h2_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'pet_animal_store_h2_color', array(
		'label' => __('h2 Color', 'pet-animal-store'),
		'section' => 'pet_animal_store_typography',
		'settings' => 'pet_animal_store_h2_color',
	)));

	//This is H2 FontFamily picker setting
	$wp_customize->add_setting('pet_animal_store_h2_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'pet_animal_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'pet_animal_store_h2_font_family', array(
	    'section'  => 'pet_animal_store_typography',
	    'label'    => __( 'h2 Fonts','pet-animal-store'),
	    'type'     => 'select',
	    'choices'  => $pet_animal_store_font_array,
	));

	//This is H2 FontSize setting
	$wp_customize->add_setting('pet_animal_store_h2_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('pet_animal_store_h2_font_size',array(
		'label'	=> __('h2 Font Size','pet-animal-store'),
		'section'	=> 'pet_animal_store_typography',
		'setting'	=> 'pet_animal_store_h2_font_size',
		'type'	=> 'text'
	));

	// This is H3 Color picker setting
	$wp_customize->add_setting( 'pet_animal_store_h3_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'pet_animal_store_h3_color', array(
		'label' => __('h3 Color', 'pet-animal-store'),
		'section' => 'pet_animal_store_typography',
		'settings' => 'pet_animal_store_h3_color',
	)));

	//This is H3 FontFamily picker setting
	$wp_customize->add_setting('pet_animal_store_h3_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'pet_animal_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'pet_animal_store_h3_font_family', array(
	    'section'  => 'pet_animal_store_typography',
	    'label'    => __( 'h3 Fonts','pet-animal-store'),
	    'type'     => 'select',
	    'choices'  => $pet_animal_store_font_array,
	));

	//This is H3 FontSize setting
	$wp_customize->add_setting('pet_animal_store_h3_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('pet_animal_store_h3_font_size',array(
		'label'	=> __('h3 Font Size','pet-animal-store'),
		'section'	=> 'pet_animal_store_typography',
		'setting'	=> 'pet_animal_store_h3_font_size',
		'type'	=> 'text'
	));

	// This is H4 Color picker setting
	$wp_customize->add_setting( 'pet_animal_store_h4_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'pet_animal_store_h4_color', array(
		'label' => __('h4 Color', 'pet-animal-store'),
		'section' => 'pet_animal_store_typography',
		'settings' => 'pet_animal_store_h4_color',
	)));

	//This is H4 FontFamily picker setting
	$wp_customize->add_setting('pet_animal_store_h4_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'pet_animal_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'pet_animal_store_h4_font_family', array(
	    'section'  => 'pet_animal_store_typography',
	    'label'    => __( 'h4 Fonts','pet-animal-store'),
	    'type'     => 'select',
	    'choices'  => $pet_animal_store_font_array,
	));

	//This is H4 FontSize setting
	$wp_customize->add_setting('pet_animal_store_h4_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('pet_animal_store_h4_font_size',array(
		'label'	=> __('h4 Font Size','pet-animal-store'),
		'section'	=> 'pet_animal_store_typography',
		'setting'	=> 'pet_animal_store_h4_font_size',
		'type'	=> 'text'
	));

	// This is H5 Color picker setting
	$wp_customize->add_setting( 'pet_animal_store_h5_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'pet_animal_store_h5_color', array(
		'label' => __('h5 Color', 'pet-animal-store'),
		'section' => 'pet_animal_store_typography',
		'settings' => 'pet_animal_store_h5_color',
	)));

	//This is H5 FontFamily picker setting
	$wp_customize->add_setting('pet_animal_store_h5_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'pet_animal_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'pet_animal_store_h5_font_family', array(
	    'section'  => 'pet_animal_store_typography',
	    'label'    => __( 'h5 Fonts','pet-animal-store'),
	    'type'     => 'select',
	    'choices'  => $pet_animal_store_font_array,
	));

	//This is H5 FontSize setting
	$wp_customize->add_setting('pet_animal_store_h5_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('pet_animal_store_h5_font_size',array(
		'label'	=> __('h5 Font Size','pet-animal-store'),
		'section'	=> 'pet_animal_store_typography',
		'setting'	=> 'pet_animal_store_h5_font_size',
		'type'	=> 'text'
	));

	// This is H6 Color picker setting
	$wp_customize->add_setting( 'pet_animal_store_h6_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'pet_animal_store_h6_color', array(
		'label' => __('h6 Color', 'pet-animal-store'),
		'section' => 'pet_animal_store_typography',
		'settings' => 'pet_animal_store_h6_color',
	)));

	//This is H6 FontFamily picker setting
	$wp_customize->add_setting('pet_animal_store_h6_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'pet_animal_store_sanitize_choices'
	));
	$wp_customize->add_control(
	    'pet_animal_store_h6_font_family', array(
	    'section'  => 'pet_animal_store_typography',
	    'label'    => __( 'h6 Fonts','pet-animal-store'),
	    'type'     => 'select',
	    'choices'  => $pet_animal_store_font_array,
	));

	//This is H6 FontSize setting
	$wp_customize->add_setting('pet_animal_store_h6_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('pet_animal_store_h6_font_size',array(
		'label'	=> __('h6 Font Size','pet-animal-store'),
		'section'	=> 'pet_animal_store_typography',
		'setting'	=> 'pet_animal_store_h6_font_size',
		'type'	=> 'text'
	));

	//Layouts
	$wp_customize->add_section( 'pet_animal_store_left_right', array(
    	'title' => __('Theme Layout Settings', 'pet-animal-store' ),
		'priority'   => 30,
		'panel' => 'pet_animal_store_panel_id'
	) );

	// Preloader
	$wp_customize->add_setting( 'pet_animal_store_preloader_hide',array(
		'default' => true,
      	'sanitize_callback'	=> 'pet_animal_store_sanitize_checkbox'
    ) );
    $wp_customize->add_control('pet_animal_store_preloader_hide',array(
    	'type' => 'checkbox',
        'label' => __( 'Show / Hide Preloader','pet-animal-store' ),
        'section' => 'pet_animal_store_left_right'
    ));

    $wp_customize->add_setting('pet_animal_store_preloader_type',array(
        'default'   => 'center-square',
        'sanitize_callback' => 'pet_animal_store_sanitize_choices'
	));
	$wp_customize->add_control( 'pet_animal_store_preloader_type', array(
		'label' => __( 'Preloader Type','pet-animal-store' ),
		'section' => 'pet_animal_store_left_right',
		'type'  => 'select',
		'settings' => 'pet_animal_store_preloader_type',
		'choices' => array(
		    'center-square' => __('Center Square','pet-animal-store'),
		    'chasing-square' => __('Chasing Square','pet-animal-store'),
	    ),
	));

	$wp_customize->add_setting( 'pet_animal_store_preloader_color', array(
	    'default' => '#333333',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'pet_animal_store_preloader_color', array(
  		'label' => 'Preloader Color',
	    'section' => 'pet_animal_store_left_right',
	    'settings' => 'pet_animal_store_preloader_color',
  	)));

  	$wp_customize->add_setting( 'pet_animal_store_preloader_bg_color', array(
	    'default' => '#fff',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'pet_animal_store_preloader_bg_color', array(
  		'label' => 'Preloader Background Color',
	    'section' => 'pet_animal_store_left_right',
	    'settings' => 'pet_animal_store_preloader_bg_color',
  	)));

	$wp_customize->add_setting('pet_animal_store_width_options',array(
        'default' => 'Full Layout',
        'sanitize_callback' => 'pet_animal_store_sanitize_choices'
	));
	$wp_customize->add_control('pet_animal_store_width_options',array(
        'type' => 'select',
        'label' => __('Select Site Layout','pet-animal-store'),
        'section' => 'pet_animal_store_left_right',
        'choices' => array(
            'Full Layout' => __('Full Layout','pet-animal-store'),
            'Contained Layout' => __('Contained Layout','pet-animal-store'),
            'Boxed Layout' => __('Boxed Layout','pet-animal-store'),
        ),
	) );

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('pet_animal_store_theme_options',array(
	        'default' => 'Right Sidebar',
	        'sanitize_callback' => 'pet_animal_store_sanitize_choices'
	    )
    );
	$wp_customize->add_control('pet_animal_store_theme_options',
	    array(
	        'type' => 'radio',
	        'label' => __( 'Do you want this section', 'pet-animal-store' ),
	        'section' => 'pet_animal_store_left_right',
	        'choices' => array(
	            'Left Sidebar' => __('Left Sidebar','pet-animal-store'),
	            'Right Sidebar' => __('Right Sidebar','pet-animal-store'),
	            'One Column' => __('One Column','pet-animal-store'),
	            'Three Columns' => __('Three Columns','pet-animal-store'),
	            'Four Columns' => __('Four Columns','pet-animal-store'),
	            'Grid Layout' => __('Grid Layout','pet-animal-store')
	        ),
	    )
    );

    //Contact details
	$wp_customize->add_section('pet_animal_store_topbar',array(
		'title'	=> __('Top Header','pet-animal-store'),
		'description'	=> __('Add Header Content here','pet-animal-store'),
		'priority'	=> null,
		'panel' => 'pet_animal_store_panel_id',
	));

	//Sticky Header
	$wp_customize->add_setting( 'pet_animal_store_sticky_header',array(
        'default' => 'false',
      	'sanitize_callback'	=> 'pet_animal_store_sanitize_checkbox'
    ) );
    $wp_customize->add_control('pet_animal_store_sticky_header',array(
    	'type' => 'checkbox',
        'label' => __( 'Sticky Header','pet-animal-store' ),
        'section' => 'pet_animal_store_topbar'
    ));

    $wp_customize->add_setting('pet_animal_store_sticky_header_padding', array(
		'default'=> '',
		'sanitize_callback'	=> 'pet_animal_store_sanitize_float'
	));
	$wp_customize->add_control('pet_animal_store_sticky_header_padding', array(
		'label'	=> __('Sticky Header Padding','pet-animal-store'),
		'input_attrs' => array(
            'step' => 1,
			'min'  => 0,
			'max'  => 50,
        ),
		'section'=> 'pet_animal_store_topbar',
		'type'=> 'number',
	));

    $wp_customize->selective_refresh->add_partial(
		'pet_animal_store_mail',
		array(
			'selector'        => '.baricon p',
			'render_callback' => 'pet_animal_store_customize_partial_pet_animal_store_mail',
		)
	);

	$wp_customize->add_setting('pet_animal_store_mail_icon',array(
		'default'	=> 'fas fa-at',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Pet_Animal_Store_Icon_Changer(
        $wp_customize, 'pet_animal_store_mail_icon',array(
		'label'	=> __('Mail Icon','pet-animal-store'),
		'section'	=> 'pet_animal_store_topbar',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting('pet_animal_store_mail',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_email'
	));	
	$wp_customize->add_control('pet_animal_store_mail',array(
		'label'	=> __('Email','pet-animal-store'),
		'section'	=> 'pet_animal_store_topbar',
		'setting'	=> 'pet_animal_store_mail',
		'type'	=> 'text'
	));

	$wp_customize->add_setting('pet_animal_store_phone_icon',array(
		'default'	=> 'fas fa-phone-volume',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Pet_Animal_Store_Icon_Changer(
        $wp_customize, 'pet_animal_store_phone_icon',array(
		'label'	=> __('Phone Icon','pet-animal-store'),
		'section'	=> 'pet_animal_store_topbar',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting('pet_animal_store_call',array(
		'default'	=> '',
		'sanitize_callback'	=> 'pet_animal_store_sanitize_phone_number'
	));	
	$wp_customize->add_control('pet_animal_store_call',array(
		'label'	=> __('Phone','pet-animal-store'),
		'section'	=> 'pet_animal_store_topbar',
		'setting'	=> 'pet_animal_store_call',
		'type'	=> 'text'
	));

	$wp_customize->add_setting('pet_animal_store_navigation_case',array(
        'default' => 'capitalize',
        'sanitize_callback' => 'pet_animal_store_sanitize_choices'
	));
	$wp_customize->add_control('pet_animal_store_navigation_case',array(
        'type' => 'select',
        'label' => __('Navigation Case','pet-animal-store'),
        'section' => 'pet_animal_store_topbar',
        'choices' => array(
            'uppercase' => __('Uppercase','pet-animal-store'),
            'capitalize' => __('Capitalize','pet-animal-store'),
        ),
	) );

	$wp_customize->add_setting( 'pet_animal_store_nav_font_size', array(
		'default'           => 14,
		'sanitize_callback' => 'pet_animal_store_sanitize_float',
	) );
	$wp_customize->add_control( 'pet_animal_store_nav_font_size', array(
		'label' => __( 'Navigation Font Size','pet-animal-store' ),
		'section'     => 'pet_animal_store_topbar',
		'type'        => 'number',
		'input_attrs' => array(
			'step' => 1,
			'min' => 0,
			'max' => 50,
		),
	) );

	//Social Icons(topbar)
	$wp_customize->add_section('pet_animal_store_topbar_header',array(
		'title'	=> __('Social Icon Section','pet-animal-store'),
		'description'	=> __('Add Header Content here','pet-animal-store'),
		'priority'	=> null,
		'panel' => 'pet_animal_store_panel_id',
	));

	$wp_customize->selective_refresh->add_partial(
		'pet_animal_store_facebook_url',
		array(
			'selector'        => '.social-icon',
			'render_callback' => 'pet_animal_store_customize_partial_pet_animal_store_facebook_url',
		)
	);

	$wp_customize->add_setting('pet_animal_store_facebook_icon',array(
		'default'	=> 'fab fa-facebook-f',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Pet_Animal_Store_Icon_Changer(
        $wp_customize, 'pet_animal_store_facebook_icon',array(
		'label'	=> __('Facebook Icon','pet-animal-store'),
		'section'	=> 'pet_animal_store_topbar_header',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('pet_animal_store_facebook_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('pet_animal_store_facebook_url',array(
		'label'	=> __('Add Facebook link','pet-animal-store'),
		'section'	=> 'pet_animal_store_topbar_header',
		'setting'	=> 'pet_animal_store_facebook_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('pet_animal_store_twitter_icon',array(
		'default'	=> 'fab fa-twitter',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Pet_Animal_Store_Icon_Changer(
        $wp_customize, 'pet_animal_store_twitter_icon',array(
		'label'	=> __('Twitter Icon','pet-animal-store'),
		'section'	=> 'pet_animal_store_topbar_header',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('pet_animal_store_twitter_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('pet_animal_store_twitter_url',array(
		'label'	=> __('Add Twitter link','pet-animal-store'),
		'section'	=> 'pet_animal_store_topbar_header',
		'setting'	=> 'pet_animal_store_twitter_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('pet_animal_store_instagram_icon',array(
		'default'	=> 'fab fa-instagram',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Pet_Animal_Store_Icon_Changer(
        $wp_customize, 'pet_animal_store_instagram_icon',array(
		'label'	=> __('Instagram Icon','pet-animal-store'),
		'section'	=> 'pet_animal_store_topbar_header',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('pet_animal_store_instagram_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('pet_animal_store_instagram_url',array(
		'label'	=> __('Add Instagram link','pet-animal-store'),
		'section'	=> 'pet_animal_store_topbar_header',
		'setting'	=> 'pet_animal_store_instagram_url',
		'type'		=> 'url'
	));

	$wp_customize->add_setting('pet_animal_store_linkedin_icon',array(
		'default'	=> 'fab fa-linkedin-in',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Pet_Animal_Store_Icon_Changer(
        $wp_customize, 'pet_animal_store_linkedin_icon',array(
		'label'	=> __('Linkedin Icon','pet-animal-store'),
		'section'	=> 'pet_animal_store_topbar_header',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('pet_animal_store_linkedin_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('pet_animal_store_linkedin_url',array(
		'label'	=> __('Add Linkedin link','pet-animal-store'),
		'section'	=> 'pet_animal_store_topbar_header',
		'setting'	=> 'pet_animal_store_linkedin_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('pet_animal_store_youtube_icon',array(
		'default'	=> 'fab fa-youtube',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Pet_Animal_Store_Icon_Changer(
        $wp_customize, 'pet_animal_store_youtube_icon',array(
		'label'	=> __('Youtube Icon','pet-animal-store'),
		'section'	=> 'pet_animal_store_topbar_header',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('pet_animal_store_youtube_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('pet_animal_store_youtube_url',array(
		'label'	=> __('Add Youtube link','pet-animal-store'),
		'section'	=> 'pet_animal_store_topbar_header',
		'setting'	=> 'pet_animal_store_youtube_url',
		'type'	=> 'url'
	));

	//home page slider
	$wp_customize->add_section( 'pet_animal_store_slidersettings' , array(
    	'title'  => __( 'Slider Settings', 'pet-animal-store' ),
		'priority'  => null,
		'panel' => 'pet_animal_store_panel_id'
	) );

	$wp_customize->selective_refresh->add_partial(
		'pet_animal_store_slider_arrows',
		array(
			'selector'        => '#slider .inner_carousel h1',
			'render_callback' => 'pet_animal_store_customize_partial_pet_animal_store_slider_arrows',
		)
	);

	$wp_customize->add_setting('pet_animal_store_slider_arrows',array(
      'default' => false,
      'sanitize_callback'	=> 'pet_animal_store_sanitize_checkbox'
	));
	$wp_customize->add_control('pet_animal_store_slider_arrows',array(
	    'type' => 'checkbox',
	    'label' => __('Show / Hide slider','pet-animal-store'),
	    'section' => 'pet_animal_store_slidersettings',
	));

	for ( $count = 1; $count <= 4; $count++ ) {
		$wp_customize->add_setting( 'pet_animal_store_slidersettings_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'pet_animal_store_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'pet_animal_store_slidersettings_page' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'pet-animal-store' ),
			'section'  => 'pet_animal_store_slidersettings',
			'type'     => 'dropdown-pages'
		) );
	}

	$wp_customize->add_setting('pet_animal_store_slider_title',array(
       'default' => 'true',
       'sanitize_callback'	=> 'pet_animal_store_sanitize_checkbox'
	));
	$wp_customize->add_control('pet_animal_store_slider_title',array(
	   'type' => 'checkbox',
	   'label' => __('Show / Hide slider Title','pet-animal-store'),
	   'section' => 'pet_animal_store_slidersettings',
	));

	$wp_customize->add_setting('pet_animal_store_slider_content',array(
       'default' => 'true',
       'sanitize_callback'	=> 'pet_animal_store_sanitize_checkbox'
	));
	$wp_customize->add_control('pet_animal_store_slider_content',array(
	   'type' => 'checkbox',
	   'label' => __('Show / Hide slider Content','pet-animal-store'),
	   'section' => 'pet_animal_store_slidersettings',
	));

	$wp_customize->add_setting('pet_animal_store_slider_button',array(
       'default' => 'true',
       'sanitize_callback'	=> 'pet_animal_store_sanitize_checkbox'
	));
	$wp_customize->add_control('pet_animal_store_slider_button',array(
	   'type' => 'checkbox',
	   'label' => __('Show / Hide slider Button','pet-animal-store'),
	   'section' => 'pet_animal_store_slidersettings',
	));

    //Slider excerpt
	$wp_customize->add_setting( 'pet_animal_store_slider_excerpt', array(
		'default'              => 25,
		'sanitize_callback'    => 'pet_animal_store_sanitize_float',
	) );
	$wp_customize->add_control( 'pet_animal_store_slider_excerpt', array(
		'label' => esc_html__( 'Slider Excerpt length','pet-animal-store' ),
		'section'     => 'pet_animal_store_slidersettings',
		'type'        => 'number',
		'settings'    => 'pet_animal_store_slider_excerpt',
		'input_attrs' => array(
			'step' => 1,
			'min' => 0,
			'max' => 50,
		),
	) );

	$wp_customize->add_setting( 'pet_animal_store_slider_button_text', array(
		'default'   => __('READ MORE','pet-animal-store' ),
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'pet_animal_store_slider_button_text', array(
		'label' => esc_html__( 'Slider Button text','pet-animal-store' ),
		'section'     => 'pet_animal_store_slidersettings',
		'type'        => 'text',
		'settings'    => 'pet_animal_store_slider_button_text'
	) );

	//Opacity
	$wp_customize->add_setting('pet_animal_store_slider_opacity',array(
        'default'   => 0.7,
        'sanitize_callback' => 'pet_animal_store_sanitize_choices'
	));
	$wp_customize->add_control( 'pet_animal_store_slider_opacity', array(
		'label'       => esc_html__( 'Slider Image Opacity','pet-animal-store' ),
		'section'    => 'pet_animal_store_slidersettings',
		'type'        => 'select',
		'settings'   => 'pet_animal_store_slider_opacity',
		'choices' => array(
	      '0' =>  esc_attr('0','pet-animal-store'),
	      '0.1' =>  esc_attr('0.1','pet-animal-store'),
	      '0.2' =>  esc_attr('0.2','pet-animal-store'),
	      '0.3' =>  esc_attr('0.3','pet-animal-store'),
	      '0.4' =>  esc_attr('0.4','pet-animal-store'),
	      '0.5' =>  esc_attr('0.5','pet-animal-store'),
	      '0.6' =>  esc_attr('0.6','pet-animal-store'),
	      '0.7' =>  esc_attr('0.7','pet-animal-store'),
	      '0.8' =>  esc_attr('0.8','pet-animal-store'),
	      '0.9' =>  esc_attr('0.9','pet-animal-store')
	  ),
	));

	//content Alignment
    $wp_customize->add_setting('pet_animal_store_slider_content_option',array(
    	'default' => 'Left',
        'sanitize_callback' => 'pet_animal_store_sanitize_choices'
	));
	$wp_customize->add_control('pet_animal_store_slider_content_option',array(
        'type' => 'select',
        'label' => __('Slider Content Alignment','pet-animal-store'),
        'section' => 'pet_animal_store_slidersettings',
        'choices' => array(
            'Center' => __('Center','pet-animal-store'),
            'Left' => __('Left','pet-animal-store'),
            'Right' => __('Right','pet-animal-store'),
        ),
	) );

	$wp_customize->add_setting('pet_animal_store_content_spacing',array(
		'sanitize_callback'	=> 'esc_html'
	));
	$wp_customize->add_control('pet_animal_store_content_spacing',array(
		'label'	=> esc_html__('Slider Content Spacing','pet-animal-store'),
		'section'=> 'pet_animal_store_slidersettings',
	));

	$wp_customize->add_setting( 'pet_animal_store_slider_top_spacing', array(
		'default'  => '',
		'sanitize_callback'	=> 'pet_animal_store_sanitize_float'
	) );
	$wp_customize->add_control( 'pet_animal_store_slider_top_spacing', array(
		'label' => esc_html__( 'Top','pet-animal-store' ),
		'section' => 'pet_animal_store_slidersettings',
		'type'  => 'number',
		'input_attrs' => array(
			'step' => 1,
			'min' => 0,
			'max' => 100,
		),
	) );

	$wp_customize->add_setting( 'pet_animal_store_slider_bottom_spacing', array(
		'default'  => '',
		'sanitize_callback'	=> 'pet_animal_store_sanitize_float'
	) );
	$wp_customize->add_control( 'pet_animal_store_slider_bottom_spacing', array(
		'label' => esc_html__( 'Bottom','pet-animal-store' ),
		'section' => 'pet_animal_store_slidersettings',
		'type'  => 'number',
		'input_attrs' => array(
			'step' => 1,
			'min' => 0,
			'max' => 100,
		),
	) );

	$wp_customize->add_setting( 'pet_animal_store_slider_left_spacing', array(
		'default'  => '',
		'sanitize_callback'	=> 'pet_animal_store_sanitize_float'
	) );
	$wp_customize->add_control( 'pet_animal_store_slider_left_spacing', array(
		'label' => esc_html__( 'Left','pet-animal-store'),
		'section' => 'pet_animal_store_slidersettings',
		'type'  => 'number',
		'input_attrs' => array(
			'step' => 1,
			'min' => 0,
			'max' => 100,
		),
	) );

	$wp_customize->add_setting( 'pet_animal_store_slider_right_spacing', array(
		'default'  => '',
		'sanitize_callback'	=> 'pet_animal_store_sanitize_float'
	) );
	$wp_customize->add_control( 'pet_animal_store_slider_right_spacing', array(
		'label' => esc_html__('Right','pet-animal-store'),
		'section' => 'pet_animal_store_slidersettings',
		'type'  => 'number',
		'input_attrs' => array(
			'step' => 1,
			'min' => 0,
			'max' => 100,
		),
	) );

	$wp_customize->add_setting( 'pet_animal_store_slider_speed', array(
		'default'  => 3000,
		'sanitize_callback'	=> 'pet_animal_store_sanitize_float'
	) );
	$wp_customize->add_control( 'pet_animal_store_slider_speed', array(
		'label' => esc_html__('Slider Speed','pet-animal-store'),
		'section' => 'pet_animal_store_slidersettings',
		'type'  => 'number',
		'input_attrs' => array(
			'step' => 500,
			'min' => 500,
			'max' => 5000,
		),
	) );	

	$wp_customize->add_setting( 'pet_animal_store_slider_height', array(
		'default'  => ' ',
		'sanitize_callback'	=> 'pet_animal_store_sanitize_float'
	) );
	$wp_customize->add_control( 'pet_animal_store_slider_height', array(
		'label' => esc_html__('Slider Height','pet-animal-store'),
		'section' => 'pet_animal_store_slidersettings',
		'type'  => 'number',
		'input_attrs' => array(
			'step' => 5,
			'min' => 500,
			'max' => 1000,
		),
	) );


	//Our Product
	$wp_customize->add_section('pet_animal_store_product',array(
		'title'	=> __('Featured Products','pet-animal-store'),
		'description'=> __('This section will appear below the slider.','pet-animal-store'),
		'panel' => 'pet_animal_store_panel_id',
	));

	$wp_customize->selective_refresh->add_partial(
		'pet_animal_store_sec1_title',
		array(
			'selector'        => '#our-products strong',
			'render_callback' => 'pet_animal_store_customize_partial_pet_animal_store_sec1_title',
		)
	);

	$wp_customize->add_setting('pet_animal_store_sec1_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('pet_animal_store_sec1_title',array(
		'label'	=> __('Section Title','pet-animal-store'),
		'section'=> 'pet_animal_store_product',
		'setting'=> 'pet_animal_store_sec1_title',
		'type'=> 'text'
	));	
	
	$wp_customize->add_setting( 'pet_animal_store_product_page', array(
		'default'           => '',
		'sanitize_callback' => 'pet_animal_store_sanitize_dropdown_pages'
	));
	$wp_customize->add_control( 'pet_animal_store_product_page', array(
		'label'    => __( 'Select Product Page', 'pet-animal-store' ),
		'section'  => 'pet_animal_store_product',
		'type'     => 'dropdown-pages'
	));

	//Blog Post
	$wp_customize->add_section('pet_animal_store_blog_post',array(
		'title'	=> __('Post Settings','pet-animal-store'),
		'panel' => 'pet_animal_store_panel_id',
	));	

	$wp_customize->add_setting('pet_animal_store_date_hide',array(
       'default' => 'false',
       'sanitize_callback'	=> 'pet_animal_store_sanitize_checkbox'
    ));
    $wp_customize->add_control('pet_animal_store_date_hide',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Post Date','pet-animal-store'),
       'section' => 'pet_animal_store_blog_post'
    ));

    $wp_customize->add_setting('pet_animal_store_author_hide',array(
       'default' => 'false',
       'sanitize_callback'	=> 'pet_animal_store_sanitize_checkbox'
    ));
    $wp_customize->add_control('pet_animal_store_author_hide',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Post Author','pet-animal-store'),
       'section' => 'pet_animal_store_blog_post'
    ));

    $wp_customize->add_setting('pet_animal_store_comment_hide',array(
       'default' => 'false',
       'sanitize_callback'	=> 'pet_animal_store_sanitize_checkbox'
    ));
    $wp_customize->add_control('pet_animal_store_comment_hide',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Post Comments','pet-animal-store'),
       'section' => 'pet_animal_store_blog_post'
    ));

    $wp_customize->add_setting('pet_animal_store_feature_image_hide',array(
       'default' => true,
       'sanitize_callback'	=> 'pet_animal_store_sanitize_checkbox'
    ));
    $wp_customize->add_control('pet_animal_store_feature_image_hide',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Featured Image','pet-animal-store'),
       'section' => 'pet_animal_store_blog_post'
    ));

    $wp_customize->add_setting( 'pet_animal_store_featured_image_border_radius', array(
		'default' => 0,
		'sanitize_callback'	=> 'pet_animal_store_sanitize_float'
	) );
	$wp_customize->add_control( 'pet_animal_store_featured_image_border_radius', array(
		'label' => __( 'Featured image border radius','pet-animal-store' ),
		'section' => 'pet_animal_store_blog_post',
		'type'  => 'number',
		'input_attrs' => array(
			'step' => 1,
			'min'  => 0,
			'max'  => 50,
		),
	) );

    $wp_customize->add_setting( 'pet_animal_store_featured_image_box_shadow', array(
		'default' => 0,
		'sanitize_callback'	=> 'pet_animal_store_sanitize_float'
	) );
	$wp_customize->add_control( 'pet_animal_store_featured_image_box_shadow', array(
		'label' => __( 'Featured image box shadow','pet-animal-store' ),
		'section' => 'pet_animal_store_blog_post',
		'type'  => 'number',
		'input_attrs' => array(
			'step' => 1,
			'min'  => 0,
			'max'  => 50,
		),
	) );

    $wp_customize->add_setting('pet_animal_store_post_content',array(
    	'default' => 'Excerpt Content',
        'sanitize_callback' => 'pet_animal_store_sanitize_choices'
	));
	$wp_customize->add_control('pet_animal_store_post_content',array(
        'type' => 'radio',
        'label' => __('Post Content Type','pet-animal-store'),
        'section' => 'pet_animal_store_blog_post',
        'choices' => array(
            'No Content' => __('No Content','pet-animal-store'),
            'Full Content' => __('Full Content','pet-animal-store'),
            'Excerpt Content' => __('Excerpt Content','pet-animal-store'),
        ),
	) );

    $wp_customize->add_setting( 'pet_animal_store_post_excerpt_length', array(
		'default'              => 20,
		'sanitize_callback'	=> 'pet_animal_store_sanitize_float'
	) );
	$wp_customize->add_control( 'pet_animal_store_post_excerpt_length', array(
		'label' => esc_html__( 'Post Excerpt Length','pet-animal-store' ),
		'section'  => 'pet_animal_store_blog_post',
		'type'  => 'number',
		'settings' => 'pet_animal_store_post_excerpt_length',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'pet_animal_store_button_excerpt_suffix', array(
		'default'   => '[...]',
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'pet_animal_store_button_excerpt_suffix', array(
		'label'       => esc_html__( 'Excerpt Suffix','pet-animal-store' ),
		'section'     => 'pet_animal_store_blog_post',
		'type'        => 'text',
		'settings' => 'pet_animal_store_button_excerpt_suffix'
	) );

	$wp_customize->add_setting( 'pet_animal_store_post_button_text', array(
		'default'   => __('Read More','pet-animal-store' ),
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'pet_animal_store_post_button_text', array(
		'label' => esc_html__('Post Button Text','pet-animal-store' ),
		'section'     => 'pet_animal_store_blog_post',
		'type'        => 'text',
		'settings'    => 'pet_animal_store_post_button_text'
	) );

	$wp_customize->add_setting('pet_animal_store_top_button_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'pet_animal_store_sanitize_float'
	));
	$wp_customize->add_control('pet_animal_store_top_button_padding',array(
		'label'	=> __('Top Bottom Button Padding','pet-animal-store'),
		'input_attrs' => array(
            'step' => 1,
			'min'  => 0,
			'max'  => 50,
        ),
		'section'=> 'pet_animal_store_blog_post',
		'type'=> 'number',
	));

	$wp_customize->add_setting('pet_animal_store_left_button_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'pet_animal_store_sanitize_float'
	));
	$wp_customize->add_control('pet_animal_store_left_button_padding',array(
		'label'	=> __('Left Right Button Padding','pet-animal-store'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'section'=> 'pet_animal_store_blog_post',
		'type'=> 'number',
	));

	$wp_customize->add_setting( 'pet_animal_store_button_border_radius', array(
		'default'=> '0',
		'sanitize_callback'	=> 'pet_animal_store_sanitize_float'
	) );
	$wp_customize->add_control('pet_animal_store_button_border_radius', array(
        'label'  => __('Button Border Radius','pet-animal-store'),
        'type'=> 'number',
        'section'  => 'pet_animal_store_blog_post',
        'input_attrs' => array(
        	'step' => 1,
            'min' => 0,
            'max' => 50,
        ),
    ));

    $wp_customize->add_setting('pet_animal_store_navigation_hide',array(
       'default' => true,
       'sanitize_callback'	=> 'pet_animal_store_sanitize_checkbox'
    ));
    $wp_customize->add_control('pet_animal_store_navigation_hide',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Post Navigation','pet-animal-store'),
       'section' => 'pet_animal_store_blog_post'
    ));

    $wp_customize->add_setting( 'pet_animal_store_post_navigation_type', array(
        'default'			=> 'numbers',
        'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'pet_animal_store_post_navigation_type', array(
        'section' => 'pet_animal_store_blog_post',
        'type' => 'select',
        'label' => __( 'Post Navigation Type', 'pet-animal-store' ),
        'choices'		=> array(
            'numbers'  => __( 'Number', 'pet-animal-store' ),
            'next-prev' => __( 'Next/Prev Button', 'pet-animal-store' ),
    )));

    //Single Post Settings
	$wp_customize->add_section('pet_animal_store_single_post',array(
		'title'	=> __('Single Post Settings','pet-animal-store'),
		'panel' => 'pet_animal_store_panel_id',
	));	

	$wp_customize->add_setting('pet_animal_store_feature_image',array(
       'default' => true,
       'sanitize_callback'	=> 'pet_animal_store_sanitize_checkbox'
    ));
    $wp_customize->add_control('pet_animal_store_feature_image',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Feature Image','pet-animal-store'),
       'section' => 'pet_animal_store_single_post'
    ));

    $wp_customize->add_setting('pet_animal_store_tags',array(
       'default' => true,
       'sanitize_callback'	=> 'pet_animal_store_sanitize_checkbox'
    ));
    $wp_customize->add_control('pet_animal_store_tags',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Tags','pet-animal-store'),
       'section' => 'pet_animal_store_single_post'
    ));

    $wp_customize->add_setting('pet_animal_store_comment',array(
       'default' => true,
       'sanitize_callback'	=> 'pet_animal_store_sanitize_checkbox'
    ));
    $wp_customize->add_control('pet_animal_store_comment',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Comment','pet-animal-store'),
       'section' => 'pet_animal_store_single_post'
    ));

    $wp_customize->add_setting( 'pet_animal_store_comment_width', array(
		'default' => 100,
		'sanitize_callback'	=> 'pet_animal_store_sanitize_float'
	) );
	$wp_customize->add_control( 'pet_animal_store_comment_width', array(
		'label' => __( 'Comment Textarea Width', 'pet-animal-store'),
		'section' => 'pet_animal_store_single_post',
		'type' => 'number',
		'settings' => 'pet_animal_store_comment_width',
		'input_attrs' => array(
			'step' => 1,
			'min' => 0,
			'max' => 100,
		),
	) );

    $wp_customize->add_setting('pet_animal_store_comment_title',array(
       'default' => __('Leave a Reply','pet-animal-store'),
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('pet_animal_store_comment_title',array(
       'type' => 'text',
       'label' => __('Comment form Title','pet-animal-store'),
       'section' => 'pet_animal_store_single_post'
    ));

    $wp_customize->add_setting('pet_animal_store_comment_submit_text',array(
       'default' => __('Post Comment','pet-animal-store'),
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('pet_animal_store_comment_submit_text',array(
       'type' => 'text',
       'label' => __('Comment Button Text','pet-animal-store'),
       'section' => 'pet_animal_store_single_post'
    ));

    $wp_customize->add_setting('pet_animal_store_nav_links',array(
       'default' => true,
       'sanitize_callback'	=> 'pet_animal_store_sanitize_checkbox'
    ));
    $wp_customize->add_control('pet_animal_store_nav_links',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Nav Links','pet-animal-store'),
       'section' => 'pet_animal_store_single_post'
    ));

    $wp_customize->add_setting('pet_animal_store_prev_text',array(
       'default' => '',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('pet_animal_store_prev_text',array(
       'type' => 'text',
       'label' => __('Previous Navigation Text','pet-animal-store'),
       'section' => 'pet_animal_store_single_post'
    ));

    $wp_customize->add_setting('pet_animal_store_next_text',array(
       'default' => '',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('pet_animal_store_next_text',array(
       'type' => 'text',
       'label' => __('Next Navigation Text','pet-animal-store'),
       'section' => 'pet_animal_store_single_post'
    ));

    $wp_customize->add_setting('pet_animal_store_related_posts',array(
       'default' => true,
       'sanitize_callback'	=> 'pet_animal_store_sanitize_checkbox'
    ));
    $wp_customize->add_control('pet_animal_store_related_posts',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Related Posts','pet-animal-store'),
       'section' => 'pet_animal_store_single_post'
    ));

    $wp_customize->add_setting('pet_animal_store_related_posts_title',array(
       'default' => '',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('pet_animal_store_related_posts_title',array(
       'type' => 'text',
       'label' => __('Related Posts Title','pet-animal-store'),
       'section' => 'pet_animal_store_single_post'
    ));

    $wp_customize->add_setting( 'pet_animal_store_related_post_count', array(
		'default' => 3,
		'sanitize_callback'	=> 'pet_animal_store_sanitize_float'
	) );
	$wp_customize->add_control( 'pet_animal_store_related_post_count', array(
		'label' => esc_html__( 'Related Posts Count','pet-animal-store' ),
		'section' => 'pet_animal_store_single_post',
		'type' => 'number',
		'settings' => 'pet_animal_store_related_post_count',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 6,
		),
	) );

    $wp_customize->add_setting( 'pet_animal_store_post_order', array(
        'default' => 'categories',
        'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'pet_animal_store_post_order', array(
        'section' => 'pet_animal_store_single_post',
        'type' => 'radio',
        'label' => __( 'Related Posts Order By', 'pet-animal-store' ),
        'choices' => array(
            'categories'  => __('Categories', 'pet-animal-store'),
            'tags' => __( 'Tags', 'pet-animal-store' ),
    )));

    //404 page settings
	$wp_customize->add_section('pet_animal_store_404_page',array(
		'title'	=> __('404 & No Result Page Settings','pet-animal-store'),
		'priority'	=> null,
		'panel' => 'pet_animal_store_panel_id',
	));

	$wp_customize->add_setting('pet_animal_store_404_title',array(
       'default' => '',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('pet_animal_store_404_title',array(
       'type' => 'text',
       'label' => __('404 Page Title','pet-animal-store'),
       'section' => 'pet_animal_store_404_page'
    ));

    $wp_customize->add_setting('pet_animal_store_404_text',array(
       'default' => '',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('pet_animal_store_404_text',array(
       'type' => 'text',
       'label' => __('404 Page Text','pet-animal-store'),
       'section' => 'pet_animal_store_404_page'
    ));

    $wp_customize->add_setting('pet_animal_store_404_button_text',array(
       'default' => '',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('pet_animal_store_404_button_text',array(
       'type' => 'text',
       'label' => __('404 Page Button Text','pet-animal-store'),
       'section' => 'pet_animal_store_404_page'
    ));

    $wp_customize->add_setting('pet_animal_store_no_result_title',array(
       'default' => '',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('pet_animal_store_no_result_title',array(
       'type' => 'text',
       'label' => __('No Result Page Title','pet-animal-store'),
       'section' => 'pet_animal_store_404_page'
    ));

    $wp_customize->add_setting('pet_animal_store_no_result_text',array(
       'default' => '',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('pet_animal_store_no_result_text',array(
       'type' => 'text',
       'label' => __('No Result Page Text','pet-animal-store'),
       'section' => 'pet_animal_store_404_page'
    ));

    $wp_customize->add_setting('pet_animal_store_show_search_form',array(
        'default' => true,
        'sanitize_callback'	=> 'pet_animal_store_sanitize_checkbox'
	));
	$wp_customize->add_control('pet_animal_store_show_search_form',array(
     	'type' => 'checkbox',
      	'label' => __('Show/Hide Search Form','pet-animal-store'),
      	'section' => 'pet_animal_store_404_page',
	));

	//Footer
	$wp_customize->add_section('pet_animal_store_footer_section',array(
		'title'	=> __('Footer Section','pet-animal-store'),
		'description'	=> '',
		'priority'	=> null,
		'panel' => 'pet_animal_store_panel_id',
	));

	$wp_customize->selective_refresh->add_partial(
		'pet_animal_store_show_back_to_top',
		array(
			'selector'        => '.scrollup',
			'render_callback' => 'pet_animal_store_customize_partial_pet_animal_store_show_back_to_top',
		)
	);

	$wp_customize->add_setting('pet_animal_store_show_back_to_top',array(
        'default' => 'true',
        'sanitize_callback'	=> 'pet_animal_store_sanitize_checkbox'
	));
	$wp_customize->add_control('pet_animal_store_show_back_to_top',array(
     	'type' => 'checkbox',
      	'label' => __('Show/Hide Back to Top Button','pet-animal-store'),
      	'section' => 'pet_animal_store_footer_section',
	));

	$wp_customize->add_setting('pet_animal_store_back_to_top_icon',array(
		'default'	=> 'fas fa-arrow-up',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Pet_Animal_Store_Icon_Changer(
        $wp_customize, 'pet_animal_store_back_to_top_icon',array(
		'label'	=> __('Back to Top Icon','pet-animal-store'),
		'section'	=> 'pet_animal_store_footer_section',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('pet_animal_store_back_to_top_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field',
	));	
	$wp_customize->add_control('pet_animal_store_back_to_top_text',array(
		'label'	=> __('Back to Top Button Text','pet-animal-store'),
		'section'	=> 'pet_animal_store_footer_section',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('pet_animal_store_back_to_top_alignment',array(
        'default' => 'Right',
        'sanitize_callback' => 'pet_animal_store_sanitize_choices'
	));
	$wp_customize->add_control('pet_animal_store_back_to_top_alignment',array(
        'type' => 'select',
        'label' => __('Back to Top Button Alignment','pet-animal-store'),
        'section' => 'pet_animal_store_footer_section',
        'choices' => array(
            'Left' => __('Left','pet-animal-store'),
            'Right' => __('Right','pet-animal-store'),
            'Center' => __('Center','pet-animal-store'),
        ),
	) );

	$wp_customize->add_setting('pet_animal_store_footer_background_color', array(
		'default'           => '#272727',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'pet_animal_store_footer_background_color', array(
		'label'    => __('Footer Background Color', 'pet-animal-store'),
		'section'  => 'pet_animal_store_footer_section',
	)));

	$wp_customize->add_setting('pet_animal_store_footer_background_img',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'pet_animal_store_footer_background_img',array(
        'label' => __('Footer Background Image','pet-animal-store'),
        'section' => 'pet_animal_store_footer_section'
	)));

	$wp_customize->add_setting('pet_animal_store_footer_widget_layout',array(
        'default'           => '4',
        'sanitize_callback' => 'pet_animal_store_sanitize_choices',
    ));
    $wp_customize->add_control('pet_animal_store_footer_widget_layout',array(
        'type'        => 'radio',
        'label'       => __('Footer widget layout', 'pet-animal-store'),
        'section'     => 'pet_animal_store_footer_section',
        'description' => __('Select the number of widget areas you want in the footer. After that, go to Appearance > Widgets and add your widgets.', 'pet-animal-store'),
        'choices' => array(
            '1'     => __('One', 'pet-animal-store'),
            '2'     => __('Two', 'pet-animal-store'),
            '3'     => __('Three', 'pet-animal-store'),
            '4'     => __('Four', 'pet-animal-store')
        ),
    ));

    $wp_customize->add_setting('pet_animal_store_copyright_alignment',array(
        'default' => 'Center',
        'sanitize_callback' => 'pet_animal_store_sanitize_choices'
	));
	$wp_customize->add_control('pet_animal_store_copyright_alignment',array(
        'type' => 'select',
        'label' => __('Copyright Alignment','pet-animal-store'),
        'section' => 'pet_animal_store_footer_section',
        'choices' => array(
            'Left' => __('Left','pet-animal-store'),
            'Right' => __('Right','pet-animal-store'),
            'Center' => __('Center','pet-animal-store'),
        ),
	) );

	$wp_customize->add_setting('pet_animal_store_copyright_fontsize',array(
		'default'	=> 16,
		'sanitize_callback'	=> 'pet_animal_store_sanitize_float',
	));	
	$wp_customize->add_control('pet_animal_store_copyright_fontsize',array(
		'label'	=> __('Copyright Font Size','pet-animal-store'),
		'section'	=> 'pet_animal_store_footer_section',
		'type'		=> 'number'
	));

	$wp_customize->add_setting('pet_animal_store_copyright_top_bottom_padding',array(
		'default'	=> 15,
		'sanitize_callback'	=> 'pet_animal_store_sanitize_float',
	));	
	$wp_customize->add_control('pet_animal_store_copyright_top_bottom_padding',array(
		'label'	=> __('Copyright Top Bottom Padding','pet-animal-store'),
		'section'	=> 'pet_animal_store_footer_section',
		'type'		=> 'number'
	));

    $wp_customize->selective_refresh->add_partial(
		'pet_animal_store_footer_copy',
		array(
			'selector'        => '#footer p',
			'render_callback' => 'pet_animal_store_customize_partial_pet_animal_store_footer_copy',
		)
	);
	
	$wp_customize->add_setting('pet_animal_store_footer_copy',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field',
	));
	$wp_customize->add_control('pet_animal_store_footer_copy',array(
		'label'	=> __('Copyright Text','pet-animal-store'),
		'section'	=> 'pet_animal_store_footer_section',
		'type'		=> 'text'
	));

	//Woocommerce Section
	$wp_customize->add_section( 'pet_animal_store_woocommerce_options' , array(
    	'title'      => __( 'Additional WooCommerce Options', 'pet-animal-store' ),
		'priority'   => null,
		'panel' => 'pet_animal_store_panel_id'
	) );

	// Product Columns
	$wp_customize->add_setting( 'pet_animal_store_products_per_row' , array(
		'default'           => '3',
		'transport'         => 'refresh',
		'sanitize_callback' => 'pet_animal_store_sanitize_choices',
	) );

	$wp_customize->add_control('pet_animal_store_products_per_row', array(
		'label' => __( 'Product per row', 'pet-animal-store' ),
		'section'  => 'pet_animal_store_woocommerce_options',
		'type'     => 'select',
		'choices'  => array(
			'2' => '2',
			'3' => '3',
			'4' => '4',
		),
	) );

	$wp_customize->add_setting('pet_animal_store_product_per_page',array(
		'default'	=> '9',
		'sanitize_callback'	=> 'pet_animal_store_sanitize_float'
	));	
	$wp_customize->add_control('pet_animal_store_product_per_page',array(
		'label'	=> __('Product per page','pet-animal-store'),
		'section'	=> 'pet_animal_store_woocommerce_options',
		'type'		=> 'number'
	));

	$wp_customize->add_setting('pet_animal_store_shop_sidebar',array(
       'default' => true,
       'sanitize_callback'	=> 'pet_animal_store_sanitize_checkbox'
    ));
    $wp_customize->add_control('pet_animal_store_shop_sidebar',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Shop page sidebar','pet-animal-store'),
       'section' => 'pet_animal_store_woocommerce_options',
    ));

    $wp_customize->add_setting('pet_animal_store_product_page_sidebar',array(
       'default' => true,
       'sanitize_callback'	=> 'pet_animal_store_sanitize_checkbox'
    ));
    $wp_customize->add_control('pet_animal_store_product_page_sidebar',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Product page sidebar','pet-animal-store'),
       'section' => 'pet_animal_store_woocommerce_options',
    ));

    $wp_customize->add_setting('pet_animal_store_related_product',array(
       'default' => true,
       'sanitize_callback'	=> 'pet_animal_store_sanitize_checkbox'
    ));
    $wp_customize->add_control('pet_animal_store_related_product',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Related product','pet-animal-store'),
       'section' => 'pet_animal_store_woocommerce_options',
    ));

	$wp_customize->add_setting( 'pet_animal_store_woocommerce_button_padding_top',array(
		'default' => 10,
		'sanitize_callback' => 'pet_animal_store_sanitize_float'
	));
	$wp_customize->add_control( 'pet_animal_store_woocommerce_button_padding_top',	array(
		'label' => esc_html__( 'Button Top Bottom Padding','pet-animal-store' ),
		'type' => 'number',
		'section' => 'pet_animal_store_woocommerce_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting( 'pet_animal_store_woocommerce_button_padding_right',array(
	 	'default' => 10,
	 	'sanitize_callback' => 'pet_animal_store_sanitize_float'
	));
	$wp_customize->add_control('pet_animal_store_woocommerce_button_padding_right',	array(
	 	'label' => esc_html__( 'Button Right Left Padding','pet-animal-store' ),
		'type' => 'number',
		'section' => 'pet_animal_store_woocommerce_options',
	 	'input_attrs' => array(
			'min' => 0,
			'max' => 50,
	 		'step' => 1,
		),
	));

	$wp_customize->add_setting( 'pet_animal_store_woocommerce_button_border_radius',array(
		'default' => 0,
		'sanitize_callback' => 'pet_animal_store_sanitize_float'
	));
	$wp_customize->add_control('pet_animal_store_woocommerce_button_border_radius',array(
		'label' => esc_html__( 'Button Border Radius','pet-animal-store' ),
		'type' => 'number',
		'section' => 'pet_animal_store_woocommerce_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

    $wp_customize->add_setting('pet_animal_store_woocommerce_product_border',array(
       'default' => false,
       'sanitize_callback'	=> 'pet_animal_store_sanitize_checkbox'
    ));
    $wp_customize->add_control('pet_animal_store_woocommerce_product_border',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable product border','pet-animal-store'),
       'section' => 'pet_animal_store_woocommerce_options',
    ));

	$wp_customize->add_setting( 'pet_animal_store_woocommerce_product_padding_top',array(
		'default' => 10,
		'sanitize_callback' => 'pet_animal_store_sanitize_float'
	));
	$wp_customize->add_control('pet_animal_store_woocommerce_product_padding_top', array(
		'label' => esc_html__( 'Product Top Bottom Padding','pet-animal-store' ),
		'type' => 'number',
		'section' => 'pet_animal_store_woocommerce_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting( 'pet_animal_store_woocommerce_product_padding_right',array(
		'default' => 10,
		'sanitize_callback' => 'pet_animal_store_sanitize_float'
	));
	$wp_customize->add_control('pet_animal_store_woocommerce_product_padding_right', array(
		'label' => esc_html__( 'Product Right Left Padding','pet-animal-store' ),
		'type' => 'number',
		'section' => 'pet_animal_store_woocommerce_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting( 'pet_animal_store_woocommerce_product_border_radius',array(
		'default' => 0,
		'sanitize_callback' => 'pet_animal_store_sanitize_float'
	));
	$wp_customize->add_control('pet_animal_store_woocommerce_product_border_radius',array(
		'label' => esc_html__( 'Product Border Radius','pet-animal-store' ),
		'type' => 'number',
		'section' => 'pet_animal_store_woocommerce_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting( 'pet_animal_store_woocommerce_product_box_shadow',array(
		'default' => 0,
		'sanitize_callback' => 'pet_animal_store_sanitize_float'
	));
	$wp_customize->add_control( 'pet_animal_store_woocommerce_product_box_shadow',array(
		'label' => esc_html__( 'Product Box Shadow','pet-animal-store' ),
		'type' => 'number',
		'section' => 'pet_animal_store_woocommerce_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting('pet_animal_store_sale_position',array(
        'default' => 'right',
        'sanitize_callback' => 'pet_animal_store_sanitize_choices'
	));
	$wp_customize->add_control('pet_animal_store_sale_position',array(
        'type' => 'select',
        'label' => __('Sale badge Position','pet-animal-store'),
        'section' => 'pet_animal_store_woocommerce_options',
        'choices' => array(
            'left' => __('Left','pet-animal-store'),
            'right' => __('Right','pet-animal-store'),
        ),
	) );

	$wp_customize->add_setting( 'pet_animal_store_woocommerce_sale_top_padding',array(
		'default' => 0,
		'sanitize_callback' => 'pet_animal_store_sanitize_float'
	));
	$wp_customize->add_control( 'pet_animal_store_woocommerce_sale_top_padding',	array(
		'label' => esc_html__( 'Sale Top Bottom Padding','pet-animal-store' ),
		'type' => 'number',
		'section' => 'pet_animal_store_woocommerce_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting( 'pet_animal_store_woocommerce_sale_left_padding',array(
	 	'default' => 0,
	 	'sanitize_callback' => 'pet_animal_store_sanitize_float'
	));
	$wp_customize->add_control('pet_animal_store_woocommerce_sale_left_padding',	array(
	 	'label' => esc_html__( 'Sale Right Left Padding','pet-animal-store' ),
		'type' => 'number',
		'section' => 'pet_animal_store_woocommerce_options',
	 	'input_attrs' => array(
			'min' => 0,
			'max' => 50,
	 		'step' => 1,
		),
	));

	$wp_customize->add_setting( 'pet_animal_store_woocommerce_sale_border_radius',array(
		'default' => 50,
		'sanitize_callback' => 'pet_animal_store_sanitize_float'
	));
	$wp_customize->add_control('pet_animal_store_woocommerce_sale_border_radius',array(
		'label' => esc_html__( 'Sale Border Radius','pet-animal-store' ),
		'type' => 'number',
		'section' => 'pet_animal_store_woocommerce_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));
}
add_action( 'customize_register', 'pet_animal_store_customize_register' );

// logo resize
load_template( trailingslashit( get_template_directory() ) . '/inc/logo/logo-width.php' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Pet_Animal_Store_Customizer_Upsell {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object $manager Customizer manager.
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . 'inc/animal-customize-theme-info-main.php' );
		load_template( trailingslashit( get_template_directory() ) . 'inc/animal-customize-upsell-section.php' );

		// Register custom section types.
		$manager->register_section_type( 'Pet_Animal_Store_Customizer_Theme_Info_Main' );

		// Main Documentation Link In Customizer Root.
		$manager->add_section(
			new Pet_Animal_Store_Customizer_Theme_Info_Main(
				$manager, 'pet-animal-store-theme-info', array(
					'theme_info_title' => __( 'Pet Animals', 'pet-animal-store' ),
					'label_url'        => esc_url( 'https://themescaliber.com/demo/doc/free-tc-pet-shop/' ),
					'label_text'       => __( 'Documentation', 'pet-animal-store' ),
				)
			)
		);

		// Frontpage Sections Upsell.
		$manager->add_section(
			new Pet_Animal_Store_Customizer_Upsell_Section(
				$manager, 'pet-animal-store-upsell-frontpage-sections', array(
					'panel'       => 'pet_animal_store_panel_id',
					'priority'    => 500,
					'options'     => array(
						esc_html__( 'Services Section', 'pet-animal-store' ),
						esc_html__( 'Gallery section', 'pet-animal-store' ),
						esc_html__( 'Doctors Team section', 'pet-animal-store' ),
						esc_html__( 'Why Choose us Section', 'pet-animal-store' ),
						esc_html__( 'Testimonial section', 'pet-animal-store' ),
						esc_html__( 'Blog section', 'pet-animal-store' ),
					),
					'button_url'  => esc_url( 'https://www.themescaliber.com/themes/premium-animal-pet-wordpress-theme' ),
					'button_text' => esc_html__( 'View PRO version', 'pet-animal-store' ),
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'pet-animal-store-upsell-js', trailingslashit( esc_url(get_template_directory_uri()) ) . 'inc/js/animal-customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'pet-animal-store-theme-info-style', trailingslashit( esc_url(get_template_directory_uri()) ) . 'inc/css/animal-style.css' );
	}
}

Pet_Animal_Store_Customizer_Upsell::get_instance();