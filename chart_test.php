<?php require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. ?>

<!DOCtype html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>UK - Environmental Health And Safety</title>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" />
		<link rel="stylesheet" href="libraries/css/style.css" type="text/css" />
        <link rel="stylesheet" href="libraries/css/print.css" type="text/css" media="print" />
        
        <!--Load the AJAX API-->
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript">
    
          // Load the Visualization API and the piechart package.
          google.load('visualization', '1.0', {'packages':['corechart']});
    
          // Set a callback to run when the Google Visualization API is loaded.
          google.setOnLoadCallback(drawChart);
    
          // Callback that creates and populates a data table,
          // instantiates the pie chart, passes in the data and
          // draws it.
          function drawChart() {
    
            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Injury Category');
            data.addColumn('number', 'Injuries');
            data.addRows([
              ['Assault', 211],
              ['Bite', 171],
              ['Burn', 138],
              ['Chemical Exposure', 222],
              ['Ergonomics - Acute/Other', 294],
			  ['Ergonomics - Lifting/Material Handling', 791],
			  ['Ergonomics - Repetitive Motion', 211],
			  ['Exposure to Contagious Disease', 792],
			  ['Exposure to Potentially Infectious Material', 818],
			  ['Eye Injury', 144],
			  ['Motor Vehicle Accident', 196],
			  ['Needle Stick', 1530],
			  ['Other', 360],
			  ['Patient Handling Related Injury', 798],
			  ['Sharps/Cutting Safety', 733],
			  ['Slip/Trip/Fall', 1990],
			  ['Struck By/Caught Between', 995]			  
            ]);
    
            
           // Set chart options
           var options = {	is3D: true,
						  	legend: { position: 'right', maxLines: 10 } ,
						  	pieSliceText: 'percentage',						  						  
						  	tooltip: { text: 'both' },
							height: 400,
							width: 700,
							chartArea:{left:10,top:10,width:'100%',height:'100%'}						  
						};
    
            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
          }
        </script>        
    </head>
    
    <body>    
        <div id="container">            
            <div id="mainNavigation">
                <?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
            </div><!--/mainNavigation-->            
            <div id="subContainer">                            
				<?php include("a_banner_0001.php"); ?>                               
                <div id="subNavigation">                
                    <?php include("a_subnav_0001.php"); ?>                     
                </div><!--/subNavigation-->                
                <div id="content">                
                    <h1>Welcome</h1>                      
                    
                    <!--Div that will hold the pie chart-->
    				<div id="chart_div"></div>
              	</div><!--/content-->                      
            </div><!--/subContainer-->
            
            <div id="sidePanel">
                <?php include($cDocroot."a_sidepanel_0001.php"); ?>		
            </div><!--/sidePanel-->
            
            <div id="footer">
                <?php include($cDocroot."libraries/includes/inc_footer.php"); ?>		
            </div><!--/footer-->
        </div><!--container-->
        
        <div id="footerPad">
        	<?php include($cDocroot."libraries/includes/inc_footerpad.php"); ?>
        </div><!--/footerPad-->
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