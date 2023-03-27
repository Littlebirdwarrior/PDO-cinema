<?php
ob_start();
?>

<?php


?>

<form action="traitement.php?action=addCasting.php" method="post" enctype="multipart/form-data"> <!---ici, php, action : cible du form en php, fichier a atteindre lors du post http (method), envois variable ds autre page, ici, T.A--->
    <h2>Ajouter un casting à votre BDD</h2>
    
    <p>
        <label>
            Acteur
            <select type="text" name="acteur" required>
                --<option value="femme">acteur un</option>--
            </select>
        </label>
    </p>

    <p>
        <label>
            Film
            <select type="text" name="film" required>
                --<option value="femme">film1</option>--

            </select>
        </label>
    </p>

    <p>
        <label>
            Nom du role :
            <input type="text" name="nomRole">
        </label>
    </p>


    <input class="" type="submit" name="submitCasting" >

</form>

<div class="control">
<!---retour à la page précédente-->
<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Retour</a>
</div>


<?php
$titre = "Ajouter un casting";
$titre_secondaire = "Ajouter un casting";
$contenu = ob_get_clean(); //envois le tempons dans la session
require "view/template.php";
