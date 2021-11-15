<?php
require_once File::build_path(array("model", "ModelProduit.php")); 
require_once File::build_path(array("model", "ModelCategorie.php"));
require_once (File::build_path(array("lib","Upload.php"))); // chargement du modèle

class ControllerProduit{
    protected static $object = 'produit';
    public static function readAll() {
        $tab_Produit = ModelProduit::selectAll(); 
        $view='list';
        $pagetitle='Liste des Produits';
        require (File::build_path(array("view","view.php")));    
    }
    public static function read() {
    	$Produit = ModelProduit::select($_GET['idProduit']);
    	if ($Produit==false) {
    		$view='error';
            $pagetitle='Erreur de recherche';
            $error='Erreur : le Produit n\'existe pas';
            require (File::build_path(array("view","error.php")));
    	} else {
            $tab = ModelProduit::selectProductSimilaire($Produit->get("categorieProduit"));
            $view='detail';
            $pagetitle='Produit '.$Produit->get("nomProduit");
            require (File::build_path(array("view","view.php")));
        }
    }
    public static function create() {
        if (Session::is_admin()) {
            $effect="created";
            $view='update';
            $pagetitle='Création d un Produit';
            $v = new ModelProduit();
            $tab_cat = ModelCategorie::selectAll();
            require (File::build_path(array("view","view.php")));
        } else {
            $control='Controller'.$GLOBALS['$controller_default'];
            $page='readAll';
            $control::$page();
        }
    }

    public static function created() {
        if (Session::is_admin()) {
            if (ModelProduit::save($_POST)===false) {
                $view='error';
                $pagetitle='Erreur insertion';
                $error='Erreur : le Produit existe déjà';
                require (File::build_path(array("view","error.php")));
            } else {
                if (!empty($_FILES['nom-du-fichier']) && is_uploaded_file($_FILES['nom-du-fichier']['tmp_name'])) {
                    Upload::image(ModelProduit::$pdo->lastInsertId(),'nom-du-fichier');
                }
                $tab_Produit = ModelProduit::selectAll();
                $view='created';
                $pagetitle='Liste des Produits';
                require (File::build_path(array("view","view.php")));
            }
        } else {
            $control='Controller'.$GLOBALS['$controller_default'];
            $page='readAll';
            $control::$page();
        }
        
    }
    public static function delete() {

        if (Session::is_admin()) {
            if (ModelProduit::delete($_GET['idProduit'])===false) {
                $view='error';
                $pagetitle='Erreur suppression';
                $error='Erreur : le Produit n existe pas';
                require (File::build_path(array("view","error.php")));
            } else {
                Upload::delete($_GET['idProduit']);
                $tab_Produit = ModelProduit::selectAll();
                $view='deleted';
                $pagetitle='Liste des Produits';
                require (File::build_path(array("view","view.php")));
            }
        } else {
            $control='Controller'.$GLOBALS['$controller_default'];
            $page='readAll';
            $control::$page();
        }
    }
    public static function update() {
        if (Session::is_admin()) {
            $effect="updated";
            $v = ModelProduit::select($_GET['idProduit']);
            if(!empty($v)) {
                $tab_cat = ModelCategorie::selectAll();
                $view = 'update';
                $pagetitle = 'Mise à jour';
                require(File::build_path(array("view", "view.php")));
            }
            else {
                $view='error';
                $pagetitle='Erreur de mise à jour';
                $error='Erreur : le Produit n\'existe pas';
                require (File::build_path(array("view","error.php")));
            }
        } else {
            $control='Controller'.$GLOBALS['$controller_default'];
            $page='readAll';
            $control::$page();
        }
        
    }
    public static function updated() {
        if (Session::is_admin()) {
            if (ModelProduit::update($_POST)===false) {
                $view='error';
                $pagetitle='Erreur mise à jour';
                require (File::build_path(array("view","error.php")));
            } else {
                if (!empty($_FILES['nom-du-fichier']) && is_uploaded_file($_FILES['nom-du-fichier']['tmp_name'])) {
                    Upload::image($_POST['idProduit'],'nom-du-fichier');
                }
                $tab_Produit = ModelProduit::selectAll();
                $view='updated';
                $pagetitle='Liste des produits';
                require (File::build_path(array("view","view.php")));
            }
        } else {
            $control='Controller'.$GLOBALS['$controller_default'];
            $page='readAll';
            $control::$page();
        }
        
    }
    public static function json(){
        $tab = ModelProduit::selectAll();
        echo "[";
        $var = "";
        foreach ($tab as $cle ){
            $var = $var . $cle->toJSON() . ",";
        }
        $var = rtrim($var, ",");
        echo $var;
        echo "]";
    }
}
?>