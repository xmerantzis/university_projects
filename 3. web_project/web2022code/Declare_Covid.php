<?php include 'header1.php'?>

<title>Δήλωση Κρούσματος</title>

 <div class="scrollmenu">
    <a href="index.php">Home</a>
    <a href="Visualization.php">Καταστήματα-POI</a>
    <a class="active" href="Declare_visit.php">Δήλωση Επίσκεψης</a>
    <a href="covid_visit.php">Πιθανή Επαφή με Κρούσμα</a>
    <a href="Declare_Covid.php">Δήλωση Κρούσματος</a>
    <a href="Profile Management.php">Προφίλ</a>
    <a href="logout.php">Logout</a>
  </div>

<body>
	 <link rel="stylesheet" href="log.css">
	 <div class="wrapper fadeInDown">
	 <div id="formContent">
	  <div class="container">
	  <h2 for="meeting-time" style="color:white";>Δώστε Ημερομηνία Διάγνωσης με covid-19:</style></h2>

	<input type="datetime-local" id="covid_date" name="meeting-time" min="2022-01-01T00:00" max="2022-12-31T00:00">
	
	<button id="Upload_button" onclick="Declare_Covid()">Καταχώριση Δήλωσης Κρούσματος</button>
	
</body>


<script>
	var now = new Date();

	 now.toLocaleString('en-US', { timeZone: 'Europe/Athens' })
	 
	 document.getElementById('covid_date').value = now.toISOString().slice(0,16);

	function Declare_Covid()
	{
	  let date = document.getElementById('covid_date').value;
	  
	  if(confirm(`Θέλετε να καταχωρίστε την δήλωση κρούσματος στις ${date.replace("T",' ')};`))
	  {
		const confirm = $.ajax({
		  url: 'Declare_Covid_backend.php',
		  method: 'POST',
		  dataType: 'text',
		  data: {positive: 1,date: date},
		  success: function(response) {
					
					if(response == 1){
						alert("Πρέπει να παρέλθουν 14 ημέρες από την τελευταία δήλωση κρούσματος");
						
					}else if(response == 2){
						Swal.fire({
							text:"Δεν επιτρέπεται Μελλοντική Ημερομηνία για καταχώριση κρούσματος"
						});
						
					}else{
						
						alert(`Η Δήλωση Covid του χρήστη με id:${response} ολοκληρώθηκε επιτυχώς!`);
						
					}
		  }
		});

	  }
	  else
	  {
		alert("Η δήλωση κρούσματος ακυρώθηκε");
	  }

	}

</script>
