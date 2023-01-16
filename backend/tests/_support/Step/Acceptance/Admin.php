<?php
namespace backend\tests\Step\Acceptance;

class Admin extends \backend\tests\AcceptanceTester
{

    public function Signin()
    {
        $I = $this;
        $I->amOnUrl($this->urlHome);
        $I->amOnPage("/admin/login");
        $I->fillField(['name' => 'email' ], 'admin@mail.ru');
        $I->fillField(['name' => 'password' ], '1');
        $I->click('.btn-primary');
    }

    public function createMailingTemplate($name)
    {
        $I = $this;
        $I->amOnPage('/admin/');
        $I->click('.sidebar-menu > li.treeview:nth-child(8) span');
        $I->waitForElement(".menu-open > li:nth-child(4) > a");
        $I->click(".menu-open > li:nth-child(4) > a");
        $I->fillField(['name' => 'name'], $name);
        $I->click('.btn.btn-primary');
        $I->waitForElement('.alert.alert-success');
        $I->see("Шаблон сохранен");
    }


    public function createMailing($mailingName,$templateName)
    {
        $I = $this;
        $I->amOnPage('/admin/');
        $I->click('.treeview:nth-child(8) span');
        $I->waitForElement(".menu-open > li:nth-child(2) > a");
        $I->click(".menu-open > li:nth-child(2) > a");
        $I->fillField(['name' => 'name'], $mailingName);
        $I->selectOption(['name' => 'template_id'], $templateName);
        $I->click('.btn.btn-info');
        $I->waitForElement('.alert.alert-success');
        $I->see("Рассылка сохранена");
    }

    public function createRole($name)
    {
        $I = $this;
        $I->amOnPage('/admin/');
        $I->click('.sidebar-menu > li.treeview:nth-child(2) span');
        $I->waitForElement(".menu-open > li:nth-child(6) > a");
        $I->click(".menu-open > li:nth-child(6) > a");
        $I->fillField(['name' => 'name'], $name);
        $I->fillField(['name' => 'description'], 'описание');
        $I->click('.btn.btn-primary');
        $I->waitForElement('.alert.alert-success', 5);
        $I->see("Успешно сохранено");
    }

    public function createPage($name, $alias)
    {
        $I = $this;
        $I->amOnPage('/admin/');
        $I->click('.sidebar-menu > li.treeview:nth-child(3) span');
        $I->waitForElement(".menu-open > li:nth-child(2) > a");
        $I->click(".menu-open > li:nth-child(2) > a");

        $I->fillField(['name' => 'name'], $name);
        $I->fillField(['name' => 'url'], $alias);

        $I->click('Сохранить');
        $I->waitForElement('.alert.alert-success');
        $I->see("Страница сохранена");
    }

    public function createCategory($name)
    {
        $I = $this;
        $I->amOnPage('/admin/');
        $I->click('.sidebar-menu > li.treeview:nth-child(3) span');
        $I->waitForElement(".menu-open > li:nth-child(4) > a");
        $I->click(".menu-open > li:nth-child(4) > a");

        $I->fillField(['name' => 'name'], $name);

        $I->click('.btn.btn-info');
        $I->waitForElement('.alert.alert-success');
        $I->see("Категория сохранена");
    }

    public function createMenu($name)
    {
        $I = $this;
        $I->amOnPage('/admin/');
        $I->click('.sidebar-menu > li.treeview:nth-child(7) span');
        $I->waitForElement(".menu-open > li:nth-child(2) > a");
        $I->click(".menu-open > li:nth-child(2) > a");

        $I->fillField(['name' => 'name'], $name);

        $I->click('.btn.btn-primary');

        $I->waitForElement('.alert.alert-success');
        $I->see("Меню сохранено");
    }

    public function createPackage($name)
    {
        $I = $this;
        $I->amOnPage('/admin/');
        $I->click('.sidebar-menu > li.treeview:nth-child(4) span');
        $I->waitForElement(".menu-open > li:nth-child(2) > a");
        $I->click(".menu-open > li:nth-child(2) > a");
        $I->fillField(['name' => 'name'], $name);
        $I->click('.btn.btn-info');

        $I->waitForElement('.alert.alert-success');
        $I->see("Пакет сохранен");
    }

    public function createBanner($name)
    {
        $I = $this;
        $I->amOnPage('/admin/');
        $I->click('.sidebar-menu > li.treeview:nth-child(5) span');
        $I->waitForElement(".menu-open > li:nth-child(2) > a");
        $I->click(".menu-open > li:nth-child(2) > a");
        $I->fillField(['name' => 'name'], $name);
        $I->fillField(['name' => 'order'], 1);
        $I->fillField(['name' => 'url'], 'bannerurl');
        // файл находится в 'tests/_data/'
        $I->attachFile(['name' => 'banner_file'], '900x900.jpg');
        $I->click('.btn.btn-info');
        $I->waitForElement('.alert.alert-success');
        $I->see("Баннер сохранен");
    }


    public function createPromocode($name, $discount)
    {
        $I = $this;
        $I->amOnPage('/admin/');
        $I->click('.sidebar-menu > li.treeview:nth-child(6) span');
        $I->waitForElement(".menu-open > li:nth-child(2) > a");
        $I->click(".menu-open > li:nth-child(2) > a");
        $I->fillField(['name' => 'name'], $name);
        $I->fillField(['name' => 'discount'], $discount);
        $I->click('.btn.btn-info');

        $I->waitForElement('.alert.alert-success');
        $I->see("Набор сохранен");
    }

    public function createPackageVariant($name)
    {
        $I = $this;
        $I->click('Добавить вариант');
        $I->fillField(['name' => 'name'], $name);
        $I->fillField(['name' => 'price'], 100);
        $I->click('Сохранить');
        $I->see("Вариант сохранен");
        $I->click("тестовый пакет");

    }



    public function createGroup($name)
    {
        $I = $this;
        $I->amOnPage('/admin/');
        $I->click('.sidebar-menu > li.treeview:nth-child(2) span');
        $I->waitForElement(".menu-open > li:nth-child(4) > a");
        $I->click(".menu-open > li:nth-child(4) > a");
        $I->fillField(['name' => 'name'], "Группа 1");
        $I->click('Сохранить');
        $I->waitForElement('.alert.alert-success');
        $I->see("Успешно сохранено");
    }

    public function createUser($family, $firstname, $lastname, $email, $phone, $role, $password)
    {
        $I = $this;
        $I->amOnPage('/admin/');
        $I->click('.sidebar-menu > li.treeview:nth-child(2) span');
        $I->waitForElement(".menu-open > li:nth-child(2) > a");
        $I->click(".menu-open > li:nth-child(2) > a");

        $I->fillField(['name' => 'family'], $family);
        $I->fillField(['name' => 'firstname'], $firstname);
        $I->fillField(['name' => 'lastname'], $lastname);
        $I->fillField(['name' => 'email'], $email);
        $I->fillField(['name' => 'phone'], $phone);
        $I->selectOption('select[name="_role"]', $role);
        $I->fillField(['name' => 'password'], $password);
        $I->fillField(['name' => 'confirm'], $password);

        $I->click(".btn.btn-info");
        $I->waitForElement('.alert.alert-success');
        $I->see("Пользователь сохранен");

    }




}