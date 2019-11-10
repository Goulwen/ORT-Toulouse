<?php

class Controller {
	// controller qui va afficher le head
	public function headView(){
		// Affiche la navigation
		include('views/htmlHead.php');
	}
	// controller qui va afficher le script
	public function scriptView(){
		// Affiche la navigation
		include('views/htmlScript.php');
	}

	// controller qui va afficher la nav
	public function navView($infoUser, $level){
		// Affiche la navigation
		include('views/nav.php');
		echo "<div class=\"sousNav\"></div>";
	}

	// controller qui va afficher la page d'identification
	public function homeView($erreur){
		// Affiche page de login
		include('views/login.php');
	}

	// controller qui va verifier si identification est correct
	public function homeModele($formValid = "", $nom = "", $pwd = "", $connexionBDD){
		// Verifie si login Bon
		$validation = htmlentities($formValid, ENT_QUOTES);
		if ($validation !== "" && $validation === "Valider"){
			$nomUser = htmlentities($nom, ENT_QUOTES);
			$mdpUser = htmlentities($pwd, ENT_QUOTES);

			// Verif champs identifiant et mot de passe
			if ($nomUser !== "" && $mdpUser !== ""){
				// Requete sur la BDD (modele)
				$verifUser = $connexionBDD->verifUser($nomUser, $mdpUser);

				// Si trouvé
				if ($verifUser){
					//Création Cookies
					foreach ($verifUser as $value) {
						$idUser = $value["id_user"];
						$nomUser = $value["nom_user"];
						$prenomUser = $value["prenom_user"];
						$emailUser = $value["email_user"];
						$mdpUser = $value["mdp_user"];
						$levelUser = $value["level_user"];

						$tabUserInfo['id'] = $idUser;
						$tabUserInfo['nom'] = $nomUser;
						$tabUserInfo['prenom'] = $prenomUser;
						$tabUserInfo['email'] = $emailUser;
						$tabUserInfo['mdp'] = $mdpUser;
						$tabUserInfo['level'] = $levelUser;
					}
					$tabUserInfo = urlencode(serialize($tabUserInfo));
					setcookie("infoUser", $tabUserInfo, time() + 172800, '/');

					// redirection (view)
					echo "<script language=\"JavaScript\">
					setTimeout(\"window.location='http://localhost/devoir_php'\",0);
					</script>";
					exit();
				} else {
					return false;
				}

			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	// controller qui va recuperer les taches
	public function tacheModele($idUser, $connexionBDD, $statut = 0){
		switch ($statut) {
			case 1:
			$titre = "Liste des taches en cours";
			$titreVide = "Il n'y a aucune tache en cours";
			$valueInput = "Ajouter une tache";
			$hrefInput = "ajoutTache";
			break;
			
			case 2:
			$titre = "Liste des taches terminées";
			$titreVide = "Il n'y a aucune tache terminée";
			$valueInput = "Visualiser toutes les taches";
			$hrefInput = "";
			break;
			
			default:
			$titre = "Liste des taches";
			$titreVide = "Il n'y a aucune tache";
			$valueInput = "Ajouter une tache";
			$hrefInput = "ajoutTache";
			break;
		}
		// Récupère liste tache BDD
		// Requete sur la BDD (modele)
		$recupTache = $connexionBDD->recupTache($idUser, $statut);
		// (view)
		self::tacheView($recupTache, $titre, $titreVide, $valueInput, $hrefInput);
	}
	// controller qui va afficher les taches
	public function tacheView($donneesRecup, $titre, $titreVide, $valueInput, $hrefInput){
		// Affiche liste des taches
		if (empty($donneesRecup)){
			// Si c'est vide, pas de données alors affiche page vide
			include('views/tacheVide.php');
		} else {
			// Sinon affichage des données
			include('views/listeTaches.php');
		}
	}

	// controller qui va afficher l'ajout d'une tache
	public function ajoutTacheView(){
		// Affiche page d'ajout des taches
		include('views/ajoutTaches.php');
	}
	// controller qui va inserer la nouvelle tache
	public function ajoutTacheModele($nomTache, $idUser, $connexionBDD){
		// Insert ajout taches en bdd
		// Requete sur la BDD (modele)
		$connexionBDD->ajoutTache($idUser, $nomTache);
		// (view)
		self::tacheModele($idUser, $connexionBDD);
	}

	// controller qui va mettre à jour les taches
	public function updateTacheModele($idTache, $idUser, $nom, $newStatut = 0, $connexionBDD){
		// Modifie taches en bdd
		// Requete sur la BDD (modele)
		$connexionBDD->updateTache($idTache, $idUser, $nom, $newStatut);
		// (view)
		self::tacheModele($idUser, $connexionBDD, $newStatut);
	}

	// controller qui va supprimer les taches
	public function deleteTacheModele($idTache, $idUser, $connexionBDD){
		// Supprime taches en bdd
		// Requete sur la BDD (modele)
		$connexionBDD->deleteTache($idTache, $idUser);
		// (view)
		self::tacheModele($idUser, $connexionBDD);
	}
	
	// controller qui va recuperer les utilisateur
	public function userController($idUser, $level, $connexionBDD){
		// Affiche utilisateur
		// Requete sur la BDD (modele)
		$donneesRecup = $connexionBDD->recupUser($idUser, $level);
		// (view)
		self::userView($donneesRecup);
	}

	// controller qui va inserer le nouvel utilisateur
	public function ajoutUserModele($idUser, $levelUser, $nom, $prenom, $email, $mdp, $level, $connexionBDD){
		// Insert ajout taches en bdd
		// Requete sur la BDD (modele)
		$connexionBDD->ajoutUser($nom, $prenom, $email, $mdp, $level);
		// (view)
		self::userController($idUser, $levelUser, $connexionBDD);
	}

	// controller qui va afficher l'ajout d'un utilisateur
	public function ajoutUser($level){
		// Affiche page d'ajout des taches
		if ($level !== 1){
			return false;
		} else {
			include('views/ajoutUser.php');
		}
	}

	// controller qui va afficher la page des utilisateurs
	public function userView($donneesRecup){
		$titre = "Liste des utilisateurs";
		// Affiche page liste des utilisateurs
		include('views/listeUser.php');
	}

	// controller qui va mettre à jour les utiisateur
	public function updateUserModele($levelUser, $idUser, $nom, $prenom, $email, $mdp, $level, $connexionBDD){
		// Modifie utilisateur en bdd
		// Requete sur la BDD (modele)
		$connexionBDD->updateUser($idUser, $nom, $prenom, $email, $mdp, $level);
		// (view)
		self::userController($idUser, $levelUser, $connexionBDD);
	}

	// controller qui va supprimer les utilisateurs
	public function deleteUserModele($levelUser, $idUser, $connexionBDD){
		// Supprime utilisateur en bdd
		// Requete sur la BDD (modele)
		$connexionBDD->deleteUser($idUser);
		// (view)
		self::userController($idUser, $levelUser, $connexionBDD);
	}

	// controller qui va afficher la page d'erreur
	public function erreurView(){
		// Affiche page de erreur
		include('views/erreur.php');
	}

	// controller qui va deconnecter un utilisateur
	public function deconnexion(){
		// Suppression du cookies
		setcookie("infoUser", "", time() - 172800, '/');
		unset($_COOKIE["infoUser"]);
		// redirection
		echo "<script language=\"JavaScript\">
		setTimeout(\"window.location='http://localhost/devoir_php'\",0);
		</script>";
		exit();
	}


}
