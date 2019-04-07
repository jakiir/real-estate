<?php 	/**	 * Template Name: Submition Controls Template */ 
	$template_id = !empty($_GET['item']) ? $_GET['item'] : '';
	$att = !empty($_GET['att']) ? $_GET['att'] : '';
	$hash_id = !empty($_GET['hash']) ? $_GET['hash'] : '';
	$report_id = !empty($_GET['report']) ? $_GET['report'] : 0;
	$saved = !empty($_GET['saved']) ? $_GET['saved'] : 0;
?>
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
<div class="formcontrol" ng-if="control.type=='report_form'">
	<?php 
		$getPrint = (isset($_GET['print']) && $_GET['print'] != '' ? 'yes' : '' );
		if($getPrint != 'yes'){
	?>
	<div class="stdreportf">
		<div class="controlholder">
		  <div class="row">
			<div class="col">
			  <p>Building Orientation</p>
			  <input type="text" id="building_orientation" ng-model="formBlueprint.building_orientation" placeholder="Building Orientation">
			</div>
			<div class="col">
				<p>Weather Conditions</p>
				<div class="share-checkbox">
				  <input type="checkbox" ng-model="formBlueprint.parties_present_sunny" value="formBlueprint.parties_present_sunny" ng-checked="{{formBlueprint.parties_present_sunny}}" id="checkbox-sunny"><label for="checkbox-sunny">Sunny</label>
				  <input type="checkbox" ng-model="formBlueprint.parties_present_raining" value="formBlueprint.parties_present_raining" ng-checked="{{formBlueprint.parties_present_raining}}" id="checkbox-raining"><label for="checkbox-raining">Raining</label>
				  <input type="checkbox" ng-model="formBlueprint.parties_present_cloudy" value="formBlueprint.parties_present_cloudy" ng-checked="{{formBlueprint.parties_present_cloudy}}" id="checkbox-cloudy"><label for="checkbox-cloudy">Cloudy</label>
				  <input type="checkbox" ng-model="formBlueprint.parties_present_ice" value="formBlueprint.parties_present_ice" ng-checked="{{formBlueprint.parties_present_ice}}" id="checkbox-Snow-Ice"><label for="checkbox-Snow-Ice">Snow/Ice</label>
				</div>
			</div>			
		  </div>
		  <div class="row">
			<div class="col">			 
			  <p>Temperature</p>
			  <input type="text" id="temperature" ng-model="formBlueprint.temperature" placeholder="Temperature">
			</div>
			<div class="col">
			  <p>Parties Present</p>
			  <div class="share-checkbox">
				  <input type="checkbox" ng-model="formBlueprint.parties_present_client" value="formBlueprint.parties_present_client" ng-checked="{{formBlueprint.parties_present_client}}" id="checkbox-client">
				  <label for="checkbox-client">Client</label>
				  <input type="checkbox" ng-model="formBlueprint.parties_present_realtor" value="formBlueprint.parties_present_realtor" ng-checked="{{formBlueprint.parties_present_realtor}}" id="checkbox-buyer-realtor">
				  <label for="checkbox-buyer-realtor">Buyer’s Realtor</label>
				  <input type="checkbox" ng-model="formBlueprint.parties_present_builder" value="formBlueprint.parties_present_builder" ng-checked="{{formBlueprint.parties_present_builder}}" id="checkbox-builder"><label for="checkbox-builder">Builder</label>
				  <input type="checkbox" ng-model="formBlueprint.parties_present_seller" value="formBlueprint.parties_present_seller" ng-checked="{{formBlueprint.parties_present_seller}}" id="checkbox-seller"><label for="checkbox-seller">Seller</label>
				  <input type="checkbox" ng-model="formBlueprint.parties_present_none" value="formBlueprint.parties_present_none" ng-checked="{{formBlueprint.parties_present_none}}" id="checkbox-none"><label for="checkbox-none">None</label>
				</div>
			</div>
		  </div>
		</div>
	</div>
		<?php } else { ?>
		<div class="row">
			<div class="col">
				<p align="center" style="text-align: center;">
					<div style="font-size:18px;color:#000;display:block;margin-bottom:20px;">Report Identification: </div>
					<div style="font-size:16px;color:#000;display:block;">Inspection Time In: <?php echo $get_inspection[0]->time_in; ?> Time Out: <?php echo $get_inspection[0]->time_out; ?> Property was: <?php echo $get_inspection[0]->inspection_status; ?><br/>Building Orientation (For The Purpose Of This Report, the Front Faces): {{formBlueprint.building_orientation}}<br/>Weather conditions During Inspection: {{formBlueprint.parties_present_sunny ? 'Sunny' : ''}}{{formBlueprint.parties_present_raining ? ', Raining' : ''}}{{formBlueprint.parties_present_cloudy ? ', Cloudy' : ''}}{{formBlueprint.parties_present_ice ? ', Snow/Ice' : ''}} Temp: {{formBlueprint.temperature}}<br/>Parties present at inspection: 
					{{formBlueprint.parties_present_client ? 'Client' : ''}}{{formBlueprint.parties_present_realtor ? ', Buyer’s Realtor' : ''}}{{formBlueprint.parties_present_builder ? ', Builder' : ''}}{{formBlueprint.parties_present_seller ? ', Seller' : ''}}{{formBlueprint.parties_present_none ? ', None' : ''}}</div>
				</p>
			</div>		
		</div>
		<?php } ?>
</div>
<!-- text -->
<div class="formcontrol text text_label" ng-if="control.type=='label'">
  <div class="labelfield">
      {{control.label}}
  </div>
</div>
<!-- text -->
<div class="formcontrol text text_box" ng-if="control.type=='text'">
  <textarea class="textinput" ng-model="control.data"></textarea>
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
<?php /* ?><div class="formcontrol paragraph" ng-if="control.type=='textarea'">
  <p>{{control.label}}</p>
  <div class="inputpretend paragraph">
    {{control.placeholder}}
  </div>
</div><?php */ ?>
<!--Check box-->
<div class="formcontrol checkbox inline-checkbox-view" ng-if="control.type=='checkbox'">
  <input type="checkbox" ng-model="control.value" ng-checked="{{control.value}}" ng-click="getLebelTxtVal($event,control.htmlName)" class="{{control.htmlName}}" id="{{control.htmlName}}"> <label for="{{control.htmlName}}">{{control.label}}</label>
</div>
<!-- Image -->
<div class="formcontrol image imgdrop add_comment_{{control.withComment}} not_required_{{control.notRequired}}" ng-if="control.type=='image'" ng-drop="imageDrop($event,$parent.$parent.$index,$parent.$index,$index)">
<?php 
	$get_att_url = '';
	if($att){
		$get_att_url = wp_get_attachment_url( $att );
	}
?>
  <input type="hidden" class="updatedUrl" value="{{control.hash=='<?php echo $hash_id; ?>'?'<?php echo $get_att_url; ?>':control.url}}"/>
  <img class="imggap fa" data-ng-init="uplodFile(control,'<?php echo $hash_id; ?>','<?php echo $get_att_url; ?>')" ng-src="{{control.hash=='<?php echo $hash_id; ?>'?'<?php echo $get_att_url; ?>':control.url}}" alt="Image Placeholder">  
  <div class="fileinput flex flexcenter hovereffect" ng-click="imageFileMess=!imageFileMess">
    <!--<input type="file" class="invisible fileinp" c-on-change="fileBrowse(control)">-->	
	<div class="documentHides" style="position:absolute;top:-77px;border:1px solid #000;background:#fff;padding:3px;width: 164px;" ng-hide="imageFileMess">
		<a class="goToDrawing frontend-button" href="#" ng-click="mediaUploderClb(control)"><i class="fa fa-picture-o" aria-hidden="true"></i> Open media <i class="fa fa-expand" aria-hidden="true"></i></a>
		<a class="goToDrawing" ng-click="goToDrawing($event)" dataurl="<?php echo home_url('/canvas-drawing/?report='.$report_id.'&item='.$template_id.'&hash={{control.hash}}'); ?>" targetUrl="#target={{control.url}}" href="#"><i class="fa fa-picture-o" aria-hidden="true"></i> Annotate Image <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
		<a class="goToDrawing" ng-click="goToDrawing($event)" dataurl="<?php echo home_url('/design-draw/?report='.$report_id.'&item='.$template_id.'&hash={{control.hash}}'); ?>" targetUrl="" href="#"><i class="fa fa-picture-o" aria-hidden="true"></i> Survey Drawing <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
	</div>
	<span class="invisible fileinp"></span>
    <i class="fa fa-folder-open"></i>
  </div>
  <div class="commentprompt"><input type="checkbox" ng-model="control.withComment" ng-checked="{{control.withComment}}"> Display Image & Add Comment (If Any) <input type="checkbox" ng-model="control.notRequired"> NOT REQUIRED</div>
  <div ng-bind-html="control.data" class="printShow"></div>
  <div class="imgcomment" ng-show="control.withComment">
    <textarea ui-tinymce="tinymceOptions" ng-model="control.data"></textarea>
  </div>
</div>
<!-- wysiwyg -->
<div class="formcontrol editor" ng-if="control.type=='wysiwyg'" ng-style="{'border':control.isInstruction?'1px solid black':'none'}">
  <div ng-bind-html="control.data"></div>
</div>
<!-- wysiwyg -->
<div class="formcontrol editor" ng-if="control.type=='comment'">
  <h4><input type="checkbox" id="{{control.htmlName}}" ng-click="commentListIsVisible=!commentListIsVisible" ng-model="control.comment1" value="control.comment1" ng-checked="{{control.comment1}}" class="commentCheckbox"> <label for="{{control.htmlName}}">{{control.label}}</label></h4>
	<label class="switch" ng-show="commentListIsVisible=control.comment1">
		<input type="checkbox" ng-init="control.shareicon=control.shareicon !== false || control.shareicon === true ? true : false" ng-model="control.shareicon" value="{{control.shareicon}}" ng-checked="{{control.shareicon}}">
		<span class="slider round"></span>
	</label>
  <div class="editbutton" ng-click="control.editMode=true" ng-show="commentListIsVisible=control.comment1">	
    <i ng-click="" class="fa fa-pencil"></i>
  </div>
  <div ng-bind-html="control.data" ng-show="commentListIsVisible=control.comment1"></div>
  <div class="wysiwygpretend" ng-show="control.editMode">
    <textarea ui-tinymce="tinymceOptions" ng-model="control.data"></textarea>
    <div class="button tbmargin get-right" ng-click="control.editMode=false">Save</div>
  </div>
</div>
<!-- advertisment -->
<div class="formcontrol editor" ng-if="control.type=='advertisement'">  
  <div ng-bind-html="control.data"></div>
  <div class="wysiwygpretend">
    <textarea ui-tinymce="tinymceOptions" ng-model="control.data"></textarea>
    <div class="button tbmargin get-right" ng-click="control.editMode=false">Save</div>
  </div>  
</div>
<!-- textarea -->
<div class="formcontrol textarea" ng-if="control.type=='textarea'">
	<textarea ng-model="control.data"></textarea>
</div>
<div class="formcontrol shortcode" ng-if="control.type=='shortcode'">
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