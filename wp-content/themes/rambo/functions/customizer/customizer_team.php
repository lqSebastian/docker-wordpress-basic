<?php
function rambo_team_section_customizer( $wp_customize ) {
	class rambo_Customize_team_upgrade extends WP_Customize_Control {
		public function render_content() { ?>
		
		<h3><?php _e('Want to add team? ','rambo'); ?><a href="<?php echo esc_url( 'http://www.webriti.com/rambo' ); ?>" target="_blank">
			<?php _e('Upgrade to Pro','rambo'); ?> </a></h3>
		<?php
		}
	}
	
		//Site Intro Section
		$wp_customize->add_section( 'team_settings_section' , array(
		'title'      => __('Team settings', 'rambo'),
		'panel'  => 'section_settings',
		'priority'   => 518,
		) );
		
		
		// Upgrade to Pro Label
		$wp_customize->add_setting( 'team_upgrade_message', array(
		'default'				=> false,
		'capability'			=> 'edit_theme_options',
		'sanitize_callback'	=> 'wp_filter_nohtml_kses',
		));
		$wp_customize->add_control(
			new rambo_Customize_team_upgrade(
			$wp_customize,
			'team_upgrade_message',
				array(
					'label'					=> __('Upgrade to Pro','rambo'),
					'section'				=> 'team_settings_section',
					'settings'				=> 'team_upgrade_message',
				)
			)
		);
		
		
			// Add enable / disable team section heading
			$wp_customize->add_setting('rambo_pro_theme_options[team_section_enable]',array(
			'default' => false,
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'type' => 'option'
			) );
			
			$wp_customize->add_control('rambo_pro_theme_options[team_section_enable]',array(
			'label' => __('Hide team section','rambo'),
			'section' => 'team_settings_section',
			'type' => 'checkbox',
			'input_attrs' => array( 'disabled' =>'disabled' )
			) );
			
			
			/*$wp_customize->add_section( 'team_section' , array(
			'title'      => __('Section Header', 'rambo'),
			'panel'  => 'team_panel',
			'priority'   => 2,
			) );*/
			
			// Team title
			$wp_customize->add_setting('rambo_pro_theme_options[team_section_title]',array(
			'default' => __('Our Team','rambo'),
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'rambo_additional_one_sanitize_html',
			'type' => 'option'
			) );
			
			$wp_customize->add_control('rambo_pro_theme_options[team_section_title]',array(
			'label' => __('Title','rambo'),
			'section' => 'team_settings_section',
			'type' => 'text','input_attrs' => array('disabled' => 'disabled')
			) );
			
			// Team description
			$wp_customize->add_setting('rambo_pro_theme_options[team_section_desc]',array(
			'default' => 'Maecenas sit amet tincidunt elit. Pellentesque habitant morbi tristique senectus et netus et Nulla facilisi.',
			'sanitize_callback' => 'rambo_additional_one_sanitize_html',
			'type' => 'option',
			) );
			
			$wp_customize->add_control('rambo_pro_theme_options[team_section_desc]',array(
			'label' => __('Description','rambo'),
			'section' => 'team_settings_section',
			'type' => 'textarea','input_attrs' => array('disabled' => 'disabled')
			) );
			
			if ( class_exists( 'Rambo_Repeater' ) ) {
			$wp_customize->add_setting(
				'rambo_pro_theme_options[rambo_team_content]', array(
				'type'=> 'option',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
				)
			);

			$wp_customize->add_control(
				new Rambo_Repeater(
					$wp_customize, 'rambo_pro_theme_options[rambo_team_content]', array(
						'label'                            => esc_html__( 'Team content', 'rambo' ),
						'section'                          => 'team_settings_section',
						'priority'                         => 15,
						'add_field_label'                  => esc_html__( 'Add new Team Member', 'rambo' ),
						// 'add_field_attribute'			=> 'disabled="disabled"',	
						'item_name'                        => esc_html__( 'Team Member', 'rambo' ),
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
			
			
			function rambo_additional_one_sanitize_html( $input ) {
				return force_balance_tags( $input );
			}
			
			
}
add_action( 'customize_register', 'rambo_team_section_customizer' );

/**
 * Add selective refresh for Front page section section controls.
 */
function rambo_pro_register_home_team_section_partials( $wp_customize ){

$wp_customize->selective_refresh->add_partial( 'rambo_pro_theme_options[team_section_title]', array(
		'selector'            => '.additional_section_one .featured_port_title h1',
		'settings'            => 'rambo_pro_theme_options[team_section_title]',
	
	) );
	
$wp_customize->selective_refresh->add_partial( 'rambo_pro_theme_options[team_section_desc]', array(
		'selector'            => '.additional_section_one .featured_port_title p',
		'settings'            => 'rambo_pro_theme_options[team_section_desc]',
	
	) );

$wp_customize->selective_refresh->add_partial( 'rambo_pro_theme_options[rambo_team_content]', array(
		'selector'            => '.additional_section_one .additional-area-one',
		'settings'            => 'rambo_pro_theme_options[rambo_team_content]',
	
	) );
	
}

//add_action( 'customize_register', 'rambo_pro_register_home_team_section_partials' );
?>