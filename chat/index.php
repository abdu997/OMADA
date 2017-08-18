<html  ng-app="myapp">

<head>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <script src="../js/jquery.js"></script>
    <style>
    .panel {
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
        margin-left: 45px;
        margin-right: 15px;
    }
    .smessage {
        margin-right: 45px;
        margin-left: 15px;
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
    .message-input {
        width: 75%;
        height: 40px
    }
    #chat-toggle {
        margin: 6px;
    }
    .chat-list {
        height: 500px;
        background: black;
        position: absolute;
        width: 225px;
        overflow-y: auto;
    }
    .chat-list#clist {
        height: 499px;
        background: black;
        position: absolute;
        width: 200px;
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
</style>

</head>

<body>
    <div ng-controller="linkRepository" ng-init="getMembers()">
        <form>
            <label>Chatroom name</label>
            <input type="text" name="chatroom_name" ng-model="chatroom_name">
            <br>
            <label>Pick Members:</label>
            <div class="form-group" ng-repeat="x in member">
                <input type="checkbox" name="checkBox" ng-click="updateCheckBox($event)" id="{{x.user_id}}" value="{{x.user_name}}">{{x.user_name}}
            </div>
            <br>
            <br />
            <input type="hidden" ng-model="id" />
            <input type="submit" name="btnInsert"  ng-click="insertData()" value="{{btnName}}" />
        </form>
        <br />
        <br />
    </div>
    <div id="chat" ng-controller="ChatController" ng-init="getChatrooms()">
        <div class="panel-head">
            <button id="chat-toggle">Show Chat Rooms</button>
        </div>
        <div class="panel" id="scroll">
            <div id="clist" class='chat-list'>
                <div class="search-chat">
                    <input placeholder="Search Chatroom" style="width:200px" ng-model="chatSearch">
                    <ul style="border-bottom: 1px solid white; margin-top: 0px">
                        <li class="chat" onclick="document.getElementById('chatroom_create').style.display='block'"><i class="fa fa-plus fa-fw"></i> Add Chatroom
                        </li>
                    </ul>
                </div>
                <div>
                    <ul ng-repeat="x in chatrooms | filter: chatSearch" style="margin-top: 0px">
                        <li ng-click='chatRoomMsgs(x.chatroom_id)' id='room' class="chat" style="margin-top: -16px; margin-bottom: -16px; text-transform: capitalize;">{{x.chatroom_name}}</li>
                    </ul>
                </div>
            </div>
            <ul ng-repeat="x in chat">
                <li class="{{ x.class }}">
                    <span class="{{ x.status }}">{{ x.sender }}</span>
                    <span class="time">{{ x.timestamp }}</span>
                    <br>
                    <span class="message">{{ x.message }}</span>
                </li>
            </ul>
        </div>
        <div class="panel-foot">
            <form id = "sendMsg">
                <input class="message-input" id="msg" placeholder="Type message here..." required>
                <input type="submit" ng-click="submitMessage()" value="Send">
            </form>
        </div>
    </div>
    <!-- /#wrapper -->
    
<!--This has to be at the bottom-->
        <script>
        $("#chat-toggle").click(function(e) {
            e.preventDefault();
            $("#clist").toggleClass("chat-list");
        });
    </script>
</body>

</html>
<script src="chat.js"></script>
