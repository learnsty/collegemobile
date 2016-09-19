<?php
$crud=new Crud;
	$split=strtolower(end(explode('.',$data['library']['library'][0]['path'])));
	
$getownerdetails=$crud->dbselect('lecturer','*',"rand='".$data['library']['library'][0]['staff_id']."'","");
	if($getownerdetails[2]==0){
	$getownerdetails=$crud->dbselect('student','*',"rand='".$data['library']['library'][0]['staff_id']."'","");
	if($getownerdetails[2]==0){
	$getownerdetails=$crud->dbselect('contentprovider','*',"rand='".$data['library']['library'][0]['staff_id']."'",""	);
	}
	
	}
	
	
?>



 <meta name="description" content="<?php echo $dirlocation;?>learn/courseware/view?view=<?php echo $_GET['view'];?>">
     <meta property="og:url" content="<?php echo $dirlocation.$data['Details'][0]['year'].'/'.$data['Details'][0]['month'].'/'.$data['Details'][0]['link'].'/';?>" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="<?php echo $data['library']['library'][0]['course_description'];?>" />
    <meta property="og:description"   content="<?php echo $data['library']['library'][0]['course_description'].'...';?>
" />
    <meta property="og:image"         content="<?php echo $dirlocation.'app/views/images/'.$data['library']['library'][0]['banner'];?>" />

    <meta name="keywords" content="Nigerian news,Nigerian politcs, Sports, Entertainment, Features, Lifestyle, Relationship">
    



<script>PDFObject.embed("c_app/views/courseware/2016_08_08_57064.pdf", "#example1");</script>
<script>
//var vid_duration = Math.round(document.getElementById("video").duration);
//alert(vid_duration);
</script>

<div class="row" style="padding:0;" ng-app="jaraja"  ng-controller="Teach">

<!----COURSEWARE IN THE CLASSROOM-->
<div class="col-lg-12">
<div class="panel panel-default" style="padding-top:0">
<!-- /.panel-heading -->
<div class="panel-body">
<h1 style="margin-top:0;text-align:center"><i class="fa fa-book"></i>: <?php echo $data['library']['library'][0]['course_title'];?></h1>
<hr style="margin-bottom:0"/>

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
 <?php echo $data['library']['library'][0]['course_description'];?>
 </p>
<hr />
<p style="line-height:30px;">
<h4>Outline</h4>
 <?php echo $data['library']['library'][0]['course_outline'];?>
 </p>
<hr />

<button class="btn btn-danger btn-block">Enroll</button>

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

<iframe src="http://docs.google.com/gview?url=<?php echo $dirlocation;?>c_app/views/<?php echo $data['library']['library'][0]['path'];?>" style="width:100%; min-height:400px;" frameborder="0"></iframe>

<?php }?>
</div>

<div class="col-lg-5">
<img src="<?php echo $dirlocation.'c_app/views/'.$data['library']['library'][0]['banner'];?>" width="100%" />
<div style="margin-top:10px"></div>
<?php
$crud=new Crud;
	/////// CHECK IF USER HAS PINED THE COURSEWARE
	$checkpin=$crud->dbselect('pin','*',"user_id='".$_SESSION['accessLogin']['user_id']."' AND table_id='".$data['library']['library'][0]['courseware_id']."'AND table_name='courseware'",'');
	?>
<?php if($checkpin[2]==0){?>                                                            
<a href="<?php echo $dirlocation;?>learn/courseware/view?view=<?php echo $data['library']['library'][0]['courseware_id'];?>&&pin=<?php echo $data['library']['library'][0]['courseware_id'];?>&&table=courseware" class="btn btn-white"><i class="fa fa-tag"></i> Clip </a>
<?php }elseif($checkpin[2]>0){?>
<a href="<?php echo $dirlocation;?>learn/courseware/view?view=<?php echo $data['library']['library'][0]['courseware_id'];?>&&unpin=<?php echo $checkpin[0]['pin_id'];?>&&table=courseware" class="btn btn-danger"><i class="fa fa-tag"></i> Unclip </a>
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


</div>
</div>

</div>


