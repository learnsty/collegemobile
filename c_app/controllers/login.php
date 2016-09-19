<?php
class login extends Controller{
	
	public function index($username='',$password=''){

	if(isset($_POST['login_username'])){
   	$LoginModel=$this->model('LoginModel'); 
   	$Login=$LoginModel->Login();
   
    }
		
		
	
		/////////CALLING A VIEW
		$this->view('login',array('ReturnMessage'=>$Login));
	}


}


?>