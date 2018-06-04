<?php
	
	/* INCLUDES */
	include("inc.mysql.php");
 
 	/* CONSTANTES */
	define("C_MAX_TRIES","5");
 
 	/* VARIABLES RECIBIDAS */
	$usuario 		= $_POST['usuario'];
	$password 		= $_POST['password'];

	/* DATOS GENERADOS */
	$PasswordHash 	= md5($password);
	$ip 			= getenv("REMOTE_ADDR");
	
	/* CONSULTAS */
	$Query 			= "SELECT * FROM user_admin WHERE usuario = '$usuario'";
	$existeUsuario 	= $DB->numRows($Query) > 0;
	$DatosUsuario 	= $DB->fetchAssoc($Query);
	$coincidePass	= ($DatosUsuario['password'] == $PasswordHash);

	
	/* PROCESO */
	if($existeUsuario){ //Si existe el nombre de usuario...
		
		$CantidadIntentos 	= $DatosUsuario['intentos'] + 1;
		
		if($CantidadIntentos > C_MAX_TRIES){ //Si la cantidad max de intentos esta excedida...
			
			$Query_Inhabilitacion = "INSERT INTO admin_login (usuario,password,ip,intentos,estado) VALUES ('$usuario','$password','$ip','$CantidadIntentos','Inhabilitada')";
			$Success = $DB->execQuery($Query_Inhabilitacion);

			echo "<script>alert('La cuenta se encuentra inhabilitada por razones de seguridad. Se ha enviado un email al usuario con su IP $ip.')</script>";
			echo "<script>document.location.href='index.php';</script>";
			
			
		}else{ //Si no esta excedida la cantidad max de intentos, entonces...
			
			if($coincidePass){ // Si la contraseña es correcta, lo loguea...
				
				$_SESSION['log_usuario'] 				= $DatosUsuario['usuario'];
				$_SESSION['log_user_admin_perfil_id'] 	= $DatosUsuario['user_admin_perfil_id'];
				$_SESSION['log_user_admin_id'] 			= $DatosUsuario['user_admin_id'];
				$_SESSION['log_nombre'] 				= $DatosUsuario['nombre'];
				
				$Query_ResetUserTries = "UPDATE user_admin SET intentos = '0' WHERE usuario = '$usuario'";
				$Success01 = $DB->execQuery($Query_ResetUserTries);
			
				$Query_LoginSuccessful = "INSERT INTO user_admin_login (usuario,ip,estado) VALUES ('$usuario','$ip','OK')";
				$Success02 = $DB->execQuery($Query_LoginSuccessful);
				
				if($Success01 && $Success02){
					echo "<script>document.location.href = 'modulo/inicio/inicio.php';</script>";
				}else{
					echo "<script>alert('Atención: Hubo un problema al registrar su ingreso. \nContactese con el administrador.');</script>";
					echo "<script>document.location.href = 'index.php';</script>";
				}
	
			}else{ // Si la contraseña es incorrecta, guarda los datos y registra el login fallido...
				
				$Query_IncreaseTries = "UPDATE user_admin SET intentos = '$CantidadIntentos' WHERE usuario = '$usuario'";
				$Success01 = $DB->execQuery($Query_IncreaseTries); 
				
				$Query_WrongPassword = "INSERT INTO user_admin_login  (usuario,password,ip,intentos,estado) VALUES ('$usuario','$password','$ip','$CantidadIntentos','Clave Incorrecta')";
				$Success02 = $DB->execQuery($Query_WrongPassword); 
				
				echo "<script>alert('La clave es incorrecta. No se pudo loguear. Intento: $CantidadIntentos de 5.')</script>";
				echo "<script>document.location.href = 'index.php';</script>";

			}
		}
		
	}else{ // Si el nombre de usuario no existe, guarda los datos y la direccion IP...
		
	
		$Query_WrongUser = "INSERT INTO user_admin_login (usuario,password,ip,estado) VALUES ('$usuario','$password','$ip','Usuario invalido')";
		$Success = $DB->execQuery($Query_WrongUser); 
				
		echo "<script>alert('No se pudo loguear. Usuario: $usuario')</script>";
		echo "<script>document.location.href='index.php';</script>";
		
	}
	
?>