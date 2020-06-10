<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        // Cria uma condição de acesso às páginas de Login de admin para quem estiver tentando acessá-las:
        // Somente poderá acessar as páginas de login de admin se não estiver logado como 'Admin'
        // ou seja, o usuário deve ser um convidado 'guest' ou outro tipo de usuário logado diferente de admin

        $this->middleware('guest:admin'); //bloqueia o acesso a este controller se já estiver logado como admin

        //Obs.: Para lidar com as tentativas de acesso onde o usuário já está autenticado como 'admin' é necessário corrigir o 
        //      redirecionamento da página no método handle() do arquivo 'App\Http\Middleware\RedirectIfAuthenticate.php'.
    }

    // Redireciona para a view de login de admin
    public function index(){
        return view('auth.login-admin');  //view 'login-admin' do diretório 'auth'
    }

    // Tenta efetuar o login como admin
    public function login(Request $request){

        // Faz a validação prévia dos dados de login
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required',
        ]);

        // define as credenciais de login
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        // Tenta realizar o login usando o guard 'admin' e passando as 'credenciais' + campo 'remember'
        $logou = Auth::guard('admin')->attempt($credentials, $request->remember);
        
        if($logou){
           
            // redireciona para o endereço solicitado ou para o dashboard de admin
            return redirect()->intended(route('admin.dashboard'));

            

            /*  
            Obs.: 
              O método intended() armazena na sessão o endereço que o usuário tentou acessar.
              Então, logo após o login, o usuário é redirecionado para este lugar que ele tentou anteriormente.     
              Se não existir nenhum endereço previamente armazenado na sessão, o usuário será redirecionado 
              para o endereço indicado como parâmetro. (Neste caso, 'admin.dashboard')

              ou seja,

              O intended() verifica se o usuário tentou acessar alguma página, se sim, 
              redireciona pra ela, senão, redireciona para o parâmetro que é passado.

              Logo, o parâmetro passado para o intended() é a segunda opção de redirecionamento.
            */
        }

        //Se não logou, retorna para a view de login, devolvendo os valores dos campos, menos o 'password'
        return redirect()->back()->withInputs($request->only('email','remember'));  
    }
    
}
