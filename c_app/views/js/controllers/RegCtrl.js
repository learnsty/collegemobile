
mainApp.controller ('Registration', ['$scope', '$http', 'UserService','$localStorage','$cookieStore', function($scope, $http, User, $localStorage, $cookieStore){

   if($cookieStore.get('activate')!='undefined'){
	$scope.activate= $cookieStore.get('activate');
   }
   
   $scope.changephone = function(){

	document.getElementById('user_phone').disabled=false; 
	document.getElementById('change_phone').value='1';
   }
   $scope.activatephone = function(){
		$('.loader').show();   
		
   		//$('.result').hide();
		phone = document.getElementById('user_phone').value;
		email = document.getElementById('user_email').value;
		change_phone= document.getElementById('change_phone').value;
		reg_type = document.getElementById('reg_type').value;
		$http.get(User.dirlocation+"/c_app/Api/ConnectApi.php?registersendsms="+phone+"&email="+email+"&register_type="+reg_type+"&change_phone="+change_phone)
              .then(function(response) {
				  alert(response.data);
				$('.loader').hide();  
				
				
              })
              .error(function() {
                alert('Poor Internet connection!');
                
              })
              .finally(function() {
				 alert(response.data); 
                $done();
              });
			  
	
		
	}		
}])