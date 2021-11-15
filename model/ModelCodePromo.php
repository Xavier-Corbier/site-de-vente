<?php
require_once File::build_path(array("model", "Model.php"));

class ModelCodePromo extends Model{

    private $idCode;
    private $pourcentage; // ajouter à la création par un <select>
    private $date;
    protected static $objet = 'CodePromo';
    protected static $primary='idCode';

    public function __construct($v = NULL) {
        if (!is_null($v)) {
            $this->valeur = $v;
        }
    }

    // Getter générique (pas expliqué en TD)
    public function get($nom_attribut) {
        if (property_exists($this, $nom_attribut))
            return $this->$nom_attribut;
        return false;
    }

    // Setter générique (pas expliqué en TD)
    public function set($nom_attribut, $valeur) {
        if (property_exists($this, $nom_attribut))
            $this->$nom_attribut = $valeur;
        return false;
    }

    public static function selectCodePromo($primary_value) {
        $table_name = ucfirst(static::$objet);
        $class_name = 'Model'.$table_name;
        $primary_key = ucfirst(static::$primary);
        $sql = "SELECT * from $table_name WHERE $primary_key=:nom_tag AND DATEDIFF(date, NOW()) >= 0;";
        // Préparation de la requête
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
            "nom_tag" => $primary_value,
        );
        // On donne les valeurs et on exécute la requête
        $req_prep->execute($values);
        // On récupère les résultats comme précédemment
        $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
        $tab = $req_prep->fetchAll();
        // Attention, si il n'y a pas de résultats, on renvoie false
        if (empty($tab))
            return false;
        return $tab[0];
    }

    public static function createCodePromo($code,$pourcentage,$expiration){
        try {
            $sql = "INSERT INTO CodePromo (idCode, Date, pourcentage) VALUES (:code, ADDDATE(NOW(), :expiration) , 	:pourcentage)";
            $values = array(
                "code" => $code,
                "pourcentage" => $pourcentage,
                "expiration" => $expiration
            );
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->execute($values);
            return true;
        }
        catch (PDOException $e){
            return false;
        }
    }

    public static function deleteCodePromo($code){
        try {
            $sql = "DELETE FROM CodePromo WHERE idCode = :code";
            $values = array(
                "code" => $code,
            );
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->execute($values);
            return true;
        }
        catch (PDOException $e){
            return false;
        }
    }



}
?>