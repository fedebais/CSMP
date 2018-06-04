<?php

class uploadFile {
    
	var $Type;  
	var $OriginPath;
	var $DestinationPath;
   
    var $newNamePrefix;
	var $newName;
	
	var $imageMaxWidth;
	var $imageMaxHeight;
	
	var $definedTypes = array("image","any");
	var $definedImageExtension = array("gif","jpg","jpeg","png");
	
	function __construct($newName = ""){
		$this->newNamePrefix 	= "";
		$this->newName 			= $this->cleanFileName($newName);
		$this->imageMaxWidth 	= 100000;
		$this->imageMaxHeight 	= 100000;
	}
	
	function startUpload($Origen,$Destino,$type="any"){
		
		$result = $this->createFile($Origen, $Destino, $type, $this->imageMaxWidth, $this->imageMaxHeight);
		if($result) return $result;
		else return $this->raiseError($result);
		
	}
	
	function createFileName($Name){
		return $this->newName = $this->newNamePrefix.$this->cleanFileName($Name);
	}
	
	function setPrefix($Prefix){
		$this->newNamePrefix = $this->cleanFileName($Prefix);
		$this->createFileName($this->newName);
	}
	function setMaxWidth($Size){
		$this->imageMaxWidth = intval($Size);
	}
	function setMaxHeight($Size){
		$this->imageMaxHeight = intval($Size);
	}

    function cleanFileName($cadena) {
	
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
		$cadena = str_replace('%', '-', $cadena);
		$cadena = str_replace('&', '-', $cadena);
		$cadena = str_replace('[^A-Za-z0-9]', '-', $cadena);
		$cadena = strtolower($cadena);
		
		return $cadena;
    }

    function isValidExtension($ext,$type = "any") {
		
		if($type=="any") return true; 
		else return in_array($ext,$this->definedImageExtension);
		
    }
	
	function raiseError($Code, $Comment = "") {
		
		$errorList = array(
			"NO_COPY" 			=> "Error al copiar el archivo.",
			"NOT_VALID_EXT" 	=> "Extension del archivo invalida.",
			"WRONG_ORIG_PATH" 	=> "Ruta del archivo de origen incorrecta.",
			"WRONG_DEST_PATH" 	=> "Ruta de destino de archivo incorrecta.",
			"EMPTY_FILE_NAME"	=> "No se especifico el nombre del archivo."
		);
		if($Comment) $Comment = " : ".$Comment;
		return $errorList[$Code].$Comment;
		
    }
	
	function getFile($Path){
		$Array = explode('/', $Path);
		if(count($Array)==1){ $Array = explode("\\", $Path); }
		return $Array[count($Array)-1];
	}
	
	function getExtension($File){
		$Array = explode('.', $File);
		return $Array[count($Array)-1];
	}
	
	function getPath($Path){
		$File = $this->getFile($Path);
		return substr($Path,0,-(strlen($File)));
	}
	
	function createFile($Origen, $Destino, $tipo, $anchoMax, $altoMax){
	
		$CarpetaOrigen	= $this->getPath($Origen);
		$ArchivoOrigen 	= $this->getFile($Origen);
		$Extension		= $this->getExtension($this->newName);
		$CarpetaDestino	= $Destino;
		
		if(!$this->isValidExtension($Extension,$tipo)) return $this->raiseError("NOT_VALID_EXT",$Extension);
		if(!file_exists($CarpetaDestino)) return $this->raiseError("WRONG_DEST_PATH",$CarpetaDestino);
		if(!file_exists($Origen)) return $this->raiseError("WRONG_ORIG_PATH",$Origen);
		if(trim($this->newName)=="") return $this->raiseError("EMPTY_FILE_NAME");
		
		if($tipo=="image"){
			
			switch($Extension){
				case 'gif':
					$original = imagecreatefromgif($Origen); 
					break;
				case 'jpg':	
				case 'jpeg':
					$original = imagecreatefromjpeg($Origen); 
					break;
				case 'png':
					$original = imagecreatefrompng($Origen); 
					break;
				default:
					return false;
			}
			
			$anchoOriginal 	= imagesx($original);
			$altoOriginal 	= imagesy($original);
			
			if ($anchoOriginal > $anchoMax){	
				$altoAjustado 	= ceil($anchoMax * $altoOriginal / $anchoOriginal);
				$anchoAjustado 	= $anchoMax;
			}else{
				if($altoOriginal > $altoMax){
					$altoAjustado 	= $altoMax;
					$anchoAjustado 	= ceil($altoMax * $anchoOriginal / $altoOriginal);
				}else{
					$altoAjustado 	= $altoOriginal;
					$anchoAjustado 	= $anchoOriginal;
				}
			}
			
			$thumb = imagecreatetruecolor($anchoAjustado,$altoAjustado);
			
			if($Extension == 'png'){
				imagealphablending($thumb, false);
				imagesavealpha($thumb, true);
			}
			
			imagecopyresampled($thumb,$original,0,0,0,0,$anchoAjustado,$altoAjustado,$anchoOriginal,$altoOriginal);
			
			$Destino = $CarpetaDestino.$this->newName;
			
			switch ($Extension){
				case 'gif':
					return imagegif($thumb, $Destino, 90);
					break;
				case 'jpg':
				case 'jpeg':
					return imagejpeg($thumb, $Destino, 90);
					break;
				case 'png':
					return imagepng($thumb, $Destino, 9);
					break;
			}
			
		}else{
		
			$Destino = $CarpetaDestino.$this->newName;
			
			if(copy($Origen,$Destino)) return true;
			else $this->raiseError("NO_COPY");
			
		}
		
	}
	
}
?>