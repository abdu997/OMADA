<html>

<head>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
</head>

<body>
    <div ng-app="myapp" ng-controller="usercontroller" ng-init="displayData()">
        <label>First Name</label>
        <input type="text" name="goal" ng-model="goal">
        <br />
        <input type="submit" name="btnInsert" ng-click="goalInsert()" value="{{btnName}}" />
        <br />
        <br />
        <table>
            <tr>
                <th>First Name</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
            <tr ng-repeat="x in goals">
                <td>{{x.goal}}</td>
                <td>
                    <button ng-click="updateData(x.goal_id, x.goal)">Update</button>
                </td>
                <td>
                    <button ng-click="deleteData(x.goal_id)">Delete</button>
                </td>
            </tr>
        </table>
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
                    "create.php", {
                        'goal': $scope.goal,
                        'btnName': $scope.btnName,
                        'id': $scope.id
                    }
                ).success(function(data) {
                    $scope.goal = null;
                    $scope.btnName = "ADD";
                    $scope.displayData();
                });
            }
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