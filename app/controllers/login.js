//-var URL = "https://myicomp.com/erp/material";
app.controller('loginController', function($apiService,$scope,$http){
  
  $scope.title ="tribe retail india pvt ltd .......";


  console.log("$scope.saveadd");
  $scope.saveAdd = function(){
    console.log("$scope.saveadd", JSON.stringify($scope.form));
    $apiService.user.login($scope.form,
        function (err, data) {
          console.log("data:---", data);
    });
      
  }

   
});