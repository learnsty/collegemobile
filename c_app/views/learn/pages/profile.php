            <?php if($data['profile']['profile_type']!='contentprovider'){?>
            
            <div class="col-lg-12 wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                
                    <h2><?php if(isset($_GET['profileid'])){echo ucwords(strtolower($data['profile']['profile'][0]['full_name']))."'s";}else{echo "My";}?> Profile</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="#">Home</a>
                        </li>
                        <li class="active">
                            <a href="<?php echo $dirlocation;?>learn/profile">My Profile</a>
                        </li>
                        
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            
<div class="wrapper wrapper-content">
            <div class="row animated fadeInRight">
            
            <?php if(!isset($_GET['edit'])){?>
                <div class="col-md-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Profile Detail</h5>
                        </div>
                        <div>
                            <div class="ibox-content no-padding border-left-right">
                                <img src="<?php if($data['profile']['profile'][0]['photo']==''){echo $dirlocation.'c_app/views/images/anonymous.png';}else{echo $dirlocation.'c_app/views/images/'.$data['profile']['profile'][0]['photo'];}?>" class="img-responsive" />
                            </div>
                            <div class="ibox-content profile-content">
                                <h4><strong><?php echo ucwords(strtolower($data['profile']['profile'][0]['full_name'])).'  ('.$data['profile']['profile'][0]['phone_number'].')';?></strong></h4>
                                <p><i class="fa fa-envelope"></i> <?php echo $data['profile']['profile'][0]['email'];?></p>
                                <h5>
                                    About me
                                </h5>
                                
                                <label>School </label> <?php echo $data['profile']['profile'][0]['school'];?><br/>
                                <label>Department </label> <?php echo $data['profile']['profile'][0]['department'];?><br/>
                         
						<?php if($_SESSION['accessLogin']['account_type']=='student'){?>

                        <label>Level </label> <?php echo $data['profile']['profile'][0]['level'];?><br/>
                        <label>Reg. Number </label> <?php echo $data['profile']['profile'][0]['reg_number'];?><br/>
                                
 <?php }elseif($_SESSION['accessLogin']['account_type']=='lecturer'){?>
  <label>Staff ID </label> <?php echo $data['profile']['profile'][0]['staff_id'];?><br/>
  <label>Certificate </label> <?php echo $data['profile']['profile'][0]['certificate'];?><br/>
  <label>Education Level</label><?php echo $data['profile']['profile'][0]['edu_level'];?><br/>
 <?php }?>
                                <p>
                                   <?php print_r($data['profile']['profile'][0]['about_me']); echo $data['profile'][1]['about_me'];?>
                                </p>
                               
                               <?php if(!isset($_GET['profileid'])){?> 
                                <div class="user-button">
                                    <div class="row">
                                        <div class="col-md-6">
                         <a href="<?php echo $dirlocation;?>learn/profile?edit" class="btn btn-primary btn-sm btn-block"><i class="fa fa-pencil"></i> Edit Profile</a>
                                        </div>
                                        
                                    </div>
                                </div>
                                <?php }?>
                            </div>
                    </div>
                </div>
                    </div>
                    
                    <?php }elseif(isset($_GET['edit'])){?>
                     
                     <!------ IF THE USER IS A STUDENT--->
                     <?php if($_SESSION['accessLogin']['account_type']=='student'){?>
                     <div class="col-md-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Edit Detail</h5>
                        </div>
                        <div>
                            <div class="ibox-content no-padding border-left-right">
                                <img src="<?php if($data['profile']['profile'][0]['photo']==''){echo $dirlocation.'c_app/views/images/anonymous.png';}else{echo $dirlocation.'c_app/views/images/'.$data['profile']['profile'][0]['photo'];}?>" class="img-responsive" id="target" style="margin:0 auto;float:none" />
                                
                          <div style="text-align:center">      
                                <img src="<?php echo $dirlocation;?>c_app/views/images/default.gif" width="20%" class="loader2" style="display:none" />
    
     <form id="uploadpassport" enctype="multipart/form-data" name="uploadavater">
     <button class="btn btn-default btn-sm" onclick="$('#fileinput').trigger('click');" style="">Change Pix</button>  
     <input name="profile_photo" type="file" id="fileinput" onchange="$('.uploadbtn').show()" style="display:none"/><br/>
     <input type="submit" ng-click="uploadpass()" value="Upload" class="uploadbtn btn btn-primary btn-sm" style="display:none;margin:7px 5px auto"/>
     <input type="hidden" name="email" value="<?php echo $_SESSION['accessLogin']['email'];?>" />
     <input type="hidden" name="phone" value="<?php echo $_SESSION['accessLogin']['phone_number'];?>" />
     <input type="hidden" name="table" value="<?php echo $_SESSION['accessLogin']['account_type'];?>" />
     </form>
     </div>
                            </div>
                            <div class="ibox-content profile-content">
           
           <?php if(isset($data['profile']['msg'])){?>
          <div class="alert alert-info">
          <?php echo $data['profile']['msg'];?>
          </div>        
          <?php }?>          
		<form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF'];?>">
        <div class="form-group">
        <label class="col-lg-2 control-label">Name</label>



            <div class="col-lg-10">
            <input type="name" placeholder="Full name" name="full_name" class="form-control" value="<?php echo ucwords(strtolower($data['profile']['profile'][0]['full_name']));?>" required="required"> 

            </div>

        </div>

        <div class="form-group"><label class="col-lg-2 control-label">Email</label>

            <div class="col-lg-10">
            <input type="email" placeholder="email address" name="email" class="form-control" value="<?php echo $data['profile']['profile'][0]['email'];?>" required="required"></div>

        </div>

		<div class="form-group">
        <label class="col-lg-2 control-label">About</label>

            <div class="col-lg-10">
            <textarea name="about" placeholder="Short description about yourself" class="form-control" rows="5" style="font-size:12px" required="required"><?php echo $data['profile']['profile'][0]['about_me'];?></textarea>
            

            </div>

        </div>
        
        <hr />
        
        <div class="form-group"><label class="col-lg-3 control-label">Reg.Number</label>

            <div class="col-lg-9"><input type="text" placeholder="Registration number" class="form-control" value="<?php echo $data['profile']['profile'][0]['reg_number'];?>" required="required" name="regnumber"></div>

        </div>
        
        <div class="form-group">
        <label class="col-lg-2 control-label">School</label>

            <div class="col-lg-10">
            
            <select class="form-control" name="school">
         <option value="University of Abuja (UNIABUJA)" <?php if($data['profile']['profile'][0]['school']=='University of Abuja (UNIABUJA)'){echo "selected='selected'";}?>> University of Abuja (UNIABUJA)</option>
          <option value="Nassarawa State University (NSUT)" <?php if($data['profile']['profile'][0]['school']=='Nassarawa State University (NSUT)'){echo "selected='selected'";}?>>Nassarawa State University(NSUT)</option>
            </select>

            </div>

        </div>

		<div class="form-group">
        <label class="col-lg-3 ">Department</label>

            <div class="col-lg-9">
            
            <select class="form-control" name="department">
         <option value="Zoology" <?php if($data['profile']['profile'][0]['department']=='Zoology'){echo "selected='selected'";}?>>Department of Zoology</option>
          <option value="Chemistry" <?php if($data['profile']['profile'][0]['department']=='Chemistry'){echo "selected='selected'";}?>>Department of Chemistry</option>
          <option value="Botany" <?php if($data['profile']['profile'][0]['department']=='Botany'){echo "selected='selected'";}?>>Department of Botany</option>
          <option value="Psychology" <?php if($data['profile']['profile'][0]['department']=='Psychology'){echo "selected='selected'";}?>>Department of Psychology</option>
          <option value="Law" <?php if($data['profile']['profile'][0]['department']=='Law'){echo "selected='selected'";}?>>Department of Law</option>
          <option value="Phylosophy" <?php if($data['profile']['profile'][0]['department']=='Phylosophy'){echo "selected='selected'";}?>>Department of Phylosophy</option>
          </select> 

            </div>

        </div>
        
        <div class="form-group">
        <label class="col-lg-2 control-label">Level</label>

            <div class="col-lg-10">
            
         <select name="level" class="form-control">
         <option value="100" <?php if($data['profile']['profile'][0]['level']=='100'){echo "selected='selected'";}?>>100 Level</option>
         <option value="200" <?php if($data['profile']['profile'][0]['level']=='200'){echo "selected='selected'";}?>>200 Level</option>
         <option value="300" <?php if($data['profile']['profile'][0]['level']=='300'){echo "selected='selected'";}?>>300 Level</option>
         <option value="400" <?php if($data['profile']['profile'][0]['level']=='400'){echo "selected='selected'";}?>>400 Level</option>
         <option value="500" <?php if($data['profile']['profile'][0]['level']=='500'){echo "selected='selected'";}?>>500 Level</option>
         <option value="600" <?php if($data['profile']['profile'][0]['level']=='600'){echo "selected='selected'";}?>>600 Level</option>
         <option value="600" <?php if($data['profile']['profile'][0]['level']=='msc'){echo "selected='selected'";}?>>Msc</option>
         <option value="600" <?php if($data['profile']['profile'][0]['level']=='phd'){echo "selected='selected'";}?>>Phd</option>
         </select>

            </div>

        </div>
        
        
        <div class="form-group">

            <div class="col-lg-offset-2 col-lg-10">

                <button class="btn btn-sm btn-primary" type="submit">Save Details</button>

            </div>

        </div>

                            </form>

						
                            </div>
                    </div>
                </div>
                    </div>
                     
                     <?php }?>
                     
                     <?php if($_SESSION['accessLogin']['account_type']=='lecturer'){?>
                     <div class="col-md-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Edit Detail</h5>
                        </div>
                        <div>
                            <div class="ibox-content no-padding border-left-right">
                                <img src="<?php if($data['profile']['profile'][0]['photo']==''){echo $dirlocation.'c_app/views/images/anonymous.png';}else{echo $dirlocation.'c_app/views/images/'.$data['profile']['profile'][0]['photo'];}?>" class="img-responsive" id="target" style="margin:0 auto;float:none" />
                                
                          <div style="text-align:center">      
                                <img src="<?php echo $dirlocation;?>c_app/views/images/default.gif" width="20%" class="loader2" style="display:none" />
    
     <form id="uploadpassport" enctype="multipart/form-data" name="uploadavater">
     <button class="btn btn-default btn-sm" onclick="$('#fileinput').trigger('click');" style="">Change Pix</button>  
     <input name="profile_photo" type="file" id="fileinput" onchange="$('.uploadbtn').show()" style="display:none"/><br/>
     <input type="submit" ng-click="uploadpass()" value="Upload" class="uploadbtn btn btn-primary btn-sm" style="display:none;margin:7px 5px auto"/>
     <input type="hidden" name="email" value="<?php echo $_SESSION['accessLogin']['email'];?>" />
     <input type="hidden" name="phone" value="<?php echo $_SESSION['accessLogin']['phone_number'];?>" />
     <input type="hidden" name="table" value="<?php echo $_SESSION['accessLogin']['account_type'];?>" />
     </form>
     </div>
     
                            </div>
                            <div class="ibox-content profile-content">
           
           <?php if(isset($data['profile']['msg'])){?>
          <div class="alert alert-info">
          <?php echo $data['profile']['msg'];?>
          </div>        
          <?php }?>          
		<form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF'];?>">
        <div class="form-group">
        <label class="col-lg-2 control-label">Name</label>



            <div class="col-lg-10">
            <input type="name" placeholder="Full name" name="full_name" class="form-control" value="<?php echo ucwords(strtolower($data['profile']['profile'][0]['full_name']));?>" required="required"> 

            </div>

        </div>

        <div class="form-group"><label class="col-lg-2 control-label">Email</label>

            <div class="col-lg-10">
            <input type="email" placeholder="email address" name="email" class="form-control" value="<?php echo $data['profile']['profile'][0]['email'];?>" required="required"></div>

        </div>

		<div class="form-group">
        <label class="col-lg-2 control-label">About</label>

            <div class="col-lg-10">
            <textarea name="about" placeholder="Short description about yourself" class="form-control" rows="5" style="font-size:12px" required="required"><?php echo $data['profile']['profile'][0]['about_me'];?></textarea>
            

            </div>

        </div>
        
        <hr />
        
        <div class="form-group"><label class="col-lg-3 control-label">Staff ID</label>

            <div class="col-lg-9"><input type="text" placeholder="Staff ID" class="form-control" value="<?php echo $data['profile']['profile'][0]['staff_id'];?>" required="required" name="staffid"></div>

        </div>
        
        <div class="form-group">
        <label class="col-lg-2 control-label">School</label>

            <div class="col-lg-10">
            
            <select class="form-control" name="school">
         <option value="University of Abuja (UNIABUJA)" <?php if($data['profile']['profile'][0]['school']=='University of Abuja (UNIABUJA)'){echo "selected='selected'";}?>> University of Abuja (UNIABUJA)</option>
          <option value="Nassarawa State University (NSUT)" <?php if($data['profile']['profile'][0]['school']=='Nassarawa State University (NSUT)'){echo "selected='selected'";}?>>Nassarawa State University(NSUT)</option>
            </select>

            </div>

        </div>

		<div class="form-group">
        <label class="col-lg-3 ">Department</label>

            <div class="col-lg-9">
            
            <select class="form-control" name="department">
         <option value="Zoology" <?php if($data['profile']['profile'][0]['department']=='Zoology'){echo "selected='selected'";}?>>Department of Zoology</option>
          <option value="Chemistry" <?php if($data['profile']['profile'][0]['department']=='Chemistry'){echo "selected='selected'";}?>>Department of Chemistry</option>
          <option value="Botany" <?php if($data['profile']['profile'][0]['department']=='Botany'){echo "selected='selected'";}?>>Department of Botany</option>
          <option value="Psychology" <?php if($data['profile']['profile'][0]['department']=='Psychology'){echo "selected='selected'";}?>>Department of Psychology</option>
          <option value="Law" <?php if($data['profile']['profile'][0]['department']=='Law'){echo "selected='selected'";}?>>Department of Law</option>
          <option value="Phylosophy" <?php if($data['profile']['profile'][0]['department']=='Phylosophy'){echo "selected='selected'";}?>>Department of Phylosophy</option>
          </select> 

            </div>

        </div>
        
        
        <div class="form-group">

            <div class="col-lg-offset-2 col-lg-10">

                <button class="btn btn-sm btn-primary" type="submit">Save Details</button>

            </div>

        </div>

                            </form>

						
                            </div>
                    </div>
                </div>
                    </div>
                     
                     <?php }?>
                    
                    <?php }?>
                <div class="col-md-5">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Activites</h5>
                            
                        </div>
                        <div class="ibox-content">

                            <div>
                                <div class="feed-activity-list">
<?php
		$crud=new Crud;

	 while($grab=mysql_fetch_array($data['profile']['myactivities'][1])){
		$getsection=$crud->dbselect($grab['activity_type'],'*',$grab['activity_type'].'_id='.$grab['activity_type_id'],'');
		
		$explode=end(explode('.',strtolower($getsection[0]['path'])));
		
		
		
		?>                           
        <?php if($grab['activity_type']=='courseware'){
		//echo $getsection[0]['staff_id'];
	///////////GET OWNER DETAILS////////////
	$getownerdetails=$crud->dbselect('lecturer','*',"rand='".$grab['user_id']."'","");
	if($getownerdetails[2]==0){
	$getownerdetails=$crud->dbselect('student','*',"rand='".$grab['user_id']."'",""	);	
	}
	//print_r($getownerdetails[0]);
	/////// CHECK IF USER HAS PINED THE COURSEWARE
	$checkpin=$crud->dbselect('pin','*',"user_id='".$_SESSION['accessLogin']['user_id']."' AND table_id='".$getsection[0]['courseware_id']."'AND table_name='courseware'",'');
	

	$split=strtolower(end(explode('.',$getsection[0]['path'])));
	
		?>
                                                
        <div class="feed-element">
            <a href="#" class="pull-left">
                
                <img alt="image" class="img-circle" src="<?php if($getownerdetails[0]['photo']==''){echo $dirlocation.'c_app/views/images/anonymous.png';}else{echo $dirlocation.'c_app/views/images/'.$getownerdetails[0]['photo'];}?>" style="width:40px;float:left">
            </a>
            <div class="media-body">
                <small class="pull-right"><?php echo $grab['time'];?></small>
                <a href="<?php echo $dirlocation;?>learn/profile?profileid=<?php echo $getownerdetails[0]['rand'];?>"><strong><?php if($getownerdetails[0]['full_name']!=$_SESSION['accessLogin']['full_name']){echo $getownerdetails[0]['full_name'];}else{echo 'You';}?></strong></a> shared a courseware -  <a href="<?php echo $dirlocation;?>learn/courseware/view?view=<?php echo $getsection[0]['courseware_id'];?>"><strong><?php echo $getsection[0]['course_title'];?></strong></a> <br>
<div class="well">
   <?php echo substr($getsection[0]['course_description'],0,300).'...';?>
</div>
<?php if(($getsection[0]['banner']=='')&&($split!='mp4')){?>
<img src="<?php echo $dirlocation;?>c_app/views/images/noimage.jpg" width="100%" />
<?php }elseif(($getsection[0]['banner']!='')){?>
<img src="<?php echo $dirlocation;?>c_app/views/<?php echo $getsection[0]['banner'];?>" width="100%" />	
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
                                                            <a class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> Like </a>
   <a href="<?php echo $dirlocation;?>learn/courseware/view?view=<?php echo $getsection[0]['courseware_id'];?>" class="btn btn-xs btn-white"><i class="fa fa-folder-open"></i> View </a>
                                                            <a class="btn btn-xs btn-white"><i class="fa fa-share"></i> Share </a>
<?php if($checkpin[2]==0){?>                                                            
<a href="<?php echo $dirlocation;?>learn/profile?profileid=<?php echo $_GET['profileid'];?>&&pin=<?php echo $getsection[0]['courseware_id'];?>&&table=courseware" class="btn btn-xs btn-white"><i class="fa fa-tag"></i> Clip </a>
<?php }elseif($checkpin[2]>0){?>
<a href="<?php echo $dirlocation;?>learn/profile?profileid=<?php echo $_GET['profileid'];?>&&unpin=<?php echo $checkpin[0]['pin_id'];?>&&table=courseware" class="btn btn-xs btn-danger"><i class="fa fa-tag"></i> Unclip </a>
<?php }?>
                                                        </div>
                                                    </div>
                                                </div>
                                                
 <?php }?>
 		<?php if($grab['activity_type']=='classroom'){
	 	$getownerdetails=$crud->dbselect('lecturer','*',"rand='".$getsection[0]['staff_id']."'","");
	if($getownerdetails[2]==0){
	$getownerdetails=$crud->dbselect('student','*',"rand='".$getsection[0]['staff_id']."'","");	
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
              
                                                            <a class="btn btn-xs btn-white"><i class="fa fa-share"></i> Share </a>

<?php if($checkpin[2]==0){?>                                                            
<a href="<?php echo $dirlocation;?>learn/profile?profileid=<?php echo $_GET['profileid'];?>&&pin=<?php echo $getsection[0]['classroom_id'];?>&&table=classroom" class="btn btn-xs btn-white"><i class="fa fa-tag"></i> Clip </a>
<?php }elseif($checkpin[2]>0){?>
<a href="<?php echo $dirlocation;?>learn/profile?profileid=<?php echo $_GET['profileid'];?>&&unpin=<?php echo $checkpin[0]['pin_id'];?>&&table=classroom" class="btn btn-xs btn-danger"><i class="fa fa-tag"></i> Unclip </a>
<?php }?>

                                                        </div>
                                                        
                                                       
                    </div>
                </div>
  <?php }?>
  <?php }?>
                                    

                                </div>

                                <button class="btn btn-primary btn-block m"><i class="fa fa-arrow-down"></i> Show More</button>

                            </div>

                        </div>
                    </div>

                </div>
                
               <?php if((!isset($_GET['profileid']))||($_SESSION['accessLogin']['user_id']==$_GET['profileid'])){?>
                <div class="col-md-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>My Clip</h5>
                            
                        </div>
                        <div class="ibox-content">

                            <div>
                                <div class="feed-activity-list">
 <?php if($data['profile']['clip'][2]==0){echo "<div class='alert alert-danger' style='text-align:center'>No Clip yet</div>";}?>
<?php while($grab=mysql_fetch_array($data['profile']['clip'][1])){
$getsection=$crud->dbselect($grab['table_name'],'*',$grab['table_name'].'_id='.$grab['table_id'],'');
		
$explode=end(explode('.',strtolower($getsection[0]['path'])));	
?>

<!-----IF THE CLIP IS A COURSEWARE---->
<?php if($grab['table_name']=='courseware'){?>
                                    <div class="feed-element">
                                        <a href="<?php echo $dirlocation;?>learn/courseware/view?view=<?php echo $getsection[0]['courseware_id'];?>" class="pull-left">
                                            <img alt="image" class="img-circle" src="<?php echo $dirlocation;?>c_app/views/<?php echo $getsection[0]['banner'];?>">
                                        </a>
                                        <div class="media-body ">
                                            <a href="<?php echo $dirlocation;?>learn/courseware/view?view=<?php echo $getsection[0]['courseware_id'];?>" style="color:inherit">
                                            <strong><?php echo $getsection[0]['course_title'];?></strong><br/> <?php echo substr($getsection[0]['course_description'],0,85).'...';?></a> <br>
                                            <small class="pull-right text-navy">
                                             <span class="fa fa-clock-o"></span>
											<?php echo $grab['date'];?></small>
                                            
                                        </div>
                                    </div>
                                    <?php }?>
                                    
<!------IF THE CLIP IS A CLASS----->  
<?php if($grab['table_name']=='classroom'){?>
                                    <div class="feed-element">
                                        <a href="<?php echo $dirlocation;?>learn/classroom/view?view=<?php echo $getsection[0]['classroom_id'];?>" class="pull-left">
                                            <div class="img-cirscle">
                                            <i class="fa fa-group fa-2x"></i>
                                            </div>
                                        </a>
                                        <div class="media-body ">
                                            <a href="<?php echo $dirlocation;?>learn/classroom/view?view=<?php echo $getsection[0]['classroom_id'];?>" style="color:inherit">
                                            <strong><?php echo $getsection[0]['classroom_title'];?></strong><br/> <?php echo substr($getsection[0]['classroom_description'],0,85).'...';?></a> <br>
                                            <small class="pull-right text-navy">
                                             <span class="fa fa-clock-o"></span>
											<?php echo $grab['date'];?></small>
                                            
                                        </div>
                                    </div>
                                    <?php }?>


                                  
<?php }?>
                                    
                                    
                                </div>

                                <button class="btn btn-primary btn-block m"><i class="fa fa-arrow-down"></i> Show More</button>

                            </div>

                        </div>
                    </div>

                </div>
                <?php }?>
                
            </div>
        </div> 
            <?php } elseif($data['profile']['profile_type']=='contentprovider'){
			$checkfollow=$crud->dbselect('follow','*',"follower_id='".$_SESSION['accessLogin']['user_id']."' AND leader_id='".$data['profile']['profile'][0]['rand']."'",'');
		
			?>
			<div class="wrapper wrapper-content animated fadeInRight" >


            <div class="row m-b-lg m-t-lg" >
            
                <div class="col-md-6">

                    <div class="profile-image">
                        <img src="<?php if($data['profile']['profile'][0]['photo']==''){echo $dirlocation.'c_app/views/images/anonymous.png';}else{echo $dirlocation.'c_app/views/images/'.$data['profile']['profile'][0]['photo'];}?>" class="img-circle circle-border m-b-md" alt="profile">
                    </div>
                    <div class="profile-info">
                        <div class="">
                            <div>
                                <h2 class="no-margins">
                                    <?php echo $data['profile']['profile'][0]['full_name'];?>
                              </h2>
                                <h4><?php echo $data['profile']['profile'][0]['website'];?></h4>
                                <small>
                                    <?php echo $data['profile']['profile'][0]['about_me'];?>
                              </small>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="col-md-3">
                    <table class="table small m-b-xs">
                        <tbody>
                        <tr>
                            <td>
                                <strong><?php echo $data['profile']['myactivities'][2];?></strong> Coursewares
                            </td>
                            <td>
                                <strong><?php echo $data['follow']['followers'][2];?></strong> Followers
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <strong><?php echo ($data['profile']['viewcounters'][0]['total']);?></strong> Views
                          </td>
                            <td>
                               
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-3" style="display:nne;text-align:center">
                    <small>Total Courseware</small><br/>
                    <h2 class="no-margins"><?php echo $data['profile']['myactivities'][2];?></h2>
                    
                               <?php if($checkfollow[2]==0){?>
                              <a href="<?php echo $dirlocation;?>learn/profile?profileid=<?php echo $data['profile']['profile'][0]['rand'];?>&&follow=<?php echo $data['profile']['profile'][0]['rand'];?>" class="btn btn-primary btn-sm">Follow</a>
                              <?php }else{?>
                              <a href="<?php echo $dirlocation;?>learn/profile?profileid=<?php echo $data['profile']['profile'][0]['rand'];?>&&unfollow=<?php echo $checkfollow[0]['follow_id'];?>" class="btn btn-danger btn-sm">Unfollow</a>
                              <?php }?>


                    <div id="sparkline1"><canvas width="241" height="50" style="display: inline-block; width: 241px; height: 50px; vertical-align: top;"></canvas></div>
                </div>


            </div>
            <div class="row">

                

                <div class="col-lg-12">
                <?php while($grab=mysql_fetch_array($data['profile']['myactivities'][1])){
					
					$getsection=$crud->dbselect($grab['activity_type'],'*',$grab['activity_type'].'_id='.$grab['activity_type_id'],'');
					
					/////// CHECK IF USER HAS PINED THE COURSEWARE
	$checkpin=$crud->dbselect('pin','*',"user_id='".$_SESSION['accessLogin']['user_id']."' AND table_id='".$getsection[0]['courseware_id']."'AND table_name='courseware'",'');
	
					?>
					<div class="col-lg-4">
                    <div class="social-feed-box">

                        <div class="pull-right social-action dropdown">
                            <button data-toggle="dropdown" class="dropdown-toggle btn-white">
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu m-t-xs">
                                <li><a href="http://webapplayers.com/inspinia_admin-v2.5/profile_2.html#">Config</a></li>
                            </ul>
                        </div>
                        <div class="social-avatar">
                            <a href="http://webapplayers.com/inspinia_admin-v2.5/profile_2.html" class="pull-left">
                                <img alt="image" src="<?php echo $dirlocation ;?>c_app/views/<?php echo $getsection[0]['banner'];?>">
                            </a>
                            
                            <div class="media-body">
                            
                                <a href="#">
                                   <?php echo $getsection[0]['course_title'];?>
                                </a>
                                <small class="text-muted"> <?php echo $getsection[0]['date'];?></small>
                            </div>
                        </div>
                        <div class="social-body">
                        <div style="max-height:180px;overflow:hidden">
                         <img alt="image" src="<?php if($getsection[0]['banner']!=''){echo $dirlocation."c_app/views/".$getsection[0]['banner'];}else{ echo $dirlocation."c_app/views/images/noimage.jpg";}?>" style="width:100%">
                         </div>
                            <p>
                                <?php echo substr($getsection[0]['course_description'],0,100).'...';?>
                            </p>

                            <div class="btn-group">
                               <a href="<?php echo $dirlocation;?>learn/courseware/view?view=<?php echo $getsection[0]['courseware_id'];?>" class="btn btn-white btn-xs">
                        <i class="fa fa-folder-open"></i>
                        View</a>
                        
                        <?php if($_SESSION['accessLogin']['user_id']==$data['profile']['profile'][0]['rand']){?>
                        
                                <a href="<?php echo $dirlocation;?>content/courseware/newcourseware?edit=<?php echo $getsection[0]['courseware_id'];?>">
                                <button class="btn btn-white btn-xs"><i class="fa fa-pencil-square-o"></i> Edit</button>
                          </a>      
                                <a href="<?php echo $dirlocation;?>content/index?delete=<?php echo $getsection[0]['courseware_id'];?>&&table=courseware">
                                <button class="btn btn-white btn-xs"><i class="fa fa-asterisk"></i> Delete</button></a>
                                
                                <?php }else{?>
                                <a class="btn btn-xs btn-white a2a_dd" data-toggle="modal" data-target="#myModalshare" data-a2a-url="<?php echo $dirlocation;?>learn/courseware/view?view=<?php echo $getsection[0]['courseware_id'];?>"><i class="fa fa-share"></i> Share </a>
                                
                                <?php if($checkpin[2]==0){?>                                                        
<a href="<?php echo $dirlocation;?>learn/profile?profileid=<?php echo $_GET['profileid'];?>&&pin=<?php echo $getsection[0]['courseware_id'];?>&&table=courseware" class="btn btn-xs btn-white"><i class="fa fa-tag"></i> Clip </a>
<?php }elseif($checkpin[2]>0){?>
<a href="<?php echo $dirlocation;?>learn/profile?profileid=<?php echo $_GET['profileid'];?>&&unpin=<?php echo $checkpin[0]['pin_id'];?>&&table=courseware" class="btn btn-xs btn-danger"><i class="fa fa-tag"></i> Unclip </a>
<?php }?>

                                
                                <?php }?>
                                
                            </div>
                            
                            
                        </div>
                        <div class="social-footer" style="display:none">
                            <div class="social-comment">
                                <a href="http://webapplayers.com/inspinia_admin-v2.5/profile_2.html" class="pull-left">
                                    <img alt="image" src="./INSPINIA_profile_contentcreator_files/a1.jpg">
                                </a>
                                <div class="media-body">
                                    <a href="http://webapplayers.com/inspinia_admin-v2.5/profile_2.html#">
                                        Andrew Williams
                                    </a>
                                    Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words.
                                    <br>
                                    <a href="http://webapplayers.com/inspinia_admin-v2.5/profile_2.html#" class="small"><i class="fa fa-thumbs-up"></i> 26 Like this!</a> -
                                    <small class="text-muted">12.06.2014</small>
                                </div>
                            </div>

                            <div class="social-comment">
                                <a href="http://webapplayers.com/inspinia_admin-v2.5/profile_2.html" class="pull-left">
                                    <img alt="image" src="./INSPINIA_profile_contentcreator_files/a2.jpg">
                                </a>
                                <div class="media-body">
                                    <a href="http://webapplayers.com/inspinia_admin-v2.5/profile_2.html#">
                                        Andrew Williams
                                    </a>
                                    Making this the first true generator on the Internet. It uses a dictionary of.
                                    <br>
                                    <a href="http://webapplayers.com/inspinia_admin-v2.5/profile_2.html#" class="small"><i class="fa fa-thumbs-up"></i> 11 Like this!</a> -
                                    <small class="text-muted">10.07.2014</small>
                                </div>
                            </div>

                            <div class="social-comment">
                                <a href="http://webapplayers.com/inspinia_admin-v2.5/profile_2.html" class="pull-left">
                                    <img alt="image" src="./INSPINIA_profile_contentcreator_files/a3.jpg">
                                </a>
                                <div class="media-body">
                                    <textarea class="form-control" placeholder="Write comment..."></textarea>
                                </div>
                            </div>

                        </div>

                    </div>
				</div>
                
                <?php }?>
					



                </div>
                

            </div>

        </div>
 
 
  <?php }?>