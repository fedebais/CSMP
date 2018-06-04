<header>

  <nav class="menu-top">
    <div class="container">
      
      <div class="logo pull-left">
        <img src="../../img/logo-header.png">
      </div>

      <ul class="menu-user list-inline pull-right">
        <li><?php echo $_SESSION['log_nombre'] ?></li>
        <li><i class="fa fa-lock"></i></li>
        <li>
          <a href="../../process.logout.php">
            <i class="fa fa-power-off"></i>
          </a>
        </li>
      </ul>

    </div>
  </nav>

  <nav class="menu-bottom">
    <div class="container">
      <ul class="menu list-inline">
        <li class=""><!-- active -->
          <a href="../inicio/inicio.php">
            <i class="fa fa-home"></i> Inicio
          </a>
        </li>
        <li class=""><!-- active -->
          <a href="../alerta/alerta.php">
            <i class="fa fa-exclamation-triangle"></i> Alertas
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-bullhorn"></i> Denuncias
          </a>
        </li>
        <li>
          <a href="../alerta/mapa.php">
            <i class="fa fa-map-marker"></i> Mapa
          </a>
        </li>
        <li>
          <a href="../alerta/reporte.php">
            <i class="fa fa-bar-chart"></i> Reportes
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-cog"></i> Administración
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-folder-open"></i> Bitácora
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-tachometer"></i> Estado del Sistema
          </a>
        </li>
      </ul>
    </div>
  </nav>

</header>