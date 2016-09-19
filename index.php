<?php

date_default_timezone_set('Africa/Lagos');

//session_start();

if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();

///// INITIATE THE APPLICATION
require_once('c_app/init.php');

$App = new App;

ob_end_flush();


?>