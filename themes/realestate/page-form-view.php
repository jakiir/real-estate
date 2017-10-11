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
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/fa/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/css/form.css">
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/css/submitform_controls.css">

<div class="container" ng-controller="submissonForm">
    <header>
      <img class="logo" ng-src="{{formInfo.logo_url}}" alt="{{formInfo.name}}">
      <div class="headercontent" ng-bind-html="formInfo.header_html"></div>
    </header>
    <div class="theform">
      <form action="" name="mainform" class="manform">
        <div class="row" ng-repeat="row in formBlueprint.tree" ng-hide="row[0][0].type=='break'">
            <div class="col colcontrols" ng-repeat="controls in row track by $index">
              <div class="control" ng-repeat="control in controls track by $index">
                <div ng-include="'<?php echo esc_url( home_url('/submition-controls/') ); ?>'"></div>
              </div>
            </div>
        </div>
      </form>
    </div>
    <div class="actions">
      <div class="button primary" ng-click="submitData()">
        Submit Form
      </div>
      <div class="button secondary">
        Draft
      </div>
      <div class="button negative">
        Discard
      </div>
    </div>
  </div>

<?php //get_footer(); ?>

<?php 
	global $wpdb;
	$table_template = $wpdb->prefix . 'template';					
	$template_id = !empty($_GET['item']) ? $_GET['item'] : '';
	$form_data = $wpdb->get_results( "SELECT * FROM $table_template WHERE id=$template_id", OBJECT );
	 
	$table_template_detail = $wpdb->prefix . 'template_detail';
	$get_template_detail = $wpdb->get_results( "SELECT * FROM $table_template_detail WHERE template_id=$template_id", OBJECT );
	$form_info = (!empty($get_template_detail[0]->field_text_html) ? $get_template_detail[0]->field_text_html : '');
	
?>
<script type="text/javascript">
	var formBlueprint = null;
    var formInfo = null;
    formInfo = <?php echo json_encode($form_data)?>;
    formBlueprint = <?php echo $form_info; ?>;
	var this_form_name = formBlueprint.name;
	document.title = this_form_name;
	var ajax_url = '<?php echo admin_url('admin-ajax.php'); ?>';
	var template_id = <?php echo $template_id; ?>;
</script>
  
  <script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/bower_components/tinymce/tinymce.js"></script>
  <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/angular.min.js"></script>
  <script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/bower_components/angular-ui-tinymce/src/tinymce.js"></script>
  <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/jq.js"></script>
  <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/submitapp.js"></script>
  
