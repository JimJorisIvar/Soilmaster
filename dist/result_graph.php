<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once "adminHeader.php";
?>
    <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                Scanned values (PPM)
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php

                        require "razorflow_php/razorflow.php";

                        $sendid = $_SESSION["selectedscan"];
                        $scan = new Waardes($DB_con, $sendid);


                        class Soil extends StandaloneDashboard
                        {

                            public function buildDashboard()
                            {
                                global $scan;

                                if ($scan->getLoodPpm() > 50)
                                {
                                    $loodkleur = array("seriesColor" => "#E74C3C");
                                }
                                else
                                {
                                    if ($scan->getLoodPpm() > 30)
                                        {
                                            $loodkleur = array("seriesColor" => "#FFC153");
                                        }
                                        else
                                        {
                                            $loodkleur = array("seriesColor" => "#29c75f");
                                        }
                                }
                                if ($scan->getKoperPpm() > 50)
                                {
                                    $koperkleur = array("seriesColor" => "#E74C3C");
                                }
                                else
                                {
                                        if ($scan->getKoperPpm() > 30)
                                        {
                                            $koperkleur = array("seriesColor" => "#FFC153");
                                        }
                                        else
                                        {
                                            $koperkleur = array("seriesColor" => "#29c75f");
                                        }
                                }
                                if ($scan->getZinkPpm() > 50)
                                {
                                    $zinkkleur = array("seriesColor" => "#E74C3C");
                                }
                                else
                                {
                                        if ($scan->getZinkPpm() > 30) {
                                            $zinkkleur = array("seriesColor" => "#FFC153");
                                        } else {
                                            $zinkkleur = array("seriesColor" => "#29c75f");
                                        }
                                }
                                if ($scan->getKwikPpm() > 50)
                                {
                                    $kwikkleur = array("seriesColor" => "#E74C3C");
                                }
                                else
                                {
                                        if ($scan->getKwikPpm() > 30) {
                                            $kwikkleur = array("seriesColor" => "#FFC153");
                                        } else {
                                            $kwikkleur = array("seriesColor" => "#29c75f");
                                        }
                                }
                                if ($scan->getArseenPpm() > 50)
                                {
                                    $arseenkleur = array("seriesColor" => "#E74C3C");
                                }
                                else
                                {
                                        if ($scan->getArseenPpm() > 30) {
                                            $arseenkleur = array("seriesColor" => "#FFC153");
                                        } else {
                                            $arseenkleur = array("seriesColor" => "#29c75f");
                                        }
                                }
                                if ($scan->getCadmiumPpm() > 50)
                                {
                                    $cadmiumkleur = array("seriesColor" => "#E74C3C");
                                }
                                else
                                {
                                        if ($scan->getCadmiumPpm() > 30) {
                                            $cadmiumkleur = array("seriesColor" => "#FFC153");
                                        } else {
                                            $cadmiumkleur = array("seriesColor" => "#29c75f");
                                        }
                                }

                                $chart = new ChartComponent("sales_chart");
                                $chart->setCaption("");
                                $chart->setDimensions(12, 8);
                                $chart->setLabels(array("Gemeten scan", "Toegestaan"));
                                $chart->addSeries("Lood", "Lood", array($scan->getLoodPpm(), 50),
                                    $loodkleur);
                                $chart->addSeries("Kwik", "Kwik", array($scan->getKwikPpm(), 40),
                                    $kwikkleur);
                                $chart->addSeries("Arseen", "Arseen", array($scan->getArseenPpm(), 50),
                                    $arseenkleur);
                                $chart->addSeries("Cadmium", "Cadmium", array($scan->getCadmiumPpm(), 10),
                                    $cadmiumkleur);
                                $chart->addSeries("Koper", "Koper", array($scan->getKoperPpm(), 60),
                                    $koperkleur);
                                $chart->addSeries("Zink", "Zink", array($scan->getZinkPpm(), 45),
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
                                        <div class="title">Moisture</div>
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
                                        <div class="title">Temperature</div>
                                        <div class="value"></span><?php echo $scan->getTemperature(); ?> ℃</div>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                Location
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


<?php
include_once "footer.php";
?>