<?php

namespace App\Http\Controllers;

use App\Models\News;
use Psr\Http\Message\ServerRequestInterface;

class NewsController extends controller
{

    public function index()
    {
        $new = new News();
        $news = $new->where("titre", "like", "%or%")
            ->where("contenu", "like", "%hi%");

        echo '<pre>';
        var_dump($news);
        echo '<pre>';
        die();
        return $this->view('news/news', [
            "news" => $news,
            "test" => "hahahahaha"
        ]);
    }

    public function show(ServerRequestInterface $request, array $args)
    {
        $news = new News();
        $nw = $news->find(intval($args['id']));
        return $this->view('news/show', [
            "news" => $nw
        ]);
    }

    public function store()
    {
        var_dump($_POST);
    }
}
