<?php
    require_once File::build_path(array('config','Conf.php'));

/**
 * Class Model
 */
class Model {
		public static $pdo;
		public static function Init(){
			$hostname = Conf::getHostname();
			$database_name = Conf::getDatabase();
			$login = Conf::getLogin();
			$password = Conf::getPassword();
			try{
				self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name", $login, $password,
					array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

				// On active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
				self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(PDOException $e) {
				if (Conf::getDebug()) {
					echo $e->getMessage(); // affiche un message d'erreur
				} else {
					echo 'Une erreur est survenue <a href="#"> retour a la page d\'accueil </a>';
				}
				die();
			}
		}
        public static function selectAll(){
		    $table_name = static::$object;
		    $table_name = ucfirst($table_name);
            $class_name = 'Model' . $table_name;

            try{ $rep = Model::$pdo->query("SELECT * FROM $table_name ");}

            catch (PDOException $e) {
                if (Conf::getDebug()) { echo $e->getMessage();}
                else { echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';}
                die();
            }

            $rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
            $tab_article = $rep->fetchAll();

            return $tab_article;
        }

    /**
     * @param $primary_value
     * @return mixed
     */
    public static function select($primary_value){
            $table_name = static::$object;
            $table_name = ucfirst($table_name);
            $class_name = 'Model' . $table_name;
            $primary_key = static::$primary;
            try {
                $rep = Model::$pdo->prepare("SELECT * FROM $table_name WHERE $primary_key=" . $primary_value . " ");
            }
            catch (PDOException $e) {
                echo $e->getMessage(); // affiche un message d'erreur
                die();
            }
            $rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
            $tab_article = $rep->fetchAll();

            return $tab_article;
        }

        public static function update($primary_value, $colonne, $value) {
            $table_name = static::$object;
            $table_name = ucfirst($table_name);
            $class_name = 'Model' . $table_name;
            $primary_key = static::$primary;

            try {
                $rep = Model::$pdo->prepare("UPDATE $table_name SET $colonne=:value  WHERE $primary_key=:primary_value");
            }

            catch (PDOException $e) {
                echo $e->getMessage(); // affiche un message d'erreur
                die();
            }

            $rep->execute(array('value' => $value,
                                'primary_value' => $primary_value));
        }

    public static function selectByAttribut($colonne, $value)
    {
        $table_name = static::$object;
        $table_name = ucfirst($table_name);
        $class_name = 'Model' . $table_name;
        $primary_key = static::$primary;

        try {
            $rep = Model::$pdo->prepare("SELECT * FROM $table_name WHERE $colonne=:value");
        } catch (PDOException $e) {
            echo $e->getMessage(); // affiche un message d'erreur
            die();
        }
        $rep->execute(array('value' => $value));

        $rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
        $tab_article = $rep->fetchAll();

        return $tab_article;
    }

        public static function selectAttributById($primary_value, $value) {
            $table_name = static::$object;
            $table_name = ucfirst($table_name);
            $class_name = 'Model' . $table_name;
            $primary_key = static::$primary;

            try {
                $rep = Model::$pdo->prepare("SELECT $value FROM $table_name WHERE $primary_key=:primary_value");
            }

            catch (PDOException $e) {
                echo $e->getMessage(); // affiche un message d'erreur
                die();
            }

        $rep->execute(array('primary_value' => $primary_value));
            $titre = $rep->fetch();
            return $titre[$value];
    }

        public static function delete($primary_value){
            $table_name = static::$object;
            $table_name = ucfirst($table_name);
            $primary_key = static::$primary;
            try {
                $stmt = Model::$pdo->prepare("DELETE FROM $table_name WHERE $primary_key=:primary_value");
            }
            catch (PDOException $e) {
                echo $e->getMessage(); // affiche un message d'erreur
                die();
            }
            $stmt->execute(array('primary_value' => $primary_value));
        }
}
	Model::Init();


?>