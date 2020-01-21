<div class="col s12">
    <div class="card">
        <div class="card-content">

            <form action="index.php?controller=adminProgramme&action=addAttribut" method="post" enctype="multipart/form-data">
                <legend>Langue :</legend>
                <p>
                    <label for="langue_id">Langue</label>
                    <input type="text" name="langue" id="langue_id"/>
                </p>
                <h5>Langues actuelles : </h5>
                <?php foreach ($tab_langue as $langue){
                    echo $langue->getNomLangue() . "<br>";
                }
                ?>
                <legend>Categorie :</legend>
                <p>
                    <label for="categorie_id">Categorie</label>
                    <input type="text" name="categorie" id="categorie_id"/>
                </p>
                <p>Categories actuelles : </p>
                <?php foreach ($tab_categorie as $categorie){
                    echo $categorie->getNomCategorie() . "<br>";
                }
                ?>
                <legend>Acteur :</legend>
                <p>
                    <label for="acteur_id">Acteur</label>
                    <input type="text" name="acteur" id="acteur_id"/>
                </p>
                <p>Acteurs actuels : </p>
                <?php foreach ($tab_acteur as $acteur){
                    echo $acteur->getNomActeur() . "<br>";
                }
                ?>
                <legend>Realisateur :</legend>
                <p>
                    <label for="realisateur_id">Realisateur</label>
                    <input type="text" name="realisateur" id="realisateur_id"/>
                </p>
                <p>Réalisateurs actuels : </p>
                <?php foreach ($tab_realisateur as $realisateur){
                    echo $realisateur->getNomRealisateur() . "<br>";
                }
                ?>
                <legend>Producteur :</legend>
                <p>
                    <label for="producteur_id">Producteur</label>
                    <input type="text" name="producteur" id="producteur_id"/>
                </p>
                <p>Producteurs actuels : </p>
                <?php foreach ($tab_producteur as $producteur){
                    echo $producteur->getNomProducteur() . "<br>";
                }
                ?>
                <input type="submit" name="submit" value="Valider">
            </form>
        </div>
    </div>
</div>