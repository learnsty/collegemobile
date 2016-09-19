
<div class="row" style="padding:0;" ng-app="jaraja"  ng-controller="Teach">


<!----STUDENTS IN THE CLASSROOM-->
<div class="col-lg-6">
<div class="panel panel-default" style="padding-top:0">
<!-- /.panel-heading -->
<div class="panel-body">
<h3 style="margin-top:0"><i class="fa fa-group"></i>: <span style="color:#09F"><?php echo $data['classroom']['classroom'][0]['classroom_title'];?></span>
<?php
$crud=new Crud;
if(!$_GET['lead']){
$checkclassroom=$crud->dbselect('classroom_users','*',"student_id='".$_SESSION['accessLogin']['user_id']."'AND classroom_id='".$data['classroom']['classroom'][0]['classroom_id']."'",'');
if($checkclassroom[2]==0){?>
                                <a href="<?php echo $dirlocation;?>learn/classroom/view?view=<?php echo $data['classroom']['classroom'][0]['classroom_id'];?>&&join=<?php echo $data['classroom']['classroom'][0]['classroom_id'];?>" class="label label-primary">Join Room</a><?php }else{?>
                                 <a href="<?php echo $dirlocation;?>learn/classroom/view?view=<?php echo $data['classroom']['classroom'][0]['classroom_id'];?>&&leave=<?php echo $data['classroom']['classroom'][0]['classroom_id'];?>" class="label label-danger label-sm">Leave Room</a>
                                <?php }?>
 <?php }?>                               
</h3>
<div style="padding:15px 7px 0 0;color:#999">
<?php echo $data['classroom']['classroom'][0]['classroom_description'];?>
</div>
<hr style="margin-bottom:0;margin-top:0" />
<h4 style="color:#09F;padding-left:10px;"> Students in this classroom</h4>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-condensed">
  <?php 
$crud=new Crud;
$students=$crud->dbselect('classroom_users AS T1 INNER JOIN student AS T2 ON T1.student_id=T2.reg_number','*',"T1.classroom_id='".$_GET['view']."'",'');
while($grab=mysql_fetch_array($students[1])){?>  
  <tr>
    <td width="14%">
    <img src="<?php if($grab['photo']==''){echo $dirlocation.'c_app/views/images/anonymous.png';}else{echo $dirlocation.'c_app/views/images/'.$grab['photo'];}?>" class="" width="55px" />
    </td>
    <td width="44%"><strong style="color:#09F"><?php echo $grab['full_name'];?></strong><br/>
    <?php echo $grab['user_id'];?>
    </td>
    <td width="26%"><?php echo $grab['email'];?><br/>
    <span class="label label-primary">View profile</span>
    </td>
    <td width="16%"><?php echo $grab['phone_number'];?></td>
  </tr>
  <?php }?>
</table>

</div>


</div>
</div>


<!----COURSEWARE IN THE CLASSROOM-->
<div class="col-lg-6">
<div class="panel panel-default" style="padding-top:0">
<!-- /.panel-heading -->
<div class="panel-body">
<h3 style="margin-top:0"><i class="fa fa-group"></i>: <span style="color:#09F"><?php echo $data['classroom']['classroom'][0]['classroom_title'];?></span></h3>
<hr style="margin-bottom:0" />
<h4 style="color:#09F;padding-left:10px;"> Courseware in this classroom</h4>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-condensed">
  <?php 
$crud=new Crud;
$courseware=$crud->dbselect('courseware','*',"classroom_id='".$_GET['view']."'",'');
while($grab=mysql_fetch_array($courseware[1])){
	$explode=end(explode('.',strtolower($grab['path'])));
	/////// CHECK IF USER HAS PINED THE COURSEWARE
	$checkpin=$crud->dbselect('pin','*',"user_id='".$_SESSION['accessLogin']['user_id']."' AND table_id='".$grab['courseware_id']."'AND table_name='courseware'",'');
	?>  
  <tr>
    <td width="16%">
     <img src="<?php echo $dirlocation;?>c_app/views/images/<?php echo 'icon_'.$explode.'.png';?>" width="55px" />
    </td>
    <td width="84%"><strong style="color:#09F">
	<?php echo $grab['course_title'];?></strong><br/>
      <?php echo $grab['course_description'];?>
      <span class="pull-right">
      <a href="<?php echo $dirlocation;?>learn/courseware/view?view=<?php echo $grab['courseware_id'];?>" class="btn btn btn-white btn-sm">
      					<i class="fa fa-folder-open"></i>
                        View</a>
                        
                        <a href="#" class="btn btn btn-white btn-sm">
                        <i class="fa fa-share"></i>
                        Share</a>
                        
                        <?php if($checkpin[2]==0){?>
                        <a href="<?php echo $dirlocation;?>learn/feeds?pin=<?php echo $grab['courseware_id'];?>&&table=courseware" class="btn btn btn-white btn-sm">
                        <i class="fa fa-tag"></i>
                        Clip</a>  
                        <?php }elseif($checkpin[2]>0){?>
<a href="<?php echo $dirlocation;?>learn/feeds?unpin=<?php echo $checkpin[0]['pin_id'];?>&&table=courseware" class="btn btn-xs btn-danger"><i class="fa fa-tag"></i> Unclip </a>
                        <?php }?>
      </span>
    </td>
    </tr>
  <?php }?>
</table>

</div>


</div>
</div>

</div>


