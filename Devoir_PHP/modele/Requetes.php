<?php
class Requetes {

    private $models;

    public function __construct(Bdd $models) {
        $this->models = $models;
    }

    /**
    * Fonction utilisée pour verifier l'utilisateur.
    * @param String $nom qui est l'identifiant de connexion.
    * @param String $mdp qui est le mot de passe de connexion.
    * @return tableau associatif (clé-valeur) ou false.
    *
    */
    public function verifUser($nom, $mdp){
        $queryString = "SELECT id_user, nom_user, prenom_user, email_user, mdp_user, level_user FROM user WHERE email_user = :nomUser AND mdp_user = :mdpUser";

        $nom = htmlentities($nom, ENT_QUOTES);
        $mdp = htmlentities($mdp, ENT_QUOTES);

        if ($nom === "" || $mdp === ""){
            return false;
        } else {
            $query = $this->getModels()->getBdd()->prepare($queryString);
            $query->bindParam('nomUser', $nom);
            $query->bindParam('mdpUser', $mdp);

            $query->execute();

            return $query->fetchAll(\PDO::FETCH_ASSOC);
        }
    }

    /**
    * Fonction utilisée pour verifier l'utilisateur.
    * @param int $id qui est l'identifiant de l'utilisateur.
    * @param int $statut qui est le statut de la tache : 1 : en cours, 2 : terminee.
    * @return tableau associatif (clé-valeur) ou false.
    *
    */
    public function recupTache($id, $statut){
        $id = intval($id);
        $statut = intval($statut);

        if ($id <= 0){
            return false;
        } else {
            $queryString = "SELECT * FROM taches WHERE id_user = :idUser";
            if ($statut > 0){
                $queryString .= " AND statut = :statut";
            }
            $queryString .= " ORDER BY statut, id_tache, nom_tache";


            $query = $this->getModels()->getBdd()->prepare($queryString);
            $query->bindParam('idUser', $id);

            if ($statut > 0){
                $query->bindParam('statut', $statut);
            }

            $query->execute();

            return $query->fetchAll(\PDO::FETCH_ASSOC);
        }
    }

    /**
    * Fonction utilisée pour ajouter une tache.
    * @param int $idUser qui est l'identifiant de l'utilisateur.
    * @param String $nom qui est le nom de la tache.
    * @param int $statut qui est le statut de la tache : 1 : en cours, 2 : terminee.
    * @return false si erreur.
    *
    */
    public function ajoutTache($idUser, $nom, $statut = 1){
        $idUser = intval($idUser);

        $nom = trim(htmlentities($nom, ENT_QUOTES));
        if ($nom === "" || $idUser <= 0){
            return false;
        } else {
            $queryString = "INSERT INTO taches (id_user, nom_tache, statut) VALUES ($idUser, \"$nom\", $statut)";

            $query = $this->getModels()->getBdd()->prepare($queryString);

            $query->execute();
        }
    }

    /**
    * Fonction utilisée pour mettre a jour une tache.
    * @param int $idTache qui est l'identifiant de la tache.
    * @param int $idUser qui est l'identifiant de l'utilisateur.
    * @param String $nom qui est le nom de la tache.
    * @param int $newStatut qui est le nouveau statut de la tache : 1 : en cours, 2 : terminee.
    * @return false si erreur.
    *
    */
    public function updateTache($idTache, $idUser, $nom, $newStatut){
        $idTache = intval($idTache);
        $idUser = intval($idUser);
        $newStatut = intval($newStatut);

        $nom = trim(htmlentities($nom, ENT_QUOTES));
        if ($nom === "" || $idTache <= 0 || $idUser <= 0){
            return false;
        } else {
            $queryString = "UPDATE taches SET nom_tache = \"$nom\"";

            if ($newStatut > 0){
                $queryString .= ", statut = $newStatut";
            }

            $queryString .= " WHERE id_tache = $idTache AND id_user = $idUser";

            $query = $this->getModels()->getBdd()->prepare($queryString);

            $query->execute();
        }
    }

    /**
    * Fonction utilisée pour supprimer une tache.
    * @param int $idTache qui est l'identifiant de la tache.
    * @param int $idUser qui est l'identifiant de l'utilisateur.
    * @return false si erreur.
    *
    */
    public function deleteTache($idTache, $idUser){
        $idTache = intval($idTache);
        $idUser = intval($idUser);

        if ($idTache <= 0 || $idUser <= 0){
            return false;
        } else {
            $queryString = "DELETE FROM taches WHERE id_tache = $idTache AND id_user = $idUser";

            $query = $this->getModels()->getBdd()->prepare($queryString);

            $query->execute();
        }
    }

    /**
    * Fonction utilisée pour lister les utilisateurs.
    * @param int $idUser qui est l'identifiant de l'utilisateur.
    * @param int $level qui est le niveau utilisateur : 1 : admin, 2 : utilisateur.
    * @return tableau associatif (clé-valeur) ou false.
    *
    */
    public function recupUser($idUser, $level){
        $idUser = intval($idUser);
        $level = intval($level);

        if ($idUser <= 0 || $level !== 1){
            return false;
        } else {
            $queryString = "SELECT * FROM user ORDER BY level_user, nom_user, prenom_user";

            $query = $this->getModels()->getBdd()->prepare($queryString);

            $query->execute();

            return $query->fetchAll(\PDO::FETCH_ASSOC);
        }
    }

    /**
    * Fonction utilisée pour ajouter un utilisateur.
    * @param String $nom qui est le nom de l'utilisateur.
    * @param String $prenom qui est le prenom de l'utilisateur.
    * @param String $email qui est le email de l'utilisateur.
    * @param String $mdp qui est le mdp de l'utilisateur.
    * @param int $level qui est le niveau utilisateur : 1 : admin, 2 : utilisateur.
    * @return false si erreur.
    *
    */
    public function ajoutUser($nom, $prenom, $email, $mdp, $level){
        $nom = trim(htmlentities($nom, ENT_QUOTES));
        $prenom = trim(htmlentities($prenom, ENT_QUOTES));
        $email = trim(htmlentities($email, ENT_QUOTES));
        $mdp = trim(htmlentities($mdp, ENT_QUOTES));

        $level = intval($level);

        if ($level !== 1){
            $level = 0;
        }

        if ($nom === "" || $prenom === "" || $email === "" || $mdp === ""){
            return false;
        } else {
            $verifQuery = "SELECT * FROM user WHERE email_user = \"$email\"";

            $query = $this->getModels()->getBdd()->prepare($verifQuery);
            $query->execute();
            $resultat = $query->rowCount();

            if ($resultat > 0) {
                return false;
            } else {
                $queryString = "INSERT INTO user (nom_user, prenom_user, email_user, mdp_user, level_user) VALUES (\"$nom\", \"$prenom\", \"$email\", \"$mdp\", $level)";

                $query = $this->getModels()->getBdd()->prepare($queryString);

                $query->execute();
            }
        }
    }

    /**
    * Fonction utilisée pour mettre à jour les utilisateurs.
    * @param int $idUser qui est l'identifiant de l'utilisateur.
    * @param String $nom qui est le nom de l'utilisateur.
    * @param String $prenom qui est le prenom de l'utilisateur.
    * @param String $email qui est le email de l'utilisateur.
    * @param String $mdp qui est le mdp de l'utilisateur.
    * @param int $level qui est le niveau utilisateur : 1 : admin, 2 : utilisateur.
    * @return false si erreur.
    *
    */
    public function updateUser($idUser, $nom, $prenom, $email, $mdp, $level){
        $idUser = intval($idUser);
        $level = intval($level);

        $nom = trim(htmlentities($nom, ENT_QUOTES));
        $prenom = trim(htmlentities($prenom, ENT_QUOTES));
        $email = trim(htmlentities($email, ENT_QUOTES));
        $mdp = trim(htmlentities($mdp, ENT_QUOTES));
        if ($nom === "" || $idUser <= 0 || $prenom === "" || $email === "" || $mdp === ""){
            return false;
        } else {
            $queryString = "UPDATE user SET nom_user = \"$nom\", prenom_user = \"$prenom\", email_user = \"$email\", mdp_user = \"$mdp\"";

            if ($level > 0){
                if ($level === 2){
                    $level = 0;
                }
                $queryString .= ", level_user = $level";
            }

            $queryString .= " WHERE id_user = $idUser";

            $query = $this->getModels()->getBdd()->prepare($queryString);

            $query->execute();
        }
    }

    /**
    * Fonction utilisée pour supprimer un utilisateur.
    * @param int $idUser qui est l'identifiant de l'utilisateur.
    * @return false si erreur.
    *
    */
    public function deleteUser($idUser){
        $idUser = intval($idUser);

        if ($idUser <= 0){
            return false;
        } else {
            $queryString = "DELETE FROM user WHERE id_user = $idUser";

            $query = $this->getModels()->getBdd()->prepare($queryString);

            $query->execute();
        }
    }



    // Getter
    public function getModels() {
        return $this->models;
    }


}
