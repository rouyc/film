<?php
foreach ($tabFav as $favori) {
    $id = $favori->getIdProgramme()."  ";
    $titre = ModelProgramme::selectAttributById($id,"titreProgramme");
    $img = ModelProgramme::selectAttributById($id,"urlImage");
    $Desc = ModelProgramme::selectAttributById($id,"descriptionProgramme");
    $duree = ModelProgramme::selectAttributById($id,"dureeProgramme");
    $Pays = ModelProgramme::selectAttributById($id,"paysProgramme");
    $prix = ModelProgramme::selectAttributById($id,"prixProgramme");

    echo "<div class=\"col s12 l6\">
                    <div class=\"card\">
                        <div class=\"card-content center\">
                        <h5>" . $titre . "</h5><br> <img  style=\"width: 80%;\" src=\"$img\">" . '<br>';
    echo 'Synopsis :  ' . $Desc . '<br> Durée du film : ' . $duree . '<br> Pays du film : ' . $Pays . '<br> Prix : ' . $prix . '€ <br>';
    echo '<div class="card">
                            <div class="card-content center"> Acteurs : <div>';
    echo ModelActeur::afficherActeur(ModelActeur::getActeurById($id));
    echo "    </div>
                        </div>
                      </div>";
    echo "<div class=\"col s12 l6\">
                        <div class=\"card\">
                            <div class=\"card-content center\"> Producteur(s) :";
    echo ModelProducteur::afficherProducteur(ModelProducteur::getProducteurById($id));
    echo "    </div>
                        </div>
                      </div>";
    echo " <div class=\"col s12 l6\">
                        <div class=\"card\">
                            <div class=\"card-content center\"> Realisateur(s) :";
    echo ModelRealisateur::afficherRealisateur(ModelRealisateur::getRealisateurById($id));
    echo "    </div>
                        </div>
                      </div>";
    echo " <div class=\"col s12 l6\">
                        <div class=\"card\">
                            <div class=\"card-content center\"> Categorie(s) :";
    echo ModelCategorie::afficherCategorie(ModelCategorie::getCategorieById($id));
    echo "    </div>
                        </div>
                      </div>";
    echo " <div class=\"col s12 l6\">
                        <div class=\"card\">
                            <div class=\"card-content center\"> Langues : ";
    echo ModelLangue::afficherLangue(ModelLangue::getLangueById($id));
    echo "    </div>
                        </div>
                      </div>";
    echo "
                <a class=\"btn waves-effect waves-light black\" href=\"index.php?controller=panier&action=ajouterPanier&id=" . $id . "\">Ajouter au panier<i class=\"material-icons right\">add_shopping_cart</i></a> 
                <a class=\"btn waves-effect waves-light black\" href=\"index.php?controller=favoris&action=retirerFavoris&id=" . $id . "\">retirer Favoris</a> 
                </div>
            </div>
            </div>";

}