<?php
	function clean_string($cadena){ 
	
		$cadena = str_replace('�', 'a', $cadena);
		$cadena = str_replace('�', 'A', $cadena);
		
		$cadena = str_replace('�', 'e', $cadena);
		$cadena = str_replace('�', 'E', $cadena);
		
		$cadena = str_replace('�', 'i', $cadena);
		$cadena = str_replace('�', 'I', $cadena);
		
		$cadena = str_replace('�', 'o', $cadena);
		$cadena = str_replace('�', 'O', $cadena);
		
		$cadena = str_replace('�', 'u', $cadena);
		$cadena = str_replace('�', 'U', $cadena);
		
		$cadena = str_replace('�', 'n', $cadena);
		$cadena = str_replace('�', 'N', $cadena);
		
		$cadena = str_replace(' ', '-', $cadena);
		$cadena = str_replace('_', '-', $cadena);
		
		$cadena = str_replace('[^A-Za-z0-9]', '-', $cadena);
		# La funci�n ereg_replace reemplaza todos lo que no sea n�meros o letras
		$cadena = strtolower($cadena);
		# strtolower transforma todo en min�sculas
		return $cadena;
		
	};
	
?>