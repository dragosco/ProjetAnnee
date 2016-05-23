<?php
require("models/SimulationChargeGlobale.php");
require("models/Project.php");

$project = Project::getInstance();

// echo "entrou";

$iteration = $_GET['iteration'];
// echo $iteration;
$intervale = $_GET['intervale'];
//
$simulation = new SimulationChargeGlobale($iteration, $intervale, $project);
$res = $simulation->calculate();
$xAxis = $res->xAxis;
$yAxis = $res->yAxis;
//
// echo "entrou aqui!!";

$data = [];
$data['xAxis'] = $xAxis;
$data['yAxis'] = $yAxis;
// echo $xAxis;

// $data = array();

// array_push($data, array('xAxis' => $xAxis,
//                           'yAxis' => $yAxis
//                             ));

header('Content-Type: application/json');
echo json_encode($data);
//header("Location: stats.php");

?>
