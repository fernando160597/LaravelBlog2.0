<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use App\Postagem;

class PostagensController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request) {
        
        $buscaLower = strtolower($request->search);

        $postagens = Postagem::orderBy('id')
        ->where('titulo','LIKE','%'.$request->search.'%')
        ->orWhere('conteudo','LIKE','%'.$request->search.'%')
        ->orWhere('conteudo','LIKE','%'.$buscaLower.'%')
        ->orWhere('titulo','LIKE','%'.$buscaLower.'%')
        ->paginate(1);
        
        //$postagens = DB::table('postagens')->paginate(5);
        
        
        return view('postagens.index', ['postagens' => $postagens,
        'search' =>$request->search ]);
        
    }

    public function postagensUsuario(Request $request){

        $postagensUsuario = Postagem::orderBy('id')
        ->where('criador','=',Auth::user()->name)
        ->paginate(1);

        return view('postagens.indexUser',['postagens' => $postagensUsuario,
        'search'=>$request->search]);


    }
    
    public function create(){
        
        return view ('postagens.create');
    }
    
    public function store(Request $request){
        $postagem = new Postagem();
        $postagem->titulo = $request->titulo;
        $postagem->conteudo = $request->conteudo;
        $postagem->criador = Auth::user()->name;
        $postagem->save();
        return redirect('/postagens');
        
    }
    public function destroy (Request $request){
        
        Postagem::destroy($request->id);
        return redirect('/postagens');
    }
    
    public function change (Request $request){

            $busca =  Postagem::orderBy('id')
            ->where('id','=',$request->id)
            ->get();
            return view('postagens.edit', ['busca' => $busca]);
        }
        



 public function update (Request $request){
    
    Postagem::where('id',$request->id)
    ->update(['titulo'=>$request->titulo,'conteudo'=>$request->conteudo]);
    
    return redirect('/postagens');
 }

}
    
    
    
    