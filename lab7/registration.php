<?php
session_start();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['images_enabled'])) {
        $_SESSION['message'] = 'Упс! Изображения отключены в вашем браузере. Пожалуйста, включите отображение изображений.';
        $_SESSION['messageType'] = 'warning';
    } else {
        $userAnswer = isset($_POST['answer']) ? trim($_POST['answer']) : '';
        $userAnswer = strtoupper($userAnswer);
        $correctAnswer = $_SESSION['captcha_string'] ?? null;
            unset($_SESSION['captcha_string']);


        if ($userAnswer === '') {
            $_SESSION['message'] = 'Пожалуйста, введите символы с изображения.';
            $_SESSION['messageType'] = 'error';
        } elseif ($userAnswer === $correctAnswer) {
            $_SESSION['message'] = 'Еееееее! Вы правильно ввели символы с изображения.';
            $_SESSION['messageType'] = 'success';

        } else {
            $_SESSION['message'] = 'Неверно! Попробуйте ещё раз.';
            $_SESSION['messageType'] = 'error';
        }
    }

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

$message = $_SESSION['message'] ?? '';
$messageType = $_SESSION['messageType'] ?? '';

if ($message !== '') {
    unset($_SESSION['message'], $_SESSION['messageType']);
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <title>Регистрация</title>
    <style>
        .message {
            padding: 10px;
            margin: 15px 0;
            border-radius: 4px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
        }

        .warning {
            background-color: #fff3cd;
            color: #856404;
        }
    </style>
</head>

<body>
    <h1>Регистрация</h1>
    <form action="" method="post">
        <div>
            <img src="noise-picture.php?v=<?= time() ?>">
        </div>
        <div>
            <label>Введите строку</label>
            <input type="text" name="answer" size="6">
        </div>
        <input type="submit" value="Подтвердить">
    </form>
    <?php if ($message !== ''): ?>
        <div class="message <?= htmlspecialchars($messageType) ?>">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>
</body>

</html>