/* made by Dmitry Konoval */

jQuery(document).ready(function ($) {
    (function ($) {

        $('.item_bell').click(function () {
            $('.uvlist').slideToggle(200);
        });

        $(".c_body").niceScroll(
            {
                cursorcolor: "#ffc107",
                cursorwidth: "3px",
                autohidemode: false,
                cursorborder: "none",
                background: "#cfd8dc"
            }
        );

        $('.form_catli li, #type li').click(function () {
            $(this).parent('ul').find('li').removeClass('active')
            $(this).addClass('active')
        })


        $('.content_last_closed_item_body_footer_span_r_openclose').click(function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).closest('.content_last_closed_item').toggleClass('active')
        })

        jQuery(".preloader").fadeOut(200)

        $(window).scroll(function () {
            setMenuBg();
        })

        function setMenuBg() {
            toptop = parseInt($('.scroll_height').height()) - 70;
            if (parseInt($(window).scrollTop()) > toptop) {
                $('.main_header').addClass('dark');
                // $('.main_header').slideDown(200);
            }
            else {
                $('.main_header').removeClass('dark')
                // $('.main_header').slideUp(200);
                // setTimeout(function(){ $('.main_header').removeClass('dark')},200)

            }
        }

        $('.main_header .navbar-toggler').click(function () {
            opened = $(this).parent('.navbar').find('#navbarSupportedContent').hasClass('show')
            if (opened == false) {
                $('.main_header').addClass('dark2');
            }
            else {
                $('.main_header').addClass('dark2');
            }
        })

        $('.mp_main_middle_top li').click(function () {
            $(this).closest('.mp_main_middle_top').find('li').removeClass('active');
            $(this).addClass('active');
        })


        /* start functions */
        setMenuBg();


        $('.report-field').hover(function () {
            iimid = $(this).data('imgid');
            oldimg_cont = $('#' + iimid + '');
            oldimg_img = oldimg_cont.data('standartimg')
            newimg = $(this).data('imgsrc');
            // alert(newimg)
            oldimg_cont.css('backgroundImage', 'url(' + newimg + ')')
        })



        $('.close-order-bth').click(function(e){
            e.preventDefault();
            $(this).fadeOut(100);
            $(this).closest('.order-item').find('.close-form').show();
        });

        $('.submit_close_form').click(function(){
            $form = $(this).closest('form');
            if($form.find('input[type=radio]:checked').length){
                $form.submit();
            }
        });



    })(jQuery);


    // <div class="img-block">
    // <input type="file" />
    // <img src=''>
    // </div>

    // <script>

    // $('input[type=file]').on('change', function(){

    // var file = this.files[0];
    // if (!file.type.match('image.*')) return;
    // var that = this;
    // var reader = new FileReader();
    // reader.onload = function(e) {  $(that).closest('.img-block').find('img').attr('src', e.target.result); };
    // reader.readAsDataURL(file);
    // });

    // </script>

    // scroll
    // jQuery("article").niceScroll({
    // cursorwidth:"2px",
    // cursorborder:"1px solid transparent"
    // })


    //выделяем активный пункт
    // $('selector').each(function () {
    // var location = window.location.href;
    // var link = this.href;
    // if(location == link) {
    // $(this).addClass('active');
    // }
    // });


    //переход между страницами
    // $("a").click(function(e){
    // href=$(this).attr("href");
    // e.preventDefault();
    // $(".preloader").fadeIn(200)
    // setTimeout(function(){
    // document.location.href=href
    // },200)
    // })


    //Аякс отправка форм
    //Документация: http://api.jquery.com/jquery.ajax/
    // $("form").submit(function() {
    // $.ajax({
    // type: "GET",
    // url: "mail.php",
    // data: $("form").serialize()
    // }).done(function() {
    // alert("Спасибо за заявку!");
    // setTimeout(function() {
    // $.fancybox.close();
    // }, 1000);
    // });
    // return false;
    // });

});

//preloader
jQuery(window).on('load', function () {
    // jQuery(".preloader").fadeOut(200)
    // setTimeout(function(){
    //    jQuery(".preloader").fadeOut(200)
    // },500)

})