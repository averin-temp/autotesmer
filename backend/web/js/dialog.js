var modalDialog = (function($){

    let dialog = $('#modal-dialog');
    let dialogMessage = dialog.find('.modal-dialog-message');
    let dialogButtonOk = dialog.find('.button-ok');
    let dialogCallback = null;

    dialogButtonOk.click(function(){
        if(!dialogCallback) {
            dialog.modal('hide');
            return;
        }
        dialogButtonOk.prop('disabled', true);
        dialogCallback();
    });

    dialog.on('hidden.bs.modal', function() {
        dialogCallback = null;
        dialogButtonOk.prop('disabled', false);
        dialogMessage.html("");
    });

    return function(message, url, data, callback){
        dialogMessage.html(message);
        if(url){
            dialogCallback = function(){
                $.post(url,data, function(response){
                    if(response.ok){
                        callback();
                    } else {
                        dialogMessage.html(response.message);
                    }
                }, 'json');
            };
        } else {
            dialogCallback = callback;
        }
        dialog.modal('show');
    };

})(jQuery);