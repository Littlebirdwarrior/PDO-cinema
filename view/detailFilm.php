<?php

//requete
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


//affichage
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
?>