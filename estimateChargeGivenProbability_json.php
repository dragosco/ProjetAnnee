<?php
require("models/SimulationChargeGlobale.php");
require("models/Project.php");

$project = Project::getInstance();

$iteration = $_GET['iteration'];
$intervale = $_GET['intervale'];
$probabilite = $_GET['probabilite'];

$simulation = new SimulationChargeGlobale($iteration, $intervale, $project);
$charge = $simulation->estimateChargeGivenProbability($probabilite);

$data = [];
$data['charge'] = $charge;

header('Content-Type: application/json');
echo json_encode($data);

?>
