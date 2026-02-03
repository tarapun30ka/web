<?php
namespace Factory\Models;
// require_once __DIR__ . '/collection.php';

class Users extends Collection
{
    public function __construct(public ?array $users = null)
    {
        $users ??= [
            new User(
                 'dmitry.koterov@gmail.com',
                 'password',
                 'Дмитрий',
                 'Котеров'),
            new User(
                 'igorsimdyanov@gmail.com',
                 'password',
                 'Игорь',
                 'Симдянов'),            
            
            new User(
                 'user1@gmail.com',
                 'password1',
                 'User1',
                 'Surname1'),
            new User(
                 'user2@gmail.com',
                 'password2',
                 'User2',
                 'Surname2'),            
            new User(
                 'user3@gmail.com',
                 'password3',
                 'User3',
                 'Surname3'),
            new User(
                 'user4@gmail.com',
                 'password4',
                 'User4',
                 'Surname4'),
            new User(
                 'user5@gmail.com',
                 'password5',
                 'User5',
                 'Surname5'),
        ];
        parent::__construct($users);
    }
}
