<?php
require_once File::build_path(array("model", "ModelCommande.php"));
class ControllerCommande{
    protected static $object = 'commande';

    public static function add() {
    	if (isset($_SESSION['login'])) {
    		if (Session::is_user($_SESSION['login'])) {
	            $data=$_SESSION['panier'];
	            date_default_timezone_set('UTC');
	            $today = date("Y") . "-" .date("m") ."-". date("d");
	            $values = array(
	                "login" => $_SESSION['login'],
	                "DateCommande" => $today,
	                "prix" => $_SESSION['prix'],
	            );
	            $id = ModelCommande::save($values);
	            $content = "Merci pour votre commande, \n voici le détail de votre commande : \n";
	            foreach ($data as $cle => $valeur){
	                    $content .= "" .ModelProduit::select($cle)->get("nomProduit") . "\n";
	                    ModelProduit::updateProduit($cle,$valeur);
	                    ModelCommande::saveLigneCommande($id,$cle,$valeur);
	            }
	            $content .= "Le prix total est de : " . $_SESSION["prix"] . "€";
	            mail(ModelUtilisateur::select($_SESSION['login'])->get("email"),"Merci pour votre commande",$content);
	            setcookie("panier", "", time()-1);
	            unset($_SESSION['codePromo']);
                unset($_SESSION['panier']);
                unset($_SESSION['prix']);
	            $view='list';
	            $pagetitle='Achat terminé';
	            $tab_Commande = ModelCommande::selectCommandeLogin($_SESSION['login']);
	            require (File::build_path(array("view","view.php")));
	        } else {
	            $control='ControllerUtilisateur';
	            $page='connect';
	            $control::$page();
	        }
    	} else {
	            $control='ControllerUtilisateur';
	            $page='connect';
	            $control::$page();
	    }
        
    }

    public static function read(){
        if(Session::is_admin()){
            $view='list';
            $pagetitle='Commandes utilisateurs';
            $tab_Commande = ModelCommande::selectAll();
            require (File::build_path(array("view","view.php")));
        } else if(Session::is_user($_SESSION['login'])){
            $view='list';
            $pagetitle='Mes Commandes';
            $tab_Commande = ModelCommande::selectCommandeLogin($_SESSION['login']);
            require (File::build_path(array("view","view.php")));
        } else {
            $control='Controller'.$GLOBALS['controller_default'];
            $page='readAll';
            $control::$page();
        }
    }

    public static function updateCommandeEnvoyee(){
        if(Session::is_admin()){
            $id = $_GET['idCommande'];
            if(ModelCommande::updateStatutEnvoyer($id,"Envoyée")) {
                self::read();
                mail(ModelUtilisateur::select(ModelCommande::select($id)->get("login"))->get("email"),"Votre commande vient d'être envoyée", "Bonne nouvelle, \n Votre commande vient d'etre envoyée, vous la recevrez d'ici peu\nMerci pour votre confiance. ");
            }
            else{
                $view='error';
                $pagetitle='Erreur de mise à jour';
                require (File::build_path(array("view","error.php")));
            }
        } else {
            $control='Controller'.$GLOBALS['controller_default'];
            $page='readAll';
            $control::$page();
        }
    }

    public static function updateCommandeAnnuler(){
        $id = $_GET['idCommande'];
        if(Session::is_admin()|| (ModelCommande::select($id)->get("login")==$_SESSION["login"])){ // ce if sert à vérifier qu'un n'utilisateur n'est pas accès à la commande d'un autre
            ModelCommande::updateStatutEnvoyer($id,"Annulée");
            mail(ModelUtilisateur::select(ModelCommande::select($id)->get("login"))->get("email"),"Votre commande vient d'être annuléee", "Votre commande a bien été annulée.");
            $view='cancel';
            $pagetitle='Commande annulée';
            $tab_Commande = ModelCommande::selectCommandeLogin($_SESSION['login']);
            require (File::build_path(array("view","view.php")));
        } else {
            $control='Controller'.$GLOBALS['controller_default'];
            $page='readAll';
            $control::$page();
        }
    }

    public static function detailCommande(){
        $idCommande = $_GET['idCommande'];
        if(Session::is_admin() || (ModelCommande::select($idCommande)->get("login")==$_SESSION["login"])){
            $view='detail';
            $pagetitle='Détail de la commande';
            $tab_detail = ModelCommande::getDetail($idCommande);
            if(empty($tab_detail)){
                $pagetitle='Commande introuvable';
                $error = "Commande introuvable";
                require (File::build_path(array("view","error.php")));
            }
            require (File::build_path(array("view","view.php")));
        }
        else {
            $control='Controller'.$GLOBALS['controller_default'];
            $page='readAll';
            $control::$page();
        }
    }

}
?>