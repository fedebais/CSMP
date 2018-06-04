<?php include("../../inc.mysql.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php include("../../inc.header.php"); ?>

</head>
<body>
<div id="header">
  <?php include("../../inc.top.php"); ?>
</div>
<div id="wrapper">
	<div id="marco_izq"></div>
	<div id="navigation"><?php include("../../modulo/0_barra/0_barra.php"); ?></div>
	<div id="content">
	  <table width="100%" border="0" cellpadding="0" cellspacing="10" style="background-image:url(imagen/cuerpo/fondo_cuerpo_centro.jpg); background-repeat:no-repeat;" >
        <tr>
          <td height="400" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="40" align="left" valign="bottom" class="titulo_grande_bold">Panel de Control </td>
            </tr>
            <tr>
              <td height="20" valign="top" class="titulo_grande_bold"><hr size="1" noshade="noshade" style="color:#CCCCCC;" /></td>
            </tr>
          </table>
            <?php 				  
				  //Fotos Extra horizontal
				  $query_icono = "SELECT A.*
				  FROM admin_menu A
				  INNER JOIN admin_menu_perfil B ON B.admin_menu_id = A.admin_menu_id
				  WHERE A.estado = '1' AND A.icono = '1' AND B.user_admin_perfil_id = '$_SESSION[log_user_admin_perfil_id]'
				  ORDER BY A.orden";
				  $result_icono = mysql_query($query_icono);
				  $cant_icono = mysql_num_rows($result_icono);//indica la cantidad de fotos
				  
				  if($cant_icono > 0){//si la cantidad de iconos es 0, no lo muestra
			?>
            <table width="100%" border="0" cellpadding="5" cellspacing="5" align="center">
              <tr valign="top">
                <?php 						
						$vuelta_icono = 1;//indicador inicial de vueltas, para el sistema de columnas
					  while( $rs_icono = mysql_fetch_assoc($result_icono) ){//while de foto extra horizontal		  					  
					
					?>
                <td width="250" align="center" valign="top" class="ejemplo_12px"><a href="modulo/user_admin/usuario_admin_nuevo.php"></a>
                    <table width="250" border="0" cellpadding="5" cellspacing="0" class="detalle_medio_bold" style=" border-bottom:1px; border-bottom-color:#CCCCCC; border-bottom-style:solid">
                      <tr>
                        <td align="left">                          .<?php echo  $rs_icono['titulo']; ?>                        </td>
                      </tr>
                    </table>
                <table width="250" border="0" cellpadding="5" cellspacing="0" bgcolor="#EEEEEE">
              <tr>
                        <td width="57" align="center" valign="middle" class="detalle_chico"><img src="../../imagen/admin_panel/<?php echo $rs_icono['foto']; ?>" border="0" /></td>
                        <td width="123" height="65" align="left" valign="middle" class="detalle_chico"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                          <tr>
                            <td align="left" valign="middle" class="detalle_medio" style="font-size:11px"><?php
						  	//Opciones para cada boton									
							$query_opcion = "SELECT A.*
							FROM admin_opcion A
							INNER JOIN admin_opcion_perfil B ON B.admin_opcion_id = A.admin_opcion_id
							WHERE A.admin_menu_id = $rs_icono[admin_menu_id] AND B.user_admin_perfil_id = '$_SESSION[log_user_admin_perfil_id]'
							ORDER BY A.orden";
							$result_opcion = mysql_query($query_opcion);		
							while ($rs_opcion = mysql_fetch_assoc($result_opcion)){
                          		echo ' <b>.</b> <a href="../../'.$rs_opcion['link'].'">'.$rs_opcion['titulo'].'</a><br>';
							}
						  
						  ?></td>
                          </tr>
                        </table></td>
                  </tr>
                </table></td>
                <?php		if($vuelta_icono == 3){ //catidad de fotos extras por fila
									echo "</tr><tr>";
									$vuelta_icono = 1;
								}else{
									$vuelta_icono++;
								};							 
						}; //FIN WHILE foto extra ?>
              </tr>
            </table>
           
              <?php } ?>          </td>
        </tr>
        <tr>
          <td align="left" valign="top" class="detalle_chico"><table width="100%" border="0" cellpadding="5" cellspacing="0" class="detalle_medio_bold" style=" border-bottom:1px; border-bottom-color:#CCCCCC; border-bottom-style:solid">
  <tr>
    <td align="left"> .Site Map
    </td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#EEEEEE">
  <tr>
    <td width="48" align="center" valign="middle" class="detalle_chico"><img src="../../imagen/iconos/Conector.png" width="19" height="28" border="0" /></td>
    <td width="624" height="65" align="left" valign="middle" class="detalle_chico"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="middle" class="detalle_medio" style="font-size:11px"><?php require_once("../../inc.sitemap.php"); ?></td>
      </tr>
    </table></td>
  </tr>
</table>
</td>
        </tr>
      </table>
	</div>
	<div id="marco_der"></div>
</div>
<div id="footer">
</div>
</body>
</html>