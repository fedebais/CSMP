<?php 

	//INCLUDES
	include ("../../inc.mysql.php");
	
	//DESPLEGAR BARRA EN: ADMINISTRADORES
	$desplegarbarra =  0;
    
	//VARIABLES
	$accion = $_POST['accion'];
	$user_admin_id = $_GET['user_admin_id'];
	$eliminar = $_GET['eliminar'];
	$intentos = $_GET['intentos'];
	
	//ELIMINAR
	if(isset($_GET['eliminar'])){
		
		$query_eliminar = "DELETE 
		FROM user_admin 
		WHERE user_admin_id = '$eliminar' ";
		mysql_query($query_eliminar);

		echo "<script>document.location.href='".$_SERVER['PHP_SELF']."';</script>";

	};
	
	//BLANQUEAR
	if($intentos=='1'){
		
		$query_estado = "UPDATE user_admin 
		SET intentos = '0'
		WHERE user_admin_id = $user_admin_id
		LIMIT 1 ";
		mysql_query($query_estado);
		
		/*echo "<script>window.location.href=('".$_SERVER['PHP_SELF']."')</script>";*/
	};
    
    //FILTRO ADMIN GROSO
	if($_SESSION['log_user_admin_perfil_id'] != 1){
		$filtro_admin = " WHERE A.user_admin_perfil_id != '1' ";
	}else{
		$filtro_admin = " ";
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php include("../../inc.header.php"); ?>

<script>
function eliminar(id, mail){
	if (confirm('¿ Está seguro que desea eliminar al usuario '+mail+' ?')){
		window.location.href=('<?php echo $_SERVER['PHP_SELF']?>?eliminar='+id+'<?php echo $busqueda_sel?>');
	}
}
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
        
			<table width="100%" border="0" cellpadding="0" cellspacing="12">
                <tr>
                  <td valign="top">
                  
                  	<div class="modulo-titulo">
                        Administradores. <span class="name">Listado</span>
                    </div>
                  
                      <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                        <tr>
                          <td>
                          <form action="" method="post" name="form_lista" id="form_lista">
                              
                              <input name="accion" type="hidden" id="accion" value="1" />
                              <input name="lista_fil" type="hidden" id="lista_fil" value="1" />
                              <input name="lista_orden" type="hidden" id="lista_orden" value="1" />
                             
                              <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="table-content">
                                <tr>
                                  <td width="22%" height="40" align="left" valign="middle" class="table-header-column">Usuario</td>
                                  <td width="33%" height="40" align="left" valign="middle" class="table-header-column">Nombre y Apellido</td>
                                  <td width="24%" align="left" valign="middle" class="table-header-column"> Perfil</td>
                                  <td width="15%" height="40" align="left" valign="middle" class="table-header-column">Cant. Intentos</td>
                                  <td height="40" colspan="2" align="left" valign="middle" class="table-header-column">&nbsp;</td>
                                </tr>
                                <?php
        
									$cont_usuarios = 0;
									$colores = array("even","odd");
									$cont_colores = 0;
									$hay_lista = false;
									$query_lista = "SELECT A.*, B.titulo AS titulo_perfil
									FROM user_admin A
									LEFT JOIN user_admin_perfil B ON B.user_admin_perfil_id = A.user_admin_perfil_id
									$filtro_admin
									ORDER BY A.user_admin_id";
									$result_lista = mysql_query($query_lista);
									while ($rs_lista = mysql_fetch_assoc($result_lista)){ 
										$hay_lista = true;
										$cont_usuarios++;
										
								?>
                                <tr valign="middle" class="<?php echo $colores[$cont_colores] ?>" >
                                  <td width="22%" align="left" ><?php echo $rs_lista['usuario']?></td>
                                  <td ><a href="usuario_web_editar.php?user_web_id=<?php echo  $rs_lista['user_admin_id'] ?>" target="_parent" class="style10"></a>                            <?php echo $rs_lista['nombre']?></td>
                                  <td ><?php echo $rs_lista['titulo_perfil']?></td>
                                  <td ><?php echo $rs_lista['intentos']?> &nbsp; <a href="<?php echo  $_SERVER['PHP_SELF']."?user_admin_id=".$rs_lista['user_admin_id']."&intentos=1";?>">[BLANQUEAR]</a></td>
                                  <td width="3%" align="center"><a href="usuario_admin_editar.php?user_admin_id=<?php echo $rs_lista['user_admin_id']?>"><img src="../../imagen/iconos/pencil.png" width="16" height="16" border="0" /></a></td>
                                  <td width="3%" align="center"><a href="javascript:eliminar(<?php echo $rs_lista['user_admin_id']?>,'<?php echo $rs_lista['usuario']?>');" class="style10"><img src="../../imagen/iconos/cross.png" id=""  alt="Eliminar" width="16" height="16" border="0" /></a></td>
                                </tr>
                                <?php
                                        if($cont_colores == 0){
                                            $cont_colores = 1;
                                        }else{
                                            $cont_colores = 0;
                                        };
                                                    
                                    } if($hay_lista == false){ 
                                    
                                ?>
                                <tr align="center" valign="middle">
                                  <td colspan="10"height="50" class="">No se han encontrado administradores.</td>
                                </tr>
                                <?php } ?>
        
                            </table>
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