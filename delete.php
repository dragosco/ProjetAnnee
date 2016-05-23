<?php
require("models/cnx.php");

$bdd = getBdd();

$id=$_GET['id'];
//$bdd->query('DELETE FROM tache WHERE id = ?');
// $bdd = new PDO('mysql:host=localhost;dbname=m1bd;charset=utf8', 'root', '');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "DELETE FROM tache WHERE id = ?";
$q = $bdd->prepare($sql);
$q->execute(array($id));
header("Location: tasklist.php");

?>
