$( document ).ready(function() {
    $('i.icon-pencil').click(function(){
        alert($(this).parent().parent().attr('id'));
    });
    
    $('i.icon-trash').click(function(){
        confirm("Soll Datensatz id=" + $(this).parent().parent().attr('id') + " tatsächlich gelöscht werden?");
    });
});