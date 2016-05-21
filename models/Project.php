<?php
require("Task.php");
require("cnx.php");
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
	var $bdd;

	private static $_instance = null;

	function __construct($nom, $tacheDebut, $tacheFin, $simulationMC)
	{
		$this->nom = $nom;
		$this->tacheDebut = $tacheDebut ;
		$this->tacheFin = $tacheFin ;
		$this->simulationMC = $simulationMC ;
		$this->listeTaches = array() ;

		$this->bdd = getBdd();

		// On récupère tout le contenu de la table tâche
		$reponse = $this->bdd->query('SELECT * FROM tache');

		while ($donnees = $reponse->fetch())
		{
			array_push($this->listeTaches, new Task($donnees['nom'], null, null, null));
		}

	}

	public static function getInstance() {

		if(is_null(self::$_instance)) {
			self::$_instance = new Project('Gna', null, null, null);
		}

		return self::$_instance;
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

	function getListeTaches()
	{
		$reponse = $this->bdd->query('SELECT * FROM tache');

		$this->listeTaches = array();

		while ($donnees = $reponse->fetch())
		{
			array_push($this->listeTaches, new Task($donnees['nom'], null, null, null));
		}
		return $this->listeTaches;
	}


}
// class Singleton {
//
//    private function __construct() {
// 		 return new Project('Gna', null, null, null);
//    }
// }

?>
