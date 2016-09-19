<div class="col-lg-12">
                <div class="wrapper wrapper-content">
                        <div class="row">
                        <div class="col-lg-3">
                            
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Read below comments</h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="http://webapplayers.com/inspinia_admin-v2.5/#">
                                            <i class="fa fa-wrench"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-user">
                                            <li><a href="http://webapplayers.com/inspinia_admin-v2.5/#">Config option 1</a>
                                            </li>
                                            <li><a href="http://webapplayers.com/inspinia_admin-v2.5/#">Config option 2</a>
                                            </li>
                                        </ul>
                                        <a class="close-link">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="ibox-content no-padding">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <p><a class="text-info" href="http://webapplayers.com/inspinia_admin-v2.5/#">@Alan Marry</a> I belive that. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                            <small class="block text-muted"><i class="fa fa-clock-o"></i> 1 minuts ago</small>
                                        </li>
                                        <li class="list-group-item">
                                            <p><a class="text-info" href="http://webapplayers.com/inspinia_admin-v2.5/#">@Stock Man</a> Check this stock chart. This price is crazy! </p>
                                            <div class="text-center m">
                                                <span id="sparkline8"><canvas width="170" height="150" style="display: inline-block; width: 170px; height: 150px; vertical-align: top;"></canvas></span>
                                            </div>
                                            <small class="block text-muted"><i class="fa fa-clock-o"></i> 2 hours ago</small>
                                        </li>
                                        <li class="list-group-item">
                                            <p><a class="text-info" href="http://webapplayers.com/inspinia_admin-v2.5/#">@Kevin Smith</a> Lorem ipsum unknown printer took a galley </p>
                                            <small class="block text-muted"><i class="fa fa-clock-o"></i> 2 minuts ago</small>
                                        </li>
                                        <li class="list-group-item ">
                                            <p><a class="text-info" href="http://webapplayers.com/inspinia_admin-v2.5/#">@Jonathan Febrick</a> The standard chunk of Lorem Ipsum</p>
                                            <small class="block text-muted"><i class="fa fa-clock-o"></i> 1 hour ago</small>
                                        </li>
                                        <li class="list-group-item">
                                            <p><a class="text-info" href="http://webapplayers.com/inspinia_admin-v2.5/#">@Alan Marry</a> I belive that. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                            <small class="block text-muted"><i class="fa fa-clock-o"></i> 1 minuts ago</small>
                                        </li>
                                        <li class="list-group-item">
                                            <p><a class="text-info" href="http://webapplayers.com/inspinia_admin-v2.5/#">@Kevin Smith</a> Lorem ipsum unknown printer took a galley </p>
                                            <small class="block text-muted"><i class="fa fa-clock-o"></i> 2 minuts ago</small>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                            <div class="col-lg-5">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Your daily feed</h5>
                                        
                                    </div>
                                    <div class="ibox-content">

                                        <div>
                                            <div class="feed-activity-list">
 <?php
		$crud=new Crud;

	 while($grab=mysql_fetch_array($data['allclassroom']['feeds'])){
		$getsection=$crud->dbselect($grab['activity_type'],'*',$grab['activity_type'].'_id='.$grab['activity_type_id'],'');
		
		$explode=end(explode('.',strtolower($getsection[0]['path'])));
	 	
		?>                           
        <?php if($grab['activity_type']=='courseware'){
		$getownerdetails=$crud->dbselect('lecturer','*',"staff_id='".$getsection[0]['staff_id']."'","");
	if($getownerdetails[2]==0){
	$getownerdetails=$crud->dbselect('student','*',"reg_number='".$getsection[0]['staff_id']."'","");	
	}
	
		?>
                                                
        <div class="feed-element">
            <a href="http://webapplayers.com/inspinia_admin-v2.5/profile.html" class="pull-left">
                <img alt="image" class="img-circle" src="<?php if($grab['photo']==''){echo $dirlocation.'c_app/views/images/anonymous.png';}else{echo $dirlocation.'c_app/views/images/'.$grab['photo'];}?>">
            </a>
            <div class="media-body ">
                <small class="pull-right"><?php echo $grab['time'];?></small>
                <strong><?php echo $getownerdetails[0]['full_name'];?></strong> shared a courseware -  <strong><?php echo $getsection[0]['course_title'];?></strong> <br>
                
                <small class="text-muted"><?php echo $getsection['date'];?></small>
                                                        <div class="well">
                                                           <?php echo $getsection[0]['course_description'];?>
                                                        </div>
                                                        <div class="pull-right">
                                                            <a class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> Like </a>
                                                            <a class="btn btn-xs btn-white"><i class="fa fa-folder-open"></i> Open </a>
                                                            <a class="btn btn-xs btn-white"><i class="fa fa-share"></i> Share </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                
 <?php }?>
 <?php if($grab['activity_type']=='classroom'){
	 	$getownerdetails=$crud->dbselect('lecturer','*',"staff_id='".$getsection[0]['staff_id']."'","");
	if($getownerdetails[2]==0){
	$getownerdetails=$crud->dbselect('student','*',"reg_number='".$getsection[0]['staff_id']."'","");	
	}
	
	$getstudentsinaclass=$crud->dbselect('classroom_users','*',"classroom_id='".$getsection[0]['classroom_id']."'","");	
	$getbooksinaclass=$crud->dbselect('courseware','*',"classroom_id='".$getsection[0]['classroom_id']."'","");	
	$checkclassroom=$crud->dbselect('classroom_users','*',"student_id='".$_SESSION['accessLogin']['user_id']."'AND classroom_id='".$getsection[0]['classroom_id']."'",'');

	 ?>
 
                <div class="feed-element">
                    <a href="" class="pull-left">
                        <img alt="image" class="img-circle" src="<?php if($getsection[0]['photo']==''){echo $dirlocation.'c_app/views/images/anonymous.png';}else{echo $dirlocation.'c_app/views/images/'.$getsection[0]['photo'];}?>">
                    </a>
                    <div class="media-body ">
                        <small class="pull-right"><?php echo $grab['time'];?></small>
                        <strong><?php echo $getownerdetails[0]['full_name'];?></strong> created a classroom - <strong><?php echo $getsection[0]['classroom_title'];?></strong>. <br>
                        
                        <small class="text-muted"><?php echo $grab['time'];?></small>
                        <div class="well">
                      <?php echo $getsection[0]['classroom_description'];?>
                       </div>
                       
                       <div class="pull-right">
                       <?php if($checkclassroom[2]==0){?>
              <a href="<?php echo $dirlocation;?>learn/feeds?join=<?php echo $getsection[0]['classroom_id'];?>" class="btn btn-xs btn-white" data-toggle="tooltip" data-placement="top" title="Join this classroom">
              +Join Class
              </a><?php }else{?>
              <a href="<?php echo $dirlocation;?>learn/feeds?leave=<?php echo $getsection[0]['classroom_id'];?>" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Leave this classroom">
              -Leave Class
              </a><?php }?>   
              <a class="btn btn-xs btn-white" ><i class="fa fa-group"></i> <?php echo $getstudentsinaclass[2];?> </a>
                                                            <a class="btn btn-xs btn-white"><i class="fa fa-book"></i> <?php echo $getbooksinaclass[2];?> </a>
                                                            <a class="btn btn-xs btn-white"><i class="fa fa-share"></i> Share </a>
                                                        </div>
                                                        
                                                       
                    </div>
                </div>
  <?php }?>
  <?php }?>
                                               
                                            </div>

                                            <button class="btn btn-primary btn-block m-t"><i class="fa fa-arrow-down"></i> Show More</button>

                                        </div>

                                    </div>
                                </div>

                            </div>
                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Alpha project</h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="http://webapplayers.com/inspinia_admin-v2.5/#">
                                            <i class="fa fa-wrench"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-user">
                                            <li><a href="http://webapplayers.com/inspinia_admin-v2.5/#">Config option 1</a>
                                            </li>
                                            <li><a href="http://webapplayers.com/inspinia_admin-v2.5/#">Config option 2</a>
                                            </li>
                                        </ul>
                                        <a class="close-link">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="ibox-content ibox-heading">
                                    <h3>You have meeting today!</h3>
                                    <small><i class="fa fa-map-marker"></i> Meeting is on 6:00am. Check your schedule to see detail.</small>
                                </div>
                                <div class="ibox-content inspinia-timeline">

                                    <div class="timeline-item">
                                        <div class="row">
                                            <div class="col-xs-3 date">
                                                <i class="fa fa-briefcase"></i>
                                                6:00 am
                                                <br>
                                                <small class="text-navy">2 hour ago</small>
                                            </div>
                                            <div class="col-xs-7 content no-top-border">
                                                <p class="m-b-xs"><strong>Meeting</strong></p>

                                                <p>Conference on the sales results for the previous year. Monica please examine sales trends in marketing and products. Below please find the current status of the
                                                    sale.</p>

                                                <p><span data-diameter="40" class="updating-chart" style="display: none;">2,9,8,7,4,5,1,2,9,5,4,7,2,7,7,3,5,2,7,0,8,9,7,8,4,6,10,0,8,3,8,6,8,1,0,6,2</span><svg class="peity" height="16" width="64"><polygon fill="#1ab394" points="0 15 0 12.5 1.7777777777777777 2 3.5555555555555554 3.5 5.333333333333333 5 7.111111111111111 9.5 8.88888888888889 8 10.666666666666666 14 12.444444444444443 12.5 14.222222222222221 2 16 8 17.77777777777778 9.5 19.555555555555554 5 21.333333333333332 12.5 23.11111111111111 5 24.888888888888886 5 26.666666666666664 11 28.444444444444443 8 30.22222222222222 12.5 32 5 33.77777777777778 15.5 35.55555555555556 3.5 37.33333333333333 2 39.11111111111111 5 40.888888888888886 3.5 42.666666666666664 9.5 44.44444444444444 6.5 46.22222222222222 0.5 48 15.5 49.77777777777777 3.5 51.55555555555555 11 53.33333333333333 3.5 55.11111111111111 6.5 56.888888888888886 3.5 58.666666666666664 14 60.44444444444444 15.5 62.22222222222222 6.5 64 12.5 64 15"></polygon><polyline fill="transparent" points="0 12.5 1.7777777777777777 2 3.5555555555555554 3.5 5.333333333333333 5 7.111111111111111 9.5 8.88888888888889 8 10.666666666666666 14 12.444444444444443 12.5 14.222222222222221 2 16 8 17.77777777777778 9.5 19.555555555555554 5 21.333333333333332 12.5 23.11111111111111 5 24.888888888888886 5 26.666666666666664 11 28.444444444444443 8 30.22222222222222 12.5 32 5 33.77777777777778 15.5 35.55555555555556 3.5 37.33333333333333 2 39.11111111111111 5 40.888888888888886 3.5 42.666666666666664 9.5 44.44444444444444 6.5 46.22222222222222 0.5 48 15.5 49.77777777777777 3.5 51.55555555555555 11 53.33333333333333 3.5 55.11111111111111 6.5 56.888888888888886 3.5 58.666666666666664 14 60.44444444444444 15.5 62.22222222222222 6.5 64 12.5" stroke="#169c81" stroke-width="1" stroke-linecap="square"></polyline></svg></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="timeline-item">
                                        <div class="row">
                                            <div class="col-xs-3 date">
                                                <i class="fa fa-file-text"></i>
                                                7:00 am
                                                <br>
                                                <small class="text-navy">3 hour ago</small>
                                            </div>
                                            <div class="col-xs-7 content">
                                                <p class="m-b-xs"><strong>Send documents to Mike</strong></p>
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="timeline-item">
                                        <div class="row">
                                            <div class="col-xs-3 date">
                                                <i class="fa fa-coffee"></i>
                                                8:00 am
                                                <br>
                                            </div>
                                            <div class="col-xs-7 content">
                                                <p class="m-b-xs"><strong>Coffee Break</strong></p>
                                                <p>
                                                    Go to shop and find some products.
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="timeline-item">
                                        <div class="row">
                                            <div class="col-xs-3 date">
                                                <i class="fa fa-phone"></i>
                                                11:00 am
                                                <br>
                                                <small class="text-navy">21 hour ago</small>
                                            </div>
                                            <div class="col-xs-7 content">
                                                <p class="m-b-xs"><strong>Phone with Jeronimo</strong></p>
                                                <p>
                                                    Lorem Ipsum has been the industry's standard dummy text ever since.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="timeline-item">
                                        <div class="row">
                                            <div class="col-xs-3 date">
                                                <i class="fa fa-user-md"></i>
                                                09:00 pm
                                                <br>
                                                <small>21 hour ago</small>
                                            </div>
                                            <div class="col-xs-7 content">
                                                <p class="m-b-xs"><strong>Go to the doctor dr Smith</strong></p>
                                                <p>
                                                    Find some issue and go to doctor.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="timeline-item">
                                        <div class="row">
                                            <div class="col-xs-3 date">
                                                <i class="fa fa-comments"></i>
                                                12:50 pm
                                                <br>
                                                <small class="text-navy">48 hour ago</small>
                                            </div>
                                            <div class="col-xs-7 content">
                                                <p class="m-b-xs"><strong>Chat with Monica and Sandra</strong></p>
                                                <p>
                                                    Web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        </div>
                </div>
                <div class="footer">
                    <div class="pull-right">
                        10GB of <strong>250GB</strong> Free.
                    </div>
                    <div>
                        <strong>Copyright</strong> Example Company © 2014-2015
                    </div>
                </div>
            </div>