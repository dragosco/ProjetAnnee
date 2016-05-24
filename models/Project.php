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
			$tache = new Task($donnees['id'], $donnees['nom'], $donnees['precedent1'], $donnees['precedent2'], $donnees['suivant1'], $donnees['suivant2']/*, $donnees['duree']*/, $this); //, null, null
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

	public function removeTask($id)
	{

		$this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$q = $this->bdd->prepare("SELECT * FROM tache WHERE id = ?");
		$q->execute(array($id));
		$row = $q->fetch(PDO::FETCH_ASSOC);
		$nom = $row['nom'];
		$prec1 = $row['precedent1'];
		$prec2 = $row['precedent2'];
		$suiv1 = $row['suivant1'];
		$suiv2 = $row['suivant2'];

		echo $prec1 . "   " . $prec2 . "   " . $suiv1 . "   " . $suiv2;
		if ($prec1 !== "" && $prec1 !== "Start") {

			$q1 = $this->bdd->prepare("UPDATE tache SET suivant1 = :suiv1 WHERE nom = :prec1 AND (suivant1 = :nom OR suivant1 = '')");
			$q1->bindParam(':suiv1', $suiv1, PDO::PARAM_STR, 50);
			$q1->bindParam(':prec1', $prec1, PDO::PARAM_STR, 50);
			$q1->bindParam(':nom', $nom, PDO::PARAM_STR, 50);
			$q1->execute();

			$q2 = $this->bdd->prepare("UPDATE tache SET suivant2 = :suiv2 WHERE nom = :prec1 AND (suivant2 = :nom OR suivant2 = '')");
			$q2->bindParam(':suiv2', $suiv2, PDO::PARAM_STR, 50);
			$q2->bindParam(':prec1', $prec1, PDO::PARAM_STR, 50);
			$q2->bindParam(':nom', $nom, PDO::PARAM_STR, 50);
			$q2->execute();

			echo 'je suis dans le 1er if';
		}
		if ($prec2 !== "" && $prec2 !== "Start") {

			$q1 = $this->bdd->prepare("UPDATE tache SET suivant1 = :suiv1 WHERE nom = :prec2 AND (suivant1 = :nom OR suivant1 = '')");
			$q1->bindParam(':suiv1', $suiv1, PDO::PARAM_STR, 50);
			$q1->bindParam(':prec2', $prec2, PDO::PARAM_STR, 50);
			$q1->bindParam(':nom', $nom, PDO::PARAM_STR, 50);
			$q1->execute();

			$q2 = $this->bdd->prepare("UPDATE tache SET suivant2 = :suiv2 WHERE nom = :prec2 AND (suivant2 = :nom OR suivant2 = '')");
			$q2->bindParam(':suiv2', $suiv2, PDO::PARAM_STR, 50);
			$q2->bindParam(':prec2', $prec2, PDO::PARAM_STR, 50);
			$q2->bindParam(':nom', $nom, PDO::PARAM_STR, 50);
			$q2->execute();

			echo 'je suis dans le 2e if';
		}
		if ($suiv1 !== "" && $suiv1 !== "End") {

			$q1 = $this->bdd->prepare("UPDATE tache SET precedent1 = :prec1 WHERE nom = :suiv1 AND (precedent1 = :nom OR precedent1 = '')");
			$q1->bindParam(':prec1', $prec1, PDO::PARAM_STR, 50);
			$q1->bindParam(':suiv1', $suiv1, PDO::PARAM_STR, 50);
			$q1->bindParam(':nom', $nom, PDO::PARAM_STR, 50);
			$q1->execute();

			$q1 = $this->bdd->prepare("UPDATE tache SET precedent2 = :prec2 WHERE nom = :suiv1 AND (precedent2 = :nom OR precedent2 = '')");
			$q1->bindParam(':prec2', $prec2, PDO::PARAM_STR, 50);
			$q1->bindParam(':suiv1', $suiv1, PDO::PARAM_STR, 50);
			$q1->bindParam(':nom', $nom, PDO::PARAM_STR, 50);
			$q1->execute();

			echo 'je suis dans le 3e if';
		}
		if ($suiv2 !== "" && $suiv2 !== "End") {

			$q1 = $this->bdd->prepare("UPDATE tache SET precedent1 = :prec1 WHERE nom = :suiv2 AND (precedent1 = :nom OR precedent1 = '')");
			$q1->bindParam(':prec1', $prec1, PDO::PARAM_STR, 50);
			$q1->bindParam(':suiv2', $suiv2, PDO::PARAM_STR, 50);
			$q1->bindParam(':nom', $nom, PDO::PARAM_STR, 50);
			$q1->execute();

			$q1 = $this->bdd->prepare("UPDATE tache SET precedent2 = :prec2 WHERE nom = :suiv2 AND (precedent2 = :nom OR precedent2 = '')");
			$q1->bindParam(':prec2', $prec2, PDO::PARAM_STR, 50);
			$q1->bindParam(':suiv2', $suiv2, PDO::PARAM_STR, 50);
			$q1->bindParam(':nom', $nom, PDO::PARAM_STR, 50);
			$q1->execute();

			echo 'je suis dans le 4e if';
		}
		$sql = "DELETE FROM tache WHERE id = ". $id;
		$q = $this->bdd->prepare($sql);
		$q->execute();

		$this->listeTaches = array();
		$this->loadListeTaches();
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
