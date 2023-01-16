<?php namespace frontend\tests\acceptance;
use frontend\tests\AcceptanceTester;
use frontend\tests\Step\Acceptance\Admin;
use frontend\tests\Step\Acceptance\Client;
use frontend\tests\Step\Acceptance\Expert;
use frontend\tests\Step\Acceptance\PayU;

class NotificationsCest
{
    public $urlHome = 'http://autotesmer-test.local';
    public $urlPanel = 'http://autotesmer-emulator.local';

    public function _before(AcceptanceTester $I)
    {
        $I->amOnUrl('http://autotesmer-emulator.local/panel/clear');
    }

    // tests
    public function NotificationAdminMessageTest(AcceptanceTester $I)
    {
    }

    public function NoticeArbitrationClosedTest(AcceptanceTester $I)
    {
    }

    public function NoticeCardRegisteredTest(Client $I)
    {
        $I->register();

        $I->linkCard();

        //payU activate card
        $payu = $I->haveFriend('payU', PayU::class);
        $payu->does(function(PayU $I){
            $I->openPanel();
            $I->click('#card-table tbody > tr button');
            $I->wait(3);
        });

        // check notify
        $I->amOnUrl($this->urlHome);
        $I->click(".item_bell a");
        $I->waitForText("Ваша карта была успешно привязана");
        $I->see("Ваша карта была успешно привязана");

        // TODO: check email
    }

    public function NoticeClientCreatedAppealTest(Client $I)
    {
        $I->register();

        $I->linkCard();

        $payU = $I->haveFriend('payU', '\frontend\tests\Step\Acceptance\PayU');

        $payU->does(function(PayU $I){
            $I->openPanel();
            $I->waitForElement('#card-table .row-1 button');
            $I->click('#card-table .row-1 button');
            $I->wait(5);
        });

        $I->createOrder();

        $expert = $I->haveFriend('expert', '\frontend\tests\Step\Acceptance\Expert');
        $expert->does(function(\frontend\tests\Step\Acceptance\Expert $I) {
            $I->register();
            $I->linkCard();
        });

        $payU->does(function(PayU $I){
            $I->openPanel();
            $I->waitForElement('#card-table .row-2 button');
            $I->click('#card-table .row-2 button');
            $I->wait(5);
        });

        $expert->does(function(\frontend\tests\Step\Acceptance\Expert $I) {
            $I->buyPackage();
            $I->amOnPage('/lk/packages');
        });

        $payU->does(function(PayU $I){
            $I->openPanel();
            $I->wait(5);
            $I->click('#payment-table .row-1 td:nth-child(3) .btn-x2');
            $I->wait(5);
        });



        $expert->does(function(\frontend\tests\Step\Acceptance\Expert $I) {
            $I->createRequest();
        });

        $I->sendBrief(true);

        $expert->does(function(\frontend\tests\Step\Acceptance\Expert $I) {
            $I->fillBrief();
        });

        $I->chooseExpert(true);

        $payU->does(function(PayU $I){
            $I->openPanel();
            $I->waitForElement('#payment-table .row-2 td:nth-child(3) .btn-x2');
            $I->click('#payment-table .row-2 td:nth-child(3) .btn-x2');
            $I->wait(5);
        });

        $I->createAppeal();


        $expert->does(function(\frontend\tests\Step\Acceptance\Expert $I) {
            // check notify
            $I->amOnUrl($this->urlHome);
            $I->click(".item_bell a");
            $I->waitForText("Клиент открыл арбитраж");
            $I->see("Клиент открыл арбитраж");
        });


        // TODO: check email

    }



    public function NoticeExpertCreatedAppealTest(Client $I)
    {
        $I->register();

        $I->linkCard();

        $payU = $I->haveFriend('payU', '\frontend\tests\Step\Acceptance\PayU');

        $payU->does(function(PayU $I){
            $I->openPanel();
            $I->waitForElement('#card-table .row-1 button');
            $I->click('#card-table .row-1 button');
            $I->wait(5);
        });

        $I->createOrder();

        $expert = $I->haveFriend('expert', '\frontend\tests\Step\Acceptance\Expert');
        $expert->does(function(\frontend\tests\Step\Acceptance\Expert $I) {
            $I->register();
            $I->linkCard();
        });

        $payU->does(function(PayU $I){
            $I->openPanel();
            $I->waitForElement('#card-table .row-2 button');
            $I->click('#card-table .row-2 button');
            $I->wait(5);
        });

        $expert->does(function(\frontend\tests\Step\Acceptance\Expert $I) {
            $I->buyPackage();
            $I->amOnPage('/lk/packages');
        });

        $payU->does(function(PayU $I){
            $I->openPanel();
            $I->wait(5);
            $I->click('#payment-table .row-1 td:nth-child(3) .btn-x2');
            $I->wait(5);
        });



        $expert->does(function(\frontend\tests\Step\Acceptance\Expert $I) {
            $I->createRequest();
        });

        $I->sendBrief(true);

        $expert->does(function(\frontend\tests\Step\Acceptance\Expert $I) {
            $I->fillBrief();
        });

        $I->chooseExpert(true);

        $payU->does(function(PayU $I){
            $I->openPanel();
            $I->waitForElement('#payment-table .row-2 td:nth-child(3) .btn-x2');
            $I->click('#payment-table .row-2 td:nth-child(3) .btn-x2');
            $I->wait(5);
        });


        $expert->does(function(\frontend\tests\Step\Acceptance\Expert $I) {
            $I->createAppeal();
        });

        // check notify
        $I->amOnUrl($this->urlHome);
        $I->click(".item_bell a");
        $I->waitForText("Эксперт открыл арбитраж");
        $I->see("Эксперт открыл арбитраж");


        // TODO: check email

    }

    public function NoticeDocumentsApprovedTest(Expert $I)
    {
        $I->register();

        $I->amOnUrl($this->urlHome);
        $I->amOnPage('/lk/settings');

        $I->click('label[for="user_agreement"]');
        $I->click('label[for="data_processing"]');
        $I->click('#verification-next');
        $I->waitForElement(['name' => 'passport_photo']);

        // файл находится в 'tests/_data/'
        $I->attachFile(['name' => 'passport_photo'], '900x900.jpg');
        $I->click('#to_selfie');

        $I->waitForElement(['name' => 'selfie_photo']);
        $I->attachFile(['name' => 'selfie_photo'], '900x900.jpg');
        $I->click('#commit');


        $admin = $I->haveFriend('admin', Admin::class);
        $admin->does(function(Admin $I){
            $I->login();
            $I->amOnPage('/admin/verifications/list');
            $I->see("testmailbox_2@inbox.ru");
            $I->see("ожидает проверки");
            $I->click('a[href="/admin/verifications/verify?id=1"]');
            $I->see("Проверка документов");
            $I->click('Подтвердить');
            $I->waitForElement('.alert.alert-success');
            $I->see("верификация подтверждена");
        });

        $I->amOnPage('/lk/settings');
        $I->see("Поздравляем! Вы успешно прошли верификацию.");


        // check notify
        $I->amOnUrl($this->urlHome);
        $I->click(".item_bell a");
        $I->waitForText("Ваши документы прошли проверку");
        $I->see("Ваши документы прошли проверку");

        // TODO: check email
    }


    public function NoticeEventsTest(Expert $I)
    {

        /*$I->register();

        // check settings
        $I->amOnPage('/lk/noticesoptions');
        $I->see("!!!!!!!!!!");
        $I->seeCheckboxIsChecked('input[name="!!!!!!!!!!"]');

        // check notify
        $I->amOnPage('/lk');
        $I->click(".item_bell a");
        $I->see("!!!!!!!!!!");*/

    }

    public function NoticePackageObtainedTest(Expert $I)
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

        $I->amOnUrl($this->urlHome);
        $I->click(".item_bell a");
        $I->waitForText("Приобретен пакет");
        $I->see("Приобретен пакет");
    }




    public function NoticeYouOrderedASelectionTest(Client $I)
    {
        $I->register();
        $I->createOrder();

        $I->amOnUrl($this->urlHome);
        $I->click(".item_bell a");
        $I->waitForText("Вы заказали услуги эксперта на день");
        $I->see("Вы заказали услуги эксперта на день");

        // TODO:  повторить для других вариантов заказа

    }


    public function NoticeNewRequestTest(Expert $I)
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
            $I->amOnUrl($this->urlHome);
            $I->click(".item_bell a");
            $I->waitForText("По вашей заявке поступило новое предложение");
            $I->see("По вашей заявке поступило новое предложение");
        });


    }



    public function NoticeYouHaveSecuredADealTest(Client $I)
    {
        $I->register();

        $I->linkCard();

        $payU = $I->haveFriend('payU', '\frontend\tests\Step\Acceptance\PayU');

        $payU->does(function(PayU $I){
            $I->openPanel();
            $I->waitForElement('#card-table .row-1 button');
            $I->click('#card-table .row-1 button');
            $I->wait(5);
        });

        $I->createOrder();

        $expert = $I->haveFriend('expert', '\frontend\tests\Step\Acceptance\Expert');
        $expert->does(function(\frontend\tests\Step\Acceptance\Expert $I) {
            $I->register();
            $I->linkCard();
        });

        $payU->does(function(PayU $I){
            $I->openPanel();
            $I->waitForElement('#card-table .row-2 button');
            $I->click('#card-table .row-2 button');
            $I->wait(5);
        });

        $expert->does(function(\frontend\tests\Step\Acceptance\Expert $I) {
            $I->buyPackage();
            $I->amOnPage('/lk/packages');
        });

        $payU->does(function(PayU $I){
            $I->openPanel();
            $I->wait(5);
            $I->click('#payment-table .row-1 td:nth-child(3) .btn-x2');
            $I->wait(5);
        });



        $expert->does(function(\frontend\tests\Step\Acceptance\Expert $I) {
            $I->createRequest();
        });

        $I->sendBrief(true);

        $expert->does(function(\frontend\tests\Step\Acceptance\Expert $I) {
            $I->fillBrief();
        });

        $I->chooseExpert(true);

        $I->amOnUrl($this->urlHome);
        $I->click(".item_bell a");
        $I->waitForText("Вы заключили безопасную сделку");
        $I->see("Вы заключили безопасную сделку");
    }




    public function NoticeYouConfirmedWorkTest(Client $I)
    {
        $I->register();

        $I->linkCard();

        $payU = $I->haveFriend('payU', '\frontend\tests\Step\Acceptance\PayU');

        $payU->does(function(PayU $I){
            $I->openPanel();
            $I->waitForElement('#card-table .row-1 button');
            $I->click('#card-table .row-1 button');
            $I->wait(5);
        });

        $I->createOrder();

        $expert = $I->haveFriend('expert', '\frontend\tests\Step\Acceptance\Expert');
        $expert->does(function(\frontend\tests\Step\Acceptance\Expert $I) {
            $I->register();
            $I->linkCard();
        });

        $payU->does(function(PayU $I){
            $I->openPanel();
            $I->waitForElement('#card-table .row-2 button');
            $I->click('#card-table .row-2 button');
            $I->wait(5);
        });

        $expert->does(function(\frontend\tests\Step\Acceptance\Expert $I) {
            $I->buyPackage();
            $I->amOnPage('/lk/packages');
        });

        $payU->does(function(PayU $I){
            $I->openPanel();
            $I->wait(5);
            $I->click('#payment-table .row-1 td:nth-child(3) .btn-x2');
            $I->wait(5);
        });



        $expert->does(function(\frontend\tests\Step\Acceptance\Expert $I) {
            $I->createRequest();
        });

        $I->sendBrief(true);

        $expert->does(function(\frontend\tests\Step\Acceptance\Expert $I) {
            $I->fillBrief();
        });

        $I->chooseExpert(true);

        $payU->does(function(PayU $I){
            $I->openPanel();
            $I->waitForElement('#payment-table .row-2 td:nth-child(3) .btn-x2');
            $I->click('#payment-table .row-2 td:nth-child(3) .btn-x2');
            $I->wait(5);
        });

        $expert->does(function(\frontend\tests\Step\Acceptance\Expert $I) {
            $I->createReport();
        });

        $I->completeOrder();

        $I->amOnUrl($this->urlHome);
        $I->click(".item_bell a");
        $I->waitForText("Вы подтвердили выполнение работ");
        $I->see("Вы подтвердили выполнение работ");
    }




    public function NoticeYouMadeADepositTest(Client $I)
    {
        $I->register();

        $I->linkCard();

        $payU = $I->haveFriend('payU', '\frontend\tests\Step\Acceptance\PayU');

        $payU->does(function(PayU $I){
            $I->openPanel();
            $I->waitForElement('#card-table .row-1 button');
            $I->click('#card-table .row-1 button');
            $I->wait(5);
        });

        $I->createOrder();

        $expert = $I->haveFriend('expert', '\frontend\tests\Step\Acceptance\Expert');
        $expert->does(function(\frontend\tests\Step\Acceptance\Expert $I) {
            $I->register();
            $I->linkCard();
        });

        $payU->does(function(PayU $I){
            $I->openPanel();
            $I->waitForElement('#card-table .row-2 button');
            $I->click('#card-table .row-2 button');
            $I->wait(5);
        });

        $expert->does(function(\frontend\tests\Step\Acceptance\Expert $I) {
            $I->buyPackage();
            $I->amOnPage('/lk/packages');
        });

        $payU->does(function(PayU $I){
            $I->openPanel();
            $I->wait(5);
            $I->click('#payment-table .row-1 td:nth-child(3) .btn-x2');
            $I->wait(5);
        });



        $expert->does(function(\frontend\tests\Step\Acceptance\Expert $I) {
            $I->createRequest();
        });

        $I->sendBrief(true);

        $expert->does(function(\frontend\tests\Step\Acceptance\Expert $I) {
            $I->fillBrief();
        });

        $I->chooseExpert(true);

        $payU->does(function(PayU $I){
            $I->openPanel();
            $I->waitForElement('#payment-table .row-2 td:nth-child(3) .btn-x2');
            $I->click('#payment-table .row-2 td:nth-child(3) .btn-x2');
            $I->wait(5);
        });


        $I->amOnUrl($this->urlHome);
        $I->click(".item_bell a");
        $I->waitForText("Вы внесли депозит");
        $I->see("Вы внесли депозит");
    }



    public function NoticeWorksInYourRegionTest(Expert $I)
    {
        $I->register();

        $client = $I->haveFriend('client', '\frontend\tests\Step\Acceptance\Client');

        $client->does(function(Client $I){
            $I->register();
            $I->createOrder();
        });

        $I->amOnUrl($this->urlHome);
        $I->click(".item_bell a");
        $I->waitForText("В вашем регионе опубликовано");
        $I->see("В вашем регионе опубликовано");
    }











}
