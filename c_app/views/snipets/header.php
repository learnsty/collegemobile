<?php session_start();?>
<nav class="navbar navbar-default" style="background:#0875ba; border:none;color:#fff;border-radius:0;margin-bottom:0;padding-bottom:0;">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo $dirlocation;?>" style="color:#fff;padding:10px">Collegemobile</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
      
        
        
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo $dirlocation;?>login" style="color:#fff">Login</a></li>
           <li><a href="<?php echo $dirlocation;?>register" style="color:#fff">Signup</a></li>
           <li><a href="<?php echo $dirlocation;?>contentpartnerregister" style="color:#fff">Be A Content Provider</a></li>
          
          
           <?php if(isset($_SESSION['accessLogin'])){
			if(($_SESSION['accessLogin']['account_type']=='student')||($_SESSION['accessLogin']['account_type']=='lecturer')){$link='learn';}else{$link='content';}	?>
          
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color:#fff"><?php echo $_SESSION['accessLogin']['full_name'];?> <span class="caret"></span></a>
          <ul class="dropdown-menu" style="background:#0784d3; border:none;color:#fff;border-radius:0;">
           
           <li><a href="<?php echo $dirlocation;?><?php echo $link;?>/profile" style="color:#fff;list-style:none;"><i class="fa fa-user"></i> My Profile</a></li>
           <li><a href="<?php echo $dirlocation;?><?php echo $link;?>/courseware" style="color:#fff;list-style:none;"><i class="fa fa-file-o"></i> My Coursewares</a></li>
               <?php if($link=='learn'){?>
           <li><a href="<?php echo $dirlocation;?><?php echo $link;?>/classroom" style="color:#fff;list-style:none;"><i class="fa fa-desktop"></i> My Classroom</a></li>
           <li class=""><a href="<?php echo $dirlocation;?><?php echo $link;?>/community" style="color:#fff;list-style:none;"><i class="fa fa-group"></i> My Community</a></li>
              <?php }?>
           
          </ul>
        </li>
          <?php }?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>