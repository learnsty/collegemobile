<!--
<script type="text/javascript" src="http://www.html.am/html-editors/ckeditor/ckeditor_4.4.1_standard/ckeditor.js"></script> 
-->
<div class="row" style="padding:0;" ng-controller="DashboardCtrl">
<div class="panel panel-default">
<!-- /.panel-heading -->
<div class="panel-body">
<a href="<?php echo $dirlocation.'content/index';?>" class="btn btn-primary" style="margin-bottom:10px">Back</a>

<div class="panel panel-default" style="">
<div class="panel-heading">
<h3 class="panel-title">Create a courseware</h3>
</div>
<div class="panel-body">

<div class="panel-body">
<div class="row">

<form method="post" action="<?php $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">

<?php if(isset($data['returnmessage']['msg'])){?>

<div class="alert alert-success" role="alert">
<strong>Alert!</strong> <?php echo $data['returnmessage']['msg'];?>
</div>
<?php }?>

<div class="col-lg-6">
<label>Category</label>  
<select name="courseware_category_select" class="form-control" ng-model="classType">
<option value="0">--Select Type--</option>     
<option value="1" <?php if($data['library']['library'][0]['catalogue_id']!='0'){echo "selected='selected'";}?>>Library Catalogue</option>
<option value="2" <?php if($data['library']['library'][0]['skillset_id']!='0'){echo "selected='selected'";}?>>Skillset</option>

</select>              
<?php //if($data['library']['library'][0]['catalogue_id']!='0'){?>
<div class="" ng-show="classType=='1'">
<label>Catalogue</label>  
<select name="courseware_catalogue" class="form-control" >
<option value="0">--Select Catalogue--</option>     
<?php foreach ($catalogue as $grab){?>
<option value="<?php echo $grab['catalogue_id'];?>" <?php if($data['library']['library'][0]['catalogue_id']==$grab['catalogue_id']){echo "selected='selected'";}?>><?php echo $grab['catalogue_title'];?></option>
<?php }?>
</select>              
</div>
<?php //}?>
<?php //if($data['library']['library'][0]['skillset_id']!='0'){?>
<div class="" ng-show="classType=='2'">
<label>Skillset</label>  
<select name="courseware_skillset" class="form-control">
<option value="0">--Select Skillset--</option>     
<?php foreach ($skillset as $grab){?>
<option value="<?php echo $grab['skillset_id'];?>" <?php if($data['library']['library'][0]['skillset_id']==$grab['skillset_id']){echo "selected='selected'";}?>><?php echo $grab['skillset_title'];?></option>
<?php }?>
</select>              
</div>
<?php //}?>

<label>Courseware Title</label>                
<input type="text" class="form-control" name="courseware_title" required="required" value="<?php if(isset($_GET['edit'])){ echo $data['library']['library'][0]['course_title'];}else{echo $_POST['courseware_title'];}?>" />

<label>Courseware Duration</label>                
<input type="text" class="form-control" name="courseware_duration" required="required" value="<?php if(isset($_GET['edit'])){ echo $data['library']['library'][0]['courseware_duration'];}else{echo $_POST['courseware_duration'];}?>" />


</div>


<div class="col-lg-6">

<?php if(isset($_GET['edit'])){
$explode=end(explode('.',strtolower($data['library']['library'][0]['path'])));	
?>
<div class="panel panel-default">
<div class="panel-body">
<div class="col-lg-4">
<img class="thumbnail" src="<?php echo $dirlocation;?>c_app/views/<?php echo $data['library']['library'][0]['banner'];?>" style="width:100%" />
</div>
<div class="col-lg-6">
<button class="btn btn-danger btn-sm" type="button" ng-click="showme=true">Change Banner</button>
<input type="file" class="form-control" name="courseware_file" ng-show="showme" style="margin-top:7px" />
</div>
</div>

<div class="panel-body">
<div class="col-lg-4">
<img class="thumbnail" src="<?php echo $dirlocation;?>c_app/views/images/icon_<?php echo $explode.'.png';?>" style="width:100%" />
</div>
<div class="col-lg-6">
<button class="btn btn-danger btn-sm" type="button" ng-click="showme=true">Change Doc</button>
<button class="btn btn-info btn-sm" type="button">View Doc</button>
<input type="file" class="form-control" name="courseware_file" ng-show="showme" style="margin-top:7px" />
</div>
</div>


</div>
<?php }else{?>
<label>Attach Banner Image</label>
<input type="file" class="form-control" name="bannerimage_file"/>              

<label>Attach Courseware</label>
<input type="file" class="form-control" name="courseware_file" required="required" />              
<?php }?>

</div>

<div class="col-lg-12">


<label>Courseware Description</label>     
<textarea id="editor1" class=" ckeditor form-control" name="courseware_description" placeholder="Description about this course" rows="5" required="required"><?php if(isset($_GET['edit'])){ echo $data['library']['library'][0]['course_description'];}else{echo $_POST['courseware_description'];}?>

</textarea>   


<label>Courseware Outline</label>     
<textarea id="editor1" class="ckeditor form-control" name="courseware_outline" placeholder="Course outline" rows="5" required="required"><?php if(isset($_GET['edit'])){ echo $data['library']['library'][0]['courseware_outline'];}else{echo $_POST['courseware_outline'];}?>

</textarea>   

<input type="submit" value="Save Courseware" class="btn btn-lg btn-primary pull-right" style="margin-top:10px" />




</div>
</form>
</div>
</div>


</div>
</div>
</div>
</div>
</div>


