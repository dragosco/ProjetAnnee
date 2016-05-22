<?php
//require("lois/LoiProbabilite.php");
require("ResultatSimulation.php");
/*
 * Monte Carlo
 *
 * Classe SimulationMC
 */
class SimulationMC
{
	var $nbEchantillons;
	var $largeurIntervalle;
	var $projet;
	var $resultatCalcul;

	function __construct($nbEchantillons, $largeurIntervalle, $projet)
	{
		$this->nbEchantillons = $nbEchantillons;
		$this->largeurIntervalle = $largeurIntervalle;
		$this->projet = $projet;
		$this->resultatCalcul = NULL;
	}

	public function __get($property) {
    if (property_exists($this, $property)) {
        return $this->$property;
    }
  }

  public function __set($property, $value) {
    if (property_exists($this, $property)) {
        $this->$property = $value;
    }
  }
}
?>
