<?php 
	include("../../inc.mysql.php"); 

	//VARIABLES
	$accion 				= $_POST['accion'];
	$nombre 				= $_POST['nombre'];
	$usuario 				= $_POST['usuario'];
	$user_admin_perfil_id 	= $_POST['user_admin_perfil_id'];
	$password 				= $_POST['password'];
	$fecha 					= date('Y').'-'.date('m').'-'.date('d');
	
	
	//INGRESAR
	if($accion == "ingresar"){
	
		//se checkea si hay un usuario con el mismo mail
		$query_usuario = "SELECT count(user_admin_id) AS existe FROM user_admin WHERE usuario = '$usuario' ";
		$rs_usuario = mysql_fetch_assoc(mysql_query($query_usuario));
		
		if($rs_usuario['existe'] > 0){
			$MsgError = "Ya existe un usuario registrado con el usuario: '$usuario'.";
		}else{
		
			$password = md5($password);
	
			$query_ingresar = "INSERT INTO user_admin (
			  usuario
			, password
			, user_admin_perfil_id
			, nombre
			) VALUES (
			  '$usuario'
			, '$password'
			, '$user_admin_perfil_id'
			, '$nombre'
			)";
			$rsInsert = mysql_query($query_ingresar);
			
			if($rsInsert == "1"){
				$MsgOK = "El usuario fue ingresado exitosamente.";
				$usuario = "";
				$password = "";
			}else{
				$MsgError = "No se pudo crear el usuario administrador.";
			}
				
		};
	};
	
	//FILTRO ADMIN GROSO
	if($_SESSION['cusuario_perfil_log_id'] != 1){
		$filtro_admin = " WHERE user_admin_perfil_id != '1' ";
	}else{
		$filtro_admin = " ";
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php include("../../inc.header.php"); ?>

<script language="javascript">
	
	function validar_registro(){
		var exito=1;
	
		var usuario = document.getElementById("usuario");
		var user_admin_perfil_id = document.getElementById("user_admin_perfil_id");	
		var password = document.getElementById("password");	
		
	/*
		if (user_segmentacion.value == 0)	{
			alert ('Debe seleccionar una segmentación');
			exito = 0;	}
		*/
		if (usuario.value.length < 4)	{
			alert ('El usuario debe ser de al menos 4 caracteres.');
			exito = 0;	}
	
		if (password.value.length < 4 )	{
			alert("La contraseña debe ser de al menos 4 caracteres.");
			exito = 0;	}
			
		if (user_admin_perfil_id.value == "" )	{
			alert("Debe completar el perfil de usuario.");
			exito = 0;	}

		if (exito == 1) {
			document.frm.accion.value = "ingresar";
			document.frm.submit(); 
		};
	
	};
	
</script>
</head>
<body>
<?php include("../../inc.top.php"); ?>

<div class="wrapper">

	<div class="colum-left">
		<?php include("../../modulo/0_barra/0_barra.php"); ?>
    </div>
    
    <div class="colum-right">
  		<div class="content">

			<table width="100%" border="0" cellpadding="0" cellspacing="12" class="fondo_tabla_principal">
                <tr>
                  <td>
                  
                  	<div class="modulo-titulo">
                        Administrador. <span class="name">Nuevo</span>
                    </div>
            
                      <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table">
                        <tr>
                          <td>
                          
                            <?php if($MsgError){ ?>
                            <div class="divAlerts" style="display:block; margin-bottom:10px;"><?php echo $MsgError?></div>
                            <?php } ?>
                            
                            <?php if($MsgOK){ ?>
                            <div class="divMsg" style="display:block; margin-bottom:10px;"><?php echo $MsgOK?></div>
                            <?php } ?>
                            
                            <form action="" method="post" name="frm" id="frm" style="margin:0px;" enctype="multipart/form-data">
                                
                                <div class="table-header"> 
                                	<div class="table-header-icon"></div>
                                	<div class="table-title">Complete los datos del nuevo administrador</div>
                                	<input name="accion" type="hidden" id="accion" value="0" /> 
                                    <div class="clear"></div>                       
                                </div>
                                
                                <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="table-content">
                                  <tr>
                                    <td >
                                    
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="">
                    					<tr>
                                          	<td width="24%" align="right"><div align="left" class="labelTitles">Nombre:</div></td>
                                    		<td width="76%" align="left"><input name="nombre" type="text" class="input-field-01" id="nombre" value=""  /></td>
                                        </tr>
                                        <tr>
                                          <td width="24%" align="right"><div align="left" class="labelTitles">Usuario:</div></td>
                                          <td width="76%" align="left"><input name="usuario" type="text" class="input-field-01" id="usuario" value=""  /></td>
                                        </tr>
                                        <tr>
                                          <td width="24%" align="right"><div align="left" class="labelTitles">Contrase&ntilde;a:</div></td>
                                          <td width="76%" align="left"><input name="password" type="text" class="input-field-01" id="password" value=""  /></td>
                                      </tr>
                                        <tr>
                                          <td width="24%" align="right"><div align="left" class="labelTitles">Perfil:</div></td>
                                          <td width="76%" align="left"><select name="user_admin_perfil_id" class="chosen-select select-width" id="user_admin_perfil_id" >
                                            <option value="">- Seleccionar</option>
                                            <?php
                                                      $query_user_admin_perfil_id  = "SELECT * 
                                                      FROM user_admin_perfil 
                                                      $filtro_admin 
                                                      ORDER BY user_admin_perfil_id";
                                                      $result_user_admin_perfil_id  = mysql_query($query_user_admin_perfil_id);
                                                      while ($rs_user_admin_perfil_id  = mysql_fetch_assoc($result_user_admin_perfil_id))
                                                      {
                                              ?>
                                            <option value="<?php echo  $rs_user_admin_perfil_id['user_admin_perfil_id'] ?>">
                                            <?php echo  $rs_user_admin_perfil_id['titulo'] ?>
                                            </option>
                                            <?php  } ?>
                                          </select></td>
                                      </tr>
                                        <tr>
                                          <td width="24%" align="right">&nbsp;</td>
                                          <td width="76%" align="left"><input name="ingresar" type="button" class="input-submit-button" id="ingresar" onclick="validar_registro();" value="  Crear Administrador  " /></td>
                                      </tr>
                                    </table></td>
                                  </tr>
                                </table>
                                <input name="cont_user_segmentacion" type="hidden" value="<?php echo $cont_user_segmentacion?>" />
                                <br />
                            </form></td>
                        </tr>
                  </table></td>
                </tr>
              </table>
      
    	</div>
	</div>

</div>

<?php include("../../inc.footer.php"); ?>

</body>
</html>