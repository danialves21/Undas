var getCupos = function() {

    //var fecha = new Date();
    //date = fecha.getFullYear() + '-' + fecha.getMonth();
    date = $('#calendar').fullCalendar('getView').intervalStart.format('YYYY-M');;
    idCentro = $('#centro').attr('idCentro');


    $.ajax({
        url: 'Include/getCupos.php',
        async: true,
        data: {"idCentro": idCentro, "date": date},
        method: 'POST',
        success: function(output) {
            output = $.parseJSON(output);

            $('#cupos').text(output.Cupos);
        }//success
    });//ajax
};


