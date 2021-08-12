<?php

namespace Controllers;

use MVC\Router;
use Model\Blog;
use Intervention\Image\ImageManagerStatic as Image;

class BlogController
{
    public static function blogs(Router $router)
    {
        $blogs = Blog::get(4);
        $router->render('/paginas/blogs', [
            'blogs' => $blogs
        ]);
    }
    public static function blog(Router $router)
    {
        $id = validaRedirecciona('/');
        $blog = Blog::find($id);

        $router->render('/paginas/blog', [
            'id' => $id,
            'blog' => $blog
        ]);
    }
}
