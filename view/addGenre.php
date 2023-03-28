<?php
ob_start();
?>

<form action="index.php?action=addGenre" method="post" enctype="multipart/form-data"> <!---ici, php, action : cible du form en php, fichier a atteindre lors du post http (method), envois variable ds autre page, ici, T.A--->
    <h2>Ajouter un genre à votre BDD</h2>
    
    <p>
    <label>
        Nom du genre : 
        <input type="text" name="libelleGenre" required>
    </label>
    </p>


    <input class="" type="submit" name="submitGenre" >

</form>

<!----<div class="control">
    <a href="index.php?action=listGenres">Retour à la liste des roles</a>
</div>--->


<?php
$titre = "Ajouter un genre";
$titre_secondaire = "Ajouter un genre";
$contenu = ob_get_clean(); //envois le tempons dans la session
require "view/template.php";