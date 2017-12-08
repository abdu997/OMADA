<?php
if(!isset($_SESSION['user_id']) && !isset($_SESSION['team_id'])){
header('Location: login.php');
}
?>
<head>
    <style>
        h3 {
            margin-top: 0px
        }
        @media(max-width: 768px) {
            h3 {
                margin-top: 30px;
            }
        }
        input {
            border: 1px solid black;
        }
        #goalEnter {
            padding-top: 25px;
        }
        .boards-column{
            margin-top: -38px;
        }
        .board {
            background: #ecf0f1;
            padding: 15px;
            box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.3);
            margin-bottom: 15px;
        }
        .board:hover {
            background: #d4d8d8;
        }
        .boardClicked {
            background: #d4d8d8;
            border-right: 8px solid #2196F3!important;
        }
        .goal {
            padding: 10px 10px 0px 10px;
            border-bottom: 1px solid black;
            background: whitesmoke;
            min-height: 95px;
        }
        .goal > p {
            margin-bottom: -5px
        }
        .not-started {
            border-bottom: 5px solid #e74c3c;
            padding-left: 0px;
            padding-right: 0px;
            margin-right: 5px;
        }
        .not-started-goal {
            border-bottom: 1px solid #e74c3c;
        }
        .in-progress {
            border-bottom: 5px solid #e67e22;
            padding-left: 0px;
            padding-right: 0px;
            margin-right: 5px;
        }
        .in-progress-goal {
            border-bottom: 1px solid #e67e22;
        }
        @media (max-width: 860px){
            .in-review-title {
                margin-bottom: 10px;
            }
        }
        @media (min-width: 861px) and (max-width: 976px){
            .in-review-title {
                margin-bottom: 36px;
            }
        }
        .in-review {
            border-bottom: 5px solid #f1c40f;
            padding-left: 0px;
            padding-right: 0px;
            margin-right: 5px;
        }
        .in-review-goal {
            border-bottom: 1px solid #f1c40f;
        }
        .completed {
            border-bottom: 5px solid #60a917;
            padding-left: 0px;
            padding-right: 0px;
        }
        .completed-goal {
            border-bottom: 1px solid #60a917;
        }
        .fa-trash {
            color: #e74c3c;
            cursor:pointer;
        }
        .fa-long-arrow-left{
            color: #ffc107!important;
            float: left;
            padding-top: 10px;
            font-size: 20px;
            margin-left: 0px;
            cursor:pointer;
        }
        .fa-long-arrow-right {
            color: green;
            float: right;
            margin-top: 10px;
            font-size: 20px;
            margin-right: 0px;
            cursor:pointer;
        }
        .fa-long-arrow-right:hover,
        .fa-long-arrow-left:hover {
            font-size: 25px;
        }
        
        .goal-delete {
            float: right;
            font-size: 15px;
        }
        .edit {
            cursor:pointer;
        }
        .show-progress {
            color: #2196F3;
            cursor: pointer;
        }
        .show-progress:hover{
            text-decoration: underline;
        }
        .progress-record {
            right:15px; 
            position: fixed; 
            border: 1px dashed #2196F3; 
            max-height: 400px; 
            overflow-y: auto;
            -webkit-backface-visibility: hidden;
            z-index: 5;
        }
        @media (max-width: 768px){
            .progress-record {
                -webkit-backface-visibility: hidden;
                position: fixed;
            }
        }
        .color-tag {
            width: 15px;
            height: 15px;
            margin: 10px 5px 10px 0px;
            float: left;
            list-style-type: none;
        }
        .tagClicked {
            width: 20px;
            height: 20px;
        }
    </style>
</head>

<body id="projectManager">
    <div class="tile-bg" ng-init="displayBoard()" ng-controller="pmController">
        <div class="row">
            <div class="col-sm-2">
                <form name="boardEnter">
                    <label>Board</label><br>
                    <input style="width: 68%;" type="text" name="board" ng-model="board" autocomplete="off" autofocus required>
                    <button type="submit" name="btnBoard" ng-click="boardInsert();" value="{{btnBoard}}" ng-disabled="boardEnter.$invalid" >{{btnBoard}}</button>
    <!--
                    <li ng-repeat="x in tagColors" class="color-tag" style="background: {{x.color}};" ng-class="{ 'tagClicked': $index == selectedColor }" ng-click="tagClicked($index); projectInsert(x.color);">
                    </li>
    -->
                    <small style="color: red;" ng-show="boardError">Board cannot be more than 25 characters</small>
                </form><br><br>
                <h3 class="boards-column"><i class="fa fa-folder-open fw"></i> Boards</h3>
                <div class="board" ng-repeat="x in boards | filter : {'0':''}" ng-click="filterGoals(x.board_id); showGoal(); boardClicked($index); hideProgress()" ng-class="{ 'boardClicked': $index == selectedBoard }" style="cursor:pointer;">
                    <p>{{x.board}}</p>
                    <i ng-click="deleteBoard(x.board_id)" class="fa fa-trash fw"></i>
                </div>
            </div>

            <div ng-show="goalForm">
                <form name="goalEnter" id="goalEnter">
                    <label style="margin-left: 0px;">Goal</label>
                    <input style="width: 60%;" type="text" name="goal" ng-model="goal" autocomplete="off" autofocus required>
                    <button type="submit" name="btnInsert" ng-click="goalInsert();" value="{{btnName}}" ng-disabled="goalEnter.$invalid">{{btnName}}
                    </button><br>
                    <small style="color: red; margin-left: 50px;" ng-show="goalError">Goal cannot be more than 28 characters</small>
                </form>
                <div ng-hide="goalForm"></div>
                <div class="col-sm-2 not-started">
                    <h3><i class="fa fa-times-circle fw" style="color: #e74c3c"></i> Not Started</h3>
                    <div class="goal not-started-goal" ng-repeat="x in goals | filter : 'not_started'" ng-click="filterRecords(x.goal_id);">
                        <p>{{x.goal}}</p>
                        <i ng-click="deleteData(x.goal_id)" class="goal-delete fa fa-trash fw"></i>
                        <small class="edit" ng-click="updateData(x.goal_id, x.goal, x.board_id)">edit</small><br>
                        <small class="show-progress" ng-click="showProgress()">Show Progress</small><br>
                        <i ng-click="advanceGoalStatus(x.goal_id, x.status)" class="fa fa-long-arrow-right fw"></i> 
                    </div>
                </div>

                <div class="col-sm-2 in-progress">
                    <h3><i class="fa fa-cogs fw" style="color: #e67e22;"></i> In Progress</h3>
                    <div class="goal in-progress-goal" ng-repeat="x in goals | filter : 'inProgress'" ng-click="filterRecords(x.goal_id);">
                        <p>{{x.goal}}</p>
                        <i ng-click="deleteData(x.goal_id)" class="goal-delete fa fa-trash fw"></i>
                        <small class="edit" ng-click="updateData(x.goal_id, x.goal)">edit</small><br>
                        <small class="show-progress" ng-click="showProgress()">Show Progress</small><br>
                        <i ng-click="reverseGoalStatus(x.goal_id, x.status)" class="fa fa-long-arrow-left fw"></i>
                        <i ng-click="advanceGoalStatus(x.goal_id, x.status)" class="fa fa-long-arrow-right fw"></i>
                    </div>
                </div>

                <div class="col-sm-2 in-review">
                    <h3 class="in-review-title"><i class="fa fa-search fw" style="color: #f1c40f;"></i> In Review</h3>
                    <div class="goal in-review-goal" ng-repeat="x in goals | filter : 'inReview'" ng-click="filterRecords(x.goal_id);">
                        <p>{{x.goal}}</p>
                        <i ng-click="deleteData(x.goal_id)" class="goal-delete fa fa-trash fw"></i>
                        <small class="edit" ng-click="updateData(x.goal_id, x.goal)"> edit</small><br>
                        <small class="show-progress" ng-click="showProgress()">Show Progress</small><br>
                        <i ng-click="reverseGoalStatus(x.goal_id, x.status)" class="fa fa-long-arrow-left fw"></i>
                        <i ng-click="advanceGoalStatus(x.goal_id, x.status)" class="fa fa-long-arrow-right fw"></i>
                    </div>
                </div>

                <div class="col-sm-2 completed">
                    <h3><i class="fa fa-check fw" style="color: #60a917;"></i> Completed</h3>
                    <div class="goal completed-goal" ng-repeat="x in goals | filter : 'completed'" ng-click="filterRecords(x.goal_id);">
                        <p>{{x.goal}}</p>
                        <i ng-click="deleteData(x.goal_id)" class="goal-delete fa fa-trash fw"></i>
                        <small class="edit" ng-click="updateData(x.goal_id, x.goal)"> edit</small><br>
                        <small class="show-progress" ng-click="showProgress()">Show Progress</small><br>
                        <i ng-click="reverseGoalStatus(x.goal_id, x.status)" class="fa fa-long-arrow-left fw"></i>
                    </div>
                </div>
            </div>
            <div class="progress-record">
                <div ng-show="progress_record" style="background: #f1f1f1!important; padding: 20px">
                    <h3><i class="fa fa-file-text fw"></i> Progress Record<i ng-click="progress_record = false" class="fa fa-times fw" style="font-size: 20px;float: right; color:white;background:red;padding:5px; cursor: pointer;position:fixed; margin:20px"></i></h3>
                    <form name="recordForm" id="recordForm">
                        <input type="text" id="recordField" ng-model="recordInput" name="progress" placeholder="Add record" autocomplete="off" autofocus required>
                        <input type="submit" name="recordInsert" ng-click="submitRecord(recordInput); recordInput = null" ng-disabled="recordForm.$invalid">
                    </form> 
                    <div style="overflow-y: auto;">
                        <div ng-repeat="x in records | filter : {'initial_record':'N'} | orderBy : '-record_id'" id="comments" style="border-bottom: 1px solid #2196F3">
                            <p style="margin-bottom: 0px" ng-bind-html="x.record2"></p>
                            <span style="font-size: 10px;">{{x.timestamp | date : "EEE d MMM h:mm a"}}</span>
                            <span style="font-size: 10px; float: right; text-transform: capitalize"> By {{x.user}}</span>
                        </div>
                        <div style="border-bottom: 2px solid #2196F3" id="first-comment" width="100px" ng-repeat="x in records | filter : {'initial_record':'Y'} | orderBy : '-record_id'">
                            <h4 style="margin-bottom: 0px; text-transform: capitalize">{{x.record}} {{x.user}}</h4>
                            <span style="font-size: 10px;">{{x.timestamp | date : "EEE d MMM h:mm a"}}</span>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
        <br><br>
    </div>
</body>

