$( document ).ready(function() {
    $('.datepicker').datepicker({
        'format': 'dd.mm.yyyy',
        'autoclose': true
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

    $('select[name=customer]').change(function(){
       var customer_id = $(this).val();
       var text = $(this).find(':selected').text();
       $.post("ajax/get_customerdata.php",{
           customer_id: customer_id,
           text: text
       }, function(data){
//           alert(data);
        //{"organisation":"Jugendhaus","phone":"0711\/123456","mobil":"0170\/02010000","email":"bla@tipsntrips.de"}
               $('input#inputPhone').val(data.phone);
               $('input#inputMobil').val(data.mobil);
               $('input#inputEmail').val(data.email);
               $('input#inputContact').val(data.contact);
//           });
           }, 'json');
    });

});