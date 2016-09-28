<?php 
//require_once('c_app/models/CrudModel.php');
$crud=new Crud;
$getownerdetails=$crud->dbselect('lecturer','*',"rand='".$data['details']['content'][0]['staff_id']."'","");
	if($getownerdetails[2]==0){
	$getownerdetails=$crud->dbselect('student','*',"rand='".$data['details']['content'][0]['staff_id']."'",""	);	
	if($getownerdetails[2]==0){
	$getownerdetails=$crud->dbselect('contentprovider','*',"rand='".$data['details']['content'][0]['staff_id']."'",""	);
	}
    }
?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="utf-8">
 <meta name="description" content="<?php echo $dirlocation;?>learn/courseware/view?view=<?php echo $_GET['view'];?>">
     <meta property="og:url" content="<?php echo $dirlocation.$data['Details'][0]['year'].'/'.$data['Details'][0]['month'].'/'.$data['Details'][0]['link'].'/';?>" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="<?php echo $data['library']['library'][0]['course_description'];?>" />
    <meta property="og:description"   content="<?php echo $data['library']['library'][0]['course_description'].'...';?>
" />
    <meta property="og:image"         content="<?php echo $dirlocation.'app/views/images/'.$data['library']['library'][0]['banner'];?>" />

    <meta name="keywords" content="Nigerian Courseware, Online Learning, Online Tutoring">

    <title>College Mobile: Learn, Teach and Collaborate</title>


<link href="<?php echo $dirlocation;?>c_app/views/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo $dirlocation;?>c_app/views/css/indexcss/chosen.css" rel="stylesheet">
<link href="<?php echo $dirlocation;?>c_app/views/css/indexcss/jquery.mobile-menu.css" rel="stylesheet">
<link href="<?php echo $dirlocation;?>c_app/views/css/indexcss/style.css" rel="stylesheet">

<link href="<?php echo $dirlocation;?>c_app/views/css/indexcss/color.css" rel="stylesheet">
<link href="<?php echo $dirlocation;?>c_app/views/css/indexcss/responsive.css" rel="stylesheet">
<link href="<?php echo $dirlocation;?>c_app/views/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css">


    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css'>

        <link rel="stylesheet" href="<?php echo $dirlocation;?>c_app/views/css/loginstyle.css">
		<link rel="stylesheet" href="<?php echo $dirlocation;?>c_app/views/css/bootstrap.css">
    
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    
  </head>

  <body class="wp-smartstudy" style="background: url(<?php echo $dirlocation;?>c_app/views/images/login_background3.png) repeat fixed;font-family: 'Raleway', sans-serif;" ng-app="jaraja"  ng-controller="Login">
  
  <div class="wrapper"> 

      <?php include('c_app/views/snipets/header.php');?>

      <div class="container">
          <div class="col-lg-12">
              
                
    <div class="col-lg-9">
        <h2><?php echo $data['details']['content'][0]['course_title'];?></h2>
        <span style="font-family:sans-serif;font-size:11px"><strong>Created by</strong>: <a href="#"><?php echo $getownerdetails[0]['full_name'];?></a> <strong>Published</strong>: <?php echo $data['details']['content'][0]['date'];?></span>
     <img src="<?php echo $dirlocation.'c_app/views/'.$data['details']['content'][0]['banner'];?>" width="100%">   
    
    </div> 
          
    <div class="col-lg-3" style="margin-top:40px">
        <h3><?php if($data['details']['content'][0]['fee']!=''){echo '<b>&#x20A6;</b>'.$data['details']['content'][0]['fee'];}else{echo "Free";}?></h3> 
        <a href="<?php echo $dirlocation;?>learn/courseware/view?view=<?php echo $data['details']['content'][0]['courseware_id'];?>" class="btn btn-success" style="margin-bottom:10px">Enroll for This course</a>
        <a href="#" class="btn btn-default">Pin This course</a>
        <h4>Share</h4>
        <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
        <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
        <a class="a2a_button_facebook"></a>
        <a class="a2a_button_twitter"></a>
        <a class="a2a_button_google_plus"></a>
        </div>
        
        <hr>
        Lecturer: <?php echo $getownerdetails[0]['full_name'];?>
        Course Duration: <?php echo $data['details']['content'][0]['course_duration'];?>
        Language: English
    </div>          
<div style="clear:both"></div>
    <div class="row">
    <div class="col-lg-12">
    <div class="col-lg-9">  
    <hr>    
     <h2>About This Course</h2>  
        <hr/>
        <h3 style="font-weight:normal !important">Course Description</h3>
        <p style="line-height:30px">
      <?php echo $data['details']['content'][0]['course_description'];?>   
      </p>   
      
      <h3 style="font-weight:normal !important">Course Otline</h3>
        <p style="line-height:30px">
      <?php echo $data['details']['content'][0]['course_outline'];?>   
      </p>   
    </div> 
    
    <!---- MAKE IT VISIBLE LATER -->
      <div class="col-lg-3" style="display:none">
        <h5 style="font-weight:bold">Student Who Viewed This Course Also Viewed</h5>
        
        
        </div>  
        
        
        </div>    
        
    </div>          
      </div>
      
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

    
<script type="text/javascript" src="//static.addtoany.com/menu/page.js"></script>

<script>
a2a_config.onclick = 1;
</script>
    
    
  </body>
</html>
