(function(w, d, undefined){

  var T = $cdvjs.Application.command("tools:query_to_json"),
      commitLastResult = false,
      commitLoopDelay = 2500,
      lastSCOChangeKey = 0,
	  waitPromise = new $cdvjs.Futures(),
	  scoChangeRecord = [], //hasSCOChangeHappen();
	  ssrHost = w.location.protocol + "//" + w.location.host + (w.location.port? ":"+w.location.port : ""),
	  SCORM_Config = $cdvjs.getClass("SCORMConfig");
	  
	  
	  
    w.SSR = {SCOTitle:""}; // Global SSR object!
	w.SSR.APP_HOST = ssrHost; // Export to the Global (the host address)
	w.SSR.AdapterStatus = false; // determine the status of the adapter object when loading, playing and unloading learning content
	w.SSR.HAS_COM_RIGHTS = false; // distinguish between a content package resource that has the right to communicate with the API adapter ("sco") and the content package resource that doesn't have this right ("asset")
	w.SSR.CMI_REQUEST_END = false; // this is used to indicate to the 'SCO Viewport' that the request for learner CMI data has completed/ended (just before a potential LMSInitialize(""); call) ...
	w.SSR.CMI_REQUEST_START = false; // this is used to tell the 'player[1_2/2004].html' file that the request for learner data has begun...
    w.SSR.CMI_GET_RETURN = false; // this is used to signal that the request for learner CMI data has completed (just before call to LMSInitialize("");
    w.SSR.CMI_POST_RETURN = false; // this is used to signal that the posting of data (via LMCommit(""); call) has completed...
    w.flagLMSSessionFinished = false; // In prior unit testing, it was found that IE6, IE7, IE8 called LMSFinish(""); (action from either the SCO or PlayerDriver) automatically 
	                                  // while Chrome, Opera and Firefox did not call LMSFinish(""); at all whenever the pop-up window close button was clicked, hence, this is 
									  // used to signal to SSR not to call LMSFinish(""); more than once in any case
	
	w.SSR.resetGlobals = function(key){
	     this[key] = false;
	};
	
	w.SSR.resetAllGlobals = function(){
	    this.HAS_COM_RIGHTS = false;
	    this.CMI_REQUEST_END = false;
		this.CMI_REQUEST_START = false;
		this.CMI_GET_RETURN = false;
		this.CMI_POST_RETURN = false;
	};
	
	w.SSR.postChannel = function(data){
		  (w.opener.$cdvjs.Application.command("channel")).post_message(data, ssrHost);
    };
	
	w.SSR.hasSCOChangeHappened = function(){
	    var bool = (scoChangeRecord.length !== lastSCOChangeKey);
		if(bool)
		   lastSCOChangeKey = scoChangeRecord.length;
		return bool;
	};
	
	w.SSR.setSCOChange = function(val){
	     scoChangeRecord.push(val);
	}
	
	w.SSR.beginCommitLoop = function(){
	     var hasAPI = !!w.API, 
	         asyncCallback = (function(){ 
		          
				  var intervalCount = 0; 
				  
				  return function sag(){ 
				          ++intervalCount;

						  if(intervalCount >= 10){ 
						       commitLoopDelay = 5900; 
						  }
						  
						  if(intervalCount >= 40){
						      if(!commitLastResult) 
							     commitLoopDelay = 7300;
							  else
                                 commitLoopDelay = 4300;							  
						  }
						  
						  if(intervalCount >= 80){
						     if(!commitLastResult)
						          commitLoopDelay = 9600;
							 else
							     commitLoopDelay = 6400;
						  }
						  
						  if(intervalCount === 100){
						       intervalCount = 0; // reset count!
						  }
						  
						  if(hasAPI){ 
						      w.SSR.consoleLog("Sending a stream of SCO commit data on count:"+intervalCount);
						      w.API.LMSCommit.$locked = true;
						      commitLastResult = Boolean(w.API.LMSCommit("")); 
						      w.API.LMSCommit.$locked = false;
						  }
						  
						  return setTimeout(sag, commitLoopDelay); 
				}; 
		}());
		
		setTimeout(asyncCallback, commitLoopDelay);
	};
	
	w.SSR.loadWait = {
	    whenReady:function(routine){
		    /* @TODO: my implementation of '{Futures}.isResolved' has a bug of returning the inverse boolean value for promise state 
			   - need to fix '{Futures}isResolved()' & '{Futures}isRejected()' code */
		    /* @DONE: The above problem (in the comment) has been fixed!! - 17/11/2015 */
			if(waitPromise.isResolved()){ 
			      routine.call(null);
			}else{
			      waitPromise.then(routine, function(e){
				       alert("Error: SSR could not load player driver files!");
					   throw e;
				  });
			}
		},
		proceed:function(data){
		      return waitPromise.resolve(data);
		},
		dontProceed:function(err){
		      return waitPromise.reject(err);
		}
	};
	
	w.SSR.ajaxLog = function(file, callback){
	    // will utilize ajax request to log info/error to the server
	};
		
    w.SSR.offloadChannel = function(callback){
		 ($cdvjs.Application.command("channel")).recieve_message(callback, ssrHost);
    };

    // Global Config Object
	w.SMConfig = new SCORM_Config(T.query_to_json(d.location.search.substring(1), true));
	
	if(w.inMobileEnv){
	     w.SMConfig.hideTOC = true; // in a mobile device, the TOC must not be visible!
	}
	
	/*
	if(single SCO course){
	     w.SMConfig.hideTOC = true;
	}
	*/
	
	w.SSR.consoleLog = function(message){
	     var console = (w.opener)? w.opener.console : undefined; // prevent {JShint} from complaining and IE from getting cranky about 'console' undefined!
		  if(console && w.SMConfig.debugModeEnabled){ // also check if 'debug' mode is on ??
		       console.log(message);
		  }	   
	};

}(this, this.document));
