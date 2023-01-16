<?php
namespace frontend\tests\Step\Acceptance;

use yii\helpers\Url;

class Client extends \frontend\tests\AcceptanceTester
{

    public function register()
    {
        $I = $this;
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

    public function createOrder()
    {
        $I = $this;
        $I->amOnUrl($this->urlHome);
        $I->click('#category li[data-category="1"]');
        $I->click('#type li[data-type="2"]');
        $I->click('#create_order');
        $I->wait(3);

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

    public function sendBrief($safedial = false)
    {
        $I = $this;
        $I->amOnUrl($this->urlHome);
        $I->amOnPage('/lk/search');

        if($safedial)
        {
            $I->click('input[name="dial_type"]');
        }

        $I->click('.sendbrif');
    }

    public function linkCard()
    {
        $I = $this;
        $I->amOnUrl($this->urlHome);
        $I->amOnPage('/lk/cards');
        $I->click('#registerCard');
        $I->waitForElement('#payment-table');
    }

    public function chooseExpert($safedial = false)
    {
        $I = $this;
        $I->amOnUrl($this->urlHome);
        $I->amOnPage('lk/search');
        $I->click('.choose-button');

        if($safedial)
        {
            $I->waitForElement('#submit-payment');
            $I->click('#submit-payment');
            $I->waitForElement(".success");
            $I->click(".success");
        }
    }

    public function completeOrder()
    {
        $I = $this;
        $I->amOnUrl($this->urlHome);
        $I->amOnPage('/lk/current');
        $I->click('.close-order-bth');
        $I->fillField(['name' => "review"], "review text");
        $I->click('.submit_close_form');
        $I->see("Нет работ");
    }

    public function cancelDial()
    {
        $I = $this;
    }

}