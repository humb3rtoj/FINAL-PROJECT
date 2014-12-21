<?php

/**
 * Define the email where you want to recieve the message
 */ 
define('TO', 'your@email.com');

/**
 * Define the "from" email. You must set an existing email.
 */ 
define('FROM', 'noreply@your-website.com');

/**
 * Define the confirmation message
 */ 
define('CONFIRM', "Your email has been sent!");


/**
 * Define the body of the email. You can use shorcodes to display the content of the message. (ex: %name%)
 */ 
define('BODY', '<html>
	<body> 
		<h2>You got a message from the website</h2>
		<p><strong>Email</strong>: %mail%</p>
		<p><strong>Name</strong>: %name%</p>
		<p><strong>Subject</strong>: %subject%</p>
		<p><strong>Message</strong>:<br>%message%</p>
	</body>
	</html>');

function sendMail(){

	if( (isset($_POST['subject'])) && (isset($_POST['name'])) && (isset($_POST['mail'])) &&  (isset($_POST['message'])) && (isset($_POST['antispam'])) ){

		$subject = $_POST['subject'];
		$name = $_POST['name'];
		$mail = $_POST['mail'];
		$message = $_POST['message'];
		$antispam = $_POST['antispam'];

		
		$recipient = TO;

		$s = array('%mail%', '%name%', '%subject%', '%message%');
		$r = array($mail, $name, $subject, $message);

		$html=str_replace($s, $r, BODY);
							
		$headers = "From:Music Pro Form <".FROM.">\n";
		$headers .='Reply-To: '.$mail.''."\n"; 
		$headers.= "X-Mailer: PHP\n";
		$headers .= "MIME-version: 1.0\n";
		$headers .= "Content-type: text/html; charset=utf-8";
			

		if((!empty($mail)) && (!empty($message)) && (!empty($name)) && (empty($antispam))){
			if( mail($recipient, $subject, $html, $headers) ){
				echo CONFIRM; //confirmation message
			}else{
				echo 'An error occured. Please try again.';
			}					
		}else{
			echo 'An error occured. Please try again.';
		}

	}

}

sendMail();
?>