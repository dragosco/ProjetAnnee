<?php
//require("cnx.php");
require("models/Project.php");
//require("models/SimulationMC.php");
require("models/SimulationChargeGlobale.php");

// Tentative d'instanciation de la classe
$project = Project::getInstance();

// On récupère tout le contenu de la table tâche
//$reponse = $bdd->query('SELECT * FROM tache');
?>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Gestion de projet</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<link href="css/joint.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>

<!--[if lt IE 9]>
<link href="css/rgba-fallback.css" rel="stylesheet">
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<!--navbar-->
	<?php
		require 'navbar.php';
	?>
  <!--/navbar-->
	<!--sidebar-->
	<?php
		require 'sidebar.php';
	?>
  <!--/.sidebar-->

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Gestion De Projet</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"><span class="glyphicon glyphicon-stats"></span>Statistiques</div>
						<?php
							$nbEchantillons = 10000;
							$largeurIntervalle = 20;

							$simulation = new SimulationChargeGlobale($nbEchantillons, $largeurIntervalle, $project);
							$res = $simulation->calculate();
							$xAxis = $res->xAxis;
							$yAxis = $res->yAxis;

							for($cc = 0; $cc < count($xAxis); $cc++)
							{
								echo($xAxis[$cc] . ' : ' . $yAxis[$cc]);
								echo("<br>");
							}

							$proba = 70;
							echo "resultat ChargeGivenProbability " . $simulation->estimateChargeGivenProbability($proba);
							echo("<br>");
							$charge = 90;
							echo "resultat ProbabilityGivenCharge " . $simulation->estimateProbabilityGivenCharge($charge);
						?>
				</div>
			</div>
		</div><!--/.row-->
	</div><!--/.main-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script src="js/bootstrap-table.js"></script>
	<script src="js/jquery.min.js"></script>
  <script src="js/lodash.min.js"></script>
  <script src="js/backbone-min.js"></script>
  <script src="js/joint.js"></script>
  <script src="js/createTask.js"></script>
  <!-- src -->
  <script src="js/addTask.js"></script>

</body>
</html>
