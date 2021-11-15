<?php
$controller_default='Accueil';
$action = 'readAll';
$controller_class = "Controller".ucfirst($controller_default);
if (isset($_GET['action'])) {
	$action = $_GET['action'];
}
if (isset($_GET['controller'])) {
	$controller = $_GET['controller'];
	$controller_class = "Controller".ucfirst($controller);
}

require_once File::build_path(array("controller", "ControllerProduit.php"));
require_once File::build_path(array("controller", "ControllerUtilisateur.php"));
require_once File::build_path(array("controller", "ControllerPanier.php"));
require_once File::build_path(array("controller", "ControllerCategorie.php"));
require_once File::build_path(array("controller", "ControllerAdmin.php"));
require_once File::build_path(array("controller", "ControllerAccueil.php"));
require_once File::build_path(array("controller", "ControllerCommande.php"));
if (get_class_methods($controller_class)) {
	if (in_array($action,get_class_methods($controller_class))) {
		$controller_class::$action(); 
	} else { 
	    $pagetitle='Erreur de chargement';
	    $error='404 not found !';
		require_once (File::build_path(array("view","error.php")));
	}
} else { 
    $pagetitle='Erreur de chargement';
    $error='Erreur controller';
    require_once (File::build_path(array("view","error.php")));
}


?>