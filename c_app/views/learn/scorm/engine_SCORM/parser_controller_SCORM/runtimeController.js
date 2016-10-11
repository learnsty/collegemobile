/*!
 * {SCORM CONTROL_LAYER}
 */
 
/*!
 * ## TODO ##
 * {RuntimeController} should be able to
 * -- save state (using "cachestore")
 * -- have support for lazy loading
 * -- delegate keyboard navigation support for TOC
 */

(function(w, d){
   
         var T = $cdvjs.Application.command("tools"),
		     U = $cdvjs.Application.command("utils:base64_encode"),
		      
			require = (function(){  
	 
	             var path, complete, args;
				 
                function req(obj) {
	               path = obj.path || [];
			       complete = obj.complete || (function(){});
			       args = obj.args;
				   
			       var len = req.fn.len = path.length;
			 
                   for (var i = 0; i < len; i++) {
                         req.fn.fetch(path[i]);
                   }
                }

                req.fn = {
				
				     len:-1,
	    
	                 loadCount:0,
       
                     done: function(e) {
                            this.loadCount++;
                            if(this.loadCount == this.len) complete.call(null, args);
                     },

                     fetch: function(src) {
                           var  self = this,
                           head = d.getElementsByTagName('head')[0], // @TODO: use T.get_head(); here later
				           all = d.getElementsByTagName('script'),
	                       thisfile = all[all.length - 1],
                           s = d.createElement('script');
                           s.type = "text/javascript";
                           s.async = false;
                           s.src = src;
                           s.onload = s.onreadystatechange = function(e){
			                         if(e.type.indexOf("readystate") > -1){
			                               if(s.readyState && 
										      s.readyState != "complete"){
										          return;
                                           }
				                           s.onreadystatechange = null;
				                           self.done(e);
			                         }else{
			                               self.done(e);
										   s.onload = null;
			                         }
			  
			               };
                           head.insertBefore(s, thisfile);
                     }
                }

               return req;
	
            }()),
			APICommand = function(store){
    
	             // Command Interfaces...
	                  return {
	                        setCMIData:function(elem, val){
		                          return (store.setData(elem, val));
		                    },
		                    getCMIData:function(elem){
		                         return (store.getData(elem));
		                    },
		                    commitCMIData:function(count){
		                          return store.persistData(count);
		                    },
		                    dumpStorage:function(){
		                         return store.dumpStorage();
		                    },
		                    controlCMIAccess:function(lock){
		                          if(lock){
			                          store.suspendOpenAccess();
			                      }else{
			                          store.engageOpenAccess();
			                      }
		                    }
	                    };
            },
            SEQCommand = function(store){
 
                    // Command interfaces...
                    return {
	                     getLessonStatus:function(id){
		                       return store.provideState(id);
		                 },
		                 getStorageContent:function(name, obj){
		                       return store.restoreData(name, obj);
		                 }
	                };
			},
			SCORM_API = null,
			CMIStorage = null,
			IMS_Sequencer = null,
			cmiStore,
			DBConfig = {global:false},
			primerUrl = w.location.protocol + "//" + w.location.host + (w.location.port? ":"+w.location.port : "") + "/collegemobile/c_app/views/learn/scorm",
			output;

 function RuntimeController(parser){
	
	    var self = this, 
		    autoLaunch = true,
			resetFlag = function(){
			     autoLaunch = !autoLaunch;
				 return " auto-launch"; 
			};
		
		if(w.SMConfig.autoLauchFirstSCO){
		      autoLaunch = false;
		}
		
		w.SSR.consoleLog("pth: "+w.location.pathname);
	
	    // retrieve all parser data...
	    self.trees = parser.getActivityTrees();
	    self.mode = parser.getParseMode();
		self.version = parser.getParseVersion();
		self.resources = parser.getResourcesData();
		self.renderPipe = [];
		
		// release memory ...
		parser.cleanup();
			 
		 var loadScripts = function(pathArray, callback, args, context){
			          require({
					         path:pathArray, 
					         complete:callback, 
							 args:args
					  });
			 },
			 treeTraversor = function(/* <TreeNode> */root){
                        var i = 0,
                            children = root.getChildren(),
                            len = children.length;
							output += "<li class='"+(root.isLeaf? "no-anchor" : "anchor anchor-closed")+"'> \n";
                            applyRules.call(self, root);
                            if(root.isParent)
							     output += "<ul class='tree-joint joint-closed'> \n";
								 
                            while(i < len){
							   treeTraversor(children[i]);
                               i++;
							}
					  	 
						    output += (root.isLeaf) ? "</li> \n" : "</ul></li> \n";
            },
            applyRules = function(root){
			            w.SSR.consoleLog("currently applying rules for sub tree");
                        output += "<a href='javascript:void(0);' class='tree-title "+(root.isLeaf ? "tree-leaf"+(autoLaunch? "" : resetFlag()) :  (root.hasParent? "tree-branch title-bold" : "tree-root title-bold"))+"'";
                        var _m,
						    res, 
					        target, 
						    attrs = root.value;
							
                            for(var m in attrs){
							
							    _m = m.toLowerCase();
								
							    if(_m == "parameters"){
								    output += " aria-href-parameters='"+attrs[m]+"'";
								}
								
								/* TODO: we have to rethink this below .... shocker from SCORM 2004 spec!!!
								  if(_m == "isvisible"){
								     if(attrs[m]==="false"){
									     output += " style='display:none; height:0; padding:0; margin:0; border:none; opacity:0; filter:alpha(opacity=0);'";
									 }
								  }
								*/
								
                                if(_m == "identifierref"){ // it must be a leaf node to have this attribute !!!
                                        target = attrs[m];
                                        if(target){
                                               res = this.resources[target]; 
											   if(res["adlcp:scormtype"] == "sco" || res["adlcp:scormtype"] == "asset")
                                                     output += " aria-launch-type='"+res["adlcp:scormtype"]+"' aria-launch-href='"+(res["xml:base"]||"")+res["href"]+"'";
                                                if(res["files"] && res["files"].length)
												     output += " aria-files-collection='{"+String(res["files"])+"}'";
												
										}
                                }
								
                                // setup the identity of the activity (branches and leafs)
                                if(_m == "activityid"){
                                        output += " aria-prerequisite-id='"+attrs['identifier']+"' id='"+attrs['identifier']+"__"+attrs[m]+"' aria-activity-id='"+attrs[m]+"'";
                                }
								// setup activity depth in the activty tree
								if(_m == "depthcount"){
								    output += " aria-depth-count='"+attrs[m]+"'";
								}
								
								// setup AICC CMI data values from the manifest xml file for 'this' learning activity
								
								if(_m == "masteryscore"){
								     output += " aria-aicc-"+_m+"='"+attrs[m]+"'";
								}
								
								if(_m == "datafromlms"){
								     output += " aria-aicc-"+_m+"='"+attrs[m]+"'";
								}
								
								if(_m == "prerequisites"){
								     output += " aria-aicc-"+_m+"='"+attrs[m]+"'";
								}
								
								if(_m == "maxtimeallowed"){
								     output += " aria-aicc-"+_m+"='"+attrs[m]+"'";
								}
								
								if(_m == "completionthreshold"){
								     output += " aria-adl-"+_m+"='"+attrs[m]+"'";
								}
								
								if(_m == "timelimitaction"){
								     output += " aria-aicc-"+_m+"='"+attrs[m]+"'";
								}
								
								/*
								 @REM: The 'imsmanifest.xml' file does not provide any fill-in
								       data for 'cmi.core.credit' and 'cmi.core.lesson_mode'
                                       these are generated by the LMS
								*/
								
                            }
       
                            output += "><span class='place-holder'>"+root.key+"</span></a> \n";
                            
     
            },
			treeRenderer = function(/* <Array, <Tree>> */ trees){
			      w.SSR.consoleLog("running the tree renderer inside the runtime controller");
			      for(var t=0; t < trees.length;t++){
				      output = "";
					  output += "<div class='tree-frame'><ul class='tree-joint'> \n";
				      treeTraversor(trees[t].node);
					  output += "</ul></div> \n";
					  self.renderPipe.push(output);
				  }
				 
			};
            
			 
	        treeRenderer(self.trees); 

			self.trees = null; // release memory...
			self.resources = null; // release some more memory...
		
            if(self.version === 1.2){
			    w.SSR.consoleLog("currently loading scripts for SCORM "+self.version+" version");
                loadScripts((function($w, pUrl){
				       
					  var array = [
					               pUrl+"/engine_SCORM/apis_SCORM/SCORM_1_2/IMS_Sequencer.js",
					               pUrl+"/engine_SCORM/apis_SCORM/SCORM_1_2/CMI_DB.js", 
					               pUrl+"/engine_SCORM/apis_SCORM/SCORM_1_2/api.js"
								]; 
								
					   
				      return array;

				  }(w, primerUrl)), 
				
				  function(){
				    try{
				    	  CMIStorage = $cdvjs.getClass("CMIStorage_1_2");
	                      SCORM_API = $cdvjs.getClass("SCORM_API_1_2");
						  IMS_Sequencer = $cdvjs.getClass("IMS_Sequencer_1_2");
						  cmiStore = new CMIStorage(DBConfig);
							 
	                      w.API = new SCORM_API((new APICommand(cmiStore)));
						  self.SEQ12 = new IMS_Sequencer((new SEQCommand(cmiStore)));
						  w.SSR.consoleLog("all scripts loaded for SCORM "+self.version+" version ---> API Adapter, CMI Store & Sequencer all initialized!!");
					      w.SSR.loadWait.proceed(DBConfig.global);
					}catch(ex){
						  w.SSR.consoleLog("Exception: " + ex.message);
						  w.SSR.loadWait.dontProceed(ex);
					}  
				});	  
            }else{
              /*
			     w.SSR.consoleLog("currently loading scripts for SCORM "+self.version+" version");
                 loadScripts([primerUrl+"/engine_SCORM/apis_SCORM/SCORM_2004/ADL_Sequencer.js",primerUrl+"/engine_SCORM/apis_SCORM/SCORM_2004/CMI_DB.js", primerUrl+"/engine_SCORM/apis_SCORM/SCORM_2004/api.js"], function(){
                      CMIStorage = $cdvjs.getClass("CMIStorage_2004");
                      SCORM_API = $cdvjs.getClass("SCORM_API_2004");
					  ADL_Sequencer = $cdvjs.getClass("ADL_Sequencer_2004");
                      cmiStore = new CMIStorage();
                      w.API_1484_11 = new SCORM_API(new APICommand(cmiStore));
					  self.SEQ2004 = new ADL_Sequencer({});
					  w.SSR.consoleLog("all scripts loaded for SCORM  "+self.version+" version ---> API Adapter, CMI Store & Sequencer all initialized!!");
				  }); 
              */
                  alert("SSR does not support SCORM 2004 versions for now!");
				  //throw new Error("version not supported!");
            }
			
			return self;
	
	}
	
	$cdvjs.createClass("RuntimeController",
       RuntimeController,
       {
          constructor:RuntimeController,
          toString:function(){
                return (this.constructor).toString();
          },
          valueOf:function(){
                        
          }
    });

}(this, this.document));