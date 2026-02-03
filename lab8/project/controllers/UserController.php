<?php
namespace Project\Controllers;
use Core\Controller;

class UserController extends Controller
{
    private $users = [
        1 => ['name' => 'user1', 'age' => '23', 'salary' => 1000],
        2 => ['name' => 'user2', 'age' => '24', 'salary' => 2000],
        3 => ['name' => 'user3', 'age' => '25', 'salary' => 3000],
        4 => ['name' => 'user4', 'age' => '26', 'salary' => 4000],
        5 => ['name' => 'user5', 'age' => '27', 'salary' => 5000],
    ];

    // /user/:id/
    public function show($params)
    {
        $id = (int) ($params['id'] ?? 0);
        if (isset($this->users[$id])) {
            // echo "<pre>" . print_r($this->users[$id], true) . "</pre>";
            $this->title = 'Пользователь не найден';
            return $this->render('user/error', [
                'message' => "Пользователь с ID $id не найден."
            ]);
        }

        $this->title = "Пользователь #$id";
        return $this->render('user/show', [
            'id' => $id,
            'user' => $this->users[$id],
        ]);

        // else {
        //     echo "Пользователь с ID $id не найден.";
        // }
    }

    // /user/:id/:key/
    public function info($params)
    {
        $id = (int) ($params['id'] ?? 0);
        $key = $params['key'] ?? '';

        if (!isset($this->users[$id])) {
            // echo "Пользователь не найден.";
            // return;
            $this->title = 'Ошибка';
            return $this->render('user/error', [
                'message' => 'Пользователь не найден.'
            ]);
        }

        if (in_array($key, ['name', 'age', 'salary'])) {
            // echo "<strong>$key:</strong> " . $this->users[$id][$key];
            $this->title = "Инфо: $key (пользователь #$id)";
            return $this->render('user/info', [
                'key' => $key,
                'value' => $this->users[$id][$key],
            ]);
        }

        $this->title = 'Ошибка';
        return $this->render('user/error', [
            'message' => 'Недопустимый ключ. Используйте: name, age, salary.'
        ]);

        // else {
        //     echo "Недопустимый ключ. Используйте: name, age, salary.";
        // }
    }

    // /user/all/
    public function all()
    {
        // echo "<h2>Все пользователи:</h2>";
        // echo "<pre>" . print_r($this->users, true) . "</pre>";

        $this->title = 'Все пользователи';
        return $this->render('user/all', [
            'users' => $this->users,
        ]);
    }

    // /user/first/:n/
    public function first($params)
    {
        $n = (int) ($params['n'] ?? 0);
        $total = count($this->users);

        if ($n <= 0) {
            // echo "Количество пользователей должно быть больше нуля.";
            // return;

            $this->title = 'Ошибка';
            return $this->render('user/error', [
                'message' => 'Количество пользователей должно быть больше нуля.'
            ]);
        }

        if ($n > $total) {
            $message = "Запрошено $n, но в системе только $total пользователей. Показаны все доступные.";
            $users = $this->users;
        } else {
            $message = null;
            $users = array_slice($this->users, 0, $n, true);
        }

        $this->title = "Первые $n пользователей";
        return $this->render('user/first', [
            'n' => $n,
            'users' => $users,
            'message' => $message,
        ]);

        // if ($n > $total) {
        //     echo "<h2>Все пользователи (всего $total):</h2>";
        //     echo "<p><em>Запрошено $n, но в системе только $total пользователей. Показаны все доступные.</em></p>";
        //     $result = $this->users;
        // } else {
        //     echo "<h2>Первые $n пользователей:</h2>";
        //     $result = array_slice($this->users, 0, $n, true);
        // }

        // echo "<pre>" . print_r($result, true) . "</pre>";
    }
}