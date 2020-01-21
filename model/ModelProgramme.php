<?php
    require_once File::build_path(array('model','Model.php'));
    require_once File::build_path(array('model','ModelActeur.php'));
    require_once File::build_path(array('model','ModelLangue.php'));
    require_once File::build_path(array('model','ModelProducteur.php'));
    require_once File::build_path(array('model','ModelRealisateur.php'));
    require_once File::build_path(array('model','ModelCategorie.php'));
    
    class ModelProgramme extends Model {
        private $idProgramme;
        private $titreProgramme;
        private $descriptionProgramme;
        private $paysProgramme;
        private $dureeProgramme;
        private $urlImage;
        private $prixProgramme;
        protected static $object='programme';
        protected static $primary='idProgramme';



        public function getIdProgramme() {return $this->idProgramme;}
        public function getTitreProgramme() {return $this->titreProgramme;}
        public function getDescriptionProgramme() {return $this->descriptionProgramme;}
        public function getPaysProgramme() {return $this->paysProgramme;}
        public function getDureeProgramme() {return $this->dureeProgramme;}
        public function getUrlImageProgramme() {return $this->urlImage;}
        public function getPrixProgramme() {return $this->prixProgramme;}

        public function afficher(){
            $img = $this->urlImage;
            echo "<div class=\"col s12 l6\">
                    <div class=\"card\">
                        <div class=\"card-content center\">
                        <h5>" . $this->titreProgramme . "</h5><br> <img  style=\"width: 80%;\" src=\"$img\">" . '<br>';
                echo 'Synopsis :  ' . $this->descriptionProgramme . '<br> Durée du film : ' . $this->dureeProgramme . '<br> Pays du film : ' . $this->paysProgramme . '<br> Prix : ' . $this->prixProgramme . '€ <br>';
                echo '<div class="card">
                            <div class="card-content center"> Acteurs : <div>';
                echo ModelActeur::afficherActeur(ModelActeur::getActeurById($this->idProgramme));
                echo "    </div>
                        </div>
                      </div>";
                echo "<div class=\"col s12 l6\">
                        <div class=\"card\">
                            <div class=\"card-content center\"> Producteur(s) :";
                echo ModelProducteur::afficherProducteur(ModelProducteur::getProducteurById($this->idProgramme));
                echo "    </div>
                        </div>
                      </div>";
                echo " <div class=\"col s12 l6\">
                        <div class=\"card\">
                            <div class=\"card-content center\"> Realisateur(s) :";
                echo ModelRealisateur::afficherRealisateur(ModelRealisateur::getRealisateurById($this->idProgramme));
                echo "    </div>
                        </div>
                      </div>";
                echo " <div class=\"col s12 l6\">
                        <div class=\"card\">
                            <div class=\"card-content center\"> Categorie(s) :";
                echo ModelCategorie::afficherCategorie(ModelCategorie::getCategorieById($this->idProgramme));
                echo "    </div>
                        </div>
                      </div>";
                echo " <div class=\"col s12 l6\">
                        <div class=\"card\">
                            <div class=\"card-content center\"> Langues : ";
                echo ModelLangue::afficherLangue(ModelLangue::getLangueById($this->idProgramme));
                echo "    </div>
                        </div>
                      </div>";
                echo "
                <a class=\"btn waves-effect waves-light black\" href=\"index.php?action=ajouterPanier&id=" . $this->idProgramme . "\">Ajouter au panier<i class=\"material-icons right\">add_shopping_cart</i></a> 
                </div>
            </div>
            </div>";
        }

        public static function addProgramme($nom,$description,$pays,$duree,$prix)
        {
            try {
                $stmt = Model::$pdo->prepare("INSERT INTO Programme (titreProgramme,descriptionProgramme,paysProgramme,dureeProgramme,prixProgramme) VALUES (:nom, :description, :pays, :duree, :prix)");
            } catch (PDOException $e) {
                echo $e->getMessage(); // affiche un message d'erreur
                die();
            }


            $stmt->execute(array("nom" => $nom,
                "description" => $description,
                "pays" => $pays,
                "duree" => $duree,
                "prix" => $prix));
        }

        public static function getIdLastProgramme(){
            try{ $sql = Model::$pdo->query("SELECT MAX(idProgramme) FROM Programme" );}

            catch (PDOException $e) {
                if (Conf::getDebug()) { echo $e->getMessage();}
                else { echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';}
                die();
            }

            $res = $sql->fetch();
            return $res[0];
        }

        public static function getProgrammeByTitre($titre){
            try {
                $rep = Model::$pdo->prepare("SELECT * FROM Programme P WHERE P.titreProgramme=:titre");
            }
            catch (PDOException $e) {
                echo $e->getMessage(); // affiche un message d'erreur
                die();
            }
            $rep->execute(array('titre' => $titre));

            $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelProgramme');
            $tab_article = $rep->fetchAll();

            return $tab_article;
        }





        // Modification de l'image //
        public static function modifImage($fichier,$id){
            $im = ModelProgramme::getImage($id);
            $var = str_replace("images/","",$im);
            $fichier="images/".$var;
            $fichier= str_replace(" ","",$fichier);
            $array = array(
                "suppression" => "bar",
                "edit" => "foo",
            );



            if (file_exists($fichier)) {
                if (@unlink($fichier)) {
                    $array["suppression"]="Suppression de $fichier réussite </br>";
                } else {
                    $array["suppression"]="Echec de suppression de $fichier : $php_errormsg";
                }
            } else {
                $array["suppression"]="Le fichier $fichier n'existe pas </br>";

            }

            // Vérifier si le formulaire a été soumis
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Vérifie si le fichier a été uploadé sans erreur.
                if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
                    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
                    $filename = $_FILES["photo"]["name"];
                    $filetype = $_FILES["photo"]["type"];
                    $filesize = $_FILES["photo"]["size"];

                    // Vérifie l'extension du fichier
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    if (!array_key_exists($ext, $allowed)) die("Erreur : Veuillez sélectionner un format de fichier valide.");

                    // Vérifie la taille du fichier - 5Mo maximum
                    $maxsize = 5 * 1024 * 1024;
                    if ($filesize > $maxsize) die("Error: La taille du fichier est supérieure à la limite autorisée.");

                    // Vérifie le type MIME du fichier
                    if (in_array($filetype, $allowed)) {
                        // Vérifie si le fichier existe avant de le télécharger.
                        if (file_exists("upload/" . $_FILES["photo"]["name"])) {
                            $array["edit"]=$_FILES["photo"]["name"] . " existe déjà.";

                        } else {
                            move_uploaded_file($_FILES["photo"]["tmp_name"], "images/" . $_FILES["photo"]["name"]);
                            $array["edit"]= "Votre fichier a été téléchargé avec succès.   ".$_FILES["photo"]["name"];


                            $adresse = "images/".$filename;
                            $adresse = str_replace(" ","",$adresse);
                            ModelProgramme::update($id,"urlImage",$adresse);
                        }
                    } else {
                        $array["edit"]= "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer.";
                    }
                } else {
                    echo "Error: " . $_FILES["photo"]["error"];
                }

            }
            return $array;
        }


        public static function getTitre($id) {
            try{
                $sql = Model::$pdo -> query("SELECT * FROM Programme WHERE idProgramme=$id");
            }
            catch (PDOException $e) {
                echo $e->getMessage();
                die();
            }
            $titre = $sql->fetch();
            return $titre['titreProgramme'];
        }

        public static function getDescription($id) {
            try{
                $sql = Model::$pdo -> query("SELECT * FROM Programme WHERE idProgramme=$id");
            }
            catch (PDOException $e) {
                echo $e->getMessage();
                die();
            }
            $description = $sql->fetch();
            return $description['descriptionProgramme'];
        }

        public static function getPays($id) {
            try{
                $sql = Model::$pdo -> query("SELECT * FROM Programme WHERE idProgramme=$id");
            }
            catch (PDOException $e) {
                echo $e->getMessage();
                die();
            }
            $pays = $sql->fetch();
            return $pays['paysProgramme'];
        }

        public static function getDuree($id) {
            try{
                $sql = Model::$pdo -> query("SELECT * FROM Programme WHERE idProgramme=$id");
            }
            catch (PDOException $e) {
                echo $e->getMessage();
                die();
            }
            $duree = $sql->fetch();
            return $duree['dureeProgramme'];
        }

        public static function getImage($id) {
            try{
                $sql = Model::$pdo -> query("SELECT * FROM Programme WHERE idProgramme=$id");
            }
            catch (PDOException $e) {
                echo $e->getMessage();
                die();
            }
            $url = $sql->fetch();
            return $url['urlImage'];
        }

        public static function getPrix($id) {
            try{
                $sql = Model::$pdo -> query("SELECT * FROM Programme WHERE idProgramme=$id");
            }
            catch (PDOException $e) {
                echo $e->getMessage();
                die();
            }
            $prix = $sql->fetch();
            return $prix['prixProgramme'];
        }

        public static function getProgrammeById($id){
            try{
                $rep = Model::$pdo -> query("SELECT * FROM Programme P WHERE P.idProgramme=" . $id . " ");
            }
            catch (PDOException $e) {
                echo $e->getMessage();
                die();
            }
            $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelProgramme');
            $tab_article = $rep->fetchAll();

            return $tab_article[0];
        }

        public static function getProgrammePanierAnterieur(){
            $email = $_SESSION['login'];
            try {
                $rep = Model::$pdo->query("SELECT * FROM Programme P
                                            INNER JOIN ProgrammePanier PP ON P.idProgramme = PP.idProgramme
                                            INNER JOIN Panier Pa ON Pa.idPanier = PP.idPanier
                                            INNER JOIN PossedePanier PPa ON PPa.idPanier = Pa.idPanier
                                            INNER JOIN Utilisateur U ON U.idUtilisateur = PPa.idUtilisateur
                                            WHERE U.emailUtilisateur =\"" . $email . "\"");
            } catch (PDOException $e) {
                if (Conf::getDebug()) {
                    echo $e->getMessage();
                } else {
                    echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
                }
                die();
            }

            $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelProgramme');
            $tab_article = $rep->fetchAll();
            return $tab_article;
        }
    }
?>