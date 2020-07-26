<html>
<head></head>
<body>
    
    <pre>
        <?php echo print_r($lista) ?>
    </pre>

    <form action="<?php echo site_url('persona/insertar');?>" method="get">
        <label>Nombre:</label>
        <input type="text" name="nombre">
        <label>Apellido:</label>
        <input type="text" name="apellido">
        <label>Edad:</label>
        <input type="number" name="edad">
        <label>Direccion:</label>
        <input type="text" name="direccion">
        <label>Pass:</label>
        <input type="password" name="pass">
        <input type="submit">
    </form>
</body>
</html>