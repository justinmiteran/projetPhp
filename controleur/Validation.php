<?php
class Validation
{
	//validation et corection du numeros de page
	public static function valPage($numPage, $nbPages){
		// si le numero de page n'est pas un nombre retourner la page 1
		if(!is_numeric($numPage)) throw new Exception("numero de page \"$numPage\" incorecte");
		// arrondie le numero de page a la valeur inferieur
		$numPage = floor($numPage);
		// si le numero de page est inferieur a 1 reourner la page 1
		if($numPage<1 ) return 1;
		// si le numero de page est supèrieur au nombre max de page retourner la page max
		if($numPage>$nbPages ) return $nbPages;
		// la page est valide retourner le numeros de page
		return $numPage;
	}

	public static function ValId($idNews){
		if(!isset($idNews)) throw new Exception("L'identifiant de l'article à supprimer n'est pas spécifié");
		if (!filter_var($idNews, FILTER_VALIDATE_INT)) throw new Exception("L'identifiant \"$idNews\" de l'article à supprimer est invalide, risque de sécurité");
		if($idNews<0) throw new Exception("L'identifiant \"$idNews\" de l'article à supprimer est inférieure à 0 ");
		return $idNews;

	}

	public static function ValNews($news){
		$news->get_heure();

		$news->get_site();
	}

	public static function string($string){
		if ($string=="") {
            throw new Exception("La chaîne de caractère \"$string\" ne peut être vide");
		}
		return filter_var($string, FILTER_SANITIZE_STRING);
	}
}