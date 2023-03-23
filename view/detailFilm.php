<?php
ob_start();
?>



<section>
    
    <?php
    //Mes fetch, je recupère les données de la BDD
    $fetchFilm = $requeteDetailFilm->fetchAll();
    $fetchGenre = $requeteDetailGenre->fetchAll();
    $fetchCasting = $requeteDetailCasting->fetchAll();

    //Fonction d'affichage des notes
    function getNote($fetchFilm){
        //Récupère mon int du sql
        $noteStars = '';

        //boucle pour la notation
        foreach($fetchFilm as $film){
            $note = $film['note_film'];  
        }
        
        //Boucle tant que i inf a note, + une * pleine
        for ( $i=1; $i <= $note; $i++){
        $noteStars .= '<span class="material-symbols-rounded fill"> star </span>';
        }

        //Boucle tant que i inf à 5 et à 0 , + une * vide
        for ( $i= $note - 5; $i < 0; $i++){
            $noteStars .= '<span class="material-symbols-rounded"> star</span>';

        }  
        return $noteStars;
        

    } 


    //boucle affichage
    foreach($fetchFilm as $film){
        
        //Affichage
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
                    <li>'.$film['affiche_film'].'</li>
                    <li>Note : '. getNote($fetchFilm).' </li>
                    <li>Durée : '.$film['duree_film'].'</li>
                    <li>Année de sortie : '.$film['annee_sortie_film'].'</li>
                    <li>Réaliser par : '.$film['prenom_personne'].' '.$film['nom_personne'].'</li>
                    <!------>
                    <li> Avec :';
               
             foreach($fetchCasting as $casting){ 
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
                    foreach ($fetchGenre as $genre){
                        echo ' '.$genre["libelle_genre"];
                    } 

            echo '</li></ul>';

            echo '<p>Synopsis : '. $film['synopsis_film'].'</p>';
            echo '</div>';
                
    } 

    getNote($film);
?>

</section>

<?php
$titre = "détail d'un film";
$titre_secondaire = "Détail d'un film";
$contenu = ob_get_clean();
require "view/template.php";