// $(document).ready(function() {
//   $('#iteration').val('10000');
//   $('#intervalle').val('30');
// });

function calculate(typeSimulateur, iteration, intervalle) {
  var parametres = {typeSimulateur: typeSimulateur, iteration: iteration, intervalle: intervalle};

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

        $('#container').highcharts({
          chart: {
            type: 'line'
          },
          title: {
              text: 'Simulation Monte Carlo'
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

function estimateProbabilityGivenCharge(typeSimulateur, iteration, intervalle, charge) {
  var parametres = {typeSimulateur: typeSimulateur, iteration: iteration, intervalle: intervalle, charge: charge};
  $.ajax({
    type: 'POST',
    url: "/ProjetAnnee/estimateProbabilityGivenCharge_json.php", //?iteration="+iteration+"&intervale="+intervale+"&charge="+charge,
    dataType: 'json',
    data: parametres,
    success: function (data) {
      probabilite = data.probabilite;
      $('#probabiliteGivenCharge').val(probabilite);
    }
  });
};

function estimateChargeGivenProbability(typeSimulateur, iteration, intervalle, probabilite) {
  var parametres = {typeSimulateur: typeSimulateur, iteration: iteration, intervalle: intervalle, probabilite: probabilite};

  $.ajax({
    type: 'POST',
    url: "/ProjetAnnee/estimateChargeGivenProbability_json.php", //?iteration="+iteration+"&intervale="+intervale+"&probabilite="+probabilite,
    dataType: 'json',
    data: parametres,
    success: function (data) {
      charge = data.charge;
      $('#chargeGivenProbability').val(charge);
    }
  });
};
