<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="<?php echo $dirlocation;?>learn/search">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="SearchKeyword" id="top-search">
                </div>
            </form>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome to College Mobile</span>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  
                        <?php if($data['snipets']['checkrequest'][2]>0){?>
                        <span class="label label-warning"><?php echo $data['snipets']['checkrequest'][2];?></span>
                        <?php }?>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                    <?php 
	$crud=new Crud;				
	while($grab=mysql_fetch_array($data['snipets']['checkrequest'][1])){
$getownerdetails=$crud->dbselect('lecturer','*',"rand='".$grab['request_from']."'","");
	if($getownerdetails[2]==0){
	$getownerdetails=$crud->dbselect('student','*',"rand='".$grab['request_from']."'",""	);	
	}	
	?>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="http://webapplayers.com/inspinia_admin-v2.5/profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="<?php if($getownerdetails[0]['photo']==''){echo $dirlocation.'c_app/views/images/anonymous.png';}else{echo $dirlocation.'c_app/views/images/'.$getownerdetails[0]['photo'];}?>">
                                </a>
                                <div class="media-body">
                                    <strong><?php echo $getownerdetails[0]['full_name'];?></strong> sent you a friend request  <small class="text-muted"><?php echo $grab['date'];?></small><br/>
                                    <button class="btn btn-default btn-xs pull-right">Delete Request</button>
                                    <a href="<?php echo $dirlocation;?>learn/community?confirmrequestfrom=<?php echo $grab['request_from'];?>"><button class="btn btn-info btn-xs pull-right" style="margin-right:5px">Confirm</button></a>
                                    
                                </div>
                            </div>
                        </li>
                        
                        <li class="divider"></li>
                        <?php }?>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="http://webapplayers.com/inspinia_admin-v2.5/#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts" style="display:none">
                        <li>
                            <a href="http://webapplayers.com/inspinia_admin-v2.5/mailbox.html">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="http://webapplayers.com/inspinia_admin-v2.5/profile.html">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="http://webapplayers.com/inspinia_admin-v2.5/grid_options.html">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="http://webapplayers.com/inspinia_admin-v2.5/notifications.html">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="<?php echo $dirlocation;?>logout.php">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
                <li>
                    <a class="right-sidebar-toggle">
                        <i class="fa fa-tasks"></i>
                    </a>
                </li>
            </ul>

        </nav>                    