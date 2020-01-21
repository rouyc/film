<?php

require_once File::build_path(array('model','Model.php'));
class ModelCategorie extends Model
{
    private $idCategorie;
    private $nomCategorie;
    protected static $object='categorie';
    protected static $primary='idCategorie';

    public function getIdCategorie()
    {
        return $this->idCategorie;
    }

    public function getNomCategorie()
    {
        return $this->nomCategorie;
    }

    public static function getCategorieById($idProgramme){

        try{ $rep = Model::$pdo->query("SELECT * FROM Categorie C
                                            INNER JOIN CategorieProgramme CP ON C.idCategorie = CP.idCategorie
                                            INNER JOIN Programme P ON P.idProgramme = CP.idProgramme
                                            WHERE P.idProgramme =". $idProgramme ." ");}

        catch (PDOException $e) {
            if (Conf::getDebug()) { echo $e->getMessage();}
            else { echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';}
            die();
        }

        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelCategorie');
        $tab_article = $rep->fetchAll();

        return $tab_article;
    }

    public static function afficherCategorie($tab){
        foreach ($tab as $element) {
            echo "<p>" . $element->getNomCategorie() . " </p>";
        }
    }


    public static function addCategorieProgramme($idProgramme,$categorie){
        foreach ($categorie as $c1) {
            $categorie_bis = ModelCategorie::selectByAttribut("nomCategorie",$c1);
            $idCategorie = $categorie_bis[0]->getIdCategorie();
            try {
                $stmt = Model::$pdo->prepare("INSERT INTO CategorieProgramme (idCategorie,idProgramme) VALUES ('$idCategorie', '$idProgramme')");
            } catch (PDOException $e) {
                echo $e->getMessage(); // affiche un message d'erreur
                die();
            }
            $stmt->execute(array('idCategorie' => $idCategorie, 'idProgramme' => $idProgramme));
        }

    }
}
?>