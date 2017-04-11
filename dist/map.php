<?php
require_once "../classes/Login.php";
$login = new Login();
if ($login->checkUserLevel() == true) {
    // the user is logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are logged in" view.
    include("adminHeader.php");

} elseif ($login->checkUserLevel() == false) {
    include("normalHeader.php");

} else {
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
    include("login.php"); }
?>

<div class="row">
    <div class="col-xs-12">
        <div class="card card-banner card-chart card-green no-br">
            <div class="card-body">
                <div>
                    <div id="map" class="map_map"></div>
                    <script>
                            //  start google maps API

                        var customLabel = {
                            0: {
                                label: '0'
                            },
                            1: {
                                label: '1'
                            },
                            2: {
                                label: '2'
                            },
                            3: {
                                label: '3'
                            },
                            4: {
                                label: '4'
                            },
                            5: {
                                label: '5'
                            },
                            6: {
                                label: '6'
                            },

                        };
                            //  Create the map
                        function initMap() {
                            var map = new google.maps.Map(document.getElementById('map'), {
                                center: new google.maps.LatLng(52.3851023, 4.6547483),
                                zoom: 12
                            });
                                //   Use user location
                            if (navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(function (position) {
                                    var pos = {
                                        lat: position.coords.latitude,
                                        lng: position.coords.longitude
                                    };

                                    infoWindow.setPosition(pos);
                                    infoWindow.setContent('U bevindt zich hier.');
                                    map.setCenter(pos);
                                }, function () {
                                    handleLocationError(true, infoWindow, map.getCenter());
                                });
                            } else {
                                // Browser doesn't support Geolocation
                                handleLocationError(false, infoWindow, map.getCenter());
                            }


                        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                            infoWindow.setPosition(pos);
                            infoWindow.setContent(browserHasGeolocation ?
                                'Error: The Geolocation service failed.' :
                                'Error: Your browser doesn\'t support geolocation.');
                        }
                            // Create infowindow for marker click
                            function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                                infoWindow.setPosition(pos);
                                infoWindow.setContent(browserHasGeolocation ?
                                    'Error: The Geolocation service failed.' :
                                    'Error: Your browser doesn\'t support geolocation.');
                                }

                            var infoWindow = new google.maps.InfoWindow;

                            // Link to mapmarkers.php to recieve the markerdata and get attributes from it

                            downloadUrl('mapmarkers.php', function(data) {
                                var xml = data.responseXML;
                                var markers = xml.documentElement.getElementsByTagName('marker');
                                Array.prototype.forEach.call(markers, function(markerElem) {
                                    var name = markerElem.getAttribute('name');
                                    var address = markerElem.getAttribute('address');
                                    var date = markerElem.getAttribute('date');
                                    var id = markerElem.getAttribute('id');
                                    var type = markerElem.getAttribute('type');
                                    var point = new google.maps.LatLng(
                                        parseFloat(markerElem.getAttribute('lat')),
                                        parseFloat(markerElem.getAttribute('lng'))
                                    );

                                    var infowincontent = document.createElement('div');
                                    var strong = document.createElement('strong');
                                    strong.textContent = name;
                                    infowincontent.appendChild(strong);
                                    infowincontent.appendChild(document.createElement('br'));
                                    infowincontent.appendChild(document.createElement('br'));

                                    var text = document.createElement('text');
                                    text.textContent = [date];
                                    infowincontent.appendChild(text);

                                    infowincontent.appendChild(document.createElement('br'));
                                    infowincontent.appendChild(document.createElement('br'));

                                    // Create link to scanresult in infowindow

                                    var link = document.createElement('a');
                                    var linkText = document.createTextNode('Scan resultaat inzien');
                                    link.setAttribute('href', "result_graph");
                                    link.appendChild(linkText);
                                    infowincontent.appendChild(link);

                                    var icon = customLabel[type] || {};
                                    var marker = new google.maps.Marker({
                                        map: map,
                                        position: point,
                                        label: icon.label
                                    });

                                    // send Json data to setSelected and after to result_graph to show information about the clicked marker ID

                                    marker.addListener('click', function() {
                                        id = id;
                                        var postData = {
                                            'id': id
                                        };

                                        var url = "setSelected";

                                        $.ajax({
                                            type: "POST",
                                            url: url,
                                            data: postData,
                                            dataType: "json",
                                            success: function(data)
                                            {
                                            }
                                        });
                                    //  window.open("result_graph");
                                        infoWindow.setContent(infowincontent);
                                        infoWindow.open(map, marker);
                                    });
                                });
                            });
                        }

                        function downloadUrl(url, callback) {
                        var request = window.ActiveXObject ?
                        new ActiveXObject('Microsoft.XMLHTTP') :
                        new XMLHttpRequest;

                        request.onreadystatechange = function() {
                        if (request.readyState == 4) {
                        request.onreadystatechange = doNothing;
                        callback(request, request.status);
                        }
                        };

                        request.open('GET', url, true);
                        request.send(null);
                        }

                        function doNothing() {}
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<html>
<head></head>
<body>
</body>
</html>

<?php
include_once "footer.php";
?>
