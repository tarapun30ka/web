<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		 <link rel="stylesheet" href="/project/webroot/styles.css">
		<title><?= $title ?></title>
	</head>
	<body>
		<header>
			 <img src="/project/webroot/logo.png" alt="Логотип" style="height: 150px; vertical-align: middle;">
			хедер сайта
		</header>
		<div class="container">
			<aside class="sidebar left">
				левый сайдбар
			</aside>
			<main>
				<?= $content ?>
			</main>
			<aside class="sidebar right">
				правый сайдбар
			</aside>
		</div>
		<footer>
			футер сайта
		</footer>
	</body>
</html>