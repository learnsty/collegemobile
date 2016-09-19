mainApp.controller('StudentCtrl', ['$scope', '$http','$location', 'UserService','$localStorage', function($scope, $http, $location, User, $localStorage){
      
    $scope.UserDetails = JSON.parse($localStorage.UserDetails);
   
    
    return $http.get("http://"+User.dirlocation+"/c_app/Api/ConnectApi.php?level=200")
    .then(function(response) {
    $scope.courseware=response.data.courseware;
    return {courseware: response.data.courseware};

  },function errorCallback(response) {

    alert("Poor Internet Connection. Please Check your Wifi/Mobile Settings.");
    //alert(response.status);
    
    return response.status;
    });
    //$scope.person=$scope.crew[$routeParams.id];
    
    
   
    
    
}]);
