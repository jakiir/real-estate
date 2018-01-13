<?php
/**
 * Template Name: Canvas drawing
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
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Canvas Client</title>
  <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/drawing/fa/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/drawing/style.css">
	<script>
		var ajax_url = '<?php echo admin_url('admin-ajax.php'); ?>';
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
    <div class="toptool downloadel" href="#" download="drawing.png" target="_blank">
      <i class="fa fa-floppy-o" aria-hidden="true"></i> <span>Save</span>
    </div>
    <div class="toptool downloadel" href="#" download="drawing.png" target="_blank">
      <i class="fa fa-download" aria-hidden="true"></i> <span>Download</span>
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
      <div class="section text-center">
        Loading...
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
<img src="" alt="mainimg" crossorigin id="theimage" style="position:absolute;z-index:-2000;opacity:0" onload="loadDoc()">
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.min.js"></script>
<!-- Libs -->
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/drawing/fabric.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/drawing/angular.min.js"></script>
<!-- Draw Stuff -->
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/drawing/events.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/drawing/init.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/drawing/utils.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/drawing/drawing.js"></script>
<!-- tools -->
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/drawing/pointer.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/drawing/line.js"></script>
<!-- <script src="arrow.js"></script> -->
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/drawing/rect.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/drawing/circle.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/drawing/text.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/drawing/pencil.js"></script>
<!-- events -->
<!-- Angular APP -->
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/drawing/app.js"></script>
<!-- initialization script -->
<script type="text/javascript">
  if(!window.location.hash){
    alert("This application cannot be opened without a target file");
  }
  else{
    var whash = window.location.hash.slice(1);
    var fields = whash.split(",");
    //console.log(fields);
    var target=fields.filter(function(fd){
      //console.log(fd.match('target'));
      return fd.match('target');
    })[0];
    //console.log(target);
    if(!target){
      alert('Target Not Found');
    }
    else{
      target =target.split("=")[1];
      document.querySelector('#theimage').src=target;
      background = document.querySelector('#theimage');
      bgi = target;
    }
  }
</script>
</body>
</html>