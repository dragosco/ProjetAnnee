<?php
require("models/Project.php");

// Tentative d'instanciation de la classe
$project = Project::getInstance();
//require("cnx.php");

// On récupère tout le contenu de la table tâche
//$reponse = $bdd->query('SELECT * FROM tache');
?>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Gestion de projet</title>

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link href="css/joint.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>


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
  <!--/sidebar-->

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

		<div class="row">
      <h1 class="page-header">Diagramme De Pert</h1>
			<p id="waitForDiagram" class="saving">Loading Diagram <span>.</span><span>.</span><span>.</span></p>
      <section style="width:100%; height:600px; background-color: transparent;"></section>
    </div>
    <!--/.row-->
	</div><!--/.main-->

	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/lodash.min.js"></script>
	<script src="js/backbone-min.js"></script>
	<script src="js/joint.js"></script>
	<script src="js/createTask.js"></script>
	<script src="js/addTask.js"></script>
	<script src="js/show-PERT.js"></script>
</body>
</html>
