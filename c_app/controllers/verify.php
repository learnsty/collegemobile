<?php
class verify extends Controller{
	
	public function index($username='',$password=''){

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
	
	$this->view('verify',array('ReturnMessage'=>$Register,));
	
	}


}


?>