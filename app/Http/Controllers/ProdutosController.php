<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Produtos;


class ProdutosController extends Controller {

    public function index() {

        $produtos = Produtos::paginate(4);

        return view('produtos/index', array('produtos' => $produtos, 'buscar'=> null));
        
    }

    public function show($id) {

        $produto = Produtos::find($id);
        
        return view('produtos/show', array('produto'=>$produto));
    }

    
    public function create(){
        
        if(auth::check()){
            return view('produtos.create');
            
        }
        else{
            
            return redirect('login');
        }
        
        
        
    }
  
    public function store(Request $request){
        
        $this->validate($request, [
            
         'sku' => 'required| unique:produtos| min:3',
          'titulo' => 'required | min:3',
            'descricao' => 'required| min:3',
            'preco' => 'required| numeric'
            
            
        ]);
        
        
        
        $produto = new Produtos();
        $produto->sku = $request->input('sku');
        $produto->titulo = $request->input('titulo');
        $produto->descricao = $request->input('descricao');
        $produto->preco = $request->input('preco');
        
        if($produto->save()){
            
            return redirect('produtos/create')->with('success', 'Salvo com sucesso');
            
            
            
        }
        
        
        
        
    }

       public function edit($id){
           
           
           if(auth::check()){
              $produto = Produtos::find($id);       
              return view('produtos.edit',compact('produto', 'id')); 
        }
        else{
            
            return redirect('login');
        }
                                   
         
           
           
       }
       
       public function update(Request $request, $id){
           
           $produto = Produtos::find($id);
           
           $this->validate($request, [
               
             'sku' =>  'required| min:3',
              'titulo' => 'required| min:3',
               'descricao' => 'required| min:3',
               'preco' => 'required|numeric'
                              
           ]);
           
           if($request->hasFile('imgproduto')){
               
               $imagem = $request->file('imgproduto');
               $nomearquivo = md5($id).".".$imagem->getClientOriginalExtension();
               $request->file('imgproduto')->move(public_path('./img/produtos/'),$nomearquivo);
               
           }
           
           $produto->sku = $request->get('sku');
           $produto->titulo = $request->get('titulo');
           $produto->descricao = $request->get('descricao');
           $produto->preco = $request->get('preco');
           
           if($produto->save()){
               
               return redirect('produtos/'.$id.'/edit')->with('success', 'Produto atualizado com sucesso.');
           }
           
           
           
           
       }
    
       public function destroy($id){
           
          $produto = Produtos::find($id);
          if(file_exists("./img/produtos/".md5($id).".jpg")){
              unlink("./img/produtos/".md5($id).".jpg");
              
          }
          
          $produto->delete();
           
           return redirect()->back()->with('success', 'Produto deletado com sucesso');
           
           
           
           
       }       
         
          public function busca(Request $request){
              
              $produto = Produtos::where('titulo', 'LIKE', '%'.$request->input('busca').'%')
                      ->orwhere('descricao','LIKE', '%'.$request->input('busca').'%')
                      ->paginate(4);
              
              return view('produtos.index', array('produtos'=>$produto, 'buscar'=>$request->input('busca')));
              
              
              
          }
       
       
       
        }
