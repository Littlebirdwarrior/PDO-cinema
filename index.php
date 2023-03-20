
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

//// Chargement automatique des classes
//
//spl_autoload_register(function ($class_name){
//    require str_replace("\\","/", $class_name) . ".php";
//});

//Chargement de la BDD
$db = new PDO(
    'mysql:host=localhost;dbname=cinema;charset=utf8',
    'root',
    'root',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

/*
 * Lorsque votre site sera en ligne, vous aurez sûrement un nom d'hôte différent, ainsi qu'un identifiant et un mot de passe, comme ceci :
 * <?php
    $db = new PDO('mysql:host=sql.hebergeur.com;dbname=mabase;charset=utf8', 'pierre.durand', 's3cr3t');
    ?>*/

$sqlQuery = 'SELECT
                film.titre_film,
                film.annee_sortie_film,
                TIME_FORMAT(SEC_TO_TIME(film.duree_film * 60), "%H:%i") AS duree_film,
                personne.prenom_personne,
                personne.nom_personne
            FROM
            film
                INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
                INNER JOIN personne ON realisateur.id_personne = personne.id_personne';

$filmStatement = $db->prepare($sqlQuery);

$filmStatement->execute();

$films = $filmStatement->fetchAll();


//afficher les films
function displayFilm($films){
    echo '
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
    ';
    //boucle sur chaque film
    //a ajouter apres construction scession
    foreach ($films as $film){
        echo '<tr>
                   <td><a href="#">'.$film['titre_film'].'</a></td>
                   <td>'.$film['annee_sortie_film'].'</td>
                   <td>'.$film['duree_film'].'</td>
                   <td>'.$film['prenom_personne'].' '.$film['nom_personne'].'</td>
               </tr>
        ';
    }
    echo '
                    </tbody>
            </table>
        </div>
    </section>
    ';
}

//?>

<!--Affichage-->

<main>
    <?php
    displayFilm($films);
    ?>

</main>

</body>
</html>