@extends('layouts.layout')

@section('cabecalho')
Postagens de  <?=Auth::user()->name?>
@endsection


@section('conteudo')   
<div class="container">
    @if(count($postagens) > 0)
    @foreach ($postagens as $postagem)
    <div class="card text-center">
        <h5 class="card-header">Postagem de número <?=$postagem->id?></h5>
        <div class="card-body">
            
            <h5 class="card-title"><?=$postagem->titulo?></h5>
            
            <p class="card-text"><?=$postagem->conteudo?></p>
            
            <p class="card-text">Última atualização dia : <?=$postagem->updated_at->format('d-m-Y')?></p>

            <p class="card-text"><?=$postagem->criador?></p>

            <form method="post" action="/postagens/editar/{{ $postagem->id}}">
                @csrf
                <button class="btn btn-info">EDITAR</button>
            </form>
        </div>
        
        <form method="post" action="/postagens/remover/{{ $postagem->id}}" 
            onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes( $postagem->nome )}}?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Excluir</button>
        </form>
        <br>
    </div>
    @endforeach
    @else
    <div class="alert alert-danger" role="alert">
        Não foram encontrados resultados
    </div>
    <div class="text-center">
        <a href="/postagens" class="btn btn-primary">Retornar</a>
    </div>
    @endif
</div>
{{$postagens->appends(['search' => $search])->links()}}
@endsection