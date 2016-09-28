<?php

session_start();
class profile extends Controller{

    var $url;
    var $dirlocation;
    var $landingPage;
	var $snipets;

    public function __construct($url, $dirlocation){

	require_once('c_app/models/dashboardModel.php');
    $dashboardModel=new dashboardModel;
		
		
	if(!isset($_SESSION['accessLogin'])){
	die(header('Location:login'));
	}
    


  		$this->url = $url;
  		$this->dirlocation = $dirlocation;
      	$this->landingPage[1] = 'landingpage';
		//$this->snipets=$dashboardModel->snipets();

  	}
	public function index(){
	require_once('c_app/models/dashboardModel.php');
    $dashboard=new dashboardModel;
	
	$profile=$dashboard->profile();	
	$this->view('profile',array('content'=>$this->url,'profile'=>$profile,'library'=>$allcourseware,)); 		
	}
	
	
    public function profile(){
	require_once('c_app/models/dashboardModel.php');
    $dashboard=new dashboardModel;
   	$pin=$dashboard->pin();
	$follow=$dashboard->follow();
    $allcourseware=$dashboard->courseware();    
	$profile=$dashboard->profile();
	$this->view('contentpartner/index',array('content'=>$this->url,'profile'=>$profile,'snipets'=>$this->snipets,'follow'=>$follow,'library'=>$allcourseware,)); 	
	}
    
	

	



}


?>
