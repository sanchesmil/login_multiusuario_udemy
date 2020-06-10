<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/*
    Este controller trata das requisições para as páginas de Administração do sistema
*/

class AdminController extends Controller
{
    public function __construct()
    {
        // verifica se o usuário está logado como admin, caso contrário, devo redirecioná-lo para a página de 'login-admin'
        $this->middleware('auth:admin');  

        /* IMPORTANTE: 
           Caso o usuário não esteja autenticado, o Laravel lançará a exceção 'AuthenticationException' 
           e redirecionará o usuário para a página de login de USUÁRIOS COMUNS.

           Todavia, para que o usuário seja redirecionado para a página de LOGIN de ADMIN, devo capturar essa 
           exceção no arquivo 'Exceptions\Handler.php' e tratá-la criando o método 'unauthenticated'.

           Obs.: Se eu não tratar essa exceção, o Laravel vai redirecionar para a página de login de usuário comum. 
        */
    }
    public function index(){
        return view('admin');
    }
}
