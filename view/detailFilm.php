<?php
ob_start();
?>

<section>
    
    <?php
    //Mes fetch, je recupère les données de la BDD
    $fetchFilm = $requeteDetailFilm->fetch(); //fetch, car je ne récupère qu'un seul id
    $fetchGenre = $requeteDetailGenre->fetchAll();
    $fetchCasting = $requeteDetailCasting->fetchAll();

    //Fonction d'affichage des notes
    function getNote($fetchFilm){
        //Récupère mon int du sql
        $note = $fetchFilm['note_film']; //int 
        $starsFilled = str_repeat('<i class="fa-solid fa-star"></i>', $note);
        $starsEmpty = str_repeat('<i class="fa-regular fa-star"></i>', (5 - $note));
        $stars = $starsFilled .''. $starsEmpty;
        echo $stars;
    } 
?>

    <!---Affichage--->
    <div>
       <div>
           <figure>
           <img src="<?=$fetchFilm['affiche_film']?>" alt="affiche <?=$fetchFilm['titre_film']?>" width="100px" height="138px"/>
           </figure>  
       </div>
       <!------>
       <div>
       <h2><?=$fetchFilm['titre_film']?></h2>
           <!------>
           <ul>
               <li>Note : <?=getNote($fetchFilm)?></li>
               <li>Durée : <?=$fetchFilm['duree_film']?></li>
               <li>Année de sortie : <?=$fetchFilm['annee_sortie_film']?></li>
               <li>Réaliser par : 
                <a href="http://localhost:8888/index.php?action=detailRealisateur&id=<?=$fetchFilm['id_realisateur']?>">
                    <?=$fetchFilm['nomReal']?></a>
                </li>
               <!------>
               <li> Avec :
                    <?php
                    //boucle film
                    foreach($fetchCasting as $casting){ 
                    echo '
                        <a href="http://localhost:8888/index.php?action=detailActeur&id='.$casting['id_acteur'].'">
                        '.$casting['nomAct'].'
                        </a>
                        ('.$casting['nom_role'].
                        ') <span> | </span>'; //il faudra cacher le derniers span en css
                    }   
                    //boucle genre
                    echo'</li>
                        <li> Genres: '; 

                        //Boucle pour afficher tous les genres du film -->
                        foreach ($fetchGenre as $genre){
                            echo ' '.$genre["libelle_genre"] .'<span> | </span>';
                        }
                    ?>
       </li></ul>

       <p> <span>Synopsis :</span><br><?=$fetchFilm['synopsis_film']?></p>
       <a href="index.php?action=listFilms"></a>
       </div>


</section>

<?php
$titre = "détail d'un film";
$titre_secondaire = "Détail d'un film";
$contenu = ob_get_clean();
require "view/template.php";