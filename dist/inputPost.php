<?php
include_once "../classes/Waardes.php";
include_once "connection.php";
include_once "../interfaces/CRUD.php";
session_start();

//get the information send from input.php and post it into the database.

$waardes = new Waardes($DB_con);
$waardes->setScanName(htmlspecialchars($_POST['scanname']));
$waardes->setLocation(htmlspecialchars($_POST['location']));
$waardes->setTemperature(htmlspecialchars($_POST['temperature']));
$waardes->setMoisture(htmlspecialchars($_POST['moisture']));
$waardes->setLoodPpm(htmlspecialchars($_POST['lood']));
$waardes->setKoperPpm(htmlspecialchars($_POST['koper']));
$waardes->setZinkPpm(htmlspecialchars($_POST['zink']));
$waardes->setKwikPpm(htmlspecialchars($_POST['kwik']));

$waardes->create();


//link user to results_table.php

header('Location: results_table');

?>