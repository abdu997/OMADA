    var app = angular.module("myapp", []);
    app.controller("linkRepository", function($scope, $http) {
        
     
        
        $scope.getMembers = function(){
            
            $http.get('getMembers.php').success(function(data){
                $scope.member = data;
            });
        }
        
        
        $scope.selectedNames = [];
        $scope.btnName = "ADD";
        $scope.insertData = function() {
            if ($scope.chatroom_name == null) {
                alert("Chatroom name is required");
            } else {
                $http.post(
                    "create.php", {
                        'chatroom_name': $scope.chatroom_name,
                        'btnName': $scope.btnName,
                        'members':$scope.selectedNames
                    }
                ).success(function(data) {
                    //document.writeln(data);
                   $scope.chatroom_name = null;
                    $scope.btnName = "ADD";
                    $scope.displayData();
                });
            }
        }
        
        $scope.updateCheckBox = function(event){
            if($scope.selectedNames.indexOf(event.target.id) !== -1) {
                var index = $scope.selectedNames.indexOf(event.target.id);
                $scope.selectedNames.splice(index,1);
                }
            else{
                $scope.selectedNames.push(event.target.id);    
            }
            console.log($scope.selectedNames);
            
        }
        
        /*$scope.displayData = function() {
            $http.get("read.php")
                .success(function(data) {
                    $scope.links = data;
                });
        }*/
        
        //setInterval(function(){$scope.displayData();}, 500);
        
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