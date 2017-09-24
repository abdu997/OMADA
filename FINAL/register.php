<html>
    <head>
        <script src="js/angular.min.js"></script>
    </head>
    <body ng-app="registerApp" ng-controller="registerController">
        <form name="passwordForm">
            <label>Password</label>
            <input id="password" ng-model="password" type="password" autocomplete="off">
            <label>Repeat Password</label>
            <input id="repeatPassword" ng-model="repeatPassword" type="password" autocomplete="off">
            <input ng-click="passwordInsert()" type="submit">
        </form>
    </body>
    <script>
        var app = angular.module('registerApp', []);
        app.controller('registerController', function($scope, $http) {
            
            $scope.pwdpattern = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/;
            $scope.passwordInsert = function() {
                if ($scope.pwdpattern.test($scope.password)) { 
                    if (password.value == repeatPassword.value){
                        alert("okay");
                        $scope.password = null;
                        $scope.repeatPassword = null;
                    } else {
                        alert("Passwords must match!");
                        repeatPassword.style.backgroundColor = "red";
                    }
                } else {
                    alert("Password must meet requirements");
                    password.style.backgroundColor = "red";
                } 
            }
        });
    </script>
</html>