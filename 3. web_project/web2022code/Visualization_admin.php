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
	
	<title>Visualization Info</title>
	<link rel="stylesheet" href="log.css">
	 <div class="wrapper fadeInDown">
	 <div id="formContent">
	
	<div class = "container">
		<canvas id = "lineChart" width="600" height="200" aria-label="Hello ARIA World" role="img"></canvas>
	</div>

	<script>
		var data = $.ajax({
		url: "data_backend.php",
		type: "POST",
		dataType: "json",
		success: function(data) {}
		});

		data.done(success)


		function success(responseText) 
		{
			let chart_data = [];
			chart_data.push(parseInt(responseText[0].user_visits), parseInt(responseText[1].covid_case), responseText[2].positive);

			const CHART1 = document.getElementById("lineChart").getContext('2d');

			let lineChart = new Chart(CHART1, {
				type: 'bar',
				data: {
					labels: ["#Επισκέψεων","#Κρούσματων Covid","#Επισκέψεων ενεργών κρουσμ."],
					
					datasets: [{
							fill: false,
							data: chart_data,
							backgroundColor: ['yellow','red','orange'],
							borderWidth: 2,
							borderColor: '#777',
							hoverBorderWidth: 3,
							hoverBorderColor: '#000'
						}
					]
				},
				options: {
					plugins: {
						legend: {
							display: false
						}
					},
					scales: {
					  y: {ticks: {color: 'lightblue', beginAtZero: true } },
					  x: {ticks: {color: 'lightblue', beginAtZero: true } }
					}
				}
    });

}
</script>
