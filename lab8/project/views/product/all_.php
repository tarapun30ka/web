<h1><?= htmlspecialchars($data['h1']) ?></h1>
<div id="content">
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Категория</th>
            <th>Цена ($)</th>
            <th>Количество</th>
            <th>Стоимость ($)</th>
            <th>Ссылка</th>
        </tr>
        <?php foreach ($data['products'] as $product): ?>
        <tr>
            <td><?= $product['id'] ?></td>
            <td><?= htmlspecialchars($product['name']) ?></td>
            <td><?= htmlspecialchars($product['category']) ?></td>
            <td><?= $product['price'] ?></td>
            <td><?= $product['quantity'] ?></td>
            <td><?= $product['price'] * $product['quantity'] ?></td>
            <td>
                <a href="/product/<?= $product['id'] ?>/">Просмотр</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>