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

    <link rel="stylesheet" href="css/reset.css">


    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css'>

        <link rel="stylesheet" href="<?php echo $dirlocation;?>c_app/views/css/loginstyle.css">
		<link rel="stylesheet" href="<?php echo $dirlocation;?>c_app/views/css/bootstrap.css">
    
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    
  </head>

  <body class="wp-smartstudy" style="background: url(<?php echo $dirlocation;?>c_app/views/images/login_background3.png) repeat fixed;font-family: 'Raleway', sans-serif;" ng-app="jaraja"  ng-controller="Login">
  
  <div class="wrapper"> 

      <?php include('c_app/views/snipets/header.php');?>

<div class="col-lg-4" style="float:none;margin:80px auto;text-align:center;">

<h2 style="color:#06C">Welcome To College Mobile</h2>	
   <form
name="loginForm" action="<?php $_SERVER['PHP_SELF'];?>" method="post" class="login" style="float:none;margin:auto;padding:0;width:100%">
        	
  <fieldset>

        <div style="clear:both"></div>
  	<legend class="legend">Login</legend>
    

     <?php if (isset($data['ReturnMessage']['msg'])){?>
        		<div class="alert alert-danger" style="display:nne;margin:0 10px">
                <?php echo $data['ReturnMessage']['msg'];?>
                </div>
                <?php }?>
    
      <span style="color:red" ng-show="loginForm.login_username.$dirty && loginForm.login_username.$invalid">
  <span ng-show="loginForm.login_username.$error.required">Username is required.</span>
  </span>

            
    <div class="input">
    	<input required type="phone" placeholder="Phone Number" name="login_username" ng-model="login_username"/>
      <span class="spantab"><i class="fa fa-phone"></i></span>
    </div>
    
    <span style="color:red" ng-show="loginForm.login_password.$dirty && loginForm.login_password.$invalid">
   <span ng-show="loginForm.login_password.$error.required">Password is required.</span>
  </span>        
   
    <div class="input">
    	<input type="password" placeholder="Password" required name="login_password" ng-model="login_password" />
      <span class="spantab"><i class="fa fa-lock"></i></span>
    </div>
    
    <div class="input">
    <h5>I am a:</h5>
    <select class="form-control" name="login_type">
         <option value="student">Student</option>
          <option value="lecturer">Teacher</option>
           <option value="contentprovider">Content Partner</option>
          </select>

    </div>
    <button type="submit" ng-disabled="loginForm.$invalid" class="submit"><i class="fa fa-long-arrow-right"></i></button>
    
    
    <a class="btn btn-sm btn-primary pull-right" style="margin:35px 5px 5px 5px;" href="<?php echo $dirlocation;?>register">I am a new User</a>
  </fieldset>
  
  
  
</form>

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
