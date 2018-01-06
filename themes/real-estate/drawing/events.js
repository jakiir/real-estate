function eventListeners(){
  // Listener functions
  function mouseDownFunction(e){
    if(tools[currentTool].noAction) return true;
    isDrawing=true;
    effectCtx.fillStyle=fillColor;
    effectCtx.strokeStyle=strokeColor;
    if(tools[currentTool].noSnap){
      initX=e.offsetX;
      initY=e.offsetY;
      return false;
    }
    var inits = getNearestGrid(e.offsetX,e.offsetY);
    initX=inits.x;
    initY=inits.y;
  }
  function mouseUpFunction(e){
    if(tools[currentTool].noAction) return true;
    clearEffect();
    //Initially make it non snappy
    var final = {
      x:e.offsetX,
      y:e.offsetY
    }
    //Snap to grid for non freehand tool
    if(!tools[currentTool].noSnap){
      final = getNearestGrid(e.offsetX,e.offsetY);
    }
    //push instructions to virtual Layer

    saveInstruction(currentTool,initX,initY,final.x,final.y,gen_uuid());
    reDraw();
    //reset everything
    isDrawing=false;
    initX = 0;
    initY = 0;
  }
  function mouseMoveFunction(e){
    if(tools[currentTool].noAction) return true;
    //Validation for wrong tool config
    if(!tools[currentTool].ghost && !tools[currentTool].freeHand && !isDrawing) return false;
    if(tools[currentTool].freeHand && !isDrawing) return false;
    if(tools[currentTool].ghost && tools[currentTool].freeHand){
      console.log("One tool cannot be both Free Hand and Ghost");
      return false;
    }
    //if the tool isn't free hand, make sure the previous frame is clear
    if(!tools[currentTool].freeHand) clearEffect();
    //get ghost effect
    if(tools[currentTool].ghost){
      effectCtx.globalAlpha=0.6;
    }
    //Freehand Tool Function
    if(tools[currentTool].freeHand){
      saveInstruction(currentTool,initX,initY,e.offsetX,e.offsetY,gen_uuid());
    }
    tools[currentTool].execute(effectCtx,
      {
        startX:initX,
        startY:initY,
        endX:e.offsetX,
        endY:e.offsetY
      }
      ,effectFab);
      //reset from ghost effect
      if(currentTool.ghost){
        effectCtx.globalAlpha=1;
      }
      //freehand finishing
      if(tools[currentTool].freeHand){
        initX=e.offsetX;
        initY=e.offsetY;
      }
    }
    //Interaction Functions
    drawingFab.on('object:modified',function(){
      var activeObj = drawingFab.getActiveObject();
      if(!activeObj) return false;
      console.log(activeObj);
      var theEl = layers.filter(function(el){
        return el.uuid==activeObj.uuid;
      })[0];
      if(!theEl){
        return false;
      }
      var sGrid = getNearestGrid(activeObj.left,activeObj.top);
      var eGrid = getNearestGrid(sGrid.x+(activeObj.width*activeObj.scaleX),sGrid.y+(activeObj.height*activeObj.scaleY));
      //console.log(theEl==layers[0]);
      theEl.startX=sGrid.x;
      theEl.startY=sGrid.y;
      theEl.endX=eGrid.x;
      theEl.endY=eGrid.y;
      if(activeObj.angle){
        theEl.angle=activeObj.angle;
      }
      reDraw();
    });
    drawingFab.on('mouse:down',function(){
      var activeObj = drawingFab.getActiveObject();
      if(!activeObj){
        document.querySelector('.prefeditor').style.display='none';
        return false;
      }
      //console.log(activeObj);
      var theEl = layers.filter(function(el){
        return el.uuid==activeObj.uuid;
      })[0];
      if(!theEl){
        return false;
      }
      console.log(theEl);
      if(theEl.tool=='text'){
        document.querySelector('.prefeditor').style.display='block';
      }
      else{
        document.querySelector('.prefeditor').style.display='none';
      }
    });
    document.querySelector('.textupdatebtn')
      .addEventListener('click',function(){
        var activeObj = drawingFab.getActiveObject();
        if(!activeObj){
          document.querySelector('.prefeditor').style.display='none';
          return false;
        }
        //console.log(activeObj);
        var theEl = layers.filter(function(el){
          return el.uuid==activeObj.uuid;
        })[0];
        if(!theEl){
          return false;
        }
        theEl.text=document.querySelector('.tfvalue').value;
        reDraw();
      });
    function checkDelete(e){
      //console.log(e);
      if(e.key){
        if(e.key.toLowerCase()!='backspace' && e.keyCode != 46) return false;
      }
      var activeObj = drawingFab.getActiveObject();
      if(!activeObj){
        document.querySelector('.prefeditor').style.display='none';
        return false;
      }
      console.log(activeObj);
      var theEl = layers.filter(function(el,i){
        return el.uuid==activeObj.uuid;
      })[0];
      if(!theEl){
        return false;
      }
      layers.splice(layers.indexOf(theEl),1);
      reDraw();
    }
    document.querySelector('.downloadel')
      .addEventListener('click',function(){
        var tempa = document.querySelector('.downloadholder');
        tempa.href= drawingFab.toDataURL({
          format:'png'
        });
        tempa.download=appName+".png";
        tempa.click();
      })
    //Attaching event listeners
    var hdrs= document.querySelector('.holders');
    hdrs.addEventListener('mousedown',mouseDownFunction);
    hdrs.addEventListener('mouseup',mouseUpFunction);
    hdrs.addEventListener('mousemove',mouseMoveFunction);
    document.body.addEventListener('keyup',checkDelete);
    document.querySelector('.deletel').addEventListener('click',checkDelete);
  }
  function loadDoc(){
    console.log("Document load");
    var imageEl = document.querySelector('#theimage');
    var iWidth = imageEl.width;
    var iHeight = imageEl.height;
    if(iWidth>1000){
      iHeight = (iHeight/iWidth)*1000;
      iWidth = 1000;
    }
    console.log(iWidth,iHeight);
    setup(iWidth,iHeight,imageEl);
  }
