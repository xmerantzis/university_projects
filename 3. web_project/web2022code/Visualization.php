<?php include 'header.php'?>
   
  <head>
        <style>
             #map { height: 700px; width: 100%; align: "center";}
             input:invalid {
               border: 3px solid red;
             }
        </style>
   </head>
   <body>
     <div class="scrollmenu">
		<a href="index.php">Home</a>
		<a href="Visualization.php">Καταστήματα-POI</a>
		<a class="active" href="Declare_visit.php">Δήλωση Επίσκεψης</a>
		<a href="covid_visit.php">Πιθανή Επαφή με Κρούσμα</a>
		<a href="Declare_Covid.php">Δήλωση Κρούσματος</a>
		<a href="Profile Management.php">Προφίλ</a>
		<a href="logout.php">Logout</a>
  </div>


   <div id= "map"></div>

 </body>
   <script>

   var markers_array = [];

   function calculate(array) 
   {
     var arraySum = array.reduce(function (a, b) { return a + b; }, 0);
     return arraySum / array.length;
   }

   var date = new Date();
   var today = date.toLocaleString('en-us', {weekday: 'long'});

   var marker_layer = new L.layerGroup();

   const markerCluster =  L.markerClusterGroup({
    chunkedLoading: true,
    disableClusteringAtZoom:15,
    spiderfyOnMaxZoom: true
  });

  
  var map = new L.Map('map', {
		center: new L.LatLng(38.246361, 21.734966),
		zoom: 15
	})
  
   const attribution = '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';
   const tileUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
   const tiles = L.tileLayer(tileUrl, {
       attribution
   });

   tiles.addTo(map);
   map.addLayer(marker_layer);
   map.addLayer(markerCluster);

   var greenIcon = L.icon({
     iconUrl: 'images/green-marker.png',
     shadowUrl: 'https://unpkg.com/leaflet@1.4.0/dist/images/marker-shadow.png',
     iconSize: [29, 24],
     iconAnchor: [9, 21],
     popupAnchor: [0, -14]
   });


   var orangeIcon = L.icon({
     iconUrl: 'images/orange-marker.png',
     shadowUrl: 'https://unpkg.com/leaflet@1.4.0/dist/images/marker-shadow.png',
     iconSize: [29, 24],
     iconAnchor: [9, 21],
     popupAnchor: [0, -14]
   });

   var redIcon = L.icon({
     iconUrl: 'images/red-marker.png',
     shadowUrl: 'https://unpkg.com/leaflet@1.4.0/dist/images/marker-shadow.png',
     iconSize: [29, 24],
     iconAnchor: [9, 21],
     popupAnchor: [0, -14]
   });


   var blueIcon = L.icon({
     iconUrl: 'images/blue-marker.png',
     shadowUrl: 'https://unpkg.com/leaflet@1.4.0/dist/images/marker-shadow.png',
     iconSize: [29, 24],
     iconAnchor: [9, 21],
     popupAnchor: [0, -14]
   });

  
   function iconColor(popularity) 
   {
     let round = Math.round(popularity);

      if (round >= 0 && round <= 32) 
          return greenIcon;
       else if (round >= 33 && round <= 65) 
          return orangeIcon;
       else if (round >= 66) 
          return redIcon;
       else 
          return blueIcon;
    }

  
   if (!navigator.geolocation)
   {
       console.log('Geolocation API not supported by this browser.');
   } 
   else
   {
       navigator.geolocation.getCurrentPosition(success, error);
	   
       function success(position) 
	   {
           var marker = L.marker([position.coords.latitude,position.coords.longitude]);
            
           marker.bindPopup("Η τρέχουσα θέση μου:<br>Γεωγραφικό Πλάτος: " +position.coords.latitude + "<br>Γεωγραφικό Μήκος: " + position.coords.longitude);
          
		   marker_layer.addLayer(marker);
		  
          
           map.setView([position.coords.latitude,position.coords.longitude], 13);
       }

       var searchControl = new L.control.search({
           url: 'search.php?q={s}',
           propertyName: 'title',
           textPlaceholder: 'Search in Leaflet Maps...',
           position: "topright",
           autoType: true,
           moveToLocation: function(latLng, title, map) {map.setView([latLng.lat, latLng.lng], 20);},
           delayType: 500,
           collapsed: false
       });

       map.addControl(searchControl);

       const ajax_query = $.ajax({
         url:"Visualization_backend.php",
         method:"POST",
         dataType: "json",
         success: function(data)
		 {
			   for(let i=0;i<data.length;i++)
			   {
				   let estimate =[];

				   if(date.getHours() == 22)
						estimate.push(parseInt(data[i].popular_times[date.getHours()]), parseInt(data[i].popular_times[date.getHours() + 1]), parseInt(data[i].popular_times[0]));
				    else if(date.getHours() == 23)
						estimate.push(parseInt(data[i].popular_times[date.getHours()]), parseInt(data[i].popular_times[0]), parseInt(data[i].popular_times[1]));
				    else
						estimate.push(parseInt(data[i].popular_times[date.getHours()]), parseInt(data[i].popular_times[date.getHours() + 1]), parseInt(data[i].popular_times[date.getHours() + 2]));
				   
					let markers = L.marker(L.latLng(data[i].loc[0], data[i].loc[1]), {icon: iconColor(calculate(estimate))}, {id:data[i].id} );

					markers.bindPopup("Ονομασία Καταστήματος: "+data[i].name+ "<br> Διεύθυνση: "+data[i].address+"<br>Μέσος Όρος Επισκεψιμότητας: "+Math.round(calculate(estimate))).on("popupopen", () => {
                 $(".leaflet-popup-close-button").on("click", (e) => {}); });


					markerCluster.addLayer(markers);
				}

				searchControl.on('search:locationfound', function(responseText) 
				{
					 var xhr = JSON.parse(responseText.sourceTarget._curReq.response);

					 for(let i=0;i<xhr.length;i++)
					 {  
						let estimate_next = [];

						if (date.getHours() == 22)
							estimate_next.push(parseInt(xhr[i].popular_times[date.getHours()]), parseInt(xhr[i].popular_times[date.getHours() + 1]), parseInt(xhr[i].popular_times[0]));
					   
						else 
							if (date.getHours() == 23)
								estimate_next.push(parseInt(xhr[i].popular_times[date.getHours()]), parseInt(xhr[i].popular_times[0]), parseInt(xhr[i].popular_times[1]));
					   
							else
								estimate_next.push(parseInt(xhr[i].popular_times[date.getHours()]), parseInt(xhr[i].popular_times[date.getHours() + 1]), parseInt(xhr[i].popular_times[date.getHours() + 2]));
					   
					   let popupContent = '<p>Τίτλος Καταστήματος:<b>'+xhr[i].title+'</p></b><p>Διεύθυνση: <b>'+xhr[i].address+'</p></b><p>Μέσος Όρος Επισκεψιμότητας:<b>'+Math.round(calculate(estimate_next))+' </p></b>';

					   let marker = L.marker(L.latLng(responseText.latlng.lat, responseText.latlng.lng), {icon:iconColor(calculate(estimate_next))},{draggable:false} );

					   let myPopup = marker.bindPopup(popupContent);

						map.addLayer(marker);
						
						markers_array.push(marker);
					}
					
					 map.removeLayer(markerCluster);
				   });
				}
			});

       function error() {
           console.log('Geolocation error!');
       }
   }
 </script>

</html>
