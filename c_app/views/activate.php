<?php

	if(isset($_FILES['csv_result']['tmp_name'])){
	require_once('app/models/CrudModel.php');
	$crud = new Crud;
	$handle = fopen($_FILES['csv_result']['tmp_name'], "r");
	$array_list=array('csv');
	
	while (($data = fgetcsv($handle, 8000, ",")) !== FALSE) {
	//print_r ($data[0]);	
	$date = date (str_replace('/','-',$data[2]));
	$insertArray2=array('product_name'=>str_replace("'","'",$data[0]),'date_added'=>$date,'status'=>'1');
	$insertIntoResult2=$crud->dbinsert('products',$insertArray2);
	echo $insertIntoResult2;
	}
exit;
	}

;?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>College Mobile: New User Registration</title>

    <!-- Bootstrap Core CSS -->
    
    
	<link rel="stylesheet" href="css/reset.css">

    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css'>

        <link rel="stylesheet" href="<?php echo $dirlocation;?>c_app/views/css/loginstyle.css">
		<link rel="stylesheet" href="<?php echo $dirlocation;?>c_app/views/css/bootstrap.css">
    
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body style="background: url(<?php echo $dirlocation;?>c_app/views/images/login_background3.png) repeat fixed;font-family: 'Raleway', sans-serif;" ng-app="jaraja"  ng-controller="Registration">

	
    <!-- /.container -->
    <!-- Navigation -->
    <?php //include('c_app/views/snipets/header.php');?>

	<div class="col-lg-12" style="margin-top:">

<div class="col-md-4 col-md-offset-4" style="margin-top:90px;text-align:center">
            
             <h2 style="color:#06C;text-align:center">BRAVO <?php echo $_SESSION['accessLogin']['full_name'];?>!</h2>
             <h4 style="text-align:center">Thousands of people are already waiting for you.</h4>	
                
                <a href="<?php if($_SESSION['accessLogin']['account_type']!='contentprovider'){echo $dirlocation.'learn/feeds';}else{echo $dirlocation.'content/index';}?>" class="btn btn btn-success"><h2>START <?php if($_SESSION['accessLogin']['account_type']!='contentprovider'){echo 'LEARNING!';}else{echo 'SHARING!';}?>!</h2></a>
                
                
      
            </div>
            
                  
     </div>

    <!-- jQuery -->
    <script src="<?php echo $dirlocation;?>c_app/views/js/jquery-1.10.2.min.js"></script>
    <script src="<?php echo $dirlocation;?>c_app/views/js/angular/angular.js"></script>
	 <script src="<?php echo $dirlocation;?>c_app/views/js/app.js"></script>
     <script src="<?php echo $dirlocation;?>c_app/views/js/controllers/AppCtrl.js"></script>
     <script src="<?php echo $dirlocation;?>c_app/views/js/angular/angular-route.js"></script>
    <script src="<?php echo $dirlocation;?>c_app/views/js/angular/ngStorage.min.js"></script>
   <script src="<?php echo $dirlocation;?>c_app/views/js/angular/angular-cookies.js"></script>
   
   <script src="<?php echo $dirlocation;?>c_app/views/js/controllers/RegCtrl.js"></script>
   

	 <!--
   
   
   <script src="js/controllers/AppCtrl.js"></script>
   
   
    !-->
    
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo $dirlocation;?>c_app/views/js/bootstrap.min.js"></script>
	
</body>

</html>
