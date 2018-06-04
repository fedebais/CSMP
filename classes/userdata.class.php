<?php 

class userData extends dataBase{
	
	public $User;
	public $Data;
	
	public function __construct($User){
		$this->User 		= $User;
		$this->Conectar();
		
		$Query_UserData = "SELECT * FROM user_admin WHERE usuario = '".$this->User."' "; 
		$this->Data		= $this->fetchAssoc($Query_UserData);
		
	}
	
	public function __constructFromID($UserID){
		$this->Conectar();
		
		$Query_UserData = "SELECT * FROM user_admin WHERE user_admin_id = '$UserID' "; 
		$this->Data		= $this->fetchAssoc($Query_UserData);
		
	}

	
	public function insertName(){
		
		if($this->Data['nombre']) echo $this->Data['nombre'];
		else echo '- Desconocido -';
	
	}
	
	public function insertProfile(){
		$Query_Profile	= "SELECT titulo FROM user_admin_perfil WHERE user_admin_perfil_id = '".$this->Data['user_admin_perfil_id']."'";
		$Profile		= $this->fetchAssoc($Query_Profile);
		echo $Profile['titulo'];
	}
	
	
	public function tituloMes($Mes){
		
		switch(strtolower($Mes)){
			case "january": 	return "Enero"; break;
			case "february": 	return "Febrero"; break;
			case "march": 		return "Marzo"; break;
			case "april": 		return "Abril"; break;
			case "may": 		return "Mayo"; break;
			case "june": 		return "Junio"; break;
			case "july": 		return "Julio"; break;
			case "august": 		return "Agosto"; break;
			case "september": 	return "Septiembre"; break;
			case "october": 	return "Octubre"; break;
			case "november": 	return "Noviembre"; break;
			case "december": 	return "Diciembre"; break;
			default:			return "";			break;
		}
	}

}

?>