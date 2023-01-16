(function($){

    $('.item_bell').click(function () {

        let d = $('li.item_bell .addit');

        if(d.length){
            let messages = [];
            $('.uvlist [data-notification]').each(function(){
                messages.push($(this).attr('data-notification'));
            });

            if(messages.length)
            $.post('/notifications/watched', {messages: messages}, function(result){
                d.remove();
            },'json');
        }
    });
})(jQuery);