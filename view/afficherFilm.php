<?php
ob_start();

    <p>Il y a <?=$requete->rowCount()?>films</p>

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
                </tr>
                </thead>
                <tbody>
                <?php
                //boucle sur chaque film
                //a ajouter apres construction scession
                foreach ($requete->fetchAll() as $film){
                    echo '<tr>
                                   <td><a href="#">'.$film['titre_film'].'</a></td>
                                   <td>'.$film['annee_sortie_film'].'</td>
                                   <td>'.$film['duree_film'].'</td>
                                   <td>'.$film['prenom_personne'].' '.$film['nom_personne'].'</td>
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
$contenu = ob_end_clean();
require "view/template.php";
