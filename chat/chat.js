    var app = angular.module("myapp", []);
    app.controller("chatroomController", function($scope, $http) {
    
//        $scope.getMembers = function(){
//            $http.get('getMembers.php').success(function(data){
//                $scope.member = data;
//            });
//        }
//    
//        $scope.selectedNames = [];
//        $scope.btnName = "ADD";
//        $scope.insertData = function() {
//            if ($scope.chatroom_name == null) {
//                alert("Chatroom name is required");
//            } else {
//                $http.post(
//                    "create.php", {
//                        'chatroom_name': $scope.chatroom_name,
//                        'btnName': $scope.btnName,
//                        'members':$scope.selectedNames
//                    }
//                ).success(function(data) {
//                   $scope.chatroom_name = null;
//                    $scope.btnName = "ADD";
//                    $scope.getChatrooms();
//                });
//            }
//        }
//        
//        $scope.updateCheckBox = function(event){
//            if($scope.selectedNames.indexOf(event.target.id) !== -1) {
//                var index = $scope.selectedNames.indexOf(event.target.id);
//                $scope.selectedNames.splice(index,1);
//                }
//            else{
//                $scope.selectedNames.push(event.target.id);    
//            }
//            console.log($scope.selectedNames);
//            
//        }
//        
//        $scope.deleteData = function(id) {
//            if (confirm("Are you sure you want to delete this data?")) {
//                $http.post("delete.php", {
//                        'id': id
//                    })
//                    .success(function(data) {
//                        alert(data);
//                        $scope.displayData();
//                    });
//            } else {
//                return false;
//            }
//        }
    
    });
app.controller('ChatController', function ($scope,$http) {

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
                   $scope.chatroom_name = null;
                    $scope.btnName = "ADD";
                    $scope.getChatrooms();
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
    
       $scope.getChatrooms = function(){
           $http.get("getChatrooms.php").success(function(data) {
           //alert(data);
            $scope.chatrooms = data;
               
                });
        }
//setInterval(function(){$scope.getChatrooms();}, 1000); 
    
    $scope.submitMessage = function() {
    $scope.message = document.getElementById('msg').value;
            if ($scope.messageInput == null) {
                alert("Input is empty");
            } else {
                
                $http.post(
                    "sendMessages.php", 
                    {
                        'message': $scope.message,
                        'chatroom_id': $scope.chatroom_id
                    }
                ).success(function(data) {
                    
                    $scope.message = '';
                    $scope.chatRoomMsgs($scope.chatroom_id);
                });
            }
        }

    
    $scope.chatroom_id;
  $scope.chatRoomMsgs = function(id){
      $scope.chatroom_id = id;
       $http.get("getMessages.php?chatroom_id="+id).success(function(msgs) {
                    $scope.chat = msgs;
                });
        }
//  setInterval(function(){$scope.chatRoomMsgs($scope.chatroom_id);}, 1000);
  
  function init() {
  getChatrooms();
  getMembers();
}
      
  });

