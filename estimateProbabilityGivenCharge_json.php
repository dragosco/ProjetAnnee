<?php
require("models/SimulationChargeGlobale.php");
require("models/Project.php");

$project = Project::getInstance();

$iteration = $_GET['iteration'];
$intervale = $_GET['intervale'];
$charge = $_GET['charge'];

$simulation = new SimulationChargeGlobale($iteration, $intervale, $project);
$probabilite = $simulation->estimateProbabilityGivenCharge($charge);

$data = [];
$data['probabilite'] = $probabilite;

header('Content-Type: application/json');
echo json_encode($data);

?>
