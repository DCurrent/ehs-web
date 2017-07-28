<?php

interface mail_int
{	
	function mail_send($cMsg=self::c_cEDefMsg, $cSubject=self::c_cESubject, $cTo=self::c_cEWMIn, $cFrom=self::c_cEWMOut, $cBcc=NULL, $bWMAlert=self::c_bWMAlert, $cHeader=self::c_cEHead, $params=NULL);
}

interface mail_header
{	
	function recipiant();	
	function sender();
	function cc();	
	function bcc();	
	function set_recipiant($recipiant);	
	function set_sender($sender);	
	function set_cc($cc);	
	function set_bcc($bcc);
}

class class_mail_header implements mail_header
{
	const RECIPIENT = '';
	const SENDER	= 'ehs_noreply@uky.edu';
	const CC		= '';
	const BCC		= '';
	
	private $recipient_m	= NULL; // Email "to" address(s).
	private $sender_m		= NULL; // Email "from" address.
	private $cc_m			= NULL; // Email cc address.
	private $bcc_m			= NULL;	// Email bcc address.
	
	function __construct($recipient = self::RECIPIENT, $sender = self::SENDER, $cc = self::CC, $bcc = self::BCC)
	{
		$this->recipient_m	= $recipient;
		$this->sender_m 	= $sender;
		$this->cc_m 		= $cc;
		$this->bcc_m 		= $bcc;
	}
	
	public function recipiant()
	{
		// Return recipiant data member.
		return $this->recipient_m;
	}
	
	public function sender()
	{
		// Return sender data member.
		return $this->sender_m;
	}
	
	public function cc()
	{
		// Return cc data member.
		return $this->cc_m;
	}
	
	public function bcc()
	{
		// Return bcc data member.
		return $this->bcc_m;
	}
	
	public function set_recipiant($recipiant)
	{
		// Set recipiant data member.
		$this->recipient_m = $recipiant;
	}
	
	public function set_sender($sender)
	{
		// Set sender data member.
		$this->sender_m = $sender;
	}
	
	public function set_cc($cc)
	{
		// Set cc data member.
		$this->cc_m;
	}
	
	public function set_bcc($bcc)
	{
		// Set bcc data member.
		$this->bcc_m;
	}
}

class class_mail
{    

	/*
	class_mail - //www.caskeys.com/dc/?p=5031
	Damon Vaughn Caskey
	2012_12_10
	
	Mail handler. 
	*/	
	
	const	c_bWMAlert	= TRUE;										//Send webmaster a blind copy?
	const	c_cEDefMsg	= "...";									//Default message.
	const	c_cEHead	= "MIME-Version: 1.0 \r\nContent-type: text/html; charset=iso-8859-1\r\n";	//Default email headers.
	const	c_cESubject	= "From EHS Web";							//Default outgoing email subject.
	const	c_cEWMIn	= "dvcask2@uky.edu";						//Default webmaster's incoming email address.
	const	c_cEWMOut	= "ehs_noreply@uky.edu";					//Default address when server sends mail.
	
	private $head		= NULL; // Email header.
	private $body 		= NULL;	// Email body.
	private $alert		= NULL;	// Send copy to web master?
	private $parameters	= NULL;	// Additional parameters for PHP mail function.
	
	function __construct(class_mail_header $head)
	{
		$this->head = new class_mail_header();
		
		$this->head->set_recipiant($head->recipiant());
		$this->head->set_sender($head->sender());
		$this->head->set_cc($head->cc());
		$this->head->set_bcc($head->bcc());
		
		
		$this->body 		= $body;
		$this->subject 		= $subject;
		$this->recipient 	= $recipient;
		$this->sender 		= $sender;
		$this->bcc 			= $bcc;
		$this->alert 		= $alert;
		$this->parameters 	= $parameters;
	}
	
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
	
		// Insert From address to header.
		$cHeader .= "From: ".$cFrom. "\r\n";		
		
		// If Webmaster alert is on, insert address into Bcc and add to header. Otherwise just add Bcc to header as is.
		if($bWMAlert===TRUE)
		{			
			$cHeader .= "Bcc: ".self::c_cEWMIn. ", ".$cBcc."\r\n";	
		}
		else
		{
			$cHeader .= "Bcc: ".$cBcc."\r\n";
		}
		
		$cHeader .="\r\n";
		
		// If message passed as a key array, break into list and output as table layout.		
		if (is_array($cMsg))
		{
			// Initial html and table markup.
			$cBody = "<html>
						<head>
						  <title>".$cSubject."</title>
						</head>
						<body>
						  <h1>".$cSubject."</h1>
						  <table cellpadding='3'>";
			
			// Get each item in array and place into two column table row.
			foreach($cMsg as $key => $value)
			{			
				$cBody .= "<tr><th>".$key.":</th><td>".$value."</td></tr>";			
			}	
			
			// Add closing markup.
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
			// Output message as is.
			$cBody = $cMsg;
		}
			
		//	Run mail function.
		return mail($cTo, $cSubject, $cBody, $cHeader, $params);		
	}	
}

?>