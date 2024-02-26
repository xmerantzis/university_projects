function register_user()
{
	function checker(password)
	{
		if(password.length<8)
			return false;
		
		let character = password.split(""); //[g] [i]
		let flag_1 = false;
		let flag_2 = false;
		let flag_3 = false;

		for(var i=0;i<character.length;i++)
		{
			let asc_number = character[i].charCodeAt();

			if(!isNaN(character[i]) === true)
				flag_1 = true;
			
			if(character[i].match(/[A-Z]/))
				flag_3 = true;
			
			if((asc_number >=33 && asc_number <=47) || (asc_number >=58 && asc_number <=64) || (asc_number >=91 && asc_number <=96) || (asc_number >=123 && asc_number<=126))
				flag_2 = true;

			if(flag_1 == true && flag_2 ==true && flag_3 == true)
				return true;
		}
		
		return false;
	}

	function register_done(responseText)
	{
		if(responseText == 0)
		{
			Swal.fire({
				text:"Επιτυχής Καταχώριση νέoυ User!!!"
			}).then(function(){
				window.location.assign("Login_form.php");
			});
		}
		else{
			Swal.fire({
				text:"Πρέπει να δώσετε διαφορετικό username/email διότι υπάρχει ήδη user με αυτά τα στοιχεία!"
			}).then(function(){
				window.location.reload();
			});
		}
	}
	
	let name =  $("input[name=name]").val(); //JQUERY
	let email =  $("input[name=email]").val();
	let pass =  $("input[name=pass]").val();
	let repeat_pass = $("input[name=repeat_pass]").val();


	if(pass!== repeat_pass)
		alert("Τα 2 passwords είναι διαφορετικά!");
	else 
		if (checker(pass)!= true)
			alert("To password δεν ικανοποιεί τις προϋποθέσεις");
	
		else 
			if(checker(pass) == true)
			{
				const ajax_query = $.ajax({
					url:"Registration_backend.php",
					type:"POST",
					dataType:"script",
					data:{username:name, password: pass, email:email},
					success:function(data){
					}
				});

				ajax_query.done(register_done);
			} 
			else 
			{
				alert("H Καταχώριση του νέου User ΑΠΕΤΥΧΕ!!!");
				window.location.reload();
			}
}
