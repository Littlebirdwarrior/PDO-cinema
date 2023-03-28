<?php
ob_start();
?>

<?php
//*Récupérer les données depuis le sql
$fetchFilms = $requeteSelectFilms->fetchAll();
$fetchActeurs = $requeteSelectActeurs->fetchAll();
$fetchRoles = $requeteSelectRoles->fetchAll();
?>


<form action="index.php?action=addCasting" method="post" enctype="multipart/form-data"> <!---ici, php, action : cible du form en php, fichier a atteindre lors du post http (method), envois variable ds autre page, ici, T.A--->    
    <p>
        <label>
            Acteur
            <select type="text" name="acteurId" required>
            <?php 
            //Affichage des films
            foreach ($fetchActeurs as $acteur) {
                echo "<option value=".$acteur['id_acteur'].">".$acteur['nom_personne']. ' '.$acteur['prenom_personne']."</option>";
            }
            ?>
            </select>
        </label>
    </p>

    <p>
        <label>
            Film
            <select type="text" name="filmId" required>
            <?php 
            //Affichage des films
            foreach ($fetchFilms as $film) {
                echo "<option value=".$film['id_film'].">".$film['titre_film']."</option>";
            }
            ?>
            </select>
        </label>
    </p>

    <p>
    <label>
            Role
            <select type="text" name="filmId" required>
            <?php 
            //Affichage des roles
            foreach ($fetchRoles as $role) {
                echo "<option value=".$role['id_role'].">".$role['nom_role']."</option>";
            }
            ?>
            </select>
        </label>
    </p>


    <input class="" type="submit" name="submitCasting" >

</form>

<div class="control">
<!---retour à la page précédente-->
<a href= "http://localhost:8888/index.php?action=listFilms">Retour</a>
</div>


<?php
$titre = "Ajouter un casting";
$titre_secondaire = "Ajouter un casting";
$contenu = ob_get_clean(); //envois le tempons dans la session
require "view/template.php";
