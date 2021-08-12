<main class="contenedor seccion">
    <h2 data-cy="heading-nosotros">Más Sobre Nosotros</h2>

    <div class="iconos-nosotros" data-cy="iconos-nosotros">

        <?php include __DIR__ .  '/iconos.php'; ?>
    </div>
</main>

<section class="seccion contenedor">
    <h2>Casas y Depas en Venta</h2>

    <?php
    include __DIR__ . '/listado.php';
    ?>

    <div class="alinear-derecha">
        <a href="/propiedades" data-cy="todas-propiedades" class="boton-verde">Ver Todas</a>
    </div>
</section>

<section data-cy="imagen-contacto" class="imagen-contacto">
    <h2>Encuentra la casa de tus sueños</h2>
    <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo a la brevedad</p>
    <a href="/contacto" class="boton-amarillo">Contactános</a>
</section>

<div class="contenedor seccion seccion-inferior">
    <section data-cy="blog" class="blog">
        <h3>Nuestro Blog</h3>

        <?php include __DIR__ . '/entrada.php' ?>

    </section>

    <section data-cy="testimoniales" class="testimoniales">
        <h3>Testimoniales</h3>

        <div class="testimonial">
            <blockquote>
                El personal se comportó de una excelente forma, muy buena atención y la casa que me ofrecieron cumple con todas mis expectativas.
            </blockquote>
            <p>- Cristian Vazquez</p>
        </div>
    </section>
</div>