<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Page de connexion</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="assets/style.css"/>
</head>

<body>
    <div class="containerLogin">
        <div class="splash-container">
            <div class="card ">
                <div class="card-header text-center">
                    <div>
                        <span class="splash-description">Veuillez entrer vos identifiants.</span>
                    </div>
                    <?php
                    if ($erreur === 1) {
                        ?>
                        <div>
                            <span class="erreurLog">Erreur de connexion</span>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="card-body">
                    <form method="POST" action="#">
                        <div class="form-group">
                            <input name="nomUser" class="form-control form-control-lg" id="username" type="text" placeholder="Identifiant" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <input name="mdpUser" class="form-control form-control-lg" id="password" type="password" placeholder="Mot de passe" required>
                        </div>
                        <input type="submit" name="connexionUser" value="Valider">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

    <script src="assets/libs/js/animejs/2.0.2/anime.min.js"></script>
    <script>
        // Wrap every letter in a span
        $('.erreurLog').each(function () {
            $(this).html($(this).text().replace(/([^\x00-\x80]|\w)/g, "<span class='letter'>$&</span>"));
        });

        anime.timeline({loop: true})
        .add({
            targets: '.erreurLog .letter',
            opacity: [0, 1],
            easing: "easeInOutQuad",
            duration: 2250,
            delay: function (el, i) {
                return 150 * (i + 1)
            }
        }).add({
            targets: '.erreurLog',
            opacity: 0,
            duration: 1000,
            easing: "easeOutExpo",
            delay: 1000
        });
    </script>
</body>

</html>