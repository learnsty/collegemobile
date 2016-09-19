<div class="ibox float-e-margins">
<div class="" style="">
<div class="col-lg-6" style="padding:0">
<h4 class="page-header" style="margin-bottom:3px;text-align:center">Joined Classroom</h4> 

<?php 
$crud=new Crud;
for($a=1;$a<=$data['classroom']['classroom'][2];$a++){
while($grab=mysql_fetch_array($data['classroom']['classroom'][0])){
$checkclassroom=$crud->dbselect('classroom_users','*',"student_id='".$_SESSION['accessLogin']['user_id']."'AND classroom_id='".$grab['classroom_id']."'",'');
?>
<?php if($checkclassroom[2]!=0){?>
                    <div class="">
                        
                        <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5><?php echo substr($grab['classroom_title'],0, 25).'...';?></h5>
                                </div>
                                <div class="ibox-content no-padding">
                                    <ul class="list-group">
                                        
                                        <li class="list-group-item">
                                            <p><?php echo substr($grab['classroom_description'],0,300).'...';?></p>
                                            
                                <a href="<?php echo $dirlocation;?>learn/classroom/view?view=<?php echo $grab['classroom_id'];?>" class="btn btn-xs btn-info" style="">View</a>
                                
                                 <a href="<?php echo $dirlocation;?>learn/classroom?leave=<?php echo $grab['classroom_id'];?>" class="btn btn-xs btn-danger">Leave Room</a>
                                        </li>
                                        
                                       
                                    </ul>
                                     <div style="clear:both"></div>
                                </div>
                            </div>
                    </div>
                    <?php }?>
       <?php }}?>                   
</div>

<div class="col-lg-6">
<h4 class="page-header" style="margin-bottom:3px;text-align:center">My Created Classroom</h4> 

<?php 
$crud=new Crud;
for($a=1;$a<=$data['classroom']['myclassroom'][2];$a++){
while($grab=mysql_fetch_array($data['classroom']['myclassroom'][0])){
$checkclassroom=$crud->dbselect('classroom_users','*',"student_id='".$_SESSION['accessLogin']['reg_number']."'AND classroom_id='".$grab['classroom_id']."'",'');
?>
                    <div class="">
                        
                        <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5><?php echo substr($grab['classroom_title'],0, 25).'...';?></h5>
                                </div>
                                <div class="ibox-content no-padding">
                                    <ul class="list-group">
                                        
                                        <li class="list-group-item">
                                            <p><?php echo substr($grab['classroom_description'],0,300).'...';?></p>
                                            
                                            <a href="<?php echo $dirlocation;?>learn/classroom/view?view=<?php echo $grab['classroom_id'];?>&&lead=<?php echo  $_SESSION['accessLogin']['user_id'];?>" class="btn btn-xs btn-white">View</a>
                                
                                <a href="<?php echo $dirlocation;?>learn/classroom?edit=<?php echo $grab['classroom_id'];?>" class="btn btn-xs btn-white">Edit</a>
                                <a href="<?php echo $dirlocation;?>learn/classroom?edit=<?php echo $grab['classroom_id'];?>" class="btn btn-xs btn-white">Delete</a>
                                        </li>
                                        
                                        
                                    </ul>
                                    
                                </div>
                            </div>
                            
                            
                            
                    </div>
       <?php }}?>                   

</div>
</div>
</div>

</div>

