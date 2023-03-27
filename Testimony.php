<?php

$webmaster_email = "youthsaction015@gmail.com";

$feedback_page = "Testimonials.html";
$error_page = "Error.html";
$thankyou_page = "Successful.html";

$testimony = $_REQUEST['testimony'] ;
$name = $_REQUEST['name'] ;
$msg = 
"Name:" .$name ."\r\n" . 
"Email:" .$email_address ."\r\n" . 
"Testimony:" .$testimony ;

function isInjected($str) {
	$injections = array('(\n+)',
	'(\r+)',
	'(\t+)',
	'(%0A+)',
	'(%0D+)',
	'(%08+)',
	'(%09+)'
	);
	$inject = join('|', $injections);
	$inject = "/$inject/i";
	if(preg_match($inject,$str)) {
		return true;
	}
	else {
		return false;
	}
}

// If the user tries to access this script directly, redirect them to the feedback form,
if (!isset($_REQUEST['name'])) {
header( "Location: $feedback_page" );
}

// If the form fields are empty, redirect to the error page.
elseif (empty($name)) {
header( "Location: $error_page" );
}

/* 
If email injection is detected, redirect to the error page.
If you add a form field, you should add it here.
*/
elseif ( isInjected($name)  || isInjected($testimony) ) {
header( "Location: $error_page" );
}

// If we passed all previous tests, send the email then redirect to the thank you page.
else {

	mail( "$webmaster_email", "Feedback Form Results", $msg );

	header( "Location: $thankyou_page" );
}
?>