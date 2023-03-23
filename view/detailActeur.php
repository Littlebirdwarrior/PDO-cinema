<?php ob_start();
?>

<section></section>
    <?php
    foreach($requeteDetailActeur->fetchAll() as $acteur) {
        echo '
        <div>
            <div>
            <figure>
            <img src="" alt=""/>
            </figure>
            </div>
            <div>
                <h2>'.$acteur['qui'].'</h2>
                <ul>
                    <li> Né le '.$acteur['date_naissance'].'</li>
                    <li> Identifiée comme'.$acteur['sexe_personne'].'</li>

                </ul>
                <h3>Filmographie</h3>
                <ul>
        ';

        foreach($requeteFilmographie -> fetchAll() as $film) {
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
    }
    ?>
</section>




<?php

$titre = $acteur["qui"];

// Changement du titre secondaire en fonction du sexe
    if ($acteur['sexe_personne'] == "femme"){
        $titre_secondaire = "Détails de l'actrice : ".$acteur["qui"];
    }
    else{
        $titre_secondaire = "Détails de l'acteur : ".$acteur["qui"];
    }
$contenu = ob_get_clean();
require "view/template.php";
