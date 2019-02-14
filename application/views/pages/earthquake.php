<div class="row">
	<div class="col-md-7">
		<label style="background-color:#169F85; color:#fff; width:100%; padding:10px; text-align:center">Worldwide EarthQuakes with Magnitudes Higher than M3</label>
	</div>
	<div class="col-md-5">
		<label style="background-color:#169F85; color:#fff; width:100%; padding:10px; text-align:center">Earthquake Map</label>
	</div>
	<div class="col-md-7">
		<table class="table table-responsive table-striped table-hover" id="tblearthquake">
			<thead>
				<tr>
					<th></th>
					<th style="width:200px;"> Location </th>
					<th> Depth </th>
					<th> Lat. </th>
					<th> Long. </th>
					<th> M </th>
					<th> Date </th>
					<th> Time </th>
					<th> </th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
	<div class="col-md-5">
		<div class="legends" id="eqdetails"></div>
		<div id="map" style="width:100%"></div>
	</div>
	<div class="col-md-7" style="font-size:15px">
		Source: <a href="http://earthquake-report.com/" target="_blank">http://earthquake-report.com/</a>
	</div>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWbvEFC7jCLWK1dheHGWGkqksGaA5JXy0&callback=initMap"></script>
	<script>
		var map;
		function initMap() {
		  map = new google.maps.Map(document.getElementById('map'), {
		    zoom: 6,
		    center: {lat: 12.8797, lng: 122.7740},
		    mapTypeId: 'roadmap'
		  });
		  
		  var script = document.createElement('script');
		  map.data.setStyle(function(feature) {
		    var magnitude = feature.getProperty('mag');
		    return {
		      icon: getCircle(magnitude)
		    };
		  });

		  $.getJSON(serverip+"magEarthquake",function(a){
		  	eqfeed_callback(a);
		  });

		  map.data.addListener('click', mouseInToRegion);

		  $('#eqdetails').hide();

		}
		var id = "";
		var showstate = 1;
		function mouseInToRegion(e){

			$('#eqdetails').empty().append(
				"Location: "+e.feature.getProperty('place')+"<br>"+
				"Magnitude: "+e.feature.getProperty('mag')+"<br>"+
				"Depth (km): "+e.feature.getProperty('depth')+"<br>"+
				"Date/Time: "+todate(e.feature.getProperty('date_time'))+ " "+totime(e.feature.getProperty('date_time'))+"<br>"
			);

			if(id == ""){
				$('#eqdetails').show("slide", { direction: "right" }, 500);
				id = e.feature.getProperty('id');
			}else{
				
				if(id == e.feature.getProperty('id') && showstate == 1){
					$('#eqdetails').hide("slide", { direction: "right" }, 500);
					showstate = 0;
				}else{
					$('#eqdetails').show("slide", { direction: "right" }, 500);
					showstate = 1;
				}
				id = e.feature.getProperty('id');
			}

		}

		function getCircle(magnitude) {
		  return {
		    path: google.maps.SymbolPath.CIRCLE,
		    fillColor: 'red',
		    fillOpacity: .2,
		    scale: Math.pow(2, magnitude) / 2,
		    strokeColor: 'white',
		    strokeWeight: .5
		  };
		}

		function eqfeed_callback(results) {
		  map.data.addGeoJson(results);
		}

		function viewOnMap(lat,long){
			console.log(long)
			center = {lat: lat, lng: long};
			map.panTo(center);
			map.setZoom(6);
		}
	</script>
</div>
