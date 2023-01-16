(function($){

    $('.verification-block').on('click', '#verification-next',function(){
        let block = $(this).closest('.verification-block');
        let user_agreement = block.find('input[name="user_agreement"]').is(':checked') ? 1 : '';
        let data_processing = block.find('input[name="data_processing"]').is(':checked') ? 1 : '';
        $.post('/verification/start', {
            user_agreement: user_agreement,
            data_processing: data_processing
        }, function(result){
            if(result.ok) block.html(result.content);
        }, 'json');
    });



    $('.verification-block').on('click','#to_selfie', function(){
        let block = $(this).closest('.verification-block');
        let form = block.find('form').get(0);
        let formdata = new FormData(form);
        $.ajax('/verification/passportphoto', {
            method: 'post',
            data: formdata,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(result){
                if(result.ok) block.html(result.content);
                else alert(result.content);
            },
            error: function(){
                alert('error');
            }
        });
    });

    $('.verification-block').on('click','#commit', function(){
        let block = $(this).closest('.verification-block');
        let form = block.find('form').get(0);
        let formdata = new FormData(form);
        $.ajax('/verification/passportselfie', {
            method: 'post',
            data: formdata,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(result){
                if(result.ok) block.html(result.content);
                else alert(result.content);
            },
            error: function(){
                alert('error');
            }
        });
    });

    $('.verification-block').on('change','#photo-upload, #selfie-photo', function(){
        let image = $(this).closest('.verification-block').find('label.steps_lk_upload');
        let fileReader = new FileReader();
        fileReader.onload = function(result){
            image.css('background-image', 'url(' + fileReader.result + ')');
        };
        fileReader.readAsDataURL($(this).get(0).files[0]);
    });

})(jQuery);