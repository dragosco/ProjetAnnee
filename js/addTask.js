/**
 * Created by Dragos on 11/03/2016.
 */
$(document).ready(function() {
    //on LOAD, tout le monde est caché :
    $('.law').hide();
    $('#taskConfig').hide();
    $('#linkConfig').hide();

    $('#addTaskButton').click(function(e) {
        $('#taskConfig').slideToggle('slow');
        e.preventDefault();
    });

    $('#addLinkButton').click(function(e) {
        $('#linkConfig').slideToggle('slow');
        e.preventDefault();
    });
});

$(document).on('click', '.btn-group button', function (e) {
    $('.law').hide();
    $('#blk-'+$(this).val()).slideToggle();
});


function createOption(selector, task) {
    var option = document.createElement('option');
    option.text = task;
    selector.add(option);
};

function addTaskToMenu(task) {
    createOption($('#leftTaskSelector')[0], task);
    createOption($('#rightTaskSelector')[0], task);
    createOption($('#sourceSelector')[0], task);
    createOption($('#targetSelector')[0], task);
};