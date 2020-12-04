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
        //Requer autenticação em todas as rotas ligadas a esse controle
        $this->middleware('auth');
    }
    public function index(Request $request) {

        //Página postagens, com paginação 1 e a busca não sensitiva, maisuculo ou minusculo
        
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

        //Postagens do usuário especifico 

        $postagensUsuario = Postagem::orderBy('id')
        ->where('criador','=',Auth::user()->name)
        ->paginate(1);

        return view('postagens.indexUser',['postagens' => $postagensUsuario,
        'search'=>$request->search]);


    }
    //Redireciona para a tela de criar
    public function create(){
        
        return view ('postagens.create');
    }
    
    //Salva o novo post no banco
    public function store(Request $request){
        $postagem = new Postagem();
        $postagem->titulo = $request->titulo;
        $postagem->conteudo = $request->conteudo;
        $postagem->criador = Auth::user()->name;
        $postagem->save();
        return redirect('/postagens');
        
    }
    //Deleta pelo id 
    public function destroy (Request $request){
        
        Postagem::destroy($request->id);
        return redirect('/postagens');
    }
    
    //Procura o post pelo id no banco e redireciona para a tela de edição
    public function change (Request $request){

            $busca =  Postagem::orderBy('id')
            ->where('id','=',$request->id)
            ->get();
            return view('postagens.edit', ['busca' => $busca]);
        }
        
//Faz um update usando as informações colocadas na tela de editar
 public function update (Request $request){
    
    Postagem::where('id',$request->id)
    ->update(['titulo'=>$request->titulo,'conteudo'=>$request->conteudo]);
    
    return redirect('/postagens');
 }

}
    
    
    
    