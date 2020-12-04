@extends('layouts.layout')

@section('cabecalho')
Editar Postagens
@endsection
@section('conteudo')
<form action="/postagens/editado/{{$busca[0]->id}}" method="put">
    @csrf
    <div class="form-group">
        <label>Título : </label>
        <input type="text" class="form-control" placeholder="Título" name="titulo"
        value="<?=$busca[0]->titulo?>"
        required>
    </div>
    <div class="form-group">
        <textarea class="form-control" name = "conteudo" rows="10" required >
            <?=$busca[0]->conteudo?>
        </textarea>
      </div>
    <div class="card text-center">
        <button type="submit" class="btn btn-default btn-success pull-right">Salvar</button>
    </div>
</form>

@endsection



