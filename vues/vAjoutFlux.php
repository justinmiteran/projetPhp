<html>
    <head>
        <meta charset="utf-8">
		<title>Ajout Flux</title>
		<link rel="stylesheet" href="vues/css/bootstrap.css" media="screen" type="text/css" />
		<link rel="stylesheet" href="vues/css/styleAjoutFlux.css" media="screen" type="text/css" />
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
            <div class="container">
            <div class="row">
                    <article class="col-md-12">
                        <form action='index.php?action=AjoutRSS' method='post'>
                        <div class="cont"><h1>Ajout Flux RSS</h1></div>
                            <label><b>Site : </b></label>
                            <input type="url" placeholder="Site :" name="site" required>
                            <label><b>lien RSS : </b></label>
                            <input type="url" placeholder="Lien RSS :" name="url" required>
                            <label><b>Catégorie : </b></label><br \>
                            <select name="categorie" id="categorie">
                                <option value="Politique">Politique</option>
                                <option value="Jeux Vidéo">Jeux-video</option>
                                <option value="Santé">Santé</option>
                                <option value="Economie">Economie</option>
                            </select>
                            <div class="cont">
                                <input type="submit" id='submit' value='Valider'>
                                <button onclick="window.location.href = 'index.php'">Annuler</button>
                            </div>   
                        </form>
                    </article>
                </div>
            </div>
        </div>
    </body>
</html>