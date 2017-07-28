
var btnClicked = "-1";
var $focusedId

function resizeInteraction(thewidth,theheight) {
	var scale = 0;
	thewidth = String(thewidth).replace("px","");
	theheight = String(theheight).replace("px","");

	if(thewidth<320){
		thewidth = 320
	}
	if(theheight<320){
		theheight = 320
	}
	
	/**********************/
	//Modification made for Presenter same logic holds good for Captivate
	//iframe width and Height
	var scaleW = thewidth / (700);
	var scaleH = theheight/ (498);
	
	if(scaleW<scaleH){
		scale = scaleW
	}else{
		scale = scaleH
	}
	
	myWidgetiFrame.style.width = parseInt(parseInt(750*scaleW))+"px"
	myWidgetiFrame.style.height = parseInt(parseInt(550*scaleH))+"px"
	
	var iframewidth = String(myWidgetiFrame.style.width).replace("px","");
	var iframeheight = String(myWidgetiFrame.style.height).replace("px","");
	
	$($(myWidgetiFrame).parent().parent()).css("top",(-19*scaleH))
	$($(myWidgetiFrame).parent().parent()).css("left",(-25*scaleW))
	
	/*********************/
	//Resize fonts
	if(scalefont=="true"){
		//Content font size
		if(contentStylessize>=12){
			if(thewidth>=1024){
				contentStyles.size = contentStylessize;
			}else if(thewidth>= 768){
				var tempNum = Math.round(contentStylessize-2);
				if(tempNum>=12){
					contentStyles.size = tempNum
				}else{
					contentStyles.size = 12
				}
			}else if(thewidth>= 360){
				contentStyles.size = 12
			}else{
				contentStyles.size = 10
			}
			
			var tempcontentStylessize = contentStyles.size*scaleW;
			if(tempcontentStylessize>=12 && tempcontentStylessize<=contentStylessize){
				contentStyles.size = tempcontentStylessize;
			}
			
		}
		
		
		//Button font size
		if(buttonStylessize>=12){
			if(thewidth>=1024){
				buttonStyles.size = buttonStylessize;
			}else if(thewidth>= 768){
				var tempNum = Math.round(buttonStylessize-2);
				if(tempNum>=12){
					buttonStyles.size = tempNum
				}else{
					buttonStyles.size = 12
				}
			}else if(thewidth>= 360){
				buttonStyles.size = 12
			}else{
				buttonStyles.size = 10
			}
			
			var tempbuttonStylessize = buttonStyles.size*scaleW;
			if(tempbuttonStylessize>=12 && tempbuttonStylessize<=buttonStylessize){
				buttonStyles.size = tempbuttonStylessize;
			}
			
		}
		
		
		//Header font size
		if(headerStylessize>=16){
			if(thewidth>=1024){
				headerStyles.size = headerStylessize;
			}else if(thewidth>= 768){
				var tempNum = Math.round(headerStylessize-2);
				if(tempNum>=16){
					headerStyles.size = tempNum
				}else{
					headerStyles.size = 16
				}
			}else if(thewidth>= 360){
				headerStyles.size = 16
			}else{
				headerStyles.size = 14
			}
			
			var tempheaderStylessize = headerStyles.size*scaleW;
			if(tempheaderStylessize>=16 && tempheaderStylessize<=headerStylessize){
				headerStyles.size = tempheaderStylessize;
			}
			
		}
		
		//Instructions font size
		if(instStylessize>=12){
			if(thewidth>=1024){
				instStyles.size = instStylessize;

			}else if(thewidth>= 768){
				var tempNum = Math.round(instStylessize-2);
				if(tempNum>=12){
					instStyles.size = tempNum
				}else{
					instStyles.size = 12
				}
			}else if(thewidth>= 360){
				instStyles.size = 12
			}else{
				instStyles.size = 10
			}
			
			var tempinstStylessize = instStyles.size*scaleW;
			if(tempinstStylessize>=12 && tempinstStylessize<=instStylessize){
				instStyles.size = tempinstStylessize;
			}

		}

		setupStyle("#intTitle", headerStyles)
		setupStyle("#intInstructions", instStyles)
		setupStyle(".tab_content p", contentStyles)
		setupStyle(".popup", buttonStyles)
	}else{
		
		contentStyles.size = contentStylessize;
		buttonStyles.size = buttonStylessize;
		headerStyles.size = headerStylessize;
		instStyles.size = instStylessize;
		
		if(theheight <= 360 || thewidth <= 360){
			contentStyles.size = 10;
			buttonStyles.size = 10;
			headerStyles.size = 14;
			instStyles.size = 10;
		}
		
		setupStyle("#intTitle", headerStyles)
		setupStyle("#intInstructions", instStyles)
		setupStyle(".tab_content p", contentStyles)
		setupStyle(".popup", buttonStyles)
	}
	
	
	//Resize interaction
	var marginsW
	
	var headerActiveSize;
	if (generalStyles.headerActive == 2) {
		headerActiveSize = -20
	}else{
		headerActiveSize = $('#headerColor').height();
		if(headerActiveSize ==0){
			headerActiveSize = 55;
		}
	}
	
	var tempH
	if(iframewidth>=1024){
		marginsW = Math.round((27+scaleW) * scaleW);
	}else if(iframewidth>= 768){
		marginsW = Math.round((25+scaleW) * scaleW);
	}else if(iframewidth>= 360){
		marginsW = Math.round((19+scaleW) * scaleW);
	}else{
		marginsW = Math.round((12+scaleW) * scaleW);
	}
	
	if(iframeheight>=768){
		tempH = 40;
	}else if(iframeheight>= 360){
		tempH = 80;
	}else if(iframeheight>= 320){
		tempH = 120;
	}
	
	var canSize = 30;
	if(thewidth<=360){
		canSize = 65;
	}
	
	var marginsH = Math.round(30 * scaleH);
	
	$('#reveal').css('width',(680*scaleW));
	$('#reveal').css('height',(470*scaleH));
	$('#reveal').css('margin-left', marginsW+"px");
	$('#reveal').css('margin-top', marginsH+"px");
	
	var revealHeight = parseInt(String($('#reveal').css('height').replace("px","")));
	var revealWidth = parseInt(String($('#reveal').css('width').replace("px","")));
	
	var contentBg = document.getElementById("content_bg");
	//contentBg.style.width = ((revealHeight-headerActiveSize)-40)+"px"
	contentBg.style.height = ((revealHeight-headerActiveSize)-((canSize*scaleH)+(tempH*scaleH)))+"px"
	//$("#content_bg").hide();
	
	var contentBgHeight = parseInt(String($('#content_bg').css('height').replace("px","")));
	
	$(".scroll-pane").css('width',"inherit");
	$(".scroll-pane").css('height',contentBgHeight+"px");
	
	//$(".scroll-pane").css('left',(pyramidHolderW)+(20*scale))
	
	$("#canvas-wrap").css('width',revealWidth+"px");
	$("#canvas-wrap").css('height',(50*scaleH)+"px");
	$("#timelinecanvas").css('width',revealWidth+"px");
	$("#timelinecanvas").css('height',(70*scaleH)+"px");
	var timelineNodeSize = (19*scale);
	if(timelineNodeSize<=18){
		timelineNodeSize = 18;
	}
	$(".timelineNode").css('width',timelineNodeSize+"px");
	$(".timelineNode").css('height',timelineNodeSize+"px");
	jQuery.each(textArray, function(index) {
		var tleftPos = parseInt(buttonXArray[index] - 45)*scaleW
		$("#"+index).css('left',tleftPos)
		
		$("#pop"+index).css('left',(tleftPos-60))
	});
	var ht = parseInt(String($("#canvas-wrap").css('height').replace("px","")));
	var tHt =  (ht/2)-(timelineNodeSize+(8));
	$(".timelineNode").css('top',tHt);
	
	var tempTop = $("#canvas-wrap").css('top');
	$("#popups").css('top',(contentBgHeight)+(80));

	var maxScaleInt = 200*scaleW
	if(maxScaleInt>=200){
		maxScaleInt = 200
	}else if(maxScaleInt<=120){
		maxScaleInt = 120
	}
	$(".popup").css('width',maxScaleInt);
	$(".popup").css('height',40*scaleH);
	
	$(myWidgetiFrame).show();
}


function addClickHandlers() {
	
	$("#reveal").fadeIn();
	 $(".timelineNode").click(function (e) {
		//$("#tabs li").removeClass('active');
		//remove old values
		
		//alert(btnClicked);
		
		$(".timelineNode").removeClass("active");
		$(".timelineNode").addClass("unactive");

		$(this).removeClass("unactive");
		$(this).addClass("active");
		$(".tab_content").hide(); //hide all
		btnClicked = e.target.id;
		var selected_tab = $(".tab_content").eq(btnClicked); //$(this).find("tab"+btnClicked);//.attr("href");
		$(selected_tab).fadeIn(function() {
			pauseSound();
			if (soundArray[btnClicked] != "-1") {
				setTimeout("play_sound(soundArray[btnClicked])",50);
			}
		  });
		
		recolorBtns();
	
		return false;
	});
	$(document).keyup(function(e){
	  var keyCode = e.keyCode || e.which; 
	  if (keyCode == 9) { 
		var $focused = $(':focus');
		$focusedId=$($focused)[0].id
		if($focused.hasClass("timelineNode")){
			$(".tab_content").hide();
			$(".timelineNode").removeClass("active");
			$(".timelineNode").addClass("unactive");
			$(".popup").css("display", "none");
			$("#pop"+$focusedId).fadeIn()
			$("#"+$focusedId).removeClass("unactive");
			$("#"+$focusedId).addClass("active");
			recolorBtns();
			//document.getElementById($focused.id).focus()
		}
		// call custom function here
	  } 
	  return false;
	});
	
	$(document).keydown(function(e){	
		var keyCode = e.keyCode || e.which; 
		  if (keyCode == 9) { 
			$(".popup").css("display", "none");
			// call custom function here
			if($focusedId=="tab"+parseInt(textArray.length-1)){
				$(".tab_content").hide();
				$(".timelineNode").removeClass("active");
				$(".timelineNode").addClass("unactive");
				recolorBtns();
			}
		  } 
		if(e.keyCode  == 13 || e.keyCode  == 32) {
			//$("#tabs li").removeClass('active');
			//remove old values
			
			//alert(btnClicked);
			$(".popup").css("display", "none");
			
			$(".timelineNode").removeClass("active");
			$(".timelineNode").addClass("unactive");
			
			$(this).removeClass("unactive");
			$(this).addClass("active");
			$(".tab_content").hide(); //hide all
			btnClicked = e.target.id;
			var selected_tab = $(".tab_content").eq(btnClicked); //$(this).find("tab"+btnClicked);//.attr("href");
			$(selected_tab).fadeIn(function() {
				try{
					pauseSound();
					if (soundArray[btnClicked] != "-1") {
						setTimeout("play_sound(soundArray[btnClicked])",50);
					}
				}catch(err){
				}
			  });
			$("#"+$focusedId).removeClass("unactive");
			$("#"+$focusedId).addClass("active");
			recolorBtns();
		
			return false;
		}
	});
	
	 $(".timelineNode").hover(function () { timelineHoverIn(this); }, function () { timelineHoverOut(this); });
}

function recolorBtns() {
	$('.unactive').css('background-color', generalStyles.btnColorUp);
	$('.active').css('background-color', generalStyles.btnColorDown);
}


function timelineHoverIn(timelineNodeContainer) {
	$(".popup").css("display", "none");
    $("#pop"+timelineNodeContainer.id).fadeIn();//css("display", "show");
}

function timelineHoverOut(timelineNodeContainer) {
    $("#pop"+timelineNodeContainer.id).css("display", "none");
}



//sound values
/*var theSnd = null;

function pauseSound() {
	if(theSnd != null) // && theSnd.src != wavePath)
	{ theSnd.pause();}
}

function play_sound(url){
	theSnd = new Audio(url);
	theSnd.load();
	theSnd.play();	
}*/

//Modifying the sound function - Audio load and play is now handled by captivate: IF it does not handle the audio revert to old code.
//This fix was mainly  implemented for IPAD.
var isiPad = navigator.userAgent.match(/iPad/i) != null;
var theSnd = null;
var theSndURL = null;

function pauseSound() {
	if(isiPad){
		if(!this.handle)
		return;
		
		if(!this.handle.stopWidgetAudio(theSndURL)){
			if(theSnd != null){ 
				theSnd.pause();
			}
		}else{
			this.handle.stopWidgetAudio(theSndURL)
		}
	} else {
		if(!this.handle.stopWidgetAudio(theSndURL)){
			if(theSnd != null){ 
				theSnd.pause();
			}
		}else{
			this.handle.stopWidgetAudio(theSndURL)
		}
	}
}

function play_sound(url){
	if(isiPad){
		if(!this.handle)
		return;
		
		theSndURL = url;
		if(!this.handle.playWidgetAudio(url)){	
			theSnd = new Audio(url);
			theSnd.load();
			theSnd.play();
		}else{
			this.handle.playWidgetAudio(url)
		}
	}else{
		theSndURL = url;
		if(!this.handle.playWidgetAudio(url)){	
			theSnd = new Audio(url);
			theSnd.load();
			theSnd.play();
		}else{
			this.handle.playWidgetAudio(url)
		}
	}
}
////////////////////////////////////////////////////////



function setupCustomStyles() {
	generalStyles.headerColor = formatColor(generalStyles.headerColor); //generalStyles.headerColor.substring(2);
	generalStyles.contentBodyColor = formatColor(generalStyles.contentBodyColor); //"#" + generalStyles.contentBodyColor.substring(2);
	generalStyles.bodyColor = formatColor(generalStyles.bodyColor); //"#" + generalStyles.bodyColor.substring(2);
	generalStyles.arrowColor = formatColor(generalStyles.arrowColor);
	generalStyles.lineColor = formatColor(generalStyles.lineColor);
	
	generalStyles.btnColorUp = formatColor(generalStyles.btnColorUp);
	generalStyles.btnColorOver = formatColor(generalStyles.btnColorOver);
	generalStyles.btnColorDown = formatColor(generalStyles.btnColorDown);
	//generalStyles.lineColor = formatColor(generalStyles.lineColor);	

	//alert(generalStyles.lineColor);
		if (currentTheme != 3 && currentTheme != 11 && currentTheme != 16) {
			$('#headerColor').css('background-color', generalStyles.headerColor)//generalStyles.headerColor);
		} else {
			$('#headerColor').css('background-color', generalStyles.bodyColor)//generalStyles.headerColor);
			
		}
		
		//$('#headerColor').css('background-image', 'none');
	$('#tabs_content_container').css('background-color', generalStyles.contentBodyColor);
	$('#content_bg').css('background-color', generalStyles.bodyColor);
	$('#reveal').css('background-color', generalStyles.bodyColor);
	$('.popup').css('background-color', generalStyles.btnColorOver);
	
	$('.timelineNode').css('background-color', generalStyles.btnColorUp);
	recolorBtns()
	
	

	if (generalStyles.headerActive == 2) {
		$('#headerColor').css('display', 'none');
		$('.popup').css('top', -90);
		
	}
	//alert(generalStyles.btnColorDown);
	//$('.timelineNode:hover').css('background-color', generalStyles.btnColorOver);
	//$('div.active').css('background-color', generalStyles.btnColorOver);
	
}



	

		
		
function drawArrow(widt,heit) {

	var canvas = document.getElementById('timelinecanvas');
	var ctx = canvas.getContext('2d');
	var ctxLine = canvas.getContext('2d');
	
	var arrowWidth = widt;
	var arrowHeight = heit;
	var arrowX = 0;
	var arrowY = 0;
	var lineY = 25;
	
	
  
  
	if (currentTheme ==2 || currentTheme == 13) {
		themestyle = 2
	} else if (currentTheme == 3 || currentTheme == 7 || currentTheme == 15) {
		themestyle = 3;
	} else {
		themestyle = 1
	}
	

	
	/*lines
	context.fillStyle   = '#00f'; // blue
context.strokeStyle = '#f00'; // red
context.lineWidth   = 4;

*/


	//draw entire arrow
	ctx.beginPath(); 
	
	 switch(themestyle){
	  case 1: //straight
			ctx.moveTo(arrowX,arrowY);  
			ctx.lineTo(arrowX+arrowWidth,arrowY); 
			ctx.lineTo(arrowX+arrowWidth+20,arrowY+25);  
			ctx.lineTo(arrowX+arrowWidth,arrowY+arrowHeight); 
			ctx.lineTo(arrowX,arrowY+arrowHeight);  
			ctx.lineTo(arrowX+20,arrowY+25);  
			ctx.lineTo(arrowX,arrowY);  
			ctx.fillStyle = generalStyles.arrowColor
			ctx.fill();
	
	/*
			ctx.moveTo(arrowX-5,arrowY);  
			ctx.lineTo(arrowX+arrowWidth,arrowY); 
			ctx.lineTo(arrowX+arrowWidth+25,arrowY+25);  
			ctx.lineTo(arrowX+arrowWidth,arrowY+arrowHeight); 
			ctx.lineTo(arrowX-5,arrowY+arrowHeight);  
			ctx.lineTo(arrowX+15,arrowY+25);  
			ctx.lineTo(arrowX-5,arrowY); 
			ctx.fillStyle = generalStyles.arrowColor
			ctx.fill();
			*/
	  break;
	  case 2: //line
	  break;
	  case 3: //wrap
			ctx.moveTo(arrowX,arrowY+10);  
			ctx.lineTo(arrowX+arrowWidth,arrowY+10); 
				//tip
			ctx.lineTo(arrowX+arrowWidth+20,arrowY+25+10);  
			ctx.lineTo(arrowX+arrowWidth,arrowY+arrowHeight+10); 
			ctx.lineTo(arrowX,arrowY+arrowHeight+10);  
			//ctx.lineTo(arrowX+25,arrowY+25);  
			ctx.lineTo(arrowX,arrowY+10);
			ctx.lineTo(arrowX+20,arrowY);
			ctx.lineTo(arrowX+20,arrowY+10);
			ctx.fillStyle = generalStyles.arrowColor
			ctx.fill();
			
			arrowY +=10;
			
			lineY+=10;
	  break;
  }
  
   if (themestyle == 2) {
		ctxLine.beginPath();  
  	ctxLine.globalAlpha   = 1;
	ctxLine.fillStyle="#ffffff";
	ctxLine.fillRect(arrowX+arrowWidth/15-35,arrowY+arrowHeight/2,520+65,2);
	ctxLine.fill(); 

  } else {
	
	//(x1,y1,x2,y2)
  var lingrad = ctx.createLinearGradient(0,arrowY,0,arrowY+arrowHeight);
  lingrad.addColorStop(0, '#111111');
  lingrad.addColorStop(0.1, '#ffffff');
  lingrad.addColorStop(0.5, '#111111');
  lingrad.addColorStop(1, '#111111');
  ctx.fillStyle = lingrad;
  ctx.globalAlpha   = .1;
  ctx.fill();
  
  
  //lines styles
  //ctx.lineJoin = 'bevel'//','miter']; 
  //ctx.lineWidth = 10;
	/*ctx.moveTo(arrowX,arrowY);  
	ctx.lineTo(arrowX+arrowWidth,arrowY); 
	ctx.lineTo(arrowX+arrowWidth+20,arrowY+25);  
	ctx.lineTo(arrowX+arrowWidth,arrowY+arrowHeight); 
	ctx.lineTo(arrowX,arrowY+arrowHeight);  
	ctx.lineTo(arrowX+20,arrowY+25);  
	ctx.lineTo(arrowX,arrowY);  
	ctx.fill();*/

	//draw line
	ctxLine.beginPath();  
//	ctxLine.strokeStyle = "#006892";
	
  	ctxLine.globalAlpha   = 1;
	ctxLine.fillStyle=generalStyles.lineColor
	ctxLine.fillRect(30,lineY,560,2);
	ctxLine.fill();

  }
}
