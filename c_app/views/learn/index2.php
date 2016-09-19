<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>College Mobile</title>
    <!-- Bootstrap Styles-->
    <link href="<?php echo $dirlocation;?>c_app/views/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="<?php echo $dirlocation;?>c_app/views/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="<?php echo $dirlocation;?>c_app/views/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="<?php echo $dirlocation;?>c_app/views/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    
    
    <link rel="stylesheet" type="text/css" href="<?php echo $dirlocation;?>c_app/views/css/tooltipster.bundle.css" />
</head>

<body ng-app="jaraja" ng-controller="Teach">
    <div id="wrapper" style="background:#0070A6;">
        <?php include('snipets/header.php');?>
        <!--/. NAV TOP  -->
        
         <?php include('snipets/left_panel.php');?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner" style="padding-left:0;margin:0;">

				<?php include('pages/'.$data['content'][1].'.php');?>

				<!--<footer><p>&copy;<?php echo date('Y');?> Mobicent Nig. Ltd</footer>-->
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="<?php echo $dirlocation;?>c_app/views/js/jquery-1.10.2.min.js"></script>
    <script src="<?php echo $dirlocation;?>c_app/views/lib/js/jquery.form.js"></script>
    <script src="<?php echo $dirlocation;?>c_app/views/js/angular/angular.js"></script>
    <script src="<?php echo $dirlocation;?>c_app/views/js/angular/angular-route.js"></script>
    <script src="<?php echo $dirlocation;?>c_app/views/js/angular/ngStorage.min.js"></script>
   <script src="<?php echo $dirlocation;?>c_app/views/js/angular/angular-cookies.js"></script>

     <script src="<?php echo $dirlocation;?>c_app/views/js/app.js"></script> 
       
 <script src="<?php echo $dirlocation;?>c_app/views/js/controllers/TeachCtrl.js"></script>
 
	<script type="text/javascript" src="<?php echo $dirlocation;?>c_app/views/js/tooltipster.bundle.min.js"></script>
    <script src="<?php echo $dirlocation;?>c_app/views/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="<?php echo $dirlocation;?>c_app/views/js/jquery.metisMenu.js"></script>
    <!-- Morris Chart Js -->
    <script src="<?php echo $dirlocation;?>c_app/views/js/morris/raphael-2.1.0.min.js"></script>
    <script src="<?php echo $dirlocation;?>c_app/views/js/morris/morris.js"></script>
    <!-- Custom Js -->
    <script src="<?php echo $dirlocation;?>c_app/views/js/custom-scripts.js"></script>

	


</body>

</html>