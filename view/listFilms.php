<?php
ob_start();//démarre session et créé tempon, capsule qui enregistre tout ce qui suit en string
?>

    <!--Compte des film-->
    <p>Il y a <?=$requeteListFilms->rowCount()?> films</p>
    <a href="index.php?action=addFilm">Ajouter un film</a>

    <?php

        $fetchFilms = $requeteListFilms->fetchAll();
        //Fonction d'affichage des notes
        function getNote($fetchFilms){
            foreach ( $fetchFilms as $film) {    
                //Récupère mon int du sql
                $note = $film['note_film']; //int 
                if($note !== null){
                    $starsFilled = str_repeat('<i class="fa-solid fa-star"></i>', $note);
                    $starsEmpty = str_repeat('<i class="fa-regular fa-star"></i>', (5 - $note));
                    $stars = $starsFilled .''. $starsEmpty .'***';
                    echo $stars;
                } else {
                    echo 'pas de note disponible';
                }    
            } 
        }
    ?>

    <section>
        <h2>Mes films</h2>
        <div>
            <table>
                <thead>
                <tr>
                    <th>Titre</th>
                    <th>Année</th>
                    <th>Durée</th>
                    <th>Réalisateur</th>
                    <th>Notes</th>
                </tr>
                </thead>
                <tbody>
                <?php
                //boucle sur chaque films
            
                foreach ($fetchFilms as $film){

                    //afficher les informations
                    echo '<tr>
                                   <td><a href="http://localhost:8888/index.php?action=detailFilm&id='.$film["id_film"].'">'.$film['titre_film'].'</a></td>
                                   <td>'.$film['annee_sortie_film'].'</td>
                                   <td>'.$film['duree_film'].'</td>
                                   <td><a href="http://localhost:8888/index.php?action=detailRealisateur&id="'.$film["id_realisateur"]. ' ">
                                        </a>'.$film['nomReal'].'</a>
                                    </td>
                                   <td>'.getNote($fetchFilms).'</td>
                               </tr>
                        ';
                }
                ?>
                </tbody>
            </table>
        </div>
    </section>

<?php
$titre = "liste des films";
$titre_secondaire= "Liste des films";
$contenu = ob_get_clean();//envois le tempons dans la session
require "view/template.php";
