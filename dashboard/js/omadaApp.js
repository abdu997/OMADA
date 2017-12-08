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
    
    $scope.pageChange = function(page) {
        $scope.page = page;
        $http.post(
            "php/pageChange.php", {
            'page': $scope.page 
            }
        ).success(function(data){
            location.reload(); 
           if(data == "success"){
           } else {
               alert(data);
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
        ).success(function(data) {
            window.location.reload();
            window.location.href = "index.php";
        });
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
        }).success(function(data) {
            $scope.filterGoals($scope.board_id)
        });
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
            $scope.filterGoals($scope.board_id)
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
app.controller('PERTController', function($scope, $http) {
    $scope.goalBtn = "create";
    $scope.createGoal = function(){
        $http.post(
            "php/PERT/createRecord.php", {
                'record_id': $scope.record_id,
                'goal_name': $scope.goal_name,
                'goal_description': $scope.goal_description,
                'start_message': $scope.start_message,
                'end_time': $scope.end_time,
                'start_time': $scope.start_time,
                'type': 'goal',
                'button': $scope.goalBtn
            }
        ).success(function(data) {
            if($scope.goalBtn == "create"){
                if (data == 'success') {
                    $scope.fetchGoals();
                    document.getElementById('questionaire').style.display='none';
                    document.getElementById('create_task').style.display='block';
                    $scope.task_create = false;
                    $scope.goal_name = "";
                    $scope.goal_description = "";
                    $scope.start_message = "";
                    $scope.end_time = "";
                    $scope.start_time = "";
                } else {
                   alert(data);
                }   
            } else if($scope.goalBtn == "update"){
                if(data == "success"){
                    document.getElementById('questionaire').style.display='none';
                    $scope.fetchGoals();
                    $scope.fetchRecord();
                    $scope.clearInput();
                } else {
                    alert(data);
                }
            }
        });
    }

    $scope.editGoal = function(record_id, name, description, start_message, start_time, end_time){
        document.getElementById('questionaire').style.display='block';
        $scope.record_id = record_id;
        $scope.goal_name = name;
        $scope.goal_description = description;
        $scope.start_message = start_message;
        document.getElementById("start_time").value = start_time;
        document.getElementById("end_time").value = end_time;
        $scope.goalBtn = "update";
    }
    
    $scope.fetchGoals = function() {
        $http.get("php/PERT/readGoal.php").success(function(data) {
            $scope.goals = data;
        });
    }
    
    $scope.selectGoal =  function(record_id){
        $scope.record_id = record_id;
        $http.post(
            "php/PERT/selectGoal.php", {
                'record_id': $scope.record_id
            }
        ).success(function(data){
            if(data == "success"){
               window.location.href='tasks.php';
           } else {
               alert(data);
           }
        });
    }
    
    $scope.deleteRecord = function(record_id, type){
        $scope.record_id = record_id;
        $scope.type = type;
        if (confirm("Are you sure you want to delete this? All contents will be deleted.")){
            $http.post(
                "php/PERT/deleteRecord.php", {
                    'record_id': $scope.record_id,
                    'type': $scope.type
                }
            ).success(function(data){
                if (data == "success"){
                    if($scope.type == "goal"){
                        $scope.fetchGoals();
                    } else if($scope.type == "task" || $scope.type == "sub_task"){
                        $scope.fetchRecord();
                    }
                } else {
                    alert(data);
                }
            });
        }
    }
    
    $scope.taskBtn = "create";
    $scope.createTask = function(){
        $http.post(
            "php/PERT/createRecord.php", {
                'task_name': $scope.task_name,
                'optimistic_time': $scope.optimistic_time,
                'realistic_time': $scope.realistic_time,
                'pessimistic_time': $scope.pessimistic_time,
                'type': 'task',
                'button': $scope.taskBtn,
                'record_id': $scope.record_id
            }
        ).success(function(data){
            
            if($scope.taskBtn == "create"){
                if(data == "success"){
                    $scope.task_create = true;
                    $scope.sub_task_create = true;
                    $scope.fetchRecord();
                } else {
                    alert(data);
                }
            } else if($scope.taskBtn == "update"){
                if(data == "success"){
                    $scope.clearInput();
                    $scope.fetchRecord();
                   document.getElementById('create_task').style.display='none';
                } else {
                    alert(data);
                }
            }
        });
    }
    
    $scope.updateTask = function(record_id, task_name, optimistic_time, realistic_time, pessimistic_time){
        document.getElementById('create_task').style.display='block';
        $scope.taskBtn = "update";
        $scope.task_name = task_name;
        document.getElementById("optimistic_time").value = optimistic_time;
        document.getElementById("realistic_time").value = realistic_time;
        document.getElementById("pessimistic_time").value = pessimistic_time;
        $scope.record_id = record_id;
    }
    
    $scope.updateSubTask = function(record_id, task_name, optimistic_time, realistic_time, pessimistic_time){
        $scope.task_create = true;
        $scope.sub_task_create = true;
        document.getElementById('create_task').style.display='block';
        $scope.subTaskBtn = "update";
        $scope.sub_task_name = task_name;
        document.getElementById("sub_optimistic_time").value = optimistic_time;
        document.getElementById("sub_realistic_time").value = realistic_time;
        document.getElementById("sub_pessimistic_time").value = pessimistic_time;
        $scope.record_id = record_id;
    }
    
    $scope.subTaskBtn = "add";
    $scope.createSubTask = function(){
        $http.post(
            "php/PERT/createRecord.php", {
                'sub_task_name': $scope.sub_task_name,
                'sub_optimistic_time': $scope.sub_optimistic_time,
                'sub_realistic_time': $scope.sub_realistic_time,
                'sub_pessimistic_time': $scope.sub_pessimistic_time,
                'type': 'sub_task',
                'button': $scope.subTaskBtn,
                'record_id': $scope.record_id
            }
        ).success(function(data){
            if($scope.subTaskBtn == "update"){
                if(data == "success"){
                    $scope.clearInput();
                    document.getElementById("create_task").style.display="none";
                    $scope.task_create = false;
                    $scope.sub_task_create = false;
                    $scope.fetchRecord();
                } else {
                    alert(data);
                }
            } else {
                if(data == "success"){
                    alert("Sub task created!");
                    $scope.sub_task_name = "";
                    $scope.sub_optimistic_time = "";
                    $scope.sub_realistic_time = "";
                    $scope.sub_pessimistic_time = "";
                    $scope.fetchRecord();
                } else {
                    alert(data);
                }
            }
        });
    }
    
    $scope.selectTask = function(task_id){
        $scope.task_id = task_id;
        $http.post(
            "php/PERT/selectTask.php", {
                'task_id': $scope.task_id
            }
        ).success(function(data){
            if(data == "success"){
                document.getElementById('create_task').style.display='block';
                $scope.task_create = true;
                $scope.sub_task_create = true;
            } else {
                alert(data);
            }
        });
    }
    
    $scope.fetchRecord = function(){
        $http.get("php/PERT/readRecord.php").success(function(data){
            $scope.records = data;
        });
    }
    
    $scope.changeSubTaskProgress = function(record_id){
        $scope.record_id = record_id;
        $http.post(
            "php/PERT/updateSubTaskProgress.php", {
                'record_id':  $scope.record_id,
            }
        ).success(function(data){
            if (data == "success"){
                $scope.fetchRecord();
            } else {
                alert(data);
            }
        });
    }
    
    $scope.clearInput = function(){
        $scope.goal_name = "";
        $scope.goal_description = "";
        $scope.start_message = "";
        $scope.start_time = "";
        $scope.end_time = "";
        $scope.goalBtn = "create";
        
        $scope.task_name = "";
        $scope.optimistic_time = "";
        $scope.realistic_time = "";
        $scope.pessimistic_time = "";
        $scope.taskBtn = "create";
        
        $scope.sub_task_name = "";
        $scope.sub_optimistic_time = "";
        $scope.sub_realistic_time = "";
        $scope.sub_pessimistic_time = "";
        $scope.subTaskBtn = "add";
    }
});
app.controller("linkRepository", function($scope, $http) {
    $scope.btnName = "ADD";
    $scope.insertLink = function() {
        $http.post(
            "php/linkBank/create.php", {
                'link': $scope.link,
                'note': $scope.note,
                'btnName': $scope.btnName,
                'record_id': $scope.record_id
            }
        ).success(function(data) {
            if($scope.btnName == "ADD"){
                if(data == "success"){
                    $scope.link = null;
                    $scope.note = null;
                    $scope.btnName = "ADD";              
                    $scope.displayData();
                } else {
                    alert(data);
                }
            } else {
                if(data == "success"){
                    $scope.link = null;
                    $scope.note = null;
                    $scope.btnName = "ADD";              
                    $scope.displayData();
                } else {
                    $scope.displayData();
                    $scope.link = null;
                    $scope.note = null;
                    $scope.btnName = "ADD"; 
                }   
            }
        });
    }
        
    $scope.displayData = function() {
        $http.get("php/linkBank/read.php").success(function(data) {
            $scope.links = data;
        });
    }
    setInterval(function(){$scope.displayData();}, 5000);
      
    $scope.updateData = function(record_id, link, note) {
        $scope.record_id = record_id;
        $scope.link = link;
        $scope.note = note;
        $scope.btnName = "Edit";
    }
        
    $scope.deleteData = function(record_id) {
        if (confirm("Are you sure you want to delete this data?")) {
            $http.post("php/linkBank/delete.php", {
                'record_id': record_id
            }).success(function(data) {
                if(data == "success"){
                    $scope.displayData();
                } else {
                    alert(data);
                }
            });
        } else {
            return false;
        }
    }
});
app.controller('taskController', function($scope, $http) {
    getItem();

    function getItem() {
        $http.post("php/personalTodo/readItem.php").success(function(data) {
            $scope.items = data;
        });
    }

    $scope.createTask = function(item) {
        $http.post(
            "php/personalTodo/createItem.php",{
                'task': $scope.taskInput
            }
        ).success(function(data) {
            if(data == "success"){
                getItem();
                $scope.itemInput = "";
            } else {
                alert(data);
            }
        });
    }

    $scope.deleteTask = function(task_id) {
        $http.post(
            "php/personalTodo/deleteItem.php", {
                'task_id': task_id
            }).success(function(data) {
            if(data == "success"){
                getItem();
                $scope.taskInput = "";
            } else {
                alert(data);
            }
        });
    }

    $scope.changeProgress = function(task_id) {
        $http.post("php/personalTodo/updateItem.php", {
            'task_id': task_id
        }).success(function(data) {
            if(data == "success"){
                getItem();
            } else {
                alert(data);
            }
        });
    }
});