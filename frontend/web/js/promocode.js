(function($){

    $('#have-promocode').click(function(){
        $(this).fadeOut(function(){
            $('.promocode-form').fadeIn();
        });
    });

    $('#submit-payment').click(function(){
        $.post("/payment/submit",{id:$(this).attr('data-payment')}, function (result) {
            if(result.ok){
                let form = $(result.content);
                $("body").append(form);
                form.submit();
            } else {
                alert(result.message);
            }
        });
    });

})(jQuery);