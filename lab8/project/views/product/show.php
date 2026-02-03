<?php $product = $data['product']; ?>
<h1>Продукт "<?= htmlspecialchars($product['name']) ?>" из категории "<?= htmlspecialchars($product['category']) ?>"</h1>
<p>
	Цена: <?= $product['price'] ?>$, количество: <?= $product['quantity'] ?>
</p>
<p>
	Стоимость (цена * количество): <?= $product['price'] * $product['quantity'] ?>$
</p>