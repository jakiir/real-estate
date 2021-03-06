<?php
/**
 * Template Name: Form Viewer Print Backup
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

get_header('form-viewer-print'); ?>
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
	$hash_id = !empty($_GET['hash']) ? $_GET['hash'] : '';

	global $wpdb;
	$user_id = get_current_user_id();
	$table_inspection = $wpdb->prefix . 'inspection';
	$get_inspection = $wpdb->get_results( "SELECT * FROM $table_inspection WHERE id=$report_id", OBJECT );
	
	$table_template = $wpdb->prefix . 'template';	
	$form_data = $wpdb->get_results( "SELECT * FROM $table_template WHERE id=$template_id", OBJECT );
	
	$display_name = '';
	$licence_number = '';
	$phone_number = '';
	if(!empty($get_inspection[0]->user_id)){
		$user_info = get_userdata($get_inspection[0]->user_id);
		$display_name = $user_info->display_name;
		$licence_number = get_user_meta($user_info->ID,  'licence_number', true );
		$phone_number = get_user_meta($user_info->ID,  'phone_number', true );
	}
?>
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/fa/css/font-awesome.min.css">
<div class="container" ng-controller="submissonForm">
<div id="drlistDivTbl">
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/css/form.css">
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/css/submitform_controls.css">
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/css/custom.css">
	<table class="report-table">
		<tr>
			<th align="right" colspan="2" style="padding-bottom:10px;">
				<img src="<?php echo !empty($form_data[0]->logo_url) ? $form_data[0]->logo_url : '//placehold.it/200'; ?>" class="avatar img-responsive" alt="avatar" style="width:150px;">
			</th>
			<td align="left" colspan="4" style="text-transform:uppercase;"><?php echo $form_data[0]->name; ?> Report</td>
		</tr>
	</table>
	<table class="report-table report-info">
		<tr>
			<th align="right" style="padding-top:10px;">Company </th>
			<td align="left">:</td>
			<td align="left"><?php echo $get_inspection[0]->company; ?></td>
			<th align="right">Date</th>
			<td align="left">:</td>
			<td align="left"><?php echo $get_inspection[0]->inpection_date; ?></td>
		</tr>
		<tr>
			<th align="right">Property Address</th>
			<td align="left">:</td>
			<td align="left"><?php echo $get_inspection[0]->report_identification; ?></td>
			<th align="right">Template</th>
			<td align="left">:</td>
			<td align="left"><?php echo $form_data[0]->name; ?></td>
		</tr>
		<tr>
			<th align="right">Prepared For</th>
			<td align="left">:</td>
			<td align="left"><?php echo $get_inspection[0]->prepared_for; ?></td>
			<th align="right">Prepared By</th>
			<td align="left">:</td>
			<td align="left"><?php echo $display_name; ?></td>
		</tr>
		<tr>
			<th align="right">Lic #</th>
			<td align="left">:</td>
			<td align="left"><?php echo $licence_number; ?></td>
			<th align="right">Phone Number</th>
			<td align="left">:</td>
			<td align="left"><?php echo $phone_number; ?></td>
		</tr>
		<tr>
			<th align="right">Time In</th>
			<td align="left">:</td>
			<td align="left"><?php echo $get_inspection[0]->time_in; ?></td>
			<th align="right">Time Out</th>
			<td align="left">:</td>
			<td align="left"><?php echo $get_inspection[0]->time_out; ?></td>
		</tr>
		<tr>
			<th align="right" style="padding-bottom:10px;">Ocuppied or Vacant</th>
			<td align="left">:</td>
			<td align="left"><?php echo $get_inspection[0]->inspection_status; ?></td>
			<th align="right">Building Orientation</th>
			<td align="left">:</td>
			<td align="left"><?php echo $get_inspection[0]->building_orientation; ?></td>
		</tr>
		<tr>
			<th align="right">Weather Conditions</th>
			<td align="left">:</td>
			<td align="left"><?php echo $get_inspection[0]->weather_conditions.' ['.$get_inspection[0]->temperature.']'; ?></td>
			<th align="right">Parties Present</th>
			<td align="left">:</td>
			<td align="left"><?php echo $get_inspection[0]->parties_present; ?></td>
		</tr>
	</table>
    <form class="theform">
      <div ng-repeat="section in form" class="mainSection">
	  <div ng-show="section.children[1] ? true : false" ng-bind-html="section.children[0][0][0].data" class="commentBoxItem"></div>
	  <div ng-repeat="child in section.children" ng-show="section.children[1] ? false : true" class="commentBoxItem">
			<div class="">
				<div class="row" ng-repeat="child in section.children">
				  <div class="col" ng-repeat="controls in child">
					<div ng-repeat="control in controls">
					<!--start submit controls-->
					  <div ng-if="control.type=='report'">
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
								<p>Report Prepared By:</p>
								<input type="text" ng-model="formBlueprint.prepared_by">
							  </div>
							  <div class="fieldcol">
								<p>Company Prepared For:</p>
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
					</div>
					<!-- text -->
					<div class="formcontrol text" ng-if="control.type=='label'">
					  <div class="labelfield">
						  {{control.label}}
					  </div>
					</div>
					<!-- text -->
					<div class="formcontrol text" ng-if="control.type=='text'">
					  <textarea class="textinput" placeholder="{{control.placeholder}}"></textarea>
					</div>
					<!-- Section -->
					<div class="formcontrol number" ng-if="control.type=='section'">
					  <h1>{{control.label}}</h1>
					  <h4>{{control.description}}</h4>
					</div>
					<!-- Sub Section -->
					<div class="formcontrol number" ng-if="control.type=='subsection'">
					  <h2>{{control.label}}</h2>
					  <div>  
						<input type="checkbox" ng-model="control.status1" value="control.status1" ng-checked="{{control.status1}}"> Inspected
						<input type="checkbox" ng-model="control.status2" value="control.status2" ng-checked="{{control.status2}}"> Not Inspected
						<input type="checkbox" ng-model="control.status3" value="control.status3" ng-checked="{{control.status3}}"> Not Present
						<input type="checkbox" ng-model="control.status4" value="control.status4" ng-checked="{{control.status4}}"> Deficient
					  </div>
					</div>
					<!-- Paragraph -->
					<div class="formcontrol paragraph" ng-if="control.type=='textarea'">
					  <p>{{control.label}}</p>
					  <div class="inputpretend paragraph">
						{{control.placeholder}}
					  </div>
					</div>
					<!--Check box-->
					<div class="formcontrol checkbox" ng-if="control.type=='checkbox'">
					  <input type="checkbox" ng-model="control.value" ng-checked="{{control.value}}"> {{control.label}}
					</div>
					<!-- Image -->
					<div class="formcontrol image imgdrop" ng-if="control.type=='image'" ng-drop="imageDrop($event,$parent.$parent.$index,$parent.$index,$index)">
					  <input type="hidden" class="updatedUrl" value="{{control.url}}"/>
					  <img class="imggap fa" ng-src="{{control.url}}" alt="Image Placeholder">  
					  <div class="commentprompt"><input type="checkbox" ng-model="control.withComment" ng-checked="{{control.withComment}}"> Add Comment</div>
					  <div ng-bind-html="control.data"></div>
					</div>
					<!-- wysiwyg -->
					<div class="formcontrol editor" ng-if="control.type=='comment'">
					  <h4><input type="checkbox" id="{{control.htmlName}}" ng-click="commentListIsVisible=!commentListIsVisible" ng-model="control.comment1" value="control.comment1" ng-checked="control.comment1"> <label for="{{control.htmlName}}">{{control.label}}</label></h4>
					  <div ng-bind-html="control.data"></div>
					</div>
					<!-- Static Text -->
					<div class="formcontrol static" ng-if="control.type=='static'">
					  <div class="instruction">
						<i class="fa fa-info-circle"></i> {{control.label}}
					  </div>
					</div>
					<!-- Page Break -->
					<div class="formcontrol break" ng-if="control.type=='break'">
					</div>
					<!-- Conditional Message -->
					<div class="formcontrol conditional" ng-if="control.type=='conditional'">
					  <div class="condtop"><input type="checkbox" ng-model="control.checked" ng-change="conditionalEval()"> {{control.label}}</div>
					</div>
					<!-- Conditional Message Target -->
					<div class="formcontrol conditional" ng-if="control.type=='reason'">
					  <div class="message" ng-class="{{control.htmlName}}">
						{{control.reason?control.reason:"Reason text for '"+control.htmlName+"' will appear here"}}
					  </div>
					</div>
					  <!--end submit controls-->
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
          <div class="sectionbody" ng-show="section.expanded">
		  
            <div ng-repeat="child in section.children">	
				<div class="subsectionhead section-{{$index}} {{child.display}}" ng-click="child.expanded=!child.expanded" >
				  <h2>{{child.subsection[0].label}}</h2>
				  <h5>{{child.subsection[0].description}}</h5>
				  <i class="icon fa" ng-class="{'fa-plus':!child.expanded,'fa-minus':child.expanded}"></i>
				</div>
				<div class="subsectionbody" ng-show="child.expanded">				
					<div class="formcontrol number" ng-if="child.subsection[0].type=='subsection'">
					  <?php /*?><h2>{{child.subsection[0].label}}</h2><?php */?>
					  <div>  
						<input type="checkbox" ng-model="child.subsection[0].status1" value="child.subsection[0].status1" ng-checked="{{child.subsection[0].status1}}"> Inspected
						<input type="checkbox" ng-model="child.subsection[0].status2" value="child.subsection[0].status2" ng-checked="{{child.subsection[0].status2}}"> Not Inspected
						<input type="checkbox" ng-model="child.subsection[0].status3" value="child.subsection[0].status3" ng-checked="{{child.subsection[0].status3}}"> Not Present
						<input type="checkbox" ng-model="child.subsection[0].status4" value="child.subsection[0].status4" ng-checked="{{child.subsection[0].status4}}"> Deficient
					  </div>
					</div>
					<div class="row-" ng-repeat="controls in child.children">
						<div class="col" ng-repeat="subcontrol in controls">
							<div ng-repeat="control in subcontrol">
								<!--start submit controls-->
								  <div ng-if="control.type=='report'">
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
											<p>Report Prepared By:</p>
											<input type="text" ng-model="formBlueprint.prepared_by">
										  </div>
										  <div class="fieldcol">
											<p>Company Prepared For:</p>
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
								</div>
								<!-- text -->
								<div class="formcontrol text" ng-if="control.type=='label'">
								  <div class="labelfield">
									  {{control.label}}
								  </div>
								</div>
								<!-- text -->
								<div class="formcontrol text" ng-if="control.type=='text'">
								  <textarea class="textinput" placeholder="{{control.placeholder}}"></textarea>
								</div>
								<!-- Section -->
								<div class="formcontrol number" ng-if="control.type=='section'">
								  <h1>{{control.label}}</h1>
								  <h4>{{control.description}}</h4>
								</div>
								<!-- Sub Section -->
								<div class="formcontrol number" ng-if="control.type=='subsection'">
								  <h2>{{control.label}}</h2>
								  <div>  
									<input type="checkbox" ng-model="control.status1" value="control.status1" ng-checked="{{control.status1}}"> Inspected
									<input type="checkbox" ng-model="control.status2" value="control.status2" ng-checked="{{control.status2}}"> Not Inspected
									<input type="checkbox" ng-model="control.status3" value="control.status3" ng-checked="{{control.status3}}"> Not Present
									<input type="checkbox" ng-model="control.status4" value="control.status4" ng-checked="{{control.status4}}"> Deficient
								  </div>
								</div>
								<!-- Paragraph -->
								<div class="formcontrol paragraph" ng-if="control.type=='textarea'">
								  <p>{{control.label}}</p>
								  <div class="inputpretend paragraph">
									{{control.placeholder}}
								  </div>
								</div>
								<!--Check box-->
								<div class="formcontrol checkbox" ng-if="control.type=='checkbox'">
								  <input type="checkbox" ng-model="control.value" ng-checked="{{control.value}}"> {{control.label}}
								</div>
								<!-- Image -->
								<div class="formcontrol image imgdrop" ng-if="control.type=='image'" ng-drop="imageDrop($event,$parent.$parent.$index,$parent.$index,$index)">
								  <input type="hidden" class="updatedUrl" value="{{control.url}}"/>
								  <img class="imggap fa" ng-src="{{control.url}}" alt="Image Placeholder">  
								  <div class="commentprompt"><input type="checkbox" ng-model="control.withComment" ng-checked="{{control.withComment}}"> Add Comment</div>
								  <div ng-bind-html="control.data"></div>
								</div>
								<!-- wysiwyg -->
								<div class="formcontrol editor" ng-if="control.type=='comment'">
								  <h4><input type="checkbox" id="{{control.htmlName}}" ng-click="commentListIsVisible=!commentListIsVisible" ng-model="control.comment1" value="control.comment1" ng-checked="control.comment1"> <label for="{{control.htmlName}}">{{control.label}}</label></h4>
								  <div ng-bind-html="control.data"></div>
								</div>
								<!-- Static Text -->
								<div class="formcontrol static" ng-if="control.type=='static'">
								  <div class="instruction">
									<i class="fa fa-info-circle"></i> {{control.label}}
								  </div>
								</div>
								<!-- Page Break -->
								<div class="formcontrol break" ng-if="control.type=='break'">
								</div>
								<!-- Conditional Message -->
								<div class="formcontrol conditional" ng-if="control.type=='conditional'">
								  <div class="condtop"><input type="checkbox" ng-model="control.checked" ng-change="conditionalEval()"> {{control.label}}</div>
								</div>
								<!-- Conditional Message Target -->
								<div class="formcontrol conditional" ng-if="control.type=='reason'">
								  <div class="message" ng-class="{{control.htmlName}}">
									{{control.reason?control.reason:"Reason text for '"+control.htmlName+"' will appear here"}}
								  </div>
								</div>
								  <!--end submit controls-->
							</div>
						</div>
					</div>
				</div>
            </div>
          </div> 
        </div>
      </div>
    </form>
	<div class="print_pdf_footer">
		Elite Inspection Group, LLC<br>
		Administrative office and mailing address<br>
		PO Box 2205 Frisco, TX 75034<br>
		469-818-5500<br>
		<a href="mailto:admin@eiginspection.com">admin@eiginspection.com</a> <a href="www.eigdallas.com">www.eigdallas.com</a>
	</div>
</div>
  </div>
<?php get_footer(); ?>
<?php 
	if(empty($saved)){
		$table_template_detail = $wpdb->prefix . 'template_detail';
		$get_template_detail = $wpdb->get_results( "SELECT * FROM $table_template_detail WHERE template_id=$template_id", OBJECT );
		$form_info = (!empty($get_template_detail[0]->field_text_html) ? $get_template_detail[0]->field_text_html : '{"name":"Untitled Form 1","logo":null,"tree":[]}');
	} else {
		$inspectionreportdetail = $wpdb->prefix . 'inspectionreportdetail';
		$get_inspectionreportdetail = $wpdb->get_results( "SELECT * FROM $inspectionreportdetail WHERE id=$saved AND inspectionId=$report_id", OBJECT );
		$form_info = (!empty($get_inspectionreportdetail[0]->fieldTextHtml) ? $get_inspectionreportdetail[0]->fieldTextHtml : '{"name":"Untitled Form 1","logo":null,"tree":[]}');
	}
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
	var inspection_id = <?php echo $report_id; ?>;
	var saved = <?php echo $saved; ?>;
	var site_url = '<?php echo home_url(); ?>';
</script>  
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/imagefunctions.js"></script>
<?php /* ?><script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/bower_components/tinymce/tinymce.js"></script><?php */?>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/angular.min.js"></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/bower_components/angular-ui-tinymce/src/tinymce.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/jq.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/submitapp.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/printThis.js"></script>
	<script type="text/javascript">
	$(document).ready(function () {
		$("#printDrBtn").on("click", function (e) {
			e.preventDefault();
			$("#drlistDivTbl").printThis({
				importStyle: false,         // import style tags
				printContainer: true,
				loadCSS: "<?php echo esc_url( get_template_directory_uri() ); ?>/assets/css/print.css",
				importCSS: false,
				copyTagClasses: false,
				printDelay: 500,
				debug:false

			});
		});
		
		<?php if(isset($_GET['print'])){ ?>
			//$( "a#printDrBtn" ).click();
		<?php } ?>
		
	});
	</script>
  
