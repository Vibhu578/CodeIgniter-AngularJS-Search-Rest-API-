var appa=angular.module('searchAppto',[]);
appa.controller('searchtoCntrl',['$scope','$http',function($scope,$http){

$scope.formSubmit = function (){
  if($scope.searchKey==undefined)
  {
    $scope.searchKey = "";
  }
  var xdate = document.getElementById("myDate").value;
  var data = {type:$scope.searchType,loc:$scope.searchLoc,date:xdate,key:$scope.searchKey };
  var stringQuery = $.param(data);
  $scope.url = "/Techbaze/api/Api_Infocenter/get_searchKeys?"+stringQuery+ "";
  $http.get($scope.url,{})
  .success(function(data){
    $scope.eventsData = data;
  });
}

}]);
