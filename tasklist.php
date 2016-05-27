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
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
</head>

<body>
	<?php require 'navbar.php'; ?>

	<div class="row main">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Task List</h1>
            </div>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
					<div class="panel-heading">
						<a class="btn btn-link" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span> Add Task</a>
						<a class="btn btn-link" href="tasklist_edit.php">Edit Task List</a>
					</div>
                    	<div class="panel-body">
                        <table class="table">
                            <thead>
                            	<tr>
								<th></th>
                                <th>Name</th>
                                <th>1st predecessor</th>
                                <th>2nd predecessor</th>
                                <th>1st successor</th>
                                <th>2nd successor</th>
                                <th>Resource associated</th>
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
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </a>

                                    <a class="btn btn-link" data-toggle="modal" data-target="#modalDeleteTache<?php echo $task->id;?>">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                    <div class="modal fade" id="modalDeleteTache<?php echo $task->id;?>" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h4 class="modal-title">Delete '<?php echo $task->nom; ?>'</h4>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        Are you sure you want to delete task '<?php echo $task->nom;?>' ?
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <a class="btn btn-danger pull-right" href="delete.php?id=<?php echo $task->id; ?>">YES</a>
                                                        <a class="btn btn-success pull-right" data-dismiss="modal" aria-label="Close">NO</a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->

                                    <div class="modal fade" id="modalTache<?php echo $task->id;?>" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h4 class="modal-title">Edit '<?php echo $task->nom; ?>'</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="update.php">
                                                        <div class="row">
                                                            <div class="form-group">
                                                                <label for="nm">Change name</label>
                                                                <input type="text" class="form-control" id="nm" name="nvnom" value="<?php echo $task->nom; ?>" />
                                                                <input type="hidden" name="id" value="<?php echo $task->id;?>" />
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group">
                                                                <label for="nvloi">Change associated distribution</label>

                                                            </div>
                                                        <div class="row">
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-success pull-right">Update</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <br>




                                </td>
	                              <td><?php echo $task->nom;?></td>
	                              <td><?php echo $task->precedent1;?></td>
	                              <td><?php echo $task->precedent2;?></td>
	                              <td><?php echo $task->suivant1;?></td>
	                              <td><?php echo $task->suivant2;?></td>
	                              <td><?php echo $task->ressource->nom . ' (cj : ' . $task->ressource->cout . '€)';}?></td>
	                            </tr>
                            </tbody>
                      </table>
                    </div>
					<?php require("addTask.php") ?>
                </div><!--/panel-->
            </div>
        </div><!--/.row-->
    </div><!--/.main-->
</body>
</html>
