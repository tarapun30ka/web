<h2>Страница с ID=3:</h2>
<?php if ($data['page3']): ?>
    <p><strong><?= htmlspecialchars($data['page3']['title']) ?></strong></p>
    <p><?= htmlspecialchars($data['page3']['text']) ?></p>
<?php else: ?>
    <p>Не найдена.</p>
<?php endif; ?>

<h2>Страница с ID=5:</h2>
<?php if ($data['page5']): ?>
    <p><strong><?= htmlspecialchars($data['page5']['title']) ?></strong></p>
    <p><?= htmlspecialchars($data['page5']['text']) ?></p>
<?php else: ?>
    <p>Не найдена.</p>
<?php endif; ?>

<h2>Страницы с ID от 2 до 5:</h2>
<?php if (!empty($data['range'])): ?>
    <ul>
        <?php foreach ($data['range'] as $page): ?>
            <li>
                <strong><?= htmlspecialchars($page['title']) ?></strong>: 
                <?= htmlspecialchars($page['text']) ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Нет страниц в диапазоне.</p>
<?php endif; ?>