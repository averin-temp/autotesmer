<?php



?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>

        @page  {
            margin: 47pt;
        }

        @font-face {
            font-family: 'montserrat-black';
            url("http://autotesmer.ru/fonts/Montserrat/Montserrat-Black.ttf") format("truetype");
        }

        @font-face {
            font-family: "montserrat-regular";
            url("http://autotesmer.ru/fonts/Montserrat/Montserrat-Regular.ttf") format("truetype");
        }

        @font-face {
            font-family: 'montserrat-medium';
            url("http://autotesmer.ru/fonts/Montserrat/Montserrat-Medium.ttf") format("truetype");
        }

        body {
            font-family: 'montserrat-regular', sans-serif;
            padding: 0;
            margin: 0;
        }

        .container{
            width: 748pt;
        }


        .header-block{
            background-color: #333333;
            padding: 22pt 40pt;
            margin-bottom: 22pt;
        }

        .car-image{
            width: 292pt;
        }

        .logo-image{
            width: 229pt;
        }


        .rating{
            width: 91pt;
            text-align: center;
            height: 91pt;
            background-color: #5eb761;
            font-family: 'montserrat-black', sans-serif;
        }

        .rating div{
            padding-top: 27pt;
            color: white;
            font-size: 22.26pt;
            font-family: 'montserrat-black', sans-serif;
        }


        .banner{
            margin-bottom: 22pt;
            background-color: #a2a2a2;
            text-align: center;
            font-size: 40pt;
            height: 100pt;
            color: #bab8b8;
            line-height: 56pt;
        }


        .caption{
            position: relative;
            background-color: #333333;
            color: white;
            text-align: center;
            height: 50pt;
            line-height: 31pt;
            font-size: 30pt;
        }

        .list{
            width: 100%;
            line-height: 40pt;
            font-size: 20pt;
            margin-bottom: 22pt;
        }

        .list .left{
            text-align: left;
            width: 50%;
            color:#666666
        }

        .list .right{
            text-align: right;
            width: 50%;
            color:#000
        }



        .canvas_1{
            position: relative;
            height: 2173pt;
        }

        .line_1{
            position: absolute;
            top: 164pt;
            left: 0;
            width: 746pt;
            height: 141pt;
        }

        .line_2{
            position: absolute;
            top: 1885pt;
            left: 0;
            width: 746pt;

        }


        .car-body{
            position: absolute;
            top: 776pt;
            left: 262pt;
            width: 223pt;
            height: 511pt;
        }

        .car-body2{
            position: absolute;
            top: 375pt;
            left: -20pt;
            width: 745pt;
            height: 307pt;
        }


        .body-right-col{
            width: 258pt;
            height: 1304pt;
            position: absolute;
            top: 445pt;
            left: 490.8pt;
        }
        .body-left-col{
            width: 258pt;
            height: 1450pt;
            position: absolute;
            top: 445pt;
            left: 0pt;
        }


        .car-body-3{
            width: 308pt;
            height: 147pt;
            position: absolute;
            top: 232pt;
            left: 219pt;
        }


        .car-body-4{
            width: 223pt;
            height: 355pt;
            position: absolute;
            top: 262pt;
            left: 263pt;
        }


        .car-body-5{
            width: 356pt;
            height: 249pt;
            position: absolute;
            top: 50pt;
            left: 192pt;
        }



        .flag-2-1{
            width: 247pt;
            height: 57pt;
            position: absolute;
            top: 150pt;
            left: 3pt;
        }
        .flag-2-2{
            width: 247pt;
            height: 57pt;
            position: absolute;
            top: 400pt;
            left: 3pt;
        }

        .flag-2-3{
            width: 247pt;
            height: 57pt;
            position: absolute;
            top: 150pt;
            right: 0;
        }

        .flag-2-4{
            width: 247pt;
            height: 57pt;
            position: absolute;
            top: 400pt;
            right: 0;
        }


        .flag-3-1{
            width: 257pt;
            height: 76pt;
            position: absolute;
            top: 168pt;
            left: 0;
        }

        .flag-3-2{
            width: 258pt;
            height: 60pt;
            position: absolute;
            top: 375pt;
            left: 0;
        }

        .flag-3-3{
            width: 258pt;
            height: 47pt;
            position: absolute;
            top: 478pt;
            left: 0;
        }

        .flag-3-4{
            width: 257pt;
            height: 75pt;
            position: absolute;
            top: 648pt;
            left: 0;
        }

        .flag-3-5{
            width: 227pt;
            height: 77pt;
            position: absolute;
            top: 648pt;
            left: 258pt;
        }

        .flag-3-6{
            width: 258pt;
            height: 76pt;
            position: absolute;
            top: 648pt;
            right: 0;
        }

        .flag-3-7{
            width: 258pt;
            height: 47pt;
            position: absolute;
            top: 478pt;
            right: 0;
        }

        .flag-3-8{
            width: 258pt;
            height: 60pt;
            position: absolute;
            top: 375pt;
            right: 0;
        }

        .flag-3-9{
            width: 257pt;
            height: 75pt;
            position: absolute;
            top: 168pt;
            right: 0;
        }

        .flag-3-10{
            width: 227pt;
            height: 71pt;
            position: absolute;
            top: 168pt;
            left: 258pt;
        }


        .flag-4-1{
            width: 227pt;
            height: 74pt;
            position: absolute;
            top: 338pt;
            left: 0;
        }

        .flag-4-2{
            width: 227pt;
            height: 71pt;
            position: absolute;
            top: 341pt;
            left: 259pt;
        }

        .flag-4-3{
            width: 227pt;
            height: 74pt;
            position: absolute;
            top: 338pt;
            right: 0;
        }

        .flag-5{
            width: 227pt;
            height: 71pt;
            position: absolute;
            top: 762pt;
            left: 0;
        }



        .flag-5-2{
            width: 227pt;
            height: 71pt;
            position: absolute;
            top: 762pt;
            left: 263pt;
        }

        .flag-5-3{
            width: 227pt;
            height: 71pt;
            position: absolute;
            top: 762pt;
            right: 0;
        }

        .flag-5-4{
            width: 227pt;
            height: 125pt;
            position: absolute;
            top: 170pt;
            left: 0;
        }

        .flag-5-5{
            width: 227pt;
            position: absolute;
            top: 170pt;
            right: 0;
        }

        .body-car-image-1{
            width: 220pt;
            /*height: 147pt*/
            position: absolute;
            top: 17pt;
            left: 3pt;
        }

        .body-car-image-2{
            width: 220pt;
            /*height: 147pt*/
            position: absolute;
            top: 17pt;
            left: 263pt;
        }

        .body-car-image-3{
            width: 220pt;
            position: absolute;
            top: 17pt;
            left: 522pt;
        }

        .body-car-image-4{
            width: 220pt;
            position: absolute;
            top: 299pt;
            left: 525pt;
        }

        .body-car-image-5{
            width: 220pt;
            position: absolute;
            top: 299pt;
            left: 3pt;
        }

        .body-car-image-6{
            width: 220pt;
            position: absolute;
            top: 485pt;
            left: 525pt;
        }

        .body-car-image-7{
            width: 220pt;
            position: absolute;
            top: 485pt;
            left: 3pt;
        }

        .body-car-image-8{
            width: 220pt;
            position: absolute;
            top: 692pt;
            left: 525pt;
        }

        .body-car-image-9{
            width: 220pt;
            position: absolute;
            top: 692pt;
            left: 3pt;
        }

        .body-car-image-10{
            width: 220pt;
            position: absolute;
            top: 1034pt;
            left: 3pt;
        }

        .body-car-image-11{
            width: 220pt;
            position: absolute;
            top: 1034pt;
            left: 525pt;
        }
        .body-car-image-12{
            width: 220pt;
            position: absolute;
            top: 1259pt;
            left: 3pt;
        }
        .body-car-image-13{
            width: 220pt;
            position: absolute;
            top: 1259pt;
            left: 525pt;
        }
        .body-car-image-14{
            width: 220pt;
            position: absolute;
            top: 1523pt;
            left: 3pt;
        }
        .body-car-image-15{
            width: 220pt;
            position: absolute;
            top: 1523pt;
            left: 525pt;
        }
        .body-car-image-16{
            width: 220pt;
            position: absolute;
            top: 1749pt;
            left: 3pt;
        }
        .body-car-image-17{
            width: 220pt;
            position: absolute;
            top: 1749pt;
            left: 525pt;
        }
        .body-car-image-18{
            width: 220pt;
            position: absolute;
            top: 2026pt;
            left: 3pt;
        }
        .body-car-image-19{
            width: 220pt;
            position: absolute;
            top: 2026pt;
            left: 264pt;
        }
        .body-car-image-20{
            width: 220pt;
            position: absolute;
            top: 2026pt;
            left: 523pt;
        }



        .sub-car-image-1{
            width: 220pt;
            position: absolute;
            top: 3pt;
            left: 7pt;
        }

        .sub-car-image-2{
            width: 220pt;
            position: absolute;
            top: 3pt;
            left: 524pt;
        }

        .sub-car-image-3{
            width: 220pt;
            position: absolute;
            top: 457pt;
            left: 8pt;
        }

        .sub-car-image-4{
            width: 220pt;
            position: absolute;
            top: 457pt;
            left: 524pt;
        }





        .salon-car-image-1{
            width: 220pt;
            position: absolute;
            top: 22pt;
            left: 3pt;
        }

        .salon-car-image-2{
            width: 220pt;
            position: absolute;
            top: 22pt;
            left: 261pt;
        }

        .salon-car-image-3{
            width: 220pt;
            position: absolute;
            top: 22pt;
            left: 524pt;
        }

        .salon-car-image-4{
            width: 220pt;
            position: absolute;
            top: 229pt;
            left: 3pt;
        }

        .salon-car-image-5{
            width: 220pt;
            position: absolute;
            top: 229pt;
            left: 524pt;
        }

        .salon-car-image-6{
            width: 220pt;
            position: absolute;
            top: 524pt;
            left: 3pt;
        }

        .salon-car-image-7{
            width: 220pt;
            position: absolute;
            top: 524pt;
            left: 524pt;
        }

        .salon-car-image-8{
            width: 220pt;
            position: absolute;
            top: 722pt;
            left: 3pt;
        }

        .salon-car-image-9{
            width: 220pt;
            position: absolute;
            top: 722pt;
            left: 261pt;
        }

        .salon-car-image-10{
            width: 220pt;
            position: absolute;
            top: 722pt;
            left: 524pt;
        }



        .back-car-image-1{
            width: 220pt;
            position: absolute;
            top: 412pt;
            left: 3pt;
        }

        .back-car-image-2{
            width: 220pt;
            position: absolute;
            top: 412pt;
            left: 262pt;
        }

        .back-car-image-3{
            width: 220pt;
            position: absolute;
            top: 412pt;
            left: 524pt;
        }



        .four-car-image-1{
            width: 220pt;
            position: absolute;
            top: 833pt;
            left: 4pt;
        }

        .four-car-image-2{
            width: 220pt;
            position: absolute;
            top: 833pt;
            left: 267pt;
        }

        .four-car-image-3{
            width: 220pt;
            position: absolute;
            top: 833pt;
            left: 524pt;
        }

        .four-car-image-4{
            width: 220pt;
            position: absolute;
            top: 23pt;
            left: 522pt;
        }

        .four-car-image-5{
            width: 220pt;
            position: absolute;
            top: 23pt;
            left: 3pt;
        }

        .canvas_2{
            margin-top: 22pt;
            position: relative;
            height: 604pt;
            margin-bottom: 45pt;
        }


        .canvas_3{
            /* border: 1px solid black; */
            position: relative;
            height: 869pt;
            margin-bottom: 22pt;
        }

        .canvas_4{
            position: relative;
            height: 559pt;
            margin-bottom: 44pt;
        }


        .canvas_5{
            position: relative;
            height: 980pt;
            margin-bottom: 22pt;
        }

        .body-car-label{
            position: absolute;
            width: 214pt;
            height: 30pt;
            color: white;
            font-size: 16pt;
            padding-left: 6pt;
            line-height: 10pt;
        }

        .body-car-label table{
            position: relative;
            width: 100%;
        }

        .body-car-label .left{
            font-family: 'montserrat-black', sans-serif;
            text-align: left;
            position: relative;
        }

        .body-car-label .right{
            text-align: right;
        }

        .label-1{ top: 163pt; left: 3pt; }
        .label-2{top: 163pt;left: 263pt;}
        .label-3{top: 163pt;left: 523pt;}
        .label-4{top: 445pt;left: 3pt;}
        .label-5{top: 631pt;left: 3pt;}
        .label-6{top: 668pt;left: 3pt;}
        .label-7{top: 854pt;left: 3pt;}
        .label-8{top: 893pt;left: 3pt;}
        .label-9{top: 932pt;left: 3pt;}
        .label-10{top: 971pt;left: 3pt;}
        .label-11{top: 1010pt;left: 3pt;}
        .label-12{top: 1196pt;left: 3pt;}
        .label-13{top: 1235pt;left: 3pt;}
        .label-14{top: 1421pt;left: 3pt;}
        .label-15{top: 1460pt;left: 3pt;}
        .label-16{top: 1499pt;left: 3pt;}
        .label-17{top: 1685pt;left: 3pt;}
        .label-18{top: 1724pt;left: 3pt;}
        .label-19{top: 2003pt;left: 3pt;}
        .label-20{top: 445pt;left: 523pt;}

        .label-21{top: 631pt;left: 523pt;}
        .label-22{top: 668pt;left: 523pt;}
        .label-23{top: 854pt;left: 523pt;}
        .label-24{top: 893pt;left: 523pt;}
        .label-25{top: 932pt;left: 523pt;}
        .label-26{top: 971pt;left: 523pt;}
        .label-27{top: 1010pt;left: 523pt;}
        .label-28{top: 1196pt;left: 523pt;}
        .label-29{top: 1235pt;left: 523pt;}
        .label-30{top: 1421pt;left: 523pt;}
        .label-31{top: 1460pt;left: 523pt;}
        .label-32{top: 1499pt;left: 523pt;}
        .label-33{top: 1685pt;left: 523pt;}
        .label-34{top: 1724pt;left: 523pt;}
        .label-35{top: 2003pt;left: 523pt;}
        .label-36{top: 2003pt;left: 263pt;}


        .label-2-1{top: 158pt;left: 3pt;}
        .label-2-2{top: 158pt;left: 523pt;}
        .label-2-3{top: 412pt;left: 3pt;}
        .label-2-4{top: 412pt;left: 523pt;}


        .label-3-1{top: 178pt;left: 3pt;}
        .label-3-2{top: 386pt;left: 3pt;}

        .label-3-4{top: 704pt;left: 3pt;}
        .label-3-5{top: 694pt;left: 260pt;}
        .label-3-6{top: 704pt;left: 523pt;}
        .label-3-7{top: 493pt;left: 523pt;}
        .label-3-8{top: 399pt;left: 523pt;}
        .label-3-9{top: 178pt;left: 521pt;}
        .label-3-10{top: 178pt;left: 263pt;}

        .label-4-1{top: 372pt;left: 3pt;}
        .label-4-2{top: 372pt;left: 263pt;}
        .label-4-3{top: 383pt;left: 523pt;}


        .label-5-1{top: 803pt;left: 3pt;}
        .label-5-2{top: 803pt;left: 263pt;}
        .label-5-3{top: 803pt;left: 523pt;}
        .label-5-4{top: 181pt;left: 523pt;}
        .label-5-5{top: 168pt;left: 3pt;}


        .body-car-label.label-5-5 td{
            height: 93pt;
        }

        .body-car-label.label-5-5 td.right{
            font-size: 15pt;
            line-height: 13pt;
        }


        .disclaimer{
            margin-top: 21pt;
            margin-bottom: 93pt;
            padding: 17pt 56pt;
            text-align: center;
            font-family: "montserrat-medium", sans-serif;
            color: #a9a9aa;
        }

        .disclaimer-2{
            text-align: center;
            font-family: "montserrat-medium", sans-serif;
            color: #a9a9aa;
        }


        .report-style{
            line-height: 25pt;
            color: white;
            font-size: 28pt;
            border-bottom: 1px solid #8a8a8a;
            font-family: 'DejaVu Sans';
            padding-bottom: 16pt;
            margin-bottom: 16pt;
            position: relative;
            top: -7pt;
        }

        .report-style-2{
            color: #b6b6b6;
            font-size: 22pt;
            margin-bottom: 5pt;
        }


        .caption-number{
            position: absolute;
            top:9pt;
            left:0;
            width: 49.594pt;
            height: 54pt;
            text-align: center;
            font-size: 16pt;
            color: white;
            line-height: 22pt;
            font-family: 'DejaVu Sans';
        }



        .caption-with-rating{
        }

        .caption-with-rating table{
            width: 748pt;
        }

        .caption-with-rating td{
            font-size: 0;
            line-height: 0;
        }


        .caption-with-rating td div{

        }
        .left-td{
            width:680pt;
            height: 54pt;
        }

        .right-td{
            width:68pt;
            height: 54pt;
        }




        .style-222{
            height: 41pt;
            font-size: 23pt;
            color: black;
            background-color: #bcbcbc;
            text-align: center;
            line-height: 25pt;
        }


        .date{
            font-family: "montserrat-medium", sans-serif;
            text-align: right;
            color: #b6b6b6;
            font-size: 16pt;
            margin-top: 20pt;
        }


        .canvas_1  .body-car-label table{
            top: 5pt;
        }

        .canvas_2 .body-car-label table{
            top: 3pt;
        }


        .canvas_3 .body-car-label table{
            top: -11pt;
        }

        .canvas_3 .body-car-label table .left{
            position: relative;
            top: 7px;
        }

        .label-3-3-left{
            position: absolute;
            top: 492pt;
            left: 10pt;
            width: 28pt;
            height: 20pt;
            color: white;
            font-size: 16pt;
            line-height: 10pt;
            font-family: 'DejaVu Sans';
        }
        .label-3-3-right{
            position: absolute;
            top: 491pt;
            left: -81pt;
            color: white;
            font-size: 16pt;
            line-height: 10pt;
            width: 300pt;
            height: 40pt;
            text-align: right;
        }

        .label-3-3-right-2{
            position: absolute;
            top: 506pt;
            left: -79pt;
            color: white;
            font-size: 16pt;
            line-height: 10pt;
            width: 300pt;
            height: 100pt;
            text-align: right;
        }



    </style>
</head>
<body>

<div class="container">



    <div class="banner">
        баннер
    </div>


    <div class="header-block">

        <table style="width: 668pt" cellpadding="0" cellspacing="0">
            <tr>
                <td style="width: 425pt; vertical-align: top">
                    <div style="margin-bottom: 21pt">
                        <img class="logo-image" src="<?= __DIR__ ?>/pdf-template-resources/img/logo.png" alt="">
                    </div>

                    <div style="padding-right: 42pt;">

                        <table cellpadding="0" cellspacing="0" style="width: 382pt;" >
                            <tr>
                                <td>
                                    <img class="car-image" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg">
                                </td>
                                <td style="text-align: left; vertical-align: top">

                                    <div class="rating">
                                        <div>4.5</div>
                                    </div>

                                </td>
                            </tr>
                        </table>





                    </div>



                </td>
                <td style="width: 243pt; border-left: 1px solid #888888; vertical-align: top">
                    <div style="padding-left: 42pt; line-height: 18pt">


                        <div class="report-style">
                            Отчет осмотра автомобиля
                        </div>

                        <div class="report-style-2">
                            Эксперт:
                        </div>

                        <div style="color: #ffc107; font-size: 21pt">
                            Горбунков Семён Семёныч
                        </div>

                        <div class="date">
                            12.23.8273

                        </div>


                    </div>
                </td>
            </tr>

        </table>


    </div>

    <div class="caption">
        Общая информация о ТС
    </div>

    <table class="list" cellspacing="0" cellpadding="0">
        <tr><td class="left">Марка</td><td class="right">Ауди</td></tr>
        <tr><td class="left">Модель</td><td class="right">dasdad</td></tr>
        <tr><td class="left">Год</td><td class="right">dasdad</td></tr>
        <tr><td class="left">VIN</td><td class="right">dasdad</td></tr>
        <tr><td class="left">Кузов</td><td class="right">dasdad</td></tr>
        <tr><td class="left">Кол-во дверей</td><td class="right">dasdad</td></tr>
        <tr><td class="left">Модель, № двигателя</td><td class="right">dasdad</td></tr>
        <tr><td class="left">Объем двигателя (куб.см.)</td><td class="right">dasdad</td></tr>
        <tr><td class="left">Привод</td><td class="right">dasdad</td></tr>
        <tr><td class="left">Возраст ТС</td><td class="right">dasdad</td></tr>
        <tr><td class="left">Страна производства</td><td class="right">dasdad</td></tr>
        <tr><td class="left">Кол-во владельцев</td><td class="right">dasdad</td></tr>

    </table>

    <div class="caption">
        Проверка ТС по базам
    </div>

    <table class="list" cellspacing="0" cellpadding="0">
        <tr><td class="left">ДТП</td><td class="right">dasdad</td></tr>
        <tr><td class="left">Записи о ТО</td><td class="right">dasdad</td></tr>
        <tr><td class="left">Частное ТС</td><td class="right">dasdad</td></tr>
        <tr><td class="left">Показание одометра</td><td class="right">dasdad</td></tr>

    </table>


    <div class="caption-with-rating">
        <table cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td class="left-td">


                    <table style="width: 680pt" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <td style="width: 2.203pt">
                                <img style="width: 100%; height: 54pt" src="<?= __DIR__ ?>/pdf-template-resources/img/left-side.jpg" alt="">
                            </td>
                            <td style="width: 675.594pt; position: relative">

                                <img style="width: 675.594pt; height: 54pt;" src="<?= __DIR__ ?>/pdf-template-resources/img/middle.jpg" alt="">
                                <div style="position: absolute; top:9pt; left:0; width: 675.594pt; height: 54pt; text-align: center; font-size: 30pt; color: white; line-height: 25pt">
                                    Кузов
                                </div>

                            </td>
                            <td style="width: 2.203pt">
                                <img style="width: 100%; height: 54pt" src="<?= __DIR__ ?>/pdf-template-resources/img/right-side.jpg" alt="">
                            </td>
                        </tr>
                    </table>



                </td>

                <td class="right-td">
                    <table style="width: 54pt; margin-left: 14pt" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <td style="width: 2.203pt">
                                <img style="width: 100%; height: 54pt" src="<?= __DIR__ ?>/pdf-template-resources/img/left-side-3.jpg" alt="">
                            </td>
                            <td style="width: 49.594pt; height: 54pt; position: relative">
                                <img style="width: 49.594pt; height: 54pt" src="<?= __DIR__ ?>/pdf-template-resources/img/middle-3.jpg" alt="">
                                <div class="caption-number">4.7</div>
                            </td>
                            <td style="width: 2.203pt">
                                <img style="width: 100%; height: 54pt" src="<?= __DIR__ ?>/pdf-template-resources/img/right-side-3.jpg" alt="">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>


    <div class="canvas_1">


        <img class="line_1" src="<?= __DIR__ ?>/pdf-template-resources/img/flags/1.png" alt="">
        <img class="body-car-image-1" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="body-car-image-2" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="body-car-image-3" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">


        <img class="body-right-col" src="<?= __DIR__ ?>/pdf-template-resources/img/flags/body-right-col.png" alt="">
        <img class="body-left-col" src="<?= __DIR__ ?>/pdf-template-resources/img/flags/body-left-col.png" alt="">
        <img class="car-body" src="<?= __DIR__ ?>/pdf-template-resources/img/flags/car-body.png" alt="">

        <img class="body-car-image-4" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="body-car-image-5" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="body-car-image-6" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="body-car-image-7" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="body-car-image-8" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="body-car-image-9" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">


        <img class="body-car-image-10" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="body-car-image-11" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="body-car-image-12" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="body-car-image-13" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="body-car-image-14" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="body-car-image-15" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="body-car-image-16" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="body-car-image-17" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">


        <img class="line_2" src="<?= __DIR__ ?>/pdf-template-resources/img/flags/2.png" alt="">


        <img class="body-car-image-18" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="body-car-image-19" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="body-car-image-20" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">



        <div class="body-car-label label-1">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">стекло лобовое</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-2">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">капот</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-3">
            <table style="width: 230pt">
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">бампер передний</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-4">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">фара</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-5">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">птф</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-6">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">крыло</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-7">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">диск</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-8">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">колодки</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-9">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">шина</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-10">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">зеркало</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-11">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">дверь передняя</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-12">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">порог</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-13">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">дверь задняя</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-14">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">диск</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-15">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">колодки</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-16">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">шина</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-17">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">крыло заднее</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-18">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">фонарь</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-19">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">стекло заднее</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-20">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">фара</td>
                </tr>
            </table>
        </div>


        <div class="body-car-label label-21">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">птф</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-22">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">крыло</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-23">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">диск</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-24">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">колодки</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-25">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">шина</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-26">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">зеркало</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-27">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">дверь передняя</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-28">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">порог</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-29">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">дверь задняя</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-30">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">диск</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-31">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">колодки</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-32">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">шина</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-33">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">крыло заднее</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-34">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">фонарь</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-35">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">бампер задний</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-36">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">крышка багажника</td>
                </tr>
            </table>
        </div>











    </div>

    <div class="disclaimer">
        <strong style="color: black; font-weight: normal">Disclaimer:</strong> Точность и достоверность информации AUTOTESMER зависит от различных источников, из которых она получается, поэтому AUTOTESMER или его представители
        не берут никакой ответственности за ошибки или пробелы в этом отчете, кроме того AUTOTESMER отказывается от всех гарантий, явных или подразумеваемых, включая
        любые подразумеваемые гарантии пригодности ТС для определенной цели
    </div>


    <div class="banner">
        баннер
    </div>

    <div class="caption-with-rating">
        <table cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td class="left-td">


                    <table style="width: 680pt" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <td style="width: 2.203pt">
                                <img style="width: 100%; height: 54pt" src="<?= __DIR__ ?>/pdf-template-resources/img/left-side.jpg" alt="">
                            </td>
                            <td style="width: 675.594pt; position: relative">

                                <img style="width: 675.594pt; height: 54pt;" src="<?= __DIR__ ?>/pdf-template-resources/img/middle.jpg" alt="">
                                <div style="position: absolute; top:9pt; left:0; width: 675.594pt; height: 54pt; text-align: center; font-size: 30pt; color: white; line-height: 25pt">
                                    Подкапотное пространство
                                </div>

                            </td>
                            <td style="width: 2.203pt">
                                <img style="width: 100%; height: 54pt" src="<?= __DIR__ ?>/pdf-template-resources/img/right-side.jpg" alt="">
                            </td>
                        </tr>
                    </table>



                </td>

                <td class="right-td">
                    <table style="width: 54pt; margin-left: 14pt" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <td style="width: 2.203pt">
                                <img style="width: 100%; height: 54pt" src="<?= __DIR__ ?>/pdf-template-resources/img/left-side-4.jpg" alt="">
                            </td>
                            <td style="width: 49.594pt; height: 54pt; position: relative">
                                <img style="width: 49.594pt; height: 54pt" src="<?= __DIR__ ?>/pdf-template-resources/img/middle-4.jpg" alt="">
                                <div class="caption-number">4.7</div>
                            </td>
                            <td style="width: 2.203pt">
                                <img style="width: 100%; height: 54pt" src="<?= __DIR__ ?>/pdf-template-resources/img/right-side-4.jpg" alt="">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>



    <div class="canvas_2">

        <img class="car-body-3" src="<?= __DIR__ ?>/pdf-template-resources/img/flags/car-body-3.png" alt="">
        <img class="flag-2-1" src="<?= __DIR__ ?>/pdf-template-resources/img/flags/flag-2-1.png" alt="">
        <img class="flag-2-2" src="<?= __DIR__ ?>/pdf-template-resources/img/flags/flag-2-2.png" alt="">
        <img class="flag-2-3" src="<?= __DIR__ ?>/pdf-template-resources/img/flags/flag-2-3.png" alt="">
        <img class="flag-2-4" src="<?= __DIR__ ?>/pdf-template-resources/img/flags/flag-2-4.png" alt="">

        <img class="sub-car-image-1" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="sub-car-image-2" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="sub-car-image-3" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="sub-car-image-4" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">

        <div class="body-car-label label-2-1">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">состояние ЛКП</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-2-2">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">двигатель</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-2-3">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">пластиковые детали</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-2-4">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">навесное оборудование</td>
                </tr>
            </table>
        </div>



    </div>



    <div class="caption-with-rating">
        <table cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td class="left-td">


                    <table style="width: 680pt" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <td style="width: 2.203pt">
                                <img style="width: 100%; height: 54pt" src="<?= __DIR__ ?>/pdf-template-resources/img/left-side.jpg" alt="">
                            </td>
                            <td style="width: 675.594pt; position: relative">

                                <img style="width: 675.594pt; height: 54pt;" src="<?= __DIR__ ?>/pdf-template-resources/img/middle.jpg" alt="">
                                <div style="position: absolute; top:9pt; left:0; width: 675.594pt; height: 54pt; text-align: center; font-size: 30pt; color: white; line-height: 25pt">
                                    Салон
                                </div>

                            </td>
                            <td style="width: 2.203pt">
                                <img style="width: 100%; height: 54pt" src="<?= __DIR__ ?>/pdf-template-resources/img/right-side.jpg" alt="">
                            </td>
                        </tr>
                    </table>



                </td>

                <td class="right-td">
                    <table style="width: 54pt; margin-left: 14pt" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <td style="width: 2.203pt">
                                <img style="width: 100%; height: 54pt" src="<?= __DIR__ ?>/pdf-template-resources/img/left-side-2.jpg" alt="">
                            </td>
                            <td style="width: 49.594pt; height: 54pt; position: relative">
                                <img style="width: 49.594pt; height: 54pt" src="<?= __DIR__ ?>/pdf-template-resources/img/middle-2.jpg" alt="">
                                <div class="caption-number">4.7</div>
                            </td>
                            <td style="width: 2.203pt">
                                <img style="width: 100%; height: 54pt" src="<?= __DIR__ ?>/pdf-template-resources/img/right-side-2.jpg" alt="">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <div class="canvas_3">

        <img class="car-body-4" src="<?= __DIR__ ?>/pdf-template-resources/img/flags/car-body-4.png" alt="">
        <img class="flag-3-1" src="<?= __DIR__ ?>/pdf-template-resources/img/flags/flag-3-1.png" alt="">
        <img class="flag-3-2" src="<?= __DIR__ ?>/pdf-template-resources/img/flags/flag-3-2.png" alt="">
        <img class="flag-3-3" src="<?= __DIR__ ?>/pdf-template-resources/img/flags/flag-3-3.png" alt="">
        <img class="flag-3-4" src="<?= __DIR__ ?>/pdf-template-resources/img/flags/flag-3-4.png" alt="">
        <img class="flag-3-5" src="<?= __DIR__ ?>/pdf-template-resources/img/flags/flag-3-5.png" alt="">
        <img class="flag-3-6" src="<?= __DIR__ ?>/pdf-template-resources/img/flags/flag-3-6.png" alt="">
        <img class="flag-3-7" src="<?= __DIR__ ?>/pdf-template-resources/img/flags/flag-3-7.png" alt="">
        <img class="flag-3-8" src="<?= __DIR__ ?>/pdf-template-resources/img/flags/flag-3-8.png" alt="">
        <img class="flag-3-9" src="<?= __DIR__ ?>/pdf-template-resources/img/flags/flag-3-9.png" alt="">
        <img class="flag-3-10" src="<?= __DIR__ ?>/pdf-template-resources/img/flags/flag-3-10.png" alt="">

        <img class="salon-car-image-1" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="salon-car-image-2" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="salon-car-image-3" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="salon-car-image-4" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="salon-car-image-5" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="salon-car-image-6" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="salon-car-image-7" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="salon-car-image-8" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="salon-car-image-9" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="salon-car-image-10" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">


        <div class="body-car-label label-3-1">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">руль переключатели</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-3-2">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">панель приборов переключатели</td>
                </tr>
            </table>
        </div>





        <div class="label-3-3-left">4.5</div>
        <div class="label-3-3-right">магнитола</div>
        <div class="label-3-3-right-2">климатическая установка</div>

        <div class="body-car-label label-3-4">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">сиденье переднее</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-3-5">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">пол педали коврики</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-3-6">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">сиденья задние</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-3-7">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">дверь переключатели</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-3-8">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">прочее</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-3-9">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">ошибки при диагностике</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-3-10">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">потолок, переключатели</td>
                </tr>
            </table>
        </div>

    </div>


    <div class="style-222" style="margin-bottom: 22pt">
        Заключение эксперта о пробеге авто: <strong style="color: #2a802e; font-weight: normal;">Реальный</strong>
    </div>

    <div class="disclaimer-2" style="margin-bottom: 80pt">
        <strong style="color: black; font-weight: normal">Disclaimer:</strong> Точность и достоверность информации AUTOTESMER зависит от различных источников, из которых она получается, поэтому AUTOTESMER или его представители
        не берут никакой ответственности за ошибки или пробелы в этом отчете, кроме того AUTOTESMER отказывается от всех гарантий, явных или подразумеваемых, включая
        любые подразумеваемые гарантии пригодности ТС для определенной цели
    </div>



    <div class="banner" style="margin-bottom: 22pt">
        баннер
    </div>


    <div class="caption-with-rating">
        <table cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td class="left-td">


                    <table style="width: 680pt" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <td style="width: 2.203pt">
                                <img style="width: 100%; height: 54pt" src="<?= __DIR__ ?>/pdf-template-resources/img/left-side.jpg" alt="">
                            </td>
                            <td style="width: 675.594pt; position: relative">

                                <img style="width: 675.594pt; height: 54pt;" src="<?= __DIR__ ?>/pdf-template-resources/img/middle.jpg" alt="">
                                <div style="position: absolute; top:9pt; left:0; width: 675.594pt; height: 54pt; text-align: center; font-size: 30pt; color: white; line-height: 25pt">
                                    Багажник
                                </div>

                            </td>
                            <td style="width: 2.203pt">
                                <img style="width: 100%; height: 54pt" src="<?= __DIR__ ?>/pdf-template-resources/img/right-side.jpg" alt="">
                            </td>
                        </tr>
                    </table>



                </td>

                <td class="right-td">
                    <table style="width: 54pt; margin-left: 14pt" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <td style="width: 2.203pt">
                                <img style="width: 100%; height: 54pt" src="<?= __DIR__ ?>/pdf-template-resources/img/left-side-2.jpg" alt="">
                            </td>
                            <td style="width: 49.594pt; height: 54pt; position: relative">
                                <img style="width: 49.594pt; height: 54pt" src="<?= __DIR__ ?>/pdf-template-resources/img/middle-2.jpg" alt="">
                                <div class="caption-number">4.7</div>
                            </td>
                            <td style="width: 2.203pt">
                                <img style="width: 100%; height: 54pt" src="<?= __DIR__ ?>/pdf-template-resources/img/right-side-2.jpg" alt="">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>


    <div class="canvas_4">

        <img class="car-body-5" src="<?= __DIR__ ?>/pdf-template-resources/img/flags/car-body-5.png" alt="">


        <img class="flag-4-1" src="<?= __DIR__ ?>/pdf-template-resources/img/flags/flag-4-1.png" alt="">
        <img class="flag-4-2" src="<?= __DIR__ ?>/pdf-template-resources/img/flags/flag-4-2.png" alt="">
        <img class="flag-4-3" src="<?= __DIR__ ?>/pdf-template-resources/img/flags/flag-4-3.png" alt="">

        <img class="back-car-image-1" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="back-car-image-2" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="back-car-image-3" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">

        <div class="body-car-label label-4-1">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">пол, обивка, освещение</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-4-2">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">инструменты, домкрат, фаркоп</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-4-3">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">запасное колесо</td>
                </tr>
            </table>
        </div>

    </div>

    <div class="caption-with-rating">
        <table cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td class="left-td">


                    <table style="width: 680pt" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <td style="width: 2.203pt">
                                <img style="width: 100%; height: 54pt" src="<?= __DIR__ ?>/pdf-template-resources/img/left-side.jpg" alt="">
                            </td>
                            <td style="width: 675.594pt; position: relative">

                                <img style="width: 675.594pt; height: 54pt;" src="<?= __DIR__ ?>/pdf-template-resources/img/middle.jpg" alt="">
                                <div style="position: absolute; top:9pt; left:0; width: 675.594pt; height: 54pt; text-align: center; font-size: 30pt; color: white; line-height: 25pt">
                                    Осмотр на подъемнике
                                </div>

                            </td>
                            <td style="width: 2.203pt">
                                <img style="width: 100%; height: 54pt" src="<?= __DIR__ ?>/pdf-template-resources/img/right-side.jpg" alt="">
                            </td>
                        </tr>
                    </table>



                </td>

                <td class="right-td">
                    <table style="width: 54pt; margin-left: 14pt" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <td style="width: 2.203pt">
                                <img style="width: 100%; height: 54pt" src="<?= __DIR__ ?>/pdf-template-resources/img/left-side-2.jpg" alt="">
                            </td>
                            <td style="width: 49.594pt; height: 54pt; position: relative">
                                <img style="width: 49.594pt; height: 54pt" src="<?= __DIR__ ?>/pdf-template-resources/img/middle-2.jpg" alt="">
                                <div class="caption-number">4.7</div>
                            </td>
                            <td style="width: 2.203pt">
                                <img style="width: 100%; height: 54pt" src="<?= __DIR__ ?>/pdf-template-resources/img/right-side-2.jpg" alt="">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>



    <div class="canvas_5">

        <img class="car-body2" src="<?= __DIR__ ?>/pdf-template-resources/img/flags/car-body-2.png" alt="">

        <img class="four-car-image-1" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="four-car-image-2" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="four-car-image-3" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="four-car-image-4" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">
        <img class="four-car-image-5" src="<?= __DIR__ ?>/pdf-template-resources/img/car.jpg" alt="">


        <img class="flag-5" src="<?= __DIR__ ?>/pdf-template-resources/img/flags/flag-5.png" alt="">
        <img class="flag-5-2" src="<?= __DIR__ ?>/pdf-template-resources/img/flags/flag-5.png" alt="">
        <img class="flag-5-3" src="<?= __DIR__ ?>/pdf-template-resources/img/flags/flag-5.png" alt="">
        <img class="flag-5-4" src="<?= __DIR__ ?>/pdf-template-resources/img/flags/flag-5-2.png" alt="">
        <img class="flag-5-5" src="<?= __DIR__ ?>/pdf-template-resources/img/flags/flag-5-3.png" alt="">

        <div class="body-car-label label-5-1">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">передняя подвеска</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-5-2">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">система выхлопа</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-5-3">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">задняя подвеска</td>
                </tr>
            </table>
        </div>

        <div class="body-car-label label-5-4">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">шланги, проводка</td>
                </tr>
            </table>
        </div>


        <div class="body-car-label label-5-5">
            <table>
                <tr>
                    <td class="left">4.5</td>
                    <td class="right">состояние антикоррозийного антигравийного покрытия</td>
                </tr>
            </table>
        </div>



    </div>

    <div class="disclaimer-2" style="margin-bottom: 60pt">
        <strong style="color: black; font-weight: normal">Disclaimer:</strong> Точность и достоверность информации AUTOTESMER зависит от различных источников, из которых она получается, поэтому AUTOTESMER или его представители
        не берут никакой ответственности за ошибки или пробелы в этом отчете, кроме того AUTOTESMER отказывается от всех гарантий, явных или подразумеваемых, включая
        любые подразумеваемые гарантии пригодности ТС для определенной цели
    </div>


    <div class="banner" style="margin-bottom: 22pt">
        баннер
    </div>

    <div class="caption-with-rating">
        <table cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td class="left-td">


                    <table style="width: 680pt" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <td style="width: 2.203pt">
                                <img style="width: 100%; height: 54pt" src="<?= __DIR__ ?>/pdf-template-resources/img/left-side.jpg" alt="">
                            </td>
                            <td style="width: 675.594pt; position: relative">

                                <img style="width: 675.594pt; height: 54pt;" src="<?= __DIR__ ?>/pdf-template-resources/img/middle.jpg" alt="">
                                <div style="position: absolute; top:9pt; left:0; width: 675.594pt; height: 54pt; text-align: center; font-size: 30pt; color: white; line-height: 25pt">
                                    Затраты после покупки
                                </div>

                            </td>
                            <td style="width: 2.203pt">
                                <img style="width: 100%; height: 54pt" src="<?= __DIR__ ?>/pdf-template-resources/img/right-side.jpg" alt="">
                            </td>
                        </tr>
                    </table>



                </td>

                <td class="right-td">
                    <table style="width: 54pt; margin-left: 14pt" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <td style="width: 2.203pt">
                                <img style="width: 100%; height: 54pt" src="<?= __DIR__ ?>/pdf-template-resources/img/left-side-2.jpg" alt="">
                            </td>
                            <td style="width: 49.594pt; height: 54pt; position: relative">
                                <img style="width: 49.594pt; height: 54pt" src="<?= __DIR__ ?>/pdf-template-resources/img/middle-2.jpg" alt="">
                                <div class="caption-number">4.7</div>
                            </td>
                            <td style="width: 2.203pt">
                                <img style="width: 100%; height: 54pt" src="<?= __DIR__ ?>/pdf-template-resources/img/right-side-2.jpg" alt="">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>


    <style>

        .table-price{margin-bottom: 20pt;}

        .table-price table{
            width: 748pt;
        }
        .table-price table tr.even{
            background-color: #f8f8fa;
        }
        .table-price table tr,
        .table-price table td{
            height: 77pt;
            font-size: 0;
            line-height: 0;
            color: #666666;
        }
        .table-price table td.first-column{
            width: 51pt;
        }
        .table-price table td.middle-column{
            width: 447pt;
        }
        .table-price table td.right-column{
            width: 250pt;
        }


        .table-price table td.first-column div{
            margin-left: 17pt;
            width: 34pt;
            height: 34pt;
            background-color: #a2a2a2;
        }

        .table-price table td.middle-column div{
            height: 100pt;
            font-size: 20pt;
            line-height: 53pt;
            margin-left: 13pt;
        }
        .table-price table td.right-column div {
            height: 100pt;
            font-size: 20pt;
            line-height: 55pt;
            text-align: right;
            margin-right: 17pt;
        }

    </style>


    <div class="table-price">

        <table cellpadding="0" cellspacing="0" border="0">
            <tr class="even">
                <td class="first-column"><div></div></td>
                <td class="middle-column"><div>Двигатель, трансмиссия</div></td>
                <td class="right-column"><div>1000р.</div></td>
            </tr>

            <tr>
                <td class="first-column"><div></div></td>
                <td class="middle-column"><div>Подвеска, тормоза</div></td>
                <td class="right-column"><div>1000р.</div></td>
            </tr>

            <tr class="even">
                <td class="first-column"><div></div></td>
                <td class="middle-column"><div>Салон</div></td>
                <td class="right-column"><div>1000р.</div></td>
            </tr>

            <tr>
                <td class="first-column"><div></div></td>
                <td class="middle-column"><div>Кузов и стекла</div></td>
                <td class="right-column"><div>1000р.</div></td>
            </tr>

            <tr class="even">
                <td class="first-column"><div></div></td>
                <td class="middle-column"><div>Второй комплект резины/колес</div></td>
                <td class="right-column"><div>1000р.</div></td>
            </tr>

            <tr>
                <td class="first-column"><div></div></td>
                <td class="middle-column"><div>Противоугонная система/подогрев</div></td>
                <td class="right-column"><div>1000р.</div></td>
            </tr>

            <tr class="even">
                <td class="first-column"><div></div></td>
                <td class="middle-column"><div>Электрика</div></td>
                <td class="right-column"><div>1000р.</div></td>
            </tr>

            <tr>
                <td class="first-column"><div></div></td>
                <td class="middle-column"><div>Прочее</div></td>
                <td class="right-column"><div>1000р.</div></td>
            </tr>

            <tr class="even">
                <td class="first-column"><div></div></td>
                <td class="middle-column"><div>Итого</div></td>
                <td class="right-column"><div>1000р.</div></td>
            </tr>
        </table>

    </div>




    <div class="disclaimer-2">
        <strong style="color: black; font-weight: normal">Disclaimer:</strong> Точность и достоверность информации AUTOTESMER зависит от различных источников, из которых она получается, поэтому AUTOTESMER или его представители
        не берут никакой ответственности за ошибки или пробелы в этом отчете, кроме того AUTOTESMER отказывается от всех гарантий, явных или подразумеваемых, включая
        любые подразумеваемые гарантии пригодности ТС для определенной цели
    </div>

</div>
</body>
</html>
