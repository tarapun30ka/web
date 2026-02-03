<h1><?= htmlspecialchars($data['h1']) ?></h1>
<div id="content">
    <p><strong>Категория:</strong> <?= htmlspecialchars($data['products']['category']) ?></p>
    <p><strong>Цена:</strong> <?= $data['products']['price'] ?>$</p>
    <p><strong>Количество:</strong> <?= $data['products']['quantity'] ?></p>
    <p><strong>Описание:</strong> <?= htmlspecialchars($data['products']['description']) ?></p>
    <p><strong>Стоимость (цена * количество):</strong> 
       <?= $data['products']['price'] * $data['products']['quantity'] ?>$
    </p>
</div>