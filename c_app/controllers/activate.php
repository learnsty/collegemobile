<?php
class activate extends Controller{
	
	public function newuser(){
	
	$RegisterModel=$this->model('RegisterModel');
	$Register=$RegisterModel->activate_link(); 			

	$this->view('activate',array('ReturnMessage'=>$Register,));
	
	}


}


?>
