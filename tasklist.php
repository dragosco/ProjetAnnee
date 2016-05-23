<?php
require("models/Project.php");
//require("delete2.php");

// Tentative d'instanciation de la classe
$project = Project::getInstance();

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
                <h1 class="page-header">Task List</h1>
            </div>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><span class="glyphicon glyphicon-tasks"></span>Tasks</div>
                    	<div class="panel-body">
                        <table class="table">
                            <thead>
                            	<tr>
																<th>Action</th>
                                <th>Nom</th>
                                <th>Précédent 1</th>
                                <th>Précédent 2</th>
                                <th>Suivant 1</th>
                                <th>Suivant 2</th>
                              </tr>
                            </thead>
                            <tbody>
                            	<?php
                              // On affiche chaque entrée une à une
															foreach ($project->listeTaches as $task) {
	                            ?>
	                            <tr>
																<td>
                                  <a href="update.php?id=<?php echo $task->id;?>">
                                  <span class="glyphicon glyphicon-edit" aria-hidden="true" >

                                  </span>
                                  <a href="delete.php?id=<?php echo $task->id;?>">
                                  <span class="glyphicon glyphicon-trash" aria-hidden="true">
                                  </span>
                                  <a>
                                </td>
	                              <td><?php echo $task->nom;}?></td>
	                            </tr>
                            </tbody>
                      </table>
                    </div>
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
  <script src="js/addTask.js"></script>

</body>
</html>
