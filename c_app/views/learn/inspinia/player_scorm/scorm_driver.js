/**  
 * Copyright (c) 2016 CollegeMobile.
 */
 
 ;(function(w_n, d){
	   
	        var 
			    $win,
                E = w_n.$cdvjs.Application.command("emitter"),
				Queue = w_n.$cdvjs.Application.getDataStruct("Queue"),
	            Ck = w_n.$cdvjs.Application.command("cookiestore"),
				lmsHost = w_n.location.protocol + "//" + w_n.location.host + (w_n.location.port ? ":"+w_n.location.port : ""),
				$promise,
				$defered,
				$sendDefered,
				$getDefered
				XDR = function(v, xdomain){
				    // if IE and {xdomain} is true, then we make use of XDR
				      E.emit("callcomms->ajax", v);
				};
				
			 	
	         w_n.$cdvjs.LMS = {isExtensionStarted:false,Batch:{}};
			 w_n.$cdvjs.LMS.Batch.getTaskID = function(){
                          /*jslint bitwise: true, eqeq: true */
                      return "xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(
                      /[xy]/g,
                     function (c) {
                          var r = Math.random() * 16|0, v = c == "x" ? r : (r&0x3|0x8);
                          return v.toString(16);
                     });
             };
			 w_n.$cdvjs.LMS.Tasks = new Queue();
             w_n.$cdvjs.LMS.monitorTimer =  null;
             w_n.$cdvjs.LMS.monitorSCORMToTerminate = function(data, type){
			       // "start", "finish"
				   $defered = new w_n.$cdvjs.Futures();
		           var tick = -1, LMS = this;
			       LMS.monitorTimer = setInterval(function(){
				           w_n.console.log(" ---> scromunit: <--- ");
				           if(!$win.closed){
						        //###########################
						        if(LMS.Tasks.size() <= 1){
								     $defered.resolve(function(callback){
									     if($win.SSR && $win.SSR.hasSCOChangeHappened()){
										     w_n.TaskRunner.runIfPresent(this.Tasks.dequeue(), callback);
										 }
									 });
								}
								// ##########################
						        if(tick === 2){
								     w_n.TaskRunner.title = LMS.Batch.getTaskID();
								     LMS.Tasks.enqueue(w_n.TaskRunner.addTask(function(data, type){
									          var x = E.emit('send_to_lms->wait', data, type);
											  return x.send_to_lms && x.send_to_lms.wait && x.send_to_lms.wait.promise();
									 }, data, type));
									 w_n.TaskRunner.title = undefined; // just to be safe...
									if(w_n.TaskRunner.getTasksCount() > 1){								
                                          w_n.TaskRunner.remove(LMS.Tasks.dequeue());
                                    }						
                                    $defered.reject(function(callback){
									     if($win.SSR && $win.SSR.hasSCOChangeHappened()){
										     w_n.TaskRunner.runIfPresent(this.Tasks.dequeue(), callback);
										 }
									});									
						            clearInterval(LMS.monitorTimer);
									LMS.monitorTimer = null;
									return;
							    }	
                                ++tick;								
						   }else{
						       LMS.isExtensionStarted = false;
							   // check if API.LMSFinish was called b4 the window was called
							   $defered.resolve(function(callback){
							        var $cookie = Ck.get_cookie("runtime_session_clause");
								    if($cookie === "finish"){
									   if(!this.Tasks.isEmpty()){
										   w_n.TaskRunner.runIfPresent(this.Tasks && this.Tasks.dequeue(), callback);
									   }else{
									       w_n.TaskRunner.title = this.Batch.getTaskID();
								           this.Tasks.enqueue(w_n.TaskRunner.addTask(function(data, type){
									             var x = E.emit('send_to_lms->wait', data, type);
											    return x.send_to_lms && x.send_to_lms.wait && x.send_to_lms.wait.promise();
									       }, data, type));
									       w_n.TaskRunner.title = undefined; // just to be safe...
										   // run the Task immediately...
										   w_n.TaskRunner.runIfPresent(this.Tasks.dequeue(), callback);
									   }   
									}else{
					                     // get all the data for CMI-DB and process as in API.LMSFinish("");
										console.log("We have the data... but API.LMSFinish(''); was not called! - $cookie="+$cookie);
                                        console.log(data);										
									}
							   });
							   clearInterval(LMS.monitorTimer);
							   LMS.monitorTimer = null;
							   return;
						   }
				   }, 1000); // 1sec interval
			       return $defered.promise();
		     };
             w_n.$cdvjs.LMS.monitorDIRECTFILEToTerminate = function(data, type){
		          // more code here soon...
		     };
			 w_n.$cdvjs.LMS.provideSCORMData = function(ydata, type, callback){
			     var LMS = this;
				 w_n.TaskRunner.title = LMS.Batch.getTaskID();
				 LMS.Tasks.enqueue(w_n.TaskRunner.addTask(function(data, type){
					          var x = E.emit('get_from_lms->wait', data, type);		  
						      return x.get_from_lms && x.get_from_lms.wait && x.get_from_lms.wait.promise();
				 }, ydata, type));
			     w_n.TaskRunner.title = undefined; // just to be safe...
				 // run the Task immediately...
				 w_n.TaskRunner.runIfPresent(LMS.Tasks.dequeue(), callback);
			 };
			 
             w_n.$cdvjs.LMS.recieveSCORMCommit = function(data, type, callback){
		          var LMS = this;
				  if(LMS.monitorTimer === null){ 
			            $promise = LMS.monitorSCORMToTerminate(data, type);
			            $promise.then(
						   /* ##RESOLVE## */
						   function(cb){
						       // this is for when the SCORM window closes finally
							  if(typeof cb === "function")  
			                        cb.call($cdvjs.LMS, callback);
							     
			               }, 
						   /* ##REJECT## */
						   function(cb){
						        // this is for when the SCORM window is still open
							if(typeof cb === "function")
								 cb.call($cdvjs.LMS, callback);
								 	
						   }
						);
					 return 1;	
				  }
				  return 0;
		     }; 

			 
 $cdvjs.Application.registerModule("scormunit", ["jQuery", "tools"], function(box, $accessControl){ 			 
			 
         var T = box.tools,
		     $ = box.jQuery,
             w = w_n.screen.width,
             h = w_n.screen.height,

			 scormPopUp = function(uri, config){
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
               w_n.$cdvjs.LMS.isExtensionStarted = true;
			   
			   E.on("send_cmi", function(d){
			          var json = T.json_stringify(d);
			          console.log("SynLMS is sending request results to SSR: "+json);
                     ($win.$cdvjs.Application.command("channel")).post_message(json, lmsHost);       
               });
			   
			   // #### DATABASE COMMS - SEND CMI DATA TO DB ####
			   E.on('wait:send_to_lms', function(data, type){
                       var _status = 0;

			           $sendDefered = new w_n.$cdvjs.Futures();
			           // Use this in prod: ---> 
					   //$accessControl.setMessage("appdatacomms", {ajaxtype:type,payload:data,context:$smallDefered});
					   
						  
						     $.ajax({
							    url:data.target_url,
                                method:(type.replace(/^CMI_/, '')),
data:T.json_stringify({"cmi_activity":data.actvity,"cmi_learner":data.student,"adl_course":data.course,"cmi_json":data.json}),
                                success:function(payload, text, xhr){
                                       var datastr;
                                       console.log("Success... " + text);
                                       _status = 100;
                                       datastr = T.json_stringify(payload);
                                       console.log("json data recieved from SCORM {CMI_POST} route: "+datastr);
                                       console.log("Success on SCORM {CMI_POST} request route to: "+data.target_url);
                                },
                                error:function(xhr, text){
                                	   _status = 300;
                                       console.log("Server Error on SCORM {CMI_POST} request due to '"+text+"'");
                                       console.log("Failure on SCORM {CMI_POST} request route to: "+data.target_url);
                                }
							 }).always(function(payload){

							 	       console.log("Request has returned from SCORM {CMI_POST}  -----> always callback "+T.json_stringify(payload));
								              
										if(type === 'CMI_POST'){  
						                  switch(_status){	
							                  case 100:
                                                 ; // success
												  break;
                                              case 300:
                                                 ; // failure
                                              break;												  
			  	    	                  }
									    }  
						   
								       $sendDefered.resolve({
			                                   "status":_status, // a status of '100' is a successful CMI_POST, a status of '300' is an unsuccessful CMI_POST
			                                   "type":type
			                           });
                             });
                                                  
					         return $sendDefered;
			   });
			   
			   // #### DATABSE COMMS - GET CMI DATA FROM DB ####
			   E.on("wait:get_from_lms", function(data, type){
                      var _status = 0;                            
			          $getDefered = new w_n.$cdvjs.Futures();
					  // Use this in prod: ---> $accessControl.setMessage("appdatacomms", {ajaxtype:type,payload:data,context:$smallDefered});
					       
						   $.ajax({
						        url:data.target_url,
								method:(type.replace(/^CMI_/, '')),
								data:T.json_stringify({"cmi_activity":data.actvity,"cmi_learner":data.student,"adl_course":data.course}),
                                success:function(payload, text, xhr){
                                       var datastr;
                                       console.log("Success... " + text);
                                       _status = 100;
                                       datastr = T.json_stringify(payload);
                                       console.log("json data recieved from SCORM {CMI_GET} route: "+datastr);
                                       console.log("Success on SCORM {CMI_GET} request route to: "+data.target_url);
                                },
                                error:function(xhr, text){
                                	   _status = 300;
                                       console.log("Server Error on SCORM {CMI_GET} request due to '"+text+"'");
                                       console.log("Failure on SCORM {CMI_GET} request route to: "+data.target_url);
                                }
                            }).always(function(payload){
							                  
				  	                        console.log("Request has returned from SCORM {CMI_GET}  -----> always callback "+T.json_stringify(payload));
							   
								              
											if(type === 'CMI_GET'){  
							                  switch(_status){	
								                  case 100:
                                                     ; // success
 												  break;
                                                  case 300:
                                                     ; // failure
                                                  break;												  
				  	    	                  }
											}  
							  
                                           $getDefered.resolve({
                                                 "data":payload,
                                                 "statedata":{},
                                                 "type":type,
                                                 "status":_status // a status '100' is a successful CMI_GET, a status '300' is an unsuccessful 
                                          });
				  	    	});
                                                  
					        return $getDefered;
			   }); 
               
           },
           requestCMI = function(obj, callback){
                  
                  var flag = obj["cmi_control_flag"];
				  var token = obj["cmi_timestamp_token"];
                  var type = obj["cmi_transport_type"];
                  var data = obj["cmi_transport_data"];
                  var timeout;

                  if(type === "CMI_GET"){ 
				       data.token = token;
					   console.log("Fetching data from persistent data store (MySQL) at "+data.target_url+" for "+data.student+" who has activated activity: "+data.activity+"!!");
					   w_n.$cdvjs.LMS.provideSCORMData(data, type, callback);
                   }else if(type === "CMI_POST"){
					   console.log("Sending data to persistent data store (MySQL) at "+data.target_url+" for "+data.student+" who has activated activity: "+data.activity+"!!");
					   console.log("SSR -> Student Expreience Report: \r\n Badge:"+data["cmi.core.credit"]+", \r\n Session Time:"+data["cmi.core.session_time"]+", \r\n Lesson Status:"+data["cmi.core.lesson_status"]+"!");
                       w_n.$cdvjs.LMS.recieveSCORMCommit(data, type, callback);
				   }else if(type === "STATE_POST"){
						     ;
				   }
                   

           };
		   
		   ($cdvjs.Application.command("channel")).recieve_message(function(json, loc){
		        if(!$win || (loc.indexOf('/scorm') == -1)){
		        	console.log("SCORM: Here we are locked out     - loc: "+loc);
				    //return;
				}
                console.log("SynLMS is recieving request from SSR: "+json);
                json = T.json_parse(json);
              
                requestCMI(json, function(data){
				      if(Array.isArray(data)){
					      data = data[0];
					  }
                      E.emit("send_cmi", data);
                });
                             
           }, lmsHost);
		   
		   
		   
  
           w_n.scormLauncher = function(url){

		       scormPopUp(url);

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

    $cdvjs.Application.activateModule('scormunit');
    
		  
}(this, this.document));