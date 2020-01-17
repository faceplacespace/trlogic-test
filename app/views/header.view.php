<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?= $title ?></title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i"
          rel="stylesheet">
    <link href="../public/assets/css/main.css" rel="stylesheet">
</head>

<body>
<header>
    <div class="lang">
        <a href="<?= parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?>?lang=ru"
            <?php if ($_SESSION['lang'] === 'ru') echo 'class="active"' ?>>RU</a>
        <a href="<?= parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?>?lang=en"
            <?php if ($_SESSION['lang'] === 'en') echo 'class="active"' ?>>EN</a>
    </div>
    <?php if (isset($_SESSION['user'])): ?>
        <a href="/logout" class="logout"><?= $this->dict['logout'] ?></a>
    <?php endif; ?>
</header>