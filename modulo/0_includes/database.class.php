<?php

class dataBase {

	var $Usuario;
	var $Password;
	var $Server;
	var $BaseDeDatos;
	
	var $CantidadFilasAfectadas;
	var $StreamConnection;
	var $Error;

	function __construct($Usuario, $Password, $BaseDeDatos, $Server = "localhost"){
		$this->Usuario 		= $Usuario;
		$this->Password 	= $Password;
		$this->BaseDeDatos 	= $BaseDeDatos;
		$this->Server 		= $Server;
	}

	function Conectar(){
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
	
	function Desconectar(){
		return mysql_close($this->StreamConnection);
	}
	
	function execQuery($Query){
		$Result = mysql_query($Query);
		if(!$Result) $this->Error = mysql_error($this->StreamConnection);
		return $Result;
	}
	
	function fetchAssoc($Query){
		$Result = mysql_fetch_assoc($this->execQuery($Query));
		if(!$Result) $this->Error = mysql_error($this->StreamConnection);
		return $Result;
	}
	
	function fetchRow($Query){
		$Result = mysql_fetch_row($this->execQuery($Query));
		if(!$Result) $this->Error = mysql_error($this->StreamConnection);
		return $Result;
	}
	
	function numRows($Query){
		$Result = mysql_num_rows($this->execQuery($Query));
		if(!$Result) $this->Error = mysql_error($this->StreamConnection);
		return $Result;
	}
	
	function affectedRows(){
		$this->CantidadFilasAfectadas = mysql_affected_rows($this->StreamConnection);
	}

}

?>