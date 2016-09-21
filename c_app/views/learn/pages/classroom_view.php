<?php
$crud=new Crud;
	
$getownerdetails=$crud->dbselect('lecturer','*',"rand='".$data['classroom']['classroom'][0]['staff_id']."'","");
	if($getownerdetails[2]==0){
	$getownerdetails=$crud->dbselect('student','*',"rand='".$data['classroom']['classroom'][0]['staff_id']."'","");
	if($getownerdetails[2]==0){
	$getownerdetails=$crud->dbselect('contentprovider','*',"rand='".$data['classroom']['classroom'][0]['staff_id']."'",""	);
	}
	
	}
	

?>

<div class="row" style="padding:0;" ng-app="jaraja"  ng-controller="Teach">


  
<!----STUDENTS IN THE CLASSROOM-->
<div class="col-lg-4">
<div class="panel panel-default" style="padding-top:0">
<!-- /.panel-heading -->
<div class="panel-body">
       
<h3 style="margin-top:8px"><i class="fa fa-group"></i> Title: <span style="color:#09F"><?php echo $data['classroom']['classroom'][0]['classroom_title'];?></span>
    
    <div  style="text-align:center">
    <strong style="font-size:12px">Class Creator</strong>
<img alt="image" class="img-circle thumbnail" src="<?php if($getownerdetails[0]['photo']==''){echo $dirlocation.'c_app/views/images/anonymous.png';}else{echo $dirlocation.'c_app/views/images/'.$getownerdetails[0]['photo'];}?>" style="width:70px;height:70px;margin:auto;float:none">
        
<span style="font-size:12px;clear:both">
                    
<?php echo substr($getownerdetails[0]['full_name'],0,20).'...';?>

</span>    

 <div class="clear:both;"></div>
    
<?php
$crud=new Crud;
if($_SESSION['accessLogin']['user_id']!=$data['classroom']['classroom'][0]['staff_id']){
$checkclassroom=$crud->dbselect('classroom_users','*',"student_id='".$_SESSION['accessLogin']['user_id']."'AND classroom_id='".$data['classroom']['classroom'][0]['classroom_id']."'",'');
    
if($checkclassroom[2]==0){?>
                                <a href="<?php echo $dirlocation;?>learn/classroom/view?view=<?php echo $data['classroom']['classroom'][0]['classroom_id'];?>&&join=<?php echo $data['classroom']['classroom'][0]['classroom_id'];?>" class="label label-primary" style="margin-top:10px">Join Room</a><?php }else{?>
                                 <a href="<?php echo $dirlocation;?>learn/classroom/view?view=<?php echo $data['classroom']['classroom'][0]['classroom_id'];?>&&leave=<?php echo $data['classroom']['classroom'][0]['classroom_id'];?>" class="label label-danger label-sm" style="margin-top:10px">Leave Room</a>
                                <?php }?>
 <?php }?> 

</div>        
</h3>
<div style="padding:0 7px 0 0;color:#999">
    <h3 style="margin-bottom:3px"> Details:</h3>
<?php echo substr($data['classroom']['classroom'][0]['classroom_description'],0,150).'...';?>
</div>
<hr style="margin-bottom:0;margin-top:0" />
<h4 style="color:#09F;padding-left:;"> Students in this classroom</h4>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-condensed">
  <?php 
$crud=new Crud;
$students=$crud->dbselect('classroom_users AS T1 INNER JOIN student AS T2 ON T1.student_id=T2.rand','*',"T1.classroom_id='".$_GET['view']."'",'');
while($grab=mysql_fetch_array($students[1])){?>  
  <tr>
    <td width="14%">
    <img src="<?php if($grab['photo']==''){echo $dirlocation.'c_app/views/images/anonymous.png';}else{echo $dirlocation.'c_app/views/images/'.$grab['photo'];}?>" class="" width="45px" />
    </td>
    <td width="44%">
        <a href="<?php echo $dirlocation;?>learn/profile?profileid=<?php echo $grab['rand'];?>">
        <strong style="color:#078e31"><?php echo $grab['full_name'];?></strong></a>
        
        <br/>
    <?php echo $grab['school'];?>
    </td>
    
  </tr>
  <?php }?>
</table>

</div>


</div>
</div>


<!----COURSEWARE IN THE CLASSROOM-->
<div class="col-lg-4">
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
      <?php echo substr($grab['course_description'],0,150).'...';?>
      <span class="pull-right">
      <a href="<?php echo $dirlocation;?>learn/courseware/view?view=<?php echo $grab['courseware_id'];?>" class="btn btn btn-white btn-xs">
      					<i class="fa fa-folder-open"></i>
                        View</a>
                        
                       <a class="btn btn-xs btn-white a2a_dd" data-toggle="modal" data-target="#myModalshare" data-a2a-url="<?php echo $dirlocation;?>learn/courseware/view?view=<?php echo $grab['courseware_id'];?>"><i class="fa fa-share"></i> Share </a>
                        
                        <?php if($checkpin[2]==0){?>
                        <a href="<?php echo $dirlocation;?>learn/classroom/view?view=<?php echo $_GET['view'];?>&&pin=<?php echo $grab['courseware_id'];?>&&table=courseware" class="btn btn btn-white btn-xs">
                        <i class="fa fa-tag"></i>
                        Clip</a>  
                        <?php }elseif($checkpin[2]>0){?>
<a href="<?php echo $dirlocation;?>learn/classroom/view?view=<?php echo $_GET['view'];?>&&unpin=<?php echo $checkpin[0]['pin_id'];?>&&table=courseware" class="btn btn-xs btn-danger"><i class="fa fa-tag"></i> Unclip </a>
                        <?php }?>
      </span>
    </td>
    </tr>
  <?php }?>
</table>

</div>


</div>
</div>
    

<!-- ENGAGEMENTS DETAILS-->
<div class="col-lg-4">
    <div class="panel panel-default" style="padding-top:0">
<!-- /.panel-heading -->
<div class="panel-body">
    Classroom engagements goes here
        
        
        </div>
        
    </div>
</div>  

</div>


