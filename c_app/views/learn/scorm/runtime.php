<?php

?><!DOCTYPE html>
<html lang="en" id="APP_SSR" class="APP_SSR">
<head>
  <title> SSR v1.0.0 | [-] </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  
  <!-- <xbase href="http://localhost/js/scorm" /> -->
  
  <link rel="icon" type="image/x-icon" href="./images/favicon.ico" />
  <link rel="apple-touch-icon" sizes="57x57" href="images/app-icons/apple-touch-icon-114.png" />
  <link rel="apple-touch-icon" sizes="114x114" href="images/app-icons/apple-touch-icon-114.png" />
  <link rel="apple-touch-icon" sizes="72x72" href="images/app-icons/apple-touch-icon-144.png" />
  
  <script src="http://www.collegemobile.net/c_app/views/js/modernizr.js" type="text/javascript"></script>
  <script src="./js/lib/browser.js" type="text/javascript"></script>

  <script type="text/javascript">
    (function(){    
        if(window.frameElement){ // detect whether a component is loading this page - {frame,iframe}
	        document.documentElement.className += " APP_SSR_DLayout"; /* dynamic layout */ // plus, in interface.css file .APP_SSR_SLayout [aria-view-mode="desktop"] #MAIN_SSR, .APP_SSR_SLayout [aria-view-mode="tablet"] #MAIN_SSR  {  }; .APP_SSR_DLayout [aria-view-mode="mobile"] #MAIN_SSR {  }; .APP_SSR_DLayout [aria-view-mode="mobile"] #MSG_SSR {  }
			window.inMirroredEnv = true; 
	    }else if(window.window){ // detect whether a component is loading this page - {pop-up window, tab window}
		    document.documentElement.className += " APP_SSR_SLayout"; /* static layout */
			window.inCompositeEnv = true;
		}	
	}());	
  </script>
  
  <link rel="stylesheet" href="./css/turbor.css" type="text/css" media="all" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="./css/interface.css" type="text/css" media="all" />
  <link rel="stylesheet" href="./css/tree.css" type="text/css" media="all" />
  <link rel="stylesheet" href="./css/mobile-sticker.css" media="screen" />
  <style type="text/css">
    .btn-gradient:hover,
		.btn-default:hover{
         background-color:#f5f5f5;
     }
  </style>

  <script type="text/javascript">
      (function(){
            var T = $cdvjs.Application.command("tools");
            var w = window.innerWidth; /*|| document.body.clientWidth;*/
            var h = window.innerHeight; /*|| document.body.clientHeight;*/
          
            var ew = w - 237;
            var eh = h - 80;
            T.add_stylesheet("width:"+ew+"px;", "html #viewport");
            T.add_stylesheet("height:"+eh+"px;", "html #shade";
      }());
  </script>
  <script src="./js/lib/cdv_js.js" type="text/javascript"></script>
  <script src="./js/engineConfig.js" type="text/javascript"></script>
  <script src="./js/engineSetup.js" type="text/javascript"></script>
  <script src="./engine_SCORM/parser_controller_SCORM/parseManifest.js" type="text/javascript"></script>
  <script src="./engine_SCORM/parser_controller_SCORM/runtimeController.js" type="text/javascript"></script>
  <script src="./js/enginePlayer.js" type="text/javascript"></script>
  <script src="./js/engineMain.js" type="text/javascript"></script>
  <!--

   Options ^
   - <Hide Menu>/<Show Menu>
   - <About Course> 
   - <About Tutor> 
   - <About Software>
   
  -->
</head>
<!--[if IE]> 
 <body onunload="" class="ie-set not-scrollable "  aria-setup-mode="unknown" aria-os-data="unknown" aria-view-mode="unknown" aria-interact-mode="mouse">
<![endif]-->
<!--[if !IE]>-->
<body onunload="" class="non-ie not-scrollable"  aria-setup-mode="unknown" aria-os-data="unknown" aria-view-mode="unknown" aria-interact-mode="mouse">
<!--<![endif]-->
 <div class="container-span span-vertical clear-fix" id="MAIN_SSR">
       <div id="toolbar" class="toolbar row-span clear-fix">
	            <div class="colm-4 alpha navview">
				    <div class="relative text-left button-place-holder">
				        <a href="javascript:void(0);" id="toggle" class="btn pill btn-gradient">Hide Menu</a>
						
						<a href="javascript:void(0);" class="btn pill btn-pulse btn-emphasis adl-flow-nav-request-button" style="font-size:12px;margin-left:39px;"><b>&laquo;</b>Previous</a>
						<a href="javascript:void(0);" class="btn pill btn-pulse btn-emphasis adl-flow-nav-request-button" style="font-size:12px;">Continue<b>&raquo;</b></a>
					</div>  
				</div>
                <div class="colm-8 omega navview">
				
					<div id="scorm_1_2" class="navigation pill clear-fix unselectable pill scorm_1_2 navbox" id="navigation" role="navigation"> 
                        <ul id="menu" class="nav-menu pull-left">
                            <li><a href="javascript:void(0);" id="start" class="menu-item btn first left-half-pill btn-default capital btn-emphasis"><span class="text-face">Begin Course</span><span class="fa-stack fa-2x"><i class="fa fa-play-circle-o" aria-hidden="true"></i><i class="fa fa-ban fa-stack-2x text-danger"></i></span></a></li>
                            <li><a href="javascript:void(0);" id="prev" class="menu-item btn btn-default btn-disabled" disabled="disabled"><span class="text-face">Previous</span><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i></a></li>
                            <li><a href="javascript:void(0);" id="next" class="menu-item btn  btn-default btn-disabled" disabled="disabled"><span class="text-face">Next</span><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></li>
                            <li><a href="javascript:void(0);" id="close" class="menu-item btn btn-default btn-disabled" disabled="disabled"><span class="text-face">Exit Activity</span><i class="fa fa-times-circle-o" aria-hidden="true"></i></a></li>
							<li><a href="javascript:void(0);" id="exit"  class="menu-item btn last right-half-pill btn-default ">Exit Course</a></li>
                        </ul>
				    </div>
					
					<div id="scorm_2004" class="navigation clear-fix unselectable pill scorm_2004 navbox" id="navigation" role="navigation">
					    <ul id="menu" class="nav-menu pull-left">
					      <li><a href="javascript:void(0);" id="suspendall" class="menu-item btn first left-half-pill btn-default capital btn-emphasis"><span>SuspendAll</span></a></li>
					      <li><a href="javascript:void(0);" id="abandon" class="menu-item btn btn-default"><span>Abandon</span></a></li>
					      <li><a href="javascript:void(0);" id="abandonall" class="menu-item btn btn-default"><span>AbandonAll</span></a></li>
					      <li><a href="javascript:void(0);" id="exit" class="menu-item btn btn-default"><span>Exit</span></a></li>
					      <li><a href="javascript:void(0);" id="exitall" class="menu-item btn last right-half-pill btn-default"><span>ExitAll</span></a></li>
						</ul>
					</div>
					
                </div>
		</div>		
		
       <div id="shade" class="row-span shade relative clear-fix">
	      <div id="tab-deck" style="background-color:red;height:30px;line-height:27px;width:241px;z-index:300;" class="absolute snap-top-left"><span>TABLE OF CONTENTS</span></div>
	      <div id="toc-menu" class="colm-3 alpha mainview package-visible" style="margin-right:0;margin-left:5px;width:235px;">
		       <div id="course-toc" class="package-toc unselectable">
			       
			     </div> 
		  </div>
		  <div id="viewport" class="colm-9 omega mainview viewport" style="margin-left:1px">
		       <div id="sco-launch" class="embed-responsive embed-responsive-16by9">
                   <iframe src="./collegemobile.html" aria-relaunch-path="./engine_SCORM/players_SCORM/load.blank.html" allowtransparency="true" scrolling="auto" hspace="0" vspace="0" marginwidth="0" marginheight="0" frameborder="0" name="runtime" id="runtime" class="runtime">
                        <p> Sorry, ths browser does not support the (SSR) viewport. You may need to use another browser </p>
                   </iframe> 
              </div>			 
		  </div>	
	   </div>
	   <div class="footer">
	      <div class="footer-wrapper relative clear-fix">
			     <div class="pull-left">
				     <a href="javascript:void(0);" class="link line-block-box"><strong>Progress </strong><b class="progress-bar relative"><span class="progress-strip"><i class="progress-value absolute snap-right">0%</i></span></b></a>
					 <span id="activity-meter" class="line-block-box"> ----- </span>
				 </div>
				 <div class="pull-right">
				    <b class="">|</b><a href="javascript:void(0);" class="link line-block-box">Timing:<span id="timing-value" class="placeholder"> Unlimited</span></a>
				 </div>
		  </div>
	   </div>
   </div>	
   <div id="MSG_SSR" class="MSG_SSR">
         <!-- Initialization Messaging Section -->
		 <div id="msg_canvas" class="">
		     <span class="placeholder">Loading SSR Environment Components...</span>
		 </div>
   </div>    
</body>
</html>
