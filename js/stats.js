function calculate(iteration, intervale) {
  var parametres = {iteration: iteration, intervale: intervale};

  $.ajax({
      type: 'POST',
      url: "/ProjetAnnee/calculStat_json.php", //?iteration="+iteration+"&intervale="+intervale,
      dataType: 'json',
      data: parametres,
      success: function (data) {
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

function estimateProbabilityGivenCharge(iteration, intervale, charge) {
  var parametres = {iteration: iteration, intervale: intervale, charge: charge};
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

function estimateChargeGivenProbability(iteration, intervale, probabilite) {
  var parametres = {iteration: iteration, intervale: intervale, probabilite: probabilite};

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
