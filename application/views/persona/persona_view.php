<h1> Ingresar Persona </h1>
<form action="<?php echo site_url('persona/insertar');?>" method="get">
    <div class="form-group">
        <label>Nombre:</label>
        <input type="text" name="nombre" class="form-control">
    </div>
    <div class="form-group">
        <label>Apellido:</label>
        <input type="text" name="apellido" class="form-control">
    </div>
    <div class="form-group">
        <label>Edad:</label>
        <input type="number" name="edad" class="form-control">
    </div>
    <div class="form-group">
        <label>Direccion:</label>
        <input type="text" name="direccion" class="form-control">
    </div>
    <div class="form-group">
        <label>Pass:</label>
        <input type="password" name="pass" class="form-control">
    </div>
    <input type="submit" class="btn btn-primary ">
</form>
