<?php 

require($_SERVER['DOCUMENT_ROOT'].'/libraries/php/classes/session.php');	//Session handler.

// Replace default session handler.
$session_handler	= new class_session();	
session_set_save_handler($session_handler, TRUE);
	
require_once($_SERVER['DOCUMENT_ROOT'].'/libraries/php/classes/access_dev/main.php'); 	// Database class.

$acc = new class_access_status();

$log = new class_access_process();


$acc->verify();

//$acc->action();

?>

<html>
<head>
<title>the title</title>
   <script type="text/javascript" 
   src="/jquery/jquery-1.3.2.min.js"></script>
   <script type="text/javascript" 
   src="/jquery/jquery-ui-1.7.2.custom.min.js"></script>
   <script type="text/javascript" language="javascript">
   
    $(document).ready(function() {

      $("#hide").click(function(){
         $(".target").hide( "drop", 
                     {direction: "up"}, 1000 );
      });

      $("#show").click(function(){
         $(".target").show( "drop", 
                      {direction: "down"}, 1000 );
      });

   });
   </script>
   <style>
      p {
           background-color:#bca;
           width:200px; 
           border:1px solid green; 
        }
  </style>
</head>
<body>

   <p>Click on any of the buttons</p>
   <button id="hide"> Hide </button>
   <button id="show"> Show</button> 
   <div class="target">
      Text
   </div>
  
</body>
</html>
