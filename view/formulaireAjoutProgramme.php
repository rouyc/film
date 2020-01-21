<!-- Formulaire d'ajout d'un programme -->
<div class="col s12">
    <div class="card">
        <div class="card-content">


            <form action="index.php?controller=adminProgramme&action=addProgramme" method="post" enctype="multipart/form-data">
                <legend>Programme :</legend>
                <p>
                    <label for="titre_id">Titre</label>
                    <input type="text" name="nom" id="titre_id" required/>
                </p>
                <p>
                    <label for="description_id">Description</label>
                    <input type="text" name="description" id="description_id" required/>
                </p>
                <p>
                    <label for="pays_id">Pays</label>
                    <input type="text" name="pays" id="pays_id" required/>
                </p>
                <p>
                    <label for="duree_id">Durée</label>
                    <input type="text" name="duree" id="duree_id" required/>
                </p>
                <p>
                    <label for="prix_id">Prix</label>
                    <input type="int" name="prix" id="prix_id" required/>
                </p>
                <script>
                    $(document).ready(function(){
                        $('select').formSelect();
                    });
                </script>
                <h6 class="center">Langue</h6>
                <div class="s12 l6">
                    <select name="langue[]" multiple>
                        <option value="" disabled>Choisissez la langue</option>
                        <?php
                        foreach ($tab_langue as $langue) {
                            echo "<option name=" . $langue->getIdLangue() . ">" . $langue->getNomLangue() . "</option>";
                        }?>
                    </select>
                </div>
                <h6 class="center">Acteur</h6>
                <div class="s12 l6">
                    <select name="acteur[]" multiple>
                        <option value="" disabled>Choisissez un acteur</option>
                        <?php
                        foreach ($tab_acteur as $acteur) {
                            echo "<option name=" . $acteur->getIdActeur() . ">" . $acteur->getPrenomActeur() . " " . $acteur->getNomActeur() . "</option>";
                        }?>
                    </select>
                </div>
                <h6 class="center">Producteur</h6>
                <div class="s12 l6">
                    <select name="producteur[]" multiple>
                        <option value="" disabled>Choisissez un producteur</option>
                        <?php
                        foreach ($tab_producteur as $producteur) {
                            echo "<option name=" . $producteur->getIdProducteur() . ">" . $producteur->getPrenomProducteur() . " " . $producteur->getNomProducteur() . "</option>";
                        }?>
                    </select>
                </div>
                <h6 class="center">Réalisateur</h6>
                <div class="s12 l6">
                    <select name="realisateur[]" multiple>
                        <option value="" disabled>Choisissez un réalisateur</option>
                        <?php
                        foreach ($tab_realisateur as $realisateur) {
                            echo "<option name=" . $realisateur->getIdRealisateur() . ">" . $realisateur->getPrenomRealisateur() . " " . $realisateur->getNomRealisateur() . "</option>";
                        }?>
                    </select>
                </div>
                <h6 class="center">Catégorie</h6>
                <select name="categorie[]" multiple>
                    <option value="" disabled>Choisissez la catégorie</option>
                    <?php
                    foreach ($tab_categorie as $categorie) {
                        echo "<option name=" . $categorie->getIdCategorie() . ">" . $categorie->getNomCategorie() . "</option>";
                    }?>
                </select>
                <input type="submit" name="submit" value="Valider">

            </form>

        </div>
    </div>
</div>
