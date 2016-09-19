<?php
require_once('MiscModel.php');

class filterModel extends miscModel{

public function LoginFilter(){
$array=array('access_uname','access_pwrd');
//////////////////////CHECK EMPTY
$check_empty=parent::emptycheck($array);
if($check_empty==FALSE){
$return['msg']='SORRY! Empty field(s) not allowed. Please try again';	
}
elseif(!ctype_alnum(parent::value_prep($_POST['access_pwrd']))){
$return['msg']='SORRY! Invalid password, Special characters not supported.';	
}
else{		
$return = array();
$return['password']=parent::value_prep($_POST['access_pwrd']);	
$return['username']=parent::value_prep($_POST['access_uname']);	
}
return $return;
}
    
 ////////////EDIT NEWS
public function editnews(){

$array=array('newsHeadline','news_details');	
$check_empty=parent::emptycheck($array);
//$crud=new crudModel;
if($check_empty==FALSE){
$return['msg']='You did not complete all of the required fields before submitting this form. Please try again.';	
}
elseif($_POST['news_menu']==0){
$return['msg']='You did not specify News category. Please try again.';	    
}
elseif($_POST['news_option']==0){
$return['msg']='You did not specify News option. Please try again.';	    
}
/*elseif (filter_var($_POST['news_video_path'], FILTER_VALIDATE_URL) == false) {
$return['msg']=$_POST['news_video_path'].'is not a valid URL';
}    
*/  
  
else{

$return = array();
$return['newsHeadline']=parent::value_prep($_POST['newsHeadline']);
$return['news_details']=$_POST['news_details'];
$return['news_menu']=$_POST['news_menu']; 
$return['sub_news_menu']=$_POST['sub_news_menu']; 
$return['newsOption']=$_POST['news_option']; 
$return['news_video_path']=$_POST['news_video_path']; 
$return['news_author']=parent::value_prep($_POST['newsAuthor']); 
    
}
return $return;
	


}
       

 ////////////EDIT NEWS
public function editpages(){
$array=array('page_title','pageUrl');	
$check_empty=parent::emptycheck($array);
//$crud=new crudModel;
if($check_empty==FALSE){
$return['msg']='You did not complete all of the required fields before submitting this form. Please try again.';	
}
elseif($_POST['page_type']==0){
$return['msg']='You did not specify Page Type. Please try again.';	    
}
  
else{

$return = array();
$return['pageTitle']=parent::value_prep($_POST['page_title']);
$return['pageUrl']=parent::value_prep($_POST['pageUrl']);
$return['pageType']=$_POST['page_type']; 
    
}
return $return;
	


}
       


    
///////////EDIT ADVERT DETAILS
public function editadvert(){

$array=array('advert_title','short_description','contact_phone','contact_email');	
$check_empty=parent::emptycheck($array);
//$crud=new crudModel;
if($check_empty==FALSE){
$return['msg']='You did not complete all of the required fields before submitting this form. Please try again.';	
}
elseif($_POST['advert_settings']==0){
$return['msg']='You did not specify News category. Please try again.';	    
}
   
elseif($_FILES['advert_imageFile']['name']==''){
$return['msg']='No image file attached. Please try again.';	    
}
elseif(parent::value_email($_POST['contact_email'])=='1'){
$return['msg']='Invalid Email Address! Please try again.';    
}

else{
    
$return = array();
$return['advert_title']=parent::value_prep($_POST['advert_title']);
$return['contact_phone']=parent::value_prep($_POST['contact_phone']);  
$return['contact_email']=parent::value_prep($_POST['contact_email']);   
$return['short_description']=$_POST['short_description'];
 
    
}
return $return;
	


}    
    
///////////EDIT ADMIN USERS DETAILS
public function editadminUsers(){
//echo  $pass=parent::value_email($_POST['admin_email']);exit;
$array=array('admin_f_name','admin_l_name','admin_email','admin_phone','admin_uname','admin_pass');	
$check_empty=parent::emptycheck($array);
//$crud=new crudModel;
if($check_empty==FALSE){
$return['msg']='You did not complete all of the required fields before submitting this form. Please try again.';	
}
elseif(parent::value_email($_POST['admin_email'])=='1'){
$return['msg']='Invalid Email Address! Please try again.';    
} 

else{
    
$return = array();
$return['admin_f_name']=parent::value_prep($_POST['admin_f_name']);
$return['admin_l_name']=parent::value_prep($_POST['admin_l_name']);  
$return['admin_phone']=parent::value_prep($_POST['admin_phone']); 
$return['admin_email']=parent::value_prep($_POST['admin_email']);     
$return['admin_uname']=parent::value_prep($_POST['admin_uname']);
$return['admin_pass']=parent::encodeValue($_POST['admin_pass'],'');    
}
return $return;
	


}  
    
    
/////////////////////SEARCH FILTER
public function searchFilter(){
$array=array('kwordsearch');

//////////////////////CHECK EMPTY
$check_empty=parent::emptycheck($array);

if($check_empty==FALSE){
$return['msg']='SORRY! Empty field(s) not allowed. Please try again';	
}

else{		
$return = array();
$return['kwordsearch']=parent::value_prep($_POST['kwordsearch']);	
}
return $return;
	
}





///////////////////OLD FILTERS
public function newclient(){	
$array=array('cfname','clname','cphone','cstate','ccity','caddress','cuname','cpass','cemail','zip','country','compname');	
$check_empty=parent::emptycheck($array);
$crud=new crudModel;
//$where=;
$search=$crud->dbselect('client_login','*',"uname='".parent::value_prep($_POST['cuname'])."'",'');

if($check_empty==FALSE){
$return['msg2']='You did not complete all of the required fields before submitting this form. Please try again.';	
}
elseif(parent::value_email($_POST['cemail'])=='1'){
$return['msg2']='Sorry invalid email address';	
}
elseif($search[2]>0){
$return['msg2']='USERNAME ALREADY EXIST!';	
}
else{	
$rand=rand(1000,1000000);	
$return = array();
$return['rand']=$rand;
$return['fname']=parent::value_prep($_POST['cfname']);	
$return['lname']=parent::value_prep($_POST['clname']);	
$return['phone']=parent::value_prep($_POST['cphone']);	
$return['state']=parent::value_prep($_POST['cstate']);	
$return['city']=parent::value_prep($_POST['ccity']);
$return['email']=parent::value_prep($_POST['cemail']);	
$return['address']=parent::value_prep($_POST['caddress']);
$return['zip']=parent::value_prep($_POST['zip']);
$return['country']=parent::value_prep($_POST['country']);
$return['company']=parent::value_prep($_POST['compname']);

//$return2=array();
//$return['rand']=$rand;
$return['uname']=parent::value_prep($_POST['cuname']);
$return['pass']=parent::value_prep($_POST['cpass']);
$return['status']='0';
//$return['msg2']="Hello ".$return['uname'].'<br/>'."YOUR ACCOUNT HAVE BEEN CREATED. <br/>A link has been sent to your email box. Please click on the link to activate your account. <br/>Note: You might find the mail in your spam folder... THANKS";

}
return $return;
}

function changeemail(){
$array=array('email1','email2');
//////////////////////CHECK EMPTY
$check_empty=parent::emptycheck($array);

$crud=new crudModel;
//$where=;
$search=$crud->dbselect('clients','*',"email='".parent::value_prep($_POST['email1'])."' && rand='".$_SESSION['userid']."'",'');


if($check_empty==FALSE){
$return['msg']='Sorry field(s) cannot be empty!.';	
}
elseif($search[2]==0){$return['msg']='Sorry Old Email do not match!';}
elseif(parent::value_email($_POST['email2'])=='1'){
$return['msg']='Sorry invalid email address';	
}
else{
$return=array();
$return['email1']=parent::value_prep($_POST['email1']);	
$return['email2']=parent::value_prep($_POST['email2']);
}
return $return;
}

function changepass(){
$array=array('changepass1','changepass2','changepass3');
//////////////////////CHECK EMPTY
$check_empty=parent::emptycheck($array);

$crud=new crudModel;
//$where=;
$search=$crud->dbselect('client_login','*',"pass='".parent::value_prep($_POST['changepass1'])."' && rand='".$_SESSION['userid']."'",'');


if($check_empty==FALSE){
$return['msg']='Sorry field(s) cannot be empty! Please try again';	
}
elseif($search[2]==0){$return['msg']='Sorry Old Password do not match! Please try again';}
elseif(parent::value_prep($_POST['changepass2'])!=parent::value_prep($_POST['changepass3'])){
$return['msg']='New password do not match! Please try again';	
}
else{
$return=array();
$return['changepass3']=parent::value_prep($_POST['changepass3']);	
}
return $return;
}





public function profile(){
	
$array=array('cfname','clname','cphone','cstate','ccity','caddress');	
$check_empty=parent::emptycheck($array);
$crud=new crudModel;
//$where=;

if($check_empty==FALSE){
$return['msg2']='You did not complete all of the required fields before submitting this form. Please try again.';	
}
elseif(parent::value_number($_POST['cphone'])=='1'){
$return['msg2']='Sorry invalid phone number! Please try again';	
}
else{	
$return = array();
$return['fname']=parent::value_prep($_POST['cfname']);	
$return['lname']=parent::value_prep($_POST['clname']);	
$return['phone']=parent::value_prep($_POST['cphone']);	
$return['state']=parent::value_prep($_POST['cstate']);	
$return['city']=parent::value_prep($_POST['ccity']);
$return['address']=parent::value_prep($_POST['caddress']);

}
return $return;


}


public function newsSearch($keyword){

$return['keyword']=parent::value_prep($keyword);	
	
return $return;	
}





}



?>