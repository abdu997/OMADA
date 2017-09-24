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
    </head>
	
    <body ng-app="registerApp" ng-controller="registerController">
		<?php
		if($count == 1){
			$row = mysqli_fetch_assoc($result);
			$id = $row['idusers']
		
		?>
        <form name="passwordForm">
            <label>Password</label>
            <input id="password" ng-model="password" type="password" autocomplete="off">
            <label>Repeat Password</label>
            <input id="repeatPassword" ng-model="repeatPassword" type="password" autocomplete="off">
            <input ng-click="passwordInsert(<?php echo $id ?>)" type="submit">
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
        var app = angular.module('registerApp', []);
        app.controller('registerController', function($scope, $http) {
            
            $scope.pwdpattern = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/;
            $scope.passwordInsert = function(id) {
                if ($scope.pwdpattern.test($scope.password)) { 
                    if (password.value == repeatPassword.value){
                        
						$http.post("php/update_pass.php", {
                        	'id': id,
							'password':$scope.password
							
                    })
                    .success(function(data) {
                        alert(data);

                    });

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
