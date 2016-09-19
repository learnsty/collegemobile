<?php
class logout extends Controller{
	
	public function index($username='',$password=''){
		
    
	
    $LoginModel=$this->model('LoginModel'); 
    $Login=$LoginModel->Logout();
    
  
	
		/////////CALLING A VIEW
		//$this->view('adminlogin',array('ReturnMessage'=>$Login));
	}


}


?>