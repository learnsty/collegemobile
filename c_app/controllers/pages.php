<?php

session_start();
class pages extends Controller{

    var $url;
    var $dirlocation;
    var $landingPage;
	var $snipets;

    public function __construct($url, $dirlocation){

	require_once('c_app/models/dashboardModel.php');
    $dashboardModel=new dashboardModel;
		
		

  		$this->url = $url;
  		$this->dirlocation = $dirlocation;
      	$this->landingPage[1] = 'landingpage';
		//$this->snipets=$dashboardModel->snipets();
        
       
        
       

  	}


	//////////INDEX DETAILS/////////    
	public function index(){

        require_once('c_app/models/dashboardModel.php');
		$dashboard=new dashboardModel;
		$checkPage=$dashboard->checkcontent($this->url[0]);
        
		
        
		/////////CALLING A VIEW
		$this->view('pages',array('details'=>$checkPage));


	}
	
    
    



}


?>
