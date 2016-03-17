<?php
require("lois/LoiProbabilite.php");
require("Project.php");
/*
 * Monte Carlo
 * 
 * Classe SimulationMC
 */
class SimulationMC
{
	var $nbEchantillons;
	var $projet;
	var $largeurIntervalle;

	function __construct($nbEchantillons, $projet, $largeurIntervalle)
	{
		$this->nbEchantillons = $nbEchantillons;
		$this->projet = $projet;
		$this->largeurIntervalle = $largeurIntervalle;
	}




}
?>