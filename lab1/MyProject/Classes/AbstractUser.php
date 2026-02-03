<?php

declare(strict_types=1);

namespace MyProject\Classes;

/**
 * Абстрактный класс для всех пользователей.
 */
abstract class AbstractUser
{
    /**
     * Абстрактный метод для отображения информации о пользователе.
     *
     * @return void
     */
    abstract public function showInfo(): void;
}
