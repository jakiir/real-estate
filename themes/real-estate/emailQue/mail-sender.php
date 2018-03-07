<?php
	/**
	 * Template Name: Sender Mail
	 */
	require 'mail_setting.php';
	//require 'dbCon.php';
	$email_to = 'jakir44.du@gmail.com';
	$email_content = 'Hello world!';
	$email_to = str_replace("'", "", $email_to);
	//$email_cc = str_replace("'", "", $row['email_cc']);
	$attachment = '';

	$mail->setFrom('jakir44.du@gmail.com', 'Real Estate');

	$mail->addAddress($email_to, '');     // Add a recipient

	//$mail->addAddress('ellen@example.com');               // Name is optional
	//$mail->addReplyTo('jakir.ocpl@batworld.com', 'Ministry of Home Affairs');
	/*$email_cc_exp = explode(',',$email_cc);
	if(!empty($email_cc_exp[1])){
		foreach($email_cc_exp as $emailCC){
			$mail->addCC($emailCC);
		}
	} else {
		$mail->addCC($email_cc);
	}*/

	//$mail->addBCC('jakir.ocpl@batworld.com');
	//$mail->addAttachment($attachment);         // Add attachments
	//$mail->addAttachment('http://beza.sms.com.bd/uploads/2016/10/beza_57f09bb96aaa79.73874888.pdf', 'beza_57f09bb96aaa79.73874888.pdf');    // Optional name
	$mail->isHTML(true); // Set email format to HTML

	$attachments = '<br/><a href="'.$attachment.'"><u>Click here for download the security clearance.</u></a>';

	$mail->Subject = 'Application Update Information';
	$mail->Body    = $email_content.$attachments;
	$mail->AltBody = '';
	if(!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		echo 'Message has been sent on '.date();
	}
	$mail->ClearAddresses();
	$mail->ClearCCs();
