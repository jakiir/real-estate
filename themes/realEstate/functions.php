<?php
/**
 * realestate functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package realestate
 */

if ( ! function_exists( 'realestate_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function realestate_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on realestate, use a find and replace
		 * to change 'realestate' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'realestate', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'realestate' ),
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
		add_theme_support( 'custom-background', apply_filters( 'realestate_custom_background_args', array(
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
add_action( 'after_setup_theme', 'realestate_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function realestate_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'realestate_content_width', 640 );
}
add_action( 'after_setup_theme', 'realestate_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function realestate_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'realestate' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'realestate' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'realestate_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function realestate_scripts() {
	wp_enqueue_style( 'realestate-style', get_stylesheet_uri() );

	wp_enqueue_script( 'realestate-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'realestate-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'realestate_scripts' );

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

//order completion form submit
add_action( 'wp_ajax_nopriv_editTemplateAction', 'editTemplateAction', 85);
add_action( 'wp_ajax_editTemplateAction', 'editTemplateAction', 85 );
function editTemplateAction(){
	$template_id = $_POST['template_id'];
	
	 $results = array();
	 if($template_id){
		 global $wpdb;
		 $table_template = $wpdb->prefix . 'template';
		 $template_name = !empty($_POST['template_name']) ? $_POST['template_name'] : '';
		 $template_share = !empty($_POST['template_share']) ? $_POST['template_share'] : '';
		 $template_state = !empty($_POST['template_state']) ? $_POST['template_state'] : '';
		 $template_state_id = !empty($_POST['template_state_id']) ? $_POST['template_state_id'] : '';
		 $template_date = !empty($_POST['template_date']) ? $_POST['template_date'] : '';
		 $template_company = !empty($_POST['template_company']) ? $_POST['template_company'] : '';
		 $footer_template = !empty($_POST['footer_template']) ? $_POST['footer_template'] : '';
		
		$wpdb->query($wpdb->prepare("UPDATE $table_template 
		 SET name='".$template_name."',
		 shared_flag='".$template_share."',
		 state='".$template_state."',
		 state_form='".$template_state_id."',
		 companyId=$template_company,
		 footer_html='".$footer_template."',
		 template_date='".$template_date."'
		 WHERE id=$template_id"
		 ));
		 
		 if (!function_exists('wp_handle_upload')) {
			   require_once(ABSPATH . 'wp-admin/includes/file.php');
		   }
		  // echo $_FILES["upload"]["name"];
		  $uploadedfile = $_FILES['template_logo'];
		  if(!empty($uploadedfile)){
			  $upload_overrides = array('test_form' => false);
			  $movefile = wp_handle_upload($uploadedfile, $upload_overrides);

			// echo $movefile['url'];
			  if ($movefile && !isset($movefile['error'])) {
				  $imageUrl = $movefile['url'];
				  $wpdb->query($wpdb->prepare("UPDATE $table_template SET logo_url='".$imageUrl."' WHERE id=$template_id"));			 
				 $results = array(
					'success' => true,
					'mess' => 'Data Successfully updated.',
					'template_id' => $template_id
				 );		
			} else {
				/**
				 * Error generated by _wp_handle_upload()
				 * @see _wp_handle_upload() in wp-admin/includes/file.php
				 */
				 $results = array(
					'success' => false,
					'mess' => $movefile['error']
				 );			
			}	
		  } else {
			$results = array(
				'success' => true,
				'mess' => 'Data Successfully updated.',
				'template_id' => $template_id
			 );
		  }		
		 
	 } else {
		 $results = array(
			'success' => false,
			'mess' => 'Form data not save, there are some error to save.'
		 );
	 }			
	echo json_encode($results);        
	die();
  }

  add_action( 'wp_ajax_nopriv_saveDynamicForm', 'saveDynamicForm', 85);
add_action( 'wp_ajax_saveDynamicForm', 'saveDynamicForm', 85 );
function saveDynamicForm(){
	
	$template_id = $_POST['template_id'];	
	 $results = array();
	 if($template_id){
		 global $wpdb;
		 $template_detail = $wpdb->prefix . 'template_detail';
		 $get_templages = $wpdb->get_results( "SELECT * FROM $template_detail WHERE template_id=$template_id", OBJECT );
		 $formJsonData = !empty($_POST['formJsonData']) ? $_POST['formJsonData'] : '';
		if(!empty($get_templages)){	
			$wpdb->query($wpdb->prepare("UPDATE $template_detail 
			 SET field_text_html='".$formJsonData."'
			 WHERE template_id=$template_id"));
		} else {			
			$wpdb->insert($template_detail, array('template_id' => $template_id));
			$wpdb->query($wpdb->prepare("UPDATE $template_detail 
			 SET field_text_html='".$formJsonData."'
			 WHERE template_id=$template_id"));
		}
		 
		 $results = array(
			'success' => true,
			'mess' => 'Data Successfully updated.',
			'template_id' => $template_id,
			'allData' => $_POST
		 );
	 } else {
		 $results = array(
			'success' => false,
			'mess' => 'Form data not save, there are some error to save.'
		 );
	 }
	echo json_encode($results);        
	die();
}

