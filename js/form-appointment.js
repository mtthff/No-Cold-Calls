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
    
    // Checkbutton JuHe
    $('#inputJuHe').change(function(){
        if($(this).is(':checked')){
            $('.tarif_id .btn').each(function(){
                $(this).removeClass('active');
            });
            $('.tarif_id .btn[value="2"]').addClass('active');
            $('.tarif_id .btn[value="1"], .tarif_id .btn[value="3"]').addClass('disabled').prop('disabled', true);
            $('input[name=fotocd]').prop('checked',true).parent().addClass("hidden").parent().append('<div class="controls" id="fotocdreadonly"><i class="icon-ok"></i></div>');
        }
        else{
            $('.tarif_id .btn[value="2"]').removeClass('active');
            $('.tarif_id .btn[value="1"], .tarif_id .btn[value="3"]').removeClass('disabled').removeAttr('disabled');
            $('input[name=fotocd]').prop('checked',false).parent().removeClass("hidden")
            $('#fotocdreadonly').remove();
        }
    });
 
    $('select[name=tarif]').change(function(){
        var tarif = $(this).val();
        if(tarif == 2 || tarif == 4){
            $('input[name=fotocd]').prop('checked',true).parent().addClass("hidden").parent().append('<div class="controls" id="fotocdreadonly"><i class="icon-ok"></i></div>');

        }
        else{
            $('input[name=fotocd]').prop('checked',false).parent().removeClass("hidden");
            $('#fotocdreadonly').remove();
            
        }
    });

    //Value des geklickten staus_id/tarif_id/version_id-button in hidden variable schreiben
    $(".status_id .btn, .version_id .btn, .tarif_id .btn").click(function() {
        $("#status_id").val($(this).val());
        $(this).parent().siblings('input:hidden').val($(this).val());
    })


    // Autovervollständigung des Customer (ajax)
    $('input#inputCustomer').autocomplete({
        source: 'ajax/get_organisations.php',
        minLength: 2,
      select: function( event, ui ) {
        $.post("ajax/get_customerdata.php",{
            customer_id: ui.item.id,
            text: ui.item.value
        }, function(data){
            alert(data.id);
        //{"organisation":"Jugendhaus","phone":"0711\/123456","email":"bla@tipsntrips.de"}
            $('input#customer_id').val(data.id);
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