<?php

session_start();
class scorm extends Controller{

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
	public function tracking(){

    
        require_once('c_app/models/dashboardModel.php');
		$dashboard=new dashboardModel;
		//echo $this->url[2];
        $url='scorm_'.$this->url[2];
        $data=$dashboard->$url();
	
		
	   return $data['content'];
		//$this->view('',array('method'=>'',));


	}
	
    
   
	

	



}


?>
