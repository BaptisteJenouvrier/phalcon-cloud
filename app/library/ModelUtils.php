<?php
class ModelUtils {
	/**
	 * Retourne l'occupation de $disque du jour trouvÃ©e dans l'historique
	 * @param config du cloud, accÃ¨s par $this->config->cloud dans un contrÃ´leur
	 * @param Disque $disque
	 * @return int occupation de $disque
	 */
	public static function getDisqueOccupation($cloud,$disque){
		$histo=DirectoryUtils::updateDaySize($cloud,$disque);
		return $histo->getOccupation();
	}

	/**
	 * Retourne le tarif appliquÃ© actuellement Ã  $disque
	 * @param Disque $disque
	 * @return Tarif tarif actuel de $disque
	 */
	public static function getDisqueTarif($disque){
		$disqueTarif = DisqueTarif::findFirst($disque->getId());
		$tarif = Tarif::findFirst($disqueTarif->getIdTarif());
		return $tarif->getPrix();
	}

	/**
	 * Convertit une unitÃ© en nombre d'octets (1 Ko= 1024 o)
	 * @param String $unit unitÃ© Ã  convertir (o, Ko, Mo, Go, To, Po)
	 * @return int
	 */
	public static function sizeConverter($unit){
		$units= ["Ko"=>1024,"Mo"=>1024*1024,"Go"=>pow(1024, 3),"To"=>pow(1024, 4),"Po"=>pow(1024,5),"o"=>1];
		return $units[$unit];
	}

	/**
	 * Affiche un tableau d'objets au format HTML
	 * @param array $array Tableau d'objets (doivent implÃ©menter __toString)
	 * @param string $mainTag
	 * @param string $tag
	 * @param string $sep sÃ©parateur entre objets
	 * @return string ReprÃ©sentation des objets au format HTML
	 */
	public static function arrayAsHtml($array,$mainTag="div",$tag="span class='label label-info'",$sep="&nbsp;"){
		$result="<{$mainTag}>";
		foreach ($array as $o){
			$result.="<{$tag}>".$o."</{$tag}>".$sep;
		}
		$result.="</{$mainTag}>";
		return $result;
	}
}