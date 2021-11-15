<?php
require_once File::build_path(array("model", "Model.php"));

class ModelCommande extends Model{

    private $idCommande;
    private $login; // ajouter à la création par un <select>
    private $dateCommande;
    private $prix;
    private $statut;
    protected static $objet = 'Commande';
    protected static $primary='idCommande';

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

    public static function saveLigneCommande($idCommande,$idProduit,$quantite) {
        try {
        $sql = "INSERT INTO LigneCommande (idCommande, idProduit, quantite) VALUES (:idCommande, :idProduit, :quantite)";
        // Préparation de la requête
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
            "idCommande" => $idCommande,
            "idProduit" => $idProduit,
            "quantite" => $quantite
        );
        $req_prep->execute($values);
        return true;
        }
        catch (PDOException $e){
            return false;
        }
    }

    public static function selectCommandeLogin($login) {
        try {
            $sql = "SELECT * FROM Commande WHERE login = :login";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);
            $values = array(
                "login" => $login
            );
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, "ModelCommande");
            $tab = $req_prep->fetchAll();
            if(empty($tab)){
                return false;
            }
            else{
                return $tab;
            }
        }
        catch (PDOException $e){
            return false;
        }
    }

    public static function updateStatutEnvoyer($idCommande,$statut){
        try {
            $sql = "UPDATE Commande SET statut = :statut WHERE idCommande=:idCommande";
            $req_prep = Model::$pdo->prepare($sql);
            $values = array(
                "idCommande" => $idCommande,
                "statut" => $statut
            );
            $req_prep->execute($values);
            return true;
        }
        catch (PDOException $e){
            return false;
        }
    }

    public static function getDetail($idCommande){
        try {
            $sql = "SELECT * FROM LigneCommande WHERE idCommande = :id";
            $req_prep = Model::$pdo->prepare($sql);
            $values = array(
                "id" => $idCommande
            );
            $req_prep->execute($values);
            $tab = $req_prep->fetchAll(PDO::FETCH_ASSOC);
            return $tab;
        }
        catch (PDOException $e){
            return false;
        }
    }

}
?>