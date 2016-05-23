function calculate(iteration, intervale) {
  $.ajax({
      type: 'GET',
      url: "/ProjetAnnee/calculStat_json.php?iteration="+iteration+"&intervale="+intervale,
      dataType: 'json',
      success: function (data) {
        // alert('entrou calculate');
        xAxis = data.xAxis;
        // alert(data);
        yAxis = data.yAxis;

        $('#container').highcharts({
            chart: {
                type: 'column',
                options3d: {
                    enabled: true,
                    alpha: 10,
                    beta: 25,
                    depth: 70
                }
            },
            title: {
                text: 'Simulation Monte Carlo'
            },
            subtitle: {
                text: null
            },
            plotOptions: {
                column: {
                    depth: 25
                }
            },
            xAxis: {
                categories: xAxis //["0-9","10-19","20-29","30-39","40-49","50-59","60-69","70-79","80-89","90-99"]
            },
            yAxis: {
                title: {
                    text: null
                }
            },
            series: [{
                name: 'Pourcentage par catégorie',
                data: yAxis //[0.7, 3, 7, 4, 0, 5, 1, 4, 6, 3]
            }]
        });
      }
  });
};

function estimateProbabilityGivenCharge(iteration, intervale, charge) {
  $.ajax({
      type: 'GET',
      url: "/ProjetAnnee/estimateProbabilityGivenCharge_json.php?iteration="+iteration+"&intervale="+intervale+"&charge="+charge,
      dataType: 'json',
      success: function (data) {
        probabilite = data.probabilite;
        $('#probabilite').val(probabilite);
      }
  });
};

function estimateChargeGivenProbability(iteration, intervale, probabilite) {
  $.ajax({
      type: 'GET',
      url: "/ProjetAnnee/estimateChargeGivenProbability_json.php?iteration="+iteration+"&intervale="+intervale+"&probabilite="+probabilite,
      dataType: 'json',
      success: function (data) {
        charge = data.charge;
        $('#chargeGivenProbability').val(charge);
      }
  });
};
