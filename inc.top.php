<?php 

		$ruta = "../../";

?>
<div class="header">
	<div class="first-row">
    
    	<div class="logo"><img src="<?php echo $ruta ?>imagen/logo-panel/logo.png" /></div>
        <div class="user"><?php echo strtoupper($_SESSION['log_nombre']) ?> | <a href="<?php echo $ruta ?>process.logout.php">CERRAR SESIÓN</a></div>
        <div class="clear"></div>
    
    </div>
    <div class="second-row">
    
    	<div class="date"><?php echo strtoupper(date("l d").", ".date("F / Y")) ?></div>
    	<div class="clear"></div>
    
    </div>
</div>


