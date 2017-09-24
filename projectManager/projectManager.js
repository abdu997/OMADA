    var app = angular.module("myapp", []);
    app.controller("usercontroller", function($scope, $http, $rootScope) {
        $scope.tagColors = [
            {
                'color': 'red'
            },
        ];
//            "#f44336!important", "#ff9800!important", "#00bcd4!important", "#3f51b5!important", "#F6C800"
        $scope.projectClicked = function($index) {
            console.log($index);
            $scope.selectedProject = $index;
        }

        $scope.color;
        $scope.projectError = false;
        $scope.btnProject = "ADD";
        $scope.projectInsert = function() {
            if ($scope.project == null) {
                alert("Project is required");
            }
            if ($scope.project.length > 25) {
                $scope.projectError = true;
            } else {
                $http.post(
                    "insertProject.php", {
                        'project': $scope.project,
                        'btnName': $scope.btnName,
                        'project_id': $scope.project_id,
                        'tag_color': $scope.color,
                    }
                ).success(function(data) {
                    //alert(data);
                    $scope.project = null;
                    $scope.btnName = "ADD";            
                    $scope.displayProject();
                    $scope.projectError = false;
//                    $scope.selectedColor = null;
                });
            }
        }

        $scope.project_id;
        $scope.filterGoals = function(id, projectName) {
            $scope.project_id = id;
            $http.get("getGoals.php?project_id=" + id).success(function(goals) {
                $scope.goals = goals;
            });
        }
        setInterval(function() {
            $scope.filterGoals($scope.project_id);
        }, 500);

        $scope.displayProject = function() {
            $http.get("readProjects.php")
                .success(function(data) {
                    $scope.projects = data;
                });
        }
        setInterval(function() {
            $scope.displayProject();
        }, 500);

        $scope.deleteProject = function(project_id) {
            if (confirm("Are you sure you want to delete this project?")) {
                $http.post("deleteProject.php", {
                        'project_id': project_id
                    })
                    .success(function(data) {
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
                    "create.php", {
                        'goal': $scope.goal,
                        'btnName': $scope.btnName,
                        'goal_id': $scope.goal_id,
                        'project_id': $scope.project_id
                    }
                ).success(function(data) {
                    //alert(data);
                    $scope.goal = null;
                    $scope.btnName = "ADD";
                    $scope.filterGoals($scope.project_id);
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
            $http.post("updateStatus.php", {
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
            $http.post("updateStatus.php", {
                'status': status,
                'goal_id': goal_id
            }).success(function(data) {

            });
        }

        $scope.displayData = function() {
                $http.get("read.php")
                    .success(function(data) {
                        $scope.goals = data;
                    });
        }
        //setInterval(function(){$scope.displayData();}, 500);

        $scope.updateData = function(goal_id, goal) {
            $scope.goal_id = goal_id;
            $scope.goal = goal;
            $scope.btnName = "Update";
        }

        $scope.deleteData = function(goal_id) {
            if (confirm("Are you sure you want to delete this goal?")) {
                $http.post("delete.php", {
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
                    "insertRecord.php", {
                        'record': $scope.record,
                        'goal_id': $scope.goal_id,
                        'project_id': $scope.project_id
                    }
                ).success(function(data) {
                    $scope.record = '';
                    $scope.filterRecords($scope.goal_id);
                });
            }
        }

        $scope.goal_id;
        $scope.filterRecords = function(id) {
            $scope.goal_id = id;
            $http.get("getRecords.php?goal_id=" + id).success(function(records) {
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