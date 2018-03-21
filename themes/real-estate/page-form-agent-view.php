<?php
/**
 * Template Name: Form Agent Viewer
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
$encode_tem_id = !empty($_GET['item']) ? $_GET['item'] : '';
$encode_token = !empty($_GET['token']) ? $_GET['token'] : '';
$encode_report_id = !empty($_GET['report']) ? $_GET['report'] : 0;
$encode_saved = !empty($_GET['saved']) ? $_GET['saved'] : 0;
	//$encode = safe_b64encode($encode_token);
	//echo $encode;
	$template_id = '';
	if(!$encode_tem_id || !$encode_token || !$encode_report_id || !$encode_saved)
		return false;
	
	$template_id = safe_b64decode($encode_tem_id);
	$token = safe_b64decode($encode_token);
	
	$report_id = safe_b64decode($encode_report_id);
	$saved = safe_b64decode($encode_saved);
	
	global $wpdb;
	$agent_email_log = $wpdb->prefix . 'agent_email_log';
	$get_agent_email_log = $wpdb->get_results( "SELECT * FROM $agent_email_log WHERE template_id=$template_id AND email_address='$token'  AND report_id=$report_id AND saved_id=$saved", OBJECT );
	// AND expires_in >= NOW()
	if(empty($get_agent_email_log[0]->id))
		return false;
		
get_header('form-agent-viewer');

	$att = !empty($_GET['att']) ? $_GET['att'] : '';
	$hash_id = !empty($_GET['hash']) ? $_GET['hash'] : '';

	$user_id = get_current_user_id();
	$table_inspection = $wpdb->prefix . 'inspection';
	$get_inspection = $wpdb->get_results( "SELECT * FROM $table_inspection WHERE id=$report_id", OBJECT );
	
?>
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/fa/css/font-awesome.min.css">
<div class="container" ng-controller="submissonForm">
<div id="drlistDivTbl">
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/css/form.css">
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/css/submitform_controls.css">
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/css/custom.css">
<!--<script type="text/javascript" src="<?php //echo esc_url( get_template_directory_uri() ); ?>/js/jquery.min.js"></script>-->
    <header>
      <div class="stdfields">
        <div class="fieldrow bordered">
          <div class="fieldcol">
            <p>Report Identification :</p>
            <input type="text" readonly value="<?php echo $get_inspection[0]->report_identification; ?>">
			<p>By:</p>
            <input type="text" readonly value="<?php echo $get_inspection[0]->prepared_by; ?>">
          </div>
          <div class="fieldcol">
            <p>Prepared For:</p>
            <input type="text" readonly value="<?php echo $get_inspection[0]->prepared_for; ?>">
			<p>License:</p>
            <input type="text" ng-model="formBlueprint.license">
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
		  
            <div ng-repeat="child in section.children">	
				<div ng-show="child.subsection[0].status4" class="subsectionhead section-{{$index}} {{child.display}}" ng-click="child.expanded=!child.expanded" >
				  <h2>{{child.subsection[0].label}}</h2>
				  <h5>{{child.subsection[0].description}}</h5>
				  <i class="icon fa" ng-class="{'fa-plus':!child.expanded,'fa-minus':child.expanded}"></i>
				</div>
				<div class="subsectionbody" ng-show="child.expanded">
					<div class="row" ng-repeat="controls in child.children">
						<div class="col" ng-repeat="subcontrol in controls">
							<div ng-repeat="control in subcontrol">
								<div ng-include="'<?php echo esc_url( home_url('/submition-controls-agent/?report='.$report_id.'&saved='.$saved.'&item='.$template_id.'&att='.$att.'&hash='.$hash_id) ); ?>'"></div>
							</div>
						</div>
					</div>
				</div>
            </div>
          </div> 
        </div>
      </div>
    </form>
</div>
	<?php if($report_id){ ?>
    <!--<div class="actions">
	  <div class="msg_show" style="position: absolute;left:135px;top:19px;font-size:14px;background: #fff;padding: 2px 6px;"></div>
      <div class="button primary saveChanges" ng-click="submitData(1,'','')">
        <i class="fa fa-floppy-o" aria-hidden="true"></i> Save Changes
      </div>
      <div class="button secondary">
        Draft
      </div>
      <div class="button negative">
        Discard
      </div>
    </div>-->
	<?php } ?>
  </div>
<?php get_footer(); ?>
<?php 
	global $wpdb;
	$table_template = $wpdb->prefix . 'template';	
	$form_data = $wpdb->get_results( "SELECT * FROM $table_template WHERE id=$template_id", OBJECT );
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
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/bower_components/tinymce/tinymce.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/angular.min.js"></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/bower_components/angular-ui-tinymce/src/tinymce.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/jq.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/submitapp-agent.js"></script>
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
				printDelay: 3000,
				debug:false

			});
		});
	});
	</script>
  