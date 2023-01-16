<?php
namespace frontend\tests\Step\Acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class Expert extends \frontend\tests\AcceptanceTester
{


    public function login()
    {
        $I = $this;

        $I->amOnUrl($this->urlHome);
        $I->amOnPage('/login');
        $I->fillField(['name' => 'email'], "testmailbox_2@inbox.ru");
        $I->fillField(['name' => 'password'], "1");
        $I->click("ВОЙТИ");

    }

    public function register()
    {
        $I = $this;
        $I->amOnUrl($this->urlHome);
        $I->click('.registration-button');
        $I->click('.register_page_right_bot > a');
        $I->click('.mp_main_bot > a');
        $I->fillField(['name' => "family"], "Экспертов");
        $I->fillField(['name' => "firstname"], "Эксперт");
        $I->fillField(['name' => "lastname"], "Экспертович");
        $I->fillField(['name' => "phone"], "+7 (932) 019-52-93");
        $I->fillField(['name' => "email"], "testmailbox_2@inbox.ru");
        $I->selectOption('select[name=city]', [ 'value' => 20 ]);
        $I->fillField(['name' => "password"], "1");
        $I->fillField(['name' => "confirm"], "1");

        $I->click('.custom-control-label[for="category_auto"]');
        $I->click('.custom-control-label[for="category_freight"]');
        $I->click('.custom-control-label[for="category_commerce"]');
        $I->click('.custom-control-label[for="category_moto"]');
        $I->click('.custom-control-label[for="category_water"]');

        $I->click('.custom-control-label[for="has_ip"]');
        $I->click('.custom-control-label[for="has_ul"]');

        $I->click('.custom-control-label[for="first_time_verification"]');
        $I->click('.custom-control-label[for="data_authentic"]');
        $I->click('.custom-control-label[for="personal_data_processing_agree"]');

        $I->submitForm('#expert-registration-form', []);
        $I->see("Письмо со ссылкой для активации аккаунта выслано на Ваш почтовый ящик");
        $I->click(".wspam1 p > a");
        $I->see("Поздравляем!");
    }

    public function linkCard()
    {
        $I = $this;
        $I->amOnUrl($this->urlHome);
        $I->amOnPage('/lk/cards');
        $I->click('#registerCard');
        $I->waitForElement('#payment-table');
    }

    public function createRequest()
    {
        $I = $this;
        $I->amOnUrl($this->urlHome);
        $I->amOnPage('/orders');
        $I->click('.header-city-select  .dropdown-toggle');
        $I->click('.header-city-select .city-20');
        $I->see("Подать заявку");
        $I->click('.send-request');
        $I->fillField('input[name="request[price]"]', 20);
        $I->fillField('input[name="request[period]"]', 2);
        $I->fillField('textarea[name="request[content]"]', "some text");
        $I->click('.send-request-button');
    }

    public function createReport()
    {

    }

    public function fillBrief()
    {
        $I = $this;
        $I->amOnUrl($this->urlHome);
        $I->amOnPage('/lk/new');
        $I->click('.edit-brief');
        $I->wait(3);
        $I->selectOption('select[name="mark_id"]', 'Acura');
        $I->wait(3);
        $I->selectOption('select[name="model_id"]', 'CL');

        $I->fillField('input[name="price"]', 23);
        $I->fillField('input[name="engine_volume"]', 2);


        $I->selectOption('select[name="kpp"]', 'Автомат');
        $I->selectOption('select[name="drive"]', 'Заднеприводный с подключаемым передним');
        $I->selectOption('select[name="body"]', 'Седан');
        $I->selectOption('select[name="year_from"]', '2000');
        $I->fillField('input[name="mileage"]', 2);
        $I->fillField('input[name="additionally"]', "add");
        $I->fillField('input[name="about"]', "add");
        $I->click('.button_orange ');
    }

    public function buyPackage()
    {
        $I = $this;
        $I->amOnUrl($this->urlHome);
        $I->click('.header_name');
        $I->click('a[href="/lk/packages"]');
        $I->moveMouseOver( '.lk_expert_body_packejes_item' );
        $I->click('a[href="/expert/variants?id=1"]');
        $I->moveMouseOver( '.lk_expert_body_packejes_item:first-child' );
        $I->click('a[href="/packages/order?id=1"]');
        $I->click('#submit-payment');
        $I->wait(10);
        $I->click('.success');


    }



}