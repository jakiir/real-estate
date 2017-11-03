<?php 	/**	 * Template Name: Form Controls Template	 */?><!-- text -->

<!-- text -->
<div class="formcontrol text" ng-if="control.type=='label'">
  <div class="labelfield">
      {{control.label}}
  </div>
</div>
<!-- text -->
<div class="formcontrol text" ng-if="control.type=='text'">
  <div class="inputpretend">
    {{control.placeholder}}
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
    <input type="radio" ng-model="contro.status" value="i"> Inspected
    <input type="radio" ng-model="contro.status" value="ni"> Not Inspected
    <input type="radio" ng-model="contro.status" value="np"> Not Present
    <input type="radio" ng-model="contro.status" value="r"> Not Functioning
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
  <div class="editbutton" ng-click="control.editMode=true" ng-hide="control.editMode">
    <i ng-click="" class="fa fa-pencil"></i>
  </div>
  <div ng-bind-html="control.data" ng-hide="control.editMode"></div>
  <div class="wysiwygpretend" ng-show="control.editMode">
    <textarea ui-tinymce="tinymceOptions" ng-model="control.data"></textarea>
    <div class="button tbmargin get-right" ng-click="control.editMode=false">Save</div>
  </div>
</div>
<!-- wysiwyg -->
<div class="formcontrol editor" ng-if="control.type=='comment'">
  <h4>Comments</h4>
  <div class="editbutton" ng-click="control.editMode=true" ng-hide="control.editMode">
    <i ng-click="" class="fa fa-pencil"></i>
  </div>
  <div ng-bind-html="control.data" ng-hide="control.editMode"></div>
  <div class="wysiwygpretend" ng-show="control.editMode">
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