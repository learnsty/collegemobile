/* Main Script file - Copyright (c) 2016 CollegeMobile */

;(function(w, d){

var handle_query = function(aspect, url){
         // variable hoisting
         url = url || d.location.search;
         if(typeof(aspect) == "string"){
              url = url.replace(/^\?/,"");
              var q = url.split("&");
              for(var k=0; k < q.length; k++){
                  if(q[k].indexOf(aspect) != -1)
                     return w.decodeURIComponent(q[k].substring(q[k].indexOf("=")+1));
              }
         }
         return null;
  },

  settings = {
    "student":handle_query("studentId"),
    "course":handle_query("courseId")
  }

  options = {
        page:0,
        id:"pdf-view",
      	pdfOpenParams: {
          navpanes: 0,
      		toolbar: 0,
      		statusbar: 0,
      		pagemode: "thumbs",
      		view: "FitV"
      	},
	      PDFJS_URL: "./js/pdfjs/web/viewer.html",
        forcePDFJS:false
},

status = w.PDFObject.supportsPDFs,

myPDF = w.PDFObject.embed(handle_query("open"), d.getElementsByTagName("section")[0], options);



}(this, this.document));