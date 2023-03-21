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
                <figure>
                <img src="'.$film['affiche_film'].'" alt="affiche '.$film['titre_film'].'" width="100px" height="138px"/>
                </figure>  
            </div>
            <div>
            <h2>'.$film['titre_film'].'</h2>
                <ul>
                    <li>Note: '.$film['note_film'].'</li>
                    <li>Année de sortie: '.$film['annee_sortie_film'].'</li>
                    <li>Réaliser par : '.$film['prenom_personne'].' '.$film['nom_personne'].'</li>
                    <li>Avec : </li>
                    <li>Durée: '.$film['duree_film'].'</li>
                </ul>
                <p>Synopsis : '.$film['synopsis_film'].'</p>
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