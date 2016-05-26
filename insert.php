<?php

require("models/Project.php");

$project = Project::getInstance();

$nom = $_POST['nom'];
$prec1 = $_POST['prec1'];
$prec2 = $_POST['prec2'];
$suiv1 = $_POST['suiv1'];
$suiv2 = $_POST['suiv2'];
$idRessource = $_POST['idRessource'];
$loi = array();
$loi['nom'] = $_POST['nomLoi'];

if($loi['nom'] == LoiEnum::Beta) {
    $loi['valeurMin'] = $_POST['min_beta'];
    $loi['valeurMax'] = $_POST['max_beta'];
    $loi['w'] = $_POST['w'];
    $loi['v'] = $_POST['v'];
} else if($loi['nom'] == LoiEnum::Triangulaire) {
    $loi['valeurMin'] = $_POST['min_triang'];
    $loi['valeurMax'] = $_POST['max_triang'];
    $loi['c'] = $_POST['c'];
} else if($loi['nom'] == LoiEnum::Normale) {
    $loi['valeurMin'] = $_POST['min_norm'];
    $loi['valeurMax'] = $_POST['max_norm'];
    $loi['mu'] = $_POST['mu'];
    $loi['sigma'] = $_POST['sigma'];
} else if($loi['nom'] == LoiEnum::Uniforme) {
    $loi['valeurMin'] = $_POST['min_unif'];
    $loi['valeurMax'] = $_POST['max_unif'];
} else if($loi['nom'] == LoiEnum::SansLoi) {
    $loi['valeurMin'] = $_POST['valeur'];
    $loi['valeurMax'] = $_POST['valeur'];
}

$project->addTask($nom, $prec1, $prec2, $suiv1, $suiv2, $idRessource, $loi);
header("Location: tasklist.php");
?>