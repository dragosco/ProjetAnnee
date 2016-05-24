<?php
//require("cnx.php");
//
//$id=$_GET['id'];
//$pdo = new PDO('mysql:host=localhost;dbname=m1bd;charset=utf8', 'root', '');
//$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//if (isset($_POST['nvnom'])){
//$sql = "UPDATE tache SET nom = '".$_POST['nvnom']."',
//suivant1 = '".$_POST['nvsuivant1']."',
//suivant2 ='". $_POST['nvsuivant2']."',
//precedent1 = '".$_POST['nvprecedent1']."',
//precedent2 = '".$_POST['nvprecedent2']."'
//WHERE id = '".$id."'";
//$q = $pdo->prepare($sql);
//$q->execute(array($id));
//
//header("Location: tasklist.php");
//
//}


require("models/Project.php");

$nom = $_POST['nvnom'];
$prec1 = $_POST['nvprecedent1'];
$prec2 = $_POST['nvprecedent2'];
$suiv1 = $_POST['nvsuivant1'];
$suiv2 = $_POST['nvsuivant2'];

$project = Project::getInstance();
$project->updateTask($_GET['id'], $nom, $prec1, $prec2, $suiv1, $suiv2);

header("Location: tasklist.php");

?>