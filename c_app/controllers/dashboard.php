<?php
session_start();
class dashboard extends Controller{

    var $url;
    var $dirlocation;
    var $landingPage;

    public function __construct($url, $dirlocation){
		
	if(!isset($_SESSION['adminid'])){
	die(header('Location:adminlogin'));
	}



  		$this->url = $url;
  		$this->dirlocation = $dirlocation;
      $this->landingPage[1] = 'landingpage';
	

  	}


	//////////INDEX DETAILS/////////    
	public function index(){

	        
        require_once('app/models/adminModel.php');
        $admin=new adminModel;
        $dashboard=$admin->dashBoard(); 


		/////////CALLING A VIEW
		$this->view('administrator/adminindex',array('method'=>$method,'content'=>$this->landingPage,'dashboard'=>$dashboard));


	}
	
	//////////ALL MENU DETAILS/////////    
	public function menu(){   
        
    require_once('app/models/adminModel.php');
    $admin=new adminModel;
        
    $allMenu=$admin->allMenu();     
        
    $this->view('administrator/adminindex',array('allMenu'=>$allMenu,'content'=>$this->url)); 
        
    }


	public function pages(){   

        

    require_once('app/models/adminModel.php');

    $admin=new adminModel;
    $allPages=$admin->allPages();     
    $this->view('administrator/adminindex',array('allPages'=>$allPages,'content'=>$this->url)); 

        

    }
	
	public function adminUsers(){
    require_once('app/models/adminModel.php');
    $admin=new adminModel; 
    $adminusers=$admin->adminUsers(); 
    
    $this->view('administrator/adminindex',array('adminusers'=>$adminusers,'content'=>$this->url));     
    }


	public function adverts(){    
    require_once('app/models/adminModel.php');
    $admin=new adminModel;
    $allAdvert=$admin->allAdvert();  
        
    $advertSettings=$admin->advertSettings();    
 
    
    $this->view('administrator/adminindex',array('advert'=>$allAdvert,'content'=>$this->url,'advertSettings'=>$advertSettings)); 
        
    }
	
public function visitors(){

    require_once('app/models/adminModel.php');
    $admin=new adminModel; 
    $details=$admin->visitors(); 
               
    $this->view('administrator/adminindex',array('Details'=>$details,'content'=>$this->url));     
    }


//////////// ADVERT CONTROLLER STARTS HERE
  public function advert(){

  $adminModel=$this->model('adminModel');
  
  /////////CIRCULATION MODEL STARTS HERE
  
  $advert = $adminModel->advert($this->url);
  

  $this->view('index',array('content'=>$this->url,'advert'=>$advert));
  }

/////////////SOCIAL MEDIA PAGES
	public function socialPages(){
	require_once('app/models/adminModel.php');
	$admin=new adminModel; 
	$details=$admin->allMediaPages(); 
		
	
	
	$this->view('administrator/adminindex',array('Details'=>$details,'content'=>$this->url));     
    }
	
	
	////////////////META DETAILS//////////////
	public function metaDetails(){
    require_once('app/models/adminModel.php');
    $admin=new adminModel; 
    $details=$admin->metaDetails(); 
        
    
    $this->view('administrator/adminindex',array('Details'=>$details,'content'=>$this->url));     
    }
	
	
	
	
	
//////////// SALES CONTROLLER STARTS HERE
  public function sales(){

  $adminModel=$this->model('adminModel');
  
  /////////CIRCULATION MODEL STARTS HERE
  
  $sales = $adminModel->sales($this->url);
  

  $this->view('index',array('content'=>$this->url,'sales'=>$sales));
  }

//////////// ACCOUNT CONTROLLER STARTS HERE
  public function account(){

  $adminModel=$this->model('adminModel');
  
  /////////CIRCULATION MODEL STARTS HERE
  
  $account = $adminModel->account($this->url);
  

  $this->view('index',array('content'=>$this->url,'account'=>$account));
  }


//////////// MARKETING CONTROLLER STARTS HERE
  public function marketing(){

  $adminModel=$this->model('adminModel');
  
  /////////CIRCULATION MODEL STARTS HERE
  
  $marketing = $adminModel->marketing($this->url);
  

  $this->view('index',array('content'=>$this->url,'marketing'=>$marketing));
  }


//////////// INFORMATION TECHNOLOGY CONTROLLER STARTS HERE
  public function infotech(){

  $adminModel=$this->model('adminModel');
  
  /////////CIRCULATION MODEL STARTS HERE
  
  $infotech = $adminModel->infotech($this->url);
  

  $this->view('index',array('content'=>$this->url,'infotech'=>$infotech));
  }


//////////// SOCIAL MEDIA CONTROLLER STARTS HERE
  public function social(){

  $adminModel=$this->model('adminModel');
  
  /////////CIRCULATION MODEL STARTS HERE
  
  $social = $adminModel->social($this->url);
  

  $this->view('index',array('content'=>$this->url,'social'=>$social));
  }





  public function mystudents(){

  $adminModel=$this->model('adminModel');

  $mystudents = $adminModel->mystudents();


  $this->view('adminindex',array('content'=>$this->url,'mystudents'=>$mystudents));
  }


  public function mycourses(){

  $adminModel=$this->model('adminModel');

  $mycourses = $adminModel->mycourses();


  $this->view('adminindex',array('content'=>$this->url,'mycourses'=>$mycourses));
  }

  public function courses(){

  $adminModel=$this->model('adminModel');

  $courses = $adminModel->mycourses();


  $this->view('adminindex',array('content'=>$this->url,'courses'=>$courses));
  }

}


?>
