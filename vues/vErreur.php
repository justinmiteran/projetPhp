<!-- Vue d'erreurs -->
<html>
    <head>
        <meta charset="utf-8">
        <title>Erreur</title>
        <link rel="stylesheet" href="vues/css/bootstrap.css" media="screen" type="text/css" />
        <link rel="stylesheet" href="vues/css/styleErreur.css" media="screen" type="text/css" />
    </head>
    <body>
        <div class="container-fluid ban">
            <div class="row">
                <article class="col-md-1">
                    <a href="index.php">
                        <img src="vues/img/logo.png" class="img">
                    </a>
                </article>
            </div>
        </div>
        <div class="container-fluid ecart">
                
        </div>
        <div class="container-fluid">
            <div class="container blanco">
                <div class="row">
                    <article class="col-md-12">
                        <div class="cont"><h1>Oups!</h1></div>
                        <div>
                            <!-- Affiche l'intégralité du tableau d'erreurs -->
                            <?php
                                foreach($TErreur as $val){
                                    echo("<p>$val</p>");
                                }
                            ?>
                        </div>
                        <div class="cont"><button onclick="window.location.href = 'index.php';">Retour au site</button></div>
                    </article>
                </div>
            </div>
        </div>
    </body>
</html>