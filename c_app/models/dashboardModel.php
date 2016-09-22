<?php 
error_reporting(1);

ini_set('display_errors',1);

    require_once('CrudModel.php');
    require_once('FilterModel.php');

    $crud=new Crud;

    class dashboardModel{
    var $crud;

	public function snipets(){
		
	$this->crud=new Crud; 
	$return['checkrequest']=$this->crud->dbselect("friend_requests",'*',"request_to ='".$_SESSION['accessLogin']['user_id']."' AND status=0",'');	
	
	return $return;
	
	}
	
	public function library(){
	//$this->crud=new Crud; 
	
	///////////CREATING A NEW COUSEWARE
	if($_POST['courseware_title']){
	$date=date('Y-m-d h:i:A');
	
	  require_once('c_app/models/CrudModel.php');
	  $crud=new Crud;

	require_once('c_app/models/FilterModel.php');
	$filter = new filterModel;

	$array_list=array('jpg','jpeg','png','gif','pdf','doc','docx','xls','csv','mov','mp3','mpeg','avi','txt','html','zip','rar');
	$name=date('Y_m_d_').rand(1000,100000);
	$name2='banner_'.date('Y_m_d_').rand(1000,100000);
	$banner_array_list=array('jpg','jpeg','png');
        
	///////SET UP A REPLACE ARRAY LIST    
	$replace_array=array(",","'","`",";"," ","!","-","--","â€™","/","#","@","%","&","*","^","’","_","!","",":",">","<",",",".","}","{","=");  
        
	if($_FILES['courseware_file']['name']!=''){
	$file_upload=$filter->file_upload($_FILES['courseware_file'],'10000000','c_app/views/courseware/',$array_list,$name);
	$banner_upload=$filter->file_upload($_FILES['bannerimage_file'],'1000000','c_app/views/courseware/',$banner_array_list,$name2);
	}
	//$file_upload[0]='1';
	if(($file_upload[0]=='1')||($_FILES['courseware_file']['name']=='')){
	//////////IF THE REQUEST IS AN EDIT REQUEST///
	if(isset($_GET['edit'])){
	$update_array=array('course_title'=>$_POST['courseware_title'],'course_description'=>$_POST['courseware_description'],'course_duration'=>$_POST['courseware_duration'],'course_outline'=>$_POST['courseware_outline'],'catalogue_id'=>$_POST['courseware_catalogue'],'skillset_id'=>$_POST['courseware_skillset'],'classroom_id'=>$_POST['courseware_classroom'],'level'=>$_POST['courseware_level'],'url'=>str_replace($replace_array,'-',$_POTS['courseware_title']));
	
	if($_FILES['courseware_file']['name']!=''){
	$columnarray=array('path'=>substr($file_upload[1],12),'banner'=>substr($banner_upload[1],12));	
	$update_array=array_merge($update_array,$columnarray); 	
	}
	$return['msg']=$update=$crud->dbupdate('courseware',$update_array,"courseware_id='".$_GET['edit']."' AND staff_id='".$_SESSION['accessLogin']['user_id']."'");
	}else{
		file_put_contents(__DIR__ . '../logs/storage.log', 'Exectued!');
	$insert_array=array('staff_id'=>$_SESSION['accessLogin']['user_id'],'date'=>$date,'course_title'=>$_POST['courseware_title'],'course_description'=>$_POST['courseware_description'],'course_duration'=>$_POST['courseware_duration'],'course_outline'=>$_POST['courseware_outline'],'catalogue_id'=>$_POST['courseware_catalogue'],'skillset_id'=>$_POST['courseware_skillset'],'classroom_id'=>$_POST['courseware_classroom'],'level'=>$_POST['courseware_level'],'path'=>substr($file_upload[1],12),'banner'=>substr($banner_upload[1],12),'status'=>'1','url'=>str_replace($replace_array,'-',$_POTS['courseware_title']));
	$return['msg']=$insert=$crud->dbinsert('courseware',$insert_array);
	
	/* INSERTING INTO THE FEEDS TABLE */
	$insert_array2=array('user_id'=>$_SESSION['accessLogin']['user_id'],'date'=>date('Y-m-d'),'time'=>$date,'activity_type'=>'courseware','activity_type_id'=>mysql_insert_id(),'status'=>'1');
	
	$return['msg']=$insert=$crud->dbinsert('feeds',$insert_array2);
	}
	
	
	if($return['msg']=='DATA INSERTED SUCCESSFULLY!'){
	if($return['msg']=='1'){
	$return['msg']='Courseware updated successfully!';
	}else{	
	$return['msg']='New courseware created successfully!';
	}
	}
	
	
	}
	else{
	$return['msg']=$file_upload[0];	
	}

	}
	
	if(isset($_GET['edit'])){
	$return['library']=$this->crud->dbselect("courseware",'*',"courseware_id ='".$_GET['edit']."' AND staff_id='".$_SESSION['accessLogin']['user_id']."'",'');
	}elseif(isset($_GET['view'])){
		
		
	$return['library']=$this->crud->dbselect("courseware",'*',"courseware_id ='".$_GET['view']."' AND status='1'",'');
	
	/*UPDATING THE COURSEVIEW COUNTER */
	
	echo $update=mysql_query("UPDATE courseware SET view_counter = view_counter+1 WHERE courseware_id ='".$_GET['view']."'");
	/* INSERTING INTO THE FEEDS TABLE */
	$insert_array2=array('user_id'=>$_SESSION['accessLogin']['user_id'],'date'=>date('Y-m-d'),'time'=>date("H:i:s A"),'activity_type'=>'view@courseware','activity_type_id'=>$_GET['view'],'status'=>'1');
	
	///UNCOMMENT THIS LATER////
	//$return['msg']=$insert=$this->crud->dbinsert('feeds',$insert_array2);

		
	}
	return $return;   
	}
	
	public function courseware(){
	$this->crud=new Crud; 
	
	///////////CREATING A NEW COUSEWARE
	if($_POST['courseware_title']){
	$date=date('Y-m-d h:i:A');
	
	  require_once('c_app/models/CrudModel.php');
	  $crud=new Crud;

	require_once('c_app/models/FilterModel.php');
	$filter = new filterModel;

	$array_list=array('jpg','jpeg','png','gif','pdf','doc','docx','xls','csv','mov','mp3','mpeg','avi','txt','html','zip','rar');
	$name=date('Y_m_d_').rand(1000,100000);
	$name2='banner_'.date('Y_m_d_').rand(1000,100000);
	$banner_array_list=array('jpg','jpeg','png');
	
	if($_FILES['courseware_file']['name']!=''){
	$file_upload=$filter->file_upload($_FILES['courseware_file'],'10000000','c_app/views/courseware/',$array_list,$name);
	$banner_upload=$filter->file_upload($_FILES['bannerimage_file'],'1000000','c_app/views/courseware/',$banner_array_list,$name2);
	}
	//$file_upload[0]='1';
	if(($file_upload[0]=='1')||($_FILES['courseware_file']['name']=='')){
	//////////IF THE REQUEST IS AN EDIT REQUEST///
	if(isset($_GET['edit'])){
	$update_array=array('course_title'=>$_POST['courseware_title'],'course_description'=>$_POST['courseware_description'],'catalogue_id'=>$_POST['courseware_catalogue'],'skillset_id'=>$_POST['courseware_skillset'],'classroom_id'=>$_POST['courseware_classroom'],'level'=>$_POST['courseware_level']);
	
	if($_FILES['courseware_file']['name']!=''){
	$columnarray=array('path'=>substr($file_upload[1],12),'banner'=>substr($banner_upload[1],12));	
	$update_array=array_merge($update_array,$columnarray); 	
	}
	$return['msg']=$update=$crud->dbupdate('courseware',$update_array,"courseware_id='".$_GET['edit']."' AND staff_id='".$_SESSION['accessLogin']['user_id']."'");
	}else{
	$insert_array=array('staff_id'=>$_SESSION['accessLogin']['user_id'],'date'=>$date,'course_title'=>$_POST['courseware_title'],'course_description'=>$_POST['courseware_description'],'course_duration'=>$_POST['courseware_duration'],'course_outline'=>$_POST['courseware_outline'],'catalogue_id'=>$_POST['courseware_catalogue'],'skillset_id'=>$_POST['courseware_skillset'],'classroom_id'=>$_POST['courseware_classroom'],'level'=>$_POST['courseware_level'],'path'=>substr($file_upload[1],12),'banner'=>substr($banner_upload[1],12),'status'=>'1');
	$return['msg']=$insert=$crud->dbinsert('courseware',$insert_array);
	echo $return['msg'];
	/* INSERTING INTO THE FEEDS TABLE */
	$insert_array2=array('user_id'=>$_SESSION['accessLogin']['user_id'],'date'=>date('Y-m-d'),'time'=>$date,'activity_type'=>'courseware','activity_type_id'=>mysql_insert_id(),'status'=>'1');
	
	$return['msg']=$insert=$crud->dbinsert('feeds',$insert_array2);
	}
	
	
	if($return['msg']=='DATA INSERTED SUCCESSFULLY!'){
	if($return['msg']=='1'){
	$return['msg']='Courseware updated successfully!';
	}else{	
	$return['msg']='New Courseware created successfully!';
	}
	}
	
	
	}
	else{
	$return['msg']=$file_upload[0];	
	}

	}
	
	if(isset($_GET['edit'])){
	$return['library']=$this->crud->dbselect("courseware",'*',"courseware_id ='".$_GET['edit']."' AND staff_id='".$_SESSION['accessLogin']['user_id']."'",'');
	}elseif(isset($_GET['view'])){
	$return['library']=$this->crud->dbselect("courseware",'*',"courseware_id ='".$_GET['view']."' AND status='1'",'');
	
	
	/*UPDATING THE COURSEVIEW COUNTER if THE USER HAVENT VIEW THIS COURSE BEFORE */
	if($_SESSION['viewcount']!=$_GET['view']){
	$update=mysql_query("UPDATE courseware SET view_counter = view_counter+1 WHERE courseware_id ='".$_GET['view']."'");
	
	
	session_start();
	$_SESSION['viewcount']=$_GET['view'];
	}
	
	

	/* INSERTING INTO THE FEEDS TABLE */
	$insert_array2=array('user_id'=>$_SESSION['accessLogin']['user_id'],'date'=>date('Y-m-d'),'time'=>date("H:i:s A"),'activity_type'=>'view@courseware','activity_type_id'=>$_GET['view'],'status'=>'1');
	
	///UNCOMMENT THIS LATER////
	//$return['msg']=$insert=$this->crud->dbinsert('feeds',$insert_array2);

		
	}else{
	$return['library']=$this->crud->paginate("courseware",'library','10',"status!=0  AND staff_id!='".$_SESSION['accessLogin']['user_id']."'",'ORDER by courseware_id DESC');
	
	$return['mylibrary']=$this->crud->paginate('courseware','mycourseware','10',"status!=0 AND staff_id='".$_SESSION['accessLogin']['user_id']."'ORDER BY courseware_id DESC");
	}
	return $return;   
	}


	public function classroom(){
	$this->crud=new Crud; 
	if($_POST['classroom_title']){
	$classroom_title = filter_var($_POST['classroom_title'], FILTER_SANITIZE_STRING);
$classroom_description = filter_var($_POST['classroom_description'], FILTER_SANITIZE_STRING);
$date=date('Y-m-d h:i:A');

require_once('c_app/models/CrudModel.php');
$crud=new Crud;
$forminsertarray=array('classroom_title'=>$classroom_title,'classroom_description'=>$classroom_description,'classroom_type'=>$_POST['classroom_type'],'classroom_level'=>$_POST['classroom_level'],'classroom_skillset'=>$_POST['classroom_skillset'],'staff_id'=>$_SESSION['accessLogin']['user_id'],'status'=>'1','date'=>$date);

	if(isset($_GET['edit'])){
	$formeditarray=array('classroom_title'=>$classroom_title,'classroom_description'=>$classroom_description,'classroom_type'=>$_POST['classroom_type'],'classroom_level'=>$_POST['classroom_level'],'classroom_skillset'=>$_POST['classroom_skillset']);
	$return['msg']=$update=$crud->dbupdate('classroom',$forminsertarray,"classroom_id='".$_GET['edit']."' AND staff_id='".$_SESSION['accessLogin']['user_id']."'");	
	}
	else{
	$return['msg']=$insert=$crud->dbinsert('classroom',$forminsertarray);
	
	/* INSERTING INTO THE FEEDS TABLE */
	$insert_array2=array('user_id'=>$_SESSION['accessLogin']['user_id'],'date'=>date('Y-m-d'),'time'=>$date,'activity_type'=>'classroom','activity_type_id'=>mysql_insert_id(),'status'=>'1');
	
	$return['msg']=$insert=$crud->dbinsert('feeds',$insert_array2);

	}
	
	if($return['msg']=='DATA INSERTED SUCCESSFULLY!'){
	if(isset($_GET['edit'])){
	$return['msg']='Classroom updated successfully!';	
	}else{
	$return['msg']='New Classroom created successfully!';
	}
	}
	
	}
	
	///////////DELETING  A CLASSROOM
	if(isset($_GET['delete'])){
	$delete=$this->crud->dbdelete('classroom',"classroom_id='".$_GET['delete']."' AND staff_id='".$_SESSION['accessLogin']['user_id']."'");	
	die(header('location:../teach/classroom'));
	}
	//////////// JOINING A CLASSROOM
	if(isset($_GET['join'])){
	$insert_array=array('classroom_id'=>$_GET['join'],'student_id'=>$_SESSION['accessLogin']['user_id'],'date_added'=>date('Y-m-d h:i:s A'),'status'=>'1');
		
	$insert=$this->crud->dbinsert('classroom_users',$insert_array);	
	
		/* INSERTING INTO THE FEEDS TABLE */
	$insert_array2=array('user_id'=>$_SESSION['accessLogin']['user_id'],'date'=>date('Y-m-d'),'time'=>date("H:i:s A"),'activity_type'=>'join@classroom_users','activity_type_id'=>$_GET['join'],'status'=>'1');
	
	$return['msg']=$insert=$this->crud->dbinsert('feeds',$insert_array2);
	return $return;
	}
	////////////LEAVING A CLASSROOM
	if(isset($_GET['leave'])){
	$delete=$this->crud->dbdelete('classroom_users',"classroom_id='".$_GET['leave']."' AND student_id='".$_SESSION['accessLogin']['user_id']."'");	
	
	$insert_array2=array('user_id'=>$_SESSION['accessLogin']['user_id'],'date'=>date('Y-m-d'),'time'=>date("H:i:s A"),'activity_type'=>'leave@classroom_users','activity_type_id'=>$_GET['leave'],'status'=>'1');
	
	$return['msg']=$insert=$this->crud->dbinsert('feeds',$insert_array2);
	return $return;
	}
	
	
	///////////EDITING A CLASSROOM
	if(isset($_GET['edit'])){
	$return['classroom']=$this->crud->dbselect("classroom",'*',"classroom_id ='".$_GET['edit']."' AND staff_id='".$_SESSION['accessLogin']['user_id']."'",'');	
	}
	elseif(isset($_GET['view'])){
	$return['classroom']=$this->crud->dbselect("classroom",'*',"classroom_id ='".$_GET['view']."' AND status='1'",'');		
	}else{
	$return['classroom']=$this->crud->paginate("classroom",'classroom','10',"status!=0 AND staff_id!='".$_SESSION['accessLogin']['user_id']."'",'ORDER by classroom_id DESC');
	
	$return['myclassroom']=$this->crud->paginate('classroom','myclassroom','10',"status!=0 AND staff_id='".$_SESSION['accessLogin']['user_id']."'");
	
	
	}
		
	return $return;   
	}
	
	public function feeds(){
	
	$return['activities']=mysql_query("SELECT * FROM feeds WHERE activity_type='classroom' OR activity_type='courseware' AND status!=0 ORDER BY feeds_id DESC")or die(mysql_error());	
	
	
	$return['join_leave_view']=mysql_query("SELECT * FROM feeds WHERE activity_type='join@classroom_users' OR activity_type='leave@classroom_users' OR activity_type='view@courseware' AND status!=0 ORDER BY feeds_id DESC")or die(mysql_error());	
	
	
	return $return;   
	}

	
	public function pin(){
	$this->crud=new Crud; 
		
	//////////// PINNING A CLASSROOM
	if(isset($_GET['pin'])){
		
	$insert_array=array('table_id'=>$_GET['pin'],'user_id'=>$_SESSION['accessLogin']['user_id'],'date'=>date('Y-m-d h:i:s A'),'status'=>'1','table_name'=>$_GET['table']);
		
	$return['msg']=$this->crud->dbinsert('pin',$insert_array);	
	
	//header("location:".$dirlocation. parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
	//return $return;
	}
	
	//////////// UNPINNING A CLASSROOM
	if(isset($_GET['unpin'])){
	$where="pin_id='".$_GET['unpin']."' AND table_name='".$_GET['table']."' AND user_id='".$_SESSION['accessLogin']['user_id']."'";
		
	$return['msg']=$this->crud->dbdelete('pin',$where);	
	
	//header("location:".$dirlocation. parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
	//return $return;
	}
	
		
	$return['pin']=mysql_query("SELECT * FROM pin WHERE status!=0 ORDER BY pin_id DESC")or die(mysql_error());	
	
	
	return $return;   
	}


	public function like(){
	$this->crud=new Crud; 
		
	//////////// PINNING A CLASSROOM
	if(isset($_GET['like'])){
		
	$insert_array=array('table_id'=>$_GET['like'],'user_id'=>$_SESSION['accessLogin']['user_id'],'date'=>date('Y-m-d h:i:s A'),'status'=>'1','table_name'=>$_GET['table']);
		
	$return['msg']=$this->crud->dbinsert('liked',$insert_array);	
	
	//header("location:".$dirlocation. parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
	//return $return;
	}
	
	//////////// UNPINNING A CLASSROOM
	if(isset($_GET['dislike'])){
	$where="like_id='".$_GET['dislike']."' AND table_name='".$_GET['table']."' AND user_id='".$_SESSION['accessLogin']['user_id']."'";
		
	$return['msg']=$this->crud->dbdelete('liked',$where);	
	
	//header("location:".$dirlocation. parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
	//return $return;
	}
	
	
	return $return;   
	}

	public function follow(){
	$this->crud=new Crud; 
		
	//////////// PINNING A CLASSROOM
	if(isset($_GET['follow'])){
	
	$insert_array=array('leader_id'=>$_GET['follow'],'follower_id'=>$_SESSION['accessLogin']['user_id'],'date'=>date('Y-m-d h:i:s A'),'status'=>'1');
		
	$return['msg']=$this->crud->dbinsert('follow',$insert_array);	
	
	//header("location:".$dirlocation. parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
	//return $return;
	}
	
	//////////// UNPINNING A CLASSROOM
	if(isset($_GET['unfollow'])){
	$where="follow_id='".$_GET['unfollow']."' AND follower_id='".$_SESSION['accessLogin']['user_id']."'";
		
	$return['msg']=$this->crud->dbdelete('follow',$where);	
	
	//header("location:".$dirlocation. parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
	//return $return;
	}
	
	//$return['followers']=$this->crud->dbselect('follow','*',"status!=0",'');
        
    $return['followers']=$this->crud->dbselect("follow",'*',"leader_id='".$_SESSION['accessLogin']['user_id']."'AND status=1",'ORDER by follow_id DESC');
        
    if(isset($_GET['follower_id'])){
   
    $followerid=mysql_real_escape_string($_GET['follower_id']);    
    $return['follower_profile']=$this->crud->dbselect('student','*',"rand='".$followerid."'","");
    if($return['follower_profile'][2]==0){
    $return['follower_profile']=$this->crud->dbselect('teacher','*',"rand='".$followerid."'","");   
    }
        
    //print_r($return['follower_profile']);    
    }
        
	return $return;   
	}
	
	public function delete(){
	$this->crud=new Crud; 

	//////////// DELETING A COURSEWARE OR CLASSROOM
	if(isset($_GET['delete'])){

	$where=$_GET['table']."_id='".$_GET['delete']."' AND staff_id='".$_SESSION['accessLogin']['user_id']."'";
		
	$return['msg']=$this->crud->dbdelete($_GET['table'],$where);
		
	header("location:".$dirlocation. parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
	}
	
	
	return $return;   
	}


	public function profile(){
	$this->crud=new Crud; 
	if(isset($_GET['profileid'])){
	$profileid=filter_var($_GET['profileid'], FILTER_SANITIZE_STRING);	
	}
	else{
	$profileid=	$_SESSION['accessLogin']['user_id'];
	}
	////////////GET THE USER LOGIN PROFILE////
	if(isset($_POST['full_name'])){
	$fullname=filter_var($_POST['full_name'], FILTER_SANITIZE_STRING);		
	$emailaddress=filter_var($_POST['email'], FILTER_SANITIZE_STRING);
	$about=filter_var($_POST['about'], FILTER_SANITIZE_STRING);
	$regnumber=filter_var($_POST['regnumber'], FILTER_SANITIZE_STRING);
	$staffid=filter_var($_POST['staffid'], FILTER_SANITIZE_STRING);
	$school=filter_var($_POST['school'], FILTER_SANITIZE_STRING);
	$department=filter_var($_POST['department'], FILTER_SANITIZE_STRING);
	$level=filter_var($_POST['level'], FILTER_SANITIZE_STRING);	
	if($_SESSION['accessLogin']['account_type']=='student'){
	$formeditarray=array('full_name'=>$fullname,'email'=>$emailaddress,'about_me'=>$about,'reg_number'=>$regnumber,'school'=>$school,'department'=>$department,'level'=>$level);
	$update=$this->crud->dbupdate('student',$formeditarray,"rand='".$_SESSION['accessLogin']['user_id']."'");
	}
	elseif($_SESSION['accessLogin']['account_type']=='lecturer'){
	$formeditarray=array('full_name'=>$fullname,'email'=>$emailaddress,'about_me'=>$about,'staff_id'=>$staffid,'school'=>$school,'department'=>$department);
	$update=$this->crud->dbupdate('lecturer',$formeditarray,"rand='".$_SESSION['accessLogin']['user_id']."'");
	}
	
    elseif($_SESSION['accessLogin']['account_type']=='contentprovider'){
	$formeditarray=array('full_name'=>$fullname,'email'=>$emailaddress,'website'=>$_POST['website'],'about_me'=>$about);
	$update=$this->crud->dbupdate('contentprovider',$formeditarray,"rand='".$_SESSION['accessLogin']['user_id']."'");
	}
        
	if($update=='1'){
	$return['msg']="Profile Details updated successfully!";	
	
	//////////UPDATE THE SESSION DETAILS///////////
	session_start();
	$_SESSION['accessLogin']['full_name']=$fullname;
	$_SESSION['accessLogin']['email']=$emailaddress;
	
	}else{
	$return['msg']=$update;
	}
	
		//print_r($return['msg']);exit;

	}
	
	$return['profile']=$this->crud->dbselect('lecturer','*',"rand='".$profileid."'","");
	if($return['profile'][2]==0){
	$return['profile']=$this->crud->dbselect('student','*',"rand='".$profileid."'","");
	
	if($return['profile'][2]==0){
	$return['profile']=$this->crud->dbselect('contentprovider','*',"rand='".$profileid."'","");	
	
	$return['viewcounters']=$this->crud->dbselect('courseware','SUM(view_counter) as total',"staff_id='".$profileid."'","");	
	
	$return['profile_type']='contentprovider';	
	}
		
	}
	
	$return['clip']=$this->crud->dbselect('pin','*',"user_id='".$profileid."' ORDER BY pin_id DESC","");
	$return['myactivities']=$this->crud->dbselect('feeds','*',"activity_type='classroom' AND user_id='".$profileid."' AND status!=0 OR activity_type='courseware' AND user_id='".$profileid."' AND status!=0 ORDER BY feeds_id DESC","");
	
	$return['join_view']=mysql_query("SELECT * FROM feeds WHERE activity_type='join@classroom_users' AND user_id='".$profileid."' AND status!=0 OR activity_type='view@courseware' AND user_id='".$profileid."' AND status!=0 ORDER BY feeds_id DESC")or die(mysql_error());
	
	return $return;   
	}


	public function search(){
	$this->crud=new Crud; 	
	if(isset($_GET['SearchKeyword'])){
	$SearchKeyword=filter_var($_GET['SearchKeyword'], FILTER_SANITIZE_STRING);	
	$search = explode(' ', $SearchKeyword);
    $searchResults = 'LIKE ';
	$query="?SearchKeyword=".$SearchKeyword.'&table='.$_GET['table'];
	
	if($_GET['table']=='courseware'){
	$column='course';	
	}
	else{
	$column='classroom';	
	}
	
	///// IF THE USER SET A CATEGORY CRITERAIA////
	if(($_GET['searchCategory']!='')&&($_GET['searchCategory']!='0')){
	$category_id=$_GET['searchCategory'];	
	$searchcategoryquery="AND catalogue_id=".$category_id;
	}
	
	//////IF THE USER SETA SKILLSET CRITERIA////
	if(($_GET['searchSkillset']!='')&&($_GET['searchSkillset']!='0')){
	$skillset_id=$_GET['searchSkillset'];
	$searchskillsetquery="AND skillset_id=".$skillset_id;	
	}
	

    foreach ($search as $id => $word) {
        $searchResults .= "'%" . $word . "%'";
        $searchResults .= " OR ".$column."_title LIKE ";
    }
    $searchResults = rtrim($searchResults,"OR ".$column."_title LIKE ");
	
	return $this->crud->paginate($_GET['table'],$query,'10',$column."_title"." {$searchResults}".$searchcategoryquery.$searchskillsetquery,'ORDER by '.$_GET['table'].'_id DESC');
	
	}
	
	
	}
	
	
	public function searchglobal(){
	echo $_GET['SearchKeyword'];
	exit;	
		
	}
	
	
	public function community(){
	$return['profile']=$profile=$this->profile();
	$return['people_you_may_know']=$this->crud->dbselect($_SESSION['accessLogin']['account_type'],'*', "rand!='".$_SESSION['accessLogin']['user_id']."' AND school='".$profile['profile'][0]['school']."' OR department='".$profile['profile'][0]['department']."'",'');
	
	$return['friends']=$this->crud->dbselect("friend_requests",'*',"request_to='".$_SESSION['accessLogin']['user_id']."'AND status=1 OR request_from ='".$_SESSION['accessLogin']['user_id']."' AND status=1",'ORDER by id DESC');
	
	$return['classmates']=$this->crud->dbselect("student",'*',"rand!='".$_SESSION['accessLogin']['user_id']."' AND  school='".$profile['profile'][0]['school']."' AND department='".$profile['profile'][0]['department']."' AND level='".$profile['profile'][0]['level']."'ORDER BY STUDENTID DESC",'');
	
	if(isset($_GET['sendrequestto'])){
	$sendrequestto=str_replace(' ','',filter_var($_GET['sendrequestto'], FILTER_SANITIZE_STRING));
	$insert_array=array('request_to'=>$sendrequestto,'request_from'=>$_SESSION['accessLogin']['user_id'],'date'=>date('Y-m-d H:i:s A'));

	$insert=$this->crud->dbinsert('friend_requests',$insert_array);	
	header('location:../learn/community');
	}
	
	if(isset($_GET['confirmrequestfrom'])){
	$confirmrequestfrom=filter_var($_GET['confirmrequestfrom'], FILTER_SANITIZE_STRING);
	$updatearray=array('status'=>'1');
	$udpate=$this->crud->dbupdate('friend_requests',$updatearray,"request_to='".$_SESSION['accessLogin']['user_id']."' AND request_from='".$confirmrequestfrom."'");
	header('location:../learn/community');	
	}
	
	
	
	return $return;	
	}
	
    
    public function checkcontent($url){
    $this->crud=new Crud; 	  
    
    $return['content']=$this->crud->dbselect("courseware","*","url='".mysql_real_escape_string($url)."'",""); 
    
   
    return $return;    
    }

        
	
}
    
?>