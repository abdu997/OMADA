var app = angular.module('personalToDo', []);
app.controller('taskController', function($scope, $http) {
    getItem();

    function getItem() {
        $http.post("readItem.php").success(function(data) {
            $scope.items = data;
        });
    }

    $scope.createTask = function(item) {
        $http.post(
            "createItem.php",{
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
            "deleteItem.php", {
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
        $http.post("updateItem.php", {
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