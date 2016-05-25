<?php
//require("models/SimulationChargeGlobale.php");
require("models/Project.php");

$project = Project::getInstance();

$typeSimulateur = $_POST['typeSimulateur'];
$iteration = $_POST['iteration'];
$intervalle = $_POST['intervalle'];

$res = $project->executeSimulation($typeSimulateur, $iteration, $intervalle);

// $simulation = new SimulationChargeGlobale($iteration, $intervalle, $project);
// $res = $simulation->calculate();
$xAxis = $res->xAxis;
$yAxis = $res->yAxis;

$data = [];
$data['xAxis'] = $xAxis;
$data['yAxis'] = $yAxis;

header('Content-Type: application/json');
echo json_encode($data);

?>
