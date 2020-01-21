<?php
require_once File::build_path(array('model','Model.php'));

class ModelActeur extends Model
{
    private $idActeur;
    private $nomActeur;
    private $prenomActeur;
    protected static $object='acteur';
    protected static $primary='idActeur';

    public function getIdActeur()
    {
        return $this->idActeur;
    }

    public function getNomActeur()
    {
        return $this->nomActeur;
    }

    public function getPrenomActeur()
    {
        return $this->prenomActeur;
    }

    public static function getActeurById($idProgramme){

        try{ $rep = Model::$pdo->query("SELECT * FROM Acteur A
                                            INNER JOIN ActeurProgramme AP ON A.idActeur = AP.idActeur
                                            INNER JOIN Programme P ON P.idProgramme = AP.idProgramme
                                            WHERE P.idProgramme =". $idProgramme ." ");}

        catch (PDOException $e) {
            if (Conf::getDebug()) { echo $e->getMessage();}
            else { echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';}
            die();
        }

        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelActeur');
        $tab_article = $rep->fetchAll();

        return $tab_article;
    }

    public static function afficherActeur($tab){
        foreach ($tab as $element) {
            echo "<p>" . $element->getPrenomActeur() . " " . $element->getNomActeur() . " </p>";
        }
    }


    public static function addActeurProgramme($idProgramme,$acteur){

            foreach ($acteur as $a1) {
                $a1=explode(" ", "$a1");
                $acteur_bis = ModelActeur::selectByAttribut("nomActeur",$a1[1]);
                $idActeur = $acteur_bis[0]->getIdActeur();
                try {
                    $stmt = Model::$pdo->prepare("INSERT INTO ActeurProgramme (idActeur,idProgramme) VALUES ('$idActeur ', '$idProgramme')");
                } catch (PDOException $e) {
                    echo $e->getMessage(); // affiche un message d'erreur
                    die();
                }
                $stmt->execute(array('idActeur' => $idActeur, 'idProgramme' => $idProgramme));

        }


    }
}
?>