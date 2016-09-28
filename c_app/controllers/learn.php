<?php
session_start();
class learn extends Controller{

    var $url;
    var $dirlocation;
    var $landingPage;
	var $snipets;

    public function __construct($url, $dirlocation){

	require_once('c_app/models/dashboardModel.php');
    $dashboardModel=new dashboardModel;
		
		
	if(!isset($_SESSION['accessLogin'])){
    
	die(header('Location:'.$dirlocation.'login?return_to='.$_SERVER['REQUEST_URI']));
	}



  		$this->url = $url;
  		$this->dirlocation = $dirlocation;
      	$this->landingPage[1] = 'landingpage';
		$this->snipets=$dashboardModel->snipets();

  	}


	//////////INDEX DETAILS/////////    
	public function index(){

	        
        require_once('c_app/models/dashboardModel.php');
        $admin=new dashboardModel;
       // $dashboard=$admin->dashBoard(); 

		
		/////////CALLING A VIEW
		$this->view('learn/index',array('method'=>$method,'content'=>$this->landingPage,'snipets'=>$this->snipets));


	}
	
	//////////FETCHING THE LIBRARY/////////    
	public function library(){
                
	require_once('c_app/models/mobileAppModel.php');
	$model=new mobileAppModel;	
	require_once('c_app/models/dashboardModel.php');
	$dashboard=new dashboardModel;

    $myclassroom=$model->myclassroom();
	$allcourseware=$dashboard->library();
	$allcatalogue=$model->allcatalogue();
	$allskillset=$model->skillset();
	$like=$dashboard->like();
	$pin=$dashboard->pin();
	//////IF THE SEARCH IS TRIGGERED///
	if(isset($_GET['SearchKeyword'])){
	$search=$dashboard->search();	
	}
	
    $this->view('learn/index',array('library'=>$allcourseware,'content'=>$this->url,'catalogue'=>$allcatalogue,'skillset'=>$allskillset,'classroom'=>$myclassroom,'returnmessage'=>$allcourseware,'search'=>$search,'snipets'=>$this->snipets)); 
        
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
	$like=$dashboard->like();
    $enrol=$dashboard->enrol();   
	if(isset($_GET['SearchKeyword'])){
	$search=$dashboard->search();	
	}
	
    $this->view('learn/index',array('library'=>$allcourseware,'content'=>$this->url,'catalogue'=>$allcatalogue,'skillset'=>$allskillset,'myclassroom'=>$myclassroom,'returnmessage'=>$allcourseware,'search'=>$search,'snipets'=>$this->snipets)); 
        
    }



	//////////ALL NEWS DETAILS/////////    
	public function classroom(){
	require_once('c_app/models/dashboardModel.php');
    $dashboardModel=new dashboardModel;
    require_once('c_app/models/mobileAppModel.php');
	$mobilemodel=new mobileAppModel;	
	
    $classroom=$dashboardModel->classroom(); 
	$skillset=$mobilemodel->skillset();
	$allcatalogue=$mobilemodel->allcatalogue();
	$pin=$dashboardModel->pin();
	//////IF THE SEARCH IS TRIGGERED///
	if(isset($_GET['SearchKeyword'])){
	$search=$dashboardModel->search();	
	}
	
    $this->view('learn/index',array('classroom'=>$classroom,'content'=>$this->url,'returnmessage'=>$classroom,'skillset'=>$skillset,'search'=>$search,'catalogue'=>$allcatalogue,'snipets'=>$this->snipets)); 
        
    }
	
	public function feeds(){
	require_once('c_app/models/dashboardModel.php');
    $dashboardModel=new dashboardModel;
    require_once('c_app/models/mobileAppModel.php');
	$mobilemodel=new mobileAppModel;	
		
	$allcourseware=$dashboardModel->library();
	$allclassroom=$dashboardModel->classroom(); 
	$feeds=$dashboardModel->feeds(); 
	$pin=$dashboardModel->pin();
	$like=$dashboardModel->like();
	$this->view('learn/index',array('content'=>$this->url,'allcourseware'=>$allcourseware,'allclassroom'=>$allclassroom,'feeds'=>$feeds,'snipets'=>$this->snipets)); 	
	}
	
	public function profile(){
	require_once('c_app/models/dashboardModel.php');
    $dashboardModel=new dashboardModel;
   	$pin=$dashboardModel->pin();
	$follow=$dashboardModel->follow();


	$profile=$dashboardModel->profile();
	$this->view('learn/index',array('content'=>$this->url,'profile'=>$profile,'snipets'=>$this->snipets,'follow'=>$follow)); 	
	}
	
	
	public function search(){
	require_once('c_app/models/dashboardModel.php');
    $dashboardModel=new dashboardModel;
	$search=$dashboardModel->searchglobal();
	
	$this->view('learn/index',array('content'=>$this->url,'search'=>$search,'snipets'=>$this->snipets)); 	
	}
	
	
	public function community(){
	require_once('c_app/models/dashboardModel.php');
    $dashboardModel=new dashboardModel;
	$community=$dashboardModel->community();
	//print_r($this->snipets);
	$this->view('learn/index',array('content'=>$this->url,'community'=>$community,'snipets'=>$this->snipets)); 	
	}
	
	
}


?>
