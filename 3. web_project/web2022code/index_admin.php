<?php include 'header.php'?>

<div class="scrollmenu">
	<a class="active" href="index_admin.php">Αρχική</a>
	<a href="Visualization_admin.php">Απεικόνιση Στατιστικών a, b, c </a>
	<a href="Visualization_admin_1.php">Απεικόνιση Στατιστικών d</a>
	<a href="logout.php">Logout</a>
</div>
	<link rel="stylesheet" href="log.css">
	 <div class="wrapper fadeInDown">
	 <div id="formContent">
	
	<title>Σελίδα Διαχειριστή</title>
	<h2>Επιλογή json Αρχείου για φόρτωση</h2>
	<input type="file" name="inputfile" id="inputfile" accept=".json">
	<br><br><button class="myButton" id="delete_btn">Διαγραφή όλων των Καταστημάτων</button>
	 
	<script>
		const delete_rows = document.getElementById('delete_btn');

		delete_rows.onclick = function()
		{
			if (confirm("Θέλετε να διαγράψετε όλα τα καταστήματα;"))
			{
				$.ajax({
					type:"POST",
					url:"Delete_rows.php",
					data:{bool_value:true},
					success:function(data)
					{
						Swal.fire({text:"H Διαγραφή των Καταστημάτων έγινε επιτυχώς!"}).then(function(){window.location.assign("index_admin.php");});
					}
				});
			} 
			else
			{
				Swal.fire({text:"H Διαγραφή των Καταστημάτων ΑΚΥΡΩΘΗΚΕ!!"});
			}
		}

		const fileSelector = document.getElementById('inputfile');

		fileSelector.addEventListener('change', function() 
		{
			var fr = new FileReader();

			fr.readAsText(this.files[0]);

			fr.onload = function()
			{
				parsed_file = JSON.parse(fr.result);
		
				let array_file = [];
				
				for (let i=0;i<parsed_file.length;i++)
				{
					loop_file ={};
					loop_file.days_name = [];
					loop_file.days_data = [];
					loop_file.id= parsed_file[i].id;
					loop_file.name= parsed_file[i].name;
					loop_file.address= parsed_file[i].address;
					loop_file.lat= parsed_file[i].coordinates.lat;
					loop_file.lng= parsed_file[i].coordinates.lng;
					loop_file.rating= parsed_file[i].rating;
					loop_file.rating_n= parsed_file[i].rating_n;
					loop_file.types = parsed_file[i].types.toString();

					for (let j=0; j<(parsed_file[i].populartimes).length; j++)
					{
						loop_file.days_name.push(parsed_file[i].populartimes[j].name);
						loop_file.days_data.push(parsed_file[i].populartimes[j].data);
					}
					
					array_file.push(loop_file);
				}
				
				$.ajax({	
					type:"POST",
					url: "Upload_stores_backend.php",
					data: {data:JSON.stringify(array_file)},
					success: function(data)
					{
						Swal.fire({text:"Η Εισαγωγή Καταστημάτων και Επισκεπτών ολοκληρώθηκε επιτυχώς!"}).then(function(){window.location.assign("index_admin.php");
					});
      }
    })
  }
});
</script>
