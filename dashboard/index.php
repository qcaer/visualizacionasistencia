<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="col-md-12">
<h2 style="text-align:center" >Sistema de Información</h2>
  <h2 style="text-align:center" >EDD-2022</h2>
  <form role="form" method="POST">
  <form action="/action_page.php">
    <div class="form-group">
      <label for="email">Documento:</label>
      <input type="text" class="form-control" name="documento" placeholder="Ingrese un DNI" required>
    </div>

  
    <button style="background:#337ab7; color:white" type="submit" class=" btn btn-default">Consultar</button>
 
  </form>
    
    
    
    <?php
   // require('conexion.php');
    //$con = Conectar();
    //$
    if($_POST){
   require('conexion.php');
    
    $con = Conectar();
    $id = $_POST['documento'];
    $SQL = 'SELECT id, Provincia, Oficina, ApellidoyNombres, Dni, Situacion, Liquidez, Monto, Celular, Condicion,  Cargo, IE, Contesto FROM NEW WHERE Dni = :doc';
    $stmt = $con->prepare($SQL);

    $result = $stmt->execute(array(':doc'=>$id));
   $rows = $stmt->fetchAll(PDO::FETCH_OBJ);





    if(count($rows)){
      
        foreach ($rows AS $row){
  
  ?>






  <div style="margin-top:10px" class="panel panel-primary">
        <div class="panel-heading">Información del usuario con DNI: <?php print($id)?></div><br/>


  

       <div class="col-md-12 panel-body">
        <div class="row">

               
                <div class="col-lg-12">
                    <div class="table-responsive ">    
                      
                        <table id="tablaPersonas"  class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>ID</th>
                                <th>Provincia</th>
                                <th>Oficina</th>
                                <th>Apellidos y Nombres</th>
                                <th>DNI</th>  
                                <th>Situación</th>                            
                                <th>Liquidez</th> 
                                <th>Monto</th> 
                               <!--<th>Liquidez Final</th> -->
                                <th>Celular</th> 
                                <th>Condición</th> 
                                <th>Cargo</th> 
                                <th>I.E.</th> 
                                <th>Contesto</th> 
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                       
                            <tr>
                                
                                <td><?php print $row->id?></td>
                                <td><?php print $row->Provincia?></td>
                                <td><?php print $row->Oficina?></td>
                                <td><?php print $row->ApellidoyNombres?></td>
                                <td><?php print $row->Dni?></td>
                                <td><?php print $row->Situacion?></td>
                                <td><?php print $row->Liquidez?></td> 
                                <td><?php print $row->Monto?></td> 
                                <td><?php print $row->Celular?></td> 
                                <td><?php print $row->Condicion?></td> 
                                <td><?php print $row->Cargo?></td>
                                <td><?php print $row->IE?></td>
                                <td><?php print $row->Contesto?></td>   
                                <td></td>
                                </tr>
                                              
                        </tbody>    
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    


        
  </div>








  <?php
    
          
        
        }
  
      }else{
          echo "El DNI no existe en la base de datos";
      }
  
  
      }
  ?>
<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
                <h5 class="modal-title">Editar Usuario</h5>
               
            </div>
            
        <form id="formPersonas">    
            <div class="modal-body">
                <div class="form-group">
                <label for="Provincia" class="col-form-label">Provincia:</label>
                <input type="text" class="form-control" disabled id="Provincia">
                </div>
                <div class="form-group">
                <label for="Oficina" class="col-form-label">Oficina:</label>
                <input type="text" class="form-control"  disabled id="Oficina">
                </div>                
                <div class="form-group">
                <label for="ApellidoyNombres" class="col-form-label">ApellidoyNombres:</label>
                <input type="text" class="form-control"  disabled  id="ApellidoyNombres">
                </div>  
                
                <div class="form-group">
                    <label for="Contesto" class="col-form-label">Contesto:</label>
                
                  <select name="Contesto" class="form-control" id="Contesto">
                                    <option value="Si">Si contesto</option>
                                    <option value="No">No contesto</option>
                                    <option value="Agendar">Agendar para otro dia</option>
                                   
                    </select>

                </div>            

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  
      

     <script src="../bootstrap/js/bootstrap.min.js"></script>    
        
     <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script> 
    
</div>

<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>