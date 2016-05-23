<?php
require("Task.php");
//require("cnx.php");
/*
 * Project
 *
 * Classe projet
 */
class Project
{
	var $id;
	var $nom;
	var $tacheDebut;
	var $tacheFin;
	var $listeTaches;
	//var $simulationMC;
	var $listeSimulateurs;
	var $bdd;

	private static $_instance = null;

	function __construct($id, $nom, $tacheDebut, $tacheFin, $simulationMC)
	{
		$this->id = $id;
		$this->nom = $nom;
		$this->tacheDebut = $tacheDebut;
		$this->tacheFin = $tacheFin;
		//$this->simulationMC = $simulationMC;
		$this->listeSimulateurs = array();
		$this->listeTaches = array();

		$this->bdd = getBdd();

		$this->bdd->query('INSERT INTO `projet` (`id`, `nomp`, `description`) VALUES (NULL, $nom, `desc`)');
		$this->id = $this->bdd->lastInsertId();

		$this->loadListeTaches();
	}

	function loadListeTaches()
	{
		// On récupère tout le contenu de la table tâche
		$reponse = $this->bdd->query('SELECT * FROM tache');

		while ($donnees = $reponse->fetch())
		{
			$tache = new Task($donnees['id'], $donnees['nom']/*, $donnees['duree']*/, $this); //, null, null
			// if($tache->duree == 0) {
			$tache->loadLoi();
			// }
			array_push($this->listeTaches, $tache);
		}
	}

	public static function getInstance() {

		if(is_null(self::$_instance)) {
			self::$_instance = new Project(1, 'Gna', null, null, null);
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

	// function getListeTaches()
	// {
	// 	$reponse = $this->bdd->query('SELECT * FROM tache');
	//
	// 	$this->listeTaches = array();
	//
	// 	while ($donnees = $reponse->fetch())
	// 	{
	// 		array_push($this->listeTaches, new Task($donnees['nom'], null, null, null));
	// 	}
	// 	return $this->listeTaches;
	// }

	public function addTask($nom, $listePredecesseurs, $listeSuccesseurs, $simulationMC)
	{
		//array_push($this->listeTaches, new Task($donnees['nom'], null, null, null));
		//$this->bdd->query('INSERT INTO tache () VALUES ()');
	}

	public function removeTask()
	{
		//remove($this->listeTaches, id);
		//$this->bdd->query('DELETE FROM tache WHERE id = ');
	}

	public function updateTask()
	{
		//array_push($this->listeTaches, new Task($donnees['nom'], null, null, null));
		//$this->bdd->query('DELEPTE FROM tache WHERE id = ');
	}

	public function getLongestPath()
	{
		//calcular maior caminho ordenado
		return $listeTaches;
	}

}
?>
