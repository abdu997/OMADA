<head>
    <script src="../js/angular.min.js"></script>
    <script src="linkapp.js"></script>
    <script src="https://code.angularjs.org/1.4.8/angular-sanitize.min.js"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <style>
        .fw {
            cursor: pointer;
            margin: 10px;
        }
        .trash {
            color: red;
        }
    </style>
</head>
    <div ng-app="myapp" ng-controller="linkRepository" ng-init="displayData()">
        <form name="link_form2">
            <label>Link</label>
            <input type="text" ng-model="link">
            <br>
            <label>Note</label>
            <input type="text" ng-model="note">
            <br>
            <input type="submit" ng-disabled="link_form2.$invalid" ng-click="insertLink()" value="{{btnName}}" />
        </form>
        <br />
        <br />
        <table>
            <tr>
                <th>Member</th>
                <th>Link</th>
                <th>Notes</th>
                <th></th>
            </tr>
            <tr ng-repeat="x in links | filter: '.'">
                <td>{{x.user}}</td>
                <td ng-bind-html="x.url"></td>
                <td>{{x.note}}</td>
                <td>
                    <i ng-click="updateData(x.record_id, x.link, x.note)" class="fa fa-pencil-square-o fw"></i>
                    <i ng-click="deleteData(x.record_id)" class="fa fa-trash fw trash"></i>
                </td>
            </tr>
        </table>
    </div>


