<nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                
					<li>
                        <a class="<?php if($data['content'][1]==''){echo 'active-menu';}?>" href="<?php echo $dirlocation;?>teach"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    
                    
                    <li>
                        <a class="<?php if($data['content'][1]=='library'){echo 'active-menu';}?>" href="<?php echo $dirlocation;?>teach/library"><i class="fa fa-dashboard"></i> Library</a>
                    </li>
                    <li>
                        <a class="<?php if($data['content'][1]=='classroom'){echo 'active-menu';}?>" href="<?php echo $dirlocation;?>teach/classroom"><i class="fa fa-desktop"></i> Classroom</a>
                    </li>
					 
        <?php if($_SESSION['adminaccessDetails']['priviledge']!='0'){?>
                     <li>
                  <a class="<?php if($data['content'][1]=='pages'){echo 'active-menu';}?>" href="<?php echo $dirlocation;?>dashboard/pages"><i class="fa fa-bar-chart-o"></i> Projects</a>
                    </li>
         <?php }?>
         
			           <li>
                  <a class="<?php if($data['content'][1]=='pages'){echo 'active-menu';}?>" href="<?php echo $dirlocation;?>dashboard/pages"><i class="fa fa-bar-chart-o"></i> My profile</a>
                    </li>
                    
                     <li>
                  <a class="<?php if($data['content'][1]=='pages'){echo 'active-menu';}?>" href="<?php echo $dirlocation;?>logout.php"><i class="fa fa-bar-chart-o"></i> Logout</a>
                    </li>

                    
                </ul>

            </div>

        </nav>