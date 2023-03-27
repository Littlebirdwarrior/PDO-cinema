<?php
ob_start();
?>

<section>
<form action="index.php?action=addRealisateur" method="post" enctype="multipart/form-data"> <!---ici, php, action : cible du form en php, fichier a atteindre lors du post http (method), envois variable ds autre page, ici, T.A--->
        <p>
            <!---attribut "name", ce qui va permettre à la requête de classer le contenu de la saisie dans des clés portant le nom choisi.---->
            <label>
                Prénom du réalisateur :
                <input type="text" name="prenomReal">
            </label>
        </p>
        <p>
            <label>
                 Nom du réalisateur :
                <input type="text" name="nomReal">
            </label>
        </p>
        <p>
        <label>
                Genre :
                <select type="text" name="sexeReal" required>
                    <option value="femme">Femme</option>
                    <option value="homme">Homme</option>
                    <option value="autre">Autre</option>
                </select>
            </label>
        </p>
        <p>
            <label>
                Date de naissance :
                <input type="date" name="dateNaissanceReal">
            </label>
        </p>
        <p>
            <!----attribut "name" qui permettra de vérifier côté serveur que le formulaire a bien été validé par l'utilisateur.------>
            <input type="submit" name="submitReal">
        </p>
    </form>

    <div class="control">
    <a href="index.php?action=detailRealisateur">Retour à la liste des acteurs</a>
    </div>
    
</section>

<?php
$titre = 'Ajouter un réalisateur';
$titre_secondaire = "Ajouter un réalisateur";
$contenu = ob_get_clean();
require "view/template.php";


