(function(){

    $(document).ready(function(){

        let actions = $('#actions');
        let table = $('.table');
        let actionForm = $('#action-form');
        let fieldIds = actionForm.find('[name=ids]');
        let fieldAction = actionForm.find('[name=action]');

        actions.on('click', '[data-action]', function(){
            let action = $(this).data('action');
            let ids = [];
            table.find('input[type=checkbox]:checked').each(function(){ids.push(this.value)});

            if(ids.length){
                fieldIds.val(JSON.stringify(ids));
                fieldAction.val(action);
                modalDialog( "Удалить выбранные?", null, null , function(){ actionForm.submit() });

            } else {
                modalDialog( "Выделите элементы для удаления", null, null , null);
            }

            /*
            let ids = [];
            table.find('input[type=checkbox]:checked').each(function(){
                ids.push(this.value);
            });*/
        });


        $('.table thead, .table tfoot').on('change', '[type=checkbox]', function () {
            let checked = $(this).is(':checked');
            let checkboxes = $(".table").find('[type=checkbox]');
            checkboxes.prop('checked', checked);
        });

        $(".table tbody").on('change', '[type=checkbox]', function(){
            $('.table thead [type=checkbox], .table tfoot [type=checkbox]').prop('checked', false);
        });


        table.on('click', 'a.delete-row', function(e){
            e.preventDefault();
            let url = $(this).attr('href');
            modalDialog( "Удалить?", null, null , function(){ window.location = url });
        });

    });

})(jQuery);