(function($){

    let progress = $('.report-progress');
    let lock = false;
    let percent = 12;
    let current = $('#stage-1');
    let form = $('.report-form');
    let ajaxurl = '/report/ajax';
    let sendurl = '/report/send';

    function goto(selector){
        if(lock) return;
        lock = true;

        let next = $(selector);

        form.css('height', form.height());

        current.fadeOut(500, function(){
            next.css({display: 'block', opacity: 0});
            current = next;
            let new_percent = Number(current.attr('data-progress'));
            $('.report-progress').attr('class', "report-progress progress-" + Math.floor(new_percent) );
            let step = (new_percent - percent) / 20;
            let timer = setInterval(function(){
                percent += step;
                percent = Math.ceil(percent);
                if(percent > new_percent) percent = new_percent;
                progress.html(percent + " %");
            }, 50);
            let h = current.height();
            form.animate({
                height: h
            }, 500, function(){
                current.attr('style', '');
                current.fadeIn(500, function(){
                    form.css('height', 'auto');
                    lock = false;
                    clearInterval(timer);
                    percent = new_percent;
                    progress.html(new_percent + " %");
                });
            });
        });
    }

    function fillFormData(stage, data){
        stage.find('input,textarea, select').each(function(index,elem){
            let name = $(elem).attr('name');
            data.append(name,getFieldValue(name));
        });
    }

    function validate(callback){

        let stage = current;

        let formData = new FormData();
        fillFormData(stage, formData);

        formData.append('category', $('#report-form').find('[name="category"]').val());
        formData.append('stage', stage.attr('data-stage'));
        formData.append('chat', $('#report-form').find('[name="chat_id"]').val());
        formData.append('action', 'validate');

        $.ajax({
            url: ajaxurl,
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(result){
                if(!$.isEmptyObject(result)){
                    for (let field in result) {
                        current.find('[name="' + field + '"]').addClass('has-error');
                    }
                    console.log(result);
                } else {
                    current.attr('data-valid', 1);
                    callback();
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(errorThrown);
            }
        });
    }

    function changeStage(stage_id){
        let stage = $(stage_id);

        if(stage.attr('data-valid') == '1'){
            goto(stage);
        } else {
            validate(function(){
                goto(stage);
            });
        }
    }

    $('.report-next, .report-prev').click(function(){
        changeStage($(this).attr('href'));
    });

    $('.report-form').on('click','.param-comment-button', function(){
        let field = $(this).closest('.report-field');
        let comment_block = field.find('.report-field-comment');
        let comment = comment_block.find('textarea').val();
        comment_block.fadeToggle();
        if(comment.trim() == "" ){
            $(this).removeClass('active');
        } else {
            $(this).addClass('active');
        }
    });


    $('.report-form').on('change','[type=file]', function(){
        $(this).closest('.param-attach-button').addClass('active');
    });

    function correct_label(n){
        if(n == 1) return n + " Балл";
        if(n == 0 || n == 5) return n + " Баллов";
        if(n > 1 && n < 5) return n + " Балла";
    }

    var counters = document.querySelectorAll('.report-field-points');

    for(let index = 0; index < counters.length; index++){
        let counter = counters[index];
        let field = counter.querySelector('input');
        field.addEventListener('change', function(){});
        counter.querySelector('.button-up').addEventListener('click', function(){
            let points = Number(field.value[0]);
            if(Number.isNaN(points)) points = 0;
            else points++;
            if(points > 5) points = 5;
            field.value = correct_label(points);
        });
        counter.querySelector('.button-down').addEventListener('click', function(){
            let points = Number(field.value[0]);
            if(Number.isNaN(points)) points = 0;
            else points--;
            if(points < 0) points = 0;

            field.value = correct_label(points);
        });
    }

    $('[name="brand"]').change(function(){
        let model = $('[name="model"]');
        model.prop('disabled', true);
        $.post(ajaxurl, {action: 'field', field: 'brand', value: $(this).val()}, function(result){
            model.find('option:not(:first-child)').remove();
            model.append(result);
            model.prop('disabled', false);
        });
    });

    $('.report-form').on('change', 'input, select, textarea', function(){
        $(this).closest('.stage').attr('data-valid', 0);
        $(this).removeClass('has-error');
    });

    function sendReport(){
        let formData = new FormData();
        $('.stage').each(function(){
            let stage = $(this);
            fillFormData(stage, formData);
        });

        formData.append('category', $('[name="category"]').val());
        formData.append('chat_id', $('[name="chat_id"]').val());

        $.ajax({ url: sendurl, data: formData, processData: false, contentType: false, type: 'POST',
            success: function(result){
                if(result.ok) window.location = result.redirect;
                else console.log(result.errors);
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(errorThrown);
            }
        });
    }


    $('input[name="photo"]').change(function(){
        let file = this.files[0];
        let reader = new FileReader();
        let label = $(this).closest('label');
        reader.onload = function(result){
            label.css('background-image', "url(" + reader.result + ")" );
        };
        reader.readAsDataURL(file);
    });



    $('#report-form').submit(function(){
        validate(sendReport);
        return false;
    });

    function getFieldValue(name){
        let field = $('[name="' + name + '"]');
        if(field.attr('type') === 'file') {
            return field.get(0).files[0];
        } else if(field.parent().hasClass('report-field-points')) {
            return field.val()[0];
        } else {
            return field.val();
        }
    }

})(jQuery);