<?php
class Validation
{
    private $erreur;

	//validation et corection du numeros de page
	public function valPage($numPage, $nbPages){
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

	public function ValIdNews($idNews){
		//validation
	}

	public function ValNews($news){
		//validation
	}

	public static function string($string){
		if ($string=="") {
            throw new Exception("La chaîne de caractère ne peut être vide");
		}
		return filter_var($string, FILTER_SANITIZE_STRING);
	}
}