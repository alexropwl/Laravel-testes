@extends('layouts.app')
@section('title', 'Adicionar Contato')
@section('content')

<h1 class="mb-3">Adicionar um novo contato</h1>
@if($message = Session::get('success'))
<div class='alert alert-success'>
    {{$message}}

</div>
@endif

@if(count($errors)>0)
<div class='alert alert-danger'>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>                        
        @endforeach


    </ul>

</div>

@endif

<form method="POST" action="{{url('contato/enviar')}}">
    @csrf
    <div class="form-group mb-3">
        <label for="nome">Nome </label>
            <input type="text"  class="form-control" id="nome" name="nome" placeholder="Digite o nome..." required>
            </div>
    
    <div class="form-group mb-3">
        <label for="mail">Email </label>
        <input type="email"  class="form-control" id="email" name="email" placeholder="Digite o email..." required>
            </div>
    
    
    <div class="form-group mb-3">
        <label for="sku">Assunto </label>
            <input type="text"  class="form-control" id="assunto" name="assunto" placeholder="Digite o assunto..." required>
            </div>
            <div class="form-group mb-3">
                <label for="msg">Mensagem</label>
                <textarea class="form-control" rows='10' id="msg" name="msg" placeholder="Digite uma mensagem..." required></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Enviar mensagem</button>
            </form>

            @endsection

