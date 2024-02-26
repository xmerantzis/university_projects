<?php include 'header1.php'?>

<body>
  <title>Δήλωση Επίσκεψης Χρήστη</title>
  <div class="scrollmenu">
    <a href="index.php">Home</a>
    <a href="Visualization.php">Καταστήματα-POI</a>
    <a class="active" href="Declare_visit.php">Δήλωση Επίσκεψης</a>
    <a href="covid_visit.php">Πιθανή Επαφή με Κρούσμα</a>
    <a href="Declare_Covid.php">Δήλωση Κρούσματος</a>
    <a href="Profile Management.php">Προφίλ</a>
    <a href="logout.php">Logout</a>
  </div>

  <h1>Λίστα POI</h1>
  
  <table id="Values_table">
    <thead>
      <th>Ονομασία Καταστήματος</th>
      <th>Διεύθυνση Καταστήματος</th>
      <th>Τοποθεσία</th>
      <th>Εκτίμηση Ατόμων</th>
      <th></th>
    </thead>
	
    <tbody id="rows"></tbody>
	
  </table>
  
  
<script>
if (!navigator.geolocation) 
    console.log('Geolocation API not supported by this browser');
 else 
 {
    navigator.geolocation.getCurrentPosition(success, error);

    function success(position)
	{
        const stores_in_20_m = $.ajax({
            url: 'Declare_visit_backend.php',
            method: 'POST',
            dataType: 'json',
            success: function(data)
			{
                var JSON_array = [];

                var table = document.getElementById('Values_table');

                rows.innerHTML = "";
				
                var tr = "";
				
                var cell = document.createElement("td");

                let count = 0;

                for (let i = 0; i < data.length; i++) 
				{
                    if (getDistanceFromLatLonInKm(position.coords.latitude, position.coords.longitude, data[i].loc[0], data[i].loc[1]) < 2000) 
					{ 
                        var JSON = {};
						
                        let rows = document.getElementById('rows');

                        tr += '<tr id="">';
                        tr += '<td>' + data[i].name + '</td>' + '<td>' + data[i].address + '</td>' + '<td>' + data[i].loc.join(',') + '</td><td><input id=input_user'+count+' " type="number" /></td><td id='+count+'></td>';
                        tr += '</tr>';

                        JSON.name = data[i].name;
                        JSON.address = data[i].address;
                        JSON.id = data[i].id;
                        JSON.loc = data[i].loc;

                        JSON_array.push(JSON);
						
                        count=count+1;
                    }
                }
				
                rows.innerHTML += tr;
               
                for(let j=0;j<count;j++)
				{
                  let btn = document.createElement("button");
				  
                  btn.setAttribute("id", j);
				  
                  btn.innerText = "Καταχώριση";

                  btn.onclick = function()
				  {
                    user_input = document.getElementById("input_user"+this.id).value;
                    ajax_upload(JSON_array[this.id],user_input);
                  };

                  let selectPanel = document.getElementById(j);
				  
                  selectPanel.appendChild(btn);
                }
            }
        });
    }

    function error() 
	{
        console.log('Geolocation error!');
    }
}

function getDistanceFromLatLonInKm(lat_1, lon_1, lat_2, lon_2) 
{
    var Radius = 6371;

    var dLat = deg2rad(lat_2 - lat_1); // deg2rad below
    var dLon = deg2rad(lon_2 - lon_1);

    var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) + Math.cos(deg2rad(lat_1)) * Math.cos(deg2rad(lat_2)) * Math.sin(dLon / 2) * Math.sin(dLon / 2);

    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    var d = Radius * c; // Distance in km
	
    return parseInt(d * 1000);
}

function deg2rad(deg)
{
    return deg * (Math.PI / 180)
}

function ajax_upload(JSON, user_est)
{
    if(confirm(`Θέλετε να καταχωρίσετε την επίσκεψη σας στο κατάστημα '${JSON.name}' που συναντήσατε ${user_est} άτομα`)) 
	{
      JSON.estimation = parseInt(user_est);

      const user_visit = $.ajax({
        url: 'Declare_visit_upload_backend.php',
        method: 'POST',
        dataType: 'text',
        data:{giorgos:JSON},
        success: function(answer)
		{
          alert("H καταχώριση επίσκεψης ολοκληρώθηκε επιτυχώς!!!");
        }
      })
    }
	else
	{
      alert("Η καταχώριση επίσκεψης δεν ολοκληρώθηκε επιτυχώς");
	  
      window.location.reload();
    }
}
</script>
</body>
