<div class="wrapper wrapper-content">
            <div class="row animated fadeInRight">
                
                <div class="col-md-12" style="text-align:center;margin-bottom:20px">
                    <div class="ibox float-e-margins">
                        
                            <h2>My Friends</h2>
                            
                       
                      <? while($grab=mysql_fetch_array($data['community']['friends'][1])){//print_r($grab);?>
                      <?php
					  
					  ///////////GET USER DETAILS////////////
	if($grab['request_to']==$_SESSION['accessLogin']['user_id']){		
	$getuserdetails=$crud->dbselect('student','*',"rand='".$grab['request_from']."'","");	
	}
	else{
	$getuserdetails=$crud->dbselect('student','*',"rand='".$grab['request_to']."'","");		
	}
	/*
	$getuserdetails=$crud->dbselect('student','*',"rand='".$grab['request_to']."'","");
	if($getuserdetails[2]==0){
	$getuserdetails=$crud->dbselect('student','*',"rand='".$grab['request_from']."'","");	
	}
	*/	
	$getarray=$getuserdetails;
	//$getarray=$crud->dbselect('student','*',"rand='".$grab['request_to']."' OR rand='".$grab['request_from']."'","");
	
					  ;?>
                      
                       <!---- IF ITS NOT THE SAME PERSON
                   If it is the same person, don't show the details
                   --->
                   <div class="col-lg-2" style="text-align:center;background:;margin:2px 3px">
                       <?php if($getarray[0]['rand']!=$_SESSION['accessLogin']['user_id']){?>
                      <div class="t" style="text-align:center;padding-top:10px">
                      <a href="<?php echo $dirlocation;?>learn/profile?profileid=<?php echo $getarray[0]['rand'];?>" style="color:inherit;font-weight:bold">
                      
                     <img alt="image" class="img-circle thumbnail" src="<?php if($getarray[0]['photo']==''){echo $dirlocation.'c_app/views/images/anonymous.png';}else{echo $dirlocation.'c_app/views/images/'.$getarray[0]['photo'];}?>" style="width:70px;height:70px;margin:auto;float:none">
                       
                      <p>
                    
       <?php echo substr($getarray[0]['full_name'],0,20).'...';?>
       
       </p>
                      </a>                      
                      </div>
                      <?php }?>
                      </div>
                      <? }?>  
                    </div>

                </div>
                <div style="clear:both"></div>
  <hr />
  
  <div class="col-md-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Co-creators</h5>
                            
                        </div>
                        
                    </div>

                </div>
                
                <?php if($_SESSION['accessLogin']['account_type']!='lecturer'){?>              
                <div class="col-md-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>My Classmates</h5>
                     </div>
                    <div class="ibox-content">

                            <div>
                                <div class="feed-activity-list">
							<?php
							
					while($grab=mysql_fetch_array($data['community']['classmates'][1])){
					?>
                                    <div class="feed-element">
                                        <a href="<?php echo $dirlocation;?>learn/profile?profileid=<?php echo $grab['rand'];?>" class="pull-left">
                                            <img alt="image" class="img-circle" src="<?php if($grab['photo']==''){echo $dirlocation.'c_app/views/images/anonymous.png';}else{echo $dirlocation.'c_app/views/images/'.$grab['photo'];}?>">
                                            
                                            
                                        </a>
                                        <div class="media-body">
                 <strong><?php echo $grab['full_name'];?></strong> <br/>
                
                <?php echo 'email: '. $grab['email'];?><br/>
                 <?php echo 'phone: '. $grab['phone_number'];?>
                                         
                                            <br>
                                           
                                            
                                        </div>
                                    </div>
                        
                        
                        <?php }?>            
                                    
                                    
                                </div>

                                <button class="btn btn-primary btn-block m"><i class="fa fa-arrow-down"></i> Show More</button>

                            </div>

                        </div>
                        
                    </div>

                </div>
                
                <?php }?>
                <div class="col-md-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>People you may know</h5>
                            
                        </div>
                        <div class="ibox-content">

                            <div>
                                <div class="feed-activity-list">
							<?php
							
					while($grab=mysql_fetch_array($data['community']['people_you_may_know'][1])){
					
					///////////CHECK IF THE REQUEST HAS BEEN ACCEPTED 
					//////CHECK IF HE INITIATED THE REQUEST
					$checkrequest=$crud->dbselect("friend_requests",'*',"request_to = '".$grab['rand']."' AND request_from ='".$_SESSION['accessLogin']['user_id']."'",'');
					
					//////ELSE CHECK IF THE REQUEST WAS INITIATED BY SOMEONE ELSE
					if($checkrequest[2]==0){
					$checkrequest=$crud->dbselect("friend_requests",'*',"request_to='".$_SESSION['accessLogin']['user_id']."' AND request_from ='".$grab['rand']."'",'');
					
					}
					?>
                   
                   <!---- IF ITS NOT THE SAME PERSON
                   If it is the same person, don't show the details
                   --->
         		 <?php if($grab['rand']!=$_SESSION['accessLogin']['user_id']){?>
                 
                 <!---- IF BOTH PERSONS ARE FRIENDS ALREADY, DONT SHOW
                   If this person has accepted friend request, don't show
                   --->
                   <?php if($checkrequest[0]['status']!=1){?>
                                    <div class="feed-element">
                                        <a href="<?php echo $dirlocation;?>learn/profile?profileid=<?php echo $grab['rand'];?>" class="pull-left">
                                            <img alt="image" class="img-circle" src="<?php if($grab['photo']==''){echo $dirlocation.'c_app/views/images/anonymous.png';}else{echo $dirlocation.'c_app/views/images/'.$grab['photo'];}?>">
                                            
                                            
                                        </a>
                                        <div class="media-body">
                                            <strong><?php echo $grab['full_name'];?></strong> 
                <?php if($grab['school']==$data['community']['profile']['profile'][0]['school']){?>
                <?php   if($_SESSION['accessLogin']['account_type']=='student'){ echo 'attends ';}else{echo 'is a lecturer at ';} echo $data['community']['profile']['profile'][0]['school'];?>
                <?php }elseif($grab['department']==$data['community']['profile']['profile'][0]['department']){?>
                 <?php echo 'is in '. $data['community']['profile']['profile'][0]['department'].' department';?>
                <?php }?>                            
                                            <br>
                                           
                                            <div class="actions">
                                            
                                          
                   <!---- IF A REQUEST WAS SENT BUT THE HAS NOT BE ACCEPTED YET--->
                   <?php if($checkrequest[2]==0){?> 
                                         <a class="btn btn-xs btn-white" href="<?php echo $dirlocation;?>learn/community?sendrequestto=<?php echo $grab['rand'];?>"><i class="fa fa-thumbs-up"></i> Send Request </a>
                                         <?php }else{?>
                                          <a class="btn btn-xs btn-info" href=""><i class="fa fa-mail-forward"></i> Friend request sent </a>
                                          <?php }?>
                                         
                                            </div>
                                        </div>
                                    </div>
						<?php }?>
                        
                        <?php }?>
                        
                        <?php }?>            
                                    
                                    
                                </div>

                                <button class="btn btn-primary btn-block m"><i class="fa fa-arrow-down"></i> Show More</button>

                            </div>

                        </div>
                    </div>

                </div>
                
                
            </div>
        </div>
        

<script>
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
})

</script>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Send Message</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
