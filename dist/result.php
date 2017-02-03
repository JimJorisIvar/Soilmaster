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

</div>
                        </div>
                    </div>
                </div>
        </div>
    </div>

<?php
include_once "footer.php";
?>