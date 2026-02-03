<?php

declare(strict_types=1);

use MyProject\Classes\User;
use MyProject\Classes\SuperUser;

spl_autoload_register(function (string $class): void {
    $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

$user1 = new User('Иван', 'ivan123', 'pass1');
$user2 = new User('Петр', 'petr456', 'pass2');
$user3 = new User('Александр', 'sasha789', 'pass3');



$superUser = new SuperUser('Супер пользователь', 'super_user', 'super_user_pass', 'Администратор');

$user1->showInfo();
$user2->showInfo();
$user3->showInfo();
echo "<br>";
$superUser->showInfo();
echo "<br>";


print_r($superUser->getInfo());
echo "<br>";

echo "<br>Всего обычных пользователей: " . User::$userCount . "<br>";
echo "Всего супер-пользователей: " . SuperUser::$superUserCount . "<br>";

echo "<br>";
