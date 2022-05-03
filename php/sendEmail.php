<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);
// Replace this with your own email address

function url(){
  return sprintf(
    "%s://%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['SERVER_NAME']
  );
}

if($_POST) {

require_once "Mail.php";

$host = "ssl://smtp.dreamhost.com";
$username = "tarunmadamanchi@gmail.com";
$password = "1214228t";
$port = "465";
$to = "tarun.madamanchi@knowledgelens.com";
$email_from = "tarunmadamanchi@gmail.com";
$email_subject = trim(stripslashes($_POST['subject']));
$email_body = trim(stripslashes($_POST['message']));
$email_address = trim(stripslashes($_POST['email']));
$name = trim(stripslashes($_POST['name']));
   
if ($subject == '') { $subject = "Contact Form Submission"; }

// Set Message
$message .= "Email from: " . $name . "<br />";
$message .= "Email address: " . $email_from . "<br />";
$message .= "Message: <br />";
$message .= nl2br($email_body);
$message .= "<br /> ----- <br /> This email was sent from your site " . url() . " contact form. <br />";

// Set From: header
$from =  $name . " <" . $email_from . ">";

// Email Headers
$headers = "From: " . $from . "\r\n";
$headers .= "Reply-To: ". $email . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$headers = array ('From' => $email_from, 'To' => $to, 'Subject' => $email_subject, 'Reply-To' => $email_address,'name' => $name );
echo "Headers   :" . $headers . "message  :".$message;
$smtp = Mail::factory('smtp', array ('host' => $host, 'port' => $port, 'auth' => true, 'username' => $username, 'password' => $password));
$mail = $smtp->send($to, $headers, $message);


if (PEAR::isError($mail)) {
echo("<p>" . $mail->getMessage() . "</p>");
} else {
echo("<p>Message successfully sent!</p>");
}

?>




