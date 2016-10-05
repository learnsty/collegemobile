<?php
$crud=new Crud;
	$split=strtolower(end(explode('.',$data['library']['library'][0]['path'])));

/* CHECK FOR THE OWNER OF A COURSEWARE */
$getownerdetails=$crud->dbselect('lecturer','*',"rand='".$data['library']['library'][0]['staff_id']."'","");
	if($getownerdetails[2]==0){
	$getownerdetails=$crud->dbselect('student','*',"rand='".$data['library']['library'][0]['staff_id']."'","");
	if($getownerdetails[2]==0){
	$getownerdetails=$crud->dbselect('contentprovider','*',"rand='".$data['library']['library'][0]['staff_id']."'",""	);
	}
	
	}


                                 
   /////// CHECK IF USER HAVE ENROLLED FOR THIS COURSEWARE //////
 $checkenrol=$crud->dbselect('enrol','*',"courseware_id='".$data['library']['library'][0]['courseware_id']."' AND staff_id='".$_SESSION['accessLogin']['user_id']."'","");

///////// CHECK THE EXTENTION OF FILE////
$extension = strtolower(end(explode('.',$data['library']['library'][0]['path'])));
  //echo $extension;             

?>



 <meta name="description" content="<?php echo $dirlocation;?>learn/courseware/view?view=<?php echo $_GET['view'];?>">
     <meta property="og:url" content="<?php echo $dirlocation.$data['Details'][0]['year'].'/'.$data['Details'][0]['month'].'/'.$data['Details'][0]['link'].'/';?>" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="<?php echo utf8_decode($data['library']['library'][0]['course_description']);?>" />
    <meta property="og:description"   content="<?php echo utf8_decode($data['library']['library'][0]['course_description']).'...';?>">
    <meta property="og:image" content="<?php echo $dirlocation.'app/views/images/'.$data['library']['library'][0]['banner'];?>">

    <meta name="keywords" content="<?php echo $data['library']['library'][0]['course_title'];?>">
    



<!--<script>PDFObject.embed("c_app/views/courseware/2016_08_08_57064.pdf", "#example1");</script>-->
<script>
//var vid_duration = Math.round(document.getElementById("video").duration);
//alert(vid_duration);
</script>

<div class="row" style="padding:0;">

<!----COURSEWARE IN THE CLASSROOM-->
<div class="col-lg-12">
<div class="panel panel-default" style="padding-top:0">
<!-- /.panel-heading -->
<div class="panel-body">
<h1 style="margin-top:0;text-align:center"><i class="fa fa-book"></i>: <?php echo $data['library']['library'][0]['course_title'];?></h1>
<hr style="margin-bottom:0"/>

<?php if(!isset($_GET['enrol'])){?>
<div class="row">
<div class="col-lg-7">
<div class="sharebuttons" style="margin-bottom:7px;">
        <div class="a2a_kit a2a_kit_size_32 a2a_default_style" style="margin-bottom:10px">
<strong>SHARE ON:</strong><br/>
<!-- AddToAny BEGIN -->
<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
<a class="a2a_button_facebook"></a>
<a class="a2a_button_twitter"></a>
<a class="a2a_button_google_plus"></a>
</div>
<script async src="https://static.addtoany.com/menu/page.js"></script>
<!-- AddToAny END -->
</div>

        
        </div>
        

<p style="line-height:30px;">
<h4>About the course</h4>
 <?php echo utf8_decode($data['library']['library'][0]['course_description']);?>
 </p>
<hr />
<p style="line-height:30px;">
<h4>Outline</h4>
 <?php echo utf8_decode($data['library']['library'][0]['course_outline']);?>
 </p>
<hr />

    <!--CHECK IF THE LOGIN USER IS THE OWNER OF TEH COURSEWARE---->
 <?php if($data['library']['library'][0]['staff_id']!=$_SESSION['accessLogin']['user_id']){?>  
    
 <?php if($checkenrol[2]==0){?>  
    
<?php if($data['library']['library'][0]['fee']==''){?>    
 <a href="#" data-toggle="modal" data-target="#enrolModal" ng-click="enrol(&#39;<?php echo $data['library']['library'][0]['courseware_id'];?>&#39;, &#39;<?php echo $data['library']['library'][0]['course_title'];?>&#39;);" class="btn btn-danger btn-block">Enroll</a>
<?php }else{?>


  <form action="/process" method="POST" style="margin:0 auto;text-align:center" >
  <script
    src="https://js.paystack.co/v1/inline.js" 
    data-key="pk_test_5f710ad1d481bc6ecd8013e6a1cf2f235045b5df"
    data-email="mylearnsty@gmail.com"
    data-amount="<?php echo $data['library']['library'][0]['fee'];?>00"
    data-ref="<?php echo $data['library']['library'][0]['course_title'];?>"
  >
  </script>
</form>

<?php }?>    
    <?php }else{?>
    
  <?php if($extension=='zip'){?>
      <a href="javascript:void(0);" onclick="javascript:scormLauncher('<?php echo $dirlocation . 'c_app/views/learn/scorm/'; ?>' + 'runtime.php?debug=on&studentId=<?php echo $_SESSION['accessLogin']['user_id'];?>&courseId=<?php echo $data['library']['library'][0]['courseware_id'];?>&studentName=<?php echo str_replace(' ', ',',$_SESSION['accessLogin']['full_name']);?>&courseRootDir=<?php echo $dirlocation;?>c_app/views/courseware/<?php echo $data['library']['library'][0]['path'];?>')" class="btn btn-success" style="margin-top:10px">Goto Courseware</a>
    <?php }elseif($extension=='pdf'){?> 
    <a href="javascript:void(0);" class="btn btn-success" onclick="javascript:pdfLauncher('<?php echo $dirlocation . 'c_app/views/learn/pdfviewer/'; ?>viewer.php?open=<?php echo $dirlocation . 'c_app/views/'.$data['library']['library'][0]['path'];?>&studentId=<?php echo $_SESSION['accessLogin']['full_name'];?>');">Goto Courseware</a>
    

    
    
    <!---- if THE EXTENTION IS NOT A PDF AND ITS NOT A VIDEO--->
    <?php }else{?>
    
    <?php }?>

    
   
    
    <?php }?>
   
<?php }?>
    
<?php
$video_array=array('mp4','mgeg');
$image_array=array('jpg','png','gif');
if(in_array($split,$video_array)){?>
<video id="video" class="video-js" controls preload="auto" width="" height="320" data-setup="{}">
    <source src="<?php echo $dirlocation;?>c_app/views/<?php echo $data['library']['library'][0]['path'];?>" type='video/mp4'>
    <p class="vjs-no-js">
      To view this video please enable JavaScript, and consider upgrading to a web browser that
      <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
    </p>
  </video>
<?php }elseif(in_array($split,$image_array)){?>
<img class="img-responsive" src="<?php echo $dirlocation;?>c_app/views/<?php echo $data['library']['library'][0]['path'];?>" style="max-width:100%"/>
<?php }else{?>
<div id="example1"></div>

<!--    
<iframe src="http://docs.google.com/gview?url=<?php echo $dirlocation;?>c_app/views/<?php echo $data['library']['library'][0]['path'];?>" style="width:100%; min-height:400px;" frameborder="0"></iframe>
--->
<?php }?>
</div>

<div class="col-lg-5">
 <?php if($data['library']['library'][0]['fee']!=''){?>   
<h2 style="font-weight:normal;color:#0968b9"><b>&#x20A6;</b> <?php echo $data['library']['library'][0]['fee'];?></h2>   
<?php }else{?>
    <h2 style="font-weight:normal;color:#0968b9">Free</h2>
<?php }?>
    <hr/>
<img src="<?php echo $dirlocation.'c_app/views/'.$data['library']['library'][0]['banner'];?>" width="100%" />
<div style="margin-top:10px"></div>
<?php
$crud=new Crud;
	/////// CHECK IF USER HAS PINED THE COURSEWARE
	$checkpin=$crud->dbselect('pin','*',"user_id='".$_SESSION['accessLogin']['user_id']."' AND table_id='".$data['library']['library'][0]['courseware_id']."'AND table_name='courseware'",'');
	
	/////// CHECK IF USER HAS LIKED THE COURSEWARE
	$checklike=$crud->dbselect('liked','*',"user_id='".$_SESSION['accessLogin']['user_id']."' AND table_id='".$data['library']['library'][0]['courseware_id']."'AND table_name='courseware'",'');
	

                                 
                                 
		?>
<?php if($checkpin[2]==0){?>                                                            
<a href="<?php echo $dirlocation;?>learn/courseware/view?view=<?php echo $data['library']['library'][0]['courseware_id'];?>&&pin=<?php echo $data['library']['library'][0]['courseware_id'];?>&&table=courseware" class="btn btn-white btn-xs"><i class="fa fa-tag"></i> Clip </a>
<?php }elseif($checkpin[2]>0){?>
<a href="<?php echo $dirlocation;?>learn/courseware/view?view=<?php echo $data['library']['library'][0]['courseware_id'];?>&&unpin=<?php echo $checkpin[0]['pin_id'];?>&&table=courseware" class="btn btn-danger btn-xs"><i class="fa fa-tag"></i> Unclip </a>
<?php }?>

<?php if($checklike[2]==0){?>                                                            
<a href="<?php echo $dirlocation;?>learn/courseware/view?view=<?php echo $data['library']['library'][0]['courseware_id'];?>&&like=<?php echo $data['library']['library'][0]['courseware_id'];?>&&table=courseware" class="btn btn-xs btn-white"><i class="fa fa-heart"></i> Like </a>
<?php }elseif($checklike[2]>0){?>
<a href="<?php echo $dirlocation;?>learn/courseware/view?view=<?php echo $data['library']['library'][0]['courseware_id'];?>&&dislike=<?php echo $checklike[0]['like_id'];?>&&table=courseware" class="btn btn-xs btn-danger"><i class="fa fa-tag"></i> Unlike </a>
<?php }?>

<hr />
<a href="<?php echo $dirlocation.'learn/profile?profileid='.$getownerdetails[0]['rand'];?>">
<p style="font-size:12px;text-align:center" class="col-lg-3">
<strong>Creator</strong>
<img alt="image" class="img-circle thumbnail" src="<?php if($getownerdetails[0]['photo']==''){echo $dirlocation.'c_app/views/images/anonymous.png';}else{echo $dirlocation.'c_app/views/images/'.$getownerdetails[0]['photo'];}?>" style="width:70px;height:70px;margin:auto;float:none">
 <?php echo $getownerdetails[0]['full_name'];?><br/>
</p>
</a>
<p style="font-size:12px;text-align:center" class="col-lg-3">
<strong>Duration</strong>
<img alt="image" class="img-circle thumbnail" src="<?php echo $dirlocation.'c_app/views/images/timer_icon.png';?>" style="width:70px;height:70px;margin:auto;float:none">
 <?php echo $data['library']['library'][0]['course_duration'];?><br/>
</p>
</div>
</div>


</div>
<?php }elseif($_GET['enrol']){?>
    <div class="row">
<div class="col-lg-7" style="margin:auto; float:none;text-align:center">
    <h1>Congratulations <?php echo $_SESSION['accessLogin']['full_name'];?>!</h1>
    You have successfully enrolled For This Course
<br/>
    
    <?php if($extension=='zip'){?>
      <a href="javascript:void(0);" onclick="javascript:scormLauncher('<?php echo $dirlocation . 'c_app/views/learn/scorm/'; ?>' + 'runtime.php?debug=on&studentId=<?php echo $_SESSION['accessLogin']['user_id'];?>&courseId=<?php echo $data['library']['library'][0]['courseware_id'];?>&studentName=<?php echo str_replace(' ', ',',$_SESSION['accessLogin']['full_name']);?>&courseRootDir=<?php echo $dirlocation;?>c_app/views/courseware/<?php echo $data['library']['library'][0]['path'];?>')" class="btn btn-success" style="margin-top:10px">Goto Courseware</a>
    <?php }elseif($extension=='pdf'){?>
    
    <a href="javascript:void(0);" class="btn btn-success" onclick="javascript:pdfLauncher('<?php echo $dirlocation . 'c_app/views/learn/pdfviewer/'; ?>viewer.php?open=<?php echo $dirlocation . 'c_app/views/'.$data['library']['library'][0]['path'];?>&studentId=<?php echo $_SESSION['accessLogin']['full_name'];?>');">Goto Courseware</a>
    
    <!---- if THE EXTENTION IS NOT A PDF AND ITS NOT A VIDEO--->
    <?php }else{?>
    
    <?php }?>
    </div>
        
    </div>
<?php }?>
    
    
    
    
    

</div>


</div>
</div>

</div>


	<script src="<?php echo $dirlocation;?>c_app/views/learn/scorm/js/lib/cdv_js.js" type="text/javascript"></script>
    <script src="<?php echo $dirlocation;?>c_app/views/learn/inspinia/player_pdf/pdf_driver.js" type="text/javascript"></script>
	<script src="<?php echo $dirlocation;?>c_app/views/learn/inspinia/player_scorm/scorm_driver.js" type="text/javascript"></script>


