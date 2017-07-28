function GetRedTextElements () 
{
	var redTag		= null;
	var container	= document.getElementById ("container");
	
	if (container.getElementsByClassName)
	{
		redTags = container.getElementsByClassName ("redText");
		
		alert ("There are " + redTags.length + " elements in the container with class of 'redText'.");
		
		for (var i = 0; i < redTags.length; i++)
		{
			redTag = redTags[i];
			alert ("The contents of the " + (i + 1) + ". redText element are\n" + redTag.innerHTML);
		}
	}
	else
	{
		alert ("Your browser does not support the getElementsByClassName method.");
	}
}


function validate_form_inputs(cClass)
{
	/*
	validate_form_inputs
	license (must include to use) - //www.caskeys.com/dc/?p=5067
	Damon V. Caskey
	2012-04-15
	
	Check form fields and block form post of any field including cClass in its class is missing value.
	*/
	
	var	i		= 0;	//Counter.
	var elems 	= null;	//Element array.
	var pass	= true;	//All values provided?

	/* Get form element collection. */
	elems = document.getElementsByTagName('*'), i;

	/* Loop through element collection. */
	for (i in elems) 
	{
		/* Does element have string matching cClass in its class tags? */
		if((' ' + elems[i].className + ' ').indexOf(' ' + cClass + ' ') > -1) 
		{	
			/* Does element lack a value? */
			if(elems[i].value=='')
			{
				/* Set pass to failure. */									
				pass = false;
			}
		}
	}
	
	/* If a missing value was found, alert user. */
	if(pass == false)
	{
		alert("Please make sure all registration fields are properly completed.");
	}
	
	/* Return pass value. */
	return pass;
}

function findLableForControl(el) 
{
	var i 		= 0;
	var idVal 	= el.id;
	var label 	= "";
	
	labels = document.getElementsByTagName('label');
	
	for(i = 0; i < labels.length; i++ )
	{
		if (labels[i].htmlFor == idVal)
			label = labels[i];
	}
	
	return label;
}