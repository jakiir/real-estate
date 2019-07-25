function eventListeners(){
  // Listener functions
  function mouseDownFunction(e){
    //console.log(e);
    if(tools[currentTool].noAction) return true;
    isDrawing=true;
    effectCtx.fillStyle=fillColor;
    effectCtx.strokeStyle=strokeColor;
    var x = null;
    var y = null;
    var x = e.offsetX || e.clientX;
    var y = e.offsetY || e.clientY;
    if(tools[currentTool].noSnap){
      initX=x
      initY=y;
      return false;
    }
    var inits = getNearestGrid(x,y);
    initX=inits.x;
    initY=inits.y;
  }
  function mouseUpFunction(e){
    //console.log(e);
    if(tools[currentTool].noAction) return true;
    clearEffect();
    //Initially make it non snappy
    var x = null;
    var y = null;
    //return console.log(e);
    x = e.offsetX || e.clientX;
    y = e.offsetY || e.clientY;
    var final = {
      x:x,
      y:y
    }
    //Snap to grid for non freehand tool
    if(!tools[currentTool].noSnap){
      final = getNearestGrid(x,y);
    }
    //push instructions to virtual Layer

    saveInstruction(currentTool,initX,initY,final.x,final.y,gen_uuid());
    reDraw();
    //reset everything
    isDrawing=false;
    initX = 0;
    initY = 0;
    //Change  back to pointer if the tool has boomerang mode
    if (tools[currentTool].boomerang) {
      changeTool('pointer');
    }
  }
  function mouseMoveFunction(e){
    //console.log(e);
    var x = null;
    var y = null;
    x = e.offsetX || e.clientX;
    y = e.offsetY || e.clientY;
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
      saveInstruction(currentTool,initX,initY,x,y,gen_uuid());
    }
    tools[currentTool].execute(effectCtx,
      {
        startX:initX,
        startY:initY,
        endX:x,
        endY:y
      }
      ,effectFab);
      //reset from ghost effect
      if(currentTool.ghost){
        effectCtx.globalAlpha=1;
      }
      //freehand finishing
      if(tools[currentTool].freeHand){
        initX=x;
        initY=y;
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
      if(theEl.tool!=="text"){
        var eGrid = getNearestGrid(sGrid.x+(activeObj.width*activeObj.scaleX),sGrid.y+(activeObj.height*activeObj.scaleY));
      }
      else{
        var eGrid = sGrid;
      }
      //console.log(theEl==layers[0]);
      if(theEl.startX<theEl.endX){
        theEl.startX=sGrid.x;
        theEl.endX=eGrid.x;
      }
      else{
        theEl.startX=eGrid.x;
        theEl.endX=sGrid.x;
      }
      if(theEl.startY<theEl.endY){
        theEl.startY=sGrid.y;
        theEl.endY=eGrid.y;
      }
      else{
        theEl.startY=eGrid.y;
        theEl.endY=sGrid.y;
      }
      if(activeObj.angle){
        theEl.angle=activeObj.angle;
      }
      redoList=[];
      versions.push(JSON.stringify(layers));
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
        document.querySelector('.tfvalue').value=theEl.text || "";
      }
      else{
        document.querySelector('.prefeditor').style.display='none';
      }
    });
    function updateText(){
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
      }
    document.querySelector('.textupdatebtn')
      .addEventListener('click',updateText);
    document.querySelector('.tfvalue')
      .addEventListener('keyup',function(e){
        if(e.keyCode===13){
          updateText();
        }
      })
    function checkDelete(e){
      //console.log(e);
      if(e.key){
        if(e.key.toLowerCase()!='delete' && e.keyCode != 46) return false;
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
	  
	  document.querySelector('.downloadelForWood')
      .addEventListener('click',function(){
		  $(this).find('.fa').removeClass('fa-floppy-o');
		  $(this).find('.fa').addClass('fa-refresh fa-spin');
        var tempa = document.querySelector('.downloadholder');
        tempa.href= drawingFab.toDataURL({
          format:'png'
        });
		window.opener.document.getElementById("woodImgItem").src = tempa.href;
		window.close();

		//console.log(tempa.href);
        //tempa.download=appName+".png";
        //tempa.click();
      });
	  
    //Attaching event listeners
	var hdrs= document.querySelector('.holders');
    hdrs.addEventListener('mousedown',mouseDownFunction);
    hdrs.addEventListener('mouseup',mouseUpFunction);
    hdrs.addEventListener('mousemove',mouseMoveFunction);
    hdrs.addEventListener('touchstart',function(e){
      e.preventDefault();
      //e.stopPropagation();
      var br = hdrs.getBoundingClientRect();
      var te = e.changedTouches[0];
      te.offsetX = te.clientX - br.left;
      te.offsetY = te.clientY - br.top;
      return mouseDownFunction(te);
    });
    hdrs.addEventListener('touchmove',function(e){
      e.preventDefault();
      //e.stopPropagation();
      var br = hdrs.getBoundingClientRect();
      var te = e.changedTouches[0];
      te.offsetX = te.clientX - br.left;
      te.offsetY = te.clientY - br.top;
      return mouseMoveFunction(te);
    });
    hdrs.addEventListener('touchend',function(e){
      e.preventDefault();
      //e.stopPropagation();
      var br = hdrs.getBoundingClientRect();
      var te = e.changedTouches[0];
      te.offsetX = te.clientX - br.left;
      te.offsetY = te.clientY - br.top;
      return mouseUpFunction(te);
    });
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
  function uploadMedia(){
	  var file_frame; // variable for the wp.media file_frame
		event.preventDefault();
		// if the file_frame has already been created, just reuse it
		if ( file_frame ) {
			file_frame.open();
			return;
		}

		file_frame = wp.media.frames.file_frame = wp.media({
			title: $( this ).data( 'uploader_title' ),
			button: {
				text: $( this ).data( 'uploader_button_text' ),
			},
			multiple: false // set this to true for multiple file selection
		});

		file_frame.on( 'select', function() {
			attachment = file_frame.state().get('selection').first().toJSON();
			// do something with the file here
			//$( '.frontend-button' ).hide();
			//$( '.imggap' ).attr('src', attachment.url);
			var ress = attachment.url;
			if(ress){
				var get_url = window.location.href;
				var get_url_first = get_url.split('#');
				window.location.href = get_url_first[0]+'#target='+ress;
				window.location.reload(true);
				//location.reload(true);
			}
		});
		file_frame.open();
  }
