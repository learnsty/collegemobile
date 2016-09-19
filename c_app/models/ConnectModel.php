<?php
class Connect{
private $dbname,$dbuname,$dbpass,$dbhost;

function __construct(){
//$this->dbname='collegem_college_mobile';
//$this->dbuname='collegem_michael';
//$this->dbpass='Proffessor123';

$this->dbname='college_mobile';
$this->dbuname='Michael';
$this->dbpass='proffessor';

$this->dbhost='localhost';
$this->dbconnect();
}

private function dbconnect(){
$conn=mysql_connect($this->dbhost,$this->dbuname,$this->dbpass);

return mysql_select_db($this->dbname,$conn);
 mysql_close();
}




}
?>
