$( document ).ready(function() {
    
    
    //Value des geklickten contributor_id-button in hidden variable schreiben
    $(".contributor_id .btn").click(function() {
        $("#contributor_id").val($(this).val());
//        $(this).parent().siblings('input:hidden').val($(this).val());
    })

    // input- und textarea-value in Session speichern
    $("form").submit(function() {
       if ($('#contributor_id').val() === '') {
           alert ('Bitte auch "Bearbeitet von"-Button klicken!');
           event.preventDefault();
       }
    });


});