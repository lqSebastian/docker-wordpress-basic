<?php function rambo_client_section_customizer( $wp_customize ) {
	
	// creating control for adding message to the top of the section
	class rambo_Customize_client_upgrade extends WP_Customize_Control {
		public function render_content() { ?>
		
		<h3><?php _e('Want to show your clients? ','rambo'); ?><a href="<?php echo esc_url( 'http://www.webriti.com/rambo' ); ?>" target="_blank">
			<?php _e('Upgrade to Pro','rambo'); ?> </a></h3>
		<?php
		}
	}
	
	
/* Client settings */
	$wp_customize->add_section( 'client_settings' , array(
		'title'      => __('Client Settings', 'rambo'),
		'panel'  => 'section_settings',
		'priority'       => 520,
	) );
			
			
			// Upgrade to Pro Label
			$wp_customize->add_setting( 'rambo_pro_theme_options[upgrade_to_pro_message]', array(
			'default'				=> false,
			'capability'			=> 'edit_theme_options',
			'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_control(
				new rambo_Customize_client_upgrade(
				$wp_customize,
				'rambo_pro_theme_options[upgrade_to_pro_message]',
					array(
						'label'					=> __('Upgrade to Pro','rambo'),
						'section'				=> 'client_settings',
						'settings'				=> 'rambo_pro_theme_options[upgrade_to_pro_message]',
					)
				)
			);
			
			// Client hide
			$wp_customize->add_setting( 'rambo_pro_theme_options[homepage_client_hide]' , array(
			'default' => true,
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			) );
			$wp_customize->add_control('rambo_pro_theme_options[homepage_client_hide]' , array(
			'label'          => __( 'Enable Home Client section', 'rambo' ),
			'section'        => 'client_settings',
			'type'           => 'checkbox'
			) );
			
			//Homepage Client Title
			$wp_customize->add_setting( 'rambo_pro_theme_options[homepage_client_title]' , array(
			'type'=>'option',
			'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			'default' => __("Our Client","rambo"),
			
			) );
			$wp_customize->add_control('rambo_pro_theme_options[homepage_client_title]' , array(
			'label'          => __( 'Title', 'rambo' ),
			'section'        => 'client_settings',
			'type'           => 'text','input_attrs' => array( 'disabled' =>'disabled' )
			) );
			
			// Homepage Client Description
			$wp_customize->add_setting( 'rambo_pro_theme_options[homepage_client_contents]' , array(
			'default' => __("Check out our client","rambo"),
			'type'=>'option','sanitize_callback'	=> 'wp_filter_nohtml_kses',
			) );
			$wp_customize->add_control('rambo_pro_theme_options[homepage_client_contents]' , array(
			'label'          => __('Description', 'rambo' ),
			'section'        => 'client_settings',
			'type'           => 'textarea','input_attrs' => array( 'disabled' =>'disabled' )
			) );
			
			
			if ( class_exists( 'Rambo_Repeater' ) ) {
			$wp_customize->add_setting(
				'rambo_pro_theme_options[rambo_clients_content]', array(
				'type'=> 'option',
				'sanitize_callback'	=> 'wp_filter_nohtml_kses',
				)
			);

			$wp_customize->add_control(
				new Rambo_Repeater(
					$wp_customize, 'rambo_pro_theme_options[rambo_clients_content]', array(
						'label'                            => esc_html__( 'Clients', 'rambo' ),
						'section'                          => 'client_settings',
						'add_field_label'                  => esc_html__( 'Add new client', 'rambo' ),
						'item_name'                        => esc_html__( 'Client', 'rambo' ),
						'customizer_repeater_image_control' => true,
						'customizer_repeater_link_control' => true,
						'customizer_repeater_checkbox_control' => true,
					)
				)
			);
			
			}
			
			$wp_customize->add_setting(
			'rambo_pro_theme_options[rambo_client_home_speed]',
			array(
				'default' => '2000',
				'type' => 'option',
				'sanitize_callback' => 'sanitize_text_field',
				
			)
			);

			$wp_customize->add_control(
			'rambo_pro_theme_options[rambo_client_home_speed]',
			array(
				'type' => 'select',
				'label' => __('Client strip slide speed','rambo'),
				'section' => 'client_settings',
				'choices' => array(1000=>1000,2000=>2000,3000=>3000,4000=>4000,5000=>5000),
				'input_attrs' => array( 'disabled' =>'disabled' ),
				));
			
}

add_action( 'customize_register', 'rambo_client_section_customizer' );

/**
 * Add selective refresh for Front page section section controls.
 */
function rambo_pro_register_home_client_section_partials( $wp_customize ){

$wp_customize->selective_refresh->add_partial( 'rambo_pro_theme_options[homepage_client_title]', array(
		'selector'            => '.home_client .featured_port_title h1',
		'settings'            => 'rambo_pro_theme_options[homepage_client_title]',
	
	) );
	
$wp_customize->selective_refresh->add_partial( 'rambo_pro_theme_options[homepage_client_contents]', array(
		'selector'            => '.home_client .featured_port_title p',
		'settings'            => 'rambo_pro_theme_options[homepage_client_contents]',
	
	) );

$wp_customize->selective_refresh->add_partial( 'rambo_pro_theme_options[rambo_clients_content]', array(
		'selector'            => '.home_client #our_client_product',
		'settings'            => 'rambo_pro_theme_options[rambo_clients_content]',
	
	) );

}

add_action( 'customize_register', 'rambo_pro_register_home_client_section_partials' );