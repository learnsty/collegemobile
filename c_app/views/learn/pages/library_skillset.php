<div class="row">
<div class="col-lg-12">
<?php foreach ($skillset as $grab){
$getbooksunderskillset=$crud->dbselect('courseware','*',"skillset_id='".$grab['skillset_id']."'","LIMIT 8"
);			
?>
<?php if($getbooksunderskillset[2]!=0){?>
<div class="row" style="background:#fff;margin-bottom:10px">
<div class="col-lg-3 pull-left" style="color:#0C6">
<div class="col-lg-5 img-circle" style="background:#F7F7F7;float:none;margin:30px auto;text-align:center;padding:10px 0">
<span class="fa fa-file fa-4x"></span>
</div>
<h3 class="page-header" style="margin-bottom:3px;text-align:center;border:none;color:#666"><?php echo $grab['skillset_title'];?></h3>
</div>
<div class="col-lg-9 pull-left">

<?php 
while($grabook=mysql_fetch_array($getbooksunderskillset[1])){
$getownerdetails=$crud->dbselect('lecturer','*',"rand='".$grabook['staff_id']."'","");
if($getownerdetails[2]==0){
$getownerdetails=$crud->dbselect('student','*',"rand='".$grabook['staff_id']."'","");
if($getownerdetails[2]==0){
	$getownerdetails=$crud->dbselect('contentprovider','*',"rand='".$grabook['staff_id']."'",""	);
	}	
}
$split=end(explode('.',strtolower($grabook['path'])));


	/////// CHECK IF USER HAS PINED THE COURSEWARE
	$checkpin=$crud->dbselect('pin','*',"user_id='".$_SESSION['accessLogin']['user_id']."' AND table_id='".$grabook['courseware_id']."'AND table_name='courseware'",'');


?>
<div class="col-lg-3" style="margin:0;padding:4px;overflow:hidden;">
                    <div class="panel panel-default">
                   <span style="font-family:sans-serif;font-size:11px;color:#666;padding-left:10px"><i class="fa fa-user"></i> <?php echo $getownerdetails[0]['full_name'];?></span>
                        <!-- /.panel-heading -->
                        <div class="panel-body" style="text-align:center;padding:0;margin-bottom:5px">
  <div style="height:120px;overflow:hidden">                      
<?php if(($grabook['banner']=='')&&($split!='mp4')){?>
<img src="<?php echo $dirlocation;?>c_app/views/images/noimage.jpg" width="100%" />
<?php }elseif(($grabook['banner']!='')){?>
<img src="<?php echo $dirlocation;?>c_app/views/<?php echo $grabook['banner'];?>" width="100%" />	
<?php } else{?>
  <video id="video" width="100%" height="">
    <source src="<?php echo $dirlocation;?>c_app/views/<?php if($split=='mp4'){echo $grabook['path'];}else{echo $grabook['banner'];}?>" type="video/mp4">
    <p>
      Your browser doesn't support HTML5 video.
      <a href="videos/mikethefrog.mp4">Download</a> the video instead.
    </p>
  </video>
  <?php }?>
</div>
                        <h4><?php echo substr($grabook['course_title'],0, 10).'...';?></h4>
                            <div class="dataTable_wrapper" style="height:40px;overflow:hidden">
                            <span style="font-size:11px">
                          
                            <?php echo substr($grabook['course_description'],0, 40).'...';?>
                               </span> 
                          </div>
                          
                        
                        <a href="<?php echo $dirlocation;?>learn/courseware/view?view=<?php echo $grabook['courseware_id'];?>" class="btn btn-white btn-xs">
                        <i class="fa fa-folder-open"></i>
                        View</a>
                        
                        <a class="btn btn-xs btn-white a2a_dd" data-toggle="modal" data-target="#myModalshare" data-a2a-url="<?php echo $dirlocation;?>learn/courseware/view?view=<?php echo $grabook['courseware_id'];?>"><i class="fa fa-share"></i> Share </a>
                        
                        <?php if($checkpin[2]==0){?>                                                            
<a href="<?php echo $dirlocation;?>learn/library?pin=<?php echo $grabook['courseware_id'];?>&&table=courseware" class="btn btn-xs btn-white"><i class="fa fa-tag"></i> Clip </a>
<?php }elseif($checkpin[2]>0){?>
<a href="<?php echo $dirlocation;?>learn/library?unpin=<?php echo $checkpin[0]['pin_id'];?>&&table=courseware" class="btn btn-xs btn-danger"><i class="fa fa-tag"></i> Unclip </a>
<?php }?>

 
                      </div>
                        <!-- /.panel-body -->
                    </div>
                    </div>
<?php }?>
</div>
<a class="btn btn-sm btn-info pull-right" style="margin:5px">View All</a>
</div>
<?php }?>
<div  style="clear:both"></div>
<?php }?>

</div>


                    <!-- /.panel -->
                </div>
