<?php 
include"PHPMailer/src/PHPMailer.php";
include"PHPMailer/src/Exception.php";
include"PHPMailer/src/OAuth.php";
include"PHPMailer/src/POP3.php";
include"PHPMailer/src/SMTP.php";
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class Mailer{

// print_r($mail);
	public function dathangmail($tieude,$noidung,$maildathang){
		$mail = new PHPMailer(true);
		try {
		    //Server settings
		    $mail->CharSet='UTF-8';
		    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = 'smtp.gmail.com;';  // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = 'huumanh.edu@gmail.com';                 // SMTP username
		    $mail->Password = 'ehfikydazafscitz';                           // SMTP password
		    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 587;                                    // TCP port to connect to
		 
		    //Recipients
		    $mail->setFrom('huumanh.edu@gmail.com', 'Mailer');

		    $mail->addAddress($maildathang, 'Hữu Mạnh');     // Add a recipient
		    // $mail->addAddress('daolehai630@gmail.com','Hải Dớ');
		    // $mail->addAddress('tdkhanh1998@gmail.com','Khanh Ngáo');                 // Name is optional
		    // 
		    // $mail->addReplyTo('info@example.com', 'Information');
		    $mail->addCC('huumanh.edu@gmail.com');
		    // $mail->addBCC('bcc@example.com');
		 
		    //Attachments
		    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		 
		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = $tieude;
		    $mail->Body    = $noidung;
		    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		 
		    $mail->send();
		    echo '';
		} catch (Exception $e) {
		    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}
}
}
?>