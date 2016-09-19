<div class="col-lg-3" style="">
       <div class="panel panel-default" style="margin-top:;">
    <div class="panel-body" style="text-align:center">
    
    <img src="<?php if($_SESSION['accessLogin']['avater']==''){echo $dirlocation.'c_app/views/images/anonymous.png';}else{echo $dirlocation.'c_app/views/images/'.$_SESSION['accessLogin']['avater'];}?>" class="thumbnail" id="target" style="border-radius:50%;margin:auto;width:50%;height:90px" />
    
    <h4 style="color:#069"><?php echo $_SESSION['accessLogin']['full_name'];?></h4>
    <img src="<?php echo $dirlocation;?>c_app/views/images/default.gif" width="20%" class="loader2" style="display:none" />
    
     <form id="uploadpassport" enctype="multipart/form-data" name="uploadavater">
     <button class="btn btn-info btn-sm" onclick="$('#fileinput').trigger('click');">Change Pix</button>  
     <input name="profile_photo" type="file" id="fileinput" onchange="$('.uploadbtn').show()" style="display:none"/><br/>
     <input type="submit" ng-click="uploadpass()" value="Upload" class="uploadbtn btn btn-primary btn-sm" style="display:none;margin-top:7px"/>
     <input type="hidden" name="email" value="<?php echo $_SESSION['accessLogin']['email'];?>" />
     <input type="hidden" name="phone" value="<?php echo $_SESSION['accessLogin']['phone_number'];?>" />
     <input type="hidden" name="table" value="<?php echo $_SESSION['accessLogin']['account_type'];?>" />
     </form>
    </div>
    </div>   
       
      <div class="panel panel-default" style="margin-top:4px;border-left:5px solid #0C3">
    <div class="panel-body" style="padding-top:4px;padding-bottom:4px">
   <h5 style="color:#0C3;">CollegeMobile Premium</h5>
    Thousands of students are waiting for you. Upgrade Your account to today!<br/>
     <button class="btn btn-primary btn-sm" ng-click="uploadpass()">Read More</button>    
    </div>
    </div> 
       
    <div class="panel panel-default" style="margin-top:4px;border-left:5px solid #F60">
    <div class="panel-body" style="padding-top:4px;padding-bottom:4px">
   <h5 style="color:#F60;">Quotes</h5>
    <em>Education is the key for nation building. Invest in IT</em>
        
    </div>
    </div> 
    
    
       </div>
       
       
 


     