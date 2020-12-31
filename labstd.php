<?php require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. ?>

<!DOCtype html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>UK - Environmental Health And Safety</title>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="libraries/css/style.css" type="text/css" />
        <link rel="stylesheet" href="libraries/css/print.css" type="text/css" media="print" />
        <style>
		table
		{
			border-spacing:1px;			
		}		
		
		tr:nth-child(n+4) 
		{
			text-align:center;
		}
		</style>
    </head>
    
    <body>    
        <div id="container">            
            <div id="mainNavigation">
                <?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
            </div><!--/mainNavigation-->            
            <div id="subContainer">                            
				<?php include("a_banner.php"); ?>                               
                <div id="subNavigation">                
                    <?php include("a_subnav.php"); ?>                     
                </div><!--/subNavigation-->                
                <div id="content">                
                    <h1>Safety Standards for Chemical Laboratories</h1>                      
                    <p>Conversion of non-lab spaces to chemical labs represents a "change in occupancy" under Kentucky Building Code. Such conversions require review and approval by the University Fire Marshal prior to renovating or occupying the space.</p>                     
                                          
                    <p>The purpose of this standard is to establish minimum criteria, consistent with the intended use, to be applied when converting non-lab spaces into rooms for the use of chemicals.

After the effective date of this standard, all chemical lab conversions must be reviewed and approved by the University Fire Marshal. Failure to obtain this approval may result in a "Stop Construction" order or posting of the space as "Illegally Occupied."

The standards for chemical laboratories, classified according to chemical use, are listed in the following table.</p>

                    <table border="0">
                    	<caption>Chemical Laboratory Standards</caption>                    	
                        <tr> 
                            <th>Chemical Lab (CL) Classification:</th>
                            <th>CL-4</th>
                            <th>CL-3</th>
                            <th>CL-2</th>
                            <th>CL-1</th>
                        </tr>
                        
                        <tr> 
                            <th rowspan="2">Safety Equipment/Systems</th>
                            <td>Broad use of hazardous chemicals</td>
                            <td>Restricted use of hazardous chemicals*</td>
                            <td>Hazardous chemical storage only</td>
                            <td>No hazardous chemical storage or use</td>
                        </tr>
    
                        <tr> 
                            <td>Broad use of non-hazardous chemicals</td>
                            <td>Broad use of non-hazardous chemicals</td>
                            <td>Broad use of non-hazardous chemicals</td>
                            <td>Broad use of non-hazardous chemicals</td>
                        </tr>
    
                        <tr> 
                            <th>Sprinkler</th>
                            <td>&#x2713;</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        
                        <tr> 
                            <th>Supply and exhaust air systems</th>
                            <td>&#x2713;</td>
                            <td>&#x2713;</td>
                            <td>&#x2713;</td>
                            <td></td>
                        </tr>
                        
                        <tr> 
                          <th>Labs on 100% exhaust</th>
                            <td>&#x2713;</td>
                            <td>&#x2713;</td>
                            <td>&#x2713;</td>
                          	<td></td>
                        </tr>
                        
                        <tr>                      
                            <th>Fume hood</th>
                            <td>&#x2713;</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        
                        <tr> 
                            <th>Sink</th>
                            <td>&#x2713;</td>
                            <td>&#x2713;</td>
                            <td>&#x2713;</td>
                            <td>&#x2713;</td>
                        </tr>
    
                        <tr> 
                            <th>Eyewash</th>
                            <td>&#x2713;</td>
                            <td>&#x2713;</td>
                            <td></td>
                            <td></td>
                        </tr>
        
                        <tr> 
                            <th>Safety shower</th>
                            <td>&#x2713;</td>
                            <td>&#x2713;</td>
                            <td></td>
                            <td></td>
                        </tr>
    
                        <tr> 
                            <th>Portable fire extinguisher</th>
                            <td>&#x2713;</td>
                            <td>&#x2713;</td>
                            <td>&#x2713;</td>
                            <td>&#x2713;</td>
                        </tr>
        
                        <tr> 
                            <th>Controlled access (lockable door)</th>
                            <td>&#x2713;</td>
                            <td>&#x2713;</td>
                            <td>&#x2713;</td>
                            <td>&#x2713;</td>
                        </tr>
    
                        <tr> 
                            <th>Approved floor surface (no carpet)</th>
                            <td>&#x2713;</td>
                            <td>&#x2713;</td>
                            <td>&#x2713;</td>
                            <td>&#x2713;</td>
                        </tr>
                    </table>
                      
                      
                    <h2>* Restricted use</h2> 
                        
                    <p>In a CL-3 lab, the following hazardous chemicals (see Definitions) 
          are restricted to closed systems (e .g., HPLC, scintillation counter, etc.): 
          gases; volatile liquids or malodorous compounds; solids that may become 
          aerosolized in a process; liquids or solids that may become volatile at 
          elevated temperatures; or reactions that may generate any of the preceding.</p>
          
                    <p>Note: CL-4, CL-3 and CL-2 labs must have sufficient HVAC controls 
        to allow them to be maintained negatively pressurized relative to the corridor.</p>
                    
                    <h2>Definitions</h2>
                    
                    <p>For the purpose of this standard, hazardous chemical is defined as a substance or mixture that meets one of the following criteria: (a) National Fire Protection Association (NFPA) hazard rating of 3 or 4 for health, flammability or reactivity, or rated as water reactive or oxidizing agent; (b) listed carcinogen; (c) aqueous solution with pH less than 2 or greater than 12.5; (d) strongly malodorous compounds, or (e) hazardous waste.</p>

					<p>A non-hazardous chemical is defined as a substance or mixture with NFPA hazard ratings of 0, 1 or 2.</p>

					<p>A chemical laboratory is an area where chemicals are used on a small scale for research, teaching or clinical functions. A laboratory may consist of one or more interconnected rooms.</p>
                    
                    <h2>Miscellaneous</h2>
                    
                    <p>Separate standards may apply for chemical use in cold rooms, animal rooms, greenhouses, and certain other specialized rooms.</p>

					<p>These standards by no means constitute an exhaustive list of all the safety requirements for chemical laboratories. Additional requirements may apply to chemical labs using radioactive materials, biohazards and/or animals.</p>
                    
              	</div><!--/content-->                       
            </div><!--/subContainer-->
            
            <div id="sidePanel">		
                <?php include($cDocroot."a_sidepanel_0001.php"); ?>		
            </div><!--/sidePanel-->
            
            <div id="footer">
                <?php include($cDocroot."libraries/includes/inc_footer.php"); ?>		
            </div><!--/footer-->
        </div>
        
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