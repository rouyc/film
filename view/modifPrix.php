<!-- Modifier prix -->
<div class="col s12">
    <div class="card">
        <div class="card-content">
            <form action = "index.php?controller=adminProgramme&action=modifPrix&id=<?php echo $_GET["id"]; ?>" method="post">
                Prix : <input type = "text" name = "prix"><br/>
                <input type = "submit" value = "Envoyer">
            </form>
            <div class="description">
                <p> <strong> Prix actuel : <br/> </strong> 
                    <?php
                        echo $prix;
                    ?></p>
            </div>
         </div>
    </div>
</div>