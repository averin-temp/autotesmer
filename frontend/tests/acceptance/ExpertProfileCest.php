<?php namespace frontend\tests\acceptance;
use frontend\tests\AcceptanceTester;
use frontend\tests\Step\Acceptance\Admin;
use frontend\tests\Step\Acceptance\Expert;

class ExpertProfileCest
{
    public $urlHome = 'http://autotesmer-test.local';
    public $urlPanel = 'http://autotesmer-emulator.local';

    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function PostVideoTest(Expert $I)
    {
        $I->register();

        $I->amOnUrl($this->urlHome);
        $I->amOnPage('/lk/video');
        $I->click('.post-video-button');

        $I->fillField(['name' => 'name'], "Видео 1");
        $I->fillField(['name' => 'link'], "https://youtu.be/R_eWDfkTV6Y");
        $I->fillField(['name' => 'tags_string'], "тэг1, тэг2");
        $I->fillField(['name' => 'description'], "описание");
        $I->click('.save-video-button');
        $I->seeElement('iframe');

        $I->amOnPage('/lk/video');

        $I->click('a[href="/expert/removevideo?id=1"]');

    }

    public function DocumentsValidationTest(Expert $I)
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
    }

}
