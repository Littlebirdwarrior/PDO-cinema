<?php
ob_start();
?>

<form action="traitement.php?action=addFilm.php" method="post" enctype="multipart/form-data"> <!---ici, php, action : cible du form en php, fichier a atteindre lors du post http (method), envois variable ds autre page, ici, T.A--->
        <h2>Ajouter un film à votre BDD</h2>

            <!---attribut "titre", ce qui va permettre à la requête de classer le contenu de la saisie dans des clés portant le nom choisi.---->
            <label>
                Titre :
                <input type="text" name="titreFilm">
            </label>

            <label>
                Année de sortie :
                <input type="number" set="any" name="anneeSortieFilm">
            </label>

            <label>
                Durée :
                <input type="number" set="any" name="dureeFilm">
            </label>
            <label>
                Note :
                <input type="number" set="any" name="noteFilm">
            </label>
            <label>
                URL de l'Affiche :
                <input type="text" name="afficheFilm">
            </label>

            <label>
                Synopsys :
                <textarea name="synopsysFilm" rows="5"></textarea>
            </label>

            <!----attribut "name" qui permettra de vérifier côté serveur que le formulaire a bien été validé par l'utilisateur.------>
            <input class="" type="submit" name="submit" value="Ajouter le film">

    </form>
    <div class="control">
    <a class="button" href="recap.php">Voir le panier</a>
    </div>


<?php
$titre = "Ajouter un film";
$titre_secondaire= "Ajouter un film";
$contenu = ob_get_clean();//envois le tempons dans la session
require "view/template.php";