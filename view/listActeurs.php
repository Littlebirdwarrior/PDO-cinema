<?php
ob_start();

//Requete

$fetchActeurs = $requeteListActeurs->fetchAll();

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
                </tr>
                </thead>
                <tbody>
                <?php


                //affichage acteurs : boucle
                foreach ($fetchActeurs as $acteur){
                    echo '<tr>
                            <td>'
                            .'<a href="index.php?action=detailActeur&id='.$acteur['id_acteur'].'" >'.$acteur['nomAct']. '</a>'.
                            '</td>
                            <td>'.$acteur['date_naissance'].'</td>
                            <td>'.$acteur['sexe_personne'].'</td>
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
