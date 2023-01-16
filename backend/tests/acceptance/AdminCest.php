<?php namespace backend\tests\acceptance;
use backend\tests\AcceptanceTester;
use backend\tests\Step\Acceptance\Admin;
use Codeception\Util\Fixtures;

class AdminCest
{
    private $urlHome = 'http://autotesmer-test.local';
    private $urlPanel = 'http://autotesmer-emulator.local';

    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function Signin(Admin $I)
    {
        $I->amOnUrl($this->urlHome);
        $I->amOnPage('/admin/login');

        $I->fillField(['name' => 'email' ], 'expert@mail.ru');
        $I->fillField(['name' => 'password' ], '2');
        $I->click('.btn-primary');
        $I->see("Неверный пароль или email");

        $I->fillField(['name' => 'email' ], 'admin@mail.ru');
        $I->fillField(['name' => 'password' ], '1');
        $I->click('.btn-primary');
    }


    // tests
    public function TableGroupsTest(Admin $I)
    {
        $I->Signin();
        $I->click('.treeview:nth-child(2) span');
        $I->waitForElement(".menu-open > li:nth-child(4) > a");
        $I->click(".menu-open > li:nth-child(4) > a");

        $groupNumber = 1;
        while($groupNumber < 12)
        {
            $I->click(".menu-open > li:nth-child(4) > a");
            $I->fillField(['name' => 'name' ], 'Группа ' . $groupNumber);
            $I->click('.btn-info');
            $I->see("Успешно сохранено");

            $groupNumber++;
        }

        $I->click(".menu-open > li:nth-child(3) > a");
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);

        $I->click('li.paginate_button [data-dt-idx="2"]');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 1);
        $I->waitForElement("tbody tr");
        $I->click('li.paginate_button [data-dt-idx="1"]');
        $I->seeNumberOfElements('tbody tr', 10);
        $I->click('#example1_next a');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 1);
        $I->click('#example1_previous a');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);

        $I->click('tbody input[value="9"]');
        $I->click('tbody input[value="8"]');
        $I->click('tbody input[value="7"]');

        $I->click('#actions > button.dropdown-toggle');
        $I->waitForElementVisible('#actions .dropdown-menu a[data-action="delete"]');
        $I->click('#actions .dropdown-menu a[data-action="delete"]');

        $I->waitForElementVisible('#modal-dialog');
        $I->see("Удалить выбранные?");
        $I->click('#modal-dialog .button-ok');

        $I->waitForElement('.alert.alert-success');
        $I->see("Группы удалены");
    }


    public function TableUsersTest(Admin $I)
    {
        $I->Signin();

        $I->click('.treeview:nth-child(2) span');
        $I->waitForElement(".menu-open > li:nth-child(2) > a");

        $usersNumber = 1;
        while($usersNumber < 12)
        {
            $I->createUser(
                "Фамилия",
                "Имя",
                "Отчество",
                "test".$usersNumber++."@mail.ru",
                "+79068686776",
                "Клиент",
                "1"
            );
        }

        $I->click('.sidebar-menu > li.treeview:nth-child(2) span');
        $I->waitForElement(".menu-open > li:nth-child(1) > a");
        $I->click(".menu-open > li:nth-child(1) > a");
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);

        $I->click('li.paginate_button [data-dt-idx="2"]');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 2);
        $I->waitForElement("tbody tr");
        $I->click('li.paginate_button [data-dt-idx="1"]');
        $I->seeNumberOfElements('tbody tr', 10);
        $I->click('#users-table_next a');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 2);
        $I->click('#users-table_previous a');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);

        $I->click('tbody tr:nth-child(1) input[type="checkbox"]');
        $I->click('tbody tr:nth-child(2) input[type="checkbox"]');
        $I->click('tbody tr:nth-child(3) input[type="checkbox"]');

        $I->click('#actions > button.dropdown-toggle');
        $I->waitForElementVisible('#actions .dropdown-menu a[data-action="delete"]');
        $I->click('#actions .dropdown-menu a[data-action="delete"]');

        $I->waitForElementVisible('#modal-dialog');
        $I->see("Удалить выбранные?");
        $I->click('#modal-dialog .button-ok');

        $I->waitForElement('.alert.alert-success');
        $I->see("Пользователи удалены");
    }


    public function TableMailingTest(Admin $I)
    {
        $I->Signin();
        $I->createMailingTemplate("тестовый шаблон");

        $mailingsNumber = 1;
        while($mailingsNumber < 12)
        {
            $I->createMailing("Рассылка " . $mailingsNumber, "тестовый шаблон");
            $mailingsNumber++;
        }

        $I->click(".menu-open > li:nth-child(1) > a");
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);
        $I->click('li.paginate_button [data-dt-idx="2"]');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 1);
        $I->click('li.paginate_button [data-dt-idx="1"]');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);
        $I->click('#mailing-table_next a');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 1);
        $I->click('#mailing-table_previous a');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);

        $I->click('tbody input[value="8"]');
        $I->click('tbody input[value="7"]');
        $I->click('tbody input[value="6"]');

        $I->click('#actions > button.dropdown-toggle');
        $I->waitForElementVisible('#actions .dropdown-menu a[data-action="delete"]');
        $I->click('#actions .dropdown-menu a[data-action="delete"]');

        $I->waitForElementVisible('#modal-dialog');
        $I->see("Удалить выбранные?");
        $I->click('#modal-dialog .button-ok');

        $I->waitForElement('.alert.alert-success');
        $I->see("Рассылки удалены");
    }


    public function TableMailingTemplateTest(Admin $I)
    {

        $I->Signin();

        $templateNumber = 1;
        while($templateNumber < 12)
        {
            $I->createMailingTemplate("шаблон " . $templateNumber++);
        }

        $I->click(".menu-open > li:nth-child(3) > a");
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);

        $I->click('li.paginate_button [data-dt-idx="2"]');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 1);

        $I->click('li.paginate_button [data-dt-idx="1"]');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);

        $I->click('#template-table_next a');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 1);

        $I->click('#template-table_previous a');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);


        $I->click('tbody input[value="8"]');
        $I->click('tbody input[value="7"]');
        $I->click('tbody input[value="6"]');

        $I->click('#actions > button.dropdown-toggle');
        $I->waitForElementVisible('#actions .dropdown-menu a[data-action="delete"]');
        $I->click('#actions .dropdown-menu a[data-action="delete"]');

        $I->waitForElementVisible('#modal-dialog');
        $I->see("Удалить выбранные?");
        $I->click('#modal-dialog .button-ok');

        $I->waitForElement('.alert.alert-success');
        $I->see("Шаблоны удалены");

    }


    public function TableRoleTest(Admin $I)
    {
        $I->Signin();

        $roleNumber = 1;
        while($roleNumber < 12)
        {
            $I->createRole("Роль " . $roleNumber++);
        }

        $I->click(".menu-open > li:nth-child(5) > a");
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);

        $I->click('li.paginate_button [data-dt-idx="2"]');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 5);

        $I->click('li.paginate_button [data-dt-idx="1"]');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);

        $I->click('#role-table_next a');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 5);

        $I->click('#role-table_previous a');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);


        $I->click('tbody input[value="Роль 5"]');


        $I->click('#actions > button.dropdown-toggle');
        $I->waitForElementVisible('#actions .dropdown-menu a[data-action="delete"]');
        $I->click('#actions .dropdown-menu a[data-action="delete"]');

        $I->waitForElementVisible('#modal-dialog');
        $I->see("Удалить выбранные?");
        $I->click('#modal-dialog .button-ok');

        $I->waitForElement('.alert.alert-success');
        $I->see("Роли удалены");
    }


    public function TablePageTest(Admin $I)
    {
        $I->Signin();

        $pageNumber = 1;
        while($pageNumber < 12)
        {
            $I->createPage("Страница " . $pageNumber, 'page' . $pageNumber++);
        }

        $I->click(".menu-open > li:nth-child(1) > a");
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);

        $I->click('li.paginate_button [data-dt-idx="2"]');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 1);

        $I->click('li.paginate_button [data-dt-idx="1"]');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);

        $I->click('#pages-table_next a');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 1);

        $I->click('#pages-table_previous a');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);

        $I->click('tbody input[value="8"]');
        $I->click('tbody input[value="7"]');
        $I->click('tbody input[value="6"]');

        $I->click('#actions > button.dropdown-toggle');
        $I->waitForElementVisible('#actions .dropdown-menu a[data-action="delete"]');
        $I->click('#actions .dropdown-menu a[data-action="delete"]');

        $I->waitForElementVisible('#modal-dialog');
        $I->see("Удалить выбранные?");
        $I->click('#modal-dialog .button-ok');

        $I->waitForElement('.alert.alert-success');
        $I->see("Страницы удалены");
    }


    public function TableCategoryTest(Admin $I)
    {
        $I->Signin();

        $categoryNumber = 1;
        while($categoryNumber < 12)
        {
            $I->createCategory("Категория " . $categoryNumber++);
        }

        $I->click(".menu-open > li:nth-child(3) > a");
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);

        $I->click('li.paginate_button [data-dt-idx="2"]');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 1);

        $I->click('li.paginate_button [data-dt-idx="1"]');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);

        $I->click('#categories_next a');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 1);

        $I->click('#categories_previous a');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);

        $I->click('tbody input[value="8"]');
        $I->click('tbody input[value="7"]');
        $I->click('tbody input[value="6"]');

        $I->click('#actions > button.dropdown-toggle');
        $I->waitForElementVisible('#actions .dropdown-menu a[data-action="delete"]');
        $I->click('#actions .dropdown-menu a[data-action="delete"]');

        $I->waitForElementVisible('#modal-dialog');
        $I->see("Удалить выбранные?");
        $I->click('#modal-dialog .button-ok');

        $I->waitForElement('.alert.alert-success');
        $I->see("Категории удалены");
    }


    public function TableMenuTest(Admin $I)
    {
        $I->Signin();

        $menuNumber = 1;
        while($menuNumber < 12)
        {
            $I->createMenu("Меню " . $menuNumber++);
        }

        $I->click(".menu-open > li:nth-child(1) > a");
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);

        $I->click('li.paginate_button [data-dt-idx="2"]');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 6);

        $I->click('li.paginate_button [data-dt-idx="1"]');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);

        $I->click('#example1_next a');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 6);

        $I->click('#example1_previous a');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);

        $I->click('tbody input[value="29"]');
        $I->click('tbody input[value="28"]');
        $I->click('tbody input[value="27"]');

        $I->click('#actions > button.dropdown-toggle');
        $I->waitForElementVisible('#actions .dropdown-menu a[data-action="delete"]');
        $I->click('#actions .dropdown-menu a[data-action="delete"]');

        $I->waitForElementVisible('#modal-dialog');
        $I->see("Удалить выбранные?");
        $I->click('#modal-dialog .button-ok');

        $I->waitForElement('.alert.alert-success');
        $I->see("Меню удалены");
    }


    public function TablePackageTest(Admin $I)
    {
        $I->Signin();

        $packageNumber = 1;
        while($packageNumber < 12)
        {
            $I->createPackage("Пакет " . $packageNumber++);
        }

        $I->click(".menu-open > li:nth-child(1) > a");
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);

        $I->click('li.paginate_button [data-dt-idx="2"]');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 2);

        $I->click('li.paginate_button [data-dt-idx="1"]');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);

        $I->click('#package-table_next a');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 2);

        $I->click('#package-table_previous a');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);

        $I->click('tbody input[value="8"]');
        $I->click('tbody input[value="7"]');
        $I->click('tbody input[value="6"]');

        $I->click('#actions > button.dropdown-toggle');
        $I->waitForElementVisible('#actions .dropdown-menu a[data-action="delete"]');
        $I->click('#actions .dropdown-menu a[data-action="delete"]');

        $I->waitForElementVisible('#modal-dialog');
        $I->see("Удалить выбранные?");
        $I->click('#modal-dialog .button-ok');

        $I->waitForElement('.alert.alert-success');
        $I->see("Пакеты удалены");
    }


    public function TableBannerTest(Admin $I)
    {
        $I->Signin();

        $bannerNumber = 1;
        while($bannerNumber < 12)
        {
            $I->createBanner("Баннер " . $bannerNumber++);
        }

        $I->click(".menu-open > li:nth-child(1) > a");
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);

        $I->click('li.paginate_button [data-dt-idx="2"]');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 1);

        $I->click('li.paginate_button [data-dt-idx="1"]');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);

        $I->click('#example1_next a');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 1);

        $I->click('#example1_previous a');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);

        $I->click('tbody input[value="8"]');
        $I->click('tbody input[value="7"]');
        $I->click('tbody input[value="6"]');

        $I->click('#actions > button.dropdown-toggle');
        $I->waitForElementVisible('#actions .dropdown-menu a[data-action="delete"]');
        $I->click('#actions .dropdown-menu a[data-action="delete"]');

        $I->waitForElementVisible('#modal-dialog');
        $I->see("Удалить выбранные?");
        $I->click('#modal-dialog .button-ok');

        $I->waitForElement('.alert.alert-success');
        $I->see("Баннеры удалены");
    }


    public function TablePromocodeTest(Admin $I)
    {
        $I->Signin();

        $promocodeSetNumber = 1;
        while($promocodeSetNumber < 12)
        {
            $I->createPromocode("Набор " . $promocodeSetNumber++, '0.3');
        }

        $I->click(".menu-open > li:nth-child(1) > a");
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);

        $I->click('li.paginate_button [data-dt-idx="2"]');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 1);

        $I->click('li.paginate_button [data-dt-idx="1"]');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);

        $I->click('#promocode-table_next a');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 1);

        $I->click('#promocode-table_previous a');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);

        $I->click('tbody input[value="8"]');
        $I->click('tbody input[value="7"]');
        $I->click('tbody input[value="6"]');

        $I->click('#actions > button.dropdown-toggle');
        $I->waitForElementVisible('#actions .dropdown-menu a[data-action="delete"]');
        $I->click('#actions .dropdown-menu a[data-action="delete"]');

        $I->waitForElementVisible('#modal-dialog');
        $I->see("Удалить выбранные?");
        $I->click('#modal-dialog .button-ok');

        $I->waitForElement('.alert.alert-success');
        $I->see("Наборы удалены");
    }


    public function TablePackageVariantTest(Admin $I)
    {
        $I->Signin();

        $I->createPackage('тестовый пакет');

        $I->click(".menu-open > li:nth-child(1) > a");
        $I->waitForElement('a[href="/admin/packages/edit?id=2"]');
        $I->click('a[href="/admin/packages/edit?id=2"]');
        $I->see("Редактор пакета");

        $variantNumber = 1;
        while($variantNumber < 12)
        {
            $I->createPackageVariant("Вариант " . $variantNumber++);
        }

        $I->click(".menu-open > li:nth-child(1) > a");
        $I->waitForElement('a[href="/admin/packages/edit?id=2"]');
        $I->click('a[href="/admin/packages/edit?id=2"]');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);

        $I->click('li.paginate_button [data-dt-idx="2"]');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 1);

        $I->click('li.paginate_button [data-dt-idx="1"]');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);

        $I->click('#variants-table_next a');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 1);

        $I->click('#variants-table_previous a');
        $I->waitForElement("tbody tr");
        $I->seeNumberOfElements('tbody tr', 10);

        $I->click('tbody input[value="8"]');
        $I->click('tbody input[value="7"]');
        $I->click('tbody input[value="6"]');

        $I->click('#actions > button.dropdown-toggle');
        $I->waitForElementVisible('#actions .dropdown-menu a[data-action="delete_variants"]');
        $I->click('#actions .dropdown-menu a[data-action="delete_variants"]');

        $I->waitForElementVisible('#modal-dialog');
        $I->see("Удалить выбранные?");
        $I->click('#modal-dialog .button-ok');

        $I->waitForElement('.alert.alert-success');
        $I->see("Варианты удалены");
    }



    public function EditCategoryTest(Admin $I)
    {
        $I->Signin();

        $I->amOnPage('/admin/');
        $I->click('.sidebar-menu > li.treeview:nth-child(3) span');
        $I->waitForElement(".menu-open > li:nth-child(4) > a");
        $I->click(".menu-open > li:nth-child(4) > a");

        $I->fillField(['name' => 'name'], 'тестовая категория');

        $I->click('.btn.btn-info');
        $I->waitForElement('.alert.alert-success');
        $I->see("Категория сохранена");
        $I->seeInField('input[name="name"]', "тестовая категория");
    }


    public function EditPageTest(Admin $I)
    {
        $I->Signin();
        $I->createCategory("тестовая категория");

        $I->amOnPage('/admin/');
        $I->click('.sidebar-menu > li.treeview:nth-child(3) span');
        $I->waitForElement(".menu-open > li:nth-child(2) > a");
        $I->click(".menu-open > li:nth-child(2) > a");

        $I->fillField(['name' => 'name'], "тестовая страница");
        $I->fillField(['name' => 'url'], "testpage");
        $I->selectOption('select[name="category_id"]', "тестовая категория");

        $I->click('.btn.btn-primary');
        $I->waitForElement('.alert.alert-success');
        $I->see("Страница сохранена");
        $I->seeInField('input[name="name"]', "тестовая страница");
        $I->seeInField('input[name="url"]', "testpage");
        $I->seeOptionIsSelected('select[name="category_id"]', "тестовая категория");
    }



    public function EditPackageTest(Admin $I)
    {
        $I->Signin();
        $I->amOnPage('/admin/');
        $I->click('.sidebar-menu > li.treeview:nth-child(4) span');
        $I->waitForElement(".menu-open > li:nth-child(2) > a");
        $I->click(".menu-open > li:nth-child(2) > a");
        $I->fillField(['name' => 'name'], "Тестовый пакет");
        $I->click('.btn.btn-info');
        $I->waitForElement('.alert.alert-success');
        $I->see("Пакет сохранен");

        $I->seeInField('input[name="name"]', "Тестовый пакет");
    }


    public function EditBannerTest(Admin $I)
    {
        $I->Signin();
        $I->amOnPage('/admin/');
        $I->click('.sidebar-menu > li.treeview:nth-child(5) span');
        $I->waitForElement(".menu-open > li:nth-child(2) > a");
        $I->click(".menu-open > li:nth-child(2) > a");
        $I->fillField(['name' => 'name'], 'тестовый баннер');
        $I->fillField(['name' => 'order'], 1);
        $I->fillField(['name' => 'url'], 'bannerurl');
        // файл находится в 'tests/_data/'
        $I->attachFile(['name' => 'banner_file'], '900x900.jpg');
        $I->click('.btn.btn-info');
        $I->waitForElement('.alert.alert-success');
        $I->see("Баннер сохранен");
    }


    public function EditPromocode(Admin $I)
    {
        $I->Signin();
        $I->amOnPage('/admin/');
        $I->click('.sidebar-menu > li.treeview:nth-child(6) span');
        $I->waitForElement(".menu-open > li:nth-child(2) > a");
        $I->click(".menu-open > li:nth-child(2) > a");
        $I->fillField(['name' => 'name'], "тестовый набор");
        $I->fillField(['name' => 'discount'], "0.3");
        $I->click('.btn.btn-info');

        $I->waitForElement('.alert.alert-success');
        $I->see("Набор сохранен");
    }


    public function EditMenuTest(Admin $I)
    {
        $I->Signin();
        $I->amOnPage('/admin/');
        $I->click('.sidebar-menu > li.treeview:nth-child(7) span');
        $I->waitForElement(".menu-open > li:nth-child(2) > a");
        $I->click(".menu-open > li:nth-child(2) > a");

        $I->fillField(['name' => 'name'], "тестовое меню");

        $I->click('.btn.btn-primary');

        $I->waitForElement('.alert.alert-success');
        $I->see("Меню сохранено");
    }

    public function EditMailingTest(Admin $I)
    {
        $I->Signin();
        $I->amOnPage('/admin/');
        $I->createMailingTemplate('тестовый шаблон');
        $I->click('.treeview:nth-child(8) span');
        $I->waitForElement(".menu-open > li:nth-child(2) > a");
        $I->click(".menu-open > li:nth-child(2) > a");
        $I->fillField(['name' => 'name'], "тестовая рассылка");
        $I->selectOption(['name' => 'template_id'], "тестовый шаблон");
        $I->click('.btn.btn-info');
        $I->waitForElement('.alert.alert-success');
        $I->see("Рассылка сохранена");
    }


    public function EditMailingTemplateTest(Admin $I)
    {
        $I->Signin();
        $I->amOnPage('/admin/');
        $I->click('.sidebar-menu > li.treeview:nth-child(8) span');
        $I->waitForElement(".menu-open > li:nth-child(4) > a");
        $I->click(".menu-open > li:nth-child(4) > a");
        $I->fillField(['name' => 'name'], "тестовый шаблон");
        $I->click('.btn.btn-primary');
        $I->waitForElement('.alert.alert-success');
        $I->see("Шаблон сохранен");

    }



    public function EditGroupTest(Admin $I)
    {
        $I->Signin();
        $I->amOnPage('/admin/');
        $I->click('.sidebar-menu > li.treeview:nth-child(2) span');
        $I->waitForElement(".menu-open > li:nth-child(4) > a");
        $I->click(".menu-open > li:nth-child(4) > a");
        $I->fillField(['name' => 'name'], "Группа 1");
        $I->click('Сохранить');
        $I->waitForElement('.alert.alert-success');
        $I->see("Успешно сохранено");
    }


    public function EditUserTest(Admin $I)
    {
        $I->Signin();
        $I->amOnPage('/admin/');

        $I->click('.sidebar-menu > li.treeview:nth-child(2) span');
        $I->waitForElement(".menu-open > li:nth-child(2) > a");
        $I->click(".menu-open > li:nth-child(2) > a");

        $client = Fixtures::get('client');

        $I->fillField(['name' => 'family'], $client['family'] );
        $I->fillField(['name' => 'firstname'], $client['firstname'] );
        $I->fillField(['name' => 'lastname'], $client['lastname'] );
        $I->fillField(['name' => 'email'], $client['email'] );
        $I->fillField(['name' => 'password'], $client['password'] );
        $I->fillField(['name' => 'confirm'], $client['password'] );

        $I->click('Сохранить');
        $I->waitForElement('.alert-success');
        $I->see("Пользователь сохранен");
    }

    public function EditMenuItemTest(Admin $I)
    {
        $I->Signin();
        $I->createMenu("тестовое меню");

        $I->amOnPage('/admin/');

        $I->click('.sidebar-menu > li.treeview:nth-child(7) span');
        $I->waitForElement(".menu-open > li:nth-child(1) > a");
        $I->click(".menu-open > li:nth-child(1) > a");
        $I->see("тестовое меню");
    }


    public function FilterUser(Admin $I)
    {
        $I->Signin();

        $I->createUser(
            'Пирожков',
            'Артур',
            'Сергеевич',
            "pirojkov@mail.ru",
            '+78338686555',
            "Администратор",
            "1"
        );

        $I->createUser(
            'Экспертов',
            'Эксперт',
            'Экспертович',
            "expertov@mail.ru",
            '+79998686778',
            "Эксперт",
            "1"
        );

        $I->createUser(
            'Клиентов',
            'Клиент',
            'Клиентович',
            "clientov@mail.ru",
            '+79068686776',
            "Клиент",
            "1"
        );

        $I->amOnPage('/admin/');
        $I->click('.sidebar-menu > li.treeview:nth-child(2) span');
        $I->waitForElement(".menu-open > li:nth-child(1) > a");
        $I->click(".menu-open > li:nth-child(1) > a");

        $I->fillField(['name' => "phone"], "+79068686776");
        $I->click("Применить");
        $I->waitForElement("tbody tr");
        $I->see("Клиентов");
        $I->dontSee("Экспертов");
        $I->dontSee("Пирожков");
        $I->fillField(['name' => "phone"], "+79998686778");
        $I->click("Применить");
        $I->waitForElement("tbody tr");
        $I->see("Экспертов");
        $I->dontSee("Клиентов");
        $I->dontSee("Пирожков");

        $I->fillField(['name' => "phone"], "");

        $I->fillField(['name' => "registration"], "01/07/2020 - 01/08/2020");
        $I->click("Применить");
        $I->dontSee("Клиентов");
        $I->dontSee("Пирожков");

        $I->fillField(['name' => "registration"], "01/07/2020 - 01/08/2021");
        $I->click("Применить");
        $I->see("Клиентов");
        $I->see("Пирожков");


    }

}
