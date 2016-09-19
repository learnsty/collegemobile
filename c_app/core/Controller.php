<?php

class Controller{
	
	public function model($model){
	  //echo 'yesssmodels';exit; 
	require_once('c_app/models/'.$model.'.php');
	return new $model();
		
	}


	public function view($view, $data=array()){
		$dirlocation="http://".$_SERVER['HTTP_HOST']."/collegemobile/";
		
		//$dirlocation="http://".$_SERVER['HTTP_HOST']."/";
		
		
		require_once('c_app/views/'.$view.'.php');
	}
}

?>