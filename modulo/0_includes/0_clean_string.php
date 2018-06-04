<?php
	function clean_string($cadena){ 
	
		$cadena = str_replace('á', 'a', $cadena);
		$cadena = str_replace('Á', 'A', $cadena);
		
		$cadena = str_replace('é', 'e', $cadena);
		$cadena = str_replace('É', 'E', $cadena);
		
		$cadena = str_replace('í', 'i', $cadena);
		$cadena = str_replace('Í', 'I', $cadena);
		
		$cadena = str_replace('ó', 'o', $cadena);
		$cadena = str_replace('Ó', 'O', $cadena);
		
		$cadena = str_replace('ú', 'u', $cadena);
		$cadena = str_replace('Ú', 'U', $cadena);
		
		$cadena = str_replace('ñ', 'n', $cadena);
		$cadena = str_replace('Ñ', 'N', $cadena);
		
		$cadena = str_replace(' ', '-', $cadena);
		$cadena = str_replace('_', '-', $cadena);
		
		$cadena = str_replace('[^A-Za-z0-9]', '-', $cadena);
		# La función ereg_replace reemplaza todos lo que no sea números o letras
		$cadena = strtolower($cadena);
		# strtolower transforma todo en minúsculas
		return $cadena;
		
	};
	
?>