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
                         <a href="<?php echo $dirlocation;?>content/profile?edit" class="btn btn-primary btn-sm btn-block"><i class="fa fa-pencil"></i> Edit Profile</a>
                                        </div>
                                        
                                    </div>
                                </div>
                                <?php }?>
                            </div>
                            
                            
                            
                    </div>
                </div>
                    </div>
                    <?php }?>
                    
                    <?php if(isset($_GET['edit'])){?>
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
        <label class="col-lg-2 control-label">Institution</label>



            <div class="col-lg-10">
            <input type="name" placeholder="Full name" name="full_name" class="form-control" value="<?php echo ucwords(strtolower($data['profile']['profile'][0]['full_name']));?>" required> 

            </div>

        </div>

        <div class="form-group"><label class="col-lg-2 control-label">Email</label>

            <div class="col-lg-10">
            <input type="email" placeholder="email address" name="email" class="form-control" value="<?php echo $data['profile']['profile'][0]['email'];?>" required></div>

        </div>

		<div class="form-group"><label class="col-lg-2 control-label">Website</label>

            <div class="col-lg-10">
            <input type="url" placeholder="http://www.yourdomain.com" name="website" class="form-control" value="<?php echo $data['profile']['profile'][0]['website'];?>" required></div>

        </div>
        
        
		<div class="form-group">
        <label class="col-lg-2 control-label">About</label>

            <div class="col-lg-10">
            <textarea name="about" placeholder="Short description about yourself" class="form-control" rows="5" style="font-size:12px" required><?php echo $data['profile']['profile'][0]['about_me'];?></textarea>
            

            </div>

        </div>
        
        <hr />
        
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
                    
                    
                    
  </div>
  
  </div>                          
                   </div>