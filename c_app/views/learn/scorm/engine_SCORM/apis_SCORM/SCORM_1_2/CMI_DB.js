/*!
 * @project: CollegeMobile
 * @desc: {this implements the SCORM computer managed instruction (CMI data) database to store learning data}
 * @remarks: {SCORM PERSISTENCE_LAYER v1.2}
 */
 
(function (w, d){

     Object.isEmpty = function(){
        for(var prop in obj) {
          if(obj.hasOwnProperty(prop))
               return false;
        }

        return true && ((new Function('return '+obj+';')()) === '{}');
     }

     // basic module imports 
    var E = $cdvjs.Application.command("emitter"),
        Ca = $cdvjs.Application.command("cachestore"),
        T = $cdvjs.Application.command("tools"),
        U = $cdvjs.Application.command("utils"),
    
     // other definitions...
     
        /*
         * A placeholder for a standard [Promises/A+] object for defering execution of code blocks 
         */      
        $promise = null,  
        /*
         * Preamble: In SCORM v1.2 specs, there is no specific guideline that directs developers on how
         *           to pass data between SCO sessions that help the SCO make decisions about a roll-up
         *           (overall course completion/success) strategy or sequencing strategy. Therefore,
         *           for SSR implemetaions, the $stateProvider object is used to persist shared data for
         *           SCOs which belong to a single content aggregation for a specific course package.
         */
        $stateProvider = (function(w, $i){
        
              var stateKey = "SSR10Wywg5gGD4743Ep02az3y8yf16D",
                  checkInit = function(){
                      return !(this.hasInit);
                  }; 
              
              return {
                   _init:function(stateObj){
                      try{
                          if(!$i.has_key(stateKey))
                              $i.store(stateKey, stateObj);
                       }catch(e){ w.SSR.consoleLog("$stateProvider encountered an error: [ "+e.message+" ]"); }
                       this.hasInit = true;
                   },
                   hasInit:false,
                   getState:function(activityid, dataelement){
                       if(checkInit.call(this)){ return; }
                         var sObj = $i.collect(stateKey);
                         if(activityid in sObj){
                             return sObj[activityid][dataelement];
                         }
                         return "not attempted";
                   },
                   saveState:function(){
                        if(checkInit.call(this)){ return; }
                        // persist to database!!
                        var data = T.json_stringify($i.collect(stateKey));
                        w.SSR.postChannel('{"cmi_control_flag":false, "cmi_timestamp_token":"'+T.get_time_string("MMDDYY")+'", "cmi_transport_type":"STATE_POST", "cmi_transport_data":'+data+'}');
                   },
                   setState:function(activityid, dataelement, value){
                         if(checkInit.call(this)){ return; }
                         var temp, sObj = $i.collect(stateKey);
                         
                         try{
                            // at other times
                             temp = sObj[activityid]["setCount"];
                             ++temp;
                             sObj[activityid][dataelement] = value;
                             sObj[activityid]["setCount"] = temp;
                         }catch(e){
                             // at the first time
                             if(!(activityid in sObj)){
                                sObj[activityid] = {};
                                temp = 1;
                                sObj[activityid]["setCount"] = temp; 
                             }  
                             sObj[activityid][dataelement] = value;  
                         }
                         $i.drop(stateKey);
                         $i.store(stateKey, sObj);
                         return temp;
                   }
              };
        }(w, Ca)),
        cmiChildKey = "._children",
        cmiCountKey = "._count",
        cmiWithChild = {
            "cmi.core.score": "raw,min,max",
            "cmi": "_version,core,objectives,interactions,student_data,suspend_data,student_preference,launch_data,comments,comments_from_lms", /* DONE: 'cmi' is the root namespace of the AICC CMI data model and really does have a representation as 'cmi._children' as part of the set */
            "cmi.objectives": "score,id,status",
            "cmi.student_data": "mastery_score,max_time_allowed,time_limit_action",
            "cmi.core":"score,credit,exit,entry,student_name,student_id,total_time,session_time,lesson_location,lesson_status,lesson_mode",
            "cmi.student_preference": "audio,language,speed,text",
            "cmi.interactions": "id,objectives,time,type,correct_responses,weighting,student_response,result,latency"
        },
        cmiWithCount = {
            "cmi.objectives": "0", // at the start of every SCO session, except where we have previously loaded that SCO, there are no objectives recorded!!
            "cmi.interactions": "0" // at the start of every SCO session, except where we have previously loaded that SCO, there are no interactions recorded (for knowledge checks, drag/drop simulations e.t.c) !!
        },
        localStorage = {},
        flagOpenAccess = false,
        space = " ",
        noop = ["", "", "", ""],
        dot = ".",
        /**
         * Takes in a {CMITimespan} string value and returns an integer
         * array of the values it contains, so that we can perform
         * some arithmetic
         *
         * @param : time {String} - CMI data model value {CMITimespan}
         * @return : bits {Array} - integer array of HH, MM, SS, (.S(S))?
         */
        parseTime = function(time){
             var result, bits = [0, 0, 0, 0];
             if(!time || typeof(time) == "undefined"){
                 return bits;
             }
             result = time.split(":");
             if(result.length <= 2 || result.length > 4){ // let it go if it is 3 or 4 or more 
                 throw new Error("CMI_DB write error: Invalid CMI data {CMITimespan}");
             }
             bits[0] = parseInt(result[0]);
             bits[1] = parseInt(result[1]);
             result = result[2];
             if(result.indexOf(dot) != -1){
                 result = result.split(dot);
                 if(result.length == 2){
                     bits[2] = parseInt(result[0]);
                     if(result[1].length == 1){
                         bits[3] = (parseInt(result[1])*10);
                     }else{
                         bits[3] = parseInt(result[1]);
                     }
                 }
             }else{
                  bits[2] = parseInt(result);
             }
             return bits;
        },
        /**
         * Utility method to add two {CMITimespan} values together.
         * - this will include "cmi.core.session_time" and "cmi.core.total_time"
         * - from the CMI data model
         *
         * RECOGNIZED FORMATS:
         * HHHH:MM:SS.SS
         * HHH:MM:SS.SS
         * HH:MM:SS.SS
         * HHHH:MM:SS.S
         * HHH:MM:SS.S
         * HH:MM:SS.S
         * HHHH:MM:SS
         * HHH:MM:SS
         * HH:MM:SS
         *
         * @param : oldSessionTime {String} - a CMI data model element [total_time]
         * @param : newSessionTime {String} - a CMI data model element [session_time]
         * @return : strTotalTime {String} - the sum of the old and new CMITimespan(s)
         */
        addCMITimes = function(oldSessionTime, newSessionTime){
           var strTotalTime,
               oldTimeArr = parseTime(oldSessionTime), // TODO: try/catch any calls to 'parseTime' method here an in any other place
               newTimeArr = parseTime(newSessionTime),
               today = new Date();
               oldSessionTime = new Date(today.getFullYear(), today.getMonth(), today.getDay(),oldTimeArr[0], oldTimeArr[1], oldTimeArr[2], oldTimeArr[3]);
               newSessionTime = new Date(today.getFullYear(), today.getMonth(), today.getDay(), newTimeArr[0], newTimeArr[1], newTimeArr[2], oldTimeArr[3]);
       
           var addH = newSessionTime.getHours(),
               addM = newSessionTime.getMinutes(),
               addS = newSessionTime.getSeconds(),
               addMS = getMilliseconds(newSessionTime),
               hrDiff = addH + oldSessionTime.getHours(),
               minDiff =  addM + oldSessionTime.getMinutes(),
               secDiff = addS + oldSessionTime.getSeconds(),
               msDiff = addMS + getMilliseconds(oldSessionTime);
       
               if(msDiff>=100){ msDiff = - (100 - msDiff); secDiff++; }
               if(secDiff>=60){ secDiff = - (60 - secDiff);  minDiff++; }
               if(minDiff>=60){ minDiff = - (60 - minDiff); hrDiff++; }
               if(hrDiff>=24){ hrDiff = - (24 - hrDiff);  }
               if(secDiff<10){ secDiff = "0"+secDiff; }
               if(minDiff<10){ minDiff = "0"+minDiff; }
               if(hrDiff<10){ hrDiff = "0"+hrDiff; }
       
                strTotalTime = hrDiff+":"+minDiff+":"+secDiff+"."+msDiff;
                
                return strTotalTime;
        },
        /**
         * Takes in a {CMITimespan} value and spits
         * out a valid milliseconds integer
         *
         * @param : time {String} - the CMI data model time value
         * @return : intMillis {Integer} - the actual milliseconds data
         */
        getMilliseconds = function(time){
             // - fixed browser-based error
             // (new Date).getMilliseconds() thinks [n:n:n.02] is equal to [n:n:n.20]
             // as both return .2 (was a tough nut to crack though - Yikes!!)
             var temp = time+"",
                 intMillis = 0;
       
             if(temp.indexOf(dot) != -1){
                  intMillis = parseInt(temp.split(dot)[1]);
             }
             return intMillis;
        },
        flatCMITimespan = "0000:00:00:00"
        ,
        flatCMITime = "0000:00:00"
        ,
        /**
         * Regular grammar definitions for simple CMI Data Type tokens/vocabularies/values
         * - this will be use to differentiate correct data model
         * - values from incorrect/corrupted values
         *
         * @desc : Regular expression map!!
         */
        cmiValueTypes = { 
            "CMIBlank":/^(.?)$/,
            "CMIBoolean":/^(?:\"(true|false)\")$/,
            "CMIVocabulary_IntrcType":/^(?:true-false|choice|fill-in|matching|performance|sequencing|likert|numeric)$/, // this deals with 'cmi.interactions.{n}.type' data
            "CMIVocabulary_IntrcResult":/^(correct|worng|unanticipated|neutral|(-?[0-9]{0,3}(\.[0-9]{1,2})?))$/, // this deals with 'cmi.interactions.{n}.result' data
            "CMIFeedback":/^(?:\{?[a-zA-Z0-9,]{0,255}\}?)$/, // structured description of a students' response to an interaction
            "CMIIdentifier":/^(?:[\w\S_]{1,255})$/,  // maximum allowed size for a {CMIIdentifier} is 255 characters (same as CMIString255)!!
            "CMIInteger":/^\+?(?:[0-9]|[1-9][0-9]{1,3}|[1-6][0-5][0-5][0-3][0-6])$/, // (+0 <---> +65536) positive integer data format for CMI whole number values
            "CMISInteger":/^[-+]?(?:[0-9]|[1-9][0-9]{1,3}|[1-3][0-2][0-7][0-6][0-8])$/, // (-32768 <---> +32768) signed integer data format for CMI whole number values
            "CMITime":/^(?:([0-1][0-9]|[2][0-4])\:([0-5][0-9])\:([0-5][0-9](\.[0-9]{1,2})?))$/, // a chronological point in a 24 hour clock
            "CMIDecimal":/^-?(?:[0-9]{0,3}(?:\.[0-9]{1,2})?)$/, // signed/unsigned real number data format for CMI floating point
            "CMIString255":/^(?:[\w\S\t\n\b]{1,255})$/,  /* CMIString255 - 255 characters */
            "CMIString4096":/^(?:[\w\S\t\n\b]{1,6500})$/,  /* CMIString4096 - 4096 characters */
            "CMITimespan":/^(?:([0-9]{2,4})\:([0-5]{1}[0-9]{1}\:([0-5]{1}[0-9]{1}(\.[0-9]{1,2})?)))$/, /* 0000:00:00.00 */
            "CMIVocabulary":/^(?:no-credit|credit|no comment|passed|incomplete|resume|ab-initio|continue,no message|exit,message|continue,message|normal|suspend|browsed|completed|failed|not attempted|logout|browse|review|time-out|(.?))$/,
            "CMIAny":/^(?:.*)$/ // Not a standard CMI data type, fills in for (Multiple Combination) types (Hey, neccessity is the mother of invention right ?)
        },
        specialCMIDataMap = {
            "weighting":"CMIDecimal",
            "student_response":"CMIFeedback",
            "result":"CMIVocabulay_IntrcResult",
            "latency":"CMITimespan",
            "status":"CMIVocabulary",
            "time":"CMITime",
            "type":"CMIVocabulary_IntrcType", 
            "correct_reponses":"CMIAny",
            "id":"CMIIdentifier",
            "raw":"CMIDecimal",
            "min":"CMIDecimal",
            "max":"CMIDecimal"
        },
        specialCMIChildMap = {
           "score":cmiWithChild["cmi.core.score"]
        },
        // The below are defined according
        // to the AICC CMI001 v3.4 Interoperability Guidelines
        cmiStorageMatrix = { 
            "cmi._version":{
                 data:"3.4",
                 type:"CMIDecimal",
                 read:true,
                 write:false     
            },
            "cmi.suspend_data":{
                 data:"",  
                 type:"CMIString4096",
                 read:true,
                 write:true
            },
            "cmi.launch_data":{
                 data:"",
                 type:"CMIString4096",
                 read:true,
                 write:false
            },
            "cmi.core.total_time":{
                 data:flatCMITimespan, //default; - "0000:00:00:00"
                 type:"CMITimespan",
                 read:true,
                 write:false
            },
            "cmi.core.session_time":{
                 data:"", // no need for initialization; - "00:00:00"
                 type:"CMITimespan",
                 read:false,
                 write:true
            },
            "cmi.core.entry":{
                 data:"ab-initio", // default - linked with lesson_status;
                 type:"CMIVocabulary",
                 read:true,
                 write:false
            },
            "cmi.core.student_id":{
                 data:"", // "1"
                 type:"CMIIdentifier",
                 read:true,
                 write:false
            },
            "cmi.core.student_name":{
                 data:"", // default; "Samuel,Joe" -- just a ficticious name (not my name!)
                 type:"CMIString255",
                 read:true,
                 write:false
            },
            "cmi.core.exit":{
                 data:"", // no need for initialization;
                 type:"CMIVocabulary",
                 read:false,
                 write:true
            },
            "cmi.core.lesson_location":{
                 data:"", // default;
                 type:"CMIString255",
                 read:true,
                 write:true
            },
            "cmi.core.lesson_status":{
                 data:"not attempted", // default;
                 type:"CMIVocabulary",
                 read:true,
                 write:true
            },
            "cmi.core.lesson_mode":{
                 data:"normal", // might be cahnged by LMSInitialize(); call
                 type:"CMIVocabulary",
                 read:true,
                 write:false
            },
            "cmi.core.score.raw":{
                 data:"",
                 type:"CMIDecimal",
                 read:true,
                 write:true
            },
            "cmi.core.score.min":{
                 data:"",
                 type:"CMIDecimal",
                 read:true,
                 write:true
            },
            "cmi.core.credit":{
                 data:"", // will be set "no-credit" or "credit" by LMSInitialize(); call
                 type:"CMIVocabulary",
                 read:true,
                 write:true
            },
            "cmi.core.score.max":{
                 data:"",
                 type:"CMIDecimal",
                 read:true,
                 write:true
            },
            "cmi.comments":{
                 data:"", // this may sometimes change - attributed to the student experiencing the course!
                 type:"CMIString4096",
                 read:true,
                 write:true
            },
            "cmi.comments_from_lms":{
                 data:"no comment", // this may never change - attributed to the instructor for the course/LMS!
                 type:"CMIString4096", 
                 read:true,
                 write:false
            },
            "cmi.student_data.mastery_score":{
                 data:"", 
                 type:"CMIDecimal",
                 read:true,
                 write:false
            },
            "cmi.student_data.max_time_allowed":{
                 data:"",
                 type:"CMITimespan",
                 read:true,
                 write:false
            },
            "cmi.student_data.time_limit_action":{
                 data:"",
                 type:"CMIVocabulary",
                 read:true,
                 write:false
            },
            "cmi.student_preference.audio":{
                 data:"0", // No change in status, Use defaults
                 type:"CMISInteger",
                 read:true,
                 write:true
            },
            "cmi.student_preference.language":{
                 data:"", 
                 type:"CMIString255",
                 read:true,
                 write:true
            },
            "cmi.student_preference.speed":{
                 data:"0", // SCO should move at it's normal speed
                 type:"CMISInteger",
                 read:true,
                 write:true
            },
            "cmi.student_preference.text":{
                 data:"0",
                 type:"CMISInteger", /* actually CMISInteger (signed integer) */
                 read:true,
                 write:true
            }
        },
        currActivityID = "",
        complexCMIPrefix = /^cmi\.(interactions|objectives)\.(?:[\d]+)/,
        complexCMIChild = new RegExp(complexCMIPrefix.source+"\\.(score)\\"+cmiChildKey+"$"),
        complexCMICount = new RegExp(complexCMIPrefix.source+"\\.(objectives|correct_responses)\\"+cmiCountKey+"$"),
        isComplexCMIElement = function(elem){
           return (elem && elem.search(complexCMIPrefix) === 0);
        },
        hasChildKey = function(element){
             return (element.indexOf(cmiChildKey) === element.lastIndexOf(dot));
        },
        hasCountKey = function(element){
             return (element.indexOf(cmiCountKey) === element.lastIndexOf(dot));
        },
        isComplexCMIArray = function(el){ 
              if(isComplexCMIElement(el)){
                  return (hasCountKey(el) && el.search(complexCMICount) === 0);
              } 
              return false;           
        },
        isNormalCMIArray = function(el){
                 var elm = el.replace(cmiCountKey, ""); // Shortcut for potential calls to {hasCountKey} remain DRY!!
                 return (!!cmiWithCount[elm]);
        },
        isComplexCMISList = function(el){ 
              if(isComplexCMIElement(el)){
                  return (hasChildKey(el) && el.search(complexCMIChild) === 0);
              } 
             return false;            
        },
        isNormalCMISList = function(el){
               var elm = el.replace(cmiChildKey, ""); // Shortcut for potential calls to {hasChildKey} remain DRY!!
               return (!!cmiWithChild[elm]);
        },
        complexCMIExtension = new RegExp(complexCMIPrefix.source+"\\.((?:score(?:\\.(raw|min|max))?|correct_responses(?:\\.[\\d]+\\.(pattern))?|objectives(?:\\.[\\d]+\\.(id)))|(?:status|id|weighting|student_response|result|latency|time|type))$"),
        checkCMIComplexElement = function(elem){
            elem = elem || space;
            var vl = null, result;
        
                if(!(hasCountKey(elem)) && !(hasChildKey(elem))){
                   result = (elem.match(complexCMIExtension) || noop);
                   if(result[1] === "interactions"){
                     switch(result[2]){
                         case "weighting":
                         case "student_response":
                         case "result":
                         case "latency":
                         case "time":
                         case "type": 
                         case "correct_responses":
                         case "id":
                            vl = result[2];
                         break;
                    } 
                    if(!vl){
                        if(result[2].search(/^objectives\.\d+\.id$/) > -1){
                             vl = result[6];
                        }else if(result[2].search(/^correct_responses\.\d+\.pattern$/) > -1){
                             vl = result[5];
                        }
                    }
                 }else if(result[1] === "objectives"){
                     switch(result[2]){
                         case "id":
                         case "status":
                         case "score":
                            vl = result[2];
                         break;
                         case "score.raw":
                         case "score.min":
                         case "score.max":
                            if(result[3]){
                                vl = result[3];
                            }
                         break;
                     }
                  }
               }else{
                   result = (elem.match(complexCMIChild) || elem.match(complexCMICount)  || noop);
                   if(result[1] === "interactions"){
                       switch(results[2]){
                          case "correct_responses":
                          case "objectives":
                            vl = cmiCountKey;
                          break;
                          case "score":
                            vl = cmiChildKey;
                          break;
                       }
                   }
               }
            return vl;
        },
        recallData = function(activityID){ // recalls/reads data from the LMS database (MySQL)
                  currActivityID = activityID;
                  var comma = '",', data = '{"activity":"'+activityID+comma+'"target_url":"'+w.SMConfig.collectDataURL+comma+'"student":"'+w.SMConfig.studentID+comma+'"course":"'+w.SMConfig.courseID+'"}';       
                  w.SSR.postChannel('{"cmi_control_flag":true, "cmi_timestamp_token":"'+T.get_time_string("MMDDYY")+'", "cmi_transport_type":"CMI_GET","cmi_transport_data":'+data+'}');
                  return true;
        },
        pushData = function(cmiData){
             var comma = '",', data = '{"activity":"'+currActivityID+comma+'"target_url":"'+w.SMConfig.saveDataURL+comma+'"student":"'+w.SMConfig.studentID+comma+'"course":"'+w.SMConfig.courseID+comma+'"json":'+cmiData+'}';       
             w.SSR.postChannel('{"cmi_control_flag":true, "cmi_timestamp_token":"'+T.get_time_string("MMDDYY")+'", "cmi_transport_type":"CMI_POST", "cmi_transport_data":'+data+'}'); 
             return true;
        },
        checkCMISimpleElement = function(element, suffix){
             var cmie, elem, resolve = {};
             if(typeof suffix == "string"){
                   cmie = (element.indexOf(suffix) === element.lastIndexOf(dot))? cmiStorageMatrix[element] : cmiStorageMatrix[(element+suffix)]; // either way (i.e. if {element} ends with either "_children" or "_count")
                   
                   if(!!cmie && suffix === cmiChildKey){ 
                        resolve.children = cmie;
                   }
                   else if(!!cmie && suffix === cmiCountKey){
                        resolve.count = cmie;
                   }
             }else{
                cmie = cmiStorageMatrix[element];
                if(cmie){
                    resolve = cmie;
                }
             }
             return resolve;
        },
        getSimpleChildren = function(element){
             return (checkCMISimpleElement(element, cmiChildKey).children);          
        },
        getSimpleCount = function(element){
            return (checkCMISimpleElement(element, cmiCountKey).count);
        },
        getComplexChildren = function(element){
            if(isComplexCMISList(element)){
                element = (element.replace(complexCMIPrefix, "")).replace(cmiChildKey, "").replace(dot, "");
                return specialCMIChildMap[element];
            }
            return "";
        },
        getComplexCount = function(element){
            if(isComplexCMIArray(element)){
                return (localStorage[element] || "0");
            }
            return "0";
        },
        isReadable = function(element){
           var result = true;
           if(flagOpenAccess){
               // bypass all read-only rules...
               return result;
           }
           
           if(isNormalCMIArray(element) || isNormalCMISList(element)){ // now, determine basic CMI elements with ._count and ._children
               return result;
           }
           
           if(isComplexCMIElement(element)){
               // all complex CMI data are readable ... e.g 'cmi.objective.3.score.raw' (where 3 is the serial number of an objective (array) in a SCORM quiz/assessment ---> {n})
               // however, complex CMI data for 'interactions' data are write-only (except for complex 'interactions' data with ._count and ._children)
               if(element.indexOf("interactions") > -1){
                    if(isComplexCMIArray(element) || isComplexCMISList(element)) 
                       return result; // those with 'interactions._count' and/or 'interactions._children' are readable...
                    else
                       return !result; // those with 'interactions.{n}.time' are not readable...
               }else if(element.indexOf("objectives") > -1){
                    return result; // readable...
               }
           }else{
               return !!checkCMISimpleElement(element).read;
           }   
           return !result;
        },
        isWritable = function(element){
           var result = true;
           if(flagOpenAccess){
               // bypass all write-only rules...
               return result;
           }
           if(isComplexCMIElement(element)){
               // all complex CMI data are writable... (except for those with '._count' OR '._children' at the end)  -- SCORM quiz/knowledge check/scenario --
               return !(isComplexCMIArray(element) || isComplexCMISList(element));     
           }else{
               return !!checkCMISimpleElement(element).write;
           }
           return !result;
        },
        isValidValue = function(element, value){
        
            var type, ext;
            if(typeof value === "number"){ value = String(value); }
            if(typeof value !== "string"){ return false; }
            
            if(!isComplexCMIElement(element)){
                 type = checkCMISimpleElement(element).type;
                 w.SSR.consoleLog("cmi type -> "+type);
                /* these below are for simple CMI data which are presented in the {matrix} as at runtime */
                /* normally CMI data for 'cmi.core.score.raw', 'cmi.core.score.min' AND 'cmi.core.score.max' is usually {CMIBlank} at other times {CMIDecimal} */ 
                  if((/^cmi\.core\.score\.(raw|min|max)$/).test(element)){
                        return (cmiValueTypes["CMIBlank"].test(value) || cmiValueTypes[type].test(value));
                  }else{
                        return cmiValueTypes[type].test(value);
                  }                    
            }else{
                 /* these below are for complex CMI data (e.g {cmi.objectives} and {cmi.interactions}) which are not present in the {matrix} as at the start of the SCO session */
                     if(isComplexCMIArray(element)){                 
                          return cmiValueTypes["CMIInteger"].test(value);
                     }else if(isComplexCMISList(element)){
                          return cmiValueTypes["CMIString255"].test(value);
                     }else{
                         if((ext = checkCMIComplexElement(element)) !== null){
                              return cmiValueTypes[specialCMIDataMap[""+ext]].test(value);
                         }else{
                              return !!0;
                         }  
                     }      
            }  
            
        },
        isValidCMIElement = function(element){
             var ext;
             if(isComplexCMIElement(element)){
                 ext = checkCMIComplexElement(element);
                 return !!(specialCMIDataMap[""+ext]);
             }else{
                 return !!(checkCMISimpleElement(element).type);
             }      
        },
        hasCount = function(element){
            if(!isComplexCMIElement(element))
                 return !!(getSimpleCount(element));
            else
                 return !!(getComplexCount(element));   
        },
        hasChildren = function(element){
            if(!isComplexCMIElement(element))
                 return !!(getSimpleChildren(element));
            else
                return !!(getComplexChildren(element));             
        },
        updateMatrix = function(){
             Object.each(cmiWithChild,
                function(child, cmielem){
                     cmiStorageMatrix[(cmielem+cmiChildKey)] = {data:child, type:"CMIString255", read:true, write:false};
             }, null);

            Object.each(cmiWithCount, 
                 function(child, cmikey){
                      cmiStorageMatrix[(cmikey+cmiCountKey)] = {data:child, type:"CMIInteger", read:true, write:false};
            }, null);
        },
        getValue = function(elem){
            var self = this;
            // @NOTE: before we get here (i.e in the flow of control from CMIStorage constructor), we must have certified the readablility and validity of the CMI data model 
            //        element {elem} which means that if the {elem} CMI model element is not set in the 'storage' object, then as SCORM prescribes,
            //        we return an empty string ("") ---> e.g in a situation where a given SCO is requesting objectives [id] without setting it first
            //        var objID = LMSGetValue("cmi.objectives.0.id"); # objID ---> ""
            return (self.sessionstorage[elem] || "");
        },
        setValue = function(elem, val){
        
            var temp, v, indx, label, self = this, is = function(data, atBegin){
                return (elem.indexOf((!!atBegin? (atBegin+dot+data) : (dot+data))) > -1);
            };
            
            // cmi.comments
            
            if(is("comments", "cmi")){
                temp = getValue.call(self, elem);
                val = temp + val;
            }
            
            // cmi.core.session_time
            
            if(is("session_time", "cmi.core")){
                    label = "cmi.core.total_time";
                    temp = addCMITimes((getValue.call(self, label)), val);
                    v = temp+"";
                    self.sessionstorage[label] = v;
                    w.SSR.consoleLog("SCO is just setting up 'session_time' and 'total_time' data");
            }
            
            // cmi.interactions.{n} ====> [xxxxxxxxx]
            
            if(is("interactions", "cmi")){
                /***** we will be modifying the below here to reflect the up-to-date size of the CMI interactions data array *****/
                // cmi.interactions ===> ._count
                // cmi.interactions.{n}.objectives.{n} ===> ._count
                // cmi.interactions.{n}.correct_responses ===> ._count
                if(isComplexCMIElement(elem)){
                     if(is("objectives")){
                        if(is("id")){
                            v = getValue.call(self, elem);
                            if(!v){
                                indx = elem.split(dot)[2];
                                label = "cmi.interactions."+indx+".objectives"+cmiCountKey;
                                temp = parseInt(getValue.call(self, label));
                                if(U.is_nan(temp)){
                                    temp = 0;
                                }
                                temp++;
                                v = temp+""; // shortcut to convert to string type
                                // circumvent read-only limitation
                                self.sessionstorage[label] = v;
                            }
                        }
                    }else if(is("correct_responses")){
                        if(is("pattern")){
                            v = getValue.call(self, elem);
                            if(!v){
                                indx = elem.split(dot)[2];
                                label = "cmi.interactions."+indx+".correct_responses"+cmiCountKey;
                                temp = parseInt(getValue.call(self, label));
                                if(U.is_nan(temp)){
                                    temp = 0;
                                }
                                temp++;
                                v = temp+""; // shortcut to convert to string type
                                self.sessionstorage[label] = v;

                            }
                          }
                        }else if(is("type")){
                              // cmi.interactions ===> type
                             cmiObjectStore[self.id]["instance_private_data"]["interaction_types"].push(val);
                             w.SSR.consoleLog("current SCO just sent in a new interactions type: "+val);
                        }else if(is("id")){
                             // cmi.interactions.{n} ===> id
                             v = getValue.call(self, elem);
                             if(!v){
                                  //if we get here, it means the SCO is sending in a new interaction for storage
                                  // so, firstly update the count for interactions, then, record the new interaction!
                                  label = "cmi.interaction"+cmiCountKey;
                                  temp = parseInt(getValue.call(self, label));
                                  if(U.is_nan(temp)){
                                         temp = 0;
                                  }
                                  temp++;
                                  v = temp+"";
                                  // circumvent read-only limitations
                                  self.sessionstorage[label] = v;
                             }
                        }
                }
            }
            
            // cmi.objectives.{n} ===> [xxxxxxxx]   
            
            else if(is("objectives", "cmi")){
                     /***** we will be modifying the below here to reflect the size of the CMI objectives data array */
                     // cmi.objectives ===> ._count
                     
                     label = "cmi.objective"+cmiCountKey;
                     // cmi.objectives.{n} ===> id
                     if(is("objectives")){ 
                        if(is("id")){
                            v = getValue.call(self, elem);
                            if(!v){
                                temp = parseInt(getValue.call(self, label))
                                if(U.is_nan(temp)){
                                    temp = 0;
                                }
                                temp++
                                v = temp+""; // shortcut to convert to string type
                                // circumvent read-only limitations
                                self.sessionstorage[label] = v;
                            }
                        }
                    }
                }
            
            self.sessionstorage[elem] = val; // direct sessionstorage access
            return val;
        },
        cmiObjectStore = {

        },
        installAvailable = function(data){
            var self = this;
            if(!data){  
                Object.each(cmiStorageMatrix, function(child, key){
                    this.sessionstorage[key] = child.data;
                }, self);
                return;
            }   
            if(data){
                Object.each(data, function(child, key){ // add data from SCO launch item (triggered by click) to the CMI local storage (DB)
                    if(key !== "launch_data"){
                        this.sessionstorage["cmi.student_data."+key] = child;
                    }else{
                        this.sessionstorage["cmi."+key] = child;
                    }   
                }, self);
            }
        };

        // update the {cmiStorageMatrix} with '._children' and '._count' initialization data
        updateMatrix();
        
        function CMIStorage(DBConfig){ 
           
             var self = this;
             self.id = String((new Date()).getTime());
             $promise = new $cdvjs.Futures();
             
             // when the ajax transport has returned with {data} from the LMS database, load {data} into localstorage
             w.SSR.offloadChannel(function(result, args){
                  
                  result = T.json_parse(result);
                 
                  if(result.type === "CMI_GET"){
                        if(!Object.isEmpty(result.data)){
                            //Object.empty(this.sessionstorage);
                            Object.each(result.data, function(val, key){
                                this.sessionstorage[key] = val;
                            }, self);
                        }else{
                             alert("Hmmm... It seems like this is your first\n attempt at this lesson for the current course.\n Press \"OK\" to continue");
                        }
                        
                        if(w.SSR.CMI_GET_RETURN === false){
                               if(!$stateProvider.hasInit){
                                   /* if {stateObject} from the LMS database contains nothing, we substitute with an empty object 
                                      literal, else, we should load it from the LMS database */
                                   $stateProvider._init((result.statedata||{}));
                               }
                               w.SSR.CMI_GET_RETURN = true;
                               w.SSR.consoleLog("CMI_GET just returned...");
                               // signal the player driver to load the current SCO!!
                               w.SSR.CMI_REQUEST_END = true;
                               /* 
                                  var fr = d.getElementById("runtime"),
                                  dc = (fr.contentDocument)? fr.contentDocument : fr.contentWindow.document; 
                                */
                               if(w.SSR.CMI_GET_RETURN === true){
                                    w.SSR.consoleLog("Hello Course!");
                                    w.SSR.resetGlobals("CMI_GET_RETURN");
                                    w.SSR.AdapterStatus = true;
                               }
                        }
                        
                  }else if(result.type === "CMI_POST"){
                  
                        if(w.SSR.CMI_POST_RETURN === false){
                             w.SSR.CMI_POST_RETURN = true;
                             w.SSR.consoleLog("CMI_POST just returned...");
                             $promise.notifyWith(self, result);
                        }    
                        
                        if(!self.allowTransport){
                              self.allowTransport = true;
                        }
                        
                  }
            });
             
            
            cmiObjectStore[self.id] = {"instance":self,"instance_private_data":{"interaction_types":[]}};
             // flag to signal when CMIStorage should engage a 'persistData' call (periodically)
             self.isDirty = false;
             // CMI data model store for all learning record data
             self.allowTransport = false;
             self.sessionstorage = sessionStorage;
             installAvailable.call(this, null);
          
             // these data model elements are read-only however, the LMS need to specify to the SCO on behalf of whom is the SCO launched
             self.sessionstorage["cmi.core.student_name"] = w.SMConfig.studentName;
             self.sessionstorage["cmi.core.student_id"] = w.SMConfig.studentID;
             
             self.setData = function(element, value){
                 var temp, set = {error:false,id:"0",data:""};
                 
                 if(typeof element != "string"){
                    w.SSR.consoleLog("Not string - set");
                    set.id = "101";
                    set.error = true;
                    return set;
                 }
                 
                 if(/[A-Z]/.test(element)){
                      set.error = true;
                      set.id = "101";
                      return set;
                 }
                 
                 if(isValidCMIElement(element)){
                     w.SSR.consoleLog(element+" is valid element!");
                    /* SCO is not allowed to set any CMI data model element that isn't {an array} */
                    if(hasCountKey(element) && !(hasCount(element))){
                        set.id = "203";
                        set.error = true;
                        return set;
                    }
                    
                    /* SCO is not allowed to set any valid CMI data model element that isn't {a parent} */
                    if(hasChildKey(element) && !(hasChildren(element))){
                        set.id = "202";
                        set.error = true;
                        return set;
                    }
                    
                    /* SCO is not allowed to (write to/set) any valid CMI data model element with '._version', '._children' or '._count' key!! (IMPOSSICABLE BY SCORM RULES!!) */
                    if((hasChildKey(element) && hasChildren(element))
                        || (hasCountKey(element) && hasCount(element)) || (element==="cmi._version")){
                          set.id = "402";
                          set.error = true;
                          return set;
                    }
                    
                    /* SCO is not allowed to (write to/set) read-only data model elements */
                    if(isWritable(element)){
                          if(element.search(/[\d]+\.id/) > -1){
                              w.SSR.consoleLog("value: ************* "+value);
                          }
                          w.SSR.consoleLog(element+" is writable!");
                        if(isValidValue(element, value)){
                            w.SSR.consoleLog(value+" is valid value!");
                            self.isDirty = true;
                            if(element.indexOf("lesson_status") > -1){
                                  temp = getValue.call(self, element);
                                  if(w.SMConfig.markCompletedAsFrozen){ // check the config
                                     set.data = ((temp.search(/^(passed|completed|browsed)$/) == 0) && value != "incomplete")? temp : setValue.call(self, element, value);                                    
                                  }else{
                                     set.data = setValue.call(self, element, value);
                                  }
                                  $stateProvider.setState(currActivityID, element, (set.data || value));
                            }else{
                                set.data = setValue.call(this, element, value);
                            }   
                                     
                            return set;
                        }else{
                            set.id = "405";
                            set.error = true;
                        }
                    }else{
                        set.id = "403";
                        set.error = true;
                    }
                 }else{
                    set.id = "201";
                    set.error = true;
                }
                  return set;
            };
                           
            self.getData = function(element){
                var set = {error:false, id:"0", data:""}, temp;
                
                w.SSR.consoleLog("cmi -> "+element);
                if(typeof element !== "string"){
                      w.SSR.consoleLog("Not string - get");
                      set.error = true;
                      set.id = "101";
                      return set;
                 }
                 
                
                 if(/[A-Z]/.test(element)){
                      w.SSR.consoleLog("Not lowercase");
                      set.error = true;
                      set.id = "101";
                      return set;
                 }
                 
                 if(isValidCMIElement(element)){
                 
                     // case: for CMI data model element(s) which are/is not suppossed to have a '._children' key -- and it has a '._children' key...
                     if(hasChildKey(element) && !(hasChildren(element))){
                         set.error = true;
                         set.id = "202";
                         return set;
                     }
                     
                     // case: for CMI data model element(s) which is not suppossed to have a '._count' key -- and it has a '._count' key...
                     if(hasCountKey(element) && !(hasCount(element))){
                         set.error = true;
                         set.id = "203";
                         return set;
                     }
                     
                     // case: for CMI data model element(s) that is readable...
                     if(isReadable(element)){
                        temp = getValue.call(self, element);
                        set.data = temp;
                     }else{
                        set.error = true;
                        set.id = "404";
                        return set;
                     }
                 }else{
                      set.error = true;
                      set.id = "201";
                      return set;
                 }
                 return set;
            };
           // restore CMI data from manifest file and load them into the sessionstorage... finally, recall CMI data from the LMS database (MySQL - if available)!!                
            self.restoreData = function(activityid, activitycmiobj){ 
                if(activitycmiobj){
                     w.SSR.consoleLog("Setting up CMI store with data model element values from manifest file");
                     installAvailable.call(self, activitycmiobj);
                }
                return recallData(activityid);
            };
            
            // persit data to the LMS database (MySQL)
            self.persistData = function(){  
                 // a 10 secs timeout... will be okay
                 var timeout = 10000, 
                 data = T.json_stringify(self.sessionstorage);
                 
              try{   
                 if(self.isDirty){
                      // notify the opener/parent window to engage ajax transport to send {data} to the LMS database!!
                      pushData(data);
                      // wait till the thread is free, this may mean that the data has reached the LMS database and returned
                      $promise.progress(function(data){
                               w.SSR.consoleLog("CMI_POST transport has returned with "+data.status+" status");
                               if(w.SSR.CMI_POST_RETURN === true){
                                    w.SSR.CMI_POST_RETURN = false;
                                    this.isDirty = false;
                               }
                       });
                 }
              }catch(e){
                 return false;
              }
                 return true;
            };
            
            self.provideState = function(activityid){
                 return $stateProvider.getState(activityid, "cmi.core.lesson_status");
            };
            
            self.dumpStorage = function(){
                  w.SSR.consoleLog("CMIStorage: DUMP> "+T.json_stringify(self.sessionstorage));
            };
        
            self.engageOpenAccess = function(){
                flagOpenAccess = true;
            };
            
            self.suspendOpenAccess = function(){
                flagOpenAccess = false;
            };
                           
            return self;
           
          };
        
        $cdvjs.createClass("CMIStorage_1_2", 
           CMIStorage,{
                constructor:CMIStorage,
                toString:function(){
                     return (this.constructor).toString();
                },
                valueOf:function(){
                      return "[object CMIStorage]";     
                }
          });

       // SAMPLE USAGE...
       // var CMIStorage = $cdvjs.getClass("CMIStorage");
       // var store = new CMIStorage({});
       // var errorStatus = store.setData("cmi.core.lesson_status", "failed");
       // var errorStatus = store.getData("cmi._version");

}(this, this.document));
