
var textArray = [];
var buttonArray = [];
var imageIDArray = [];
var soundIDArray = [];
var imageArray = [];
var soundArray = [];
var picAlignArray=[];
var color;
var face;
var style;
var size;
var align;
var contentStyles = new Object();
var buttonStyles = new Object();
var headerStyles = new Object();
var instStyles = new Object();
var generalStyles = new Object();
var width
var height
var handle

processtabsUse1 = {
	onLoad: function()
	{
		if ( ! this.captivate )
			return;
		
				handle = this.captivate.CPMovieHandle;
		if(handle.isWidgetVisible() == true)
		{
		this.movieProps = this.captivate.CPMovieHandle.getMovieProps();
		if ( ! this.movieProps )
			return;
		this.varHandle = this.movieProps.variablesHandle;
		this.eventDisp = this.movieProps.eventDispatcher;
		this.xmlStr = this.captivate.CPMovieHandle.widgetParams();
		var size = this.OpenAjax.getSize();
		width = size.width;
		height = size.height;
		this.internalImage = '';
		this.externalImage = '';
		this.instructions = '';
		this.buttonLabel = '';
		this.buttonContent = '';
		this.soundName = '';
		this.title = '';
		this.directions = '';
		this.currentTheme
		this.updateData();
		this.doUpdate();                               
		/*if (this.captivate.CPMovieHandle.pauseMovie ) {
			setTimeout("parent.cp.movie.pause(parent.cp.ReasonForPause.INTERACTIVE_ITEM)",100);
		}*/
		}
	},

	updateData: function()
	{
		var id = 0;
		var initresult = jQuery.parseXML( this.xmlStr );
		var initresultDoc = jQuery( initresult );
		var thexml = initresultDoc.find( 'string' ).text();  
		
		var result = jQuery.parseXML( thexml );
		var resultDoc = jQuery( result );
		//alert(jQuery.isXMLDoc(resultDoc));
		
		var theButtons = resultDoc.find( 'buttons' ); 
		var theTextProps = resultDoc.find( 'textProperties' );
		var theContentProps = resultDoc.find( 'buttonContent' );
		var theButtonProps = resultDoc.find( 'buttonLabel' );
		var theHeaderProps = resultDoc.find( 'headerTitle' );
		var theInstProps = resultDoc.find( 'headerInst' );
		currentTheme = theTextProps.children('general').attr("themeNum");
		
		
		//setup styles
		contentStyles.color = theContentProps.children('color').attr("textColor");
		contentStyles.face = theContentProps.children('font').attr("face");
		contentStyles.italic = theContentProps.children('textDecoration').attr("italic");
		contentStyles.bold = theContentProps.children('textDecoration').attr("bold");
		contentStyles.size = theContentProps.children('font').attr("size");
		contentStyles.align = theContentProps.children('font').attr("align");
		
		buttonStyles.color = theButtonProps.children('color').attr("textColor");
		buttonStyles.textOver = theButtonProps.children('color').attr("textOver");
		buttonStyles.textDown = theButtonProps.children('color').attr("textDown");
		
		buttonStyles.face = theButtonProps.children('font').attr("face");
		buttonStyles.italic = theButtonProps.children('textDecoration').attr("italic");
		buttonStyles.bold = theButtonProps.children('textDecoration').attr("bold");
		buttonStyles.size = theButtonProps.children('font').attr("size");
		buttonStyles.align = theButtonProps.children('font').attr("align");		
		
		headerStyles.color = theHeaderProps.children('color').attr("textColor");
		headerStyles.face = theHeaderProps.children('font').attr("face");
		headerStyles.italic = theHeaderProps.children('textDecoration').attr("italic");
		headerStyles.bold = theHeaderProps.children('textDecoration').attr("bold");
		headerStyles.size = theHeaderProps.children('font').attr("size");
		headerStyles.align = theHeaderProps.children('font').attr("align");		
		
		instStyles.color = theInstProps.children('color').attr("textColor");
		instStyles.face = theInstProps.children('font').attr("face");
		instStyles.italic = theInstProps.children('textDecoration').attr("italic");
		instStyles.bold = theInstProps.children('textDecoration').attr("bold");
		instStyles.size = theInstProps.children('font').attr("size");
		instStyles.align = theInstProps.children('font').attr("align");				

		generalStyles.headerActive = theTextProps.children('general').attr("headerActive");
		//generalStyles.arrowColor = theTextProps.children('general').attr("arrowColor");
		//generalStyles.lineColor = theTextProps.children('general').attr("lineColor");
		generalStyles.headerColor = theTextProps.children('general').attr("headerColor");
		generalStyles.contentBodyColor = theTextProps.children('general').attr("contentBodyColor");
		generalStyles.bodyColor = theTextProps.children('general').attr("bodyColor");
		generalStyles.btnColorUp = theTextProps.children('general').attr("btnColorUp");
		generalStyles.btnColorOver = theTextProps.children('general').attr("btnColorOver");
		generalStyles.btnColorDown = theTextProps.children('general').attr("btnColorDown");
		
		
		//DIYeLearning&gt;&lt;textProperties&gt;&lt;general themeNum=&quot;1&q
		
		//loop through each button node
		theButtons.children('button').each(function(index) {
			textArray.push( cleanIt(jQuery( this ).children('text').text()) );	
			buttonArray.push( cleanIt(jQuery( this ).children('buttonContent').text()) );	
			imageIDArray.push(jQuery( this ).children('image').attr("id"));	//grab image id
			soundIDArray.push(jQuery( this ).children('sound').attr("id"));	//grab sound id		
			picAlignArray.push(jQuery( this ).children('buttonContent').attr("picAlign"));			
		});
		
		//access other items on the stage
		this.title = resultDoc.find( 'general' ).attr("titleText");
		this.instructions = resultDoc.find( 'general' ).attr("instructionsText");
		
		///access audio and images
		
		for (num=0; num < imageIDArray.length; num++) {
			//first check images
			id = parseInt( imageIDArray[num] );	
			if (id != -1) { 
				imageArray[num] = this.movieProps.ExternalResourceLoader.getResourcePath( id )
				imageArray[num] = imageArray[num].replace("index.html", "");
			} else {
				imageArray[num] = -1;
			}
			//then check sound
			id = parseInt( soundIDArray[num] );	
			if (id != -1) { 
				soundArray[num] = this.movieProps.ExternalResourceLoader.getResourcePath( id )
		   		soundArray[num] = soundArray[num].replace("index.html", "");
			} else {
				soundArray[num] = -1;
			}
			
		}
	},
	
	doUpdate: function() 
	{
		//init the default html values
		//var divHtmlHeader = "<div class='header'><a>aaaa this button to see the response in the drop down box.</a></div>";
		//var divHtmlContent = "<div class='content'>aaaa job! That was easy, wasn't it?</div>";
		
		var tabHtmlHeader = "<li style='width: percent;'><a href='#placeholder'>Button Label JQuery</a></li>";
		var tabHtmlContent = "<div id='placeholder' class='tab_content' style='display: block;'><p>Testing JQuery</p></div>";



		//init the other elements on the page		
		var elem = document.getElementById('intTitle');
		elem.innerHTML = this.title;
		elem.tabIndex = '1000';
		elem = document.getElementById('intInstructions');
		elem.innerHTML = this.instructions;
		elem.tabIndex = '1001';
				
				
				
		var button_elem;
		var tabindex = 5000;
		var body;
		var tabCount = textArray.length;
		var header
		//600, 14, 4
		var tabWidthPercentage
		if (tabCount == 2) {
			tabWidthPercentage = 556 / tabCount;
		} else if (tabCount == 3) {
			tabWidthPercentage = 534 / tabCount;
		} else if (tabCount == 4) {
			tabWidthPercentage = 512 / tabCount;
		} else {
			tabWidthPercentage = 490 / tabCount;
		}
		if (currentTheme == 3) { tabWidthPercentage = 100 } 
		//(1 / tabCount * 100) - 2;
		if (currentTheme == 2 || currentTheme == 13) { if(tabCount==4){tabWidthPercentage -= 2}else{tabWidthPercentage -=5} } 
		//alert(tabWidthPercentage);
		jQuery.each(textArray, function(index, value) {
			button_elem = document.getElementById('tabs');
			button_elem.innerHTML += "<li><a tabindex='" + tabindex + "' style='width: " + tabWidthPercentage + "px' id='" + index + "' class='title'>" + textArray[index] + "</a></li>";			
			//add content first 
		
			button_elem = document.getElementById('tabs_content_container');
		
			//check if image exists
			if (imageArray[index] == "-1") { 
				button_elem.innerHTML += "<div id='tab" + index + "' class='tab_content scroll-pane' style='display: none;' tabindex='"+(tabindex+1)+"'><p style='padding:10px 20px;'>" + buttonArray[index] + "</p></div>";				
		   } else {  
		   		if (picAlignArray[index] == 'LEFT') { newPad = 'padding-right:10px;' }
				else { newPad = 'padding-left:10px;' }
				button_elem.innerHTML += "<div id='tab" + index + "' class='tab_content scroll-pane' style='display: none;' tabindex='"+(tabindex+1)+"'><p style='padding:10px 20px;'><img style='" + newPad + "' width='150' align='" + picAlignArray[index] + "' height='150' src='" + imageArray[index] + "'/>" + buttonArray[index] + "</div> ";
		   }
		    tabindex = tabindex + 3
 		 });	
		
		changeTheme("themes/processtabsTheme" + currentTheme + ".css", "themes/headerTheme" + currentTheme + ".css" );
		setupCustomStyles();
		setupStyle("#intTitle", headerStyles)
		setupStyle("#intInstructions", instStyles)
		
		
		setupStyle(".title", buttonStyles)
		setupStyle(".tab_content p", contentStyles)
		resizeInteraction(width,height);
		addClickHandlers(); //setup the click handlers
		
		if(currentTheme == 8 || currentTheme == 4 || currentTheme == 16){
			adjustOtherThemes(tabCount);
		}
		if(currentTheme == 3 || currentTheme == 9){
			adjustThemes(tabCount);
		}
		if (currentTheme == 6 || currentTheme == 11 || currentTheme == 17) {
			moveNav();
		}
	}
};

processtabs_use = function ()
{
	return processtabsUse1;
}

