<script type="text/javascript"> 
 
	ddaccordion.init({
		headerclass: "submenuheader", //Shared CSS class name of headers group
		contentclass: "submenu", //Shared CSS class name of contents group
		revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
		mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
		collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
		defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
		onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
		animatedefault: false, //Should contents open by default be animated into view?
		persiststate: true, //persist state of opened contents within browser session?
		toggleclass: ["", "active"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
		togglehtml: ["suffix", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
		animatespeed: "normal", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
		oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
			//do nothing
			//["suffix", "<img src='plus.gif' class='statusicon' />", "<img src='minus.gif' class='statusicon' />"],
		},
		onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
			//do nothing
		}
	})
	 
</script>

    
<div class="barra_menu">
	<?php
	
	$query_barra = "SELECT A.admin_menu_id, A.titulo, A.link
	FROM admin_menu A
	LEFT JOIN admin_menu_perfil B ON B.admin_menu_id = A.admin_menu_id
	WHERE A.estado = 1 AND A.admin_menu_padre_id = '0' AND B.user_admin_perfil_id = '$_SESSION[log_user_admin_perfil_id]' AND A.icono = '2'
	ORDER BY orden ASC";
	$result_barra = mysql_query($query_barra);
	
	while($rs_barra = mysql_fetch_assoc($result_barra)){
						
		$query_sub = "SELECT A.admin_menu_id, A.titulo, A.link 
		FROM admin_menu A
		LEFT JOIN admin_menu_perfil B ON B.admin_menu_id = A.admin_menu_id
		WHERE A.admin_menu_padre_id = $rs_barra[admin_menu_id] AND A.estado = '1' AND B.user_admin_perfil_id = $_SESSION[log_user_admin_perfil_id] AND A.icono = '2'
		ORDER BY orden ASC";
		$result_sub = mysql_query($query_sub);
		$num_rows = mysql_num_rows($result_sub);
		
		if($num_rows == 0){
			
			if($rs_barra['link']){ //SIN SUBMENU
				echo '<a class="menuitem" href="../../'.$rs_barra['link'].'">&nbsp;'.strtoupper($rs_barra['titulo']).'</a>'; 
			}else{ //CON SUBMENU
				echo '<a class="menuitem submenuheader" href="" >&nbsp;'.strtoupper($rs_barra['titulo']).'</a>'; 
			}
			
		}else{
			echo '<a class="menuitem submenuheader" href="" >&nbsp;'.strtoupper($rs_barra['titulo']).'</a>';

			echo '<div class="submenu">';
			while($rs_sub = mysql_fetch_assoc($result_sub)){
			
				if($rs_sub['link']){
					echo '<a href="../../'.$rs_sub['link'].'" class="submenuitem conlink">'.$rs_sub['titulo'].'</a>';
				}else{
					echo '<a href="javascript:;" class="submenuitem sinlink"> &nbsp;&nbsp;  '.$rs_sub['titulo'].'</a>';
					
					$query_barra_sub_subcat = "SELECT A.admin_menu_id, A.titulo, A.link 
					FROM admin_menu A
					LEFT JOIN admin_menu_perfil B ON B.admin_menu_id = A.admin_menu_id
					WHERE A.admin_menu_padre_id = $rs_sub[admin_menu_id] AND A.estado = '1' AND B.user_admin_perfil_id = $_SESSION[log_user_admin_perfil_id] AND A.icono = '2'
					ORDER BY A.orden ASC";
					$result_barra_sub_subcat = mysql_query($query_barra_sub_subcat);
					
					while($rs_barra_sub_subcat = mysql_fetch_assoc($result_barra_sub_subcat)){
						echo '<a href="../../'.$rs_barra_sub_subcat['link'].'" class="submenuitem conlink" >'.$rs_barra_sub_subcat['titulo'].'</a>';
					}
				}
			}
			echo '</div>';
		}
					

	}
	
	?>
</div>
