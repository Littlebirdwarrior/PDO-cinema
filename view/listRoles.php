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
                            <td>'. $role['nom_role']. 
                            '</td>
                            <td>'. $role['nomAct']. 
                            '</td>
                            <td>'. $role['titre_film']. 
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
