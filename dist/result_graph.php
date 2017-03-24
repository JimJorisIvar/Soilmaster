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
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>
    <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                Gescande waardes (mg/kg) droge stof:
            </div>
            <div class="card-body">
                <div class="row">
                        <?php

                        require "razorflow_php/razorflow.php";

                        $sendid = $_SESSION["selectedscan"];
                        $scan = new Waardes($DB_con, $sendid);


                        class Soil extends StandaloneDashboard
                        {
                            public function buildDashboard()
                            {
                                global $scan;

                                if ($scan->getLoodPpm() > $scan->getLoodIntervene()) {
                                    $loodkleur = array("seriesColor" => "#E74C3C");
                                } else {
                                    if ($scan->getLoodPpm() > $scan->getLoodWarning()) {
                                        $loodkleur = array("seriesColor" => "#FFC153");
                                    } else {
                                        $loodkleur = array("seriesColor" => "#29c75f");
                                    }
                                }
                                if ($scan->getKoperPpm() > $scan->getKoperIntervene()) {
                                    $koperkleur = array("seriesColor" => "#E74C3C");
                                } else {
                                    if ($scan->getKoperPpm() > $scan->getKoperWarning()) {
                                        $koperkleur = array("seriesColor" => "#FFC153");
                                    } else {
                                        $koperkleur = array("seriesColor" => "#29c75f");
                                    }
                                }
                                if ($scan->getZinkPpm() > $scan->getZinkIntervene()) {
                                    $zinkkleur = array("seriesColor" => "#E74C3C");
                                } else {
                                    if ($scan->getZinkPpm() > $scan->getZinkWarning()) {
                                        $zinkkleur = array("seriesColor" => "#FFC153");
                                    } else {
                                        $zinkkleur = array("seriesColor" => "#29c75f");
                                    }
                                }
                                if ($scan->getKwikPpm() > $scan->getKwikIntervene()) {
                                    $kwikkleur = array("seriesColor" => "#E74C3C");
                                } else {
                                    if ($scan->getKwikPpm() > $scan->getKwikWarning()) {
                                        $kwikkleur = array("seriesColor" => "#FFC153");
                                    } else {
                                        $kwikkleur = array("seriesColor" => "#29c75f");
                                    }
                                }
                                if ($scan->getKobaltPpm() > $scan->getKobaltIntervene()) {
                                    $arseenkleur = array("seriesColor" => "#E74C3C");
                                } else {
                                    if ($scan->getKobaltPpm() > $scan->getKobaltWarning()) {
                                        $arseenkleur = array("seriesColor" => "#FFC153");
                                    } else {
                                        $arseenkleur = array("seriesColor" => "#29c75f");
                                    }
                                }
                                if ($scan->getCadmiumPpm() > $scan->getCadmiumIntervene()) {
                                    $cadmiumkleur = array("seriesColor" => "#E74C3C");
                                } else {
                                    if ($scan->getCadmiumPpm() > $scan->getCadmiumWarning()) {
                                        $cadmiumkleur = array("seriesColor" => "#FFC153");
                                    } else {
                                        $cadmiumkleur = array("seriesColor" => "#29c75f");
                                    }
                                }

                                $chart = new ChartComponent("sales_chart");
                                $chart->setCaption("");
                                $chart->setDimensions(12, 8);
                                $chart->setLabels(array("Gemeten scan"));
                                $chart->addSeries("Lood", "Lood", array($scan->getLoodPpm()),
                                    $loodkleur);
                                $chart->addSeries("Kwik", "Kwik", array($scan->getKwikPpm()),
                                    $kwikkleur);
                                $chart->addSeries("Kobalt", "Kobalt", array($scan->getKobaltPpm()),
                                    $arseenkleur);
                                $chart->addSeries("Cadmium", "Cadmium", array($scan->getCadmiumPpm()),
                                    $cadmiumkleur);
                                $chart->addSeries("Koper", "Koper", array($scan->getKoperPpm()),
                                    $koperkleur);
                                $chart->addSeries("Zink", "Zink", array($scan->getZinkPpm()),
                                    $zinkkleur);
                                $chart->setYAxis('PPM', array("numberPrefix" => '', "numberHumanize" => true));
                                $this->addComponent($chart);
                            }
                        }

                        $db = new Soil();


                        // Here, we're manually setting the static root to where the CSS and HTML is available.
                        // This is relative to the current path of index.php and will not work in more advanced
                        // scenarios like integrating into MVC and embedding.
                        $db->setStaticRoot("razorflow_php/static/rf/");
                        $db->enableDevTools();
                        $db->renderStandalone();

                        ?>
                        <hr>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <a class="card card-banner card-blue-light">
                                <div class="card-body">
                                    <i class="icon fa fa-tint fa-4x"></i>
                                    <div class="content">
                                        <div class="title">Vochtigheid</div>
                                        <div class="value"></span><?php echo $scan->getMoisture(); ?> %</div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <a class="card card-banner card-yellow-light">
                                <div class="card-body">
                                    <i class="icon fa fa-thermometer-half fa-4x"></i>
                                    <div class="content">
                                        <div class="title">Temperatuur</div>
                                        <div class="value"></span><?php echo $scan->getTemperature(); ?> ℃</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                Locatie
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="map" class="map_result"></div>
                        <script>
                            <?php
                            $loca = $scan->getLocation();
                            sscanf("($loca)", "(%f, %f)", $lat, $lng);
                            ?>
                            function initMap() {
                                var uluru = {lat: <?php echo $lat; ?>, lng: <?php echo $lng; ?>};
                                var map = new google.maps.Map(document.getElementById('map'), {
                                    zoom: 15,
                                    center: uluru
                                });
                                var marker = new google.maps.Marker({
                                    position: uluru,
                                    map: map
                                });
                            }
                          </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="card-body">
        <div class="col-md-6">
          <?php include_once "result_graph_modal.php";?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="card">
            <div class="card-header">
                Toegestane waardes
            </div>
              <div class="card-body">
                  <div class="row">
                      <div class="col-md-12">
                          <div class="col-md-12">
                              <table class="table table-striped table-bordered table-hover">
                                  <thead>
                                  <tr>
                                      <th>Stof</th>
                                      <th>Toegestane waarde (PPM)</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <tr>
                                      <td>Lood</td>
                                      <td>50</td>
                                  </tr>
                                  <tr>
                                      <td>Kwik</td>
                                      <td>50</td>
                                  </tr>
                                  <tr>
                                      <td>Arseen</td>
                                      <td>50</td>
                                  </tr>
                                  <tr>
                                      <td>Cadmium</td>
                                      <td>50</td>
                                  </tr>
                                  <tr>
                                      <td>Koper</td>
                                      <td>50</td>
                                  </tr>
                                  <tr>
                                      <td>Zink</td>
                                      <td>50</td>
                                  </tr>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>



<?php
include_once "footer.php";
?>
