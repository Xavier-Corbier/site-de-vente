<?php
require_once File::build_path(array("model", "ModelCodePromo.php"));
require_once File::build_path(array("model", "ModelPanier.php"));
class ControllerPanier{
    protected static $object = 'panier';
    public static function add(){
        ModelPanier::add();
        header('Location: ./index.php?controller=Panier&action=read');
        exit();
    }
    public static function read(){
        // récupération de la liste des produits dans le $_COOKIE
        if (isset($_COOKIE['panier'])){
            $data=unserialize($_COOKIE['panier']);
            if(!isset($_SESSION['codePromo'])){
                $promo = 1;
            } else {
                $promo = $_SESSION['codePromo'];
            }
            foreach ($data as $cle => $valeur){
                // si le produit n'existe plus dans la base de données
                if (ModelProduit::select($cle)==false) {
                    // supression de la case dans le pannier dont le produit est inexistant
                    unset($data[$cle]);
                }
            }
            // calcul du prix du panier
            $resultat=0;
            foreach ($data as $cle => $valeur){
                if (!(ModelProduit::select($cle)==false)) {
                    $resultat=$resultat+(ModelProduit::select($cle)->get("prixProduit")*$valeur);
                }
            }
            // ajout du pannier dans la session
            $_SESSION['panier'] = $data;
        }
        $view='detail';
        $pagetitle='Votre panier';
        require (File::build_path(array("view","view.php")));
    }
    public static function deleteAll(){
        ModelPanier::deleteAll();
        header('Location: ./index.php?controller=panier&action=read');
        exit();
    }
    public static function delete(){
        ModelPanier::deleteElement();
        header('Location: ./index.php?controller=panier&action=read');
        exit();
    }

    public static function codePromo(){
        ModelPanier::codePromo();
        header('Location: ./index.php?controller=panier&action=read');
        exit();
    }

}
?>