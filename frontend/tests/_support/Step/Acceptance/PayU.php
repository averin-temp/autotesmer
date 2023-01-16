<?php
namespace frontend\tests\Step\Acceptance;

use yii\helpers\Url;

class PayU extends \frontend\tests\AcceptanceTester
{
    public function updatePanel()
    {
        $I = $this;
        $I->amOnUrl($this->urlPanel);
    }

    public function openPanel()
    {
        $I = $this;
        $I->amOnUrl($this->urlPanel);
        $I->wait(5);
        $I->amOnPage('/panel');
    }

    public function sendSuccessPayment1()
    {
        $I = $this;
        $I->updatePanel();
        $I->click('.row-1 td:nth-child(3) .btn-x2');
        $I->wait(5);
    }
}