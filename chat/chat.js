    var app = angular.module("myapp", []);
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
        
        $scope.deleteData = function(chatroom_id) {
            if (confirm("Are you sure you want to delete this data?")) {
                $http.post("delete.php", {
                        'chatroom_id': chatroom_id
                    })
                    .success(function(data) {
                        $scope.getChatrooms();
                        
                    });
            } else {
                return false;
            }
        }
        
        $scope.updateData = function(chatroom_id, chatroom_name) {
            $scope.goal_id = goal_id;
            $scope.goal = goal;
            $scope.btnName = "Update";
        }
    
       $scope.getChatrooms = function(){
           $http.get("getChatrooms.php").success(function(data) {
            $scope.chatrooms = data;
               //console.log($scope.chatrooms);
               
                });
        }
    setInterval(function(){$scope.getChatrooms();}, 1000); 
    setInterval(function(){$scope.chatRoomMsgs($scope.chatroom_id);}, 1000); 
    
    // submitMessage is the add button messageInput is the field
    // ng-click="submitMessage(messageInput); messageInput = null"
    $scope.submitMessage = function() {
    // 
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
                    // gets the ID from the click fetch function
                    $scope.chatRoomMsgs($scope.chatroom_id);
                });
            }
        }

    
    $scope.chatroom_id;
  $scope.chatRoomMsgs = function(id){
      $scope.chatroom_id = id;
       $http.get("getMessages.php?chatroom_id="+id).success(function(msgs) {
                    $scope.chat = msgs;
                    //$("#messages").scrollTop($("#messages")[0].scrollHeight);
                });
        }
//  setInterval(function(){$scope.chatRoomMsgs($scope.chatroom_id);}, 1000);
  
  function init() {
      alert("Init called");
  getChatrooms();
  getMembers();
}
      
  });

