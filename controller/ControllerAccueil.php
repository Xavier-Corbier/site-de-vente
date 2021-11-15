<?php
require_once File::build_path(array("model", "ModelProduit.php"));
require_once File::build_path(array("model", "ModelCategorie.php"));

class ControllerAccueil{
    protected static $object = 'accueil';
    public static function readAll() {
        $tab_Produit = ModelProduit::selectAll();
        $view='list';
        $pagetitle='Accueil';
        require (File::build_path(array("view","view.php")));
    }
}
?>