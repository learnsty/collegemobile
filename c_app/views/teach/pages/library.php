            <div class="row">
            
                <div class="col-lg-12">
                  <h1 class="page-header">Library</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row" >
            
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo $dirlocation;?>teach/library">Home</a>
                            </li>
                             <li class="active">
                                <i class="fa fa-edit"></i> <a href="<?php echo $dirlocation;?>teach/library/newcourseware">Create New Courseware</a>
                            </li>
                        </ol>
                        
                        

                <?php  
				if($data['content'][2]==''){
				$data['content'][2]='index';	
				}
				include($data['content'][1].'_'.$data['content'][2].'.php');
				
				?>
				
                </div>