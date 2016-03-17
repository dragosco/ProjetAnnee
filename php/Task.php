<?php
require("lois/LoiProbabilite.php");
require("Project.php");
/*
 * Task
 * 
 * Classe tâche
 */
class Task
{
	var $nom = "";
	var $projet;
	var $predecesseurs;
	var $successeurs;
	var $loi;

	function __construct($nom, $projet, $predecesseurs, $successeurs, $loi)
	{
		$this->nom = $nom;
		$this->projet = $projet;
		$this->predecesseurs = $predecesseurs;
		$this->successeurs = $successeurs;
		$this->loi = $loi;
	}




}
?>