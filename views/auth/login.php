<main class="contenedor seccion contenido-centrado">
    <h2 data-cy="heading-auth">Iniciar Sesión</h2>

    <?php foreach ($errores as $error) : ?>
        <div data-cy="alerta-auth-error" class="alerta error"><?php echo $error; ?></div>
    <?php endforeach; ?>

    <form method="POST" data-cy="formulario-auth" class="formulario" action="/public/login">
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">E-mail</label>
            <input data-cy="input-usuario" type="email" name="email" placeholder="Tu Email" id="email">

            <label for="password">Password</label>
            <input data-cy="input-password" type="password" name="password" placeholder="Tu Password" id="password">
        </fieldset>

        <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
    </form>
</main>