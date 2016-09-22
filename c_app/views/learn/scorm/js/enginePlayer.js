/*!
 * {this implements the SCORM runtime player core}
 * {SCORM PLAYER v1.2}
 */

(function(w, d, undefined){

var T = $cdvjs.Application.command("tools"),

    currActivityIndex = -1,
	
    leafActivityNum = 0, // total number of leaf activities... (initially initialized to zero)
	
	timerStatus = " Unlimited",
	
	noShowKey = true,
	
	noHideKey = false,
	
	startSCOTarget = null,
	
	shouldAllowProceedNav = false,
	
	activitiesList = [],
	
	__core = {url:""},
	
	getAttributeByName = function(obj, attrName, callback){
            var attributes = obj.attributes, temp;
            try {
                if(attributes){
 				        attributes.getNamedItem(attrName).value; // nodeValue;
				}else{
				        // IE6/7 mostly
				        temp = obj.getAttributeNode(attrName)
						
						if(temp.specified){
						     return temp.value;
						}
                        throw {"message":"Choi! we no fit get attribute ooooo..."};						
				}		
            }catch (ex) {
                var i;
                for (i = 0; i < attributes.length; i++) {
                    var attr = attributes[i];
                    if (attr.nodeName == attrName && attr.specified) {
                         return attr.value; // return attr.value
                    }
                }
                return null;
            }
		return undefined;	
    },
	
    hasClass = function(target, name){
	    if(T.is_node(target)){
		     return (target.className.search(new RegExp("(?:^|\\s+)" + name + "(?:\\s+|$)")) > -1);
		}   
    },
		 
	addClass = function(target, name){
		      var parts;
		      if(T.is_node(target)){
			      parts = target.className.split(/\s+/);
				  parts.push(name);
				  target.className = (parts.join(" "));
			  }
	},
		 
	removeClass = function(target, name){
		    if(T.is_node(target)){
			     target.className = (target.className.replace(name, ""));
			}
	},
	
	throttleFn = function(fn, fx, threshold){

            if(!threshold || typeof threshold === "undefined"){
                  if(fx && typeof fx === "number")
                        threshold = fx;
            }

            var lastTime = now = (new Date()).getMilliseconds(),
                diff, setter = function(/* varargs */){
                      now = (new Date()).valueOf(); //now, making use of the variables in outer scope - "now","diff"
                      diff =  now - lastTime;
                      var self = this,
					      item = fx.call(self, []);
                      if(diff >= threshold){
                            fn.apply(self, (([].slice.call(arguments)).concat(item)));
                      }
                      lastTime = now;
					  item = null; // avoid inner scope memory leaks!
            };

           return setter;  
   },
   
   addEvent = function(evt, target, callback){
      if(!T.is_node(target)){
	       return;
	  }
	  
	  if('addEventListener' in target){
	      return target.addEventListener(evt, callback, false);
	  }else if('attachEvent' in target){
	      return target.attachEvent("on"+evt, callback);
	  }else{
	    return (target["on"+evt] = callback) !== null;
	  }
	  
   },
   
   removeEvent = function(evt, target, callback){
           if(!T.is_node(target)){
	       return;
	  }
	  
	  if('removeEventListener' in target){
	      return target.removeEventListener(evt, callback, false);
	  }else if('detachEvent' in target){
	      return target.detachEvent("on"+evt, callback);
	  }else{
	    return (target["on"+evt] === callback) && (target["on"+evt] = null);
	  }
   },
   
   detach = function(elem, name, handle){
        // avoid IE memory leaks... (for custom events)
	   if(!T.is_node(elem)){
	       return;
	   }
       
       if(typeof elem[name] === "undefined"){
	       elem[name] = null;
	   }
	   
	   removeEvent(name, elem, handle);
   };

$cdvjs.Application.registerModule("PlayerCore", ["cookiestore", "emitter", "utils"], function(sandbox, $accessControl){
 
   var C = sandbox.cookiestore,
   
       E = sandbox.emitter,
	   
       U = sandbox.utils,
	   
	   toc,

       mainJoint,	
	   
	   leafs,

       start, 
	   
	   prev, 
	   
	   next, 
	   
	   close, 
	   
	   exit,
	   
	   toggle,
	   
	   isAncestor = function(elem, container){
	    var html = d.documentElement;
	    if('compareDocumentPosition' in html){
		   return (container.compareDocumentPosition(elem) & 16) === 16;
		}else if('contains' in html){
		   return container !== elem && container.contains(elem);
		}else{
		   while ((elem = elem.parentNode) !== null) 
		          if (elem === container) return !!1;
				 
		    return !!0;		 
		 }
	  },
	  
	  byClassName = function(className, context){
       var temp = [],
	    byClass = d.getElementsByClassName || function(cname){
	         var retArr = [], ek = this.getElementsByTagName('*') || [];
             for(var t=0;t<ek.length;t++){
               if(ek[t].className.indexOf(" ")>=0){
                   var all = ek[t].className.split(" ");
                     for(var z=0;z<all.length;z++){
                       if(all[z]===cname){ retArr.push(ek[t])}
                     }   
                 }else if(ek[t].className===cname){ 
				    retArr.push(ek[t])
				 }
             }
            return retArr;  
	    },
	    tags = [].slice.call(byClass.call(d, className));
		
        if(T.is_node(context)){
		   for(var f=0; f < tags.length;f++){
		       if(isAncestor(tags[f], context)){
			       temp.push(tags[f]); 
			   }
           }
           return temp;		   
		}
		
		return tags;
     },

     SetEvents = function(event, menuTarget){
	   
	        var e = event || window.event,
			    target = e.target || e.srcElement || this,
 			    target_id = target.id;
				
			if(target_id === "prev" || target === "next"){
			   if(!(T.is_node(menuTarget)) && menuTarget === "invalid"){
			        w.SSR.consoleLog("Error: Invalid Flow Navigation Request Encountered!");
			        alert("Warn: You have requested the same lesson as before - access declined");
					return false; 
			   }
			}	
			
			switch(target_id){
			    case "exit":
		            setTimeout(function(){
		                   if(w.confirm("Are you sure you wish to exit \n this course right now ?")){
						        w.SSR.consoleLog("Info: SSR - shuting down...");
						        E.emit("navRequest", [{'REQUEST_TYPE':"EXIT"}, {}, {}]);
				           }
			       }, 50);	   
                break;
				case "start":
				        T.trigger_event(startSCOTarget, "scolaunch", {state:'auto-launch', navRequest:'START'}, w);
				break;
			    case "prev":
				case "next":
				        T.trigger_event(menuTarget, 'scolaunch', {state:null, navRequest:'FLOW'}, w);
				break;
				case "close":
				     setTimeout(function(){
					      w.SSR.resetAllGlobals();
					      var $el = byClassName("currently-launched")[0];
						  removeClass($el, "currently-launched");
						  removeClass($el.getElementsByTagName("a")[0], "anchor-disabled");
						  w.frames["runtime"].location.href = w.SSR.APP_HOST + "/js/scorm/synergixe.html";
			         }, 0);
				break;
			}
            return true;			 
	    },	   
		       
	    getCurrentPixelStyle = function(target, property){
              switch(property){
			  
			      case "opacity":
			            return target.currentStyle.filter || target.style.filter;
				  break;		
			  }
			  
        },
	
	    setupLaunch = function(attrs, title){
		
	          title = T.strip_tags(title);
			  
		      var name, 
			      itemMap = {
				     masteryscore:"mastery_score",
					 timelimitaction:"time_limit_action",
					 datafromlms:"launch_data",
					 maxtimeallowed:"max_time_allowed",
					 completionthreshold:"completion_threshold"
				  },
			      activitySetup = {
				       PLAYER_URL:__core.url,
					   TITLE:title,
					   PARAMS:"",
					   SCRIPT:""
				 }, 
			     activityList = {}, 
				 activityObj = {
				    mastery_score:"", 
					time_limit_action:"",
					launch_data:"",
					max_time_allowed:"",
					completion_threshold:""
				 };
			  
			  for(var t=0; t < attrs.length; t++){
			      if(attrs[t].specified){
				      name = attrs[t].name;
				      switch(name){
 					      case "aria-prerequisite-id":
					           activityList.REQUEST_HANDLE = attrs[t].value;
					      break;
						  case "aria-launch-href":
						       activitySetup.LAUNCH_URL = attrs[t].value;
						  break;
						  case "aria-href-parameters":
						       activitySetup.PARAMS = attrs[t].value;
						  break;
						  case "aria-launch-type":
						       w.SSR.HAS_COM_RIGHTS = ("sco" === attrs[t].value);
						  break;
						  case "aria-aicc-prerequisites":
						       activitySetup.SCRIPT = attrs[t].value;
						  break;
						  case "aria-activity-id":
						      activitySetup.SUBJECT = attrs[t].value;
						  break;
						  case "aria-adl-minnormalizedmeasure":
						      activityObj["completion_threshold"] = attrs[t].value;
						  break;
					      case "aria-aicc-masteryscore":
						  case "aria-aicc-timelimitaction":
						  case "aria-aicc-datafromlms":
						  case "aria-aicc-maxtimeallowed":
						  case "aria-aicc-completionthreshold":
						       activityObj[itemMap[(name.replace(/^aria-aicc-/,""))]] = attrs[t].value;
						  break;
					  }
				  }
			  }
			  
			  if(activityObj.maxtimeallowed !== ""){
			       timerStatus = " Restricted";
				   // SCORM 1.2/2004 specs delineate that in some cases, a SCO can timeout! 
				   // So, we visually indicate this to the user via the UI
			  }
			  
			  d.getElementById("timing-value").innerHTML = timerStatus;
			  
		      return function(evt){    
				   // trigger mediator event {navRequest} to IMS_Sequencer instance
				   w.SSR.consoleLog("Current DOM element: "+evt.origin);
				   w.SSR.consoleLog("Current request: "+evt.navRequest);
				   activityList.REQUEST_TYPE = evt.navRequest;
				   E.emit("navRequest", [activityList, activityObj, activitySetup]);         
			  } 
    },
	
	attachAnimation = function(target, options, duration, callback){
	    // @TODO: use requestAnimationFrame here...
		// options.prop, options.now, options.start, options.end
		if(!T.is_node(target)){
		   return null;
		}
		var _callback = null,
		    cases = {
		        hasW3COpacity:/^(0.5|1)/.test(target.style.opacity),
		        isOldIE:hasClass((d.getElementsByTagName("body")[0]), "(IE6|IE7|IE8)")
		    };
		
		if(cases.isOldIE && options.prop === "opacity" && !cases.hasW3COpacity){
		      target.style.zoom = 1;
		}
		
		 _callback = !!callback.call && callback.bind(target, options, duration);
		
		return setTimeout(function(){
		     //w.requestAnimationFrame(_callback);
        },0);			
	},
	
    runtimeStyle = function(target, property){
        if(!T.is_node(target)){
		    return;
		}
		
		var val;
		if(target.style[property]){
               val = target.style[property];
         }else{
               
                val = (w.getComputedStyle) ?  w.getComputedStyle(target, null)[prp] : ((target.currentStyle)? getCurrentPixelStyle(target, property)  : 
                d.defaultView.getComputedStyle(target, null).getPropertyValue(T.str_decamelize(property, '-')));
          }
        
       // return property-value in pixels
	   return val;
   },
   
   nodeName = function(target, name){
        if(T.is_node(target)){
 		   if(target.nodeType === 1){
			    return (target.nodeName.toLowerCase() === name);
			}else{
			    return (target.nodeType === 3 && name === "#text");
			}
		}	
   },
   
   firstElementChild = function(target){
       if('firstElementChild' in target){
	       return target.firstElementChild;
	   }else{
	      if(target.firstChild && target.firstChild.nodeType === 1){
		      return target.firstChild;
		  }else{
		      return target.children.item(0);
		  }
	   }   
   },
   
   	 
   stopPropagation = function(e){
		    if('stopPropagation' in e){
			     e.stopPropagation();
				 return true;
			}else if('cancelBubble' in e){
   			     e.cancelBubble = true;
				 return e.cancelBubble;
			}
            return false;
   },
   preventDefault = function(e){
         if('preventDefault' in e){
		      e.preventDefault();
		 }else if('returnValue' in e){
		     e.returnValue = true;
		 }
   },
   eventsCallback = function(data){
         
		 w.SSR.consoleLog("Attaching Event Callback...");
		 
         return function(event){
		      event = event || window.event;
		      var  isStopped = event && stopPropagation(event),
			       currentTarget = this,
				   isAnchorOpen = null,
				   temp = null,
			       target = event.origin =  (event.target || event.srcElement),
				   stork = null,
				   type = event.type; 
			  
			   switch(type){
			   
			       case "click":
				      
			          if(hasClass(currentTarget, "tree-joint") && nodeName(currentTarget, "ul")){
					    if(currentTarget != target){
						
						   if(!isStopped){
						       // i can't find a reason on earth why the propagation/bubbling of the event can't be canceled
							   // however, shining the eyes!
							   w.SSR.consoleLog("Propagation wasn't stopped!! - Hmmmmm... no be small tin ohhh!");
							   if(event.cancelable){
							      // return false;
							   }
						   }
						   
						   if(nodeName(target, "li")){
						       stork = firstElementChild(target);
						       if(!hasClass(stork, "tree-leaf")){
							         // get the <li> tag
						             stork = target;
							   }else{
							       // 'trigger SCO launch' on the <a> tag - custom event
								   w.SSR.consoleLog("Triggering SCO by <li> itself...");
								   if(!shouldAllowProceedNav || hasClass(stork, "anchor-disabled")){
								        alert("Error: Invalid Choice Navigation Request Encountered!");
								        return false;
								   }
								   return T.trigger_event(stork, 'scolaunch', {state:null, navRequest:'CHOICE'}, w);  
							   }		 
						   }
						   
						   if((nodeName(target, "a")) || (nodeName(target, "span")) || (nodeName(target, "#text"))){
						        
							   if(target.nodeType === 3){ // text node
							       // get the <span> tag
								   target = target.parentNode;
							   }
						        
						       if(hasClass(target, "place-holder")){ // <span> DOM node
							        // get the <a> tag
							        target = target.parentNode;
							   }

							   if(hasClass(target, "tree-branch") || hasClass(target, "tree-root")){
							       // get the <li> tag
							       stork = target.parentNode; 
							   }else if(hasClass(target, "tree-leaf")){
							       // 'trigger SCO launch' happens here - custom event
								   w.SSR.consoleLog("Triggering SCO by <li> children...");
								   if(!shouldAllowProceedNav || hasClass(target, "anchor-disabled")){
								        alert("Error: SYNERGIXE SCORM RUNTIME - Invalid Choice Navigation Request Encountered!");
								        return false;
								   }
								   return T.trigger_event(target, 'scolaunch', {state:null, navRequest:'CHOICE'}, w);	  
							   }
						   }
						   
						   if(stork){
						            isAnchorOpen = hasClass(stork, "anchor-open");
							              /*attachAnimation(stork, 
							                       {
												       variable:"height",
												       start:runtimeStyle(stork, "height"),
													   end:(isJointOpen? runtimeStyle(temp, "height") : runtimeStyle(byClassName("tree-joint", stork)[0], "height")),
													},
													2000, 
								            */					
												
									if(isAnchorOpen){
									    removeClass(stork, "anchor-open");
										addClass(stork, "anchor-closed");
								    }else{
									    removeClass(stork, "anchor-closed");
									    addClass(stork, "anchor-open");
									}
													
						   }
						}else{
						     // kill the event!
						     return false;
						}
						return true;
					 }   			   
				   break;
                   case "scolaunch":
                        if(data){
		                  
 						    w.SSR.consoleLog("target text: "+target.innerHTML);
							
						    temp = setupLaunch(data, target.innerHTML);
							
						    if(event.state){
							     // handle START navigation requests...
						         removeClass(target, event.state);
								 if(!shouldAllowProceedNav){
								      shouldAllowProceedNav = true;
									  if(!hasClass(close, "deactivate")){
									      close.disabled = false;
										  removeClass(close, "btn-disabled");
									  }
							     }
								 start.disabled = true;
							     addClass(start, "btn-disabled");
						         w.SSR.consoleLog("proceedNav is allowed!");
							}else{
							     // handle FLOW & CHOICE navigation requests...
								 stork = byClassName("anchor-disabled")[0];
								 removeClass(stork, "anchor-disabled");
								 stork = null;
                                 stork = byClassName("currently-launched")[0];
						         removeClass(stork, "currently-launched");
								 if(!hasClass(close, "deactivate")){
									  close.disabled = false;
									  removeClass(close, "btn-disabled");
								 }
                            }								
						    // check for 'CHOICE' navigation requests and update data for use with 'FLOW' navigation requests
							if(!event.state && event.navRequest === 'CHOICE'){
							     currActivityIndex = parseInt(getAttributeByName(target, "data-leaf-index"));
							}
							// disallow the currently-launched SCO from being launched by 'CHIOCE' or 'FLOW' more than once
							target.disabled = true;
							addClass(target, "anchor-disabled");
							// also, tag it (the SCO) as currently-launched!!
						    addClass(target.parentNode, "currently-launched");
							// unload the current SCO (triggers 'LMSFinish' call in the process) by 'blanking the view' with a wait message
				            w.frames["runtime"].location.href = w.SSR.APP_HOST + "/js/scorm/engine_SCORM/players_SCORM/load.blank.html";
							// wait for all resources (CMI_DB/API/IMS_Sequencer) to 'async-ly' load and properly
							// and then trigger the current navigation request
						    w.SSR.loadWait.whenReady(function(){
							      w.SSR.consoleLog("wait limit reached to trigger nav-request...");
								  d.getElementById("activity-meter").innerHTML = "[" + (currActivityIndex+1) + " of " + leafActivityNum + " Activities]";
						         
								      temp.call(null, event);
								  
						    });
						   
						    return false;
						}
                   break;				   
			   }	  
			  
		 }
   };
 
   
   return {
      init:function(bootstrap){
	  
	      if(!U.is_url(bootstrap.DRIVER_STUB)){
		       alert("Error: SSR player driver could not load player core access parameter!");
		       w.close();
		  }else{
		       __core.url = bootstrap.DRIVER_STUB;
		  }
		  
		  // bind all necessary click events...
		  addEvent("click", exit, function(e){
		          SetEvents(e, null);
		  });
		  
		  addEvent("click", close, function(e){
		         SetEvents(e, null);
				 this.disabled = true;
				 addClass(close, "btn-disabled");
		  });
		  
		  addEvent("click", prev, throttleFn(function(e, t){
		          w.SSR.consoleLog("Loading Previous Activity SCO...");
				  SetEvents(e, t);
		  }, function(){
		      var elem;
			  if(!shouldAllowProceedNav){
				  return "invalid";
			  }
		      if(currActivityIndex > 0){
		            currActivityIndex -= 1;
			  }else{
			     // since the activity item has already been marked as active 'currently-launched','anchor-disabled' classes included on <li> and <a> respectively, then it can't launch twice
				  // however disable button
			     prev.disabled = true;
				 addClas(prev, "btn-disabled");
			  }		
			  elem = d.getElementById(activitiesList[currActivityIndex]);	
              if(parseInt(getAttributeByName(elem, "data-leaf-index")) === currActivityIndex){
			        w.SSR.consoleLog("PREV - navigation launch is correctly linked.");
			  }			  
		      return elem; // 'elem' is 't' passed in as argument above
		  }, 500));
		  
		  addEvent("click", next, throttleFn(function(e, t){
		            w.SSR.consoleLog("Loading Next Activity SCO...");
				    SetEvents(e, t);
		  }, function(){
		        var elem;
				if(!shouldAllowProceedNav){
					 return "invalid";
				}
		        if(currActivityIndex < activitiesList.length){ 
		               currActivityIndex += 1;
			    }else{
				    // since the activity item has already been marked as active 'currently-launched','anchor-disabled' classes included on <li> and <a> respectively, then it can't launch twice
				    // however disable button
			        next.disabled = true;
				    addClas(next, "btn-disabled");
				}
			   	elem = d.getElementById(activitiesList[currActivityIndex]);
     	
                if(parseInt(getAttributeByName(elem, "data-leaf-index")) === currActivityIndex){
			        w.SSR.consoleLog("NEXT - navigation launch is correctly linked.");
			    }					
		        return elem; // 'elem' is 't' passed in as argument above
		  }, 500));
		  
		  addEvent("click", start, function(e){
		        w.SSR.consoleLog("Loading Start Activity SCO...");
				SetEvents(e);
		  });
		  
		  addEvent("click", toggle, function(e){
		       e = e || window.event;
		       var pack = d.getElementById("toc-menu"), self = this;
			    	
			   if(hasClass(pack, "package-visible")){
			        if(hasClass(prev, "btn-disabled")){
					    if(!hasClass(prev, "deactivate")){
					         removeClass(prev, "btn-disabled");
						     prev.disabled = false;
						     removeClass(next, "btn-disabled");
						     next.disabled = false;
						}	 
					}
			        removeClass(pack, "package-visible");
					addClass(pack, "package-hidden");
					addClass(document.getElementById("tab-deck"), "clip-all");
			        self.innerHTML = "Show Menu";
			   }else if(hasClass(pack, "package-hidden")){
			        if(!hasClass(prev, "btn-disabled")){
					   if(!hasClass(prev, "deactivate")){
					        addClass(prev, "btn-disabled");
						    prev.disabled = true;
						    addClass(next, "btn-disabled");
						    next.disabled = true;
						}	
					}
					removeClass(pack, "package-hidden");
					addClass(pack, "package-visible");
					removeClass(document.getElementById("tab-deck"), "clip-all");
					self.innerHTML = "Hide Menu";
			   }
			   
			   // was the click event triggered by key actions ??
			   if(e.withKeys){ 
				    if(e.keyTag === "shown"){
					    noShowKey = true;
						noHideKey = false;
					}else if(e.keyTag === "hidden"){
					    noHideKey = true;
						noShowKey = false;
					}   
			   }
			   return true;
		  });
		  
		  
		  
		  addEvent("keyup", d, throttleFn(function(e){
	              var event = e || window.event;
				  var key = (event.which)? event.which : event.charCode;
	              if(key){
				       if("S" === (String.fromCharCode(key)) && event.shiftKey && event.ctrlKey){ 
					         if(noShowKey){ return false; }
			                 return T.trigger_event(toggle, "click", {withKeys:true, keyTag:'shown'}, w);
			           }else if("H" === (String.fromCharCode(key)) && event.shiftKey && event.ctrlKey){
					         if(noHideKey){ return false; }
					         return T.trigger_event(toggle, "click", {withKeys:true, keyTag:'hidden'}, w);
					   }
				  }
		  }, 100));
	
		  
		  for(var t = 0;  t < bootstrap.TOC_BUFFER.length; t++){
			 /* TODO: will have to implement tabs for arranging CAM <organizations> that have multiple <organization> path sets each having one or more <item> activities */
			    toc = bootstrap.TOC_BUFFER[t];				
		        d.getElementById('course-toc').innerHTML = toc;
			 
			    if(w.SMConfig.useOneOrganization)	
			  	       break;
		  }
		  
		  bootstrap.TOC_BUFFER = null; // release memeory...
		  t = null;
		  
		  if(w.SMConfig.ObeyNavPresentation){
		     prev.innerHTML = w.SMConfig.prevActivityText; // setup config details for UI navigation buttons
		     next.innerHTML = w.SMConfig.nextActivityText;
		  }
		  mainJoint =  byClassName("tree-joint")[0];
		  leafs = byClassName("tree-leaf", mainJoint);
		  
		  addEvent("click", mainJoint,  eventsCallback([])); // using event delegation to set one handler for multiple event origins
		  
		  for(var j = 0;  j < leafs.length; j++){
		        w.SSR.consoleLog("Attaching event callback on leaf...");
				leafs[j].setAttribute("data-leaf-index", ""+j);
				activitiesList.push(leafs[j].id); // this will be pushed in the order the leaf activities appear in the DOM (as is also the order in the CAM content structure -  this is what we want!!!)
			    addEvent("scolaunch", leafs[j], eventsCallback(leafs[j].attributes));
          }	

          E.on("dropLaunch", function(status){
		         alert("Info: This lesson can't be launched until prerequisites are satisfied!");
				 close.click();
		  });		  

          // record the total number of individual leaf SCO activities...
	      leafActivityNum = activitiesList.length;			  
     
	      // determine that the engine is launching the correct type of COURSE !! 
	      switch(w.SMConfig.scoLaunchContext){
		     case 'single':
			    if(leafActivityNum >  1){ 
				    alert("Info: Incorrect Launch Context... Please, restart this course with fresh settings");
					throw new Error("Error: Incorrect Launch Context encountered. SSR cannot proceed");
				}
			 break;
			 case 'multiple':
			    if(leafActivityNum == 1){
				   	alert("Info: Incorrect Launch Context... Please, restart this course with fresh settings");
					throw new Error("Error: Incorrect Launch Context encountered. SSR cannot proceed");
				}
			 break;
		  }
		  
		  // any SCORM content package with just one leaf SCO activity is likely to have internal navigation of its own, 
		  // so disable and 'deactivate' all runtime navigation... besides, they aren't needed at any rate in such a case!!
		  
		  if(leafActivityNum === 1){
		       addClass(prev, "btn-disabled");
		       prev.disabled = true;
			   addClass(prev, "deactivate");
			   addClass(next, "btn-disabled");
			   next.disabled = true;
			   addClass(next, "deactivate");
			   addClass(close, "btn-disabled");
			   close.disabled = true;
			   addClass(close, "deactivate");
			   d.getElementById("activity-meter").innerHTML = "<" + (w.SMConfig.autoLauchFirstSCO ? 1 : 0) + " of " + leafActivityNum + " Activity>";
		  }else{
		       d.getElementById("activity-meter").innerHTML = "<" + (w.SMConfig.autoLauchFirstSCO ? 1 : 0) + " of " + leafActivityNum + " Activities>";
		  }
		  
		  // setup config details for TOC visibility
		  if(w.SMConfig.hideTOC){
		       toggle.click(); // programatically hide the TOC
			   toggle.disabled = true;
			   toggle.style.cssText = "opacity:0;filter:alpha(opacity=0);-moz-opacity:0;display:none;";
			   toggle = null;
		  }
		  
		  E.emit("envReady", [function(cls){
   
                  var elem = byClassName(cls)[0];
	  
	                  if(!elem){ /* if {elem} is not truthy, then it means we don't have something to auto launch!! */
	                       // therefore, we allow the student to launch the start SCO himself/herself
	                       if(currActivityIndex === -1)
				               currActivityIndex+=1;
						   else
                               currActivityIndex = 0;
							   
				           startSCOTarget = d.getElementById(activitiesList[currActivityIndex]);
	                 }else{  /*  else if {elem} is indeed truthy, then it means we do infact have something to auto launch!! */
	                       // therefore, the SCO has to be auto launched by programmatically clicking the 'start' <button> 
						   currActivityIndex = parseInt(getAttributeByName(elem, "data-leaf-index"));
				           startSCOTarget = elem;
	                       start.click();	   
	                 }
	  
	                 return true;
          }, (bootstrap.DRIVER_MODE===1.2? " box-12": " box-2004")]);
		 
	  },
	  defineVars:function(mode){
	    //if(mode === 1.2){
	       toggle = d.getElementById("toggle");
		   start = d.getElementById("start");
	       prev = d.getElementById("prev");
		   next = d.getElementById("next");
		   close = d.getElementById("close");
		   exit = d.getElementById("exit");
		//}else if(mode === 2004){
		    // SCORM 2004 (2nd, 3rd, 4th Editions)
		//}   
	  },
	  stop:function(){
	  
	  },
	  destroy:function(){
	        
	        getCurrentPixelStyle  = null;
			
			toc = mainJoint = leafs = toggle = prev = next = close = exit = start = null;
	  }
  };

});

}(this, this.document));