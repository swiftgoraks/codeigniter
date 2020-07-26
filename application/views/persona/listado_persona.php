<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Listado Personas</h3>
                  <div class="box-tools">
                 
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                  <thead>
                      <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 181px;">
                      ID</th><th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 181px;">
                      Nombre</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 223px;">
                      Apellido</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 197px;">
                      Edad</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 155px;">
                      Direccion</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 155px;">
                      Password</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 155px;">
                      Estado</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($consulta as $fila): ?>
                            <tr>
                            <td><?php echo $fila->id_persona;?></td>
                            <td><?php echo $fila->nombre;?></td>
                            <td><?php echo $fila->apellido; ?></td>
                            <td><?php echo $fila->edad; ?></td>
                            <td><?php echo $fila->direccion ;?></td>
                            <td><?php echo $fila->pass ;?></td>
                            <td><?php echo $fila->id_estado ;?></td>
                            <td><button type='submit'  id='btmodal' name='btmodal' class='btn btn-primary'>Modificar</button></td>
                            <td><button type='submit' id='bteliminar' name='bteliminar' class='btn btn-danger'>Eliminar</button></td>
                        </tr role="row" class="odd">
                        <?php endforeach;?>
                  </tbody></table>
                </div><!-- /.box-body -->
              </div>


<script type="text/javascript">
    $(document).ready(function () {
        $(".table tbody").on('click','#bteliminar',function(){
            let currentrow  = $(this).closest('tr');
            let id_persona  = currentrow.find('td:eq(0)').text();
            let baseURL= "<?php echo base_url();?>";
            $.ajax({
                type: "post",
                url: baseURL + "persona/eliminar",
                data: "id_per=" + id_persona  ,
                success: function () {
                    location.reload();
                },
            });
        });

        $(".table tbody").on('click','#btmodal',function(){
            let currentrow  = $(this).closest('tr');
            let id_persona  = currentrow.find('td:eq(0)').text();
            let nombre  = currentrow.find('td:eq(1)').text();
            let apellido  = currentrow.find('td:eq(2)').text();
            $.ajax({
                success: function () {
                    $('#modalEditPersona').modal({show:true});
                    $('#modalidpersona').val(id_persona);
                    $('#modalnombre').val(nombre);
                    $('#modalapellido').val(apellido);
                },
                
            });
        });
    }); 
</script>

<!-- Modal -->
<div class="modal fade" id="modalEditPersona" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <div class="modal-header bg-blue">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar Persona</h4>
      </div>
        <div class="modal-body">
            <form action="<?php echo site_url('persona/actualizar');?>" method="get">
                <div class="box-body">
                    <div class="form-group">
                    <input type="hidden" id="modalidpersona" name="modalidpersona" >
                        <label>Nombre:</label>
                        <input type="text" name="modalnombre" id="modalnombre" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Apellido:</label>
                        <input type="text" name="modalapellido" id="modalapellido" class="form-control">
                    </div>
                    <!--
                    <div class="form-group">
                        <label >Otro</label>
                            <select class="form-control" id="estado" name="estado">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        
                    </div>
                    -->
                </div>
        </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="btModalClose" data-dismiss="modal">Cancelar</button>
                    <!-- <button type="button" class="btn btn-info" id="mbtActualizar">Actualizar</button>-->
                    <input type="submit" class="btn btn-info " value="Actualizar">
                </div>
            </form>
    </div>
  </div>
</div>