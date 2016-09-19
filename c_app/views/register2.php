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
    
    
	<link href="<?php echo $dirlocation;?>c_app/views/css/bootstrap.css" rel="stylesheet">
    
    <link href="<?php echo $dirlocation;?>c_app/views/css/font-awesome.css" rel="stylesheet">
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

<body ng-app="jaraja"  ng-controller="Registration">

	
    <!-- /.container -->
    <!-- Navigation -->
    <?php include('c_app/views/snipets/header.php');?>

	<div class="col-lg-12" style="margin-top:;background:#F3F3F3">
    	<?php if((!isset($_SESSION['stage2']))&&(!isset($_SESSION['stage3']))){?>

    
            <div class="col-md-4 col-md-offset-4" ng-if="activate == undefined">
                <div class="login-panel panel panel-default" style="margin-top:90px">
                    <div class="panel-heading">
                        <h3 class="panel-title" style="text-align:center">
                        <img src="<?php echo $dirlocation.'c_app/views/images/logo.png';?>" height="100px" style="border-radius:0%;border:2px solid #fff" /><br/>
                       New User Registration
                         </h3>
                    </div>
                    <div class="panel-body">
                    <div style="text-align:center">
                    <img src="<?php echo $dirlocation;?>app/views/images/comment.gif" class="loader" style="margin:auto;display:none"/>
                    </div>
                   <form
name="myForm" method="post" novalidate id="register" action="<?php $_SERVER['PHP_SELF'];?>">
        
        
                            <fieldset>
                            
          <?php if(isset($data['ReturnMessage']['msg'])){?>
 <div class="alert alert-danger"><?php echo $data['ReturnMessage']['msg'];?></div>
          <?php }?>                  
                            
                            
  <span style="color:red" ng-show="myForm.email.$dirty && myForm.email.$invalid">
  <span ng-show="myForm.email.$error.required">Email is required.</span>
  <span ng-show="myForm.email.$error.email">Invalid email address.</span>
  </span>

  <span style="color:red" ng-show="myForm.email.$dirty && myForm.email.$invalid">
   <span ng-show="myForm.email.$error.email">Invalid email address.</span>
  </span>
  
  	<span style="color:red" ng-show="myForm.fname.$dirty && myForm.fname.$invalid">
  <span ng-show="myForm.fname.$error.required">Full name is required.</span>
  </span>


                            <div class="input-group">
                              <div class="input-group-addon">
                              <span class="glyphicon glyphicon-user"></span>
                              </div>
                              <input type="text" class="form-control col-lg-2" id="exampleInputAmount" placeholder="First name and last name" name="fname" ng-model="fname" required>
                            </div> 
                            
                              <div class="input-group">
                              <div class="input-group-addon">
                               <span class="glyphicon glyphicon-phone"></span>
                              </div>
                              <input type="number" class="form-control" id="exampleInputAmount" placeholder="Phone number" name="phone" ng-model="phone" required>
                            </div>
  
                            <div class="input-group">
                              <div class="input-group-addon">@</div>
                              <input type="text" class="form-control" id="exampleInputAmount" placeholder="Email" name="email" ng-model="email" required>
                            </div>
                            
     <span style="color:red" ng-show="myForm.password.$dirty && myForm.password.$invalid">
   <span ng-show="myForm.password.$error.required">Password is required.</span>
  </span>        
  
                          
                                <div class="input-group">
                              <div class="input-group-addon">
                              <span class="glyphicon glyphicon-lock"></span>
                              </div>
                              <input type="password" class="form-control" id="exampleInputAmount" placeholder="Password" name="password" data-ng-model="password" required>
                            </div>
                            
                         
                             <div class="input-group">
                              <div class="input-group-addon">
                              <span class="glyphicon glyphicon-lock"></span>
                              </div>
                              <input type="password" class="form-control" id="exampleInputAmount" placeholder="Confirm Password" name="confirm_password" ng-model="password_verify" required data-password-verify="password">
                            </div>
<!---->
      <div style="color:red" ng-show="myForm.confirm_password.$error.passwordVerify">
        Password fields are not equal!</div>
                            
<span ng-show="myForm.cpassword.$error.passwordVerify" style="color:red">Passwords do not match.</span>                            


<div class="input-group">
          <div class="input-group-addon">
          <span class="">I am a</span>
          </div>
         <select class="form-control" name="register_type">
         <option value="student">Student</option>
          <option value="lecturer">Teacher</option>
          <option value="content_provider">Content Provider</option>
          </select>

           </div>                            
                                <label>
         <input type="checkbox" value="1" name="terms" ng-model="check" required> I agree with the <a href="#">terms</a>
                                    </label>
                                <!-- Change this to a button or input when using this as a form -->
       <input type="submit" class="btn btn-sm btn-success btn-block"  ng-disabled="myForm.$invalid" value="Sign Up">
                            </fieldset>
                        </form>
                      
                    </div>
                    
                    
                </div>
                
                
      <form method="post" class="pull-left"enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF'];?>" style="display:none">
  <table class="col-sm-6 table table-bordered table-striped">
    <?php if(isset($data['uresult']['msg'])){?>
    <tr>
    <td colspan="4">
      <div class="alert alert-info"><?php echo $data['uresult']['msg'];?></div>
    </td>
    </tr>
    <?php }?>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2"><input type="file" name="csv_result" class="span3 pull-left" value="Upload CSV file"/></td>
    </tr>

    <tr>
      <td colspan="4">
        <input type="submit" class="pull-right btn btn-primary" style="margin-left:10px" value="Upload Results">
      </td>
    </tr>
  </table>
  </form>
            </div>
            
            
          
     <?php }elseif((isset($_SESSION['stage2']))&&(!isset($_SESSION['stage3']))){?>  
     <div class="col-md-4 col-md-offset-4">
		<div class="login-panel panel panel-default" style="margin-top:90px">
           
    <div class="panel-body">

                            <fieldset>
                            
  	

	<h3 style="text-align:center">CONGRATULATIONS!!!</h3><br>
	<div class="alert alert-info">Your account has been created!. You are just one step away. Please input your phone number to verify your account </div>
    
     <?php if($data['ReturnMessage']['msg']){?>
 <div class="alert alert-danger"><?php echo $data['ReturnMessage']['msg'];?></div>
          <?php }?>  
          
     <div class="input-group col-lg-8 pull-left">
      <div class="input-group-addon">
      <span class="fa fa-phone">+234</span>
      </div>
    <input type="number" class="form-control" id="user_phone" placeholder="Input Phone Number" style="font-size:16px" name="phone_number" ng-model="phone" required>
    <input type="hidden" id="reg_type"  name="reg_type" value="<?php echo $_SESSION['stage2']['reg_type'];?>">
    <input type="hidden" name="email" id="user_email" value="<?php echo $_SESSION['stage2']['email'];?>">
    
      </div> 
      <img src="<?php echo $dirlocation;?>c_app/views/images/default.gif" width="25px" class="loader" style="margin-top:5px;display:none"/>
      <button type="button" class="pull-right btn btn-sm btn-success" style="margin-top:4px" ng-disabled="!phone" ng-click="activatephone()">Send sms</button>
      <div style="clear:both"></div>
      
      <form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
          <input type="hidden"  name="reg_type" value="<?php echo $_SESSION['stage2']['reg_type'];?>">
    <input type="hidden" name="email" value="<?php echo $_SESSION['stage2']['email'];?>">

      <div class="input-group">
      <div class="input-group-addon">
      <span class="fa fa-question-circle"></span>
      </div>
    <input type="text" class="form-control" id="activation_code" placeholder="Input Activation code" style="font-size:16px;display:nne" name="activation_phone_code" ng-model="activation_code" required>
      </div>
      
                            
                                
    <div style="text-align:center">
<input type="submit" class="btn btn-sm btn-info btn-block" style="float:none;margin:0 auto"  ng-disabled="!activation_code" value="VERIFY MY PHONE NUMBER">
</div>
</form>
                             
             </fieldset>
                      
                    </div>
    
	</div>
     </div>

	<?php }elseif($_SESSION['stage3']){?>
    <div class="col-md-4 col-md-offset-4">
	<div class="login-panel panel panel-default" style="margin-top:90px">
           
    <div class="panel-body">
<div style="text-align:center">
<img src="<?php echo $dirlocation;?>app/views/images/comment.gif" class="loader" style="margin:auto;display:none"/>
</div>
                   <form
name="completeRegisgration" method="post" novalidate id="register" action="<?php $_SERVER['PHP_SELF'];?>">
        
        
                            <fieldset>
                            

				<div class="panel-heading">
                        <h3 class="panel-title" style="text-align:center">
                        <img src="<?php echo $dirlocation.'c_app/views/images/logo.png';?>" height="100px" style="border-radius:0%;border:2px solid #fff" /><br/>
                         </h3>
                    </div>    
    
	<h3 style="text-align:center">Welcome to CollegeMobile! You are just a click away.</h3>
    
     <?php if(isset($data['ReturnMessage']['msg'])){?>
 <div class="alert alert-danger"><?php echo $data['ReturnMessage']['msg'];?></div>
     <?php }?> 
         
<span style="color:red" ng-show="completeRegisgration.id_number.$dirty && completeRegisgration.id_number.$invalid">
  <span ng-show="completeRegisgration.id_number.$error.required">Registration number is required</span>
  </span> 
  
  <label>Enter your school's registration number</label>
  <div class="input-group">
       <div class="input-group-addon">
          <span class="fa fa-user"></span>
          </div>
         <input type="text" name="id_number" class="form-control" required ng-model="id_number"/>

           </div>
             
  <input type="hidden" id="reg_type"  value="<?php echo $_SESSION['stage2']['reg_type'];?>" name="reg_type">
    <input type="hidden" name="email" value="<?php echo $_SESSION['stage2']['email'];?>">
    
     <label>Please select your school</label>
     <div class="input-group">
       <div class="input-group-addon">
          <span class="fa fa-home"></span>
          </div>
         <select class="form-control" name="school">
         <option value="University of Abuja (UNIABUJA)">University of Abuja (UNIABUJA)</option>
          <option value="Nassarawa State University (NSUT)">Nassarawa State University(NSUT)</option>
          </select>

           </div> 
           <label>Please select your Department</label>
                            
        <div class="input-group">

          <div class="input-group-addon">
          <span class="fa fa-home"></span>
          </div>
         <select class="form-control" name="department">
         <option value="Zoology">Department of Zoology</option>
          <option value="Chemistry">Department of Chemistry</option>
          <option value="Botany">Department of Botany</option>
          <option value="Psychology">Department of Psychology</option>
          <option value="Law">Department of Law</option>
          <option value="Phylosophy">Department of Phylosophy</option>
          </select>

           </div>                 
            
           <input type="submit" class="btn btn-sm btn-info btn-block"  ng-disabled="completeRegisgration.$invalid" value="SAVE AND CONTINUE">  
           
           <span style="float:right;margin-top:20px">
           <a href="<?php echo $dirlocation;?>learn/feeds">
           <strong>SKIP THIS</strong>
           </a>
           </span>                  
               </fieldset>
                        </form>
                      
                    </div>
    
	</div>
     </div>
    <?php }?>
      
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
