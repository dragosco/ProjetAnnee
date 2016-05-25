$(document).ready(function() {
  $('#titreChargeGlobale').on('click', function(event) {
    $('#contenuChargeGlobale').toggle(); //'show'
    // $('#contenuCoutGlobal').toggle();
  });
  $('#titreCoutGlobal').on('click', function(event) {
    $('#contenuCoutGlobal').toggle(); //'show'
    // $('#contenuChargeGlobale').toggle();
  });
});

$('')

// jQuery(document).ready(function(){
//     jQuery('#hideshow').live('click', function(event) {
//          jQuery('#content').toggle('show');
//     });
// });

function calculate(typeSimulateur, iteration, intervalle, probabilite, charge, divId) {
  var parametres = {typeSimulateur: typeSimulateur, iteration: iteration, intervalle: intervalle,
     probabilite: probabilite, charge: charge};

  var nomChart = '';
  if(typeSimulateur=='chargeGlobale') {
    nomChart = 'Simulation de charge globale';
  } else if(typeSimulateur=='coutGlobal') {
    nomChart = 'Simulation de coût global';
  }

  $.ajax({
      type: 'POST',
      url: "/ProjetAnnee/calculStat_json.php", //?iteration="+iteration+"&intervale="+intervale,
      dataType: 'json',
      data: parametres,
      // beforeSend: function() {
      //   alert(typeSimulateur);
      //     alert(iteration);
      //       alert(intervalle);
      // },
      success: function (data) {
        // alert("entrou");
        xAxis = data.xAxis;
        yAxis = data.yAxis;

        $('#'+divId).highcharts({
          chart: {
            type: 'line'
          },
          title: {
            text: nomChart
          },
          subtitle: {
              text: null
          },
          plotOptions: {
            line: {
              dataLabels: {
                  enabled: true
              },
              enableMouseTracking: false
            }
          },
          xAxis: {
              categories: xAxis
          },
          yAxis: {
              title: {
                  text: null
              }
          },
          series: [{
              name: 'Pourcentage par catégorie',
              data: yAxis
          }]
        });
      }
  });
};

function estimateProbability(typeSimulateur, iteration, intervalle, probabilite, charge) {
  var parametres = {typeSimulateur: typeSimulateur, iteration: iteration, intervalle: intervalle,
     probabilite: probabilite, charge: charge};

  var outputId = 'probabiliteGivenCharge';
  if(typeSimulateur=='chargeGlobale') {
    outputId += '_Charge';
  } else if(typeSimulateur=='coutGlobal') {
    outputId += '_Cout';
  }

  $.ajax({
    type: 'POST',
    url: "/ProjetAnnee/estimateProbabilityGivenCharge_json.php", //?iteration="+iteration+"&intervale="+intervale+"&charge="+charge,
    dataType: 'json',
    data: parametres,
    success: function (data) {
      probabilite = data.probabilite;
      $('#'+outputId).val(probabilite);
    }
  });
};

function estimateCharge(typeSimulateur, iteration, intervalle, probabilite, charge) {
  var parametres = {typeSimulateur: typeSimulateur, iteration: iteration, intervalle: intervalle,
     probabilite: probabilite, charge: charge};

  var outputId = 'chargeGivenProbability';
  if(typeSimulateur=='chargeGlobale') {
    outputId += '_Charge';
  } else if(typeSimulateur=='coutGlobal') {
    outputId += '_Cout';
  }

  $.ajax({
    type: 'POST',
    url: "/ProjetAnnee/estimateChargeGivenProbability_json.php", //?iteration="+iteration+"&intervale="+intervale+"&probabilite="+probabilite,
    dataType: 'json',
    data: parametres,
    success: function (data) {
      charge = data.charge;
      $('#'+outputId).val(charge);
    }
  });
};
