<?php
/**
 * ll_start functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ll_start
 */

if ( ! function_exists( 'll_starter_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ll_starter_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on ll_start, use a find and replace
		 * to change 'll_start' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'll_start', get_template_directory() . '/languages' );

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
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'll_start' ),
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

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'll_starter_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'll_starter_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ll_starter_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'll_starter_content_width', 640 );
}
add_action( 'after_setup_theme', 'll_starter_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ll_starter_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'll_start' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'll_start' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'll_starter_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ll_starter_scripts() {
	wp_enqueue_style( 'll_start-style', get_stylesheet_uri() );

	wp_enqueue_script( 'll_start-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'll_start-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'll_starter_scripts' );

/**
 * Remove feeds and wordpress-specific content that is generated on the wp_head hook.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/wp_head
 */
add_action( 'init', function () {
  // Remove the Really Simple Discovery service link
  remove_action( 'wp_head', 'rsd_link' );
  // Remove the link to the Windows Live Writer manifest
  remove_action( 'wp_head', 'wlwmanifest_link' );
  // Remove the general feeds
  remove_action( 'wp_head', 'feed_links', 2 );
  // Remove the extra feeds, such as category feeds
  remove_action( 'wp_head','feed_links_extra', 3 );
  // Remove the displayed XHTML generator
  remove_action( 'wp_head', 'wp_generator' );
  // Remove the REST API link tag
  remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
  // Remove oEmbed discovery links.
  remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
  // Remove rel next/prev links
  remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
});

/**
 * Set default image attachment options
 */
add_action( 'after_setup_theme', function () {
  // Remove default link
  if ( get_option( 'image_default_link_type' ) !== 'none' ) {
    update_option( 'image_default_link_type', 'none' );
  }
  // Remove default alignment
  if ( get_option( 'image_default_align' ) !== 'none' ) {
    update_option( 'image_default_align', 'none' );
  }
  // Set default size
  if ( get_option( 'image_default_size' ) !== 'large' ) {
    update_option( 'image_default_size', 'large' );
  }
});

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
 * Functions clean up the admin interface.
 */
require get_template_directory() . '/inc/ui-cleanup.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

