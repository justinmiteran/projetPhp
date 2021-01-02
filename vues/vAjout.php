<html>
    <head>
        <meta charset="utf-8">
		<title>Ajout News</title>
		<link rel="stylesheet" href="vues/css/bootstrap.css" media="screen" type="text/css" />
		<link rel="stylesheet" href="vues/css/styleAjout.css" media="screen" type="text/css" />
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
                        <form action='index.php?action=validerAjoutNews' method='post'>
                        <div class="cont"><h1>Ajout News</h1></div>
                            <label><b>Titre : </b></label>
                            <input type="text" placeholder="Titre :" name="titre" required>
                            <label><b>Date : </b></label>
                            <input type="datetime-local" placeholder="Date :" name="heure" required>
                            <label><b>Catégorie : </b></label><br \>
                            <select name="categorie" id="categorie">
                                <option value="politique">Politique</option>
                                <option value="jeux-video">Jeux-video</option>
                                <option value="sante">Santé</option>
                                <option value="economie">Economie</option>
                            </select>
                            <label><b>Déscription : </b></label><br \>
                            <textarea name="description" id="description" rows="7" placeholder="Déscription :"></textarea>
                            <label><b>Lien de l'image : </b></label>
                            <input type="url" name="image" id="image" placeholder="Lien de l'image :">
                            <label><b>Lien de l'article : </b></label>
                            <input type="url" name="site" id="site" placeholder="Lien de l'article :">
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