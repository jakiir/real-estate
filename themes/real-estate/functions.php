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
		show_admin_bar( false );

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

/**/
add_action('after_switch_theme', 'manage_required_tables');
function manage_required_tables() {
	
	global $wpdb;
	// Template table
	$table_template = $wpdb->prefix . 'template';	
	$sql_template = "CREATE TABLE $table_template (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
	  `shared_flag` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
	  `state` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
	  `state_form` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
	  `companyId` int(11) NOT NULL,
	  `logo_url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
	  `footer_html` text COLLATE utf8_unicode_ci NOT NULL,
	  `header_html` text COLLATE utf8_unicode_ci NOT NULL,
	  `template_date` varchar(34) COLLATE utf8_unicode_ci NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
	INSERT INTO $table_template (`id`, `name`, `shared_flag`, `state`, `state_form`, `companyId`, `logo_url`, `footer_html`, `header_html`, `template_date`) VALUES
	(1,	'Item One',	'',	'Dhaka',	'BD',	88,	'http://via.placeholder.com/350x150', '', '', ''),
	(2,	'Item Two',	'',	'Dhaka',	'BD',	88,	'http://via.placeholder.com/350x150', '', '', ''),
	(3,	'Item Three', '',	'Dhaka',	'BD',	88,	'http://via.placeholder.com/350x150', '', '', '');";
	
	
	// Template details table
	$table_template_detail = $wpdb->prefix . 'template_detail';
	$sql_template_detail = "CREATE TABLE $table_template_detail (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `template_id` int(11) NOT NULL,
	  `field_type_id` int(11) NOT NULL,
	  `field_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
	  `field_text_html` text COLLATE utf8_unicode_ci NOT NULL,
	  `print_flag` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
	  `x_coord` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
	  `x_coord_relative` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
	  `width` tinytext COLLATE utf8_unicode_ci NOT NULL,
	  `height` tinytext COLLATE utf8_unicode_ci NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
	
	// form_data table
	$form_data = $wpdb->prefix . 'form_data';
	$sql_form_data = "DROP TABLE IF EXISTS $form_data;
		CREATE TABLE $form_data (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `form_id` int(11) NOT NULL,
		  `field_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
		  `field_value` text COLLATE utf8_unicode_ci NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
		
	// form_info table
	$form_info = $wpdb->prefix . 'form_info';
	$sql_form_info = "DROP TABLE IF EXISTS $form_info;
	CREATE TABLE $form_info (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `template_id` int(11) NOT NULL,
	  `form_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
	  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	  `created_by` int(11) DEFAULT NULL,
	  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  `updated_by` int(11) DEFAULT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
	
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	//dbDelta( $sql_template );
	//dbDelta( $sql_template_detail );
	//dbDelta( $sql_form_data );
	//dbDelta( $sql_form_info );
}

function safe_b64encode($string) {
	$data = base64_encode($string);
	$data = str_replace(array('+','/','='),array('-','_',''),$data);
	return urlencode($data);
}

function safe_b64decode($string) {
	$data = urldecode($string);
	$data = str_replace(array('-','_'),array('+','/'),$string);
	$mod4 = strlen($data) % 4;
	if ($mod4) {
		$data .= substr('====', $mod4);
	}
	return base64_decode($data);
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
		 $template_share = !empty($_POST['template_share']) ? $_POST['template_share'] : 'off';
		 $template_state = !empty($_POST['template_state']) ? $_POST['template_state'] : '';
		 $template_state_id = !empty($_POST['template_state_id']) ? $_POST['template_state_id'] : '';
		 $template_date = !empty($_POST['template_date']) ? $_POST['template_date'] : '';
		 $template_company = !empty($_POST['template_company']) ? $_POST['template_company'] : '';
		 $footer_template = !empty($_POST['footer_template']) ? $_POST['footer_template'] : '';
		 $shareTem=0;
		 if($template_share == 'true') $shareTem=1;
		$wpdb->query($wpdb->prepare("UPDATE $table_template 
		 SET name='".$template_name."',
		 shared_flag='".$template_share."',
		 state='".$template_state."',
		 state_form='".$template_state_id."',
		 companyId='".$template_company."',
		 footer_html='".$footer_template."',
		 template_date='".$template_date."',
		 shared_template=$shareTem,
		 your_template=1
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

add_action( 'wp_ajax_nopriv_get_save_as_draft', 'get_save_as_draft', 85);
add_action( 'wp_ajax_get_save_as_draft', 'get_save_as_draft', 85 );
function get_save_as_draft(){
	$template_id = $_POST['template_id'];
	$results = array();
	if($template_id){
		 $hash = $_POST['hash'];
		 $user_id = $_POST['user_id'];
		 $drawing_type = $_POST['drawing_type'];
		 
		 global $wpdb;
		 $saveAsDraft = $wpdb->prefix . 'ins_save_as_draft';
		 $get_saveDraft = $wpdb->get_results( "SELECT * FROM $saveAsDraft WHERE user_id=$user_id AND template_id=$template_id AND hash=$hash AND drawing_type='$drawing_type'", OBJECT );
		 if(!empty($get_saveDraft)){
			$results = array(
				'success' => true,
				'mess' => 'Data Successfully Updated.1',
				'template_id' => $template_id,
				'hash' => $hash,
				'user_id' => $user_id,
				'drawingName'=> $get_saveDraft[0]->drawingName,
				'drawingData'=> $get_saveDraft[0]->drawingData
			 );
		 } else {
			 $results = array(
				'success' => false,
				'mess' => 'Form data not save, there are some error to save.1'
			 );
		 }
	} else {
		$results = array(
			'success' => false,
			'mess' => 'Form data not save, there are some error to save.2'
		 );
	 }
	echo json_encode($results);        
	die();
}
  
add_action( 'wp_ajax_nopriv_save_as_draft', 'save_as_draft', 85);
add_action( 'wp_ajax_save_as_draft', 'save_as_draft', 85 );
function save_as_draft(){
	$template_id = $_POST['template_id'];
	$results = array();
	if($template_id){
		 $hash = $_POST['hash'];		 
		 $drawingName = $_POST['drawingName'];
		 $drawingData = $_POST['drawingData'];
		 $user_id = $_POST['user_id'];
		 $drawing_type = $_POST['drawing_type'];
		 global $wpdb;
		 $saveAsDraft = $wpdb->prefix . 'ins_save_as_draft';
		 $get_saveDraft = $wpdb->get_results( "SELECT * FROM $saveAsDraft WHERE user_id=$user_id AND template_id=$template_id AND hash=$hash AND drawing_type='$drawing_type'", OBJECT );
		 if(!empty($get_saveDraft)){
		 $wpdb->update(
				$saveAsDraft, 
				array( 
					'drawingName' => $drawingName,
					'drawingData' => $drawingData
				), 
				array( 'user_id' => $user_id,'template_id' => $template_id,'hash' => $hash,'drawing_type' => $drawing_type )
			);
		 } else {
			  $wpdb->insert($saveAsDraft, 
				 array(
					 'template_id' => $template_id,
					 'hash' => $hash,
					 'drawingName' => $drawingName,
					 'drawingData' => $drawingData,
					 'user_id' => $user_id,
					 'drawing_type' => $drawing_type
				 )
			 );
		 }			 
		 $results = array(
			'success' => true,
			'mess' => 'All changes saved!',
			'template_id' => $template_id,
			'hash' => $hash,
			'user_id' => $user_id
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
  
add_action( 'wp_ajax_nopriv_perform_inspections', 'perform_inspections', 85);
add_action( 'wp_ajax_perform_inspections', 'perform_inspections', 85 );
function perform_inspections(){
	$template_id = $_POST['template_id'];
	
	 $results = array();
	 if($template_id){
		 global $wpdb;
		 $table_inspection = $wpdb->prefix . 'inspection';
		 $company = !empty($_POST['company']) ? $_POST['company'] : '';
		 $inpection_date = !empty($_POST['inpection_date']) ? $_POST['inpection_date'] : '';
		 $report_identification = !empty($_POST['report_identification']) ? $_POST['report_identification'] : '';
		 $template_id = !empty($_POST['template_id']) ? $_POST['template_id'] : '';
		 $prepared_for = !empty($_POST['prepared_for']) ? $_POST['prepared_for'] : '';
		 $prepared_by = !empty($_POST['prepared_by']) ? $_POST['prepared_by'] : '';
		 $time_in = !empty($_POST['time_in']) ? $_POST['time_in'] : '';
		 $time_out = !empty($_POST['time_out']) ? $_POST['time_out'] : '';
		 $inspection_status = !empty($_POST['inspection_status']) ? $_POST['inspection_status'] : '';
		 $user_id = get_current_user_id();
		 //$get_inspection = $wpdb->get_results( "SELECT * FROM $table_inspection WHERE user_id=$user_id AND template_id=$template_id", OBJECT );
		 $get_inspection = '';
		if(!empty($get_inspection)){
			 $wpdb->update(
				$table_inspection, 
				array( 
					'company' => $company,
					 'inpection_date' => $inpection_date,
					 'report_identification' => $report_identification,					 
					 'prepared_for' => $prepared_for,
					 'prepared_by' => $prepared_by,
					 'time_in' => $time_in,
					 'time_out' => $time_out,
					 'inspection_status' => $inspection_status					 
				), 
				array( 'user_id' => $user_id,'template_id' => $template_id )
			);
			 
			 $results = array(
				'success' => true,
				'mess' => 'Data Successfully Updated.1',
				'template_id' => $template_id
			 );	
		} else {
			 $wpdb->insert($table_inspection, 
				 array(
					 'company' => $company,
					 'inpection_date' => $inpection_date,
					 'report_identification' => $report_identification,
					 'template_id' => $template_id,
					 'prepared_for' => $prepared_for,
					 'prepared_by' => $prepared_by,
					 'time_in' => $time_in,
					 'time_out' => $time_out,
					 'inspection_status' => $inspection_status,
					 'user_id' => $user_id
				 )
			 );
			 $lastid = $wpdb->insert_id;
			 $results = array(
				'success' => true,
				'mess' => 'Data Successfully Inserted.',
				'report_id'=>$lastid,
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

  
add_action( 'wp_ajax_nopriv_copyTemplate', 'copyTemplate', 85);
add_action( 'wp_ajax_copyTemplate', 'copyTemplate', 85 );
function copyTemplate(){
	
	$template_id = $_POST['template_id'];	
	 $results = array();
	 if($template_id){
		 global $wpdb;
		$user_id = get_current_user_id();							
		$table_template = $wpdb->prefix . 'template';
		$get_your_templages = $wpdb->get_results( "SELECT * FROM $table_template WHERE id=$template_id AND user_id=$user_id AND your_template=0", OBJECT );
		if(!empty($get_your_templages)){	
			$wpdb->query($wpdb->prepare("UPDATE $table_template 
			 SET your_template=1,
			 user_id=$user_id
			 WHERE id=$template_id AND user_id=$user_id AND your_template=0"));
			 
			 $results = array(
				'success' => true,
				'mess' => 'Template successfully copy.'	,
				'template_id' => $template_id,
				'template_name' => $get_your_templages[0]->name
			 );
			 
		} else {
			$get_your_temp = $wpdb->get_results( "SELECT * FROM $table_template WHERE id=$template_id AND user_id=$user_id AND your_template=1", OBJECT );
			if(empty($get_your_temp)){
				$get_your_templage = $wpdb->get_results( "SELECT * FROM $table_template WHERE id=$template_id", OBJECT );
				$tempName = $get_your_templage[0]->name;
				$temCount = $wpdb->get_var("SELECT COUNT(*) FROM $table_template WHERE name='$tempName'");
				$temptName = '';
				if($temCount > 0){
					$temptName = $get_your_templage[0]->name.' - Copy';
				}
				$wpdb->insert($table_template, 
					 array(
						 'name' => $temptName,
						 'shared_flag' => $get_your_templage[0]->shared_flag,
						 'state' => $get_your_templage[0]->state,
						 'state_form' => $get_your_templage[0]->state_form,
						 'companyId' => $get_your_templage[0]->companyId,
						 'logo_url' => $get_your_templage[0]->logo_url,
						 'footer_html' => $get_your_templage[0]->footer_html,
						 'header_html' => $get_your_templage[0]->header_html,
						 'template_date' => $get_your_templage[0]->template_date,
						 'shared_template' => $get_your_templage[0]->shared_template,
						 'your_template' => 1,
						 'user_id' => $user_id
					 )
				 );
				 $insert_id = $wpdb->insert_id;
				 $results = array(
					'success' => true,
					'mess' => 'Template successfully copy.',
					'template_id' => $insert_id,
					'template_name' => $temptName
				 );
			} else {
				$results = array(
					'success' => false,
					'mess' => 'This template is already copied!'
				 );
			}		
		} 
	 } else {
		 $results = array(
			'success' => false,
			'mess' => 'Template is not valid, please, select valid template!'
		 );
	 }
	echo json_encode($results);        
	die();
}

add_action( 'wp_ajax_nopriv_removeTemplate', 'removeTemplate', 85);
add_action( 'wp_ajax_removeTemplate', 'removeTemplate', 85 );
function removeTemplate(){
	
	$template_id = $_POST['template_id'];	
	 $results = array();
	 if($template_id){
		 global $wpdb;
		$user_id = get_current_user_id();							
		$table_template = $wpdb->prefix . 'template';
		$get_your_templages = $wpdb->get_results( "SELECT * FROM $table_template WHERE id=$template_id AND user_id=$user_id AND your_template=1", OBJECT );
		if(!empty($get_your_templages)){	
			$wpdb->query($wpdb->prepare("UPDATE $table_template 
			 SET your_template=0,
			 user_id=$user_id
			 WHERE id=$template_id AND user_id=$user_id AND your_template=1"));
			 
			 $results = array(
				'success' => true,
				'mess' => 'Template successfully removed.'				
			 );
			 
		} else {			
			$results = array(
				'success' => false,
				'mess' => 'This template is already removed!'				
			 );
		} 
	 } else {
		 $results = array(
			'success' => false,
			'mess' => 'Template is not valid, please, select valid template!'
		 );
	 }
	echo json_encode($results);        
	die();
}

add_action( 'wp_ajax_nopriv_addTemplateItem', 'addTemplateItem', 85);
add_action( 'wp_ajax_addTemplateItem', 'addTemplateItem', 85 );
function addTemplateItem(){
	
	$template_name = $_POST['template_name'];	
	 $results = array();
	 if($template_name){
		 global $wpdb;
		$user_id = get_current_user_id();							
		$table_template = $wpdb->prefix . 'template';
		$wpdb->insert($table_template, array('name' => $template_name,'user_id' => $user_id,'logo_url' => 'http://via.placeholder.com/350x150'));
		$template_id = $wpdb->insert_id;
		if($template_id){
			$results = array(
				'success' => true,
				'mess' => 'Template successfully added.',
				'template_id'=> $template_id
			 );
		} else {
			$results = array(
				'success' => false,
				'mess' => 'Template adding problem detected!'
			 );
		}
	 } else {
		 $results = array(
			'success' => false,
			'mess' => 'Template adding problem detected!'
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

add_action( 'wp_ajax_nopriv_saveDynamicFormReport', 'saveDynamicFormReport', 85);
add_action( 'wp_ajax_saveDynamicFormReport', 'saveDynamicFormReport', 85 );
function saveDynamicFormReport(){
	$inspection_id = $_POST['inspection_id'];	
	 $results = array();
	 if($inspection_id){
		 global $wpdb;
		 $saved = $_POST['saved'];
		 $inspectionReportDetail = $wpdb->prefix . 'inspectionreportdetail';
		 $formJsonData = !empty($_POST['formJsonData']) ? $_POST['formJsonData'] : '';
		 if(empty($saved) || $saved==0){
			$wpdb->insert($inspectionReportDetail, array('inspectionId' => $inspection_id));
			$lastid = $wpdb->insert_id;
		 } else {
			 $lastid = $saved;
		 }
		$wpdb->query($wpdb->prepare("UPDATE $inspectionReportDetail 
		 SET fieldTextHtml='".$formJsonData."'
		 WHERE id=$lastid"));
		 
		 $results = array(
			'success' => true,
			'mess' => 'Data Successfully updated.',
			'template_id' => $template_id,
			'report_detail_id' => $lastid
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

add_action( 'wp_ajax_nopriv_save_form_data', 'save_form_data', 85);
add_action( 'wp_ajax_save_form_data', 'save_form_data', 85 );
function save_form_data(){
	$template_id = $_POST['template_id'];
	print_r($_POST);
	die();
	 $results = array();
	 if($template_id){
		if(!empty($_POST)){
			unset($_POST['action']);
			unset($_POST['template_id']);
			global $wpdb;
			$user_ID = get_current_user_id();
			$form_name = $_POST['this_form_name'];	
			
			$form_data = $wpdb->prefix . 'form_data';
			$form_info = $wpdb->prefix . 'form_info';
			$wpdb->insert($form_info, array('template_id' => $template_id,'form_name' => $form_name,'created_by' => $user_ID,'updated_by' => $user_ID));
			$form_id = $wpdb->insert_id;			
			foreach ($_POST as $param_name => $param_val) {						
				$wpdb->insert($form_data, array('form_id' => $form_id,'field_name' => $param_name,'field_value' => $param_val));
			}
			$results = array(
				'success' => true,
				'mess' => 'Data Successfully updated.',
				'template_id' => $template_id,
				'allData' => $user_ID
				);
		}
	 } else {
		 $results = array(
			'success' => false,
			'mess' => 'Form data not save, there are some error to save.',
		 );
	 }	 
	echo json_encode($results);        
	die();
}

add_role(
    'inspector',
    __( 'Inspector' ),
    array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => false,
		'delete_posts' => false, // Use false to explicitly deny
    )
);

if ( current_user_can('inspector') && !current_user_can('upload_files') )
add_action('admin_init', 'allow_new_role_uploads');


function allow_new_role_uploads() {
    $new_role = get_role('inspector');
    $new_role->add_cap('upload_files');
}

add_action('admin_menu', 'realestate_menu_pages');
function realestate_menu_pages(){
    $form_data_page = add_menu_page('Form data', 'Form data', 'manage_options', 'form-data', 'form_data_output' );
	add_action( 'admin_print_styles-' . $form_data_page, 'form_data_options_scripts' );
}
function form_data_output(){
	global $wpdb;
	$user_ID = get_current_user_id();
	$template = $wpdb->prefix . 'template';
	$form_info = $wpdb->prefix . 'form_info';
	$form_data = $wpdb->prefix . 'form_data';
	?>
	<div class="wrap">
	<h1 class="wp-heading-inline">Form data</h1>
		<fieldset style="position: relative;">			
			<table id="form-data" class="display order-completion-table" cellspacing="0" border="0" style="border:1px solid #444;" width="100%">
			<?php if(isset($_GET['fid']) && $_GET['fid'] !=''){ 
				$fid = $_GET['fid'];
				$form_data_sql = "SELECT fd.id,fd.form_id,fd.field_name,fd.field_value,fi.form_name,fi.created_at,fi.created_by,ti.name as template_name 
				FROM $form_data as fd
				left join $form_info as fi on fi.id = fd.form_id
				left join $template as ti on ti.id = fi.template_id
				WHERE form_id=$fid";
				$get_form_data = $wpdb->get_results($form_data_sql , OBJECT );
			?>
				<thead>
					<tr style="background-color:#444;color:#fff;">
						<th>Template Name</th>
						<th>Form Name</th>
						<th>Form Field</th>
						<th>Form Value</th>
						<th>Created by</th>
						<th>Created at</th>	
					</tr>
				</thead>
				<tbody>
					<?php foreach($get_form_data as $each_form_data): ?>
						<tr>
							<td><?php echo $each_form_data->template_name; ?></td>
							<td><?php echo $each_form_data->form_name; ?></td>
							<td><?php echo $each_form_data->field_name; ?></td>
							<td><?php echo $each_form_data->field_value; ?></td>
							<td><?php echo $each_form_data->created_by; ?></td>
							<td><?php echo $each_form_data->created_at; ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			<?php } else { ?>
				<thead>
					<tr style="background-color:#444;color:#fff;">
						<th>Template Name</th>
						<th>Form Name</th>
						<th>Created by</th>
						<th>Created at</th>						
						<th>Form data</th>
						<th>Form Url</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$get_form_info = $wpdb->get_results( "SELECT fi.id,fi.template_id,fi.form_name,fi.created_at,fi.created_by,ti.name as template_name FROM $form_info as fi left join $template as ti on ti.id = fi.template_id", OBJECT );
					foreach($get_form_info as $each_form_info):
					?>
						<tr>
							<td><?php echo $each_form_info->template_name; ?></td>
							<td><a style="text-decoration: none;" href="<?php echo admin_url( 'admin.php?page=form-data&action=view&fid='.$each_form_info->id ); ?>" alt="Order Completion Form" target="_self"><?php echo $each_form_info->form_name; ?></a></td>
							<td><?php echo $each_form_info->created_by; ?></td>
							<td><?php echo $each_form_info->created_at; ?></td>
							<td><a style="text-decoration: none;" href="<?php echo admin_url( 'admin.php?page=form-data&action=view&fid='.$each_form_info->id ); ?>" alt="Order Completion Form" target="_self">Click here</a></td>
							<td><a style="text-decoration: none;" href="<?php echo home_url('/realestate/form-builder/?item='.$each_form_info->template_id); ?>" alt="Order Completion Form" target="_blank"><span class="dashicons dashicons-external"></span></a></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			<?php } ?>
			</table>
		</fieldset>
	</div>	
	<?php
}
function form_data_options_scripts(){
	wp_enqueue_script( 'jquery-dataTables-script', get_template_directory_uri() . '/js/jquery.dataTables.min.js', array ( 'jquery' ), 1.1, true );
	wp_enqueue_script( 'custom-script', get_template_directory_uri() . '/js/custom_scripts.js', array ( 'jquery' ), 1.1, true );
	wp_enqueue_style( 'jquery-dataTables-style', get_template_directory_uri() . '/css/jquery.dataTables.min.css', true );
}

function ajax_login_init(){

    wp_register_script('ajax-login-script', get_template_directory_uri() . '/js/ajax-login-script.js', array('jquery') ); 
    wp_enqueue_script('ajax-login-script');

    wp_localize_script( 'ajax-login-script', 'ajax_login_object', array( 
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'templateurl' => home_url('/template/'),
		'inspectorurl' => home_url('/perform-inspection/'),
		'homeurl' => home_url(),
        'loadingmessage' => __('Sending user info, please wait...')
    ));

    // Enable the user with no privileges to run ajax_login() in AJAX
    add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );
}

// Execute the action only if the user isn't logged in
if (!is_user_logged_in()) {
    add_action('init', 'ajax_login_init');
}

function ajax_login(){
	
    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-login-nonce', 'security' );
    // Nonce is checked, get the POST data and sign user on
    $info = array();
    $info['user_login'] = $_POST['username'];
    $info['user_password'] = $_POST['password'];
    $info['remember'] = true;

    $user_signon = wp_signon( $info, false );
    if ( is_wp_error($user_signon) ){
        echo json_encode(array('loggedin'=>false, 'user_roles'=>'', 'message'=>__('Wrong username or password.')));
    } else {
        echo json_encode(array('loggedin'=>true, 'user_roles'=>$user_signon->roles[0], 'message'=>__('Login successful, redirecting...')));
    }

    die();
}

add_action( 'wp_ajax_nopriv_savedrawingimages', 'savedrawingimages', 85);
add_action( 'wp_ajax_savedrawingimages', 'savedrawingimages', 85 );
function savedrawingimages(){
	
$data = $_POST['file'];
if(empty($data)){ 
	$results_data = array(
		'success' => false,
		'mess' => 'Form data not save, there are some error to save.',
		'allPost'=>is_wp_error( $temp_file )
	 );
	 echo json_encode($results_data);        
	die();
}

$uploads = wp_upload_dir();
$file_name = time().'.png';
$uploadfile = $uploads['path'] .'/'.$file_name;
list($type, $data) = explode(';', $data);
list(, $data)      = explode(',', $data);
$data = base64_decode($data);

file_put_contents($uploadfile, $data);

$attachment = array(
    'post_mime_type' => 'image/png',
    'post_title' => $filename,
    'post_content' => '',
    'post_status' => 'inherit'
);

$attach_id = wp_insert_attachment( $attachment, $uploadfile );

$imagenew = get_post( $attach_id );
$fullsizepath = get_attached_file( $imagenew->ID );
$attach_data = wp_generate_attachment_metadata( $attach_id, $fullsizepath );
wp_update_attachment_metadata( $attach_id, $attach_data );

if($attach_id){
	$template_id = $_POST['template_id'];
	$hash_id = $_POST['hash_id'];
	$report_id = $_POST['report_id'];
	$saved = $_POST['saved'];
	$results_data = array(
		'success' => true,
		'mess' => 'Data Successfully updated.',
		'template_id' => $template_id,
		'attach_id' => $attach_id,
		'redirect_url'=> home_url('/form-viewer/?item='.$template_id.'&att='.$attach_id.'&hash='.$hash_id.'&report='.$report_id.'&saved='.$saved)
	);  
} else {
	$results_data = array(
		'success' => false,
		'mess' => 'Form data not save, there are some error to save.',
	 );
}
echo json_encode($results_data);        
die();
}

add_action( 'wp_enqueue_scripts', 'enqueue_scripts');
function enqueue_scripts() {
    wp_enqueue_media();
    /*wp_enqueue_script(
        'some-script',
        get_template_directory_uri() . '/js/media-uploader.js',
        // if you are building a plugin
        // plugins_url( '/', __FILE__ ) . '/js/media-uploader.js',
        array( 'jquery' ),
        null
    );*/
}