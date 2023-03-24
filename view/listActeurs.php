<?php
ob_start();

?>

    <!---Compte des films-->
    <p>Il y a <?=$requeteListActeurs-> rowCount()?> acteurs</p>

    <section>
        <h2>Mes Acteurs</h2>
        <div>
            <table>
                <thead>
                <tr>
                    <th>Acteur</th>
                    <th>date de naissance</th>
                    <th>Sexe</th>
                    <th>Filmographie</th>
                </tr>
                </thead>
                <tbody>
                <?php
                //boucle sur chaque films
            
                foreach ($requeteListActeurs->fetchAll() as $acteur){
                    echo '<tr>
                            <td>'.$acteur['nomAct'].'</td>
                            <td>'.$acteur['date_naissance'].'</td>
                            <td>'.$acteur['sexe_personne'].'</td>
                            <td>'.$acteur['filmographie'].'</td>
                        </tr>
                        ';
                    }
                ?>
                </tbody>
            </table>
        </div>
    </section>

<?php
$titre = "Listes des acteurs";
$titre_secondaire= "Listes des acteurs";
$contenu = ob_get_clean();//envois le tempons dans la session
require "view/template.php";
