<?php
/**
 * Template Name: Form Viewer
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header('form-viewer'); ?>
<?php 
	if (is_user_logged_in()) {
		$user = wp_get_current_user();
		if($user->roles[0] != 'administrator' && $user->roles[0] != 'inspector'){
			echo '<script>window.location.replace("'.home_url().'");</script>';
			die('You have no access right! Please contact system administration for more information.!');
		}
	} else {
		echo '<script>window.location.replace("'.home_url().'");</script>';
		die('You have no access right! Please contact system administration for more information.!');
	}
	
	$template_id = !empty($_GET['item']) ? $_GET['item'] : '';
	$att = !empty($_GET['att']) ? $_GET['att'] : '';
	$hash_id = !empty($_GET['hash']) ? $_GET['hash'] : '';
?>
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/fa/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/css/form.css">
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/css/submitform_controls.css">
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/css/custom.css">
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.min.js"></script>
<div class="container" ng-controller="submissonForm">
    <header>
      <div class="stdfields">
        <div class="fieldrow">
          <div class="fieldcol">
            <div class="clogoholder">
            <img ng-src="{{formBlueprint.logo}}" alt="Logo" class="companylogo">
          </div>
          </div>
        </div>
        <div class="fleldrow">
          <div class="fieldcol">
            <h1 class="text-center reporttitle">{{formBlueprint.report_title}}</h1>
          </div>
        </div>
        <div class="fieldrow">
          <div class="fieldcol">
            <p class="text-center">
              {{formBlueprint.company_address}}
            </p>
          </div>
        </div>
        <div class="fieldrow bordered">
          <div class="fieldcol">
            <p>Report Title:</p>
            <input type="text" ng-model="formBlueprint.prepared_by">
          </div>
          <div class="fieldcol">
            <p>Company Address:</p>
            <input type="text" ng-model="formBlueprint.prepared_for">
          </div>
        </div>
        <div class="fieldrow">
          <div class="fieldcol">
            <p class="text-center prepareddate">
              <b>Date:</b> {{formBlueprint.prepared_date}}
            </p>
          </div>
        </div>
      </div>
    </header>
    <form class="theform">
      <div ng-repeat="section in form">
        <div class="section">
          <div class="sectionhead section-{{$index}} {{section.display}}" ng-click="section.expanded=!section.expanded">
            <h2>{{section.section.label}}</h2>
            <h5>{{section.section.description}}</h5>
            <i class="icon fa" ng-class="{'fa-plus':!section.expanded,'fa-minus':section.expanded}"></i>
          </div>
          <div class="sectionbody" ng-show="section.expanded">
            <div class="row" ng-repeat="child in section.children">
              <div class="col" ng-repeat="controls in child">
                <div ng-repeat="control in controls">                  
				  <div ng-include="'<?php echo esc_url( home_url('/submition-controls/?item='.$template_id.'&att='.$att.'&hash='.$hash_id) ); ?>'"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
    <!--<div class="actions">
      <div class="button primary" ng-click="submitData()">
        Submit Form
      </div>
      <div class="button secondary">
        Draft
      </div>
      <div class="button negative">
        Discard
      </div>
    </div>-->
  </div>
<?php //get_footer(); ?>

<?php 
	global $wpdb;
	$table_template = $wpdb->prefix . 'template';	
	$form_data = $wpdb->get_results( "SELECT * FROM $table_template WHERE id=$template_id", OBJECT );
	$table_template_detail = $wpdb->prefix . 'template_detail';
	$get_template_detail = $wpdb->get_results( "SELECT * FROM $table_template_detail WHERE template_id=$template_id", OBJECT );
	$form_info = (!empty($get_template_detail[0]->field_text_html) ? $get_template_detail[0]->field_text_html : '{"name":"Untitled Form 1","logo":null,"tree":[]}');
	$get_template_name = (!empty($form_data[0]->name) ? $form_data[0]->name : '');
?>
<script type="text/javascript">
	var formBlueprint = null;
    var formInfo = null;
    formInfo = <?php echo json_encode($form_data)?>;
    formBlueprint = <?php echo $form_info; ?>;	
	//var this_form_name = formBlueprint.name;
	document.title = '<?php echo $get_template_name; ?>';
	var ajax_url = '<?php echo admin_url('admin-ajax.php'); ?>';
	var template_id = <?php echo $template_id; ?>;
</script>  
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/imagefunctions.js"></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/bower_components/tinymce/tinymce.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/angular.min.js"></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/bower_components/angular-ui-tinymce/src/tinymce.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/jq.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/submitapp.js"></script>
  
