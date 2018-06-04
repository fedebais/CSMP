<?php

class dataBase {

	var $Usuario 		= "fewcom_root";
	var $Password 		= "peluca1531";
	var $Server			= "localhost";
	var $BaseDeDatos 	= "fewcom_cs";
    
	var $CantidadFilasAfectadas;
	var $StreamConnection;
	var $Error;
	

	public function __construct($Usuario, $Password, $BaseDeDatos, $Server = "localhost"){
		$this->Usuario 		= $Usuario;
		$this->Password 	= $Password;
		$this->BaseDeDatos 	= $BaseDeDatos;
		$this->Server 		= $Server;
	}

	public function Conectar(){
	
		//echo "mysql_connect('".$this->Server."', '".$this->Usuario."', '".$this->Password."')";
		$Link = mysql_connect($this->Server, $this->Usuario, $this->Password);
		
		if(!$Link){ 
			$this->Error = 'No se pudo conectar: '.mysql_error();
			return false;
		}else{
			$this->StreamConnection = $Link;
			$SelectDB = mysql_select_db($this->BaseDeDatos, $Link);
			if(!$SelectDB){
				$this->Error = 'No se pudo conectar: '.mysql_error();
				return false;
			}else{
				return true;
			}
		}
	}
	
	public function Desconectar(){
		return mysql_close($this->StreamConnection);
	}
	
	public function execQuery($Query){
		$Result = mysql_query($Query);
		if(!$Result) $this->Error = mysql_error($this->StreamConnection);
		return $Result;
	}
	
	public function fetchAssoc($Query){
		$Result = mysql_fetch_assoc($this->execQuery($Query));
		if(!$Result) $this->Error = mysql_error($this->StreamConnection);
		return $Result;
	}
	
	public function fetchRow($Query){
		$Result = mysql_fetch_row($this->execQuery($Query));
		if(!$Result) $this->Error = mysql_error($this->StreamConnection);
		return $Result;
	}
	
	public function numRows($Query){
		$Result = mysql_num_rows($this->execQuery($Query));
		if(!$Result) $this->Error = mysql_error($this->StreamConnection);
		return $Result;
	}
	
	public function affectedRows(){
		$this->CantidadFilasAfectadas = mysql_affected_rows($this->StreamConnection);
	}

}

?>