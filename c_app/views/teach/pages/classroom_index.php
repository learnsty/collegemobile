<div class="row">

<div class="col-lg-6" style="padding:0;margin:0;">
<h4 class="page-header" style="margin-bottom:3px;text-align:center">Joined Classroom</h4> 

<?php 
$crud=new Crud;
for($a=1;$a<=$data['classroom']['classroom'][2];$a++){
while($grab=mysql_fetch_array($data['classroom']['classroom'][0])){
$checkclassroom=$crud->dbselect('classroom_users','*',"student_id='".$_SESSION['accessLogin']['user_id']."'AND classroom_id='".$grab['classroom_id']."'",'');
?>
<?php if($checkclassroom[2]!=0){?>

                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-blue">
                            <div class="panel-body">
                                <i class="fa fa-users fa-5x"></i>
                              
                            </div>
                            <div class="panel-footer back-footer-blue">
                                <?php echo substr($grab['classroom_title'],0, 20).'...';?>
                            </div>
                            <div class="panel-footer back-footer-default">
                                <?php echo substr($grab['classroom_description'],0, 20).'...';?><br/>
                                <a href="<?php echo $dirlocation;?>learn/classroom/view?view=<?php echo $grab['classroom_id'];?>" class="label label-success">View</a>
                                
                                 <a href="<?php echo $dirlocation;?>learn/classroom?leave=<?php echo $grab['classroom_id'];?>" class="label label-danger">Leave Room</a>
                                
                               
                            </div>
                            
                            
                        </div>
                    </div>
                    
            <?php }?>        
       <?php }}?>  
       
       <?php if($checkclassroom[2]==0){?>
<div class="alert alert-danger" style="text-align:center;margin:20px 10px">You have not joined any classroom yet.<br/><br/><a href="" class="btn btn-primary">View Other Classrooms</a></div>
<?php }?>
                 
</div>


<div class="col-lg-6" style="padding:0;margin:0;">
<h4 class="page-header" style="margin-bottom:3px;text-align:center">Created Classroom</h4> 

<?php 
$crud=new Crud;
for($a=1;$a<=$data['classroom']['myclassroom'][2];$a++){
while($grab=mysql_fetch_array($data['classroom']['myclassroom'][0])){
$checkclassroom=$crud->dbselect('classroom_users','*',"classroom_id='".$grab['classroom_id']."'",'');

?>

                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-green">
                            <div class="panel-body">
                                <i class="fa fa-users fa-5x"></i>
                              
                            </div>
                            <div class="panel-footer back-footer-green">
                                <?php echo substr($grab['classroom_title'],0, 20).'...';?>
                            </div>
                            <div class="panel-footer back-footer-default">
                                <?php echo substr($grab['classroom_description'],0, 30).'...';?><br/>
                                 <a href="<?php echo $dirlocation;?>teach/classroom/view?view=<?php echo $grab['classroom_id'];?>&&lead=<?php echo  $_SESSION['accessLogin']['user_id'];?>">
                                 <span class="label label-success">
                          
                                View</span></a>
                                <a href="<?php echo $dirlocation;?>teach/classroom/newclassroom?edit=<?php echo $grab['classroom_id'];?>" class="label label-primary">Edit</a>
                                <a href="<?php echo $dirlocation;?>teach/classroom?delete=<?php echo $grab['classroom_id'];?>" class="label label-danger">Delete</a>
                            </div>
                            
                            <span style="fint-size:11px;color:#666"><?php echo $checkclassroom[2].' person(s)';?></span>
                        </div>
                    </div>
       <?php }}?>                   
</div>



</div>

