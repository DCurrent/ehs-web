<?php require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. ?>

<!DOCtype html>
    <head>
        <title>UK - Environmental Health And Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="libraries/css/style.css" type="text/css" />
        <link rel="stylesheet" href="libraries/css/print.css" type="text/css" media="print" />  
    </head>
    
    <body>    
    	<!-- Test EHS -->
        <div id="container">
            <div id="mainNavigation">
                <?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
            </div>
            <div id="subContainer">
                <?php include($cDocroot."a_banner_0001.php"); ?>
                <div id="subNavigation">
                    <?php include($cDocroot."a_subnav_0001.php"); ?> 
                </div>
                <div id="content">
					<h1>College and University EH&amp;S Links</h1>
                  
                    UK's benchmark institutions are listed in <span class="alert">red</span>. <br />                  
                  
                  	<p>
                    	<?php							
							$list	= NULL;	//List markup.
							$letter	= NULL;	//Letter placeholder.
							
							//Loop range array (A to Z)
							foreach (range('A', 'Z') as $letter)
							{
								//Build link list markup.
								$list .= '<a href="#'.$letter.'" class="no_icon">'.$letter.'</a> '.PHP_EOL;
							}
							
							//Output markup.
							echo $list;
						?>                    	
                    </p>
                                
                  	<h2 id="A">A</h2>
                  
                        <a href="//www.healthsafe.uab.edu">Alabama-Birmingham, University of</a><br />
                        <a href="//www.uaa.alaska.edu/ehsrms">Alaska Anchorage, University of</a><br />
                        <a href="//www.uaf.edu/safety">Alaska Fairbanks, University of</a><br />
                        <a href="//www.fm.asu.edu/Risk/risk.htm">Arizona State University</a><br />
                        <a href="//www.radcon.arizona.edu">Arizona, University of </a>&nbsp;(Radiation Safety)<br />
                        <a href="//w3fp.arizona.edu/riskmgmt"><span class="alert">Arizona, University of</span></a><br />
                        <a href="//www.phpl.uark.edu/index.html">Arkansas, University</a> <br />
                        <a href="//www.auburn.edu/administration/safety">Auburn University</a>
                  
                  	<h2 id="B">B</h2>
                  
                        <a href="//www.bcm.tmc.edu/envirosafety">Baylor University-College of Medicine</a><br />
                        <a href="//vax1.bemidji.msus.edu/~physical/bsu-ehs.html">Bemidji State University</a><br />
                        <a href="//www2.boisestate.edu/rmas/environ_&amp;_occup_health.htm ">Boise State University</a><br />
                        <a href="//www.bc.edu/cgi-bin/print_hit_bold.cgi/bc_org/fvp">Boston College</a><br />
                        <a href="//www.bu.edu">Boston University</a><br />
                        <a href="//www.bu.edu/ehsmc/content.htm">Boston University - Medical Campus</a><br />
                        <a href="//www.bgsu.edu/offices/envhs/index.htm">Bowling Green State University</a><br />
                        <a href="//www.byu.edu/hr/risk">Brigham Young University</a> 
                                    
                  	<h2 id="C">C</h2>
                  
                        <a href="//www.acs.ucalgary.ca/~ucsafety">Calgary, University of</a><br />
                        <a href="//www.safety.caltech.edu/home.htm">California Institute of Technology</a><br />
                        <a href="//www.intranet.csupomona.edu/~ehs">California State Polytechnic University, Pomona</a><br />
                        <a href="//www.afd.calpoly.edu/risk">California State Polytechnic University, San Luis Obispo</a><br />
                        <a href="//www.csuchico.edu">California State University, Chico</a><br />
                        <a href="//www.csudh.edu/admfin/ehos/ehoshome.htm">California State University, Dominguez Hills</a><br />
                        <a href="//ehs.fullerton.edu">California State University, Fullerton</a><br />
                        <a href="//ehs.csuhayward.edu">California State University, Hayward</a><br />
                        <a href="//www.csusm.edu/EHnOS">California State University, San Marcos</a><br />
                        <a href="//www.ucop.edu/riskmgt">California, University of</a><br />
                        <a href="//www.ehs.berkeley.edu">California-Berkeley, University of</a><br />
                        <a href="//www-ehs.ucdavis.edu">California-Davis, University of</a><br />
                        <a href="//www.ehs.ucla.edu"><span class="alert">California-Los Angeles, University of</span></a><br />
                        <a href="//www.ehs.uci.edu">California-Irvine, University of</a><br />
                        <a href="//ehs.ucr.edu">California-Riverside, University of</a><br />
                        <a href="//www-ehs.ucsd.edu">California-San Diego, University of</a><br />
                        <a href="//ehs.ucsb.edu">California-Santa Barbara, University of</a><br />
                        <a href="//ehs.ucsc.edu">California-Santa Cruz, University of</a><br />
                        <a href="//www.cmu.edu">Carnegie Mellon University</a><br />
                        <a href="//does.cwru.edu">Case Western Reserve University</a><br />
                        <a href="//www.ehs.ucf.edu">Central Florida, University of</a><br />
                        <a href="//ehs.uc.edu">Cincinnati, University of </a>
                        <a href="//ehs.clemson.edu/">Clemson University</a><br />
                        <a href="//offices.colgate.edu/chemmgt">Colgate University</a><br />
                        <a href="//chemdat1.ehs.colostate.edu">Colorado State University</a><br />
                        <a href="//ehs.colorado.edu">Colorado-Boulder, University of</a><br />
                        <a href="//www.uchsc.edu/home">Colorado-Health Science Center, University of</a><br />
                        <a href="//www.hr.columbia.edu/ehrs">Columbia University</a><br />
                        <a href="//relish.concordia.ca/index.htm">Concordia University</a><br />
                        <a href="//www.ehs.uconn.edu">Connecticut, University of</a><br />
                        <a href="//www.uchc.edu">Connecticut-Health Center, University of</a><br />
                        <a href="//www.ehs.cornell.edu">Cornell University</a><br />
                        <a href="//www.creighton.edu">Creighton University</a>
                 
                  	<h2 id="D">D</h2>
                  
                        <a href="//www.udayton.edu/~env-safe/index.htm">Dayton, University of</a><br />
                        <a href="//www.udel.edu/OHS/">Delaware, University of</a><br />
                        <a href="//www.denison.edu/sec-safe/">Denison University</a><br />
                        <a href="//64.94.196.246/drexelsite/home.htm">Drexel University</a><br />
                        <a href="//www.safety.duke.edu/">Duke University</a>
                  
                  	<h2 id="E">E</h2>
                  
                        <a href="//www.ecu.edu/oehs/">East Carolina University</a><br />
                        <a href="//www.eiu.edu/~environ/">Eastern Illinois University</a><br />
                        <a href="//www.ehso.emory.edu/">Emory University</a>
                                    
                  	<h2 id="F">F</h2>
                  
                        <a href="//www.fau.edu/divdept/univarch/ehs.htm">Florida Atlantic University</a><br />
                        <a href="//www.fsu.edu/~safety/">Florida State University</a><br />
                        <a href="//www.ehs.ufl.edu/"><span class="alert">Florida, University of</span></a>
                  
                  	<h2 id="G">G</h2>
                  
                    	<a href="//macpost.odr.georgetown.edu/ehands/homepg.htm">Georgetown University-Medical Center</a><br />
                        <a href="//www.gsu.edu/webprj01/adm/wwwsaf/public_html/">Georgia State University</a><br />
                        <a href="//www.esd.uga.edu/"><span class="alert">Georgia, University of</span></a><br />
                        <a href="//www.usg.edu/">Georgia, University System of</a><br />
                        <a href="//www.uoguelph.ca/HR/">Guelph, University of</a>
                  
                  	<h2 id="H">H</h2>
                 
                        <a href="//www.uos.harvard.edu/">Harvard University</a><br />
                        <a href="//www2.hawaii.edu/ehso/">Hawaii-Manoa, University of</a><br />
                        <a href="//www.uh.edu/admin/srmd/">Houston, University of</a><br />
                        <a href="//www.hhmi.org/science/labsafe/">Howard Hughes Medical Institute</a><br />
                        <a href="//www.humboldt.edu/%7Eehos/">Humboldt State University</a>
                 
                  	<h2 id="I">I</h2>
                 
                        <a href="//www.uidaho.edu/safety">Idaho, University of</a><br />
                        <a href="//www.physics.isu.edu/health-physics/tso/ohome1.html">Idaho State University </a><br />
                        <a href="//ness2.uic.edu/htbin/ulist/ulist?dispatch=find&amp;orgid=99735">Illinois-Chicago, University of</a><br />
                        <a href="//phantom.ehs.uiuc.edu/"><span class="alert">Illinois-Urbana, University of</span></a><br />
                        <a href="//www.ehs.indiana.edu/EHS-new-dev-2003/new/index.html">Indiana University</a><br />
                        <a href="//www.ehs.iupui.edu/">Indiana University Purdue University Indianapolis</a><br />
                        <a href="//www.ehs.iastate.edu">Iowa State University</a><br />
                        <a href="//www.uiowa.edu/%7Ehpo/"><span class="alert">Iowa, University of</span></a><br />
                        <a href="//www.ithaca.edu/admin/safety/safety1/lsindex.htm">Ithaca College</a>
                 
                  	<h2 id="J">J</h2>
                  
                    	<a href="//pewenvirohealth.jhsph.edu">Johns Hopkins University</a>
                  
                  	<h2 id="K">K</h2>
                  
                        <a href="//www2.kumc.edu/safety/">Kansas State University</a><br />
                        <a href="//www.ehs.ukans.edu/">Kansas, University of</a><br />
                        <a href="//www2.kumc.edu/safety">Kansas-Medical Center, University of</a>
                 
                 	<h2 id="L">L</h2>
                  
                    	<a href="//www.louisville.edu/admin/dehs/health.htm">Louisville, University of</a>
                 
                  	<h2 id="M">M</h2>
                  
                        <a href="//www.ume.maine.edu/~ehs/">Maine, University of</a><br />
                        <a href="//www.umanitoba.ca/campus/health_and_safety/index.shtml">Manitoba, University of</a><br />
                        <a href="//www.ehs.umaryland.edu/">Maryland-Baltimore, University of</a><br />
                        <a href="//www.inform.umd.edu/CampusInfo/Departments/EnvirSafety"><span class="alert">Maryland-College Park, University of</span></a>
                        <a href="//web.mit.edu/environment/environmental/ehs_services/ehs_areas/">Massachusetts Institute of Technology</a><br />
                        <a href="//www.umass.edu/safety/">Massachusetts-Amherst, University of</a><br />
                        <a href="//www.mcgill.ca/">McGill University</a><br />
                        <a href="//www.people.memphis.edu/~ehas/">Memphis, University of</a><br />
                        <a href="//www.mercer.edu/uro/Health/index.html">Mercer University</a><br />
                        <a href="//www.ehs.muohio.edu/">Miami University</a> (Ohio)<br />
                        <a href="//www.miami.edu/UMH/CDA/UMH_Main/1,1770,2531-1,00.html">Miami, University of</a> (Florida)<br />
                        <a href="//www.orcbs.msu.edu"><span class="alert">Michigan State University</span></a><br />
                        <a href="//www.umich.edu/~oseh/">Michigan, University of</a><br />
                        <a href="//www.dehs.umn.edu"><span class="alert">Minnesota, University of</span></a><br />
                        <a href="//www.d.umn.edu/ehso/">Minnesota-Duluth, University of</a><br />
                        <a href="//www.missouri.edu/%7Emuehs/index.htm">Missouri-Columbia, University of</a><br />
                        <a href="//www.umkc.edu/depts/gfr/cbrs/">Missouri-Kansas City, University of</a><br />
                        <a href="//www.umr.edu/~ems/">Missouri-Rolla, University of</a><br />
                        <a href="//www.montana.edu/wwwsrm/">Montana State University</a><br />
                        <a href="//www.mnstate.edu/Physical/EHS.htm">Minnesota State University Moorhead </a>
                  
                  	<h2 id="N">N</h2>
                  
                        <a href="//bifrost.unl.edu/index.html">Nebraska-Lincoln, University of</a><br />
                        <a href="//www.unmc.edu/CRSO">Nebraska-Medical Center, University of</a><br />
                        <a href="//www.unomaha.edu/%7Ewwwehs/">Nebraska-Omaha, University of</a><br />
                        <a href="//domino3.nevada.edu/ehshp.nsf">Nevada-Las Vegas, University of</a><br />
                        <a href="//www.ehs.unr.edu/">Nevada-Reno, University of</a><br />
                        <a href="//www.unh.edu/">New Hampshire, University of</a><br />
                        <a href="//www.unm.edu/~sheaweb/">New Mexico, University of</a><br />
                        <a href="//www.cortland.edu/envirohlth/">New York-Cortland, State University of</a><br />
                        <a href="//www.ehs.sunysb.edu/">New York-Stony Brook, State University of</a><br />
                        <a href="//www2.ncsu.edu/www99/index.html"><span class="alert">North Carolina State University</span></a><br />
                        <a href="//ehs.unc.edu/"><span class="alert">North Carolina, University of</span></a><br />
                        <a href="//departments.und.edu/safety/">North Dakota, University of</a><br />
                        <a href="//www.ehs.neu.edu/">Northeastern University</a><br />
                        <a href="//www4.nau.edu/facman/Envron_Hlth/index.html">Northern Arizona University</a><br />
                        <a href="//www.unf.edu/dept/">North Florida, University of</a><br />
                        <a href="//www.unt.edu/riskman/">North Texas, University of</a><br />
                        <a href="//nuinfo.nwu.edu/research-safety">Northwestern University</a><br />
                        <a href="//www.nd.edu/~riskman/">Notre Dame, University of</a>
                
                  	<h2 id="O">O</h2>
                 
                        <a href="//www.ehs.ohio-state.edu"><span class="alert">Ohio State University</span></a><br />
                        <a href="//cscwww.cats.ohiou.edu/~envhea/EHS_PAGE.HTML">Ohio University</a><br />
                        <a href="//www.pp.okstate.edu/index.htm">Oklahoma State University</a><br />
                        <a href="//www.ou.edu/fis/!physica.htm">Oklahoma, University of</a><br />
                        <a href="//w3.uokhsc.edu/ehso/">Oklahoma-Health Science Center, University of</a><br />
                        <a href="//osu.orst.edu/dept/index.htm">Oregon State University<br />
                        </a> <a href="//darkwing.uoregon.edu/~oehs/oehs.html">Oregon, University of</a>
                 
                 	<h2 id="P">P</h2>
                 
                        <a href="//www.ehs.psu.edu"><span class="alert">Pennsylvania State University</span></a><br />
                        <a href="//www.ehrs.upenn.edu/">Pennsylvania, University of</a><br />
                        <a href="//www.pp.pdx.edu/FAC/Safety/index.html">Portland State University</a><br />
                        <a href="//www.princeton.edu/~ehs/">Princeton University</a><br />
                        <a href="//www.purdue.edu/REM"><span class="alert">Purdue University</span></a>
                 
                  	<h2 id="Q">Q</h2>
                 
                 		<a href="//www.safety.queensu.ca/">Queen's University</a>
                  
                  	<h2 id="R">R</h2>
                  
                        <a href="//www.rpi.edu/dept/rmia/webpage/rmia.html">Rensselaer Polytechnic Institute</a><br />
                        <a href="//www.uri.edu/safety/index.html">Rhode Island, University of</a> (Radiation Safety)<br />
                        <a href="//riceinfo.rice.edu/projects/depts/ehsdirect.html">Rice University</a><br />
                        <a href="//www.safety.rochester.edu/">Rochester, University of</a><br />
                        <a href="//www.rockefeller.edu/labsafety/home.html">Rockefeller University</a><br />
                        <a href="//rehs.rutgers.edu/">Rutgers University</a>
                  
                  	<h2 id="S">S</h2>
                  
                        <a href="//bfa.sdsu.edu/index.htm">San Diego State University</a><br />
                        <a href="//www.sonoma.edu/">Sonoma State University</a><br />
                        <a href="//ehs.sc.edu/">South Carolina, University of</a><br />
                        <a href="//www.musc.edu/">South Carolina, Medical University of</a><br />
                        <a href="//usfweb.usf.edu/eh&amp;s/">South Florida, University of</a><br />
                        <a href="//www.uscolo.edu/">Southern Colorado, University of</a><br />
                        <a href="//www.cehs.siu.edu/">Southern Illinois-Carbondale, University of</a><br />
                        <a href="//www.smu.edu/riskmgmt/">Southern Methodist University</a><br />
                        <a href="//www.stanford.edu/dept/index.html">Stanford University</a><br />
                        <a href="//somsafety.stanford.edu">Stanford University School of Medicine Health &amp; Safety</a><br />
                        <a href="//www.slac.stanford.edu/esh/esh.html">Stanford University, SLAC</a><br />
                        <a href="//bfasweb.syr.edu/env_hlth/">Syracuse University</a>
                 
                  	<h2 id="T">T</h2>
                    
                        <a href="//www.tarleton.edu/%7Esafety/">Tarleton State University</a><br />
                        <a href="//web.utk.edu/~ehss/">Tennessee-Knoxville, University of</a><br />
                        <a href="//www.utmem.edu/safety/2safety.html">Tennessee-Memphis, University of</a><br />
                        <a href="//ehsd-online.tamu.edu"><span class="alert">Texas A&amp;M University</span></a><br />
                        <a href="//ehsd-online.tamu.edu/">Texas A&amp;M University-Galveston</a><br />
                        <a href="//ehs.tamuk.edu/Office/OfficeOverview.htm">Texas A&amp;M University-Kingsville</a><br />
                        <a href="//www.uta.edu/ehsafety/main.htm">Texas-Arlington, University of</a><br />
                        <a href="//www.utexas.edu/safety/">Texas-Austin, University of</a><br />
                        <a href="//www.utep.edu/eh&amp;s/">Texas-El Paso, University of</a><br />
                        <a href="//www.uth.tmc.edu/ut_general/research_acad_aff/safety/">Texas-Houston, University of</a><br />
                        <a href="//www.utsa.edu/compliance/enviro/">Texas-San Antonio, University of</a><br />
                        <a href="//www.uttyler.edu/safety/">Texas at Tyler, University of</a><br />
                        <a href="//physres2.uns.tju.edu/">Thomas Jefferson University</a><br />
                        <a href="//safety.utoledo.edu/">Toledo, University of</a><br />
                        <a href="//www.utoronto.ca/safety/">Toronto, University of</a><br />
                        <a href="//www.tufts.edu/central/pubsafe/ehs.htm">Tufts University</a><br />
                        <a href="//www.tmc.tulane.edu/oehs/">Tulane University</a>
                 
                  	<h2 id="U">U</h2>
                 
                        <a href="//www.ehs.usu.edu/">Utah State University</a><br />
                        <a href="//www.ehs.utah.edu/">Utah, University of</a>
                
                  	<h2 id="V">V</h2>
                  
                        <a href="//www.safety.vanderbilt.edu/">Vanderbilt University</a><br />
                        <a href="//esf.uvm.edu/">Vermont, University of</a><br />
                        <a href="//www.uvcs.uvic.ca/eoh/">Victoria, University of</a><br />
                        <a href="//views.vcu.edu/oehs/">Virginia Commonwealth University</a><br />
                        <a href="//www.ehss.vt.edu/">Virginia Tech</a><br />
                        <a href="//keats.admin.virginia.edu/"><span class="alert">Virginia, University of</span></a>
                  
                  	<h2 id="W">W</h2>
                    
                        <a href="//www.ehs.wsu.edu/">Washington State University</a><br />
                        <a href="//www.ehs.washington.edu" class="alert">Washington, University of</a><br />
                        <a href="//www.chemistry.wustl.edu/safety.html">Washington University</a> (St. Louis)<br />
                        <a href="//www.safetyoffice.uwaterloo.ca/">Waterloo, University of</a><br />
                        <a href="//www.oehs.wayne.edu/">Wayne State University</a><br />
                        <a href="//www.ac.wwu.edu/~ehs/">Western Washington University</a><br />
                        <a href="//ehs.wvu.edu/">West Virginia University</a><br />
                        <a href="//www.uwsa.edu/oslp/index.htm">Wisconsin, University of</a><br />
                        <a href="//perth.uwlax.edu/adminserv/ehshome.html">Wisconsin-La Crosse, University of</a><br />
                        <a href="//www.fpm.wisc.edu/safety/" class="alert">Wisconsin-Madison, University of</a><br />
                        <a href="//www.uwm.edu/Dept/EHSRM/">Wisconsin-Milwaukee, University of</a><br />
                        <a href="//www.uwosh.edu/home_pages/departments/safety/index.html">Wisconsin-Oshkosh, University of</a><br />
                        <a href="//www.is.uwp.edu/admin/safety/index.html">Wisconsin-Parkside, University of</a><br />
                        <a href="//vms.www.uwplatt.edu/~fm/">Wisconsin-Platteville, University of</a><br />
                        <a href="//ehs.uwsp.edu/">Wisconsin-Stevens Point, University of</a><br />
                        <a href="//www.uwstout.edu/uservices/risk/">Wisconsin-Stout, University of</a><br />
                        <a href="//staff.uwsuper.edu/">Wisconsin-Superior, University of</a><br />
                        <a href="//www.ehs.wichita.edu/">Witchita State University</a><br />
                        <a href="//www.wright.edu/admin/ehs">Wright State University</a><br />
                        <a href="//www.wpi.edu/Admin/Safety/">Worcester Polytechnic Institute</a><br />
                        <a href="//safety.uwyo.edu/">Wyoming, University of</a>
                 
                 	<h2 id="X">X</h2>
                    
                  	<h2 id="Y">Y</h2>
                  
                  		<a href="//www.yale.edu/oehs/ohsp.htm">Yale University</a>
                  
                  	<h2 id="Z">Z</h2>
                  
              </div>       
            </div>    
            <div id="sidePanel">		
                    <?php include($cDocroot."a_sidepanel_0001.php"); ?>			
                </div>
            <div id="footer">
                <?php include($cDocroot."libraries/includes/inc_footer.php"); ?>		
            </div>
        </div>
        
        <div id="footerPad">
        <?php include($cDocroot."libraries/includes/inc_footerpad.php"); ?>
        </div>
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