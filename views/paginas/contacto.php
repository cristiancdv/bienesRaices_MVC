<main class="contenedor seccion">
    <h2 data-cy="heading-contacto">Contacto</h2>
    <?php
    if ($mensajeExito) { ?>

        <p data-cy="alerta-contacto-exito" class='alerta exito'><?php echo $mensajeExito ?></p>
    <?php } ?>

    <?php
    if ($mensajeError) { ?>

        <p data-cy="alerta-contacto-error" class='alerta error'><?php echo $mensajeError ?></p>
    <?php } ?>


    <picture>
        <source srcset="/public/build/img/destacada3.webp" type="image/webp">
        <source srcset="/public/build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="/public/build/img/destacada3.jpg" alt="Imagen Contacto">
    </picture>

    <h2 data-cy="heading-formulario">Llene el Formulario de Contacto</h2>

    <form data-cy="formulario-contacto" class="formulario" action="/public/contacto" method="POST">
        <fieldset>
            <legend>Información Personal</legend>

            <label for="nombre">Nombre</label>
            <input data-cy="input-nombre" type="text" placeholder="Tu Nombre" name="contacto[nombre]" id="nombre" required>

            <label for="mensaje">Mensaje:</label>
            <textarea data-cy="input-mensaje" name="contacto[mensaje]" id="mensaje" required></textarea>
        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>

            <label for="opciones">Vende o Compra:</label>
            <select data-cy="input-opciones" name="contacto[tipo]" id="opciones" required>
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>

            <label for="presupuesto">Precio o Presupuesto</label>
            <input data-cy="input-precio" type="number" placeholder="Tu Precio o Presupuesto" name="contacto[precio]" id="presupuesto" required>

        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>

            <p>Como desea ser contactado</p>

            <div class="forma-contacto">
                <label for="contactar-telefono" required>Teléfono</label>
                <input data-cy="forma-contacto" type="radio" value="telefono" name="contacto[contacto]" id="contactar-telefono">

                <label for="contactar-email" required>E-mail</label>
                <input data-cy="forma-contacto" type="radio" value="email" name="contacto[contacto]" id="contactar-email">
            </div>

            <div id="contacto"></div>


        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>