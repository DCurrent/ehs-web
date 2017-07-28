<?php 
		
	// Start page cache.
	//$page_obj = new class_page_cache();
	//ob_start();
?>

<!DOCtype html>
    <head>
        <title>UK - Environmental Health And Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        
        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        
        <style>			
			
			body {
				background-image: url('/media/image/0_0004.jpg');
				background-position: center center;
				background-repeat: no-repeat;
				background-attachment:fixed;
				background-size: cover;
				background-color: #464646;
			}
			
			.container {
				background-color:#FFF;
				opacity:0.95;
			}
			
			.table tbody>tr>td.vert-align
			{
				vertical-align: middle;
			}
			
		</style>
        
    </head>
    
    <body>
        <div id="container" class="container">
        	<div class="row">
            		<div class="jumbotron">
                    <h1>Environmental Health And Safety</h1>
                    <p>UK Safety begins with YOU!</p>
                    
                    <div id="mainNavigation">
						<?php include($_SERVER['DOCUMENT_ROOT']."/libraries/includes/inc_mainnav_bootstrap.php"); ?>
                    </div>
                    
                  </div>
            
                
            </div>
            
            <div class="row">            
                <div id="subContainer" class="container col-xs-9">                    
                    <div id="content" class="col-xs-12">
                   	  <h2>Frequently Asked Questons</h2>
                      
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" href="#collapse1">How do I dispose of an item in my lab or office? <span class="glyphicon glyphicon-menu-down"></span></a>
                                </h4>
                            </div>
                            <div style="" id="collapse1" class="panel-collapse collapse">
                                <div class="panel-body">
                                	Contact Environmental Management at 859-323-6820. 
                                </div>
                            </div>
                        </div>
                        
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" href="#collapse2">I have been told I need to get safety training before I may begin work. Where do I get started? <span class="glyphicon glyphicon-menu-down"></span></a>
                                </h4>
                            </div>
                            <div style="" id="collapse2" class="panel-collapse collapse">
                                <div class="panel-body">
                                	EHS has created the <a href="/apps/rocky/module_list_client.php">Rocky</a> application to handle safety training needs. See <a href="/apps/rocky/module_list_client.php">here</a> to get started.
                                </div>
                            </div>
                        </div>
                        
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" href="#collapse3">How do I report an accident? <span class="glyphicon glyphicon-menu-down"></span></a>
                                </h4>
                            </div>
                            <div style="" id="collapse3" class="panel-collapse collapse">
                                <div class="panel-body">
                                	See here for instructions on accident reporting. For immediate emergencies, dial 911. 
                                </div>
                            </div>
                        </div>
                        
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" href="#collapse4">I saw something that doesn't look safe. What should I do? <span class="glyphicon glyphicon-menu-down"></span></a>
                                </h4>
                            </div>
                            <div style="" id="collapse4" class="panel-collapse collapse">
                                <div class="panel-body">
                                	Unsafe conditions should be reported here.
                                </div>
                            </div>
                        </div>
                     
                    </div>
                    <!--content--> 
                </div>
                
                <div id="sidePanel" class="container col-xs-3">		
					<?php include($_SERVER['DOCUMENT_ROOT']."/a_sidepanel_bootstrap.php"); ?>                        
                </div><!-- sidePanel-->                     		
            </div><!-- .row-->      
        </div><!-- container-->

    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-40196994-1', 'uky.edu');
  ga('send', 'pageview');

</script>
</body>
</html>