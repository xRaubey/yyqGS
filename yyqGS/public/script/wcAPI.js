var $oauth = angular.module("OAuth",['ui.router']);

$oauth.config(function ($stateProvider, $urlRouterProvider, $locationProvider) {
    $locationProvider.hashPrefix('');
    $stateProvider
        .state("wcLogin",{
            url:"/wcLogin",
            templateUrl:"wcLogin.php",
            controller:"LoginController"
        })
        .state("secure",{
            url:"/secure",
            templateUrl:"secure.php",
            controller:"SecureController"
        });
    $urlRouterProvider.otherwise("/wcLogin");
});

$oauth.controller("LoginController",function ($scope) {
    $scope.login = function () {
        window.location.href="https://open.work.weixin.qq.com/wwopen/sso/qrConnect?appid=ww9c011721c4164ca3&agentid=1000005&redirect_uri=http://test.ikaiyin.com/ff/public/oauth_callback.html&state=1";
    }
});

$oauth.controller("SecureController",function ($scope) {
    $scope.accountUsername = JSON.parse(window.localStorage.getItem("wc")).oauth.username;
    $scope.userList = JSON.parse(window.localStorage.getItem("userlist"));
    //$scope.phone = user.mobile;

    var token = window.localStorage.getItem("token");
    var id = JSON.parse(window.localStorage.getItem("wc")).oauth.username;

    $scope.transfer = function (){
        window.location.href = 'home.php?id='+id;
    };

    // $.ajax({
    //     url:"./forms/proxyAjax.php?url=https%3A%2F%2Fqyapi.weixin.qq.com%2Fcgi-bin%2Fuser%2Fget%3Faccess_token%3D"+token+"%26userid%3D"+id,
    //     method:"GET",
    //     success:function (d) {
    //         var data = JSON.parse(d);
    //         var phone = data.mobile;
    //         $scope.phone = phone;
    //
    //         $scope.transfer = function () {
    //             $.ajax({
    //                 url:"./forms/matchPhone.php",
    //                 method:"POST",
    //                 data:{"phone":phone},
    //                 success:function (d) {
    //                     if(d === 0){
    //                         window.location.href = 'index.php';
    //                     }
    //                     else{
    //                         window.location.href = 'home.php?id='+d;
    //                     }
    //                 }
    //             });
    //         };
    //     }
    // });

	$scope.send = function (userid) {
		console.log(userid);
		var userid = userid;
        var token = window.localStorage.getItem("token");
		console.log(token);
        $.ajax({
            method:"POST",
            url:"./forms/proxyAjax.php?url=https%3A%2F%2Fqyapi.weixin.qq.com%2Fcgi-bin%2Fmessage%2Fsend%3Faccess_token%3D"+token,
            data:{
                "touser":userid,
				"toparty":"",
                "totag":"",
                "msgtype" : "text",
                "agentid" : 1000005,
                "text" : {
                    "content" : "你猜我做了什么，嘤嘤嘤。"
                },
                "safe":0
            },
            success:function (d) {
				console.log(d);
                alert("SUCCESS");
            }
        })
    };

});