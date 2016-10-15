/*!
 * {this implements the SCORM Player entry point }
 * {SCORM MAIN_LAYER v1.2}
 */

(function(w, d){
   // Entry
   var  T = $cdvjs.Application.command("tools"),
		
		E = $cdvjs.Application.command("emitter"),
		
		primerUrl = w.SSR.APP_HOST + "/",
		
		$dfr = new $cdvjs.Futures(),
		
        PlayerDriver = (function(){

            var body,
				url = primerUrl + ((w.location.pathname.substr(1)).replace('/runtime.php','')) + "/engine_SCORM/players_SCORM/",
			    pathMap = {
				   "1.2":"player1_2.html",
				   "1.3":"player2004.html",
				   "2004":"player2004.html",
				   "":"u\nknown$.html"
				},		  
			    buildPlayerUrl = function(obj){
		
		             // for all - 1.2, 1.3 & 2004
			         if(obj.mode === "ADL SCORM"){
						   url += pathMap[(obj.version || "")] 
					 }
					 return url;
			    };
			 
	     return {
		     init:function(obj){
			  
				 body = d.getElementsByTagName('body')[0];
				 
				 // Settting up Mediator object event handlers
				 E.on("envReady", function(readyData){
		              w.SSR.consoleLog("Initializing PlayerCore... "); 
		              if(typeof readyData[0] === "function"){
					        body.className += " "+readyData[1];
					        readyData[0]("auto-launch");
							E.off("env_ready");
					  }else{
					      w.SSR.consoleLog("custom {envReady} event - wahala dey ohhhh!");
					  }	 
                      body = null; // release memeory...					  
		        });
				
				E.on("navRequest", function(settings){
				    if(obj.version === 1.2){
                        obj.SEQ12.resetSequenceContext();
                        obj.SEQ12.execNavigationRequest(settings[0], settings[1], settings[2]);
					}else if(obj.version === 2004 || obj.version === 1.3){
					     ; //obj.SEQ2004.startSequenceLoop();
					}   
                }); 
				  
			    $cdvjs.Application.activateAllModules({
					  "PlayerCore":{"DRIVER_MODE":obj.version,"TOC_BUFFER":obj.renderPipe, "DRIVER_STUB":buildPlayerUrl(obj)}
				});
				
			 }
		 };
    }()),
    ManifestParser = $cdvjs.getClass("ManifestParser"),
    RuntimeController = $cdvjs.getClass("RuntimeController"),
	activefile = primerUrl + w.SMConfig.courseRootDir + w.SMConfig.courseManifestFileName,
	parser = new ManifestParser(activefile);
	
	w.SSR.consoleLog("Current SCORM manifest file path: "+activefile);
    w.SSR.consoleLog("Current SCORM RUNTIME host: "+w.SSR.APP_HOST);
		
	// Resolution
    w.onload = function(e){	
	    
		w.SSR.consoleLog("environment ready for SCORM PlayerDriver Initialization...");
		var controller, msg = d.getElementById("msg_canvas");
		msg.innerHTML = '<span class="placeholder">Finalizing SSR Components Installation...</span>';
		
		/* setting up table of contents (TOC), 
		   setting up DOM events handlers, 
		   setting up SCO display by firstly loading either 'player1_2.html', 'player2004.html'
		*/   
		setTimeout(function(){
		     w.SSR.consoleLog("Currently Initializing SCORM PlayerDriver ....");
		     controller = new RuntimeController(parser); 
		     PlayerDriver.init(controller);
			 msg = null;
		}, 2500);	 
   
    };
	
}(this, this.document));
