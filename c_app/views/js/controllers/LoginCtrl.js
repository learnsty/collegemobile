
mainApp.controller ('Login', ['$scope', '$http', 'UserService','$localStorage','$cookieStore', function($scope, $http, User, $localStorage, $cookieStore){
   if($cookieStore.get('activate')!='undefined'){
	$scope.activate= $cookieStore.get('activate');
   }
   	//$cookieStore.remove('activate');
   
	$scope.loginuser = function(){
    $('.loader').show();   
    $('.result').hide();
    var formData = new FormData($('#login')[0]);  
    //var fetch = JSON.parse(formData);
    $.ajax({
         url: 'http://'+User.dirlocation+'/app/Api/ConnectApi.php',
         type: 'POST',
         data: formData,
         async: false,
         cache: false,
         contentType: false,
         enctype: 'multipart/form-data',
         processData: false,
         success: function (response) {
		
		if(response=='invalid'){
	   	$('.result').addClass('alert-danger');       
		$('.result').show();     
		$('.result').html("Invalid username or password! Please try again");
		$('.loader').hide();  
		}
		else{
			
		$cookieStore.remove('activate');
		$cookieStore.remove('currentuser');
		var today = new Date();
		var expired = new Date(today);
		expired.setDate(today.getDate() + 1); //Set expired date to tomorrow
		$cookieStore.put('currentuser', response, {expires : expired });
		alert($cookieStore.get('currentuser'));
			
		setTimeout(function(){ 
		window.location.href='http://'+User.dirlocation+'/dashboard/';
		//$location.path("/dashboard");
		//$scope.$apply(); 
		}, 1000);
		}
           
            
         }
       });    
        
    }		
	
}])