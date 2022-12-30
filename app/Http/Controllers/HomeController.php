<?php

namespace App\Http\Controllers;

use App\Models\News;
use Psr\Http\Message\ServerRequestInterface;


class HomeController extends Controller
{
    public function index()
    {
        // $news = new News();
        // $nouvelle = $news->find(1);
        // echo '<pre>';
        // var_dump($news->find(1));
        // echo '<pre>';
        die();
        return $this->view('home');
    }


    public function bonjour()
    {
        return $this->view('bonjour');
    }
}
