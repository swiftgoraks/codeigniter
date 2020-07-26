<div>
<h1> Ingresar Persona </h1>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

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
        <input id="datepicker" name="datepicker" width="276" readonly/>
            <script>
                $('#datepicker').datepicker({
                    format: 'yyyy/mm/dd'
                });
            </script>
    </div>
    <div class="form-group">
        <label>Imagen:</label>
        <input class="input-group" type="file" id="image" name="image" accept="image/*" />
    </div>
    <input type="submit" class="btn btn-primary ">
</div>
</form>
</div>