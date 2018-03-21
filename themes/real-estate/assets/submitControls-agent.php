<?php 	/**	 * Template Name: Submition Controls Template Agent */ 
	$template_id = !empty($_GET['item']) ? $_GET['item'] : '';
	$att = !empty($_GET['att']) ? $_GET['att'] : '';
	$hash_id = !empty($_GET['hash']) ? $_GET['hash'] : '';
	$report_id = !empty($_GET['report']) ? $_GET['report'] : 0;
	$saved = !empty($_GET['saved']) ? $_GET['saved'] : 0;
?>
<div ng-show="false" ng-if="control.type=='report'">
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
<div ng-show="false" class="formcontrol text" ng-if="control.type=='label'">
  <div class="labelfield">
      {{control.label}}
  </div>
</div>
<!-- text -->
<div ng-show="false" class="formcontrol text" ng-if="control.type=='text'">
  <textarea class="textinput" placeholder="{{control.placeholder}}"></textarea>
</div>
<!-- Section -->
<div class="formcontrol number" ng-if="control.type=='section'">
  <h1>{{control.label}}</h1>
  <h4>{{control.description}}</h4>
</div>
<!-- Sub Section -->
<div ng-show="false" class="formcontrol number" ng-if="control.type=='subsection'">
  <h2>{{control.label}}</h2>
  <div>  
	<input type="checkbox" ng-model="control.status1" value="control.status1" ng-checked="control.status1"> Inspected
    <input type="checkbox" ng-model="control.status2" value="control.status2" ng-checked="control.status2"> Not Inspected
    <input type="checkbox" ng-model="control.status3" value="control.status3" ng-checked="control.status3"> Not Present
    <input type="checkbox" ng-model="control.status4" value="control.status4" ng-checked="control.status4"> Deficient
  </div>
</div>
<!-- Paragraph -->
<div ng-show="false" class="formcontrol paragraph" ng-if="control.type=='textarea'">
  <p>{{control.label}}</p>
  <div class="inputpretend paragraph">
    {{control.placeholder}}
  </div>
</div>
<!--Check box-->
<div ng-show="control.value" class="formcontrol checkbox" ng-if="control.type=='checkbox'">
  <input type="checkbox" ng-model="control.value"> {{control.label}}
</div>
<!-- Image -->
<div ng-show="control.withComment" class="formcontrol image imgdrop" ng-if="control.type=='image'" ng-drop="imageDrop($event,$parent.$parent.$index,$parent.$index,$index)">
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
  <div class="commentprompt"><input type="checkbox" ng-model="control.withComment"> Add Comment</div>
  <div class="imgcomment" ng-show="control.withComment">
    <textarea ui-tinymce="tinymceOptions" ng-model="control.data"></textarea>
  </div>
</div>
<!-- wysiwyg -->
<div class="formcontrol editor" ng-if="control.type=='wysiwyg'" ng-style="{'border':control.isInstruction?'1px solid black':'none'}">
  <div ng-bind-html="control.data"></div>
</div>
<!-- wysiwyg -->
<div ng-show="control.comment1" class="formcontrol editor" ng-if="control.type=='comment'">
  <h4><input type="checkbox" id="{{control.htmlName}}" ng-click="commentListIsVisible=!commentListIsVisible" ng-model="control.comment1" value="control.comment1" ng-checked="control.comment1"> <label for="{{control.htmlName}}">{{control.label}}</label></h4>
  <div class="editbutton" ng-click="control.editMode=true" ng-show="commentListIsVisible=control.comment1">
    <i ng-click="" class="fa fa-pencil"></i>
  </div>
  <div ng-bind-html="control.data" ng-show="commentListIsVisible=control.comment1"></div>
  <div class="wysiwygpretend" ng-show="control.editMode">
    <textarea ui-tinymce="tinymceOptions" ng-model="control.data"></textarea>
    <div class="button tbmargin get-right" ng-click="control.editMode=false">Save</div>
  </div>
</div>
<!-- Static Text -->
<div ng-show="false" class="formcontrol static" ng-if="control.type=='static'">
  <div class="instruction">
    <i class="fa fa-info-circle"></i> {{control.label}}
  </div>
</div>
<!-- Page Break -->
<div ng-show="false" class="formcontrol break" ng-if="control.type=='break'">
</div>
<!-- Conditional Message -->
<div ng-show="false" class="formcontrol conditional" ng-if="control.type=='conditional'">
  <div class="condtop"><input type="checkbox" ng-model="control.checked" ng-change="conditionalEval()"> {{control.label}}</div>
</div>
<!-- Conditional Message Target -->
<div ng-show="false" class="formcontrol conditional" ng-if="control.type=='reason'">
  <div class="message" ng-class="{{control.htmlName}}">
    {{control.reason?control.reason:"Reason text for '"+control.htmlName+"' will appear here"}}
  </div>
</div>