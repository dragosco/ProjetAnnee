<?php
require("Task.php");
/*
 * Project
 * 
 * Classe projet
 */
class Project
{
	var $nom;
	var $tacheDebut;
	var $tacheFin;
	var $listeTaches;
	var $simulationMC;
	
	function __construct($nom, $tacheDebut, $tacheFin, $simulationMC)
	{
		$this->nom = $nom;
		$this->tacheDebut = $tacheDebut ;
		$this->tacheFin = $tacheFin ;
		$this->simulationMC = $simulationMC ;
	}

	function getListeTaches()
	{
		return $listeTaches;
	}
}
?>