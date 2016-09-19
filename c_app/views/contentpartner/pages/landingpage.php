
            <div class="row">

                

                <div class="col-lg-12">
                <?php while($grab=mysql_fetch_array($data['library']['mylibrary'][0])){?>
					<div class="col-lg-4">
                    <div class="social-feed-box">

                        <div class="pull-right social-action dropdown">
                            <button data-toggle="dropdown" class="dropdown-toggle btn-white">
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu m-t-xs">
                                <li><a href="http://webapplayers.com/inspinia_admin-v2.5/profile_2.html#">Config</a></li>
                            </ul>
                        </div>
                        <div class="social-avatar">
                            <a href="http://webapplayers.com/inspinia_admin-v2.5/profile_2.html" class="pull-left">
                                <img alt="image" src="<?php echo $dirlocation ;?>c_app/views/<?php echo $grab['banner'];?>">
                            </a>
                            
                            <div class="media-body">
                            
                                <a href="#">
                                   <?php echo $grab['course_title'];?>
                                </a>
                                <small class="text-muted"> <?php echo $grab['date'];?></small>
                            </div>
                        </div>
                        <div class="social-body">
                        <div style="max-height:180px;overflow:hidden">
                         <img alt="image" src="<?php if($grab['banner']!=''){echo $dirlocation."c_app/views/".$grab['banner'];}else{ echo $dirlocation."c_app/views/images/noimage.jpg";}?>" style="width:100%">
                         </div>
                            <p>
                                <?php echo substr($grab['course_description'],0,100).'...';?>
                            </p>

                            <div class="btn-group">
                               <a href="<?php echo $dirlocation;?>learn/courseware/view?view=<?php echo $grab['courseware_id'];?>" class="btn btn-white btn-xs">
                        <i class="fa fa-folder-open"></i>
                        View</a>
                                <a href="<?php echo $dirlocation;?>content/courseware/newcourseware?edit=<?php echo $grab['courseware_id'];?>">
                                <button class="btn btn-white btn-xs"><i class="fa fa-pencil-square-o"></i> Edit</button>
                          </a>      
                                <a href="<?php echo $dirlocation;?>content/index?delete=<?php echo $grab['courseware_id'];?>&&table=courseware">
                                <button class="btn btn-white btn-xs"><i class="fa fa-asterisk"></i> Delete</button></a>
                            </div>
                            
                            
                        </div>
                        <div class="social-footer" style="display:none">
                            <div class="social-comment">
                                <a href="http://webapplayers.com/inspinia_admin-v2.5/profile_2.html" class="pull-left">
                                    <img alt="image" src="./INSPINIA_profile_contentcreator_files/a1.jpg">
                                </a>
                                <div class="media-body">
                                    <a href="http://webapplayers.com/inspinia_admin-v2.5/profile_2.html#">
                                        Andrew Williams
                                    </a>
                                    Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words.
                                    <br>
                                    <a href="http://webapplayers.com/inspinia_admin-v2.5/profile_2.html#" class="small"><i class="fa fa-thumbs-up"></i> 26 Like this!</a> -
                                    <small class="text-muted">12.06.2014</small>
                                </div>
                            </div>

                            <div class="social-comment">
                                <a href="http://webapplayers.com/inspinia_admin-v2.5/profile_2.html" class="pull-left">
                                    <img alt="image" src="./INSPINIA_profile_contentcreator_files/a2.jpg">
                                </a>
                                <div class="media-body">
                                    <a href="http://webapplayers.com/inspinia_admin-v2.5/profile_2.html#">
                                        Andrew Williams
                                    </a>
                                    Making this the first true generator on the Internet. It uses a dictionary of.
                                    <br>
                                    <a href="http://webapplayers.com/inspinia_admin-v2.5/profile_2.html#" class="small"><i class="fa fa-thumbs-up"></i> 11 Like this!</a> -
                                    <small class="text-muted">10.07.2014</small>
                                </div>
                            </div>

                            <div class="social-comment">
                                <a href="http://webapplayers.com/inspinia_admin-v2.5/profile_2.html" class="pull-left">
                                    <img alt="image" src="./INSPINIA_profile_contentcreator_files/a3.jpg">
                                </a>
                                <div class="media-body">
                                    <textarea class="form-control" placeholder="Write comment..."></textarea>
                                </div>
                            </div>

                        </div>

                    </div>
				</div>
                
                <?php }?>
					



                </div>
                

            </div>

        </div>