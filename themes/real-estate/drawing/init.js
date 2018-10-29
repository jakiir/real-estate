//Global variables
var appName = "document1";
var bgi = "";
var background = null;
var originCvs = document.querySelector('canvas#origin');
var originCtx = originCvs.getContext('2d');
var gridCvs = document.querySelector('canvas#grid');
var gridCtx = gridCvs.getContext('2d');
var drawingCvs = document.querySelector('canvas#drawing');
var drawingCtx = drawingCvs.getContext('2d');
var effectCvs = document.querySelector('canvas#effect');
var effectCtx = effectCvs.getContext('2d');
var originFab = null;
var drawingFab = null;
var effectFab = null;
var globalWidth=0;
var globalHeight=0;
var globalGridSize = 10;
var globalStrokeWidth=3;
var isDrawing=false;
var initX = 0;
var initY = 0;
var fillColor="#FFFFFF";
var strokeColor="#FF0000";
//tools
var tools = {};
var currentTool='arrow';
//Virtual Layers
var layers = [];
//Undo and redo
var versions = [];
var redoList =[];
//Iitial Setup
function setup(width,height,background){
  //document.querySelector('.backdrop').style.display="none";
  //set globals
  globalWidth=width;
  globalHeight=height;
  //set the sizes
  originCvs.width=width;
  originCvs.height=height;
  drawingCvs.width=width;
  drawingCvs.height=height;
  effectCvs.width=width;
  effectCvs.height=height;
  //Set the colors
  effectCtx.fillStyle=fillColor;
  effectCtx.strokeStyle=strokeColor;
  drawingCtx.fillStyle=fillColor;
  drawingCtx.strokeStyle=strokeColor;
  //Initialize FabricJS objects
  // originFab  = new fabric.Canvas('origin');
  var bgi = new fabric.Image(background,{
    width:globalWidth,
    height:globalHeight,
    left:0,
    top:0,
    selectable:false
  });
  drawingFab = new fabric.Canvas('drawing');
  drawingFab.add(bgi);
  drawingFab.selection=true;
  effectFab  = new fabric.StaticCanvas('effect');
  createGrid(globalGridSize);
  eventListeners();
}
// Grid Drawing function
function createGrid(distance){
  globalGridSize=distance;
  //reset grid canvas
  gridCvs.width=globalWidth;
  gridCvs.height=globalHeight;
  //draw 1px dots
  for(i=0;i<globalHeight;i+=distance){
    for(j=0;j<globalWidth;j+=distance){
      gridCtx.fillRect(i,j,1,1);
    }
  }
}
