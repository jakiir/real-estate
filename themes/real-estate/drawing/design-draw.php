<?php
/**
 * Template Name: Design draw
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
 $template_id = !empty($_GET['item']) ? $_GET['item'] : '';
 $hash = !empty($_GET['hash']) ? $_GET['hash'] : '';
  
	if (!is_user_logged_in()) {
		echo '<script>window.location.replace("'.home_url().'");</script>';
		die('You have no access right! Please contact system administration for more information.!');
	}
	$user_id = get_current_user_id();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Canvas Client</title>
  <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/drawing/fa/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/drawing/style.css">
  <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/spectrum/spectrum.css">
	<script>
		var ajax_url = '<?php echo admin_url('admin-ajax.php'); ?>';
		var template_id = '<?php echo $template_id; ?>';
		var hash = '<?php echo $hash; ?>';
		var user_id = '<?php echo $user_id; ?>';
	</script>
</head>
<body ng-app="drawing">
<div class="toolbarholder" ng-controller="toolsController">
  <div class="toolbar left">
      <div class="drtool" ng-class="{'current':currentTool==tname}" ng-click="toolAlter(tname)" ng-repeat="(tname,tool) in tools">
        <i class="fa {{tool.icon}}"></i> <span>{{tool.name}}</span>
      </div>
      <div class="colors">
        <div class="color" ng-repeat="color in colors" ng-class="{'current':currentStrokeColor==color}" style="background-color:{{color}}" ng-click="changeColor(color)">
        </div>
      </div>
      <div class="customcolor">
        <p>Custom Color</p>
        <input type="color" class="customcolor" ng-model="currentStrokeColor" ng-change="changeColor(currentStrokeColor)">
      </div>
      <div class="strokewidthholder">
        <p>Stroke Width</p>
        <input class="strokewidth" type="range" min="1" max="15" value="1" ng-model="strokeWidth" ng-change="changeStrokeWidth()">
        <div class="strokesample" ng-style="{'height':heightInPx(strokeWidth)}"></div>
      </div>
      <div class="gridsize">
        <p>Grid Size</p>
        <select ng-model="grid" class="gsize" ng-change="changeGridSize()">
          <option value="5">5 Pixels</option>
          <option value="10">10 Pixels</option>
          <option value="20">20 Pixels</option>
          <option value="30">30 Pixels</option>
          <option value="40">40 Pixels</option>
        </select>
      </div>
    </div>
  <div class="toolbar top">
    <div class="toptoolrest">

    </div>
	<div style="color:green;margin-top:17px;" class="ajax_mess"></div>
    <div class="toptool downloadel- saveasdrave" ng-click="saveToServer()" href="#" download="drawing.png" target="_blank">
      <i class="fa fa-floppy-o" aria-hidden="true"></i> <span>Save as draft</span>
    </div>
    <div class="toptool downloadel" href="#" download="drawing.png" target="_blank">
      <i class="fa fa-floppy-o" aria-hidden="true"></i> <span>Save</span>
    </div>
    <div class="toptool deletel">
      <i class="fa fa-ban" aria-hidden="true"></i> <span>Delete</span>
    </div>
    <!-- <div class="toptool" ng-click="clear()">
      <i class="fa fa-eraser" aria-hidden="true"></i> <span>Clear</span>
    </div> -->
    <div class="toptoolspacer"></div>
    <div class="toptool" ng-click="undo()">
      <i class="fa fa-undo" aria-hidden="true"></i> <span>Undo</span>
    </div>
    <div class="toptool" ng-click="cancelUndo()">
      <i class="fa fa-repeat" aria-hidden="true"></i> <span>Redo</span>
    </div>
  </div>
  <!-- startup backdrop -->
  <div class="backdrop">
    <div class="startup">
      <div class="section">
        <p>Document Name</p>
        <div class="row">
          <input type="text" class="docname" ng-model="drawingCreds.dname">
        </div>
      </div>
      <div class="section">
        <p>Document Width</p>
        <div class="row">
          <input type="text" class="docwidth" ng-model="drawingCreds.dw"> Px
        </div>
      </div>
      <div class="section">
        <p>Document Height</p>
        <div class="row">
          <input type="text" class="docheight" ng-model="drawingCreds.dh"> Px
        </div>
      </div>
      <div class="section text-center">
        <div class="button createbtn" ng-click="createNew()">
          Create Document
        </div>
      </div>
      <div class="section text-center unfinished-title" ng-show="backupList.length">
        <p>Or Load An Unfinished one :</p>
      </div>
      <div class="unfinished">
        <p ng-repeat="backup in backupList" class="backupname" ng-click="loadBackup(backup)">
          {{backup}}
        </p>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="holders">
    <canvas class="board" id="origin"></canvas>
    <canvas class="board" id="grid"></canvas>
    <canvas class="board" id="effect"></canvas>
    <canvas class="board" id="drawing"></canvas>
  </div>
</div>
<!-- preference  -->
<div class="prefeditor">
  <div class="pref text">
    <p>Enter Text</p>
    <div class="textinner">
      <input type="text" placeholder="Enter Value here" class="tfvalue">
      <i class="fa fa-check button textupdatebtn"></i>
    </div>
  </div>
</div>
<a class="downloadholder" data-template="<?php echo $template_id; ?>" data-hash="<?php echo $hash; ?>" href="#" style="display:none"> </a>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.min.js"></script>
<!-- Libs -->
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/drawing/fabric.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/drawing/angular.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/spectrum/spectrum.js"></script>
<!-- Draw Stuff -->
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/drawing/events1.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/drawing/init1.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/drawing/utils.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/drawing/drawing1.js"></script>
<!-- tools -->
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/drawing/pointer.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/drawing/line1.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/drawing/curve.js"></script>
<!-- <script src="arrow.js"></script> -->
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/drawing/rect1.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/drawing/circle1.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/drawing/text.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/drawing/pencil.js"></script>
<!-- events -->
<!-- Angular APP -->
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/drawing/app1.js"></script>
</body>
</html>
