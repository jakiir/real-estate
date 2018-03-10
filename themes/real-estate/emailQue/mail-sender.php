<?php
	/**
	 * Template Name: Sender Mail
	 */
	 die();
	require 'mail_setting.php';
	//require 'dbCon.php';
	$mail->From = 'notification@mail.clearagain.net';
	$email_to = 'jakir44.du@gmail.com';
	$mail->FromName = 'Mailer';
	//$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
	$mail->addAddress($email_to);

	//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = 'Here is the subject';
	$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	if(!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		echo 'Message has been sent';
	}
	?>
