<?php
// require("models/SimulationChargeGlobale.php");
require("models/Project.php");

$project = Project::getInstance();

$typeSimulateur = $_POST['typeSimulateur'];
$iteration = $_POST['iteration'];
$intervalle = $_POST['intervalle'];
$charge = $_POST['charge'];

$probabilite = $project->estimateProbability($typeSimulateur, $iteration, $intervalle, $charge);
// $simulation = new SimulationChargeGlobale($typeSimulateur, $iteration, $intervalle, $project);
// $probabilite = $simulation->estimateProbabilityGivenCharge($charge);

$data = [];
$data['probabilite'] = $probabilite;

header('Content-Type: application/json');
echo json_encode($data);

?>
