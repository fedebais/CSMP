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
               <h3 class="panel-title">Monitoreo de Alertas</h3>
            </div>

            <div class="panel-body">

               <div class="portlet-body">
                  
                  <!--    
                  <a id="stopSound" class="btn btn-primary pull-right" style="margin-bottom:20px; background-color:#BC0000;" href="">Detener Sonido</a>
                  <div class="clearfix"></div>
                  -->

                     <div ><!-- class="table-responsive" -->

                        <table class="table table-striped table-hover" id="table-alertas">
                           
                           <thead>
                              <tr>
                                 <th>
                                     Fecha
                                 </th>
                                 <th>
                                     Dispositivo
                                 </th>
                                 <th>
                                     Alarma
                                 </th>
                                 <th>
                                     Procedencia
                                 </th>
                                 <th class='text-center'>
                                     Estado
                                 </th>
                              </tr>
                           </thead>

                           <tbody>
                              <tr></tr>
                           </tbody>

                        </table>

                     </div>

                  </div>

            </div>

         </div>

      </div>

   </section>

   <div style="display:none;">
       <audio id="music" preload="auto">
           <source src="../../sound/alerta.mp3" type="audio/mpeg">
       </audio> 
   </div>

   <link rel="stylesheet" type="text/css" href="../../js/DataTables/datatables.min.css"/>
   <script type="text/javascript" src="../../js/DataTables/datatables.min.js"></script>

   <script src="https://www.gstatic.com/firebasejs/3.2.1/firebase.js"></script>
   <script>
      var config = {
         apiKey: "AIzaSyDNK0RzdP_uulAJaYTau9QU_jmOEOJQy_8",
         authDomain: "clarociudadsegura.firebaseapp.com",
         databaseURL: "https://clarociudadsegura.firebaseio.com",
         storageBucket: "clarociudadsegura.appspot.com",
      }; firebase.initializeApp(config);
   </script>
    
   <script>

      function changeStatus(key, value){
         firebase.database().ref('alerta/'+key+'/status').set(value);
      }

      $(document).ready(function() {   
         
         var isFirstLoadingComplete = false;
         var count = 0;
         var alertasRef = firebase.database().ref('alerta').limitToLast(20);
         //var audio = new Audio('../../sound/alerta.mp3'); audio.pause();

         //FIRST LOAD
         //var dataArray = [];
         alertasRef.on('child_added', function(snap) {

            if (isFirstLoadingComplete){
               $("#music")[0].play();
               //.stop().animate({volume: 1}, 100);
            }

            var dataArray = $.makeArray( snap.val() );
            dataArray[0]['key'] = snap.key;
            
            console.log('Array: '+dataArray);

            $.ajax({
               type: "POST",
               url: 'process.getResponseData.php',
               data: {data:dataArray},
               cache: false,
               success: function(data){
                  
                  var Result = data.split('::')
                  console.log(data);
                  
                  if(Result[0] == 'true'){
                     //$('#table-alertas tbody tr:first').after(Result[1]);
                     console.log('added: '+Result[1]);
                  }else{
                     console.log('error: '+Result[1]);
                  }
                  
               }
            });


            var fecha = snap.val().date+"<br>"+snap.val().time+"hs";
            var procedencia = snap.val().apellido+", "+snap.val().nombre+"<br> 11.4333.3333";
            var origen = '<div class="label-device apple"> <i class="fa fa-apple" aria-hidden="true"></i> apple app</div>';
            var type = '<div class="label-alert '+snap.val().type+'">'+snap.val().type+'</div>';

            /*var estado = '<a href="detalle_alerta.php?key='+snap.key+'" target="_blank"><div class="label-status new">Nueva Alarma</div><div class="label-open"><i class="fa fa-search"></i></div></a>';*/

            var estado = '<div class="btn-group">' +
               '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                  ' <span id="case-status">'+snap.val().status+'</span> &nbsp; <i class="fa fa-chevron-down"></i>' +
               '</button>' +
               '<ul class="dropdown-menu">' +
                  '<li><a href="javascript:changeStatus(\''+snap.key+'\',\'Nueva Alarma\');">Nueva Alarma</a></li>' +
                  '<li><a href="javascript:changeStatus(\''+snap.key+'\',\'Atendido\');">Atendido</a></li>' +
                  '<li><a href="javascript:changeStatus(\''+snap.key+'\',\'Pendiente\');">Pendiente</a></li>' +
                  '<li><a href="javascript:changeStatus(\''+snap.key+'\',\'Repetido\');">Repetido</a></li>' +
                  '<li role="separator" class="divider"></li>' +
                  '<li><a href="javascript:changeStatus(\''+snap.key+'\',\'Falsa Alarma\');">Falsa Alarma</a></li>' +
               '</ul>' +
               '</div>' + 
               '<a href="detalle_alerta.php?key='+snap.key+'" target="_blank"><div class="label-open"><i class="fa fa-search"></i></div></a>';


            var caso = Math.floor(Math.random() * 200 ) + 1;
            var id = Math.floor(Math.random() * 99999 ) + 1;

            var tr = "<tr class='"+snap.key+"'><td>"+fecha+"</td><td>"+origen+"</td><td class='type text-capitalize'>"+type+"</td><td>"+procedencia+"</td><td class='text-center'>"+estado+"</td></tr>";

            $('#table-alertas tbody tr:first').after(tr);

            if (isFirstLoadingComplete){
               $('#table-alertas tbody tr:nth-child(2)').addClass('highlight');
               setTimeout(function(){
                  $('#table-alertas tbody tr:nth-child(2)').removeClass('highlight');
               },6000);
            }

            count++;
            //console.log("added", snap.val());

         });

         alertasRef.once("value", function(snap) {

            if( Object.keys(snap.val()).length === count ) isFirstLoadingComplete = true;
            //console.log(" initial loading complete! Count: "+count+" vs. Lengh: "+Object.keys(snap.val()).length, isFirstLoadingComplete);

         });

         alertasRef.on('child_changed', function(snap) {
            $("tr."+snap.key+" td.type .label-alert ").html(snap.val().type);
            $("tr."+snap.key+" td #case-status").html(snap.val().status);

            $("#music")[0].play();

            $("tr."+snap.key).addClass('highlight');
            setTimeout(function(){
               $("tr."+snap.key).removeClass('highlight');
            },6000);

         });

         $('#stopSound').on("click",function(e){
            e.preventDefault();
            $("#music")[0].pause();
         });

         

      });

   </script>


</body>
</html>