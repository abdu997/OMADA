<html lang="en" ng-app="DashApp" ng-controller="ChatController">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="js/angular.min.js"></script>
<script src="js/dash-app.js"></script>
<link rel="stylesheet"href="css/w3.css">
<link rel="stylesheet" href="css/style.css">
<script src="js/jquery.js"></script>

    <script for="modal">
        // Get the modal
        var modal = document.getElementById('chatroom_create');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
    
    <script>
    $.('#sendMsg').submit(function(e){
        e.preventDefault();
        formData = {
            'msg' : $('.message.input').val(),
            
        };
        $.ajax({
            type: 'POST',
            url : '',
            data: formData,
            dataType: 'json',
            success: function(data){
                console.log(data);
            }
        })
        
    });
    
    
    
    </script>
    <script>
    $.('#chatroom-submit').submit(function(e){
        e.preventDefault();
        var mems = new Array();
        $("input:checkbox[name=chatroom_members]:checked").each(function(){
            mems.push($(this).innerHTML);
        });
        formData = {
            'chatroomname' : $('#chatroomname').val(),
            'members': mems
            };
        $.ajax({
            type: 'POST',
            url : 'chatroom.php',
            data: formData,
            dataType: 'json',
            success: function(data){
                console.log(data);
            }
        })
        
    });
    
    
    
    </script>

<div id="chatroom_create" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-4" style="padding: 25px; background: #f1f1f1!important">
        <span onclick="document.getElementById('chatroom_create').style.display='none'" class="w3-button w3-display-topright" style="font-size: 20px">&times;</span>
        <div class="w3-container">
            <h4>Create Chatroom</h4>
            <form id="chatroom-submit">
                <label>Chatroom Name<span class="asterisk">*</span>
                </label>
                <input id="chatroomname" class="w3-input w3-border-0" type="text" required>
                <p><small>Pick members to be added into new chatroom. You can have a chatroom for yourself without members.</small>
                </p>
                <div class="checkbox" ng-repeat="x in members">
                    <label>
                        <input type="checkbox" name="chatroom_members"> {{ x.member_name }}
                    </label>
                </div>
                <input class="w3-button" type="submit" value="Create" style="background: white; margin-top: 10px">
            </form>
        </div>
    </div>
</div>
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

<body>
    <div id="chat">
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
                <input class="message-input" placeholder="Type message here..." required>
                <input type="submit" value="Send">
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