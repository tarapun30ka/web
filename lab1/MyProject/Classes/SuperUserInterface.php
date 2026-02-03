<?php

declare(strict_types=1);

namespace MyProject\Classes;

/**
 * Интерфейс для суперпользователей.
 */
interface SuperUserInterface
{
    /**
     * Возвращает ассоциативный массив со свойствами объекта.
     *
     * @return array<string, string>
     */
    public function getInfo(): array;
}