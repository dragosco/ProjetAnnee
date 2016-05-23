<?php
require("models/Project.php");
$project = Project::getInstance();

// require("models/cnx.php");
// $bdd = getBdd();
// $reponse = $bdd->query('SELECT * FROM tache');



$data = array();
foreach ($project->listeTaches as $task) {
  array_push($data, array('nom' => $task->nom,
                              /*'duree' => $donnees['duree'],*/
                              'precedent1' => $task->precedent1,
                              'precedent2' => $task->precedent2,
                              'suivant1' => $task->suivant1,
                              'suivant2' => $task->suivant2
                            ));
}
// while ($donnees = $reponse->fetch()) {
//     array_push($data, array('nom' => $donnees['nom'],
//                             /*'duree' => $donnees['duree'],*/
//                             'precedent1' => $donnees['precedent1'],
//                             'precedent2' => $donnees['precedent2'],
//                             'suivant1' => $donnees['suivant1'],
//                             'suivant2' => $donnees['suivant2']
//     ));
// }

header('Content-Type: application/json');
echo json_encode($data);
