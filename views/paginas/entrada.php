<?php foreach ($blogs as $blog) : ?>
    <article class="entrada-blog">
        <div class="imagen">
            <img loading="lazy" src="/public/imagenes/<?php echo $blog->imagen; ?>" alt="Texto Entrada Blog">
        </div>

        <div class="texto-entrada">
            <a href="/blog?id=<?php echo $blog->id; ?>">

                <h4><?php echo $blog->titulo; ?></h4>
                <p>Escrito el: <span><?php echo $blog->creado; ?></span> por: <span><?php echo $blog->firma; ?></span> </p>

                <p>
                    <?php echo $blog->subtitulo; ?>
                </p>
            </a>
        </div>
    </article>
<?php endforeach; ?>