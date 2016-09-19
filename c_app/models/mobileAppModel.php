<?php
require_once('CrudModel.php');
require_once('FilterModel.php');
$crud=new Crud;

class mobileAppModel extends filterModel{

	var $crud;



  	public function myclassroom(){
	$this->crud=new Crud;
	if(isset($_SESSION['accessLogin']['user_id'])){
	$id=$_SESSION['accessLogin']['user_id'];
	}else{
		
	$id = $_GET['staffid'];
	}
	$myclassroom=$this->crud->dbselect('classroom','*',"staff_id='".$id."' AND status='1'",'ORDER by classroom_id DESC');
	
	return $myclassroom;
	}


  	public function allcatalogue(){
	$this->crud=new Crud;
	$catalogue=$this->crud->dbselect('catalogue','*',"status!='0'",'ORDER by catalogue_id DESC');
	
	return $catalogue;
	}

	public function skillset(){
	$this->crud=new Crud;
	$skillset=$this->crud->dbselect('skillset','*',"status!='0'",'ORDER by skillset_id DESC');
	
	return $skillset;
	}

  	public function allcourseware(){
	$this->crud=new Crud;
	
	$courseware=$this->crud->paginate('courseware','courseware','30',"status='1'",'ORDER by course_ware_id DESC');
	
	//$return['allNews']=$this->crud->paginate("news",'allNews'.$query,'10',"id!=0",'ORDER by id DESC');
	
	return $courseware;
	}



public function staffclassroom(){
	$this->crud=new Crud;
	$id=$_GET['staffid'];
	$staffclassroom=$this->crud->dbselect('classroom','*',"staff_id='".$id."' AND status='1'",'ORDER by classroom_id DESC');
	
	return $staffclassroom;
	}	

}
;?>
