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
		if(!filter_var($idNews, FILTER_VALIDATE_INT)) throw new Exception("L'identifiant \"$idNews\" de l'article à supprimer est invalide, risque de sécurité");
		if($idNews<0) throw new Exception("L'identifiant \"$idNews\" de l'article à supprimer est inférieure à 0 ");
		return $idNews;
		
	}
	
	public static function ValNews($news){
		if(filter_var($news->get_heure()->format("D, d M Y H:i:s"), FILTER_SANITIZE_STRING) != $news->get_heure()->format("D, d M Y H:i:s"))
		throw new Exception("La date \""+$news->get_heure()->format("D, d M Y H:i:s")+"\" de l'article à ajouter est invalide, risque de sécurité");
		if(!filter_var($news->get_site(),FILTER_VALIDATE_URL)) throw new Exception("Le lien \""+$news->get_site()+"\" de l'article à ajouter est invalide, risque de sécurité");
		if(filter_var($news->get_titre(),FILTER_SANITIZE_STRING)!=$news->get_titre()) throw new Exception("Le titre \""+$news->get_titre()+"\" de l'article à ajouter est invalide, risque de sécurité");
		if(filter_var($news->get_description(),FILTER_SANITIZE_STRING)!=$news->get_description()) throw new Exception("La description \""+$news->get_description()+"\" de l'article à ajouter est invalide, risque de sécurité");
		if(filter_var($news->get_categorie(),FILTER_SANITIZE_STRING)!=$news->get_categorie()) throw new Exception("La categorie \""+$news->get_categorie()+"\" de l'article à ajouter est invalide, risque de sécurité");
		if(!filter_var($news->get_image(),FILTER_VALIDATE_URL)) throw new Exception("L'image' \""+$news->get_image()+"\" de l'article à ajouter est invalide, risque de sécurité");
		return $news;
	}
	
	public static function ValRss($rss){
		if(!filter_var($rss->get_url(),FILTER_VALIDATE_URL)) throw new Exception("Le lien \""+$rss->get_url()+"\" du flux à ajouter est invalide, risque de sécurité");
		if(filter_var($rss->get_site(),FILTER_SANITIZE_STRING)!=$rss->get_site()) throw new Exception("Le site \""+$rss->get_site()+"\" du flux à ajouter est invalide, risque de sécurité");
		if(filter_var($rss->get_categorie(),FILTER_SANITIZE_STRING)!=$rss->get_categorie()) throw new Exception("La categorie \""+$rss->get_categorie()+"\" du flux à ajouter est invalide, risque de sécurité");
		return $rss;
	}

	public static function string($string){
		if ($string=="") {
			throw new Exception("La chaîne de caractère \"$string\" ne peut être vide");
		}
		return filter_var($string, FILTER_SANITIZE_STRING);
	}
	
	public static function itemRSS($item){
		// netoyage et validation de l'heure
		if (!isset($item->pubDate)) $heure = new DateTime();
		else{
			try{
				$heure = DateTime::createFromFormat("D, d M Y H:i:s O",$item->pubDate);
			}catch(Exception $e){
				$heure = new DateTime();
			}
		}
		// netoyage et validation du site
		if (!isset($item->link)) throw new Exception("L'item du flux RSS n'a pas de lien");
		elseif(!filter_var($item->link,FILTER_VALIDATE_URL)) throw new Exception("L'item \"$item->link\" du flux RSS a un lien invalide, risque de sécurité");
		$site = $item->link;
		// netoyage et validation du titre
		if (!isset($item->title)) throw new Exception("L'item du flux RSS n'a pas de titre");
		else $titre = filter_var($item->title,FILTER_SANITIZE_STRING);
		// netoyage et validation de la description
		if (!isset($item->description)) throw new Exception("L'item du flux RSS n'a pas de description");
		else $description = filter_var($item->description,FILTER_SANITIZE_STRING);
		// netoyage et validation de l'image
		if(isset($item->children('media', true)->thumbnail)) {
			if(isset($item->children('media', true)->thumbnail->attributes()->url)){
				$image = $item->children('media', true)->thumbnail->attributes()->url;
				$image = filter_var($image,FILTER_VALIDATE_URL);
			}
		}
		elseif(isset($item->children('media', true)->content)) {
			if(isset($item->children('media', true)->content->attributes()->url)){
				$image = $item->children('media', true)->content->attributes()->url;
				$image = filter_var($image,FILTER_VALIDATE_URL);
			}
		}

		elseif(isset($item->enclosure)){
			if(isset($item->enclosure->attributes()->url)){
				$image = $item->enclosure->attributes()->url;
				$image = filter_var($image,FILTER_VALIDATE_URL);
			}
		}
		else $image="";
		return new News(0,$heure,$site,$titre,$description,"",$image);
		
	}

	public static function num($num){
		if(!isset($num)) return 10;
		if(!filter_var($num, FILTER_VALIDATE_INT)) return 10;
		if($num<0) return 10;
		return $num;
	}
}