<?php
namespace frontend\tests\Step\Acceptance;

class Admin extends \frontend\tests\AcceptanceTester
{

    public function login()
    {
        $I = $this;
        $I->amOnUrl($this->urlHome);
        $I->amOnPage("/admin/login");
        $I->fillField(['name' => 'email' ], 'admin@mail.ru');
        $I->fillField(['name' => 'password' ], '1');
        $I->click('.btn-primary');
    }

    public function linkCard()
    {
        $I = $this;
    }

}