<?php
use \Core\Route;

return [
	new Route('/hello/', 'hello', 'index'), // роут для приветственной страницы, можно удалить
	new Route('/my-page1/', 'page', 'show1'),
	new Route('/my-page2/', 'page', 'show2'),


	new Route('/test/act1', 'test', 'act1'),
	new Route('/test/act2', 'test', 'act2'),
	new Route('/test/act3', 'test', 'act3'),

	new Route('/nums/:n1/:n2/:n3/', 'num', 'sum'),

	new Route('/user/all/', 'user', 'all'),
	new Route('/user/first/:n/', 'user', 'first'),
	new Route('/user/:id/', 'user', 'show'),
	new Route('/user/:id/:key/', 'user', 'info'),

	new Route('/product/:n/', 'product', 'show'),
	new Route('/products/all/', 'product', 'all'),

	new Route('/page/test/', 'page', 'test'),
	new Route('/page/:id/', 'page', 'show'),

	new Route('/page/:id', 'page', 'one'),
	new Route('/pages/', 'page', 'all'),

	new Route('/products/:id/', 'product', 'one'),
	new Route('/products/', 'product', 'all_'),
];

