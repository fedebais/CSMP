<?php

	
	function convertHTMLToLatin1($str) {
    $html_entities = array (
        "&amp;" => "&",
		"&aacute;" => "á",
		"&Acirc;" => "Â",
		"&acirc;" => "â",
		"&Agrave;" => "À",
		"&agrave;" => "à",
		"&Atilde;" => "Ã",
		"&atilde;" => "ã",
		"&Aacute;" => "Á",
		"&aacute;" => "á",
		
		
        "&Ccedil;" =>  "Ç",     #latin capital letter C
        "&ccedil;" =>  "ç",     #latin small letter c
        "&Eacute;" =>  "É",     #latin capital letter E
        "&eacute;" =>  "é",     #latin small letter e
        "&Egrave;" =>  "È",     #latin capital letter E
		"&Oacute;" =>  "Ó",
		"&oacute;" =>  "ó",
		"&Ograve;" =>  "Ò",
		"&ograve;" =>  "ò",
        "&Ugrave;" =>  "Ù",     #latin capital letter U
        "&ugrave;" =>  "ù",     #latin small letter u

		"&bull;" =>  "•",       #latin capital letter Y
		"&raquo;" =>  "»",      #latin capital letter Y
		"&laquo;" =>  "«",
		"&middot;" =>  "·"
    );

    foreach ($html_entities as $key => $value) {
        $str = str_replace($key, $value, $str);
    }
    return $str;
} 

		//FUNCION formato fecha
		function FormatoFecha($fecha_inicial, $separador){
			
			$array_fecha = explode("-", $fecha_inicial); //http://www.php.net/manual/en/function.split.php
			$fecha_final = $array_fecha[2].$separador.$array_fecha[1].$separador.$array_fecha[0]; // Concatenamos todo el array para formar la nueva fecha
			return $fecha_final;
			
		}
		
		
		//FUNCION loguear error
		function LoguearError($registro, $query, $mensaje, $instancia){
			$query=addslashes($query);
			$query_error="INSERT INTO error_log(
						  registro_id
						, query
						, mensaje
						, instancia
					)VALUES(
						  '$registro'
						, '$query'
						, '$msj'
						, '$instancia'
					)";
					mysql_query($query_error);
			
		}
		
		//FUNCION loguear corrida job
		function LoguearCorridaJob($job, $registros){
			$query_corrida="INSERT INTO job_log(
						  job
						, registros
					)VALUES(
						  '$job'
						, '$registros'
					)";
					$result= mysql_query($query_corrida);
					if($result==false){
						LoguearError('', $query_corrida, 'No se pudo realizar la query', 'Funcion LoguearCorridaJob '.strtoupper($job).'JOB');
					}
			
		}
		
		//FUNCION loguear historial de saldo
		function LoguearSaldo($hotel_id, $pago_id, $monto, $saldo, $accion, $tipo, $concepto, $autor){
			$query_saldo="INSERT INTO hotel_saldo_log(
						  hotel_id
						, pago_id
						, monto
						, saldo
						, accion
						, tipo
						, concepto
						, autor
					)VALUES(
						  '$hotel_id'
						, '$pago_id'
						, '$monto'
						, '$saldo'
						, '$accion'
						, '$tipo'
						, '$concepto'
						, '$autor'
					)";
					$result = mysql_query($query_saldo);
					if($result==false){
						LoguearError('', $query_saldo, 'No se pudo realizar la query', 'Funcion LoguearSaldo');
					}
		}
		
		function MonthName($M){

			if($M > 12){ $M = $M % 12; }
			
			switch($M){
				case '1': $name = "Enero"; break;
				case '2': $name = "Febrero"; break;
				case '3': $name = "Marzo"; break;
				case '4': $name = "Abril"; break;
				case '5': $name = "Mayo"; break;
				case '6': $name = "Junio"; break;
				case '7': $name = "Julio"; break;
				case '8': $name = "Agosto"; break;
				case '9': $name = "Septiembre"; break;
				case '10': $name = "Octubre"; break;
				case '11': $name = "Noviembre"; break;
				case '12': $name = "Diciembre"; break;
				default: $name = ""; break;
				}
			
			return $name;
			
			}//End Function: MonthName
		
		
		
		//FUNCION para Darle Formato a los Nombres de Personas o Empresas
	function formatoNombre($nombre) 
	{
		// aca definimos dos arrays, uno de articulos (en minuscula) y otro de empresas (en mayuscula).
		// aunque lo puedes definir afuera y declararlo global aca
		$srl = array(
			'0' => 'S.R.L',
			'1' => 'SRL',
			'2' => 'S.A.',
			'3' => 'SA',
			'4' => 'XX',
		);

		$articulos = array(
			'0' => 'a',
			'1' => 'de',
			'2' => 'del',
			'3' => 'la',
			'4' => 'los',
			'5' => 'las',
		);

		// Separamos el nombre por cada espacio
		//EJ: juancho de la rosa S.R.L nos va a quedar: palabras[1] = 'juancho', palabras[2] = 'de', etc...
		$palabras = explode(' ', $nombre);

		// creamos la variable que contendra el nombre
		// formateado
		$nuevoNombre = '';

		// parseamos cada palabra
		foreach($palabras as $elemento)
		{
			// si la palabra es un articulo
			if(in_array(trim(strtolower($elemento)), $articulos))
			{
				// concatenamos seguido de un espacio
				$nuevoNombre .= strtolower($elemento)." ";
			} 
			else 
			{
				// sino, es un nombre propio, por lo tanto aplicamos
				// las funciones y concatenamos seguido de un espacio
				if(in_array(trim(strtoupper($elemento)), $srl))
				{
					$nuevoNombre .= strtoupper($elemento)." ";
				}
				else
				{	
					$nuevoNombre .= ucfirst(strtolower($elemento))." ";
				}//end 2º if
			}//end 1º if
		} //end ForEach
		return ucfirst(trim($nuevoNombre));
	}//Fin funcion
	
	
	//Funcion para saber si un numero es impar, si el numero es impar devuelve true.
	function esImpar($numero) {
 		return $numero & 1; // 0 = par, 1 = impar
	}

?>