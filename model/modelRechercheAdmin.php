<?php
    require_once File::build_path(array('model','Model.php'));
    require_once File::build_path(array('model','ModelProgramme.php'));

    class ModelRechercheAdmin extends Model
    {

    	public static function getResultat(){
	        $r_programme ="SELECT P.idProgramme FROM Programme P";

			if (isset($_POST['programme'])){
			    $programme = $_POST['programme'];
			    $r_programme = "SELECT P.idProgramme FROM Programme P
			    WHERE P.titreCategorie = "."'"."$programme"."'"." ";
			}
			
			try{ $rep = Model::$pdo->query("SELECT p.titreProgramme FROM Programme P WHERE P.idProgramme");
			}

			catch (PDOException $e) {
			    if (Conf::getDebug()) { echo $e->getMessage();}
			    else { echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';}
			    die();
			}

			$rep->setFetchMode(PDO::FETCH_CLASS, 'ModelProgramme');
			$tab_resulatAdmin = $rep->fetchAll();
			return $tab_resulatAdmin;
		}	
	}
?>