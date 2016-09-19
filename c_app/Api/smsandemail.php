<?php
use Mailgun\Mailgun;


class smsandemail {
/////// SMS API
public function smsmessage($sms_to_phonenumber,$text_message,$sender_name){	
	
//SMS TWILIO API
	require 'twilio-php-master-2/Services/Twilio.php';

	$sid = "ACdeb97f0cf5ce466bc399acd6405ad2ce"; // Your Account SID from www.twilio.com/user/account
	$token = "1458aee00a127d6d47c3b0548682d4ca"; // Your Auth Token from www.twilio.com/user/account
	
	$client = new Services_Twilio($sid, $token);
	$message = $client->account->messages->sendMessage(
	  $sender_name, // From a valid Twilio number
	  $sms_to_phonenumber, // Text this number
	  $text_message
	);
	print_r($message);

	return;
}

//MAIL GUN EMAIL API
public function emailing($emailtoaddress,$email_message,$sender_name,$subject){
//Your credentials
require 'vendor/autoload.php';

$mg = new Mailgun("key-c7a3fe7354444d7209d1e92345862bd1");
$domain = "jaraja.com.ng";

//Customise the email - self explanatory
$mg->sendMessage($domain, array(
'from'=> $sender_name.' <support@collegemobile.net>',
'to'=> $emailtoaddress,
'subject' => $subject,
'text' => $email_message,
'html'=>$email_message
    )
);
//print_r($mg);

	return $mg;
}




}

;?>