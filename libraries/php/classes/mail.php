<?php

class class_mail
{    

	/*
	class_mail - //www.caskeys.com/dc/?p=5031
	Damon Vaughn Caskey
	2012_12_10
	
	Mail handler. 
	*/	
		
	const	c_bWMAlert	= FALSE;										//Send webmaster a blind copy?
	const	c_cEDefMsg	= "...";									//Default message.
	const	c_cEHead	= "MIME-Version: 1.0 \r\nContent-type: text/html; charset=iso-8859-1\r\n";	//Default email headers.
	const	c_cESubject	= "From EHS Web";							//Default outgoing email subject.
	const	c_cEWMIn	= "dvcask2@uky.edu";						//Default webmaster's incoming email address.
	const	c_cEWMOut	= "ehs_noreply@uky.edu";					//Default address when server sends mail.
				
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
		Insert From address to header.
		*/
		$cHeader .= "From: ".$cFrom. "\r\n";		
		
		/* 
		If Webmaster alert is on, insert address into Bcc and add to header. Otherwise just add Bcc to header as is.
		*/
		if($bWMAlert===TRUE)
		{			
			$cHeader .= "Bcc: ".self::c_cEWMIn. ", ".$cBcc."\r\n";	
		}
		else
		{
			$cHeader .= "Bcc: ".$cBcc."\r\n";
		}
		
		$cHeader .="\r\n";
		
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
		}
		else
		{
			/*
			Output message as is.
			*/
			$cBody = $cMsg;
		}
			
		/*
		Run mail function.
		*/
		return mail($cTo, $cSubject, $cBody, $cHeader, $params);		
	}	
}

?>