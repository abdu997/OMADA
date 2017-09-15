<div ng-app="myapp" ng-controller="ChatController" ng-init="getMembers()">
    <script src="../js/angular.min.js"></script>
    <script src="../js/jquery.js"></script>
    <script src="chat.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .chatPanel {
            background: black;
            max-width: 700px;
            height: 500px;
            border-radius: 0px;
            overflow-y: auto;
            margin-bottom: 0px
        }
        .smessage,
        .rmessage {
            background: white;
            padding: 10px;
            max-width: 700px;
            margin-bottom: 15px;
            margin-top: 15px;
        }
        .rmessage {
            margin-right: 45px;
            margin-left: 15px;
        }
        .smessage {
            margin-left: 45px;
            margin-right: 15px;
        }
        .sender {
            color: blue;
            font-size: 13px;
            float: left;
        }
        .receiver {
            color: green;
            font-size: 13px;
            float: left;
        }
        .time {
            font-size: 10px;
            color: grey;
            float: right
        }
        .message {
            font: 16px;
            color: black;
        }
        ul {
            color: transparent;
            padding-left: 0px
        }
        .panel-head,
        .panel-foot {
            height: 40px;
            background: grey;
            max-width: 700px
        }
        .message-input.compressed {
            width: 60%;
            height: 40px;
            margin-left: 200px
        }
        .message-input {
            width: 92.3%;
            height: 40px;
            
        }
        #chat-toggle {
            margin: 6px;
        }
        .chat-list {
            height: 500px;
            background: black;
            position: absolute;
            max-width: 225px;
            overflow-y: auto;
            overflow-x: visible;
        }
        .chat-list#clist {
            height: 540px;
            background: black;
            position: absolute;
            max-width: 200px;
            overflow-y: auto;
            display: initial
        }
        #clist {
            position: absolute;
            display: none
        }
        .chat {
            color: white;
            padding: 15px;
        }
        .chat:hover,
        .chat:active {
            color: black;
            background: white;
        }
        .search-chat {
            width: 200px;
            background: black
        }
        #messages.compressed {
            width: 70%;
            float: right
        }
        #messages {
            width: 100%;
            float: right
        }
        #chatroomCreate {
            color: white;
            margin-left: 15px;
            margin-top: 10px
        }
        .hidden {
             display:none;
        }
        #chatroomEdit {
            margin-left: 80px;
            margin-right: 5px;
            color: grey;
        }
        
    </style>

    <div id="chat">
        <div class="panel-head">
            <button id="chat-toggle">Show Chat Rooms</button>
        </div>
        <div class="chatPanel" id="scroll" style="width:100%">
            <div id="clist" class='chat-list'>
                <div class="search-chat">
                    <input placeholder="Search Chatroom" style="width:200px" ng-model="chatSearch" autocomplete="off">
                    <ul style="border-bottom: 1px solid white; margin-top: 0px">
                        <li id="addChatroom" class="chat"><i class="fa fa-plus fa-fw"></i> Add Chatroom
                        </li>
                        <form id="chatroomCreate" class="hidden">
                            <label>Chatroom name</label>
                            <input type="text" name="chatroom_name" ng-model="chatroom_name" autocomplete="off">
                            <br>
                            <label>Pick Members:</label>
                            <div class="form-group" ng-repeat="x in member">
                                <input type="checkbox" name="checkBox" ng-click="updateCheckBox($event)" id="{{x.user_id}}" value="{{x.user_name}}">{{x.user_name}}
                            </div>
                            <input type="submit" name="btnInsert"  ng-click="insertData()" value="{{btnName}}" />
                        </form>
                        <script>
                            $(document).ready(function(){
                                $("#addChatroom").click(function(){
                                $("#chatroomCreate").toggleClass("hidden");
                                    });
                                });

                        </script>
                    </ul>
                </div>
                <div>
                    <ul ng-repeat="x in chatrooms | filter: chatSearch" style="margin-top: 0px">
                        <li ng-click='chatRoomMsgs(x.chatroom_id)' class="chat" style="margin-top: -16px; margin-bottom: -16px; text-transform: capitalize;">{{x.chatroom_name}}<button id="chatroomEdit" class="chatroomEdit"><i class="fa fa-cog fw"></i></button><button ng-click="deleteData(x.chatroom_id);"><i class="fa fa-trash fw" style="color: red;"></i></button></li>
                    </ul>
                    <script>
                        $(document).ready(function(){
                            $(".chatroomEdit").click(function(){
                                $("#chatroomCreate").toggleClass("hidden");
                            });
                        });
                    </script>
                </div>
            </div>
            <div id="messages" class="compressed">
                <span ng-repeat="x in chat | filter : {'initial_message':'Y'}">
                    <center>
                        <p style="color: white; font-size: 14px">Chatroom <strong style="font-size: 16spx">{{x.message}}</strong> created by {{x.sender}}</p>
                        <p style="color: grey; font-size: 10px">{{ x.timestamp | date : "EEE d MMM h:mm a" }}</p>
                    </center>
                </span>
                <ul id="test" ng-repeat="x in chat | filter : {'initial_message':'N'} | orderBy : 'message_id'">
                    <li class="{{ x.class }}">
                        <span class="{{ x.status }}">{{ x.sender }}</span>
                        <span class="time">{{ x.timestamp | date : "EEE d MMM h:mm a"}}</span>
                        <br>
                        <span id="message" class="message">{{ x.message }}</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="panel-foot">
            <form id="sendMsg" name="sendMsg">
                <input class="message-input compressed" id="msg" placeholder="Type message here..." ng-model="messageInput" autocomplete="off" name="message" autofocus required>
                <input type="submit" ng-click="submitMessage(messageInput); messageInput = null" value="Send" ng-disabled="sendMsg.$invalid">
            </form>
        </div>
    </div>

    <script>
        $("#chat-toggle").click(function(e) {
            e.preventDefault();
            $("#clist").toggleClass("chat-list");
        });
        $("#chat-toggle").click(function(e) {
            e.preventDefault();
            $("#messages").toggleClass("compressed");
        });
        $("#chat-toggle").click(function(e) {
            e.preventDefault();
            $("#msg").toggleClass("compressed");
        });
//        $("#panel-toggle").click(function(e) {
//            e.preventDefault();
//            $("#sendMsg").removeClass("hidden");
//        });
    </script>
</div>