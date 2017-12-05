var app = angular.module("myapp", ['ngSanitize']);
app.controller("linkRepository", function($scope, $http, $q) {
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
                    alert(data);
                }   
            }
        });
    }
        
//    $scope.displayData = function() {
//        $http.get("read.php").success(function(data) {
//            $scope.links = data;
//        });
//    }
//    setInterval(function(){$scope.displayData();}, 500);
    
    $scope.displayData = function() {
        //Creating a deferred object
        var deferred = $q.defer();
        var url = 'read.php'; //or some valid url
        $http.get(url)
        .success(function (data) {
        $scope.links = data;
        //Passing data to deferred's resolve function on successful completion
        deferred.resolve($scope.links);
        })
        .error(function (msg) {
        //Sending a friendly error message in case of failure
        deferred.reject('error: ' + msg);
        });
        //Returning the promise object
        return deferred.promise;
    }

    $scope.displayData().then(function(data){
    // process response
    }, function(err){
    console.log(err.message);
    });
        
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