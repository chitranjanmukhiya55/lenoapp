<?php
/**
 * lenoapp functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package lenoapp
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function lenoapp_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on lenoapp, use a find and replace
		* to change 'lenoapp' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'lenoapp', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	// register_nav_menus(
	// 	array(
	// 		'menu-1' => esc_html__( 'Primary', 'lenoapp' ),
	// 	)
	// );

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'lenoapp_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'lenoapp_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function lenoapp_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'lenoapp_content_width', 640 );
}
add_action( 'after_setup_theme', 'lenoapp_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function lenoapp_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'lenoapp' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'lenoapp' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'lenoapp_widgets_init' );
/**
 * Enqueue scripts and styles.
 */
function lenoapp_scripts() {
    // Enqueue the main theme stylesheet
    wp_enqueue_style( 'lenoapp-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_style_add_data( 'lenoapp-style', 'rtl', 'replace' );

    // Enqueue additional CSS files
    wp_enqueue_style( 'lenoapp-custom-style', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.0' );
    wp_enqueue_style( 'lenoapp-font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css', array(), '6.0.0' );

    // Enqueue navigation script
    wp_enqueue_script( 'lenoapp-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

    // Enqueue additional JS files
    wp_enqueue_script( 'lenoapp-main-js', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true );

    // Enqueue comment-reply script if needed
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'lenoapp_scripts' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Header Menu OnClick Functionaity
 */

// Register a menu location for the theme
function lenoapp_register_menus() {
    register_nav_menus(
        array(
            'menu-1' => esc_html__( 'Primary', 'lenoapp' ),
        )
    );
}
add_action( 'init', 'lenoapp_register_menus' );

function lenoapp_add_onclick_to_menu_items( $items, $args ) {
    if ( $args->theme_location === 'menu-1' ) {
        foreach ( $items as &$item ) {
            // Generate a page identifier based on the title
            $page_id = sanitize_title( $item->title ); // Example: "Dashboard" -> "dashboard"
            $item->url = '#'; // Disable default link behavior
            $item->title = '<i class="fas ' . lenoapp_get_icon_class( $page_id ) . '"></i> <span>' . $item->title . '</span>';
            $item->attr_title = $page_id; // Add the identifier as a title attribute
            $item->classes[] = 'menu-item-' . $page_id; // Add a custom class
        }
    }
    return $items;
}
add_filter( 'wp_nav_menu_objects', 'lenoapp_add_onclick_to_menu_items', 10, 2 );

// Helper function to assign icons dynamically
function lenoapp_get_icon_class( $page_id ) {
    $icons = array(
        'dashboard'     => 'fa-home',
        'new-order'     => 'fa-plus',
        'order-history' => 'fa-history',
        'support'       => 'fa-headset',
        'payment'       => 'fa-credit-card',
        'logout'        => 'fa-sign-out-alt',
    );

    return isset( $icons[ $page_id ] ) ? $icons[ $page_id ] : 'fa-circle';
}
