<?php
require_once File::build_path(array('model','ModelPanier.php'));
    echo "<div class=\"container \">";

    echo "<h3> Panier </h3>";
    if (isset($tab_cookie)){
        ModelPanier::getPrixPanier($tab_cookie);
        ModelPanier::afficherPanier($tab_cookie);
        echo "
          </div>";
    }

    else{
    echo "<div class=\"col s12 l6\"> 
           <div class=\"card\">
          <div class=\"card - content center\">";
        echo "Votre panier est vide";
        echo " </div>
          </div>
          </div>
          </div>";
    }



?>