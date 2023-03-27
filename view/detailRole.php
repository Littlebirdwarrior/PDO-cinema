<?php ob_start();
?>

<section>
    <?php
    //définition de mes variables fetch

    $fetchRole = $requeteDetailRole->fetch(); //fetch, car je ne récupère qu'un seul id
    
    echo '
    <div>
        <div>
        <figure>
        <img src="" alt=""/>
        </figure>
        </div>
        <div>
            <h2>'.$fetchRole['nom_role'].'</h2>
            <p>
            '.$fetchRole['nom_role'].
            ' est joué par '
            .'<a href="index.php?action=detailActeur&id='.$fetchRole['id_acteur'].'" >'.$fetchRole['nomAct'].'</a>'.
            ' dans '.
            '<a href="index.php?action=detailFilm&id='.$fetchRole['id_film'].'" >'.$fetchRole['titre_film'].'</a>
            </p>

        </div>
    </div>
    ';

    ?>
    <a href="index.php?action=listRoles"></a>
</section>

<?php

$titre = $fetchRole['nomAct'];
$titre_secondaire= "";
$contenu = ob_get_clean();
require "view/template.php";
