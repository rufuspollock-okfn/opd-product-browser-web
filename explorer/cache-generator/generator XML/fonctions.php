<?
	//------------------------------------------------------------------
	// Template 
	// Retourne une partie d'un fichier template et l'interprète
	//------------------------------------------------------------------
	function Template($Fichier,$Partie,$params=array()) {
	
		// on obtient les paramtres requis dans le template
		extract($params);
	
		$Template = file_get_contents($Fichier.".php");
		$TemplateExplode = explode("<!--COUPER_ICI-->", $Template);
		
		$PartieFichier = " ?> ".$TemplateExplode[$Partie - 1]." <? ";
	
		// interptrtation du code PHP lu dans le fichier
		ob_start();
			eval($PartieFichier);
			$Resultat = ob_get_contents();
		ob_end_clean();
	
		return $Resultat;
	
	}

	function nl2br2($string) { 
		$string = str_replace(array("\r\n", "\r", "\n"), "<br />", $string); 
		return $string; 
	} 
	
	function check_gtin($gtin) { 
		
		//first change digits to a string so that we can access individual numbers
			$digits =(string)$gtin;
			// 1. Add the values of the digits in the even-numbered positions: 2, 4, 6, etc.
			$even_sum = $digits{1} + $digits{3} + $digits{5} + $digits{7} + $digits{9} + $digits{11};
			// 2. Multiply this result by 3.
			$even_sum_three = $even_sum * 3;
			// 3. Add the values of the digits in the odd-numbered positions: 1, 3, 5, etc.
			$odd_sum = $digits{0} + $digits{2} + $digits{4} + $digits{6} + $digits{8} + $digits{10};
			// 4. Sum the results of steps 2 and 3.
			$total_sum = $even_sum_three + $odd_sum;
			// 5. The check character is the smallest number which, when added to the result in step 4,  produces a multiple of 10.
			$next_ten = (ceil($total_sum/10))*10;
			$check_digit = $next_ten - $total_sum;
			
			$Code = $digits{0}.$digits{1}.$digits{2}.$digits{3}.$digits{4}.$digits{5}.$digits{6}.$digits{7}.$digits{8}.$digits{9}.$digits{10}.$digits{11}.$check_digit;
			
			if( $gtin != $Code) {
				return 0;
			} else {
				return 1;
			} 
	} 

	function verification($formulaire) {
       tinyMCE.triggerSave(true, true);
	   $formulaire.submit();
	}

?>