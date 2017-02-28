<?php
include_once "adminHeader.php";
?>

<div class="row">
    <div class="col-xs-12">
        <div class="card card-banner card-chart card-green no-br">
            <div class="card-body">
                <div>
                    <div id="map" class="map_map"></div>
                    <script>
                        var customLabel = {
                            restaurant: {
                                label: 'R'
                            },
                            bar: {
                                label: 'B'
                            }
                        };

                        function initMap() {
                            var map = new google.maps.Map(document.getElementById('map'), {
                                center: new google.maps.LatLng(51.3851023, 4.6547483),
                                zoom: 12
                            });

                            if (navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(function(position) {
                                    var pos = {
                                        lat: position.coords.latitude,
                                        lng: position.coords.longitude
                                    };

                                    infoWindow.setPosition(pos);
                                    infoWindow.setContent('Location found.');
                                    map.setCenter(pos);
                                }, function() {
                                    handleLocationError(true, infoWindow, map.getCenter());
                                });
                            } else {
                                // Browser doesn't support Geolocation
                                handleLocationError(false, infoWindow, map.getCenter());
                            }
                            var infoWindow = new google.maps.InfoWindow;

                            // Change this depending on the name of your PHP or XML file
                            downloadUrl('mapmarkers.php', function(data) {
                                var xml = data.responseXML;
                                var markers = xml.documentElement.getElementsByTagName('marker');
                                Array.prototype.forEach.call(markers, function(markerElem) {
                                    var name = markerElem.getAttribute('name');
                                    var address = markerElem.getAttribute('address');
                                    var type = markerElem.getAttribute('type');
                                    var point = new google.maps.LatLng(
                                        parseFloat(markerElem.getAttribute('lat')),
                                        parseFloat(markerElem.getAttribute('lng')));

                                    var infowincontent = document.createElement('div');
                                    var strong = document.createElement('strong');
                                    strong.textContent = name
                                    infowincontent.appendChild(strong);
                                    infowincontent.appendChild(document.createElement('br'));

                                    var text = document.createElement('text');
                                    text.textContent = address
                                    infowincontent.appendChild(text);
                                    var icon = customLabel[type] || {};
                                    var marker = new google.maps.Marker({
                                        map: map,
                                        position: point,
                                        label: icon.label
                                    });
                                    marker.addListener('click', function() {
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

<?php
include_once "footer.php";
?>
