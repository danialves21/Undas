/**
 * filtro de TMs para agregar al calendario al input hay que agregarle el id="search"
 * y cada una de las opciones a esconder debe tener la clase "fc-event"
 *
 **/
$('#search').keyup(function () {
    $('.fc-event').hide();
    var txt = $('#search').val();
    $('.fc-event').each(function () {
        if ($(this).text().toUpperCase().indexOf(txt.toUpperCase()) != -1) {
            $(this).show();
        }
    });
});
/**
 * filtro de TMs por Prestaciones asociadas.
 * - al input hay que agregarle el id="search"
 * - cada una de las opciones a esconder debe tener la clase "fc-event"
 *
 **/
$('#prestacionFilter').keyup(function () {
    $('.fc-event').hide();//hides every parent div
    var txt = $('#prestacionFilter').val(); //text to compare with
    if (txt != "") {
        $('.prestacion').each(function () {//iterates through every children
            if ($(this).text().toUpperCase().indexOf(txt.toUpperCase()) != -1) { //if the text matches a children

                parentid = $(this).parent('div').attr('idtm'); //gets the id of the parent to compare with

                $('.fc-event').each(function () { //iterates through every event
                    fcevent = $(this).attr('idTM'); //idTM del evento
                    if (fcevent === parentid) {// if matches
                        $(this).show(); //shows parent
                    }
                });
            }
        });
    } else {
        $('.fc-event').show();
    }
});