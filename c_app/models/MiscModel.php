<?php
class miscModel{
/*public $agree;
public $info;
public $result;
public $type;
public $user;
public $userid;
function construction($agree,$info){
$this->agree=$agree;
$this->info=$info;
return $this->result=1;
}
function set(){
$_SESSION['user']=$this->user;
$_SESSION['userid']=$this->userid;	
}
*////////////PREPARE VALUE FOR INSERTION
function value_prep($value){
$magic_quotes_active=get_magic_quotes_gpc();
$new_enough_php=function_exists("mysql_real_escape_string"); //ie. PHP >=v4.3.0
if($new_enough_php){// PHP v4.3.0 or higher
//undo any magic quote effects so mysql_real_escape_string can do the work
if($magic_quotes_active){$value=stripslashes($value);}
$value=mysql_real_escape_string($value);	
}
else{// before PHP v4.3.0
//if magic quotes aren't already on them add slashes manually	
if(!$magic_quotes_active){$value=addslashes($value);}	
//if magic quotes are active, then the slashes already exist	
}
return $value;	
}


function value_number($value){
if(!ctype_digit($value)){	
return '1';	
}
}


function value_alpha($value){
if(!ctype_alpha($value)){	
return '1';	
}
}

function value_email($value){
if(!filter_var($value,FILTER_VALIDATE_EMAIL)){
return '1';
}
}


function file_upload($file,$limitsize,$directory_path,$array_list,$name){
if($file){
$file_name=$file['name'];
$file_size=$file['size'];
$file_type=$file['type'];
/////////////////////////
$ext=strtolower(end(explode('.',$file_name)));
$ar=$array_list;
if(in_array($ext,$ar)){
if($file_size<=$limitsize){
$path=$directory_path;
$time=time();
$path_name=$path.$name.'.'.$ext;

if($ext=='zip'){
   $target_folder = $path . $name . "/";
   $msg = move_uploaded_file($file['tmp_name'], $path_name);
    if($msg){
        $zip = new ZipArchive();
        $x = $zip->open($path_name);
        if($x === TRUE){
            $zip->extractTo($target_folder);
            $zip->close();
            unlink($path_name);
        }
    }
    $path_name=$target_folder;
}else{
   $msg=move_uploaded_file($file['tmp_name'], $path_name);
}
/*if($move==TRUE){
$form_array=array(
'date'=>date('Y/m/d'),
'picture_title'=>mysql_real_escape_string($_POST['image_name']),
'path'=>'gallery/'.$time.$_FILES['pix']['name'],
'status'=>'1'
);
$crud=new crud;
$crud->dbRowInsert('gallery',$form_array);
echo 'FILE SAVED SUCCESSFULLY';
}*/
}
else{$msg="FILE SIZE TOO LARGE::: SHOULD NOT BE GREATER THAN  $limitsize kilobyte";}
}
else{$msg='FILE TYPE NOT SUPPORTED!';}
return array($msg,$path_name);

}
}
	

///////////////RANDOM NUMBERS AND ALPHABET
function RandomCode($length = 10){
    $code = '';
    $total = 0;

    do
    {
        if (rand(0, 1) == 0)
        {
            $code.= chr(rand(97, 122)); // ASCII code from **a(97)** to **z(122)**
        }
        else
        {
            $code.= rand(0, 9); // Numbers!!
        }
        $total++;
    } while ($total < $length);

    return $code;
}	


//////////////////CHECKING FOR EMPTY FIELD
function emptycheck($char){
$veri = TRUE;
foreach($char as $p) {
   if(!isset($_POST[$p]) || empty($_POST[$p])) {
      $veri = FALSE;
   }
   
}
return $veri;	
}


/////////////////////////COUTING WORDS TO DISPLAY
function limit_words($string, $word_limit)
{
    $words = explode(" ",$string);
    return implode(" ",array_splice($words,0,$word_limit));
}



/////////////////////DATE FUNCTION
function dateset($date,$dateadd){
$date = new DateTime($date);
date_add($date, new DateInterval("P".$dateadd."D"));
echo $date->format("d-m-Y");
}

//////////////////ENCODING PASSOWRD
function encodeValue($value,$padding='[abcd1234abcdefg]') {
	if(!empty($padding)) {
		$value = urlencode(base64_encode($padding.$value.$padding));
	} else {
		$value = urlencode(base64_encode(trim($value)));
	}
	return $value;
}



/////////////////////DECODING PASSWORD
function decodeValue($value,$padding='[abcd1234abcdefg]') {
	
	$value = base64_decode(urldecode($value));
	if(!empty($padding)) {
		$value = str_replace($padding,'',$value);
	}
	return $value;
}
    
    
}

?>