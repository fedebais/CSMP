<?php 

   include("../../inc.mysql.php"); 

   // VARS
   $AlertKey = $_GET['key'];


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

   <?php include("../../inc.metatags.php"); ?>

   <?php include("../../inc.resources.php"); ?>

   <script src="../../js/highcharts/highcharts.js"></script>
   <script src="../../js/highcharts/highcharts-3d.js"></script>
   <script src="../../js/highcharts/highcharts-more.js"></script>
   <script src="../../js/highcharts/modules/exporting.js"></script>

   <script src="../../js/highcharts/modules/data.js"></script>
   <script src="../../js/highcharts/modules/drilldown.js"></script>

   <script type="text/javascript">
      $(function () {

         $('#chartTiempoRespuesta').highcharts({
            chart: {
               type: 'area',
               spacingBottom: 30
            },
            title: {
               text: '' // Últimos 15 días
            },
            subtitle: {
               text: '', //* Jane\'s banana consumption is unknown
               floating: true,
               align: 'right',
               verticalAlign: 'bottom',
               y: 15
            },
            legend: {
               layout: 'vertical',
               align: 'left',
               verticalAlign: 'top',
               x: 150,
               y: 100,
               floating: true,
               borderWidth: 1,
               backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
            },
            xAxis: {
               categories: ['06/08','07/08','08/08','09/08','10/08','11/08','12/08','13/08', '14/08','15/08', '16/08', '17/08', '18/08', '19/08', '20/08']
            },
            yAxis: {
               title: {
                   text: 'Segundos'
               },
               labels: {
                   formatter: function () {
                       return this.value;
                   }
               }
            },
            tooltip: {
               formatter: function () {
                   return '<b>' + this.series.name + '</b><br/>' +
                       this.x + ': ' + this.y +' seg.';
               }
            },
            plotOptions: {
               area: {
                  fillOpacity: 0.5
               }
            },
            credits: {
               enabled: false
            },
            series: [{
               name: 'Tiempo de Respuesta', //Tiempo de Respuesta
               data: [0.8, 1.6, 1.3, 1.2, 1.8,1.4, 2.3, 1.8, 1.2, 2.5, 2.7, 1.5, 1.9, 1.4, 2.3,1.8],
               color: 'rgba(25,49,55,1)'
            }]
         });

         $('#chartFalsaAlarma').highcharts({
            chart: {
               type: 'area',
               spacingBottom: 30
            },
            title: {
               text: '' //Últimos 15 días
            },
            subtitle: {
               text: '', //* Jane\'s banana consumption is unknown
               floating: true,
               align: 'right',
               verticalAlign: 'bottom',
               y: 15
            },
            legend: {
               layout: 'vertical',
               align: 'left',
               verticalAlign: 'top',
               x: 150,
               y: 100,
               floating: true,
               borderWidth: 1,
               backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
            },
            xAxis: {
               categories: ['06/08','07/08','08/08','09/08','10/08','11/08','12/08','13/08', '14/08','15/08', '16/08', '17/08', '18/08', '19/08', '20/08']
            },
            yAxis: {
               title: {
                   text: 'Falsa Alarma'
               },
               labels: {
                   formatter: function () {
                       return this.value;
                   }
               }
            },
            tooltip: {
               formatter: function () {
                   return '<b>' + this.series.name + '</b><br/>' +
                       this.x + ': ' + this.y ;
               }
            },
            plotOptions: {
               area: {
                  fillOpacity: 0.5
               }
            },
            credits: {
               enabled: false
            },
            series: [{
               name: 'Falsas Alarmas', //Tiempo de Respuesta
               data: [5, 8, 14, 18, 16, 24, 15, 13, 16, 7, 8, 9, 5, 12, 13, 8],
               color: 'rgba(25,49,55,1)'
            }]
         });

         $('#chartDisposivos').highcharts({

              chart: {
                  polar: true,
                  type: 'line'
              },

              title: {
                  text: '',
                  x: -80
              },

              pane: {
                  size: '80%'
              },

              xAxis: {
                  categories: ['Defensa Civil', 'Denuncia Online', 'Vigiladores', 'Domicilio',
                          'Colegios', 'Transporte'],
                  tickmarkPlacement: 'on',
                  lineWidth: 0
              },

              yAxis: {
                  gridLineInterpolation: 'polygon',
                  lineWidth: 0,
                  min: 0
              },

              tooltip: {
                  shared: true,
                  pointFormat: '<span style="color:{series.color}">{series.name}: <b>${point.y:,.0f}</b><br/>'
              },

              legend: {
                  align: 'right',
                  verticalAlign: 'top',
                  y: 70,
                  layout: 'vertical'
              },

              series: [{
                  name: 'Cantidad de Alertas',
                  data: [43000, 19000, 60000, 17000, 57000, 10000],
                  pointPlacement: 'on',
                  color: 'rgba(25,49,55,1)'
               }/*, {
                  name: 'Actual Spending',
                  data: [50000, 39000, 42000, 31000, 26000, 14000],
                  pointPlacement: 'on'
               }*/]

         });

         $('#chartDisposivos2').highcharts({

              chart: {
                  polar: true,
                  type: 'line'
              },

              title: {
                  text: '',
                  x: -80
              },

              pane: {
                  size: '80%'
              },

              xAxis: {
                  categories: ['Botón Pánico', 'Escolar', 'Online', 'DrogasNo',
                          'Género', 'Establec. Privados'],
                  tickmarkPlacement: 'on',
                  lineWidth: 0
              },

              yAxis: {
                  gridLineInterpolation: 'polygon',
                  lineWidth: 0,
                  min: 0
              },

              tooltip: {
                  shared: true,
                  pointFormat: '<span style="color:{series.color}">{series.name}: <b>${point.y:,.0f}</b><br/>'
              },

              legend: {
                  align: 'right',
                  verticalAlign: 'top',
                  y: 70,
                  layout: 'vertical'
              },

              series: [{
                  name: 'Cantidad de Alertas',
                  data: [19000, 54000, 17000, 67000, 36000, 43000],
                  pointPlacement: 'on',
                  color: 'rgba(25,49,55,1)'
               }/*, {
                  name: 'Actual Spending',
                  data: [50000, 39000, 42000, 31000, 26000, 14000],
                  pointPlacement: 'on'
               }*/]

          });

         $('#chartShare').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: ''
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: [{
                    name: 'Microsoft',
                    y: 56.33
                }, {
                    name: 'Chrome',
                    y: 24.03,
                    sliced: true,
                    selected: true
                }, {
                    name: 'Firefox',
                    y: 10.38
                }, {
                    name: 'Safari',
                    y: 4.77
                }]
            }]
         });

         /*$('#chartShare2').highcharts({
            chart: {
               plotBackgroundColor: null,
               plotBorderWidth: null,
               plotShadow: false,
               type: 'pie'
            },
            title: {
               text: ''
            },
            tooltip: {
               pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
               pie: {
                  allowPointSelect: true,
                  cursor: 'pointer',
                  dataLabels: {
                     enabled: false
                  },
                  showInLegend: true
               }
            },
            series: [{
               name: 'Brands',
               colorByPoint: true,
               data: [{
                  name: 'Microsoft',
                  y: 44.33
               }, {
                  name: 'Chrome',
                  y: 24.03
               }, {
                  name: 'Firefox',
                  y: 22.38,
                  sliced: true,
                  selected: true
               }, {
                  name: 'Safari',
                  y: 4.77
                }]
            }]
         });*/

         $('#chartShare2').highcharts({
              chart: {
                  type: 'column'
              },
              title: {
                  text: ''
              },
              xAxis: {
                  type: 'category'
              },
              yAxis: {
                  title: {
                      text: ''
                  }

              },
              legend: {
                  enabled: false
              },
              plotOptions: {
                  series: {
                      borderWidth: 0,
                      dataLabels: {
                          enabled: true,
                          format: '{point.y:.1f}%'
                      }
                  }
              },

              tooltip: {
                  headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                  pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
              },

              series: [{
                  name: 'Brands',
                  colorByPoint: true,
                  data: [{
                      name: 'Microsof',
                      y: 56.33,
                      drilldown: 'Microsoft'
                  }, {
                      name: 'Chrome',
                      y: 24.96,
                      drilldown: 'Chrome'
                  }, {
                      name: 'Firefox',
                      y: 10.38,
                      drilldown: 'Firefox'
                  }, {
                      name: 'Safari',
                      y: 4.77,
                      drilldown: 'Safari'
                  }]
              }],
              drilldown: {
                  series: [{
                      name: 'Microsoft Internet Explorer',
                      id: 'Microsoft Internet Explorer',
                      data: [
                          [
                              'v11.0',
                              24.13
                          ],
                          [
                              'v8.0',
                              17.2
                          ],
                          [
                              'v9.0',
                              8.11
                          ],
                          [
                              'v10.0',
                              5.33
                          ],
                          [
                              'v6.0',
                              1.06
                          ],
                          [
                              'v7.0',
                              0.5
                          ]
                      ]
                  }, {
                      name: 'Chrome',
                      id: 'Chrome',
                      data: [
                          [
                              'v40.0',
                              5
                          ],
                          [
                              'v41.0',
                              4.32
                          ],
                          [
                              'v42.0',
                              3.68
                          ],
                          [
                              'v39.0',
                              2.96
                          ],
                          [
                              'v36.0',
                              2.53
                          ],
                          [
                              'v43.0',
                              1.45
                          ],
                          [
                              'v31.0',
                              1.24
                          ],
                          [
                              'v35.0',
                              0.85
                          ],
                          [
                              'v38.0',
                              0.6
                          ],
                          [
                              'v32.0',
                              0.55
                          ],
                          [
                              'v37.0',
                              0.38
                          ],
                          [
                              'v33.0',
                              0.19
                          ],
                          [
                              'v34.0',
                              0.14
                          ],
                          [
                              'v30.0',
                              0.14
                          ]
                      ]
                  }, {
                      name: 'Firefox',
                      id: 'Firefox',
                      data: [
                          [
                              'v35',
                              2.76
                          ],
                          [
                              'v36',
                              2.32
                          ],
                          [
                              'v37',
                              2.31
                          ],
                          [
                              'v34',
                              1.27
                          ],
                          [
                              'v38',
                              1.02
                          ],
                          [
                              'v31',
                              0.33
                          ],
                          [
                              'v33',
                              0.22
                          ],
                          [
                              'v32',
                              0.15
                          ]
                      ]
                  }, {
                      name: 'Safari',
                      id: 'Safari',
                      data: [
                          [
                              'v8.0',
                              2.56
                          ],
                          [
                              'v7.1',
                              0.77
                          ],
                          [
                              'v5.1',
                              0.42
                          ],
                          [
                              'v5.0',
                              0.3
                          ],
                          [
                              'v6.1',
                              0.29
                          ],
                          [
                              'v7.0',
                              0.26
                          ],
                          [
                              'v6.2',
                              0.17
                          ]
                      ]
                  }]
              }
         });

      });
   </script>

</head>

<body>

   <?php include("../../inc.navigation.php"); ?>

   <section id="dashboard">

      <div class="container">

         <div class="panel">

            <div class="panel-heading">
               <div class="row">
                  <div class="col-lg-12">
                     <h3 class="panel-title">Tiempo de Respuesta</h3>
                     <div class="user-data">
                        Reporte del tiempo de respuesta promedio diario de los últimos 15 días.
                     </div>
                  </div>
               </div>
            </div>

            <div class="panel-body">
               <div id="chartTiempoRespuesta" style="min-width: 310px; height: 300px; margin: 0 auto"></div>
            </div>
         
         </div>

         <div class="panel">

            <div class="panel-heading">
               <div class="row">
                  <div class="col-lg-12">
                     <h3 class="panel-title">Alarmas</h3>
                     <div class="user-data">
                        Resumen de los diferentes tipos de alarmas de los últimos 15 días.
                     </div>
                  </div>
               </div>
            </div>

            <div class="panel-body">
               <div id="chartDisposivos" class="pull-left" style="min-width: 400px; width: 50%; height: 300px; margin: 0 auto"></div>
               <div id="chartDisposivos2" class="pull-left" style="min-width: 400px; width: 50%; height: 300px; margin: 0 auto"></div>
               <div class="clearfix"></div>
            </div>

         </div>

         <div class="panel">

            <div class="panel-heading">
               <div class="row">
                  <div class="col-lg-12">
                     <h3 class="panel-title">Denuncias</h3>
                     <div class="user-data">
                        Resumen de los diferentes tipos de alarmas de los últimos 15 días.
                     </div>
                  </div>
               </div>
            </div>

            <div class="panel-body">
               <div id="chartShare" class="pull-left" style="min-width: 310px; height: 300px; width: 50%;  margin: 0 auto"></div>
               <div id="chartShare2" class="pull-left" style="min-width: 310px; height: 300px; width: 50%;  margin: 0 auto"></div>
               <div class="clearfix"></div>
            </div>

         </div>

         <div class="panel">

            <div class="panel-heading">
               <div class="row">
                  <div class="col-lg-12">
                     <h3 class="panel-title">Falsas Alarmas</h3>
                     <div class="user-data">
                        Reporte de cantidad de falsas alarmas de los últimos 15 días.
                     </div>
                  </div>
               </div>
            </div>

            <div class="panel-body">
               <div id="chartFalsaAlarma" style="min-width: 310px; height: 300px; margin: 0 auto"></div>
            </div>

         </div>

      </div>

   </section>


   <script src="https://www.gstatic.com/firebasejs/3.2.1/firebase.js"></script>
   <script>
      var config = {
         apiKey: "AIzaSyDNK0RzdP_uulAJaYTau9QU_jmOEOJQy_8",
         authDomain: "clarociudadsegura.firebaseapp.com",
         databaseURL: "https://clarociudadsegura.firebaseio.com",
         storageBucket: "clarociudadsegura.appspot.com",
      }; firebase.initializeApp(config);
   </script>


</body>
</html>