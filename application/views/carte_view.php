<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// From a tuto of Ian Luckraft: http://ianluckraft.co.uk/2011/04/google-maps-v3-and-geolocation/
?><!DOCTYPE html>
<html>
<head>
	<title>Carte - myApp</title>
	<style>
		body {
			width: 100%;
			height: 100%;
			margin: 0;
			padding: 0;
			font-family: calibri, arial;
		}

		#map {
			width:100vw;
			height:100vh;
		}

		#logout {
			position: fixed;
			top: 0;
			right: 0;
			z-index: 10;
		}

		#logout a {
			text-decoration: none;
			font-weight: bold;
		}
	</style>

	<!-- Load the Google APIs -->
	<script src="http://www.google.com/jsapi"></script>
	<script>
 // Load the map scripts
 google.load('maps', '3', {other_params:'sensor=true'});

 // Function to create a map and check for geolocation
 function mapInit() {
	 // Set the options to be used when creating the map
	 var myOptions = {
	 	zoom: 0,
	 	center: new google.maps.LatLng(0, 0),
	 	mapTypeControl: 0,
	 	streetViewControl: 0,
	 	mapTypeId: google.maps.MapTypeId.ROADMAP
	 };
	 // Create the map
	 map = new google.maps.Map(document.getElementById("map"), myOptions);
	 // Check if the browser supports geolocation
	 if(navigator.geolocation) {
	 	navigator.geolocation.getCurrentPosition(currentPositionCallback);
	 } else {
	 	alert('The browser does not support geolocation');
	 }
}

function currentPositionCallback(position) {
	// Create a new latlng based on the latitude and longitude from the user's position
	var user_lat_long = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

	//Setting the icon with the user profile picture
	var markerIcon = {
		// Set the profile picture path
		url: "<?php echo $this->session->userdata('instagram-profile-picture') ?>",
		// Rescale the profil picture to 30px x 30px
		scaledSize: new google.maps.Size(30, 30),
		// The point on the image to measure the anchor from. 0, 0 is the top left.
		origin: new google.maps.Point(0, 0),
		// The x y coordinates of the anchor point on the marker.
		anchor: new google.maps.Point(15, 15)
	};

	//Creating the marker using the user_lat_long position
	var marker = new google.maps.Marker({
		  position: user_lat_long,
	      map: map,
		  icon: markerIcon
	});

	// Setting the info window with the correct message
	var infoWindow = new google.maps.InfoWindow({ content: "L'utilisateur " + "<?php echo $this->session->userdata('instagram-username') ?>" + " est loggué" });

	// Add an eventListener to open/close the info window when marker is clicked
	marker.addListener('click', function() {
		if (infoWindow.getMap() !== null)
		{
			infoWindow.close(map, marker);
		}
		else
		{
			infoWindow.open(marker.get('map'), marker);
		}
	});

	 // Set the center of the map to the user's position and zomm into a more detailed level
	 map.setCenter(user_lat_long);
	 map.setZoom(15);
}

google.setOnLoadCallback(mapInit);

</script>
</head>
<body>
	<div id="map"></div>
	<div id="logout"><a href="Logout">Logout</a></div>
	<div style="display:none" onclick="Logout"><iframe src="https://instagram.com/accounts/logout/" width="0" height="0"></iframe></div>
</body>
</html
