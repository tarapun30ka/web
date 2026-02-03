<?php
namespace Project\Controllers;
use Core\Controller;
use \Project\Models\Page;

class PageController extends Controller
{
    private $pages = [
        1 => ['title' => 'страница 1', 'text' => 'текст страницы 1'],
        2 => ['title' => 'страница 2', 'text' => 'текст страницы 2'],
        3 => ['title' => 'страница 3', 'text' => 'текст страницы 3'],
    ];

    // /page/:id/
    public function show($params)
    {
        $id = (int) ($params['id'] ?? 0);

        $pageModel = new Page();
        $page = $pageModel->getById($id);

        if (!$page) {
            $this->title = 'Страница не найдена';
            // echo "Страница с ID $id не существует.";
            return $this->render('errors/not_found', [
                'message' => "Страница с ID $id не существует."
            ]);
        }


        $this->title = $page['title'];

        return $this->render('page/show', [
            'title' => $page['title'],
            'text' => $page['text'],
        ]);

        // if (!isset($this->pages[$id])) {
        //     $this->title = 'Страница не найдена';
        //     echo "Страница с ID $id не существует.";
        //     return;
        // }

        // $page = $this->pages[$id];

        // // Заголовок страницы = title из данных
        // $this->title = $page['title'];

        // return $this->render('page/show', [
        //     'title' => $page['title'],
        //     'text' => $page['text'],
        // ]);
    }

    public function one($params)
    {
        $page = (new Page)->getById($params['id']);

        $this->title = $page['title'];
        return $this->render('page/one', [
            'text' => $page['text'],
            'h1' => $this->title
        ]);
    }

    public function all()
    {
        $this->title = 'Список всех страниц';

        $pages = (new Page)->getAll();
        return $this->render('page/all', [
            'pages' => $pages,
            'h1' => $this->title
        ]);
    }

    // public function test()
    // {
    //     $page = new Page; // создаем объект модели

    //     $data = $page->getById(3); // получим запись с id=3
    //     var_dump($data);

    //     $data = $page->getById(5); // получим запись с id=5
    //     var_dump($data);

    //     $data = $page->getByRange(2, 5); // записи с id от 2 до 5
    //     var_dump($data);
    // }

    public function test()
    {
        $pageModel = new Page();

        $this->title = 'Тест модели Page';

        return $this->render('page/test', [
            'page3' => $pageModel->getById(3),
            'page5' => $pageModel->getById(5),
            'range' => $pageModel->getByRange(2, 5),
        ]);
    }
}





// namespace Project\Controllers;
// use \Core\Controller;

// class PageController extends Controller
// {
//     public function show1()
//     {
//         echo '1';
//     }

//     public function show2()
//     {
//         echo '2';
//     }
// }