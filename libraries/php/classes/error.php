<?php

class class_error
{    

	/*
	class_error
	Damon Vaughn Caskey
	2012-12-28
	~2014-06-12: Add ERROR_DIAGNOSTIC option to ease development.
	~2015-03-24: Removed mail object dependency - class is now self contained. Mailing and DB output are a mess still - needs cleanup.
	
	Error handler.
	*/	
	
	const	ERROR_URL					= '/a_errors/php.php';		// URL to send user on fatal error (if possible).
	const	ERROR_DIAGNOSTIC			= TRUE;					// If TRUE, log and send alert for all detected errors but disable trapping.
	const 	ERROR_LOG_DB_HOST			= "box406.bluehost.com";	// Error log DB host.
	const 	ERROR_LOG_DB_LOGICAL_NAME	= "caskeysc_uk";			// Error log DB logical name.
	const 	ERROR_LOG_DB_ACCOUNT		= "caskeysc_ehsinfo";		// Error log DB user.
	const 	ERROR_LOG_DB_PASSWORD		= "caskeysc_ehsinfo_user";	// Error log DB password.
	const	ERROR_TYPE_SCRIPT			= 0;						// Error type; general script errors.
	const	ERROR_TYPE_DATABASE			= 1;						// Error type; datbase error.
	
	private $cIP			= NULL;						// $_SERVER['REMOTE_ADDR']
	private $cSource		= NULL; 					// $_SERVER['PHP_SELF']
	private $debug			= 0;
		
	public	$cErrType		= NULL;						// Error number or user type.
	public 	$cErrCode		= NULL;						// Error code.
	public 	$cErrDetail		= NULL;						// Error detail (SQL string, parameters, user defined data...).
	public 	$cErrFile		= NULL;						// File running at error time.
	public	$cErrLine		= NULL; 					// Error line.
	public 	$cErrMsg		= NULL;						// Error message.
	public	$cErrState		= NULL;						// State of server (ex. SQL State).
	public	$cErrTOE		= NULL;						// Time of error.
	public	$cErrVars		= NULL;						// String dump of variables.
	
	public function __construct()
    {	
        set_error_handler(array($this, 'error_handle_start'));
	
		register_shutdown_function(array(&$this, 'error_shutdown'));
	}
	
	public function error_fatal()
	{	
		/*
		error_fatal
		Damon Vaughn Caskey
		2012_12_30
		
		Run final actions before exit on a fatal error.
		*/
		
		/*	If headers haven't been sent, redirect user to an error page. Otherwise we'll just have to die and settle for a plain text message.	*/
		if($this->redirect() === FALSE)
		{ 
			die('<span style="font-size:12px; color:red;">We are sorry; it appears an internal error has occurred while processing your request. The webmaster has been alerted and will resolve this issue as soon as possible.</span>');
		}
		
		exit;
			
	}
	
	public function error_handle_start($cCode=NULL, $cMsg=NULL, $cFile=NULL, $cLine=NULL)
	{
		$this->error_handle($cCode, $cMsg, $cFile, $cLine, self::ERROR_TYPE_SCRIPT, NULL, NULL);
		
		return true;		
	}
	
	public function error_handle($cCode=NULL, $cMsg=NULL, $cFile=NULL, $cLine=NULL, $type=self::ERROR_TYPE_SCRIPT, $cState=NULL, $cDetail=NULL)
	{
		/*
		error_run
		Damon Vaughn Caskey
		2012_12_28
		
		Run error mail and and log in single call.
				
		$cCode:		Error code/number.
		$cMsg:		Error message.
		$cFile:		PHP generated file name.
		$cLine:		Code line location.
		$type:		User defined error type.
		$cState:	Server state (mostly for SQL errors).
		$cDetail:	User added detail.
		*/
		
		$iLevel = NULL;
		$value	= NULL;
		$key	= NULL;
		$i		= 0;
		$result = FALSE;
		$action = array('log' => TRUE, 'mail' => FALSE, 'fatal' => FALSE);
				
		$this->cErrTOE		= date(DATE_FORMAT);
		$this->cIP			= $_SERVER['REMOTE_ADDR'];
		$this->cSource		= $_SERVER['PHP_SELF'];
		$this->cErrType		= $type;
		$this->cErrFile		= $cFile;
		$this->cErrLine		= $cLine;	
		$this->cErrCode		= $cCode;
		$this->cErrVars		= NULL;
		if($cState) $this->cErrState .= " || ". $cState;	
		if($cMsg) $this->cErrMsg .= " || ". $cMsg;
		if($cDetail) $this->cErrDetail .= " || ". $cDetail;		
								
		/*
		If logging in (/authenticate.php) and error is suppressed then exit and do nothing.
		
		LDAP libraries are bugged. EX: ldap_bind throws error 49 on bad password instead of returning FALSE as documented. 
		In PHP this can only be worked around by suppressing the error. Otherwise suppressing errors with @ is bad practice 
		that should be avoided at all costs. Its use will be ignored within any other file.
		*/
		$iLevel = error_reporting();
		
		if (($iLevel == 0 || ($iLevel & $cCode) == 0) && ($this->cSource == "/authenticate.php" || $this->cSource == $_SERVER['PHP_SELF']))
		{
			$result = TRUE;
		}
		else
		{		
			if($this->cErrCode)
			{		
				/* Get global vars dump. */
				$this->cErrVars = $this->get_var_dump();
				
				/* If error is any type other than a notice then immediately end script and send an email alert to webmaster.	*/
				
				if(self::ERROR_DIAGNOSTIC === TRUE)
				{
					echo 'Error: '.$this->cErrMsg.'<br>';
					$action['mail'] = TRUE;
				}
				else
				{
					switch ($this->cErrCode)
					{				
						case E_USER_ERROR:
						case E_USER_WARNING:
						case E_ERROR:
						case E_CORE_ERROR:
						case E_COMPILE_ERROR:
						default:									
							
							$action['mail'] = TRUE;
							$action['fatal'] = TRUE;
							break;
			
						case E_USER_NOTICE:
						case E_NOTICE:
							break;				
					}		
				}
								
				/* Take action based on error results. */
				//if($action['log'] === TRUE)		$this->error_log_db();	//Log to external database.
				if($action['mail'] === TRUE) 	$this->error_mail();	//Send email alert.
				if($action['fatal'] === TRUE)	$this->error_fatal();	//Exit script and alert end user.
			}			
		}
		
		return $result;
	}
		
   	public function error_log_db()
	{
		/*
		error_db_log
		Damon Vaughn Caskey
		2012_12_28
				
		Attempt to log error detail to database. Self-contained and all potential errors suppressed to avoid recursive calls.
		*/
				
		$DBConn		= NULL;	//Connection reference to DB error log.
		$query			= NULL; //Error query string.
		$DBStatement	= NULL;	//Prepared query reference.
		
		@$DBConn = new mysqli(self::ERROR_LOG_DB_HOST, self::ERROR_LOG_DB_ACCOUNT, self::ERROR_LOG_DB_PASSWORD, self::ERROR_LOG_DB_LOGICAL_NAME);
		
		/* If the error log database connection was successful, insert each error to table. */
		if (!$DBConn->connect_error) 
		{				
			/* Build query string. */ 		
			$query = "INSERT INTO tbl_gen_errors (toe, ip, type, source, file, line, state, code, vars, msg, details) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			@$DBStatement = $DBConn->prepare($query);
			
			/* Bind parameters. */
			@$DBStatement->bind_param("sssssssssss", $this->cErrTOE, $this->cIP, $this->cErrType, $this->cSource, $this->cErrFile, $this->cErrLine, $this->cErrState, $this->cErrCode, $this->cErrVars, $this->cErrMsg, $this->cErrDetail);
			
			/* Execute and close query. */ 
			if($DBStatement != false)
			{							
				@$DBStatement->execute();
				@$DBStatement->close();
			}
			
			/* Close DB connection. */
			@$DBConn->close();			
		}						
	}
	
	public function error_mail()
	{
		/*
		error_mail
		Damon Vaughn Caskey
		2012_12_31
		~2012_01_02: Array list upgrade.
		~Remove mail function so we can be self contained.
		
		Prepare and send an email error alert.
		*/		
		
		$subject = 'Error Report';
		$body = '
				<html>
					<head>
						<title>'.$subject.'</title>
					</head>
					<body>
						<h1>'.$subject.'</h1>						
						
						<hr>						
						<table cellpadding="3">
							<caption>Error Data</caption>
							<thead></thead>
							<tfoot></tfoot>
							<tbody>
								<tr><th>Time:</th><td>'.$this->cErrTOE.'</td></tr>
								<tr><th>Type:</th><td>'.$this->cErrType.'</td></tr>
								<tr><th>IP:</th><td>'.$this->cIP.'</td></tr>
								<tr><th>Def. Source File:</th><td>'.$this->cSource.'</td></tr>
								<tr><th>Source File:</th><td>'.$this->cErrFile.'</td></tr>
								<tr><th>Line:</th><td>'.$this->cErrLine.'</td></tr>
								<tr><th>State:</th><td>'.$this->cErrState.'</td></tr>
								<tr><th>Code:</th><td>'.$this->cErrCode.'</td></tr>
								<tr><th>Message:</th><td>'.$this->cErrMsg.'</td></tr>
								<tr><th>Variables:</th><td>'.$this->cErrVars.'</td></tr>
								<tr><th>Details:</th><td>'.$this->cErrDetail.'</td></tr>
							</tobdy>
						</table>	
					</body>
				</html>';

		$mail_to = "dvcask2@uky.edu";
		$headers   = array();
		$headers[] = "MIME-Version: 1.0"; 
		$headers[] = "Content-type: text/html; charset=iso-8859-1";			
		$headers[] = "From: ehsnoreply.uky.edu";
								
		// Run mail function.
		mail($mail_to, $subject, $body, implode("\r\n", $headers));
		
	}
			
	public function error_shutdown()
	{
		/*
		error_shutdown
		Damon Vaughn Caskey
		2012_12_31
		
		Shutdown function to capture error types PHP will not normally allow custom error handlers to deal with.
		*/
		
		$cError	= NULL;		//Last error status.
		
		/*	Get last error status.	*/
        $cError = error_get_last();
		
		$this->error_handle($cError['type'], $cError['message'], $cError['file'], $cError['line']);
    }	
	
	private function get_var_dump()
	{
		
		/*
		get_var_dump
		Damon Vaughn Caskey
		2015-03-24 (copied from utl_var_dump 2013-06-18)		
		
		Dump vars into string or single array and return results.
		
		$type: Dump style. NULL = String.
		$sets: Types to include in dump.		
		*/
		
		$result = NULL;
		
		if(isset($_GET))
		{
			foreach($_GET as $key => $value)
			{
				if(is_array($value))
				{
					$value = implode(", ", $value);					
				}
				
				$result .= "GET[".$key."]: ".$value." || ";
			}
		}
		
		if(isset($_POST))
		{
			foreach($_POST as $key => $value)
			{
				if(is_array($value))
				{
					$value = implode(", ", $value);					
				}
				
				$result .= "POST[".$key."]: ".$value." || ";
			}
		}
		
		if(isset($_SESSION))
		{
			foreach($_SESSION as $key => $value)
			{
				if(is_array($value))
				{
					$value = implode(", ", $value);					
				}
				
				$result .= "SESSION[".$key."]: ".$value." || ";
			}
		}
		
		return $result;
	}
	
	// Redirect to error page if possible.
	private function redirect()
	{
		$result = TRUE;

		// If headers haven't been sent, redirect user to an error page. Otherwise we'll just have to die and settle for a plain text message.		
		if(headers_sent())
		{ 
			// Good coding will always avoid attempting to resend headers, but let's make sure to catch them here before PHP throws a nasty error.			
			$result = FALSE;
		}
		else
		{			
			//header('Location: '.self::ERROR_URL);
		}
		
		// Return end result.
		return $result;
	}
}

