<link href="http://vjs.zencdn.net/5.10.8/video-js.css" rel="stylesheet">
<style>
.pdfobject-container { height: 500px;}
.pdfobject { border: 1px solid #666; }
</style>

  <!-- If you'd like to support IE8 -->
  <script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>

            <div class="wrapper wrapper-content">
            <div class="content animated fadeInRight" style="padding:0;">
<div class="col-lg-12 wrapper border-bottom white-bg page-heading">
                <div class="col-lg-12">
                    <h2> Library <a href="<?php echo $dirlocation;?>learn/courseware/newcourseware"><button class="btn btn-white btn-sm">
                  <i class="fa fa-plus"></i>  Create Coursware
                  </button></a></h2>
                    <ol class="breadcrumb" style="margin-bottom:10px">
                        <li>
                            <a href="<?php echo $dirlocation;?>learn/library"><?php if($data['content'][2]==''){echo '<strong>';}?>Academic</strong></a>
                        </li>
                        <li>
                            <a href="<?php echo $dirlocation;?>learn/library/skillset"><?php if($data['content'][2]=='skillset'){echo '<strong>';}?>Skill</strong></a>
                        </li>
                        <li class="active">
                            <a href="<?php echo $dirlocation;?>learn/library/search"><?php if($data['content'][2]=='search'){echo '<strong>';}?>Search</strong></a>
                        </li>
                        
                    </ol>
                </div>
                
   <form style="" method="get" action="<?php echo $dirlocation;?>learn/library/search">
    <div class="col-lg-6" style="padding:0;padding-right:10px;">
    <div class="input-group">
          <div class="input-group-addon">
          <span class="">Keyword</span>
          </div>
    <input type="text" class="form-control" placeholder="Search for a book (eg. Quantum Mechanics)" ng-model="searchLibrary" required="required" name="SearchKeyword">
    </div>
    </div>
    
    <?php if($data['content'][2]!='skillset'){?>
    <div class="col-lg-4" style="padding:0;">
    <div class="input-group">
          <div class="input-group-addon">
          <span class="">Category</span>
          </div>
    <select name="searchCategory" class="form-control">
    <option value="0">--Select Catalogue--</option>     
    <?php while ($grab=mysql_fetch_array($data['catalogue'][1])){
	$catalogue[]=$grab;		
	?>
    
    <option value="<?php echo $grab['catalogue_id'];?>" <?php if($data['library']['library'][0]['catalogue_id']==$grab['catalogue_id']){echo "selected='selected'";}?>><?php echo $grab['catalogue_title'];?></option>
    <?php }?>
    </select>              
	<input type="hidden" name="table" value="courseware" />
           </div>
	</div>
    <?php }elseif($data['content'][2]=='skillset'){?>
    <div class="col-lg-4" style="padding:0;">
    <div class="input-group">
          <div class="input-group-addon">
          <span class="">Skillset</span>
          </div>
    <select name="searchSkillset" class="form-control" style="margin-bottom:3px">
    <option value="0">--Select Skillset--</option>     
    <?php while ($grab=mysql_fetch_array($data['skillset'][1])){
	$skillset[]=$grab;		
	?>
    
    <option value="<?php echo $grab['skillset_id'];?>" <?php if($data['library']['library'][0]['skillset_id']==$grab['skillset_id']){echo "selected='selected'";}?>><?php echo $grab['skillset_title'];?></option>
    <?php }?>
    </select>              
	<input type="hidden" name="table" value="courseware" style="margin-bottom:3px"/>
           </div>
	</div>
    <?php }?>
    
    <div class="col-lg-2">
    <button type="submit" class="btn btn-info pull-right" style="border:none">
    <span class="fa fa-search"></span> Search
  </button>
   	</div>
     <div style="clear:both"></div> 
   	</form>
            </div>

               <div class="col-lg-12" style="padding-top:10px">
                
                <?php  
				if($data['content'][2]==''){
				$data['content'][2]='index';	
				}
				include($data['content'][1].'_'.$data['content'][2].'.php');
				
				?>
				
                </div>
                </div>
                </div>
                
  
    <script src="http://vjs.zencdn.net/5.10.8/video.js"></script>              