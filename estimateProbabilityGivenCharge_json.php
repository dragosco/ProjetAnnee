<?php
require("models/SimulationChargeGlobale.php");
require("models/Project.php");

$project = Project::getInstance();

$iteration = $_POST['iteration'];
$intervale = $_POST['intervale'];
$charge = $_POST['charge'];

$simulation = new SimulationChargeGlobale($iteration, $intervale, $project);
$probabilite = $simulation->estimateProbabilityGivenCharge($charge);

$data = [];
$data['probabilite'] = $probabilite;

header('Content-Type: application/json');
echo json_encode($data);

?>
