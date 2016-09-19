<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>College Mobile: Learn, Teach and Collaborate</title>
    <script src="http://s.codepen.io/assets/libs/modernizr.js" type="text/javascript"></script>


    
    <link rel="stylesheet" href="css/reset.css">

    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css'>

        <link rel="stylesheet" href="<?php echo $dirlocation;?>c_app/views/css/loginstyle.css">

    
    
    
  </head>

  <body>

    <form class="login">
  
  <fieldset>
    
  	<legend class="legend">Login</legend>
    
    <div class="input">
    	<input type="email" placeholder="Email" required />
      <span><i class="fa fa-envelope-o"></i></span>
    </div>
    
    <div class="input">
    	<input type="password" placeholder="Password" required />
      <span><i class="fa fa-lock"></i></span>
    </div>
    
    <button type="submit" class="submit"><i class="fa fa-long-arrow-right"></i></button>
    
  </fieldset>
  
  <div class="feedback">
  	login successful <br />
    redirecting...
  </div>
  
</form>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="<?php echo $dirlocation;?>c_app/views/js/loginindex.js"></script>

    
    
    
  </body>
</html>
