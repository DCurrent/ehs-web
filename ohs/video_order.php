<?php 
	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	$cLRoot		= $cDocroot."ohs/";
	
	// Verify user authorization and get account info.
	$oAcc->access_verify();
?>

<!DOCtype html>
    <head>
        <title>UK - Occupational Health &amp; Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />

        <link rel="stylesheet" href="../libraries/css/print.css" type="text/css" media="print" />    
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
                    <h1>Video order Form</h1>
                    
                    <p>
                        <form action="//www.uky.edu/AnyFormTurbo/AnyForm.php" method="post">
                        <input type="hidden" name="AnyFormTo" value="lpoor2@email.uky.edu" /> 
                        <input type="hidden" name="AnyFormSubject" value="Video Order Form" /> 
                        <b>
                        Without the following information your order cannot be processed:</b>
                        <table>
                        <tr>
                        <td>Name: </td>  <td> 
                          <input name="Name" size="50" value="<?php echo $oAcc->get_full_name(); ?>" />
                        </td>
                        </tr>
                        <tr>
                        <td>Department:</td> <td>
                          <input name="Department" size="50" />
                        </td>
                        </tr>
                        <tr>
                          <td>Phone:</td> <td> 
                          <input name="Phone" size="50" /> 
                          </td>
                        </tr>
                        <tr>
                        <td>Account Number:</td> <td> 
                          <input name="Acct" size="50" /> 
                          </td>
                        </tr>
                        <tr>
                        <td>E-mail:</td> <td> 
                          <input name="E-mail" size="50" /> 
                          </td>
                        </tr>
                        </table>
                        <p></p>
                        
                        <strong>Please check the videos you would like to borrow: </strong>
                        <p>
                          <b>American Chemical Society</b></p>
                        <p>
                          <input type="checkbox" name="The Big Spill-Chemical Spill Prevention and Cleanup" value="yes" /> 
                          The Big Spill-Chemical Spill Prevention and Cleanup
                          <br />
                         
                          <input type="checkbox" name="Compressed Gases: Safe Handling Procedures" value="yes" /> 
                        Compressed Gases: Safe Handling Procedures
                        <br />
                        <input type="checkbox" name="Compressed Gases: Compressed Hazards" value="yes" />
                         Compressed Gases: Compressed Hazards
                         <br />
                         <input type="checkbox" name="How Safe is Your Laboratory" value="yes" />
                         How Safe is Your Laboratory
                         <br />
                         <input type="checkbox" name="Marty's Guide to Chemical Storage in the Lab" value="yes" />
                         Marty's Guide to Chemical Storage in the Lab
                         <br />
                         <input type="checkbox" name="Oxidation Hazards [More than just air]" value="yes" />
                         Oxidation Hazards [More than just air]
                         <br />
                         <input type="checkbox" name="Stop That Dose" value="yes" />
                         Stop That Dose
                         <br />
                         <input type="checkbox" name="Things That Burn-Flammable and Combustible Chemicals" value="yes" />
                         Things That Burn-Flammable and Combustible Chemicals</p>
                        <p>
                          <b>Howard Hughes Medical Institute</b></p>
                        <p>
                          <input type="checkbox" name="Centrifuge Hazards" value="yes" /> 
                          Centrifuge Hazards
                          <br />
                          <input type="checkbox" name="Glassware Washing Hazards" value="yes" /> 
                        Glassware Washing Hazards
                        <br />
                        <input type="checkbox" name="Practicing Safe Science" value="yes" /> 
                        Practicing Safe Science
                        <br />
                        <input type="checkbox" name="Radionuclide Hazards" value="yes" />
                         Radionuclide Hazards</p>
                        <p>
                          <b>Miscellaneous Vendors</b></p>
                        <p>
                          <input type="checkbox" name="Electrical Safety" value="yes" />
                           Electrical Safety
                          <br />
                          <input type="checkbox" name="28 Grams of Prevention" value="yes" />
                        28 Grams of Prevention 
                        </p>
                        <p align="left">
                        <input type="submit" value="Order Now!!" />
                        <input type="hidden" name="AnyFormTo" value="lpoor2@email.uky.edu" />
                        <input type="reset" value="Clear Form" /><br />
                        This form will be sent to lpoor2@email.uky.edu</p>
                        <p align="center"><hr></p>
                        <p><center><b><a href="labsafe.php">Laboratory Safety</a></b></center></p>
                        </form>
                        </td></tr></table>
                    </p>
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