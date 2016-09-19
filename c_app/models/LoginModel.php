<?php
require_once('CrudModel.php');
require_once('MiscModel.php');
$crud=new Crud;

class LoginModel {


	public function Login(){
 	require_once('CrudModel.php');
 	$crud=new Crud;
  	$table=$_POST['login_type'];
	$first_zero=substr($_POST['login_username'],0,1);
	if($first_zero=='0'){
	$number=substr($_POST['login_username'],1);	
	$phone='+234'.$number;
	}else{
	$phone=$number=filter_var($_POST['login_username'], FILTER_SANITIZE_STRING);	
	}
  	
		
$open=mysql_query("SELECT * FROM `".$table."` WHERE phone_number ='".$phone."'")or die(mysql_error());
if(mysql_num_rows($open)>0){
$login2=mysql_fetch_array($open);
$return = array();

if($login2['status']=='0'){
$return['msg']="Hello <strong>".$uname."</strong><br/>Your account is pending; please contact Admin.</a>";
}
/*
elseif($login2['register_stage']<2){
session_start();
$_SESSION['stage2']=array('stage'=>'2','reg_type'=>$table,'email'=>$login2['email']);
die(header('Location: register'));		
}
*/
else{
$password=md5(filter_var($_POST['login_password'], FILTER_SANITIZE_STRING),'');


if ($login2['pwrd'] == $password){
	//$grabvalues=array();
	session_start();
	if($_POST['login_type']=='lecturer'){
	$_SESSION['accessLogin']=array('full_name'=>$login2['full_name'],'phone_number'=>$login2['phone_number'],'email'=>$login2['email'],'state'=>'1','user_id'=>$login2['rand'],'account_type'=>'lecturer','register_stage'=>$login2['register_stage'],'avater'=>$login2['photo']);
	
	header('Location: learn/feeds');
	}elseif($_POST['login_type']=='student'){
		
	$_SESSION['accessLogin']=array('full_name'=>$login2['full_name'],'phone_number'=>$login2['phone_number'],'email'=>$login2['email'],'user_id'=>$login2['rand'],'reg_number'=>$login2['reg_number'],'state'=>'1','account_type'=>'student','register_stage'=>$login2['register_stage'],'avater'=>$login2['photo']);
	header('Location: learn/feeds');	
	}elseif($_POST['login_type']=='contentprovider'){
		
	$_SESSION['accessLogin']=array('full_name'=>$login2['full_name'],'phone_number'=>$login2['phone_number'],'email'=>$login2['email'],'user_id'=>$login2['rand'],'state'=>'1','account_type'=>'contentprovider','register_stage'=>$login2['register_stage'],'avater'=>$login2['photo'],'about_me'=>$login2['about_me'],'website'=>$login2['website']);
	header('Location: content/index');	
	}

	}

	elseif($login2['pwrd']!=$password){
	$return['msg'] =  'Wrong Username or Password! Please try again.';
	}
}

}
else{
	$return['msg'] =  'Wrong Username or Password! Please try again.';

}

	return $return;
	
	
}


public function adminLogin(){
	$this->crud=new Crud;
	$this->misc=new miscModel;    
		
$open=mysql_query("SELECT * FROM adminlogin AS T1 INNER JOIN admin AS T2 ON T1.id=T2.ID WHERE T1.UserName ='".filter_var($_POST['username'], FILTER_SANITIZE_STRING)."'")or die(mysql_error());
if(mysql_num_rows($open)>0){
$login2=mysql_fetch_array($open);
$return = array();	
if($login2['status']=='0'){
$return['msg']="Hello <strong>".$uname."</strong><br/>Your account is still pending; please contact Admin.</a>";	
}

else{
 $password=$this->misc->encodeValue(filter_var($_POST['password'], FILTER_SANITIZE_STRING),'');
	

if ($login2['Password'] == $password){
    
    session_start();
    
	$_SESSION['adminLogin']=filter_var($_POST['username'], FILTER_SANITIZE_STRING);	
	$_SESSION['adminaccessDetails']=array('fname'=>$login2['fname'],'lname'=>$login2['lname'],'Othernames'=>$login2['OtherNames'],'phone'=>$login2['phone'],'passport'=>$login2['pic_path'],'email'=>$login2['email'],'lastLogin'=>$login2['lastlogin'],'address'=>$login2['address'],'city'=>$login2['city'],'ID'=>$login2['ID'],'priviledge'=>$login2['priviledge']);

	
	$return['msg']='1';
	
	if($login2['pic_status']=='0'){
	die(
		header('location:adminupload')
		);	
	}else{
	$_SESSION['adminid']=$login2['ID'];	
	header('Location: dashboard/allNews');
	}
	//$return['session_user']=$uname;
	///$return['session_userid']=$login2['rand'];

	}
		
	elseif($login2['Password']!=$password){
	$return['msg']='Oops... Invalid Username or Password!';
	}
}

}
else{
	$return['msg']='Oops... Invalid Username or Password!';
	
}

	return $return;

	}



public function Logout(){
	$url=explode('/',$_SERVER['REQUEST_URI']);
	//$dirlocation="http://".$_SERVER['HTTP_HOST']."/".$url[1]."/";
	$dirlocation="http://".$_SERVER['HTTP_HOST']."/";
//////////UPDATE LAST LOGIN
//$update=mysql_query("update adminlogin SET lastlogin='".date('Y-m-d H:i:s')."' WHERE ID='".$_SESSION['adminid']."'")or die(mysql_error());

if($_SESSION['accessLogin']){
	session_destroy();
	session_unset('accessLogin');
	session_unset('accessid');

	die(
	header('location:'.$dirlocation.'login')
	);


}
else{
	session_destroy();
	session_unset('accessLogin');
	session_unset('accessid');

	die(
	header('location:'.$dirlocation.'login')
	);
}


}

}

;?>
