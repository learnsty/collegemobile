<?php
require_once('CrudModel.php');
require_once('FilterModel.php');

$crud=new Crud;

class indexModel extends filterModel{
var $crud;


public function index(){
$this->crud=new Crud; 	

$return['catalogue']=$this->crud->dbselect("catalogue",'*',"status='1'",'LIMIT 8');	

$return['courseware']=$this->crud->dbselect("courseware",'*',"status='1'",'ORDER BY courseware_id DESC LIMIT 8');	

return $return;	
}


}
;?>
