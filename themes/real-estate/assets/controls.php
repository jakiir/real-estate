<?php 	/**	 * Template Name: Form Controls Template	 */?>
<!-- text -->
<div class="formcontrol text" ng-if="control.type=='label'">
  <div class="labelfield">
      {{control.label}}
  </div>
</div>
<!-- text -->
<div class="formcontrol text" ng-if="control.type=='text'">
  <div class="inputpretend">
    {{control.default}}
  </div>
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
	<input type="checkbox" ng-model="control.status1" value="control.status1" ng-checked="control.status1"> Inspected
    <input type="checkbox" ng-model="control.status2" value="control.status2" ng-checked="control.status2"> Not Inspected
    <input type="checkbox" ng-model="control.status3" value="control.status3" ng-checked="control.status3"> Not Present
    <input type="checkbox" ng-model="control.status4" value="control.status4" ng-checked="control.status4"> Deficient
	
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
  <input type="checkbox"> {{control.label}}
</div>
<!-- Image -->
<div class="formcontrol image imgdrop" ng-if="control.type=='image'" ng-drop="imageDrop($event,$parent.$parent.$index,$parent.$index,$index)">
  <input type="checkbox" ng-model="control.isExample"> Example Image </br></br>
  <img class="imggap fa" ng-src="{{control.url}}" alt="Image Placeholder">
</div>
<!-- wysiwyg -->
<div class="formcontrol editor" ng-if="control.type=='wysiwyg'">
  <div class="editbutton" ng-click="control.editMode=true" ng-if="!control.editMode">
    <i ng-click="" class="fa fa-pencil"></i>
  </div>
  <div ng-bind-html="control.data" ng-if="!control.editMode"></div>
  <div class="wysiwygpretend" ng-if="control.editMode">
    <textarea ui-tinymce="tinymceOptions" ng-model="control.data"></textarea>
    <div class="button tbmargin get-right" ng-click="control.editMode=false">Save</div>
  </div>
  <input type="checkbox" ng-model="control.isInstruction"> Instruction field
</div>
<!-- wysiwyg -->
<div class="formcontrol editor" ng-if="control.type=='comment'">
  <h4>{{control.label}}</h4>
  <div class="editbutton" ng-click="control.editMode=true" ng-if="!control.editMode">
    <i ng-click="" class="fa fa-pencil"></i>
  </div>
  <div ng-bind-html="control.data" ng-if="!control.editMode"></div>
  <div class="wysiwygpretend" ng-if="control.editMode">
    <textarea ui-tinymce="tinymceOptions" ng-model="control.data"></textarea>
    <div class="button tbmargin get-right" ng-click="control.editMode=false">Save</div>
  </div>
</div>
<!-- advertisment -->
<div class="formcontrol editor" ng-if="control.type=='advertisement'">
  <h4>{{control.label}}</h4>
  <div class="editbutton" ng-click="control.editMode=true" ng-if="!control.editMode">
    <i ng-click="" class="fa fa-pencil"></i>
  </div>
  <div ng-bind-html="control.data" ng-if="!control.editMode"></div>
  <div class="wysiwygpretend" ng-if="control.editMode">
    <textarea ui-tinymce="tinymceOptions" ng-model="control.data"></textarea>
    <div class="button tbmargin get-right" ng-click="control.editMode=false">Save</div>
  </div>
</div>
<!-- Static Text -->
<div class="formcontrol static" ng-if="control.type=='static'">
  <div class="instruction">
    <i class="fa fa-info-circle"></i> {{control.label}}
  </div>
</div>
<!-- report Text -->
<div class="formcontrol- report" ng-if="control.type=='report'">
	<div class="stdreportf">
		<div class="controlholder">
		  <div class="row">
			<div class="col">
			  <p>Company Logo</p>
			  <div class="clogoholder">
				<img class="companylogo" ng-src="{{data.logo}}" alt="Company Logo">
				<input class="fiimg" c-on-change="changeCompanyLogo()" type="file" accept="image/*">
			  </div>
			</div>
		  </div>
		  <div class="row">
			<div class="col">
			  <p>Report Title</p>
			  <input type="text" ng-model="data.report_title" placeholder="Report Title">
			</div>
			<div class="col">
			  <p>Company Address</p>
			  <input type="text" ng-model="data.company_address" placeholder="Enter The address here">
			</div>
		  </div>
		</div>
	</div>
</div>
<!-- Page Break -->
<div class="formcontrol break" ng-if="control.type=='break'">
  <div class="pagebreak"></div>
  <div class="text-center breaktext"><span>{{control.label}}</span></div>
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