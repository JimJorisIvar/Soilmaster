<?php
session_start();
include_once "adminheader.php";
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

$id = $_SESSION["id"];
$waardes = new Waardes($DB_con, $id);


class Soil extends StandaloneDashboard {

    public function buildDashboard(){
        global $waardes;
        $test = 100;
        if ($test == 100) {
            $kleur = array("seriesColor" => "#29c75f");
        }
        else
        {
            $kleur = array("seriesColor" => "#E74C3C");
        }

        $chart = new ChartComponent("sales_chart");
        $chart->setCaption("");
        $chart->setDimensions (12, 8);
        $chart->setLabels (array("Antimoon", "Arseen", "Barium", "Cadmium"));
        $chart->addSeries ("Maximaal toegestaan", "Maximaal toegestaan", array(40, 30, 50, 20), array(
            "seriesColor" => "#0077ff"));
        $chart->addSeries ("Meting", "Meting", array($waardes->getAntimoonPpm(), $waardes->getArseenPpm(), $waardes->getBariumPpm(), $waardes->getCadmiumPpm()),
            $kleur);
        $chart->setYAxis('PPM', array("numberPrefix"=> '', "numberHumanize"=> true));
        $this->addComponent ($chart);
    }
}

$db = new Soil();




// Here, we're manually setting the static root to where the CSS and HTML is available.
// This is relative to the current path of index.php and will not work in more advanced
// scenarios like integrating into MVC and embedding.
$db->setStaticRoot ("razorflow_php/static/rf/");
$db->enableDevTools ();
$db->renderStandalone();

?>
                                <hr>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <a class="card card-banner card-blue-light">
                                            <div class="card-body">
                                                <i class="icon fa fa-tint fa-4x"></i>
                                                <div class="content">
                                                    <div class="title">Moisture</div>
                                                    <div class="value"></span><?php echo $waardes->getMoisture();?> %</div>
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
                                                <div class="value"></span><?php echo $waardes->getTemperature();?>  ℃</div>
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
                        <div id="map"></div>
                        <script>
                            function initMap() {
                                var uluru = {lat: 52.4407972, lng: 4.6547483};
                                var map = new google.maps.Map(document.getElementById('map'), {
                                    zoom: 14,
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