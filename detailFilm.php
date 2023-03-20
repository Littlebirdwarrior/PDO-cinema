
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>details des films</title>
    <link rel="stylesheet" href="styles.css"></link>
</head>
<!----------->
<body>
<header>
    <h1>details des films</h1>
</header>

<?php

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
                film.synopsis_film,
                film.note_film,
                film.affiche_film,
                personne.prenom_personne,
                personne.nom_personne
            FROM
            film
                INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
                INNER JOIN personne ON realisateur.id_personne = personne.id_personne 
            WHERE id_film = :id   
                ';

$filmStatement = $db->prepare($sqlQuery);

$filmStatement->execute([
"id"=>1
]);

$films = $filmStatement->fetchAll();

// Chargement automatique des classes

//spl_autoload_register(function ($class_name){
//    require str_replace("\\","/", $class_name) . ".php";
//});

//afficher les films
function detailFilm($films){
    echo '<section>';
    //boucle
    foreach($films as $film){
        echo '
         <div>
            <div>
                <h2>'.$film['titre_film'].'</h2>
                <figure>
                <img src="'.$film['affiche_film'].'" alt="affiche '.$film['titre_film'].'" width="100px" height="138px"/>
                </figure>  
            </div>
            <div>
                <ul>
                    <li>Note: '.$film['note_film'].'</li>
                    <li>Année de sortie: '.$film['annee_sortie_film'].'</li>
                    <li>Réaliser par : '.$film['prenom_personne'].' '.$film['nom_personne'].'</li>
                    <li>Avec : </li>
                    <li>Durée: '.$film['duree_film'].'</li>
                    <li>Synopsis : '.$film['synopsis_film'].'</li>
                </ul>
            </div>
        </div>
        ';
    }
    echo '</section>';
}

//?>

<!---->

<main>
    <?php
    detailFilm($films);
    ?>

</main>

</body>
</html>

