<?php
ob_start();
?>

<section>
<form action="index.php?action=addRealisateur" method="post" enctype="multipart/form-data"> <!---ici, php, action : cible du form en php, fichier a atteindre lors du post http (method), envois variable ds autre page, ici, T.A--->
        <h2>Ajouter un produit</h2>
        <p>
            <!---attribut "name", ce qui va permettre à la requête de classer le contenu de la saisie dans des clés portant le nom choisi.---->
            <label>
                Nom de l'acteur :
                <input type="text" name="">
            </label>
        </p>
        <p>
            <label>
                Prenom de l'acteur :
                <input type="text" name="">
            </label>
        </p>
        <p>
            <label>
                Genre :
                <input type="text" name="">
            </label>
        </p>
        <p>
            <label>
                Date de naissance :
                <input type="date" name="date_naissance">
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
            <input class="button light" type="submit" name="submit" value="Ajouter le réalisateur">
        </p>


</section>

<?php
$titre = 'Ajouter un réalisateur';
$titre_secondaire = "Ajouter un réalisateur";
$contenu = ob_get_clean();
require "view/template.php";


