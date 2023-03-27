<?php
ob_start();
?>

<section>
<form action="index.php?action=addActeur" method="post" enctype="multipart/form-data"> <!---ici, php, action : cible du form en php, fichier a atteindre lors du post http (method), envois variable ds autre page, ici, T.A--->
        <h2>Ajouter un produit</h2>
        <p>
            <!---attribut "name", ce qui va permettre à la requête de classer le contenu de la saisie dans des clés portant le nom choisi.---->
            <label>
                Prénom de l'acteur :
                <input type="text" name="prenomAct" required>
            </label>
        </p>
        <p>
            <label>
                Nom de l'acteur :
                <input type="text" name="nomAct" required>
            </label>
        </p>
        <p>
            <label>
                Genre :
                <select type="text" name="sexeAct" required>
                    <option value="femme">Femme</option>
                    <option value="homme">Homme</option>
                    <option value="autre">Autre</option>
                </select>
            </label>
        </p>
        <p>
            <label>
                Date de naissance :
                <input type="date" name="dateNaissanceAct" required>
            </label>
        </p>
        <!--- <p>
            <label class="ajout-img">
                Image du produit :
                <span>
                <input type="file" name="file">
                
                </span>
            </label>
        </p> --->
        <p>
            <!----attribut "name" qui permettra de vérifier côté serveur que le formulaire a bien été validé par l'utilisateur.------>
            <input type="submit" name="submitActeur">
        </p>

</form>

</section>

<?php
$titre = 'Ajouter un acteur';
$titre_secondaire = "Ajouter un acteur";
$contenu = ob_get_clean();
require "view/template.php";

