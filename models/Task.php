<?php
require("lois/LoiProbabilite.php");
require 'lois/LoiTriangulaire.php';
require 'lois/LoiNormale.php';
require 'lois/LoiNormaleTronquee.php';
require 'lois/LoiBeta.php';
require 'lois/LoiRand.php';
require 'lois/SansLoi.php';
require("LoiEnum.php");
require("cnx.php");
require("Ressource.php");
// require("Project.php");
/*
 * Task
 *
 * Classe tâche
 */
class Task
{
	var $id;
	var $nom = "";
	//var $duree;
	var $projet;

	var $precedent1;
	var $precedent2;
	var $suivant1;
	var $suivant2;

	var $predecesseurs;
	var $successeurs;
	var $loi;
	var $ressource;

	var $bdd;

	// function __construct($nom, $predecesseurs, $successeurs, $loi)
	// {
	// 	$this->nom = $nom;
	// 	// $this->projet = $projet;
	// 	$this->predecesseurs = $predecesseurs;
	// 	$this->successeurs = $successeurs;
	// 	$this->loi = $loi;
	// }

	function __construct($id, $nom, $precedent1, $precedent2, $suivant1, $suivant2/*, $duree*/, $projet) // , $loi, $predecesseurs, $successeurs
	{
		$this->id = $id;
		$this->nom = $nom;
		//$this->duree = $duree;
		$this->projet = $projet;

		$this->precedent1 = $precedent1;
		$this->precedent2 = $precedent2;
		$this->suivant1 = $suivant1;
		$this->suivant2 = $suivant2;
		// $this->predecesseurs = $predecesseurs;
		// $this->successeurs = $successeurs;

		$this->bdd = getBdd();
		//$this->loadLoi();
	}

	public function loadLoi()
	{
		//if($this->duree == 0) {
		$reponse = $this->bdd->query('SELECT l.* FROM tache t, loi l where t.id = l.idTache');
		$loi = $reponse->fetch();
		if($loi['nom'] == LoiEnum::Beta) {
			$reponse = $this->bdd->query('SELECT b.* FROM loi l, loiBeta b where l.id = b.id');
			$beta = $reponse->fetch();
			$this->loi = new LoiBeta($loi['valeurMin'], $loi['valeurMax'], $beta['w'], $beta['v']);
		} else if($loi['nom'] == LoiEnum::Triangulaire) {
			$reponse = $this->bdd->query('SELECT t.* FROM loi l, loiTriangulaire t where l.id = t.id');
			$triangulaire = $reponse->fetch();
			$this->loi = new LoiTriangulaire($loi['valeurMin'], $loi['valeurMax'], $triangulaire['c']);
		} else if($loi['nom'] == LoiEnum::Normale) {
			$reponse = $this->bdd->query('SELECT n.* FROM loi l, loiNormale n where l.id = n.id');
			$normale = $reponse->fetch();
			$this->loi = new LoiNormaleTronquee($loi['valeurMin'], $loi['valeurMax'], $normale['mu'], $normale['sigma']);
		} else if($loi['nom'] == LoiEnum::Uniforme) {
			$this->loi = new LoiRand($loi['valeurMin'], $loi['valeurMax']);
		} else if($loi['nom'] == LoiEnum::SansLoi) {
			$this->loi = new SansLoi($loi['valeurMax']);
		}
		//}
		// $this->loi = new L
		// while ()
		// {
			//array_push($this->listeTaches, new Task($donnees['nom'], self)); //, null, null
		// }

		//$this->loi = $loi;
	}

	public function loadRessource() {
		// $reponse = $this->bdd->query('SELECT r.* FROM tache t, ressource r WHERE t.idRessource = r.id AND');
		// $ressource = $reponse->fetch();

		$this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$q = $this->bdd->prepare("SELECT r.* FROM tache t, ressource r WHERE t.idRessource = r.id AND t.id = ?");
		$q->execute(array($this->id));
		$ressource = $q->fetch(PDO::FETCH_ASSOC);

		$this->ressource = new Ressource($ressource['id'], $ressource['nom'], $ressource['cout']);
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
