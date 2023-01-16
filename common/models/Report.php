<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 25.03.2019
 * Time: 21:49
 */

namespace common\models;

use tFPDF;
use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * Class Report
 * @package common\models
 *
 */
class Report extends Model
{
    public $order_id;
    public $chat_id;

    public $year;
    public $mark;
    public $model;
    public $vin;
    public $body;
    public $doors_number;
    public $drive;
    public $ts_age;
    public $country;
    public $owners_number;
    public $photo;
    public $traffic_accidents;
    public $to_records;
    public $personal_ts;
    public $odometer;
    public $dtp1;
    public $dtp2;
    public $left_headlight;
    public $left_headlight_comment;
    public $left_ptf;
    public $left_ptf_comment;
    public $left_front_wing;
    public $left_front_wing_comment;
    public $left_back_wing;
    public $left_back_wing_comment;
    public $left_mirror;
    public $left_mirror_comment;
    public $left_front_wheels;
    public $left_front_wheels_comment;
    public $left_back_wheels;
    public $left_back_wheels_comment;
    public $left_front_brake_disc;
    public $left_front_brake_disc_comment;
    public $left_back_brake_disc;
    public $left_back_brake_disc_comment;
    public $left_front_pads;
    public $left_front_pads_comment;
    public $left_back_pads;
    public $left_back_pads_comment;
    public $left_front_tire;
    public $left_front_tire_comment;
    public $left_back_tire;
    public $left_back_tire_comment;
    public $left_front_door;
    public $left_front_door_comment;
    public $left_threshold;
    public $left_threshold_comment;
    public $left_back_door;
    public $left_back_door_comment;
    public $left_back_lamp;
    public $left_back_lamp_comment;
    public $roof_with_racks;

    public $rigth_headlight;
    public $rigth_headlight_comment;
    public $rigth_ptf;
    public $rigth_ptf_comment;
    public $rigth_front_wing;
    public $rigth_front_wing_comment;
    public $rigth_back_wing;
    public $rigth_back_wing_comment;
    public $rigth_mirror;
    public $rigth_mirror_comment;
    public $rigth_front_wheels;
    public $rigth_front_wheels_comment;
    public $rigth_back_wheels;
    public $rigth_back_wheels_comment;
    public $rigth_front_brake_disc;
    public $rigth_front_brake_disc_comment;
    public $rigth_back_brake_disc;
    public $rigth_back_brake_disc_comment;
    public $rigth_front_pads;
    public $rigth_front_pads_comment;
    public $rigth_back_pads;
    public $rigth_back_pads_comment;
    public $rigth_front_tire;
    public $rigth_front_tire_comment;
    public $rigth_back_tire;
    public $rigth_back_tire_comment;
    public $rigth_front_door;
    public $rigth_front_door_comment;
    public $rigth_threshold;
    public $rigth_threshold_comment;
    public $rigth_back_door;
    public $rigth_back_door_comment;
    public $rigth_back_lamp;
    public $rigth_back_lamp_comment;

    public $windshield;
    public $windshield_comment;
    public $hood;
    public $hood_comment;
    public $front_bumper;
    public $front_bumper_comment;
    public $radiator_grille;
    public $radiator_grille_comment;
    public $rear_bumper;
    public $rear_bumper_comment;
    public $trunk_lid;
    public $trunk_lid_comment;
    public $rear_glass;
    public $rear_glass_comment;


    public $lpc_condition;
    public $lpc_condition_comment;
    public $engine;
    public $engine_comment;
    public $plastic_parts;
    public $plastic_parts_comment;
    public $attachment_equipment;
    public $attachment_equipment_comment;

    public $front_drivers_seat;
    public $front_drivers_seat_comment;
    public $front_passenger_seat;
    public $front_passenger_seat_comment;
    public $rear_seat;
    public $rear_seat_comment;
    public $diagnostic_errors;
    public $diagnostic_errors_comment;
    public $kpp;
    public $kpp_comment;
    public $recorder;
    public $recorder_comment;
    public $climate_control;
    public $climate_control_comment;
    public $steering_wheel_and_paddle_switches;
    public $steering_wheel_and_paddle_switches_comment;
    public $dashboard;
    public $dashboard_comment;
    public $door_cards;
    public $door_cards_comment;
    public $floor;
    public $floor_comment;
    public $pedals;
    public $pedals_comment;
    public $floor_mats;
    public $floor_mats_comment;
    public $ceiling;
    public $ceiling_comment;

    public $trunk_floor;
    public $trunk_floor_comment;
    public $upholstery;
    public $upholstery_comment;
    public $lighting;
    public $lighting_comment;
    public $spare_wheel;
    public $spare_wheel_comment;
    public $instruments;
    public $instruments_comment;
    public $jack;
    public $jack_comment;
    public $hitch;
    public $hitch_comment;

    public $anticorrosion_coating;
    public $anticorrosion_coating_comment;
    public $hoses;
    public $hoses_comment;
    public $wiring;
    public $wiring_comment;
    public $front_shock_absorbers;
    public $front_shock_absorbers_comment;
    public $rear_shock_absorbers;
    public $rear_shock_absorbers_comment;
    public $front_suspension;
    public $front_suspension_comment;
    public $rear_suspension;
    public $rear_suspension_comment;
    public $exhaust_system;
    public $exhaust_system_comment;

    public $general_currency;
    public $general_body;
    public $general_glasses;
    public $general_engine;
    public $general_transmission;
    public $general_salon;
    public $general_suspension;
    public $general_chassis;
    public $general_electrician;
    public $general_second_set_rubber;
    public $general_country_origin;




    public function toStructure()
    {
        return [
            [
                'Основная информация' => [
                    ['Год выпуска' , 'year', 's'],
                    ['Марка' , 'mark', 's'],
                    ['Модель' , 'model', 's'],
                    ['VIN' , 'vin', 's'],
                    ['Тип кузова' , 'body', 's'],
                    ['Количество дверей' , 'doors_number', 'n'],
                    ['Привод' , 'drive', 's'],
                    ['Возраст ТС' , 'ts_age', 's'],
                    ['Страна производства' , 'country', 's'],
                    ['Количество владельцев' , 'owners_number', 's'],
                    ['Фотография' , 'photo', 'image']
                ],
                'Проверка автомобиля по базам' => [
                    ['ДТП' , 'traffic_accidents', 's'],
                    ['Записи о ТО' , 'to_records', 's'],
                    ['Частное ТС' , 'personal_ts', 's'],
                    ['Показания одометра' , 'odometer', 's'],
                    ['ДТП *' , 'dtp1', 's'],
                    ['ДТП *' , 'dtp2', 's']
                ],
                "Кузов" => [
                    "Левая сторона" => [
                        ['Фара','left_headlight','b'],
                        ['ПТФ','left_ptf','b'],
                        ['Крыло пер.','left_front_wing','b'],
                        ['Крыло задн.','left_back_wing','b'],
                        ['Зеркало','left_mirror','b'],
                        ['Диск пер.','left_front_wheels','b'],
                        ['Диск задн.','left_back_wheels','b'],
                        ['Тормозной диск пер.','left_front_brake_disc','b'],
                        ['Тормозной диск задн.','left_back_brake_disc','b'],
                        ['Колодки пер.','left_front_pads','b'],
                        ['Колодки задн.','left_back_pads','b'],
                        ['Шина пер.','left_front_tire','b'],
                        ['Шина задн.','left_back_tire','b'],
                        ['Порог', 'left_threshold', 'b'],
                        ['Дверь пер.','left_front_door','b'],
                        ['Дверь задн.','left_back_door','b'],
                        ['Фонарь задн.','left_back_lamp','b'],
                        ['Крыша со стойками','roof_with_racks','b'],
                    ],
                    "Правая сторона" => [
                        ['Фара','rigth_headlight','b'],
                        ['ПТФ','rigth_ptf','b'],
                        ['Крыло пер.','rigth_front_wing','b'],
                        ['Крыло задн.','rigth_back_wing','b'],
                        ['Зеркало','rigth_mirror','b'],
                        ['Диск пер.','rigth_front_wheels','b'],
                        ['Диск задн.','rigth_back_wheels','b'],
                        ['Тормозной диск пер.','rigth_front_brake_disc','b'],
                        ['Тормозной диск задн.','rigth_back_brake_disc','b'],
                        ['Колодки пер.','rigth_front_pads','b'],
                        ['Колодки задн.','rigth_back_pads','b'],
                        ['Шина пер.','rigth_front_tire','b'],
                        ['Шина задн.','rigth_back_tire','b'],
                        ['Порог', 'rigth_threshold', 'b'],
                        ['Дверь пер.','rigth_front_door','b'],
                        ['Дверь задн.','rigth_back_door','b'],
                        ['Фонарь задн.','rigth_back_lamp','b'],
                    ],
                    "Перед" => [
                        ['Стекло лобовое','windshield','b'],
                        ['Капот','hood','b'],
                        ['Бампер передний','front_bumper','b'],
                        ['Решетка радиатора','radiator_grille','b'],
                    ],
                    "Зад" => [
                        ['Бампер задний','rear_bumper','b'],
                        ['Крышка багажника','trunk_lid','b'],
                        ['Стекло заднее','rear_glass','b']
                    ]
                ],
                'Подкапотное пространство' => [
                    ['Состояние ЛКП','paintwork_condition','b'],
                    ['Двигатель','engine','b'],
                    ['Пластиковые детали','plastic_parts','b'],
                    ['Навесное оборудование','attachment_equipment','b'],
                ],
                'Салон' => [
                    ['Сиденье пер. водительское','front_drivers_seat','b'],
                    ['Сиденье пер. пассажирское','front_passenger_seat','b'],
                    ['Сиденье задн.','rear_seat','b'],
                    ['Ошибки при диагностике','diagnostic_errors','b'],
                    ['КПП','kpp','b'],
                    ['Магнитола','recorder','b'],
                    ['Климатическая установка','climate_control','b'],
                    ['Руль + подрулевые переключатели','steering_wheel_and_paddle_switches','b'],
                    ['Панель приборов','dashboard','b'],
                    ['Карты дверей','door_cards','b'],
                    ['Пол','floor','b'],
                    ['Педали','pedals','b'],
                    ['Коврики','floor_mats','b'],
                    ['Потолок','ceiling','b'],
                ],
                'Багажник' => [
                    ['Пол', 'trunk_floor', 'b'],
                    ['Обивка', 'upholstery', 'b'],
                    ['Освещение', 'lighting', 'b'],
                    ['Запасное колесо', 'spare_wheel', 'b'],
                    ['Инструменты', 'instruments', 'b'],
                    ['Домкрат', 'jack', 'b'],
                    ['Фаркоп', 'hitch', 'b'],
                ],
                'Осмотр на подъемнике' => [
                    ['Антикоррозийное и антигравийное покрытие','anticorrosion_coating','b'],
                    ['Шланги','hoses','b'],
                    ['Проводка','wiring','b'],
                    ['Амортизаторы пер.','front_shock_absorbers','b'],
                    ['Амортизаторы зад.','rear_shock_absorbers','b'],
                    ['Передняя подвеска','front_suspension','b'],
                    ['Задняя подвеска','rear_suspension','b'],
                    ['Система выхлопа','exhaust_system','b'],
                ],
                'Затраты после покупки' => [
                    ['Валюта','general_currency','s'],
                    ['Кузов','general_body','s'],
                    ['Стекла','general_glasses','s'],
                    ['Двигатель','general_engine','s'],
                    ['Трансмиссия','general_transmission','s'],
                    ['Салон','general_salon','s'],
                    ['Подвеска','general_suspension','s'],
                    ['Ходовая часть','general_chassis','s'],
                    ['Электрика','general_electrician','s'],
                    ['Второй комплект резины','general_second_set_rubber','s'],
                    ['Страна производства','general_country_origin','s'],
                ],
            ],
        ];

    }

    public function rules()
    {

        $rules = [];
        $safe_elements = [];

        $structure = $this->toStructure();

        foreach($structure as $section => $elements){

            foreach($elements as $index => $subelement){
                if(is_numeric($index)){
                    $safe_elements[] = $subelement[1];
                    if($subelement[2] == 'b'){
                        $safe_elements[] = $subelement[1] . '_comment';
                    }
                } else {
                    foreach($subelement as $subindex => $item){
                        if(is_numeric($subindex)){
                            $safe_elements[] = $item[1];
                            if($item[2] == 'b'){
                                $safe_elements[] = $item[1] . '_comment';
                            }
                        }
                    }
                }
            }
        }

        $rules[] = [$safe_elements, 'safe' ];

        $rules[] = [['order_id', 'chat_id'], 'safe'];


        return $rules;
    }


    private function tableHeader($tpdf, $value){
        $tpdf->Cell(40,10,'Отчет', 0);
        $tpdf->ln();
    }

    private function tableSubHeader($tpdf, $value){
        $tpdf->Cell(40,10,$value, 0);
        $tpdf->ln();
    }


    private function tableLine($tpdf, $caption, $value){
        $tpdf->Cell(80,20,$caption, 1);
        $tpdf->Cell(80,20,$value, 1);
        $tpdf->ln();
    }

    private function renderField($tpdf, $field){
        $label = $field[0];
        $attribute = $field[1];
        $value = $this->$attribute;
        $type = $field[2];
        $this->tableLine($tpdf, "$label:",$value);
    }


    public function renderSection($tpdf, $section, $fields){
        $this->tableSubHeader($tpdf, $section);
        foreach($fields as $index => $field){
            if(!is_numeric($index)){
                $this->renderSection($tpdf, $index, $field);
            } else {
                $this->renderField($tpdf, $field);
            }
        }

    }

    public function save($filename){

        $dompdf = new \Dompdf\Dompdf();

        $html = \Yii::$app->view->render(
            '//report/pdf-template',
            ['report' => $this]
        );

        $dompdf->loadHtml($html);

        $pageSize = array(0, 0, 842, 9300);

        $dompdf->setPaper($pageSize);

        $dompdf->render();

        $output = $dompdf->output();

        file_put_contents($filename, $output);

        return true;
    }

}