<?php
include_once "adminHeader.php";
?>

<div class="row">
  <div class="col-xs-12">
    <div class="card card-banner card-chart card-green no-br">
      <div class="card-body">
        <div>
            <div id="map" class="map_dashboard"></div>
            <script>

                //  start google maps API

                var customLabel = {
                    restaurant: {
                        label: 'R'
                    },
                    bar: {
                        label: 'B'
                    }
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
                                parseFloat(markerElem.getAttribute('lng')));

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
<div class="row">
  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <a class="card card-banner card-green-light">
  <div class="card-body">
    <i class="icon fa fa-wifi fa-4x"></i>
    <div class="content">
    <!--Get most recent scan_id from the database from this day-->
      <div class="title">Scans today</div>
      <div class="value"><span class="sign"></span>6</div>
    </div>
  </div>
</a>

  </div>
  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <a class="card card-banner card-blue-light">
  <div class="card-body">
    <i class="icon fa fa-wifi fa-4x"></i>
    <div class="content">
        <!--Get most recent scan_id from the database in total-->
      <div class="title">Total scans</div>
      <div class="value"><span class="sign"></span>13</div>
    </div>
  </div>
</a>

  </div>
  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <a class="card card-banner card-yellow-light">
  <div class="card-body">
    <i class="icon fa fa-user-plus fa-4x"></i>
    <div class="content">
<!--        Get the number of total scanning devices-->
      <div class="title">Scanning Mechanics</div>
      <div class="value"><span class="sign"></span>32</div>
    </div>
  </div>
</a>

  </div>
</div>

<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <div class="card card-mini">
      <div class="card-header">
        <div class="card-title">Recent Scans</div>
        <ul class="card-action">
          <li>
            <a href="/">
              <i class="fa fa-refresh"></i>
            </a>
          </li>
        </ul>
      </div>
      <div class="card-body no-padding table-responsive">
        <table class="table card-table">
          <thead>
            <tr>
              <th>Scan by</th>
              <th class="right">Coordinates</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Freek Willem</td>
              <td class="right">52.381829 - 4.6519018</td>
              <td><span class="badge badge-warning badge-icon"><i class="fa fa-clock-o" aria-hidden="true"></i><span>Pending</span></span></td>
            </tr>
            <tr>
              <td>Jan piet</td>
              <td class="right">49.381829 - 7.6519018</td>
              <td><span class="badge badge-danger badge-icon"><i class="fa fa-times" aria-hidden="true"></i><span>Cancelled</span></span></td>
            </tr>
            <tr>
              <td>Herman Klaassen</td>
              <td class="right">78.381829 - 2.6519018</td>
              <td><span class="badge badge-success badge-icon"><i class="fa fa-check" aria-hidden="true"></i><span>Complete</span></span></td>
            </tr>
            <tr>
              <td>Jan Piet</td>
              <td class="right">23.381829 - 6.6519018</td>
              <td><span class="badge badge-success badge-icon"><i class="fa fa-check" aria-hidden="true"></i><span>Complete</span></span></td>
            </tr>
            <tr>
              <td>Herman Klaassen</td>
              <td class="right">59.381829 - 2.6519018</td>
              <td><span class="badge badge-success badge-icon"><i class="fa fa-check" aria-hidden="true"></i><span>Complete</span></span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <div class="card card-tab card-mini">
      <div class="card-header">
        <ul class="nav nav-tabs tab-stats">
          <li role="tab1" class="active">
            <a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Browsers</a>
          </li>
          <li role="tab2">
            <a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">OS</a>
          </li>
          <li role="tab2">
            <a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab">More</a>
          </li>
        </ul>
      </div>
      <div class="card-body tab-content">
        <div role="tabpanel" class="tab-pane active" id="tab1">
          <div class="row">
            <div class="col-sm-8">
              <div class="chart ct-chart-browser ct-perfect-fourth"></div>
            </div>
            <div class="col-sm-4">
              <ul class="chart-label">
                <li class="ct-label ct-series-a">Google Chrome</li>
                <li class="ct-label ct-series-b">Firefox</li>
                <li class="ct-label ct-series-c">Safari</li>
                <li class="ct-label ct-series-d">IE</li>
                <li class="ct-label ct-series-e">Opera</li>
              </ul>
            </div>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="tab2">
          <div class="row">
            <div class="col-sm-8">
              <div class="chart ct-chart-os ct-perfect-fourth"></div>
            </div>
            <div class="col-sm-4">
              <ul class="chart-label">
                <li class="ct-label ct-series-a">iOS</li>
                <li class="ct-label ct-series-b">Android</li>
                <li class="ct-label ct-series-c">Windows</li>
                <li class="ct-label ct-series-d">OSX</li>
                <li class="ct-label ct-series-e">Linux</li>
              </ul>
            </div>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="tab3">
        </div>
      </div>
    </div>
  </div>
<?php
include_once "footer.php";
?>
