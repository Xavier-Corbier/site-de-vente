<?php
require_once (File::build_path(array("model","ModelUtilisateur.php"))); // chargement du modèle
require_once (File::build_path(array("lib","Security.php"))); // chargement du modèle
require_once (File::build_path(array("lib","Session.php"))); // chargement du modèle

class ControllerUtilisateur {
    protected static $object = 'utilisateur';
    public static function readAll() {
        if (Session::is_admin()) {
            $tab_v = ModelUtilisateur::selectAll();     //appel au modèle pour gerer la BD
            $view='list';
            $pagetitle='Liste des Utilisateurs';
            require (File::build_path(array("view","view.php")));  //"redirige" vers la vue
        } else {
            $control='ControllerUtilisateur';
            $page='connect';
            $control::$page();
        }
        
    }
    public static function read() {
        if ($_GET['login']===$_SESSION['login'] or Session::is_admin()==true) {
            $v = ModelUtilisateur::select($_GET['login']);     //appel au modèle pour gerer la BD
            $view='';
            $pagetitle='';
            if ($v==null) {
                $view='error';
                $pagetitle='Erreur de lecture';                                   //"redirige" vers la vue
            } else {
                $view='detail';
                $pagetitle='Détail '.$_GET['login'] ;                   //"redirige" vers la vue
            }
            require (File::build_path(array("view","view.php")));
        } else {
            $control='ControllerUtilisateur';
            $page='connect';
            $control::$page();
        }  	
    }
    public static function delete() {
    	if ($_GET['login']===$_SESSION['login'] or Session::is_admin()==true) {
	        if (ModelUtilisateur::delete($_GET['login'])===false) {
	            $view='error';
	            $pagetitle='Erreur suppression';
                require (File::build_path(array("view","view.php")));
	        } else {
	            self::deconnected();
	        }
        } else {
            $control='ControllerUtilisateur';
            $page='connect';
            $control::$page();
        }
    }
    public static function create() {
        $input="required";
        $effect="created";
        $v = new ModelUtilisateur();
        $view='update';
        $pagetitle='Inscription';
        require (File::build_path(array("view","view.php")));  //"redirige" vers la vue
    }
    public static function created() {
    	$_POST['nonce']=Security::generateRandomHex();
        if ($_POST['mdp']===$_POST['mdpbis']) {
            unset($_POST['mdpbis']);
            $_POST['mdp'] = Security::chiffrer($_POST['mdp']);
            if (ModelUtilisateur::save($_POST)===false&&!(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))) {
                $view='error';
                $pagetitle='Erreur insertion';
            } else {
                $tab_v = ModelUtilisateur::selectAll();
                $view='created';
                $pagetitle='Liste des Utilisateurs';
                $mail='Salut! Rejoins Amazon 2.0 !
                       http://webinfo.iutmontp.univ-montp2.fr/~corbierx/Amazon2/?action=validate&controller=Utilisateur&login='.$_POST['login'].'&nonce='.$_POST['nonce'].'
                       ';
		mail($_POST['email'], 'Inscription', $mail);
            }
        } else {
            $view='error';
            $pagetitle='Erreur mot de passe';
        }
        
        require (File::build_path(array("view","view.php")));

    }
    public static function update() {
        if ($_GET['login']===$_SESSION['login'] or Session::is_admin()===true) {
            $effect="updated";
            $input="readonly";
            $v = ModelUtilisateur::select($_GET['login']);
            $view='update';
            $pagetitle='Mise à jour';
            require (File::build_path(array("view","view.php")));
        } else {
            $control='ControllerUtilisateur';
            $page='connect';
            $control::$page();
        }
        
    }
    public static function updated() {

    	if ($_POST['admin']!==NULL) {
    		$_POST['admin']=1;
    	} else {
    		$_POST['admin']=0;
    	}
    	if ($_POST['login']===$_SESSION['login'] or Session::is_admin()==true) {
    		if(Session::is_admin()){
    			if (ModelUtilisateur::update($_POST)===false) {
    	              		  $view='error';
    	             	          $pagetitle='Erreur mise à jour';
    	                    } else {
    	                	$tab_v = ModelUtilisateur::selectAll();
    	                	$view='updated';
    	                	$pagetitle='Liste des utilisateurs';
    	            	   }
    		} else {
            		if ($_POST['mdp']===$_POST['mdpbis']) {
    	        	    unset($_POST['mdpbis']);
    	       	            $_POST['mdp'] = Security::chiffrer($_POST['mdp']);
    	          	    if (ModelUtilisateur::update($_POST)===false) {
    	              		  $view='error';
    	             	          $pagetitle='Erreur mise à jour';
    	                    } else {
    	                	$tab_v = ModelUtilisateur::selectAll();
    	                	$view='updated';
    	                	$pagetitle='Liste des utilisateurs';
    	            	   }
    	        	} else {
    	            		$view='error';
    	            		$pagetitle='Erreur mot de passe';
    	        	}
    		}
            require (File::build_path(array("view","view.php")));
        } else {
            $control='ControllerUtilisateur';
            $page='connect';
            $control::$page();
        }
    }
    public static function connect() {
        $view='connect';
        $pagetitle='Connexion';
        require (File::build_path(array("view","view.php")));  //"redirige" vers la vue
    }
    public static function connected() {
            $_POST['mdp']=Security::chiffrer($_POST['mdp']);
            $compte=ModelUtilisateur::select($_POST['login']);
            if (ModelUtilisateur::checkPassword($_POST['login'],$_POST['mdp'])===true&&($compte->get("nonce")==NULL)) {
                $_SESSION['login']=$_POST['login'];
                $v = ModelUtilisateur::select($_POST['login']);
                if ($v->get('admin')==1) {
                	$_SESSION['admin']=true;
                }
                $view='detail';
                $pagetitle='Profil' ;
            } else {
                $view='connect';
                $pagetitle='Connexion';
                $login=$_POST['login'];
            }
        
        require (File::build_path(array("view","view.php")));
    }

    public static function deconnected(){
            session_unset();     // unset $_SESSION variable for the run-time 
            session_destroy();   // destroy session data in storage
            $control='ControllerUtilisateur';
            $page='connect';
            $control::$page();
    }
    public static function validate(){
        if (!(ModelUtilisateur::select($_GET['login'])==false)&&(ModelUtilisateur::select($_GET['login'])->get("nonce")===$_GET['nonce'])) {
            $data= array(
            	'login' => $_GET['login'],
            	'nonce' => NULL
            );
            ModelUtilisateur::update($data);
            $control='ControllerUtilisateur';
            $page='connect';
            $control::$page();
        }
    }
}
?>