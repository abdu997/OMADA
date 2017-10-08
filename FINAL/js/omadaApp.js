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
    
    $scope.emailpattern = /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/;
    $scope.editProfile = function() {
        if(document.getElementById('firstName').value == "") {
            $scope.firstNameError = true;
            $scope.lastNameError = false;
        } else if(document.getElementById('lastName').value == "") {
            $scope.lastNameError = true;
            $scope.firstNameError = false;
        } else if($scope.emailpattern.test(document.getElementById('email').value)) {
            $http.post(
                "php/editProfile.php", {
                    'first_name': document.getElementById('firstName').value,
                    'last_name': document.getElementById('lastName').value,
                    'email': document.getElementById('email').value
                }
            ).success(function(data) {
                alert(data);
                $scope.userinfo();
                $scope.firstNameError = false;
                $scope.emailError = false;
            });           
        } else {
            $scope.emailError = true;
        }
    }
});
