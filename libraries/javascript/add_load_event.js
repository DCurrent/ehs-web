function addLoadEvent(func) 
{
	/*
	addLoadEvent
	Damon Vaughn Caskey
	2013_01_17 (moved from pages)
	
	Run other functions on page load.
		
	func:	Function to run.
	*/	

    var oldonload = window.onload;
    
    if (typeof window.onload != 'function') 
    {
    	window.onload = func;
    }
    else
    {
        window.onload = function() 
        {
            if (oldonload)
            {
            	oldonload();
            }
            func();
        }
    }
}