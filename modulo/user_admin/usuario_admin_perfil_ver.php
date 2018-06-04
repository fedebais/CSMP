<?php 
	//INCLUDES
	include ("../../inc.mysql.php"); 

	//VARIABLES		
	$accion = $_POST['accion'];
	$titulo = $_POST['titulo'];	
	$user_admin_perfil_borrar_id = $_GET['user_admin_perfil_borrar_id'];
	$user_admin_perfil_id = $_GET['user_admin_perfil_id'];
	$estado = $_GET['estado'];
	
	//nuevoPerfil
	if($accion == "nuevoPerfil" ){
		$Query = "INSERT INTO user_admin_perfil ( titulo ) VALUES ( '$titulo' ) ";
		$DB->execQuery($Query);
	}
			   
	//BORRAR	
	if($user_admin_perfil_borrar_id){	

		$Query = "DELETE 
		FROM user_admin_perfil 
		WHERE user_admin_perfil_id = '$user_admin_perfil_borrar_id'";
		$DB->execQuery($Query);
		
		echo "<script>document.location.href=('".$_SERVER['PHP_SELF']."')</script>";	
	}
	
	//CAMBIAR ESTADO
	if($estado && $user_admin_perfil_id){
		
		$query_estado = "UPDATE user_admin_perfil 
		SET estado = '$estado'
		WHERE user_admin_perfil_id = '$user_admin_perfil_id'
		LIMIT 1 ";
		mysql_query($query_estado);
		
		echo "<script>document.location.href=('".$_SERVER['PHP_SELF']."')</script>";
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php include("../../inc.header.php"); ?>


<script language="javascript">

	function validarNuevoPerfil(){
		
		formulario = document.frm_perfil;
	
		if(formulario.titulo.value == ''){
			alert("Debe tener un titulo el perfil");
		}else{
			formulario.accion.value = "nuevoPerfil";
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
  		<div class="content fullwidth">
        
	 	 <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>
          
          	<div class="modulo-titulo">
            	Perfiles. <span class="name"></span>
            </div>
            
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>
                  
                  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="table-content">
                      <tr >
                        <td height="40" align="left" class="table-header-column">Titulo</td>
                        <td height="40" colspan="4" class="table-header-column" align="center" >&nbsp;</td>
                      </tr>
                      <?php 
 	
								$colores = array("even","odd");
								$cont_colores = 0;
								$hay_lista = false;
								$query_lista = "SELECT *
								FROM user_admin_perfil 
								WHERE estado <> 3 ";
								$result_lista = mysql_query($query_lista);
								while ($rs_lista = mysql_fetch_assoc($result_lista))
									{ $hay_lista = true;			  
									  $pais = $rs_lista['pais_id'];
							  
						?>
                      <tr valign="middle" class="<?php echo $colores[$cont_colores]?>" >
                        <td align="left"><?php echo  $rs_lista['titulo']; ?></td>
                        <td width="4%" align="center" ><?php if ($rs_lista['estado'] == '1') { 
						//estado 1 activo, 2 inactivo, 3 borrado
						  ?>
                            <a href="<?php echo  $_SERVER['PHP_SELF'] ?>?estado=2&amp;user_admin_perfil_id=<?php echo  $rs_lista['user_admin_perfil_id'] ?>"><img src="../../imagen/iconos/accept_blue.png" alt="Habilitado" width="16" height="16" border="0" /></a>
                            <?php } else { ?>
                            <a href="<?php echo  $_SERVER['PHP_SELF'] ?>?estado=1&amp;user_admin_perfil_id=<?php echo  $rs_lista['user_admin_perfil_id'] ?>"><img src="../../imagen/iconos/accept_blue_off.png" alt="Deshabilitado" width="15" height="16" border="0" /></a>
                            <?php } ?></td>
                        <td width="3%" align="center" ><a href="usuario_admin_perfil_editar.php?user_admin_perfil_id=<?php echo  $rs_lista['user_admin_perfil_id'] ?>" target="_parent" class="style10"><img src="../../imagen/iconos/pencil.png" alt="Modificar" width="16" height="16" border="0" /></a></td>
                        <td width="3%" align="center" >
						<?php if($rs_lista['user_admin_perfil_id'] != 1){ ?>
						<a href="javascript:document.location.href = '<?php echo  $_SERVER['PHP_SELF'] ?>?user_admin_perfil_borrar_id=<?php echo  $rs_lista['user_admin_perfil_id'] ?>' " class="style10"><img src="../../imagen/iconos/cross.png" width="16" height="16" border="0" /></a>
						<?php } ?>						</td>
                    </tr>
                      <?php
	if($cont_colores == 0){
		$cont_colores = 1;
	}else{
		$cont_colores = 0;
	};
					
	} if($hay_lista == false){ ?>
                      <tr align="center" valign="middle">
                        <td colspan="5" height="50" >No se han encontrado perfiles.</td>
                      </tr>
                      <?php };
	?>
                    </table><br />

                    <form action="" method="post" name="frm_perfil" id="frm_perfil" enctype="multipart/form-data">
                    
                        <div class="table-header"> 
                            <div class="table-header-icon"></div>
                            <div class="table-title">Complete los datos del nuevo administrador</div>
                            <input name="accion" type="hidden" id="accion" value="0" /> 
                            <div class="clear"></div>                       
                        </div>
                        
                        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="table-content">
                            <tr>
                                <td>   
                                
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td width="15%" align="right" valign="middle" ><div align="left" class="labelTitles">Nombre DEL PERFIL:</div></td>
                                          <td width="85%" align="left" valign="top"><label>
                                            <input name="titulo" type="text" id="titulo" class="input-field-01" size="35" />
                                          </label></td>
                                        </tr>
                                        <tr>
                                          <td align="right" valign="top" class="detalle_medio_bold">&nbsp;</td>
                                          <td align="left" valign="top"><input name="Button" type="button" class=" input-submit-button" onclick="validarNuevoPerfil();" value="Crear Perfil" /></td>
                                        </tr>
                                    </table>
                            
                            	</td>
                            </tr>
                        </table>
                            
                    </form>
                    
                    </td>
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