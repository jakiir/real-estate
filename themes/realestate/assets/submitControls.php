<?php 	/**	 * Template Name: Submition Controls Template	 */?>
<!-- text -->
<div class="formcontrol text" ng-if="control.type=='text'">
  <p>{{control.label}}</p>
  <input class="fcontrol" type="text" placeholder="{{control.placeholder}}" name="{{control.htmlName}}">
</div>
<!-- number -->
<div class="formcontrol number" ng-if="control.type=='number'">
  <p>{{control.label}}</p>
  <input type="number" class="fcontrol" placeholder="{{control.placeholder}}" name="{{control.htmlName}}">
</div>
<!-- Paragraph -->
<div class="formcontrol paragraph" ng-if="control.type=='textarea'">
  <p>{{control.label}}</p>
  <textarea class="longtext fcontrol" placeholder="{{control.placeholder}}" name="{{control.htmlName}}"></textarea>
</div>
<!--Check box-->
<div class="formcontrol checkbox" ng-if="control.type=='checkbox'">
  <input type="checkbox" name="{{control.htmlName}}"> {{control.label}}
</div>
<!-- Image -->
<div class="formcontrol image imgdrop" ng-if="control.type=='image'" ng-drop="imageDrop($event,$parent.$parent.$index,$parent.$index,$index)">
  <img class="imggap fa" ng-src="{{control.url}}" alt="Image Placeholder">
</div>
<!-- wysiwyg -->
<div class="formcontrol editor" ng-if="control.type=='wysiwyg'">
  <p>{{control.label}}</p>
   <textarea ui-tinymce name="{{control.htmlName}}" ng-model="control.content"></textarea>
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
  <div class="condtop"><input type="checkbox" name="{{control.htmlName}}" ng-model="control.activation"> {{control.label}}</div>
  <div class="instruction cond" ng-show="control.activation">
    <i class="fa fa-info-circle"></i> {{control.message}}
  </div>
</div>
