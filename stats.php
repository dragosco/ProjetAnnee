<?php
//require("cnx.php");
require("models/Project.php");

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
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php"><span>Gestion</span>De<span>Projet</span></a>

                <ul class="nav navbar-top-links navbar-right">
                        <a href="login.php" class="navbar-brand">| <span class="glyphicon glyphicon-user"></span> Logout</a>
				</ul>
                <ul class="nav navbar-top-links navbar-right">
                        <a href="stats.php" class="navbar-brand">| <span class="glyphicon glyphicon-stats"></span> Statistiques</a>
                </ul>
                <ul class="nav navbar-top-links navbar-right">
                        <a href="tasklist.php" class="navbar-brand">| <span class="glyphicon glyphicon-th-list"></span> Liste Des Tâches</a>
                </ul>
                <ul class="nav navbar-top-links navbar-right">
                        <a href="index.php" class="navbar-brand"><span class="glyphicon glyphicon-random"></span> Pert</a>
                </ul>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<!--sidebar-->
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">

            <div class="col-md-12">
                <br>
                <button class="btn btn-default btn-block" type="button" name="submit" id="addTaskButton">
                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Add Task</button>
            </div>
            <!-- Le paramètrage de la tâche est initialement caché -->
            <div class="row" id="taskConfig">
                <div class="row">
                    <div class="col-md-12"><input class="form-control" id="taskInput" type="text" name="taskName" placeholder="Task name" /></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6 ">
                        <fieldset class="form-group">
                            <label class="formLabel" for="leftTaskSelector">Follows</label>
                            <select class="form-control" id="leftTaskSelector" data-toggle="tooltip" data-placement="right" title="Choose the task(s) it follows <br/> [Ctrl + Select] for multiple choices"multiple>
                                <option>Start</option>
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <fieldset class="form-group">
                            <label class="formLabel" for="rightTaskSelector">Precedes</label>
                            <select class="form-control" id="rightTaskSelector" data-toggle="tooltip" data-placement="right" title="Choose the task(s) it precedes <br/> [Ctrl + Select] for multiple choices" multiple>
                                <option>End</option>
                            </select>
                        </fieldset>
                    </div>
                </div>
                <div class="col-md-12">
                <div class="row">
                	<label class="formLabel" for="probaLawBtnGroup">Probability Law</label>
                </div>
                </div>
                <div class="col-md-12 btn-group btn-group-justified" data-toggle="buttons" id="probaLawBtnGroup">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-law" value="1">υ</button>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-law" value="2">β</button>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-law" value="3">Λ</button>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-law" value="4">σ</button>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-law" value="5">[σ]</button>
                        </div>
                </div>
                <hr>
                <div class="law col-md-12" id="blk-1">
                    <p><b>loi uniforme</b></p>
                    <div class="form-group">
                <input type="text" class="form-control" placeholder="Min">
                     </div>
                     <div class="form-group">
                <input type="text" class="form-control" placeholder="Max">
                     </div>
                </div>
                <div class="law col-md-12" id="blk-2">
                    <p><b>loi beta</b></p>
                    <div class="form-group">
                <input type="text" class="form-control" placeholder="Min">
                     </div>
                     <div class="form-group">
                <input type="text" class="form-control" placeholder="Max">
                     </div>
                     <div class="form-group">
                <input type="text" class="form-control" placeholder="V">
                     </div>
                     <div class="form-group">
                <input type="text" class="form-control" placeholder="W">
                     </div>
                </div>
                <div class="law col-md-12" id="blk-3">
                    <p><b>loi triangulaire</b></p>
                <div class="form-group">
                <input type="text" class="form-control" placeholder="Min">
                     </div>
                     <div class="form-group">
                <input type="text" class="form-control" placeholder="Max">
                     </div>
                     <div class="form-group">
                <input type="text" class="form-control" placeholder="C">
                     </div>
                 </div>
                <div class="law col-md-12" id="blk-4">
                    <p><b>loi normale</b></p>
                    <div class="form-group">
                <input type="text" class="form-control" placeholder="Min">
                     </div>
                     <div class="form-group">
                <input type="text" class="form-control" placeholder="Max">
                     </div>
                     <div class="form-group">
                <input type="text" class="form-control" placeholder="Mu">
                     </div>
                     <div class="form-group">
                <input type="text" class="form-control" placeholder="Sigma">
                     </div>
                </div>
                <div class="law col-md-12" id="blk-5">
                    <p><b>loi normale tronquée</b></p>
                    <div class="form-group">
                <input type="text" class="form-control" placeholder="Min">
                     </div>
                     <div class="form-group">
                <input type="text" class="form-control" placeholder="Max">
                     </div>
                     <div class="form-group">
                <input type="text" class="form-control" placeholder="Mu">
                     </div>
                     <div class="form-group">
                <input type="text" class="form-control" placeholder="Sigma">
                     </div>
                </div>
                <div class="col-md-12">
                <div class="row">
                	<button class="btn btn-default btn-block" id="createTaskButton" type="submit" name="submit" onclick="createTask();">Create task</button>
                </div>
            </div>
            </div>
            <div class="col-md-12">
                <button class="btn btn-default btn-block" type="button" name="submit" id="addLinkButton">
                    <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span> Add Link</button>
            </div>
            <div class="row" id="linkConfig">
                <div class="col-md-6 ">
                    <fieldset class="form-group">
                        <label class="formLabel" for="leftTaskSelector">Source</label>
                        <select class="form-control" id="sourceSelector" data-toggle="tooltip" data-placement="right" title="Choose link's source">
                            <option>Start</option>
                        </select>
                    </fieldset>
                </div>
                <div class="col-md-6">
                    <fieldset class="form-group">
                        <label class="formLabel" for="rightTaskSelector">Target</label>
                        <select class="form-control" id="targetSelector" data-toggle="tooltip" data-placement="right" title="Choose link's target">
                            <option>End</option>
                        </select>
                    </fieldset>
                </div>
                <br>
                <div class="col-md-12">
                	<button class="btn btn-default" id="createLinkButton" type="submit" name="submit" onclick="createLink();">Create link</button>
                </div>
            </div>
	</div>
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
					<div class="panel-heading"><span class="glyphicon glyphicon-stats"></span> Statistiques</div>

						<h1><?php echo $project->nom;?></h1>

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
