<!DOCTYPE html>
<!-- saved from url=(0045)http://webapplayers.com/inspinia_admin-v2.5/# -->
<html>
<script async src="<?php echo $dirlocation;?>c_app/views/learn/inspinia/analytics.js"></script><script id="tinyhippos-injected">if (window.top.ripple) { window.top.ripple("bootstrap").inject(window, document); }</script>
<script id="tinyhippos-injected">if (window.top.ripple) { window.top.ripple("bootstrap").inject(window, document); }</script>
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>College Mobile Dashboard</title>

    <link href="<?php echo $dirlocation;?>c_app/views/learn/inspinia/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $dirlocation;?>c_app/views/learn/inspinia/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="<?php echo $dirlocation;?>c_app/views/learn/inspinia/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="<?php echo $dirlocation;?>c_app/views/learn/inspinia/jquery.gritter.css" rel="stylesheet">

    <link href="<?php echo $dirlocation;?>c_app/views/learn/inspinia/animate.css" rel="stylesheet">
    <link href="<?php echo $dirlocation;?>c_app/views/learn/inspinia/style.css" rel="stylesheet">
    <link href="<?php echo $dirlocation;?>c_app/views/css/font-awesome.css" rel="stylesheet" />

    
    
<style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style></head>

<body class="pace-done" ng-app="jaraja" ng-controller="DashboardCtrl"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
  <div class="pace-progress-inner"></div>
</div>
<div class="pace-activity"></div></div>
    <div id="wrapper">
        
         <?php include('c_app/views/contentpartner/snipets/left_panel.php');?>
                    
                        
        <div id="page-wrapper" class="gray-bg dashbard-1" style="min-height: 629px;">
        <div class="row border-bottom">
        <?php //include('snipets/header.php');?>
        </div>
                
        <div class="row">
            
            <div class="wrapper wrapper-content animated fadeInRight" >


            <div class="row m-b-lg m-t-lg" >
            
                <div class="col-md-6">

                    <div class="profile-image">
                        <img src="<?php if($_SESSION['accessLogin']['avater']==''){echo $dirlocation.'c_app/views/images/anonymous.png';}else{echo $dirlocation.'c_app/views/images/'.$_SESSION['accessLogin']['avater'];}?>" class="img-circle circle-border m-b-md" alt="profile" id="target3">
                    </div>
                    <div class="profile-info">
                        <div class="">
                            <div>
                                <h2 class="no-margins">
                                    <?php echo $_SESSION['accessLogin']['full_name'];?>
                              </h2>
                                <h4><?php echo $_SESSION['accessLogin']['website'];?></h4>
                                <small>
                                    <?php echo $_SESSION['accessLogin']['about_me'];?>
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
                                <a href="<?php echo $dirlocation;?>content/index">
                                <strong><?php echo $data['library']['mylibrary'][2];?></strong> Coursewares
                                </a>    
                            </td>
                            <td>
                                <a href="<?php echo $dirlocation;?>content/followers">
                                <strong><?php echo $data['follow']['followers'][2];?></strong> Followers
                                </a>    
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
                    <h2 class="no-margins"><?php echo $data['library']['mylibrary'][2];?></h2>
                     <a href="<?php echo $dirlocation;?>content/courseware/newcourseware" class="btn btn-default btn-sm">Add New Courseware</a>
                    <div id="sparkline1"><canvas width="241" height="50" style="display: inline-block; width: 241px; height: 50px; vertical-align: top;"></canvas></div>
                </div>


            </div>
                
            <?php include('pages/'.$data['content'][1].'.php');?>
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
                                        <img alt="image" class="img-circle message-avatar" src="<?php echo $dirlocation;?>c_app/views/learn/inspinia/a1.jpg">

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
                                        <img alt="image" class="img-circle message-avatar" src="<?php echo $dirlocation;?>c_app/views/learn/inspinia/a2.jpg">
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
                                        <img alt="image" class="img-circle message-avatar" src="<?php echo $dirlocation;?>c_app/views/learn/inspinia/a3.jpg">

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
                                        <img alt="image" class="img-circle message-avatar" src="<?php echo $dirlocation;?>c_app/views/learn/inspinia/a4.jpg">
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
                                        <img alt="image" class="img-circle message-avatar" src="<?php echo $dirlocation;?>c_app/views/learn/inspinia/a8.jpg">
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
                                        <img alt="image" class="img-circle message-avatar" src="<?php echo $dirlocation;?>c_app/views/learn/inspinia/a7.jpg">
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
                                        <img alt="image" class="img-circle message-avatar" src="<?php echo $dirlocation;?>c_app/views/learn/inspinia/a3.jpg">

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
                                        <img alt="image" class="img-circle message-avatar" src="<?php echo $dirlocation;?>c_app/views/learn/inspinia/a4.jpg">
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
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
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


	<script src="<?php echo $dirlocation;?>c_app/views/js/angular/angular.js"></script>
    <script src="<?php echo $dirlocation;?>c_app/views/js/angular/angular-cookies.js"></script>
    <script src="<?php echo $dirlocation;?>c_app/views/js/angular/angular-route.js"></script>
    <script src="<?php echo $dirlocation;?>c_app/views/js/angular/ngStorage.min.js"></script>
	<script src="<?php echo $dirlocation;?>c_app/views/js/app.js"></script>
    <script src="<?php echo $dirlocation;?>c_app/views/js/controllers/dashboardCtrl.js"></script>

        <!-- Mainly scripts -->
    <script src="<?php echo $dirlocation;?>c_app/views/learn/inspinia/jquery-2.1.1.js"></script>
    <script src="<?php echo $dirlocation;?>c_app/views/learn/inspinia/bootstrap.min.js"></script>
    <script src="<?php echo $dirlocation;?>c_app/views/learn/inspinia/jquery.metisMenu.js"></script>
    <script src="<?php echo $dirlocation;?>c_app/views/learn/inspinia/jquery.slimscroll.min.js"></script>




    <!-- Toastr -->
    <?php if (!isset($_SESSION['enterfirst'])){?>
    <script src="<?php echo $dirlocation;?>c_app/views/learn/inspinia/toastr.min.js"></script>
    <?php }?>
    
    
    <!----TRIGGER THE MODAL WINDOW ON LOGIN-->
    <?php if (!isset($_SESSION['enterfirst'])){?>
	<script>
	$(document).ready(function() {
		
	$( "#signinregister" ).trigger( "click" );
	});
	</script>
	<?php }?>
    
    
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-4625583-2', 'webapplayers.com');
        ga('send', 'pageview');

    </script>
    
    
	<script>
    // Config box

    // Enable/disable fixed top navbar
    $('#fixednavbar').click(function (){
        if ($('#fixednavbar').is(':checked')){
            $(".navbar-static-top").removeClass('navbar-static-top').addClass('navbar-fixed-top');
            $("body").removeClass('boxed-layout');
            $("body").addClass('fixed-nav');
            $('#boxedlayout').prop('checked', false);

            if (localStorageSupport){
                localStorage.setItem("boxedlayout",'off');
            }

            if (localStorageSupport){
                localStorage.setItem("fixednavbar",'on');
            }
        } else{
            $(".navbar-fixed-top").removeClass('navbar-fixed-top').addClass('navbar-static-top');
            $("body").removeClass('fixed-nav');
            $("body").removeClass('fixed-nav-basic');
            $('#fixednavbar2').prop('checked', false);

            if (localStorageSupport){
                localStorage.setItem("fixednavbar",'off');
            }

            if (localStorageSupport){
                localStorage.setItem("fixednavbar2",'off');
            }
        }
    });

    // Enable/disable fixed top navbar
    $('#fixednavbar2').click(function (){
        if ($('#fixednavbar2').is(':checked')){
            $(".navbar-static-top").removeClass('navbar-static-top').addClass('navbar-fixed-top');
            $("body").removeClass('boxed-layout');
            $("body").addClass('fixed-nav').addClass('fixed-nav-basic');
            $('#boxedlayout').prop('checked', false);

            if (localStorageSupport){
                localStorage.setItem("boxedlayout",'off');
            }

            if (localStorageSupport){
                localStorage.setItem("fixednavbar2",'on');
            }
        } else {
            $(".navbar-fixed-top").removeClass('navbar-fixed-top').addClass('navbar-static-top');
            $("body").removeClass('fixed-nav').removeClass('fixed-nav-basic');
            $('#fixednavbar').prop('checked', false);

            if (localStorageSupport){
                localStorage.setItem("fixednavbar2",'off');
            }
            if (localStorageSupport){
                localStorage.setItem("fixednavbar",'off');
            }
        }
    });

    // Enable/disable fixed sidebar
    $('#fixedsidebar').click(function (){
        if ($('#fixedsidebar').is(':checked')){
            $("body").addClass('fixed-sidebar');
            $('.sidebar-collapse').slimScroll({
                height: '100%',
                railOpacity: 0.9
            });

            if (localStorageSupport){
                localStorage.setItem("fixedsidebar",'on');
            }
        } else{
            $('.sidebar-collapse').slimscroll({destroy: true});
            $('.sidebar-collapse').attr('style', '');
            $("body").removeClass('fixed-sidebar');

            if (localStorageSupport){
                localStorage.setItem("fixedsidebar",'off');
            }
        }
    });

    // Enable/disable collapse menu
    $('#collapsemenu').click(function (){
        if ($('#collapsemenu').is(':checked')){
            $("body").addClass('mini-navbar');
            SmoothlyMenu();

            if (localStorageSupport){
                localStorage.setItem("collapse_menu",'on');
            }

        } else{
            $("body").removeClass('mini-navbar');
            SmoothlyMenu();

            if (localStorageSupport){
                localStorage.setItem("collapse_menu",'off');
            }
        }
    });

    // Enable/disable boxed layout
    $('#boxedlayout').click(function (){
        if ($('#boxedlayout').is(':checked')){
            $("body").addClass('boxed-layout');
            $('#fixednavbar').prop('checked', false);
            $('#fixednavbar2').prop('checked', false);
            $(".navbar-fixed-top").removeClass('navbar-fixed-top').addClass('navbar-static-top');
            $("body").removeClass('fixed-nav');
            $("body").removeClass('fixed-nav-basic');
            $(".footer").removeClass('fixed');
            $('#fixedfooter').prop('checked', false);

            if (localStorageSupport){
                localStorage.setItem("fixednavbar",'off');
            }

            if (localStorageSupport){
                localStorage.setItem("fixednavbar2",'off');
            }

            if (localStorageSupport){
                localStorage.setItem("fixedfooter",'off');
            }


            if (localStorageSupport){
                localStorage.setItem("boxedlayout",'on');
            }
        } else{
            $("body").removeClass('boxed-layout');

            if (localStorageSupport){
                localStorage.setItem("boxedlayout",'off');
            }
        }
    });

    // Enable/disable fixed footer
    $('#fixedfooter').click(function (){
        if ($('#fixedfooter').is(':checked')){
            $('#boxedlayout').prop('checked', false);
            $("body").removeClass('boxed-layout');
            $(".footer").addClass('fixed');

            if (localStorageSupport){
                localStorage.setItem("boxedlayout",'off');
            }

            if (localStorageSupport){
                localStorage.setItem("fixedfooter",'on');
            }
        } else{
            $(".footer").removeClass('fixed');

            if (localStorageSupport){
                localStorage.setItem("fixedfooter",'off');
            }
        }
    });

    // SKIN Select
    $('.spin-icon').click(function (){
        $(".theme-config-box").toggleClass("show");
    });

    // Default skin
    $('.s-skin-0').click(function (){
        $("body").removeClass("skin-1");
        $("body").removeClass("skin-2");
        $("body").removeClass("skin-3");
    });

    // Blue skin
    $('.s-skin-1').click(function (){
        $("body").removeClass("skin-2");
        $("body").removeClass("skin-3");
        $("body").addClass("skin-1");
    });

    // Inspinia ultra skin
    $('.s-skin-2').click(function (){
        $("body").removeClass("skin-1");
        $("body").removeClass("skin-3");
        $("body").addClass("skin-2");
    });

    // Yellow skin
    $('.s-skin-3').click(function (){
        $("body").removeClass("skin-1");
        $("body").removeClass("skin-2");
        $("body").addClass("skin-3");
    });

    if (localStorageSupport){
        var collapse = localStorage.getItem("collapse_menu");
        var fixedsidebar = localStorage.getItem("fixedsidebar");
        var fixednavbar = localStorage.getItem("fixednavbar");
        var fixednavbar2 = localStorage.getItem("fixednavbar2");
        var boxedlayout = localStorage.getItem("boxedlayout");
        var fixedfooter = localStorage.getItem("fixedfooter");

        if (collapse == 'on'){
            $('#collapsemenu').prop('checked','checked')
        }
        if (fixedsidebar == 'on'){
            $('#fixedsidebar').prop('checked','checked')
        }
        if (fixednavbar == 'on'){
            $('#fixednavbar').prop('checked','checked')
        }
        if (fixednavbar2 == 'on'){
            $('#fixednavbar2').prop('checked','checked')
        }
        if (boxedlayout == 'on'){
            $('#boxedlayout').prop('checked','checked')
        }
        if (fixedfooter == 'on') {
            $('#fixedfooter').prop('checked','checked')
        }
    }
</script>


<!-- THIS SCRIPT CONTROLS THE PROFILE IMAGE SHOWING ON TARGET ID !-->       
<script>
function showImage(src,target,target2,target3) {
  var fr=new FileReader();
  // when image is loaded, set the src of the image where you want to display it
  fr.onload = function(e) { target.src = this.result; target2.src = this.result; target3.src = this.result };
  src.addEventListener("change",function() {
    // fill fr with image data    
    fr.readAsDataURL(src.files[0]);
  });
}

var src = document.getElementById("fileinput");
var target = document.getElementById('target');
var target2 = document.getElementById('target2');
var target3 = document.getElementById('target3');

showImage(src,target,target2,target3);
</script> 



</body>

</html>