<?php
/**
 * Here you can initialize variables via \Codeception\Util\Fixtures class
 * to store data in global array and use it in Cepts.
 *
 * ```php
 * // Here _bootstrap.php
 * \Codeception\Util\Fixtures::add('user1', ['name' => 'davert']);
 * ```
 *
 * In Cept
 *
 * ```php
 * \Codeception\Util\Fixtures::get('user1');
 * ```
 */

use Codeception\Util\Fixtures;

Fixtures::add('admin', [
    'firstname' => 'Админ',
    'family' => 'Админов',
    'lastname' => 'Админович',
    'email' => 'admin@mail.ru',
    'password' => '1',
]);

Fixtures::add('client', [
    'firstname' => 'Клиент',
    'family' => 'Клиентов',
    'lastname' => 'Клиентович',
    'email' => 'testmailbox_1@inbox.ru',
    'password' => '1',
]);

Fixtures::add('expert', [
    'firstname' => 'Эксперт',
    'family' => 'Экспертов',
    'lastname' => 'Экспертович',
    'email' => 'testmailbox_2@inbox.ru',
    'password' => '1',
]);