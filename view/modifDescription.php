<!-- Modifier description -->
<div class="col s12">
    <div class="card">
        <div class="card-content">
            <form action = "index.php?controller=adminProgramme&action=modifDesc&id=<?php echo $_GET["id"]; ?>" method="post">
                Votre description : <input type = "text" name = "description"><br/>
                <input type = "submit" value = "Envoyer">
            </form>
            <div class="description">
                <p> <strong> Description actuelle : <br/> </strong> 
                    <?php
                        echo $description;
                    ?></p>
            </div>
         </div>
    </div>
</div>