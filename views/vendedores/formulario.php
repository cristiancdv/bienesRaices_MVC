<fieldset>
    <legend>Información Personal</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre" value="<?php echo s($vendedor->nombre); ?>">

    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellido" value="<?php echo s($vendedor->apellido); ?>">

    <label for="imagen2">Foto:</label>
    <input type="file" id="imagen2" accept="image/jpeg, image/png" name="vendedor[imagen]">

    <?php if ($vendedor->imagen) { ?>
        <img src="/imagenes/<?php echo $vendedor->imagen; ?>" class="imagen-small">
    <?php } ?>


    <label for="telefono">Telefono:(10 Digitos sin guiones)</label>
    <input type="number" id="telefono" name="vendedor[telefono]" placeholder="Telefono" value="<?php echo s($vendedor->telefono); ?>">

</fieldset>