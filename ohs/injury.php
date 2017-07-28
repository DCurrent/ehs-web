<?php 
	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	$cLRoot		= $cDocroot."ohs/";
	
	// Verify user is authorized.
	$oAcc->access_verify();
?>

<!DOCtype html>
    <head>
        <title>UK - Occupational Health &amp; Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
		<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />
        <link rel="stylesheet" href="../libraries/css/print.css" type="text/css" media="print" />    
        
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
              ['Violence by Person or Animal', 44],
				['Transportation Incidents', 6],
				['Slip/Trip/Fall', 166],
				['Exposure to Harmful Substance/Environment', 172],
				['Foreign Object in Body', 13],
				['Cut', 85],
				['Needlestick', 235],
				['Strain/Sprain', 241],
				['Struck By/Against', 54],
				['Allergic Reaction', 12],
				['Burn', 5],
				['Caught In/Between', 13]			
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
                <?php include($cLRoot."a_banner_0001.php"); ?>
                <div id="subNavigation">
                    <?php include($cLRoot."a_subnav_0001.php"); ?> 
                </div><!--/subContainer-->
                <div id="content">
                    <h1>Injury and Illness</h1>
                    <p>In 2015, injury rates  remained constant when compared to past years, but due to increased efforts,  the types of injuries have changed. The past few winters brought weather to  Lexington that hasn&rsquo;t been seen in almost two decades. Increased snowfall and  bitter temperatures created dangerous conditions on campus that several  departments worked together to remidiate.  In the past, injuries resulting from slips,  trips, and falls on campus skyrocketed during winter months, and for several  years, these injuries outpaced all other categories by a large margin. In 2015,  due to increased awareness and training provided by OHS, and an efficient plan  of snow clearing by the Physical Plant Department, injuries resulting from  slips, trips, and falls have fallen from first to fourth.</p>
While efforts to prevent  certain injuries were successful, other categories continue to be difficult to  reduce. Strains and sprains have ranked in the top two for the past several  years, and 2015 was no different, as those injuries ranked number one in total  number of incidents.  Strains and sprains  attributed to patient handling within UK Healthcare prove to be the most severe  in terms of workers&rsquo; compensation costs and lost days.  Mechanisms to assist in patient moving and  lifting continue to be installed in hopes of reducing hands-on patient handling  and overexertion. Contaminated needlesticks ranked second in 2015 in total  number of injuries. The OHS department will continue to work with UK Healthcare  and University Health Services on ideas and plans of actions to reduce needlesticks  to our hospital workers, specifically during high risk activities such as blood  draws and injections.
                    <!--Div that will hold the pie chart-->
   				  <div id="chart_div"></div>
                    
                    <p>Additional departmental analysis of injury and illness data can be found <a href="../docs/pdf/ohs_injury_illness_data.pdf" target="_blank">here</a>.</p>
                    
              </div><!--/content-->      
            </div><!--/subContainer-->
            <div id="sidePanel">		
                <?php include($cLRoot."a_sidepanel_0001.php"); ?>		
            </div><!--/sidePanel-->
            <div id="footer">
                <?php include($cDocroot."libraries/includes/inc_footer.php"); ?>		
            </div><!--/footer-->
        </div><!--/container-->
        
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