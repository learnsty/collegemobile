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

<body style="background: url(<?php echo $dirlocation;?>c_app/views/images/login_background.png) repeat fixed;font-family: 'Raleway', sans-serif;" ng-app="jaraja"  ng-controller="Registration">

	
    <!-- /.container -->
    <!-- Navigation -->
    <?php //include('c_app/views/snipets/header.php');?>

	<div class="col-lg-12" style="margin-top:;">
    	<?php if((!isset($_SESSION['stage3']))){?>  
     <div class="col-md-4 col-md-offset-4">
		<div class="login-panel panel panel-default" style="margin-top:90px">
           
    <div class="panel-body">

                            <fieldset>
                            
  	

	<h3 style="text-align:center">Hola <?php echo $_SESSION['accessLogin']['full_name'];?>!!!</h3><br>
	<div class="alert alert-info" style="text-align:center">There is a lot more you can do than you can ever imagine!. You are just one step away. Please input your phone number to verify your account </div>
    
     <?php if($data['ReturnMessage']['msg']){?>
 <div class="alert alert-danger"><?php echo $data['ReturnMessage']['msg'];?></div>
      <?php }?>  
          
     <div class="input-group col-lg-7 pull-left">
      <div class="input-group-addon">
      <span class="fa fa-phone"></span>
      </div>
    <input type="text" disabled="disabled" class="form-control pull-left" id="user_phone" placeholder="Input Phone Number" style="font-size:16px" name="phone_number" value="<?php echo $_SESSION['accessLogin']['phone_number'];?>" required>
    
    <input type="hidden" id="change_phone" name="change_phone">
    <input type="hidden" id="reg_type"  name="reg_type" value="<?php echo $_SESSION['accessLogin']['account_type'];?>">
    <input type="hidden" name="email" id="user_email" value="<?php echo $_SESSION['accessLogin']['email'];?>">
    
      </div> <a href="#" class="btn btn-sm btn-white" style="margin:;" ng-click="changephone()">Change</a>
      <img src="<?php echo $dirlocation;?>c_app/views/images/default.gif" width="25px" class="loader" style="margin-top:5px;display:none"/>
      <button type="button" class="pull-right btn btn-sm btn-success" style="margin-top:4px"  ng-click="activatephone()">Send sms</button>
      <div style="clear:both"></div>
      
      <form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
          <input type="hidden"  name="reg_type" value="<?php echo $_SESSION['accessLogin']['account_type'];?>">
    <input type="hidden" name="email" value="<?php echo $_SESSION['accessLogin']['email'];?>">

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
<?php }?>
	<?php if($_SESSION['stage3']){?>
    
    <?php if($_SESSION['accessLogin']['account_type']=='student'){?>
    <div class="col-md-4 col-md-offset-4">
	<div class="login-panel panel panel-default" style="margin-top:90px">
    <div class="legend" style="text-align:center">Welcome to CollegeMobile! You are just a click away.</div>       
    <div class="panel-body">
<div style="text-align:center">
<img src="<?php echo $dirlocation;?>app/views/images/comment.gif" class="loader" style="margin:auto;display:none"/>
</div>

<form
name="completeRegisgration" method="post" novalidate id="register" action="<?php $_SERVER['PHP_SELF'];?>">
        
        
                            <fieldset>
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
   
  <input type="hidden"  name="reg_type" value="<?php echo $_SESSION['accessLogin']['account_type'];?>">
    <input type="hidden" name="email" value="<?php echo $_SESSION['accessLogin']['email'];?>">
    
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
          
           <label>Enter your level</label>
  <div class="input-group">
       <div class="input-group-addon">
          <span class="fa fa-th"></span>
          </div>
         <select name="level" class="form-control">
         <option value="100">100 Level</option>
         <option value="200">200 Level</option>
         <option value="300">300 Level</option>
         <option value="400">400 Level</option>
         <option value="500">500 Level</option>
         <option value="600">600 Level</option>
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
