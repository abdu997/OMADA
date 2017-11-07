var app = angular.module('omadaApp', ['ngSanitize']);
app.controller('SessionController', function($scope, $http) {
    $scope.userinfo = function() {
        $http.get("php/getUser.php").success(function(data) {
            $scope.user = data;
        });
    }

    $scope.userTeams = function() {
        $http.get("php/userTeam.php").success(function(data) {
            $scope.teams = data;
        });
    }
    setInterval(function() {
        $scope.userTeams();
    }, 2000);

    $scope.createTeam = function() {
        $http.post(
            "php/createTeam.php", {
                'team_name': $scope.newTeamName
            }
        ).success(function(data) {
            if (data == "success") {
                $scope.teamCreateSuccess = true;
                $scope.newTeamMemberInsertForm = true;
            } else {
                alert(data);
                $scope.teamCreateSuccess = false;
                $scope.newTeamMemberInsertForm = false;
            }
        });
    }
    
    $scope.deleteTeam = function() {
        if (confirm("Are you sure you want to delete this team?")){
            $http.get("php/deleteTeam.php").success(function(data){
                alert(data);
                location.reload();
            });
        }
    }

    $scope.teamName = function() {
        $http.get("php/userTeam.php").success(function(data) {
            $scope.teamNames = data;
        });
    }

    $scope.getTeamMembers = function() {
        $http.get("php/getTeamMembers.php").success(function(data) {
            $scope.teamMembers = data;
        });
    }
    setInterval(function() {
        $scope.getTeamMembers();
    }, 2000);

    $scope.getTeamEmails = function() {
        $http.get("php/getTeamMembers.php").success(function(data) {
            $scope.teamEmails = data;
            $scope.editAdminForm = true;
        });
    }
    
    $scope.switchAdmins = function() {
        $http.post(
            "php/switchAdmins.php", {
                'new_admin_email': document.getElementById('newAdmin').value,
                'old_admin_email': document.getElementById('oldAdmin').value
            }
        ).success(function(data) {
            $scope.getTeamEmails();
            if(data == 'success1'){
                location.reload();
            } else if(data == 'success2'){
    
            } else {
                alert(data);
            }
        });
    }

    $scope.insertMember = function() {
        if ($scope.emailpattern.test($scope.insertMemberInput)) {
            $http.post(
                "php/freeAddMember.php", {
                    'email': $scope.insertMemberInput,
                    'admin': document.getElementById('insertAdminStatus').value
                }
            ).success(function(data) {
                alert(data);
                $scope.insertMemberInput = null;
            });
        } else {
            alert("email must be valid");
        }
    }

    $scope.removeMember = function(team_connect_id, email) {
        $scope.team_connect_id = team_connect_id;
        $scope.memberEmail = email;
        $http.post(
            "php/removeMember.php", {
                'team_connect_id': $scope.team_connect_id,
                'email': $scope.memberEmail
            }
        ).success(function(data) {
            $scope.getTeamMembers();
            if(data == "success"){
                $scope.getTeamMembers();
            } else {
                alert(data);
            }
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
        ).success(function(data) {});
    }

    $scope.emailpattern = /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/;
    $scope.editProfile = function() {
        if (document.getElementById('firstName').value == null) {
            $scope.firstNameError = true;
            $scope.lastNameError = false;
        } else if (document.getElementById('lastName').value == "") {
            $scope.lastNameError = true;
            $scope.firstNameError = false;
        } else if ($scope.emailpattern.test(document.getElementById('email').value)) {
            $http.post(
                "php/editProfile.php", {
                    'first_name': document.getElementById('firstName').value,
                    'last_name': document.getElementById('lastName').value,
                    'email': document.getElementById('email').value
                }
            ).success(function(data) {
                if (data == 'error') {
                    $scope.usedEmailError = true;
                    $scope.editProfileSuccess = false;
                    $scope.emailError = false;
                    $scope.lastNameError = false;
                    $scope.firstNameError = false;
                } else if(data == 'success') {
                    $scope.editProfileSuccess = true;
                    $scope.userinfo();
                    $scope.firstNameError = false;
                    $scope.usedEmailError = false;
                    $scope.emailError = false;
                    $scope.lastNameError = false;
                } else {
                    alert(data);
                    $scope.usedEmailError = false;
                    $scope.editProfileSuccess = false;
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
            if (data == "success") {
                if ($scope.pwdpattern.test(document.getElementById('newPassword').value)) {
                    if (newPassword.value == repeatNewPassword.value) {
                        $http.post(
                            "php/passwordChange.php", {
                                'new_password': document.getElementById('newPassword').value,
                            }
                        ).success(function(data) {
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

    $scope.changeTeamName = function(team_id) {
        $scope.team_id = team_id;
        if (document.getElementById('teamName').value == '') {
            $scope.nullTeamError = true;
            $scope.teamLengthError = false;
            $scope.changeTeamSuccess = false;
        } else if (document.getElementById('teamName').value.length > 20) {
            $scope.teamLengthError = true;
            $scope.nullTeamError = false;
            $scope.changeTeamSuccess = false;
        } else {
            $http.post(
                "php/changeTeamName.php", {
                    'team_id': $scope.team_id,
                    'team_name': document.getElementById('teamName').value
                }
            ).success(function(data) {
                if (data == 'success') {
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
app.controller("pmController", function($scope, $http, $rootScope) {
    $scope.boardClicked = function($index) {
        console.log($index);
        $scope.selectedBoard = $index;
    }

    $scope.boardError = false;
    $scope.btnBoard = "ADD";
    $scope.boardInsert = function() {
        if ($scope.board == null) {
            alert("Project is required");
        }
        if ($scope.board.length > 25) {
            $scope.boardError = true;
        } else {
            $http.post(
                "php/projectManager/insertBoard.php", {
                    'board': $scope.board,
                    'btnName': $scope.btnName,
                    'board_id': $scope.board_id,
                    'tag_color': $scope.color,
                }
            ).success(function(data) {
                $scope.board = null;
                $scope.btnName = "ADD";
                $scope.displayBoard();
                $scope.boardError = false;
            });
        }
    }

    $scope.board_id;
    $scope.filterGoals = function(id) {
        $scope.board_id = id;
        $http.get("php/projectManager/getGoals.php?board_id=" + id).success(function(goals) {
            $scope.goals = goals;
        });
    }
    setInterval(function() {
        $scope.filterGoals($scope.board_id);
    }, 1000);

    $scope.displayBoard = function() {
        $http.get("php/projectManager/readBoards.php")
            .success(function(data) {
                $scope.boards = data;
            });
    }
    setInterval(function() {
        $scope.displayBoard();
    }, 1000);

    $scope.deleteBoard = function(board_id) {
        if (confirm("Are you sure you want to delete this board?")) {
            $http.post("php/projectManager/deleteBoard.php", {
                    'board_id': board_id
                }).success(function(data){
                $scope.displayData();                
                });
        } else {
            return false;
        }
    }

    $scope.goalForm = false;
    $scope.showGoal = function() {
        $scope.goalForm = true;
    };
    $scope.tagClicked = function($index) {
        console.log($index);
        $scope.selectedColor = $index;
    }

    $scope.btnName = "ADD";
    $scope.goalError = false;
    $scope.goalInsert = function() {
        if ($scope.goal == null) {
            alert("Goal is required");
        }
        if ($scope.goal.length > 28) {
            $scope.goalError = true;
        } else {
            $http.post(
                "php/projectManager/create.php", {
                    'goal': $scope.goal,
                    'btnName': $scope.btnName,
                    'goal_id': $scope.goal_id,
                    'board_id': $scope.board_id
                }
            ).success(function(data) {
                //alert(data);
                $scope.goal = null;
                $scope.btnName = "ADD";
                $scope.goalError = false;
            });
        }
    }

    $scope.advanceGoalStatus = function(goal_id, status) {
        console.log(status);
        if (status == 'not_started') {
            status = 'inProgress';
        } else if (status == 'inProgress') {
            status = 'inReview';
        } else if (status == 'inReview') {
            status = 'completed';
        }
        $http.post("php/projectManager/updateStatus.php", {
            'status': status,
            'goal_id': goal_id
        }).success(function(data) {});
    }
    $scope.reverseGoalStatus = function(goal_id, status) {
        console.log(status);
        if (status == 'inProgress') {
            status = 'not_started';
        } else if (status == 'inReview') {
            status = 'inProgress';
        } else if (status == 'completed') {
            status = 'inReview';
        }
        $http.post("php/projectManager/updateStatus.php", {
            'status': status,
            'goal_id': goal_id
        }).success(function(data) {

        });
    }

    $scope.displayData = function() {
        $http.get("php/projectManager/read.php")
            .success(function(data) {
                $scope.goals = data;
            });
    }

    $scope.updateData = function(goal_id, goal) {
        $scope.goal_id = goal_id;
        $scope.goal = goal;
        $scope.btnName = "Update";
    }

    $scope.deleteData = function(goal_id) {
        if (confirm("Are you sure you want to delete this goal?")) {
            $http.post("php/projectManager/delete.php", {
                    'goal_id': goal_id
                })
                .success(function(data) {
                    $scope.displayData();
                });
        } else {
            return false;
        }
    }

    $scope.submitRecord = function() {
        $scope.record = document.getElementById('recordField').value;
        if ($scope.recordInput == null) {
            alert("Input is empty");
        } else {
            $http.post(
                "php/projectManager/insertRecord.php", {
                    'record': $scope.record,
                    'goal_id': $scope.goal_id,
                    'board_id': $scope.board_id
                }
            ).success(function(data) {
                $scope.record = '';
            });
        }
    }

    $scope.goal_id;
    $scope.filterRecords = function(id) {
        $scope.goal_id = id;
        $http.get("php/projectManager/getRecords.php?goal_id=" + id).success(function(records) {
            $scope.records = records;
        });
    }
    setInterval(function() {
        $scope.filterRecords($scope.goal_id);
    }, 1000);

    $scope.progress_record = false;
    $scope.showProgress = function() {
        $scope.progress_record = true;
    };

    $scope.hideProgress = function() {
        $scope.progress_record = false;
    };

});