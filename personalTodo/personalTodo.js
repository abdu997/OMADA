        var app = angular.module('personalToDo', []);

        app.controller('taskController', function($scope, $http) {

            getItem();

            function getItem() {
                $http.post("getItem.php").success(function(data) {
                    $scope.items = data;
                });
            };

            $scope.addItem = function(item) {
                $http.post("addItem.php?item=" + item).success(function(data) {
                    getItem();
                    $scope.itemInput = "";
                });
            };

            $scope.deleteItem = function(item) {
                if (confirm("Are you sure to delete this task?")) {
                    $http.post("deleteItem.php?itemID=" + item).success(function(data) {
                        getItem();
                    });
                }
            };

            $scope.clearItem = function() {
                if (confirm("Delete all checked items?")) {
                    $http.post("clearItem.php").success(function(data) {
                        getItem();
                    });
                }
            };

            $scope.changeStatus = function(item, status, task) {
                if (status == '2') {
                    status = '0';
                } else {
                    status = '2';
                }
                $http.post("updateItem.php?itemID=" + item + "&status=" + status).success(function(data) {
                    getItem();
                });
            };

        });