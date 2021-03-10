<?php

class class_mail
{    

	/*
	class_mail - //www.caskeys.com/dc/?p=5031
	Damon Vaughn Caskey
	2012_12_10
	
	Mail handler. 
	*/	
		
	const	c_bWMAlert	= TRUE;										//Send webmaster a blind copy?
	const	c_cEDefMsg	= '...';									//Default message.
	const	c_cEHead	= 'MIME-Version: 1.0 \r\nContent-type: text/html; charset=iso-8859-1\r\n';	//Default email headers.
	const	c_cESubject	= 'From EHS Web';							//Default outgoing email subject.
	const	c_cEWMIn	= 'dvcask2@uky.edu';						//Default webmaster's incoming email address.
	const	c_cEWMOut	= 'ehs_noreply@uky.edu';					//Default address when server sends mail.
				
	public function mail_send($cMsg=self::c_cEDefMsg, $cSubject=self::c_cESubject, $cTo=self::c_cEWMIn, $cFrom=self::c_cEWMOut, $cBcc=NULL, $bWMAlert=self::c_bWMAlert, $cHeader=self::c_cEHead, $params=NULL)
	{	
		/*
		mail_send
		Damon Vaughn Caskey
		2012_12_28
		
		Send HTML mail with standard defaults.
		
		$cMsg:		Body of email.
		$cSubject:	Subject line.
		$cTo:		Outgoing address list.
		$cFrom:		Return address.
		$cBcc:		Blind carbon copy address list.
		$bWMAlert:	Send Bcc to webmaster.
		$cHeader:	Header information.
		$params:	Optional parameters.
		*/
	
        $cBody = NULL;	//Final sting for message body.
	
		/* 
		If Webmaster alert is off, blank the bcc.
		*/
		if($bWMAlert==FALSE)
		{
            $cBcc = '';
        }
        	
		/*
		If message passed as a key array, break into list and output as table layout.
		*/		
		if (is_array($cMsg))
		{
			/*
			Initial html and table markup.
			*/
			$cBody = "<html>
						<head>
						  <title>".$cSubject."</title>
						</head>
						<body>
						  <h1>".$cSubject."</h1>
						  <table cellpadding='3'>";
			
			/*
			Get each item in array and place into two column table row.
			*/
			foreach($cMsg as $key => $value)
			{			
				$cBody .= "<tr><th>".$key.":</th><td>".$value."</td></tr>";			
			}	
			
			/*
			Add closing markup.
			*/
			$cBody .= "</table>
					
</body>
					</html>";	
		}
		else
		{
			/*
			Output message as is.
			*/
			$cBody = $cMsg;
		}
			
		/*
		* Run mail function.
		*/
        
        $headers   = array();
        $headers[] = "MIME-Version: 1.0";
        $headers[] = "Content-type: text/html; charset=iso-8859-1";
        if($cFrom)	$headers[] = "From: ".$cFrom;
        if($cBcc)	$headers[] = "Bcc: ".$cBcc;
        //if(MAILING::CC) 	$headers[] = "Cc: ";	
        
        $result = mail($cTo, $cSubject, $cBody, implode("\r\n", $headers));
        
        if(!$result)
        {
            $errorMessage = error_get_last()['message'];
            echo PHP_EOL.'<!-- Error '.$errorMessage.' -->';
        }
        
		return $result;	
	}	
}

?>