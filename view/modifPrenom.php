<!-- Modifier prenom -->
<div class="col s12">
    <div class="card">
        <div class="card-content">
            <form action = "../www/index.php?controller=utilisateur&action=modifPrenom&id=<?php echo $idUtilisateur; ?>" method="post">
                Nouveau prénom : <input type = "text" name = "prenom"><br/>
                <input type = "submit" value = "Envoyer">
            </form>
            <div class="description">
                <p> <strong> Prénom actuel : </strong> <?php
                    echo $prenom;
                    ?></p>
            </div>
            <br/>
         </div>
    </div>
</div>