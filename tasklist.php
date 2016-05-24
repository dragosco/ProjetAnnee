<?php
require("models/Project.php");

// Tentative d'instanciation de la classe
$project = Project::getInstance();

?>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Gestion de projet</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/joint.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/lodash.min.js"></script>
    <script src="js/backbone-min.js"></script>
    <script src="js/joint.js"></script>
    <script src="js/createTask.js"></script>
    <script src="js/addTask.js"></script>
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
								<th></th>
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
                                  <a class="btn btn-link" data-toggle="modal" data-target="#modalTache<?php echo $task->id;?>" >
                                      <span class="glyphicon glyphicon-edit" aria-hidden="true" >
                                      </span>
                                  </a>
                                    <div class="modal fade" id="modalTache<?php echo $task->id;?>" role="dialog">
                                        <div class="modal-dialog">
                                                <div class="modal-body">
                                                    <form method="post" action="update.php">
                                                        <div class="form-group">
                                                            <input type="hidden" name="id" value="<?php echo $task->id;?>" />
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="nm">Nom</label>
                                                            <input type="text" class="form-control" id="nm" name="nvnom" value="<?php echo $task->nom; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="gd">suivant1</label>
                                                            <input type="text" class="form-control" id="sv1" name="nvsuivant1" value="<?php echo $task->suivant1; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="gd">suivant2</label>
                                                            <input type="text" class="form-control" id="sv2" name="nvsuivant2" value="<?php echo $task->suivant2; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="gd">precedent1</label>
                                                            <input type="text" class="form-control" id="pr1" name="nvprecedent1" value="<?php echo $task->precedent1; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="gd">precedent2</label>
                                                            <input type="text" class="form-control" id="pr2" name="nvprecedent2" value="<?php echo $task->precedent2; ?>">
                                                        </div>

                                                        <button type="submit" class="btn btn-success">Update</button>
                                                    </form>
                                                </div>
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
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
</body>
</html>
