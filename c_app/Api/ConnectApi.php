<?php
error_reporting(1);

ini_set('display_errors',1);
//// DO REGISTRATION ////
if($_POST['name']){
  require_once('../models/CrudModel.php');
  $crud=new Crud;
	$date=date('Y-m-d h:i:A');
	$insert_array=array('email'=>$_POST['email'],'date'=>$date,'full_name'=>$_POST['name'],'phone_number'=>$_POST['phone'],'username'=>$_POST['username'],'pwrd'=>md5($_POST['password']),'status'=>'1');
	
	if($_POST['type']=='1'){
	$student_details=array('reg_number'=>$_POST['regnumber']);	
	$merge_array=array_merge($insert_array,$student_details); 
	echo $insert=$crud->dbinsert('student',$merge_array);	
	}
	elseif($_POST['type']=='2'){
	$lecturer_details=array('staff_id'=>$_POST['lecturerid']);	
	$merge_array=array_merge($insert_array,$lecturer_details); 	
	echo $insert=$crud->dbinsert('lecturer',$merge_array);		
	}
	

}

if($_POST['loginusername']){
 require_once('../models/CrudModel.php');
  $crud=new Crud;
  if($_POST['type']=='1'){
  	$table='student';	
  }
  elseif($_POST['type']=='2'){
	$table='lecturer';	  
  }
  
$open=mysql_query("SELECT * FROM ".$table." WHERE username ='".filter_var($_POST['loginusername'], FILTER_SANITIZE_STRING)."'")or die(mysql_error());
if(mysql_num_rows($open)>0){
$login2=mysql_fetch_array($open);
$return = array();

if($login2['status']=='0'){
echo "Hello <strong>".$uname."</strong><br/>Your account is pending; please contact Admin.</a>";
}

else{
$password=md5(filter_var($_POST['loginpassword'], FILTER_SANITIZE_STRING),'');


if ($login2['pwrd'] == $password){
	//$grabvalues=array();
	$grabvalues=array('full_name'=>$login2['full_name'],'phone_number'=>$login2['phone_number'],'email'=>$login2['email'],'reg_number'=>$login2['reg_number'],'state'=>'1','staff_id'=>$login2['staff_id']);

	echo json_encode($grabvalues);
	}

	elseif($login2['pwrd']!=$password){
	echo 'invalid';
	}
}

}
else{
	echo 'invalid';

}

	
	
}

if($_GET['level']){
require_once('../models/mobileAppModel.php');
$model=new mobileAppModel;	
$courseware=$model->courseware();

while($grabcourseware=mysql_fetch_array($courseware[1])){
$grabValues['courseware'][] = $grabcourseware;
}


echo json_encode($grabValues);
}


if($_GET['staffid']){
require_once('../models/mobileAppModel.php');
$model=new mobileAppModel;	
$allcourseware=$model->allcourseware();
$myclassroom=$model->myclassroom();

//print_r($staffclassroom);
while($grabcourseware=mysql_fetch_array($allcourseware[0])){
$grabValues['allcourseware'][] = $grabcourseware;
}

while($grabclassroom=mysql_fetch_array($myclassroom[1])){
$grabValues['myclassroom'][] = $grabclassroom;
}

echo json_encode($grabValues);
}



if($_POST['courseware_title']){
	$date=date('Y-m-d h:i:A');
	
  require_once('../models/CrudModel.php');
  $crud=new Crud;

	require_once('../models/FilterModel.php');
	$filter = new filterModel;

	$array_list=array('jpg','jpeg','png','gif','pdf','doc','docx','xls','csv','mov','mp3','mpeg','avi');
	$name=date('Y_m_d_').rand(1000,100000);
	
	$file_upload=$filter->file_upload($_FILES['courseware_file'],'1000000','../views/courseware/',$array_list,$name);
	

	if(($file_upload[0]=='1')){
	
	$insert_array=array('staff_id'=>$_POST['staffid'],'date'=>$date,'course_title'=>$_POST['courseware_title'],'course_description'=>$_POST['courseware_description'],'level'=>$_POST['courseware_level'],'path'=>substr($file_upload[1],9),'status'=>'1');
	
	echo $insert=$crud->dbinsert('courseware',$insert_array);	
	}
	else{
	echo $file_upload[0];	
	}

}


if($_POST['classroom_title']){
$classroom_title = filter_var($_POST['classroom_title'], FILTER_SANITIZE_STRING);
$classroom_description = filter_var($_POST['classroom_description'], FILTER_SANITIZE_STRING);
$date=date('Y-m-d h:i:A');

require_once('../models/CrudModel.php');
$crud=new Crud;
$forminsertarray=array('classroom_title'=>$classroom_title,'classroom_description'=>$classroom_description,'classroom_type'=>$_POST['classroom_type'],'staff_id'=>$_POST['staffid'],'status'=>'1','date'=>$date);

echo $insert=$crud->dbinsert('classroom',$forminsertarray);


//require_once('../models/FilterModel.php');
/*
$filter = new filterModel;
$array_list=array('jpg','jpeg','png','gif','pdf','doc','docx','xls','csv','mov','mp3','mpeg','avi');
$name=date('Y_m_d_').rand(1000,100000);
$name2=date('Y_m_d_').rand(1000,100000);
$name3=date('Y_m_d_').rand(1000,100000);
$file_upload1=$filter->file_upload($_FILES['classroom_file1'],'1000000','../views/courseware/',$array_list,$name);
$file_upload2=$filter->file_upload($_FILES['classroom_file1'],'1000000','../views/courseware/',$array_list,$name2);
$file_upload3=$filter->file_upload($_FILES['classroom_file1'],'1000000','../views/courseware/',$array_list,$name2);
$file_upload1[0] = '1';

if(($file_upload1[0]=='1')||($file_upload2[0]=='1')||($file_upload3[0]=='1')){

}
*/

}

///////////DO A SIGNIN USING ANGULAR JS
if($_GET['registersendsms']){

  require_once('../models/CrudModel.php');
   require_once('../models/MiscModel.php');
  $crud=new Crud;
  $misc=new miscModel;
	$activate_code=rand(1000,10000000);
	$email=$_GET['email'];
	$table=$_GET['register_type'];
	$first_zero=substr($_GET['registersendsms'],0,1);
	if($first_zero=='0'){
	$number=substr($_GET['registersendsms'],1);	
	$phone='+234'.$number;
	}
	else{
	$phone='+'.str_replace(' ','',$number=$_GET['registersendsms']);	
	}
	//$phone=$number;
	///// IF THE USER CHANGED PHONE NUMBER CHECK IF THE NUMBER ALREADY EXIST////
	if($_GET['change_phone']=='1'){
	
	$check=$crud->dbselect($table,'*',"phone_number='".$phone."'",'');	
	if($check[2]>0){
	echo $return['msg']='Sorry Phone Number already exist! Please try again';
	exit;
	}
	}
	
	$update_array=array('activation_code'=>$activate_code,'phone_number'=>$phone);
	
	$update=$crud->dbupdate($table,$update_array,"email='".$email."'");	

 	///////////SMS AND EMAIL API STARTS//////
	require('smsandemail.php');
	$smsandemail=new smsandemail;
	$sms_message="CollegeMobile activation code is ".$activate_code;
	
	////////////////SEND SMS PLUGIN/////////
	$sms=$smsandemail->smsmessage($phone,$sms_message,"Jaraja");
	$mail=$smsandemail->emailing($email,$sms_message,"CollegeMobile","Welcome To College Mobile");
	
	///session_start();
	//$_SESSION['stage3']=array('phone'=>$phone,'email'=>$email);
	
	print_r($mail);
	print_r($sms);	

}

///////////UPLOAD PASSPORT
if($_FILES['profile_photo']){
	print_r('yesss');
	require_once('../models/CrudModel.php');
	require_once('../models/FilterModel.php');
	$crud=new Crud;
	$filter = new filterModel;
	$name=date('Y_m_d_').rand(1000,100000);
	$array_list=array('jpg','png','JPEG','jpeg');
	$file_upload=$filter->file_upload($_FILES['profile_photo'],'10000000','../views/images/avater/',$array_list,$name);	
	
	if($file_upload[0]=='1'){
	$wheretoselect="phone_number='".$_POST['phone']."'AND email='".$_POST['email']."'"; 
	$formeditarray=array('photo'=>substr($file_upload[1],16));   
	$query=$crud->dbupdate($_POST['table'],$formeditarray,$wheretoselect);
	session_start();
	$_SESSION['accessLogin']['avater']=substr($file_upload[1],16);
	echo $return['msg']=$query;
	}
	else{
	echo $return['msg']=$file_upload[0];	
	}
	//print_r($file_upload);
	return $file_upload;
	}

;?>
