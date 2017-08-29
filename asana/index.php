<html>

<head>
    <script src="../js/angular.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

</head>

<body>
    <div ng-app="myapp" ng-controller="usercontroller" ng-init="displayData()">
        <label>First Name</label>
        <input type="text" name="goal" ng-model="goal">
        <br />
        <input type="submit" name="btnInsert" ng-click="goalInsert()" value="{{btnName}}" />
        <br />
        <br />
        <div class="col-sm-3">
            <h3>Not Started</h3>
            <div ng-repeat="x in goals | filter : 'not_started'">
                <p>{{x.goal}}</p>
                <button ng-click="updateData(x.goal_id, x.goal)">Update</button>
                <button ng-click="deleteData(x.goal_id)">Delete</button>
                <button ng-click="advanceGoalStatus(x.goal_id, x.status)">In Progress</button>
            </div>
        </div>
        
        <div class="col-sm-3">
            <h3>In Progress</h3>
            <div ng-repeat="x in goals | filter : 'inProgress'">
                <p>{{x.goal}}</p>
                <button ng-click="updateData(x.goal_id, x.goal)">Update</button>
                <button ng-click="deleteData(x.goal_id)">Delete</button>
                <button ng-click="reverseGoalStatus(x.goal_id, x.status)">Not Now</button>
                <button ng-click="advanceGoalStatus(x.goal_id, x.status)">In Review</button>
            </div>
        </div>

        <div class="col-sm-3">
            <h3>In Review</h3>
            <div ng-repeat="x in goals | filter : 'inReview'">
                <p>{{x.goal}}</p>
                <button ng-click="updateData(x.goal_id, x.goal)">Update</button>
                <button ng-click="deleteData(x.goal_id)">Delete</button>
                <button ng-click="reverseGoalStatus(x.goal_id, x.status)">Back to Work</button>
                <button ng-click="advanceGoalStatus(x.goal_id, x.status)">Completed!</button>
            </div>
        </div>
        
        <div class="col-sm-3">
            <h3>Completed</h3>
            <div ng-repeat="x in goals | filter : 'completed'">
                <p>{{x.goal}}</p>
                <button ng-click="updateData(x.goal_id, x.goal)">Update</button>
                <button ng-click="deleteData(x.goal_id)">Delete</button>
                <button ng-click="reverseGoalStatus(x.goal_id, x.status)">Needs Review</button>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    var app = angular.module("myapp", []);
    app.controller("usercontroller", function($scope, $http) {
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
    });
</script>