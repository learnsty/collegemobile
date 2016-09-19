<div class="col-lg-12" ng-controller="DashboardCtrl">
                <div class="wrapper wrapper-content">
                        <div class="row">
                        
                        <div class="col-lg-5">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Feeds</h5>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal6" id="signinregister" style="display:none">
                                    Small Modal
                                </button>
                                    </div>
                                    <div class="ibox-content">

                                        <div>
                                            <div class="feed-activity-list">
 <?php
		$crud=new Crud;

	 while($grab=mysql_fetch_array($data['feeds']['activities'])){
		$getsection=$crud->dbselect($grab['activity_type'],'*',$grab['activity_type'].'_id='.$grab['activity_type_id'],'');
		
		$explode=end(explode('.',strtolower($getsection[0]['path'])));
		
		
		
		?>                           
        <?php if($grab['activity_type']=='courseware'){
		//echo $getsection[0]['staff_id'];
	///////////GET OWNER DETAILS////////////
	$getownerdetails=$crud->dbselect('lecturer','*',"rand='".$grab['user_id']."'","");
	if($getownerdetails[2]==0){
	$getownerdetails=$crud->dbselect('student','*',"rand='".$grab['user_id']."'",""	);	
	if($getownerdetails[2]==0){
	$getownerdetails=$crud->dbselect('contentprovider','*',"rand='".$grab['user_id']."'",""	);
	}
	
	}
	//print_r($getownerdetails[0]);
	/////// CHECK IF USER HAS PINED THE COURSEWARE
	$checkpin=$crud->dbselect('pin','*',"user_id='".$_SESSION['accessLogin']['user_id']."' AND table_id='".$getsection[0]['courseware_id']."'AND table_name='courseware'",'');
	
	/////// CHECK IF USER HAS LIKED THE COURSEWARE
	$checklike=$crud->dbselect('liked','*',"user_id='".$_SESSION['accessLogin']['user_id']."' AND table_id='".$getsection[0]['courseware_id']."'AND table_name='courseware'",'');
	
	$split=strtolower(end(explode('.',$getsection[0]['path'])));
	
		?>
                                                
        <div class="feed-element">
            <a href="#" class="pull-left">
                
                <img alt="image" class="img-circle" src="<?php if($getownerdetails[0]['photo']==''){echo $dirlocation.'c_app/views/images/anonymous.png';}else{echo $dirlocation.'c_app/views/images/'.$getownerdetails[0]['photo'];}?>" style="width:40px;float:left">
            </a>
            <div class="media-body ">
                <small class="pull-right"><?php echo $grab['time'];?></small>
                <a href="<?php echo $dirlocation;?>learn/profile?profileid=<?php echo $getownerdetails[0]['rand'];?>"><strong><?php if($getownerdetails[0]['full_name']!=$_SESSION['accessLogin']['full_name']){echo $getownerdetails[0]['full_name'];}else{echo 'You';}?></strong></a> shared a courseware -  <a href="<?php echo $dirlocation;?>learn/courseware/view?view=<?php echo $getsection[0]['courseware_id'];?>"><strong><?php echo $getsection[0]['course_title'];?></strong></a> <br>
<div class="well">
   <?php echo substr($getsection[0]['course_description'],0,80).'...';?>
</div>
<?php if(($getsection[0]['banner']=='')&&($split!='mp4')){?>
<img src="<?php echo $dirlocation;?>c_app/views/images/noimage.jpg" width="100%" />
<?php }elseif(($getsection[0]['banner']!='')){?>
<div style="max-height:180px;overflow:hidden">
<img src="<?php echo $dirlocation;?>c_app/views/<?php echo $getsection[0]['banner'];?>" width="100%" />
</div>	
<?php } else{?>
  <video id="video" width="100%" height="">
    <source src="<?php echo $dirlocation;?>c_app/views/<?php if($split=='mp4'){echo $getsection[0]['path'];}else{echo $getsection[0]['banner'];}?>" type="video/mp4">
    <p>
      Your browser doesn't support HTML5 video.
      <a href="videos/mikethefrog.mp4">Download</a> the video instead.
    </p>
  </video>
  <?php }?>

<small class="text-muted"><?php echo $getsection['date'];?></small>

                                                        <div class="pull-right">
                                                            <?php if($checklike[2]==0){?>                                                            
<a href="<?php echo $dirlocation;?>learn/feeds?like=<?php echo $getsection[0]['courseware_id'];?>&&table=courseware" class="btn btn-xs btn-white"><i class="fa fa-heart"></i> Like </a>
<?php }elseif($checklike[2]>0){?>
<a href="<?php echo $dirlocation;?>learn/feeds?dislike=<?php echo $checklike[0]['like_id'];?>&&table=courseware" class="btn btn-xs btn-danger"><i class="fa fa-tag"></i> dislike </a>
<?php }?>

   <a href="<?php echo $dirlocation;?>learn/courseware/view?view=<?php echo $getsection[0]['courseware_id'];?>" class="btn btn-xs btn-white"><i class="fa fa-folder-open"></i> View </a>
                                                            <a class="btn btn-xs btn-white a2a_dd" data-toggle="modal" data-target="#myModalshare" data-a2a-url="<?php echo $dirlocation;?>learn/courseware/view?view=<?php echo $getsection[0]['courseware_id'];?>"><i class="fa fa-share"></i> Share </a>

<!--------IF THE OWNERS RAND IS NOT EQUAL TO THE CURRENT SESSION-
If the owner is not the creator of this courseware. That is the only condition inwhich the clip button should show
-->
<?php if($getownerdetails[0]['rand']!=$_SESSION['accessLogin']['user_id']){?>
<!---IF THE PIN IS NOT CLIPED SHOW CLIP BUTTON ELSE SHOW UNCLIP BUTTON-->                                                         
<?php if($checkpin[2]==0){?>                                                            
<a href="<?php echo $dirlocation;?>learn/feeds?pin=<?php echo $getsection[0]['courseware_id'];?>&&table=courseware" class="btn btn-xs btn-white"><i class="fa fa-tag"></i> Clip </a>
<?php }elseif($checkpin[2]>0){?>
<a href="<?php echo $dirlocation;?>learn/feeds?unpin=<?php echo $checkpin[0]['pin_id'];?>&&table=courseware" class="btn btn-xs btn-danger"><i class="fa fa-tag"></i> Unclip </a>
<?php }?>
<?php }?>
                                                        </div>
                                                    </div>
                                                </div>
                                                
 <?php }?>
 
 <!-------IF THE ACTIVITY TYPE IS AS CLASSROOM----->
 		<?php if($grab['activity_type']=='classroom'){
	 $getownerdetails=$crud->dbselect('lecturer','*',"rand='".$getsection[0]['staff_id']."'","");
	if($getownerdetails[2]==0){
	$getownerdetails=$crud->dbselect('student','*',"rand='".$getsection[0]['staff_id']."'","");	
	if($getownerdetails[2]==0){
	$getownerdetails=$crud->dbselect('contentprovider','*',"rand='".$grab['user_id']."'",""	);
	}
	}
	
	$getstudentsinaclass=$crud->dbselect('classroom_users','*',"classroom_id='".$getsection[0]['classroom_id']."'","");	
	$getbooksinaclass=$crud->dbselect('courseware','*',"classroom_id='".$getsection[0]['classroom_id']."'","");	
	$checkclassroom=$crud->dbselect('classroom_users','*',"student_id='".$_SESSION['accessLogin']['user_id']."'AND classroom_id='".$getsection[0]['classroom_id']."'",'');
	
	/////// CHECK IF USER HAS PINED THE CLASSROOM
	$checkpin=$crud->dbselect('pin','*',"user_id='".$_SESSION['accessLogin']['user_id']."' AND table_id='".$getsection[0]['classroom_id']."'AND table_name='classroom'",'');

	 ?>
 
                <div class="feed-element">
                    <a href="#" class="pull-left">
                        <img alt="image" class="img-circle" src="<?php if($getownerdetails[0]['photo']==''){echo $dirlocation.'c_app/views/images/anonymous.png';}else{echo $dirlocation.'c_app/views/images/'.$getownerdetails[0]['photo'];}?>" style="width:40px;float:left">
                        
                       
                    </a>
                    <div class="media-body ">
                        <small class="pull-right"><?php echo $grab['time'];?></small>
                        <a href="<?php echo $dirlocation;?>learn/profile?profileid=<?php echo $getownerdetails[0]['rand'];?>"><strong><?php if($getownerdetails[0]['full_name']!=$_SESSION['accessLogin']['full_name']){echo $getownerdetails[0]['full_name'];}else{echo 'You';}?></strong> </a>created a classroom - <a href="<?php echo $dirlocation;?>learn/classroom/view?view=<?php echo $getsection[0]['classroom_id'];?>"><strong><?php echo $getsection[0]['classroom_title'];?></strong></a>.<br>
                        
                        <small class="text-muted"><?php echo $grab['time'];?></small>
                        <div class="well">
                      <?php echo substr($getsection[0]['classroom_description'],0,300).'...';?>
                       </div>
                       
                       <div class="pull-right">
                       <?php if($checkclassroom[2]==0){?>
                       
                       <!--- CHECK IF THE SESSION IS THE OWNER--->
                       <?php if($grab['user_id']!=$_SESSION['accessLogin']['user_id']){?>
              <a href="<?php echo $dirlocation;?>learn/feeds?join=<?php echo $getsection[0]['classroom_id'];?>" class="btn btn-xs btn-white" data-toggle="tooltip" data-placement="top" title="Join this classroom">
              +Join Class
              </a>
			  <?php }?>
			  <?php }else{?>
              <a href="<?php echo $dirlocation;?>learn/feeds?leave=<?php echo $getsection[0]['classroom_id'];?>" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Leave this classroom">
              -Leave Class
              </a><?php }?>   
              <a class="btn btn-xs btn-white" ><i class="fa fa-group"></i> <?php echo $getstudentsinaclass[2];?> </a>
              <a class="btn btn-xs btn-white"><i class="fa fa-book"></i> <?php echo $getbooksinaclass[2];?> </a>
              <a href="<?php echo $dirlocation;?>learn/classroom/view?view=<?php echo $getsection[0]['classroom_id'];?>" class="btn btn-xs btn-white"><i class="fa fa-folder-open"></i> View </a>
              
                                                            <a class="btn btn-xs btn-white a2a_dd" data-toggle="modal" data-target="#myModalshare" data-a2a-url="<?php echo $dirlocation;?>learn/classroom/view?view=<?php echo $getsection[0]['classroom_id'];?>"><i class="fa fa-share"></i> Share </a>

<!--------IF THE OWNERS RAND IS NOT EQUAL TO THE CURRENT SESSION-
If the owner is not the creator of this classroom. That is the only condition inwhich the clip button should show
-->
<?php if($getownerdetails[0]['rand']!=$_SESSION['accessLogin']['user_id']){?>

<?php if($checkpin[2]==0){?>                                                            
<a href="<?php echo $dirlocation;?>learn/feeds?pin=<?php echo $getsection[0]['classroom_id'];?>&&table=classroom" class="btn btn-xs btn-white"><i class="fa fa-tag"></i> Clip </a>
<?php }elseif($checkpin[2]>0){?>
<a href="<?php echo $dirlocation;?>learn/feeds?unpin=<?php echo $checkpin[0]['pin_id'];?>&&table=classroom" class="btn btn-xs btn-danger"><i class="fa fa-tag"></i> Unclip </a>
<?php }?>

<?php }?>                                                     </div>
                                                        
                                                       
                    </div>
                </div>
  <?php }?>
  <?php }?>
                                               
                                            </div>

                                            <button class="btn btn-primary btn-block m-t"><i class="fa fa-arrow-down"></i> Show More</button>

                                        </div>

                                    </div>
                                </div>

                            </div>
                            
                        
                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Activities</h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="http://webapplayers.com/inspinia_admin-v2.5/#">
                                            <i class="fa fa-wrench"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-user">
                                            <li><a href="http://webapplayers.com/inspinia_admin-v2.5/#">Config option 1</a>
                                            </li>
                                            <li><a href="http://webapplayers.com/inspinia_admin-v2.5/#">Config option 2</a>
                                            </li>
                                        </ul>
                                        <a class="close-link">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                                <?php if($_SESSION['accessLogin']['register_stage']<2){?>
                                <div class="ibox-content ibox-heading" style="text-align:center">
                                    <h3>Your account is not yet authenticated</h3>
                                    <small> There is a lot more you can do than you can ever imagine</small><a href="<?php echo $dirlocation;?>verify"><button class="btn btn-sm btn-info pull-right">Authenticate my account</button></a>
                                </div>
                                
                                <?php }else{?>
                                
                                <div class="ibox-content ibox-heading" style="text-align:center">
                                    <h3 style="margin:0;padding:0">You account is authenticated! </h3><span class="fa fa-thumbs-up fa-2x" style="color:#0C3"></span>	<br/>
          <a class="btn btn-xs btn-white" href="<?php echo $dirlocation;?>learn/profile">My profile</a>   <a class="btn btn-xs btn-white" href="<?php echo $dirlocation;?>learn/community">My community</a>
                                </div>
                                
                                <?php }?>
                                
                                <div class="ibox-content inspinia-timeline">
<?php while($grab=mysql_fetch_array($data['feeds']['join_leave_view'])){
	$getdetails=$crud->dbselect('lecturer','*',"rand='".$grab['user_id']."'","");
	if($getdetails[2]==0){
	$getdetails=$crud->dbselect('student','*',"rand='".$grab['user_id']."'","");	
	}
	$getclass=$crud->dbselect('classroom','*',"classroom_id='".$grab['activity_type_id']."'","");
	
	
	?>
    <?php if($grab['activity_type']=='join@classroom_users'){?>
                                    <div class="timeline-item">
                                        <div class="row">
                                            <div class="col-xs-3 date">
                                                <i class="fa fa-th"></i>
                                                <?php echo $grab['time'];?>
                                                <br>
                                                <small class="text-navy">2 hour ago</small>
                                            </div>
                                            <div class="col-xs-7 content no-top-border">
                                                <p class="m-b-xs"><strong><?php if($getdetails[0]['full_name']==$_SESSION['accessLogin']['full_name']){echo "You have";}else{echo "<a href='".$dirlocation."learn/profile?profileid=".$getdetails[0]['rand']."'>".$getdetails[0]['full_name'].'</a> has';}?></strong> joined the class <?php echo $getclass[0]['classroom_title'];?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>
    <?php if($grab['activity_type']=='leave@classroom_users'){?>
                                    <div class="timeline-item">
                                        <div class="row" style="color:#F90">
                                            <div class="col-xs-3 date">
                                                <i class="fa fa-th"></i>
                                                <?php echo $grab['time'];?>
                                                <br>
                                                <small class="text-navy">2 hour ago</small>
                                            </div>
                                            <div class="col-xs-7 content no-top-border">
                                                <p class="m-b-xs"><strong><?php if($getdetails[0]['full_name']==$_SESSION['accessLogin']['full_name']){echo "You have";}else{echo "<a href='".$dirlocation."learn/profile?profileid=".$getdetails[0]['rand']."'>".$getdetails[0]['full_name'].'</a> has';}?></strong> left the class <?php echo $getclass[0]['classroom_title'];?></p>

                                                
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?> 
<?php if($grab['activity_type']=='view@courseware'){
	$getcourseware=$crud->dbselect('courseware','*',"courseware_id='".$grab['activity_type_id']."'","");									
	?>
                                    
                                    <div class="timeline-item">
                                        <div class="row" style="color:#069">
                                            <div class="col-xs-3 date">
                                                <i class="fa fa-th"></i>
                                                <?php echo $grab['time'];?>
                                                <br>
                                                <small class="text-navy">2 hour ago</small>
                                            </div>
                                            <div class="col-xs-7 content no-top-border">
                                                <p class="m-b-xs"><strong><?php echo $getdetails[0]['full_name'];?></strong></p>

                                                <p>viewed this courseware - <?php echo $getcourseware[0]['course_title'];?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>                           
                                    
                                    <?php }?>
                                    
                                </div>
                            </div>
                        </div>


		<div class="col-lg-3">
                            
                            <div class="ibox float-e-margins">
                                <div class="ibox-title" style="height:400px">
                                 <h5>Projects Column</h5>
                            <!--

                                   
                                    <div class="ibox-tools">
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="http://webapplayers.com/inspinia_admin-v2.5/#">
                                            <i class="fa fa-wrench"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-user">
                                            <li><a href="http://webapplayers.com/inspinia_admin-v2.5/#">Config option 1</a>
                                            </li>
                                            <li><a href="http://webapplayers.com/inspinia_admin-v2.5/#">Config option 2</a>
                                            </li>
                                        </ul>
                                        <a class="close-link">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                    !-->
                                </div>
                                
                                
                                <div class="ibox-content no-padding" style="display:none">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <p>
                                            
                                            </p>
                                            <small class="block text-muted"><i class="fa fa-clock-o"></i> 1 minuts ago</small>
                                        </li>
                                        <li class="list-group-item">
                                            <p><a class="text-info" href="http://webapplayers.com/inspinia_admin-v2.5/#">@Stock Man</a> Check this stock chart. This price is crazy! </p>
                                            <div class="text-center m">
                                                <span id="sparkline8"><canvas width="170" height="150" style="display: inline-block; width: 170px; height: 150px; vertical-align: top;"></canvas></span>
                                            </div>
                                            <small class="block text-muted"><i class="fa fa-clock-o"></i> 2 hours ago</small>
                                        </li>
                                        <li class="list-group-item">
                                            <p><a class="text-info" href="http://webapplayers.com/inspinia_admin-v2.5/#">@Kevin Smith</a> Lorem ipsum unknown printer took a galley </p>
                                            <small class="block text-muted"><i class="fa fa-clock-o"></i> 2 minuts ago</small>
                                        </li>
                                        <li class="list-group-item ">
                                            <p><a class="text-info" href="http://webapplayers.com/inspinia_admin-v2.5/#">@Jonathan Febrick</a> The standard chunk of Lorem Ipsum</p>
                                            <small class="block text-muted"><i class="fa fa-clock-o"></i> 1 hour ago</small>
                                        </li>
                                        <li class="list-group-item">
                                            <p><a class="text-info" href="http://webapplayers.com/inspinia_admin-v2.5/#">@Alan Marry</a> I belive that. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                            <small class="block text-muted"><i class="fa fa-clock-o"></i> 1 minuts ago</small>
                                        </li>
                                        <li class="list-group-item">
                                            <p><a class="text-info" href="http://webapplayers.com/inspinia_admin-v2.5/#">@Kevin Smith</a> Lorem ipsum unknown printer took a galley </p>
                                          <small class="block text-muted"><i class="fa fa-clock-o"></i> 2 minuts ago</small>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        </div>
                </div>
                <div class="footer" style="display:none">
                    <div class="pull-right">
                        10GB of <strong>250GB</strong> Free.
                    </div>
                    <div>
                        <strong>Copyright</strong> Example Company © 2014-2015
                    </div>
                </div>
            </div>
 

