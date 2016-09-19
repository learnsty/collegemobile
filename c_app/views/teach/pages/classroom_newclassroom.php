
<div class="col-lg-12" style="padding:0;" ng-app="jaraja"  ng-controller="Teach">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
<a href="<?php echo $dirlocation.'teach/classroom';?>" class="btn btn-success" style="margin-bottom:10px">Back</a>

<div class="panel panel-default" style="">
            <div class="panel-heading">
              <h3 class="panel-title">Create a classroom</h3>
            </div>
            <div class="panel-body">

<div class="panel-body">
                            <div class="row">
<form role="form" method="post" action="<?php $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
        
<?php if(isset($data['returnmessage']['msg'])){?>

<div class="alert alert-success" role="alert">
<strong>Alert!</strong> <?php echo $data['returnmessage']['msg'];?>
</div>
<?php }?>

                                <div class="col-lg-6">
                       
                       <label><strong> Classroom Type</strong></label>                
                           <input type="radio" name="classroom_type" value="1" ng-model="classType" <?php if($data['classroom']['classroom'][0]['classroom_type']=='1'){echo "ng-init='classType=1'";}?>/> academic
                           <input type="radio" name="classroom_type" ng-model="classType" value="2"  <?php if($data['classroom']['classroom'][0]['classroom_type']=='2'){echo "ng-init='classType=2'";}?>/> skill
                           <div style="clear:both"></div><br/>
                     <label>Classroom Title</label>                
                       <input type="text" class="form-control" name="classroom_title" required="required" value="<?php if(isset($_GET['edit'])){echo $data['classroom']['classroom'][0]['classroom_title'];}else{ echo $_POST['classroom_title'];}?>" />
                       <label>Classroom Description</label>     
           <textarea class="form-control" name="classroom_description"><?php if(isset($_GET['edit'])){echo $data['classroom']['classroom'][0]['classroom_description'];}else{ echo $_POST['classroom_description'];}?>
           </textarea>              

                                </div>
                                
                                
                                <div class="col-lg-6">
                         
          <label ng-show="classType=='1'">Level</label>
     <select class="form-control" name="classroom_level" ng-show="classType=='1'">
                <option value="0">--Select Level--</option>     
                <option value="100" <?php if($data['classroom']['classroom'][0]['classroom_level']=='100'){echo "selected='selected'";}?>>100</option> 
                <option value="200" <?php if($data['classroom']['classroom'][0]['classroom_level']=='200'){echo "selected='selected'";}?>>200</option> 
                <option value="300" <?php if($data['classroom']['classroom'][0]['classroom_level']=='300'){echo "selected='selected'";}?>>300</option>
                <option value="400" <?php if($data['classroom']['classroom'][0]['classroom_level']=='400'){echo "selected='selected'";}?>>400</option>    
                <option value="500" <?php if($data['classroom']['classroom'][0]['classroom_level']=='500'){echo "selected='selected'";}?>>500</option>    
                <option value="600" <?php if($data['classroom']['classroom'][0]['classroom_level']=='600'){echo "selected='selected'";}?>>600</option>    
				</select>
        
         <label ng-show="classType=='2'">Skill set</label>
     <select class="form-control" name="classroom_skillset" ng-show="classType=='2'">
                <option value="0">--Select Skillset--</option>     
<?php while ($grab=mysql_fetch_array($data['skillset'][1])){?>
<option value="<?php echo $grab['skillset_id'];?>"  <?php if($data['classroom']['classroom'][0]['classroom_skillset']==$grab['skillset_id']){echo "selected='selected'";}?>><?php echo $grab['skillset_title'];?></option>
<?php }?>
				</select>                 
    <input type="submit" value="Save Classroom" class="btn btn-lg btn-success btn-sm pull-right" style="margin-top:10px" />


                             </div>

</form>
</div>
</div>


</div>
</div>
</div>
</div>
</div>


