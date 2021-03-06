<?php
  $simulateur = $project->getSimulateurByType('margeFinanciere');
  $iteration = 10000;
  $intervalle = 2000;
  $probabilite = 80;
  $charge = 17000;
  if(!is_null($simulateur)) {
    $iteration = $simulateur->nbEchantillons;
    $intervalle = $simulateur->largeurIntervalle;
    $probabilite = $simulateur->probabilite;
    $charge = $simulateur->charge;
  }
 ?>

<div class="form-group">
  <button id="titre_Marge" class="btn btn-default btn-block" type="button">
    Marge Financière
  </button>
</div>
<div id="contenu_Marge" class="contenu">
  <!-- <br> -->
  <div class="col-md-4">
  <div class="row">
    <input type="hidden" id="typeSimulateur_Marge" name="typeSimulateur" value="margeFinanciere" />
    <div class="col-xs-4">
      <label for="iteration">Nombre d'itération</label>
      <input class="form-control" id="iteration_Marge" type="text" name="iteration_Marge" value=<?php echo $iteration; ?> required >
    </div>
    <div class="col-xs-4">
      <label for="intervalle">Largeur de l'intervalle</label>
      <input class="form-control" id="intervalle_Marge" type="text" name="intervalle" value=<?php echo $intervalle; ?> required >
    </div>
    <div class="col-xs-4">
      <!-- <form methode ="POST" action ="traitement.php"> -->
        <br><br><button class="btn btn-default btn-block btn-lg" type="submit" onclick="calculate(typeSimulateur_Marge.value, iteration_Marge.value, intervalle_Marge.value, probabiliteGivenProbability_Marge.value, chargeGivenCharge_Marge.value, 'container_Marge')">
          Générer
        </button>
      <!-- </form> -->
    </div>
  </div>
</div>

<div class="col-md-4">
  <div class="row">
    <div class="col-xs-4">
      <label for="chargeGivenCharge">Coût d'entrée (€)</label>
      <input class="form-control" id="chargeGivenCharge_Marge" type="text" name="chargeGivenCharge" value=<?php echo $charge; ?> />
    </div>
    <div class="col-xs-4">
      <!-- <form methode ="POST" action ="traitement.php"> -->
        <br><br><button class="btn btn-default btn-block btn-lg" type="submit" onclick="estimateProbability(typeSimulateur_Marge.value, iteration_Marge.value, intervalle_Marge.value, probabiliteGivenProbability_Marge.value, chargeGivenCharge_Marge.value)">
          Calculer
        </button>
      <!-- </form> -->
    </div>
    <div class="col-xs-4">
      <label for="probabiliteGivenCharge">Probabilité calculée (%)</label>
      <output class="form-control" id="probabiliteGivenCharge_Marge" type="text" name="probabiliteGivenCharge" />
    </div>
  </div>
</div>

<div class="col-md-4">
  <div class="row">
    <div class="col-xs-4">
      <label for="probabiliteGivenProbability">Probabilité d'entrée (%)</label>
      <input class="form-control" id="probabiliteGivenProbability_Marge" type="text" name="probabiliteGivenProbability" value=<?php echo $probabilite; ?> />
    </div>
    <div class="col-xs-4">
      <br><br><button class="btn btn-default btn-block btn-lg" type="submit" onclick="estimateCharge(typeSimulateur_Marge.value, iteration_Marge.value, intervalle_Marge.value, probabiliteGivenProbability_Marge.value, chargeGivenCharge_Marge.value)">
        Calculer
      </button>
    </div>
    <div class="col-xs-4">
      <label for="chargeGivenProbability">Coût calculé en (€)</label>
      <output class="form-control" id="chargeGivenProbability_Marge" type="text" name="chargeGivenProbability" />
    </div>
  </div>
</div>
  <br> <div id="container_Marge"></div>
   <!-- style="height: 400px; width: 100%;" -->
</div>
