<?php 
	
	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file.
	
	$cDocroot = $_SERVER['DOCUMENT_ROOT']."/"; 
	
	$name			= NULL;
	$c_vals = array('name_f' 		=> NULL,
					'name_l' 		=> NULL,
					'email'	 		=> NULL,
					'date_of_birth'	=> NULL,
					'phone'	 		=> NULL,
					'password' 		=> NULL,
					'password_c'	=> NULL);
	$c_val 			= NULL;				
	$cdialog		= NULL;
	$b_omit			= FALSE;

	$c_vals['name_f']			=	$utl->utl_get_post('name_f');
	$c_vals['name_l']			=	$utl->utl_get_post('name_l');
	$c_vals['email']			=	$utl->utl_get_post('email');	
	$c_vals['date_of_birth']	=	$utl->utl_get_post('date_of_birth');
	$c_vals['phone']			=	$utl->utl_get_post('phone');
	$c_vals['password']			=	$utl->utl_get_post('password');
	$c_vals['password_c']		=	$utl->utl_get_post('password_c');
	$time 						= 	date(DATE_FORMAT);
	
	// Fieldset markup: Date of Birth	
	$oFrm->formElement['date_of_birth'] = $oFrm->forms_time('date_of_birth', class_forms::ID_USE_NAME, "Date of Birth:", $c_vals['date_of_birth'], NULL, "{dateFormat: 'yy-mm-dd', timeFormat: 'HH:mm:ss', changeYear: true, constrainInput: true, yearRange: '1900:".date('Y')."'}", "datetimepicker", class_forms::READ_ONLY_ON, array(), 'placeholder="yyyy-mm-dd" required');
																	
	$oFrm->forms_fieldset("fs_date_of_birth", class_forms::LEGEND_NONE);	
		
	// Fieldset markup: Name
	$oFrm->forms_input('name_f', class_forms::ID_USE_NAME, "First:", class_forms::VALUE_DEFAULT_NONE, $c_vals['name_f'], NULL, class_forms::EVENTS_NONE, 'placeholder="First Name" required');	
	$oFrm->forms_input('name_l', class_forms::ID_USE_NAME, "Last:", class_forms::VALUE_DEFAULT_NONE, $c_vals['name_l'], NULL, class_forms::EVENTS_NONE, 'placeholder="Last Name" required');
																										
	$oFrm->forms_fieldset("fs_name", "Name");	

	// Fieldset markup: email	
	$oFrm->forms_fieldset_addition("instructions", "When signing in using this account, the email address will also act as the account name.");
	
	$oFrm->forms_input("email", class_forms::ID_USE_NAME, "E-Mail Address:", class_forms::VALUE_DEFAULT_NONE, $c_vals['email'], array(), NULL, 'placeholder="email@domain.com" required', "email");	
																										
	$oFrm->forms_fieldset("fs_email", "E-Mail / Account Name");
	
	// Fieldset markup: phone
	$oFrm->forms_input('phone', class_forms::ID_USE_NAME, "Phone #:", class_forms::VALUE_DEFAULT_NONE, $c_vals['phone'], array(), NULL, 'placeholder="x-xxx-xxx-xxxx" required', "tel");
	
	$oFrm->forms_fieldset("fs_phone");

	// Fieldset markup: password
	$oFrm->forms_input('password', class_forms::ID_USE_NAME, "Password:", class_forms::VALUE_DEFAULT_NONE, $c_vals['password'], array(), NULL, 'placeholder="Password" required', "password");	
	
	$oFrm->forms_input('password_c', class_forms::ID_USE_NAME, "Confirm:", class_forms::VALUE_DEFAULT_NONE, $c_vals['password_c'], array(), NULL, 'placeholder="Confirm Password" required', "password");
																										
	$oFrm->forms_fieldset("fs_password", "Password");

?>

<!DOCtype html>
    <head>
        <title>UK - Environmental Health And Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
		<link rel="stylesheet" href="libraries/css/style.css" type="text/css" />
        <link rel="stylesheet" href="libraries/css/print.css" type="text/css" media="print" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
        <script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="//code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
        <script type="text/javascript" src="/libraries/javascript/jquery_ui_timepicker_addon.js"></script>    
    </head>
    
    <body>
    
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
                    <h1>EHS Accounts</h1>
                  	<p>Access for non UK personnel to access EHS training  modules. Register below to create an EHS account.</p>
        
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'){ ?>
                    
                                
                    <?php
                            
							/* Go through all input values and make sure they have been filled out. */
							foreach($c_vals as $c_val)
							{
								if(empty($c_val) === TRUE)
								{
									$b_omit = TRUE;	
								}
							}						

							if($b_omit === TRUE)
							{
							?>
								<span class="alert">All fields are required. Please ensure all fields are filled out.</span><br /><br />
							<?php	
							}
                            elseif($c_vals['password'] != $c_vals['password_c'] || !$c_vals['email'])
                            {
							?>
								<span class="alert">Password fields do not match.</span><br /><br />
							<?php
                            }
                            else
                            {
                            ?>
                            	<span class="success">Congratulations, your account has been created. You may now use your email and password to log into EHS training modules.</span><br /><br />
                            <?php
                                                        
                                /* Build query string. */
                                $query ="MERGE INTO tbl_accounts
                                USING 
                                    (SELECT ? AS Search_Col) AS SRC
                                ON 
                                    tbl_accounts.account = SRC.Search_Col
                                WHEN MATCHED THEN
                                    UPDATE SET
                                        account			= ?,
                                        name_f			= ?,
                                        name_l			= ?,								
                                        date_of_birth	= ?,
                                        phone			= ?,
                                        password		= ?,
                                        last_update		= ?
                                WHEN NOT MATCHED THEN
                                    INSERT (account, name_f, name_l, date_of_birth, phone, password, last_update)
                                    VALUES (SRC.Search_Col, ?, ?, ?, ?, ?, ?);";		
                                
                                /* Apply parameters. */
                                $params = array(&$c_vals['email'],
                                    &$c_vals['email'],
                                    &$c_vals['name_f'],
                                    &$c_vals['name_l'],
                                    &$c_vals['date_of_birth'],
                                    &$c_vals['phone'],
                                    &$c_vals['password'],
                                    &$time,
                                    &$c_vals['name_f'],
                                    &$c_vals['name_l'],
                                    &$c_vals['date_of_birth'],
                                    &$c_vals['phone'],
                                    &$c_vals['password'],
                                    &$time);	
                                
                                /* Execute query. */	
                                $oDB->db_basic_action($query, $params);
                                                        
                                $name					= 	$c_vals['name_f']." ".$c_vals['name_l'];						
                        
                                /* Set up email. */
                                $toaddress = "k.childress@uky.edu, " .$c_vals['email'];
                                $subject = "EHS Account Created";
                                $mailcontent = 											
                                            "<html>
                                            <head>
                                              <title>Account Info</title>
                                            </head>
                                            <body>
                                              <h1>Account Info</h1>
                                              <table cellpadding='3'>
                                                <tr>
                                                  <th>Name</th><td>".$name."</td>
                                                </tr>
                                                <tr>
                                                  <th>DOB</th><td>".$c_vals['date_of_birth']."</td>
                                                </tr>
                                                <tr>
                                                  <th>Phone</th><td>".$c_vals['phone']."</td>
                                                </tr>
                                                <tr>
                                                  <th>Account/Email</th><td>".$c_vals['email']."</td>
                                                </tr>
                                              </table>
                                            <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-40196994-1', 'uky.edu');
  ga('send', 'pageview');

</script>
</body>
                                            </html>";                                    
                                $oMail->mail_send($mailcontent, $subject, $toaddress);
                            }
                }
                 			
                ?>          
                  <div class="table_header">
                    Registration - All fields required unless otherwise noted.
                  </div>
                  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" name="form6" id="form6">
                    <?php 
                        echo $oFrm->forms_fieldset_all_get();                        
                    ?>
                    
                    <p>
                      <input type="Submit" value="Submit" name="Submit"/>
                    </p>
                  </form>
                <?php
                
                ?>          
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