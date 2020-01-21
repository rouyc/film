<?php
require_once File::build_path(array('model','Model.php'));

class ModelProducteur extends Model
{
    private $idProducteur;
    private $nomProducteur;
    private $prenomProducteur;
    protected static $object='producteur';
    protected static $primary='idProducteur';

    public function getIdProducteur()
    {
        return $this->idProducteur;
    }

    public function getNomProducteur()
    {
        return $this->nomProducteur;
    }

    public function getPrenomProducteur()
    {
        return $this->prenomProducteur;
    }

    public static function getProducteurById($idProgramme){

        try{ $rep = Model::$pdo->prepare("SELECT * FROM Producteur Pr
                                            INNER JOIN ProducteurProgramme PP ON Pr.idProducteur = PP.idProducteur
                                            INNER JOIN Programme P ON P.idProgramme = PP.idProgramme
                                            WHERE P.idProgramme =:idProgramme");}

        catch (PDOException $e) {
            if (Conf::getDebug()) { echo $e->getMessage();}
            else { echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';}
            die();
        }
        $rep->execute(array('idProgramme' => $idProgramme));


        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelProducteur');
        $tab_article = $rep->fetchAll();

        return $tab_article;
    }

    public static function afficherProducteur($tab){
        foreach ($tab as $element) {
            echo "<p>" . $element->getPrenomProducteur() . " " . $element->getNomProducteur() . " </p>";
        }
    }


    public static function addProducteurProgramme($idProgramme,$producteur){
        foreach ($producteur as $p1) {
            $p1=explode(" ", "$p1");
            $producteur_bis = ModelProducteur::selectByAttribut("nomProducteur",$p1[1]);
            $idProducteur = $producteur_bis[0]->getIdProducteur();
            try {
                $stmt = Model::$pdo->prepare("INSERT INTO ProducteurProgramme (idProducteur,idProgramme) VALUES (:idProducteur, :idProgramme)");
            } catch (PDOException $e) {
                echo $e->getMessage(); // affiche un message d'erreur
                die();
            }
            $stmt->execute(array('idProducteur' => $idProducteur, 'idProgramme' => $idProgramme));
        }

    }
}
?>