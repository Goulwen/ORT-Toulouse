<?php
// Recuperation des infos de l'utilisateur
(isset($_COOKIE['infoUser'])) ? $infoUser = $_COOKIE['infoUser'] : $infoUser = "";

// Connexion à la bdd
require_once("modele/Bdd.php");
require_once("modele/Requetes.php");
$connexionBDD = new Requetes(new Bdd());

// Initialisation du controller (fera appelle modele/views)
require_once('controller/Controller.php');
$controller = new Controller();

// Pas le temps de faire un rooter alors index est mon rooter
(isset($_POST['connexionUser'])) ? $formUserLogin = $_POST['connexionUser'] : $formUserLogin = "";
// Si le formulaire de login est rempli, je vérifie les id et passe, controller : homeModele
if($formUserLogin !== ""){
	$controller->homeModele($_POST['connexionUser'], $_POST['nomUser'], $_POST['mdpUser'], $connexionBDD);
}
// Si l'utilisateur n'est pas identifier alors page de login
if ($infoUser === ""){
	$erreur = 0;
	// Si utilisateur se trompe alors affiche son erreur, controller : homeView
	if ($formUserLogin !== ""){
		$erreur = 1;
	}
	$controller->homeView($erreur);
} else {
	// Utilisateur connecté recupere les infos du cookies
	$infoUser = unserialize(urldecode($infoUser));

	// Affichage du head et de la nav, controller : headView et navView
	$controller->headView();
	$controller->navView($infoUser, intval($infoUser['level']));

	// Affichage du contenue 'dynamique'
	(isset($_GET['page'])) ? $page = $_GET['page'] : $page = "";

	if ($page === "" || $page === "voirTacheEnCours" || $page === "voirTacheTerminee"){
		// Page d'accueil ou si page voir tache de cliqué : controller tacheModele
		$statut = 0;
		if ($page === "voirTacheEnCours"){
			$statut = 1;
		} else if ($page === "voirTacheTerminee"){
			$statut = 2;
		}
		// recup info bdd tache existante et affiche vue
		$controller->tacheModele(intval($infoUser['id']), $connexionBDD, $statut);
	} else if ($page === "ajoutTache"){
		// Page d'ajout tache
		(isset($_POST['ajoutTache'])) ? $formAjoutTacheBDD = $_POST['ajoutTache'] : $formAjoutTacheBDD = "";

		if ($formAjoutTacheBDD !== ""){
			// insert info bdd tache existante, controller : ajoutTacheModele
			$controller->ajoutTacheModele($_POST['nomTache'], intval($infoUser['id']), $connexionBDD);
		}
		// Affichage vue pour ajouter tache, controller : ajoutTacheView
		$controller->ajoutTacheView();
	} else if ($page === "updateTache"){
		// Page de modif tache, controller : updateTacheModele
		// mise a jour info bdd tache existante et affiche vue
		$controller->updateTacheModele($_POST['numeroTache'], intval($infoUser['id']), $_POST['newNameTache'], $_POST['newStatut'], $connexionBDD);
	} else if ($page === "deleteTache"){
		// Page de suppression tache, controller : deleteTacheModele
		// mise a jour info bdd tache existante et affiche vue
		$controller->deleteTacheModele($_POST['numeroTache'], intval($infoUser['id']), $connexionBDD);
	} else if ($page === "voirUser"){
		// recup info bdd utilisateur existant et affiche vue, controller : userController
		$controller->userController(intval($infoUser['id']), intval($infoUser['level']), $connexionBDD);
	} else if ($page === "ajoutUser"){
		// Page d'ajout utilisateur
		(isset($_POST['ajoutUser'])) ? $formAjoutUserBDD = $_POST['ajoutUser'] : $formAjoutUserBDD = "";

		if ($formAjoutUserBDD !== ""){
			// insert info bdd utilisateur existant, controller : ajoutUserModele
			$controller->ajoutUserModele(intval($infoUser['id']), intval($infoUser['level']), $_POST['nomUser'], $_POST['prenomUser'], $_POST['emailUser'], $_POST['mdpUser'], $_POST['levelUser'], $connexionBDD);
		}
		// Affichage vue pour ajouter tache, controller : ajoutUser
		$controller->ajoutUser(intval($infoUser['level']));
	} else if ($page ===  "updateUser"){
		// Page de modif utilisateur, controller : updateUserModele
		// mise a jour info bdd tache existante et affiche vue
		$controller->updateUserModele(intval($infoUser['level']), $_POST['idUser'], $_POST['newNomUser'], $_POST['newPrenomUser'], $_POST['newEmailUser'], $_POST['newMdpUser'], $_POST['newlevel'], $connexionBDD);
	} else if ($page === "deleteUser"){
		// Page de suppression tache, controller : deleteUserModele
		// mise a jour info bdd tache existante et affiche vue
		$controller->deleteUserModele(intval($infoUser['level']), $_POST['idUser'], $connexionBDD);
	} else if ($page === "deconnexion"){
		// Deconnexion de l'utilisateur, controller : deconnexion
		$controller->deconnexion();
	} else {
		// S'il y a une erreur, controller : erreurView
		$controller->erreurView();
	}
	// Fin du 'dynamique'
	
	// Footer optionnel, je n'en fais pas
	// Affichage des script, controller : scriptView
	$controller->scriptView();
}
?>