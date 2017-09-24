<?php
include "connection/connect.php";
if(isset($_GET['token'])){
$token = $_GET['token'];
}

$hashed_token = password_hash($token, PASSWORD_DEFAULT);

$sql = "SELECT GUID, email,Time FROM `user_reset` WHERE GUID = '$hashed_token' ";
$stmnt = $db -> query($sql);
$row = $stmnt -> fetch_array(MYSQLI_ASSOC);
$count = $stmnt -> num_rows;

$bool = false;
if($count != 0){
    $bool = true;
}

?>


<!DOCTYPE html>
<html >

	  
	  
    <title>Reset Password</title>
    
  
<body>
	      	  <script>
	  $(document).ready(function(){
		  
		  $("#reset").submit(function(e) {
		 
		e.preventDefault();
		if ($("#pw").val() != $("#pw2").val()){
			alert("Passwords don't match!");
		}
		var password = $("#pw").val();
		var email = "<?php echo $row['email']  ?>";
		$.ajax({
					type: "POST",
						url: "update_pass.php",
						data:{
							password: password,
							email: email
						},
						success: function(data){
							if(data.indexOf("Success") >= 0){
                          $("#postsubmit").remove();		
		                  $("#pw").remove();
		                  $("#pw2").remove();
		                  $("#h4").text("Password Reset!");
		                  $("#h3").text("You can now go to the login page.");   
                            }
                            else{
                          $("#postsubmit").remove();		
		                  $("#pw").remove();
		                  $("#pw2").remove();
		                  $("#h4").text("Something went wrong!");
		                  $("#h3").text("Try to reset again!"); 
                            }
						}
					});
			  
		
		  
  	
			

		
			
});
		  }); 
	  </script> 

    

	  <?php
    
    
$dateFromDatabase = strtotime($row['Time']);
$dateTwelveHoursAgo = strtotime("-24 hours");

if ($dateFromDatabase >= $dateTwentyFourHoursAgo){
	  

echo "<form style = 'height:100px;' id='reset'>
  		<h4 id='h4' >Your Link is invalid or has expired.</h4>
  	</form>";
	  
	  }
	  
	  
	  
	 
	  else{
		  
	
	  
	echo "  <form id='reset'>
  <h4 id='h4' >Password Reset</h4>
	<h3 id = 'h3'>Enter your new password:</h3>
	<input id='pw' name='password' type='password' placeholder='New Password'/>
		  <input id='pw2' type='password' name ='password2' placeholder='New Password Again'/>
  
  <input name='postsubmit' class='hvr-shrink' id='postsubmit' type='submit' value='Submit'/>
</form>";
	  
	 
	  }
	  ?>
	  
    
    
    

  </body>
</html>
