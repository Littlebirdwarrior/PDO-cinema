<?php
ob_start();
?>

<form action="traitement.php?action=addRole.php" method="post" enctype="multipart/form-data"> <!---ici, php, action : cible du form en php, fichier a atteindre lors du post http (method), envois variable ds autre page, ici, T.A--->
    <h2>Ajouter un role à votre BDD</h2>
    
    <p>
    <label>
        Nom du role : 
        <input type="text" name="nomRole" required>
    </label>
    </p>


    <input class="" type="submit" name="submitRole" >

</form>

<div class="control">
    <a href="index.php?action=listRoles">Retour à la liste des roles</a>
</div>


<?php
$titre = "Ajouter un role";
$titre_secondaire = "Ajouter un role";
$contenu = ob_get_clean(); //envois le tempons dans la session
require "view/template.php";