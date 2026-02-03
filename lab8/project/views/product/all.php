<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Категория</th>
            <th>Цена ($)</th>
            <th>Количество</th>
            <th>Стоимость ($)</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['products'] as $id => $product): ?>
        <tr>
            <td><?= $id ?></td>
            <td><?= htmlspecialchars($product['name']) ?></td>
            <td><?= htmlspecialchars($product['category']) ?></td>
            <td><?= $product['price'] ?></td>
            <td><?= $product['quantity'] ?></td>
            <td><?= $product['price'] * $product['quantity'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>