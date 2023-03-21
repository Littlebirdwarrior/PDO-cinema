<?php
ob_start();//démarre session et créé tempon, capsule qui enregistre tout ce qui suit en string
?> 
    <!--Compte des film-->
    <p>Il y a <?=$requeteListFilm->rowCount()?> films</p>

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
            
                foreach ($requeteListFilm->fetchAll() as $film){
                    echo '<tr>
                                   <td><a href="#">'.$film['titre_film'].'</a></td>
                                   <td>'.$film['annee_sortie_film'].'</td>
                                   <td>'.$film['duree_film'].'</td>
                                   <td>'.$film['prenom_personne'].' '.$film['nom_personne'].'</td>
                                   <td>'.$film['note_film'].'</td>
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
