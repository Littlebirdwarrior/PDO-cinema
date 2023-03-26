<?php
ob_start();//démarre session et créé tempon, capsule qui enregistre tout ce qui suit en string
?> 
    <!--Compte des film-->

    <section>
        <h2>Mes films</h2>
        <div>
            <table>
                <thead>
                <tr>
                    <th>Role</th>
                    <th>Acteur</th>
                    <th>Film</th>
                    <th>Année</th>
                </tr>
                </thead>
                <tbody>
                <?php
                //boucle sur chaque films
            
                foreach ($requeteListRoles->fetchAll() as $role){

                    //afficher les informations
                    echo '<tr>
                            <td>'. '<a href="index.php?action=detailRole&id='.$role['id_role'].'" >'.$role['nom_role']. '</a>'.
                            '</td>
                            <td><a href="http://localhost:8888/index.php?action=detailActeur&id='.$role["id_acteur"].'">'
                            .$role['nomAct'].'</a>
                            <td>
                            <a href="http://localhost:8888/index.php?action=detailFilm&id='.$role["id_film"].'">'
                            .$role['titre_film'].'</a>'.
                            '</td>
                            <td>'. $role['annee_sortie_film']. 
                            '</td>
                        </tr>
                        ';
                }
                ?>
                </tbody>
            </table>
        </div>
    </section>

<?php
$titre = "liste des Role";
$titre_secondaire= "Liste des Role";
$contenu = ob_get_clean();//envois le tempons dans la session
require "view/template.php";
