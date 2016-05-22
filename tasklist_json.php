<?php
require("models/cnx.php");
$bdd = getBdd();
$reponse = $bdd->query('SELECT * FROM tache');

$data = array();
while ($donnees = $reponse->fetch()) {
    array_push($data, array('nom' => $donnees['nom'],
                            /*'duree' => $donnees['duree'],*/
                            'precedent1' => $donnees['precedent1'],
                            'precedent2' => $donnees['precedent2'],
                            'suivant1' => $donnees['suivant1'],
                            'suivant2' => $donnees['suivant2']
    ));
}

header('Content-Type: application/json');
echo json_encode($data);
