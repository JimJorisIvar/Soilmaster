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
        $loca = $scan->getLocation();
        //sscanf splits de coordinaten in twee om deze vervolgens
        sscanf("($loca)", "(%f, %f)", $lat, $lng);
    echo '<marker id="'.$scan->getScanid().'" data-scanid="' . $scan->getScanid() . '" date="Scan van:  '.$scan->getDate().'" koper="koper: '.$scan->getKoperPpm().' PPM" address="ADDRESS HIER" name="'.$scan->getScanName().'" lat="'.$lat.'" lng="'.$lng.'" type="restaurant"/>';};?>
</markers>




