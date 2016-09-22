/*!
 * @project: <synergixe - SynLMS>
 * @file: <api.js> - 
 * @author: <https://team.synergixe.com.ng>
 * @created: <04/03/2015>
 * @desc: {this implements the core of SCORM runtime adapter}
 * @remarks: {SCORM API v1.2}
 * @contributors: { @patrick, @chris, @dominic }
 */

(function(w, d){
  
    var Cs = $cdvjs.Application.command("cookiestore"),
	errorDiag = {
	     "0":"SSR reported that all previous error conditions have been resolved and there is no error currently reported",
	     "101":{"1":"","2":""},
		 "401":{"1":"","2":""},
		 "203":"This element which was requested for is not part of the CMI data set for arrays and cannot be retrieved",
		 "201":"This value presentented for this element is not capable of being stored. It doesn't match the data type required for this element"
	},
    errorDesc = {
    	 "0":"No error",
    	 "101":"General Exception",
	/*	 "102":"Server Busy", @REM not really sure about this one oooo... but, will check ref: APIWrapper.js (ADL code) */
    	 "201":"Invalid argument error",
    	 "202":"Element cannot have children",
    	 "203":"Element not an array. cannot have count",
    	 "301":"Not initialized",
    	 "401":"Not implemented error",
    	 "402":"Invalid set value, element is a keyword",
    	 "403":"Element is read only",
    	 "404":"Element is write only",
    	 "405":"Incorrect data type"
    },
    apiObjectStore = {

    },
    SCORM_API = function(command){ // pass the CMIStorage object as an argument to the API constructor
        this.errorCode = 0; // (No error)
		this.isBusy = false; // is the API 'busy' with anything ???
		this.DiagnosticCode = 0; // (Nothing to diagnose)
        this.id = String((new Date()).getTime());
        apiObjectStore[this.id] = {"instance":this,"instance_private_data":{commit_count:0,error_count:0,set_count:0,init_status:false,running_status:false,terminate_status:true, command_obj:command}};
        
		/**
        * @param : str {String} - an empty string 
        * @return : done {Boolean} - status flag to show success or failure
        * @desc : Moves to properly start-up the SCORM API Adapter and begin a communication session with SCO
        */
       this.LMSInitialize = function(str){
	         this.isBusy = true;
             var done = false, restore, mastery_score, mode, status, log, 
			           rack = apiObjectStore[this.id]["instance_private_data"],
                       command = rack["command_obj"];
			 
			 w.SSR.consoleLog("SCO is currently calling LMSInitialize...");	 
			 
             if(rack["init_status"]){
             	    this.errorCode = 101;  // (General Exception)
					this.DiagnosticCode = 2; // The API object has been prevoiusly initialized
             	    ++rack["error_count"];
					w.SSR.consoleLog("An exception has occured while calling LMSInitilize... >>> "+this.erroCode);
                    return String(done);
             }
                  
		     if(str !== "" || str === null){
                       this.errorCode = 201;  // (Invalid argument error)
                       ++rack["error_count"];
					   w.SSR.consoleLog("An exception has occured while calling LMSInitilize... >>> "+this.erroCode);
                       return String(done);
             }
             
			 
		     w.flagLMSSessionFinished = false;
             this.errorCode = 0;
			 this.DiagnosticCode = 0;
			 
			 done = w.SSR.AdapterStatus;
			 
			if(rack["terminate_status"]){
				 rack["init_status"] = true // set this API runtime session as initialized!!
			     rack["running_status"] = true // also, set this API runtime session as running!!
			     rack["terminate_status"] = false; // also, set this API runtime session as not terminated!!
			}	

            mastery_score = this.LMSGetValue("cmi.student_data.mastery_score");
			
			status = this.LMSGetValue("cmi.core.lesson_status");
			
			mode = this.LMSGetValue("cmi.core.lesson_mode");
			
			// relax appropriate R/W access to DB-->(CMI)
			command.controlCMIAccess(false);
			
			if(status === "browsed"){ // if it has been previously 'browsed' (mode is 'browse'), then we are in 'review' mode
			     if(mode === "browse"){
				      // @REM: May be out of context with SCORM specs but, let us see how this fails by the ADL Conformance Tests in future test cases
				      this.LMSSetValue("cmi.core.lesson_mode", "review");
				 }
				 // this is to reset the entry status into the SCO, should it (the SCO) have been previously set to 'resume' as at 'un-completion'
				 this.LMSSetValue("cmi.core.entry", "ab-initio");
			}else if(status === "passed" || status === "failed" || status === "completed"){ // if the SCO was previously 'passed', 'failed' OR 'completed', then we are also in 'review' mode
			     if(mode === "normal"){
				     this.LMSSetValue("cmi.core.lesson_mode", "review");
				 }
				 this.LMSSetValue("cmi.core.entry", "ab-initio");
			}else{ // "not attempted", "incomplete"
			     if(mastery_score === ""){ // set for 'credit' OR 'no-credit' based on availability of a {mastery_score} from the manifest file
				        if(status === "not attempted" || status === "incomplete"){
			                this.LMSSetValue("cmi.core.credit", "no-credit");
				            this.LMSSetValue("cmi.core.lesson_mode", "browse");
				            // this.LMSSetValue("cmi.core.lesson_status", "browsed"); ##The SCO should handle this.. but if it doesn't, we enforce it in the LMSFinish(""); call
						}	
			     }else{
				        if(status === "not attempted" || status === "incomplete"){
			                this.LMSSetValue("cmi.core.credit", "credit");
				            this.LMSSetValue("cmi.core.lesson_mode", "normal");
				            //this.LMSSetValue("cmi.core.lesson_status", "incomplete");	##The SCO will handle this.. but if it doesn't, we enforce it in the LMSFinish(""); call
			            }
				 }	
			}
			
			d.title = d.title.replace("[-]", "[Mode:"+this.LMSGetValue("cmi.core.lesson_mode")+"; Entry:"+this.LMSGetValue("cmi.core.entry")+"]");
			 
			// enforce appropriate R/W access to DB-->(CMI) 
			command.controlCMIAccess(true);
			// ensure data from adapter gets to the LMS
			 if(false){ /* supposed to be (w.inDesktopEnv) in actual production code */
			      w.SSR.beginCommitLoop();
			 }	
             // set cookie for monitoring data...
			 Cs.set_cookie("runtime_session_clause", "start");
			 // pass this call...
			 done = true;
			 w.SSR.consoleLog("LMSInitialize is about to return with a success result of 'true'!");
			 
			 this.isBusy = false;
             return String(done);
       };
       /**
        * @param : str {String} - an empty string 
        * @return : done {Boolean} - status flag to show success or failure
        * @desc : Moves to properly shutdown the LMS Adapter
        */
       this.LMSFinish = function(str){
	      this.isBusy = true;
       	  var done = false, offerCredits = false, min_score, max_score, credits, loc, status, mastery_score, mode, raw_score,
		  exit_value, rack = apiObjectStore[this.id]["instance_private_data"], command = rack["command_obj"];
          
		  if(w.flagLMSSessionFinished){
		      return;
		  }
		  
		  // call {window.SSR.postChannel} to send $stateProvider data to LMS database using 
		  // the EXIT navigation request (not here!! - move this to IMS_Sequencer)
		 
		 // command.setStateData();
		  
		  if(str !== "" || str === null){
             	 this.errorCode = 201;  // (Invalid argument error)
             	 ++rack["error_count"];
				 w.SSR.consoleLog("An exception occured while trying to call LMSFinish... >>> "+this.errorCode);
                 return String(done);
          }
		  
		  if(!rack["init_status"]){
		       this.errorCode = 301;  // (General Exception)
               ++rack["error_count"];
			   w.SSR.consoleLog("An exception has occured while calling LMSFinish... >>> "+this.errorCode);
               return String(done);
		  }
		  
		   w.flagLMSSessionFinished = true;
		  
		  w.SSR.consoleLog("SCO is currently calling LMSFinish...");
		  
		  min_score = this.LMSGetValue("cmi.core.score.min");
		  
		  if(this.LMSGetLastError() === "0"){
		      w.SSR.consoleLog("SCO has successfully requested 'cmi.core.score.min' data from {CMIStorage}...");
		  }
		  
		  max_score = this.LMSGetValue("cmi.core.score.max");
		  
		  if(this.LMSGetLastError() === "0"){
		      w.SSR.consoleLog("SCO has successfully requested 'cmi.core.score.max' data from {CMIStorage}...");
		  }
		  
		  credits = this.LMSGetValue("cmi.core.credit");
		  
		  if(credits === "credit"){
		       offerCredits = true;
		  }
		  
		  // relax appropriate R/W access to DB-->(CMI)
		  command.controlCMIAccess(false); 
		  
		  status = this.LMSGetValue("cmi.core.lesson_status");
		  
		  if(this.LMSGetLastError() === "0"){
		        w.SSR.consoleLog("SCO has successfully requested 'cmi.core.lesson_status' data from {CMIStorage}...");
		  }
		  
		  mastery_score = this.LMSGetValue("cmi.student_data.mastery_score");
		  
		  if(this.LMSGetLastError() === "0"){
		        w.SSR.consoleLog("SCO has successfully requested 'cmi.student_data.mastery_score' data from {CMIStorage}...");
		  }
		  
		  raw_score = this.LMSGetValue("cmi.core.score.raw");
			   
		  if(this.LMSGetLastError() === "0"){
			    w.SSR.consoleLog("SCO has just successfully requested 'cmi.core.score.raw' data from {CMIStorage}...");
		  }
		  
		  mode = this.LMSGetValue("cmi.core.lesson_mode");
								 
		  if(this.LMSGetLastError() === "0"){
				w.SSR.consoleLog("SCO has just successfully requested a value for 'cmi.core.lesson_mode' from {CMIStorage}...");
		  }
		  
          if(offerCredits){
		        // If the SCO has done nothing concerning scoring even as SSR allow credits....
		        if(status === "not attempted" || status === "incomplete"){
				
                     if(mastery_score !== ""){ // if it is provided for in the 'imsmanifest.xml' file, then let's check the raw score
                                
			                    if(raw_score !== ""){
				                       // since there is indeed a 'credit' for the current SCO, and a score is reported by the SCO,
									   // then calculate the relative score OR grade of the student for the SCO... 
									   // set completion status to 'passed' OR 'failed' depending...
				                       if(parsetInt(raw_score) >= parseInt(mastery_score)){
					                            this.LMSSetValue("cmi.core.lesson_status", "passed");
					                    }else{
					                            this.LMSSetValue("cmi.core.lesson_status", "failed");
					                    }
				                }
								
                        }
					}	
			}else{
			
			    if(mastery_score === null || mastery_score === ""){
				
				          if(raw_score === ""){
						        raw_score = "0";
								
								this.LMSSetValue("cmi.core.score.raw", raw_score);
								
								if(this.LMSGetLastError() === "0"){
				                     w.SSR.consoleLog("SCO has just successfully set a value for 'cmi.core.score.raw' data to {CMIStorage}...");
				                }
								
								if(min_score === ""){
						              min_score = "0";
									  
									  this.LMSSetValue("cmi.core.score.min", min_score);
									  
									  if(this.LMSGetLastError() === "0"){
				                          w.SSR.consoleLog("SCO has just successfully set a value for 'cmi.core.score.min' data to {CMIStorage}...");
				                      }
						        }
								if(max_score === ""){
						              max_score = "100";
									  
									  this.LMSSetValue("cmi.core.score.max", max_score);
									  
									  if(this.LMSGetLastError() === "0"){
				                           w.SSR.consoleLog("SCO has just successfully set a value for 'cmi.core.score.max' data to {CMIStorage}...");
				                      }
						        }
						  }else{
						        //@CHECK THIS MOVE AGAIN: even though the course is in 'browse' mode, let's take in a credit for the course! (Osho Free)
						        //this.LMSSetValue("cmi.core.credit", "credit");
								;
						  }
						  
						  
			 
			              if(parseInt(raw_score) >=  parseInt(min_score)){
						         // since there may or may not be 'credit' for the current SCO and if no score (score.raw) is reported 
								 // (for a no 'no-credit' case) by the SCO, then the status of the course becomes 'completed' (from SCORM specs!!) 
								 switch(mode){
                                     case "normal":
									 case "review":									 
								       if(status === "not attempted" || status !== "incomplete")
								            this.LMSSetValue("cmi.core.lesson_status", "completed");
									 break;
                                     case "browse":
                                       if(status === "not attempted" || status !== "incomplete")
								            this.LMSSetValue("cmi.core.lesson_status", "browsed");
                                     break;	
								}	 
						  }
						  // going forward,
						  // if there was infact a raw score set by the current SCO, then we can't override what the SCO has set 
						  // as both the raw score, min score, max score and the lesson_status (from SCORM specs!!) are to have separate 
						  // set/get responsiblity levels
						  
		        }
		  }
		  
		  
		  exit_value = this.LMSGetValue("cmi.core.exit");
		  
		  if(this.LMSGetLastError() === "0"){
		      w.SSR.consoleLog("SCO has successfully requested a value for 'cmi.core.exit' data from {CMIStorage}...");
		  }
		  
		  status = this.LMSGetValue("cmi.core.lesson_status");
		  
		  if(this.LMSGetLastError() === "0"){ 
		        w.SSR.consoleLog("SCO has successfully requested a value for 'cmi.core.lesson_status' data from {CMIStorage}...");
		  }
		  
		  switch(exit_value){
		      case "time-out":
			  case "logout":
			  
				   this.LMSSetValue("cmi.core.entry", "");
				   
				   if(this.LMSGetLastError() === "0"){
				       w.SSR.consoleLog("SCO has just successfully set a value for 'cmi.core.entry' data to {CMIStorage}...");
				   }
				      // Make sure (at this point) that the SCO actually set 
				      // a "completed/browsed/passed/failed" status on the lesson.
					  
				   if(status.search(/^(completed|passed|failed|browsed)$/) != 0){
				          switch(mode){
						      case "browse":
							        this.LMSSetValue("cmi.core.lesson_status", "browsed");
							  break;
							  case "normal":
							     if(parseInt(raw_score) >= (parseInt(mastery_score) || 0))
					                  this.LMSSetValue("cmi.core.lesson_status", "completed");
								 
								 
							  break;
						  }
						  
						  if(this.LMSGetLastError() === "0"){
				                 w.SSR.consoleLog("SCO has just probably set a value for 'cmi.core.lesson_status' data to {CMIStorage} successfully...");
				          }
				   }	  
					  
			  break;
			  case "":
			       this.LMSSetValue("cmi.core.entry", "");
				   
				   if(this.LMSGetLastError() === "0"){
				       w.SSR.consoleLog("SCO has just successfully set a value for 'cmi.core.entry' data to {CMIStorage}...");
				   }
				   
				   if(status !== "passed" && status !== "failed" && status !== "completed"){
						         
								 credits = this.LMSGetValue("cmi.core.credit");
		  
		                         if(this.LMSGetLastError() === "0"){
		                                w.SSR.consoleLog("SCO has successfully requested the 'cmi.core.credit' data from {CMIStorage}...");
		                         }
								 
								 if(mode === "browse" && credits === "no-credit"){
								       this.LMSSetValue("cmi.core.lesson_status", "browsed");
									   
									   if(this.LMSGetLastError() === "0"){
				                             w.SSR.consoleLog("SCO has just successfully set a value for 'cmi.core.lesson_status' data to {CMIStorage}...");
				                       }
								 }
					}
			  break;
			  case "suspend":
			  
			      this.LMSSetValue("cmi.core.entry", "resume");
				  // TODO: Might also want to make sure that the SCO actually set a 
				     //    bookmark for the lesson (cmi.core.lesson_location != "") 
					 //    and also that suspend info (cmi.suspend_data != "") is also set 
					 
				  // loc = this.LMSGetValue("cmi.core.lesson_location");	 
				  // more code will go here...
					 
				 // Also, at this point, we should make sure that the SCO has setup lesson_status 
				 // data for it's content properly else, clean-up after the SCO	 
				  status = this.LMSGetValue("cmi.core.lesson_status");
				  
				  if(this.LMSGetLastError() === "0"){
				      w.SSR.consoleLog("SCO has just successfully requested 'cmi.core.lesson_status' data form {CMIStorage}...");
				  }
				  
				  if(status !== "incomplete"){
				         this.LMSSetValue("cmi.core.lesson_status", "incomplete");
						 
						 if(this.LMSGetLastError() === "0"){
				              w.SSR.consoleLog("SCO has just successfully set a value for 'cmi.core.lesson_status' to {CMIStorage}...");
				         }
				  }
				  
			  break;
		  }
		  
		 // enforce appropriate R/W access to DB-->(CMI)
		 command.controlCMIAccess(true);
		 
		 
		 
		       // TODO: At some point, depending on whether or not the SCO called {LMSCommit} during the runtime session,
		       //       we may need to enforce a commit by calling 'endCommitLoop'
		  
		       // w.SSR.endCommitLoop();
			   
			   this.errorCode = 0;
			   this.DiagnosticCode = 0;
			   
			   w.SSR.resetGlobals("AdapterStatus");
			   
			   command.dumpStorage();
			   
		       // reset API runtime status ...
		       if(!rack["terminate_status"]){
		            rack["init_status"] = false; // set this API runtime session as not initialized!!
			        rack["running_status"] = false; // also, set this API runtime session as not running!!
			        rack["terminate_status"] = true; // also, set this API runtime session as terminated!!
		       }
		 
		  w.SSR.setSCOChange(1);
		  w.SSR.consoleLog("SSR is succesfully returning from LMSFinish(''); call with a 'true'!");
		  // set cookie for monitoring data...
	        Cs.set_cookie("runtime_session_clause", "finish"); 
		  // pass this call...		
		    done = true;
            this.isBusy = false;
			return String(done);
       };
       /**
        * @param : cmielement {String} - the string that represents the CMI data model element
        * @param : value {String} - the value to the CMI data model element
        * @return : done {String} - status boolean string to report storage result to the CMI localstorage
        * @desc : Moves to properly save data (locally) to the LMS 
        */
       this.LMSSetValue = function(cmielement, value){ 
	       this.isBusy = true;
           var done = false, log, rack = apiObjectStore[this.id]["instance_private_data"],
                       command = rack["command_obj"];
           
                if(rack["init_status"] && !rack["terminate_status"]){
				     w.SSR.consoleLog("SCO is about to save learner data (locally) using LMSSetValue...");
                     log = command.setCMIData(cmielement, value);
					 
                }else{
				     w.SSR.consoleLog("SCO is opting to use LMSSetValue at a wrong time... API object Not Initialized!");
                     log = {id:"301",error:true,data:""};
                }
				
				this.errorCode = parseInt(log.id);
				
                if(!log.data && log.error){
					 w.SSR.consoleLog("An exception occured while trying to call LMSSetValue... >>> "+this.errorCode);
                     ++rack["error_count"];
                }else{
				    ++rack["set_count"];
				    done = true;
				}
                       
            
			    // log.data
			    this.isBusy = false;
                return String(done);
            
       };
	   
       /**
        * @param : cmielement {String} - the string that represents the CMI data model element
        * @return : log.data {String} - status string to report value retrieved from the CMI localStorage
        * @desc : Moves to properly obtain data (locally) from the LMS 
        */
		
       this.LMSGetValue = function(cmielement){ 
	       this.isBusy = true;
           var done = false, log = {data:""}, rack = apiObjectStore[this.id]["instance_private_data"], command = rack["command_obj"];
           
           
                if(rack["init_status"] && !rack["terminate_status"]){
				       w.SSR.consoleLog("SCO is about to request learner data (locally) using LMSGetValue...");
                       log = command.getCMIData(cmielement);
                }else{
                    throw new Error("Not Initialized");
                }
				
				this.errorCode = parseInt(log.id);
				
                if(log.error){
					w.SSR.consoleLog("An exception occured while trying to call LMSGetValue  >>>"+this.errorCode);
           	        ++rack["error_count"];
                }else{
				    done = true;
				}
			
			    this.isBusy = false;
                return String(log.data);
				
       };
	   
       /**
        * @param : str {String} - an empty string 
        * @return : done {String} - status boolean string to show success or failure of commit operation to LMS DB
        * @desc : Moves to properly persist data the LMS Database
        */
       this.LMSCommit = function(str){
	        
            var result, done = false, rack = apiObjectStore[this.id]["instance_private_data"], command = rack["command_obj"];
			
                if(str !== "" || str === null){
                       this.errorCode = 101;  // (General Exception)
					   w.SSR.consoleLog("An exception occured while trying to call LMSCommit... >>>> "+this.errorCode);
                       ++rack["error_count"];
					   return String(done);
                }
				
				try{
                        if(rack["init_status"] && !rack["terminate_status"]){
				                        w.SSR.consoleLog("SCO is about to request transfer of learner data (remotely) using LMSCommit...");
									    if(!this.isBusy){
										   if(rack["set_count"] !== 0){
										        rack["set_count"] = 0;
                                                result = command.commitCMIData(rack['commit_count']); // pass on the last commit count...
										  }else{
										     return String(done);
										  }	
								        }else{
										     return String(done);
										}
                                            this.errorCode = (this.LMSCommit.$locked)? this.errorCode :  0;
											done = true;
                                        								
                        }else{
                                throw new Error("Not Initialized");
                        }
                         
						this.errorCode = (this.LMSCommit.$locked)? this.errorCode : parseInt(log.id); 
						 
						if(log.error){
							 w.SSR.consoleLog("An exception occured while trying to call LMSCommit... >>>> "+this.errorCode);
           	                 ++rack["error_count"];
							 return String(done);
                        }
                }catch(e){
                        if(e.message == "Not Initialized"){
                              this.errorCode = 301; // (Not Intialized)
                        }else{
                              this.errorCode = 101; // (General Exception)
                        }

            	        ++rack["error_count"];
						return String(done);
                }
				
                
				w.SSR.consoleLog("SCO has just successfully sent data to the LMS database using LMSCommit...");
                ++rack["commit_count"];
       
               return String(done);
       };
       /**
        * @param : {Null} - nothing 
        * @return : errorCode {Integer} - status flag to show the last error that occured
        * @desc : Makes available the error code for last error that occurred 
        */
       this.LMSGetLastError = function(){
	       this.isBusy = true;
	       var error = String(this.errorCode);
	       w.SSR.consoleLog("SCO just requested the last error case using LMSGetLastError...");
		   this.isBusy = false;
       	   return error;
		};
	   /**
        * @param : {Number} - code
        * @return : errorDesc[] {String} - status text to describe the last error that occured
        * @desc : Makes available the error text for last error that occurred 
        */
       this.LMSGetErrorString = function(code){
	        this.isBusy = true;
			var code = errorDesc[""+code];
            w.SSR.consoleLog("SCO is requesting description data for the last error that occured using LMSGetErrorString...");
			this.isBusy = false;
       	    return code;
       };
	   /**
        * @param : {Number} - code
        * @return : errorDiag[] {String} - status text to describe the last error that occured
        * @desc : Makes available the LMS specific detailed error text for last error that occurred 
        */
       this.LMSGetDiagnostic = function(code){
	         this.isBusy = true;
			 var dcode = errorDiag[""+code][(""+this.DiagnosticCode)];
             w.SSR.consoleLog("SCO is requesting diagnostic LMS-specific data for the last error that occured using LMSGetDiagnostic...");
			 this.isBusy = false;
             return dcode;
       	   
       };
  	
		return this;
    };

    $cdvjs.createClass("SCORM_API_1_2",  // SCORM 1.2 API Constructor definition!!
      SCORM_API,
      {
        constructor:SCORM_API,
        toString:function(){
               return (this.constructor).toString();
        },
        valueOf:function(){
                       
        }
	  });

}(this, this.document));
