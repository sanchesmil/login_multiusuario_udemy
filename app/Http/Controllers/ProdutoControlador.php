<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class ProdutoControlador extends Controller
{

    private $produtos = ['Televisão 40"','Notebook Acer','Impressora 3D','HD Externo'];

    public function __construct()
    {
        //$this->middleware(\App\Http\Middleware\ProdutoAdmin::class);
        $this->middleware('auth');
    }

    public function index(){
        echo "<h1> Produtos </h1> <hr>";
        echo "<ol>";
            foreach($this->produtos as $prod)
                echo "<li> " . $prod. " </li>";
        echo "</ol>";
    }
}
