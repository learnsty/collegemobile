<?php
require_once('ConnectModel.php');
$connect=new Connect;

class Crud{
//*********************************************
// INSERT FUNCTION STARTS HERE //
//*********************************************
////////////////////CHECK IF TABLE EXIST
function create($table_name){
$create=mysql_query("CREATE TABLE IF NOT EXISTS $table_name (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rand` int(11) NOT NULL,
  `exp_details` text NOT NULL,
  `spent` decimal(20,2) NOT NULL,
  `date_spent` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;")or die(mysql_error());
}

////////////////////INSERT INTO TABLE
function dbinsert ($table_name, $form_data){
//echo $form_data['rand'];
	// Retrievethe keys of the array (column title)
	$fields = array_keys($form_data);
	if($form_data==''){
	$msg='FIELD(s) CANNOT BE EMPTY!';
	}
	// Build the query
	$sql = "INSERT INTO ".$table_name."
	(`".implode('`,`',$fields)."`)
	VALUES('".implode("','", $form_data)."')";
	// run and return the query result resources
	$run=mysql_query($sql);
	if($run==TRUE){
	$msg='DATA INSERTED SUCCESSFULLY!';
	}
	else{
	$msg='COLUMN NAME OR TABLE NAME NOT CORRECT!';
	}
	return $msg;
}

//*******************************
// INSERT FUNCTION ENDS HERE //
//*******************************
	
	
//*******************************
// DELETE FUNCTION STARTS HERE //
//*******************************
function dbdelete($table_name, $where_clause){
	// The where clause is optional incase the user want to delete every rows
	$whereSQL = ''; // Check for optional where clause
	if(!empty($where_clause))
	{
		// Check to see if where key word exists
			if(substr(strtoupper(trim($where_clause)), 0.5) !='WHERE')
			{
				// Not found, add keyword
				$whereSQL = " WHERE " .$where_clause;
			} 
			
			
			else{
					$whereSQL = " " .trim($where_clause);
				}
	}
			
			
			
			// Build the query
			$sql = "DELETE FROM " .$table_name.$whereSQL;
			
			// Run and return the query resources
			return mysql_query($sql)or die(mysql_error());
}

//*******************************
// DELETE FUNCTION ENDS HERE //
//*******************************
	
	
//*******************************
// UPDATE FUNCTION STARTS HERE //
//*******************************
function dbupdate( $table_name, $form_data, $where_clause)
{
	// Check for optional where clause
	$whereSQL ='';
	if(!empty($where_clause)){
		
		// Check if the where key exist
		if(substr(strtoupper(trim($where_clause)), 0,5) != 'WHERE'){
			
			// Not found, add keyword
			$whereSQL = " WHERE " . $where_clause;
			}else
			{
				$whereSQL =" ".trim($where_clause);
				
				}
		
		}


// Check form fields
function setfields($form_data){
	
	// Loop and build the column
$sets = array();
foreach($form_data as $column => $value){
	 $sets[] = "" .$column. " = '".$value."' ";
	}
	return $sets;
} 



// Start the actual statement
$sql =" UPDATE $table_name " . " SET " . implode("," ,setfields($form_data)) . $whereSQL;


// Run and return the query result
return mysql_query($sql)or die(mysql_error());

}

//*******************************
// UPDATE FUNCTION ENDS HERE //
//*******************************

//*******************************
// SELECT FUNCTION STARTS HERE //
//*******************************
public function dbselect($table_name,$data,$where_clause,$order){
	$whereSQL ='';
	if(!empty($where_clause)){
		// Check if the where key exist
		if(substr(strtoupper(trim($where_clause)), 0,5) != 'WHERE'){
			
			// Not found, add keyword
			$whereSQL = " WHERE " . $where_clause;
			}else
			{
				$whereSQL =" ".trim($where_clause);
				
				}
		if($order==''){$order='';}elseif($order!=''){$order=$order;}		
		$run="SELECT $data FROM $table_name $whereSQL $order";		
		$sql=mysql_query($run)or die(mysql_error());
		$slt=mysql_fetch_array($sql);
		//////////////////IF YOU HAVE WHERE AND ITS SELECTING MORE THAN ONE ROWS
		$run2="SELECT $data FROM $table_name $whereSQL $order";		
		$sql2=mysql_query($run2)or die(mysql_error());
		$numb=mysql_num_rows($sql2);
		return array($slt,$sql2,$numb);	
		}
		else{
		//if(!empty($whereSQL)){	
		$run="SELECT $data FROM $table_name $order";	
		$sql=mysql_query($run)or die(mysql_error());
		$num=mysql_num_rows($sql);	
		return array($sql,$num);	
		//}
		}
}
	
	/////////////////////PAGINATION GOES HERE/////
	
public function paginate($tbl_name,$targetpage,$limit,$where,$order){
//////////////////PAGINATION
	//$tbl_name="jobs_upload";		//your table name
	// How many adjacent pages should be shown on each side?
	$adjacents = 3;
	
	if (strpos($_SERVER['REQUEST_URI'],'?') !== false) {
	$getPageCount='&page';
	}
	else{
	$getPageCount='?page';	
	}
	/* 
	   First get total number of rows in data table. 
	   If you have a WHERE clause in your query, make sure you mirror it here.
	*/
	$query = "SELECT COUNT(*) as num FROM $tbl_name WHERE $where";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages[num];
	
	/* Setup vars for query. */
	//$targetpage = "index.php"; 	//your file name  (the name of this file)
	//$limit = 10; 								//how many items to show per page
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
	$sql = "SELECT * FROM $tbl_name  WHERE $where $order LIMIT $start, $limit";
	$result = mysql_query($sql)or die(mysql_error());
	
	
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = "";
	if($lastpage > 1)
	{	
       
		$pagination .= "<ul class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<li><a href=\"$targetpage".$getPageCount."=$prev\"> previous</a></li>";
		else
			$pagination.= "<li><span class=\"disabled\"> previous</span></li>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<li><span class=\"current\">$counter</span></li>";
				else
					$pagination.= "<li><a href=\"$targetpage".$getPageCount."=$counter\">$counter</a><li>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li><span class=\"current\">$counter</span></li>";
					else
						$pagination.= "<li><a href=\"$targetpage".$getPageCount."=$counter\">$counter</a></li>";					
				}
				$pagination.= "...";
				$pagination.= "<li><a href=\"$targetpage".$getPageCount."=$lpm1\">$lpm1</a></li>";
				$pagination.= "<li><a href=\"$targetpage".$getPageCount."=$lastpage\">$lastpage</a></li>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<li><a href=\"$targetpage".$getPageCount."=1\">1</a></li>";
				$pagination.= "<li><a href=\"$targetpage".$getPageCount."=2\">2</a></li>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li><span class=\"current\">$counter</span></li>";
					else
						$pagination.= "<li><a href=\"$targetpage".$getPageCount."=$counter\">$counter</a></li>";					
				}
				$pagination.= "...";
				$pagination.= "<li><a href=\"$targetpage".$getPageCount."=$lpm1\">$lpm1</a></li>";
				$pagination.= "<li><a href=\"$targetpage".$getPageCount."=$lastpage\">$lastpage</a></li>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<li><a href=\"$targetpage".$getPageCount."=1\">1</a><li>";
				$pagination.= "<li><a href=\"$targetpage".$getPageCount."=2\">2</a></li>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li><span class=\"current\">$counter</span></li>";
					else
						$pagination.= "<li><a href=\"$targetpage".$getPageCount."=$counter\">$counter</a></li>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 

			$pagination.= "<li><a href=\"$targetpage".$getPageCount."=$next\">next </a></li>";
		else
			$pagination.= "<li><span class=\"disabled\">next</span></li>";
		$pagination.= "</ul>\n";		
	}
	
	return array($result,$pagination,$total_pages,$start);
	
}
}




?>