<?php

declare(strict_types=1);

// require_once __DIR__ . '/User.php';

namespace MyProject\Classes;

/**
 * Класс суперпользователя, наследуется от User и реализует SuperUserInterface.
 */
class SuperUser extends User implements SuperUserInterface
{
    /** @var string Роль суперпользователя */
    public string $role;

    /** @var int Статический счётчик экземпляров класса SuperUser */
    public static int $superUserCount = 0;

    /**
     * Конструктор класса SuperUser.
     *
     * @param string $name Имя пользователя
     * @param string $login Логин пользователя
     * @param string $password Пароль пользователя
     * @param string $role Роль суперпользователя
     */
    public function __construct(string $name, string $login, string $password, string $role)
    {
        parent::__construct($name, $login, $password);
        $this->role = $role;
        self::$superUserCount++;
    }

    /**
     * Переопределённый метод для вывода информации о суперпользователе.
     *
     * @return void
     */
    public function showInfo(): void
    {
        echo "Суперпользователь: {$this->name}<br>Логин: {$this->login}<br>Роль: {$this->role}<br>";
    }

    /**
     * Реализация метода интерфейса: возвращает ассоциативный массив свойств.
     *
     * @return array<string, string>
     */
    public function getInfo(): array
    {
        return [
            'name' => $this->name,
            'login' => $this->login,
            'password' => $this->getPassword(),
            'role' => $this->role,
        ];
    }
}