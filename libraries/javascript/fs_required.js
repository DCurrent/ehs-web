// JavaScript Document
<!-- Begin
<!--checks to make sure all info is entered on the form -->
function checkrequired(which) 
{
	var pass=true;
	
	if (document.images) 
	{
		for (i=0;i<which.length;i++) 
		{
			var tempobj=which.elements[i];
			if (tempobj.name.substring(0,8)=="required") 
			{
				if (((tempobj.type=="text"||tempobj.type=="textarea") && tempobj.value=='')||(tempobj.type.toString().charAt(0)=="s"&& tempobj.selectedIndex==0))
				{
					pass=false;
					break;
				}
			}
		}
	}
	
	if (!pass) 
	{
		shortFieldName=tempobj.name.substring(8,30);
		alert("Please make sure the "+shortFieldName+" field was properly completed.");
		return false;
	}
	else
		return true;
}
//  End -->