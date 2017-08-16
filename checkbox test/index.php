<html>

<head>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
</head>

<body>
    <div ng-app="myapp" ng-controller="linkRepository" ng-init="displayData()">
        <form>
            <label>Chatroom name</label>
            <input type="text" name="chatroom_name" ng-model="chatroom_name">
            <br>
            <label>Pick Members:</label>
            <div class="form-group" ng-repeat="x in member">
                <input type="checkbox" name="checkBox" ng-click="updateCheckBox($event)" id="{{x}}" value="{{x}}">{{x}}
            </div>
            <br>
            <br />
            <input type="hidden" ng-model="id" />
            <input type="submit" name="btnInsert"  ng-click="insertData()" value="{{btnName}}" />
        </form>
        <br />
        <br />
    </div>
</body>

</html>
<script src="linkapp.js"></script>
