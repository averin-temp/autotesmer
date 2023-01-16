<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 08.09.2019
 * Time: 20:04
 */

namespace common\models;

use common\classes\VehicleCategory;
use common\classes\VehicleProperties;
use yii\base\Model;
use yii\web\UploadedFile;

class ReportAuto extends Model
{

    public $chat_id;
    public $expert_id;
    public $category = VehicleCategory::AUTO;

    /* Основная информация */

    public $year;                               // Год выпуска
    public $brand;                              // Марка
    public $model;                              // Модель
    public $vin;                                // VIN
    public $body;                               // Тип кузова
    public $doors_number;                       // Количество дверей
    public $drive;                              // Привод
    public $age;                                // Возраст ТС
    public $vendor_country;                     // Страна производства
    public $owner_count;                        // Количество владельцев
    public $photo;                              // Фотография

    /* Проверка автомобиля по базам */

    public $traffic_accidents;                  // ДТП
    public $traffic_accidents_attachments;

    public $inspection_records;                 // Записи о техосмотре
    public $inspection_attachments;

    public $personal_vehicle;                   // Частное ТС
    public $personal_vehicle_attachments;

    public $odometer_readings;                  // Показания одометра'
    public $odometer_readings_attachments;

    public $traffic_accidents_info_1;           // Информация о ДТП
    public $traffic_accidents_info_1_attachments;

    public $traffic_accidents_info_2;           // Информация о ДТП
    public $traffic_accidents_info_2_attachments;

    /* Кузов.  Левая сторона */

    public $left_headlight;                     // Фара
    public $left_headlight_comment;
    public $left_headlight_photo;


    public $left_fog_lights;                    // Противотуманные огни
    public $left_fog_lights_comment;
    public $left_fog_lights_photo;

    public $left_front_wing;                    // Переднее крыло
    public $left_front_wing_comment;
    public $left_front_wing_photo;

    public $left_back_wing;                     // Крыло заднее
    public $left_back_wing_comment;
    public $left_back_wing_photo;

    public $left_mirror;                        // Зеркало
    public $left_mirror_comment;
    public $left_mirror_photo;

    public $left_front_wheels;                  // Диск передний
    public $left_front_wheels_comment;
    public $left_front_wheels_photo;

    public $left_back_wheels;                   // Диск задний
    public $left_back_wheels_comment;
    public $left_back_wheels_photo;

    public $left_front_brake_disc;              // Тормозной диск передний
    public $left_front_brake_disc_comment;
    public $left_front_brake_disc_photo;

    public $left_back_brake_disc;               // Тормозной диск задний
    public $left_back_brake_disc_comment;
    public $left_back_brake_disc_photo;

    public $left_front_pads;                    // Колодки пер.
    public $left_front_pads_comment;
    public $left_front_pads_photo;

    public $left_back_pads;                     // Колодки задн
    public $left_back_pads_comment;
    public $left_back_pads_photo;

    public $left_front_tire;                    // Шина пер
    public $left_front_tire_comment;
    public $left_front_tire_photo;

    public $left_back_tire;                     // Шина задняя
    public $left_back_tire_comment;
    public $left_back_tire_photo;

    public $left_threshold;                     // Порог
    public $left_threshold_comment;
    public $left_threshold_photo;

    public $left_front_door;                    // Дверь пер.
    public $left_front_door_comment;
    public $left_front_door_photo;

    public $left_back_door;                     // Дверь задн.
    public $left_back_door_comment;
    public $left_back_door_photo;

    public $left_back_lamp;                     // Фонарь задн
    public $left_back_lamp_comment;
    public $left_back_lamp_photo;

    public $roof_with_racks;                    // Крыша со стойками
    public $roof_with_racks_comment;
    public $roof_with_racks_photo;

    /* Кузов.  Правая сторона */

    public $right_headlight;                    // Фара
    public $right_headlight_comment;
    public $right_headlight_photo;

    public $right_fog_lights;                   // Противотуманные огни
    public $right_fog_lights_comment;
    public $right_fog_lights_photo;

    public $right_front_wing;                   // Крыло переднее
    public $right_front_wing_comment;
    public $right_front_wing_photo;

    public $right_back_wing;                    // Крыло заднее
    public $right_back_wing_comment;
    public $right_back_wing_photo;

    public $right_mirror;                       // Зеркало
    public $right_mirror_comment;
    public $right_mirror_photo;

    public $right_front_wheels;                 // Диск передний
    public $right_front_wheels_comment;
    public $right_front_wheels_photo;

    public $right_back_wheels;                  // Диск задний
    public $right_back_wheels_comment;
    public $right_back_wheels_photo;

    public $right_front_brake_disc;             // Тормозной диск передний
    public $right_front_brake_disc_comment;
    public $right_front_brake_disc_photo;

    public $right_back_brake_disc;              // Тормозной диск задний
    public $right_back_brake_disc_comment;
    public $right_back_brake_disc_photo;

    public $right_front_pads;                   // Колодки передняя
    public $right_front_pads_comment;
    public $right_front_pads_photo;

    public $right_back_pads;                    // Колодки задние
    public $right_back_pads_comment;
    public $right_back_pads_photo;

    public $right_front_tire;                   // Шина передняя
    public $right_front_tire_comment;
    public $right_front_tire_photo;

    public $right_back_tire;                    // Шина задняя
    public $right_back_tire_comment;
    public $right_back_tire_photo;

    public $right_threshold;                    // Порог
    public $right_threshold_comment;
    public $right_threshold_photo;

    public $right_front_door;                   // Дверь передняя
    public $right_front_door_comment;
    public $right_front_door_photo;

    public $right_back_door;                    // Дверь задняя
    public $right_back_door_comment;
    public $right_back_door_photo;

    public $right_back_lamp;                    // Фонарь задний
    public $right_back_lamp_comment;
    public $right_back_lamp_photo;

    /* Кузов.  Перед */

    public $windshield;                         //Стекло лобовое
    public $windshield_comment;
    public $windshield_photo;

    public $hood;                               //Капот
    public $hood_comment;
    public $hood_photo;

    public $front_bumper;                       //Бампер передний
    public $front_bumper_comment;
    public $front_bumper_photo;

    public $radiator_grille;                    //Решетка радиатора
    public $radiator_grille_comment;
    public $radiator_grille_photo;

    /* Кузов.  Зад */

    public $rear_bumper;                        // Бампер задний
    public $rear_bumper_comment;
    public $rear_bumper_photo;

    public $trunk_lid;                          // Крышка багажника
    public $trunk_lid_comment;
    public $trunk_lid_photo;

    public $rear_glass;                         // Стекло заднее
    public $rear_glass_comment;
    public $rear_glass_photo;

    /* Подкапотное пространство */

    public $paintwork_condition;                // Состояние ЛКП
    public $paintwork_condition_comment;                // Состояние ЛКП
    public $paintwork_condition_photo;                // Состояние ЛКП
    public $engine;                             // Двигатель
    public $engine_comment;                             // Двигатель
    public $engine_photo;                             // Двигатель
    public $plastic_parts;                      // Пластиковые детали
    public $plastic_parts_comment;                      // Пластиковые детали
    public $plastic_parts_photo;                      // Пластиковые детали
    public $attachment_equipment;               // Навесное оборудование
    public $attachment_equipment_comment;               // Навесное оборудование
    public $attachment_equipment_photo;               // Навесное оборудование

    /* Салон */

    public $front_drivers_seat;                 // Сиденье переднее водительское
    public $front_drivers_seat_comment;                 // Сиденье переднее водительское
    public $front_drivers_seat_photo;                 // Сиденье переднее водительское
    public $front_passenger_seat;               // Сиденье переднее пассажирское
    public $front_passenger_seat_comment;               // Сиденье переднее пассажирское
    public $front_passenger_seat_photo;               // Сиденье переднее пассажирское
    public $rear_seat;                          // Сиденье заднее
    public $rear_seat_comment;                          // Сиденье заднее
    public $rear_seat_photo;                          // Сиденье заднее
    public $diagnostic_errors;                  // Ошибки при диагностике
    public $diagnostic_errors_comment;                  // Ошибки при диагностике
    public $diagnostic_errors_photo;                  // Ошибки при диагностике
    public $recorder;                           // Магнитола
    public $recorder_comment;                           // Магнитола
    public $recorder_photo;                           // Магнитола
    public $kpp;                                // КПП
    public $kpp_comment;                                // КПП
    public $kpp_photo;                                // КПП
    public $climate_control;                    // Климатическая установка
    public $climate_control_comment;                    // Климатическая установка
    public $climate_control_photo;                    // Климатическая установка
    public $steering_wheel_and_paddle_switches; // Руль + подрулевые переключатели
    public $steering_wheel_and_paddle_switches_comment; // Руль + подрулевые переключатели
    public $steering_wheel_and_paddle_switches_photo; // Руль + подрулевые переключатели
    public $dashboard;                          // Панель приборов
    public $dashboard_comment;                          // Панель приборов
    public $dashboard_photo;                          // Панель приборов
    public $door_trim;                          // Карты дверей
    public $door_trim_comment;                          // Карты дверей
    public $door_trim_photo;                          // Карты дверей
    public $floor;                              // Пол
    public $floor_comment;                              // Пол
    public $floor_photo;                              // Пол
    public $pedals;                             // Педали
    public $pedals_comment;                             // Педали
    public $pedals_photo;                             // Педали
    public $floor_mats;                         // Коврики
    public $floor_mats_comment;                         // Коврики
    public $floor_mats_photo;                         // Коврики
    public $ceiling;                            // Потолок
    public $ceiling_comment;                            // Потолок
    public $ceiling_photo;                            // Потолок

    /* Багажник */

    public $trunk_floor;                        // Пол
    public $trunk_floor_comment;                        // Пол
    public $trunk_floor_photo;                        // Пол
    public $trunk_upholstery;                   // Обивка
    public $trunk_upholstery_comment;                   // Обивка
    public $trunk_upholstery_photo;                   // Обивка
    public $trunk_lighting;                     // Освещение
    public $trunk_lighting_comment;                     // Освещение
    public $trunk_lighting_photo;                     // Освещение
    public $spare_wheel;                        // Запасное колесо
    public $spare_wheel_comment;                        // Запасное колесо
    public $spare_wheel_photo;                        // Запасное колесо
    public $instruments;                        // Инструменты
    public $instruments_comment;                        // Инструменты
    public $instruments_photo;                        // Инструменты
    public $jack;                               // Домкрат
    public $jack_comment;                               // Домкрат
    public $jack_photo;                               // Домкрат
    public $hitch;                              // Фаркоп
    public $hitch_comment;                              // Фаркоп
    public $hitch_photo;                              // Фаркоп

    /* Осмотр на подъемнике */

    public $anticorrosion_coating;              // Антикоррозийное и антигравийное покрытие
    public $anticorrosion_coating_comment;              // Антикоррозийное и антигравийное покрытие
    public $anticorrosion_coating_photo;              // Антикоррозийное и антигравийное покрытие
    public $hoses;                              // Шланги
    public $hoses_comment;                              // Шланги
    public $hoses_photo;                              // Шланги
    public $wiring;                             // Проводка
    public $wiring_comment;                             // Проводка
    public $wiring_photo;                             // Проводка
    public $front_shock_absorbers;              // Амортизаторы пер
    public $front_shock_absorbers_comment;              // Амортизаторы пер
    public $front_shock_absorbers_photo;              // Амортизаторы пер
    public $rear_shock_absorbers;               // Амортизаторы зад
    public $rear_shock_absorbers_comment;               // Амортизаторы зад
    public $rear_shock_absorbers_photo;               // Амортизаторы зад
    public $front_suspension;                   // Передняя подвеска
    public $front_suspension_comment;                   // Передняя подвеска
    public $front_suspension_photo;                   // Передняя подвеска
    public $rear_suspension;                    // Задняя подвеска
    public $rear_suspension_comment;                    // Задняя подвеска
    public $rear_suspension_photo;                    // Задняя подвеска
    public $exhaust_system;                     // Система выхлопа
    public $exhaust_system_comment;                     // Система выхлопа
    public $exhaust_system_photo;                     // Система выхлопа

    /* Затраты после покупки */

    public $currency;                           // Валюта
    public $post_purchase_costs_body;           // Кузов
    public $post_purchase_costs_glasses;        // Стекла
    public $post_purchase_costs_engine;         // Двигатель
    public $post_purchase_costs_transmission;   // Трансмиссия
    public $post_purchase_costs_salon;          // Салон
    public $post_purchase_costs_suspension;     // Подвеска
    public $post_purchase_costs_chassis;        // Ходовая часть
    public $post_purchase_costs_electrician;    // Электрика
    public $second_set_rubber;                  // Второй комплект резины
    public $country_origin;                     // Страна производства

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [
                [
                    'chat_id',
                    'category',
                    'year',
                    'brand',
                    'model',
                    'vin',
                    'body',
                    'doors_number',
                    'drive',
                    'age',
                    'vendor_country',
                    'owner_count',
                    'inspection_records',
                    'personal_vehicle',
                    'odometer_readings',
                    'left_headlight',                     // Фара
                    'left_fog_lights',                    // Противотуманные огни
                    'left_front_wing',                    // Переднее крыло
                    'left_back_wing',                     // Крыло заднее
                    'left_mirror',                        // Зеркало
                    'left_front_wheels',                  // Диск передний
                    'left_back_wheels',                   // Диск задний
                    'left_front_brake_disc',              // Тормозной диск передний
                    'left_back_brake_disc',               // Тормозной диск задний
                    'left_front_pads',                    // Колодки пер.
                    'left_back_pads',                     // Колодки задн
                    'left_front_tire',                    // Шина пер
                    'left_back_tire',                     // Шина задняя
                    'left_threshold',                     // Порог
                    'left_front_door',                    // Дверь пер.
                    'left_back_door',                     // Дверь задн.
                    'left_back_lamp',                     // Фонарь задн
                    'roof_with_racks',                    // Крыша со стойками
                    'right_headlight',                    // Фара
                    'right_fog_lights',                   // Противотуманные огни
                    'right_front_wing',                   // Крыло переднее
                    'right_back_wing',                    // Крыло заднее
                    'right_mirror',                       // Зеркало
                    'right_front_wheels',                 // Диск передний
                    'right_back_wheels',                  // Диск задний
                    'right_front_brake_disc',             // Тормозной диск передний
                    'right_back_brake_disc',              // Тормозной диск задний
                    'right_front_pads',                   // Колодки передняя
                    'right_back_pads',                    // Колодки задние
                    'right_front_tire',                   // Шина передняя
                    'right_back_tire',                    // Шина задняя
                    'right_threshold',                    // Порог
                    'right_front_door',                   // Дверь перяя
                    'right_back_door',                    // Дверь задняя
                    'right_back_lamp',                    // Фонарь задний
                    'windshield',                         //Стекло лобовое
                    'hood',                               //Капот
                    'front_bumper',                       //Бампер передний
                    'radiator_grille',                    //Решетка радиатора
                    'rear_bumper',                        // Бампер задний
                    'trunk_lid',                          // Крышка багажника
                    'rear_glass',                         // Стекло заднее
                    'paintwork_condition',                // Состояние ЛКП
                    'engine',                             // Двигатель
                    'plastic_parts',                      // Пластиковые детали
                    'attachment_equipment',               // Навесное оборудование
                    'front_drivers_seat',                 // Сиденье переднее водительское
                    'front_passenger_seat',               // Сиденье переднее пассажирское
                    'rear_seat',                          // Сиденье заднее
                    'diagnostic_errors',                  // Ошибки при диагностике
                    'recorder',                           // Магнитола
                    'kpp',                                // КПП
                    'climate_control',                    // Климатическая установка
                    'steering_wheel_and_paddle_switches', // Руль + подрулевые переключатели
                    'dashboard',                          // Панель приборов
                    'door_trim',                          // Карты дверей
                    'floor',                              // Пол
                    'pedals',                             // Педали
                    'floor_mats',                         // Коврики
                    'ceiling',                            // Потолок
                    'trunk_floor',                        // Пол
                    'trunk_upholstery',                   // Обивка
                    'trunk_lighting',                     // Освещение
                    'spare_wheel',                        // Запасное колесо
                    'instruments',                        // Инструменты
                    'jack',                               // Домкрат
                    'hitch',                              // Фаркоп
                    'anticorrosion_coating',              // Антикоррозийное и антигравийное покрытие
                    'hoses',                              // Шланги
                    'wiring',                             // Проводка
                    'front_shock_absorbers',              // Амортизаторы пер
                    'rear_shock_absorbers',               // Амортизаторы зад
                    'front_suspension',                   // Передняя подвеска
                    'rear_suspension',                    // Задняя подвеска
                    'exhaust_system',                     // Система выхлопа
                    'currency',                           // Валюта
                    'post_purchase_costs_body',           // Кузов
                    'post_purchase_costs_glasses',        // Стекла
                    'post_purchase_costs_engine',         // Двигатель
                    'post_purchase_costs_transmission',   // Трансмиссия
                    'post_purchase_costs_salon',          // Салон
                    'post_purchase_costs_suspension',     // Подвеска
                    'post_purchase_costs_chassis',        // Ходовая часть
                    'post_purchase_costs_electrician',    // Электрика
                    'second_set_rubber',                  // Второй комплект резины
                    'country_origin',                     // Страна производства
                ], 'required'
            ],
            [
                [
                'left_headlight',                     // Фара
                'left_fog_lights',                    // Противотуманные огни
                'left_front_wing',                    // Переднее крыло
                'left_back_wing',                     // Крыло заднее
                'left_mirror',                        // Зеркало
                'left_front_wheels',                  // Диск передний
                'left_back_wheels',                   // Диск задний
                'left_front_brake_disc',              // Тормозной диск передний
                'left_back_brake_disc',               // Тормозной диск задний
                'left_front_pads',                    // Колодки пер.
                'left_back_pads',                     // Колодки задн
                'left_front_tire',                    // Шина пер
                'left_back_tire',                     // Шина задняя
                'left_threshold',                     // Порог
                'left_front_door',                    // Дверь пер.
                'left_back_door',                     // Дверь задн.
                'left_back_lamp',                     // Фонарь задн
                'roof_with_racks',                    // Крыша со стойками
                'right_headlight',                    // Фара
                'right_fog_lights',                   // Противотуманные огни
                'right_front_wing',                   // Крыло переднее
                'right_back_wing',                    // Крыло заднее
                'right_mirror',                       // Зеркало
                'right_front_wheels',                 // Диск передний
                'right_back_wheels',                  // Диск задний
                'right_front_brake_disc',             // Тормозной диск передний
                'right_back_brake_disc',              // Тормозной диск задний
                'right_front_pads',                   // Колодки передняя
                'right_back_pads',                    // Колодки задние
                'right_front_tire',                   // Шина передняя
                'right_back_tire',                    // Шина задняя
                'right_threshold',                    // Порог
                'right_front_door',                   // Дверь перяя
                'right_back_door',                    // Дверь задняя
                'right_back_lamp',                    // Фонарь задний
                'windshield',                         //Стекло лобовое
                'hood',                               //Капот
                'front_bumper',                       //Бампер передний
                'radiator_grille',                    //Решетка радиатора
                'rear_bumper',                        // Бампер задний
                'trunk_lid',                          // Крышка багажника
                'rear_glass',                         // Стекло заднее
                'paintwork_condition',                // Состояние ЛКП
                'engine',                             // Двигатель
                'plastic_parts',                      // Пластиковые детали
                'attachment_equipment',               // Навесное оборудование
                'front_drivers_seat',                 // Сиденье переднее водительское
                'front_passenger_seat',               // Сиденье переднее пассажирское
                'rear_seat',                          // Сиденье заднее
                'diagnostic_errors',                  // Ошибки при диагностике
                'recorder',                           // Магнитола
                'kpp',                                // КПП
                'climate_control',                    // Климатическая установка
                'steering_wheel_and_paddle_switches', // Руль + подрулевые переключатели
                'dashboard',                          // Панель приборов
                'door_trim',                          // Карты дверей
                'floor',                              // Пол
                'pedals',                             // Педали
                'floor_mats',                         // Коврики
                'ceiling',                            // Потолок
                'trunk_floor',                        // Пол
                'trunk_upholstery',                   // Обивка
                'trunk_lighting',                     // Освещение
                'spare_wheel',                        // Запасное колесо
                'instruments',                        // Инструменты
                'jack',                               // Домкрат
                'hitch',                              // Фаркоп
                'anticorrosion_coating',              // Антикоррозийное и антигравийное покрытие
                'hoses',                              // Шланги
                'wiring',                             // Проводка
                'front_shock_absorbers',              // Амортизаторы пер
                'rear_shock_absorbers',               // Амортизаторы зад
                'front_suspension',                   // Передняя подвеска
                'rear_suspension',                    // Задняя подвеска
                'exhaust_system',                     // Система выхлопа

            ], 'number', 'max' => 5, 'min' => 0],  // баллы

            [
                [
                    'post_purchase_costs_body',           // Кузов
                    'post_purchase_costs_glasses',        // Стекла
                    'post_purchase_costs_engine',         // Двигатель
                    'post_purchase_costs_transmission',   // Трансмиссия
                    'post_purchase_costs_salon',          // Салон
                    'post_purchase_costs_suspension',     // Подвеска
                    'post_purchase_costs_chassis',        // Ходовая часть
                    'post_purchase_costs_electrician',    // Электрика
                    'second_set_rubber',                  // Второй комплект резины
                ],
                'number'
            ],

            [
                [

                    'traffic_accidents',                  // ДТП
                    'inspection_records',                 // Записи о техосмотре
                    'personal_vehicle',                   // Частное ТС
                    'odometer_readings',                  // Показания одометра'
                    'traffic_accidents_info_1',           // Информация о ДТП
                    'traffic_accidents_info_2',           // Информация о ДТП
                    'left_headlight_comment',
                    'left_fog_lights_comment',
                    'left_front_wing_comment',
                    'left_back_wing_comment',
                    'left_mirror_comment',
                    'left_front_wheels_comment',
                    'left_back_wheels_comment',
                    'left_front_brake_disc_comment',
                    'left_back_brake_disc_comment',
                    'left_front_pads_comment',
                    'left_back_pads_comment',
                    'left_front_tire_comment',
                    'left_back_tire_comment',
                    'left_threshold_comment',
                    'left_front_door_comment',
                    'left_back_door_comment',
                    'left_back_lamp_comment',
                    'roof_with_racks_comment',
                    'right_headlight_comment',
                    'right_fog_lights_comment',
                    'right_front_wing_comment',
                    'right_back_wing_comment',
                    'right_mirror_comment',
                    'right_front_wheels_comment',
                    'right_back_wheels_comment',
                    'right_front_brake_disc_comment',
                    'right_back_brake_disc_comment',
                    'right_front_pads_comment',
                    'right_back_pads_comment',
                    'right_front_tire_comment',
                    'right_back_tire_comment',
                    'right_threshold_comment',
                    'right_front_door_comment',
                    'right_back_door_comment',
                    'right_back_lamp_comment',
                    'windshield_comment',
                    'hood_comment',
                    'front_bumper_comment',
                    'radiator_grille_comment',
                    'rear_bumper_comment',
                    'trunk_lid_comment',
                    'rear_glass_comment',
                    'paintwork_condition_comment',                // Состояние ЛКП
                    'engine_comment',                             // Двигатель
                    'plastic_parts_comment',                      // Пластиковые детали
                    'attachment_equipment_comment',               // Навесное оборудование
                    'front_drivers_seat_comment',                 // Сиденье переднее водительское
                    'front_passenger_seat_comment',               // Сиденье переднее пассажирское
                    'rear_seat_comment',                          // Сиденье заднее
                    'diagnostic_errors_comment',                  // Ошибки при диагностике
                    'recorder_comment',                           // Магнитола
                    'kpp_comment',                                // КПП
                    'climate_control_comment',                    // Климатическая установка
                    'steering_wheel_and_paddle_switches_comment', // Руль + подрулевые переключатели
                    'dashboard_comment',                          // Панель приборов
                    'door_trim_comment',                          // Карты дверей
                    'floor_comment',                              // Пол
                    'pedals_comment',                             // Педали
                    'floor_mats_comment',                         // Коврики
                    'ceiling_comment',                            // Потолок
                    'trunk_floor_comment',                        // Пол
                    'trunk_upholstery_comment',                   // Обивка
                    'trunk_lighting_comment',                     // Освещение
                    'spare_wheel_comment',                        // Запасное колесо
                    'instruments_comment',                        // Инструменты
                    'jack_comment',                               // Домкрат
                    'hitch_comment',                              // Фаркоп
                    'anticorrosion_coating_comment',              // Антикоррозийное и антигравийное покрытие
                    'hoses_comment',                              // Шланги
                    'wiring_comment',                             // Проводка
                    'front_shock_absorbers_comment',              // Амортизаторы пер
                    'rear_shock_absorbers_comment',               // Амортизаторы зад
                    'front_suspension_comment',                   // Передняя подвеска
                    'rear_suspension_comment',                    // Задняя подвеска
                    'exhaust_system_comment',                     // Система выхлопа
                ],'string'
            ],

            [
                ['model'],
                function($attribute){
                    if(!VehicleModel::findOne($this->$attribute)){
                        $this->addError($attribute, 'неизвестная модель');
                    }
                }
            ],

            [
                ['brand'],
                function($attribute){
                    if(!VehicleBrand::findOne($this->$attribute)){
                        $this->addError($attribute, 'неизвестная марка');
                    }
                }
            ],

            [
                [
                    'photo',
                    'left_headlight_photo',
                    'left_fog_lights_photo',
                    'left_front_wing_photo',
                    'left_back_wing_photo',
                    'left_mirror_photo',
                    'left_front_wheels_photo',
                    'left_back_wheels_photo',
                    'left_front_brake_disc_photo',
                    'left_back_brake_disc_photo',
                    'left_front_pads_photo',
                    'left_back_pads_photo',
                    'left_front_tire_photo',
                    'left_back_tire_photo',
                    'left_threshold_photo',
                    'left_front_door_photo',
                    'left_back_door_photo',
                    'left_back_lamp_photo',
                    'roof_with_racks_photo',
                    'right_headlight_photo',
                    'right_fog_lights_photo',
                    'right_front_wing_photo',
                    'right_back_wing_photo',
                    'right_mirror_photo',
                    'right_front_wheels_photo',
                    'right_back_wheels_photo',
                    'right_front_brake_disc_photo',
                    'right_back_brake_disc_photo',
                    'right_front_pads_photo',
                    'right_back_pads_photo',
                    'right_front_tire_photo',
                    'right_back_tire_photo',
                    'right_threshold_photo',
                    'right_front_door_photo',
                    'right_back_door_photo',
                    'right_back_lamp_photo',
                    'windshield_photo',
                    'hood_photo',
                    'front_bumper_photo',
                    'radiator_grille_photo',
                    'rear_bumper_photo',
                    'trunk_lid_photo',
                    'rear_glass_photo',
                    'paintwork_condition_photo',                // Состояние ЛКП
                    'engine_photo',                             // Двигатель
                    'plastic_parts_photo',                      // Пластиковые детали
                    'attachment_equipment_photo',
                    'front_drivers_seat_photo',                 // Сиденье переднее водительское
                    'front_passenger_seat_photo',               // Сиденье переднее пассажирское
                    'rear_seat_photo',                          // Сиденье заднее
                    'diagnostic_errors_photo',                  // Ошибки при диагностике
                    'recorder_photo',                           // Магнитола
                    'kpp_photo',                                // КПП
                    'climate_control_photo',                    // Климатическая установка
                    'steering_wheel_and_paddle_switches_photo', // Руль + подрулевые переключатели
                    'dashboard_photo',                          // Панель приборов
                    'door_trim_photo',                          // Карты дверей
                    'floor_photo',                              // Пол
                    'pedals_photo',                             // Педали
                    'floor_mats_photo',                         // Коврики
                    'ceiling_photo',
                    'trunk_floor_photo',                        // Пол
                    'trunk_upholstery_photo',                   // Обивка
                    'trunk_lighting_photo',                     // Освещение
                    'spare_wheel_photo',                        // Запасное колесо
                    'instruments_photo',                        // Инструменты
                    'jack_photo',                               // Домкрат
                    'hitch_photo',
                    'anticorrosion_coating_photo',              // Антикоррозийное и антигравийное покрытие
                    'hoses_photo',                              // Шланги
                    'wiring_photo',                             // Проводка
                    'front_shock_absorbers_photo',              // Амортизаторы пер
                    'rear_shock_absorbers_photo',               // Амортизаторы зад
                    'front_suspension_photo',                   // Передняя подвеска
                    'rear_suspension_photo',                    // Задняя подвеска
                    'exhaust_system_photo',
                ],
                'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxSize' => 200000
            ],
        ];
    }

    /**
     * @return array
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios['stage_1'] = [
            'year',                               // Год выпуска
            'brand',                              // Марка
            'model',                              // Модель
            'vin',                                // VIN
            'body',                               // Тип кузова
            'doors_number',                       // Количество дверей
            'drive',                              // Привод
            'age',                                // Возраст ТС
            'vendor_country',                     // Страна производства
            'owner_count',                      // Количество владельцев
            'photo',                              // Фотография
        ];
        $scenarios['stage_2'] = [
            'traffic_accidents',                  // ДТП
            'traffic_accidents_attachments',

            'inspection_records',                 // Записи о техосмотре
            'inspection_attachments',

            'personal_vehicle',                   // Частное ТС
            'personal_vehicle_attachments',

            'odometer_readings',                  // Показания одометра'
            'odometer_readings_attachments',

            'traffic_accidents_info_1',           // Информация о ДТП
            'traffic_accidents_info_1_attachments',

            'traffic_accidents_info_2',           // Информация о ДТП
            'traffic_accidents_info_2_attachments',

        ];
        $scenarios['stage_3'] = [
            /* Кузов.  Левая сторона */

            'left_headlight',                     // Фара
            'left_headlight_comment',
            'left_headlight_photo',

            'left_fog_lights',                    // Противотуманные огни
            'left_fog_lights_comment',
            'left_fog_lights_photo',

            'left_front_wing',                    // Переднее крыло
            'left_front_wing_comment',
            'left_front_wing_photo',

            'left_back_wing',                     // Крыло заднее
            'left_back_wing_comment',
            'left_back_wing_photo',

            'left_mirror',                        // Зеркало
            'left_mirror_comment',
            'left_mirror_photo',

            'left_front_wheels',                  // Диск передний
            'left_front_wheels_comment',
            'left_front_wheels_photo',

            'left_back_wheels',                   // Диск задний
            'left_back_wheels_comment',
            'left_back_wheels_photo',

            'left_front_brake_disc',              // Тормозной диск передний
            'left_front_brake_disc_comment',
            'left_front_brake_disc_photo',

            'left_back_brake_disc',               // Тормозной диск задний
            'left_back_brake_disc_comment',
            'left_back_brake_disc_photo',

            'left_front_pads',                    // Колодки пер.
            'left_front_pads_comment',
            'left_front_pads_photo',

            'left_back_pads',                     // Колодки задн
            'left_back_pads_comment',
            'left_back_pads_photo',

            'left_front_tire',                    // Шина пер
            'left_front_tire_comment',
            'left_front_tire_photo',

            'left_back_tire',                     // Шина задняя
            'left_back_tire_comment',
            'left_back_tire_photo',

            'left_threshold',                     // Порог
            'left_threshold_comment',
            'left_threshold_photo',

            'left_front_door',                    // Дверь пер.
            'left_front_door_comment',
            'left_front_door_photo',

            'left_back_door',                     // Дверь задн.
            'left_back_door_comment',
            'left_back_door_photo',

            'left_back_lamp',                     // Фонарь задн
            'left_back_lamp_comment',
            'left_back_lamp_photo',

            'roof_with_racks',                    // Крыша со стойками
            'roof_with_racks_comment',
            'roof_with_racks_photo',

            /* Кузов.  Правая сторона */

            'right_headlight',                    // Фара
            'right_headlight_comment',
            'right_headlight_photo',

            'right_fog_lights',                   // Противотуманные огни
            'right_fog_lights_comment',
            'right_fog_lights_photo',

            'right_front_wing',                   // Крыло переднее
            'right_front_wing_comment',
            'right_front_wing_photo',

            'right_back_wing',                    // Крыло заднее
            'right_back_wing_comment',
            'right_back_wing_photo',

            'right_mirror',                       // Зеркало
            'right_mirror_comment',
            'right_mirror_photo',

            'right_front_wheels',                 // Диск передний
            'right_front_wheels_comment',
            'right_front_wheels_photo',

            'right_back_wheels',                  // Диск задний
            'right_back_wheels_comment',
            'right_back_wheels_photo',

            'right_front_brake_disc',             // Тормозной диск передний
            'right_front_brake_disc_comment',
            'right_front_brake_disc_photo',

            'right_back_brake_disc',              // Тормозной диск задний
            'right_back_brake_disc_comment',
            'right_back_brake_disc_photo',

            'right_front_pads',                   // Колодки передняя
            'right_front_pads_comment',
            'right_front_pads_photo',

            'right_back_pads',                    // Колодки задние
            'right_back_pads_comment',
            'right_back_pads_photo',

            'right_front_tire',                   // Шина передняя
            'right_front_tire_comment',
            'right_front_tire_photo',

            'right_back_tire',                    // Шина задняя
            'right_back_tire_comment',
            'right_back_tire_photo',

            'right_threshold',                    // Порог
            'right_threshold_comment',
            'right_threshold_photo',

            'right_front_door',                   // Дверь перяя
            'right_front_door_comment',
            'right_front_door_photo',

            'right_back_door',                    // Дверь задняя
            'right_back_door_comment',
            'right_back_door_photo',

            'right_back_lamp',                    // Фонарь задний
            'right_back_lamp_comment',
            'right_back_lamp_photo',

            /* Кузов.  Перед */

            'windshield',                         //Стекло лобовое
            'windshield_comment',
            'windshield_photo',

            'hood',                               //Капот
            'hood_comment',
            'hood_photo',

            'front_bumper',                       //Бампер передний
            'front_bumper_comment',
            'front_bumper_photo',

            'radiator_grille',                    //Решетка радиатора
            'radiator_grille_comment',
            'radiator_grille_photo',

            /* Кузов.  Зад */

            'rear_bumper',                        // Бампер задний
            'rear_bumper_comment',
            'rear_bumper_photo',

            'trunk_lid',                          // Крышка багажника
            'trunk_lid_comment',
            'trunk_lid_photo',

            'rear_glass',                         // Стекло заднее
            'rear_glass_comment',
            'rear_glass_photo',

        ];
        $scenarios['stage_4'] = [
            /* Подкапотное пространство */

            'paintwork_condition',                // Состояние ЛКП
            'paintwork_condition_comment',                // Состояние ЛКП
            'paintwork_condition_photo',                // Состояние ЛКП
            'engine',                             // Двигатель
            'engine_comment',                             // Двигатель
            'engine_photo',                             // Двигатель
            'plastic_parts',                      // Пластиковые детали
            'plastic_parts_comment',                      // Пластиковые детали
            'plastic_parts_photo',                      // Пластиковые детали
            'attachment_equipment',               // Навесное оборудование
            'attachment_equipment_comment',               // Навесное оборудование
            'attachment_equipment_photo',               // Навесное оборудование


        ];
        $scenarios['stage_5'] = [
            /* Салон */

            'front_drivers_seat',                 // Сиденье переднее водительское
            'front_drivers_seat_comment',                 // Сиденье переднее водительское
            'front_drivers_seat_photo',                 // Сиденье переднее водительское
            'front_passenger_seat',               // Сиденье переднее пассажирское
            'front_passenger_seat_comment',               // Сиденье переднее пассажирское
            'front_passenger_seat_photo',               // Сиденье переднее пассажирское
            'rear_seat',                          // Сиденье заднее
            'rear_seat_comment',                          // Сиденье заднее
            'rear_seat_photo',                          // Сиденье заднее
            'diagnostic_errors',                  // Ошибки при диагностике
            'diagnostic_errors_comment',                  // Ошибки при диагностике
            'diagnostic_errors_photo',                  // Ошибки при диагностике
            'recorder',                           // Магнитола
            'recorder_comment',                           // Магнитола
            'recorder_photo',                           // Магнитола
            'kpp',                                // КПП
            'kpp_comment',                                // КПП
            'kpp_photo',                                // КПП
            'climate_control',                    // Климатическая установка
            'climate_control_comment',                    // Климатическая установка
            'climate_control_photo',                    // Климатическая установка
            'steering_wheel_and_paddle_switches', // Руль + подрулевые переключатели
            'steering_wheel_and_paddle_switches_comment', // Руль + подрулевые переключатели
            'steering_wheel_and_paddle_switches_photo', // Руль + подрулевые переключатели
            'dashboard',                          // Панель приборов
            'dashboard_comment',                          // Панель приборов
            'dashboard_photo',                          // Панель приборов
            'door_trim',                          // Карты дверей
            'door_trim_comment',                          // Карты дверей
            'door_trim_photo',                          // Карты дверей
            'floor',                              // Пол
            'floor_comment',                              // Пол
            'floor_photo',                              // Пол
            'pedals',                             // Педали
            'pedals_comment',                             // Педали
            'pedals_photo',                             // Педали
            'floor_mats',                         // Коврики
            'floor_mats_comment',                         // Коврики
            'floor_mats_photo',                         // Коврики
            'ceiling',                            // Потолок
            'ceiling_comment',                            // Потолок
            'ceiling_photo',                            // Потолок
        ];
        $scenarios['stage_6'] = [
            /* Багажник */

            'trunk_floor',                        // Пол
            'trunk_floor_comment',                        // Пол
            'trunk_floor_photo',                        // Пол
            'trunk_upholstery',                   // Обивка
            'trunk_upholstery_comment',                   // Обивка
            'trunk_upholstery_photo',                   // Обивка
            'trunk_lighting',                     // Освещение
            'trunk_lighting_comment',                     // Освещение
            'trunk_lighting_photo',                     // Освещение
            'spare_wheel',                        // Запасное колесо
            'spare_wheel_comment',                        // Запасное колесо
            'spare_wheel_photo',                        // Запасное колесо
            'instruments',                        // Инструменты
            'instruments_comment',                        // Инструменты
            'instruments_photo',                        // Инструменты
            'jack',                               // Домкрат
            'jack_comment',                               // Домкрат
            'jack_photo',                               // Домкрат
            'hitch',                              // Фаркоп
            'hitch_comment',                              // Фаркоп
            'hitch_photo',                              // Фаркоп

        ];
        $scenarios['stage_7'] = [

            /* Осмотр на подъемнике */

            'anticorrosion_coating',              // Антикоррозийное и антигравийное покрытие
            'anticorrosion_coating_comment',              // Антикоррозийное и антигравийное покрытие
            'anticorrosion_coating_photo',              // Антикоррозийное и антигравийное покрытие
            'hoses',                              // Шланги
            'hoses_comment',                              // Шланги
            'hoses_photo',                              // Шланги
            'wiring',                             // Проводка
            'wiring_comment',                             // Проводка
            'wiring_photo',                             // Проводка
            'front_shock_absorbers',              // Амортизаторы пер
            'front_shock_absorbers_comment',              // Амортизаторы пер
            'front_shock_absorbers_photo',              // Амортизаторы пер
            'rear_shock_absorbers',               // Амортизаторы зад
            'rear_shock_absorbers_comment',               // Амортизаторы зад
            'rear_shock_absorbers_photo',               // Амортизаторы зад
            'front_suspension',                   // Передняя подвеска
            'front_suspension_comment',                   // Передняя подвеска
            'front_suspension_photo',                   // Передняя подвеска
            'rear_suspension',                    // Задняя подвеска
            'rear_suspension_comment',                    // Задняя подвеска
            'rear_suspension_photo',                    // Задняя подвеска
            'exhaust_system',                     // Система выхлопа
            'exhaust_system_comment',                     // Система выхлопа
            'exhaust_system_photo',                     // Система выхлопа

        ];
        $scenarios['stage_8'] = [
            /* Затраты после покупки */

            'currency',                           // Валюта
            'post_purchase_costs_body',           // Кузов
            'post_purchase_costs_glasses',        // Стекла
            'post_purchase_costs_engine',         // Двигатель
            'post_purchase_costs_transmission',   // Трансмиссия
            'post_purchase_costs_salon',          // Салон
            'post_purchase_costs_suspension',     // Подвеска
            'post_purchase_costs_chassis',        // Ходовая часть
            'post_purchase_costs_electrician',    // Электрика
            'second_set_rubber',                  // Второй комплект резины
            'country_origin',                     // Страна производства
        ];

        return $scenarios;
    }

    /**
     * @return array|mixed
     */
    public function getBodies(){
        return VehicleProperties::bodies($this->category);
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getBrands(){
        return VehicleBrand::find()->all();
    }

    /**
     * @return array
     */
    public function getDrives(){
        return VehicleProperties::drives();
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getCountries(){
        return Country::find()->all();
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getCurrencies(){
        return Currency::find()->all();
    }


    public function save(){

        $dest = \Yii::getAlias('@uploads') . "/chats/$this->chat_id/";
        if(!file_exists($dest)){
            mkdir($dest, 0777, true);
        }
        $filename = uniqid() . time() . '.pdf';
        $fullname = $dest . $filename;

        $pdf = $this->toPDF();

        file_put_contents($fullname, $pdf);

        $file = new File(['chat_id' => $this->chat_id]);
        $file->dest = $filename;
        $file->image = "rew.png";
        $file->title = "Отчет";
        $file->save(false);
    }

    public function toPDF(){
        $dompdf = new \Dompdf\Dompdf();
        $html = $this->toHTML();
        $dompdf->loadHtml($html);
        $dompdf->setPaper(array(0, 0, 842, 9300));
        $dompdf->render();
        return $dompdf->output();
    }

    public function toHTML(){
        return \Yii::$app->view->render(
            '//report/html_for_pdf/auto/template',
            ['report' => $this]
        );
    }

    public function getExpert(){
        return User::findOne($this->expert_id);
    }


    public function getModel(){
        return VehicleModel::findOne($this->model);
    }

    public function getBrand(){
        return VehicleBrand::findOne($this->brand);
    }

    public function getBody(){
        $bodies = VehicleProperties::bodies($this->category);
        return $bodies[$this->body];
    }

    public function getDrive(){
        $drives = VehicleProperties::drives($this->category);
        return $drives[$this->drive];
    }

    public function getVendorCountry(){
        return Country::findOne($this->vendor_country);
    }

    public function getCommonPostCosts(){

        return array_sum([
            $this->post_purchase_costs_body,
            $this->post_purchase_costs_glasses,
            $this->post_purchase_costs_engine,
            $this->post_purchase_costs_transmission,
            $this->post_purchase_costs_salon,
            $this->post_purchase_costs_suspension,
            $this->post_purchase_costs_chassis,
            $this->post_purchase_costs_electrician,
            $this->second_set_rubber,
        ]);
    }


    public function getCurrency(){
        return Currency::findOne($this->currency)->abbr;
    }


    public function files(){
        $files = [
            'photo',
            'left_headlight_photo',
            'left_fog_lights_photo',
            'left_front_wing_photo',
            'left_back_wing_photo',
            'left_mirror_photo',
            'left_front_wheels_photo',
            'left_back_wheels_photo',
            'left_front_brake_disc_photo',
            'left_back_brake_disc_photo',
            'left_front_pads_photo',
            'left_back_pads_photo',
            'left_front_tire_photo',
            'left_back_tire_photo',
            'left_threshold_photo',
            'left_front_door_photo',
            'left_back_door_photo',
            'left_back_lamp_photo',
            'roof_with_racks_photo',
            'right_headlight_photo',
            'right_fog_lights_photo',
            'right_front_wing_photo',
            'right_back_wing_photo',
            'right_mirror_photo',
            'right_front_wheels_photo',
            'right_back_wheels_photo',
            'right_front_brake_disc_photo',
            'right_back_brake_disc_photo',
            'right_front_pads_photo',
            'right_back_pads_photo',
            'right_front_tire_photo',
            'right_back_tire_photo',
            'right_threshold_photo',
            'right_front_door_photo',
            'right_back_door_photo',
            'right_back_lamp_photo',
            'windshield_photo',
            'hood_photo',
            'front_bumper_photo',
            'radiator_grille_photo',
            'rear_bumper_photo',
            'trunk_lid_photo',
            'rear_glass_photo',
            'paintwork_condition_photo',                // Состояние ЛКП
            'engine_photo',                             // Двигатель
            'plastic_parts_photo',                      // Пластиковые детали
            'attachment_equipment_photo',
            'front_drivers_seat_photo',                 // Сиденье переднее водительское
            'front_passenger_seat_photo',               // Сиденье переднее пассажирское
            'rear_seat_photo',                          // Сиденье заднее
            'diagnostic_errors_photo',                  // Ошибки при диагностике
            'recorder_photo',                           // Магнитола
            'kpp_photo',                                // КПП
            'climate_control_photo',                    // Климатическая установка
            'steering_wheel_and_paddle_switches_photo', // Руль + подрулевые переключатели
            'dashboard_photo',                          // Панель приборов
            'door_trim_photo',                          // Карты дверей
            'floor_photo',                              // Пол
            'pedals_photo',                             // Педали
            'floor_mats_photo',                         // Коврики
            'ceiling_photo',
            'trunk_floor_photo',                        // Пол
            'trunk_upholstery_photo',                   // Обивка
            'trunk_lighting_photo',                     // Освещение
            'spare_wheel_photo',                        // Запасное колесо
            'instruments_photo',                        // Инструменты
            'jack_photo',                               // Домкрат
            'hitch_photo',
            'anticorrosion_coating_photo',              // Антикоррозийное и антигравийное покрытие
            'hoses_photo',                              // Шланги
            'wiring_photo',                             // Проводка
            'front_shock_absorbers_photo',              // Амортизаторы пер
            'rear_shock_absorbers_photo',               // Амортизаторы зад
            'front_suspension_photo',                   // Передняя подвеска
            'rear_suspension_photo',                    // Задняя подвеска
            'exhaust_system_photo',
        ];

        return $files;
    }

    public function formName(){
        return '';
    }

    public function uploadFiles(){

        $defaultImage = \Yii::getAlias('@frontend/web/img/defaultcarphoto.jpg');
        foreach($this->files() as $attribute){
            if($this->$attribute){
                /** @var UploadedFile $file */
                $file = $this->$attribute;
                $destPath = $this->getImagePath($this->expert_id);
                if(!file_exists($destPath)){
                    mkdir($destPath, 0777, true);
                }

                while(file_exists($destName = $destPath . $this->createImageName()));

                $this->prepareImage($file->tempName, $destName);
                $this->$attribute = $destName;
            } else {
                $this->$attribute = $defaultImage;
            }
        }

    }

    public function createImageName(){
        return uniqid() . time() . '.jpg';
    }

    public function getImagePath($user_id){
        return \Yii::getAlias('@uploads') . "/report/$user_id/";
    }

    public static function getImagesSize(){
        return [
            'width' => 294,
            'height' => 196
        ];
    }


    public function prepareImage($sourcePath, $destPath ){

        $size = self::getImagesSize();

        $sourceImage = imagecreatefromjpeg($sourcePath);
        $sourceWidth = imagesx($sourceImage);
        $sourceHeight = imagesy($sourceImage);

        $k = ($sourceHeight / $sourceWidth > $size['height'] / $size['width']) ? $sourceWidth / $size['width'] : $sourceHeight / $size['height'] ;

        $clipRect = [
            'x' => 0,
            'y' => 0,
            'width' => $size['width'] * $k,
            'height' => $size['height'] * $k
        ];

        $clippedImage = imagecrop($sourceImage, $clipRect);
        $result = imagescale($clippedImage, $size['width'], $size['height'], IMG_BILINEAR_FIXED);
        imagejpeg($result, $destPath);

        imagedestroy($sourceImage);
        imagedestroy($clippedImage);
        imagedestroy($result);
    }


    public function loadFiles(){
        foreach($this->files() as $attribute){
            $this->$attribute = UploadedFile::getInstance($this, $attribute);
        }
    }


    public function rating(){


        $fields = [
            /* Кузов.  Левая сторона */

            'left_headlight',                     // Фара

            'left_fog_lights',                    // Противотуманные огни

            'left_front_wing',                    // Переднее крыло

            'left_back_wing',                     // Крыло заднее

            'left_mirror',                        // Зеркало

            'left_front_wheels',                  // Диск передний

            'left_back_wheels',                   // Диск задний

            'left_front_brake_disc',              // Тормозной диск передний

            'left_back_brake_disc',               // Тормозной диск задний

            'left_front_pads',                    // Колодки пер.


            'left_back_pads',                     // Колодки задн


            'left_front_tire',                    // Шина пер


            'left_back_tire',                     // Шина задняя


            'left_threshold',                     // Порог


            'left_front_door',                    // Дверь пер.


            'left_back_door',                     // Дверь задн.


            'left_back_lamp',                     // Фонарь задн


            'roof_with_racks',                    // Крыша со стойками


            /* Кузов.  Правая сторона */

            'right_headlight',                    // Фара


            'right_fog_lights',                   // Противотуманные огни


            'right_front_wing',                   // Крыло переднее


            'right_back_wing',                    // Крыло заднее


            'right_mirror',                       // Зеркало


            'right_front_wheels',                 // Диск передний


            'right_back_wheels',                  // Диск задний


            'right_front_brake_disc',             // Тормозной диск передний


            'right_back_brake_disc',              // Тормозной диск задний


            'right_front_pads',                   // Колодки передняя


            'right_back_pads',                    // Колодки задние


            'right_front_tire',                   // Шина передняя


            'right_back_tire',                    // Шина задняя


            'right_threshold',                    // Порог


            'right_front_door',                   // Дверь перяя


            'right_back_door',                    // Дверь задняя


            'right_back_lamp',                    // Фонарь задний


            /* Кузов.  Перед */

            'windshield',                         //Стекло лобовое


            'hood',                               //Капот


            'front_bumper',                       //Бампер передний


            'radiator_grille',                    //Решетка радиатора


            /* Кузов.  Зад */

            'rear_bumper',                        // Бампер задний


            'trunk_lid',                          // Крышка багажника


            'rear_glass',                         // Стекло заднее



            'paintwork_condition',                // Состояние ЛКП

            'engine',                             // Двигатель

            'plastic_parts',                      // Пластиковые детали

            'attachment_equipment',               // Навесное оборудование




            'front_drivers_seat',                 // Сиденье переднее водительское

            'front_passenger_seat',               // Сиденье переднее пассажирское

            'rear_seat',                          // Сиденье заднее

            'diagnostic_errors',                  // Ошибки при диагностике

            'recorder',                           // Магнитола

            'kpp',                                // КПП

            'climate_control',                    // Климатическая установка

            'steering_wheel_and_paddle_switches', // Руль + подрулевые переключатели

            'dashboard',                          // Панель приборов

            'door_trim',                          // Карты дверей

            'floor',                              // Пол

            'pedals',                             // Педали

            'floor_mats',                         // Коврики

            'ceiling',                            // Потолок



            'trunk_floor',                        // Пол

            'trunk_upholstery',                   // Обивка

            'trunk_lighting',                     // Освещение

            'spare_wheel',                        // Запасное колесо

            'instruments',                        // Инструменты

            'jack',                               // Домкрат

            'hitch',                              // Фаркоп



            'anticorrosion_coating',              // Антикоррозийное и антигравийное покрытие

            'hoses',                              // Шланги

            'wiring',                             // Проводка

            'front_shock_absorbers',              // Амортизаторы пер

            'rear_shock_absorbers',               // Амортизаторы зад

            'front_suspension',                   // Передняя подвеска

            'rear_suspension',                    // Задняя подвеска

            'exhaust_system',                     // Система выхлопа


        ];

        $sum = 0;
        $count = count($fields);
        foreach($fields as $field){
            if($this->$field){
                $sum += $this->$field;
            }
        }

        return round($sum / $count, 1);
    }




}