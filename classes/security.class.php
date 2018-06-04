<?php 

class loginSecurity extends dataBase{
	
	public function __construct(){
		$this->Conectar();
	}
	
	public function checkLogin(){
		if(!$this->isLogging()){
			if(!$_SESSION['log_usuario']){
				echo "<script>alert('Debes estar logueado para entrar a esta seccion.');</script>";
				echo "<script>document.location.href='../../process.logout.php';</script>";
			}
		}
	}
	
	function isLogging(){
		return (basename($_SERVER['PHP_SELF']) == "process.login.php") || (basename($_SERVER['PHP_SELF']) == "activate.php");	
	}

}

?>
