<style>
/* custom template */
html, body {
   height: 100%;
   font-family:verdana,arial,sans-serif;
   color:#555555;
}

.nav {
   font-family:Arial,sans-serif;
   font-size:13px;
}

a {
  color:#222222;
}

a:hover {
  text-decoration:none;
}

hr {
  border-color:#dedede;
}

.wrapper, .row {
   height: 100%;
   margin-left:0;
   margin-right:0;
}

.wrapper:before, .wrapper:after,
.column:before, .column:after {
    content: "";
    display: table;
}

.wrapper:after,
.column:after {
    clear: both;
}

.column {
    height: 100%;
    overflow: auto;
    *zoom:1;
}

.column .padding {
    padding: 20px;
}

.full{
	padding-top:70px;
}

.box {
  	bottom: 0; /* increase for footer use */
    left: 0;
    position: absolute;
    right: 0;
    top: 0;
    background-color:#444444;
  /*
    background-image:url('/assets/example/bg_suburb.jpg');
    background-size:cover;
    background-attachment:fixed;
  */
}

.divider {
	margin-top:32px;
}

.navbar-blue {
    border-width:0;
	background-color:#3B5999;
    color:#ffffff;
    font-family:arial,sans-serif;
    top:0;
    position:fixed;
    width:inherit;
}

.navbar-blue li > a,.navbar-toggle  {
   color:#efefef;
}

.navbar-blue .dropdown-menu li a {color:#2A4888;}
.navbar-blue .dropdown-menu li > a {padding-left:30px;}

.navbar-blue li>a:hover, .navbar-blue li>a:focus, .navbar-blue .open, .navbar-blue .open>a, .navbar-blue .open>a:hover, .navbar-blue .open>a:focus {
   background-color:#2A4888;
   color:#fff;
}

#main {
   background-color:#e9eaed;
   padding-left:0;
   padding-right:0;
}
#main .img-circle {
   margin-top:18px;
   height:70px;
   width:70px;
}

#sidebar {
    padding:0px;
	padding-top:15px;
}

#sidebar, #sidebar a, #sidebar-footer a {
    color:#ffffff;
    background-color:transparent;
	text-shadow:0 0 2px #000000;
    padding-left:5px;
}
#sidebar .nav li>a:hover {
    background-color:#393939;
}

.logo {
  display:block;
  padding:3px;
  background-color:#fff;
  color:#3B5999;
  height:28px;
  width:28px;
  margin:9px;
  margin-right:2px;
  margin-left:15px;
  font-size:20px;
  font-weight:700;
  text-align:center;
  text-decoration:none;
  text-shadow:0 0 1px;
  border-radius:2px;
}
#sidebar-footer {
  background-color:#444;
  position:absolute;
  bottom:5px;
  padding:5px;
}
#footer {
  margin-bottom:20px;
}

/* bootstrap overrides */

h1,h2,h3 {
   font-weight:800;
}

.navbar-toggle, .close {
	outline:0;
}

.navbar-toggle .icon-bar {
	background-color: #fff;
}

.btn-primary,.label-primary,.list-group-item.active, .list-group-item.active:hover, .list-group-item.active:focus  {
	background-color:#3B5999;
    color:#fffffe;
}
.btn-default {
    color:#666666;
    text-shadow:0 0 1px rgba(0,0,0,.3);
}
.form-control {
	
}

.panel textarea, .well textarea, textarea.form-control
{
   resize: none;
}
  
.badge{
   color:#3B5999;
   background-color:#fff;
}
.badge:hover, .badge-inverse{
   background-color:#3B5999;
   color:#fff;
}
    
.jumbotron {
  background-color:transparent;
}
.label-default {
  background-color:#dddddd;
}
.page-header {
  margin-top: 55px;
  padding-top: 9px;
  border-top:1px solid #eeeeee;
  font-weight:700;
  text-transform:uppercase;
  letter-spacing:2px;
}

.panel-default .panel-heading {
  background-color:#f9fafb;
  color:#555555;
}

.col-sm-9.full {
    width: 100%;
}

.modal-header, .modal-footer {
	background-color:#f2f2f2;
    font-weight:800;
    font-size:12px;
}

.modal-footer i, .well i {
    font-size:20px;
    color:#c0c0c0;
}

.modal-body {
	padding:0px;
}

.modal-body textarea.form-control
{
   resize: none;
   border:0;
   box-shadow:0 0 0;
}

small.text-muted {
  font-family:courier,courier-new,monospace;
}

/* adjust the contents on smaller devices */
@media (max-width: 768px) {

  .column .padding {
    padding: 7px;
  }

  .full{
	padding-top:20px;
  }

  .navbar-blue {
	background-color:#3B5999;
    top:0;
    width:100%;
    position:relative;
  }

}


/*
 * off canvas sidebar
 * --------------------------------------------------
 */
@media screen and (max-width: 768px) {
  .row-offcanvas {
    position: relative;
    -webkit-transition: all 0.25s ease-out;
    -moz-transition: all 0.25s ease-out;
    transition: all 0.25s ease-out;
  }

  .row-offcanvas-left.active {
    left: 33%;
  }

  .row-offcanvas-left.active .sidebar-offcanvas {
    left: -33%;
    position: absolute;
    top: 0;
    width: 33%;
    margin-left: 5px;
  }

  #sidebar, #sidebar a, #sidebar-footer a {
    padding-left:3px;
  }
}
</style>
<div class="row">
<div class=" col-lg-9">
                      
                        <!-- content -->                      
                      	<div class="row">
                         <!-- main col left --> 
                         <div class="col-sm-6">
    <?php while($grab=mysql_fetch_array($data['allcourseware']['library'][0])){
		$explode=end(explode('.',strtolower($grab['path'])));
		?>                           
                              <div class="panel panel-default">
                    <div class="title_background" style="background:url(<?php echo $dirlocation;?>c_app/views/images/header_bg/<?php echo 'blue1';?>.jpg)">
                    <p class="lead" style="font-size:20px;padding:0;margin:0;">
								  <?php echo $grab['course_title'];?><br/>
                                  <span style="font-size:14px">
								  <?php echo $grab['course_description'];?>
                    </span>
                    </div>          
                    
                     <img src="<?php echo $dirlocation.'c_app/views/images/icon_'.$explode.'.png';?>" class="img-responsive" width="15%" style="margin:-20px 10px;float:left">
                                <div class="panel-body" style="margin-top:-10px">
                          <p style="font-size:10px;float:right">45 Downloads, 13 preview(s)</p>
                                  
                                  </p>
                                  
                                  
                                  <div style="clear:both">
                                   <a href="<?php echo $dirlocation;?>c_app/views/<?php echo $grab['path'];?>" class="label btn btn-info btn-sm">
                        <i class="fa fa-folder-open"></i>
                        Open File</a>
                        
                        <a href="<?php echo $dirlocation;?>c_app/views/<?php echo $grab['path'];?>" class="label btn btn-success btn-sm">
                        <i class="fa fa-share"></i>
                        Share</a>
                        
                        <a href="<?php echo $dirlocation;?>c_app/views/<?php echo $grab['path'];?>" class="label btn btn-primary btn-sm">
                        <i class="fa fa-tag"></i>
                        Pin</a>  
                                  </div>
                                </div>
                                
                                
                              </div>

 <?php }?>                          
                              
                           
                              
                           
                          </div>
                          
                          <!-- main col right -->
                          <div class="col-sm-6">
    <?php
	$crud=new Crud;
	
	while($grab=mysql_fetch_array($data['allclassroom']['classroom'][0])){
			
	$getownerdetails=$crud->dbselect('lecturer','*',"staff_id='".$grab['staff_id']."'","");
	if($getownerdetails[2]==0){
	$getownerdetails=$crud->dbselect('student','*',"reg_number='".$grab['staff_id']."'","");	
	}
	
	$getstudentsinaclass=$crud->dbselect('classroom_users','*',"classroom_id='".$grab['classroom_id']."'","");	
	$getbooksinaclass=$crud->dbselect('courseware','*',"classroom_id='".$grab['classroom_id']."'","");	
	$checkclassroom=$crud->dbselect('classroom_users','*',"student_id='".$_SESSION['accessLogin']['user_id']."'AND classroom_id='".$grab['classroom_id']."'",'');
	?>                           
                      <div class="panel panel-default">
                                 <div class="panel-heading"><a href="#" class="pull-right">Enter class</a><h4><i class="fa fa-group"></i> <?php echo $grab['classroom_title'];?></h4></div>
                                  <div class="panel-body">
                                    <p><img src="<?php if($grab['photo']==''){echo $dirlocation.'c_app/views/images/anonymous.png';}else{echo $dirlocation.'c_app/views/images/'.$grab['photo'];}?>" width="10%" class="img-circle pull-right"> <a href="#">Teacher: <?php echo $getownerdetails[0]['full_name'];?></a></p>
                                    <div class="clearfix"></div>
                                    <hr style="margin-bottom:10px;padding-bottom:0;">
                                    
<p style="margin-top:0;padding-top:0"><?php echo $grab['classroom_description'];?></p>
                                    
                                    <hr>
                                    <form>
                                    <div class="input-group">
                                      <div class="input-group-btn">
                                      <?php if($checkclassroom[2]==0){?>
                                      <a href="<?php echo $dirlocation;?>learn/feeds?join=<?php echo $grab['classroom_id'];?>" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Join this classroom">
                                      +Join Class
                                      </a><?php }else{?>
                                      <a href="<?php echo $dirlocation;?>learn/feeds?leave=<?php echo $grab['classroom_id'];?>" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Leave this classroom">
                                      Leave Class
                                      </a><?php }?>
                                      <button class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Share to a friend or on social media"><i class="glyphicon glyphicon-share"></i></button> 
                                      <button class="btn btn-default"><i class="fa fa-group"></i> <?php echo $getstudentsinaclass[2];?></button>
                                      
                                      <button class="btn btn-default"><i class="fa fa-book"></i> <?php echo $getbooksinaclass[2];?></button>
                                         
                                      </div>
                                    </div>
                                    </form>
                                
                        </div>
                                  
                                  
                            </div>
                               
     <?php }?>                          
                               
                               
                            
                               

                               
                            
                               <div class="panel panel-default" style="display:none">
                                <div class="panel-thumbnail"><img src="/assets/example/bg_4.jpg" class="img-responsive"></div>
                                <div class="panel-body">
                                  <p class="lead">Social Good</p>
                                  <p>1,200 Followers, 83 Posts</p>
                                  
                                  <p>
                                    <img src="https://lh6.googleusercontent.com/-5cTTMHjjnzs/AAAAAAAAAAI/AAAAAAAAAFk/vgza68M4p2s/s28-c-k-no/photo.jpg" width="28px" height="28px">
                                    <img src="https://lh4.googleusercontent.com/-6aFMDiaLg5M/AAAAAAAAAAI/AAAAAAAABdM/XjnG8z60Ug0/s28-c-k-no/photo.jpg" width="28px" height="28px">
                                    <img src="https://lh4.googleusercontent.com/-9Yw2jNffJlE/AAAAAAAAAAI/AAAAAAAAAAA/u3WcFXvK-g8/s28-c-k-no/photo.jpg" width="28px" height="28px">
                                  </p>
                                </div>
                              </div>
                            
                          </div>
                       </div><!--/row-->
                      
                        <div class="row">
                          <div class="col-sm-6">
                            <a href="#">Twitter</a> <small class="text-muted">|</small> <a href="#">Facebook</a> <small class="text-muted">|</small> <a href="#">Google+</a>
                          </div>
                        </div>
                      
                        
                      
                  
                    </div>
           <?php include('c_app/views/learn/snipets/right_column_content.php');?>
</div>                    
                    <div style="clear:both"></div>


<!--post modal-->

