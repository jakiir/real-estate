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

<?php 
	global $wpdb;
	$table_template = $wpdb->prefix . 'template';					
	$template_id = !empty($_GET['item']) ? $_GET['item'] : '';
	$get_templages = $wpdb->get_results( "SELECT * FROM $table_template WHERE id=$template_id", OBJECT );
	$get_template_data = json_encode($get_templages);
	$get_template_name = (!empty($get_templages[0]->name) ? $get_templages[0]->name : '');
	$table_template_detail = $wpdb->prefix . 'template_detail';
	$get_template_detail = $wpdb->get_results( "SELECT * FROM $table_template_detail WHERE template_id=$template_id", OBJECT );
	$field_text_html = (!empty($get_template_detail[0]->field_text_html) ? $get_template_detail[0]->field_text_html : '');
	
?>

<div class="container" ng-controller="mainCtrl">
    <div class="toptools">
      <i class="fa fa-floppy-o" id="save_to_database" title="save"></i>
      <a href="<?php echo home_url('/form-viewer/?item='.$template_id); ?>" target="_blank" title="Preview"><i class="fa fa-eye" title="Preview"></i></a>
      <i class="fa fa-upload" title="Export"></i>
      <i class="fa fa-ban" title="Discard"></i>
    </div>
    <div class="toolbar side">
      <!-- toolbar -->
      <div class="dragelement tool" ng-repeat="tool in tools" draggable="true"
      ng-dragstart="startDrag($event,tool)"
      ng-dragend="dragCleanup()">
        <i class="fa {{tool.icon}}"></i>  {{tool.title}}
      </div>
	  <i class="fa fa-arrow-circle-o-left"></i>  <a href="<?php echo home_url('/template/'); ?>">Go to template</a>
      <!-- toolbar -->
    </div>
    <div class="canvas">
      <div class="area">
        <div class="row" ng-repeat="row in data.tree">
            <div class="droparea left sides"
            ng-hide="row[0][0].single"
            ng-class="{'available':externalDrag}"
            ng-style="{'pointer-events':(internalDrag?'none':'auto')}"
            ng-drop="unShiftToChild($event,$index)"></div> <!--left side drop-->
            <div class="col controls" ng-repeat="item in row">
              <div class="controlholder controldraggable" ng-repeat="control in item track by $index"
              ng-class="{'sing':control.single}">
                <div class="removebtn"
                ng-class="{'singv':control.single}"
                 ng-click="removeControl($parent.$parent.$index,$parent.$index,$index,$event)">
                  <i class="fa fa-trash"></i>
                </div>
                <!-- rearrange dragdrop -->
                <div class="droparea rearr"
                ng-class="{'idrg':internalDrag}"
                ng-drop="rearrange($event,$parent.$parent.$index,$parent.$index,$index)">
                </div>
                <!-- loop through the controls -->
                <div class="controlh"
                ng-class="{'currentcontrol':(currentControl && currentControl.hash===control.hash)}"
                ng-click="selectControl($parent.$parent.$index,$parent.$index,$index)"
                draggable="true"
                ng-dragstart="internalDragStart($event,[$parent.$parent.$index,$parent.$index,$index])"
                ng-dragend="internalDragEnd()">                  
				  <div ng-include="'<?php echo esc_url( home_url('/form-controls/') ); ?>'"></div>
                </div>
              </div>
              <div class="droparea bottom" ng-show="row.length>1"
              ng-hide="row[0][0].single"
              ng-style="{'pointer-events':(internalDrag?'none':'auto')}"
              ng-class="{'available':externalDrag}"
              ng-drop="addBottom($event,$parent.$index,$index)">
                <!-- add new into the group -->
              </div>
            </div>
            <div class="droparea right sides"
            ng-style="{'pointer-events':(internalDrag?'none':'auto')}"
            ng-class="{'available':externalDrag}"
            ng-hide="row[0][0].single"
            ng-drop="pushToChild($event,$index)"></div> <!--right side drop -->
        </div>
        <div class="row">
          <div class="col droparea"
            ng-style="{'pointer-events':(internalDrag?'none':'auto')}"
            ng-class="{'available':externalDrag}"
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

<script type="text/javascript">
	var field_text_html = '<?php echo $field_text_html; ?>';
	var get_template_data = '<?php echo $get_template_data; ?>';
	var get_template_name = '<?php echo $get_template_name; ?>';
	//console.log(get_template_name);
</script>

  <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/controls.js"></script>
  <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/angular.min.js"></script>
  <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/ng-drag.js"></script>
  <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/jq.js"></script>
  <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/imagefunctions.js"></script>
  <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/app.js"></script>
  <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/dragdrop.js"></script>

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
