


<html>

<head>
    <script src="../js/angular.min.js"></script>
</head>

<body>
    <div ng-app="myapp" ng-controller="linkRepository" ng-init="displayData()">
        <form>
            <label>Link</label>
            <input type="text" name="link" ng-model="link">
            <br />
            <label>note</label>
            <input type="text" name="note" ng-model="note">
            <br />
            <input type="hidden" ng-model="id" />
            <input type="submit" name="btnInsert" ng-click="insertData()" value="{{btnName}}" />
        </form>
        <br />
        <br />
        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <tr>
                <th>Member</th>
                <th>Link</th>
                <th>Notes</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
            <tr ng-repeat="x in links | filter: '.'">
                <td>{{x.user_id}}</td>
                <td><a href="{{x.link}}" target="_blank">{{x.link}}</a>
                </td>
                <td>{{x.note}}</td>
                <td>
                    <button ng-click="updateData(x.id, x.link, x.note)">Edit</button>
                </td>
                <td>
                    <button ng-click="deleteData(x.id )">Delete</button>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
<script src="linkapp.js"></script>
