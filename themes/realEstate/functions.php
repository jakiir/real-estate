<?php
/**
 * Real Estate Theme functions
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 */

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
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/realestate
	 * If you're building a theme based on Twenty Seventeen, use a find and replace
	 * to change 'realestate' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'realestate' );

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

	add_image_size( 'realestate-featured-image', 2000, 1200, true );

	add_image_size( 'realestate-thumbnail-avatar', 100, 100, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 525;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'top'    => __( 'Top Menu', 'realestate' ),
		'social' => __( 'Social Links Menu', 'realestate' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css', realestate_fonts_url() ) );

	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		'widgets' => array(
			// Place three core-defined widgets in the sidebar area.
			'sidebar-1' => array(
				'text_business_info',
				'search',
				'text_about',
			),

			// Add the core-defined business info widget to the footer 1 area.
			'sidebar-2' => array(
				'text_business_info',
			),

			// Put two core-defined widgets in the footer 2 area.
			'sidebar-3' => array(
				'text_about',
				'search',
			),
		),

		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts' => array(
			'home',
			'about' => array(
				'thumbnail' => '{{image-sandwich}}',
			),
			'contact' => array(
				'thumbnail' => '{{image-espresso}}',
			),
			'blog' => array(
				'thumbnail' => '{{image-coffee}}',
			),
			'homepage-section' => array(
				'thumbnail' => '{{image-espresso}}',
			),
		),

		// Create the custom image attachments used as post thumbnails for pages.
		'attachments' => array(
			'image-espresso' => array(
				'post_title' => _x( 'Espresso', 'Theme starter content', 'realestate' ),
				'file' => 'assets/images/espresso.jpg', // URL relative to the template directory.
			),
			'image-sandwich' => array(
				'post_title' => _x( 'Sandwich', 'Theme starter content', 'realestate' ),
				'file' => 'assets/images/sandwich.jpg',
			),
			'image-coffee' => array(
				'post_title' => _x( 'Coffee', 'Theme starter content', 'realestate' ),
				'file' => 'assets/images/coffee.jpg',
			),
		),

		// Default to a static front page and assign the front and posts pages.
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		// Set the front page section theme mods to the IDs of the core-registered pages.
		'theme_mods' => array(
			'panel_1' => '{{homepage-section}}',
			'panel_2' => '{{about}}',
			'panel_3' => '{{blog}}',
			'panel_4' => '{{contact}}',
		),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "top" location.
			'top' => array(
				'name' => __( 'Top Menu', 'realestate' ),
				'items' => array(
					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
					'page_about',
					'page_blog',
					'page_contact',
				),
			),

			// Assign a menu to the "social" location.
			'social' => array(
				'name' => __( 'Social Links Menu', 'realestate' ),
				'items' => array(
					'link_yelp',
					'link_facebook',
					'link_twitter',
					'link_instagram',
					'link_email',
				),
			),
		),
	);

	/**
	 * Filters Twenty Seventeen array of starter content.
	 *
	 * @since Twenty Seventeen 1.1
	 *
	 * @param array $starter_content Array of starter content.
	 */
	$starter_content = apply_filters( 'realestate_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
}
add_action( 'after_setup_theme', 'realestate_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function realestate_content_width() {

	$content_width = $GLOBALS['content_width'];

	// Get layout.
	$page_layout = get_theme_mod( 'page_layout' );

	// Check if layout is one column.
	if ( 'one-column' === $page_layout ) {
		if ( realestate_is_frontpage() ) {
			$content_width = 644;
		} elseif ( is_page() ) {
			$content_width = 740;
		}
	}

	// Check if is single post and there is no sidebar.
	if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 740;
	}

	/**
	 * Filter Twenty Seventeen content width of the theme.
	 *
	 * @since Twenty Seventeen 1.0
	 *
	 * @param int $content_width Content width in pixels.
	 */
	$GLOBALS['content_width'] = apply_filters( 'realestate_content_width', $content_width );
}
add_action( 'template_redirect', 'realestate_content_width', 0 );

/**
 * Register custom fonts.
 */
function realestate_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Libre Franklin, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'realestate' );

	if ( 'off' !== $libre_franklin ) {
		$font_families = array();

		$font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function realestate_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'realestate-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'realestate_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function realestate_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'realestate' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'realestate' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'realestate' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'realestate' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'realestate' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'realestate' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'realestate_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $link Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function realestate_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'realestate' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'realestate_excerpt_more' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Seventeen 1.0
 */
function realestate_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'realestate_javascript_detection', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function realestate_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'realestate_pingback_header' );

/**
 * Display custom color CSS.
 */
function realestate_colors_css_wrap() {
	if ( 'custom' !== get_theme_mod( 'colorscheme' ) && ! is_customize_preview() ) {
		return;
	}

	require_once( get_parent_theme_file_path( '/inc/color-patterns.php' ) );
	$hue = absint( get_theme_mod( 'colorscheme_hue', 250 ) );
?>
	<style type="text/css" id="custom-theme-colors" <?php if ( is_customize_preview() ) { echo 'data-hue="' . $hue . '"'; } ?>>
		<?php echo realestate_custom_colors_css(); ?>
	</style>
<?php }
add_action( 'wp_head', 'realestate_colors_css_wrap' );



/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function realestate_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 740 <= $width ) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
		if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
			 $sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'realestate_content_image_sizes_attr', 10, 2 );

/**
 * Filter the `sizes` value in the header image markup.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function realestate_header_image_tag( $html, $header, $attr ) {
	if ( isset( $attr['sizes'] ) ) {
		$html = str_replace( $attr['sizes'], '100vw', $html );
	}
	return $html;
}
add_filter( 'get_header_image_tag', 'realestate_header_image_tag', 10, 3 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function realestate_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( is_archive() || is_search() || is_home() ) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'realestate_post_thumbnail_sizes_attr', 10, 3 );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function realestate_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'realestate_front_page_template' );

add_action('after_switch_theme', 'manage_required_tables');

function manage_required_tables() {
	
	global $wpdb;
	// Template table
	$table_template = $wpdb->prefix . 'template';	
	$sql_template = "DROP TABLE IF EXISTS $table_template;
	CREATE TABLE $table_template (
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
	INSERT INTO $table_template (`id`, `name`, `shared_flag`, `state`, `state_form`, `companyId`, `logo_url`, `footer_html`, `header_html`) VALUES
	(1,	'Item One',	'',	'Dhaka',	'BD',	88,	'http://via.placeholder.com/350x150',	'',	''),
	(2,	'Item Two',	'',	'Dhaka',	'BD',	88,	'http://via.placeholder.com/350x150',	'',	''),
	(3,	'Item Three',	'',	'Dhaka',	'BD',	88,	'http://via.placeholder.com/350x150',	'',	'');";
	
	
	// Template details table
	$table_template_detail = $wpdb->prefix . 'template_detail';
	$sql_template_detail = "DROP TABLE IF EXISTS $table_template_detail;
	CREATE TABLE $table_template_detail (
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
	
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql_template );
	dbDelta( $sql_template_detail );
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
		 footer_html='".$footer_template."' 
		 WHERE id=$template_id"
		 ));
		 
		 if (!function_exists('wp_handle_upload')) {
			   require_once(ABSPATH . 'wp-admin/includes/file.php');
		   }
		  // echo $_FILES["upload"]["name"];
		  $uploadedfile = $_FILES['template_logo'];
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
			'success' => false,
			'mess' => 'Form not send, there are some error to send email.'
		 );
	 }			
	echo json_encode($results);        
	die();
  }
