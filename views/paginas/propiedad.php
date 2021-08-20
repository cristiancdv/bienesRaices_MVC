<main class="contenedor seccion contenido-centrado">
    <h2 data-cy="titulo-propiedad"><?php echo $propiedad->titulo; ?></h2>


    <img loading="lazy" src="/public/imagenes/<?php echo $propiedad->imagen; ?>" alt="imagen de la propiedad">

    <div class="resumen-propiedad">
        <p class="precio">$<?php echo $propiedad->precio; ?></p>

        <p class="descripcion"><?php echo $propiedad->descripcion ?></p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="/public/build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $propiedad->wc; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="/public/build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                <p><?php echo $propiedad->estacionamiento; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="/public/build/img/icono_dormitorio.svg" alt="icono habitaciones">
                <p><?php echo $propiedad->habitaciones; ?></p>
            </li>
        </ul>

    </div>
</main>