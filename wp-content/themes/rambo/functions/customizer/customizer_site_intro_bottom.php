<?php
function rambo_site_intro_bottom_customizer( $wp_customize ) {	
	
	class rambo_Customize_ctb_upgrade extends WP_Customize_Control {
		public function render_content() { ?>
		
		<h3><?php _e('Want to add CTA at the bottom? ','rambo'); ?><a href="<?php echo esc_url( 'http://www.webriti.com/rambo' ); ?>" target="_blank">
			<?php _e('Upgrade to Pro','rambo'); ?> </a></h3>
		<?php
		
		}
	}
	
	//Site Intro Section
	$wp_customize->add_section( 'site_intro_bottom_settings' , array(
	'title'      => __('Call to action bottom settings', 'rambo'),
	'panel'  => 'section_settings',
	'priority'   => 521,
	) );
	
	
		// Upgrade to Pro Label
	$wp_customize->add_setting( 'rambo_pro_theme_options[site_bottom_intro_message]', array(
	'default'				=> false,
	'capability'			=> 'edit_theme_options',
	'sanitize_callback'	=> 'wp_filter_nohtml_kses',
	));
	$wp_customize->add_control(
		new rambo_Customize_ctb_upgrade(
		$wp_customize,
		'rambo_pro_theme_options[team_upgrade_message]',
			array(
				'label'					=> __('Upgrade to Pro','rambo'),
				'section'				=> 'site_intro_bottom_settings',
				'settings'				=> 'rambo_pro_theme_options[site_bottom_intro_message]',
			)
		)
	);
		
		
	$wp_customize->add_setting(
    'rambo_pro_theme_options[site_bottom_intro_title]',
    array(
        'default' => __('Rambo is a clean and fully responsive Template.','rambo'),
		'capability'     => 'edit_theme_options',
		'type' => 'option',
		'sanitize_callback'	=> 'wp_filter_nohtml_kses',
		)
	);	
		

	$wp_customize->add_control('rambo_pro_theme_options[site_bottom_intro_title]',array(
    'label'   => __('Title','rambo'),
    'section' => 'site_intro_bottom_settings',
	 'type' => 'text', 'input_attrs' => array( 'disabled' =>'disabled' ))  );	
	 
	 $wp_customize->add_setting(
    'rambo_pro_theme_options[site_bottom_intro_des]',
    array(
        'default' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos excepturi vehicula sem ut volutpat. Ut non libero magna fusce condimentum eleifend enim a feugiat.',
		'capability'     => 'edit_theme_options',
		'type' => 'option',
		'sanitize_callback'	=> 'wp_filter_nohtml_kses',
		)
	);	
		
	$wp_customize->add_control('rambo_pro_theme_options[site_bottom_intro_des]',array(
    'label'   => __('Description','rambo'),
    'section' => 'site_intro_bottom_settings',
	 'type' => 'text','input_attrs' => array( 'disabled' =>'disabled' ))  );	

	 
	$wp_customize ->add_setting (
	'rambo_pro_theme_options[site_intro_bottom_button_text]',
	array( 
	'default' => __('Purchase Now','rambo'),
	'capability'     => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'type' => 'option',
	) 
	);

	$wp_customize->add_control (
	'rambo_pro_theme_options[site_intro_bottom_button_text]',
	array (  
	'label' => __('Button Text','rambo'),
	'section' => 'site_intro_bottom_settings',
	'type' => 'text','input_attrs' => array( 'disabled' =>'disabled' ),
	) );
	
	$wp_customize ->add_setting (
	'rambo_pro_theme_options[site_intro_bottom_button_link]',
	array( 
	'default' => '#',
	'capability'     => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'type' => 'option',
	) );

	$wp_customize->add_control (
	'rambo_pro_theme_options[site_intro_bottom_button_link]',
	array (  
	'label' => __('Button Link','rambo'),
	'section' => 'site_intro_bottom_settings',
	'type' => 'text','input_attrs' => array( 'disabled' =>'disabled' ),
	) );

	$wp_customize->add_setting(
		'rambo_pro_theme_options[intro_bottom_button_target]',
		array('capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
		'default'=> true ,
		));

	$wp_customize->add_control(
		'rambo_pro_theme_options[intro_bottom_button_target]',
		array(
			'type' => 'checkbox',
			'label' => __('Open link in new tab','rambo'),
			'section' => 'site_intro_bottom_settings',
		)
	);
			
}
add_action( 'customize_register', 'rambo_site_intro_bottom_customizer' );

/**
 * Add selective refresh for Front page section section controls.
 */
function rambo_pro_register_home_callout_bottom_section_partials( $wp_customize ){

$wp_customize->selective_refresh->add_partial( 'rambo_pro_theme_options[site_bottom_intro_title]', array(
		'selector'            => '.callout_main_content .callout_now_content .span8 h1',
		'settings'            => 'rambo_pro_theme_options[site_bottom_intro_title]',
	
	) );
	
$wp_customize->selective_refresh->add_partial( 'rambo_pro_theme_options[site_bottom_intro_des]', array(
		'selector'            => '.callout_main_content .callout_now_content .span8 p',
		'settings'            => 'rambo_pro_theme_options[site_bottom_intro_des]',
	
	) );

$wp_customize->selective_refresh->add_partial( 'rambo_pro_theme_options[site_intro_bottom_button_text]', array(
		'selector'            => '.callout_main_content .callout_now_content .callout_now_btn',
		'settings'            => 'rambo_pro_theme_options[site_intro_bottom_button_text]',
	
	) );

}

add_action( 'customize_register', 'rambo_pro_register_home_callout_bottom_section_partials' );
?>