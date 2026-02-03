<?php

declare(strict_types=1);

namespace MyProject\Classes;

/**
 * Класс обычного пользователя.
 */
class User extends AbstractUser
{
    /** @var string Имя пользователя */
    public string $name;

    /** @var string Логин пользователя */
    public string $login;

    /** @var string Пароль пользователя (приватный) */
    private string $password;

    /** @var int Статический счётчик экземпляров класса User */
    public static int $userCount = 0;

    /**
     * Конструктор класса User.
     *
     * @param string $name Имя пользователя
     * @param string $login Логин пользователя
     * @param string $password Пароль пользователя
     */
    public function __construct(string $name, string $login, string $password)
    {
        $this->name = $name;
        $this->login = $login;
        $this->password = $password;
        
        if (static::class === self::class) {
            self::$userCount++;
        }
        // self::$userCount++;
    }

    /**
     * Выводит информацию о пользователе.
     *
     * @return void
     */
    public function showInfo(): void
    {
        echo "Имя пользователя: {$this->name}<br>Логин: {$this->login}<br>";
    }

    /**
     * Деструктор класса User.
     */
    public function __destruct()
    {
        echo "Пользователь {$this->login} удален.<br>";
    }

    /**
     * Возвращает пароль.
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}