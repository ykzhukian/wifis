<!--link to the google map api-->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&language=en"></script>

<?php
    // link to the arrays contains the latitude and longtitude, will used to put markers on the map
    include "all_spots_query.php";
?>

<script>
    // used to calculate the distance
    if (typeof(Number.prototype.toRad) === "undefined") {
        Number.prototype.toRad = function() {
            return this * Math.PI / 180;
        }
    }
    // get user's current position
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(current_position);
    } else {
        document.getElementById("user-location").innerHTML = "Geolocation is not supported by this browser.";
    }
    // calculate the distance from user's current position and every spots, and put them in array
    var distance_array = new Array();
    function current_position(position){
        for(var i = 0; i < 55; i++ ){
            distance_array[i] = distance(position.coords.latitude, position.coords.longitude, parseFloat(latitude_array[i]), parseFloat(longitude_array[i]));
        }
    }

    // map used in item page and searching results page
    // get the centre latitude and longitude of the map, which is the spot in the searching result
    function mapInitialize(center_la, center_lo, map_id) { 
        var mapCanvas = document.getElementById(map_id);
        var mapOptions = {
            center: new google.maps.LatLng(parseFloat(center_la), parseFloat(center_lo)),
            zoom: 16,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        // create a new map
        var map = new google.maps.Map(mapCanvas, mapOptions);
        // declare marker array and infowindow array
        var markers = new Array();
        var infowindow = new google.maps.InfoWindow({});

        // put markers on the map for all the spots
        for (var i = 0; i < 55; i++) {
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(latitude_array[i], longitude_array[i]),
                map: map
            });

            markers.push(marker);

            // create the information window for every marker on the map
            if (map_id == 'map') { // this is for the item page
                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        try {
                            infowindow.setContent("<div class='black-font'>" + name_array[i]+"<br/>"+address_array[i]+"<br/>"+suburb_array[i] + "<br/>" + distance_array[i].toFixed(2) + " km to your current location</div>");
                            document.getElementById("distance").innerHTML = distance_array[i].toFixed(2) + " km to your current location";
                        } catch (err) {
                            infowindow.setContent("<div class='black-font'>" + name_array[i]+"<br/>"+address_array[i]+"<br/>"+suburb_array[i] + "<br/>" + "<div class='red-font'>Retrieving your location, please click again few seconds later.</div></div>");
                        }
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            } else { // this is for the results page
                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        try {
                            infowindow.setContent("<div class='black-font'><b><u><a href='item.php?keyword="+name_array[i]+"'>" + name_array[i] + "</b></u></a><br/>" + address_array[i] + "<br/>" + suburb_array[i] + "<br/>" + distance_array[i].toFixed(2) + " km to your current location</div>");
                        } catch (err){
                            infowindow.setContent("<div class='black-font'><b><u><a href='item.php?keyword="+name_array[i]+"'>" + name_array[i] + "</b></u></a><br/>" + address_array[i] + "<br/>" + suburb_array[i] + "<br/>" + "<div class='red-font'>Retrieving your location, please click again few seconds later.</div></div>");
                        }

                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }

        }
    }

    // this map is used in home page
    function homeMapInitialize() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            document.getElementById("user-location").innerHTML = "Geolocation is not supported by this browser.";
        }
    }
    // create the map on home page, doing the same thing as the previous one, and also move the centre of this map to 
    // the user's current position and put a circle marker for this position
    function showPosition(position) {
//        document.getElementById("user-location").innerHTML = "You are at Latitude: " + position.coords.latitude +
//        " Longitude: " + position.coords.longitude;
        var geolocate = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
        var mapCanvas = document.getElementById('home-map');
        var mapOptions = {
            center: geolocate,
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(mapCanvas, mapOptions);
        var markers = new Array();
        var infowindow = new google.maps.InfoWindow({});

        for (var i = 0; i < 56; i++) {

            if ( i != 55 ){
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(latitude_array[i], longitude_array[i]),
                    map: map
                });

                markers.push(marker);

                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        infowindow.setContent("<b><u><a href='item.php?keyword="+name_array[i]+"'>" + name_array[i] + "</b></u></a><br/>" + address_array[i] + "<br/>" + suburb_array[i] + "<br/>" + distance_array[i].toFixed(2) + " km to your current location" );
                        infowindow.open(map, marker);
                    }
                })(marker, i));

            } else {
                // put a user's marker on map using the circle marker image
                var marker = new google.maps.Marker({map: map,position: geolocate, icon:'images/marker-user.png'});
                markers.push(marker);
                infowindow.setContent("<b>You are here</b>");
                infowindow.open(map, marker);
            }
        }
    }

    // used to calculate the distance between two input positions
    function distance(lat1,lon1,lat2,lon2) {
        var R = 6371; // km
        var dLat = (lat2-lat1).toRad();
        var dLon = (lon2-lon1).toRad();
        var lat1 = lat1.toRad();
        var lat2 = lat2.toRad();
        var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
            Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(lat1) * Math.cos(lat2);
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
        var d = R * c;
        return d;
    }


</script>