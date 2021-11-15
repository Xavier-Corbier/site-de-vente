<?php
require_once File::build_path(array("model", "ModelProduit.php")); 
require_once File::build_path(array("model", "ModelCategorie.php")); 

class ControllerAdmin{
    protected static $object = 'admin';
    public static function readAll() {
    	if (Session::is_admin()) {
    		$tab = ModelProduit::getEmpty();
    		$listCode = ModelCodePromo::selectAll();
	        $view='list';
	        $pagetitle='Administration';
	        require (File::build_path(array("view","view.php"))); 
    	} else {
    		$control=$GLOBALS['$controller_default'];
    		$page='readAll';
    		$control::$page();
    	}   
    }
    public static function carousel(){
        $resultat=true;
        $path=getcwd();
        if (Session::is_admin()) {
            if (!empty($_FILES['nom-du-fichier1']) && is_uploaded_file($_FILES['nom-du-fichier1']['tmp_name'])) {
                Upload::delete("accueil1");
                Upload::image("accueil1",'nom-du-fichier1');
            }
            if (!empty($_FILES['nom-du-fichier2']) && is_uploaded_file($_FILES['nom-du-fichier2']['tmp_name'])) {
                Upload::delete("accueil2");
                Upload::image("accueil2",'nom-du-fichier2');
            }
            if (!empty($_FILES['nom-du-fichier3']) && is_uploaded_file($_FILES['nom-du-fichier3']['tmp_name'])) {
                Upload::delete("accueil3");
                Upload::image("accueil3",'nom-du-fichier3');
            }
            $tab = ModelProduit::getEmpty();
            $listCode = ModelCodePromo::selectAll();
            $view='updated';
            $pagetitle='Administration';
            require (File::build_path(array("view","view.php")));
        } else {
            $control='Controller'.$GLOBALS['$controller_default'];
            $page='readAll';
            $control::$page();
        }
    }

    public static function createCodePromo(){
        if (Session::is_admin()) {
            $pourcentage = $_POST['pourcentage'] / 100;
            $expiration = $_POST['expiration'];
            $nomCode = $_POST['nomCode'];
            ModelCodePromo::createCodePromo($nomCode,$pourcentage,$expiration);
            $tabutilisateur = ModelUtilisateur::selectAll();
            $date = date('d-m-Y', strtotime('+'. $expiration. 'day'));
            foreach ($tabutilisateur as $val){
                $mail = $val->get("email");
                $object = "Un cadeau pour vous";
                $content = "Vous avez reçu un code promo de " . $pourcentage *100 . "%\n Pour en profiter, inscrivez ce code : " . $nomCode . " * lors de votre achat.\n 
                *Valable jusqu'au ". $date ."
                \nA bientôt";
                mail($mail,$object,$content);
            }
            $tab = ModelProduit::getEmpty();
            $listCode = ModelCodePromo::selectAll();
            $view = "createdCodePromo";
            $pagetitle = "Code Créer";
            require (File::build_path(array("view","view.php")));
        } else {
            $control='Controller'.$GLOBALS['$controller_default'];
            $page='readAll';
            $control::$page();
        }

    }

    public static function deleteCodePromo(){
        if (Session::is_admin()) {
            $idCode = $_GET['idCode'];
            ModelCodePromo::deleteCodePromo($idCode);
            $tab = ModelProduit::getEmpty();
            $listCode = ModelCodePromo::selectAll();
            $view = "deletedCodePromo";
            $pagetitle = "Code Supprimer";
            require (File::build_path(array("view","view.php")));
        } else {
            $control='Controller'.$GLOBALS['$controller_default'];
            $page='readAll';
            $control::$page();
        }

    }
}
?>