<?php
function rambo_home_slider_customizer($wp_customize){
	
	$selective_refresh = isset( $wp_customize->selective_refresh ) ? true : false;
	
	/* Option list of all post */	
    $options_posts = array();
    $options_posts_obj = get_posts('posts_per_page=-1');
    $options_posts[''] = __( 'Choose Post','rambo' );
    foreach ( $options_posts_obj as $posts ) {
    	$options_posts[$posts->ID] = $posts->post_title;
    }
	
	
	$wp_customize->add_panel( 'section_settings', array(
		'priority'       => 126,
		'capability'     => 'edit_theme_options',
		'title'      => __('Homepage section settings', 'rambo'),
	) );
	
	
		
/* Header Section */
	$wp_customize->add_section( 'slider_section_settings', array(
		'capability'     => 'edit_theme_options',
		'priority'   => 514,
		'panel'  => 'section_settings',
		'title'      => __('Slider settings', 'rambo'),
	) );

			//Hide slider
			
			$wp_customize->add_setting(
			'rambo_pro_theme_options[home_banner_enabled]',
			array(
				'default' => true,
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
				'type' => 'option',
			)	
			);
			$wp_customize->add_control(
			'rambo_pro_theme_options[home_banner_enabled]',
			array(
				'label' => __('Enable home slider','rambo'),
				'section' => 'slider_section_settings',
				'type' => 'checkbox',
				'description' => __('Enable slider on front page.','rambo'),
			));
			
	$current_options = wp_parse_args(  get_option( 'rambo_pro_theme_options', array() ), theme_data_setup() );
	
	$current_options = get_option( 'rambo_pro_theme_options');
	$ImagePath = get_the_post_thumbnail_url(isset($current_options['slider_post']));
	 
	$slider_post = isset($current_options['slider_post'])? $ImagePath : WEBRITI_TEMPLATE_DIR_URI . '/images/slider.jpg';
		
		
		
		//Slider Setting
		$wp_customize->add_setting( 'rambo_pro_theme_options[slider_post]',array('default' => get_template_directory_uri().'/images/slider.jpg','sanitize_callback' => 'esc_url_raw','type' => 'option','sanitize_callback'	=> 'wp_filter_nohtml_kses',
		));
 
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'rambo_pro_theme_options[slider_post]',
				array(
					'type'        => 'upload',
					'label' => __('Image','rambo'),
					'section' => 'slider_section_settings',
					'settings' =>'rambo_pro_theme_options[slider_post]',
					
				)
			)
		);
		
		$slider_title = isset($current_options['slider_post'])?   get_the_title($current_options['slider_post']) : __('Responsive WP theme','rambo');
		
		//Slider Title
		$wp_customize->add_setting(
		'rambo_pro_theme_options[slider_title]', array(
			'default'        => $slider_title,
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'rambo_input_field_sanitize_text',
			'transport' => $selective_refresh ? 'postMessage' : 'refresh',
			'type' => 'option',
		));
		$wp_customize->add_control('rambo_pro_theme_options[slider_title]', array(
			'label'   => __('Title', 'rambo'),
			'section' => 'slider_section_settings',
			'type' => 'text',
		));
		
		$slider_text = isset($current_options['slider_post'])?   get_post_field('post_content', $current_options['slider_post']) : 'We are a group of passionate designers and developers who really love creating awesome WordPress themes & giving support.';
		
		//Slider sub title
		$wp_customize->add_setting(
		'rambo_pro_theme_options[slider_text]', 
			array(
			'default'        => $slider_text,
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'rambo_input_field_sanitize_text',
			'transport' => $selective_refresh ? 'postMessage' : 'refresh',
			'type' => 'option',
		));
		$wp_customize->add_control('rambo_pro_theme_options[slider_text]', array(
			'label'   => __('Description', 'rambo'),
			'section' => 'slider_section_settings',
			'type' => 'textarea',
		));
		
		
		
		//Slider read more button
		$wp_customize->add_setting(
		'rambo_pro_theme_options[slider_readmore_text]', 
			array(
			'default'        => __('Read more','rambo'),
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'rambo_input_field_sanitize_text',
			'type' => 'option',
		));
		$wp_customize->add_control('rambo_pro_theme_options[slider_readmore_text]', array(
			'label'   => __('Button Text', 'rambo'),
			'section' => 'slider_section_settings',
			'type' => 'text',
		));
		
		
		//Slider read more button link
		$wp_customize->add_setting(
		'rambo_pro_theme_options[readmore_text_link]', 
			array(
			'default'        => __('#','rambo'),
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'rambo_input_field_sanitize_text',
			'type' => 'option',
		));
		$wp_customize->add_control('rambo_pro_theme_options[readmore_text_link]', array(
			'label'   => __('Button Link', 'rambo'),
			'section' => 'slider_section_settings',
			'type' => 'text',
		));
		
		
		//Slider read more button target
		$wp_customize->add_setting(
		'rambo_pro_theme_options[readmore_target]', 
			array(
			'default'        => false,
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'rambo_input_field_sanitize_text',
			'type' => 'option',
		));
		$wp_customize->add_control('rambo_pro_theme_options[readmore_target]', array(
			'label'   => __('Open link in new tab', 'rambo'),
			'section' => 'slider_section_settings',
			'type' => 'checkbox',
		));
		
		
		
		
		
		//Upgrade to Pro
		class WP_slider_Customize_Control extends WP_Customize_Control {
		public $type = 'new_menu';
		/**
		* Render the control's content.
		*/
		public function render_content() {
		?>
		 <div class="pro-vesrion">
		 <P><?php _e('Want to add more Slides and use animation effect in slider? Then upgrade to Pro.','rambo');?></P>
		 </div>
		  <div class="pro-box">
		 <a href="<?php echo esc_url('http://webriti.com/rambo/');?>" class="service" id="review_pro" target="_blank"><?php _e('Upgrade to Pro','rambo' ); ?></a>
		 </div>
		<?php
		}
		}

		$wp_customize->add_setting(
			'Slider_pro',
			array(
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)	
		);
		$wp_customize->add_control( new WP_slider_Customize_Control( $wp_customize, 'Slider_pro', array(	
				'section' => 'slider_section_settings',
				'setting' => 'Slider_pro',
			))
		); 
		
		
		function rambo_input_field_sanitize_text( $input ) 
		{
		return wp_kses_post( force_balance_tags( $input ) );
		}
}
add_action( 'customize_register', 'rambo_home_slider_customizer' );

/**
 * Add selective refresh for service title section controls.
 */
function rambo_register_slider_section_partials( $wp_customize ){
	
	$wp_customize->selective_refresh->add_partial( 'rambo_pro_theme_options[slider_title]', array(
		'selector'            => '.main_slider .slider_con h2',
		'settings'            => 'rambo_pro_theme_options[slider_title]',
	
	) );
	
		$wp_customize->selective_refresh->add_partial( 'rambo_pro_theme_options[slider_text]', array(
		'selector'            => '.main_slider .slider_con h5',
		'settings'            => 'rambo_pro_theme_options[slider_text]',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'rambo_pro_theme_options[slider_readmore_text]', array(
		'selector'            => '.main_slider .slider_con a',
		'settings'            => 'rambo_pro_theme_options[slider_readmore_text]',
	
	) );
	
	
}
add_action( 'customize_register', 'rambo_register_slider_section_partials' );
?>