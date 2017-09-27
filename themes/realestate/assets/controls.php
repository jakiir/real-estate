<?php 	/**	 * Template Name: Form Controls Template	 */?><!-- text -->
<div class="formcontrol text" ng-if="control.type=='text'">
  <p>{{control.label}}</p>
  <div class="inputpretend">
    {{control.placeholder}}
  </div>
</div>
<!-- number -->
<div class="formcontrol number" ng-if="control.type=='number'">
  <p>{{control.label}}</p>
  <div class="inputpretend">
    {{control.placeholder}}
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
  <img class="imggap fa" ng-src="{{control.url}}" alt="Image Placeholder">
</div>
<!-- wysiwyg -->
<div class="formcontrol editor" ng-if="control.type=='wysiwyg'">
  <p>{{control.label}}</p>
  <div class="wysiwygpretend">
    <img class="imgw" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/editor.png" alt="Editor">
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
  <div class="condtop"><input type="checkbox"> {{control.label}}</div>
  <div class="instruction cond">
    <i class="fa fa-info-circle"></i> {{control.message}}
  </div>
</div>
