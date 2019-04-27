<?php
function rambo_template_customizer( $wp_customize ) {

//Template panel 
	$wp_customize->add_panel( 'rambo_template', array(
		'priority'       => 590,
		'capability'     => 'edit_theme_options',
		'title'      => __('Template settings', 'rambo'),
	) );
	
	
// add section to manage About us tPage
	$wp_customize->add_section(
        'about_us_setting',
        array(
            'title' => __('About us page settings','rambo'),
			'panel'  => 'rambo_template',
			'priority'   => 1,
			)
    );
	
	// Upgrade to pro
    class WP_Template_Settings_About_us_Customize_Control extends WP_Customize_Control {
        public $type = 'new_menu';
        /**
        * Render the control's content.
        */
        public function render_content() {
        ?>
		 <h3><?php _e('Want to use about us template settings available in the premium version of this theme?','rambo'); ?><a href="<?php echo esc_url( 'http://www.webriti.com/rambo' ); ?>" target="_blank">
			<?php _e('Upgrade to Pro','rambo'); ?> </a></h3>
        <?php
        }
    }
    
    
    $wp_customize->add_setting(
        'template_about_settings',
        array(
            'default' => '',
			'sanitize_callback' => 'sanitize_text_field',
    		'capability'     => 'edit_theme_options',
        )	
    );
    $wp_customize->add_control( new WP_Template_Settings_About_us_Customize_Control( $wp_customize, 'template_about_settings', array(
    		'section' => 'about_us_setting',
    		'setting' => 'template_about_settings',
        ))
    );
	
	


// About us page Temm heading one
	$wp_customize->add_setting(
		'rambo_pro_theme_options[about_page_title]',
		array('capability'  => 'edit_theme_options',
		'sanitize_callback' => 'rambo_template_sanitize_html',
		'default' => __('Who we are','rambo'), 
		'type' => 'option',
		));

	$wp_customize->add_control(
		'rambo_pro_theme_options[about_page_title]',
		array(
			'type' => 'text',
			'label' => __('About page title','rambo'),
			'section' => 'about_us_setting',
			'input_attrs' => array( 'disabled' =>'disabled' )
		)
	);
	
//About Team Section
$wp_customize->add_setting(
		'rambo_pro_theme_options[aboutus_our_team_enabled]',
		array('capability'  => 'edit_theme_options',
		'default' => true, 
		'sanitize_callback' => 'rambo_sanitize_checkbox',
		'type' => 'option',
		));

	$wp_customize->add_control(
		'rambo_pro_theme_options[aboutus_our_team_enabled]',
		array(
			'type' => 'checkbox',
			'label' => __('Enable our team section','rambo'),
			'section' => 'about_us_setting',
		)
	);	
//About Us Page Team Heading Two
	$wp_customize->add_setting(
		'rambo_pro_theme_options[our_team_title]',
		array('capability'  => 'edit_theme_options',
		'default' => 'Meet the Team', 
		'type' => 'option',
		'sanitize_callback' => 'rambo_template_sanitize_html',
		));

	$wp_customize->add_control(
		'rambo_pro_theme_options[our_team_title]',
		array(
			'type' => 'text',
			'label' => __('Our team title','rambo'),
			'section' => 'about_us_setting',
			'input_attrs' => array( 'disabled' =>'disabled' )
		)
	);

//Testimonial
$wp_customize->add_setting(
		'rambo_pro_theme_options[aboutus_testimonial_enabled]',
		array('capability'  => 'edit_theme_options',
		'default' => true,
		'sanitize_callback' => 'rambo_sanitize_checkbox',
		'type' => 'option',
		));

	$wp_customize->add_control(
		'rambo_pro_theme_options[aboutus_testimonial_enabled]',
		array(
			'type' => 'checkbox',
			'label' => __('Enable testimonial section','rambo'),
			'section' => 'about_us_setting',
		)
	);	
	
//Testimonial Title
	$wp_customize->add_setting(
		'rambo_pro_theme_options[testimonials_title]',
		array('capability'  => 'edit_theme_options',
		'sanitize_callback' => 'rambo_template_sanitize_html',
		'default' => 'Testimonials', 
		'type' => 'option',
		));

	$wp_customize->add_control(
		'rambo_pro_theme_options[testimonials_title]',
		array(
			'type' => 'text',
			'label' => __('Title','rambo'),
			'section' => 'about_us_setting',
			'input_attrs' => array( 'disabled' =>'disabled' )
		)
	);	
	
	if ( class_exists( 'Rambo_Repeater' ) ) {
			$wp_customize->add_setting(
				'rambo_pro_theme_options[rambo_testimonial_content]', array(
				'sanitize_callback' => 'rambo_repeater_sanitize',
				'type' => 'option',
				)
			);

			$wp_customize->add_control(
				new Rambo_Repeater(
					$wp_customize, 'rambo_pro_theme_options[rambo_testimonial_content]', array(
						'label'                            => esc_html__( 'Testimonial content', 'rambo' ),
						'section'                          => 'about_us_setting',
						'priority'                         => 10,
						'add_field_label'                  => esc_html__( 'Add new Testimonial', 'rambo' ),
						'item_name'                        => esc_html__( 'Testimonial', 'rambo' ),
						'customizer_repeater_image_control' => true,
						'customizer_repeater_title_control' => true,
						'customizer_repeater_text_control'  => true,
						'customizer_repeater_subtitle_control' => true,
						'customizer_repeater_link_control' => true,
						'customizer_repeater_checkbox_control' => true,
						
					)
				)
			);
	 
	 }	
	 
	$wp_customize->add_setting(
    'rambo_pro_theme_options[rambo_testimonial_speed]',
    array(
        'default' => '2000',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
    )
	);

	$wp_customize->add_control(
    'rambo_pro_theme_options[rambo_testimonial_speed]',
    array(
        'type' => 'select',
        'label' => __('Testiimonial slide speed','rambo'),
        'section' => 'about_us_setting',
		'choices' => array(1000=>1000,2000=>2000,3000=>3000,4000=>4000,5000=>5000),
		));


	//Client Strip enable
	$wp_customize->add_setting(
		'rambo_pro_theme_options[aboutus_client_strip_enabled]',
		array('capability'  => 'edit_theme_options',
		'default' => true,
		'sanitize_callback' => 'rambo_sanitize_checkbox',
		'type' => 'option',
		));

	$wp_customize->add_control(
		'rambo_pro_theme_options[aboutus_client_strip_enabled]',
		array(
			'type' => 'checkbox',
			'label' => __('Enable client strip','rambo'),
			'section' => 'about_us_setting',
		)
	);

	//Client Title
	$wp_customize->add_setting(
		'rambo_pro_theme_options[client_strip_title]',
		array('capability'  => 'edit_theme_options',
		'default' => 'Our Client',
		'sanitize_callback' => 'rambo_template_sanitize_html',
		'type' => 'option',
		));

	$wp_customize->add_control(
		'rambo_pro_theme_options[client_strip_title]',
		array(
			'type' => 'text',
			'label' => __('Client strip heading','rambo'),
			'section' => 'about_us_setting',
			'input_attrs' => array( 'disabled' =>'disabled' )
		)
	);

$wp_customize->add_setting(
    'rambo_pro_theme_options[rambo_client_strip_speed]',
    array(
        'default' => '2000',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
    )
	);

	$wp_customize->add_control(
    'rambo_pro_theme_options[rambo_client_strip_speed]',
    array(
        'type' => 'select',
        'label' => __('Client strip slide speed','rambo'),
        'section' => 'about_us_setting',
		'choices' => array(1000=>1000,2000=>2000,3000=>3000,4000=>4000,5000=>5000),
		));
	
	

// Conatct page setting
$wp_customize->add_section(
        'contact_page',
        array(
            'title' => __('Contact page settings','rambo'),
			'panel'  => 'rambo_template',
			'priority'   => 2,
			)
    );
	
	
	
	// Upgrade to pro
    class WP_Template_Settings_Contact_us_Customize_Control extends WP_Customize_Control {
        public $type = 'new_menu';
        /**
        * Render the control's content.
        */
        public function render_content() {
        ?>
		 <h3><?php _e('Want to use Contact us template settings available in the premium version of this theme?','rambo'); ?><a href="<?php echo esc_url( 'http://www.webriti.com/rambo' ); ?>" target="_blank">
			<?php _e('Upgrade to Pro','rambo'); ?> </a></h3>
        <?php
        }
    }
    
    
    $wp_customize->add_setting(
        'template_contact_settings',
        array(
            'default' => '',
			'sanitize_callback' => 'sanitize_text_field',
    		'capability'     => 'edit_theme_options',
        )	
    );
    $wp_customize->add_control( new WP_Template_Settings_Contact_us_Customize_Control( $wp_customize, 'template_contact_settings', array(
    		'section' => 'contact_page',
    		'setting' => 'template_contact_settings',
        ))
    );

	$wp_customize->add_setting(
		'rambo_pro_theme_options[contact_form_heading]',
		array('capability'  => 'edit_theme_options',
		'default' => 'Contact Form', 
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
		));

	$wp_customize->add_control(
		'rambo_pro_theme_options[contact_form_heading]',
		array(
			'type' => 'text',
			'label' => __('Contact form title','rambo'),
			'section' => 'contact_page',
			'input_attrs' => array( 'disabled' =>'disabled' )
		)
	);
	
	
		//Google Map Enable:
	$wp_customize->add_setting(
		'rambo_pro_theme_options[contact_google_map_enabled]',
		array('capability'  => 'edit_theme_options',
		'default' => true, 
		'sanitize_callback' => 'rambo_sanitize_checkbox',
		'type' => 'option',
		));

	$wp_customize->add_control(
		'rambo_pro_theme_options[contact_google_map_enabled]',
		array(
			'type' => 'checkbox',
			'label' => __('Enable Google Maps','rambo'),
			'section' => 'contact_page',
		)
	);
	
	//Google map URL
	
	$wp_customize->add_setting(
		'rambo_pro_theme_options[rambo_contact_google_map_shortcode]',
		array('capability'  => 'edit_theme_options',
		'default' => '',
		'sanitize_callback' => 'rambo_template_sanitize_html',		
		'type' => 'option',
		));

	$wp_customize->add_control(
		'rambo_pro_theme_options[rambo_contact_google_map_shortcode]',
		array(
			'type' => 'textarea',
			'label' => __('Google Maps URL','rambo'),
			'section' => 'contact_page',
			'input_attrs' => array( 'disabled' =>'disabled' )
		)
	);
	
	
	
	 //enable/disable blog post meta content
	$wp_customize->add_section( 'blog_template' , array(
		'title'      => __('Blog meta settings', 'rambo'),
		'panel'  => 'rambo_template',
		'priority'   => 4,
   	) );
	
	
	
	// Upgrade to pro
    class WP_Template_Settings_Blog_meta_Customize_Control extends WP_Customize_Control {
        public $type = 'new_menu';
        /**
        * Render the control's content.
        */
        public function render_content() {
        ?>
		 <h3><?php _e('Want to use Blog meta settings available in the premium version of this theme?','rambo'); ?><a href="<?php echo esc_url( 'http://www.webriti.com/rambo' ); ?>" target="_blank">
			<?php _e('Upgrade to Pro','rambo'); ?> </a></h3>
        <?php
        }
    }
    
    
    $wp_customize->add_setting(
        'template_blog_meta_settings',
        array(
            'default' => '',
			'sanitize_callback' => 'sanitize_text_field',
    		'capability'     => 'edit_theme_options',
        )	
    );
    $wp_customize->add_control( new WP_Template_Settings_Blog_meta_Customize_Control( $wp_customize, 'template_blog_meta_settings', array(
    		'section' => 'blog_template',
    		'setting' => 'template_blog_meta_settings',
        ))
    );
	
		$wp_customize->add_setting(
		'rambo_pro_theme_options[blog_meta_section_settings]',
		array(
			'default' => false,
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'rambo_sanitize_checkbox',
			'type' => 'option',
			
		)	
		);
		$wp_customize->add_control(
		'rambo_pro_theme_options[blog_meta_section_settings]',
		array(
			'label' => __('Hide post meta from blog pages.','rambo'),
			'section' => 'blog_template',
			'type' => 'checkbox',
		)
		);
	
		$wp_customize->add_setting(
		'rambo_pro_theme_options[archive_page_meta_section_settings]',
		array(
			'default' => 0,
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'rambo_sanitize_checkbox',
			'type' => 'option',
			
		)	
		);
		$wp_customize->add_control(
		'rambo_pro_theme_options[archive_page_meta_section_settings]',
		array(
			'label' => __('Hide post meta from archive pages.','rambo'),
			'section' => 'blog_template',
			'type' => 'checkbox',
		)
		);
		
		
	$wp_customize->add_section(
        'breadcrumbs_setting',
        array(
            'title' => __('Archive page title','rambo'),
            'description' =>'',
			'panel'  => 'rambo_template',
			'sanitize_callback' => 'sanitize_text_field',
			'priority' => 500,
			)
    );
	
	
	// Upgrade to pro
    class WP_Template_Settings_Archive_page_Customize_Control extends WP_Customize_Control {
        public $type = 'new_menu';
        /**
        * Render the control's content.
        */
        public function render_content() {
        ?>
		 <h3><?php _e('Want to use Archive page title settings available in the premium version of this theme?','rambo'); ?><a href="<?php echo esc_url( 'http://www.webriti.com/rambo' ); ?>" target="_blank">
			<?php _e('Upgrade to Pro','rambo'); ?> </a></h3>
        <?php
        }
    }
    
    
    $wp_customize->add_setting(
        'template_archive_page_settings',
        array(
            'default' => '',
			'sanitize_callback' => 'sanitize_text_field',
    		'capability'     => 'edit_theme_options',
        )	
    );
    $wp_customize->add_control( new WP_Template_Settings_Archive_page_Customize_Control( $wp_customize, 'template_archive_page_settings', array(
    		'section' => 'breadcrumbs_setting',
    		'setting' => 'template_archive_page_settings',
        ))
    );
	

		$wp_customize->add_setting(
		'rambo_pro_theme_options[archive_prefix]',
		array(
			'default' => __('Archive','rambo'),
			'type' => 'option',
			'sanitize_callback' => 'rambo_template_sanitize_html',
			'capability'     => 'edit_theme_options',
			)
		);	
		$wp_customize->add_control( 'rambo_pro_theme_options[archive_prefix]',array(
		'label'   => __('Archive','rambo'),
		'section' => 'breadcrumbs_setting',
		 'type' => 'text',
		 'input_attrs' => array( 'disabled' =>'disabled' )
		));	
		
		
		$wp_customize->add_setting(
			'rambo_pro_theme_options[category_prefix]',
			array('capability'  => 'edit_theme_options',
			'default' => 'Category', 
			'sanitize_callback' => 'rambo_template_sanitize_html',
			'type' => 'option',
			));

		$wp_customize->add_control(
			'rambo_pro_theme_options[category_prefix]',
			array(
				'type' => 'text',
				'label' => __('Category','rambo'),
				'section' => 'breadcrumbs_setting',
				'input_attrs' => array( 'disabled' =>'disabled' )
			)
		);
		
		$wp_customize->add_setting(
		'rambo_pro_theme_options[author_prefix]',
		array(
			'default' => __('All posts by','rambo'),
			'type' => 'option',
			'sanitize_callback' => 'rambo_template_sanitize_html',
			'capability'     => 'edit_theme_options',
			)
		);	
		$wp_customize->add_control( 'rambo_pro_theme_options[author_prefix]',array(
		'label'   => __('Author','rambo'),
		'section' => 'breadcrumbs_setting',
		 'type' => 'text',
		 'input_attrs' => array( 'disabled' =>'disabled' )
		));
		
		$wp_customize->add_setting(
		'rambo_pro_theme_options[tag_prefix]',
		array(
			'default' => __('Tag','rambo'),
			'type' => 'option',
			'sanitize_callback' => 'rambo_template_sanitize_html',
			'capability'     => 'edit_theme_options',
			)
		);	
		$wp_customize->add_control( 'rambo_pro_theme_options[tag_prefix]',array(
		'label'   => __('Tag','rambo'),
		'section' => 'breadcrumbs_setting',
		 'type' => 'text',
		 'input_attrs' => array( 'disabled' =>'disabled' )
		));
		
		
		$wp_customize->add_setting(
		'rambo_pro_theme_options[search_prefix]',
		array(
			'default' => __('Search results for','rambo'),
			'type' => 'option',
			'sanitize_callback' => 'rambo_template_sanitize_html',
			'capability'     => 'edit_theme_options',
			)
		);	
		$wp_customize->add_control( 'rambo_pro_theme_options[search_prefix]',array(
		'label'   => __('Search','rambo'),
		'section' => 'breadcrumbs_setting',
		 'type' => 'text',
		 'input_attrs' => array( 'disabled' =>'disabled' )
		));
		
		$wp_customize->add_setting(
		'rambo_pro_theme_options[404_prefix]',
		array(
			'default' => __('404','rambo'),
			'type' => 'option',
			'sanitize_callback' => 'rambo_template_sanitize_html',
			'capability'     => 'edit_theme_options',
			)
		);	
		$wp_customize->add_control( 'rambo_pro_theme_options[404_prefix]',array(
		'label'   => __('404','rambo'),
		'section' => 'breadcrumbs_setting',
		 'type' => 'text',
		 'input_attrs' => array( 'disabled' =>'disabled' )
		));
		
		$wp_customize->add_setting(
		'rambo_pro_theme_options[project_prefix]',
		array(
			'default' => __('Project categories','rambo'),
			'type' => 'option',
			'sanitize_callback' => 'rambo_template_sanitize_html',
			'capability'     => 'edit_theme_options',
			
			)
		);	
		$wp_customize->add_control( 'rambo_pro_theme_options[project_prefix]',array(
		'label'   => __('Project categories','rambo'),
		'section' => 'breadcrumbs_setting',
		 'type' => 'text',
		 'input_attrs' => array( 'disabled' =>'disabled' )
		));
	
		$wp_customize->add_setting(
		'rambo_pro_theme_options[shop_prefix]',
		array(
			'default' => __('Shop','rambo'),
			'type' => 'option',
			'sanitize_callback' => 'rambo_template_sanitize_html',
			'capability'     => 'edit_theme_options',
			)
		);	
		$wp_customize->add_control( 'rambo_pro_theme_options[shop_prefix]',array(
		'label'   => __('Shop','rambo'),
		'section' => 'breadcrumbs_setting',
		 'type' => 'text',
		 'input_attrs' => array( 'disabled' =>'disabled' )
		));
	
	
	function rambo_template_sanitize_html( $input ) {
		return force_balance_tags( $input );
	}
	
	
	//checkbox sanitization function
	function rambo_sanitize_checkbox( $input ){
		 
		//returns true if checkbox is checked
		return ( isset( $input ) ? true : false );
	}
	
	}
	add_action( 'customize_register', 'rambo_template_customizer' );
	?>
