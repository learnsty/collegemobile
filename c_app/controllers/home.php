<?php
class Home extends Controller{
	
	public function index($name='',$othername=''){
		 $indexmodel=$this->model('indexModel');
		/////////CALLING A VIEW
		$index=$indexmodel->index(); 
		
		
		$this->view('index',array('index'=>$index,'keydate'=>date('Y')));
		
	}



}


?>