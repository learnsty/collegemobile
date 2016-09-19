mainApp.controller('DashboardCtrl', ['$scope', '$http','$location', 'UserService','$localStorage', function($scope, $http, $location, User, $localStorage){
	
	
    $scope.uploadpass = function(){
    $('.loader2').show();   
   // $('.result2').hide();
    //alert(User.dirlocation);
    var formData = new FormData($('#uploadpassport')[0]);  
	$.ajax({
         url: User.dirlocation+'/c_app/Api/ConnectApi.php',
         type: 'POST',
         data: formData,
         async: false,
         cache: false,
         contentType: false,
         enctype: 'multipart/form-data',
         processData: false,
         success: function (response) {
		//alert(response);
		$('.uploadbtn').hide();
		//if(response=='Product Saved successfully'){
		$('.loader2').hide();  
		//}
         }
       });    
        
    }	
	
	/*
	$scope.confirmrequest = function(){
	alert('yess');	
	$('.loader').show();  	
	$http.get(User.dirlocation+"/c_app/Api/ConnectApi.php?confirmrequestfrom="+requestfrom+"&requestto="+requestto)
              .then(function(response) {
				  alert(response.data);
				$('.loader').hide();  
				
				
              })
		
	}
	*/
   
}]);
