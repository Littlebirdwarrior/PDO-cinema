<!-- Template de base pour toutes les pages -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/styles.css" class="css">
    <!--icone--->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title><?=$titre?></title>
</head>
<body>
<header>
    <nav>
        <div class = "nav-logo">
            <p>PDO Cinema</p>
        </div>

        <div class = "nav-a">
        </div>
    </nav>
</header>
<div>
    <main>
        <div>
            <h2><?= $titre_secondaire ?></h2>
            <?= $contenu ?>
        </div>
    </main>
</div>
</body>
</html>