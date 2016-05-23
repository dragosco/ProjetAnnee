<?php
//require("cnx.php");
require("models/Project.php");
//require("models/SimulationMC.php");
//require("models/SimulationChargeGlobale.php");

// Tentative d'instanciation de la classe
$project = Project::getInstance();

// On récupère tout le contenu de la table tâche
//$reponse = $bdd->query('SELECT * FROM tache');
?>

<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/highcharts-3d.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>

		<script src="js/stats.js"></script>

		<link href="css/themecharts.css" rel="stylesheet">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/datepicker3.css" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet">
		<link href="css/joint.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Gestion de projet</title>


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
		      <h1 class="page-header">Statistiques</h1>
		    </div>
		  </div><!--/.row-->

		  <div class="row">
		    <div class="col-lg-12">
		      <div class="panel panel-default">
		        <div class="panel-heading"><span class="glyphicon glyphicon-tasks"></span> Monte Carlo</div>
		        <div class="panel-body">
							<div class="row">
		            <div class="col-md-4"><input class="form-control" id="iteration" type="text" name="iteration" placeholder="Nombre d'itération" /></div>
		            <div class="col-md-4"><input class="form-control" id="intervale" type="text" name="intervale" placeholder="Intervale" /></div>
		            <div class="col-md-4">
		              <!-- <form methode ="POST" action ="traitement.php"> -->
										<button class="btn btn-primary btn-block" type="submit" onclick="calculate(iteration.value, intervale.value)">
											Generate Graph
										</button>
									<!-- </form> -->
		            </div>
		        	</div>
							<div class="row">
								<div class="col-md-4"><input class="form-control" id="charge" type="text" name="charge" placeholder="Charge" /></div>
		            <div class="col-md-4">
		              <!-- <form methode ="POST" action ="traitement.php"> -->
										<button class="btn btn-primary btn-block" type="submit" onclick="estimateProbabilityGivenCharge(iteration.value, intervale.value, charge.value)">
											ok
										</button>
									<!-- </form> -->
		            </div>
								<div class="col-md-4"><input class="form-control" id="probabilite" type="text" name="probabilite" placeholder="Probabilité" /></div>
		        	</div>
							<div class="row">
								<div class="col-md-4"><input class="form-control" id="probabiliteGivenProbability" type="text" name="probabiliteGivenProbability" placeholder="Probabilité" /></div>
		            <div class="col-md-4">
		              <!-- <form methode ="POST" action ="traitement.php"> -->
										<button class="btn btn-primary btn-block" type="submit" onclick="estimateChargeGivenProbability(iteration.value, intervale.value, probabiliteGivenProbability.value)">
											ok
										</button>
									<!-- </form> -->
		            </div>
								<div class="col-md-4"><input class="form-control" id="chargeGivenProbability" type="text" name="chargeGivenProbability" placeholder="Charge" /></div>
		        	</div>
		          <br><br> <div id="container" style="height: 400px; width: 100%;"></div>
					 	</div>
		      </div>
		    </div>
		  </div><!--/.row-->
		</div><!--/.main-->
	</body>
</html>
