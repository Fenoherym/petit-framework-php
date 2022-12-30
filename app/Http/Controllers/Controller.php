<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function view($content, array $params = null)
    {
        $loader = new \Twig\Loader\FilesystemLoader('../views');
        $twig = new \Twig\Environment($loader, [
            'cache' => '/path/to/compilation_cache',
            'auto_reload' => true
        ]);
        $template = $twig->load($content . '.twig');


        // ob_start();
        $data = [];
        $response = new \Laminas\Diactoros\Response;

        if ($params !== null) {
            foreach ($params as $param => $value) {
                $data[$param] = $value;
            }
            $response->getBody()->write($template->render($data));
        } else {

            $response->getBody()->write($template->render());
        }
        // require BASE_VIEW_PATH . $content . '.php';


        return $response;
    }
}
