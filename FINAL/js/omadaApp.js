var app = angular.module('omadaApp', []);
app.controller('SessionController', function($scope, $http) {
    $scope.userinfo = function(){
        $http.get("php/getUser.php").success(function(data) {
            $scope.user = data;
        });
    }
    
    $scope.userTeams = function(){
        $http.get("php/userTeam.php").success(function(data) {
            $scope.teams = data;
        });
    }
});