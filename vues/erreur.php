<html>
    <head>
        <meta charset="utf-8">
        <title>Erreur</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" type="text/css" />
        <link rel="stylesheet" href="css/styleErreur.css" media="screen" type="text/css" />
    </head>
    <body>
         <div class="container-fluid ban">
            <div class="row">
                <article class="col-md-1">
                    <a href="connexion.html">
                        <img src="img/logo.png" class="img">
                    </a>
                </article>
            </div>
        </div>
        <div class="container-fluid ecart">
                
        </div>
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    
                </div>
            </div>
        </div>
    </body>
</html>

<?php
    echo("<br/><b>Erreurs : </b><br/>");
    foreach($TErreur as $val){
        echo("⚠️ $val<br/>");
    }
?>