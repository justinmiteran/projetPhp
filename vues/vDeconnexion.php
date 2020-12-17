<html>
    <head>
        <meta charset="utf-8">
        <title>Deconnexion</title>
        <link rel="stylesheet" href="vues/css/bootstrap.css" media="screen" type="text/css" />
        <link rel="stylesheet" href="vues/css/styleDeconnexion.css" media="screen" type="text/css" />
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
                        <div class="cont"><h1>Au revoir </h1></div>
                        <?php
                            echo("<div class=\"cont\"><h2 class='nom'>$nom</h2></div>");
                        ?>
                        <div class="cont">
                            <img src="vues/img/bey.jpg">
                        </div>
                        <div class="cont"><button onclick="window.location.href = 'index.php';">Retour au site</button></div>
                    </article>
                </div>
            </div>
        </div>
    </body>
</html>