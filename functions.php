<?php
/**
 * soapatrickfive functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package soapatrickfive
 */

if ( ! function_exists( 'soapatrickfive_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function soapatrickfive_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on soapatrickfive, use a find and replace
		 * to change 'soapatrickfive' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'soapatrickfive', get_template_directory() . '/languages' );

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
			'menu' => esc_html__( 'Primary', 'soapatrickfive' ),
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

		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array(
			'image',
			'video',
			'quote',
			'link',
			'status'
		) );
	}
endif;
add_action( 'after_setup_theme', 'soapatrickfive_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function soapatrickfive_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'soapatrickfive_content_width', 640 );
}
add_action( 'after_setup_theme', 'soapatrickfive_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function soapatrickfive_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'soapatrickfive' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'soapatrickfive' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'soapatrickfive_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function soapatrickfive_scripts() {
	wp_enqueue_style( 'soapatrickfive-style', get_stylesheet_uri() );
	wp_enqueue_script( 'soapatrickfive-scripts', get_template_directory_uri() . '/js/scripts.js', '','' , true );		
// 	wp_enqueue_script( 'soapatrickfive-fa5', get_template_directory_uri() . '/js/fontawesome-all.min.js', '','' , false  );		
	if ( !is_admin() ) wp_deregister_script('jquery');		
}
add_action( 'wp_enqueue_scripts', 'soapatrickfive_scripts' );



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
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Remove Emojiscript
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/**
 * add featured image/video to RSS feed
 */

function featured_toRSS($content) {
	global $post;
	$post_id = get_the_ID();
	
	$video = get_post_meta( $post_id, '_format_video_embed', true);
	if ( ! empty( $video ) ) {
	    $content = '<div>' . $video . '</div>' . $content;
	}	
	
	if ( has_post_thumbnail( $post->ID ) ){
		$content = '<div>' . get_the_post_thumbnail( $post->ID, 'full', array( 'style' => 'margin-bottom: 15px;' ) ) . '</div>' . $content;
	}
	
	return $content;
}
 
add_filter('the_excerpt_rss', 'featured_toRSS');
add_filter('the_content_feed', 'featured_toRSS');

/**
 * Shortens title used in next and previous post links.
 *
 * Replaces the '%title' argument used in the 2nd argument of these WordPress functions:
 * previous_post_link() and next_post_link()
 *
 * Sample usage with and without optional argument:
 *      previous_post_link( %link, shorten_next_prev_title( 'prev', 25 ) );
 *      next_post_link( %link, shorten_next_prev_title( 'next' ) );
 *
 * @since 1.0.0 (Aug 9, 2015 build date)
 *
 * @see get_next_post() and get_previous_post()
 * @link http://codesport.io/coding/previous-and-next-post-titles/
 *
 * @param string $direction Use 'next' or 'prev'. If != 'next' hard defaults to 'prev'
 * @param integer $my_title_length Optional. Number of characters in title. Defaults to 33
 * @return string A shortened title.
 */
 
function shorten_next_prev_title( $direction, $my_title_length = 33 ) {
    if ( $direction == 'next' ) {
        $my_post = get_next_post();  
    } else {
        $my_post = get_previous_post(); 
    }
 
    if ( !empty( $my_post ) ) {
         $my_post_title = $my_post->post_title;
         if ( strlen( $my_post_title ) > $my_title_length ) {
              $shortened_my_post_title = substr( $my_post_title, 0, $my_title_length ) . '…';   
         } else {
             $shortened_my_post_title = $my_post_title;       
         }
    }
         
    return $shortened_my_post_title;
}

/**
 * Attach a class to linked images' parent anchors
 * Works for existing content
 */
function give_linked_images_class($content) {

  $classes = 'img-link'; // separate classes by spaces - 'img image-link'

  // check if there are already a class property assigned to the anchor
  if ( preg_match('/<a.*? class=".*?"><img/', $content) ) {
    // If there is, simply add the class
    $content = preg_replace('/(<a.*? class=".*?)(".*?><img)/', '$1 ' . $classes . '$2', $content);
  } else {
    // If there is not an existing class, create a class property
    $content = preg_replace('/(<a.*?)><img/', '$1 class="' . $classes . '" ><img', $content);
  }
  return $content;
}

add_filter('the_content','give_linked_images_class');

/**
 * Register Custom Post Types
 */

function register_custom_post_types() {

	/* Post Type: Portfolios. */

	$labels = array(
		"name" => __( "Factory", "" ),
		"singular_name" => __( "Portfolio", "" ),
		"menu_name" => __( "Portfolios", "" ),
		"all_items" => __( "Portfolios", "" ),
		"add_new" => __( "Add New", "" ),
		"add_new_item" => __( "Add New Portfolio", "" ),
		"edit_item" => __( "Edit Portfolio", "" ),
		"new_item" => __( "New Portfolio", "" ),
		"view_item" => __( "View Portfolio", "" ),
		"view_items" => __( "View Portfolios", "" ),
		"search_items" => __( "Search Portfolios", "" ),
		"not_found" => __( "No Portfolios found", "" ),
		"not_found_in_trash" => __( "No Portfolios found in Trash", "" ),
		"parent_item_colon" => __( "Parent Portfolio", "" ),
		"featured_image" => __( "Featured image for Portfolio", "" ),
		"set_featured_image" => __( "Set featured image for Portfolio", "" ),
		"use_featured_image" => __( "Use as featured image for this Portfolio", "" ),
		"archives" => __( "Portfolio Archives", "" ),
		"insert_into_item" => __( "Insert into Portfolio", "" ),
		"uploaded_to_this_item" => __( "Uploaded to this Portfolio", "" ),
		"filter_items_list" => __( "Filter Portfolio List", "" ),
		"items_list_navigation" => __( "Portfolios List Navigation", "" ),
		"items_list" => __( "Portfolios List", "" ),
		"attributes" => __( "Portfolios Attributes", "" ),
		"parent_item_colon" => __( "Parent Portfolio", "" ),
	);

	$args = array(
		"label" => __( "Portfolios", "" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"menu_icon" => "dashicons-art",
		"menu_position" => 5,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "factory", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "editor", "thumbnail", "post-formats" ),
	);

	register_post_type( "factory", $args );
	
	/* Post Type: Changelog. */

	$labels = array(
		"name" => __( "Logs", "" ),
		"singular_name" => __( "Log", "" ),
		"menu_name" => __( "Logs", "" ),
		"all_items" => __( "Logs", "" ),
		"add_new" => __( "Add New", "" ),
		"add_new_item" => __( "Add New Log", "" ),
		"edit_item" => __( "Edit Log", "" ),
		"new_item" => __( "New Log", "" ),
		"view_item" => __( "View Log", "" ),
		"view_items" => __( "View Logs", "" ),
		"search_items" => __( "Search Logs", "" ),
		"not_found" => __( "No Logs found", "" ),
		"not_found_in_trash" => __( "No Logs found in Trash", "" ),
		"parent_item_colon" => __( "Parent Log", "" ),
		"archives" => __( "Log Archives", "" ),
		"insert_into_item" => __( "Insert into Log", "" ),
		"uploaded_to_this_item" => __( "Uploaded to this Log", "" ),
		"filter_items_list" => __( "Filter Log List", "" ),
		"items_list_navigation" => __( "Log List Navigation", "" ),
		"items_list" => __( "Logs List", "" ),
		"attributes" => __( "Logs Attributes", "" ),
		"parent_item_colon" => __( "Parent Log", "" ),
	);

	$args = array(
		"label" => __( "Logs", "" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"menu_icon" => "dashicons-hammer",
		"menu_position" => 6,		
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "log", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title"),
	);

	register_post_type( "log", $args );	
}

add_action( 'init', 'register_custom_post_types' );

/**
 * Register Custom Taxonomies
 */

function register_my_taxes() {

	/* Taxonomy: Portfolio Categories.*/

	$labels = array(
		"name" => __( "Portfolio Categories", "" ),
		"singular_name" => __( "Portfolio Category", "" ),
	);

	$args = array(
		"label" => __( "Portfolio Categories", "" ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => false,
		"label" => "Portfolio Categories",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'portfolio_category', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_quick_edit" => false,
	);
	register_taxonomy( "portfolio_category", array( "factory" ), $args );
	
}

add_action( 'init', 'register_my_taxes' );


/**
 * Advanced Custom Fields
 */



define( 'ACF_LITE', true );
include_once('advanced-custom-fields/acf.php');

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_font-awesome-icon',
		'title' => 'Font-Awesome Icon',
		'fields' => array (
			array (
				'key' => 'field_56ed1244cce42',
				'label' => 'Font-Awesome Icon',
				'name' => 'font-awesome_icon',
				'type' => 'text',
				'default_value' => 'fal fa-newspaper',
				'placeholder' => 'fal fa-newspaper',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	
	register_field_group(array (
		'id' => 'acf_change-log',
		'title' => 'Change Log',
		'fields' => array (
			array (
				'key' => 'field_5ad8c6dfbfa48',
				'label' => 'Changelog Type',
				'name' => 'changelog_type',
				'type' => 'select',
				'required' => 1,
				'choices' => array (
					'fal fa-plus-circle' => 'Added',
					'fal fa-minus-circle' => 'Removed',
					'fal fa-wrench' => 'Changed',
					'fal fa-bug' => 'Fixed',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'log',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));	
}	



/**
 * Remove archive title prefixes.
 *
 * @param  string  $title  The archive title from get_the_archive_title();
 * @return string          The cleaned title.
 */
function grd_custom_archive_title( $title ) {
	// Remove any HTML, words, digits, and spaces before the title.
	return preg_replace( '#^[\w\d\s]+:\s*#', '', strip_tags( $title ) );
}
add_filter( 'get_the_archive_title', 'grd_custom_archive_title' );
