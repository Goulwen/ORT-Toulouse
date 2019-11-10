<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-center fixed-top">
    <span class="navbar-text"><?php echo ucfirst(strtolower($infoUser['prenom'])).' '.strtoupper($infoUser['nom']); ?></span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto">
            <!-- Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Voir Taches
                </a>
                <div class="dropdown-menu bg-dark navbar-dark">
                    <a class="nav-link" href="?page=voirTacheEnCours">En cours</a>
                    <a class="nav-link" href="?page=voirTacheTerminee">Terminée</a>
                    <a class="nav-link" href="?page">Toutes</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=ajoutTache">Ajouter une tache</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <?php
            // Si admin connecter peut ajouer, modifier ou supprimer des utilisateurs
            // admin : level = 1
            if ($level === 1){
                ?>
                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Utilisateur
                    </a>
                    <div class="dropdown-menu bg-dark navbar-dark">
                        <a class="nav-link" href="?page=voirUser">Liste</a>
                        <a class="nav-link" href="?page=ajoutUser">Ajouter</a>
                    </div>
                </li>
                <?php
            }
            ?>
            <li class="nav-item">
                <a class="nav-link" href="?page=deconnexion">Se déconnecter</a>
            </li>
        </ul>
    </div>
</nav>
