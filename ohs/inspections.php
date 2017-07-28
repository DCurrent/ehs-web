<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	$cLRoot		= $cDocroot."ohs/";    
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
                </div><!--/subNavigation-->
                <div id="content">
                    <h1>Lab Inspections</h1>
                  <p>Violations documented during laboratory inspections activity are defined as follows: </p>
                  <h4>Other-than-serious (Other):</h4> 
                  A condition that could result in an accident or injury that is less than serious in nature.
                  <h4>Serious:</h4> 
                  A condition that could result in death or serious physical harm or major regulatory action against the University (penalties of $5,000 or more).
                  <h4>Repeat:</h4>
                   A serious violation of the same type observed in two consecutive inspections.
                    <h4>Willful:</h4>
                   A serious violation of the same type observed in three consecutive inspections.
                    <h4>Facility:</h4>
                   A condition whereby equipment associated with the laboratory, e.g., emergency eyewash/showers, a chemical fume hood, fire  extinguishers, etc., is compromised and requiring repair.
                  
                    <h4>Note:</h4>  
                  When two or more individual violations are found which, if considered individually represent Other-than-serious violations, but considered in relation to each other create a condition that could result in death or serious physical harm or major regulatory action against the University (penalties of 5,000 or more), the individual violations will be documented as serious.
                  
                 <p>After the laboratory inspection has concluded, present available laboratory personnel are counseled on the violations and actions to correct.  Violations that are easily corrected are encouraged to be corrected at this time.  Any additional concerns or questions are also discussed.  The inspection report consisting of the violations and actions to correct is then forwarded via email within 5 working days   to the Principal Investigator, a departmental contact if one is appointed, and  to the chairs of the departments.</p>
                  <p>Effective January 1, 2007, inspections will document violations that persist year after year as a Repeat Violation.  When a Repeat Violation is documented, a follow-up inspection will be conducted within 30 calendar days from the date the violation was documented.   If the violation has not been corrected at the time of the follow-up inspection, the violation is referred to the appropriate senior academic official or administrative official for action. </p>
                  <p>If a Facility violation is documented, Occupational Health and Safety (OHS) will forward  a notice of deficiency to the appropriate department for correction, e.g., Physical Plant Division,  Fire Marshal's Office.</p>
                  <p>It is the department's responsibility to determine how best to follow-up and ensure these violations are corrected.  Many departments have used their safety committees for this function.   OHS remains available to assist in correcting any and all violations.</p>
                  <h2>Violation Examples</h2>
        <p>The violation examples below are the most common violations found at the University of Kentucky.</p>
        
        <ul class="cols two">
            <li><a href="#chemicalstorage">Chemical Storage</a></li>
            <li><a href="#chp">CHP Manual</a></li>
            <li><a href="#compressedgas">Compressed Gas Cylinders</a></li>
            <li><a href="#controlledaccess">Controlled Access</a></li>
            <li><a href="#doorsignage">Door Signage</a></li>
            <li><a href="#electrical">Electrical</a></li>
            <li><a href="#eyewash">Eyewash</a></li>
            <li><a href="#fireextinguisher">Fire Extinguisher</a></li>
            <li><a href="#flammablestorage">Flammable Storage</a></li>
            <li><a href="#food">Food</a></li>
            <li><a href="#fumehood">Fume Hood</a></li>
            <li><a href="#hazardouswaste">Hazardous Waste</a></li>
            <li><a href="#housekeeping">Housekeeping</a></li>
            <li><a href="#labeling">Labeling</a></li>
            <li><a href="#other">Other</a></li>
            <li><a href="#peroxideformer">Peroxide Former</a></li>
            <li><a href="#ppe">PPE</a></li>
            <li><a href="#safetyshower">Safety Shower</a></li>
            <li><a href="#training">Training</a></li>
        </ul>
        
        <h2>Legend:</h2>
                  <h4>S - Serious Violations</h4>
                  <h4>O - Other than Serious Violations</h4>
                  <h4>F - Facilities Violations</h4>
                  
                  <h3 id="chemicalstorage">Chemical Storage</h3> 
                  <a href="#top" class="top">back to top</a>
                    <table>
                        <tr>
                            <th rowspan="3">S</th>
                            <td>
                                Incompatible Chemicals Stored Together
                                <ul>
                                    <li>Acids/bases</li>
                                    <li>Flammables/oxidizers</li>
                                    <li>Organic/inorganic Acids </li>
                                    <li>Water Reactives/Water or Water-based Compounds</li>
                                    <li>Oxidizers Stored on Incompatible Shelf Material</li>
                                </ul>
                            </td>
                            <td>
                                <a href="../media/image/CS1.jpg">Example</a><br />
                                <a href="../media/image/CS4.jpg">Example</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Containers Not Sealed Properly
                            </td>
                            <td>
                                <a href="../media/image/CS2.jpg">Example</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Containers Compromised
                                <ul>
                                    <li>Corroded</li>
                                    <li>Cracked</li>
                                    <li>Leaking</li>
                                </ul>
                            </td>
                            <td>
                                <a href="../media/image/CS3.jpg">Example</a>
                            </td>
                        </tr>
                        <tr>
                            <th>O</th>
                            <td>
                                Fume hood utilized for storage while actively being utilized 
                            for chemical operations
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <th>F</th>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>              
                                
                    <h3 id="chp">CHP Manual</h3> 
                    <a href="#top" class="top">back to top</a>
                      <table>
                        <tr>
                          <th>S</th>
                          <td>None</td>
                          <td><a href="mailto:jghamo2@email.uky.edu">Request</a></td>
                        </tr>
                        <tr>
                          <th rowspan="2">O</th>
                          <td>Not Completed</td>
                          <td><a href="chp/forms.html" target="_blank">Example</a></td>
                        </tr>
                        <tr>
                          <td>Varying degrees of incomplete
                            <ul>
                              <li>No SOPs for Select Carcinogens, Reproductive Toxins and 
                                Acutely Toxic Chemicals</li>
                              <li>No Chemical Inventory</li>
                              <li>No Lab Specific Training Documentation</li>
                              <li>Incomplete ID Page</li>
                              <li>Information Not Current</li>
                            </ul></td>
                          <td><a href="chp/annrev.html" target="_blank">Example</a></td>
                        </tr>
                        <tr>
                          <th>F</th>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </table>
                      
                    <h3 id="compressedgas">Compressed Gas Cylinders</h3>
                    <a href="#top" class="top">back to top</a>
                      <table>
                        <tr>
                          <th rowspan="6">S</th>
                          <td>Unsecured</td>
                          <td><a href="../media/image/CGC1.jpg">Example</a></td>
                        </tr>
                        <tr>
                          <td>Not secured properly</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>Exceeding limits for storage per UK policy</td>
                          <td><a href="cgc2.html" target="_blank">Fact Sheet</a></td>
                        </tr>
                        <tr>
                          <td>Toxic gases not in continuously ventilated hood 
                            or gas cabinet<sup>1</sup>. Would include but not be limited 
                            to:<br />
                            arsine, diborane, germane, phosphine, nitric oxide, methyl bromide, 
                            boron trifluoride, chlorine, chlorine trifluoride, dichlorosilane, 
                            hydrogen fluoride, nitrogen dioxide, phosgene, sulfur tetrafluoride, 
                            ammonia, boron trichloride, boron trifluoride, carbon monoxide, 
                            carbonyl sulfide, ethyl chloride, hydrogen bromide, hydrogen 
                            chloride, hydrogen sulfide, silane, and disilane</td>
                          <td><a href="../media/image/CGC4.jpg">Example</a></td>
                        </tr>
                        <tr>
                          <td>Incompatible gases stored together<br />
                            &#8226; Flammables/oxidizers</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>Utilizing regulator as isolation device</td>
                          <td><a href="../media/image/CGC2.JPG">Example</a></td>
                        </tr>
                        <tr>
                          <th>O</th>
                          <td>Valve caps not on cylinders in storage</td>
                          <td><a href="../media/image/CGC7.jpg">Example</a></td>
                        </tr>
                        <tr>
                          <th>F</th>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </table>
                    
                    <h3 id="controlledaccess">Controlled Access</h3> 
                    <a href="#top" class="top">back to top</a>
                      <table>
                        <tr>
                          <th>S</th>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <th rowspan="3">O</th>
                          <td>Lab left unlocked and unattended</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>Children in lab</td>
                          <td><a href="../media/image/CA2.jpg">Example</a></td>
                        </tr>
                        <tr>
                          <td>Pets in lab</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <th>F</th>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </table>              
                    
                    <h3 id="doorsignage">Door Signage</h3>
                    <a href="#top" class="top">back to top</a>
                      <table>
                        <tr>
                          <th>S</th>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <th rowspan="3">O</th>
                          <td>None</td>
                          <td><a href="chp/forms.html" target="_blank">Forms</a></td>
                        </tr>
                        <tr>
                          <td>Incomplete</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>Outdated/incorrect information</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <th>F</th>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </table>
                      
                    <h3 id="electrical">Electrical</h3>
                    <a href="#top" class="top">back to top</a>
                      <table>
                        <tr>
                          <th rowspan="2">S</th>
                          <td>Damaged/frayed power cords</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>Use of appliances not UL listed for application<br />
                            &#8226; 
                            Blenders<br />
                            &#8226; Heat guns/hair dryers</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <th rowspan="3">O</th>
                          <td>Ext cords utilized for permanent wiring</td>
                          <td><a href="../media/image/E3.jpg">Example</a></td>
                        </tr>
                        <tr>
                          <td>Use of multiple power strips inline</td>
                          <td><a href="../media/image/E4.jpg">Example</a></td>
                        </tr>
                        <tr>
                          <td>No strain relief on energized cords</td>
                          <td><a href="../media/image/E5.jpg">Example</a></td>
                        </tr>
                        <tr>
                          <th>F</th>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </table>              
                    
                    <h3 id="eyewash">Eyewash</h3>
                    <a href="#top" class="top">back to top</a>
                      <table>
                        <tr>
                          <th>S</th>
                          <td>Blocked/obstructed eyewash</td>
                          <td><a href="../media/image/EW1.jpg">Example</a></td>
                        </tr>
                        <tr>
                          <th>O</th>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <th rowspan="2">F</th>
                          <td>Non-compliant eyewash</td>
                          <td><a href="../media/image/EW2.jpg">Example</a></td>
                        </tr>
                        <tr>
                          <td>No eyewash</td>
                          <td>&nbsp;</td>
                        </tr>
                      </table>
                      
                    <h3 id="fireextinguisher">Fire Extinguisher</h3>
                    <a href="#top" class="top">back to top</a>
                      <table>
                        <tr>
                          <th rowspan="3">S</th>
                          <td>No Fire extinguisher</td>
                          <td><a href="mailto:gbeach@email.uky.edu">E-mail</a></td>
                        </tr>
                        <tr>
                          <td>Fire ext. discharged and not reported</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>Fire ext. blocked</td>
                          <td><a href="../media/image/blockeFE.JPG">Example</a></td>
                        </tr>
                        <tr>
                          <th>O</th>
                          <td>Fire ext. not in wall mount</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <th rowspan="3">F</th>
                          <td>Fire ext. not inspected annually</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>Fire ext. not charged &#8211; &#8220;not in 
                            the green&#8221;</td>
                          <td><a href="../media/image/FE6.jpg">Example</a></td>
                        </tr>
                        <tr>
                          <td>Fire ext. not mounted</td>
                          <td>&nbsp;</td>
                        </tr>
                      </table>
                      
                    <h3 id="flammablestorage">Flammable Storage</h3>
                    <a href="#top" class="top">back to top</a>
                      <table>
                        <tr>
                          <th rowspan="5">S</th>
                          <td>Storage amounts exceed Solvent Storage Policy</td>
                          <td><a href="../fire/flstpol1.html" target="_blank">Policy</a></td>
                        </tr>
                        <tr>
                          <td>Flammables stored in unapproved refrigerator</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>Unapproved flammable storage cabinet<br />
                            &#8226; Three latch 
                            inoperable<br />
                            &#8226; Not FM or UL listed<br /></td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>Cabinet not closed</td>
                          <td><a href="../media/image/FS2.jpg">Example</a></td>
                        </tr>
                        <tr>
                          <td>Vent caps removed</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <th>O</th>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <th>F</th>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </table>       
                    
                    <h3 id="food">Food</h3>
                    <a href="#top" class="top">back to top</a>
                      <table>
                        <tr>
                          <th rowspan="2">S</th>
                          <td>Evidence consistent with eating and/or drinking 
                            in the lab</td>
                          <td><a href="../media/image/Food1.JPG">Example</a></td>
                        </tr>
                        <tr>
                          <td>Storage of food in lab area </td>
                          <td><a href="../media/image/Food2.jpg">Example</a></td>
                        </tr>
                        <tr>
                          <th>O</th>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <th>F</th>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </table>
                      
                    <h3 id="fumehood">Fume Hood</h3>
                    <a href="#top" class="top">back to top</a>
                      <table>
                        <tr>
                          <th rowspan="5">S</th>
                          <td>Sash above working height during use</td>
                          <td><a href="../media/image/sash1.JPG">Example</a></td>
                        </tr>
                        <tr>
                          <td>Alarm rendered inoperable via tampering</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>Using hood when failing</td>
                          <td><a href="../media/image/FH2.JPG">Example</a></td>
                        </tr>
                        <tr>
                          <td>Baffles obstructed</td>
                          <td><a href="../media/image/sash2.jpg">Example</a></td>
                        </tr>
                        <tr>
                          <td>Incompatible chemical utilized with standard 
                            fume hood<br />
                            &#8226; Perchloric acid</td>
                          <td><a href="perchloric.htm" target="_blank">Policy</a></td>
                        </tr>
                        <tr>
                          <th>O</th>
                          <td>Excessive chemicals/equipment in hood</td>
                          <td><a href="../media/image/FH1.JPG">Example</a></td>
                        </tr>
                        <tr>
                          <th rowspan="3">F</th>
                          <td>Hood in alarm mode</td>
                          <td><a href="mailto:jghamo2@email.uky.edu">E-mail</a></td>
                        </tr>
                        <tr>
                          <td>Alarm not functioning </td>
                          <td><a href="mailto:jghamo2@email.uky.edu">E-mail</a></td>
                        </tr>
                        <tr>
                          <td>No flow indicator and/or alarm</td>
                          <td><a href="flowmonitor.php" target="_blank">Guide</a></td>
                        </tr>
                      </table>
                      
                    <h3 id="hazardouswaste">Hazardous Waste</h3>
                    <a href="#top" class="top">back to top</a>
                      <table>
                        <tr>
                          <th rowspan="5">S</th>
                          <td>No label</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>Label incomplete<br />
                            &#8226; &#8220;Hazardous Waste&#8221; 
                            not on label<br />
                            &#8226; No date as to when full<br />
                            &#8226; 
                            No name of contents listed</td>
                          <td><a href="../media/image/HW3.jpg">Example</a></td>
                        </tr>
                        <tr>
                          <td>Waste not ticketed for pick-up when container full</td>
                          <td><a href="mailto:pquisenb@email.uky.edu">E-mail</a></td>
                        </tr>
                        <tr>
                          <td>Open containers of HW</td>
                          <td><a href="../media/image/HW4.jpg">Example</a></td>
                        </tr>
                        <tr>
                          <td>Evidence of improper disposal</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <th>O</th>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <th>F</th>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </table>
                      
                    <h3 id="housekeeping">Housekeeping</h3>
                    <a href="#top" class="top">back to top</a>
                      <table>
                        <tr>
                          <th>S</th>
                          <td>Means of egress, i.e., aisles, doorways blocked</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <th rowspan="3">O</th>
                          <td>Chemical stored in aisle ways &#8211; obstructing 
                            egress and spill potential</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>Slip/Trip hazards &#8211; power and extension 
                            cords, liquids on floor</td>
                          <td><a href="../media/image/cordtrip.JPG">Example</a></td>
                        </tr>
                        <tr>
                          <td>Overabundance of combustibles</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <th>F</th>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </table>
                      
                    
                    <h3 id="labeling">Labeling</h3>
                    <a href="#top" class="top">back to top</a>
                      <table>
                        <tr>
                          <th rowspan="3">S</th>
                          <td>Chemical containers not labeled</td>
                          <td><a href="../media/image/L1.jpg">Example</a></td>
                        </tr>
                        <tr>
                          <td>Illegible container labels</td>
                          <td><a href="../media/image/L2.jpg">Example</a></td>
                        </tr>
                        <tr>
                          <td>Label incomplete<br />
                            &#8226; No chemical name</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <th>O</th>
                          <td>Food stuffs utilized for research not labeled 
                            for intended use, i.e., &#8220;food not to be used for human 
                            consumption&#8221;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <th>F</th>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </table>
                      
                    <h3 id="other">Other</h3>
                    <a href="#top" class="top">back to top</a>
                      <table>
                        <tr>
                          <th>S</th>
                          <td>Machine not guarded</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <th rowspan="5">O</th>
                          <td>No vacuum trap utilized with vacuum source</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>Utilizing chipped or broken glassware</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>Improper disposal of glassware (deposited in regular trash 
                            in lab)</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>Overfilled sharps container</td>
                          <td><a href="../media/image/O4.jpg">Example</a></td>
                        </tr>
                        <tr>
                          <td>No annual certification of biological safety cabinet</td>
                          <td><a href="../media/image/O5.jpg">Example</a></td>
                        </tr>
                        <tr>
                          <th>F</th>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </table>
                      
                    <h3 id="peroxideformer">Peroxide Former</h3>
                    <a href="#top" class="top">back to top</a>
                      <table>
                        <tr>
                          <th rowspan="2">S</th>
                          <td>Not dated for disposal in accordance with guide sheet</td>
                          <td><a href="/ohs/peroxide.htm" target="_blank">Policy</a></td>
                        </tr>
                        <tr>
                          <td>Not disposed of by mfg&#8217;er expiration date</td>
                          <td><a href="../media/image/PF2.jpg">Example</a></td>
                        </tr>
                        <tr>
                          <th>O</th>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <th>F</th>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </table>
                      
                    <h3 id="ppe">PPE</h3>
                    <a href="#top" class="top">back to top</a>
                      <table>
                        <tr>
                          <th rowspan="4">S</th>
                          <td>Not wearing PPE in accordance with CHP PPE Hazard Assessment</td>
                          <td><a href="mailto:jghamo2@email.uky.edu">Request </a></td>
                        </tr>
                        <tr>
                          <td>Improper storage<br />
                            &#8226; Contamination of PPE<br />
                            &#8226; Degradation of PPE</td>
                          <td><a href="../media/image/PPE2.jpg">Example</a></td>
                        </tr>
                        <tr>
                          <td>Improper PPE selected</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>Improper use of PPE<br />
                            &#8226; Improper type<br />
                            &#8226; 
                            Wearing gloves outside of lab</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <th>O</th>
                          <td>Improper attire</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <th>F</th>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </table>
                      
                    <h3 id="safetyshower">Safety Shower</h3>
                    <a href="#top" class="top">back to top</a>
                      <table>
                        <tr>
                          <th rowspan="2">S</th>
                          <td>Blocked/obstructed</td>
                          <td><a href="../media/image/SS1.jpg">Example</a></td>
                        </tr>
                        <tr>
                          <td>Shower activation handle tied back</td>
                          <td><a href="../media/image/SS2.jpg">Example</a></td>
                        </tr>
                        <tr>
                          <th>O</th>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <th rowspan="3">F</th>
                          <td>No shower</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>Non-compliant shower<br />
                            &#8226; No stay open valve</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>Handle height greater than 69</td>
                          <td>&nbsp;</td>
                        </tr>
                      </table>
                      
                    <h3 id="training">Training</h3>
                    <a href="#top" class="top">back to top</a>
                      <table>
                        <tr>
                          <th>S</th>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <th rowspan="2">O</th>
                          <td>All affected employees not received Chemical Hygiene Plan/Laboratory 
                            Safety Training</td>
                          <td><a href="/classes">Training Page</a></td>
                        </tr>
                        <tr>
                          <td>All affected employees not received Lab Specific Training </td>
                          <td><a href="/ohs/chp">Training 
                            Forms</a></td>
                        </tr>
                        <tr>
                          <th>F</th>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </table>                      
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