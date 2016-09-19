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
}
		
$split=end(explode('.',strtolower($grab['path'])));
$grabvalues[]=$grab;
?>  
<div class="col-lg-4" style="margin:0;padding:4px;overflow:hidden;">
                    <div class="panel panel-default">
                   <span style="font-family:sans-serif;font-size:11px;color:#666;padding-left:10px"><i class="fa fa-user"></i> <?php echo $getownerdetails[0]['full_name'];?></span>
                        <!-- /.panel-heading -->
                        <div class="panel-body" style="text-align:center;padding:0;">
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
                        
                        <a href="<?php echo $dirlocation;?>c_app/views/<?php echo $grab['path'];?>" class="btn btn-white btn-xs">
                        <i class="fa fa-share"></i>
                        Share</a>
                        
                        <a href="<?php echo $dirlocation;?>c_app/views/<?php echo $grab['path'];?>" class="btn btn-white btn-xs">
                        <i class="fa fa-tag"></i>
                        Clip</a>  
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
                        <div class="panel-body" style="text-align:center;padding:0;">
                        
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
                        <i class="fa fa-share"></i>
                        Edit</a>
                        
                        <a href="<?php echo $dirlocation;?>c_app/views/<?php echo $grab['path'];?>" class="btn btn-white btn-xs">
                        <i class="fa fa-tag"></i>
                        Delete</a>  
                      </div>
                        <!-- /.panel-body -->
                    </div>
                    </div>

<?php }?>
</div>
                    <!-- /.panel -->
                </div>
