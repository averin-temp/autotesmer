<?php
// множитель  1122

/** @var $this \yii\web\View */
/** @var $report \common\models\ReportAuto */

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<HTML>
<HEAD>
    <TITLE></TITLE>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>

        @page  {
            margin: 0;
            font-family: DejaVu Sans, sans-serif;
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
            width: 100%;
            padding: 64px;
        }

        .banner{
            width: 100%;
            height: 141px;
            font-family: 'montserrat-medium', sans-serif;
            text-align: center;
            font-size: 77px;
            color: #bab8b8;
            background-color: #a2a2a2;
        }

        .header{
            background-color: #333333;
            padding: 30px 50px;
        }

        .main-columns .column-left{
            width: 569px;
            border-right: 1px solid #b6b6b6;
        }


        .main-columns .column-right{
            padding-left: 52px;
            position: relative;
            vertical-align: top;
        }

        .inner-columns .column-left{
            width: 390px;
        }

        .logo-image > img{
            width: 306px;
            height: 44px;
        }

        .logo-image{
            margin-bottom: 30px;
        }

        .photo-and-rating{
            font-size: 0;
            text-align: left;
        }

        .header-image{
            display: inline-block;
            vertical-align: top;
        }
        .header-image > img{
            width: 390px;
            height: 260px;
        }

        .rating-square{
            display: inline-block;
            width: 122px;
            height: 80px;
            background-color: #5eb761;
            vertical-align: top;
            text-align: center;
            font-family: 'montserrat-black', sans-serif;
            font-style: normal;
            color: #ffffff;
            font-size: 24px;
            padding-top: 42px;
        }



        .header-label-1{
            position: relative;
            top: -9px;
            left:3px;
            font-family: 'montserrat-black', sans-serif;
            font-size: 37px;
            line-height: 33px;
            color: white;
            border-bottom: 1px solid #b6b6b6;
            padding-bottom: 25px;
            letter-spacing: 2px;
            vertical-align: top;
        }


        .header-label-2{
            font-family: 'montserrat-medium', sans-serif;
            font-size: 27px;
            color: #b6b6b6;
            padding-top: 4px;
            margin-bottom: 5px;
        }

        .header-expert-name{
            font-family: 'montserrat-medium', sans-serif;
            font-size: 27px;
            color: #ffc107;
            line-height: 24px;
            margin-bottom: 30px;
        }


        .date{
            font-family: 'montserrat-medium', sans-serif;
            font-size: 18px;
            color: #b6b6b6;
            text-align: right;
            height: 25px;
        }

        .caption{
            background-color: #333333;
            font-family: 'montserrat-medium', sans-serif;
            font-size: 32px;
            color: #fefefe;
            text-align: center;
            height: 73px;
            line-height: 43px;
        }


        .property-list{
            padding: 11px 23px 40px 23px;
        }
        .property-list table{
            width: 100%;
            font-family: 'montserrat-medium', sans-serif;
        }

        .property-list .first{
            font-size: 27px;
            color: #666666;
            text-align: left;
        }

        .property-list .second{
            font-size: 27px;
            color: #000000;
            text-align: right;
        }


        .underhood{
            height: 1080px;
            position: relative;
        }

        .underhood-background{
            position: absolute;
            width: 996px;
            height: 388px;
            left: -1px;
            top:196px;
            z-index: 10;
        }

        .salon{
            position: relative;
            height: 1130px;
        }

        .salon-background{
            width: 995px;
            height: 737px;
            position: absolute;
            left: 0;
            top:196px;
        }




        .photo-label{
            position: absolute;
            height: 250px;
            width: 293px;
            z-index: 20;
        }

        .photo-label .photo{
            position: absolute;
            width: 293px;
            height: 195px;
            top:0;
            left:0;
        }

        .photo-label .text{
            position: absolute;
            height: 44px;
            width: 217px;
            right:0;
            top: 196px;
            text-align: right;
            overflow: hidden;
            padding-right: 16px;
            padding-top: 10px;
            color: white;

        }

        .photo-label .ball{
            height: 48px;
            width: 61px;
            left:0;
            top: 196px;
            position: absolute;
            text-align: center;
            color: white;
            font-family: 'montserrat-black', sans-serif;
            font-size: 22px;
            padding-top: 6px;
        }

        .photo-label.right .text{
            left:0;
            right: auto;
            text-align: left;
            font-family: 'montserrat-medium', sans-serif;
            font-size: 20px;
            color: white;

        }

        .photo-label.right .ball{
            right:0;
            left:auto;
            text-align: right;
        }


        .photo-label.down .photo{
            top:54px;
        }

        .photo-label.down .text{
            top: 0;
        }
        .photo-label.down .ball{
            top: 0;
        }

        .photo-label.strings2 .text{
            padding-top: 0;
            height: 54px;
        }

        .photo-label.strings2 .text span{
            display: block;
            text-align: right;
            line-height: 18px;
        }



        .photo-label.strings4 {
            height: 321px;
        }
        .photo-label.strings4 .text{
            padding-top: 10px;
            height: 115px;
        }
        .photo-label.strings4 .text span{
            display: block;
            text-align: right;
            line-height: 18px;
        }

        .photo-label.strings4 .ball{
            height: 85px;
            padding-top: 40px;
        }

        .trunk-block{
            position: relative;
            height:680px;
            width:100%;
        }

        .trunk-block-background{
            position: absolute;
            top:0;
            left:0;
            width: 995px;
            height: 484px;
            z-index: 10;
        }

        .inspection{
            position: relative;
            height:1314px;
            width:100%;
        }

        .inspection-background{
            position: absolute;
            top:196px;
            left:0;
            width: 994px;
            height: 887px;
            z-index: 10;
        }


        .body-block{
            position: relative;
            height: 2900px;
        }

        .body-background{
            position: absolute;
            top: 196px;
            width: 994px;
            height: 2508px;
            z-index: 10;
        }





        .photo-label-2{
            position: absolute;
            width: 293px;
            height: 226px;
            font-size: 0;
            z-index: 20;
        }

        .photo-label-2 .photo{
            width: 294px;
            height: 196px;
        }

        .photo-label-2 .label{
            height: 30px;
            width: 293px;
            color: white;
            font-size: 0;
        }

        .photo-label-2 .label .ball{
            display: inline-block;
            width: 60px;
            height: 30px;
            font-family: 'montserrat-black', sans-serif;
            text-align: center;
            font-size: 22px;
            line-height: 21px;
        }

        .photo-label-2 .label .text{
            display: inline-block;
            width: 227px;
            height: 30px;
            font-family: 'montserrat-medium', sans-serif;
            font-size: 20px;
            text-align: right;
            padding-right: 15px;
            line-height: 19px;
        }

        .disclimer{
            font-size: 18px;
            font-family: 'montserrat-medium', sans-serif;
            color: #a9a9aa;
            padding: 0 74px;
            margin: 30px 0;
        }

        .disclimer strong{
            color: black;
        }

        .cost-after-buy{}

        .cost-after-buy .line{

            vertical-align: top;
            padding-top: 30px;
            height: 75px;
            font-size: 0;
        }

        .cost-after-buy .square{
            display: inline-block;
            height: 45px;
            width: 45px;
            background-color: #a2a2a2;
            margin-left: 23px;
        }

        .cost-after-buy .label{
            display: inline-block;
            font-family: 'montserrat-medium', sans-serif;
            font-size: 27px;
            color: #666666;
            width: 476px;
            padding-left: 30px;
            line-height: 22px;
            vertical-align: top;
        }

        .cost-after-buy .cost{
            display: inline-block;
            font-family: 'montserrat-medium', sans-serif;
            font-size: 20px;
            color: #666666;
            width: 389px;
            text-align: right;
            padding-right: 30px;
            line-height: 22px;
            vertical-align: top;
        }


        .paintwork_condition_photo{ left:4px; top: 0px; }
        .engine_photo{ right:5px; top: 0px; }
        .plastic_parts_photo{ left:4px; top: 531px; }
        .attachment_equipment_photo{ right:5px; top: 531px; }



        .steering_wheel_and_paddle_switches_photo{ left: 4px; top: 1px;}
        .ceiling_photo{ left: 350px; top: 1px;}
        .diagnostic_errors_photo{ right: 4px; top: 1px;}

        .right_front_door_photo{ right: 4px; top:  607px;}
        .rear_seat_photo{ right: 4px; top:  879px;}

        .floor_photo{ left: 350px; top: 879px;}
        .front_passenger_seat_photo{ left: 4px; top: 879px;}
        .recorder_photo{ left: 4px; top: 607px;}
        .dashboard_photo{ left: 4px; top: 273px;}

        .trunk_upholstery_photo{ left: 4px; top:430px; }
        .hitch_photo{ left: 349px; top:430px; }
        .spare_wheel_photo{ right: 4px; top:430px; }


        .paintwork_condition_photo2{left: 4px; top:0;}
        .wiring_photo{right: 5px; top:71px;}

        .front_suspension_photo{left: 4px; top:1029px; }
        .exhaust_system_photo{left: 350px; top:1029px;}
        .rear_suspension_photo{right: 4px; top:1029px;}

        .windshield_photo{ top:0; left: 4px; }
        .hood_photo{top:0; left: 351px;}
        .front_bumper_photo{top:0; right: 4px;}

        .right_headlight_photo{top:386px; left: 4px;}
        .left_headlight_photo{top:386px; right: 4px;}

        .right_fog_lights_photo{top:634px; right: 4px;}
        .left_fog_lights_photo{top:634px; left: 4px;}

        .left_front_door_photo{ top:1337px; left: 4px; }
        .right_front_door_photo{ top:1337px; right: 4px; }


        .left_back_door_photo{ top:1637px; left: 4px; }
        .right_back_door_photo{ top:1637px; right: 4px; }


        .right_front_tire_photo{ top:1989px; right: 4px; }
        .left_front_tire_photo{ top:1989px; left: 4px; }

        .left_back_lamp_photo{ top:2289px; left: 4px; }
        .right_back_lamp_photo{ top:2289px; right: 4px; }

        .rear_glass_photo{ top:2674px; left: 4px; }
        .trunk_lid_photo{ top:2674px; left: 351px; }
        .rear_bumper_photo{ top:2674px; right: 4px; }

        .left_front_wing_photo{ top:881px; left: 4px;}
        .right_front_wing_photo{ top:881px; right: 4px;}

        .right_front_wheels_photo{ top:934px; right: 4px;}
        .left_front_wheels_photo{ top:934px; left: 4px;}


        .left_front_pads_photo{ top:1181px; left: 4px;}
        .right_front_pads_photo{ top:1181px; right: 4px;}

        .left_back_tire_photo{ top:1233px; left: 4px;}
        .right_back_tire_photo{ top:1233px; right: 4px;}

        .right_mirror_photo{ top:1285px; right: 4px;}
        .left_mirror_photo{ top:1285px; left: 4px;}

        .left_front_door_photo{ top:1337px; left: 4px;}
        .right_front_door_photo{ top:1337px; right: 4px;}

        .right_threshold_photo{ top:1585px; right: 4px;}
        .left_threshold_photo{ top:1585px; left: 4px;}

        .left_back_wheels_photo{ top: 1885px; left: 4px; }
        .right_back_wheels_photo{ top: 1885px; right: 4px; }


        .left_back_pads_photo{top: 1937px; left: 4px;}
        .right_back_pads_photo{top: 1937px; right: 4px;}


        .left_back_wing_photo{top: 2237px; left: 4px;}
        .right_back_wing_photo{top: 2237px; right: 4px;}




    </style>
</HEAD>
<BODY>

<div class="container">

    <div class="banner" style="margin-bottom: 30px">баннер</div>

    <div class="header">

        <table cellspacing="0" cellpadding="0" border="0" width="100%">
            <tr class="main-columns">
                <td class="column-left">
                    <div class="logo-image">
                        <img src="<?= __DIR__ ?>/img/test/logo.png" alt="">
                    </div>

                    <div class="photo-and-rating">
                        <div class="header-image">
                            <img src="<?= $report->photo ?>" alt="">
                        </div>
                        <div class="rating-square"><?= $report->rating() ?></div>
                    </div>


                </td>
                <td class="column-right">
                    <div class="header-label-1">
                        <div>Отчет</div>
                        <div>осмотра</div>
                        <div>автомобиля</div>
                    </div>
                    <div class="header-label-2">Эксперт</div>
                    <div class="header-expert-name">

                        <?php $expert = $report->getExpert(); ?>
                        <span><?= ucfirst($expert->family) ?></span> <span><?= ucfirst($expert->firstname) ?></span> <span><?= ucfirst($expert->lastname) ?></span>
                    </div>
                    <div class="date"><?= date("d.m.Y") ?></div>
                </td>
            </tr>
        </table>
    </div>

    <div class="caption" style="margin-top: 30px;">Общая информация о ТС</div>

    <div class="property-list">
        <table cellspacing="0" cellpadding="0">
            <tr><td class="first">Марка</td><td class="second"><?= $report->getBrand()->name ?></td></tr>
            <tr><td class="first">Модель</td><td class="second"><?= $report->getModel()->name ?></td></tr>
            <tr><td class="first">Год</td><td class="second"><?= $report->year ?></td></tr>
            <tr><td class="first">VIN</td><td class="second"><?= $report->vin ?></td></tr>
            <tr><td class="first">Кузов</td><td class="second"><?= $report->getBody() ?></td></tr>
            <tr><td class="first">Кол-во дверей</td><td class="second"><?= $report->doors_number ?></td></tr>
            <tr><td class="first">Привод</td><td class="second"><?= $report->getDrive() ?></td></tr>
            <tr><td class="first">Возраст ТС</td><td class="second"><?= $report->age ?></td></tr>
            <tr><td class="first">Страна производства</td><td class="second"><?= $report->getVendorCountry()->name ?></td></tr>
            <tr><td class="first">Кол-во владельцев</td><td class="second"><?= $report->owner_count ?></td></tr>
        </table>
    </div>

    <div class="caption">Проврка ТС по базам</div>

    <div class="property-list">
        <table cellspacing="0" cellpadding="0">
            <tr><td class="first">ДТП</td><td class="second"><?= $report->traffic_accidents ?></td></tr>
            <tr><td class="first">Записи о ТО</td><td class="second"><?= $report->inspection_records ?></td></tr>
            <tr><td class="first">Частное ТС</td><td class="second"><?= $report->personal_vehicle ?></td></tr>
            <tr><td class="first">Показание одометра</td><td class="second"><?= $report->odometer_readings ?></td></tr>
        </table>
    </div>

    <div class="caption-rating">
        <div class="caption">Кузов</div><div class="rating"></div>
    </div>


    <div class="body-block">


        <div class="photo-label-2 windshield_photo">
            <img class="photo" src="<?= $report->windshield_photo ?>" alt="">
            <div class="label">
                <div class="ball"><?= $report->windshield ?></div>
                <div class="text">стекло лобовое</div>
            </div>
        </div>


        <div class="photo-label-2 hood_photo">
            <img class="photo" src="<?= $report->hood_photo ?>" alt="">
            <div class="label">
                <div class="ball"><?= $report->hood ?></div>
                <div class="text">капот</div>
            </div>
        </div>

        <div class="photo-label-2 front_bumper_photo">
            <img class="photo" src="<?= $report->front_bumper_photo ?>" alt="">
            <div class="label">
                <div class="ball"><?= $report->front_bumper ?></div>
                <div class="text">бампер передний</div>
            </div>
        </div>

        <div class="photo-label-2 right_headlight_photo">
            <img class="photo" src="<?= $report->right_headlight_photo ?>" alt="">
            <div class="label">
                <div class="ball"><?= $report->right_headlight ?></div>
                <div class="text">фара</div>
            </div>
        </div>

        <div class="photo-label-2 left_headlight_photo">
            <img class="photo" src="<?= $report->left_headlight_photo ?>" alt="">
            <div class="label">
                <div class="ball"><?= $report->left_headlight ?></div>
                <div class="text">фара</div>
            </div>
        </div>


        <div class="photo-label-2 right_fog_lights_photo">
            <img class="photo" src="<?= $report->right_fog_lights_photo ?>" alt="">
            <div class="label">
                <div class="ball"><?= $report->right_fog_lights ?></div>
                <div class="text">ПТФ</div>
            </div>
        </div>

        <div class="photo-label-2 left_fog_lights_photo">
            <img class="photo" src="<?= $report->left_fog_lights_photo ?>" alt="">
            <div class="label">
                <div class="ball"><?= $report->left_fog_lights ?></div>
                <div class="text">ПТФ</div>
            </div>
        </div>


        <div class="photo-label-2 left_front_wing_photo">
            <div class="label">
                <div class="ball"><?= $report->left_front_wing ?></div>
                <div class="text">крыло</div>
            </div>
        </div>

        <div class="photo-label-2 right_front_wing_photo">
            <div class="label">
                <div class="ball"><?= $report->right_front_wing ?></div>
                <div class="text">крыло</div>
            </div>
        </div>


        <div class="photo-label-2 left_front_wheels_photo">
            <img class="photo" src="<?= $report->left_front_wheels_photo ?>" alt="">
            <div class="label">
                <div class="ball"><?= $report->left_front_wheels ?></div>
                <div class="text">Диск</div>
            </div>
        </div>

        <div class="photo-label-2 right_front_wheels_photo">
            <img class="photo" src="<?= $report->right_front_wheels_photo ?>" alt="">
            <div class="label">
                <div class="ball"><?= $report->right_front_wheels ?></div>
                <div class="text">Диск</div>
            </div>
        </div>


        <div class="photo-label-2 left_front_pads_photo">
            <div class="label">
                <div class="ball"><?= $report->left_front_pads ?></div>
                <div class="text">колодки</div>
            </div>
        </div>

        <div class="photo-label-2 right_front_pads_photo">
            <div class="label">
                <div class="ball"><?= $report->right_front_pads ?></div>
                <div class="text">колодки</div>
            </div>
        </div>


        <div class="photo-label-2 left_back_tire_photo">
            <div class="label">
                <div class="ball"><?= $report->left_back_tire ?></div>
                <div class="text">шина</div>
            </div>
        </div>

        <div class="photo-label-2 right_back_tire_photo">
            <div class="label">
                <div class="ball"><?= $report->right_back_tire ?></div>
                <div class="text">шина</div>
            </div>
        </div>

        <div class="photo-label-2 right_mirror_photo">
            <div class="label">
                <div class="ball"><?= $report->right_mirror ?></div>
                <div class="text">зеркало</div>
            </div>
        </div>

        <div class="photo-label-2 left_mirror_photo">
            <div class="label">
                <div class="ball"><?= $report->left_mirror ?></div>
                <div class="text">зеркало</div>
            </div>
        </div>

        <div class="photo-label-2 right_threshold_photo">
            <div class="label">
                <div class="ball"><?= $report->right_threshold ?></div>
                <div class="text">порог</div>
            </div>
        </div>

        <div class="photo-label-2 left_threshold_photo">
            <div class="label">
                <div class="ball"><?= $report->left_threshold ?></div>
                <div class="text">порог</div>
            </div>
        </div>


        <div class="photo-label-2 right_front_door_photo">
            <div class="label">
                <div class="ball"><?= $report->right_front_door ?></div>
                <div class="text">дверь передняя</div>
            </div>
            <img class="photo" src="<?= $report->right_front_door_photo ?>" alt="">
        </div>

        <div class="photo-label-2 left_front_door_photo">
            <div class="label">
                <div class="ball"><?= $report->left_front_door ?></div>
                <div class="text">дверь передняя</div>
            </div>
            <img class="photo" src="<?= $report->left_front_door_photo ?>" alt="">
        </div>

        <div class="photo-label-2 left_back_door_photo">
            <div class="label">
                <div class="ball"><?= $report->left_back_door ?></div>
                <div class="text">дверь задняя</div>
            </div>
            <img class="photo" src="<?= $report->left_back_door_photo ?>" alt="">
        </div>

        <div class="photo-label-2 right_back_door_photo">
            <div class="label">
                <div class="ball"><?= $report->right_back_door ?></div>
                <div class="text">дверь задняя</div>
            </div>
            <img class="photo" src="<?= $report->right_back_door_photo ?>" alt="">
        </div>


        <div class="photo-label-2 left_back_wheels_photo">
            <div class="label">
                <div class="ball"><?= $report->left_back_wheels ?></div>
                <div class="text">диск</div>
            </div>
        </div>

        <div class="photo-label-2 right_back_wheels_photo">
            <div class="label">
                <div class="ball"><?= $report->right_back_wheels ?></div>
                <div class="text">диск</div>
            </div>
        </div>

        <div class="photo-label-2 left_back_pads_photo">
            <div class="label">
                <div class="ball"><?= $report->left_back_pads ?></div>
                <div class="text">колодки</div>
            </div>
        </div>

        <div class="photo-label-2 right_back_pads_photo">
            <div class="label">
                <div class="ball"><?= $report->right_back_pads ?></div>
                <div class="text">колодки</div>
            </div>
        </div>


        <div class="photo-label-2 right_front_tire_photo">
            <div class="label">
                <div class="ball"><?= $report->right_front_tire ?></div>
                <div class="text">Шина</div>
            </div>
            <img class="photo" src="<?= $report->right_front_tire_photo ?>" alt="">
        </div>

        <div class="photo-label-2 left_front_tire_photo">
            <div class="label">
                <div class="ball"><?= $report->left_front_tire ?></div>
                <div class="text">Шина</div>
            </div>
            <img class="photo" src="<?= $report->left_front_tire_photo ?>" alt="">
        </div>


        <div class="photo-label-2 left_back_wing_photo">
            <div class="label">
                <div class="ball"><?= $report->left_back_wing ?></div>
                <div class="text">крыло заднее</div>
            </div>
        </div>

        <div class="photo-label-2 right_back_wing_photo">
            <div class="label">
                <div class="ball"><?= $report->right_back_wing ?></div>
                <div class="text">крыло заднее</div>
            </div>
        </div>

        <div class="photo-label-2 left_back_lamp_photo">
            <div class="label">
                <div class="ball"><?= $report->left_back_lamp ?></div>
                <div class="text">фонарь</div>
            </div>
            <img class="photo" src="<?= $report->left_back_lamp_photo ?>" alt="">
        </div>

        <div class="photo-label-2 right_back_lamp_photo">
            <div class="label">
                <div class="ball"><?= $report->right_back_lamp ?></div>
                <div class="text">фонарь</div>
            </div>
            <img class="photo" src="<?= $report->right_back_lamp_photo ?>" alt="">
        </div>


        <div class="photo-label-2 rear_glass_photo">
            <div class="label">
                <div class="ball"><?= $report->rear_glass ?></div>
                <div class="text">стекло заднее</div>
            </div>
            <img class="photo" src="<?= $report->rear_glass_photo ?>" alt="">
        </div>

        <div class="photo-label-2 trunk_lid_photo">
            <div class="label">
                <div class="ball"><?= $report->trunk_lid ?></div>
                <div class="text">крышка багажника</div>
            </div>
            <img class="photo" src="<?= $report->trunk_lid_photo ?>" alt="">
        </div>

        <div class="photo-label-2 rear_bumper_photo">
            <div class="label">
                <div class="ball"><?= $report->rear_bumper ?></div>
                <div class="text">бампер задний</div>
            </div>
            <img class="photo" src="<?= $report->rear_bumper_photo ?>" alt="">
        </div>


        <img src="<?= __DIR__ ?>/img/test/body_background.jpg" alt="" class="body-background">
    </div>

    <div class="disclimer">
        <strong>Disclaimer:</strong><span> Точность и достоверность информации AUTOTESMER зависит от различных источников, из которых она получается, поэтому AUTOTESMER или его представители не берут никакой ответственности за ошибки или пробелы в этом отчете, кроме того AUTOTESMER отказывается от всех гарантий, явных или подразумеваемых, включая любые подразумеваемые гарантии пригодности ТС для определенной цели</span>
    </div>

    <div class="banner">баннер</div>

    <div class="caption" style="margin-top: 30px;">Подкапотное пространство</div>

    <div class="underhood">


        <div class="photo-label paintwork_condition_photo">
            <img class="photo" src="<?= $report->paintwork_condition_photo ?>" alt="">
            <div class="text">Состояние ЛКП</div>
            <div class="ball"><?= $report->paintwork_condition ?></div>
        </div>

        <div class="photo-label engine_photo">
            <img class="photo" src="<?= $report->engine_photo ?>" alt="">
            <div class="text">Двигатель</div>
            <div class="ball"><?= $report->engine ?></div>
        </div>

        <div class="photo-label down plastic_parts_photo">
            <img class="photo" src="<?= $report->plastic_parts_photo ?>" alt="">
            <div class="text">Пластиковые детали</div>
            <div class="ball"><?= $report->plastic_parts ?></div>
        </div>

        <div class="photo-label down attachment_equipment_photo">
            <img class="photo" src="<?= $report->attachment_equipment_photo ?>" alt="">
            <div class="text">Навесное оборудование</div>
            <div class="ball"><?= $report->attachment_equipment ?></div>
        </div>


        <img src="<?= __DIR__ ?>/img/test/underhood_background.jpg" alt="" class="underhood-background">


    </div>

    <div class="caption" style="margin-top: 30px;">Салон</div>

    <div class="salon">


        <div class="photo-label strings2 steering_wheel_and_paddle_switches_photo">
            <img class="photo" src="<?= $report->steering_wheel_and_paddle_switches_photo ?>" alt="">
            <div class="text"><span>руль</span><span>переключатели</span></div>
            <div class="ball"><?= $report->steering_wheel_and_paddle_switches ?></div>
        </div>

        <div class="photo-label strings2 ceiling_photo">
            <img class="photo" src="<?= $report->ceiling_photo ?>" alt="">
            <div class="text"><span>потолок</span><span>переключатели</span></div>
            <div class="ball"><?= $report->ceiling ?></div>
        </div>

        <div class="photo-label strings2 diagnostic_errors_photo">
            <img class="photo" src="<?= $report->diagnostic_errors_photo ?>" alt="">
            <div class="text"><span>ошибки</span><span>при диагностике</span></div>
            <div class="ball"><?= $report->diagnostic_errors ?></div>
        </div>



        <div class="photo-label down strings2 rear_seat_photo">
            <img class="photo" src="<?= $report->rear_seat_photo ?>" alt="">
            <div class="text"><span>сиденья</span><span>задние</span></div>
            <div class="ball"><?= $report->rear_seat ?></div>
        </div>

        <div class="photo-label down strings2 floor_photo">
            <img class="photo" src="<?= $report->floor_photo ?>" alt="">
            <div class="text"><span>пол</span><span>педали, коврики</span></div>
            <div class="ball"><?= $report->floor ?></div>
        </div>

        <div class="photo-label down front_passenger_seat_photo">
            <img class="photo" src="<?= $report->front_passenger_seat_photo ?>" alt="">
            <div class="text">сиденья передние</span></div>
            <div class="ball"><?= $report->front_passenger_seat ?></div>
        </div>

        <div class="photo-label down strings2 recorder_photo">
            <img class="photo" src="<?= $report->recorder_photo ?>" alt="">
            <div class="text"><span>магнитола</span><span>климатическая установка</span></span></div>
            <div class="ball"><?= $report->recorder ?></div>
        </div>

        <div class="photo-label strings2 dashboard_photo">
            <img class="photo" src="<?= $report->dashboard_photo ?>" alt="">
            <div class="text"><span>панель приборов</span><span>переключатели</span></span></div>
            <div class="ball"><?= $report->dashboard ?></div>
        </div>

        <img src="<?= __DIR__ ?>/img/test/salon_background.jpg" alt="" class="salon-background">

    </div>

    <div class="disclimer">
        <strong>Disclaimer:</strong><span> Точность и достоверность информации AUTOTESMER зависит от различных источников, из которых она получается, поэтому AUTOTESMER или его представители не берут никакой ответственности за ошибки или пробелы в этом отчете, кроме того AUTOTESMER отказывается от всех гарантий, явных или подразумеваемых, включая любые подразумеваемые гарантии пригодности ТС для определенной цели</span>
    </div>

    <div class="banner">баннер</div>

    <div class="caption" style="margin-top: 30px;">Багажник</div>

    <div class="trunk-block">

        <div class="photo-label down strings2 trunk_upholstery_photo">
            <img class="photo" src="<?= $report->trunk_upholstery_photo ?>" alt="">
            <div class="text"><span>пол, обивка</span><span>освещение</span></div>
            <div class="ball"><?= $report->trunk_upholstery ?></div>
        </div>

        <div class="photo-label down strings2 hitch_photo">
            <img class="photo" src="<?= $report->hitch_photo ?>" alt="">
            <div class="text"><span>инструменты</span><span>домкрат, фаркоп</span></div>
            <div class="ball"><?= $report->hitch ?></div>
        </div>

        <div class="photo-label down spare_wheel_photo">
            <img class="photo" src="<?= $report->spare_wheel_photo ?>" alt="">
            <div class="text">запасное колесо</div>
            <div class="ball"><?= $report->spare_wheel ?></div>
        </div>

        <img src="<?= __DIR__ ?>/img/test/trunk_background.jpg" alt="" class="trunk-block-background">
    </div>

    <div class="caption" style="margin-top: 30px;">Осмотр на подъемнике</div>


    <div class="inspection">


        <div class="photo-label strings4 paintwork_condition_photo2">
            <img class="photo" src="<?= $report->paintwork_condition_photo ?>" alt="">
            <div class="text">
                <span>Состояние</span>
                <span>антикоррозийного</span>
                <span>антигравийного</span>
                <span>покрытия</span>
            </div>
            <div class="ball"><?= $report->paintwork_condition ?></div>
        </div>


        <div class="photo-label wiring_photo">
            <img class="photo" src="<?= $report->wiring_photo ?>" alt="">
            <div class="text">шланги, проводка</div>
            <div class="ball"><?= $report->wiring ?></div>
        </div>


        <div class="photo-label down front_suspension_photo">
            <img class="photo" src="<?= $report->front_suspension_photo ?>" alt="">
            <div class="text">передняя подвеска</div>
            <div class="ball"><?= $report->front_suspension ?></div>
        </div>

        <div class="photo-label down exhaust_system_photo">
            <img class="photo" src="<?= $report->exhaust_system_photo ?>" alt="">
            <div class="text">система выхлопа</div>
            <div class="ball"><?= $report->exhaust_system ?></div>
        </div>

        <div class="photo-label down rear_suspension_photo">
            <img class="photo" src="<?= $report->rear_suspension_photo ?>" alt="">
            <div class="text">задняя подвеска</div>
            <div class="ball"><?= $report->rear_suspension ?></div>
        </div>



        <img src="<?= __DIR__ ?>/img/test/inspection_background.jpg" alt="" class="inspection-background">


    </div>

    <div class="disclimer">
        <strong>Disclaimer:</strong><span> Точность и достоверность информации AUTOTESMER зависит от различных источников, из которых она получается, поэтому AUTOTESMER или его представители не берут никакой ответственности за ошибки или пробелы в этом отчете, кроме того AUTOTESMER отказывается от всех гарантий, явных или подразумеваемых, включая любые подразумеваемые гарантии пригодности ТС для определенной цели</span>
    </div>

    <div class="banner">баннер</div>

    <div class="caption" style="margin-top: 30px;">Затраты после покупки</div>



    <div class="cost-after-buy">

        <div class="line">
            <div class="square"></div>
            <div class="label"><span>Кузов</span></div>
            <div class="cost"><span><?= $report->post_purchase_costs_body  ?></span></div>
        </div>
        <div class="line">
            <div class="square"></div>
            <div class="label"><span>Стекла</span></div>
            <div class="cost"><span><?= $report->post_purchase_costs_glasses  ?></span></div>
        </div>

        <div class="line">
            <div class="square"></div>
            <div class="label"><span>Двигатель</span></div>
            <div class="cost"><span><?= $report->post_purchase_costs_engine  ?></span></div>
        </div>

        <div class="line">
            <div class="square"></div>
            <div class="label"><span>Трансмиссия</span></div>
            <div class="cost"><span><?= $report->post_purchase_costs_transmission  ?></span></div>
        </div>

        <div class="line">
            <div class="square"></div>
            <div class="label"><span>Салон</span></div>
            <div class="cost"><span><?= $report->post_purchase_costs_salon  ?></span></div>
        </div>

        <div class="line">
            <div class="square"></div>
            <div class="label"><span>Подвеска</span></div>
            <div class="cost"><span><?= $report->post_purchase_costs_suspension  ?></span></div>
        </div>

        <div class="line">
            <div class="square"></div>
            <div class="label"><span>Ходовая часть</span></div>
            <div class="cost"><span><?= $report->post_purchase_costs_chassis  ?></span></div>
        </div>

        <div class="line">
            <div class="square"></div>
            <div class="label"><span>Электрика</span></div>
            <div class="cost"><span><?= $report->post_purchase_costs_electrician  ?></span></div>
        </div>

        <div class="line">
            <div class="square"></div>
            <div class="label"><span>Второй комплект резины</span></div>
            <div class="cost"><span><?= $report->second_set_rubber  ?></span></div>
        </div>

        <div class="line">
            <div class="square"></div>
            <div class="label"><span>Итого</span></div>
            <div class="cost"><span><?= $report->getCommonPostCosts()  ?></span></div>
        </div>

    </div>



    <div class="disclimer">
        <strong>Disclaimer:</strong><span> Точность и достоверность информации AUTOTESMER зависит от различных источников, из которых она получается, поэтому AUTOTESMER или его представители не берут никакой ответственности за ошибки или пробелы в этом отчете, кроме того AUTOTESMER отказывается от всех гарантий, явных или подразумеваемых, включая любые подразумеваемые гарантии пригодности ТС для определенной цели</span>
    </div>
</div>

</BODY>
</HTML>


