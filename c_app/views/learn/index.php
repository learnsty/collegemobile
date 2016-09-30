<!DOCTYPE html>
<html>

<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">

<!---
 <meta name="description" content="<?php echo $dirlocation;?>learn/courseware/view?view=<?php echo $_GET['view'];?>">
     <meta property="og:url" content="<?php echo $dirlocation.$data['Details'][0]['year'].'/'.$data['Details'][0]['month'].'/'.$data['Details'][0]['link'].'/';?>" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="<?php echo $data['library']['library'][0]['course_description'];?>" />
    <meta property="og:description"   content="<?php echo $data['library']['library'][0]['course_description'].'...';?>
" />
    <meta property="og:image"         content="<?php echo $dirlocation.'app/views/images/'.$data['library']['library'][0]['banner'];?>" />

    <meta name="keywords" content="Nigerian Courseware, Online Learning, Online Tutoring">
 -->   
    <title>College Mobile Dashboard</title>

    <link href="<?php echo $dirlocation;?>c_app/views/learn/inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $dirlocation;?>c_app/views/learn/inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">
     <link href="<?php echo $dirlocation;?>c_app/views/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo $dirlocation;?>c_app/views/learn/inspinia/css/animate.css" rel="stylesheet">
    <link href="<?php echo $dirlocation;?>c_app/views/learn/inspinia/css/style.css" rel="stylesheet">
	
</head>

<body class="" ng-app="jaraja" ng-controller="DashboardCtrl">

    <div id="wrapper">
       
         <?php include('snipets/left_panel.php');?>
                    
                        
        <div id="page-wrapper" class="gray-bg dashbard-1" style="min-height: 629px;">
        <div class="row border-bottom">
        <?php include('snipets/header.php');?>
        </div>
                
        <div class="row">
            <?php //include('pages/'.$data['content'][1].'.php');?>
        </div>

        </div>
        <div class="small-chat-box fadeInRight animated">

            <div class="heading" draggable="true">
                <small class="chat-date pull-right">
                    02.19.2015
                </small>
                Small chat
            </div>

            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 234px;"><div class="content" style="overflow: hidden; width: auto; height: 234px;">

                <div class="left">
                    <div class="author-name">
                        Monica Jackson <small class="chat-date">
                        10:02 am
                    </small>
                    </div>
                    <div class="chat-message active">
                        Lorem Ipsum is simply dummy text input.
                    </div>

                </div>
                <div class="right">
                    <div class="author-name">
                        Mick Smith
                        <small class="chat-date">
                            11:24 am
                        </small>
                    </div>
                    <div class="chat-message">
                        Lorem Ipsum is simpl.
                    </div>
                </div>
                <div class="left">
                    <div class="author-name">
                        Alice Novak
                        <small class="chat-date">
                            08:45 pm
                        </small>
                    </div>
                    <div class="chat-message active">
                        Check this stock char.
                    </div>
                </div>
                <div class="right">
                    <div class="author-name">
                        Anna Lamson
                        <small class="chat-date">
                            11:24 am
                        </small>
                    </div>
                    <div class="chat-message">
                        The standard chunk of Lorem Ipsum
                    </div>
                </div>
                <div class="left">
                    <div class="author-name">
                        Mick Lane
                        <small class="chat-date">
                            08:45 pm
                        </small>
                    </div>
                    <div class="chat-message active">
                        I belive that. Lorem Ipsum is simply dummy text.
                    </div>
                </div>


            </div><div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; background: rgb(0, 0, 0);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.4; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div></div>
            <div class="form-chat">
                <div class="input-group input-group-sm"><input type="text" class="form-control"> <span class="input-group-btn"> <button class="btn btn-primary" type="button">Send
                </button> </span></div>
            </div>

        </div>
        <div id="small-chat">

            <span class="badge badge-warning pull-right">5</span>
            <a class="open-small-chat">
                <i class="fa fa-comments"></i>

            </a>
        </div>
        
                            
        <div id="right-sidebar" class="">
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;"><div class="sidebar-container" style="overflow: hidden; width: auto; height: 100%;">

                <ul class="nav nav-tabs navs-3">

                    <li class="active"><a data-toggle="tab" href="http://webapplayers.com/inspinia_admin-v2.5/#tab-1">
                        Notes
                    </a></li>
                    <li><a data-toggle="tab" href="http://webapplayers.com/inspinia_admin-v2.5/#tab-2">
                        Projects
                    </a></li>
                    <li class=""><a data-toggle="tab" href="http://webapplayers.com/inspinia_admin-v2.5/#tab-3">
                        <i class="fa fa-gear"></i>
                    </a></li>
                </ul>

                <div class="tab-content">


                    <div id="tab-1" class="tab-pane active">

                        <div class="sidebar-title">
                            <h3> <i class="fa fa-comments-o"></i> Latest Notes</h3>
                            <small><i class="fa fa-tim"></i> You have 10 new message.</small>
                        </div>

                        <div>

                            <div class="sidebar-message">
                                <a href="http://webapplayers.com/inspinia_admin-v2.5/#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="./INSPINIA _ Dashboard_files/a1.jpg">

                                        <div class="m-t-xs">
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="media-body">

                                        There are many variations of passages of Lorem Ipsum available.
                                        <br>
                                        <small class="text-muted">Today 4:21 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="http://webapplayers.com/inspinia_admin-v2.5/#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="./INSPINIA _ Dashboard_files/a2.jpg">
                                    </div>
                                    <div class="media-body">
                                        The point of using Lorem Ipsum is that it has a more-or-less normal.
                                        <br>
                                        <small class="text-muted">Yesterday 2:45 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="http://webapplayers.com/inspinia_admin-v2.5/#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="./INSPINIA _ Dashboard_files/a3.jpg">

                                        <div class="m-t-xs">
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        Mevolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                        <br>
                                        <small class="text-muted">Yesterday 1:10 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="http://webapplayers.com/inspinia_admin-v2.5/#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="./INSPINIA _ Dashboard_files/a4.jpg">
                                    </div>

                                    <div class="media-body">
                                        Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the
                                        <br>
                                        <small class="text-muted">Monday 8:37 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="http://webapplayers.com/inspinia_admin-v2.5/#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="./INSPINIA _ Dashboard_files/a8.jpg">
                                    </div>
                                    <div class="media-body">

                                        All the Lorem Ipsum generators on the Internet tend to repeat.
                                        <br>
                                        <small class="text-muted">Today 4:21 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="http://webapplayers.com/inspinia_admin-v2.5/#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="./INSPINIA _ Dashboard_files/a7.jpg">
                                    </div>
                                    <div class="media-body">
                                        Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
                                        <br>
                                        <small class="text-muted">Yesterday 2:45 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="http://webapplayers.com/inspinia_admin-v2.5/#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="./INSPINIA _ Dashboard_files/a3.jpg">

                                        <div class="m-t-xs">
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        The standard chunk of Lorem Ipsum used since the 1500s is reproduced below.
                                        <br>
                                        <small class="text-muted">Yesterday 1:10 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="http://webapplayers.com/inspinia_admin-v2.5/#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="./INSPINIA _ Dashboard_files/a4.jpg">
                                    </div>
                                    <div class="media-body">
                                        Uncover many web sites still in their infancy. Various versions have.
                                        <br>
                                        <small class="text-muted">Monday 8:37 pm</small>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>

                    <div id="tab-2" class="tab-pane">

                        <div class="sidebar-title">
                            <h3> <i class="fa fa-cube"></i> Latest projects</h3>
                            <small><i class="fa fa-tim"></i> You have 14 projects. 10 not completed.</small>
                        </div>

                        <ul class="sidebar-list">
                            <li>
                                <a href="http://webapplayers.com/inspinia_admin-v2.5/#">
                                    <div class="small pull-right m-t-xs">9 hours ago</div>
                                    <h4>Business valuation</h4>
                                    It is a long established fact that a reader will be distracted.

                                    <div class="small">Completion with: 22%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                                    </div>
                                    <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                </a>
                            </li>
                            <li>
                                <a href="http://webapplayers.com/inspinia_admin-v2.5/#">
                                    <div class="small pull-right m-t-xs">9 hours ago</div>
                                    <h4>Contract with Company </h4>
                                    Many desktop publishing packages and web page editors.

                                    <div class="small">Completion with: 48%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 48%;" class="progress-bar"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="http://webapplayers.com/inspinia_admin-v2.5/#">
                                    <div class="small pull-right m-t-xs">9 hours ago</div>
                                    <h4>Meeting</h4>
                                    By the readable content of a page when looking at its layout.

                                    <div class="small">Completion with: 14%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 14%;" class="progress-bar progress-bar-info"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="http://webapplayers.com/inspinia_admin-v2.5/#">
                                    <span class="label label-primary pull-right">NEW</span>
                                    <h4>The generated</h4>
                                    <!--<div class="small pull-right m-t-xs">9 hours ago</div>-->
                                    There are many variations of passages of Lorem Ipsum available.

                                    <div class="small">Completion with: 22%</div>
                                    <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                </a>
                            </li>
                            <li>
                                <a href="http://webapplayers.com/inspinia_admin-v2.5/#">
                                    <div class="small pull-right m-t-xs">9 hours ago</div>
                                    <h4>Business valuation</h4>
                                    It is a long established fact that a reader will be distracted.

                                    <div class="small">Completion with: 22%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                                    </div>
                                    <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                </a>
                            </li>
                            <li>
                                <a href="http://webapplayers.com/inspinia_admin-v2.5/#">
                                    <div class="small pull-right m-t-xs">9 hours ago</div>
                                    <h4>Contract with Company </h4>
                                    Many desktop publishing packages and web page editors.

                                    <div class="small">Completion with: 48%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 48%;" class="progress-bar"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="http://webapplayers.com/inspinia_admin-v2.5/#">
                                    <div class="small pull-right m-t-xs">9 hours ago</div>
                                    <h4>Meeting</h4>
                                    By the readable content of a page when looking at its layout.

                                    <div class="small">Completion with: 14%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 14%;" class="progress-bar progress-bar-info"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="http://webapplayers.com/inspinia_admin-v2.5/#">
                                    <span class="label label-primary pull-right">NEW</span>
                                    <h4>The generated</h4>
                                    <!--<div class="small pull-right m-t-xs">9 hours ago</div>-->
                                    There are many variations of passages of Lorem Ipsum available.
                                    <div class="small">Completion with: 22%</div>
                                    <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                </a>
                            </li>

                        </ul>

                    </div>

                    <div id="tab-3" class="tab-pane">
                        <div class="sidebar-title">
                            <h3><i class="fa fa-gears"></i> Settings</h3>
                            <small><i class="fa fa-tim"></i> You have 14 projects. 10 not completed.</small>
                        </div>

                        <div class="setings-item">
                    <span>
                        Show notifications
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example">
                                    <label class="onoffswitch-label" for="example">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Disable Chat
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" checked="" class="onoffswitch-checkbox" id="example2">
                                    <label class="onoffswitch-label" for="example2">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Enable history
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example3">
                                    <label class="onoffswitch-label" for="example3">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Show charts
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example4">
                                    <label class="onoffswitch-label" for="example4">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Offline users
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" checked="" name="collapsemenu" class="onoffswitch-checkbox" id="example5">
                                    <label class="onoffswitch-label" for="example5">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Global search
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" checked="" name="collapsemenu" class="onoffswitch-checkbox" id="example6">
                                    <label class="onoffswitch-label" for="example6">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Update everyday
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example7">
                                    <label class="onoffswitch-label" for="example7">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-content">
                            <h4>Settings</h4>
                            <div class="small">
                                I belive that. Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                And typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                Over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                            </div>
                        </div>

                    </div>
                </div>

            </div><div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 336.067px; background: rgb(0, 0, 0);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.4; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div></div>



        </div>
    </div>



<!----- Javascript Button Trigger --->    
    <div class="modal inmodal fade" id="myModal6" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            
                                            <h5 class="modal-title">Hello <br/><?php echo $_SESSION['accessLogin']['full_name'];?></h5>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Your profile strength is average and needs to be upgraded</strong> <br/>
                                                Please fill in all details.  some sections are not completed in your profile. Students and teachers give priority to users with a complete profile..</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                            <a href="<?php echo $dirlocation;?>learn/profile?edit" class="btn btn-primary">Update my profile</a>
                                        </div>
                                    </div>
                                </div>
                            </div>


    
    <!----- Modal Delete Window --->    
    <div class="modal inmodal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content" style="text-align:center">
                                        <div class="modal-header">
                                            
                                            <h5 class="modal-title">Hey <br/><?php echo $_SESSION['accessLogin']['full_name'];?></h5>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                                Do you want to delete this classroom <strong id="deletename"></strong>?</p>
                                        </div>
                                        <img src="<?php echo $dirlocation;?>c_app/views/images/default.gif" width="30px" class="loader" style="display:none">
                                        <div class="alert alert-success" id="message" style="text-align:center;font-weight:bold;display:none">
                                        
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                            <a href="" class="btn btn-white" ng-click="confirmdelete()">Delete class</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
    


    <!----- Javascript Button Trigger --->    
    <div class="modal inmodal fade" id="enrolModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            
                                            <h5 class="modal-title">Hello <br/><?php echo $_SESSION['accessLogin']['full_name'];?></h5>
                                        </div>
                                        <div class="modal-body">
                                            <p>By enroling for this courseware, You have read and agreed to our terms and conditions
                                            
                                            <ul>
                                            <a href="#"><li>Terms and Conditions</li></a>
                                            <a href="#"><li>Privacy Policy</li></a>
                                           
                                            </ul>
                                            
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                            <a href="" class="btn btn-primary" ng-click="confirmenrol();">Enroll</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
    


	<script src="<?php echo $dirlocation;?>c_app/views/js/angular/angular.js"></script>
    <script src="<?php echo $dirlocation;?>c_app/views/js/angular/angular-cookies.js"></script>
    <script src="<?php echo $dirlocation;?>c_app/views/js/angular/angular-route.js"></script>
    <script src="<?php echo $dirlocation;?>c_app/views/js/angular/ngStorage.min.js"></script>
	<script src="<?php echo $dirlocation;?>c_app/views/js/app.js"></script>
    <script src="<?php echo $dirlocation;?>c_app/views/js/controllers/dashboardCtrl.js"></script>

    <!-- Mainly scripts -->
    <script src="<?php echo $dirlocation;?>c_app/views/learn/inspinia/js/jquery-2.1.1.js"></script>
    <script src="<?php echo $dirlocation;?>c_app/views/learn/inspinia/js/bootstrap.js"></script>
    <script src="<?php echo $dirlocation;?>c_app/views/learn/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo $dirlocation;?>c_app/views/learn/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo $dirlocation;?>c_app/views/learn/inspinia/js/inspinia.js"></script>
    <script src="<?php echo $dirlocation;?>c_app/views/learn/inspinia/js/plugins/pace/pace.min.js"></script>

    <!-- Peity -->
    <script src="<?php echo $dirlocation;?>c_app/views/learn/inspinia/js/plugins/peity/jquery.peity.min.js"></script>

    <!-- Peity -->
    <script src="<?php echo $dirlocation;?>c_app/views/learn/inspinia/js/demo/peity-demo.js"></script>

</body>

 <!-- Toastr -->
    <?php if(!isset($_SESSION['enterfirst'])){?>
    <script src="<?php echo $dirlocation;?>c_app/views/learn/inspinia/js/toastr/toastr.min.js"></script>
    <?php }?>
    
    
    <!---ADD TO ANY JS--->
  <script type="text/javascript" src="//static.addtoany.com/menu/page.js"></script>

<script>
a2a_config.onclick = 1;
</script>


  
    <!----TRIGGER THE MODAL WINDOW ON LOGIN-->
    <?php if (!isset($_SESSION['enterfirst'])){?>
	<script>
	$( "#signinregister" ).trigger( "click" );
	</script>
	<?php }?>
    
    

<?php
	session_start();
	$_SESSION['enterfirst']='1'
	;?>
    
    
<!-- THIS SCRIPT CONTROLS THE PROFILE IMAGE SHOWING ON TARGET ID !-->       
<script>
function showImage(src,target,target2) {
  var fr=new FileReader();
  // when image is loaded, set the src of the image where you want to display it
  fr.onload = function(e) { target.src = this.result; target2.src = this.result };
  src.addEventListener("change",function() {
    // fill fr with image data    
    fr.readAsDataURL(src.files[0]);
  });
}

var src = document.getElementById("fileinput");
var target = document.getElementById('target');
var target2 = document.getElementById('target2');
showImage(src,target,target2);
</script> 



</html>
