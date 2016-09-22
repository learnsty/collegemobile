/*!
 * @project: <synergixe - SynLMS>
 * @file: <parseManifest.js> - 
 * @author: <https://team.synergixe.com.ng>
 * @created: <04/03/2015>
 * @desc: {this implements the SCORM runtime manifest file parser}
 * @remarks: {SCORM PARSER v1.2}
 * @contributors: { @patrick, @chris, @dominic }
 */
 
/* 

  PREAMBLES 
================================

 -- SAMPLE MANIFEST -- SCORM 1.2
 
 SCORM VERSIONs ---> 1.2, CAM 1.3 (SCORM 2004 1st Edition), SCORM 2004 2nd Edition, SCORM 2004 3rd Edition, SCORM 2004 4th Edition
 
 SCORM 1.2 - imsmanifest.xml
 
<manifest default="" version="" xmlns="http://www.imsglobal.org/xsd/imscp_rootv1p2">
   <metadata>
        <schema> ADL SCORM </schema>
        <schemaversion> 1.2 </schemaversion>
   </metadata>
   <organizations default="ORG-ITEM-001" >
       <organization identifier="ORG-ITEM-001" structure="hierachical">
            <title>Photoshop --- Tutorials </title>
            <item identifier="ITEM-001" identifierref="RES-001" parameters="">
                  <title>Introduction</title>
            </item>
            <item identifier="ITEM-002" isvisible="true">
                  <title>Basics</title>
                  <item identifier="ITEM-002-SUBITEM-001" identifierref="RES-002" isvisible="true" parameters="">
                      <title>Basics 001</title>
                  </item>
                  <item identifier="ITEM-002-SUBITEM-002" identifierref="RES-003" isvisible="true" parameters="">
                      <title>Basics 002</title>
                  </item>
            </item>
            <item identifier="ITEM-003" isvisible="true">
                   <title>Presentation</title>
                   <item identifier="ITEM-003-SUBITEM-001" identifierref="RES-004" isvisible="true" parameters="">
                      <title>Presentation 001</title>
                  </item>
                  <item identifier="ITEM-003-SUBITEM-002" identifierref="RES-005" isvisible="true" parameters="">
                      <title>Presentation 002</title>
                  </item>
            </item>
       </organization>
   </organizations>
   <resources default="RES-GROUP-001">
       <resource identfier="RES-001" adlcp:scormtype="sco" xml:base="contents/" type="webcontent" href="index_lms.html">
             <file href="index_lms.html" />
             <file href="index_lms.swf" />
			 <dependency identifierref="RES-005" />
       </resource>
       <resource identfier="RES-002" adlcp:scormtype="sco" xml:base="contents/" type="webcontent" href="second_lms.html">
              <file href="second_lms.html" />
              <file href="second_lms.swf" />
       </resource>
       <resource identifier="RES-003" adlcp:scormtype="sco" xml:base="contents/" type="webcontent" href="third_lms.html">
            <file href="third_lms.html" />
            <file href="third_lms.swf" />
			<dependency identifierref="RES-005" />
       </resource>
	   
	   <!--
	      ### This is a <resource> definition that can infact be referenced by a <dependency> definition ### 
		  
	      <resource identifier="RES-005" adlcp:scormtype="asset" xml:base="" type="webcontent">
		      <file href="" />
			  <file href="" />
		  </resource>
	   -->
	   
   </resources>
</manifest>


FIRSTLY, TRANSFORMED TO ---> JSON DOCUMENT MODEL (JDM)
 

'{ \
	"manifest":{ \
		 "$attrs":{"default":"","version":"","xmlns":"http://www.imsglobal.org/xsd/imscp_rootv1p2"}, \
		 "metadata":{ \
		 	  "$attrs":{}, \
		 	  "schema":{ \
		 	  	 "$attrs":{}, \
		 	     "$text":"ADL SCORM" \
		 	  }, \
              "schemaversion":{ \
              	 "$attrs":{}, \
                 "$text":"1.2" \
              }, \
              "imsmd:lom":{ \
              	"$attrs":{}, \
	            "imsmd:general":{ \
	                "$attrs":{}, \
	                "imsmd:title":{ \
	                    "$attrs":{}, \
	                    "imsmd:langstring":{ \
	                         "$attrs":{"lang":"en-US"}, \
                             "$text":"Genral LOM" \
	                    } \
	                } \
	            } \
              } \
		 }, \
		 "organizations":{ \
		 	 "$attrs":{"default":"ORG-ITEM-001","structure":"heirachical"}, \
             "organization":{ \
	                 "$attrs":{"identifier":"ORG-ITEM-001","structure":"hierachical"}, \
                     "item":{ \
	                     "$attrs":{"identifier":"ITEM-001","identifierref":"RES-001","isvisble":"true"}, \
	                     "title":{ \
	                         "$attrs":{}, \
	                         "$text":"Introduction" \
	                     } \
                     }, \
                     "title":{ \
                         "$attrs":{}, \
                         "$text":"Photoshop --- Tutorials" \
                     }, \
                     "item":{ \
	                     "$attrs":{"identifier":"ITEM-002"}, \
	                     "title":{ \
	                         "$attrs":{}, \
	                         "$text":"Basics" \
	                     }, \
	                     "item":{ \
	                         "$attrs":{"identifier":"ITEM-002-SUBITEM-001","identifierref":"RES-002","isvisible":"true"}, \
                             "title":{ \
                                 "$attrs":{}, \
                                 "$text":"Basics 001" \
                             } \
	                     }, \
                         "item":{ \
                             "$attrs":{"identifier":"ITEM-002-SUBITEM-002","identifierref":"RES-003","isvisible":"true"}, \
                             "title":{ \
                                 "$attrs":{}, \
                                 "$text":"Basics 002" \
                              } \
                         } \
                     }, \
                     "item":{ \
                           "$attrs":{"identifier":"ITEM-003"}, \
                           "title":{ \
                                "$attrs":{}, \
                                "$text":"Presentation" \
                            } \
                         } \
                     } \
		 }, \
		 "resources":{ \
              "$attrs":{"default":""}, \
	          "resource":{ \
                   "$attrs":{"identifier":"RES-001","adlcp:scromtype":"sco","xml:base":"content\/","type": "webcontent","href":"index_lms.html"}, \
                   "file":{ \
                       "$attrs":{"href":"xsaf.swf"} \
                   }, \
                   "file":{ \
                       "$attrs":{"href":"baseline.html"} \
                   } \
              }, \
              "resource":{ \
                  "$attrs":{"identifier":"RES-002","adlcp:scromtype":"sco","xml:base":"content/","type": "webcontent","href":"second_lms.html"} \
              }, \
              "resource":{ \
                 "$attrs":{"identifier":"RES-003","adlcp:scromtype":"sco","xml:base":"content/","type": "webcontent","href":"third_lms.html"} \
              } \
		 } \
	} \
}'


THEN, TRANSFORMED TO ---> ACTIVITY TREE MODEL (ATM)

                   (root/cluster Activity) -- (key = "Photoshop --- Tutorials")
                          |                -- (depthlevel = "0")
                          |                -- (isLeaf = "false")
                          |                -- (hasParent = "false")
                          |
                          |
                          |
                          V  
     ---------------------------------------------------------------------------
     |                    |                                                    |
     |                    |                                                    |
     |                    |                                                    |
     |                    |                                                    |
     |                    |                                                    |
     V                    |                                                    |
(child/leaf Activity)     |                                                    |
-- (key = "Introduction") |                                                    |
-- (isLeaf = "true")      |                                                    |
-- (hasParent = "true")   |                                                    |
-- (depthlevel = "1")     |                                                    |
                          |                                                    |
                          V                                                    |
             (child/cluster Activity)                                          |
               -- (key = "Basics")                                             |
               -- (isLeaf = "false")                                           |
               -- (hasParent = "true")                                         |
               -- (depthlevel = "1")                                           |
                          |                                                    |
                          |                                                    |
                          |                                                    |
                          |                                                    V
                          |                                         (child/cluster  Activity)
                          |                                          -- (key = "Presentation")
                          |                                          -- (isLeaf = "false")
                          V                                          -- (hasParent = "true")
            -------------------------------                          -- (depthlevel = "1")
            |             |               |                                     |
            |             |               |                                     |
            |             |               |                                     |
            |             |               |                                     |
            |             |               |                                     |
            |             |               |                                     |
            |             |               |                                     |
            V             |               |                                     |
                          |               |                                     |
                          |               |                                     V
                          |               |
                          |               |
                          |               |
                          |               |
                          |               |
                          |               |
                          |               |
                          |               |
                          V               |
                                          |
                                          |
                                          |
                                          |
                                          V
 
 
 FINALLY, TRANSFORMED TO ---> TABLE OF CONTENTS (TOC)
       
   <ul class='tree-joint joint-closed'>
        <li class='anchor anchor-open'><a class='tree-title tree-root title-bold'><span class='place-holder'>Photoshop --- Tutorials</span></a>
           <ul class='tree-joint'>
                <li class='no-anchor'><a href='javascript:void(0);' class='tree-title tree-leaf auto-launch' aria-launch-href='#'><span class='place-holder'>Introduction</span></a></li>
                <li class='anchor anchor-closed'><a class='tree-title tree-branch title-bold'><span class='place-holder'>Basics</span></a>
                      <ul class='tree-joint joint-closed'>
                           <li class='no-anchor'><a href='javascript:void(0);' class='tree-title tree-leaf' aria-aicc-masteryscore='80' aria-aicc-maxtimeallowed='1300:00:00' aria-launch-href='#' aria-activity-id='' aria-href-parameters='?id=set'><span class='place-holder'>Basics 001</span></a></li>
                           <li class='no-anchor'><a href='javascript:void(0);' class='tree-title tree-leaf' aria-aicc-datafromlms='' aria-aicc-masteryscore='100' aria-launch-href='#' aria-activity-id='' aria-href-parameters='?id=set'><span class='place-holder'>Basics 002</span></a></li>
                      </ul>
                </li>
                <li class='anchor anchor-open'><a href='javascript:void(0);' class='tree-title tree-branch title-bold'><span class='place-holder'>Presentation</span></a>
                      <ul class='tree-joint'>
                         <li class='no-anchor'><a href='javascript:void(0);' class='tree-title tree-leaf' aria-aicc-datafromlms='' aria-launch-href='#' aria-activity-id='' aria-href-parameters='?id=set'><span class='place-holder'>Presentation 001</span></a></li>
                         <li class='no-anchor'><a href='javascript:void(0);' class='tree-title tree-leaf' aria-aicc-datafromlms='' aria-launch-href='#' aria-activity-id='' aria-href-parameters='?id=set'><span class='place-holder'>Presentation 002</span></a></li>
                      </ul>
                </li>
           </ul>
        </li>
  </ul>
  
  Details
  -------
  * All <li> tags who are direct parents of all .tree-root(s) and .tree-branch(s) are expandable and will have animations for the 'height'
    property attached to them. However, <li> tags that are direct parents of .tree-leaf(s) are non-expandable
  
  * All .tree-joint(s) will have click event handlers attached to them via event delegation from root parent <ul> and if click events bubble 
    up to them then, they should effectively "stopPropagation" of such click event. 
  
 !===========================================================================!
 
HTML VIEW OF (TOC), WHEN ATTACHED TO THE DOM (for 'runtime.html')
|_ 
   V Photoshop --- Tutorials
        |_
          > Introduction
 
          V Basics
		    |_
               > Basics 001
               > Basics 002

          V Presentation
		    |_
               > Presentation 001
               > Presentation 002
**/
       


(function(w, d){

var T = $cdvjs.Application.command("tools"),
    
Tree = $cdvjs.Application.getDataStruct('Tree'),

Stack = $cdvjs.Application.getDataStruct('Stack'),

Queue = $cdvjs.Application.getDataStruct('Queue'),
    
XMLReader = (function(){

            /*!
			 * making use of the Module pattern
			 */
			
            // Define success status sets
			
            // returns whether the HTTP request was successful
            function IsRequestSuccessful(httpRequest) {
                    // IE: sometimes 1223 instead of 204
					w.SSR.consoleLog("request is completly done ---> "+httpRequest.status);
                    var success = (httpRequest.status === 0 || 
                         (httpRequest.status >= 200 && httpRequest.status < 300) || 
                          httpRequest.status === 304 || httpRequest.status === 1223);
    
                    return success;
            }			
			// Define basic xhr service
			function CreateXHRObject() {
			             w.SSR.consoleLog("creating XHR object for reading manifest file");
                        // although IE supports the XMLHttpRequest object, but it does not work on local files.
                        var forceActiveX = (w.ActiveXObject && w.location.protocol === "file:");
                        if (w.XMLHttpRequest && !forceActiveX) {
                                return new w.XMLHttpRequest();
                        }else{
                              try {
                                 return new w.ActiveXObject("Microsoft.XMLHTTP");
                              }catch(e) {
							     return new w.ActiveXObject("Msxml2.XMLHTTP");
							  }
                        }
                        w.SSR.consoleLog("This browser doesn't support XML handling!");
                        return null;
            }
             
             // ajax fetch functionality (XML)
             // XML data goes here...
             var rds = "onreadystatechange",
			     setType = function(headerText){
				     if (headerText.match('xml')) return 'xml';
					 if (headerText.match('json')) return 'json';
					 if (headerText.match('html')) return 'html';
					 return '';
				 },
			     XMLAjax = function(options){
                     var xhr = CreateXHRObject();
					 if(xhr === null){
					      alert("Error: SCORM Manifest XMLReader failed!");
						  return;
					 }
					 
					 if(options.dataType == 'xml'){
					     if(xhr.overrideMimeType){
						     xhr.overrideMimeType('text/xml'); // for old Firefox
						 }
					 }
					 
					 options.url = options.url+(options.data? "?"+options.data : "");
					 
                     options.url = options.url+(options.cache? "" : (!options.data? "?" : "&")+"timeburst="+(new Date()).getTime()); 
					 
					 xhr.open(options.type, options.url, options.async);
					 
					 // a couple of xmlhttp headers to set for this request         
            
                     xhr.setRequestHeader("Content-Type", options.contentType);
                     xhr.setRequestHeader("X-Requested-With","XMLHttpRequest");
                     xhr.setRequestHeader("If-Modified-Since", "Sat, 1 Jan 2000 00:00:00 GMT");  // Fixes IE re-caching problem
					 xhr.setRequestHeader("Accept", "application/xml");
					 
					 xhr.send("");	
					 
					 // this function is called repeatedly
					 xhr[rds] = function(){
					 
                                  var rState = this.readyState;
								 
								 if(rState === 2){
									 if(typeof(options.beforeSend) === 'function') 
                                           options.beforeSend(this);  
                                 }
                
				                 if(rState === 4){ 
								        xhr[rds] = null;
								        if(IsRequestSuccessful(this)){
										    if(setType(this.getResponseHeader('Content-Type')) === options.dataType){
											      options.success(this, this.statusText);
												  return;
										    }
										     
											if(setType(this.getResponseHeader('Content-Type')) === 'html'){
											     options.success(this, this.statusText);
											}
									    }else{
									        options.error(this, this.statusText);
									    }
										xhr = null;
								 }
					};
            },
			
            normaliseErrorResponse = function(response){
                 if(response.parseError){
				     // code to go here...
				 }
            };
             
             return {
                read:function(file, options){
                     XMLAjax({
                           url:file,
                           type:"GET",
                           async:true,
                           cache:false,
                           dataType:'xml',
                           context:options.context,
                           contentType:'text/plain',
                           beforeSend:function(xhr){
                               options.beforeSend.call(this.context, xhr);
                           },
                           timeout:4000,
                           success:function(xhr, statusText){
						       
                               var xmlDoc = (xhr.responseXML && xhr.responseXML.documentElement && xhr.responseXML.documentElement.nodeName != "parsererror")? xhr.responseXML : T.xml_parse(xhr.responseText, false);
                               // ----------
							   
                               options.always.call(this.context, xmlDoc);
                           },
                           error:function(xhr, statusText){
						       var xmlErr = (xhr.responseXML && ((xhr.responseXML.parseError && xhr.responseXML.parseError.errorCode != 0) || (xhr.responseXML.documentElement && xhr.responseXML.documentElement.nodeName == "parsererror")))? xhr.responseXML : T.create_xml_doc("parseerror" /*, ""*/); 
                               //xmlErr = normaliseErrorResponse(xmlErr);
							   
							   options.always.call(this.context, xmlErr);
                           }
                    });
                }
             }
}()),
getPrivateData = function(id, data, basic){
    if(basic === 0){          
        return parserObjectStore[id]["basic_data"][data];
	}else if(basic === 1){
	    return parserObjectStore[id]["tree_data"][data];
	}
},
numOfOrganizations = 0,
numOfResources = 0,
numOfSchemaVersions = 0,
numOfSchemas = 0,
parentID = "",	
metaDataCue = "",			  
adlInstructionMap = { 
   "resumeAllIdentifiers":null,
   "globalObjectives":{},
   "suspendedGlobalObjectives":null
},
ADLPrefix = /^adl(cp|nav)\:/,
IMSPrefix = /^imsss\:/,
parserObjectStore = {},
buildTrees = function(obj){

    var mainQueue = new Queue(),
        treesQueue = new Queue(),
		adjacencyStack = new Stack(),
        currenttree,
        activitytree,
        temptree,
		data,
        child,
		pushSentinel = false,
        dot = ".",
        regxItem = /^(?:(imscp\:)?item([\d]+))$/,
        regxOrg = /^(?:(imscp\:)?organization([\d]+))$/,
        catcher = ["", null],
        self = this,
        ancestorID = "organizations",
		currentDepth = 0,
		elementsToDepthIncrease = 1,
		nextElementsToDepthIncrease = 0,
        rootsSetupFlag = false,
		adjacencyMatrix = {},
		currAdjacencyID = "",
        tempitems,
        activityid,
        treeRootNum = 0, // '0' is a falsy value # type coersion
		computePath = function(graph, start, end){
		   /*var visited = [],
		       path = [],
			   vertex,
			   queue = [];
			   
			   queue.push([start]);
			   
			   while(queue.length){
			   
			   }*/
			   
			   /* return queue; */
			   return [start, String((new Date()).getTime()), end];
		},
        createTree = function(items, currID){
            
                var each,
				    lastKey,
					itemAtr,
					_temp,
					InstrData,
					InstrTle,
					precedenceKey,
				    path, 
                    newItems = {},
					activityID = items["activityID"],
					attributes = items["$attrs"],
					itemID = attributes["identifier"],
					idref = attributes["identifierref"],
                    title = (items["title"] || {"$text":"Unknown Activity - SCO"}),
					resetToEntryState = function(){
						  precedenceKey = (precedenceKey.split(dot, 2)).join(dot);
					      if(precedenceKey !== lastKey){
								lastKey = precedenceKey.replace(dot+lastKey, "");
								precedenceKey = lastKey;
						  }
					};
					

				if(title["$text"] === "Unknown Activity - SCO"){
				     throw new Error("SSR Error: invalid manifest file");
				}
				
				
				if(!(adjacencyMatrix.hasOwnProperty(currID))){
				     if(idref){
					     // now, we are very sure that this is a leaf, so, we compute the path to the leaf node from the root node!
                         path = computePath(adjacencyMatrix, ancestorID, currID);
				         path.splice(0,1);
                         path = path.join(".");
				         adlInstructionMap[ancestorID][path] = {};	 
					 }
				}
				
                // remove all trace of now unwanted data ... going forward
                delete items["$attrs"];
            
                delete items["title"];
				
				delete items["activityID"];
            
                if(rootsSetupFlag){ // check if root trees have been setup
                    
                     for(each in items){
                         
                         if(({}).hasOwnProperty.call(items, each)){
                         
                             switch(each.toLowerCase()){ // SCORM 2004 tagNames have uppercase letters, so watch out!!
                                     
                                  /* ADL Content Pacaging CMI Extension data extraction -- If available, the Run-time Env needs to make these available to the launched course (SCO)!! */
                                  case "adlcp:masteryscore":
                                  case "adlcp:datafromlms":
                                  case "adlcp:prerequisites":
                                  case "adlcp:maxtimeallowed":
                                  case "adlcp:completionthreshold":
                                  case "adlcp:timelimitaction":
                                    if(idref){ // if(path)
                                        attributes[each.replace(ADLPrefix, "")] = items[each]["$text"];
                                    }
                                  break;
								  /* (SCORM 2004) ---> data extraction for Navigaton Presentation instructions to modify the Runtime Env UI -- If available, the Runtime Env needs to execute these upon each SCO launch */
								  case "adlnav:presentation":
								    if(idref){
								        lastKey=each; precedenceKey = lastKey; InstrData = (InstrData || {});
										InstrData[itemID] = {};
								        T.inflate({}, items[each], true, function(val, key){
										             if(key === "$attrs" || key.indexOf("imsss:") === -1){
													      return;
													 }
										            itemAtr = val["$attrs"]; 
													if(key.indexOf("adlnav:navigationinterface") > -1){
													     resetToEntryState();
													     if(lastKey === each){
														     InstrData[itemID]["interface"] = {"continue":true,"previous":true,"exit":true,"exitAll":true,"abandon":true,"abandonAll":true,"suspendAll":true};
														 }else{
														     throw new Error("<adlnav:navigationInterface>");
														 }
													}
													if(key.indexOf("adlnav:hidelmsui") > -1){
													     if(lastKey === "adlnav:navigationinterface"){
														      InstrData[itemID]["interface"][val["$text"]] = false;
														 }
													}
												
												 return val;
										});
									    adlInstructionMap[ancestorID]["navigation"][itemID] = InstrData[itemID];
									}	
								  break;
								  
                                  /* (SCORM 2004) ---> data extraction for IMS Simple Sequencing Instructions -- If available, the Runtime Env needs to make these available to the system (LMS)!! */
                                  case "imsss:sequencing":
								      if(idref){
								        lastKey=each; precedenceKey = lastKey; InstrData = (InstrData || {});
								        InstrData[itemID] = {};
										T.inflate({}, items[each], true, function(val, key){
										             if(key === "$attrs" || key.indexOf("imsss:") === -1){
													      return;
													 }
										             itemAtr = val["$attrs"];
													
													   
											        if(key.indexOf("imsss:controlMode") > -1){
													     resetToEntryState();
														 w.SSR.consoleLog(" ??????????? "+lastKey);
													     if(lastKey === each){
														      InstrData[itemID]["mode"] = itemAtr;
															  //adlInstructionMap[ancestorID]["sequencing"][itemID]["mode"] = InstrData[itemID]["mode"];
														 }else{
														      throw new Error("SSR Error: <"+key+"> tag cannot be defined in its current position within the hierachy under <"+each+">");
														 }
													}
											   
												    if(key.indexOf("imsss:sequencingRules") > -1){
                                                           resetToEntryState();							
                                                           if(lastKey === each){
														        InstrData[itemID]["rules"] =  {};
																InstrData[itemID]["rules"]["seq"] = {};
																//adlInstructionMap[ancestorID]["sequencing"][itemID]["rules"] = InstrData[itemID]["rules"];
														   }else{
														        throw new Error("SSR Error: ");
														   }													
                                                           lastKey = key;
                                                           precedenceKey += dot+lastKey;
													}
								                   
													if(key.indexOf("imsss:postConditionRule") > -1 || key.indexOf("imsss:preConditionRule") > -1){
													       if(lastKey === "imsss:sequencingRules"){
														       InstrData[itemID]["rules"]["seq"][(key.replace("itionrule", ""))] = [];
															   //adlInstructionMap[ancestorID]["sequencing"][itemID]["rules"]["seq"] = InstrData[itemID]["rules"]["seq"];
														   }
													       lastKey = key;
                                                           precedenceKey += dot+lastKey;
													}
													
													if(key.indexOf("imsss:ruleConditions") > -1){
													       if(lastKey === "imsss:preConditionRule" || lastKey === "imss:postConditionRule"){
														       InstrData[itemID]["rules"]["seq"][(lastKey.replace("itionrule",""))][0] = [];
															   //adlInstructionMap[ancestorID]["sequencing"][itemID]["rules"]["seq"][(lastKey.replace("itionrule",""))] = InstrData[itemID]["rules"]["seq"][(lastKey.replace("itionrule",""))];
														   }
													       lastKey = key;
                                                           precedenceKey += dot+lastKey;
													}
													
													if(key.indexOf("imsss:ruleCondition") > -1){
													       if(lastKey === "imsss:ruleConditions"){
														        _temp = precedenceKey.substring(precedenceKey.indexOf(dot, 1), precedenceKey.indexOf(lastKey));
														        InstrData[itemID]["rules"]["seq"][(_temp.replace("itionrule",""))][0].push(itemAtr);
																
														   }
													       lastKey = key;
                                                           precedenceKey += dot+lastKey;
													}
													
								                    if(key.indexOf("imsss:ruleAction") > -1){
													       if(lastKey === "imsss:ruleConditions"){
														        _temp = precedenceKey.substring(precedenceKey.indexOf(dot, 1), precedenceKey.indexOf(lastKey));
														        InstrData[itemID]["rules"]["seq"][(_temp.replace("itionRule",""))][1] = itemAtr["action"];
															
														   }
													       precedenceKey = precedenceKey.split(dot, 2);
                                                           lastKey = precedenceKey[1];
                                                           precedenceKey = precedenceKey.join(dot);
													}
													
													if(key.indexOf("imsss:rollupRules") > -1){
													      resetToEntryState();
														  if(lastKey === each){
														      InstrData[itemID]["rules"] = (InstrData[itemID]["rules"] || {});
															  InstrData[itemID]["rules"]["rollup"] = itemAtr;
														  }else{
														      throw new Error("<"+key+"> tag cannot be defined in its current position within the hierachy under <"+each+">");
														  }
													}
													
													if(key.indexOf("imsss:deliveryControls") > -1){
													      resetToEntryState();
														  if(lastKey === each){
															   InstrData[itemID]["controls"] = itemAtr;
														  }else{
														      throw new Error("<"+key+"> tag cannot be defined in its current position within the hierachy under <"+each+">");
														  }
													}
													
													if(key.indexOf("adlseq:rollupConsiderations") > -1){
													     ;
													}
													
								                    if(key.indexOf("imsss:objectives") > -1){
													    resetToEntryState();
														w.SSR.consoleLog(" ??????????? "+lastKey);
														 if(lastKey === each){
															    InstrData[itemID]["objectives"] = {};
														 }else{
														      throw new Error("SSR Error: <"+key+"> tag cannot be defined in its current position within the hierachy under <"+each+">");
														 }
														 lastKey = key;
                                                         precedenceKey += dot+lastKey;
													}
								                    
													if(key.indexOf("imsss:objective") > -1 || key.indexOf("imsss:primaryObjective") > -1){
													     w.SSR.consoleLog(" ??????????? "+lastKey);
														 if(lastKey === "imsss:objectives"){			
                                                              _temp = itemAtr["objectiveID"];														 
														      InstrData[itemID]["objectives"][itemAtr["objectiveID"]] = {"useMeasure":Boolean(itemAtr["satisfiedByMeasure"]),"mappings":{}};
														      
														 }else{
														      throw new Error("SSR Error: <"+key+"> tag cannot be defined in its current position within the hierachy under <"+each+">");
														 }
														 lastKey = key;
                                                         precedenceKey += dot+lastKey;
													}
													
													if(key.indexOf("imsss:minNormalisedMeasure") > -1){
													     if(lastKey === "imsss:primaryobjective"){
														      InstrData[itemID]["objectives"][_temp]["minMastery"] = val["$text"];
														 }else{
														      throw new Error("SSR Error: <"+key+"> tag cannot be defined in its current position within the hierachy under <"+each+">");
														 }
														 
													}
													
													if(key.indexOf("imsss:mapInfo") > -1){
													     if(lastKey === "imsss:primaryObjective" || lastKey === "imsss:objective"){
														       adlInstructionMap["globalObjectives"] = {_temp:{}};
                                                               InstrData[itemID]["objectives"][_temp]["mappings"][itemAtr["targetObjectiveID"]] = {"readSatisfied":itemAtr["readSatisfiedStatus"],"writeSatisfied":itemAtr["writeSatisfiedStatus"],"readNormalised":itemAtr["readNormalisedMeasure"],"writeNormalised":itemAtr["writeNormalisedMeasure"]} 
														 }else{
														      throw new Error("SSR Error: <"+key+"> tag cannot be defined in its current position within the hierachy under <"+each+">");
														 }
														 precedenceKey = precedenceKey.split(dot, 2);
                                                         lastKey = precedenceKey[1];
                                                         precedenceKey = precedenceKey.join(dot);
													}
											
												return val;
										});
										adlInstructionMap[ancestorID]["sequencing"][itemID] = InstrData[itemID];
									}  
								  break;
                                  case "imsss:sequencingCollection":
								        ;
								  break;
								  case "imsss:objective":
								  case "imsss:controlMode":
								  case "imsss:rollupRules":
								  case "imsss:deliveryControls":
								  case "imsss:sequencingRules":
								  case "imscp:organization":
								  case "organization":
								         throw new Error("SSR Error: <"+each+"> tag not allowed in its current position within the hierachy");
								  break;
								  case "item":
								  case "imscp:item":
								      if(idref){
 									       throw new Error("SSR Error: <"+each+"> tag not allowed in its current position within the hierachy under <item> or <organization>");
									  }	   
								  break;
                                  default:
                                      newItems[each] = items[each];
                                  break;
                                     
                             }
                             
                         }
                    
                     }
             
			         attributes["depthcount"] = currentDepth;
			       
			         if(activityID){
                          // get the activity identity
                          attributes["activityid"] = activityID;	 
				     }
                        
                     activitytree = temptree = new Tree(attributes);
                    
				     if(title["$text"] !== "Unknown Activity - SCO")	
                         activitytree.node.key = title["$text"];
					 else	
                         activitytree.node.key = "-";
						
                     treesQueue.enqueue(activitytree);

                    
                     if(currenttree){ // if a current tree exists
                         
                          // attach the newly created tree above (temptree) to the current tree
                    
                          currenttree.attachTree(temptree);
                        
                     }
                    
                     items = newItems; // overwrite with {newItems} a.k.a (what has been filtered out)
                    
                    
                }
            
            return true;
        };
    
     
    mainQueue.enqueue([obj[ancestorID], ancestorID]);
	
    adlInstructionMap[ancestorID] = {};
	// Now, behold the ogbonge power of SCORM 2004 - SN (Sequencing and Navigation)!!!!
	adlInstructionMap[ancestorID]["sequencing"] = {};
	adlInstructionMap[ancestorID]["navigation"] = {};
	
    while(!(mainQueue.isEmpty())){
     
        data = mainQueue.dequeue();  // dequeue root [object-node, key] array (in first case scenario) or current [object-node,key] array or "" sentinel string
        
		if(typeof data !== "string"){
		       tempitems = data[0];
		
		       currAdjacencyID = data[1];
		}else{
		    
		      tempitems = data;
		}	   
      
        if(typeof tempitems === "string"){
            
            try{
        
                     // switch to the next tree in line, then, make it the current tree
                     currenttree = activitytree = treesQueue.dequeue();

					 
                
                     if(treeRootNum){
                
                             // we now need to update the activity trees array using {self}
            
                             self["activitytrees"].push(activitytree);
                         
                             --treeRootNum;
             
                     }
                  
              }catch(ex){
              
                    // i think the error should be rethrown... but, hold the thought... for now
                    w.SSR.consoleLog(ex.message);
                    
              }
        
        }else{
		
		    if(currAdjacencyID !== ancestorID){
			
			   // undo what you did initially...
			   pushSentinel = false; 
			   
			   nextElementsToDepthIncrease += (Array.filter(Object.keys(tempitems), function(value, index){
			             return ((value.indexOf("item") > -1) || (value.indexOf("organization") > -1));
			   })).length;
			   
			   if(nextElementsToDepthIncrease > 0){
			       adjacencyMatrix[currAdjacencyID] = [];
				   pushSentinel = true;
			   }
			   
			   createTree(tempitems, currAdjacencyID);
			   
			   if(--elementsToDepthIncrease === 0){
			       ++currentDepth;
				   elementsToDepthIncrease = nextElementsToDepthIncrease;
				   nextElementsToDepthIncrease = 0;
			   }
			   
			}else{
			      // This means we are about to process '<organizations>' data!!
				  delete tempitems["$attrs"];
				  w.SSR.consoleLog("***************** :"+currAdjacencyID);
				  pushSentinel = true;
			}
			   
               // at this point, we should just have only "item" and "organization" keys for which values on the object (tempitems) are children to be iterated below... 
			   // however, shine your eyes, as no tree will be created on the first run for "organizations" !!
            
               for(var item in tempitems){
         
                    child = tempitems[item];
                   
                    if(({}).hasOwnProperty.call(tempitems, item)){
                  
                           if((activityid = (item.match(regxItem) || item.match(regxOrg))) !== null){
						   
						      if(activityid.length > 1)
						           activityid = activityid[0].replace("imscp:", "");
							 	  
                               
                               if(item.indexOf("item") >= 0){
                               
                                   child["activityID"] = activityid;

                               }else if(item.indexOf("organization") >= 0){
                                   
                                   ++numOfOrganizations;
                                   
                                   if(w.SMConfig.useOneOrganization){
                                       
                                       if(numOfOrganizations > 1){
                                           
                                            numOfOrganizations = 1;
                                           
                                       }
                                       
                                   }
								   
								   child["activityID"] = activityid;
                               }
                      
                               mainQueue.enqueue([child, activityid]);
                      
                           }else{
						          // SSR does not honour <metadata> tags as well as it descendants which are found inside any <organization> tag!!
								  // SSR will 'ESCAPE' them all.
						          w.SSR.consoleLog("----------------- Escaped part: "+item);
						          // alert("Invalid Manifest file!");
						   }
                  
                     }
            
                }
            
			     if(pushSentinel){
				 
                      mainQueue.enqueue("");  // switch command sentinel!!
					  
					  pushSentinel = false;
					  
				 }
        }
        
        if(!rootsSetupFlag){
            
            treeRootNum = numOfOrganizations;
            
            rootsSetupFlag = true;
            
        }
    
    }
    
    return true;
    
},
buildData = function(obj, name, indent, depth){
        
        var attributes = obj["$attrs"], temp, self = this;
        
	    if(!name || typeof name == "undefined"){
                   name = "";
                   indent = "";
                   depth = 0;
	    }
		
		if(name == "metadata"){
		 
 		    metaDataCue = name;
			
		}
        
        if(name == "imsmd:general" || name == "general"){
            
            self["meta_data"][name] = {};
			self["meta_data"][name]["ATTR"] = attributes;
            
            parentID = name;
        }
		
		if(name == "imsmd:langstring" || name == "langstring"){
		    
			  if(parentID == "imsmd:general" || parentID == "general"){
			   
			        self["meta_data"][parentID][name] = {};
					self["meta_data"][parentID][name]["ATTR"] = attributes;
					
					parentID = name;
			   
			  }
		}
    
        if(name == "resources"){
            ++numOfResources;
            if(numOfResources > 1){
                throw new Error("SSR Error: can't have more than one <resources> tag in a manifest file");
            }
			parentID = name;
        }
        
       
        if(metaDataCue == "metadata"){
		
		    console.log("found it!  "+metaDataCue);
			if(name == "schema"){
				++numOfSchemas;
				
				self["parse_mode"] =  obj["$text"];
			}
			
			if(name == "schemaversion"){
				++numOfSchemaVersions;
				
				self["parse_version"] = parseFloat((obj["$text"] || "1").replace(/\d?[a-zA-Z]+/g, ""));
			}
			
			if(name == "adlcp:location"){
			    self['meta_data']['externalfile'] = obj["$text"];
			}
		}	
        
        
        
        if(name == "title"){
            
            if(parentID == "resource" || parentID == "lom:general" || parentID == "general"){
                
                self["meta_data"][parentID] = {};
				self["meta_data"][parentID]["title"] = obj["$text"];
                
            }
            
        }
		
		if(parentID == "resources"){
        
             if(/^(resource[\d]+)$/.test(name)){
            
                    parentID = (attributes["identifier"] || "");
            
					self["resources_data"][parentID] = {
						"xml:base":(attributes["xml:base"] || ""),
						"href":(attributes["href"] || ""),
						"type":(attributes["type"] || ""),
						"adlcp:scormtype":(attributes["adlcp:scormtype"] || ""),
						"files":[]
					}
            
             }
        
		}
		
        if(/^(file[\d]+)$/.test(name)){
            w.SSR.consoleLog("found file at ancestor: "+parentID);
            self["resources_data"][parentID]["files"].push(attributes["href"]);
        }
        
        
        var child;
		
        delete obj["$attrs"];
        
        for(var item in obj){
            if(({}).hasOwnProperty.call(obj, item)){
               
                child = obj[item];
                if(typeof child == "object" && !('length' in child)){
                    // object literals only here pls...
                    buildData.call(self, child, item, indent, depth + 1);
                    
                }else{
                    
                    w.SSR.consoleLog(child);
                }
            }
        }
    
},
retraceJSONWithTags = function(json, posters){
    var i, posr, rgx, bstr = "(", estr = ")(?=\\\"\\:)";
    for(var y=0; y < posters.length; y++){
        i = 0;
		posr = posters[y];
		if(posr === "item" || posr === "organization"){
		    posr = "(?:imscp\\:)?"+posr;
		}else if(posr === "hideLMSUI"){
		    posr = "(?:adlnav\\:)?"+posr;
		}else if(posr === "postConditionRule" || posr === "preConditionRule" || posr === "objective"){
		    posr = "(?:imsss\\:)?"+posr;
		}else if(posr === "metadata"){
		   // posr = "(?:lom\\:)?"+posr;
		}
        rgx = new RegExp((bstr+posr+estr), "g");
        json = json.replace(rgx, function(m0, m1){
            return m1+(++i);
        });
    }
	//alert("kkkkkkkkkk: "+json);
    return json;
},
$def,
ManifestParser = function(file){
     this.id = String((new Date).getTime());
     parserObjectStore[this.id] = {"instance":this,"tree_data":{"activitytrees":[]},"basic_data":{"resources_data":{},"meta_data":{},"manifest_file_name":file,"adl_instruction_data":adlInstructionMap}};
     $def = new $cdvjs.Futures();
     
	 var work = function(xmlDOM, complete){
		        
				  var jsnDoc = T.dom_to_json(xmlDOM, true)[0];
				  w.SSR.consoleLog(jsnDoc.substring(0, Math.floor(jsnDoc.length/2))+"\r\n\n");
				  w.SSR.consoleLog(jsnDoc.substring(Math.floor(jsnDoc.length/2)-1, jsnDoc.length)+"\r\n\n");
                  jsnDoc = T.json_parse(retraceJSONWithTags(jsnDoc, ["item", "organization", "preConditionRule", "postConditionRule", "ruleCondition", "objective", "hideLMSUI", "resource", "file"])); // exclude "metadata" from list
				  var Docroot = (jsnDoc["manifest"] || jsnDoc["parseerror"] || jsnDoc["loaderror"] || {});  // SCORM 1.2 / SCORM 2004 
                  if(Docroot["organizations"]){
                      buildTrees.call(parserObjectStore[this.id]["tree_data"], {"organizations":Docroot["organizations"]});
                      delete Docroot["organizations"];
                      buildData.call(parserObjectStore[this.id]["basic_data"], Docroot);
					  if(numOfOrganizations === 0 || numOfSchemas === 0 || numOfSchemaVersions === 0 || numOfResources === 0){
					      alert("SSR Error: SSR encountered a fatal error \n\nwhile reading the manifest file");
					  }
                  }else{
                      throw new Error("SSR Error: SSR has detected that you are accessing a malformed manifest file");
                  }
				  complete();
    }; 
    
    this.parse = function(){
        var self = this;
		$def.then(
		// resolution...
		function(c){
		     // termination of the parsing process...
			 w.SSR.consoleLog("parsing is terminated!");
		     // this.lockConfig();
		});
		XMLReader.read(self.getManifestFileName(), {
	               context:null, 
				   beforeSend:function(){ 
	                     w.SSR.consoleLog("Just about to request 'imsmanifest.xml' from the server");
	               },
				   always:function(c){
	                      // 'this' here is the {context} object which is 'null' (above)
			               var context = this;
							work.call(self, c, function(){
							      w.SSR.consoleLog("promise is resolving to cleanup parser");
							      $def.resolveWith(self, "");
							});
				            w.SSR.consoleLog("'imsmanifest.xml' has been succesfully loaded into SSR");
                   }
		});
    };
	
	this.lockConfig = function(){
	
	};
	 
    this.getActivityTrees = function(){
        return getPrivateData(this.id, "activitytrees", 1);
    };
    
    this.getMetadataStore = function(){
        return getPrivateData(this.id, "meta_data", 0);
    };
    
    this.getParseMode = function(){
        return getPrivateData(this.id, "parse_mode", 0);
    };
    
    this.getParseVersion = function(){
        return getPrivateData(this.id, "parse_version", 0);
    };
    
    this.getResourcesData = function(){
        return getPrivateData(this.id, "resources_data", 0);
    };
	
	this.getInstructionData = function(){
        return getPrivateData(this.id, "adl_instruction_data", 0);
    };
	
	this.cleanup = function(){
	     // avoid unnecessary memory leaks...
	     $def = buildTrees = buildData = numOfOrganizations = numOfSchemas = parserObjectStore = parentID = adlInstructionMap = retraceJSONWithTags = XMLReader = numOfSchemaVersions = numOfResources = ADLPrefix = getPrivateData = null;
	};
    
    this.getManifestFileName = function(){
        return getPrivateData(this.id, "manifest_file_name", 0);
    }
    
	this.parse();
    return this;
}
    
$cdvjs.createClass("ManifestParser",
    ManifestParser,
    {
                   constructor:ManifestParser,
                   toString:function(){
                      return "[object ManifestParser]";
                   },
                   valueOf:function(){
                      return (this.constructor).valueOf();
                   }
});                                                       
              
}(this, this.document));
