<?php
// Check for empty fields
if(empty($_POST['name'])      ||
   empty($_POST['email'])     ||
   empty($_POST['phone'])     ||
   empty($_POST['message'])   ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
   echo "No arguments Provided!";
   return false;
   }
   
$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));
   
// Create the email and send the message
$to = 'kontakt@mkwadrat.witaszek.com.pl'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "m2.witaszek.com.pl przesyła wiadomość:  $name";
	$preferences = ['input-charset' => 'UTF-8', 'output-charset' => 'UTF-8'];
	$encoded_subject = iconv_mime_encode('Subject', $email_subject, $preferences);
	$email_subject = substr($encoded_subject, strlen('Subject: '));
$email_body = "Nowa wiadomość ze strony m2.witaszek.com.pl\n\n"."Imię: $name\n\nEmail: $email_address\n\nTelefon: $phone\n\nWiadomość:\n$message";
$headers = "From: noreply@yourdomain.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email_address\n";   
$headers .= 'MIME-Version: 1.0'.PHP_EOL.'Content-type: text/plain; charset=UTF-8';
mail($to,$email_subject,$email_body,$headers);
return true;         
?>