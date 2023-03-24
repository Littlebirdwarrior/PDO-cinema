<?php
ob_start();
?>

<?php
    //Mes fetch, je recupère les données de la BDD
    $fetchReals = $requeteListRealisateurs ->fetchAll();
?>

    <!---Compte des films-->
    <p>Il y a 
    <?=$requeteListRealisateurs->rowCount()?>
    Réalisateurs
    </p>

    <section>
        <h2>Mes Réalisateurs</h2>
        <div>
            <table>
                <thead>
                <tr>
                    <th>Réalisateurs</th>
                    <th>date de naissance</th>
                    <th>Sexe</th>
                    <th>Filmographie</th>
                </tr>
                </thead>
                <tbody>
                <?php
                //boucle sur chaque films
            
                foreach ($fetchReals as $real){
                    echo '<tr>
                            <td>'.$real['nomReal'].'</td>
                            <td>'.$real['date_naissance'].'</td>
                            <td>'.$real['sexe_personne'].'</td>
                            <td>'.$real['filmographie'].'</td>
                        </tr>
                        ';
                    }
                ?>
                </tbody>
            </table>
        </div>
    </section>

<?php
$titre = "Listes des réalisateurs";
$titre_secondaire= "Listes des réalisateurs";
$contenu = ob_get_clean();//envois le tempons dans la session
require "view/template.php";
