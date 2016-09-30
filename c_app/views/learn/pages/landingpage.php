            <div class="col-lg-12" style="background:#fff;display:"> 
            <div class="panel panel-default" style="margin-top:4px;border-left:5px solid #0C3">
    <div class="panel-body" style="padding-top:4px;padding-bottom:4px">
   <h5 style="color:#0C3;">CollegeMobile Dashboard</h5>
    Thousands of students are waiting for you. We help Students easily achieve academic success.<br/>
      
    </div>
    </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="col-lg-9">
                <a href="<?php echo $dirlocation;?>learn/library" style="color:inherit">
                    <div class="col-lg-4" style="text-align:center">
                        <div class="ibox">
                            <div class="ibox-content">
                             
                                <h2 class="text-navy">
                                    <i class="fa fa-book fa-rotate-270"></i><br/> Library
                                </h2>
                            
                            </div>
                        </div>
                    </div>
                    </a>
                     <a href="<?php echo $dirlocation;?>learn/classroom" style="color:inherit">
                    <div class="col-lg-4" style="text-align:center">
                        <div class="ibox">
                            <div class="ibox-content ">
                               
                                <h2 class="text-navy">
                                    <i class="fa fa-desktop"></i><br/> Classroom
                                </h2>
                               
                            </div>
                        </div>
                    </div>
                       </a>
                     <a href="<?php echo $dirlocation;?>learn/courseware" style="color:inherit">   
                    <div class="col-lg-4" style="text-align:center">
                        <div class="ibox">
                            <div class="ibox-content">
                               
                                <h2 class="text-navy">
                                    <i class="fa fa-file-o fa-rotate-90"></i><br/> Courseware
                                </h2>
                               
                            </div>
                        </div>
                    </div>
                    </a>
                     <a href="<?php echo $dirlocation;?>learn/community" style="color:inherit">
                    <div class="col-lg-4" style="text-align:center">
                        <div class="ibox">
                            <div class="ibox-content">
                               
                                <h2 class="text-navy">
                                    <i class="fa fa-users"></i><br/> My Community
                                </h2>
                                
                            </div>
                        </div>
                    </div>

				</a>
                 <a href="<?php echo $dirlocation;?>learn/feeds" style="color:inherit">
				<div class="col-lg-4" style="text-align:center">
                        <div class="ibox">
                            <div class="ibox-content">
                               
                                <h2 class="text-navy">
                                    <i class="fa fa-rss"></i><br/>Feeds
                                </h2>
                               
                            </div>
                        </div>
                    </div>
                    </a>
               <a href="<?php echo $dirlocation;?>learn/profile" style="color:inherit">
                    <div class="col-lg-4" style="text-align:center">
                        <div class="ibox">
                            <div class="ibox-content">
                               
                                <h2 class="text-navy">
                                    <i class="fa fa-user"></i><br/>My Profile
                                </h2>
                                
                            </div>
                        </div>
                    </div>
                 </a>   
                    
                    
                    
                </div>
                
                
                
 <div class="col-lg-3">
                <div class="contact-box">
                    <a href="<?php echo $dirlocation;?>learn/profile">
                    <div class="col-sm-10" style="margin:auto;float:none">
                        <div class="text-center">
                            <img alt="image" class="img-circle m-t-xs img-responsive" src="<?php if($_SESSION['accessLogin']['avater']==''){echo $dirlocation.'c_app/views/images/anonymous.png';}else{echo $dirlocation.'c_app/views/images/'.$_SESSION['accessLogin']['avater'];}?>"  id="target">
                            <div class="m-t-xs font-bold"><i class="fa fa-user"></i><?php echo $_SESSION['accessLogin']['full_name'];?></div><br/>
                           <?php echo $_SESSION['accessLogin']['email'];?>
                            
                        </div>
                    </div>
                    
                    <div class="clearfix"></div>
                        </a>
                </div>
            
    </div>
    
            </div>
            
          
                </div>


                
                <!-- /. ROW  -->

                
                <!-- /. ROW  -->