
@auth
    <h4>Você está logado!</h4>
    <p>Nome: {{Auth::user()->name}}</p>   
    <p>E-mial: {{Auth::user()->email}}</p>   
    <p>Id: {{Auth::user()->id}}</p>   
@endauth

@guest
    <h4>Você não está logado!</h4>
@endguest