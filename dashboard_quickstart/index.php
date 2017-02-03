<?php

// Welcome to the RazorFlow PHP Dashbord Quickstart. Simply copy this "dashboard_quickstart"
// to somewhere in your PHP server to have a dashboard ready to use.
// This is a great way to get started with RazorFlow with minimal time in setup.
// However, once you're ready to go into deployment consult our documentation on tips for how to 
// maintain the most stable and secure 

// Require the library file

require "razorflow_php/razorflow.php";

class Soil extends StandaloneDashboard {
    public function buildDashboard(){

        $test = 100;
        if ($test == 100) {
            $kleur = array("seriesColor" => "#5cb85c");
        }
        else
        {
            $kleur = array("seriesColor" => "#ff3f3f");
        }

        $chart = new ChartComponent("sales_chart");
        $chart->setCaption("");
        $chart->setDimensions (12, 8);
        $chart->setLabels (array("Antimoon", "Arseen", "Barium", "Cadmium"));
        $chart->addSeries ("Maximaal toegestaan", "Maximaal toegestaan", array(40, 30, 50, 20, 80, 50, 60, 30, 30, 20, 70, 40), array(
            "seriesColor" => "#0077ff"));
        $chart->addSeries ("Meting", "Meting", array(60, 40, 50, 60, 40, 80, 45, 40, 75, 44, 23, 10),
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

