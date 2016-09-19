<?php

session_start();
class content extends Controller{

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


	//////////INDEX DETAILS/////////    
	public function index(){

        require_once('c_app/models/dashboardModel.php');
		$dashboard=new dashboardModel;
		require_once('c_app/models/mobileAppModel.php');
		$model=new mobileAppModel;	
	
		$allcourseware=$dashboard->courseware();
		$allcatalogue=$model->allcatalogue();
		$allskillset=$model->skillset();
		$delete=$dashboard->delete();
		$follow=$dashboard->follow();

		$profile=$dashboard->profile();
		/////////CALLING A VIEW
		$this->view('contentpartner/index',array('method'=>$method,'content'=>$this->landingPage,'library'=>$allcourseware,'catalogue'=>$allcatalogue,'skillset'=>$allskillset,'follow'=>$follow,'profile'=>$profile));


	}
	
    
    //////////FOLLOWERS DETAILS/////////    
	public function followers(){
        
        require_once('c_app/models/dashboardModel.php');
		$dashboard=new dashboardModel;
			
	   $allcourseware=$dashboard->courseware();
		
        $follow=$dashboard->follow();
		$profile=$dashboard->profile();
        /////////CALLING A VIEW
		$this->view('contentpartner/index',array('content'=>$this->url,'follow'=>$follow,'library'=>$allcourseware,'profile'=>$profile));


	}
	
    //////////FETCHING THE COURSEWARE/////////    
	public function courseware(){
	require_once('c_app/models/mobileAppModel.php');
	$model=new mobileAppModel;	
	require_once('c_app/models/dashboardModel.php');
	$dashboard=new dashboardModel;

    $myclassroom=$model->myclassroom();
	$allcourseware=$dashboard->courseware();
	$pin=$dashboard->pin();
	$allcatalogue=$model->allcatalogue();
	$allskillset=$model->skillset();
	
	
    $this->view('contentpartner/index',array('library'=>$allcourseware,'content'=>$this->url,'catalogue'=>$allcatalogue,'skillset'=>$allskillset,'returnmessage'=>$allcourseware,'search'=>$search,)); 
        
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
