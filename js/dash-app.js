var app = angular.module('DashApp', []);

app.controller('SessionController', function ($scope) {

	$scope.profile = [
        {
            "user_id": "1",
            "user_fname": "abdul",
            "user_email": "https://apportal.ca",
            "user_image": "walrus-baby.jpg",
        },
	];
    
    $scope.user_teams = [
        {
            "team_id": "1",
            "team_name": "development",
        },
        {
            "team_id": "2",
            "team_name": "Design",
        },
        {
            "team_id": "3",
            "team_name": "Marketing",
        },
    ]

});

app.controller('LinkController', function ($scope) {

	$scope.links = [
        {
            "link_id": "1",
            "user": "Abdul",
            "link": "https://apportal.ca",
            "notes": "an amazing university navigator!",
        },
        {
            "link_id": "2",
            "user": "Yousef",
            "link": "http://apportal.ca/abdul",
            "notes": "I would hire this guy!!",
        },
        {
            "link_id": "3",
            "user": "Swagat",
            "link": "http://uottawa.ca",
            "notes": "check this school out",
        },
	];


});
app.controller('ChatController', function ($scope) {
//    DO NOT INCLUDE CURRENT USER THIS SCOPE IS FOR CHATROOM CREATE FORM
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
    
    $scope.chatrooms = [
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
    ]
  
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

  $scope.chatRoomMsgs = function(id){
      var msgs = [];
      $("#clist").toggleClass("chat-list");
  
      angular.forEach($scope.messages, function(item) {
          var key = item['chatroom_id'];
          if(key == id) {
              msgs.push(item);
          }
      });

      $scope.chat = msgs;
  }

});
app.controller('LinkController', function ($scope) {

	$scope.links = [
        {
            "link_id": "1",
            "user": "Abdul",
            "link": "https://apportal.ca",
            "notes": "an amazing university navigator!",
        },
        {
            "link_id": "2",
            "user": "Yousef",
            "link": "http://apportal.ca/abdul",
            "notes": "I would hire this guy!!",
        },
        {
            "link_id": "3",
            "user": "Swagat",
            "link": "http://uottawa.ca",
            "notes": "check this school out",
        },
	];
                $scope.deletelink = function(id){
        alert('id');
        };

});
app.controller('TodoController', function ($scope) {
   
    $scope.list = [
        {
            "task_id": "1",
            "task": "Pay Bills",
            "class": "checked",
        },
        {
            "task_id": "2",
            "task": "Buy Milk",
            "class": null,
        },
    ]
});