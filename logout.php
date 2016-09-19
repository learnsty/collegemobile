<?php
session_start();
require_once('c_app/models/LoginModel.php');

$logout=new loginModel;
$logout->logout();
//echo '<META HTTP-EQUIV="Refresh" Content="0; URL=http://localhost/ASPX/avivawireless2/">';
//exit;

?>
