<div class="row" style="">
<div class="col-lg-7" style="padding-left:0">
<h4 class="page-header" style="margin-bottom:3px;text-align:center">Courseware</h4> 


<?php 
$crud=new Crud;
for($a=1;$a<=$data['library']['library'][2];$a++){
while($grab=mysql_fetch_array($data['library']['library'][0])){
	
//// GET OWNER DETAILS////	
$getownerdetails=$crud->dbselect('lecturer','*',"rand='".$grab['staff_id']."'","");
if($getownerdetails[2]==0){
$getownerdetails=$crud->dbselect('student','*',"rand='".$grab['staff_id']."'","");	
	if($getownerdetails[2]==0){
	$getownerdetails=$crud->dbselect('contentprovider','*',"rand='".$grab['staff_id']."'",""	);
	}

}

	/////// CHECK IF USER HAS PINED THE COURSEWARE
	$checkpin=$crud->dbselect('pin','*',"user_id='".$_SESSION['accessLogin']['user_id']."' AND table_id='".$grab['courseware_id']."'AND table_name='courseware'",'');

		
$split=end(explode('.',strtolower($grab['path'])));
$grabvalues[]=$grab;
?>  
<div class="col-lg-4" style="margin:0;padding:4px;overflow:hidden;">
                    <div class="panel panel-default">
                   <span style="font-family:sans-serif;font-size:11px;color:#666;padding-left:10px"><i class="fa fa-user"></i> <?php echo $getownerdetails[0]['full_name'];?></span>
                        <!-- /.panel-heading -->
                        <div class="panel-body" style="text-align:center;padding:5px 0;">
  <div style="height:120px;overflow:hidden">                      
<?php if(($grab['banner']=='')&&($split!='mp4')){?>
<img src="<?php echo $dirlocation;?>c_app/views/images/noimage.jpg" width="100%" />
<?php }elseif(($grab['banner']!='')){?>
<img src="<?php echo $dirlocation;?>c_app/views/<?php echo $grab['banner'];?>" width="100%" />	
<?php } else{?>
  <video id="video" width="100%" height="">
    <source src="<?php echo $dirlocation;?>c_app/views/<?php if($split=='mp4'){echo $grab['path'];}else{echo $grab['banner'];}?>" type="video/mp4">
    <p>
      Your browser doesn't support HTML5 video.
      <a href="videos/mikethefrog.mp4">Download</a> the video instead.
    </p>
  </video>
  <?php }?>
</div>
                        <h4><?php echo substr($grab['course_title'],0, 20).'...';?></h4>
                            <div class="dataTable_wrapper" style="height:40px;overflow:hidden">
                            <span style="font-size:11px">
                          
                            <?php echo substr($grab['course_description'],0, 40).'...';?>
                               </span> 
                          </div>
                          
                        
                        <a href="<?php echo $dirlocation;?>learn/courseware/view?view=<?php echo $grab['courseware_id'];?>" class="btn btn-white btn-xs">
                        <i class="fa fa-folder-open"></i>
                        View</a>
                        
                        <a class="btn btn-xs btn-white a2a_dd" data-toggle="modal" data-target="#myModalshare" data-a2a-url="<?php echo $dirlocation;?>learn/courseware/view?view=<?php echo $grab['courseware_id'];?>"><i class="fa fa-share"></i> Share </a>
                        
                        
<!--------IF THE OWNERS RAND IS NOT EQUAL TO THE CURRENT SESSION-
If the owner is not the creator of this classroom. That is the only condition inwhich the clip button should show
-->
                        <?php if($getownerdetails[0]['rand']!=$_SESSION['accessLogin']['user_id']){?>

                        <?php if($checkpin[2]==0){?>                                                            
<a href="<?php echo $dirlocation;?>learn/courseware?pin=<?php echo $grab['courseware_id'];?>&&table=courseware" class="btn btn-xs btn-white"><i class="fa fa-tag"></i> Clip </a>
<?php }elseif($checkpin[2]>0){?>
<a href="<?php echo $dirlocation;?>learn/courseware?unpin=<?php echo $checkpin[0]['pin_id'];?>&&table=courseware" class="btn btn-xs btn-danger"><i class="fa fa-tag"></i> Unclip </a>
<?php }?>

<?php }?>
  
                      </div>
                        <!-- /.panel-body -->
                    </div>
                    </div>
 <?php }}?>                   
  </div>
<div class="col-lg-5" style="margin:0;padding:4px;overflow:hidden;">
<h4 class="page-header" style="margin-bottom:3px;text-align:center">My Courseware</h4> 


<?php 
$crud=new Crud;
while($grab=mysql_fetch_array($data['library']['mylibrary'][0])){
$split=end(explode('.',strtolower($grab['path'])));
	
?>  
<div class="col-lg-6" style="margin:0;padding:0 5px;">
                    <div class="panel panel-default" style="">
                   
                        <!-- /.panel-heading -->
                        <div class="panel-body" style="text-align:center;padding:5px 0;">
                        
                         <div style="height:120px;overflow:hidden">                      
<?php if(($grab['banner']=='')&&($split!='mp4')){?>
<img src="<?php echo $dirlocation;?>c_app/views/images/noimage.jpg" width="100%" />
<?php }elseif(($grab['banner']!='')){?>
<img src="<?php echo $dirlocation;?>c_app/views/<?php echo $grab['banner'];?>" width="100%" />	
<?php } else{?>
  <video id="video" width="100%" height="">
    <source src="<?php echo $dirlocation;?>c_app/views/<?php if($split=='mp4'){echo $grab['path'];}else{echo $grab['banner'];}?>" type="video/mp4">
    <p>
      Your browser doesn't support HTML5 video.
      <a href="videos/mikethefrog.mp4">Download</a> the video instead.
    </p>
  </video>
  <?php }?>
</div>

                        <h4 style="padding:0 5px"><?php echo substr($grab['course_title'],0, 20).'...';?></h4>
                            <div class="dataTable_wrapper" style="height:40px;overflow:hidden">
                            <div style="font-size:11px;padding:0 5px">
                            <?php echo substr($grab['course_description'],0,50).'...';?>
                               </div> 
                          </div>
                          
                        
                        <a href="<?php echo $dirlocation;?>learn/courseware/view?view=<?php echo $grab['courseware_id'];?>" class=" btn btn-white btn-xs">
                        <i class="fa fa-folder-open"></i>
                        View</a>
                        
                        <a href="<?php echo $dirlocation;?>c_app/views/<?php echo $grab['path'];?>" class="btn btn-white btn-xs">
                        <i class="fa fa-pencil-square-o"></i>
                        Edit</a>
                        
                        <a href="<?php echo $dirlocation;?>c_app/views/<?php echo $grab['path'];?>" class="btn btn-white btn-xs">
                        <i class="fa fa-asterisk"></i>
                        Delete</a>  
                      </div>
                        <!-- /.panel-body -->
                    </div>
                    </div>

<?php }?>
</div>
                    <!-- /.panel -->
                </div>
