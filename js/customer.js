$( document ).ready(function() {
    $('i.icon-pencil').click(function(){
        alert($(this).parent().parent().attr('id'));
    });
    
    $('i.icon-trash').click(function(){
        var customer_id = $(this).parent().parent().attr('id');
        var customer_name = $(this).parent().siblings('td.customerName').text();
        $('input#del_id').val(customer_id);
        $('#del_name').text(customer_name);
        $('#deleteCustomer').modal();
    });
    
    $('#yesDeleteIt').click(function(){
       $('#deleteCustomer').modal('hide');
       var id = $('input#del_id').val();
       $.post("ajax/del_customer.php",{
            customer_id: id
        }, function(){
            window.location.href = 'customer.php';
        });       
    });
    
});