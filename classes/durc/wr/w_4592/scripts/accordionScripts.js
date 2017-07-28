var btnClicked = "-1";

function resizeInteraction(thewidth,theheight) {
	var scale = 0;
	thewidth = String(thewidth).replace("px","");
	theheight = String(theheight).replace("px","");
	if(thewidth<320){
		thewidth = 320
	}
	if(theheight<350){
		theheight = 350
	}
	
	/**********************/
	//Modification made for Presenter same logic holds good for Captivate
	//iframe width and Height
	var scaleW = thewidth / (700);
	var scaleH = theheight/ (498);
	
	myWidgetiFrame.style.width = parseInt(parseInt(750*scaleW))+"px"
	myWidgetiFrame.style.height = parseInt(parseInt(550*scaleH))+"px"
	
	
	var iframewidth = String(myWidgetiFrame.style.width).replace("px","");
	var iframeheight = String(myWidgetiFrame.style.height).replace("px","");
	
	$($(myWidgetiFrame).parent().parent()).css("top",(-19*scaleH))
	$($(myWidgetiFrame).parent().parent()).css("left",(-25*scaleW))

	if(scaleW<scaleH){
		scale = scaleW
	}else{
		scale = scaleH
	}
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
		setupStyle(".content", contentStyles)
		setupStyle(".header a", buttonStyles)
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
		
		setupStyle("#intTitle", headerStyles);
		setupStyle("#intInstructions", instStyles);
		setupStyle(".content", contentStyles);
		setupStyle(".header a", buttonStyles);
	}
	
	//Resize interaction
	var totContentPadding =  20;
	if(thewidth>=1024){
		totContentPadding = 20;
	}else if(thewidth>= 768){
		totContentPadding = 20
	}else{
		totContentPadding = 50
	}
	
	var marginsW = Math.round(34 * scaleW);
	var marginsH = Math.round(30 * scaleH);
	var headerActiveSize;
	if (generalStyles.headerActive == 2) {
		headerActiveSize = 56
	}else{
		headerActiveSize = 0;
	}
	
	//console.log(headerActiveSize,"headerActiveSize")
	
	$('#reveal').css('width',(680*scaleW));
	$('#reveal').css('height',(470*scaleH));
	$('#content_bg').css('height',(305*scaleH));
	
	$('#reveal').css('margin-left', marginsW+"px");
	$('#reveal').css('margin-right', marginsW+"px");
	$('#reveal').css('margin-top', marginsH+"px");

	
	var contentDisheight = $('#content_bg').height();
	var optionsHeaderHeight = 0
	
	for(i=0;i<textArray.length;i++){
		optionsHeaderHeight = optionsHeaderHeight+$("#btnHeader"+i).innerHeight();
	}
	
	var setContentHeight = ((contentDisheight- totContentPadding) - optionsHeaderHeight)+(headerActiveSize*scaleH)
	if(setContentHeight<=10){
		setContentHeight = 10;
	}
	
	
	$('.scroll-pane').css('height',(setContentHeight));
	for(i=0;i<textArray.length;i++){
		$('#btnHeader'+i).children(this).text(textArray[i])
	}
	resizerCounter=0
	setOptionsHeight();
}


function addClickHandlers() {
	
	$("#reveal").fadeIn();		
	$('#content_bg .header a').mouseleave(function() {
  		var main = $(this).parent().hasClass('activeBtn')
		if (!main) {
			outState(this);
		}
	});
	
	$('#content_bg .header a').keydown(function() {
  		var main = $(this).parent().hasClass('activeBtn')
		if (!main) {
			outState(this);
		}
	});
	
		$('#content_bg .header a').mouseenter(function() {
			 var main = $(this).parent().hasClass('activeBtn')
			if (!main) {
				overState(this);
			}
	});
	
		$('#content_bg .header a').keyup(function() {
			 var main = $(this).parent().hasClass('activeBtn')
			if (!main) {
				overState(this);
			}
	});
										  
	$('#content_bg .header a').click(function(e){	
		pauseSound();
	//Calculate by how much the container should be set
		if (btnClicked != e.target.id) //make sure that nothing happens if the same button is clicked
		{
			//console.log("this",this)
			var dad = $(this).parent(); //grab parent
			
			if (btnClicked != "-1") { //make sure it's not the first click 
				var grabMe = btnClicked*2 + 1;
				$('#content_bg div').eq(grabMe).slideUp('slow'); //slide the content div
				$('#content_bg div').eq(grabMe-1).removeClass('overBtn'); //remove class from header div
				$('#content_bg div').eq(grabMe-1).removeClass('activeBtn'); //remove class from header div
				$('#content_bg div').eq(grabMe-1).addClass('unactive'); //add the unactive state to the btn						
			}
			//now move up the other 
			btnClicked = e.target.id;
			
			$(dad).removeClass('unactive'); //remove class from header div
			$(dad).removeClass('overBtn'); //remove class from header div
			$(dad).addClass('activeBtn');
			$('#btnHeader'+e.target.id).children(this).text(textArray[e.target.id])
			
			//console.log($(this).addClass('active').parent('div').next('.content'))
			$(this).addClass('active').parent('div').next('.content').slideDown('slow', function() {
				//after animation is complete, run setup and play audio
				//Added this for IE 9 and IE 11 scroll issues.
				$(this).css('overflow',"auto");	
				pauseSound();
				if (soundArray[btnClicked] != "-1") {
					setTimeout("play_sound(soundArray[btnClicked])",50);
				}
			  });
		}else{
			var grabMe = btnClicked*2 + 1;
			$('#content_bg div').eq(grabMe).slideUp('slow');
			$('#content_bg div').eq(grabMe).slideUp('slow'); //slide the content div
			$('#content_bg div').eq(grabMe-1).removeClass('overBtn'); //remove class from header div
			$('#content_bg div').eq(grabMe-1).removeClass('activeBtn'); //remove class from header div
			$('#content_bg div').eq(grabMe-1).addClass('unactive'); //add the unactive state to the btn	
			btnClicked =-1;
			resizerCounter=0
			setOptionsHeight()
		}
		
		$('.unactive a').css('color', buttonStyles.color);
		$('.unactive').css('background-color', generalStyles.btnColorUp);
		$('.activeBtn').css('background-color', generalStyles.btnColorDown);
		$('.activeBtn a').css('color', buttonStyles.textDown);
		resizerCounter=0
		setOptionsHeight()

	});
	
	$(document).keydown(function(e){	
	//console.log("key press",btnClicked,e.target.firstChild,e.keyCode)
		if(e.keyCode  == 13 || e.keyCode  == 32) {
		//if(e.target.id != "")
		if (btnClicked != e.target.firstChild.id && isNaN(e.target.id)) //make sure that nothing happens if the same button is clicked
		{
			
				var dad = $(e.target.firstChild).parent(); //grab parent
				if (btnClicked != "-1") { //make sure it's not the first click 
				var grabMe = btnClicked*2 + 1;
				$('#content_bg div').eq(grabMe).slideUp('slow'); //slide the content div
				$('#content_bg div').eq(grabMe-1).removeClass('overBtn'); //remove class from header div

				$('#content_bg div').eq(grabMe-1).removeClass('activeBtn'); //remove class from header div
				$('#content_bg div').eq(grabMe-1).addClass('unactive'); //add the unactive state to the btn						
			}
			//now move up the other 
			btnClicked = e.target.firstChild.id;
			
			//console.log(btnClicked,"btnClicked")
			$(dad).removeClass('unactive'); //remove class from header div
			$(dad).removeClass('overBtn'); //remove class from header div
			$(dad).addClass('activeBtn');
			$(e.target.firstChild).addClass('active').parent('div').next('.content').slideDown('slow', function() {
				//after animation is complete, run setup and play audio
				pauseSound();
				if (soundArray[btnClicked] != "-1") {
					setTimeout("play_sound(soundArray[btnClicked])",50);
				}
			  });
		}else{
			if(isNaN(e.target.id)){
				var grabMe = btnClicked*2 + 1;
				$('#content_bg div').eq(grabMe).slideUp('slow');
				$('#content_bg div').eq(grabMe).slideUp('slow'); //slide the content div
				$('#content_bg div').eq(grabMe-1).removeClass('overBtn'); //remove class from header div
				$('#content_bg div').eq(grabMe-1).removeClass('activeBtn'); //remove class from header div
				$('#content_bg div').eq(grabMe-1).addClass('unactive'); //add the unactive state to the btn	
				btnClicked =-1;
				resizerCounter=0
				setOptionsHeight()
			}
		}
		
		$('.unactive a').css('color', buttonStyles.color);
		$('.unactive').css('background-color', generalStyles.btnColorUp);
		$('.activeBtn').css('background-color', generalStyles.btnColorDown);
		$('.activeBtn a').css('color', buttonStyles.textDown);
	}
	
		});
}
function overState(obj) {
	var dad = $(obj).parent();
	$(dad).addClass('overBtn');
	$('.overBtn').css('background-color', generalStyles.btnColorOver);
	$('.overBtn a').css('color', buttonStyles.textOver);
	
}

function outState(obj2) {
	//alert("out");
	var dad = $(obj2).parent();
	$(dad).removeClass('overBtn');
	$(dad).addClass('unactive');
	$('.unactive').css('background-color', generalStyles.btnColorUp);
	$('.unactive a').css('color', buttonStyles.color);
	
}


function html5_audio(){
	var a = document.createElement('audio');
	return !!(a.canPlayType && a.canPlayType('audio/mpeg;').replace(/no/, ''));
}
 
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

function setupCustomStyles() {
	generalStyles.headerColor = formatColor(generalStyles.headerColor); //generalStyles.headerColor.substring(2);
	generalStyles.contentBodyColor = formatColor(generalStyles.contentBodyColor); //"#" + generalStyles.contentBodyColor.substring(2);
	generalStyles.bodyColor = formatColor(generalStyles.bodyColor); //"#" + generalStyles.bodyColor.substring(2);
	//generalStyles.arrowColor = formatColor(generalStyles.arrowColor);
	generalStyles.btnColorUp = formatColor(generalStyles.btnColorUp);
	generalStyles.btnColorOver = formatColor(generalStyles.btnColorOver);
	generalStyles.btnColorDown = formatColor(generalStyles.btnColorDown);
	//generalStyles.lineColor = formatColor(generalStyles.lineColor);	
	buttonStyles.color  = formatColor(buttonStyles.color);
	buttonStyles.textOver = formatColor(buttonStyles.textOver);
	buttonStyles.textDown = formatColor(buttonStyles.textDown);
		
	//alert(generalStyles.lineColor);
		if (currentTheme != 3 && currentTheme != 11 && currentTheme != 16) {
			$('#headerColor').css('background-color', generalStyles.headerColor)//generalStyles.headerColor);
		} else {
			$('#headerColor').css('background-color', generalStyles.bodyColor)//generalStyles.headerColor);
			
		}
		//alert(buttonStyles.color);
	//$('#headerColor').css('background-image', 'none');
	$('div.content').css('background-color', generalStyles.contentBodyColor);
	$('#content_bg').css('background-color', generalStyles.bodyColor);
	
	$('#reveal').css('background-color', generalStyles.bodyColor);
	$('.header').css('background-color', generalStyles.btnColorUp);
	
	$('.header a').css('color', buttonStyles.color);
	if (generalStyles.headerActive == 2) {
		$('#headerColor').css('display', 'none');
	}
	
}