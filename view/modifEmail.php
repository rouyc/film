<!-- Modifier email -->
<div class="col s12">
    <div class="card">
        <div class="card-content">
            <form action = "../www/index.php?controller=utilisateur&action=modifEmail&id=<?php echo $idUtilisateur; ?>" method="post">
                Nouvelle email : <input type = "email" name = "email"><br/>
                <input type = "submit" value = "Envoyer">
            </form>
            <div class="description">
                <p> <strong> Email actuel : </strong> <?php
                    echo $email;
                    ?></p>
            </div>
            <br/>
         </div>
    </div>
</div>