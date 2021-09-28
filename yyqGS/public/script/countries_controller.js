

var $countriesC = angular.module("countriesC",[]);

$countriesC.controller("countriesController",function ($scope,$http) {

    $http({
        method:"GET",
        url:"./form/search_news.php"
    }).then(function (data) {
        // data = JSON.parse(data);
        // console.log(data.data);
        console.log(data);

        $scope.info = data.data;
        // $scope.info = data.data;
    });
});