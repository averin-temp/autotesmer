<?php namespace frontend\tests\acceptance;
use frontend\tests\AcceptanceTester;
use frontend\tests\Step\Acceptance\Admin;
use frontend\tests\Step\Acceptance\Client;
use frontend\tests\Step\Acceptance\Expert;
use frontend\tests\Step\Acceptance\PayU;

class FrontCest
{
    public $urlHome = 'http://autotesmer-test.local';
    public $urlPanel = 'http://autotesmer-emulator.local';


    public function _before(AcceptanceTester $I)
    {
        $I->amOnUrl('http://autotesmer-emulator.local/panel/clear');
    }

    // tests
    public function ExpertRegistrationTest(AcceptanceTester $I)
    {
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

    public function ClientRegistrationTest(AcceptanceTester $I)
    {
        $I->amOnUrl($this->urlHome);
        $I->click('.registration-button');
        $I->waitForElement('.register_page_left_bot > a', 5);
        $I->click('.register_page_left_bot > a');
        $I->waitForElement('input[name="family"]', 5);
        $I->fillField(['name' => "family"], "Клиентов");
        $I->fillField(['name' => "firstname"], "Клиент");
        $I->fillField(['name' => "lastname"], "Клиентович");
        $I->fillField(['name' => "phone"], "+7 (932) 019-52-93");
        $I->fillField(['name' => "email"], "testmailbox_1@inbox.ru");
        $I->selectOption('select[name=city]', [ 'value' => 20 ]);
        $I->fillField(['name' => "password"], "1");
        $I->fillField(['name' => "confirm"], "1");
        $I->submitForm('#client-registration-form', []);
        $I->see("ссылка для активации");
        $I->click(".wspam1 p > a");
        $I->see("Вы успешно активировали ваш аккаунт Autotesmer");
    }


    public function BuyPackageTest(Expert $I)
    {
        $I->register();
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


    public function CreateRequestTest(Expert $I)
    {
        $I->register();
        $I->buyPackage();

        $payU = $I->haveFriend('payU', '\frontend\tests\Step\Acceptance\PayU');

        $payU->does(function(PayU $I){
            $I->openPanel();
            $I->wait(5);
            $I->click('#payment-table .row-1 td:nth-child(3) .btn-x2');
            $I->wait(5);
        });


        $client = $I->haveFriend('client', Client::class);
        $client->does(function(Client $I){
            $I->register();
            $I->createOrder();
        });

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


    public function BriefFormTest(Expert $I)
    {
        $I->register();
        $I->buyPackage();

        $payU = $I->haveFriend('payU', '\frontend\tests\Step\Acceptance\PayU');

        $payU->does(function(PayU $I){
            $I->openPanel();
            $I->wait(5);
            $I->click('#payment-table .row-1 td:nth-child(3) .btn-x2');
            $I->wait(5);
        });

        $client = $I->haveFriend('client', Client::class);
        $client->does(function(Client $I){
            $I->register();
            $I->createOrder();
        });

        $I->createRequest();

        $client->does(function(Client $I){
            $I->sendBrief();
        });

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


    public function ReportTest(Expert $I)
    {
        $client = $I->haveFriend('client', '\frontend\tests\Step\Acceptance\Client');
        $payU = $I->haveFriend('payU', '\frontend\tests\Step\Acceptance\PayU');

        $I->register();

        $client->does(function(\frontend\tests\Step\Acceptance\Client $I) {
            $I->register();
        });

        $I->buyPackage();

        $payU->does(function(PayU $I){
            $I->openPanel();
            $I->wait(5);
            $I->click('#payment-table .row-1 td:nth-child(3) .btn-x2');
            $I->wait(5);
        });

        $client->does(function(\frontend\tests\Step\Acceptance\Client $I) {
            $I->createOrder();
        });

        $I->createRequest();

        $client->does(function(\frontend\tests\Step\Acceptance\Client $I) {
            $I->sendBrief();
        });

        $I->fillBrief();

        $client->does(function(\frontend\tests\Step\Acceptance\Client $I) {
            $I->chooseExpert();
        });

        $I->amOnPage('/lk/current');
        $I->click("Отправить отчет");
        $I->waitForText('Кузов');
        $I->selectOption('#selectYear', "1984");
        $I->selectOption('#selectBrand', "Acura");
        $I->waitForElementClickable('#selectModel',20);
        $I->selectOption('#selectModel', "Integra");
        $I->fillField('#inputVin', "2342764892479824");
        $I->selectOption('#selectBody', "Седан");
        $I->selectOption('#selectDrives', "Задний");
        $I->selectOption('#selectVendorCountry', "Бангладеш");
        $I->selectOption('#selectAge', "13");
        $I->fillField('#inputDoorsNumber', "2");
        $I->selectOption('#selectOwnerCount', "2");
        $I->attachFile('[name="photo"]', "900x900.jpg");
        $I->click('#stage-1 a[href="#stage-2"]');

        $I->waitForText("Проверка автомобиля по базам");

        $I->fillField('#textareaTrafficAccidents', "sdfsdfsdf");
        $I->fillField('#textareaInspectionRecords', "sdfsdfsdf");
        $I->fillField('#textareaPersonalVehicle', "sdfsdfsdf");
        $I->fillField('#textareaOdometerReadings', "sdfsdfsdf");
        $I->fillField('#textareaTrafficAccidents_1', "sdfsdfsdf");
        $I->fillField('#textareaTrafficAccidents_2', "sdfsdfsdf");
        $I->click('#stage-2 a[href="#stage-3"]');
        $I->waitForText("Кузов");
        $I->click('#stage-3 a[href="#stage-4"]');
        $I->waitForText("Подкапотное пространство");
        $I->click('#stage-4 a[href="#stage-5"]');
        $I->waitForText("Салон");
        $I->click('#stage-5 a[href="#stage-6"]');
        $I->waitForText("Багажник");
        $I->click('#stage-6 a[href="#stage-7"]');
        $I->waitForText("Осмотр на подъемнике");
        $I->click('#stage-7 a[href="#stage-8"]');
        $I->waitForText("Затраты после покупки");

        $I->fillField('#inputPostPurchaseCostsBody', "1000");
        $I->fillField('#inputPostPurchaseCostsGlasses', "1000");
        $I->fillField('#inputPostPurchaseCostsEngine', "1000");
        $I->fillField('#inputPostPurchaseCostsTransmission', "1000");
        $I->fillField('#inputPostPurchaseCostsSalon', "1000");
        $I->fillField('#inputPostPurchaseCostsSuspension', "1000");
        $I->fillField('#inputPostPurchaseCostsChassis', "1000");
        $I->fillField('#inputPostPurchaseCostsElectrician', "1000");
        $I->fillField('#inputSecondSetRubber', "1000");
        $I->fillField('#inputCountryOrigin', "sdfsdfsdf");
        $I->click("Отправить");
        $I->waitForText("Открыть чат");

    }

    public function CreateOrderTest(Client $I)
    {
        $I->register();

        $I->amOnUrl($this->urlHome);
        $I->click('#category li[data-category="1"]');
        $I->click('#type li[data-type="2"]');
        $I->click('#create_order');

        $I->fillField('#budget_from', "20000");
        $I->fillField('#budget_to', "30000");

        $I->fillField('#period_from', "10");
        $I->fillField('#period_to', "20");

        $I->selectOption('#mark_id', 'Acura');
        $I->wait(5);
        $I->selectOption('#model_id', 'CL');

        $I->click('#auto-body li[data-body="4"]');
        $I->click('#drive li[data-drive="1"]');
        $I->click('#transmission li[data-transmission="1"]');
        $I->click('#engine li[data-engine="1"]');

        $I->fillField(['name' => "comment"], "Comment text");
        $I->click('#send');
    }


    public function ClientCreateAppeal(Client $I)
    {

    }

    public function ExpertCreateAppeal(Expert $I)
    {

    }


    public function ChatTest(Expert $I)
    {

        /*$client = $I->haveFriend('client', '\frontend\tests\Step\Acceptance\Client');
        $payU = $I->haveFriend('payU', '\frontend\tests\Step\Acceptance\PayU');

        $I->register();

        $client->does(function(\frontend\tests\Step\Acceptance\Client $I) {
            $I->register();
        });

        $I->buyPackage();

        $payU->does(function(PayU $I){
            $I->openPanel();
            $I->wait(5);
            $I->click('#payment-table .row-1 td:nth-child(3) .btn-x2');
            $I->wait(5);
        });

        $client->does(function(\frontend\tests\Step\Acceptance\Client $I) {
            $I->createOrder();
        });


        $I->createRequest();

        $client->does(function(\frontend\tests\Step\Acceptance\Client $I) {
            $I->sendBrief();
        });

        $I->fillBrief();

        $client->does(function(\frontend\tests\Step\Acceptance\Client $I) {
            $I->chooseExpert();
        });*/

        $I->Singin();

        $I->amOnPage('/lk/current');
        $I->click("Отправить отчет");
        $I->waitForText('Кузов');
        $I->selectOption('#selectYear', "1984");
        $I->selectOption('#selectBrand', "Acura");
        $I->waitForElementClickable('#selectModel');
        $I->selectOption('#selectModel', "Integra");
        $I->fillField('#inputVin', "2342764892479824");
        $I->selectOption('#selectBody', "Седан");
        $I->selectOption('#selectDrives', "Задний");
        $I->selectOption('#selectVendorCountry', "Бангладеш");
        $I->selectOption('#selectAge', "13");
        $I->selectOption('#selectOwnerCount', "2");
        $I->selectOption('#selectOwnerCount', "2");
        $I->attachFile('[name="photo"]', "900x900.jpg");
        $I->click("ДАЛЬШЕ");

        $I->waitForText("Проверка автомобиля по базам");

        $I->fillField('#textareaTrafficAccidents', "sdfsdfsdf");
        $I->fillField('#textareaInspectionRecords', "sdfsdfsdf");
        $I->fillField('#textareaPersonalVehicle', "sdfsdfsdf");
        $I->fillField('#textareaOdometerReadings', "sdfsdfsdf");
        $I->fillField('#textareaTrafficAccidents_1', "sdfsdfsdf");
        $I->fillField('#traffic_accidents_info_2', "sdfsdfsdf");
        $I->click("ДАЛЬШЕ");
        $I->waitForText("Кузов");
        $I->click("ДАЛЬШЕ");
        $I->waitForText("Подкапотное пространство");
        $I->click("ДАЛЬШЕ");
        $I->waitForText("Салон");
        $I->click("ДАЛЬШЕ");
        $I->waitForText("Багажник");
        $I->click("ДАЛЬШЕ");
        $I->waitForText("Осмотр на подъемнике");
        $I->click("ДАЛЬШЕ");
        $I->waitForText("Затраты после покупки");

        $I->fillField('#inputPostPurchaseCostsBody', "sdfsdfsdf");
        $I->fillField('#inputPostPurchaseCostsGlasses', "sdfsdfsdf");
        $I->fillField('#inputPostPurchaseCostsEngine', "sdfsdfsdf");
        $I->fillField('#inputPostPurchaseCostsTransmission', "sdfsdfsdf");
        $I->fillField('#inputPostPurchaseCostsSalon', "sdfsdfsdf");
        $I->fillField('#inputPostPurchaseCostsSuspension', "sdfsdfsdf");
        $I->fillField('#inputPostPurchaseCostsChassis', "sdfsdfsdf");
        $I->fillField('#inputPostPurchaseCostsElectrician', "sdfsdfsdf");
        $I->fillField('#inputSecondSetRubber', "sdfsdfsdf");
        $I->fillField('#inputCountryOrigin', "sdfsdfsdf");
        $I->click("Отправить");
        $I->waitForText("Открыть чат");
    }



    public function ExpertCardRegistration(Expert $I)
    {
        $I->register();

        $I->amOnUrl($this->urlHome);
        $I->amOnPage('/lk/cards');
        $I->click('#registerCard');

        $payu = $I->haveFriend('payU', PayU::class);
        $payu->does(function(PayU $I){
            $I->openPanel();
            $I->click('#card-table tbody > tr button');
            $I->wait(3);
        });

        $I->amOnUrl($this->urlHome);
        $I->amOnPage('/lk/cards');
        $I->seeElement(".card-block");
    }

    public function ClientCardRegistration(Client $I)
    {
        $I->register();

        $I->amOnUrl($this->urlHome);
        $I->amOnPage('/lk/cards');
        $I->click('#registerCard');

        $payu = $I->haveFriend('payU', PayU::class);
        $payu->does(function(PayU $I){
            $I->openPanel();
            $I->click('#card-table tbody > tr button');
            $I->wait(3);
        });

        $I->amOnUrl($this->urlHome);
        $I->amOnPage('/lk/cards');
        $I->seeElement(".card-block");
    }

    public function AdvertisingTest(Admin $I)
    {
        $data = [
            'name' => "Иван Иванович",
            'phone' => "+79068686776",
            'email' => "test@iit.com",
            'website' => "http://hh.ru"
        ];

        $I->amOnUrl($this->urlHome);
        $I->amOnPage('/advertising');
        $I->fillField(['name' => 'Advertising[name]'], $data['name']);
        $I->fillField(['name' => 'Advertising[phone]'], $data['phone']);
        $I->fillField(['name' => 'Advertising[email]'], $data['email']);
        $I->fillField(['name' => 'Advertising[website]'], $data['website']);
        $I->click('#send-request');

        $I->waitForText("Ваше сообщение сохранено");

        $I->login();
        $I->amOnPage('/admin/advertising');
        $I->see($data['name']);
        $I->see($data['phone']);
        $I->see($data['email']);
        $I->see($data['website']);
    }

}
