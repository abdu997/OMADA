<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../js/angular.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

</head>

<body>
    <div ng-app="myapp" ng-controller="usercontroller" ng-init="displayData()">
        <form name="goalEnter">
            <label>Goal</label>
            <input type="text" name="goal" ng-model="goal" autocomplete="off" autofocus required>
            <br />
            <input type="submit" name="btnInsert" ng-click="goalInsert();" value="{{btnName}}" ng-disabled="goalEnter.$invalid" >
        </form>
        <br />
        <br />
        <div class="col-sm-2">
            <h3>Not Started</h3>
            <div ng-repeat="x in goals | filter : 'not_started'">
                <p style="cursor:pointer;" ng-click="filterRecords(x.goal_id); showProgress()">{{x.goal}}</p>
                <button ng-click="updateData(x.goal_id, x.goal)"><i class="fa fa-pencil-square-o fw"></i></button>
                <button ng-click="deleteData(x.goal_id)"><i class="fa fa-trash fw"></i></button><br>
                <button ng-click="advanceGoalStatus(x.goal_id, x.status)"><i class="fa fa-arrow-right fw"></i></button>
            </div>
        </div>
        
        <div class="col-sm-2">
            <h3>In Progress</h3>
            <div ng-repeat="x in goals | filter : 'inProgress'">
                <p style="cursor:pointer;" ng-click="filterRecords(x.goal_id)">{{x.goal}}</p>
                <button ng-click="updateData(x.goal_id, x.goal)"><i class="fa fa-pencil-square-o fw"></i></button>
                <button ng-click="deleteData(x.goal_id)"><i class="fa fa-trash fw"></i></button><br>
                <button ng-click="reverseGoalStatus(x.goal_id, x.status)"><i class="fa fa-arrow-left fw"></i></button>
                <button ng-click="advanceGoalStatus(x.goal_id, x.status)"><i class="fa fa-arrow-right fw"></i></button>
            </div>
        </div>

        <div class="col-sm-2">
            <h3>In Review</h3>
            <div ng-repeat="x in goals | filter : 'inReview'">
                <p style="cursor:pointer;" ng-click="filterRecords(x.goal_id)">{{x.goal}}</p>
                <button ng-click="updateData(x.goal_id, x.goal)"><i class="fa fa-pencil-square-o fw"></i></button>
                <button ng-click="deleteData(x.goal_id)"><i class="fa fa-trash fw"></i></button><br>
                <button ng-click="reverseGoalStatus(x.goal_id, x.status)"><i class="fa fa-arrow-left fw"></i></button>
                <button ng-click="advanceGoalStatus(x.goal_id, x.status)"><i class="fa fa-arrow-right fw"></i></button>
            </div>
        </div>
        
        <div class="col-sm-2">
            <h3>Completed</h3>
            <div ng-repeat="x in goals | filter : 'completed'">
                <p style="cursor:pointer;" ng-click="filterRecords(x.goal_id)">{{x.goal}}</p>
                <button ng-click="updateData(x.goal_id, x.goal)"><i class="fa fa-pencil-square-o fw"></i></button>
                <button ng-click="deleteData(x.goal_id)"><i class="fa fa-trash fw"></i></button><br>
                <button ng-click="reverseGoalStatus(x.goal_id, x.status)"><i class="fa fa-arrow-left fw"></i></button>
            </div>
        </div>
        
        <div ng-show="progress_record" class="col-sm-4" style="overflow-y: auto; height: 400px">
            <h3>Progress Record</h3>
            <form name="recordForm" id="recordForm">
                <input type="text" id="recordField" ng-model="recordInput" name="progress" placeholder="Add record" autocomplete="off" autofocus required>
                <input type="submit" name="recordInsert" ng-click="submitRecord(recordInput); recordInput = null" ng-disabled="recordForm.$invalid">
            </form>
            <div id="comments" ng-repeat="x in records | filter : {'initial_record':'N'} | orderBy : '-record_id'">
                <p style="margin-bottom: 0px">{{x.record}}</p>
                <span style="font-size: 10px;">{{x.timestamp | date : "EEE d MMM h:mm a"}}</span>
                <span style="font-size: 10px; float: right;"> By {{x.user}}</span>
            </div>
            <div id="first-comment" width="100px" ng-repeat="x in records | filter : {'initial_record':'Y'} | orderBy : '-record_id'">
                <h4 style="margin-bottom: 0px">{{x.record}} {{x.user}}</h4>
                <span style="font-size: 10px;">{{x.timestamp | date : "EEE d MMM h:mm a"}}</span>
<!--                <span style="font-size: 10px; float: right;"> By {{x.user}}</span>-->
            </div>       
        </div>
    </div>
</body>

</html>
<script>
    var app = angular.module("myapp", []);
    app.controller("usercontroller", function($scope, $http, $rootScope) {
        $scope.btnName = "ADD";
        $scope.goalInsert = function() {
            if ($scope.goal == null) {
                alert("Goal is required");
            } else {
                
                $http.post(
                    "create.php", 
                    {
                        'goal': $scope.goal,
                        'btnName': $scope.btnName,
                        'goal_id': $scope.goal_id
                    }
                ).success(function(data) {
                    //alert(data);
                    $scope.goal = null;
                    $scope.btnName = "ADD";
                    $scope.displayData();
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
            $http.post("updateStatus.php",{
                'status': status,
                'goal_id': goal_id
            }
            ).success(function(data){                      
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
            $http.post("updateStatus.php",{
                'status': status,
                'goal_id': goal_id
            }
                      ).success(function(data){
                
            });
        }
        
        $scope.displayData = function() {
            $http.get("read.php")
                .success(function(data) {
                    $scope.goals = data;
                });
        }
        setInterval(function(){$scope.displayData();}, 500);
                
        $scope.updateData = function(goal_id, goal) {
            $scope.goal_id = goal_id;
            $scope.goal = goal;
            $scope.btnName = "Update";
        }
        
        $scope.deleteData = function(goal_id) {
            if (confirm("Are you sure you want to delete this data?")) {
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
                    "insertRecord.php",
                    {
                        'record': $scope.record,
                        'goal_id': $scope.goal_id
                    }
                    ).success(function(data) {
                    $scope.record = '';
                    $scope.filterRecords($scope.goal_id);
                });
            }
        }

        
        $scope.goal_id;
        $scope.filterRecords = function(id){
            $scope.goal_id = id;
            $http.get("getRecords.php?goal_id="+id).success(function(records) {
                $scope.records = records;
            });
        }
        setInterval(function(){$scope.filterRecords($scope.goal_id);}, 1000);
        
        $scope.progress_record = false;
        $scope.showProgress = function() {
        $scope.progress_record = true;
        };
        
    });
</script>