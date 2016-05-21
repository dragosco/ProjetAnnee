<?php
require("lois/LoiProbabilite.php");
// require("Project.php");
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

	// function __construct($nom, $predecesseurs, $successeurs, $loi)
	// {
	// 	$this->nom = $nom;
	// 	// $this->projet = $projet;
	// 	$this->predecesseurs = $predecesseurs;
	// 	$this->successeurs = $successeurs;
	// 	$this->loi = $loi;
	// }

	function __construct($nom, $projet, $loi) // , $predecesseurs, $successeurs
	{
		$this->nom = $nom;
		$this->projet = $projet;
		// $this->predecesseurs = $predecesseurs;
		// $this->successeurs = $successeurs;
		$this->loi = $loi;
	}

	public function addPredecesseur($tache) {
		array_push($predecesseurs, $tache);
		//$predecesseurs[0] = $tache;
	  //echo("addPredecesseur");
		//array_push($this->predecesseur, $tache);
	}

	public function addSuccesseur($tache) {
		// print "<pre>";
		// print_r($tache);
		// print "</pre>";
		array_push($successeurs, $tache);
		//array_push($this->successeurs, $tache);
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
