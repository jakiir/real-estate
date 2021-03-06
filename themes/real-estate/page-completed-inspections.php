<?php
get_header(); ?>
<?php 
	if (!is_user_logged_in()) {
		echo '<script>window.location.replace("'.home_url().'");</script>';
		die('You have no access right! Please contact system administration for more information.!');
	}
?>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/moment.min.js"></script>
  <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/jquery-ui-1.10.0.custom.min.css" />
  <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery-ui.js"></script>
<style>
	#profilePicRemover{
		position: absolute;
		top: 2px;
		right: 22px;
	}
	label.error{color:red;}
</style>
<!-- BLOG -->

<article class="container">
	<div class="row">
	  <div class="col-sm-8 col-sm-offset-2">
		<div class="box perform-inspection-box">
		  <h2 class="page-title-body">Completed Inspections</h2>
		<?php
			global $wpdb;
			$user_id = get_current_user_id();			
			$parrent_user = esc_attr( get_the_author_meta( 'parrent_user', $user_id ) );
			if(empty($parrent_user)) $parrent_user = $user_id;
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
			$template_table = $wpdb->prefix . 'template';
			$table_inspection = $wpdb->prefix . 'inspection';
			$inspectionReportDetail = $wpdb->prefix . 'inspectionreportdetail';
			$user = wp_get_current_user();
			$getShowData = (isset($_GET['show']) ? $_GET['show'] : '');
			$whereAdd = '';
			if($getShowData == 'year'){
				$thisYear = date('Y');
				$whereAdd = " YEAR(inpection_date) = $thisYear";
			}
			if($getShowData == 'month'){
				$whereAdd = " inpection_date BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()";
			}
			
			if(!empty($user) && $user->roles[0] == 'administrator'){
				if(!empty($whereAdd))
				$whereAdd = ' WHERE '.$whereAdd;
			
				$get_inspection = $wpdb->get_results( "SELECT ins.id,ins.company,ins.template_id,ins.report_identification,ins.prepared_for,ins.inpection_date,ird.id as ird_id FROM $table_inspection as ins JOIN $inspectionReportDetail as ird ON ird.inspectionId=ins.id $whereAdd ORDER BY ins.inpection_date DESC", OBJECT );
			} else {
				if(!empty($whereAdd))
				$whereAdd = ' AND '.$whereAdd;
			
				$get_inspection = $wpdb->get_results( "SELECT ins.id,ins.company,ins.template_id,ins.report_identification,ins.prepared_for,ins.inpection_date,ird.id as ird_id FROM $table_inspection as ins JOIN $inspectionReportDetail as ird ON ird.inspectionId=ins.id WHERE ins.user_id IN ($selected_user) $whereAdd ORDER BY ins.inpection_date DESC", OBJECT );
			}
		?>
		<div class="panel-body table-responsive">
			
			<table class="table table-striped table-filter" border="0" cellspacing="0" width="100%">
				<tr>
					<td>Date Range:</td>
					<td>
						<input class="form-control datepicker date-range-filter" data-date-format="mm/dd/yyyy" type="text" name="date_range" id="from" value="">
					</td>
					<td>To:</td>
					<td>
					<input class="form-control datepicker date-range-filter" data-date-format="mm/dd/yyyy" type="text" name="dateTo" id="to" value="">
					</td>
				</tr>
			</table>
		
			<table class="table table-striped table-bordered" cellspacing="0" width="100%" id="devTable">
				<thead>
					<tr>
						<th>#</th>
						<th>Report Id</th>
						<th>Template</th>
						<th>Prepared For</th>
						<th>Date</th>
						<th>#</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						if(!empty($get_inspection)) {
						$inc=1;						
						foreach($get_inspection as $inspection){
							$templateId = $inspection->template_id;
							$get_template = $wpdb->get_results( "SELECT name,wood_inspection FROM $template_table WHERE id=$templateId", OBJECT );
							$wood_inspection = $get_template[0]->wood_inspection;
					?>
						<tr>
							<td><input type="checkbox" onClick="eachSelect(this,<?php echo $wood_inspection; ?>)" name="report_box[]" data-report="<?php echo $inspection->id; ?>" data-saved="<?php echo $inspection->ird_id; ?>" data-url="link-<?php echo $inc; ?>" data-title="<?php echo $inspection->report_identification; ?>" data-company="<?php echo $inspection->company; ?>" data-prepared_for="<?php echo $inspection->prepared_for; ?>" value="<?php echo $inspection->template_id; ?>" data-print-url="<?php echo home_url('/template-print-page/?template='.$inspection->template_id.'&reportId='.$inspection->id.'&savedId='.$inspection->ird_id); ?>"/></td>
							<td><a target="_blank" href="<?php echo home_url('/form-viewer/?item='.$inspection->template_id.'&report='.$inspection->id.'&saved='.$inspection->ird_id); ?>" class="link-<?php echo $inc; ?>" title="<?php echo $inspection->report_identification; ?>"><?php echo $inspection->report_identification; ?></a></td>
							<td><?php echo $get_template[0]->name; ?></td>
							<td><?php echo $inspection->prepared_for; ?></td>
							<td><?php echo date('m/d/Y', strtotime($inspection->inpection_date)); ?></td>
							<td><a target="_blank" href="<?php echo home_url('/edit-inspections/?ins_id='.$inspection->id); ?>" class="link-<?php echo $inc; ?>" title="<?php echo $inspection->report_identification; ?>"><i class="fa fa-edit"></i></a></td>
						</tr>
					<?php $inc++; }} ?>
				</tbody>
			</table>
			<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
				<div class="row">
					<div class="col-sm-7 col-sm-offset-1">
						<div class="dataTables_paginate paging_simple_numbers">					
							<button type="button" class="btn-taptap checkBoxSlected printSelectedItem" disabled="disabled"><i class="fa fa-print"></i> Print</button>
							<button type="button" class="btn-taptap checkBoxSlected" data-toggle="modal" data-target="#shareFormView" disabled="disabled"><i class="fa fa-share"></i> Share</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
		</div>
		</div>
</section>
	<!-- /BLOG -->
	<?php 
		/*$inspectionreportdetail = $wpdb->prefix . 'inspectionreportdetail';
		$get_inspectionreportdetail = $wpdb->get_results( "SELECT * FROM $inspectionreportdetail WHERE id=5 AND inspectionId=15", OBJECT );
		$form_info = (!empty($get_inspectionreportdetail[0]->fieldTextHtml) ? $get_inspectionreportdetail[0]->fieldTextHtml : '{"name":"Untitled Form 1","logo":null,"tree":[]}');
		echo $form_info;*/
	?>
	<!-- Modal -->
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
			<p class="msg_show"></p>
			<p><button type="submit" class="btn-taptap checkBoxSlected" disabled="disabled"><i class="fa fa-share"></i> SHARE REPORT</button></p>
		</form>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">

$(document).ready(function() {
	
	 $( "#from" ).datepicker({
		dateFormat: 'mm/dd/yy',
		defaultDate: "+1w",
		changeMonth: true,
		onClose: function( selectedDate ) {
		  $( "#to" ).datepicker( "option", "minDate", selectedDate );
		}
	  });
	  $( "#to" ).datepicker({
		dateFormat: 'mm/dd/yy',
		defaultDate: "+1w",
		changeMonth: true,
		onClose: function( selectedDate ) {
		  $( "#from" ).datepicker( "option", "maxDate", selectedDate );
		}
	  });
	  
	// Set up your table
	table = $('#devTable').DataTable({
		"iDisplayLength": 10,
		//"order": [[ 3, "asc" ]]
	});

	// Extend dataTables search
	$.fn.dataTable.ext.search.push(
	  function(settings, data, dataIndex) {
		var min = $('#from').val();
		var max = $('#to').val();
		var createdAt = data[3]; // Our date column in the table
		if (
		  (min == "" || max == "") ||
		  (moment(createdAt).isSameOrAfter(min) && moment(createdAt).isSameOrBefore(max))
		) {
		  return true;
		}
		return false;
	  }
	);

	// Re-draw the table when the a date range filter changes
	$('.date-range-filter').change(function() {
	  table.draw();
	});
	
	/*$('.datepicker').datetimepicker({
		viewMode: 'years',
		format: 'MM/DD/YYYY'
	});*/
	
	
	  
	$("#shareForm").validate();
	$(document).on("click", ":submit", function(e) {
			$('.msg_show').html('<i class="fa fa-refresh fa-spin" aria-hidden="true"></i>');
			var formValid = $("#shareForm").valid();
			var thisForm = $(this);
			
			var checkboxesaa = document.querySelectorAll('input[name="report_box[]"]:checked');

            var getSelected = [];
			var getSelectedReport = [];
			var getSelectedSaved = [];
			var getSelectedTitle = [];
			var getSelectedCompany = [];
			var getSelectedPrep = [];
            for(var i=0, n=checkboxesaa.length;i<n;i++) {
                getSelected.push(checkboxesaa[i].value);
				getSelectedReport.push(checkboxesaa[i].getAttribute("data-report"));
				getSelectedSaved.push(checkboxesaa[i].getAttribute("data-saved"));
				getSelectedTitle.push(checkboxesaa[i].getAttribute("data-title"));
				getSelectedCompany.push(checkboxesaa[i].getAttribute("data-company"));
				getSelectedPrep.push(checkboxesaa[i].getAttribute("data-prepared_for"));
            }
            if(getSelected.length == 0){
				$('.msg_show').html('<span style="color:red">Please, select minimum 1 template!</span>');
                return false;
            }
			
			if (formValid === true) {
				var agentEmailAddress = jQuery('#agentEmailAddress').val();
				
				var form_data = new FormData();
				
				form_data.append('action', 'send_agent_email');
				form_data.append('getSelected', getSelected);				
				form_data.append('getSelectedReport', getSelectedReport);
				form_data.append('getSelectedSaved', getSelectedSaved);
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
						  $('.msg_show').html('');
						  $('.msg_show').html('<span style="color:green">'+parsedJson.mess+'</span>');
						  location.reload();
					  } else {
						  $('.msg_show').html('');
						 $('.msg_show').html('<span style="color:red">'+parsedJson.mess+'</span>');
					  }
					},
					error: function (errorThrown) {
						$('.msg_show').html('');
						$('.msg_show').html('<span style="color:red">'+errorThrown+'</span>');						
					}
				});
			}			
			return false;
			
		});
		
		$('.printSelectedItem').on('click', function(){
			//var getLastCheckBox = $('input[name="report_box[]"]:checked').last().attr('data-url');
			//var gethrefUrl = $('.'+getLastCheckBox).attr('href');
			var getPrintUrl = $('input[name="report_box[]"]:checked').last().attr('data-print-url');
			//window.location.href = gethrefUrl+'&print=1';
			newwindow=window.open(getPrintUrl+'&print=1','width=560,height=340,toolbar=0,menubar=0,location=0');
			//console.log(newwindow);
			
		});
	
});

function eachSelect(source,templateType){
	if(templateType == true){
		alert('This template is not shareable!');
		$(source).prop('checked', false);
		return false;
	}
	var checkedboxesCount = document.querySelectorAll('input[name="report_box[]"]:checked').length;
	if(checkedboxesCount > 0){
		$('.checkBoxSlected').prop('disabled',false);
	} else {
		$('.checkBoxSlected').prop('disabled',true);
	}
}

</script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/main.js"></script>
<?php //get_footer();
