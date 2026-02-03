<?php
namespace Project\Controllers;
use Core\Controller;

class TestController extends Controller
{
    public function act1()
    {
        $this->title = 'Действие act1';
        return $this->render('test/act1');
    }

    public function act2()
    {
        $this->title = 'Действие act2';
        return $this->render('test/act2');
    }

    public function act3()
    {
        $this->title = 'Действие act3';
        return $this->render('test/act3');
    }
}

// <?php
// namespace Project\Controllers;
// use Core\Controller;

// class TestController extends Controller
// {
// 	public function act()
// 	{
// 		// Зададим тайтл:
// 		$this->title = 'Действие act контроллера test';

// 		// Отрендерим представление, передав какие-то данные:
// 		return $this->render('test/act', [
// 			'var1' => 'eee',
// 			'var2' => 'bbb',
// 			'var3' => 'kkk',
// 		]);
// 	}
// }
// ?>