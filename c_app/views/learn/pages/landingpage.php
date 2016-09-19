            <div class="col-lg-12" style="background:#fff">            
                <div class="col-lg-9">
                 <h2 class="page-header" style="font-family:;">Welcome <?php echo $_SESSION['accessLogin']['full_name'];?> !</h2>
                 
               
                 <a href="<?php echo $dirlocation;?>learn/library" style="color:inherit">
                 <div class="col-md-3 col-sm-12 col-xs-12" style="padding:0 5px;">
               
                        <div class="panel panel-primary text-center">
                            <div class="panel-body">
                                <i class="fa fa-book fa-5x"></i>
                              <h3><?php echo $data['dashboard']['classroom'][2];?></h3> 
                            </div>
                            
                            <div class="panel-footer">
                                Library</div>
                             
                        </div>
                    </div></a>
                    <a href="<?php echo $dirlocation;?>learn/classroom" style="color:inherit">
                    <div class="col-md-3 col-sm-12 col-xs-12" style="padding:0 5px">
                        <div class="panel panel-primary text-center no-boder bg-color-green">
                            <div class="panel-body">
                                <i class="fa fa-desktop fa-5x"></i>
                                <h3><?php echo $data['dashboard']['todayvisitors'][2];?></h3>
                            </div>
                            <div class="panel-footer back-footer-green">
                                Classroom

                            </div>
                        </div>
                    </div></a>
                    
                    <a href="<?php echo $dirlocation;?>learn/courseware" style="color:inherit">
                    <div class="col-md-3 col-sm-12 col-xs-12" style="padding:0 5px">
                        <div class="panel panel-primary text-center no-boder bg-color-green">
                            <div class="panel-body">
                                <i class="fa fa-book fa-5x"></i>
                                <h3><?php echo $data['dashboard']['todayvisitors'][2];?></h3>
                            </div>
                            <div class="panel-footer back-footer-green">
                                Coureware

                            </div>
                        </div>
                    </div></a>
                    
                    <div class="col-md-3 col-sm-12 col-xs-12" style="padding:0 5px">
                        <div class="panel panel-primary text-center no-boder bg-color-blue">
                            <div class="panel-body">
                                <i class="fa fa-file-o fa-5x"></i>
                                <h3><?php echo $data['dashboard']['allNews'][2];?></h3>
                            </div>
                            <div class="panel-footer back-footer-blue">
                                Projects

                            </div>
                        </div>
                    </div>
                    
                    <a href="<?php echo $dirlocation;?>learn/community" style="color:inherit">
                    <div class="col-md-3 col-sm-12 col-xs-12" style="padding:0 5px">
                        <div class="panel panel-primary text-center no-boder bg-color-green">
                            <div class="panel-body">
                                <i class="fa fa-users fa-5x"></i>
                                <h3><?php echo $data['dashboard']['todayvisitors'][2];?></h3>
                            </div>
                            <div class="panel-footer back-footer-green">
                                My Community

                            </div>
                        </div>
                    </div></a>
                    
                  <a href="<?php echo $dirlocation;?>learn/feeds" style="color:inherit">
                    <div class="col-md-3 col-sm-12 col-xs-12" style="padding:0 5px">
                        <div class="panel panel-primary text-center no-boder bg-color-red">
                            <div class="panel-body">
                                <i class="fa fa fa-rss fa-5x"></i>
                                <h3><?php echo $data['dashboard']['todayNews'][2];?></h3>
                            </div>
                            <div class="panel-footer back-footer-red">
                               Post Feeds

                            </div>
                        </div>
                    </div>
                 </a>
                 <div class="col-md-3 col-sm-12 col-xs-12" style="padding:0 5px">
                        <div class="panel panel-primary text-center no-boder bg-color-default">
                            <div class="panel-body">
                                <i class="fa fa-user fa-5x"></i>
                                <h3><?php echo $data['dashboard']['allNews'][2];?></h3>
                            </div>
                            <div class="panel-footer back-footer-default">
                                My profile

                            </div>
                        </div>
                    </div>
                      </div> 
                      
                      
                      
           <?php include('c_app/views/learn/snipets/right_column_content.php');?>
                </div>


                
                <!-- /. ROW  -->

                
                <!-- /. ROW  -->