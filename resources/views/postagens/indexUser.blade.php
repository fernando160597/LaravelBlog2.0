@extends('layouts.layout')

@section('cabecalho')
Postagens de  <?=Auth::user()->name?>
@endsection



@section('conteudo')   
<div class="container">
    @if(count($postagens) > 0)
    @foreach ($postagens as $postagem)
    <div class="card text-center">
        <h5 class="card-header"><?=$postagem->titulo?></h5>
        <div class="card-body">
            
            <p class="card-text"><?=$postagem->conteudo?></p>
            
            {{-- Verifica se o criador é o usuario logado e assim permite ele editar  apenas as suas postagens --}}
            @if($postagem->criador == Auth::user()->name)
            
            <div class="row justify-content-md-center">
                <div class="col col-lg-1">
                    <form method="post" action="/postagens/editar/{{ $postagem->id}}">
                        @csrf
                        <button class="btn btn-info">Editar</button>
                    </form>
                </div>
                <div class="col col-lg-1">
                    {{-- Verifica se o criador é o usuario logado e assim permite ele  excluir apenas as suas postagens --}}
                    <form method="post" action="/postagens/remover/{{ $postagem->id}}" 
                        onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes( $postagem->nome )}}?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Excluir</button>
                    </form>
                </div>
            </div>
            
        </div>
            <?php 
            $earlier = new DateTime($postagem->updated_at);
            $later = new DateTime();
            
            $diff = $later->diff($earlier)->format("%a");   ?>

            @if($diff >0)

            <div class="card-footer text-muted">
                <?= "Essa postagem foi alterada a " .$diff." dia(s) atrás por ".$postagem->criador?>
            </div>

            @else 

            <div class="card-footer text-muted">
                <?= "Essa postagem foi alterada hoje por ".$postagem->criador?>
            </div>

            @endif
       
        @endif
        <br>
    </div>
    @endforeach
    @else
    <div class="alert alert-danger" role="alert">
        Não foram encontrados resultados
    </div>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col col-lg-1">
                <a href="/postagens" class="btn btn-primary">Retornar</a>
            </div>
            <div class="col col-lg-2">
                <a href="/postagens/criar" class="btn btn-success">Criar</a>
            </div>
        </div>
        @endif
    </div>
    <br>
    {{$postagens->appends(['search' => $search])->links()}}
    @endsection