<?php namespace frontend\tests\acceptance;
use frontend\tests\AcceptanceTester;
use frontend\tests\Step\Acceptance\PayU;

class MainCycleCest
{
    public function _before(AcceptanceTester $I)
    {

        $I->amOnUrl('http://autotesmer-emulator.local/panel/clear');
    }

    // tests
    public function simpleDialTest(\frontend\tests\Step\Acceptance\Client $I)
    {
        $I->register();

        $I->createOrder();

        $expert = $I->haveFriend('expert', '\frontend\tests\Step\Acceptance\Expert');

        $expert->does(function(\frontend\tests\Step\Acceptance\Expert $I) {
            $I->register();
            $I->buyPackage();
        });

        $payU = $I->haveFriend('payU', '\frontend\tests\Step\Acceptance\PayU');

        $payU->does(function(\frontend\tests\Step\Acceptance\PayU $I) {
            $I->sendSuccessPayment1();
        });

        $expert->does(function(\frontend\tests\Step\Acceptance\Expert $I) {
            $I->createRequest();
        });

        $I->sendBrief();

        $expert->does(function(\frontend\tests\Step\Acceptance\Expert $I) {
            $I->fillBrief();
        });

        $I->chooseExpert();

        $expert->does(function(\frontend\tests\Step\Acceptance\Expert $I) {
            $I->createReport();
        });

        $I->completeOrder();
    }


    public function safeDialTest(\frontend\tests\Step\Acceptance\Client $I)
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
    }
}
