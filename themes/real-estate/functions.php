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


add_action( 'wp_ajax_nopriv_send_agent_email', 'send_agent_email', 85);
add_action( 'wp_ajax_send_agent_email', 'send_agent_email', 85 );
function send_agent_email(){
	$agentEmailAddress = $_POST['agentEmailAddress'];
	 $results = array();
	 if($agentEmailAddress){
		 global $wpdb;
		 $agent_email_log = $wpdb->prefix . 'agent_email_log';
		 $template_table = $wpdb->prefix . 'template';
		 $inspection_table = $wpdb->prefix . 'inspection';
		 $getSelected = !empty($_POST['getSelected']) ? $_POST['getSelected'] : [];
		 $getSelectedReport = !empty($_POST['getSelectedReport']) ? $_POST['getSelectedReport'] : [];
		 $getSelectedSaved = !empty($_POST['getSelectedSaved']) ? $_POST['getSelectedSaved'] : [];
		 $getSelectedTitle = !empty($_POST['getSelectedTitle']) ? $_POST['getSelectedTitle'] : [];
		 $getSelectedCompany = !empty($_POST['getSelectedCompany']) ? $_POST['getSelectedCompany'] : [];
		 $getSelectedPrep = !empty($_POST['getSelectedPrep']) ? $_POST['getSelectedPrep'] : [];
		 $expSelected = explode(',',$getSelected);
		 $expSelectedReport = explode(',',$getSelectedReport);
		 $expSelectedSaved = explode(',',$getSelectedSaved);
		 $expSelectedTitle = explode(',',$getSelectedTitle);
		 $expSelectedCompany = explode(',',$getSelectedCompany);
		 $expSelectedPrep = explode(',',$getSelectedPrep);
		 $user = wp_get_current_user();
		 $agentViewer = home_url('/agent-form-viewer/');

		require get_template_directory() . '/emailQue/mail_setting.php';
		$fromEmail = !empty($user->user_email) ? $user->user_email : 'notifications@mail.contentfirst.marketing';
		//$mail->SetFrom($fromEmail, 'clearagain.net');
		//$mail->FromName = 'clearagain.net';
		//$mail->From = 'notification@mail.clearagain.net';
		
		$mail->AddReplyTo($fromEmail, $user->display_name);
		$mail->SetFrom('notifications@mail.contentfirst.marketing', $fromEmail);
		//$email_to = 'jakir44.du@gmail.com';		
		//$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
		$expEmail = explode(',',$agentEmailAddress);
		if(!empty($expEmail[1])){
			foreach($expEmail as $eachEmail){
				$mail->addAddress($eachEmail);
			}
		} else {
			$mail->addAddress($agentEmailAddress);
		}
		

		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML
		$bodyText = '';
		$inc=1;
		$identificationNo = '';
		$bodyText .= "An inspection has been shared with you.  Use this to see the deficiencies identified by ";
		foreach($expSelected as $key=>$template){
			 $identified[$expSelectedCompany[$key]] = $expSelectedCompany[$key];
		}
		$identifiedd = implode(' and ',$identified);
		$bodyText .= "{$identifiedd}. Click below template links to see the details :<ul>";
		foreach($expSelected as $key=>$template){
			$get_report_id = $expSelectedReport[$key];
			 $template_id = safe_b64encode($template);
			 $report_id = safe_b64encode($get_report_id);
			 $saved_id = safe_b64encode($expSelectedSaved[$key]);
			 $emailAddress = safe_b64encode($agentEmailAddress);
			 $identificationNo = $expSelectedTitle[$key];
			 /*$get_template = $wpdb->get_results( "SELECT name FROM $template_table WHERE id=$template", OBJECT );*/
			 $get_inspection = $wpdb->get_results( "SELECT report_identification FROM $inspection_table WHERE id=$get_report_id", OBJECT );
			 /*$bodyText .= "{$get_template[0]->name} has been inspected for {$expSelectedCompany[$key]} company and prepared for : {$expSelectedPrep[$key]} Please click the report <a href='".$agentViewer."?item=".$template_id."&report=".$report_id."&saved=".$saved_id."&token=".$emailAddress."'> {$identificationNo}</a> to get details.<br/>Thanks.<br/>";*/
			 
			 $bodyText .= "<li><a href='".$agentViewer."?item=".$template_id."&report=".$report_id."&saved=".$saved_id."&token=".$emailAddress."'>{$get_inspection[0]->report_identification}</a></li>";
			 $inc++;
		}
		$bodyText .= "</ul>";
		$mail->Subject = "Report: {$identificationNo} has been shared with you.";
		$mail->Body    = $bodyText;
		$mail->AltBody = $bodyText;

		if(!$mail->send()) {
		 $results = array(
			'success' => false,
			'mess' => 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo
		 );
		} else {

		foreach($expSelected as $key=>$each_data){		
			$expires_in = date('Y-m-d h:i:s', strtotime(' + 1 days'));
			 $sendData = array(
					 'email_address' => $agentEmailAddress,
					 'template_id' => $each_data,
					 'report_id' => $expSelectedReport[$key],
					 'saved_id' => $expSelectedSaved[$key],
					 'email_by' => $user->id,
					 'email_from' => $user->user_email,
					 'expires_in' => $expires_in
				 );		 
			 $wpdb->insert($agent_email_log, 
				 $sendData
			 );
		 }	 
		$results = array(
			'success' => true,
			'mess' => 'Message has been sent'
		 );
		}
		} else {
		 $results = array(
			'success' => false,
			'mess' => 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo
		 );
		}			
	echo json_encode($results);        
	die();
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
		 $template_share = !empty($_POST['template_share']) ? $_POST['template_share'] : 'false';
		 $share_btn = !empty($_POST['share_btn']) ? $_POST['share_btn'] : 'false';
		 $print_btn = !empty($_POST['print_btn']) ? $_POST['print_btn'] : 'false';
		 $wood_inspection = !empty($_POST['wood_inspection']) ? $_POST['wood_inspection'] : 'false';
		 $no_cover = !empty($_POST['no_cover']) ? $_POST['no_cover'] : 'false';
		 $template_state = !empty($_POST['template_state']) ? $_POST['template_state'] : '';
		 $template_state_id = !empty($_POST['template_state_id']) ? $_POST['template_state_id'] : '';
		 $template_city = !empty($_POST['template_city']) ? $_POST['template_city'] : '';
		 $template_date = !empty($_POST['template_date']) ? $_POST['template_date'] : '';
		 $template_company = !empty($_POST['template_company']) ? $_POST['template_company'] : '';
		 $footer_template = !empty($_POST['footer_template']) ? $_POST['footer_template'] : '';
		 $company_email = !empty($_POST['company_email']) ? $_POST['company_email'] : '';
		 $company_address = !empty($_POST['company_address']) ? $_POST['company_address'] : '';
		 $company_phone = !empty($_POST['company_phone']) ? $_POST['company_phone'] : '';
		 $shareTem=0;
		 if($template_share == 'true') $shareTem=1;
		$wpdb->query($wpdb->prepare("UPDATE $table_template 
		 SET name='".$template_name."',
		 shared_flag='".$template_share."',
		 share_btn='".$share_btn."',
		 print_btn='".$print_btn."',
		 wood_inspection='".$wood_inspection."',
		 no_cover='".$no_cover."',
		 company_email='".$company_email."',
		 company_address='".$company_address."',
		 company_phone='".$company_phone."',
		 state='".$template_state."',
		 state_form='".$template_state_id."',
		 template_city='".$template_city."',
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
					'mess' => '<i class="fa fa-check-circle"></i>',
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
				'mess' => '<i class="fa fa-check-circle"></i>',
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
		 $time = $_POST['time'];
		 $get_selected = (!empty($_POST['get_selected']) ? $_POST['get_selected'] : '');
		 global $wpdb;
		 $saveAsDraft = $wpdb->prefix . 'ins_save_as_draft';
		 if($get_selected == 'yes'){
			 $get_saveDraft = $wpdb->get_results("SELECT * FROM $saveAsDraft WHERE user_id=$user_id AND template_id=$template_id AND hash=$hash AND drawing_type='$drawing_type' AND time=$time", OBJECT );
		 } else {
			 $get_saveDraft = $wpdb->get_results( "SELECT * FROM $saveAsDraft WHERE user_id=$user_id AND template_id=$template_id AND hash=$hash AND drawing_type='$drawing_type'", OBJECT );
	     }
		 
		 if(!empty($get_saveDraft)){
			$results = array(
				'success' => true,
				'mess' => '<i class="fa fa-check-circle"></i>',
				'template_id' => $template_id,
				'hash' => $hash,
				'user_id' => $user_id,
				'drawingName'=> $get_saveDraft[0]->drawingName,
				'drawingData'=> $get_saveDraft[0]->drawingData,
				'get_saveDraft'=> $get_saveDraft
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
		 $time = $_POST['time'];
		 global $wpdb;
		 $saveAsDraft = $wpdb->prefix . 'ins_save_as_draft';
		 $get_saveDraft = $wpdb->get_results("SELECT * FROM $saveAsDraft WHERE user_id=$user_id AND template_id=$template_id AND hash=$hash AND drawing_type='$drawing_type' AND time=$time", OBJECT );
		 //print_r($get_saveDraft);
		 if(!empty($get_saveDraft)){
		 $wpdb->update(
				$saveAsDraft, 
				array( 
					'drawingName' => $drawingName,
					'drawingData' => $drawingData
				), 
				array( 'user_id' => $user_id,'template_id' => $template_id,'hash' => $hash,'drawing_type' => $drawing_type,'time' => $time )
			);
			$status = 'update';
		 } else {
			 $insert = array(
					 'template_id' => $template_id,
					 'hash' => $hash,
					 'drawingName' => $drawingName,
					 'drawingData' => $drawingData,
					 'user_id' => $user_id,
					 'drawing_type' => $drawing_type,
					 'time' => $time
				 );
			  $wpdb->insert($saveAsDraft,$insert);
			 $status = 'insert';
		 }			 
		 $results = array(
			'success' => true,
			'mess' => '',
			'status' => $insert,
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
		 $inspection_id = !empty($_POST['inspection_id']) ? $_POST['inspection_id'] : '';
		 $inpection_date = !empty($_POST['inpection_date']) ? $_POST['inpection_date'] : '';
		 $report_identification = !empty($_POST['report_identification']) ? $_POST['report_identification'] : '';
		 $inspection_city = !empty($_POST['inspection_city']) ? $_POST['inspection_city'] : '';
		 $zip_code = !empty($_POST['zip_code']) ? $_POST['zip_code'] : '';
		 $building_orientation = !empty($_POST['building_orientation']) ? $_POST['building_orientation'] : '';
		 $weather_conditions = !empty($_POST['weather_conditions']) ? $_POST['weather_conditions'] : '';
		 $temperature = !empty($_POST['temperature']) ? $_POST['temperature'] : '';
		 $parties_present = !empty($_POST['parties_present']) ? $_POST['parties_present'] : '';
		 $template_id = !empty($_POST['template_id']) ? $_POST['template_id'] : '';
		 $prepared_for = !empty($_POST['prepared_for']) ? $_POST['prepared_for'] : '';
		 $prepared_by = !empty($_POST['prepared_by']) ? $_POST['prepared_by'] : '';
		 $licence_number = !empty($_POST['licence_number']) ? $_POST['licence_number'] : 'N/A';
		 $time_in = !empty($_POST['time_in']) ? $_POST['time_in'] : '';
		 $time_out = !empty($_POST['time_out']) ? $_POST['time_out'] : '';
		 $inspection_status = !empty($_POST['inspection_status']) ? $_POST['inspection_status'] : '';
		 
		 $inspector_type = !empty($_POST['inspector_type']) ? $_POST['inspector_type'] : '';
		 $case_number = !empty($_POST['case_number']) ? $_POST['case_number'] : '';
		 $inspection_buyer_type = !empty($_POST['inspection_buyer_type']) ? $_POST['inspection_buyer_type'] : '';
		 $owner_type = !empty($_POST['owner_type']) ? $_POST['owner_type'] : '';
		 $report_forwarded_to = !empty($_POST['report_forwarded_to']) ? $_POST['report_forwarded_to'] : '';
		 $notice_inspection = !empty($_POST['notice_inspection']) ? $_POST['notice_inspection'] : '';
		 $inspection_buyer_name = !empty($_POST['inspection_buyer_name']) ? $_POST['inspection_buyer_name'] : '';
		 $list_structure = !empty($_POST['list_structure']) ? $_POST['list_structure'] : '';
		 
		 $user_id = get_current_user_id();
		 $get_inspection = '';
		 //$get_inspection = $wpdb->get_results( "SELECT * FROM $table_inspection WHERE user_id=$user_id AND template_id=$template_id", OBJECT );
		 $get_inspection = $wpdb->get_row( "SELECT * FROM $table_inspection WHERE id=$inspection_id ORDER BY id DESC LIMIT 1");
		 
		if(!empty($get_inspection)){
			$inspectionReportDetail = $wpdb->prefix . 'inspectionreportdetail';
			$get_inspection_details = $wpdb->get_row( "SELECT id FROM $inspectionReportDetail WHERE inspectionId=$inspection_id ORDER BY id DESC LIMIT 1");
			 $wpdb->update(
				$table_inspection, 
				array(
					 'company' => $company,
					 'inpection_date' => $inpection_date,
					 'report_identification' => $report_identification,
					 'inspection_city' => $inspection_city,
					 'zip_code' => $zip_code,
					 'building_orientation' => $building_orientation,
					 'weather_conditions' => $weather_conditions,
					 'temperature' => $temperature,
					 'parties_present' => $parties_present,
					 'prepared_for' => $prepared_for,
					 'prepared_by' => $prepared_by,
					 'licence_number' => $licence_number,
					 'time_in' => $time_in,
					 'time_out' => $time_out,
					 'inspection_status' => $inspection_status,
					 'inspector_type' => $inspector_type,
					 'case_number' => $case_number,
					 'inspection_buyer_type' => $inspection_buyer_type,
					 'owner_type' => $owner_type,
					 'report_forwarded_to' => $report_forwarded_to,
					 'notice_inspection' => $notice_inspection,
					 'inspection_buyer_name' => $inspection_buyer_name,
					 'list_structure' => $list_structure
				 ), 
				array( 'id' => $inspection_id )
			);
			
			 if(!empty($inspection_id)){
				if (!function_exists('wp_handle_upload')) {
					require_once(ABSPATH . 'wp-admin/includes/file.php');
				}
				  // echo $_FILES["upload"]["name"];
				  $uploadedfile = $_FILES['cover_photo'];
				  if(!empty($uploadedfile)){
					  $upload_overrides = array('test_form' => false);
					  $movefile = wp_handle_upload($uploadedfile, $upload_overrides);

					// echo $movefile['url'];
					if ($movefile && !isset($movefile['error'])) {
						  $imageUrl = $movefile['url'];
						  $wpdb->query($wpdb->prepare("UPDATE $table_inspection SET cover_photo='".$imageUrl."' WHERE id=$inspection_id"));
					} else {
						 $results = array(
							'success' => false,
							'mess' => $movefile['error']
						 );			
					}	
				  } else {
					  $exist_img = !empty($_POST['exist_img']) ? $_POST['exist_img'] : '';
					  $wpdb->query($wpdb->prepare("UPDATE $table_inspection SET cover_photo='".$exist_img."' WHERE id=$inspection_id"));
				  }
				  
				  $header_image = $_FILES['header_image'];
				  if(!empty($header_image)){
					  $upload_overrides = array('test_form' => false);
					  $header_image_file = wp_handle_upload($header_image, $upload_overrides);
					// echo $movefile['url'];
					if ($header_image_file && !isset($header_image_file['error'])) {
						  $header_image_url = $header_image_file['url'];
						  $wpdb->query($wpdb->prepare("UPDATE $table_inspection SET header_image='".$header_image_url."' WHERE id=$inspection_id"));
					} else {
						 $results = array(
							'success' => false,
							'mess' => $header_image_file['error']
						 );			
					}	
				  } else {
					  $exist_header_img = !empty($_POST['exist_header_img']) ? $_POST['exist_header_img'] : '';
					  $wpdb->query($wpdb->prepare("UPDATE $table_inspection SET header_image='".$exist_header_img."' WHERE id=$inspection_id"));
				  }
				  
			 }
			 if(empty($results)){
				 $results = array(
					'success' => true,
					'mess' => '<i class="fa fa-check-circle"></i>',
					'report_id'=>$inspection_id,
					'template_id' => $template_id,
					'saved'=>$get_inspection_details->id
				 );
			 }
			 
			 /*$results = array(
				'success' => true,
				'mess' => '<i class="fa fa-check-circle"></i>',
				'template_id' => $template_id
			 );*/
		} else {
			 $wpdb->insert($table_inspection, 
				 array(
					 'company' => $company,
					 'inpection_date' => $inpection_date,
					 'report_identification' => $report_identification,
					 'inspection_city' => $inspection_city,
					 'zip_code' => $zip_code,
					 'building_orientation' => $building_orientation,
					 'weather_conditions' => $weather_conditions,
					 'temperature' => $temperature,
					 'parties_present' => $parties_present,
					 'template_id' => $template_id,
					 'prepared_for' => $prepared_for,
					 'prepared_by' => $prepared_by,
					 'licence_number' => $licence_number,
					 'time_in' => $time_in,
					 'time_out' => $time_out,
					 'inspection_status' => $inspection_status,
					 'inspector_type' => $inspector_type,
					 'case_number' => $case_number,
					 'inspection_buyer_type' => $inspection_buyer_type,
					 'owner_type' => $owner_type,
					 'report_forwarded_to' => $report_forwarded_to,
					 'notice_inspection' => $notice_inspection,
					 'inspection_buyer_name' => $inspection_buyer_name,
					 'list_structure' => $list_structure,
					 'user_id' => $user_id
				 )
			 );
			 $lastid = $wpdb->insert_id;
			 if(!empty($lastid)){
				if (!function_exists('wp_handle_upload')) {
					require_once(ABSPATH . 'wp-admin/includes/file.php');
				}
				  // echo $_FILES["upload"]["name"];
				  $uploadedfile = $_FILES['cover_photo'];
				  if(!empty($uploadedfile)){
					  $upload_overrides = array('test_form' => false);
					  $movefile = wp_handle_upload($uploadedfile, $upload_overrides);

					// echo $movefile['url'];
					if ($movefile && !isset($movefile['error'])) {
						  $imageUrl = $movefile['url'];
						  $wpdb->query($wpdb->prepare("UPDATE $table_inspection SET cover_photo='".$imageUrl."' WHERE id=$lastid"));
					} else {
						 $results = array(
							'success' => false,
							'mess' => $movefile['error']
						 );			
					}	
				  }
				  
				  $header_image = $_FILES['header_image'];
				  if(!empty($header_image)){
					  $upload_overrides = array('test_form' => false);
					  $header_image_file = wp_handle_upload($header_image, $upload_overrides);

					// echo $movefile['url'];
					if ($header_image_file && !isset($header_image_file['error'])) {
						  $header_image_url = $header_image_file['url'];
						  $wpdb->query($wpdb->prepare("UPDATE $table_inspection SET header_image='".$header_image_url."' WHERE id=$lastid"));
					} else {
						 $results = array(
							'success' => false,
							'mess' => $header_image_file['error']
						 );			
					}	
				  }
			 }
			 if(empty($results)){
				 $results = array(
					'success' => true,
					'mess' => '<i class="fa fa-check-circle"></i>',
					'report_id'=>$lastid,
					'template_id' => $template_id
				 );
			 }
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
				'mess' => 'Template successfully copy.22'	,
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
				 if($insert_id != ''){					 
					 $table_template_details = $wpdb->prefix . 'template_detail';
					 $get_template_details = $wpdb->get_results( "SELECT * FROM $table_template_details WHERE template_id=$template_id", OBJECT );
					 if(!empty($get_template_details)){
						 $wpdb->insert($table_template_details, 
							 array(
								 'template_id' => $insert_id,
								 'field_type_id' => $get_template_details[0]->field_type_id,
								 'field_name' => $get_template_details[0]->field_name,
								 'field_text_html' => $get_template_details[0]->field_text_html,
								 'print_flag' => $get_template_details[0]->print_flag,
								 'x_coord' => $get_template_details[0]->x_coord,
								 'x_coord_relative' => $get_template_details[0]->x_coord_relative,
								 'width' => $get_template_details[0]->width,
								 'height' => $get_template_details[0]->height
							 )
						 );
					 }
				 }
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
			/*$wpdb->query($wpdb->prepare("UPDATE $table_template 
			 SET your_template=0,
			 user_id=$user_id
			 WHERE id=$template_id AND user_id=$user_id AND your_template=1"));*/
			 $wpdb->delete( $table_template, array( 'id' => $template_id,'user_id' => $user_id,'your_template' => 1 ) );
			 $table_template_detail = $wpdb->prefix . 'template_detail';
			 $wpdb->delete( $table_template_detail, array( 'template_id' => $template_id) );
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
			'mess' => '<i class="fa fa-check-circle"></i>',
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
		 //if(empty($saved) || $saved===0){
			 $getinsDetails = $wpdb->get_results( "SELECT id,fieldTextHtml FROM $inspectionReportDetail WHERE inspectionId=$inspection_id", OBJECT );
			 if(empty($getinsDetails)){
				$wpdb->insert($inspectionReportDetail, array('inspectionId' => $inspection_id));
				$lastid = $wpdb->insert_id;
			 } else {
				 $lastid = $getinsDetails[0]->id;
			 }
		 //} else {
			 //$lastid = $saved;
		 //}
		$updateStatus = $wpdb->query($wpdb->prepare("UPDATE $inspectionReportDetail 
		 SET fieldTextHtml='".$formJsonData."'
		 WHERE id=$lastid AND fieldTextHtml != '".$formJsonData."'"));
		 
		 $results = array(
			'success' => true,
			'mess' => '<i class="fa fa-check-circle"></i>',
			'template_id' => '',
			'report_detail_id' => $lastid,
			'updateStatus'=>$updateStatus
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
				'mess' => '<i class="fa fa-check-circle"></i>',
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

add_role(
    'company_admin',
    __( 'Company Admin' ),
    array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => false,
		'delete_posts' => false, // Use false to explicitly deny
    )
);

if ( (current_user_can('inspector') && !current_user_can('upload_files')) || (current_user_can('company_admin') && !current_user_can('upload_files')) )
add_action('admin_init', 'allow_new_role_uploads');
function allow_new_role_uploads() {
    $inspector_role = get_role('inspector');
    $inspector_role->add_cap('upload_files');
	$company_role = get_role('company_admin');
    $company_role->add_cap('upload_files');
}

add_action('admin_menu', 'realestate_menu_pages');
function realestate_menu_pages(){	
	add_menu_page('Templates Settings Page', 'Templates Settings', 'manage_options', 'get-template', 'get_templates_output' );
    $get_templates_page = add_submenu_page('get-template', 'All Templates', 'All Templates', 'manage_options', 'get-template' );
    $get_inspection_page = add_submenu_page('get-template', 'All Inspections', 'All Inspections', 'manage_options', 'get-inspection','get_inspection_output' );
	add_action( 'admin_print_styles-' . $get_templates_page, 'get_templates_options_scripts' );
	add_action( 'admin_print_styles-' . $get_inspection_page, 'get_templates_options_scripts' );
}
function get_templates_output(){
	global $wpdb;
	$user_ID = get_current_user_id();
	$template = $wpdb->prefix . 'template';
	$template_detail = $wpdb->prefix . 'template_detail';
	?>
	<div class="wrap">
	<h1 class="wp-heading-inline">All Templates</h1>
		<fieldset style="position: relative;">			
			<table id="template-data" class="display order-completion-table" cellspacing="0" border="0" style="border:1px solid #444;" width="100%">
			<?php if(isset($_GET['tid']) && $_GET['tid'] !=''){ 
					$tid = $_GET['tid'];
					$tempid = $wpdb->delete( $template, array( 'id' => $tid ) );
					$wpdb->delete( $template_detail, array( 'template_id' => $tid ) );
					if(isset($_GET['rev']) && $_GET['rev'] =='on'){
						$inspection = $wpdb->prefix . 'inspection';
						$get_inspection_id = $wpdb->get_results( "SELECT id FROM $inspection WHERE template_id=$tid", OBJECT );
						if(!empty($get_inspection_id)){
							$wpdb->delete( $inspection, array( 'template_id' => $tid ) );
							$inspectionreportdetail = $wpdb->prefix . 'inspectionreportdetail';
							foreach($get_inspection_id as $each_inspection){
								$wpdb->delete( $inspectionreportdetail, array( 'inspectionId' => $each_inspection->id ) );
							}
						}
					}
					$templateUrl = admin_url( 'admin.php?page=get-template' );
					echo '<script>window.location="'.$templateUrl.'";</script>';
				} else { ?>
				<thead>
					<tr style="background-color:#444;color:#fff;">
						<th>#</th>
						<th>Template Name</th>
						<th>Share</th>
						<th>State</th>
						<th>Company</th>						
						<th>Created By</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$users_table = $wpdb->prefix . 'users';
					$get_templates = $wpdb->get_results( "SELECT * FROM $template", OBJECT );
					$inc=1;
					foreach($get_templates as $each_template):
					$user_id = $each_template->user_id;
					$get_users = $wpdb->get_results( "SELECT user_email,display_name FROM $users_table WHERE ID=$user_id" );
					?>
						<tr>
							<td><?php echo $inc; ?></td>
							<td><?php echo $each_template->name; ?></td>
							<td><?php echo $each_template->shared_flag; ?></td>
							<td><?php echo $each_template->state; ?></td>
							<td><?php echo $each_template->companyId; ?></td>
							<td><?php echo $get_users[0]->display_name.' [ '.$get_users[0]->user_email.' ]'; ?></td>
							<td>
								<a style="text-decoration: none;" href="<?php echo home_url('/form-builder/?item='.$each_template->id); ?>" alt="Template" target="_blank"><span class="dashicons dashicons-external"></span></a>
								<a style="text-decoration: none;" href="javascript:void(0)" alt="Remove Template" target="_self" class="trigger_popup_fricc" onClick="trigger_popup_fricc(this)" data-template="<?php echo esc_attr($each_template->id); ?>"><span class="dashicons dashicons-trash"></span></a>
							</td>
						</tr>
					<?php $inc++; endforeach; ?>
				</tbody>
			<?php } ?>
			</table>
		</fieldset>
		<div class="hover_bkgr_fricc">
			<span class="helper"></span>
			<div>
				<div class="popupCloseButton">X</div>
				<p> 
					<form method="get">
						<input type="hidden" name="page" value="get-template"/>
						<input type="hidden" name="tid" id="get_template_id" value=""/>
						<label for="remove_everything">Do you want to remove everything? If you want, check this</label>
						<input type="checkbox" name="rev" id="remove_everything"/>
						<br>
						<br>
						<input class="page-title-action" type="submit" name="trash" value="Next"/> 
					</form>
				</p>
			</div>
		</div>
	</div>	
	<?php
}
function get_inspection_output(){
	global $wpdb;
	$table_inspection = $wpdb->prefix . 'inspection';
	$inspectionreportdetail = $wpdb->prefix . 'inspectionreportdetail';
	?>
	<div class="wrap">
	<h1 class="wp-heading-inline">All Inspections</h1>
		<fieldset style="position: relative;">			
			<table id="inspection-data" class="display order-completion-table" cellspacing="0" border="0" style="border:1px solid #444;" width="100%">
			<?php if(isset($_GET['ispid']) && $_GET['ispid'] !=''){ 
					$ispid = $_GET['ispid'];
					$wpdb->delete( $table_inspection, array( 'id' => $ispid ) );
					$wpdb->delete( $inspectionreportdetail, array( 'inspectionId' => $ispid ) );
					$inspectionUrl = admin_url( 'admin.php?page=get-inspection' );
					echo '<script>window.location="'.$inspectionUrl.'";</script>';
				} else { ?>
				<thead>
					<tr style="background-color:#444;color:#fff;">
						<th>#</th>
						<th>Report Id</th>
						<th>Prepared For</th>
						<th>Date</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php 						
						$get_inspection = $wpdb->get_results( "SELECT ins.id,ins.company,ins.template_id,ins.report_identification,ins.prepared_for,ins.inpection_date,ird.id as ird_id FROM $table_inspection as ins JOIN $inspectionreportdetail as ird ON ird.inspectionId=ins.id", OBJECT );
						
						if(!empty($get_inspection)) {
						$inc=1;
						foreach($get_inspection as $inspection){
						?>
						<tr>
							<td><?php echo $inc; ?></td>
							<td><a target="_blank" href="<?php echo home_url('/form-viewer/?item='.$inspection->template_id.'&report='.$inspection->id.'&saved='.$inspection->ird_id); ?>" class="link-<?php echo $inc; ?>" title="<?php echo $inspection->report_identification; ?>"><?php echo $inspection->report_identification; ?></a></td>
							<td><?php echo $inspection->prepared_for; ?></td>
							<td><?php echo $inspection->inpection_date; ?></td>
							<td>
								<a style="text-decoration: none;" href="<?php echo home_url('/form-viewer/?item='.$inspection->template_id.'&report='.$inspection->id.'&saved='.$inspection->ird_id); ?>" alt="Inspection" target="_blank"><span class="dashicons dashicons-external"></span></a>
								<a style="text-decoration: none;" href="<?php echo admin_url( 'admin.php?page=get-inspection&action=trash&ispid='.$inspection->id ); ?>" alt="Remove Template" target="_self"><span class="dashicons dashicons-trash"></span></a>
							</td>
						</tr>
					<?php $inc++; }} ?>
					
				</tbody>
			<?php } ?>
			</table>
		</fieldset>
	</div>	
	<?php
}
function get_templates_options_scripts(){
	wp_enqueue_script( 'jquery-dataTables-script', get_template_directory_uri() . '/js/jquery.dataTables.min.js', array ( 'jquery' ), 1.1, true );
	wp_enqueue_script( 'custom-script', get_template_directory_uri() . '/js/custom_scripts.js', array ( 'jquery' ), 1.1, true );
	wp_enqueue_style( 'jquery-dataTables-style', get_template_directory_uri() . '/css/jquery.dataTables.min.css', true );
	wp_enqueue_style( 'custom-dataTables-style', get_template_directory_uri() . '/css/custom_admin_css.css', true );
}

function ajax_login_init(){

    wp_register_script('ajax-login-script', get_template_directory_uri() . '/js/ajax-login-script.js', array('jquery') ); 
    wp_enqueue_script('ajax-login-script');

    wp_localize_script( 'ajax-login-script', 'ajax_login_object', array( 
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'templateurl' => home_url('/template/'),
		'inspectorurl' => home_url('/perform-inspection/'),
		'homeurl' => home_url('/landing-page/'),
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

global $wpdb;
$report_id = $_POST['report_id'];
$table_inspection = $wpdb->prefix . 'inspection';	
$get_inspection = $wpdb->get_row( "SELECT * FROM $table_inspection WHERE id=$report_id ORDER BY id DESC LIMIT 1");
$report_identification = (!empty($get_inspection->report_identification) ? sanitize_title($get_inspection->report_identification.'-'.date('Y-m-d  h-i-s a', time())) : time());

$uploads = wp_upload_dir();
$file_name = $report_identification.'.png';
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
$attachemntUrl = wp_get_attachment_image_src( $imagenew->ID, 'full' );

if($attach_id){
	$template_id = $_POST['template_id'];
	$hash_id = $_POST['hash_id'];
	$saved = $_POST['saved'];
	$results_data = array(
		'success' => true,
		'mess' => '<i class="fa fa-check-circle"></i>',
		'template_id' => $template_id,
		'attach_id' => $attach_id,
		'attachemntUrl'=>$attachemntUrl[0],
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

add_action( 'wp_ajax_nopriv_deletdrawingimages', 'deletdrawingimages', 85);
add_action( 'wp_ajax_deletdrawingimages', 'deletdrawingimages', 85 );
function deletdrawingimages(){
$template_id = $_POST['template_id'];
	$results = array();
	if($template_id){
	 $user = wp_get_current_user();
	 $user_id = $user->ID;
	 $drawing_type = $_POST['drawingtype'];
	 $time = $_POST['time'];
	 $get_selected = (!empty($_POST['get_selected']) ? $_POST['get_selected'] : '');
	 global $wpdb;
	 $saveAsDraft = $wpdb->prefix . 'ins_save_as_draft';
	 $get_saveDraft = $wpdb->get_results("SELECT * FROM $saveAsDraft WHERE user_id=$user_id AND template_id=$template_id AND drawing_type='$drawing_type' AND time=$time", OBJECT );
	 if(!empty($get_saveDraft)){		
		 $del_id = $get_saveDraft[0]->id;
		$wpdb->query( "DELETE  FROM {$saveAsDraft} WHERE id = '{$del_id}' AND time = '{$time}'" );
		$results = array(
			'success' => true,
			'mess' => '<i class="fa fa-check-circle"></i>',
		 );
	 } else {
		 $results = array(
			'success' => false,
			'mess' => 'You have no access right! Please contact system administration for more information.'
		 );
	 }
} else {
	$results = array(
		'success' => false,
		'mess' => 'You have no access right! Please contact system administration for more information.'
	 );
 }
echo json_encode($results);        
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
add_action('pre_get_posts','ml_restrict_media_library');

function ml_restrict_media_library( $wp_query_obj ) {
    global $current_user, $pagenow;
	if(!empty($current_user->roles[0]) && $current_user->roles[0] == 'administrator')
	return;
    if( !is_a( $current_user, 'WP_User') )
    return;
    if( 'admin-ajax.php' != $pagenow || $_REQUEST['action'] != 'query-attachments' )
    return;
    if( !current_user_can('manage_media_library') ){
		$parrent_user = esc_attr( get_the_author_meta( 'parrent_user', $current_user->ID ) );
		if(empty($parrent_user)) $parrent_user = $current_user->ID;
		$users = get_users(array(
			'meta_key'     => 'parrent_user',
			'meta_value'   => $parrent_user,
			'meta_compare' => '=',
		));
		$user_all[] = $parrent_user;
		if(!empty($users)){
			foreach($users as $user){
				$user_all[] = $user->ID;
			}
		}
		$selected_user = implode(',',$user_all);
		$wp_query_obj->set('author', "$selected_user" );
	}
    return;
}

add_action( 'show_user_profile', 'parrent_user_profile_fields' );
add_action( 'edit_user_profile', 'parrent_user_profile_fields' );
add_action( 'user_new_form', 'parrent_user_profile_fields' );

function parrent_user_profile_fields( $user ) { 
$args = array(
    'role'    => 'inspector',
    'orderby' => 'user_nicename',
    'order'   => 'ASC'
);
$users = get_users( $args );
$parrent_user = esc_attr( get_the_author_meta( 'parrent_user', $user->ID ) );
?>
    <table class="form-table">
    <tr>
        <th><label for="parrent_user"><?php _e("Parrent User"); ?></label></th>
        <td>
		<select name="parrent_user" id="parrent_user">
		<?php
			echo '<option value="">Select one</option>';
			foreach ( $users as $user ) {
				$selected = ($parrent_user==$user->ID ? 'selected="selected"' : '');
				echo '<option '.$selected.' value="'.esc_attr($user->ID).'">' . esc_html( $user->display_name ) . ' [' . esc_html( $user->user_login ) . ']</option>';
			}
		?>
		</select>
        </td>
    </tr>
    </table>
<?php }

add_action( 'user_register', 'save_parrent_user_profile_fields' );
add_action( 'profile_update', 'save_parrent_user_profile_fields' );

function save_parrent_user_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }
	if(isset($_POST['parrent_user'])){
		update_user_meta( $user_id, 'parrent_user', $_POST['parrent_user'] );
	}
}

function parrent_user_column( $column ) {
    $column['parrent_user'] = 'Parrent Users';
    return $column;
}
add_filter( 'manage_users_columns', 'parrent_user_column' );

function parrent_user_table_row( $val, $column_name, $user_id ) {
    switch ($column_name) {
        case 'parrent_user' :
            $parrent_user_id = get_the_author_meta( 'parrent_user', $user_id );
			if(!empty($parrent_user_id)){
				$parrent_user=get_userdata($parrent_user_id);
				return esc_html( $parrent_user->display_name ) . ' [' . esc_html( $parrent_user->user_login ) . ']';
			} else { return '—'; }
            break;
        default:
    }
    return $val;
}
add_filter( 'manage_users_custom_column', 'parrent_user_table_row', 10, 3 );


/**
 * New User profile
 *
 */
function company_profile_clb() {
 
  // Verify nonce
  if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'company_profile_update' ) ){
	  $results = array(
			'success' => false,
			'mess' => 'Ooops, something went wrong, please try again later.'
		);
  }
 $user = wp_get_current_user();
  // Post values
	$user_fullname = $_POST['user_fullname'];
    $company_password     = $_POST['company_password'];
	$licence_number = $_POST['licence_number'];
    $phone_number     = $_POST['phone_number'];
    $confirm_pass     = $_POST['confirm_pass'];

    // Return
	$results = array();
	$user_id = $user->ID;
	$user_id = wp_update_user( array( 
		'ID' => $user_id, 
		'display_name' => $user_fullname 
	));

	if ( is_wp_error( $user_id ) ) {
		$results = array(
			'success' => false,
			'mess' => 'There was an error, probably that user does not exist.'
		);
	} else {
		if(!empty($confirm_pass))
		wp_set_password( $confirm_pass, $user_id );
	
		update_user_meta( $user_id, 'licence_number', $licence_number);
		update_user_meta( $user_id, 'phone_number', $phone_number);
		$results = array(
			'success' => true,
			'mess' => '<i class="fa fa-check-circle"></i>'
		 );
	}
	echo json_encode($results); 
	die(); 
}
if (is_user_logged_in()) {
	add_action('wp_ajax_company_profile_clb', 'company_profile_clb');
	add_action('wp_ajax_nopriv_company_profile_clb', 'company_profile_clb');
}


/**
 * New User registration
 *
 */
function company_registration_clb() {
 
  // Verify nonce
  if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'company_new_user' ) ){
	  $results = array(
			'success' => false,
			'mess' => 'Ooops, something went wrong, please try again later.'
		);
  }
 $user = wp_get_current_user();
  // Post values
    $registration_as = $_POST['registration_as'];
	$company_name = $_POST['company_name'];
	$user_fullname = $_POST['user_fullname'];
    $email_address = $_POST['email_address'];
    $company_username    = $_POST['company_username'];
	$licence_number = $_POST['licence_number'];
    $phone_number    = $_POST['phone_number'];
    $company_password     = $_POST['company_password'];
    $confirm_pass     = $_POST['confirm_pass'];
 
    /**
     * IMPORTANT: You should make server side validation here!
     *
     */
	if($registration_as == 'inspector'){
		$user_role = 'inspector';
	} else {
		$user_role = 'company_admin';
	}
    $userdata = array(
        'user_login' => $company_username,
        'user_pass'  => $confirm_pass,
        'user_email' => $email_address,
        'first_name' => $user_fullname,
		'role' => $user_role
    );
 
    $user_id = wp_insert_user( $userdata ) ;
 
    // Return
	$results = array();
	if (!is_wp_error($user_id)) {
		if($registration_as == 'new_company' && $user->roles[0] == 'administrator'){
			add_user_meta( $user_id, 'company_name', $company_name);
		} else {
			add_user_meta( $user_id, 'parrent_user', $company_name);
		}
		
		add_user_meta( $user_id, 'licence_number', $licence_number);
		add_user_meta( $user_id, 'phone_number', $phone_number);
		
		$results = array(
			'success' => true,
			'mess' => '<i class="fa fa-check-circle"></i>'
		 );
	} else {
		if (isset($user_id->errors['empty_user_login'])) {
			$results = array(
				'success' => false,
				'mess' => 'User Name and Email are mandatory'
			);
		} elseif (isset($user_id->errors['existing_user_login'])) {
		  $results = array(
				'success' => false,
				'mess' => 'User name already exixts.'
			);
		} else {
		  $results = array(
				'success' => false,
				'mess' => 'Error Occured please fill up the sign up form carefully.'
			);
		}
	}
	echo json_encode($results); 
	die(); 
}
add_action('wp_ajax_company_registration_clb', 'company_registration_clb');
add_action('wp_ajax_nopriv_company_registration_clb', 'company_registration_clb');

if (is_user_logged_in()) {
	if(isset($_GET['company-trash']) || isset($_GET['inspector-trash'])){
		add_action('init', 'company_inspector_action');
	}
}
function company_inspector_action() {
	$user = wp_get_current_user();
	if(!empty($user) && $user->roles[0] == 'administrator' && !empty($user) || $user->roles[0] == 'company_admin'){
		if(isset($_GET['company-trash']) && !empty($_GET['company-trash'])){
			require_once(ABSPATH.'wp-admin/includes/user.php' );
			$companyId = safe_b64decode($_GET['company-trash']);			
			$company_args = array(
			 'role' => 'company_admin',
			 'orderby' => 'user_nicename',
			 'order' => 'ASC',
			 'meta_query' => array(
				array(
					'key' => 'parrent_user',
					'value' => $companyId,
					'compare' => 'EXISTS',
				),
			  )
			);
			$company_users = get_users($company_args);
			if(!empty($company_users)) {
				$thisAllUser[] = $companyId;
				foreach($company_users as $company_user){
					$thisAllUser[] = $company_user->ID;
				}
			}
			if(!empty($thisAllUser)) {
				foreach($thisAllUser as $eachUser):
					wp_delete_user( $eachUser );
				endforeach;
			}
		}
		
		if(isset($_GET['inspector-trash']) && !empty($_GET['inspector-trash'])){
			require_once(ABSPATH.'wp-admin/includes/user.php' );
			$inspectorId = safe_b64decode($_GET['inspector-trash']);
			wp_delete_user( $inspectorId );
		}
	}
}

function isMobile() {
	$useragent=$_SERVER['HTTP_USER_AGENT'];
	if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
		$is_mobile=true;
	} else {
		$is_mobile=false;
	}
	return $is_mobile;
}
//add_shortcode( 'inspector', 'shortcode_inspector' );
//add_action( 'wp_ajax_nopriv_shortcode_wdi', 'shortcode_wdi', 85);
//add_action( 'wp_ajax_shortcode_wdi', 'shortcode_wdi', 85 );
function shortcode_wdi($content){
	global $wpdb;
	$templateId = !empty($_GET['template']) ? $_GET['template'] : '';
	$template_id = !empty($_GET['item']) ? $_GET['item'] : $templateId;
	$inspector_name = '';
	$inspection_company = "<span class='every_span'><div class='under_line'>N/A</div>Name of Inspection Company</span>";
	$inpection_date = "<span class='every_span'><div class='under_line'>N/A</div>Date of inspected</span>";
	$inspected_address = "<span class='every_span'>N/A<br>Inspected Address</span>";
	$inspection_city = "<span class='every_span'>N/A<br>City</span>";
	$inspected_address_zip = "<span class='every_span'><div class='under_line'>N/A</div>Zip Code</span>";
	$company_address = "<span class='every_span'><div class='under_line'>N/A</div>Address of Inspection Company</span>";
	$inspection_email = "<span class='every_span'><div style='border-bottom: 2px solid #337ab7;'>N/A</div>&nbsp;&nbsp;&nbsp;&nbsp;</span>";;
	$inspector_type = '';
	$case_number = "<span class='every_span'><div class='under_line'>N/A</div>Case Number (VA/FHA/Other)</span></span>";
	$buyer_type = '';
	$inspection_buyer_name = "<span class='every_span'><div class='under_line'>N/A</div>Name of Person Purchasing Inspection</span>";
	$owner_type = "<span class='every_span'><div class='under_line'>N/A</div>Owner/Seller</span>";
	$report_forwarded = '';
	$list_structures = "<span class='every_span'>N/A</span>";
	$inspection_posting = '';
	$company_footer = "<div class='print_pdf_footer'><div style='text-decoration:underline;'>INSPECTOR</div><div>N/A</div></div>";;
	$user = wp_get_current_user();
	if(!empty($user->ID)){
		$inspector_name = "<span class='every_span'><div class='under_line'>".get_user_meta($user->ID,  'first_name', true )." ".get_user_meta($user->ID,  'last_name', true )."</div>Name of Inspector (Please Print)</span>";
		$email_address = "<span class='every_span'><div class='under_line_blue'><a href='mailto:".$user->user_email."'>".$user->user_email."</a></div></span>";
		$licence_number = "<span class='every_span'><div class='under_line'>".get_user_meta($user->ID,  'licence_number', true )."</div>SPCB Business License Number</span>";
		$phone_number = "<span class='every_span'><div class='under_line'>".get_user_meta($user->ID,  'phone_number', true )."</div>Telephone No</span>";
	} else {
		$inspector_name = "<span class='every_span'>N/A</span>";
		$email_address = "<span class='every_span'><div class='under_line'>N/A</div></span>";
		$licence_number = "<span class='every_span'><div class='under_line'>N/A</div>SPCB Business License Number</span>";
		$phone_number = "<span class='every_span'><div class='under_line'>N/A</div>Telephone No</span>";
	}
	if(!empty($template_id)){
		$table_template = $wpdb->prefix . 'template';
		$get_templages = $wpdb->get_row( "SELECT companyId,company_email,company_address,company_phone,template_city,state,footer_html FROM $table_template WHERE id=$template_id ORDER BY id DESC LIMIT 1");
		$inspection_company = "<span class='every_span'><div class='under_line'>".$get_templages->companyId."</div>Name of Inspection Company</span>";
		$inspection_email = "<span class='every_span'><div style='border-bottom: 2px solid #337ab7;'><a href='mailto:".$get_templages->company_email."'>".$get_templages->company_email."</a></div>&nbsp;&nbsp;&nbsp;&nbsp;</span>";
		$company_address = "<span class='every_span'><div class='under_line'>".$get_templages->company_address."</div>Address of Inspection Company</span>";		
		$company_footer = "<div class='print_pdf_footer'><div style='text-decoration:underline;'>INSPECTOR</div><div>".$inspector_name." – ".get_user_meta($user->ID,  'licence_number', true )."<br/>".$get_templages->footer_html."</div></div>";		
		$company_phone = "<span class='every_span'><div class='under_line'>".$get_templages->company_phone."</div>Telephone No.</span>";
		$template_city = "<span class='every_span'><div class='under_line'>".$get_templages->template_city."</div>City</span>";
		$state = "<span class='every_span'><div class='under_line'>".$get_templages->state."</div>State</span>";
		$reportId = !empty($_GET['reportId']) ? $_GET['reportId'] : '';
		$report_id = !empty($_GET['report']) ? $_GET['report'] : $reportId;
		if(!empty($report_id)){
			$table_inspection = $wpdb->prefix . 'inspection';
			$get_inspection = $wpdb->get_row( "SELECT * FROM $table_inspection WHERE id=$report_id ORDER BY id DESC LIMIT 1");
			$inpection_date = "<span class='every_span'><div class='under_line'>".$get_inspection->inpection_date."</div>Date of inspected</span>";
			$inspected_address = "<span class='every_span'>".$get_inspection->report_identification.'<br>Inspected Address</span>';
			$inspection_city = "<span class='every_span'>".$get_inspection->inspection_city.'<br>City</span>';
			$inspected_address_zip = "<span class='every_span'><div class='under_line'>".$get_inspection->zip_code.'</div>Zip Code</span>';
			$inspector_types = (!empty($get_inspection->inspector_type) ? explode(',',$get_inspection->inspector_type) : []);
			$inspector_type = "<span class='every_span'><div class='inspector_type'><label for='certified_applicator'>Certified Applicator</label> <input type='checkbox' ".(in_array('Certified Applicator', $inspector_types) ? 'checked=checked' : null)." name='certified_applicator' id='certified_applicator' ng-model='control.inspected_type1' value='control.inspected_type1' ng-checked='{{control.inspected_type1}}'> &nbsp;&nbsp;&nbsp;&nbsp;(check one)<br><label for='technician'>Technician</label> <input type='checkbox' ".(in_array('Technician', $inspector_types) ? 'checked=checked' : null)." name='technician' id='technician' ng-model='control.inspected_type2' value='control.inspected_type2' ng-checked='{{control.inspected_type2}}'></div>";
			$case_number = "<span class='every_span'><div class='under_line'>".(!empty($get_inspection->case_number) ? $get_inspection->case_number : 'N/A')."</div>Case Number (VA/FHA/Other)</span></span>";
			
			$inspection_buyer_types = (!empty($get_inspection->inspection_buyer_type) ? explode(',',$get_inspection->inspection_buyer_type) : []);
			$buyer_type = "<span class='every_span'><div class='inspection_buyer' style='clear:both;'><span><label for='buyer-seller'>Seller</label> <input type='checkbox' ".(in_array('Seller', $inspection_buyer_types) ? 'checked=checked' : null)." name='buyer-seller' id='buyer-seller' ng-model='control.inspection_buyer_types1' value='control.inspection_buyer_types1' ng-checked='{{control.inspection_buyer_types1}}'></span><span><label for='buyer-agent'>Agent</label> <input type='checkbox' ".(in_array('Agent', $inspection_buyer_types) ? 'checked=checked' : null)." name='buyer-agent' id='buyer-agent' ng-model='control.inspection_buyer_types2' value='control.inspection_buyer_types2' ng-checked='{{control.inspection_buyer_types2}}'></span><span><label for='buyer-buyer'>Buyer</label> <input type='checkbox' ".(in_array('Buyer', $inspection_buyer_types) ? 'checked=checked' : null)." name='buyer-buyer' id='buyer-buyer' ng-model='control.inspection_buyer_types3' value='control.inspection_buyer_types3' ng-checked='{{control.inspection_buyer_types3}}'></span><span><label for='buyer-management_co'>Management Co</label> <input type='checkbox' ".(in_array('Management Co', $inspection_buyer_types) ? 'checked=checked' : null)." name='buyer-management_co' id='buyer-management_co' ng-model='control.inspection_buyer_types4' value='control.inspection_buyer_types4' ng-checked='{{control.inspection_buyer_types4}}'></span><span><label for='buyer-other'>Other</label> <input type='checkbox' ".(in_array('Other', $inspection_buyer_types) ? 'checked=checked' : null)." name='buyer-other' id='buyer-other' ng-model='control.inspection_buyer_types5' value='control.inspection_buyer_types5' ng-checked='{{control.inspection_buyer_types5}}'></span></div></span>";
			
			$inspection_buyer_name = "<span class='every_span'><div class='under_line'>".$get_inspection->prepared_for."</div>Name of Person Purchasing Inspection</span>";
			
			$owner_type = "<span class='every_span'><div class='under_line'>".(!empty($get_inspection->owner_type) ? $get_inspection->owner_type : 'N/A')."</div>Owner/Seller</span>";
			$report_forwarded_to = (!empty($get_inspection->report_forwarded_to) ? explode(',',$get_inspection->report_forwarded_to) : []);
			$report_forwarded = "<span class='every_span'><div class='inspection_buyer' style='clear:both;'><span><label for='forwarded-mortgage'>Title Company or Mortgage</label> <input type='checkbox' ".(in_array('Title Company or Mortgage', $report_forwarded_to) ? 'checked=checked' : null)." name='forwarded-mortgage' id='forwarded-mortgage' ng-model='control.report_forwarded_to1' value='control.report_forwarded_to1' ng-checked='{{control.report_forwarded_to1}}'></span><span><label for='forwarded-purchaser'>Purchaser of Service</label> <input type='checkbox' ".(in_array('Purchaser of Service', $report_forwarded_to) ? 'checked=checked' : null)." name='forwarded-purchaser' id='forwarded-purchaser' ng-model='control.report_forwarded_to2' value='control.report_forwarded_to2' ng-checked='{{control.report_forwarded_to2}}'></span><span><label for='forwarded-seller'>Seller</label> <input type='checkbox' ".(in_array('Seller', $report_forwarded_to) ? 'checked=checked' : null)." name='forwarded-seller' id='forwarded-seller' ng-model='control.report_forwarded_to3' value='control.report_forwarded_to3' ng-checked='{{control.report_forwarded_to3}}'></span><span><label for='forwarded-agent'>Agent</label> <input type='checkbox' ".(in_array('Agent', $report_forwarded_to) ? 'checked=checked' : null)." name='forwarded-agent' id='forwarded-agent' ng-model='control.report_forwarded_to4' value='control.report_forwarded_to4' ng-checked='{{control.report_forwarded_to4}}'></span><span><label for='forwarded-buyer'>Buyer</label> <input type='checkbox' ".(in_array('Buyer', $report_forwarded_to) ? 'checked=checked' : null)." name='forwarded-buyer' id='forwarded-buyer' ng-model='control.report_forwarded_to5' value='control.report_forwarded_to5' ng-checked='{{control.report_forwarded_to5}}'></span></div></span>";
			$list_structures = "<span class='every_span'>".$get_inspection->list_structure."</span>";
			$notice_inspection = (!empty($get_inspection->notice_inspection) ? explode(',',$get_inspection->notice_inspection) : []);
			$inspection_posting = "<span class='every_span'><div class='inspection_buyer' style='clear:both;'><span><label for='notice-electric'>Electric Breaker Box</label> <input type='checkbox' ".(in_array('Electric Breaker Box', $notice_inspection) ? 'checked=checked' : null)." name='notice-electric' id='forwnotice-electric' ng-model='control.notice_inspection1' value='control.notice_inspection1' ng-checked='{{control.notice_inspection1}}'></span><span><label for='notice-beneath'>Water Heater Closet Beneath</label> <input type='checkbox' ".(in_array('Water Heater Closet Beneath', $notice_inspection) ? 'checked=checked' : null)." name='notice-beneath' id='notice-beneath' ng-model='control.notice_inspection2' value='control.notice_inspection2' ng-checked='{{control.notice_inspection2}}'></span><span><label for='notice-access'>Bath Trap Access</label> <input type='checkbox' ".(in_array('Bath Trap Access', $notice_inspection) ? 'checked=checked' : null)." name='notice-access' id='notice-access' ng-model='control.notice_inspection3' value='control.notice_inspection3' ng-checked='{{control.notice_inspection3}}'></span><span><label for='notice-kitchen'>Beneath the Kitchen Sink</label> <input type='checkbox' ".(in_array('Beneath the Kitchen Sink', $notice_inspection) ? 'checked=checked' : null)." name='notice-kitchen' id='notice-kitchen' ng-model='control.notice_inspection4' value='control.notice_inspection4' ng-checked='{{control.notice_inspection4}}'></span></div></span>";
		}
	}
	
	$healthy = array("[inspector_name]","[inspection_company]","[email_address]","[phone_no]", "[licence_number]", "[inspection_date]","[inspected_address]","[inspected_address_city]","[inspected_address_zip]","[inspector_type]","[inspection_email]","[inspection_company_address]","[inspection_company_phone]","[inspection_company_city]","[inspection_company_state]","[case_number]","[buyer_type]","[inspection_buyer_name]","[owner_type]","[report_forwarded]","[list_structures]","[inspection_posting]","[company_footer]");
	$yummy   = array($inspector_name,$inspection_company,$email_address,$phone_number, $licence_number, $inpection_date,$inspected_address,$inspection_city,$inspected_address_zip,$inspector_type,$inspection_email,$company_address,$company_phone,$template_city,$state,$case_number,$buyer_type,$inspection_buyer_name,$owner_type,$report_forwarded,$list_structures,$inspection_posting,$company_footer);
	$newphrase = str_replace($healthy, $yummy, $content);	
	return $newphrase;
}

function parseHyperlinks($string) {
    $regex = '/(\S+@\S+\.\S+)/';
    $replace = '<span class="email-link">$1</span>';
	$pregReplace = preg_replace($regex, $replace, $string);
	$reg_exUrl = "/(\S+w.\S+\.\S+)/";
	if(preg_match($reg_exUrl, $pregReplace)) {
       $pregReplace = preg_replace($reg_exUrl, ' <span class="email-link">$0</span>', $pregReplace);
	}
    return $pregReplace;
}
function parseEmails($string) {
    // Add  tags around all email addresses in $string
    $regex = '/(\S+@\S+\.\S+)/';
    $replace = '<a href="mailto:$1">$1</a>';
	$pregReplace = preg_replace($regex, $replace, $string);
	$reg_exUrl = "/(\S+w.\S+\.\S+)/";
	if(preg_match($reg_exUrl, $pregReplace)) {
       $pregReplace = preg_replace($reg_exUrl, '<a target="_blank" href="//$0">$0</a>', $pregReplace);
	}
    return $pregReplace;
}