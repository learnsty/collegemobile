<!DOCTYPE html>
<html >
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>College Mobile: Learn, Teach and Collaborate</title>


<link href="<?php echo $dirlocation;?>c_app/views/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo $dirlocation;?>c_app/views/css/indexcss/chosen.css" rel="stylesheet">
<link href="<?php echo $dirlocation;?>c_app/views/css/indexcss/jquery.mobile-menu.css" rel="stylesheet">
<link href="<?php echo $dirlocation;?>c_app/views/css/indexcss/style.css" rel="stylesheet">

<link href="<?php echo $dirlocation;?>c_app/views/css/indexcss/color.css" rel="stylesheet">
<link href="<?php echo $dirlocation;?>c_app/views/css/indexcss/responsive.css" rel="stylesheet">
<link href="<?php echo $dirlocation;?>c_app/views/css/indexcss/responsive.css" rel="stylesheet">

    <link rel="stylesheet" href="css/reset.css">


    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css'>

        <link rel="stylesheet" href="<?php echo $dirlocation;?>c_app/views/css/loginstyle.css">
		<link rel="stylesheet" href="<?php echo $dirlocation;?>c_app/views/css/bootstrap.css">
    
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    
  </head>

  <body class="wp-smartstudy" style="background: url(<?php echo $dirlocation;?>c_app/views/images/login_background3.png) repeat fixed;font-family: 'Raleway', sans-serif;" ng-app="jaraja"  ng-controller="Login">
  
  <div class="wrapper"> 

      <?php include('c_app/views/snipets/header.php');?>
<div class="col-lg-12" style="background:#069;padding:25px 0">
    <div class="container" style="padding-left:25px">
                        
        <ul class="top-nav nav-left" style="color:#fff">                 
<h2><?php echo $data['profile']['profile'][0]['full_name'];?></h2>
            <h4><?php echo $data['profile']['profile_type'];?></h4>
             </ul>
      
        </div>
    
    
</div>
      
      <div class="container" style="margin-top:5px">
      
      <div class="col-lg-1" style="float:left">
        <img src="<?php echo $dirlocation.'c_app/views/images/'.$data['profile']['profile'][0]['photo'];?>" style="max-height:250px">
        </div>
      </div>
      
      <div class="col-lg-10" style="float:left">
      <?php echo $data['profile']['profile'][0]['about_me'];?>
      </div>

</div>
<script src="<?php echo $dirlocation;?>c_app/views/js/jquery.js"></script>
    <script src="<?php echo $dirlocation;?>c_app/views/js/angular/angular.js"></script>
	 <script src="<?php echo $dirlocation;?>c_app/views/js/app.js"></script>
     <script src="<?php echo $dirlocation;?>c_app/views/js/angular/angular-route.js"></script>
   <script src="<?php echo $dirlocation;?>c_app/views/js/angular/angular-cookies.js"></script>
   <script src="<?php echo $dirlocation;?>c_app/views/js/controllers/LoginCtrl.js"></script>
   <script src="<?php echo $dirlocation;?>c_app/views/js/angular/angular-route.js"></script>
    <script src="<?php echo $dirlocation;?>c_app/views/js/angular/ngStorage.min.js"></script>
    <script src="<?php echo $dirlocation;?>c_app/views/js/angular/angular-cookies.js"></script>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="<?php echo $dirlocation;?>c_app/views/js/loginindex.js"></script>

    
    
    
  </body>
</html>
