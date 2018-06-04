<?php include("../../inc.mysql.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

  <?php include("../../inc.metatags.php"); ?>
  <?php include("../../inc.resources.php"); ?>

</head>

<body>

   <?php include("../../inc.navigation.php"); ?>

   <section id="dashboard">

    <div class="container">

      <div class="panel">

         <div class="panel-heading">
            <h3 class="panel-title">Menú Principal</h3>
         </div>

         <div class="panel-body">

            <div class="row">

               <div class="widget col-lg-2 text-center">
                  <a href="../alerta/alerta.php" class="box-icon dark">
                     <div class="inner">
                        <img src="../../img/dashboard/ic-alerta.png"> 
                     </div>
                  </a>
                  <div class="box-title">
                     Alertas
                  </div>
               </div>

               <div class="widget col-lg-2 text-center">
                  <a href="#" class="box-icon dark">
                     <div class="inner">
                        <img src="../../img/dashboard/ic-denuncia.png">
                     </div>
                  </a>
                  <div class="box-title">
                     Denuncias
                  </div>
               </div>

               <div class="widget col-lg-2 text-center">
                  <a href="../alerta/mapa.php" class="box-icon dark">
                     <div class="inner">
                        <img src="../../img/dashboard/ic-mapa.png">
                     </div>
                  </a>
                  <div class="box-title">
                     Mapa
                  </div>
               </div>

               <div class="widget col-lg-2 text-center">
                  <a href="../alerta/reporte.php" class="box-icon dark">
                     <div class="inner">
                        <img src="../../img/dashboard/ic-reporte.png">
                     </div>
                  </a>
                  <div class="box-title">
                     Reportes
                  </div>
               </div>

               <div class="widget col-lg-2 text-center">
                  <a href="#" class="box-icon dark">
                     <div class="inner">
                        <img src="../../img/dashboard/ic-administracion.png">
                     </div>
                  </a>
                  <div class="box-title">
                     Administración
                  </div>
               </div>

               <div class="widget col-lg-2 text-center">
                  <a href="#" class="box-icon dark">
                     <div class="inner">
                        <img src="../../img/dashboard/ic-denuncia.png">
                     </div>
                  </a>
                  <div class="box-title">
                     Bitácora
                  </div>

               </div>

            </div>

         </div>

      </div>

      <div class="panel">

         <div class="panel-heading">
            <h3 class="panel-title">Canales de entrada</h3>
         </div>

        <div class="panel-body">

          <div class="row">

            <div class="widget col-lg-2 text-center">
              <a href="#" class="box-icon light">
                <div class="inner">
                  <img src="../../img/dashboard/ic-posnet.png"> 
                </div>
              </a>
              <div class="box-title">
                Alerta POS
              </div>
            </div>

            <div class="widget col-lg-2 text-center">
              <a href="#" class="box-icon light">
                <div class="inner">
                  <img src="../../img/dashboard/ic-hogar.png">
                </div>
              </a>
              <div class="box-title">
                Alerta Domicilio
              </div>
            </div>

            <div class="widget col-lg-2 text-center">
              <a href="#" class="box-icon light">
                <div class="inner">
                  <img src="../../img/dashboard/ic-escuela.png">
                </div>
              </a>
              <div class="box-title">
                Alerta Escuela
              </div>
            </div>

            <div class="widget col-lg-2 text-center">
              <a href="#" class="box-icon light">
                <div class="inner">
                  <img src="../../img/dashboard/ic-privado.png">
                </div>
              </a>
              <div class="box-title">
                Est. Privados
              </div>
            </div>

            <div class="widget col-lg-2 text-center">
              <a href="#" class="box-icon light">
                <div class="inner">
                  <img src="../../img/dashboard/ic-transporte.png">
                </div>
              </a>
              <div class="box-title">
                Alerta Transporte
              </div>
            </div>

            <div class="widget col-lg-2 text-center">
              <a href="#" class="box-icon light">
                <div class="inner">
                  <img src="../../img/dashboard/ic-escolar.png">
                </div>
              </a>
              <div class="box-title">
                Transporte Escolar
              </div>
            </div>

            <div class="widget col-lg-2 text-center">
              <a href="#" class="box-icon light">
                <div class="inner">
                  <img src="../../img/dashboard/ic-online.png"> 
                </div>
              </a>
              <div class="box-title">
                Denuncia Online
              </div>
            </div>

            <div class="widget col-lg-2 text-center">
              <a href="#" class="box-icon light">
                <div class="inner">
                  <img src="../../img/dashboard/ic-twitter.png">
                </div>
              </a>
              <div class="box-title">
                Twitter
              </div>
            </div>

            <div class="widget col-lg-2 text-center">
              <a href="#" class="box-icon light">
                <div class="inner">
                  <img src="../../img/dashboard/ic-sms.png">
                </div>
              </a>
              <div class="box-title">
                SMS Vecinos
              </div>
            </div>

            <div class="widget col-lg-2 text-center">
              <a href="#" class="box-icon light">
                <div class="inner">
                  <img src="../../img/dashboard/ic-vigiladores.png">
                </div>
              </a>
              <div class="box-title">
                SMS Vigiladores
              </div>
            </div>

            <div class="widget col-lg-2 text-center">
              <a href="#" class="box-icon light">
                <div class="inner">
                  <img src="../../img/dashboard/ic-manzaneras.png">
                </div>
              </a>
              <div class="box-title">
                SMS Manzaneras
              </div>
            </div>

            <div class="widget col-lg-2 text-center">
              <a href="#" class="box-icon light">
                <div class="inner">
                  <img src="../../img/dashboard/ic-genero.png">
                </div>
              </a>
              <div class="box-title">
                SMS Violencia Género
              </div>
            </div>

            <div class="widget col-lg-2 text-center">
              <a href="#" class="box-icon light">
                <div class="inner">
                  <img src="../../img/dashboard/ic-droga.png"> 
                </div>
              </a>
              <div class="box-title">
                Droga NO
              </div>
            </div>

            <div class="widget col-lg-2 text-center">
              <a href="#" class="box-icon light">
                <div class="inner">
                  <img src="../../img/dashboard/ic-defensa.png">
                </div>
              </a>
              <div class="box-title">
                Defensa Civil
              </div>
            </div>

            <div class="widget col-lg-2 text-center">
              <a href="#" class="box-icon light">
                <div class="inner">
                  <img src="../../img/dashboard/ic-viajoseguro.png">
                </div>
              </a>
              <div class="box-title">
                Viajo Seguro
              </div>
            </div>

          </div>

        </div>

      </div>

    </div>
  </section>


</body>
</html>