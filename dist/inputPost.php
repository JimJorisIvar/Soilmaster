<?php
include_once "../classes/Waardes.php";
include_once "connection.php";
include_once "../interfaces/CRUD.php";
session_start();

$waardes = new Waardes($DB_con);
$waardes->setScanName(htmlspecialchars($_POST['scanname']));
$waardes->setLocation(htmlspecialchars($_POST['location']));
$waardes->setTemperature(htmlspecialchars($_POST['temperature']));
$waardes->setMoisture(htmlspecialchars($_POST['moisture']));
$waardes->setAntimoonPpm(htmlspecialchars($_POST['antimoon']));
$waardes->setArseenPpm(htmlspecialchars($_POST['arseen']));
$waardes->setBariumPpm(htmlspecialchars($_POST['barium']));
$waardes->setCadmiumPpm(htmlspecialchars($_POST['cadmium']));

$waardes->create();


$_SESSION["id"] = $waardes->getLastinsertedid();

header('Location: results_table.php');


?>