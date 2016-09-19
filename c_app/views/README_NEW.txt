//////////READ ME////////////
The project fully run on an MVC framework. This readme will guide you into knowing the folder structures and files.

FOLDER STRUCTURE:

////////Root Folder//////
COLLEGEMOBILE
 -c_app/
   -Api/
     -mailgun-php/
     -twilio-php-master-2/
     -vendor/
     -ConnectApi
     -index
     -smsandemail

   -Controllers/
      -activate.php 		(Controls user activation processes)
      -content.php  		(Controls content pages)
      -contentpartnerregister	(Controls registeration for content provider)
      -home			(controls home/index page)
      -learn			(Controls learn content)
      -login			(Controls user login)
      -logout			(Controls logout)
      -register			(Controls student and teachers registration)
      -teach			(Controls teach content) [depreciat
      -verify			(Controls verification)

   -Models/
       -ConnectModel		(Connection to the database)
       -CrudModel		(CRUD::: Create, Read, Update and Delete)
       -dashboardModel		(Controls connection from db and activities on the dashboard)
       -FilterModel		(Form fields filtering and data sactity)
       -indexModel		(Controls connection from db and activities on the index page)
       -LoginModel		(Controls User Login Activities and loginrequests)
       -MiscModel		(Miscelleneous request)
       -mobileAppModel		(Deliver request in JSON format for mobile App)
       -RegisterModel		(CRUD for user registration)

   -Views/
       -contentpartner/		(Containers all pages for content partners)
       -courseware/		(contains all uploaded courseware docs and images)
       -css/			(Contains all css)	
       -font-awesome/		(Contains all font-awesome files)
       -fonts/			(Contains font awesome files)
       -images/			(Contains all images)	
       -js/			(All js files)
       -learn/			(Contains all pages for students and teachers)
       -snipets/		(Contains header and footer for the index page)
       -teach/			(Contains all pages for teachers)[deprecated]
       -viewerjs/		(Folder for viewerjs library)
       -activate		activate.php page
       -contentpartnerregister	contentparternerregister.php page
       -index			(index.php page)[landingpage]	
       -favicon			favicon icon image
       -login			Login.php page

   -init.php
