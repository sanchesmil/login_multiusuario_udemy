<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartamentoControlador extends Controller
{
    private $departamentos = ['Gerência"','Recursos Humanos','Finanças','Produção'];

    public function index(){
        echo "<h1> Departamentos </h1> <hr>";
        echo "<ol>";
            foreach($this->departamentos as $depto)
                echo "<li> " . $depto. " </li>";
        echo "</ol>";

        if(Auth::check()){
            $user = Auth::user();
            echo '<h4>' . $user->name . ', você está logado!</h4>';
        }else{
            echo '<br> Usuário não está logado!';
        }
    }
}
