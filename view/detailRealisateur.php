<?php
//gere le traitements des requête realisateur
 ob_start();
?>

<section>
    <?php
    //définition de mes variables fetch

    $fetchReal = $requeteDetailReal->fetch(); //fetch, car je ne récupère qu'un seul id
    $fetchFilmographie = $requeteFilmographie->fetchAll(); //fetchAll, car je ne récupère plusieurs films pour un acteur

    echo '
    <div>
        <div>
        <figure>
        <img src="" alt=""/>
        </figure>
        </div>
        <div>
            <h2>'.$fetchReal['nomReal'].'</h2>
            <ul>
                <li> Né le '.$fetchReal['date_naissance'].'</li>
                <li> Identifiée comme '.$fetchReal['sexe_personne'].'</li>

            </ul>
            <h3>Filmographie</h3>
            <ul>
    ';

    foreach($fetchFilmographie as $film) {
        echo '
                <li>
                <a href="index.php?action=detailFilm&id='.$film['id_film'].'" >'
                    .$film['titre_film'].
                    '</a>
                </li>
            ';
    }
    echo '
            </ul>
        </div>
    </div>
    ';

    ?>
    <a href="index.php?action=listRealisateurs"></a>
</section>

<?php

$titre = $fetchReal["nomReal"];

// Changement du titre secondaire en fonction du sexe (merci Pierre, superbe idée)
    if ($fetchReal ['sexe_personne'] == "femme"){
        $titre_secondaire = "Détails de la réalisatrice : ".$fetchReal ["nomReal"];
    }
    else{
        $titre_secondaire = "Détails du réalisateur : ".$fetchReal ["nomReal"];
    }
$contenu = ob_get_clean();
require "view/template.php";

?>