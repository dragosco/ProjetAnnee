$(document).ready(function() {
    $.ajax({
        type: 'GET',
        url: "/ProjetAnnee/tasklist_json.php",
        dataType: 'json',
        success: function (data) {
            data.forEach(function (item) {
                var task = item.nom;
                var taskRect = rect.clone();
                    taskRect.attr('text/text', task);
                graph.addCell(taskRect);
                addTaskToMenu(task);
            });

            data.forEach(function (item) {

                var task = getCellByText(item.nom);
                var prec1 = getCellByText(item.precedent1);
                var prec2 = getCellByText(item.precedent2);
                var suiv1 = getCellByText(item.suivant1);
                var suiv2 = getCellByText(item.suivant2);

                var linkLeft1 = new joint.dia.Link({
                    source: { id: prec1.id},
                    target: { id: task.id},
                    attrs: fleche
                });
                graph.addCell(linkLeft1);
                bounds.embed(linkLeft1);

                if (item.precedent2 !== "") {
                    var linkLeft2 = new joint.dia.Link({
                        source: { id: prec2.id},
                        target: { id: task.id},
                        attrs: fleche
                    });
                    graph.addCell(linkLeft2);
                    bounds.embed(linkLeft2);
                }

                var linkRight1 = new joint.dia.Link({
                    source: { id: task.id},
                    target: { id: suiv1.id},
                    attrs: fleche
                });
                graph.addCell(linkRight1);
                bounds.embed(linkRight1);

                if (item.suivant2 !== "") {
                    var linkRight2 = new joint.dia.Link({
                        source: { id: task.id},
                        target: { id: suiv2.id},
                        attrs: fleche
                    });
                    graph.addCell(linkRight2);
                    bounds.embed(linkRight2);
                }

            });

            reorganizeGraphPositions();

        }
    });

});