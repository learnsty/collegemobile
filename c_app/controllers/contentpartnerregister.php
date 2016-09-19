<?php
class contentpartnerregister extends Controller{
	
	public function index($username='',$password=''){

	if(isset($_POST['institution'])){
    $RegisterModel=$this->model('RegisterModel'); 
    $Register=$RegisterModel->contentpartnerregister();
    }
	
	if(isset($_GET['resendactivation'])){
    $RegisterModel=$this->model('RegisterModel'); 
    $resend=$RegisterModel->resendactivation();
	
    }
	
	
	$this->view('contentpartnerregister',array('ReturnMessage'=>$Register,'resend'=>$resend));
	
	}


}


?>