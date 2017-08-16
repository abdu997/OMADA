<html ng-app="List">

<head>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
    <style>
        .items-list-cb:checked ~ .items-list-desc {
            color: #34bf6e;
            text-decoration: line-through;
        }
    </style>
</head>

<body ng-controller="PersonalList">



    <form name="shopList">

        <input type="text" ng-model="itemInput" placeholder="Add New Item" autofocus required />
        <div>
            <button type="submit" ng-click="addItem(itemInput); itemInput = null" ng-disabled="shopList.$invalid">
                <i class="fa fa-plus"></i>&nbsp;Add Item
            </button>
        </div>
        <input type="text" ng-model="filterItem" placeholder="Filter Items">
        <br>
    </form>

    <label ng-repeat="item in items | filter : filterItem">
        <input type="checkbox" value="{{item.STATUS}}" ng-checked="item.STATUS==2" ng-click="changeStatus(item.ID,item.STATUS,item.ITEM)" class="items-list-cb" />
        <span></span>
        <span class="items-list-desc" ng-class="{strike:item.STATUS==2}">{{item.ITEM}} <span>[{{item.CREATED_AT | date:"MMM d"}}]</span></span>
        <a ng-click="deleteItem(item.ID)"><i class="fa fa-minus-circle"></i></a>
        <br>
    </label>
    <br>





    <script>
        //Define an angular module for our app
        var app = angular.module('List', []);

        app.controller('PersonalList', function($scope, $http) {

            getItem(); // Load all available items 
            function getItem() {
                $http.post("getItem.php").success(function(data) {
                    $scope.items = data;
                });
            };

            $scope.addItem = function(item) {
                $http.post("addItem.php?item=" + item).success(function(data) {
                    getItem();
                    $scope.itemInput = "";
                });
            };

            $scope.deleteItem = function(item) {
                if (confirm("Are you sure to delete this item?")) {
                    $http.post("deleteItem.php?itemID=" + item).success(function(data) {
                        getItem();
                    });
                }
            };

            $scope.changeStatus = function(item, status, task) {
                if (status == '2') {
                    status = '0';
                } else {
                    status = '2';
                }
                $http.post("updateItem.php?itemID=" + item + "&status=" + status).success(function(data) {
                    getItem();
                });
            };

        });
    </script>
</body>

</html>