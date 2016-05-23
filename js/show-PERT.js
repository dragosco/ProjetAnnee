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


                var linkLeft1 = lien.clone();
                    linkLeft1.set('source', { id: prec1.id });
                    linkLeft1.set('target', { id: task.id });
                graph.addCell(linkLeft1);
                bounds.embed(linkLeft1);

                if (item.precedent2 !== "") {
                    var linkLeft2 = lien.clone();
                        linkLeft2.set('source', { id: prec2.id });
                        linkLeft2.set('target', { id: task.id });
                    graph.addCell(linkLeft2);
                    bounds.embed(linkLeft2);
                }

                if (item.suivant1 === "End" || item.suivant2 === "End") {
                    var linkRight = lien.clone();
                        linkRight.set('source', { id: task.id });
                        linkRight.set('target', { id: end.id });
                    graph.addCell(linkRight);
                    bounds.embed(linkRight);
                }


            });

            reorganizeGraphPositions();

        }
    });

});
