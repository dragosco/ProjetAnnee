<?php
require("Task.php");
//require("SimulateurEnum.php");
require("SimulationChargeGlobale.php");
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

	function __construct($id, $nom, $tacheDebut, $tacheFin) //, $simulationMC
	{
		$this->id = $id;
		$this->nom = $nom;
		$this->tacheDebut = $tacheDebut;
		$this->tacheFin = $tacheFin;
		//$this->simulationMC = $simulationMC;
		$this->listeTaches = array();
		$this->listeSimulateurs = array();
		// array_push($this->listeSimulateurs, SimulationChargeGlobale::constructBasic(SimulateurEnum::ChargeGlobale, 10000, 30, $this)); //, $chargeEntree, $probabiliteEntree

		$this->bdd = getBdd();

		// $this->bdd->query('INSERT INTO `projet` (`id`, `nomp`, `description`) VALUES (NULL, $nom, `desc`)');
		$this->id = 1; //$this->bdd->lastInsertId();

		$this->loadListeTaches();
		$this->loadListeSimulateurs();
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

	function loadListeSimulateurs()
	{
		// On récupère tout le contenu de la table tâche
		$reponse = $this->bdd->query('SELECT * FROM simulateur');

		$simulateur = NULL;
		while ($donnees = $reponse->fetch())
		{
			if($donnees['typeSimulateur'] == SimulateurEnum::ChargeGlobale) {
				$simulateur = new SimulationChargeGlobale($donnees['typeSimulateur'], $donnees['nbEchantillons'], $donnees['largeurIntervalle'], $this);
				$simulateur->probabilite = $donnees['probabilite'];
				$simulateur->charge = $donnees['charge'];
				array_push($this->listeSimulateurs, $simulateur);
			}
		}
		// echo ($this->listeSimulateurs[0]->nbEchantillons);
		// echo ($this->listeSimulateurs[0]->largeurIntervalle);

	}

	public static function getInstance() {

		if(is_null(self::$_instance)) {
			self::$_instance = new Project(1, 'Gna', null, null); //, null
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

	public function addTask($nom, $listePredecesseurs, $listeSuccesseurs)
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

			$q2 = $this->bdd->prepare("UPDATE tache SET precedent2 = :prec2 WHERE nom = :suiv1 AND (precedent2 = :nom OR precedent2 = '')");
			$q2->bindParam(':prec2', $prec2, PDO::PARAM_STR, 50);
			$q2->bindParam(':suiv1', $suiv1, PDO::PARAM_STR, 50);
			$q2->bindParam(':nom', $nom, PDO::PARAM_STR, 50);
			$q2->execute();

			echo 'je suis dans le 3e if';
		}
		if ($suiv2 !== "" && $suiv2 !== "End") {

			$q1 = $this->bdd->prepare("UPDATE tache SET precedent1 = :prec1 WHERE nom = :suiv2 AND (precedent1 = :nom OR precedent1 = '')");
			$q1->bindParam(':prec1', $prec1, PDO::PARAM_STR, 50);
			$q1->bindParam(':suiv2', $suiv2, PDO::PARAM_STR, 50);
			$q1->bindParam(':nom', $nom, PDO::PARAM_STR, 50);
			$q1->execute();

			$q2 = $this->bdd->prepare("UPDATE tache SET precedent2 = :prec2 WHERE nom = :suiv2 AND (precedent2 = :nom OR precedent2 = '')");
			$q2->bindParam(':prec2', $prec2, PDO::PARAM_STR, 50);
			$q2->bindParam(':suiv2', $suiv2, PDO::PARAM_STR, 50);
			$q2->bindParam(':nom', $nom, PDO::PARAM_STR, 50);
			$q2->execute();

			echo 'je suis dans le 4e if';
		}
		$q = $this->bdd->prepare("DELETE FROM tache WHERE id = :id");
		$q->bindParam(':id', $id, PDO::PARAM_INT);
		$q->execute();

		$this->listeTaches = array();
		$this->loadListeTaches();
	}

	public function updateTask($id, $nvnom)
	{
		$q = $this->bdd->prepare("SELECT * FROM tache WHERE id = ?");
		$q->execute(array($id));
		$row = $q->fetch(PDO::FETCH_ASSOC);
		$nom = $row['nom'];
		$prec1 = $row['precedent1'];
		$prec2 = $row['precedent2'];
		$suiv1 = $row['suivant1'];
		$suiv2 = $row['suivant2'];

		if ($prec1 !== "" && $prec1 !== "Start") {

			$q1 = $this->bdd->prepare("UPDATE tache SET suivant1 = :suiv1 WHERE nom = :prec1 AND (suivant1 = :nom OR suivant1 = '')");
			$q1->bindParam(':suiv1', $nvnom, PDO::PARAM_STR, 50);
			$q1->bindParam(':prec1', $prec1, PDO::PARAM_STR, 50);
			$q1->bindParam(':nom', $nom, PDO::PARAM_STR, 50);
			$succes = $q1->execute();

			if(!$succes) {
				$q2 = $this->bdd->prepare("UPDATE tache SET suivant2 = :suiv2 WHERE nom = :prec1 AND (suivant2 = :nom OR suivant2 = '')");
				$q2->bindParam(':suiv2', $suiv2, PDO::PARAM_STR, 50);
				$q2->bindParam(':prec1', $prec1, PDO::PARAM_STR, 50);
				$q2->bindParam(':nom', $nom, PDO::PARAM_STR, 50);
				$q2->execute();
			}

		}
		if ($prec2 !== "" && $prec2 !== "Start") {

			$q1 = $this->bdd->prepare("UPDATE tache SET suivant1 = :suiv1 WHERE nom = :prec2 AND (suivant1 = :nom OR suivant1 = '')");
			$q1->bindParam(':suiv1', $nvnom, PDO::PARAM_STR, 50);
			$q1->bindParam(':prec2', $prec2, PDO::PARAM_STR, 50);
			$q1->bindParam(':nom', $nom, PDO::PARAM_STR, 50);
			$succes = $q1->execute();
			if(!$succes) {
				$q2 = $this->bdd->prepare("UPDATE tache SET suivant2 = :suiv2 WHERE nom = :prec2 AND (suivant2 = :nom OR suivant2 = '')");
				$q2->bindParam(':suiv2', $nvnom, PDO::PARAM_STR, 50);
				$q2->bindParam(':prec2', $prec2, PDO::PARAM_STR, 50);
				$q2->bindParam(':nom', $nom, PDO::PARAM_STR, 50);
				$q2->execute();
			}

		}
		if ($suiv1 !== "" && $suiv1 !== "End") {

			$q1 = $this->bdd->prepare("UPDATE tache SET precedent1 = :prec1 WHERE nom = :suiv1 AND (precedent1 = :nom OR precedent1 = '')");
			$q1->bindParam(':prec1', $nvnom, PDO::PARAM_STR, 50);
			$q1->bindParam(':suiv1', $suiv1, PDO::PARAM_STR, 50);
			$q1->bindParam(':nom', $nom, PDO::PARAM_STR, 50);
			$succes = $q1->execute();

			if(!$succes) {
				$q1 = $this->bdd->prepare("UPDATE tache SET precedent2 = :prec2 WHERE nom = :suiv1 AND (precedent2 = :nom OR precedent2 = '')");
				$q1->bindParam(':prec2', $nvnom, PDO::PARAM_STR, 50);
				$q1->bindParam(':suiv1', $suiv1, PDO::PARAM_STR, 50);
				$q1->bindParam(':nom', $nom, PDO::PARAM_STR, 50);
				$q1->execute();
			}

		}
		if ($suiv2 !== "" && $suiv2 !== "End") {

			$q1 = $this->bdd->prepare("UPDATE tache SET precedent1 = :prec1 WHERE nom = :suiv2 AND (precedent1 = :nom OR precedent1 = '')");
			$q1->bindParam(':prec1', $nvnom, PDO::PARAM_STR, 50);
			$q1->bindParam(':suiv2', $suiv2, PDO::PARAM_STR, 50);
			$q1->bindParam(':nom', $nom, PDO::PARAM_STR, 50);
			$succes = $q1->execute();

			if(!$succes) {
				$q1 = $this->bdd->prepare("UPDATE tache SET precedent2 = :prec2 WHERE nom = :suiv2 AND (precedent2 = :nom OR precedent2 = '')");
				$q1->bindParam(':prec2', $nvnom, PDO::PARAM_STR, 50);
				$q1->bindParam(':suiv2', $suiv2, PDO::PARAM_STR, 50);
				$q1->bindParam(':nom', $nom, PDO::PARAM_STR, 50);
				$q1->execute();
			}

		}

		$this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$q1 = $this->bdd->prepare("UPDATE tache SET nom = :nvnom WHERE id = :id");
		$q1->bindParam(':id', $id, PDO::PARAM_INT);
		$q1->bindParam(':nvnom', $nvnom, PDO::PARAM_STR, 50);
		$q1->execute();

		$this->listeTaches = array();
		$this->loadListeTaches();
	}

	public function updateTable($table) {
		$this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		foreach ($table as $task) {

			$nom = $task['nom'];
			$nvprec1 = $task['precedent1'];
			$nvprec2 = $task['precedent2'];
			$nvsuiv1 = $task['suivant1'];
			$nvsuiv2 = $task['suivant2'];

			$q = $this->bdd->prepare("UPDATE tache SET precedent1 = :nvprec1, precedent2 = :nvprec2, suivant1 = :nvsuiv1, suivant2 = :nvsuiv2 WHERE nom = :nom");
			$q->bindParam(':nom', $nom, PDO::PARAM_STR, 50);
			$q->bindParam(':nvprec1', $nvprec1, PDO::PARAM_STR, 50);
			$q->bindParam(':nvprec2', $nvprec2, PDO::PARAM_STR, 50);
			$q->bindParam(':nvsuiv1', $nvsuiv1, PDO::PARAM_STR, 50);
			$q->bindParam(':nvsuiv2', $nvsuiv2, PDO::PARAM_STR, 50);
			$q->execute();
		}

		$this->listeTaches = array();
		$this->loadListeTaches();

	}

	function addSimulateur($typeSimulateur, $nbEchantillons, $largeurIntervalle) { //, $chargeEntree, $probabiliteEntree
		// $simulateur = NULL;

		$q1 = $this->bdd->prepare("INSERT INTO simulateur (idProjet, typeSimulateur, nbEchantillons, largeurIntervalle)
					VALUES (:idProjet, :typeSimulateur, :nbEchantillons, :largeurIntervalle)");
		$q1->bindParam(':nbEchantillons', $nbEchantillons, PDO::PARAM_INT, 10);
		$q1->bindParam(':largeurIntervalle', $largeurIntervalle, PDO::PARAM_INT, 10);
		$q1->bindParam(':typeSimulateur', $typeSimulateur, PDO::PARAM_STR, 50);
		$q1->bindParam(':idProjet', $this->id, PDO::PARAM_INT, 10);
		$q1->execute();

		// if($typeSimulateur == SimulateurEnum::ChargeGlobale) {
		// 	$simulateur = new SimulationChargeGlobale($typeSimulateur, $nbEchantillons, $largeurIntervalle, $this);
		// 	array_push($this->listeSimulateurs, $simulateur); //, $chargeEntree, $probabiliteEntree
		// 	//faire insert bd
		// }

		//return $simulateur;

		$this->listeSimulateurs = array();
		$this->loadListeSimulateurs();

		return $this->listeSimulateurs[0];
	}

	function updateSimulateur($simulateur, $typeSimulateur, $nbEchantillons, $largeurIntervalle) {
		$q1 = $this->bdd->prepare("UPDATE simulateur SET nbEchantillons = :nbEchantillons, largeurIntervalle = :largeurIntervalle WHERE typeSimulateur = :typeSimulateur AND idProjet = :idProjet");
		$q1->bindParam(':nbEchantillons', $nbEchantillons, PDO::PARAM_INT, 10);
		$q1->bindParam(':largeurIntervalle', $largeurIntervalle, PDO::PARAM_INT, 10);
		$q1->bindParam(':typeSimulateur', $typeSimulateur, PDO::PARAM_STR, 50);
		$q1->bindParam(':idProjet', $this->id, PDO::PARAM_INT, 10);
		$q1->execute();

		$this->listeSimulateurs = array();
		$this->loadListeSimulateurs();

		return $this->listeSimulateurs[0];
	}

	function getSimulateur($typeSimulateur, $nbEchantillons, $largeurIntervalle) {
		$simulateur = NULL;

		for ($i=0; $i < count($this->listeSimulateurs); $i++) {
			if($this->listeSimulateurs[$i]->typeSimulateur == $typeSimulateur) {
				if($this->listeSimulateurs[$i]->nbEchantillons != $nbEchantillons ||
					$this->listeSimulateurs[$i]->largeurIntervalle != $largeurIntervalle)
				{
					$simulateur = $this->updateSimulateur($this->listeSimulateurs[$i], $typeSimulateur, $nbEchantillons, $largeurIntervalle);
				} else {
					$simulateur = $this->listeSimulateurs[$i];
				}
				$i = count($this->listeSimulateurs);
			}
		}

		if(is_null($simulateur)) {
			$simulateur = $this->addSimulateur($typeSimulateur, $nbEchantillons, $largeurIntervalle);
		}

		return $simulateur;
	}

	function executeSimulation($typeSimulateur, $iteration, $intervalle) {
		// echo ("executeSimulation");
		// chercher si deja existent
		// sinon créer et insérer dans la bd
		$simulation = $this->getSimulateur($typeSimulateur, $iteration, $intervalle);
		// $simulation = new SimulationChargeGlobale($typeSimulateur, $iteration, $intervalle, $this);
		$res = $simulation->calculate();

		return $res;
	}

	function estimateCharge($typeSimulateur, $iteration, $intervalle, $probabilite) {
		$simulation = $this->getSimulateur($typeSimulateur, $iteration, $intervalle);
		//update bd avec probabilite
		$charge = $simulation->estimateChargeGivenProbability($probabilite);
		return $charge;
	}

	function estimateProbability($typeSimulateur, $iteration, $intervalle, $charge) {
		$simulation = $this->getSimulateur($typeSimulateur, $iteration, $intervalle);
		//update bd avec charge
		$probabilite = $simulation->estimateProbabilityGivenCharge($charge);
		return $probabilite;
	}

	public function getLongestPath()
	{
		//calcular maior caminho ordenado
		return $this->listeTaches;
	}

}
?>
