<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>College Mobile: Learn, Teach and Collaborate</title>

    <!-- Bootstrap Core CSS -->
    
    
	<link href="<?php echo $dirlocation;?>c_app/views/css/bootstrap.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo $dirlocation;?>c_app/views/css/half-slider.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body ng-app="jaraja"  ng-controller="Login">

	
    <!-- /.container -->
    <!-- Navigation -->
    <?php include('c_app/views/snipets/header.php');?>

	<div class="col-lg-12" style="margin-top:;background:#F3F3F3">
    
    
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default" style="margin-top:90px">
                    <div class="panel-heading">
                        <h3 class="panel-title" style="text-align:center">
                        <img src="<?php echo $dirlocation.'c_app/views/images/logo.png';?>" height="100px" style="border-radius:0%;border:2px solid #fff" /><br/>
                         User Sign in
                         
                       </h3>
                    </div>
                    <div class="panel-body">
                    
                   <form
name="loginForm" action="<?php $_SERVER['PHP_SELF'];?>" method="post">
        		 <?php if (isset($data['ReturnMessage']['msg'])){?>
        		<div class="alert alert-danger" style="display:nne">
                <?php echo $data['ReturnMessage']['msg'];?>
                </div>
                <?php }?>
                            <fieldset>
  <span style="color:red" ng-show="loginForm.login_username.$dirty && loginForm.login_username.$invalid">
  <span ng-show="loginForm.login_username.$error.required">Username is required.</span>
  </span>


                               <div class="input-group">
                              <div class="input-group-addon">
                              <span class="glyphicon glyphicon-phone"></span> Phone
                              </div>
                              <input type="phone" class="form-control" id="exampleInputAmount" placeholder="Username" name="login_username" ng-model="login_username" required>
                            </div>
  
   <span style="color:red" ng-show="loginForm.login_password.$dirty && loginForm.login_password.$invalid">
   <span ng-show="loginForm.login_password.$error.required">Password is required.</span>
  </span>        
                                <div class="input-group">
                              <div class="input-group-addon">
                              <span class="glyphicon glyphicon-lock"></span> Password
                              </div>
                              <input type="password" class="form-control" id="exampleInputAmount" placeholder="Password" name="login_password" ng-model="login_password" required>
                              
                            </div>
              
              <div class="input-group">
          <div class="input-group-addon">
          <span class="">I am a</span>
          </div>
         <select class="form-control" name="login_type">
         <option value="student">Student</option>
          <option value="lecturer">Teacher</option>
          </select>

           </div>
                            
              
              
  <input type="submit" class="btn btn-sm btn-success btn-block"  ng-disabled="loginForm.$invalid" value="Sign in">
                            </fieldset>
                        </form>
                      
                    </div>
                    
                    
                </div>
            </div>
            
        </div>
    <!-- Half Page Image Background Carousel Header -->
    


    <!-- jQuery -->
    <script src="<?php echo $dirlocation;?>c_app/views/js/jquery.js"></script>
    <script src="<?php echo $dirlocation;?>c_app/views/js/angular/angular.js"></script>
	 <script src="<?php echo $dirlocation;?>c_app/views/js/app.js"></script>
     <script src="<?php echo $dirlocation;?>c_app/views/js/angular/angular-route.js"></script>
   <script src="<?php echo $dirlocation;?>c_app/views/js/angular/angular-cookies.js"></script>
   <script src="<?php echo $dirlocation;?>c_app/views/js/controllers/LoginCtrl.js"></script>
   <script src="<?php echo $dirlocation;?>c_app/views/js/angular/angular-route.js"></script>
    <script src="<?php echo $dirlocation;?>c_app/views/js/angular/ngStorage.min.js"></script>
    <script src="<?php echo $dirlocation;?>c_app/views/js/angular/angular-cookies.js"></script>

	 <!--
   
   
   <script src="js/controllers/AppCtrl.js"></script>
   
   
    !-->
    
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo $dirlocation;?>app/views/js/bootstrap.min.js"></script>
	
    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

</body>

</html>
