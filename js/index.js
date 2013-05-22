$( document ).ready(function() {
//    $("table#sortTable").tablesorter({
//        sortList: [[1,0]] 
//    });
//    
    $('i.icon-pencil').click(function(){
        var appointment_id = $(this).parent().parent().attr('id');
        window.location.href="form-appointment.php?appointment_id="+appointment_id;
    });
    
    $('i.icon-trash').click(function(){
        confirm("Soll Datensatz id="+$(this).parent().parent().attr('id')+" tatsächlich gelöscht werden?");
    });
    
    $('tr.runout').css('opacity', .3);
});