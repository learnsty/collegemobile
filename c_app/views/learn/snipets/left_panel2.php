<nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                             <img src="<?php if($_SESSION['accessLogin']['avater']==''){echo $dirlocation.'c_app/views/images/anonymous.png';}else{echo $dirlocation.'c_app/views/images/'.$_SESSION['accessLogin']['avater'];}?>" class="img-circle thumbnail" id="target2" style="width:70px;height:70px;margin-bottom:0;" onclick="$('#fileinput').trigger('click');" />
    <img src="<?php echo $dirlocation;?>c_app/views/images/default.gif" width="10%" class="loader2" style="display:none;margin:auto" />            
  <form id="uploadpassport" enctype="multipart/form-data" name="uploadavater">
     
     <input name="profile_photo" type="file" id="fileinput" onchange="$('.uploadbtn').show()" style="display:none"/>
     <input type="submit" ng-click="uploadpass()" value="Upload" class="uploadbtn btn btn-primary btn-sm" style="display:none;margin-top:7px"/>
     <input type="hidden" name="email" value="<?php echo $_SESSION['accessLogin']['email'];?>" />
     <input type="hidden" name="phone" value="<?php echo $_SESSION['accessLogin']['phone_number'];?>" />
     <input type="hidden" name="table" value="<?php echo $_SESSION['accessLogin']['account_type'];?>" />
     </form>
     
                             </span>
                             <div style="clear:both"></div>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="<?php echo $dirlocation;?>learn/profile">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $_SESSION['accessLogin']['full_name'];?></strong>
                             </span> <span class="text-muted text-xs block"> <?php echo $_SESSION['accessLogin']['email'];?> </span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="<?php echo $dirlocation;?>learn/profile">Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo $dirlocation;?>logout.php">Logout</a></li>
                            </ul>
                        </div>
                    <div class="logo-element">
                        CM+
                    </div>
                </li>
                <li>
                    <a class="<?php if($data['content'][1]==''){echo 'active-menu';}?>" href="<?php echo $dirlocation;?>learn"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span> <span class="fa arrow"></span></a>
                    
                </li>
                <li>
                    <a class="<?php if($data['content'][1]=='library'){echo 'active-menu';}?>" href="<?php echo $dirlocation;?>learn/library"><i class="fa fa-book"></i> <span class="nav-label">Library</span></a>
                </li>
                <li>
                    <a class="<?php if($data['content'][1]=='courseware'){echo 'active-menu';}?>" href="<?php echo $dirlocation;?>learn/courseware"><i class="fa fa-file-o"></i> <span class="nav-label">Courseware</span><span class="fa arrow"></span></a>
                    
                </li>
                <li>
                    <a class="<?php if($data['content'][1]=='classroom'){echo 'active-menu';}?>" href="<?php echo $dirlocation;?>learn/classroom"><i class="fa fa-desktop"></i> <span class="nav-label">Classroom </span></a>
                    
                </li>
                <li style="display:none">
                     <a class="<?php if($data['content'][1]=='pages'){echo 'active-menu';}?>" href="<?php echo $dirlocation;?>learn/pages"><i class="fa fa-pie-chart"></i> <span class="nav-label">Projects</span>  </a>
                </li>
                <li>
                     <a class="<?php if($data['content'][1]=='community'){echo 'active-menu';}?>" href="<?php echo $dirlocation;?>learn/community"><i class="fa fa-users"></i> <span class="nav-label">My Community</span></a>
                </li>
                <li>
                    <a class="landing_link <?php if($data['content'][1]=='feeds'){echo 'active-menu';}?>" href="<?php echo $dirlocation;?>learn/feeds"><i class="fa fa-rss"></i> <span class="nav-label">Feeds</span><span class="fa arrow"></span></a>
                    
                </li>
                
                <li>
                     <a class="<?php if($data['content'][1]=='pages'){echo 'active-menu';}?>" href="<?php echo $dirlocation;?>logout.php"><i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span><span class="fa arrow"></span></a>
                   
                </li>
                
                
            </ul>

        </div>
    </nav>