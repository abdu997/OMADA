<html>
    <head>
        <script src="js/angular.min.js"></script>
        <script src="js/jquery.js"></script>
        <link rel="stylesheet" href="css/w3.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!--Fonts-->
        <link rel="stylesheet" href="css/raleway.css">
        <style>
            .hidden {
                display: none;
            }
            body {
                background: #f1f1f1!important;
            }
            input {
                width: 200px;
            }
            button {
                width: 100px;
            }
            .w3-button {
                background: #bdc3c7;
            }
            form {
                max-width: 200px
            }
        </style>
    </head>
    <body ng-app="loginApp" ng-controller="loginController" class="w3-display-middle">
        <center>
            <button id="loginTab" class="w3-button">Login</button>
            <button id="registerTab" class="w3-button">Register</button>
        </center>
        <br>
        <form id="loginForm">
            <label>Email</label><br>
            <input type="email" ng-model="email"><br>
            <label>Password</label><br>
            <input type="password" ng-model="password"><br><br>
            <small style="color: red;" ng-show="loginError">Email/password do not match our records. Please try again<br></small>
            <input type="submit" value="login" class="w3-button" ng-click="login()">
        </form>
        <form id="registerForm" class="hidden">
            <label>Email</label><br>
            <input type="email" ng-model="registerEmail"><br>
            <small style="color: red;" ng-show="emailInvalid">Valid email is required<br></small>
            <label>First Name</label><br>
            <input type="text" ng-model="firstName"><br>
            <small style="color: red;" ng-show="firstEmpty">First name is required<br></small>
            <label>Last Name</label><br>
            <input type="text" ng-model="lastName"><br><br>
            <small style="color: red;" ng-show="lastEmpty">Last name is required<br></small>
            <small style="color: red;" ng-show="registerError">Email is already being used, try loging in or reseting your password<br></small>
            <small style="color: green;" ng-show="registerSuccess">Registration successful, check your email for confirmation and password setup link!<br></small>
            <input ng-click="register()" type="submit" class="w3-button" value="register">
        </form>
    </body>
    <script>
        $("#registerTab").click(function(e) {
            e.preventDefault();
            $("#loginForm").addClass("hidden");
            $("#registerForm").removeClass("hidden");
        });
        $("#loginTab").click(function(e) {
            e.preventDefault();
            $("#loginForm").removeClass("hidden");
            $("#registerForm").addClass("hidden");
        });
    </script>
    <script>
        var app = angular.module('loginApp', []);
        app.controller('loginController', function($scope, $http) {
            $scope.login = function() {
                if ($scope.email == null) {
                    alert("Email invalid");
                } else if ($scope.password == ""){
                    alert("Password is needed");
                } else {
                    $http.post(
                        "php/loginRequest.php", {
                            'email': $scope.email,
                            'password': $scope.password
                        }
                    ).success(function(data) {
                        if (data == "error") {
                            $scope.loginError = true;
                        } else {
                            alert(data);
                            $scope.email = null;
                            $scope.password = null;
                            window.location.href = "team.php";
                            $scope.loginError = false;
                        }
                    });
                }
            }
            
            $scope.register = function() {
                if ($scope.registerEmail == null) {
                    $scope.emailInvalid = true;
                } else if($scope.firstName == null){
                    $scope.firstEmpty = true;
                    $scope.emailInvalid = false;
                } else if($scope.lastName == null) {
                    $scope.lastEmpty = true;
                    $scope.firstEmpty = false;
                    $scope.emailInvalid = false;
                } else {
                    $http.post(
                        "php/registerRequest.php", {
                            'email': $scope.registerEmail,
                            'first_name': $scope.firstName,
                            'last_name': $scope.lastName
                        }
                    ).success(function(data) {
                        if (data == "error"){
                            $scope.registerError = true;
                        } else {
                            $scope.registerEmail = null;
                            $scope.firstName = null;
                            $scope.lastName = null;
                            $scope.registerSuccess = true;
                        }
                    });
                }
            }
        });
    </script>

</html>
