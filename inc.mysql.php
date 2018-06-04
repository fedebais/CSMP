<?php
	
	/* SESSIONS */
	session_start();
	session_name("Satori");
	session_cache_expire(10800);
	
	/* SELECT TIMEZONE */
	date_default_timezone_set('America/Buenos_Aires');
	
	/* CLASES */
	include($Root."classes/database.class.php");
	include($Root."classes/security.class.php");
	include($Root."classes/userdata.class.php");
	include($Root."classes/page.class.php");
	include($Root."classes/image.class.php");
	include($Root."classes/uploadfile.class.php");



	/* CREO LA INSTANCIA DEL OBJETO */
	switch($_SERVER["HTTP_HOST"]){
		case "server":
			$DB = new dataBase('root','','clarociudadsegura');
			break;
			
		case "localhost":
			$DB = new dataBase('root','','clarociudadsegura');
			break;
			
		default:
			$DB = new dataBase('fewcom_root','peluca1531','fewcom_cs');
			break;
	}
	
	/* SI HUBO UN ERROR AL CONECTAR, REDIRECCIONA */
	if(!$DB->Conectar()) header("Location: inc.error.php?error=".$DB->Error);
	
	/* CHEQUEO DE SEGURIDAD */
	$Security = new loginSecurity();
	//$Security->__construct();
	$Security->checkLogin();

	/* CREO EL OBJETO DEL USUARIO ADMINISTRADOR */
	$UsuarioAdmin 	= new userData($_SESSION['log_user_admin_id']);
	//$UsuarioAdmin->__constructFromID($_SESSION['log_user_admin_id']);

	/* DATOS DEL PANEL DE CONTROL */
	$rsDatoSitio = $DB->fetchAssoc("SELECT * FROM dato_sitio LIMIT 1");	

	/* Funciones de Repositorio */
	if(file_exists("../../../classes/repository.class.php")){
		include("../../../classes/repository.class.php");
		$RQ	= new QueryRepository();
	}

?>