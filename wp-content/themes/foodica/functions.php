<?php
/**
 * @package foodica
 */

/* Customizer */
require get_template_directory() . '/inc/customizer/bootstrap.php';
require_once( trailingslashit( get_template_directory() ) . '/inc/customizer/trt-customize-pro/upgrade-pro/class-customize.php' );

/**
 * Load Jetpack plugin enhancement file to display admin notices.
 */
require get_template_directory() . '/inc/jetpack/plugin-enhancements.php';


/**
 * Theme Setup
 */
function foodica_setup() {

	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 'assets/css/editor-style.css' ) );

	// Custom Background
	add_theme_support( 'custom-background' );

	// Custom Menus
	register_nav_menus( array(
		'secondary' => __( 'Top Menu', 'foodica' ),
        'primary' => __( 'Main Menu', 'foodica' ),
        'tertiary' => __( 'Footer Menu', 'foodica' )
	) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );

	// Featured Image
	add_theme_support( 'post-thumbnails' );
   	add_image_size( 'foodica-featured-posts-widget', 75, 50, true ); /* Recent Posts with Thumbnail widget */
    add_image_size( 'foodica-loop-sticky', 750, 500, true );                 /* Sticky Posts and Single Post large Image */
    add_image_size( 'foodica-loop-full', 1140, 500, true );                  /* Post with full-width layout */
    add_image_size( 'foodica-loop-portrait', 360, 540, true );               /* Regular post thumbnail (portrait ratio) */
    add_image_size( 'foodica-prevnext-small', 100, 100, true );              /* Previous/Next Post navigation */

	// Title Tag
	add_theme_support( 'title-tag' );

	// Feed Links
	add_theme_support( 'automatic-feed-links' );


    /*
     * JetPack Infinite Scroll
     */
    add_theme_support( 'infinite-scroll', array(
        'container' => 'recent-posts',
        'wrapper' => false,
        'footer' => false
    ) );


    /**
     * Add support for Jetpack's Featured Content
     */
     add_theme_support( 'featured-content', array(
         'featured_content_filter' => 'foodica_featured_content',
         'max_posts' => 5,
     ) );


    /**
     * Theme Logo
     */
    add_theme_support( 'custom-logo', array(
        'height'      => 150,
        'width'       => 650,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-description' ),
    ) );

	load_theme_textdomain( 'foodica', get_template_directory() . '/languages' );

    // Set the default content width.
    $GLOBALS['content_width'] = 750;

    /**
     * Gutenberg Wide Images
     */
    add_theme_support( 'align-wide' );

}
add_action( 'after_setup_theme', 'foodica_setup' );


/**
* Get Jetpack Featured Content posts
*/
function foodica_get_featured_content() {
    return apply_filters( 'foodica_featured_content', array() );
}

/**
 * Show custom logo or blog title and description (backward compatibility)
 *
 */
function foodica_custom_logo() {
    has_custom_logo() ? the_custom_logo() : printf('<h1><a href="%s" title="%s">%s</a></h1>', esc_url(home_url()), get_bloginfo('description'), get_bloginfo('name'));
}

/**
 * Enqueues scripts and styles
 */
function foodica_enqueue_scripts() {
	wp_enqueue_style( 'foodica-style', get_stylesheet_uri() );

	wp_enqueue_style( 'foodica-style-mobile', get_template_directory_uri() . '/assets/css/media-queries.css', array( 'foodica-style' ), '1.0' );

	wp_enqueue_style( 'foodica-google-font-default', '//fonts.googleapis.com/css?family=Cabin:400,700|Annie+Use+Your+Telescope|Roboto+Condensed:400,700|Libre+Franklin:400,400i,600,600i,700,700i|Roboto+Slab:300,400,700&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext' );

	wp_enqueue_style( 'dashicons' );

    wp_enqueue_script( 'slicknav', get_template_directory_uri() . '/assets/js/foodica-slicknav.min.js', array( 'jquery' ), '1.0.0', true );

    wp_enqueue_script( 'flickity', get_template_directory_uri() . '/assets/js/flickity.pkgd.min.js', array(), '1.0.0', true );

    wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/assets/js/foodica-jquery.fitvids.js', array( 'jquery' ), '1.0.0', true );

    wp_enqueue_script( 'superfish', get_template_directory_uri() . '/assets/js/superfish.min.js', array( 'jquery' ), '1.0.0', true );

    wp_enqueue_script( 'foodica-search_button', get_template_directory_uri() . '/assets/js/foodica-search_button.js', array(), '1.0.0', true );

 	wp_enqueue_script( 'foodica-script', get_template_directory_uri() . '/assets/js/foodica-functions.js', array( 'jquery' ), '20150325', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'foodica_enqueue_scripts' );

/**
 * Initializes Widgetized Areas (Sidebars)
 */
function foodica_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Sidebar', 'foodica' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<div class="widget %2$s" id="%1$s">',
        'after_widget'  => '<div class="clear"></div></div>',
        'before_title'  => '<h3 class="title">',
        'after_title'   => '</h3>',
	) );

    /*----------------------------------*/
    /* Footer widgetized areas          */
    /*----------------------------------*/

    register_sidebar( array(
        'name'          => __('Footer: Column 1', 'foodica' ),
        'id'            => 'footer_1',
        'before_widget' => '<div class="widget %2$s" id="%1$s">',
        'after_widget'  => '<div class="clear"></div></div>',
        'before_title'  => '<h3 class="title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __('Footer: Column 2', 'foodica' ),
        'id'            => 'footer_2',
        'before_widget' => '<div class="widget %2$s" id="%1$s">',
        'after_widget'  => '<div class="clear"></div></div>',
        'before_title'  => '<h3 class="title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __('Footer: Column 3', 'foodica' ),
        'id'            => 'footer_3',
        'before_widget' => '<div class="widget %2$s" id="%1$s">',
        'after_widget'  => '<div class="clear"></div></div>',
        'before_title'  => '<h3 class="title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __('Footer: Column 4', 'foodica' ),
        'id'            => 'footer_4',
        'before_widget' => '<div class="widget %2$s" id="%1$s">',
        'after_widget'  => '<div class="clear"></div></div>',
        'before_title'  => '<h3 class="title">',
        'after_title'   => '</h3>',
    ) );

    /* Header - for social icons
    ===============================*/

    register_sidebar(array(
        'name'=>__('Header Social Icons', 'foodica' ),
        'id' => 'header_social',
        'description' => 'Widget area in the header. Install the "Social Icons Widget by WPZOOM" plugin and add the widget here.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="title"><span>',
        'after_title' => '</span></h3>',
    ));


	// Custom Theme Widget
	require_once get_template_directory() . '/inc/widgets.php';
    // require_once get_template_directory() . '/inc/wpzoom-widgets.php';

}
add_action( 'widgets_init', 'foodica_widgets_init' );


/* Tag Cloud Mods */

function foodica_tagcloud_postcount_filter ($variable) {
    $variable = str_replace('<span class="tag-link-count"> (', ' <span class="post_count"> ', $variable);
    $variable = str_replace(')</span>', '</span>', $variable);
    return $variable;
}

add_filter('wp_tag_cloud','foodica_tagcloud_postcount_filter');




/**
 * Adds the post layout meta box
 */
function foodica_add_meta_box() {
	add_meta_box( 'foodica_post_layout', __( 'Post Layout', 'foodica' ), 'foodica_meta_box_post_layout', 'post', 'side', 'low' );
}
add_action( 'add_meta_boxes', 'foodica_add_meta_box' );

/**
 * Displays the post layout dropdown field
 */
function foodica_meta_box_post_layout() {
	global $post;

	$selected = get_post_meta( $post->ID, '_foodica_post_layout', true );
	wp_nonce_field( 'foodica_post_layout', 'foodica_post_layout_nonce' ); ?>

<p>
	<label for="foodica_post_layout"><?php esc_html_e( 'Choose the layout for this post:', 'foodica' ); ?>
	</label><br /> <select name="foodica_post_layout"
		id="foodica_post_layout">
		<option value="">
			<?php esc_html_e( 'Default', 'foodica' ); ?>
		</option>
		<option value="column-full"
		<?php selected( $selected, 'column-full' ); ?>>
			<?php esc_html_e( 'Full Width (no sidebar)', 'foodica' ); ?>
		</option>
	</select>
</p>
<?php
}

/**
 * Updates or deletes post meta with the post layout selection
 *
 * @param int $post_id
 * @return int
 */
function foodica_save_post( $post_id ){

	if ( ( ! defined( 'DOING_AUTOSAVE' ) || ! DOING_AUTOSAVE )
		&& current_user_can( 'edit_post', $post_id )
		&& isset( $_POST['foodica_post_layout'] )
		&& check_admin_referer( 'foodica_post_layout', 'foodica_post_layout_nonce' ) ) {
		$sanitized_post_layout = sanitize_title_with_dashes($_POST['foodica_post_layout']);

		if ( in_array( $sanitized_post_layout, array( 'column-full' ) ) )
			update_post_meta( $post_id, '_foodica_post_layout', $sanitized_post_layout );
		else
			delete_post_meta( $post_id, '_foodica_post_layout' );
	}
	return $post_id;
}
add_action( 'save_post', 'foodica_save_post' );


/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'foodica_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function foodica_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        // Recommended plugins from the WordPress Plugin Repository.
        array(
            'name'      => 'Social Icons Widget by WPZOOM',
            'slug'      => 'social-icons-widget-by-wpzoom',
            'required'  => false,
        ),

        array(
            'name'         => 'Instagram Widget by WPZOOM',
            'slug'         => 'instagram-widget-by-wpzoom',
            'required'     => false,
        ),
        array(
            'name'         => 'Recipe Card Blocks',
            'slug'         => 'recipe-card-blocks-by-wpzoom',
            'required'     => false,
        ),


    );

    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
        'id'           => 'foodica',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.

    );

    tgmpa( $plugins, $config );
}



/*
 * Fetch Theme Data & Options for About Page
 */

$foodica_data = wp_get_theme('foodica');
$foodica_version = $foodica_data['Version'];
$foodica_options = get_option('foodica_options');

if (!function_exists('foodica_admin_scripts')) {
    function foodica_admin_scripts($hook) {
        if ('appearance_page_foodica' === $hook || 'widgets.php' === $hook) {
            wp_enqueue_style('foodica-admin', get_template_directory_uri() . '/inc/admin/admin.css');
        }
    }
}
add_action('admin_enqueue_scripts', 'foodica_admin_scripts');

if (is_admin()) {
    require_once('inc/admin/admin.php');
}