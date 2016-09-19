<nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                
					<li>
                        <a class="<?php if($data['content'][1]==''){echo 'active-menu';}?>" href="<?php echo $dirlocation;?>learn"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    
                    
                    <li>
                        <a class="<?php if($data['content'][1]=='library'){echo 'active-menu';}?>" href="<?php echo $dirlocation;?>learn/library"><i class="fa fa-dashboard"></i> Library</a>
                    </li>
                    
                     <li>
                        <a class="<?php if($data['content'][1]=='courseware'){echo 'active-menu';}?>" href="<?php echo $dirlocation;?>learn/courseware"><i class="fa fa-book"></i> Courseware</a>
                    </li>
                    
                    <li>
                        <a class="<?php if($data['content'][1]=='classroom'){echo 'active-menu';}?>" href="<?php echo $dirlocation;?>learn/classroom"><i class="fa fa-desktop"></i> Classroom</a>
                    </li>
					 
        <?php if($_SESSION['adminaccessDetails']['priviledge']!='0'){?>
                     <li>
                  <a class="<?php if($data['content'][1]=='pages'){echo 'active-menu';}?>" href="<?php echo $dirlocation;?>learn/pages"><i class="fa fa-bar-chart-o"></i> Projects</a>
                    </li>
         <?php }?>
         
			           <li>
                  <a class="<?php if($data['content'][1]=='community'){echo 'active-menu';}?>" href="<?php echo $dirlocation;?>learn/community"><i class="fa fa-group"></i> My Community</a>
                    </li>
                    
                    <li>
                  <a class="<?php if($data['content'][1]=='feeds'){echo 'active-menu';}?>" href="<?php echo $dirlocation;?>learn/feeds"><i class="fa fa-rss"></i> Feeds</a>
                    </li>
                    
                     <li>
                  <a class="<?php if($data['content'][1]=='pages'){echo 'active-menu';}?>" href="<?php echo $dirlocation;?>logout.php"><i class="fa fa-bar-chart-o"></i> Logout</a>
                    </li>

                    
                </ul>

            </div>

        </nav>