
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exercice cinema</title>
    <link rel="stylesheet" href="styles.css"></link>
</head>
<!----------->
<body>
<header>
    <h1>Exercice cinéma</h1>
</header>

<?php

//Chargement de la BDD
try {
    $db = new PDO(
        'mysql:host=localhost;dbname=cinema;charset=utf8',
        'root',
        'root'
    );

}catch (Exception $e){
    die('Erreur :'.$e->getMessage());
}

/*
 * Lorsque votre site sera en ligne, vous aurez sûrement un nom d'hôte différent, ainsi qu'un identifiant et un mot de passe, comme ceci :
 * <?php
    $db = new PDO('mysql:host=sql.hebergeur.com;dbname=mabase;charset=utf8', 'pierre.durand', 's3cr3t');
    ?>*/



$filmStatement = $db->prepare('SELECT * FROM film');

$filmStatement->execute();

$films = $filmStatement->fetchAll();

// Chargement automatique des classes

//spl_autoload_register(function ($class_name){
//    require str_replace("\\","/", $class_name) . ".php";
//});

//$realisateurs = [
//    [
//        'nom'=>'Allen',
//        'prenom'=> 'Woody',
//        'sexe'=>'1936'
//    ],
//    [
//        'nom'=>'Streep',
//        'prenom'=> 'Meryl',
//        'sexe'=>'1946'
//    ],
//];
//
//$films = [
//    [
//        'titre'=>'Manhattan',
//        'annee'=> '1979',
//        'duree'=>'96',
//        'realisateur'=> $realisateurs[0]
//    ],
//    [
//        'titre'=>'Kramer contre Kramer',
//        'annee'=>'1979',
//        'duree'=>'105',
//        'realisateur'=> $realisateurs[1]
//    ],
//];
//
//
//
//

function displayFilm($films){
    foreach ($films as $film){
        //lire le realisateur

        //affichage
        echo '<tr>
                   <td>'.$film['titre_film'].'</td>
                   <td>'.$film['annee_sortie_film'].'</td>
                   <td>'.$film['duree_film'].'</td>
               </tr>
        ';
    }
}
//
//
//?>
<!---->

<main>
    <section>
        <h2>Mes films</h2>
        <div>
            <table>
                <thead>
                <tr>
                    <th>Titre</th>
                    <th>Année</th>
                    <th>Durée</th>
                    <th>Réalisateur</th>
                </tr>
                </thead>
                <tbody>

                    <?php
                    displayFilm($films);
                    ?>

                </tbody>
            </table>
        </div>
    </section>


</main>

</body>
</html>