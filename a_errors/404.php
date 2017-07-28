<?php $cDocroot = $_SERVER['DOCUMENT_ROOT']."/"; ?>

<!DOCtype html>
    <head>
        <title>UK - Environmental Health And Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="/libraries/css/style.css" type="text/css" />

        <link rel="stylesheet" href="/libraries/css/print.css" type="text/css" media="print" />
        
        <?php $cReferer = $_SERVER['REQUEST_URI']; 
            
            if($cReferer)
            {
                $cReferer = "<span class='note'>(<a href='$cReferer'>".$cReferer."</a>)</span>";
            }
        
        ?>    
    </head>
    
    <body>
    
        <div id="container">
            <div id="mainNavigation">
                <?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
            </div><!--/mainNavigation-->
            <div id="subContainer">
                <?php include($cDocroot."a_banner_0001.php"); ?>
                
                <div id="content">
                    <h1 class="color_red">Error</h1>
                  	<p>We are sorry; the resource you requested could not be found  or has resulted in a server error. Please check your address <?php echo $cReferer; ?> for any misspellings  and typos or try using the search function at upper left.</p>       
            	</div><!--/content-->    
            </div><!--/subCntainer-->
            <div id="footer">
                <?php include($cDocroot."libraries/includes/inc_footer.php"); ?>		
            </div><!--/footer-->
        </div><!--/container-->
        
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

<?php exit; ?>