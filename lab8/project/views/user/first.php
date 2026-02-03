<h2>Первые <?= $data['n'] ?> пользователей</h2>
<?php if (!empty($data['message'])): ?>
    <p><em><?= htmlspecialchars($data['message']) ?></em></p>
<?php endif; ?>
<pre><?= htmlspecialchars(print_r($data['users'], true)) ?></pre>