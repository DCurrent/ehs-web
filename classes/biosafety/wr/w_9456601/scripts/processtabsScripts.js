var btnClicked = "-1";
					 
function resizeInteraction(thewidth,theheight) {
	var scale = 0;
	thewidth = String(thewidth).replace("px","");
	theheight = String(theheight).replace("px","");
	if(thewidth<theheight){
	 scale = thewidth / (680+70);
	}else{
	 scale = theheight/ (500);
	}
	
	var margins = Math.round(25 * scale);
	margins+="px"
	scale = "scale(" + scale + ")";
	$('#reveal').css('-webkit-transform', scale);
	$('#reveal').css('-moz-transform', scale);
	$('#reveal').css('-o-transform', scale);
	$('#reveal').css('-ms-transform', scale);
	
	$('#reveal').css('-moz-transform-origin', '0 0');
	$('#reveal').css('-webkit-transform-origin', '0 0');
	$('#reveal').css('-moz-transform-origin', '0 0');
	$('#reveal').css('-o-transform-origin', '0 0');
	$('#reveal').css('-ms-transform-origin', '0 0');
	

	$('#reveal').css('margin-top', margins);
	$('#reveal').css('margin-left', margins);
	
}

function addClickHandlers() {
	$("#reveal").fadeIn();
		$("#tabs li").mouseleave(function() {
  		var main = $(this).parent().hasClass('activeBtn')
		if (!main) {
			outState(this);
		}
	});
	
	$("#tabs li").mouseenter(function() {
			 var main = $(this).parent().hasClass('activeBtn')
			if (!main) {
				overState(this);
			}
	});
		
	 $("#tabs li").click(function (e) {
		$("#tabs li a").removeClass('activeBtn');
		$("#tabs li a").addClass('unactive');
		$(this).find("a").removeClass('unactive');
		$(this).find("a").addClass("activeBtn");
		$(".tab_content").hide();
		var selected_tab = "#tab" + $(this).find("a").attr("id");
		
		btnClicked = e.target.id;
		$(selected_tab).fadeIn(function() {
			pauseSound();
			if (soundArray[btnClicked] != "-1") {
				setTimeout("play_sound(soundArray[btnClicked])",50);
			}
		 });
		
		$('.unactive').css('color', buttonStyles.color);
		$('.unactive').css('background-color', generalStyles.btnColorUp);
		$('.activeBtn').css('background-color', generalStyles.btnColorDown);//generalStyles.btnColorDown);
		$('.activeBtn').css('color', buttonStyles.textDown);//generalStyles.btnColorDown);
		});
		
	$("#tabs li").keydown(function (e) {
		if(e.keyCode  == 13 || e.keyCode  == 32) {
			$("#tabs li a").removeClass('activeBtn');
			$("#tabs li a").addClass('unactive');
			$(this).find("a").removeClass('unactive');
			$(this).find("a").addClass("activeBtn");
			$(".tab_content").hide();
			var selected_tab = "#tab" + $(this).find("a").attr("id");
			
			btnClicked = e.target.id;
			$(selected_tab).fadeIn(function() {
				pauseSound();
				if (soundArray[btnClicked] != "-1") {
					setTimeout("play_sound(soundArray[btnClicked])",50);
				}
			 });
			
			$('.unactive').css('color', buttonStyles.color);
			$('.unactive').css('background-color', generalStyles.btnColorUp);
			$('.activeBtn').css('background-color', generalStyles.btnColorDown);//generalStyles.btnColorDown);
			$('.activeBtn').css('color', buttonStyles.textDown);//generalStyles.btnColorDown);
		}
		});
}

			
function overState(obj) {
	$(this).find("a").addClass('overBtn');
	
	$('.overBtn').css('background-color', generalStyles.btnColorOver);
	$('.overBtn').css('color', buttonStyles.textOver);
	
}

function outState(obj2) {
	//alert("out");
	var dad = $(obj2).parent();
	
	$(this).find("a").addClass('unactive');
	$(this).find("a").removeClass('overBtn');
	$('.unactive').css('background-color', generalStyles.btnColorUp);
	$('.unactive').css('color', buttonStyles.color);
	
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
		if(theSnd != null) // && theSnd.src != wavePath)
		{ theSnd.pause();}
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
		theSnd = new Audio(url);
		theSnd.load();
		theSnd.play();	
	}
}

function adjustTabs(amount,amountTwo){
	$('#tabs li a').css('padding-top',amount+'px');
	$('#tabs li a').css('padding-bottom',amount+'px');
	$('#tabs li a').css('margin-top',amountTwo+'px');
}

function adjustOtherThemes(tabCount){
	switch(tabCount){
		case 2:
			adjustTabs(33,14);
		break;
		case 3:
			adjustTabs(16,13);
		break;
		case 4:
			adjustTabs(12,6);
		break;
		case 5:
			adjustTabs(7,5);
		break;
	}
}

function adjustThemes(tabCount){
	switch(tabCount){
		case 2:
			adjustTabs(35,16);
		break;
		case 3:
			adjustTabs(20,10);
		break;
		case 4:
			adjustTabs(14,5);
		break;
		case 5:
			adjustTabs(9,4);
		break;
	}
}

////////////////////////////////////////////////////////

function moveNav() { 
	$('#tabs_container').css('position', 'absolute');
	$('#tabs_container').css('top', '350px');

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
			
		}//$('#headerColor').css('background-image', 'none');
	$('#tabs_content_container').css('background-color', generalStyles.contentBodyColor);
	$('#content_bg').css('background-color', generalStyles.bodyColor);
	
	$('#reveal').css('background-color', generalStyles.bodyColor);
	
	$('.title').css('background-color', generalStyles.btnColorUp);
	$('.title').css('cursor', 'pointer');
	
	
	
	//$('.title').css('color', 'blue');//buttonStyles.color);
	
		/*$('.unactive').css('color', buttonStyles.color);
		$('.unactive').css('background-color', generalStyles.btnColorUp);*/
		
	
	if (currentTheme == 3 || currentTheme == 4 || currentTheme == 8 || currentTheme == 9 || currentTheme == 10 || currentTheme == 16) {
		$('.scroll-pane').css('width', '385px'); 
		
	}

	if (generalStyles.headerActive == 2) {
		$('#headerColor').css('display', 'none');
	}


	//alert(generalStyles.btnColorDown);
	//$('div.timelineNode').css('background-color', generalStyles.btnColorOver);
	//$('.timelineNode:hover').css('background-color', generalStyles.btnColorOver);
	//$('div.active').css('background-color', generalStyles.btnColorOver);
	
	//#headerColor { 
	//background-color:#069;
	//generalStyles.headerActive = theTextProps.children('general').attr("headerActive");
		//generalStyles.arrowColor = theTextProps.children('general').attr("arrowColor");
		//generalStyles.headerColor = theTextProps.children('general').attr("headerColor");
		//generalStyles.contentBodyColor = theTextProps.children('general').attr("contentBodyColor");
		//generalStyles.bodyColor = theTextProps.children('general').attr("bodyColor");
		//generalStyles.btnColorUp = theTextProps.children('general').attr("btnColorUp");
		//generalStyles.btnColorOver = theTextProps.children('general').attr("btnColorOver");
		//generalStyles.btnColorDown = theTextProps.children('general').attr("btnColorDown");
}


	