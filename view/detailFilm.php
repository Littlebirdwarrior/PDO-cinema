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
            <!------>
            <div>
            <h2>'.$film['titre_film'].'</h2>
                <!------>
                <ul>
                    <li>Note: '.$film['note_film'].'</li>
                    <li>Durée: '.$film['duree_film'].'</li>
                    <li>Année de sortie: '.$film['annee_sortie_film'].'</li>
                    <li>Réaliser par : '.$film['prenom_personne'].' '.$film['nom_personne'].'</li>
                    <!------>
                    <li> Avec :';
               
             foreach($requeteDetailCasting->fetchAll() as $casting){ 
                echo '
                    <a>
                    '.$casting['qui'].'
                    </a>
                    ('.$casting['nom_role'].
                    '),';
                }   
            
                echo'</li>
                    <li> Genres: '; 

                    //Boucle pour afficher tous les genres du film -->
                    foreach ($requeteDetailGenre->fetchAll() as $genre){
                        echo ' '.$genre["libelle_genre"];
                    } 

            echo '</li></ul>';

            echo '<p>Synopsis : '. $film['synopsis_film'].'</p>';
            echo '</div>';
                
    } 
?>

</section>

<?php
$titre = "détail d'un film";
$titre_secondaire = "Détail d'un film";
$contenu = ob_get_clean();
require "view/template.php";