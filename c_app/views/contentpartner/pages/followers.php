<?php if(!isset($_GET['follower_id'])){?>
<div class="row m-b-lg m-t-lg" >                
<div class="col-md-12" style="text-align:center;margin-bottom:20px">
                    <div class="ibox float-e-margins">
                        
                            <h2>My Followers</h2>
                            
                       
                      <? while($grab=mysql_fetch_array($data['follow']['followers'][1])){//print_r($grab);?>
                      <?php
					  
					  ///////////GET USER DETAILS////////////
	$crud=new Crud;		
	$getuserdetails=$crud->dbselect('student','*',"rand='".$grab['follower_id']."'","");	
    if($getuserdetails[2]==0){
    $getuserdetails=$crud->dbselect('teacher','*',"rand='".$grab['follower_id']."'","");	      
    }
	
	;?>
                        
                      
                <!---- IF ITS NOT THE SAME PERSON
                   If it is the same person, don't show the details
                   --->
                   <div class="col-lg-2" style="text-align:center;background:;margin:2px 3px">
                       <?php if($getuserdetails[0]['rand']!=$_SESSION['accessLogin']['user_id']){?>
                      
                      <div class="t" style="text-align:center;padding-top:10px">
                      <a href="<?php echo $dirlocation;?>content/followers?follower_id=<?php echo $getuserdetails[0]['rand'];?>" style="color:inherit;font-weight:bold">
                      
                     <img alt="image" class="img-circle thumbnail" src="<?php if($getuserdetails[0]['photo']==''){echo $dirlocation.'c_app/views/images/anonymous.png';}else{echo $dirlocation.'c_app/views/images/'.$getuserdetails[0]['photo'];}?>" style="width:70px;height:70px;margin:auto;float:none">
                       
                      <p>
                    
       <?php echo $getuserdetails[0]['full_name'];?>
       
       </p>
                      </a>                      
                      </div>
                      <?php }?>
                      </div>
                      <? }?>  
                    </div>

                </div>
</div>



<?php } elseif(isset($_GET['follower_id'])){?>
                <div class="col-md-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Profile Detail</h5>
                        </div>
                        <div>
                            <div class="ibox-content no-padding border-left-right">
                                <img src="<?php if($data['follow']['follower_profile'][0]['photo']==''){echo $dirlocation.'c_app/views/images/anonymous.png';}else{echo $dirlocation.'c_app/views/images/'.$data['follow']['follower_profile'][0]['photo'];}?>" class="img-responsive" />
                            </div>
                            <div class="ibox-content profile-content">
                                <h4><strong><?php echo ucwords(strtolower($data['follow']['follower_profile'][0]['full_name'])).'  ('.$data['follow']['follower_profile'][0]['phone_number'].')';?></strong></h4>
                                <p><i class="fa fa-envelope"></i> <?php echo $data['follow']['follower_profile'][0]['email'];?></p>
                                <h5>
                                    About me
                                </h5>
                                
                                <label>School </label> <?php echo $data['follow']['follower_profile'][0]['school'];?><br/>
                                <label>Department </label> <?php echo $data['follow']['follower_profile'][0]['department'];?><br/>
                         
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
                               
                               <?php if(!isset($_GET['follower_id'])){?> 
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
                    
                    <?php }?>



</div>