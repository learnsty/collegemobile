<?php
/*
SMS TWILIO API
	require 'twilio-php-master-2/Services/Twilio.php';

	$sid = "ACdeb97f0cf5ce466bc399acd6405ad2ce"; // Your Account SID from www.twilio.com/user/account
	$token = "1458aee00a127d6d47c3b0548682d4ca"; // Your Auth Token from www.twilio.com/user/account
	
	$client = new Services_Twilio($sid, $token);
	$message = $client->account->messages->sendMessage(
	  'Jaraja ', // From a valid Twilio number
	  '+2348174077714', // Text this number
	  "This one is from Jaraja dont be scared"
	);
	print_r($message);
*/

//MAIL GUN EMAIL API

require 'vendor/autoload.php';
use Mailgun\Mailgun;
//Your credentials
$mg = new Mailgun("key-c7a3fe7354444d7209d1e92345862bd1");
$domain = "jaraja.com.ng";

//Customise the email - self explanatory
$mg->sendMessage($domain, array(
'from'=>'JARAJA <support@jaraja.com.ng>',
'to'=> 'mike98989@gmail.com',
'subject' => 'WELCOME TO JARAJA!',
'text' => 'It is so simple to send a message.'
    )
);


;?>
