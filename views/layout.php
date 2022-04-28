<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon super site</title>
    <link rel="stylesheet" href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'style.css' ?>">
</head>
<body>
    <nav>
        

            <a href="/site_poo/">Blog</a>
            <li>
                <a href="/site_poo/">Accueil</a>
            </li>
            <li>
            <a href="/site_poo/posts/">Les derniers articles</a>
            </li>

            <ul>
                <?php if(isset($_SESSION['auth'])) : ?>
                <li>
                    <a href="/site_poo/logout">Se déconnecter</a>
                </li>
                <?php endif ?>
            </ul>

    </nav>
    <?= $content?>
</body>
</html>