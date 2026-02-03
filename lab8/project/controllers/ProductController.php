<?php
namespace Project\Controllers;
use Core\Controller;
use Project\Models\Product;

class ProductController extends Controller
{
    private $products = [
        1 => [
            'name' => 'product1',
            'price' => 100,
            'quantity' => 5,
            'category' => 'category1',
        ],
        2 => [
            'name' => 'product2',
            'price' => 200,
            'quantity' => 6,
            'category' => 'category2',
        ],
        3 => [
            'name' => 'product3',
            'price' => 300,
            'quantity' => 7,
            'category' => 'category2',
        ],
        4 => [
            'name' => 'product4',
            'price' => 400,
            'quantity' => 8,
            'category' => 'category3',
        ],
        5 => [
            'name' => 'product5',
            'price' => 500,
            'quantity' => 9,
            'category' => 'category3',
        ],
    ];

    // /product/:n/
    public function show($params)
    {
        $id = (int) ($params['n'] ?? 0);
        if (!isset($this->products[$id])) {
            // echo "Товар с ID $id не найден.";
            // return;
            return $this->render('errors/not_found', [
                'message' => "Товар с ID $id не существует."
            ]);
        }

        $product = $this->products[$id];
        $this->title = "Товар: {$product['name']}";

        return $this->render('product/show', [
            'product' => $product,
            'id' => $id,
        ]);
    }

    public function all()
    {
        $this->title = 'Все товары';
        return $this->render('product/all', [
            'products' => $this->products,
        ]);
    }

    public function one($params)
    {
        $id = (int) ($params['id'] ?? 0);
        $product = (new Product)->getById($id);

        if (!$product) {
            $this->title = 'Товар не найден';
            // echo "Товар с ID $id не существует.";
            // return;
            return $this->render('errors/not_found', [
                'message' => "Товар с ID $id не существует."
            ]);
        }

        $this->title = 'Товар: ' . $product['name'];

        return $this->render('product/one', [
            'products' => $product,
            'h1' => $this->title,
        ]);
    }

    // /products/
    public function all_()
    {
        $this->title = 'Все товары';

        $products = (new Product)->getAll();

        return $this->render('product/all_', [
            'products' => $products,
            'h1' => $this->title,
        ]);
    }
}