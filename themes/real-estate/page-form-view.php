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

?>
<?php 
	if (is_user_logged_in()) {
		$user = wp_get_current_user();
		if($user->roles[0] != 'administrator' && $user->roles[0] != 'inspector' && $user->roles[0] != 'company_admin'){
			echo '<script>window.location.replace("'.home_url().'");</script>';
			die('You have no access right! Please contact system administration for more information.!');
		}
	} else {
		echo '<script>window.location.replace("'.home_url().'");</script>';
		die('You have no access right! Please contact system administration for more information.!');
	}
	
	$template_id = !empty($_GET['item']) ? $_GET['item'] : '';
	$report_id = !empty($_GET['report']) ? $_GET['report'] : 0;
	$saved = !empty($_GET['saved']) ? $_GET['saved'] : 0;
	$att = !empty($_GET['att']) ? $_GET['att'] : '';
	$hash_id = !empty($_GET['hash']) ? $_GET['hash'] : '';

	global $wpdb;
	$user_id = get_current_user_id();
	$table_inspection = $wpdb->prefix . 'inspection';
	$get_inspection = $wpdb->get_row( "SELECT * FROM $table_inspection WHERE id=$report_id ORDER BY id DESC LIMIT 1" );
	
	$table_template = $wpdb->prefix . 'template';	
	$form_data = $wpdb->get_row( "SELECT * FROM $table_template WHERE id=$template_id ORDER BY id DESC LIMIT 1" );
	$display_name = '';
	$licence_number = '';
	$phone_number = '';
	if(!empty($get_inspection->user_id)){
		$user_info = get_userdata($get_inspection->user_id);
		$display_name = $user_info->display_name;
		$licence_number = get_user_meta($user_info->ID,  'licence_number', true );
		$phone_number = get_user_meta($user_info->ID,  'phone_number', true );
	}
?>
<?php if($form_data->wood_inspection == 'true'){
	get_header('form-viewer-inspection');
	require_once(ABSPATH . 'wp-content/themes/real-estate/template-print-view-pdf.php');
} else { 
get_header('form-viewer');
?>
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/fa/css/font-awesome.min.css">
<div class="container" ng-controller="submissonForm">
<div id="templateViewer">
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/css/form.css">
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/css/submitform_controls.css">
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/css/custom.css">
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/responsive.css">
	<table class="report-table">
		<tr>
			<th align="right" colspan="6" style="padding-bottom:10px;border:none;">
				<img src="<?php echo !empty($get_inspection->cover_photo) ? $get_inspection->cover_photo : '/wp-content/themes/real-estate/images/cover_photo.jpg'; ?>" class="avatar img-responsive" alt="avatar" style="width:100%;">
				<br/>
				<div style="text-transform:capitalize;text-align:center;font-size:25px;">
				<?php echo $get_inspection->report_identification; ?></div>
				<?php //echo $form_data->name.' Report'; ?>
			</th>
		</tr>
		</table>
		<div class="report-table" style="border:none;">
			<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
		</div>
		<table class="report-table" style="border:none;">
		<tr>
			<th align="right" colspan="6" style="padding-bottom:10px;border:none;">
				<div style="text-align:center;font-size:18px;font-weight:normal;">
					<?php 
						$originalDate = $get_inspection->inpection_date;
						$newDate = date("F d, Y", strtotime($originalDate));
						echo '<div style="font-size:18px;font-weight:bold;">'.$newDate.'</div>';
						echo '<div style="width:250px;margin:0 auto;">'.$form_data->footer_html.'</div>';
					?>
				</div>
			</th>
		</tr>
		<tr>
			<th align="center" colspan="6" style="padding-bottom:10px;border:none;">
				<div>
					<img src="<?php echo !empty($form_data->logo_url) ? $form_data->logo_url : '/wp-content/themes/real-estate/images/cover_photo.jpg'; ?>" class="avatar img-responsive" alt="avatar">
				</div>
			</th>
		</tr>
	</table>
	<div class="page-break">&nbsp;</div>
	<?php /*<div class="report-table"><br/><br/><br/><br/><br/></div>
	<table class="report-table report-info" style="border:none;">
		<tr>
			<td style="border:none;">
				<div style="font-size:18px;color:#000;display:block;margin-bottom:20px;">Report Identification: </div>
				<div style="font-size:16px;color:#000;display:block;">Inspection Time In: <?php echo $get_inspection->time_in; ?> Time Out: <?php echo $get_inspection->time_out; ?> Property was: <?php echo $get_inspection->inspection_status; ?> Building Orientation (For The Purpose Of This Report, the Front Faces): <?php echo $get_inspection->building_orientation; ?> Weather conditions During Inspection: <?php echo $get_inspection->weather_conditions; ?> Temp: <?php echo $get_inspection->temperature; ?> Parties present at inspection: <?php echo $get_inspection->parties_present; ?></div>			
			</td>			
		</tr>
	</table>
	<div class="report-table"><br/><br/><br/></div>*/ ?>
    <form class="theform formcontrol">
      <div ng-repeat="section in form" class="mainSection">
	  <?php /*?><div ng-show="!section.children[0].subsection" ng-bind-html="section.children[0][0][0].data" class="commentBoxItem"></div><?php */?>
	  <?php if($form_data->wood_inspection == 'true'){ ?>
	  <div class="wood_inspection">
		  <div ng-repeat="child in section.children" ng-if="!section.children[0].subsection" class="commentBoxItem section-{{section.children[0][0][0].hash}}">
				<div class="">
					<div class="row" ng-repeat="child in section.children">
					  <div class="col" ng-repeat="controls in child">
						<div ng-repeat="control in controls">
						  <div ng-include="'<?php echo esc_url( home_url('/submit-controls-wood/?report='.$report_id.'&saved='.$saved.'&item='.$template_id.'&att='.$att.'&hash='.$hash_id) ); ?>'"></div>
						</div>
					  </div>
					</div>
				</div>
			</div>
		</div>
	  <?php } else { ?>
	  <div ng-repeat="child in section.children" ng-if="!section.children[0].subsection" class="commentBoxItem">
			<div class="">
				<div class="row" ng-repeat="child in section.children">
				  <div class="col" ng-repeat="controls in child">
					<div ng-repeat="control in controls">
					  <div ng-include="'<?php echo esc_url( home_url('/submition-controls/?report='.$report_id.'&saved='.$saved.'&item='.$template_id.'&att='.$att.'&hash='.$hash_id) ); ?>'"></div>
					</div>
				  </div>
				</div>
			</div>
		</div>
        <div class="section">
          <div class="sectionhead section-{{$index}} {{section.display}}" ng-click="section.expanded=!section.expanded">
            <h2>{{section.section.label}}</h2>
            <h5>{{section.section.description}}</h5>
            <i class="icon fa" ng-class="{'fa-plus':!section.expanded,'fa-minus':section.expanded}"></i>
          </div>
          <div class="sectionbody" ng-if="section.expanded">
		  
            <div ng-repeat="child in section.children">	
				<div class="subsectionhead section-{{$index}} {{child.display}}" ng-click="child.expanded=!child.expanded" >
				  <h2>{{child.subsection[0].label}}</h2>
				  <h5>{{child.subsection[0].description}}</h5>
				  <i class="icon fa" ng-class="{'fa-plus':!child.expanded,'fa-minus':child.expanded}"></i>
				</div>
				<div class="subsectionbody" ng-if="child.expanded">				
					<div class="formcontrol number" ng-if="child.subsection[0].type=='subsection'">
					  <?php /*<h2>{{child.subsection[0].label}}</h2>*/?>
					  <div>  
						<input type="checkbox" ng-model="child.subsection[0].status1" value="child.subsection[0].status1" ng-checked="{{child.subsection[0].status1}}"> Inspected
						<input type="checkbox" ng-model="child.subsection[0].status2" value="child.subsection[0].status2" ng-checked="{{child.subsection[0].status2}}"> Not Inspected
						<input type="checkbox" ng-model="child.subsection[0].status3" value="child.subsection[0].status3" ng-checked="{{child.subsection[0].status3}}"> Not Present
						<input type="checkbox" ng-init="child.subsection[0].status4=child.subsection[0].status4 !== false || child.subsection[0].status4 === true ? true : false" ng-model="child.subsection[0].status4" value="{{child.subsection[0].status4}}" ng-checked="{{child.subsection[0].status4}}"> Deficient
					  </div>
					</div>
					<div class="row" ng-repeat="controls in child.children">
						<div class="col-" ng-repeat="subcontrol in controls">
							<div ng-repeat="control in subcontrol">
								<div ng-include="'<?php echo esc_url( home_url('/submition-controls/?report='.$report_id.'&saved='.$saved.'&item='.$template_id.'&att='.$att.'&hash='.$hash_id) ); ?>'"></div>
							</div>
						</div>
					</div>
				</div>
            </div>
          </div> 
        </div>
	  <?php } ?>
      </div>
    </form>
	
	<?php /* ?><div class="print_pdf_footer">
		<div style="text-decoration:underline;">INSPECTOR</div>
		<div>
			<?php echo $display_name; ?> – <?php echo $licence_number; ?>
			<br/>
			<?php echo $form_data->footer_html; ?>
		</div>
	</div><?php */ ?>
	
</div>
	<?php if($report_id){ ?>
    <div class="actions">
	  <div class="msg_show form-view-msg" style="display:inline-block;"></div>
	  <a href="javascript:void(0)" style="margin-bottom:10px;" class="btn-taptap saveChanges" ng-click="submitData(1,'','')">
        <i class="fa fa-floppy-o" aria-hidden="true"></i> Save Changes
      </a>
	  <?php if(!empty($form_data->share_btn) && $form_data->share_btn == 'true'){ ?>
	  <a href="javascript:void(0)" class="btn-taptap checkBoxSlected" data-toggle="modal" data-target="#shareFormView" disabled="disabled"><i class="fa fa-share"></i> Share this
      </a>
	  <?php } ?>
	  <?php /* ?><a target="_blank" href="<?php echo home_url('/form-viewer-print/?item='.$template_id.'&report='.$report_id.'&saved='.$saved.''); ?>" class="btn-taptap">
        <i class="fa fa-file"></i> Save as PDF
      </a><?php */?>
	  <?php if(!empty($form_data->print_btn) && $form_data->print_btn == 'true'){ ?>
	  <a target="_blank" href="<?php echo home_url('/template-print-page/?template='.$template_id.'&reportId='.$report_id.'&savedId='.$saved.'&print=1'); ?>" id="printTemplateBtn-" class="btn-taptap"><i class="fa fa-print" aria-hidden="true"></i> Print / Save to PDF</a>
	  <?php } ?>
    </div>
	<?php } else { ?>
		<style>
		.fileinput{display:none;}
		.wysiwygpretend .button{display:none;}
		</style>
	<?php } ?>
  </div>
<?php get_footer('viewer'); ?>

<div id="shareFormView" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header taptap-modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Enter an email address to share the inspection.</h4>
      </div>
      <div class="modal-body taptap-modal-body">
		<form action="#" id="shareForm">
			<p>Share the inspection deficiencies with Real Estate Agents and others here.  Enter an email address to share the inspection.</p>
			<p><input class="form-control required" type="text" name="agentEmailAddress" id="agentEmailAddress" value=""></p>
			<p class="msg_show_share"></p>
			<br/>
			<p><button type="submit" class="btn-taptap checkBoxSlected"><i class="fa fa-share"></i> SHARE REPORT</button></p>
		</form>
      </div>
    </div>

  </div>
</div>

<?php 
	if(empty($saved)){
		$table_template_detail = $wpdb->prefix . 'template_detail';
		$get_template_detail = $wpdb->get_results( "SELECT * FROM $table_template_detail WHERE template_id=$template_id", OBJECT );
		$form_info = (!empty($get_template_detail[0]->field_text_html) ? $get_template_detail[0]->field_text_html : '{"name":"Untitled Form 1","logo":null,"tree":[]}');
		$form_info = shortcode_wdi($form_info);
	} else {
		$inspectionreportdetail = $wpdb->prefix . 'inspectionreportdetail';
		$get_inspectionreportdetail = $wpdb->get_results( "SELECT * FROM $inspectionreportdetail WHERE id=$saved AND inspectionId=$report_id", OBJECT );
		$form_info = (!empty($get_inspectionreportdetail[0]->fieldTextHtml) ? $get_inspectionreportdetail[0]->fieldTextHtml : '{"name":"Untitled Form 1","logo":null,"tree":[]}');
		$form_info = shortcode_wdi($form_info);
	}
	$get_form_data = $wpdb->get_results( "SELECT * FROM $table_template WHERE id=$template_id", OBJECT );
	$get_form_data = shortcode_wdi($get_form_data);
	$get_template_name = (!empty($get_form_data->name) ? $get_form_data->name : '');
?>
<script type="text/javascript">
	var formBlueprint = null;
    var formInfo = null;
    formInfo = <?php echo json_encode($get_form_data)?>;
    formBlueprint = <?php echo $form_info; ?>;	
	//var this_form_name = formBlueprint.name;
	document.title = '<?php echo $get_template_name; ?>';
	var ajax_url = '<?php echo admin_url('admin-ajax.php'); ?>';
	var template_id = <?php echo $template_id; ?>;	
	var inspection_id = <?php echo $report_id; ?>;
	var saved = <?php echo $saved; ?>;
	var site_url = '<?php echo home_url(); ?>';
</script>  
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/imagefunctions.js"></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/bower_components/tinymce/tinymce.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/angular.min.js"></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/bower_components/angular-ui-tinymce/src/tinymce.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/jq.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/submitapp.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/printThis.js"></script>
	<script type="text/javascript">
	$(document).ready(function () {
		
		$('.dropdown-toggle').on("click", function (e) {
			$('.dropdown').toggleClass('open');
		});
		
	$(document).on("click", ":submit", function(e) {
			$('.msg_show_share').html('<i class="fa fa-refresh fa-spin" aria-hidden="true"></i>');
			var thisForm = $(this);
				var agentEmailAddress = jQuery('#agentEmailAddress').val();
				if(agentEmailAddress == ""){
					jQuery('#agentEmailAddress').focus();
					$('.msg_show_share').html('<span style="color:red">Please, type minimum one email address.</span>');
					return false;
				}
				var form_data = new FormData();
				var getSelectedTitle = "<?php echo $get_inspection->report_identification; ?>";
				var getSelectedCompany = "<?php echo $get_inspection->company; ?>";
				var getSelectedPrep = "<?php echo $get_inspection->prepared_for; ?>";
				
				form_data.append('action', 'send_agent_email');
				form_data.append('getSelected', template_id);				
				form_data.append('getSelectedReport', inspection_id);
				form_data.append('getSelectedSaved', saved);
				form_data.append('getSelectedTitle', getSelectedTitle);
				form_data.append('getSelectedCompany', getSelectedCompany);
				form_data.append('getSelectedPrep', getSelectedPrep);
				form_data.append('agentEmailAddress', agentEmailAddress);
				
				$.ajax({					
					url: '<?php echo admin_url('admin-ajax.php'); ?>',
					type: 'post',
					contentType: false,
					processData: false,
					data : form_data,					
					success: function (data) {
					  var parsedJson = $.parseJSON(data);
					  if(parsedJson.success == true){						  
						  $('.msg_show_share').html('');
						  $('.msg_show_share').html('<span style="color:green">'+parsedJson.mess+'</span>');
						  location.reload();
					  } else {
						  $('.msg_show_share').html('');
						 $('.msg_show_share').html('<span style="color:red">'+parsedJson.mess+'</span>');
					  }
					},
					error: function (errorThrown) {
						$('.msg_show_share').html('');
						$('.msg_show_share').html('<span style="color:red">'+errorThrown+'</span>');						
					}
				});		
			return false;
			
		});
		
	});
	function expand_nav_menu() {
		$('#navbar').toggleClass('in');
	}
	$(".dropdown").on("click", function (e) {
		$(this).toggleClass('open');
	});
	
	</script>
<?php } ?>