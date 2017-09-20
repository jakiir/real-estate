<?php
/**
 * Template Name: Form Builder
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

get_header('form-builder'); ?>
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/fa/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/css/style.css">
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/css/controls.css">

<div class="container" ng-controller="mainCtrl">
    <div class="toptools">
      <i class="fa fa-floppy-o" id="save_to_database" title="save"></i>
      <i class="fa fa-eye" title="Preview"></i>
      <i class="fa fa-upload" title="Export"></i>
      <i class="fa fa-ban" title="Discard"></i>
    </div>
    <div class="toolbar side">
      <!-- toolbar -->
      <div class="dragelement tool" ng-repeat="tool in tools" draggable="true" ng-dragstart="startDrag($event,tool)">
        <i class="fa {{tool.icon}}"></i>  {{tool.title}}
      </div>
      <!-- toolbar -->
    </div>
    <div class="canvas">
      <div class="area">
        <div class="row" ng-repeat="row in data.tree">
            <div class="droparea left sides"
            ng-hide="row[0][0].single"
            ng-drop="unShiftToChild($event,$index)"></div> <!--left side drop-->
            <div class="col controls" ng-repeat="item in row">
              <div class="controlholder" ng-repeat="control in item track by $index"
              ng-click="selectControl($parent.$parent.$index,$parent.$index,$index)"
              ng-class="{'currentcontrol':(currentControl && currentControl.hash===control.hash)}">
                <div class="removebtn" ng-click="removeControl($parent.$parent.$index,$parent.$index,$index,$event)">
                  <i class="fa fa-trash"></i>
                </div>
                <!-- loop through the controls -->
                <div ng-include="'<?php echo esc_url( get_template_directory_uri() ); ?>/assets/controls.php'"></div>
              </div>
              <div class="droparea bottom" ng-show="row.length>1"
              ng-hide="row[0][0].single"
              ng-drop="addBottom($event,$parent.$index,$index)">
                <!-- add new into the group -->
              </div>
            </div>
            <div class="droparea right sides"
            ng-hide="row[0][0].single"
            ng-drop="pushToChild($event,$index)"></div> <!--right side drop -->
        </div>
        <div class="row">
          <div class="col droparea"
            ng-drop="addNewRow($event)"
          ></div>
        </div>
      </div>
    </div>
    <div class="properties" ng-show="currentControl">
      <div class="deselectcurrent" ng-click="deselectControl()">
        <i class="fa fa-close"></i>
      </div>
      <!-- label -->
      <div class="property" ng-if="currentControl.label!=undefined">
        <p>Element Label</p>
        <input type="text" ng-model="currentControl.label">
      </div>
      <!-- placeholder -->
      <div class="property" ng-if="currentControl.placeholder!=undefined">
        <p>Input Placeholder</p>
        <input type="text" ng-model="currentControl.placeholder">
      </div>
      <!-- default -->
      <div class="property" ng-if="currentControl.default!=undefined">
        <p>Default Value</p>
        <input type="text" ng-model="currentControl.default">
      </div>
      <!-- HTML name-->
      <div class="property" ng-if="currentControl.htmlName!=undefined">
        <p>Unique Name (for form submisson)</p>
        <input type="text" ng-model="currentControl.htmlName">
      </div>
      <!-- URL -->
      <div class="property" ng-if="currentControl.url!=undefined">
        <p>URL</p>
        <div class="flex">
          <input type="text" class="flexone" ng-model="currentControl.url">
          <div class="fileinput flex flexcenter hovereffect">
            <input type="file" class="invisible fileinp" c-on-change="fileBrowse()">
            <i class="fa fa-folder-open"></i>
          </div>
        </div>
      </div>
      <!-- Conditional Message -->
      <div class="property" ng-if="currentControl.message!=undefined">
        <p>Conditional Message</p>
        <input type="text" ng-model="currentControl.message">
      </div>
    </div>
  </div>

<?php //get_footer(); ?>
  <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/controls.js"></script>
  <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/angular.min.js"></script>
  <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/ng-drag.js"></script>
  <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/jq.js"></script>
  <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/imagefunctions.js"></script>
  <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/app.js"></script>
  <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/dragdrop.js"></script>
<?php 
 global $wpdb;
 $template_detail = $wpdb->prefix . 'template_detail';
 $template_id = !empty($_GET['item']) ? $_GET['item'] : '';
 $get_templages = $wpdb->get_results( "SELECT * FROM $template_detail WHERE template_id=$template_id", OBJECT );
?>

<script type="text/javascript">
  document.getElementById('save_to_database').addEventListener('click', function() {
    var form_data = new FormData();    
    var template_id = '<?php echo $template_id; ?>';
    var formJsonData = JSON.stringify(JSON.parse(localStorage.formbuilder_cache_data));
    form_data.append('action', 'saveDynamicForm');
    form_data.append('template_id', template_id);
    form_data.append('formJsonData', formJsonData);
    
    $.ajax({          
      url: '<?php echo admin_url('admin-ajax.php'); ?>',
      type: 'post',
      contentType: false,
      processData: false,
      data: form_data,          
      success: function (data) {
        var parsedJson = $.parseJSON(data);
        console.log(parsedJson);
        if(parsedJson.success == true){
          alert(parsedJson.mess);
          //window.location.href = "<?php echo home_url('/form-builder/?item='); ?>"+template_id;
        } else {
        alert(parsedJson.mess);
        }
      },
      error: function (errorThrown) {
        alert(errorThrown);
      }
    });
    
    //console.log(JSON.stringify(JSON.parse(formBuilder.actions.getData('json', true))));
  });
</script>
