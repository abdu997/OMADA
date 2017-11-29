    var app = angular.module("myapp", ['ngSanitize']);
    app.controller("linkRepository", function($scope, $http) {
        $scope.btnName = "ADD";
        $scope.insertLink = function() {
                $http.post(
                    "create.php", {
                        'link': $scope.link,
                        'note': $scope.note,
                        'btnName': $scope.btnName,
                        'record_id': $scope.record_id
                    }
                ).success(function(data) {
                    if(data == "success"){
                        $scope.link = null;
                        $scope.note = null;
                        $scope.btnName = "ADD";
                        $scope.displayData();
                    } else {
                        alert(data);
                    }
                });
        }
        $scope.displayData = function() {
            $http.get("read.php")
                .success(function(data) {
                    $scope.links = data;
                });
        }
        
        setInterval(function(){$scope.displayData();}, 500);
        
        $scope.updateData = function(record_id, link, note) {
            $scope.record_id = record_id;
            $scope.link = link;
            $scope.note = note;
            $scope.btnName = "Edit";
        }
        $scope.deleteData = function(record_id) {
            if (confirm("Are you sure you want to delete this data?")) {
                $http.post("delete.php", {
                        'record_id': record_id
                    })
                    .success(function(data) {
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