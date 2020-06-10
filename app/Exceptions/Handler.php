<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Arr;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }

    // Método criado para tratar a autenticação dos diferentes tipos de usuários
    // Obs.: Este método já possui uma implementação padrão no laravel, todavia é necessário que
    // seja sobrescrito para resolver o problema acima. 
    protected function unauthenticated($request, AuthenticationException $exception)
    {

        // Se quem está tentando acessar estiver esperando dados em json, significa 
        // que o acesso é via API e neste caso, retorna um erro 401 de não autorizado.
        if($request->expectsJson()){ 
            return response()->json(['message' => $exception->getMessage()], 401);  // 401 = Não autorizado
        }

        $guard = Arr::get($exception->guards(), 0); // obtem o nome do 'guard' que foi invocado

        //dd($guard); // mostra o nome do 'guard'

        switch($guard){
            case 'admin': 
                $rota_login = 'admin.login';  // Se o 'guard' for 'admin', redireciona para a página de 'login' de admin
                break;
            case 'web':
                $rota_login = 'login';
                break;
            default:
                $rota_login = 'login';  // Por padrão, redireciona p/ a página de login de usuário comum
                break;
        }
        
        return redirect()->guest(route($rota_login));
    
    }
}
