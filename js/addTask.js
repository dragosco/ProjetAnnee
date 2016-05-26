/**
 * Created by Dragos on 11/03/2016.
 */
$(document).ready(function() {
    //on LOAD, tout le monde est caché :
    $('.law').hide();
});

$(document).on('click', '.btn-group button', function (e) {
    $('.law').hide();
    $('#blk-'+$(this).val()).slideToggle();
    if($(this).val() === "1") {
        $('#lawName').val("uniforme");
    } else if($(this).val() === "2") {
        $('#lawName').val("beta");
    } else if($(this).val() === "3") {
        $('#lawName').val("triangulaire");
    } else if($(this).val() === "4") {
        $('#lawName').val("normale");
    } else if($(this).val() === "5") {
        $('#lawName').val("sansLoi");
    }
});