<?php 
	//INCLUDES
	include ("../../inc.mysql.php");
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
	//VARIABLES
	$accion = $_POST['accion'];
	$user_admin_id = $_GET['user_admin_id'];
	
	$usuario = $_POST['usuario'];
	$nombre = $_POST['nombre'];
	$user_admin_perfil_id = $_POST['user_admin_perfil_id'];
	$password = $_POST['password'];
	
	if($password){
		$password = md5($password);
		$filtro_pass = " , password = '$password' ";
	}else{
		$filtro_pass = "";
	}
		
	//ACTUALIZAR			
	if( $accion == "actualizar" ){
		
		$query_modficacion = "UPDATE user_admin SET
		  usuario = '$usuario'
		, user_admin_perfil_id = '$user_admin_perfil_id'
		, nombre = '$nombre'
		$filtro_pass
		WHERE user_admin_id = '$user_admin_id'
		LIMIT 1";
		mysql_query($query_modficacion);
		
		echo "<script>document.location.href= 'usuario_admin_ver.php';</script>";
		
	
	};
		
	//CONSULTA
	$query = "SELECT * 
	FROM user_admin 
	WHERE user_admin_id = '$user_admin_id' ";
	$rs_lista = mysql_fetch_assoc(mysql_query($query));
	
	//FILTRO ADMIN GROSO
	if($_SESSION['cusuario_perfil_log_id'] != 1){
		$filtro_admin = " WHERE user_admin_perfil_id != '1' ";
	}else{
		$filtro_admin = " ";
	}
		
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php include("../../inc.header.php"); ?>

<script language="javascript">

	function validar_nombre(valor){
		document.getElementById("NombreNoSeleccionado").style.display = "none";
		
		if(valor==""){
			document.getElementById("NombreNoSeleccionado").style.display = "block";
			return false;
		}else{
			return true;
		}
	};
	
	function validar_usuario(valor){
		document.getElementById("UsuarioNoSeleccionado").style.display = "none";
		
		if(valor==""){
			document.getElementById("UsuarioNoSeleccionado").style.display = "block";
			return false;
		}else{
			return true;
		}
	};
	
	function validar_password(valor, id){
		
		var flag = true;
		
		document.getElementById(id+"1").style.display = "none";
		document.getElementById(id+"2").style.display = "none";
		
		if(document.form_titular.password.value != '' && document.form_titular.password_confirm.value != ''){
			if(valor.length < 4){
					flag=false;
					document.getElementById(id+"1").style.display = "block";
			}else if(document.form_titular.password.value != '' && document.form_titular.password_confirm.value != '' && document.form_titular.password.value != document.form_titular.password_confirm.value){
					flag=false;
					document.getElementById(id+"2").style.display = "block";
			}
		}
		
		if(flag==true){
			return true;
		}else{
			return false;
		}
	
	};
	
	
	function validar_form(){
	var flag = true;
	var formulario = document.form_titular;
	
		if(validar_nombre(formulario.nombre.value) == false){
			flag=false;
		}
		
		if(validar_usuario(formulario.usuario.value)==false){
			falg=false;
		}
		
		if(validar_password(formulario.password.value, "DivPass")==true){
			if(validar_password(formulario.password_confirm.value, "DivConf")==false){
				flag==false;
			}
		}else{
			flag=false;
		}
		
		if(flag==true){
			formulario.accion.value = "actualizar";
			formulario.submit();
		}
	
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
		
            <table width="100%" border="0" cellpadding="0" cellspacing="0" >
            <tr>
              <td>
              
                  <div class="modulo-titulo">
                      Administrador. <span class="name">Edición</span>
                  </div>
                
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
                    <tr>
                      <td>
                      
                      <form action="" method="post" name="form_titular" id="form_titular">
                          
                            <div class="table-header"> 
                                <div class="table-header-icon"></div>
                                <div class="table-title">Editar datos del usuario administrador:</div>
                                <input name="accion" type="hidden" id="accion" value="0" /> 
                                <div class="clear"></div>                       
                            </div>
                                
                  			<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="table-content">
                            <tr>
                              <td valign="top">
                              
                              <table width="100%" border="0" cellspacing="0" cellpadding="5">
                          		<tr>
                                    <td width="24%" align="right" valign="middle" class="detalle_medio"><div align="left" class="labelTitles">Nombre y Apellido:</div></td>
                                  <td width="76%" align="left" valign="top"><label>
                                      <input name="nombre" type="text" class="input-field-01" id="nombre" value="<?php echo  $rs_lista['nombre'] ?>" onchange="javascript: validar_nombre(this.value);" />
                                    </label><div class="divAlerts" id="NombreNoSeleccionado" style="display:none;">Ingrese un nombre y apellido.</div></td>
                                </tr>
                                  <tr>
                                    <td width="24%" align="right" valign="middle" class="detalle_medio"><div align="left" class="labelTitles">Usuario:</div></td>
                                    <td width="76%" align="left" valign="top"><input name="usuario" type="text" class="input-field-01" id="usuario" value="<?php echo  $rs_lista['usuario'] ?>" onchange="javascript: validar_usuario(this.value);" />
                                    <div id="UsuarioNoSeleccionado" class="divAlerts" style="display:none;">Ingrese el usuario.</div>                                </td>
                                </tr>
                                  <tr>
                                    <td width="24%" align="right" valign="middle" class="detalle_medio"><div align="left" class="labelTitles">Nueva Contrase&ntilde;a:</div></td>
                                    <td width="76%" align="left" valign="top" class="detalle_11px"><input name="password" type="password" class="input-field-01" id="password" onchange="javascript: validar_password(this.value,'DivPass');" />
                                    &nbsp; Complete solo si desea cambiar la contrase&ntilde;a 
                                    <div id="DivPass1" class="divAlerts" style="display:none;">La contrase&ntilde;a debe tener al menos 4 caracteres.</div>
                                    <div id="DivPass2" class="divAlerts" style="display:none;">No coincide la password ingresada con la de confirmaci&oacute;n.</div>                                </td>
                                </tr>
                                  <tr>
                                    <td width="24%" align="right" valign="middle" class="detalle_medio"><div align="left" class="labelTitles">Confirmar Contrase&ntilde;a:</div></td>
                                    <td width="76%" align="left" valign="top" class="detalle_11px"><input name="password_confirm" type="password" class="input-field-01" id="password_confirm" onchange="javascript: validar_password(this.value,'DivConf');" />
                                    &nbsp; Complete solo si desea cambiar la contrase&ntilde;a 
                                    <div id="DivConf1" class="divAlerts" style="display:none;">La contrase&ntilde;a debe tener al menos 4 caracteres.</div>
                                    <div id="DivConf2" class="divAlerts" style="display:none;">No coincide la password ingresada con la de confirmaci&oacute;n.</div>                                </td>
                                </tr>
                                  <tr>
                                    <td width="24%" align="right" valign="middle" class="detalle_medio"><div align="left" class="labelTitles">Perfil:</div></td>
                                    <td width="76%" align="left" valign="top"><select name="user_admin_perfil_id" class="chosen-select select-width" id="user_admin_perfil_id" >
                                      <?php
                                              $query_user_admin_perfil_id  = "SELECT * 
                                              FROM user_admin_perfil 
                                              $filtro_admin
                                              ORDER BY user_admin_perfil_id";
                                              $result_user_admin_perfil_id  = mysql_query($query_user_admin_perfil_id);
                                              while ($rs_user_admin_perfil_id  = mysql_fetch_assoc($result_user_admin_perfil_id))
                                              {
                                        ?>
                                      <option value="<?php echo  $rs_user_admin_perfil_id['user_admin_perfil_id'] ?>" <?php if($rs_lista['user_admin_perfil_id'] == $rs_user_admin_perfil_id['user_admin_perfil_id']){ echo "selected"; } ?> >
                                      <?php echo  $rs_user_admin_perfil_id['titulo'] ?>
                                      </option>
                                      <?php  } ?>
                                    </select></td>
                                </tr>
                                  <tr>
                                    <td width="24%" align="right" valign="top" class="detalle_medio_bold">&nbsp;</td>
                                    <td width="76%" align="left" valign="top"><input name="Button" type="button" class="input-submit-button" onclick="validar_form();" value=" Modificar  " /></td>
                                </tr>
                              </table></td>
                            </tr>
                        </table>
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