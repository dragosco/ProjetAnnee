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
						<a class="btn btn-link" data-toggle="modal" data-target=".bs-example-modal-lg"><span class="glyphicon glyphicon-plus"></span> Add Task</a>
						<a class="btn btn-link" href="tasklist_edit.php">Edit Task List</a>
					</div>
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
                                <th>Ressource associée</th>
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
                                                    <form method="POST" action="update.php">
                                                        <div class="form-group">
                                                            <input type="hidden" name="id" value="<?php echo $task->id;?>" />
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="nm">Nom</label>
                                                            <input type="text" class="form-control" id="nm" name="nvnom" value="<?php echo $task->nom; ?>" />
                                                        </div>

														<div class="form-group">
															<label for="nm">Loi</label>
															<input type="text" class="form-control" />
														</div>

                                                        <button type="submit" class="btn btn-success">Update</button>
                                                    </form>
                                                </div>
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
									<a class="btn btn-link" data-toggle="modal" data-target="#modalDeleteTache<?php echo $task->id;?>">
                                      <span class="glyphicon glyphicon-trash" aria-hidden="true" >
                                      </span>
									</a>
									<div class="modal fade" id="modalDeleteTache<?php echo $task->id;?>" role="dialog">
										<div class="modal-dialog">
											<div class="modal-header">
												Are you sure you want to delete task '<?php echo $task->nom;?>' ?
											</div>
											<div class="modal-body">


												<a href="delete.php?id=<?php echo $task->id; ?>">YES</a>
											</div>
										</div><!-- /.modal-dialog -->
									</div><!-- /.modal -->
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
										<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
										<br><br><br><br><br><br>
										<div class="modal-dialog">
										<div class="modal-header">
										        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										        <h4 class="modal-title">Add Task</h4>
										      </div>
										            <!-- Le paramètrage de la tâche est initialement caché -->
										            <form method="POST" action="insert.php">
										            <div class="row" >
										                <br>
										                <div class="row">
										                    <div class="col-md-12"><input class="form-control" id="taskInput" type="text" name="nom" placeholder="Task name" /></div>
										                </div>
										                <br>
										                <div class="row">
										                    <div class="col-md-6 ">
										                        <fieldset class="form-group">
										                            <label class="formLabel" for="leftTaskSelector1">1st predecessor</label>
										                            <select class="form-control" id="leftTaskSelector1" name="prec1">
																		<option value="Start">Start</option>
																		<?php foreach ($project->listeTaches as $task) { ?>
																				<option value="<?php echo $task->nom ?>"><?php echo $task->nom ?></option>
																		<?php }?>
										                            </select>
										                        </fieldset>
										                    </div>
															<div class="col-md-6 ">
																<fieldset class="form-group">
																	<label class="formLabel" for="leftTaskSelector2">2nd predecessor</label>
																	<select class="form-control" id="leftTaskSelector2" name="prec2">
																		<option value="Start">Start</option>
																		<?php foreach ($project->listeTaches as $task) { ?>
																			<option value="<?php echo $task->nom ?>"><?php echo $task->nom ?></option>
																		<?php }?>
																		<option value="" selected>none</option>
																	</select>
																</fieldset>
															</div>
										                    <div class="col-md-6">
										                        <fieldset class="form-group">
										                            <label class="formLabel" for="rightTaskSelector1">1st successor</label>
										                            <select class="form-control" id="rightTaskSelector1" name="suiv1">
																		<option value="End">End</option>
																		<?php foreach ($project->listeTaches as $task) { ?>
																			<option value="<?php echo $task->nom ?>"><?php echo $task->nom ?></option>
																		<?php }?>
										                            </select>
										                        </fieldset>
										                    </div>
															<div class="col-md-6">
																<fieldset class="form-group">
																	<label class="formLabel" for="rightTaskSelector2">2nd successor</label>
																	<select class="form-control" id="rightTaskSelector2" name="suiv2">
																		<option value="End">End</option>
																		<?php foreach ($project->listeTaches as $task) { ?>
																			<option value="<?php echo $task->nom ?>"><?php echo $task->nom ?></option>
																		<?php }?>
																		<option value="" selected>none</option>
																	</select>
																</fieldset>
															</div>
										                </div>
										                <br>
														<div class="col-md-12">
															<div class="row">
																<label class="formLabel" for="resource">Resource</label>
																<select class="form-control" id="rightTaskSelector2" name="idRessource">
																	<?php foreach ($project->listeRessources as $ressource) { ?>
																		<option value="<?php echo $ressource->id ?>"><?php echo $ressource->nom .' (cj : ' . $ressource->cout . '€)' ?></option>
																	<?php }?>
																</select>
															</div>
														</div>
										                <div class="col-md-12">
										                <div class="row">
										                    <label class="formLabel" for="probaLawBtnGroup">Probability Law</label>
										                </div>
										                </div>
														<input type="hidden" id="lawName" name="nomLoi" value=""/>
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
										                            <button type="button" class="btn btn-default btn-law" value="5">no law</button>
										                        </div>
										                </div>
										                <div class="law col-md-12" id="blk-1">
										                    <p><b>loi uniforme</b></p>
										                    <div class="form-group">
										                		<input type="text" class="form-control" placeholder="Min" name="min_unif">
										                     </div>
										                     <div class="form-group">
										                		<input type="text" class="form-control" placeholder="Max" name="max_unif">
										                     </div>
										                </div>
										                <div class="law col-md-12" id="blk-2">
										                    <p><b>loi beta</b></p>
										                    <div class="form-group">
										                		<input type="text" class="form-control" placeholder="Min" name="min_beta">
										                     </div>
										                     <div class="form-group">
										                		<input type="text" class="form-control" placeholder="Max" name="max_beta">
										                     </div>
										                     <div class="form-group">
										                		<input type="text" class="form-control" placeholder="V" name="v">
										                     </div>
										                     <div class="form-group">
										                		<input type="text" class="form-control" placeholder="W" name="w">
										                     </div>
										                </div>
										                <div class="law col-md-12" id="blk-3">
										                    <p><b>loi triangulaire</b></p>
										                	<div class="form-group">
										                		<input type="text" class="form-control" placeholder="Min" name="min_triang">
										                     </div>
										                     <div class="form-group">
										                		<input type="text" class="form-control" placeholder="Max" name="max_triang">
										                     </div>
										                     <div class="form-group">
										                		<input type="text" class="form-control" placeholder="c" name="c">
										                     </div>
										                 </div>
										                <div class="law col-md-12" id="blk-4">
										                    <p><b>loi normale</b></p>
										                    <div class="form-group">
										                		<input type="text" class="form-control" placeholder="Min" name="min_norm">
										                     </div>
										                     <div class="form-group">
										                		<input type="text" class="form-control" placeholder="Max" name="max_norm">
										                     </div>
										                     <div class="form-group">
										                		<input type="text" class="form-control" placeholder="Mu" name="mu">
										                     </div>
										                     <div class="form-group">
										                		<input type="text" class="form-control" placeholder="Sigma" name="sigma">
										                     </div>
										                </div>
										                <div class="law col-md-12" id="blk-5">
										                    <p><b>sans loi</b></p>
										                    <div class="form-group">
										                		<input type="text" class="form-control" placeholder="fixed value" name="valeur">
										                     </div>
										                </div>
										                <div class="col-md-12">
															<div class="modal-footer">
																<input type="submit" class="btn btn-success" id="createTaskButton" type="submit" name="submit"></button>
																<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
														  	</div>
										                <br>
										            </div>
										            </div>
										        </form>

										    </div>
										</div>

										<!--End Modal-->


                </div>
            </div>
        </div><!--/.row-->
    </div><!--/.main-->
</body>
</html>
