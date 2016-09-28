<?php
require_once('CrudModel.php');
require_once('FilterModel.php');

$crud=new Crud;

class indexModel extends filterModel{
var $crud;


public function index(){
$this->crud=new Crud; 	

$return['catalogue']=$this->crud->dbselect("catalogue",'*',"status='1'",'LIMIT 8');	


$return['courseware']=$this->crud->dbselect("courseware",'*',"status='1'",'ORDER BY courseware_id DESC LIMIT 12');	

/*
$replace_array=array(",","'","`",";"," ","!","-","--","â€™","/","#","@","%","&","*","^","’","_","!","",":",">","<",",",".","}","{","=");
while($grab=mysql_fetch_array($return['courseware'][1])){
$form=array("url"=>strtolower(str_replace($replace_array,'-',$grab['course_title'])));

echo $update=mysql_query("UPDATE courseware SET url='".strtolower(str_replace($replace_array,'-',$grab['course_title']))."' WHERE courseware_id='".$grab['courseware_id']."'");
}
*/
return $return;	
}


}
;?>
