<?php
class Validation
{
    private $erreur;

    public function getErreur(){
        return $this->erreur;
    }
	
	//validation et corection du numeros de page
	public function valPage($numPage, $nbPages){
		// si le numero de page n'est pas un nombre retourner la page 1
		if(!is_numeric($numPage)){ $this->erreur[] = "numero de page \"$numPage\" incorecte";return 1;}
		// arrondie le numero de page a la valeur inferieur
		$numPage = floor($numPage);
		// si le numero de page est inferieur a 1 reourner la page 1
		if($numPage<1 ) return 1;
		// si le numero de page est supèrieur au nombre max de page retourner la page max
		if($numPage>$nbPages ) return $nbPages;
		// la page est valide retourner le numeros de page
		return $numPage;
	}
}