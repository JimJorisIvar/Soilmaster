<!--Bestand om de alle locaties uit de database op te halen en hier markers van te maken.-->
<?php
include_once "connection.php";
include_once "../classes/Waardes.php";
include_once "../classes/ListOfScans.php";
$scanlist = new ListOfScans($DB_con);
$listofscans = $scanlist->getListOfScans();
header("Content-type: text/xml");
?>
<markers>
    <?php
    foreach ($listofscans as $scan) {
        $splitTimeStamp = explode(" ",$scan->getDate());

        $date_from_database = $splitTimeStamp[0]; //dag uit de database
        $today = date("Y-m-d"); //vandaag

        $diff = abs(strtotime($today) - strtotime($date_from_database));

        $years = 'nothing';

        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));

//        -----------------------------------------------------------------
        $loca = $scan->getLocation();
        //sscanf splits de coordinaten in twee om deze vervolgens
        sscanf("($loca)", "(%f, %f)", $lat, $lng);
//        -----------------------------------------------------------------
    echo '<marker id="'.$scan->getScanid().'" data-scanid="' . $scan->getScanid() . '" date="Scan van:  '.$scan->getDate().'" name="'.$scan->getScanName().'" lat="'.$lat.'" lng="'.$lng.'" type="' . $months .'"/>';};?>
</markers>




