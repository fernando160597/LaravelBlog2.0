@extends('layouts.layout')

@section('cabecalho')
Criar Postagens
@endsection

@section('conteudo')
<form action="/postagens/criar" method="post">
    @csrf
    <div class="form-group col-md-8">
        <label>Título : </label>
        <input type="text" class="form-control" placeholder="Título" name="titulo" required>
    </div>
    <div class="form-group col-md-10">
        <textarea class="form-control" name = "conteudo" rows="10" required ></textarea>
      </div>
    <div class="card text-center">
        <button type="submit" class="btn btn-default btn-success pull-right" name = "salvar">Salvar</button>
    </div>
</form>

@endsection



