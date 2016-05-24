<?php
require("models/SimulationChargeGlobale.php");
require("models/Project.php");

$project = Project::getInstance();

$iteration = $_POST['iteration'];
$intervale = $_POST['intervale'];
$probabilite = $_POST['probabilite'];

$simulation = new SimulationChargeGlobale($iteration, $intervale, $project);
$charge = $simulation->estimateChargeGivenProbability($probabilite);

$data = [];
$data['charge'] = $charge;

header('Content-Type: application/json');
echo json_encode($data);

?>
