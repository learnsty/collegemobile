<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <h2>
                                <?php echo $data['search'][2];?> Results found for: <span class="text-navy">“<?php echo $_GET['SearchKeyword'];?>”</span>
                            </h2>
                           
                            <div class="search-form">
                                <form action="<?php echo $dirlocation;?>learn/courseware/search" method="get">
                                    <div class="input-group">
                                        <input type="text" placeholder="Type your search here (eg. Mechanical Engineering, Building materials)" name="SearchKeyword" class="form-control input-lg">
                                        <input type="hidden" name="table" value="courseware" />
                                        <div class="input-group-btn">
                                            <button class="btn btn-lg btn-primary" type="submit">
                                                Search
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <?php while ($grab=mysql_fetch_array($data['search'][0])){?>
                            <div class="hr-line-dashed"></div>
                            <div class="search-result" style="padding-top:0;">
                             <img src="<?php echo $dirlocation;?>c_app/views/<?php echo $grab['banner'];?>" class="img-responsive" width="60px" style="float:left;margin-right:10px" />
                                <h3><a href="#"><?php echo $grab['course_title'];?></a></h3>
                                <a href="#" class="search-link">www.collegemobile.net/learn/courseware/<?php echo $grab['course_title'].'_'.$grab['courseware_id'];?></a>
                                
                                <p>
                                    <?php echo $grab['course_description'];?>
                                </p>
                            </div>
                            <?php }?>
                            <div class="hr-line-dashed"></div>
                            <div class="text-center">
                               <?php echo $data['search'][1];?>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </div>