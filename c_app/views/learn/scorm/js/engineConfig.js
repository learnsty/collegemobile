/*!
 * {SCORM_Config_Definitions}
 */

(function(w, d){

     var U = $cdvjs.Application.command("utils"),
     getStatus = function(v){
	     return ("on" === v)? true : false;
	 },
     SCORMConfig = function(obj){
              
    /******************************
     *-- Basic Controls         --*
     ******************************/
    
    this.debugModeEnabled = getStatus(obj["debug"]);
    this.debugOutputSetup = "console"; // you can set this up to "window" as well but this may be offensive to your LMS users. it is recommeded that you don't change it!
    this.studentName = obj["studentName"];
    this.studentID = obj["studentId"];
	this.creditForCourse = getStatus(obj["credits"]); // whether or not the instructor is willing to award credit to a student or trainee for taking a course
	this.modeForCourse = null; // {{ this is still a strict experimental config option and it is disabled for this version of SSR! }}
    
    /******************************
     *-- Nav Controls           --*
     ******************************/
    
    this.ObeyNavPresentation = true;
    this.prevActivityText = "Previous Activity";
    this.nextActivityText = "Next Activity";
    
    /******************************
     *-- Launch Controls        --*
     ******************************/
    
    this.useOneOrganization = true; // make use of only the default learning path/ course aggregation per session
	// possible vocabulary ---> "single" , "multi"
    this.scoLaunchContext = "both"; // 'single' SCO course OR 'multiple' SCO course OR 'both'
    this.scoTypesAllowed = ['HTML','SWF','COMBO'];
    this.autoLauchFirstSCO = true; // set to {false} if you wish that the student/user should initiate navigation request for the first SCO 
    // this.rteWindowSettings = {"width":970, "height":560, "x,y":[0,0], "screenoffset":0};
    
    /******************************
     *-- Course Controls        --*
     ******************************/
    
    this.courseRootDir = obj["courseRootDir"];
    this.courseID = obj["courseId"];
    this.courseManifestFileName = "imsmanifest.xml"; // this config is always the same most of the time
	this.markCompletedAsFrozen = false; // this config is to stop a SCO which has been previously experienced from overwriting its status of 'passed' OR 'completed' OR 'browsed' to any other status value
	this.completionByUserAccess = true; // this config is to (allow/disallow) the student complete the SCO by just accessing it only
    this.showCourseCompletionStatus = true; // show the completion progress at the footer of SSR viewport
    this.showCourseSuccessStatus = true; // show the success progress at the footer of SSR viewport
    
    /******************************
     *-- Data Transport Controls -*
     ******************************/
    
    // possible vocabulary ---> "persistent" , "volatile"
    this.storageMediaType = "persistent"; // persistent storage media include one of the following --> {cookies, server DB, localStorage}
    this.transportVerbs = ["CMI_POST", "CMI_GET", "STATE_POST"];
    this.saveDataURL = "http://www.collegemobile.net/scorm/tracking/scormset"; // URL path to Tracking DB for saving CMI data
    this.collectDataURL = "http://www.collegemobile.net/scorm/tracking/scormget"; // URL path to Tracking DB for retrieving CMI data
    this.saveDataOnDirty = true; // save data whenever the CMI database is flagged 'dirty' (i.e on every call to {LMSSetValue} / {SetValue})
    
    /******************************
     *-- Activity Controls      --*
     ******************************/
    this.hideTOC = false; // set to {true} if you wish to hide the Table Of Contents (TOC)
	// possible vocabulary ---> "treeview" , "accordion"
    this.displayTOCType = "treeview"; // you can also set this to "accordion" if you wish to collape and expand the TOC at a horizontal fold point, however, "accordion" type is not yet supported in SYNERGIXE SCORM RUNTIME (SSR) v1.1
    this.statusTOCImages = {"completed":"./images/completed.png","incomplete":"./images/notcompleted.png","passed":"./images/success.png","failed":"./images/fail.png","not_attempted":"./images/","unknown":""}
   
    };
     
    $cdvjs.createClass("SCORMConfig",
       SCORMConfig,
       {
          constructor:SCORMConfig,
          toString:function(){
                return (this.constructor).toString();
          },
          valueOf:function(){
                        
          }
    });

}(this, this.document));
