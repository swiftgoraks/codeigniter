<div class="box">

    <div class="box-header">
        <h3 class="box-title"  >Detalle de la receta con ID:</h3>
        <h3 class="box-title" id="id_detalleShow" name="id_detalleShow"><?php echo $idDetalle?></h3>
        <div class="box-tools">
        <button type='submit'  id='btmodalAgregar' name='btmodalAgregar' class='btn btn-primary'>Agregar</button>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover" id="tbData">
        <thead>
            <tr role="row"><th class="sorting_asc"   width="0px">
            ID</th><th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 181px;">
            Medicamento</th><th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 181px;">
            Cantidad</th></tr>
        </thead>
        <tbody>
            <?php foreach ($detalle as $fila): ?>
                <tr>
                <td><?php echo $fila->id_detalle_receta;?></td>
                <td><?php echo $fila->medicamento;?></td>
                <td><?php echo $fila->cantidad;?></td>
                <td><button type='submit' id='btEdit' name='btEdit' class='btn btn-info'>Editar</button></td>
                <td><button type='submit' id='bteliminarDet' name='bteliminarDet' class='btn btn-danger'>Eliminar</button></td>
                <td style="width:0.01px; max-width:0.01px; visibility:hidden;"><?php echo $fila->id_medicamento;?></td>
            </tr role="row" class="odd">
            <?php endforeach;?>
        </tbody></table>
    </div><!-- /.box-body -->
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="AgregarDetalle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header bg-blue">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Agregar al Detalle</h4>
      </div>
      <form action="<?php echo site_url('receta/AgregarDetalle');?>" method="post">
            <div class="modal-body">
                
                    <div class="box-body">
                    <input type="hidden" id="modalidreceta" name="modalidreceta" value="<?php echo $idDetalle?>">
                        <div class="form-group ">
                            <label>Medicamento:</label>
                            <select class="form-control btn btn-primary" id="modalMedicamentoAgregar" name="modalMedicamentoAgregar">     
                            <?php foreach ($medicamento as $item): ?>
                                    <option value=<?php echo $item->id_medicamento;?>> <?php echo $item->medicamento;?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label >Cantidad:</label>
                            <input type="number" id="modalcantidadAgregar" name="modalcantidadAgregar" required />
                        </div>
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

<!-- Modal -->
<div class="modal fade" id="EditDetalle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header bg-blue">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar Detalle</h4>
      </div>
        <div class="modal-body">
            <form action="<?php echo site_url('receta/EditarDetalle');?>" method="post">
                <div class="box-body">
                <input type="hidden" id="modalidreceta" name="modalidreceta" value="<?php echo $idDetalle ?>">
                <input type="hidden" id="modaliddetalleEdit" name="modaliddetalleEdit" >
                    <div class="form-group" style="width: 240px;">
                        <label>Paciente:</label>
                        <select class="form-control btn btn-primary" id="modalMedicamentoEdit" name="modalMedicamentoEdit">     
                        <?php foreach ($medicamento as $item): ?>
                                <option value=<?php echo $item->id_medicamento;?>> <?php echo $item->medicamento;?> </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Cantidad:</label>
                        <input type="number" id="modalcantidadEdit" name="modalcantidadEdit" required />
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" id="btModalClose" data-dismiss="modal">Cancelar</button>
            <input type="submit" class="btn btn-info " value="Editar">
        </div>
            </form>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {

        $(".table tbody").on('click','#btEdit',function(){
            let currentrow  = $(this).closest('tr');
            let id_detalle    = currentrow.find('td:eq(0)').text();
            let cant    = currentrow.find('td:eq(2)').text();
            let id_medicamento    = currentrow.find('td:eq(5)').text();
            $.ajax({
                success: function () {
                    $("#modalMedicamentoEdit option[Value="+id_medicamento+"]").attr('selected',true);
                    $('#EditDetalle').modal({show:true});
                    $('#modalcantidadEdit').val(cant);
                    $('#modaliddetalleEdit').val(id_detalle);
                },
            });
        });

        $(".table tbody").on('click','#bteliminarDet',function(){
            let currentrow  = $(this).closest('tr');
            let id_detalleReceta    = currentrow.find('td:eq(0)').text();
            let id_detalleShow   =   $("#id_detalleShow ").text();
            let baseURL= "<?php echo base_url();?>";
            $.ajax({
                type: "post",
                url: baseURL + "receta/EliminarDetalle",
                data: "id_detalleShow=" + id_detalleShow + "&id_detalle_receta=" +id_detalleReceta,
                success: function () {
                    
                   location.reload();
                },
            });
        });
        
        
        $("#btmodalAgregar").click(function(){
            $('#AgregarDetalle').modal({show:true});
        });   
    }); 
</script>