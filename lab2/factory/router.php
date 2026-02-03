<?php

namespace Factory;

abstract class Router
{
    public static function parse(string $url): mixed
    {
        $arr = explode('/', $url);
        // $modelName = ucfirst($arr[0]); // 'Users'
        // $filePath = __DIR__ . '/models/' . strtolower($modelName) . '.php'; // 'models/users.php'

        // if (!file_exists($filePath)) {
        //     throw new \Exception("Файл модели не найден: " . $filePath);
        // }
        // require_once $filePath;
        $class = 'Factory\\Models\\' . ucfirst($arr[0]);

        // $fullClassName = 'Factory\\Models\\' . $modelName;
        $obj = new $class();

        $id = $arr[1] ?? null;
        return $id === null ? $obj : $obj->collection[$id];
    }

    abstract public function render();
}