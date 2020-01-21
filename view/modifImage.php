<!-- Modifier image -->
<div class="col s12">
    <div class="card">
        <div class="card-content">
            <form action="index.php?controller=adminProgramme&action=modifImage&id=<?php echo $_GET["id"]; ?>" method="post" enctype="multipart/form-data">
                <label for="fileUpload">Fichier:</label>
                <input type="file" name="photo" id="fileUpload">
                <input type="submit" name="submit" value="Upload">
                <p> <strong>Note:</strong> Seuls les formats .jpg, .jpeg, .jpeg, .gif, .png sont autorisés jusqu'à une taille maximale de 5 Mo.</p>
                <div class="image">
                    <p> <strong class="texte_image">Image actuelle :</strong>
                        <?php
                            $res = str_replace(' ', '', $image);
                            echo "<img src=\"$res\" alt =\"n1\">";
                        ?>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>