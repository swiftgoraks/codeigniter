<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<?php
    $mostrar="hidden";
    if($mostrarD)
    {
        $mostrar="";
    }
    if(isset($sqlInjection)){echo "<div class='alert alert-danger'>Estas ingresando palabras indebidas</div>";}
?>

<button type='submit' class='btn btn-primary' data-toggle="modal" data-target='#modalAddReceta' >Agregar</button>

<div class="box">

        <div class="box-header">
            <h3 class="box-title">Listado Recetas</h3>
            <div class="box-tools">
            
            </div>
        </div><!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover" id="tbData">
            <thead>
                <tr role="row"><th class="sorting_asc"   width="0px">
                ID</th><th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 181px;">
                Paciente</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 223px;">
                Fecha</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 155px;">
                Imagen Receta</th></tr>
            </thead>
            <tbody>
                <?php foreach ($listadoR as $fila): ?>
                    <tr>
                    <td><?php echo $fila->id_receta;?></td>
                    <td><?php echo $fila->nombre;?></td>
                    <td><?php echo $fila->fecha; ?></td>
                    <td><img src="http://localhost/parcial/img/<?php echo $fila->img?>" id="<?php echo $fila->img?>" name="<?php echo $fila->img?>" height="115px" width="125px"> </img></td>
                    <td><button type='submit'  id='btmodal' name='btmodal' class='btn btn-primary'>Modificar</button></td>
                    <td><button type='submit'  id='btmodalDetalle' name='btmodalDetalle' class='btn btn-primary'>Ver detalle</button></td>
                    <td><button type='submit' id='bteliminar' name='bteliminar' class='btn btn-danger'>Eliminar</button></td>
                    <td style="width:0.01px; max-width:0.01px; visibility:hidden;"><?php echo $fila->id_persona;?></td>
                    <td style="width:0.01px; max-width:0.01px; visibility:hidden;"><?php echo $fila->img;?></td>
                </tr role="row" class="odd">
                <?php endforeach;?>
            </tbody></table>
        </div><!-- /.box-body -->
        </div>



<!-- Modal -->
<div class="modal fade" id="modalEditReceta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header bg-blue">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar Receta</h4>
      </div>
      <form action="<?php echo site_url('receta/actualizar');?>" enctype="multipart/form-data" method="post">
        <div class="modal-body">
           
                <div class="box-body">
                
                <input type="hidden" id="modalidreceta" name="modalidreceta" >
                <input type="hidden" id="imgDel" name="imgDel" >
                    <div class="form-group">
                        <img id="mostrarImg" height="200px" width="250px"/>
                        <button type="button" class="btn btn-danger" id="quitar">Eliminar Imagen</button>
                        <button type="button" class="btn btn-primary" id="back">Finalizar/Volver</button>
                </br> </br> 
                        <input class="input-group btn btn-info" type="file" id="image" name="image" accept="image/*" />
                        
                    </div>
                    <div class="form-group ">
                        <label>Paciente:</label>
                        <select class="form-control btn btn-primary" id="modalPaciente" name="modalPaciente" >     
                            <?php foreach ($persona as $item): ?>
                                <option value=<?php echo $item->id_persona;?>> <?php echo $item->nombre;?> </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Fecha:</label>
                        <input id="modalFecha" name="modalFecha" readonly required />
                            <script>
                                $('#modalFecha').datepicker({
                                    format: 'yyyy/mm/dd',
                                    firstDay: 1
                                });
                            </script>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" id="btModalClose" data-dismiss="modal">Cancelar</button>
           
            <input type="submit" class="btn btn-info " value="Actualizar">
        </div>
            </form>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalAddReceta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header bg-blue">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Agregar Receta</h4>
      </div>
        <div class="modal-body">
            <form action="<?php echo site_url('receta/insertar');?>" enctype="multipart/form-data" method="post">
                <div class="form-group">
                <label>Paciente:</label>
                <select class="form-control" id="id_persona" name="id_persona">     
                    <?php foreach ($persona as $item): ?>
                        <option value=<?php echo $item->id_persona;?>> <?php echo $item->nombre;?> </option>
                    <?php endforeach; ?>
                </select>
                </div>
                <div class="form-group">
                    <label>Fecha:</label>
                    <input id="datepicker" name="datepicker" width="276" readonly required />
                        <script>
                            $('#datepicker').datepicker({
                                format: 'yyyy/mm/dd'
                            });
                    </script>
                </div>
                <div class="form-group">
                    <label>Imagen:</label>
                    <!--<img id="mostrarImgAdd" height="200px" width="250px"/>-->
                    <input class="input-group" type="file" id="image2" name="image2" accept="image/*" />
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="btModalClose" data-dismiss="modal">Cancelar</button>
                <input type="submit" class="btn btn-info " value="Agregar">
            </div>
        </form>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $(".table tbody").on('click','#bteliminar',function(){
            let currentrow  = $(this).closest('tr');
            let id_receta  = currentrow.find('td:eq(0)').text();
            let img1    =   currentrow.find('td:eq(8)').text();
            let baseURL= "<?php echo base_url();?>";
            $.ajax({
                type: "post",
                url: baseURL + "receta/eliminar",
                data: "id_receta=" + id_receta + "&img="+ img1 ,
                success: function () {
                    location.href =baseURL+"receta/listadoReceta/";
                },
            });
        });

        $(".table tbody").on('click','#btmodalDetalle',function(){
            let currentrow  = $(this).closest('tr');
            let id_receta  = currentrow.find('td:eq(0)').text();
            let baseURL= "<?php echo base_url();?>";
            $.ajax({
                type: "post",
                url: baseURL + "receta/indexDetalle/"+id_receta,
               
                success: function (resultado) {
                    //location.reload();
                   // alert(resultado);
                   // $('#modalDetalle').modal({show:true});
                   location.href =baseURL+"receta/indexDetalle/"+id_receta;
                },   
            });
        });

        $(".table tbody").on('click','#btmodal',function(){
            let currentrow  = $(this).closest('tr');
            let id_receta  = currentrow.find('td:eq(0)').text();
            let id_persona    = currentrow.find('td:eq(7)').text();
            let fecha  = currentrow.find('td:eq(2)').text();
            let img1    =   currentrow.find('td:eq(8)').text();
            $.ajax({
                success: function () {
                    $('#modalEditReceta').modal({show:true});
                    $('#modalidreceta').val(id_receta);
                    $('#modalFecha').val(fecha);
                    $("#modalPaciente option[Value=" + id_persona +"]").attr('selected',true);
                    $("#imgDel").val(img1); 
                    $("#mostrarImg").attr("src","http://localhost/parcial/img/"+img1);
                },
            });
        });

        $("#quitar").on("click",function(){
            let id_receta=$("#modalidreceta").val();
            let img1    =  $("#imgDel").val();
            let baseURL= "<?php echo base_url();?>";
            $.ajax({
                type: "post",
                url: baseURL + "receta/eliminarImg",
                data: "img=" + img1 + "&id_receta=" +id_receta,
                success: function () {
                    $("#mostrarImg").attr("src","http://localhost/parcial/img/default.png");
                },
            });
        });

        $("#back").on("click",function(){
            location.reload();
        });
        
    }); 
</script>

<div <?php echo $mostrar?>>
<?php
  $this->load->view('/detalle/detalle_view');
?>
</div>