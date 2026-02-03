<?php
namespace Project\Controllers;
use Core\Controller;

class NumController extends Controller
{
public function sum($params)
{
    $n1 = (float)($params['n1'] ?? 0);
    $n2 = (float)($params['n2'] ?? 0);
    $n3 = (float)($params['n3'] ?? 0);
    $sum = $n1 + $n2 + $n3;

    $this->title = 'Сумма трёх чисел';

    return $this->render('num/sum', [
        'n1'  => $n1,
        'n2'  => $n2,
        'n3'  => $n3,
        'sum' => $sum,
    ]);
}
}