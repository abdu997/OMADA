            $(document).ready(function(){
		  
		  $("#login").click(function(e) {
		 e.preventDefault();
              
			  
  		var email = $("#email").val();		
		var pass = $("#pass").val();
              
			   if($.trim(email) == '' || $.trim(pass) == '' ){
      alert('Input can not be left blank');
   }
			  else{
		
			
	  $.ajax ({
		  
      type: "POST",
	 url: "php/login_request.php",
	  	data: {
			email: email,
			  password:pass
		},
		  
		  

		  success: function(html){
				if(html.indexOf("login") >= 0){
				    console.log("team.php");
				  window.location.href = 'team.php';
			  }
			  else{
				  alert("Incorrect Username and/or Password");
			  }
		  }
		  

  });
			  }
			
});
		  });