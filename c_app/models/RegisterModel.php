<?php
require_once('CrudModel.php');
require_once('MiscModel.php');

ini_set('display_errors',0);

class RegisterModel {
	
	var $crud;
	var $misc;
	///////////// REGISTER ///////////
	public function Register(){
	$this->crud=new Crud;	
	$this->misc=new miscModel;
	
	$fname=filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
	$email=filter_var($_POST['email'], FILTER_SANITIZE_STRING);
	
	//////CONVERT PHONE TO +234//////
	$first_zero=substr($_POST['phone'],0,1);
	if($first_zero=='0'){
	$number=substr($_POST['phone'],1);	
	$phone='+234'.$number;
	}
	else{
	$phone='+'.str_replace(' ','',$number=$_POST['phone']);	
	}
	
	$password=md5(filter_var($_POST['password'], FILTER_SANITIZE_STRING));
	$table=$_POST['register_type'];
	//$table='student';
	$rand=rand(1000000000,100000000000000);
	if($table=='content_provider'){
	$return['msg']="Sorry, We are currently working on contents for content providers. Please bear with us";
	return $return;	
	}
	else{
	$check=$this->crud->dbselect($table,'*',"email='".$email."'",'');	
	$check2=$this->crud->dbselect($table,'*',"phone_number='".$phone."'",'');	
	if($check[2]>0){
	$return['msg']="Sorry, Email address aleady exist! Please try agian.";
	return $return;		
	}if($check2[2]>0){
	$return['msg']="Sorry, Phone number aleady exist! Please try agian.";
	return $return;		
	}else{
	$activate_code=$this->misc->RandomCode(10);	
	$formdata=array('full_name'=>$fname,'email'=>$email,'phone_number'=>$phone,'date'=>date('Y-m-d H:i:s A'),'register_stage'=>'1','pwrd'=>$password,'status'=>'1','rand'=>$rand,'activation_code'=>$activate_code);
	$insert=$this->crud->dbinsert($table,$formdata);

	//////UAC means User Activation Code/////
	$activate_link='http://www.collegemobile.net/activate/newuser?uac='.$activate_code.'&rand='.$rand.'&type='.$table;
	session_start();
	$_SESSION['success_registration']=array('status'=>'1','full_name'=>$fname,'activation_code'=>$activate_code,'rand'=>$rand,'type'=>$table,'email'=>$email);
	
	///////////SMS AND EMAIL API STARTS//////
	require('c_app/Api/smsandemail.php');
	
	$smsandemail=new smsandemail;
	$email_message="<p>Dear ".strtoupper($fname).", <br/>
	Thank you for signing up with us. Your new account has been setup and you can now login to our client area using the same details filled while registering.<br/>
	To activate, click on this activation link:".$activate_link." <br/>
	If you are unable to click on the link, copy and paste the link on your browser navigation bar and press the enter key. <br/>
	
	Ensure to visit the FAQ section to better acquaint you with the Collegemobile interface.<br/>
	Warm Regards, The Collegemobile Team
	<p>
	";
	////////////////SEND EMAIL PLUGIN/////////
	$mail=$smsandemail->emailing($email,$email_message,"CollegeMobile","Welcome To CollegeMobile");
	}
	}
	
	return $return;
	}

	///////////// CONTENT PROVIDER ////////
	public function contentpartnerregister(){
	$this->crud=new Crud;	
	$this->misc=new miscModel;
	
	$institution=filter_var($_POST['institution'], FILTER_SANITIZE_STRING);
	$email=filter_var($_POST['email'], FILTER_SANITIZE_STRING);
	
	//////CONVERT PHONE TO +234//////
	$first_zero=substr($_POST['phone'],0,1);
	if($first_zero=='0'){
	$number=substr($_POST['phone'],1);	
	$phone='+234'.$number;
	}
	else{
	$phone='+'.str_replace(' ','',$number=$_POST['phone']);	
	}
	
	$password=md5(filter_var($_POST['password'], FILTER_SANITIZE_STRING));
	$table='contentprovider';
	//$table='student';
	$rand=rand(1000000000,100000000000000);

	$check=$this->crud->dbselect($table,'*',"email='".$email."'",'');	
	$check2=$this->crud->dbselect($table,'*',"phone_number='".$phone."'",'');	
	if($check[2]>0){
	$return['msg']="Sorry, Email address aleady exist! Please try agian.";
	return $return;		
	}if($check2[2]>0){
	$return['msg']="Sorry, Phone number aleady exist! Please try agian.";
	return $return;		
	}else{
	$activate_code=$this->misc->RandomCode(10);	
	$formdata=array('full_name'=>$institution,'email'=>$email,'phone_number'=>$phone,'date'=>date('Y-m-d H:i:s A'),'register_stage'=>'1','pwrd'=>$password,'status'=>'1','rand'=>$rand,'activation_code'=>$activate_code);
	$insert=$this->crud->dbinsert($table,$formdata);

	//////UAC means User Activation Code/////
	$activate_link='http://www.collegemobile.net/activate/newuser?uac='.$activate_code.'&rand='.$rand.'&type='.$table;
	session_start();
	$_SESSION['success_registration']=array('status'=>'1','full_name'=>$institution,'activation_code'=>$activate_code,'rand'=>$rand,'type'=>$table,'email'=>$email);
	
	///////////SMS AND EMAIL API STARTS//////
	require('c_app/Api/smsandemail.php');
	
	$smsandemail=new smsandemail;
	$email_message="<p>Dear ".strtoupper($institution).", <br/>
	Thank you for signing up with us. Your new account has been setup and you can now login to our client area using the same details filled while registering.<br/>
	To activate, click on this activation link:".$activate_link." <br/>
	If you are unable to click on the link, copy and paste the link on your browser navigation bar and press the enter key. <br/>
	
	Ensure to visit the FAQ section to better acquaint you with the Collegemobile interface.<br/>
	Warm Regards, The Collegemobile Team
	<p>
	";
	////////////////SEND EMAIL PLUGIN/////////
	$mail=$smsandemail->emailing($email,$email_message,"CollegeMobile","Welcome To CollegeMobile");
	}
	
	return $return;
	}
	
	
	public function resendactivation(){
		
	$activate_code=$_GET['resendactivation'];
	$rand=$_GET['rand'];
	$table=$_GET['type'];	
	$email=$_SESSION['success_registration']['email'];
	//////UAC means User Activation Code/////
	$activate_link='http://www.collegemobile.net/activate/newuser?uac='.$activate_code.'&rand='.$rand.'&type='.$table;
	require('c_app/Api/smsandemail.php');
	
	$smsandemail=new smsandemail;
	$email_message="<p style='line-height:25px'> Dear ".strtoupper($_SESSION['success_registration']['full_name']).", <br/>
	Thank you for signing up with us. Your new account has been setup and you can now login to our client area using the same details filled while registering.<br/>
	To activate, click on this activation link:".$activate_link." <br/>
	If you are unable to click on the link, copy and paste the link on your browser navigation bar and press the enter key. <br/>
	
	Ensure to visit the FAQ section to better acquaint you with the Collegemobile interface.<br/>
	Warm Regards, The Collegemobile Team
	<p>
	";
	////////////////SEND EMAIL PLUGIN/////////
	$mail=$smsandemail->emailing($email,$email_message,"CollegeMobile","Welcome To CollegeMobile");
	//print_r($mail);
	
	return $mail;
	
	
		
	}
	
	///////////////AFTER INPUTING ACTIVATION CODE SENT TO PHONE
	public function activation_phone_code(){
	$this->crud=new Crud;
	$phone=$_POST['phone_number'];
	$reg_type=$_POST['reg_type'];
	  $email=$_POST['email'];
	  $activate_code=filter_var($_POST['activation_phone_code'], FILTER_SANITIZE_STRING);	

 	$check=$this->crud->dbselect($reg_type,'*',"activation_code='".$activate_code."' AND email ='".$email."'",'');	

	if($check[2]==0){
	$return['msg']='Unknown activation code';
	return $return;	
	}
	
	else{	
	
	session_start();
	
	/////////////IF ACCESSLOGIN SESSION IS NOT SET//////
	if(!isset($_SESSION['accessLogin'])){
	if($_POST['reg_type']=='lecturer'){
	$_SESSION['accessLogin']=array('full_name'=>$login2['full_name'],'phone_number'=>$login2['phone_number'],'email'=>$login2['email'],'user_id'=>$login2['rand'],'account_type'=>'lecturer');
	}elseif($_POST['reg_type']=='student'){
	$_SESSION['accessLogin']=array('full_name'=>$login2['full_name'],'phone_number'=>$login2['phone_number'],'email'=>$login2['email'],'user_id'=>$login2['rand'],'account_type'=>'student');
	}
	}
	$_SESSION['stage3']=array('full_name'=>$check[0]['full_name'],'email'=>$check[0]['email']);
	
	$update=mysql_query("update ".$reg_type." SET status='1', register_stage='2' WHERE email='".$email."' AND activation_code='".$activate_code."'")or die(mysql_error());
	
	return $return;			
	//echo "1";	
	}
	

	}
	
	
	/////////////////ACTIVATING USER ACTIVATION LINK//////////
	public function activate_link(){
		
	$this->crud=new Crud;
	//////UAC means User Activation Code/////
	$uac=$_GET['uac'];	
	$rand=$_GET['rand'];
	$updatearray=array('register_stage'=>'2');
	$type=strtolower($_GET['type']);

	$update=$this->crud->dbupdate($type,$updatearray,"rand='".$rand."' AND activation_code='".$uac."' AND register_stage='1'");
	
	$check=$this->crud->dbselect($type,'*',"rand='".$rand."'",'');
	//print($check[0]['institution']);
	if($update=='1'){
	session_start();
	if($type=='lecturer'){
	$_SESSION['accessLogin']=array('full_name'=>$check[0]['full_name'],'phone_number'=>$check[0]['phone_number'],'email'=>$check[0]['email'],'state'=>'1','user_id'=>$check[0]['rand'],'account_type'=>$type,'register_stage'=>$check[0]['register_stage'],'avater'=>$check[0]['photo']);
	
	}
	elseif($type=='student'){
	$_SESSION['accessLogin']=array('full_name'=>$check[0]['full_name'],'phone_number'=>$check[0]['phone_number'],'email'=>$check[0]['email'],'user_id'=>$check[0]['rand'],'reg_number'=>$check[0]['reg_number'],'state'=>'1','account_type'=>$type,'register_stage'=>$check[0]['register_stage'],'avater'=>$check[0]['photo']);
	
	}
	elseif($type=='contentprovider'){
	$_SESSION['accessLogin']=array('full_name'=>$check[0]['full_name'],'phone_number'=>$check[0]['phone_number'],'email'=>$check[0]['email'],'user_id'=>$check[0]['rand'],'reg_number'=>$check[0]['reg_number'],'state'=>'1','account_type'=>$type,'register_stage'=>$check[0]['register_stage'],'avater'=>$check[0]['photo']);
	
	}
	
	}
	
	
	else{
	echo $msg='Invalid Activation Link';		
	}
	
	return;
	}
	
	public function complete_form(){
	
	$this->crud=new Crud;
	$idnumber=$_POST['id_number'];
	$school=$_POST['school'];
	$department=$_POST['department'];
	$level=$_POST['level'];
	$email=$_POST['email'];
	$reg_type=$_POST['reg_type'];
	if($reg_type=='lecturer'){
	$column='staff_id';	
	}elseif($reg_type=='student'){
	$column='reg_number';	
	}

 	$check=$this->crud->dbselect($reg_type,'*',$column."='".$idnumber."'",'');	

	if($check[2]>0){
	$return['msg']='This '.$column." already exist!";
	return $return;	
	}
	
	else{	
	
	session_start();
	$formdata=array($column=>$idnumber,'school'=>$school,'department'=>$depeartment,'register_stage'=>'3','level'=>$level);
	$update=mysql_query("update ".$reg_type." SET register_stage='3', school='".$school."', department='".$department."', level='".$level."',".$column."='".$idnumber."' WHERE email='".$email."'")or die(mysql_error());
	
	$getuserdetails=$this->crud->dbselect($reg_type,'*',"email='".$email."'",'');
	
	////////////IF THE SESSION IS NOT SET, SET A NEW SESSION
	if(!isset($_SESSION['accessLogin'])){
	
	if($_POST['reg_type']=='lecturer'){
	$_SESSION['accessLogin']=array('full_name'=>$getuserdetails[0]['full_name'],'phone_number'=>$getuserdetails[0]['phone_number'],'email'=>$email,'user_id'=>$getuserdetails[0]['rand'],'account_type'=>'lecturer');
	header('Location: teach/');
	}elseif($_POST['reg_type']=='student'){
	$_SESSION['accessLogin']=array('full_name'=>$getuserdetails[0]['full_name'],'phone_number'=>$getuserdetails[0]['phone_number'],'email'=>$email,'user_id'=>$getuserdetails[0]['rand'],'account_type'=>'student');
	header('Location: learn/feeds');
	}
	
	
	}
	$_SESSION['accessLogin']['register_stage']='3';
	$_SESSION['accessLogin']['user_id']=$getuserdetails[0]['rand'];
	header('Location: learn/feeds');

	
	
	return $return;			
	//echo "1";	
	}
	

		
		
	}


}

;?>
