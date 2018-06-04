<?php 
	//INCLUDES
	include ("../../inc.mysql.php");
	
	//DESPLEGAR BARRA EN: ADMINISTRADORES
	$desplegarbarra =  0;
	
	//VARIABLES
	$accion = $_POST['accion'];
	$user_admin_perfil_id = $_GET['user_admin_perfil_id'];
	$titulo = $_POST['titulo'];
		
	//ACTUALIZAR			
	if( $accion == "actualizar" ){
	
		$query_modficacion = "UPDATE user_admin_perfil SET
		  titulo='$titulo'
		WHERE user_admin_perfil_id = '$user_admin_perfil_id'
		LIMIT 1";
		mysql_query($query_modficacion);
		
		echo "<script>window.location.href=('usuario_admin_perfil_ver.php');</script>";
		
	
	};
		
	//CONSULTA DE PROVINCIA
	$query_provincia = "SELECT * 
	FROM user_admin_perfil 
	WHERE user_admin_perfil_id = '$user_admin_perfil_id' ";
	$rs_provincia = mysql_fetch_assoc(mysql_query($query_provincia));
		
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php include("../../inc.header.php"); ?>

<SCRIPT LANGUAGE="JavaScript" SRC="js/htmleditor.js"></SCRIPT>
<script language="javascript">

	function validar_form_preguntas(){
	formulario = document.form_titular;
	
		 if(formulario.titulo.value == ''){
			alert("Debe ingresar el nombre");
		}else{
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
        
	 		<table width="100%" border="0" cellpadding="0" cellspacing="0"¿>
                <tr>
                  <td>
                  
                      <div class="modulo-titulo">
                          Perfiles. <span class="name">Edición</span>
                      </div>
                  
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><form action="" method="post" name="form_titular" id="form_titular">
                          
                          	<div class="table-header"> 
                                <div class="table-header-icon"></div>
                                <div class="table-title">Editar datos del perfil:</div>
                                <input name="accion" type="hidden" id="accion" value="0" /> 
                                <div class="clear"></div>                       
                            </div>
                          
                              <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="table-content">
                                <tr>
                                  <td valign="top">
                                  
                                      <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                          <tr>
                                            <td width="24%" align="right" valign="middle" ><div class="labelTitles">Nombre del Perfil:</div></td>
                                          	<td width="76%" align="left" valign="top"><label>
                                              <input name="titulo" type="text" class=" input-field-01" id="titulo" value="<?php echo  $rs_provincia['titulo'] ?>" size="40" />
                                            </label></td>
                                        </tr>
                                          <tr>
                                            <td align="right" valign="top" >&nbsp;</td>
                                            <td align="left" valign="top"><input name="Button" type="button" class="input-submit-button" onclick="validar_form_preguntas();" value=" Modificar &raquo; " /></td>
                                          </tr>
                                      </table>
                                  
                                  </td>
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