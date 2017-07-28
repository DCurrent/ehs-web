<p>Live Example</p>
<button onclick="delayedAlert();">Show an alert box after two seconds</button>
<p></p>
<button onclick="clearAlert();">Cancel alert before it happens</button>

<span id='r'></span>

<script>
window.onload=function(){
	
	var time	 	= 240000; 	// <?php echo ini_get("session.gc_maxlifetime") * 1000; ?>; // 3e5 Time to count down (seconds * 1000).
	var catchpoint	= 180000;	// Take action when this amount of time is left.
	var interval 	= 1000; 	// 1e3 How often to update timer.
	
	
		
	var start=Date.now();
	var r=document.getElementById('r');
	
	(function f(){
		var diff = Date.now()-start;
		var ns=(((time-diff) / 1000)>>0);
		var m=(ns / 60)>>0;
		var s= ns-m*60;
		 
		r.textContent = m+':'+ ( (''+s).length>1 ? '' : '0' )+s;
		 
		if(diff > (time - catchpoint))
		{ 
			var logout 	= new Date;			 
			logout.setSeconds(logout.getSeconds() + (time / 1000));
		 	var date_string = logout.toDateString() + logout.toTimeString();
			
			alert('To ensure the security of your data, you will be logged out due to inactivity\nin 3 minutes at ' + date_string +'. \n\nPress OK before time expires to continue your session.');
			
			
				var url = 'http://ehs.uky.edu/authenticate_refresh.php';
            	$.get(url);
				start=Date.now();
				setTimeout(f,interval);
			
		}
		else
		{
			setTimeout(f,interval);
		}
	})();
}

var timeoutID;

function delayedAlert() {
  timeoutID = window.setTimeout(slowAlert, 2000);
}

function slowAlert() {
  if(confirm("That was really slow!"))
  {
	  alert('<?php echo ini_get("session.gc_maxlifetime"); ?>');
  }
  else
  {
	  alert('no');
  }
}

function clearAlert() {
  window.clearTimeout(timeoutID);
}
</script>