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
    setInterval(function() {$scope.userTeams();}, 1000);
    
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
    
    $scope.pwdpattern = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/;
    $scope.editPassword = function() {
        $http.post(
            "php/passwordCheck.php", {
                'old_password': document.getElementById('oldPassword').value,
            }
        ).success(function(data) {
            if(data == "success") {
                if ($scope.pwdpattern.test(document.getElementById('newPassword').value)) {
                    if (newPassword.value == repeatNewPassword.value){
                        $http.post(
                            "php/passwordChange.php", {
                                'new_password': document.getElementById('newPassword').value,
                            }
                        ).success(function(data){
                            $scope.passwordChangeSuccess = true;
                            $scope.newPasswordError = false;
                            $scope.repeatNewPasswordError = false;
                            $scope.oldPasswordError = false;
                        });
                    } else {
                        $scope.passwordChangeSuccess = false;
                        $scope.newPasswordError = false;
                        $scope.repeatNewPasswordError = true;
                        $scope.oldPasswordError = false;
                    }
                } else {
                    $scope.passwordChangeSuccess = false;
                    $scope.newPasswordError = true;
                    $scope.repeatNewPasswordError = false;
                    $scope.oldPasswordError = false;
                }
            } else {
                $scope.passwordChangeSuccess = false;
                $scope.oldPasswordError = true;
                $scope.newPasswordError = false;
                $scope.repeatNewPasswordError = false;
            }
        });  
    }
});
