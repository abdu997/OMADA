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
app.controller('ChatController', function ($scope,$http) {
    
    $scope.members  = [
        {
            "member_id": "3",
            "member_name": "yousef"
        },
        {
            "member_id": "4",
            "member_name": "Swagat"
        },
        {
            "member_id": "1",
            "member_name": "abdul"
        },
    ]
    
   /* $scope.chatrooms = [
        {
            "chatroom_id": 1,
            "chatroom_name": "Development"
        },
        {
            "chatroom_id": 2,
            "chatroom_name": "Design"
        },
        {
            "chatroom_id": 3,
            "chatroom_name": "marketing"
        }
    ]*/
    
    
    
    
  
	$scope.messages = [
        {
            "message_id": "1",
            "chatroom_id": "1",
            "class": "rmessage",
            "status": "receiver",
            "sender": "Abdul",
            "timestamp": "Mon 8:00pm",
            "message": "Hello!"
        },
         {
            "message_id": "2",
            "chatroom_id": "2",
            "class": "smessage",
            "status": "sender",
            "sender": "Yousef",
            "timestamp": "Mon 8:50pm",
            "message": "Ho!"
        },
        {
            "message_id": "3",
            "chatroom_id": "2",
            "class": "rmessage",
            "status": "receiver",
            "sender": "Abdul",
            "timestamp": "Mon 8:40pm",
            "message": "jerk!"
        },
        {
            "message_id": "4",
            "chatroom_id": "1",
            "class": "rmessage",
            "status": "receiver",
            "sender": "Abdul",
            "timestamp": "Mon 8:00pm",
            "message": "why!"
        },
         {
            "message_id": "5",
            "chatroom_id": "2",
            "class": "smessage",
            "status": "sender",
            "sender": "Yousef",
            "timestamp": "Mon 8:50pm",
            "message": "no!"
        },
        {
            "message_id": "6",
            "chatroom_id": "3",
            "class": "rmessage",
            "status": "receiver",
            "sender": "Abdul",
            "timestamp": "Mon 8:40pm",
            "message": "yoyo!"
        },
	];
    
       $scope.getChatrooms = function(){
           $http.get("getChatrooms.php").success(function(data) {
           //alert(data);
            $scope.chatrooms = data;
               
                });
        }
   
    
    
    $scope.submitMessage = function() {
    $scope.message = document.getElementById('msg').value;
            if ($scope.message == null) {
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
      $("#clist").hide();
       $http.get("getMessages.php?chatroom_id="+id).success(function(msgs) {
        
                    $scope.chat = msgs;
                });
        }
    
  /*setInterval(function(){$scope.chatRoomMsgs($scope.chatroom_id);}, 1000);*/
      
  });

