<?php
require("models/SimulationChargeGlobale.php");
require("models/Project.php");

$project = Project::getInstance();

$iteration = $_POST['iteration'];
$intervale = $_POST['intervale'];

$simulation = new SimulationChargeGlobale($iteration, $intervale, $project);
$res = $simulation->calculate();
$xAxis = $res->xAxis;
$yAxis = $res->yAxis;

$data = [];
$data['xAxis'] = $xAxis;
$data['yAxis'] = $yAxis;

header('Content-Type: application/json');
echo json_encode($data);

?>
