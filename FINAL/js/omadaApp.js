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
    setInterval(function() {$scope.userTeams();}, 2000);
    
    $scope.teamName = function(){
        $http.get("php/userTeam.php").success(function(data) {
            $scope.teamNames = data;
        });
    }
    
    $scope.getTeamMembers = function(){
        $http.get("php/getTeamMembers.php").success(function(data){
            $scope.teamMembers = data;
        });
    }
    setInterval(function() {$scope.getTeamMembers();}, 2000);
    
    $scope.getTeamEmails = function(){
        $http.get("php/getTeamMembers.php").success(function(data){
            $scope.teamEmails = data;
            $scope.editAdminForm = true;
        });
    }
    setInterval(function() {$scope.getTeamEmails();}, 20000);

    $scope.switchAdmins = function(){
        $http.post(
            "php/switchAdmins.php", {
                'new_admin_email': document.getElementById('newAdmin').value,
                'old_admin_email': document.getElementById('oldAdmin').value
            }
        ).success(function(data){
            alert(data);
        });
    }
    
    $scope.insertMember = function(){
        if($scope.emailpattern.test($scope.insertMemberInput)){      
            $http.post(
                "php/freeAddMember.php", {
                    'email': $scope.insertMemberInput,
                    'admin': document.getElementById('insertAdminStatus').value
                }
            ).success(function(data){
                alert(data);
            });
        } else {
            alert("email must be valid");
        }
    }
    
    $scope.removeMember = function(team_connect_id, email){
        $scope.team_connect_id = team_connect_id;
        $scope.memberEmail = email;
        $http.post(
            "php/removeMember.php", {
                'team_connect_id': $scope.team_connect_id,
                'email': $scope.memberEmail
            }
        ).success(function(data){
            alert(data);
        });
    }
    
    $scope.teamSelect = function(team_id, admin, type, team_name, plan) {
        $scope.team_id = team_id;
        $scope.admin_status = admin;
        $scope.team_type = type;
        $scope.team_name = team_name;
        $scope.plan = plan;
        $http.post(
            "php/teamSelect.php", {
                'team_id': $scope.team_id,
                'admin_status': $scope.admin_status,
                'team_type': $scope.team_type,
                'team_name': $scope.team_name,
                'plan': $scope.plan
            }
        ).success(function(data){
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
                if(data == 'error') {
                    alert(data);
                } else {
                    $scope.userinfo();
                    alert(data);
                    $scope.firstNameError = false;
                    $scope.emailError = false;
                    $scope.lastNameError = false;
                }
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
    
    $scope.changeTeamName = function (team_id){
        $scope.team_id = team_id;
        if(document.getElementById('teamName').value == ''){
            $scope.nullTeamError = true;
            $scope.teamLengthError = false;
            $scope.changeTeamSuccess = false;
        } else if(document.getElementById('teamName').value.length > 20){
            $scope.teamLengthError = true;
            $scope.nullTeamError = false;
            $scope.changeTeamSuccess = false;
        } else {
            $http.post(
                "php/changeTeamName.php", {
                    'team_id': $scope.team_id,
                    'team_name': document.getElementById('teamName').value
                }
            ).success(function(data){
                if(data == 'success'){
                    $scope.changeTeamSuccess = true;
                    $scope.nullTeamError = false;
                    $scope.teamLengthError = false;
                } else {
                    alert(data);
                }    
            });
        }
    }
});
