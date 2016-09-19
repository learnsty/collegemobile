<div class="col-lg-12" style="">
<div class="col-lg-5" style="padding:0;margin:0;">
<h4 class="page-header" style="margin-bottom:3px;text-align:center">Coursewares</h4> 

<?php 
$crud=new Crud;
for($a=1;$a<=$data['library']['library'][2];$a++){
while($grab=mysql_fetch_array($data['library']['library'][0])){
$explode=end(explode('.',strtolower($grab['path'])));

	//$Detailed_Wordcount=$miscModel->limit_words(strip_tags($grab['Details'],'<div>'), 20);

?>
<div class="col-md-6 col-sm-12 col-xs-12" style="margin:0;max-height:;">
                    <div class="panel panel-default">
                   
                        <!-- /.panel-heading -->
                        <div class="panel-body" style="text-align:center">
                        <img src="<?php echo $dirlocation;?>c_app/views/images/<?php echo 'icon_'.$explode.'.png';?>" width="40%" />
                        <h4><?php echo substr($grab['course_title'],0, 20).'...';?></h4>
                            <div class="dataTable_wrapper" style="height:40px;overflow:hidden">
                            <span style="font-size:11px">
                            <?php echo substr($grab['course_description'],0, 50).'...';?>
                            
                               </span> 
                          </div>
                          
<?php if($grab['staff_id']==$_SESSION['accessLogin']['staff_id']){?>                            
                        <a href="<?php echo $dirlocation;?>teach/library/newcourseware?edit=<?php echo $grab['course_ware_id'];?>" class="btn btn-primary btn-sm">Edit</a>  
                        
<?php }?>
                        
                        
                        <a href="<?php echo $dirlocation;?>c_app/views/<?php echo $grab['path'];?>" class="label btn btn-info btn-sm">Open File</a>  
                      </div>
                        <!-- /.panel-body -->
                    </div>
                    </div>
    <?php }}?>  
                    <!-- /.panel -->
                </div>


<div class="col-lg-7  col-sm-12 col-xs-12" style=";">
<h4 class="page-header" style="margin-bottom:3px;text-align:center">My Courseware</h4> 


<?php 
$crud=new Crud;
while($grab=mysql_fetch_array($data['library']['mylibrary'][0])){
$explode=end(explode('.',strtolower($grab['path'])));
	
?>  
<div class="col-lg-4" style="margin:0;padding:5px;max-height:;overflow:hidden;">
                    <div class="panel panel-default" style="">
                   
                        <!-- /.panel-heading -->
                        <div class="panel-body" style="text-align:center">
                        
                        <img src="<?php echo $dirlocation;?>c_app/views/images/icon_<?php echo $explode.'.png';?>" width="40%" />
                        <h5><?php echo substr($grab['course_title'],0, 15).'...';?></h5>
                            <div class="dataTable_wrapper" style="height:40px;overflow:hidden">
                            <span style="font-size:11px">
                            <?php echo $grab['course_description'];?>
                               </span> 
                          </div>
                          
                        
                        <a href="<?php echo $dirlocation;?>c_app/views/<?php echo $grab['path'];?>" class="label btn btn-info btn-sm">
                        <i class="fa fa-folder-open"></i>
                        Open</a>
                        
                        <a href="<?php echo $dirlocation;?>c_app/views/<?php echo $grab['path'];?>" class="label btn btn-primary btn-sm">
                        <i class="fa fa-share"></i>
                        Edit</a>
                        
                        <a href="<?php echo $dirlocation;?>c_app/views/<?php echo $grab['path'];?>" class="label btn btn-danger btn-sm">
                        <i class="fa fa-tag"></i>
                        Delete</a>  
                      </div>
                        <!-- /.panel-body -->
                    </div>
                    </div>

<?php }?>
</div>
</div>