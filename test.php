<?php
include_once "classes/waardes.php";
include_once "connection.php";
include_once "interfaces/CRUD.php";

$id = 21;

$waardes = new Waardes($DB_con, $id);
echo $waardes->getAntimoonPpm();
echo $waardes->getArseenPpm();
echo $waardes->getBariumPpm();
echo $waardes->getCadmiumPpm();
echo $waardes->getChroomPpm();
echo $waardes->getCobaltPpm();
echo $waardes->getKoperPpm();
echo $waardes->getKwikPpm();
echo $waardes->getLoodPpm();
echo $waardes->getMolybeenPpm();
echo $waardes->getNikkelPpm();
echo $waardes->getZinkPpm();

