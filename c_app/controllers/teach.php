<?php
session_start();
class teach extends Controller{

    var $url;
    var $dirlocation;
    var $landingPage;

    public function __construct($url, $dirlocation){

	if(!isset($_SESSION['accessLogin'])){
	die(header('Location:login'));
	}



  		$this->url = $url;
  		$this->dirlocation = $dirlocation;
      $this->landingPage[1] = 'landingpage';
	

  	}


	//////////INDEX DETAILS/////////    
	public function index(){

	        
        require_once('c_app/models/dashboardModel.php');
        $admin=new dashboardModel;
       // $dashboard=$admin->dashBoard(); 

		
		/////////CALLING A VIEW
		$this->view('teach/index',array('method'=>$method,'content'=>$this->landingPage));


	}
	
		//////////ALL NEWS DETAILS/////////    
	public function library(){
                
	require_once('c_app/models/mobileAppModel.php');
	$model=new mobileAppModel;	
	require_once('c_app/models/dashboardModel.php');
	$dashboard=new dashboardModel;

    $myclassroom=$model->myclassroom();
	$allcourseware=$dashboard->library();
	$allcatalogue=$model->allcatalogue();
	
	
    $this->view('teach/index',array('library'=>$allcourseware,'content'=>$this->url,'catalogue'=>$allcatalogue,'classroom'=>$myclassroom,'returnmessage'=>$allcourseware)); 
        
    }
	

		//////////ALL NEWS DETAILS/////////    
	public function classroom(){
                
	require_once('c_app/models/dashboardModel.php');
    $dashboardModel=new dashboardModel;
    require_once('c_app/models/mobileAppModel.php');
	$mobilemodel=new mobileAppModel;	
	
    $classroom=$dashboardModel->classroom(); 
	$skillset=$mobilemodel->skillset();
		////////////CREATING A NEW CLASSROOM
	
    $this->view('teach/index',array('classroom'=>$classroom,'content'=>$this->url,'returnmessage'=>$classroom,'skillset'=>$skillset)); 
        
    }
	
	
	
}


?>
