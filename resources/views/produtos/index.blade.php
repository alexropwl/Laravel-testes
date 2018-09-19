@extends('layouts.app')
@section('title', 'Lista de produtos')
@section('content')
        <h1>Produtos</h1>
        @if($message = Session::get('success'))
<div class='alert alert-success'>
    {{$message}}

</div>
        @endif
        
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{url('produtos/busca')}}">
                    @csrf
                  <div class='input-group mb-3'>
                      <input type="text" class="form-control" id="busca" name="busca" placeholder="Procurar no site" value='{{$buscar}}'>
                  <div class="input-group-append">
                        <button class="btn btn-outline-secondary">Buscar</button>
                    </div>
                  </div>
                    
                    
                </form>
                
                
            </div>
            
            <div class="col-md-12">
                <form method="POST" action="{{url('produtos/ordem')}}">
                    @csrf
                  <div class='input-group mb-3'>
                      <select id='ordem' name='ordem' class='form-control'>
                          <option>Escolha a ordem</option>
                          <option value='1'>Titulo (A-Z)</option>
                          <option value='2'>Titulo (Z-A)</option>
                          <option value='3'>Titulo (Maior-Menor)</option>
                          <option value='4'>Titulo (Menor-Maior)</option>
                      </select>
                            <div class="input-group-append">
                        <button class="btn btn-outline-secondary">Ordenar</button>
                    </div>
                    
                  </div>
                    
                </form>
                
                
            </div>
        </div>
        
        <div class="row">
            @foreach($produtos as $produto)
            <div class="col-md-3">
                <h4 class="text-center"><a href="{{URL::to('produtos')}}/ {{$produto->id}}}"> {{$produto->titulo}}</a>
                      
                    </h4>
                <p class='text-center'>R$ {{number_format($produto->preco,2,',','.')}}</p>
                @if(file_exists("./img/produtos/".md5($produto->id).".jpg"))                  
		<img src="{{url('img/produtos/'.md5($produto->id)).'.jpg'}}" alt="Imagem Produto" class="img-fluid img-thumbnail">
	            @endif
                    
                    @if(Auth::check())
                    <div class="md-3">
                        <form method="POST"  action="{{action('ProdutosController@destroy', $produto->id)}}">
                       @csrf
                         <input type='hidden' name='_method' value='DELETE'>
                            <a href="http://localhost:8000/produtos/{{$produto->id.'/edit'}}" class="btn btn-primary">Editar</a>                                     
                                       
                     <button class="btn btn-danger">Deletar</button>               
                        
                        </form>         
                         </div>
                         @endif
                     
            </div>
            @endforeach
        </div>
        
        <div>
            <p><strong>O valor médio é: </strong><p>R${{number_format($media,2,',','.')}}</p></p> 
            <p><strong>O mais barato é: </strong><p>R${{number_format($maisbarato,2,',','.')}}</p></p> 
            <p><strong>O mais caro é: </strong><p>R${{number_format($maiscaro,2,',','.')}}</p></p>
            <p><strong>O total é: </strong><p>R${{number_format($soma,2,',','.')}}</p></p>
        </div>
        {{$produtos->links()}}
        
        @endsection
 