<?php
class register extends Controller{
	
	public function index($username='',$password=''){

	if(isset($_POST['fname'])){
    $RegisterModel=$this->model('RegisterModel'); 
    $Register=$RegisterModel->Register();
    }
	
	if(isset($_GET['resendactivation'])){
    $RegisterModel=$this->model('RegisterModel'); 
    $resend=$RegisterModel->resendactivation();
	
    }
	
	if(isset($_POST['activation_phone_code'])){
	$RegisterModel=$this->model('RegisterModel');
	$Register=$RegisterModel->activation_phone_code(); 	
	}
	
	if(isset($_POST['id_number'])){
	$RegisterModel=$this->model('RegisterModel');
	$Register=$RegisterModel->complete_form(); 			
	}
	//session_destroy();
		//$model=$this->model('indexModel');
	 /////////TOP STORIES NEWS NEWS CALL
       
	
		/////////CALLING A VIEW
	
	$this->view('register',array('ReturnMessage'=>$Register,'resend'=>$resend));
	
	}


}


?>