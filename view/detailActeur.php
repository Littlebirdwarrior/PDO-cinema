<?php ob_start();
?>

<section></section>
    <?php
    //définition de mes variables fetch

    $fetchActeur = $requeteDetailActeur->fetch(); //fetch, car je ne récupère qu'un seul id
    $fetchFilmographie = $requeteFilmographie->fetchAll(); //fetchAll, car je ne récupère plusieurs films pour un acteur

    echo '
    <div>
        <div>
        <figure>
        <img src="" alt=""/>
        </figure>
        </div>
        <div>
            <h2>'.$fetchActeur['nomAct'].'</h2>
            <ul>
                <li> Né le '.$fetchActeur['date_naissance'].'</li>
                <li> Identifiée comme '.$fetchActeur['sexe_personne'].'</li>

            </ul>
            <h3>Filmographie</h3>
            <ul>
    ';

    foreach($fetchFilmographie as $film) {
        echo '
                <li>
                '. $film['nom_role'].' dans
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
</section>

<?php

$titre = $fetchActeur['nomAct'];

// Changement du titre secondaire en fonction du sexe (merci Pierre, superbe idée)
    if ($fetchActeur ['sexe_personne'] == "femme"){
        $titre_secondaire = "Détails de l'actrice : ".$fetchActeur ["nomAct"];
    }
    else{
        $titre_secondaire = "Détails de l'acteur : ".$fetchActeur ["nomAct"];
    }
$contenu = ob_get_clean();
require "view/template.php";
