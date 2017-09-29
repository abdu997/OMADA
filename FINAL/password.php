<?php
include "php/connect.php";
if(isset($_GET['token'])){
    $token = $_GET['token'];
}
$sql = "SELECT idusers FROM users WHERE password = '$token'";
$result = mysqli_query($connect,$sql);

$count = mysqli_num_rows($result);

?>


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
            .error {
                color: #e74c3c;
            }
        </style>
    </head>
	
    <body ng-app="registerApp" ng-controller="registerController"  class="w3-display-middle">
		<?php
		if($count == 1){
			$row = mysqli_fetch_assoc($result);
			$user_id = $row['idusers']
		
		?>
        <form name="passwordForm">
            <label>Password</label><br>
            <input id="password" ng-model="password" type="password" autocomplete="off">
            <small>Must contain an uppercase and lowercase letter, number and min. 8 characters</small><br>
            <small class="error" ng-show="patternError">Password must meet requirements<br></small>
            <label>Repeat Password</label><br>
            <input id="repeatPassword" ng-model="repeatPassword" type="password" autocomplete="off"><br>
            <small class="error" ng-show="repeatError">Passwords must match!<br></small>
            <input ng-click="passwordInsert(<?php echo $user_id ?>)" id="passwordInsert" class="w3-button" value="update" type="submit">
        </form>
			<?php
		}
		else{
			?>
		<p>YOUR LINK IS NOT VALID!</p>
		<?php
		}
			?>
    </body>
    <script>
        $("#passwordInsert").click(function(event){
            event.preventDefault();
        });
    </script>
    <script>
        var app = angular.module('registerApp', []);
        app.controller('registerController', function($scope, $http) {
            
            $scope.pwdpattern = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/;
            $scope.passwordInsert = function(user_id) {
                if ($scope.pwdpattern.test($scope.password)) { 
                    if (password.value == repeatPassword.value){
						$http.post("php/update_pass.php", {
                        	'user_id': user_id,
							'password':$scope.password
							
                    })
                    .success(function(data) {
                            window.location = 'login.php';

                    });
                        $scope.password = null;
                        $scope.repeatPassword = null;
                    } else {
                        $scope.repeatError = true;
                        $scope.patternError = false;
                        repeatPassword.style.backgroundColor = "#e74c3c";
                        password.style.backgroundColor = "white";
                    }
                } else {
                    $scope.patternError = true;
                    password.style.backgroundColor = "#e74c3c";
                } 
            }
        });
    </script>
</html>
