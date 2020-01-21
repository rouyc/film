<?php
require_once File::build_path(array('model','Model.php'));
require_once File::build_path(array('model','ModelProgramme.php'));

class ModelPanier extends Model
{
    private $idPanier;
    private $etatPanier;
    protected static $object='panier';
    protected static $primary='idPanier';

    public static function ajouterPanier($idProgramme){
        if (!isset($_COOKIE['panier'])){
            $tab[0] = $idProgramme;
            $tabCookie = serialize($tab);
            setcookie('panier',$tabCookie,time()+3600);
            $cookie = $tab;
            return $cookie;
        }
        else {
            $tabRes = unserialize($_COOKIE['panier']);
            array_push($tabRes,$idProgramme);
            $tabReturn = serialize($tabRes);
            setcookie('panier',$tabReturn,time()+3600);
            return $tabRes;
        }
    }

    public static function getTabCookie(){
        if (isset($_COOKIE['panier'])){
            return unserialize($_COOKIE['panier']);
        }
    }

    public static function getQuantité($tabCookie, $idProgramme){
        $tabCount = array_count_values($tabCookie);
        return $tabCount[$idProgramme];
    }

    public static function afficherPanier($tab_cookie){
        if (!isset($tab_cookie)){
            echo "votre panier est vide";
        }
        else {
            $tabAffiche = array();
            foreach ($tab_cookie as $programmeID){
                if (!(in_array($programmeID,$tabAffiche))){
                    array_push($tabAffiche, $programmeID);
                    $programme = ModelProgramme::getProgrammeById($programmeID);
                    $programme->afficher();
                    $quantite = ModelPanier::getQuantité($tab_cookie,$programmeID);
                    echo "<div class=\"col s12 l6\"> 
                   <div class=\"card\">
                  <div class=\"card - content center\">";
                    echo "<br> Quantité : " . $quantite . "<br><br>";
                    echo " </div>
                  </div>
                  </div>";
                }
            }
            echo "<div class=\"col s6 l3\"> 
                   <div class=\"card\">
                  <div class=\"card - content center\"><br>";
            echo "<a class=\"btn waves-effect waves-light black center\" href=\"index.php?controller=panier&action=validerPanier\">Confirmer panier<i class=\"material-icons right\">check</i></a>";
            echo " <br><br></div>
                  </div>
                  </div>";
        }
    }

    public static function viderPanier(){
        if(isset($_COOKIE['panier'])){
            setcookie ("panier", "", time() - 1);
        }
    }

    public static function getPrixPanier($tab_cookie){
        $prix = 0;
        foreach ($tab_cookie as $programmeID){
            $programme = ModelProgramme::getProgrammeById($programmeID);
            $prix = $prix + $programme->getPrixProgramme();
        }
        echo "<div class=\"col s12 l6\"> 
           <div class=\"card\">
          <div class=\"card - content center\">";
        echo "<br>";
        echo "<h3> Prix : " . $prix . "€ </h3>";
        echo "<br>";
        echo "<br>";
        echo " </div>
          </div>
          </div>";
    }

    public static function validerPanier()
    {
        try {
            $stmt = Model::$pdo->prepare("INSERT INTO Panier (etatPanier) VALUES (0)");
        } catch (PDOException $e) {
            echo $e->getMessage(); // affiche un message d'erreur
            die();
        }
        $stmt->execute();
    }

    public static function getIdLastPanier(){
        try{ $sql = Model::$pdo->query("SELECT MAX(idPanier) FROM Panier" );}

        catch (PDOException $e) {
            if (Conf::getDebug()) { echo $e->getMessage();}
            else { echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';}
            die();
        }

        $res = $sql->fetch();
        return $res[0];
    }

    public static function validerPanierBis($tab_cookie){
        $idP = ModelPanier::getIdLastPanier();
        $idU = ModelUtilisateur::getUtilisateurByEmail($_SESSION['login'])->getIdUtilisateur();
        $tabQuantite = array();
        foreach ($tab_cookie as $programmeID){
            if (!(in_array($programmeID,$tabQuantite))){
                array_push($tabQuantite, $programmeID);
            }
        }
        foreach ($tabQuantite as $element) {
            $quantite = ModelPanier::getQuantité($tab_cookie,$element);
            try{
                $progPanier = Model::$pdo->prepare("INSERT INTO ProgrammePanier (idProgramme,idPanier, quantiteProgramme) VALUES (:element,:idP,:quantite)");
            }
            catch (PDOException $e) {
                echo $e->getMessage(); // affiche un message d'erreur
                die();
            }
            $progPanier->execute(array("element" => $element,
                "idP" => $idP,
                "quantite" => $quantite));
        }
        try {
            $possedePanier = Model::$pdo->prepare("INSERT INTO PossedePanier (idPanier,idUtilisateur) VALUES (:idP,:idU)");
        }
        catch (PDOException $e) {
            echo $e->getMessage(); // affiche un message d'erreur
            die();
        }
        $possedePanier->execute(array("idP" => $idP,
            "idU" => $idU));
        ModelPanier::viderPanier();
    }
}