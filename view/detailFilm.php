<?php
ob_start();
?>

<section>
    <?php
    //boucle
    foreach($requeteDetailFilm->fetchAll() as $film){
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
    } ?>

</section>

<?php
$titre = "détail d'un film";
$titre_secondaire = "Détail d'un film";
$contenu = ob_get_clean();
require "view/template.php";