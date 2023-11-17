<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Tablero
      
      <small>Panel de Control</small>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Tablero</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">
      
    </div> 

        <?php

             echo '<div class="row">';


             if($_SESSION["tipo"] =="Administrador" || $_SESSION["tipo"] =="Fabricante"){         
               include "inicio/cajas-superiores.php";
               include "inicio/cajas-superiores-dists.php";
         
             }
             else if($_SESSION["tipo"] =="Mayorista"){
              include "inicio/cajas-superiores-dists.php";
             }
               
             echo '<div class="col-lg-12">';
             

             if($_SESSION["tipo"] =="Administrador" || $_SESSION["tipo"] =="Fabricante"){
              include "reportes/grafico-ventas.php";
              include "reportes/grafico-ventas-dists.php";
   
             }
             else if($_SESSION["tipo"] =="Mayorista"){
              include "reportes/grafico-ventas-dists.php";
             }
   
     
             echo '</div>
     
             <div class="col-lg-6">';

             if($_SESSION["tipo"] =="Administrador"){           
              include "reportes/productos-mas-vendidos.php";
              include "reportes/productos-mas-vendidos-mayoristas.php";
            }
            else if($_SESSION["tipo"] =="Fabricante"){
              include "reportes/productos-mas-vendidos.php";
            }
            else if($_SESSION["tipo"] =="Mayorista"){
              include "reportes/productos-mas-vendidos-mayoristas.php";
            }

        
             echo '</div>
     
              <div class="col-lg-6">';
              if($_SESSION["tipo"] =="Administrador"){        
                include "inicio/productos-recientes.php";
                include "inicio/productos-recientes-mayoristas.php";
     
              }
              else if($_SESSION["tipo"] =="Fabricante"){
                include "inicio/productos-recientes.php";
              }
              else if($_SESSION["tipo"] =="Mayorista"){
                include "inicio/productos-recientes-mayoristas.php";
              }     
             echo '</div>';

            if($_SESSION["tipo"]=="Solicitante"){
              include "info-cuenta.php";
            }

          ?>

         </div>

     </div>

  </section>
 
</div>
