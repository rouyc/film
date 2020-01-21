<!-- Modifier telephone -->
<div class="col s12">
    <div class="card">
        <div class="card-content">
            <form action = "../www/index.php?controller=utilisateur&action=modifTelephone&id=<?php echo $idUtilisateur; ?>" method="post">
                Nouveaux téléphone : <input type = "tel" name = "telephone"><br/>
                <input type = "submit" value = "Envoyer">
            </form>
            <div class="description">
                <p> <strong> Téléphone actuel : </strong> <?php
                    echo $telephone;
                    ?></p>
            </div>
            <br/>
         </div>
    </div>
</div>