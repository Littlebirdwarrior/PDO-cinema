<?php
ob_start();

//Requete

$fetchActeurs = $requeteListActeurs->fetchAll();

?>

    <!---Compte les acteurs-->
    <p>Il y a <?=$requeteListActeurs-> rowCount()?> acteurs</p>
    <a href="index.php?action=addActeur">Ajouter un acteur</a>
    <section>
        <h2>Mes Acteurs</h2>
        <div>
            <table>
                <thead>
                <tr>
                    <th>Acteur</th>
                    <th>Sexe</th>
                    <th>Date de naissance</th>
                    <th>Age</th>
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
                            <td>'.$acteur['sexe_personne'].'</td>
                            <td>'.$acteur['date_naissance'].'</td>
                            <td>'.$acteur['age'].' ans </td>
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
