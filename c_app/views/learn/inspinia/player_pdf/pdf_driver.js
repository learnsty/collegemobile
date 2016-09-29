/**  
 * Copyright (c) 2016 CollegeMobile.
 */

 /* <a href="javascript:void(0);" class="btn btn-default" onclick="javascript:pdfLauncher('<?php echo $dirlocation . 'c_app/view/learn/pdfviewer/'; ?>viewer.php?open=<?php $dirlocation . 'c_app/view/courseware/8892342.pdf'; ?>&studentId=xxxxxxx');"></a> */
 
 ;(function(w_n, d){

     var $win,
	    E = w_n.$cdvjs.Application.command("emitter"),
		Cs = w_n.$cdvjs.Application.command("cachestore"),
		lmsHost = w_n.location.protocol + "//" + w_n.location.host + (w_n.location.port ? ":"+w_n.location.port : "");

    w_n.$cdvjs.Application.registerModule("pdfunit", ["jQuery"], function(box, $accessControl){ 	
          
          var config = null,
              $ = box.jQuery,
              w = w_n.innerWidth || d.body.clientWidth,
              h = w_n.innerHeight || d.body.clientHeight,

		      pdfPopUp = function(uri, config){
		          // setup config params
			      config = (!!config && String(config.constructor).indexOf('[Object')>-1)? T.json_stringify(config) : '{"cross_domain":false}';
                  // open a pop-up window...

                  if(w <= 480){ // trying to detect mobile
                    config = "_blank";
                  } 

                  $win = T.open_window(uri, config, [(w - Math.floor(w/4)),(h - Math.floor(h/4))]);
                  if(typeof w_n.windowsOpened !== "number"){
                     w_n.windowsOpened = 1
                  }else{
                  	 ++w_n.windowsOpened;
                  }
		      }

		      w_n.pdfLauncher = function(url){

		           pdfPopUp(url);

             };
		   
		   return {
		   
		        init:function(){
				     //.........
				},
				defineVars:function(){
				
				},
				stop:function(){
				     //........
				},
				destroy:function(){
				
				}
		   
		   };
    });

    
    w_n.$cdvjs.Application.activateModule('pdfunit');
   
 }(this, this.document)); 	