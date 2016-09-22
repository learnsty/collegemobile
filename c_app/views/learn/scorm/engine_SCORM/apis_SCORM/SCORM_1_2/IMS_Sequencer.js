/*!
 * {this implements the SCORM AICC_SCRIPT Interpreter }
 * {SCORM CHECK_LAYER}
 */


(function(w, d, undefined){


/*******************************************************
 * Project: AICC_SCRIPT Intepreter                     *
 * https://code.google.com/p/aicc-script-interpreter/  *
 *                                                     *
 * Originally Created on 2007-4-27                     * 
 * Copyright (C) 2006 Qujinlong.                       *
 * All rights reserved.                                *
 *                                                     *
 * Original Source Language: Java                      *
 * License: Apache License 2.0                         *
 * http://www.apache.org/licenses/LICENSE-2.0          *
 *                                                     *
 * Recomposed and Modified on 2015-6-5                 *
 * Copyright (C) 2016 College Mobile                   *
 * All rights reserved.                                *
 *                                                     *
 * Current Source Language: JavaScript                 *
 * License: MIT License 2.1                            *
 *                                                     *
 *                                                     * 
 *******************************************************/

var E = $cdvjs.Application.command("emitter"),

    Queue = $cdvjs.Application.getDataStruct("Queue"),

    Stack = $cdvjs.Application.getDataStruct('Stack'),
	
	  promise = new $cdvjs.Futures(),
	
    TokensType = {
          "EOF":0,
          "ERROR":1,
          "LPAREN":2,
          "RPAREN":3,
          "AND":4,
          "OR":5,
          "EQUAL":6,
          "NOTEQUAL":7,
          "NOT":8,
          "ID":9,
          "TIMES":10,
          "SET":11,
          "STRING":12,
          "RESULT":13
    };

function AICC_ScriptScanner(/* Type:<String> */script){
  
    var script = script, // variable hoisting 
        tokenQueue = new Queue(),
        hasError = false,
        setStack;

    var lexerMap = {
            ID:/^([_:a-zA-Z](?:[_:a-zA-Z\d\.\-]+))(?:\b|)/,
            WSPACE:/^(\s+)(?:\b|)/,
            STR:/^(\"(?:[\w]*)\")(?:\b|)/,
            OPERATORS:/^(<>|&|\||~|=)(?:\b|)/,
            SET:/^(\{(?:[^},]+)(?:,[^,}]+)*?\})(?:\b|)/,
            TIMES:/^([\d](?=\*))(?:\b)/, // @NOTE: to match '*' char via Regular Expression is very problematic in JavaScript!!
            GROUP:/^(\(|\))(?:\b|)/
    };

    function _init(){
        var temp, 
        createSymbol = function(type, value){
                 return {
                   type:type,
                   value:value
                 };
        },
        sample = function(n){
            return script.match(lexerMap[n]);
        },
        reduce = function(c){
		        if(c === "TIMES")
		             return script.replace(lexerMap[c], "").replace(/^\*/,"");
		        else	  
                 return script.replace(lexerMap[c], "");
        };


        while(script!==""){
            for(var g in lexerMap){
               if(lexerMap.hasOwnProperty(g)){
                   if((temp = sample(g)) !== null){
                        temp = temp[1];
                        if(g === "WSPACE"){
                           script = reduce(g);
                           break;
                        }
                        
                        if(g === "OPERATORS"){
                            switch(temp){
                               case "&":
                                  tokenQueue.enqueue(createSymbol(TokensType["AND"], temp));
                               break;
                               case "<>":
                                  tokenQueue.enqueue(createSymbol(TokensType["NOTEQUAL"], temp));
                               break;
                               case "~":
                                  tokenQueue.enqueue(createSymbol(TokensType["NOT"], temp));
                               break;
                               case "=":
                                  tokenQueue.enqueue(createSymbol(TokensType["EQUAL"], temp));
                               break;
                               case "|":
                                  tokenQueue.enqueue(createSymbol(TokensType["OR"], temp));
                               break;
                            }
                           script = reduce(g);
                           break;  
                        }
                        if(g === "STR"){
                           tokenQueue.enqueue(createSymbol(TokensType["STRING"], temp));
                           script = reduce(g);
                           break;
                        }
                        if(g === "SET"){
                                  temp = temp.replace(/\{|\}/g,"");
                                  temp = temp.split(",");
                                  setStack = new Stack();
                                    for(var b=0;b < temp.length;b++)
                                          setStack.push((temp[b]).trim());
										  
                                  temp = temp.join(",");
                                  tokenQueue.enqueue(createSymbol(TokensType[g], setStack));
                                  setStack = null;
                                  script = reduce(g);
                               break;
                        }
                        if(g === "GROUP"){
                            if(temp==="("){
                                 tokenQueue.enqueue(createSymbol(TokensType["LPAREN"], temp));
                            }else if(temp===")"){
                                 tokenQueue.enqueue(createSymbol(TokensType["RPAREN"], temp));
                            }
                            script = reduce(g);
                            break;
                       }
                       if(g === "TIMES"){
                            tokenQueue.enqueue(createSymbol(TokensType[g], temp));
                            script = reduce(g);
                            break;
                       }
                       if(g === "ID"){        
                            tokenQueue.enqueue(createSymbol(TokensType[g], temp));
							script = reduce(g);
							break;
                       }
                   }
               }

            }

            if(!temp){
                 tokenQueue.enqueue(createSymbol(TokensType["ERROR"], new Error("wrong script: Illegal token char found --> '"+script.substr(0, 1)+"'"+" near ---> '"+script.substr(1)+"'")));
                 hasError = true;
                 script = "";
            }
        }
        
        if(!hasError){
              tokenQueue.enqueue(createSymbol(TokensType["EOF"], null)); 
        }

        this.hasMoreTokens = function(){
           return !(tokenQueue.isEmpty());
        }

        this.getNextToken = function(){
            return (tokenQueue.dequeue());
        }

        return this;
    } 

    return _init.call(this);
}

function AICC_ScriptContext(command){

    var map, _init = function(){
        this.refresh();
        return this;
    };
    
    this.put = function(name, value){
        name =  name || "";
        map[name] = value;
    }

    this.refresh =  function(){
        map = {"":null};
        return true;
    }

    this.getStatus = function(name){
        var stats = map[name];
        if(!stats){
             stats = command.getLessonStatus(name);
			 map[name] = stats; // cache the data so we don't keep asking the source (command) all the time!!
        }
        return stats;        
    }

    return _init.call(this);
}


function AICC_ScriptParser(script, context){

    this.scanner = new AICC_ScriptScanner(script);
    this.context = context;

    var TokenConstants = {
         EOF:{type:TokensType["EOF"], value:null},
         TRUE:{type:TokensType["RESULT"],value:new Boolean(true)},
         FALSE:{type:TokensType["RESULT"],value:new Boolean(false)},
         getResultToken:function(val){
                   return val ? this["TRUE"] : this["FALSE"] ;
         }
    },
    execPriority = {
      "HIGH":1,
      "SAME":0,
      "LOW":-1
    },
    checkStatus = function(stats){
        return (stats==="passed") || (stats==="completed") || (stats==="browsed");
    },  
    pop = function(stack){
         try{
             return stack.pop();
         }
         catch (e){
              return null;
         }
    },
    peek = function(stack){
          try {
              return stack.peek();
          }
          catch (e){
              return null;
          }
    },
    isEmpty =  function(stack){
        return (stack.isEmpty());
    },
    operandTokenStack = new Stack(),
    operatorTokenStack = new Stack();
    
	/**
	 *@param : countToken {Object} -
	 *@param : setToken {Stack} -
	 *@return : {Boolean}
	 *@desc :
	 */
    this.eatTimesToken = function(countToken, setToken){
         if(countToken.type !== TokensType.TIMES || setToken.type !== TokensType.SET){
                 throw new Error("wrong script: Unexpected token char found in stream ---> "+String(setToken.value));
         }

         return this.eatSetToken(parseInt(countToken.value), setToken);
    };

	/**
	 *@param : count {Number} -  
	 *@param : setToken {Stack} -
	 *@return : {Boolean}
	 *@desc :
	 */
    this.eatSetToken = function(count, setToken){
        
          var status, stack = setToken.value;

          if(!(stack instanceof Stack)){
               return TokenConstants.getResultToken(false);
          }

          /* @REM: detected a bug here while running unit tests for original code, removed '&&' operator in {while condition} below,
		     so that all items in 'SET' stack can be all 'false' upon examination without going into an endless loop */
          while(!isEmpty(stack)){

               status = this.context.getStatus(stack.pop());
                
               if(checkStatus(status)){
                     --count;
               }

               if(count <= 0){
                     break;
               }
          }

          return TokenConstants.getResultToken(count <= 0);
    };
	
	/**
	 *@param : idToken {Object} -
	 *@param : strToken {Object} -
     *@param : equal {Boolean} -
	 *@return : {Boolean}
	 *@desc :
	 */

    this.eatEqualToken = function(idToken, strToken, equal){
         var leftStatus, rightStatus;           

         if(idToken.type != TokensType.ID || strToken.type != TokensType.STRING){
                throw new Error("wrong script; cannot compare token types "+idToken.type+" and "+strToken.type);
         }

         leftStatus = this.context.getStatus(idToken.value);
         rightStatus = strToken.value;

         equal = equal ? (leftStatus===rightStatus) : (leftStatus!==rightStatus);

         return TokenConstants.getResultToken(equal);
    };

    this.eatPopOperator = function(){
       /* type: Token */ var optrToken = pop(operatorTokenStack);

          if (optrToken.type === TokensType.NOT){
                 return TokenConstants.getResultToken(!this.getTokenValue(pop(operandTokenStack)));
          }
          else if (optrToken.type === TokensType.AND){
                 return TokenConstants.getResultToken(this.getTokenValue(pop(operandTokenStack))
                         && this.getTokenValue(pop(operandTokenStack)));
          }
          else if (optrToken.type === TokensType.OR){
                 return TokenConstants.getResultToken(this.getTokenValue(pop(operandTokenStack))
                         || this.getTokenValue(pop(operandTokenStack)));
          }else{
                 throw new Error("wrong script.");
       
          }
    };

 
    this.getTokenValue = function(token){
         
         var status;
         if (typeof token === "undefined" || !token){
                throw new Error("wrong script.");
         }

    
         if(token.type === TokensType.RESULT){
               return (token.value).valueOf(); // return the boolean itself not the object!!
         }
         else if(token.type === TokensType.ID){
               status = this.context.getStatus(token.value);
               return checkStatus(status);
         } 
         else{
             throw new Error("wrong script.");
         }
		 
    };

    this.computePriority = function(stackToken, currToken){
         var prior = execPriority.HIGH;

         switch(stackToken.type){
             case TokensType.OR:
             case TokensType.AND:
                    switch(currToken.type){
                         case TokensType.OR:
                         case TokensType.AND:
                         case TokensType.RPAREN:
                         case TokensType.EOF:
                              prior = execPriority.HIGH;
                         break;

                         case TokensType.NOT:
                         case TokensType.LPAREN:
                              prior = execPriority.LOW;
                         break;
                    }
             break;

             case TokensType.NOT:
                    if(currToken.type === TokensType.LPAREN){
                              prior = execPriority.LOW;
                    }
                    else{
                              prior = execPriority.HIGH;
                    }
             break;

             case TokensType.LPAREN:
                    if(currToken.type === TokensType.RPAREN){
                            prior = execPriority.SAME;
                    }
                    else{
                            prior = execPriority.LOW;
                    }
             break;

             case TokensType.EOF:
                   if(currToken.type == TokensType.EOF){
                            prior = execPriority.SAME;
                   }
                   else{
                            prior = execPriority.LOW;
                   }
             break;

             default:
                  throw new Error("wrong script.");
             break;
          }

          return prior;
    };
    /**
	 *@param : {Undefined}
	 *@return : {Boolean}
	 *@desc : The result of parsing the AICC script
	 */
    this.parse = function(){
         
             operatorTokenStack.push(TokenConstants.EOF);

             var token = this.scanner.getNextToken();

             while(token.type !== TokensType.EOF || peek(operatorTokenStack).type !== TokensType.EOF){
      
                 if(token.type === TokensType.ERROR){
                          throw token.value;
                 }

      
                 if(token.type === TokensType.ID){
                           operandTokenStack.push(token);
                           // Id
                           token = this.scanner.getNextToken();
                 }
                 else{
                       if(token.type === TokensType.EQUAL){
                           // =
                           token = this.scanner.getNextToken();

                           token = this.eatEqualToken(pop(operandTokenStack), token, true);

                           operandTokenStack.push(token);

                           token = this.scanner.getNextToken();
                       }
                       else if(token.type === TokensType.NOTEQUAL){
                           // <>
                           token = this.scanner.getNextToken();

                           token = this.eatEqualToken(pop(operandTokenStack), token, false);

                           operandTokenStack.push(token);

                           token = this.scanner.getNextToken();
                       }
                       else if(token.type === TokensType.TIMES){
                           // TIMES
                           token = this.eatTimesToken(token, this.scanner.getNextToken());

                           operandTokenStack.push(token);

                           token = this.scanner.getNextToken();
                       }
                       else if(token.type === TokensType.SET){
                           // SET
                           token = this.eatSetToken(1, token);

                           operandTokenStack.push(token);

                           token = this.scanner.getNextToken();
                       }
                       else if(token.type === TokensType.STRING){
                           // Token
                           throw new Error("wrong script.");
                       }else{
                            // & | ~ ( )
                            switch(this.computePriority(peek(operatorTokenStack), token)){
            
                                   case execPriority.HIGH:
                                         operandTokenStack.push(this.eatPopOperator());
                                   break;

                                   case execPriority.SAME:
                                         pop(operatorTokenStack);
                                         token = this.scanner.getNextToken();
                                   break;

                                   case execPriority.LOW:
                                         operatorTokenStack.push(token);
                                         token = this.scanner.getNextToken();
                                   break;
                            }
                      }
              }

       
        }

                    token = pop(operandTokenStack);

					
                    if((token !== null || token !== undefined)){
						  if(token.type === TokensType.RESULT){
                                  return this.getTokenValue(token);
						  }else if(token.type === TokensType.ID){
							      return this.getTokenValue(token);
					      }				   
                    }

                    throw new Error("wrong script.");
    };

    // this method is to perform clean-up of the parser
    this.terminate = function(){
	        token = null;
          operatorTokenStack.empty();
          operandTokenStack.empty();
          return true;
    };
}


/****************************************
 * Project: JavaScript IMS_Sequencer   *
 *                                      *
 *                                      *
 * Source Language: JavaScript          *
 * License: MIT License 2.1             *
 *                                      *
 * Copyright (C) 2016 College Mobile    *
 * All rights reserved.                 *
 *                                      * 
 ****************************************/

/**
  * @type : Contructor
  * @param : command {SEQCommand} - command object for the sequencer 
  * @return : this {Object} - the instance object of IMS_Sequencer
  * @desc : Makes available the instance of the sequencer for use with the Player Core for dealing with navigation requests 
  */
function IMS_Sequencer(command){
  
  this.context = new AICC_ScriptContext(command);
  
  var preProcessScript = function(s){
        var entitiesMap = {
	       '&amp;':'&',
		   '&lt;':'<',
		   '&gt;':'>'
	    };
  },
  waitAndLaunchSCOResource = function(setup){
      var basePath = w.SSR.APP_HOST + "/"; 
	  w.SSR.consoleLog("Currently Launching SCO resource...");
      w.frames["runtime"].location.href = (setup.PLAYER_URL)+"?sco_title="+(setup.TITLE)+"&sco_path="+(basePath+w.SMConfig.courseRootDir+(setup.LAUNCH_URL+setup.PARAMS)); 
	  /* @REM: still trying to justify the use of "encodeURIComponent();" here */
  },
  getPrerequisitesResult = function(script){
       w.SSR.consoleLog("Trying to detect AICC Prerequisite for this SCO...");
	   var result = false;
       if(script===""){
	       // if there weren't any prerequisites defined in the 'imsmanifest.xml' file, just pass the attempt to launch the SCO
		   w.SSR.consoleLog("No AICC Prerequisite found for this SCO resource!");
	       return !result; 
	   }
	   w.SSR.consoleLog("Yes AICC Prerequisite found for this SCO resource!");
       var parser = new AICC_ScriptParser(script, this.context);
	   w.SSR.consoleLog("Parsing AICC Prerequisite scripts...");
	   try{
	        result = parser.parse();
	   }catch(ex){ 
	        w.SSR.consoleLog("AICC_ScriptParser Error: " + ex.message); 
	        alert("This course cannot play because something went wrong. \n Please contact the admin for further directions"); 
	   }	  
	   w.SSR.consoleLog("Terminating AICC Prerequisite Parser... and returning {Boolean} result!");
	   parser.terminate();
	   return result;
  };
  /**
    * @type : Method
    * @param : details {Object} -  
	* @param : opsdata {Object} -
	* @param : setup {Object} -
    * @return : {Undefined} - 
    * @desc :  
    */
  this.execNavigationRequest = function(details, opsdata, setup){
      	w.SSR.consoleLog("currently executing request: "+details.REQUEST_TYPE);
	    switch(details.REQUEST_TYPE){
		     case "START":
			   case "FLOW":
			   case "CHOICE":
			      if(getPrerequisitesResult.call(this, setup.SCRIPT)){
				      // this means that all prerequisites were passed and we can proceed to launch the SCO
				      delete setup.SCRIPT;
					    waitAndLaunchSCOResource(setup);
					    return this.initStore(details.REQUEST_HANDLE, opsdata);
				    }else{
				      // report back to the engine core of (SSR) that prerequisites failed!!
				      return !!(E.emit("dropLaunch", {"script":false}));
				    }
			 break;
			 case "EXIT":
			    if(!w.closed){	
				    // setup relevant promise callbacks
					  promise.then(function(s){					
			           w.close();
				    });
					// according to the SCORM specs, only SCOs have the right to communicate 
          // with the Host Learning Software via the SCORM API adapter
					// We are simply making sure that we keep to this rule

            if(w.SSR.HAS_COM_RIGHTS){		
                  w.SSR.resetGlobals("HAS_COM_RIGHTS");	
                  w.frames["runtime"].location = w.SSR.APP_HOST + "/c_app/views/learn/scorm/synergixe.html";
		              //command.saveStateData(); // persist the $stateProvider data to LMS database (not for now though)
		              setTimeout(function(){
	                      w.API && w.API.LMSFinish("");
			                promise.resolve("");
                  }, 500);							   
            }else{
	                promise.resolve("");
	          }
            return;					
				}
			 break;
		}
  };
  
  /**
    * @type : Method
    * @param : {Null} - nothing 
    * @return : {Boolean} - status flag to show the context object has been refreshed
    * @desc :  
    */
  this.resetSequenceContext = function(){
       this.context.refresh();
  };
  
  /**
    * @type : Method
    * @param : name {String} - 
	* @param : object {Object} -
    * @return : {Boolean} - status flag to show the context object has benn refreshed
    * @desc :  
    */
  
  this.initStore = function(name, object){
      // notify 'player[1_2/2004].html' that request for learner data has begun...
	  w.SSR.CMI_REQUEST_START = true;
      return command.getStorageContent(name, object);
  };

  return this;
}

$cdvjs.createClass("IMS_Sequencer_1_2", IMS_Sequencer, {
    toString:function(){
	    return "[object IMS_Sequencer]";
	}
}); 

}(this, this.document));







 