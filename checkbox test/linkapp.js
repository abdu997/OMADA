    var app = angular.module("myapp", []);
    app.controller("linkRepository", function($scope, $http) {
        $scope.member  = [
        "Abdul Amoud", "Youssef El-Khalili", "Swagat Ghimire"
        ]
        
        $scope.btnName = "ADD";
        $scope.insertData = function() {
            if ($scope.link == null) {
                alert("Link is required");
            } else if ($scope.note == null) {
                alert("Note is required");
            } else {
                $http.post(
                    "create.php", {
                        'link': $scope.link,
                        'note': $scope.note,
                        'btnName': $scope.btnName,
                        'id': $scope.id
                    }
                ).success(function(data) {
                    //alert(data);
                    $scope.firstname = null;
                    $scope.lastname = null;
                    $scope.btnName = "ADD";
                    $scope.displayData();
                });
            }
        }
        
        $scope.displayData = function() {
            $http.get("read.php")
                .success(function(data) {
                    $scope.links = data;
                });
        }
        
        setInterval(function(){$scope.displayData();}, 500);
        
        $scope.updateData = function(id, link, note) {
            $scope.id = id;
            $scope.link = link;
            $scope.note = note;
            $scope.btnName = "Edit";
        }
        $scope.deleteData = function(id) {
            if (confirm("Are you sure you want to delete this data?")) {
                $http.post("delete.php", {
                        'id': id
                    })
                    .success(function(data) {
                        alert(data);
                        $scope.displayData();
                    });
            } else {
                return false;
            }
        }
    });