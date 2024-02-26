function Login() 
{
  function login_done(responseText) 
  {
    if (responseText == "user")
      Swal.fire({text:"Succesfull User Login",showConfirmButton:false,timer:1000}).then(function(){window.location.assign("index.php");});
	else 
		if (responseText == "admin") 
			Swal.fire({text:"Succesfull Admin Login",showConfirmButton:false,timer: 1000}).then(function(){window.location.assign("index_admin.php");});
		else 
			if (responseText == "Wrong Password") 
				Swal.fire({text:"Wrong Password.Try Again",showConfirmButton:false,timer:1000}).then(function(){window.location.assign("Login_form.php");});
			else 
				if (responseText == "Wrong Username")
					Swal.fire({text:"Wrong Username.Try Again",showConfirmButton:false,timer:1000}).then(function(){window.location.assign("Login_form.php");});
  }

  let name = $("input[name=name]").val();
  let pass = $("input[name=pass]").val();

  const ajax_query = $.ajax({
    url: "Login_backend.php",
    type: "POST",
    dataType: "text",
    data: {username: name,password: pass},
    success:function(data){console.log(data)}
  });

  ajax_query.done(login_done);
  
   event.preventDefault();
}
