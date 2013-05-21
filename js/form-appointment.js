$( document ).ready(function() {
    
    $('.datepicker').datepicker({
        'format': 'dd.mm.yyyy',
        'autoclose': true
        }).on('changeDate', function(ev){
            var inputValue = $(this).val();
            var inputName = $(this).attr('name');
            $.post('ajax/value2session.php',{
                value: inputValue,
                name: inputName
            });

        });

    
    $('.timepicker').timepicker({
        showMeridian: false,
        minuteStep: 5,
        defaultTime: '10:15 AM'
    });
    
    $('#inputJuHe').change(function(){
        if($(this).is(':checked')){
            $("select[name=tarif]").val('2').attr('selected',true);
        }
    });
 
    $('select[name=tarif]').change(function(){
        var tarif = $(this).val();
        if(tarif == 2 || tarif == 4){
            $('input[name=fotocd]').prop('checked',true).parent().addClass("hidden").parent().append('<div class="controls" id="fotocdreadonly"><i class="icon-ok"></i></div>');

        }else{
            $('input[name=fotocd]').prop('checked',false).parent().removeClass("hidden");
            $('#fotocdreadonly').remove();
            
        }
    });

    //Value des geklickten staus_id-buttonin hidden variable schreiben
    $(".status_id .btn").click(function() {
        // whenever a button is clicked, set the hidden helper
        $("#status_id").val($(this).val());
    })

    $('input#inputCustomer').autocomplete({
        source: 'ajax/get_organisations.php',
        minLength: 2,
      select: function( event, ui ) {
        $.post("ajax/get_customerdata.php",{
            customer_id: ui.item.id,
            text: ui.item.value
        }, function(data){
        //{"organisation":"Jugendhaus","phone":"0711\/123456","email":"bla@tipsntrips.de"}
            $('input#inputPhone').val(data.phone);
            $('input#inputEmail').val(data.email);
            $('input#inputContact').val(data.contact);
        }, 'json');
      }
    }).change(function(){
        var inputValue = $(this).val();
        var inputName = $(this).attr('name');
        $.post('ajax/value2session.php',{
            value: inputValue,
            name: inputName
        });
    });
    
    // input- und textarea-value in Session speichern
    $('input, textarea').change(function(){
        var inputValue = $(this).val();
        var inputName = $(this).attr('name');
        $.post('ajax/value2session.php',{
            value: inputValue,
            name: inputName
        });
    });


});