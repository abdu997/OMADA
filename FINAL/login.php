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
                margin-bottom: -10px;
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
            a:hover {
                text-decoration: none;
                cursor: pointer;
            }
        </style>
    </head>
    <body ng-app="loginApp" ng-controller="loginController" class="w3-display-middle">
        <center>
            <h1 style="margin-bottom: 30px">OmadaHQ</h1>
            <button id="loginTab" class="w3-button">Login</button>
            <button id="registerTab" class="w3-button">Register</button>
        </center><br>
        <form id="loginForm">
            <label>Email</label><br>
            <input type="email" ng-model="email" class="w3-input w3-border-0"><br>
            <label>Password</label><br>
            <input type="password" ng-model="password" class="w3-input w3-border-0"><br>
            <a id="resetTab">Forgot password?</a><br><br>
            <small style="color: red;" ng-show="loginError">Email/password do not match our records. Please try again<br></small>
            <input type="submit" value="login" class="w3-button" ng-click="login()">
        </form>
        <form id="registerForm" class="hidden">
            <label>Email</label><br>
            <input type="email" ng-model="registerEmail" class="w3-input w3-border-0"><br>
            <small style="color: red;" ng-show="emailInvalid">Valid email is required<br></small>
            <label>First Name</label><br>
            <input type="text" ng-model="firstName" class="w3-input w3-border-0"><br>
            <small style="color: red;" ng-show="firstEmpty">First name is required<br></small>
            <label>Last Name</label><br>
            <input type="text" ng-model="lastName" class="w3-input w3-border-0"><br>
            <small style="color: red;" ng-show="lastEmpty">Last name is required<br><br></small>
            <small style="color: red;" ng-show="registerError">Email is already being used, try loging in or reseting your password<br></small>
            <small style="color: green;" ng-show="registerSuccess">Registration successful, check your email for confirmation and password setup link!<br></small>
            <input ng-click="register()" type="submit" class="w3-button" value="register">
        </form>
        <form id="passwordReset" class="hidden">
            <h4>Password Reset</h4>
            <label>Email Address</label>
            <input ng-model="resetEmail" class="w3-input w3-border-0" type="email">
            <br><br>
            <input ng-click="passwordReset()" class="w3-button" type="submit" value="Reset">
        </form>
    </body>
    <script>
        $("#registerTab").click(function(e) {
            e.preventDefault();
            $("#passwordReset").addClass("hidden");
            $("#loginForm").addClass("hidden");
            $("#registerForm").removeClass("hidden");
        });
        $("#loginTab").click(function(e) {
            e.preventDefault();
            $("#loginForm").removeClass("hidden");
            $("#registerForm").addClass("hidden");
            $("#passwordReset").addClass("hidden");
        });
        $("#resetTab").click(function(e) {
            e.preventDefault();
            $("#loginForm").addClass("hidden");
            $("#registerForm").addClass("hidden");
            $("#passwordReset").removeClass("hidden");
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
                            $scope.email = null;
                            $scope.password = null;
                            window.location.href = "team.php";
                            $scope.loginError = false;
                        }
                    });
                }
            }
            
            $scope.emailpattern = /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/;
            $scope.register = function() {
                if($scope.emailpattern.test($scope.registerEmail)) {
                    if($scope.firstName ==  ""){
                        $scope.firstEmpty = true;
                        $scope.emailInvalid = false;
                        $scope.lastEmpty = false;
                        $scope.registerError = false;
                        $scope.registerSuccess = false;
                    } else if($scope.lastName == ""){
                        $scope.lastEmpty = true;
                        $scope.firstEmpty = false;
                        $scope.emailInvalid = false;
                        $scope.registerError = false;
                        $scope.registerSuccess = false;
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
                                $scope.lastEmpty = false;
                                $scope.firstEmpty = false;
                                $scope.emailInvalid = false;
                                $scope.registerSuccess = false;
                            } else {
                                $scope.registerEmail = null;
                                $scope.firstName = null;
                                $scope.lastName = null;
                                $scope.registerSuccess = true;
                                $scope.registerError = false;
                                $scope.lastEmpty = false;
                                $scope.emailInvalid = false;
                            }
                        });
                    }
                } else {
                    $scope.emailInvalid = true;
                }
            }
            
            $scope.passwordReset = function() {
                $http.post(
                    "php/passwordReset.php", {
                        'resetEmail': $scope.resetEmail
                    }
                ).success(function(data) {
                    alert(data);
                });
            }
        });
    </script>

</html>