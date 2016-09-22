/** CMI data model Database -- SCORM version 2004 **/
/* TODO: url to visit soon (30/04/2015) 
       {http://scorm.com/tincanoverview/} 
       {http://scorm.com/scorm-explained/technical-scorm/sequencing/sequencing-pseudo-code/}
*/
(function (w, d){
        // basic module imports...
    var E = $cdvjs.Application.command("emitter"),
        Ca = $cdvjs.Application.command("cachestore"),
        T = $cdvjs.Application.command("tools"),
        U = $cdvjs.Application.command("utils"),
		/* @REM: 'cmi' is the root namespace of the AICC CMI data model and it really doesn't have a representation such as 'cmi._children' being part of the set for 2004 spec.*/
		SConfig = w.SMConfig,
		
        cmiChildKey = "._children",
        cmiCountKey = "._count",
        cmiWithChild = {
        	"cmi.score": "scaled, raw, min, max",
        	"cmi":"_version, mode, credit, scaled_passing_score, progress_measure, exit, entry, completion_status, completion_threshold, location, launch_data, learner_preference, learner_id, learner_name, max_time_allowed", 
            "cmi.objectives": "id, score, success_status, completion_status, description, _count, _children",
            "cmi.student_data": "mastery_score, time_limit_action, _children",
            "":"",
            "cmi.comments_from_learner": "_children, _count",
			"cmi.comments_from_lms":"_count, _children, comment, location, timestamp,",
            "cmi.interactions": "_count, _children",
			"cmi.learner_preference":"audio_level,language,delivery_speed,audio_captioning"
        },
		/**
         * Regular grammar definitions for simple CMI Data Type tokens/vocabularies/values
         * - this will be use to differentiate correct data model
         * - values from incorrect/corrupted values
         *
         * @desc : Regular expression map!!
         */
        cmiValueTypes = { 
		    "CMIBlank:":/^(.?)$/,
			"CMIBoolean":/^(?:"(true|false)")$/,
			"CMIVocabulary_IntrcType":/^(?:true-false|choice|fill-in|matching|performance|sequencing|likert|numeric)$/, // this deals with 'cmi.interactions.{n}.type' data
            "CMIVocabulary_IntrcResult":/^(correct|worng|unanticipated|neutral|(-?[0-9]{0,3}(\.[0-9]{1,2})?))$/, // this deals with 'cmi.interactions.{n}.result' data
        	"CMIFeedback":/^(?:\{?[a-zA-Z0-9,]{0,255}\}?)$/, // structured description of a students' response to an interaction
        	"CMIIdentifier":/^(?:[a-zA-Z0-9]{1,255})$/,  // maximum allowed size for a {CMIIdentifier} is 255 characters (same as CMIString255)!!
        	"CMIInteger":/^\+?(?:[0-9]|[1-9][0-9]{1,3}|[1-6][0-5][0-5][0-3][0-6])$/, // (+0 <---> +65536) positive integer data format for CMI whole number values
			"CMISInteger":/^[-+]?(?:[0-9]|[1-9][0-9]{1,3}|[1-3][0-2][0-7][0-6][0-8])$/, // (-32768 <---> +32768) signed integer data format for CMI whole number values
            "CMITime":/^(?:([0-1][0-9]|[2][0-4])\:([0-5][0-9])\:([0-5][0-9](\.[0-9]{1,2})?))$/, // a chronological point in a 24 hour clock
        	"CMIDecimal":/^-?(?:[0-9]{0,3}(?:\.[0-9]{1,2})?)$/, // signed real number data format for CMI floating point
        	"CMIString255":/^(?:[\w-, .]{1,255})$/,  /* CMIString255 - 255 characters */
			"CMIString4096":/^(?:[\w- ]{1,4069})$/,  /* CMIString4096 - 4096 characters */
            "CMITimespan":/^(?:([0-9]{2,4})\:([0-5]{1}[0-9]{1}\:([0-5]{1}[0-9]{1}(\.[0-9]{1,2})?)))$/,
        	"CMIVocbulary":/^(?:no-credit|credit|no comment|passed|incomplete|resume|ab-initio|contnue,no message|exit,message|continue,message|normal|suspend|not attempted|logout|browse|review|time-out|(.?))$/,
        	"CMIAny":/^(?:.*)$/ // Not a standard CMI data type, fills in for (Multiple Combination) types (Hey, neccessity is the mother of invention right ?)
        },
        cmiWithCount = {
        	"cmi.objectives": "0",
        	"cmi.interactions": "0",
			"cmi.comments_from_learner": "0",
			"cmi.comments_from_lms": "0"
        },
		space = " ",
		noop = ["", "", ""],
        dot = ".",
		// The below are defined according
		// to the AICC CMI001 v4.0 Interoperability Guidelines
		cmiStorageMatrix = {
        	"cmi._version":{
                 data:"4.0",
        		 type:"CMIDecimal",
        		 read:true,
        		 write:false     
        	},
			"cmi.launch_data":{
			     data:"",
				 type:"",
				 read:true,
				 write:false,
			},
			"cmi.learner_id":{
			     data:"",
				 type:"",
				 read:true,
				 write:false
			}, 
			"cmi.learner_name":{
			     data:"",
				 type:"",
				 read:true,
				 write:false
			},
			"cmi.learner_preference.audio_level":{
			     data:"",
				 type:"",
				 read:true,
				 write:true
			},
			"cmi.learner_preference.display_speed":{
			     data:"",
				 type:"",
				 read:true,
				 write:true
			},
			"cmi.learner_preference.language":{
			     data:"",
				 type:"",
				 read:true,
				 write:true
			},
			"cmi.learner_preference.audio_captioning":{
			     data:"",
				 type:"",
				 read:true,
				 write:true
			},
			"cmi.mode":{
			     data:"",
				 type:"CMIVocabulary",
				 read:true,
				 write:false
			},
			"cmi.location":{
			     data:"",
				 type:"CMIString",
				 read:true,
				 write:true
			},
			"cmi.max_time_allowed":{
			     data:"",
				 type:"CMITime",
				 read:true,
				 write:false
			},
			"cmi.progress_measure":{
			     data:"",
				 type:"CMIDecimal",
				 read:true,
				 write:true
			},
			"cmi.scaled_passing_score":{
			     data:"",
				 type:"CMIDecimal",
				 read:true,
				 write:false
			},
			"cmi.session_time":{
			     data:"",
				 type:"CMITimespan",
				 read:false,
				 write:true
			},
			"cmi.success_status":{
			     data:"",
				 type:"CMIVocabulary",
				 read:true,
				 write:true
			},
			"cmi.suspend_data":{
			     data:"",
				 type:"CMIVocabulary",
				 read:true,
				 write:true
			},
			"cmi.time_limit_action":{
			     data:"",
				 type:"CMIVocabulary",
				 read:true,
				 write:false
			},
			"cmi.total_time":{
			     data:"",
				 type:"CMITimespan",
				 read:true,
				 write:false
			},
        	"cmi.exit":{
                 data:"",  
        		 type:"CMIVocabulary",
        		 read:false,
        		 write:true
        	},
			"cmi.credit":{
			     data:"",
				 type:"CMIVocabulary",
				 read:true,
				 write:false
			},
			"cmi.entry":{
			     data:"",
				 type:"CMIVocabulary",
				 read:true,
				 write:false
			},
			"cmi.completion_status":{
			     data:"",
				 type:"CMIVocabulary",
				 read:true,
				 write:true
			},
			"cmi.completion_threshold":{
			     data:"",
				 type:"",
				 read:true,
				 write:false
			}
		},
		adlNavigationMatrix = {
		   "adl.nav.request":{},
		   "adl.nav.request_valid.continue":{},
		   "adl.nav.request_valid.previous":{},
		   "adl.nav.request_valid.choice_*":{},
		   "adl.nav.request_valid.jump_*":{}
		},
		complexCMIPrefix = /^cmi\.(interactions|objectives)\.(?:[\d]+)/,
		complexCMIExtension = new RegExp(complexCMIPrefix.source+"\\.(score(?:\\.(scaled|raw|min|max))?|description|progress_measure|completion_status|success_status|id|objectives|weighting|student_response|result|latency|correct_reponses|time|type)$"),
	    isValidValue = function(){
		
		},
		getSimpleChildren = function(){
		
		},
		getSimpleCount = function(){
		
		};
	
	    function CMIStorage = function(){
		
		};
	
	    $cdvjs.createClass("CMIStorage", 
           CMIStorage,{
                constructor:CMIStorage,
                toString:function(){
                     return (this.constructor).toString();
                },
                valueOf:function(){
                      return "[object CMIStorage]";     
                }
        });
		
	/*!
	  No Error (0) No error occurred, the previous API call was successful.
      General Exception (101) No specific error code exists to describe the error. Use GetDiagnostic for more information.
      General Initialization Failure (102) Call to Initialize failed for an unknown reason.
      Already Initialized (103) Call to Initialize failed because Initialize was already called.
      Content Instance Terminated (104) Call to Initialize failed because Terminate was already called.
      General Termination Failure (111) Call to Terminate failed for an unknown reason.
      Termination Before Initialization (112) Call to Terminate failed because it was made before the call to Initialize.
      Termination After Termination (113) Call to Terminate failed because Terminate was already called.
      Retrieve Data Before Initialization (122) Call to GetValue failed because it was made before the call to Initialize.
      Retrieve Data After Termination (123) Call to GetValue failed because it was made after the call to Terminate.
      Store Data Before Initialization (132) Call to SetValue failed because it was made before the call to Initialize.
      Store Data After Termination (133) Call to SetValue failed because it was made after the call to Terminate.
	  Commit After Termination (143) Call to Commit failed because it was made after the call to Terminate.
      General Argument Error (201) An invalid argument was passed to an API method (usually indicates that Initialize, Commit or Terminate did not receive the expected empty string argument.
      General Get Failure (301) Indicates a failed GetValue call where no other specific error code is applicable. Use GetDiagnostic for more information.
      General Set Failure (351) Indicates a failed SetValue call where no other specific error code is applicable. Use GetDiagnostic for more information.
      General Commit Failure (391) Indicates a failed Commit call where no other specific error code is applicable. Use GetDiagnostic for more information.
      Undefined Data Model Element (401) The data model element name passed to GetValue or SetValue is not a valid SCORM data model element.
      Unimplemented Data Model Element (402) The data model element indicated in a call to GetValue or SetValue is valid, but was not implemented by this LMS. In SCORM 2004, this error would indicate an LMS that is not fully SCORM conformant.
      Data Model Element Value Not Initialized (403) Attempt to read a data model element that has not been initialized by the LMS or through a SetValue call. This error condition is often reached during normal execution of a SCO.
      Data Model Element Is Read Only (404) SetValue was called with a data model element that can only be read.
      Data Model Element Is Write Only (405) GetValue was called on a data model element that can only be written to.
      Data Model Element Type Mismatch (406) SetValue was called with a value that is not consistent with the data format of the supplied data model element.
      Data Model Element Value Out Of Range (407) The numeric value supplied to a SetValue call is outside of the numeric range allowed for the supplied data model element.
      Data Model Dependency Not Established (408) Some data model elements cannot be set until another data model element was set. This error condition indicates that the prereq
	
	*/
}(this, this.document));	