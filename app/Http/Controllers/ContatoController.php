<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;


class ContatoController extends Controller
{
    
public function index(){
    
    $data['titulo']  = "Alexandre 2018";
    
    
    return view('contato', $data);
    
} 
     

public function enviar(Request $request){
    
    $dadosEmail = array(
        
       'nome'=>$request->input('nome'),
        'email'=>$request->input('email'),
        'assunto'=>$request->input('assunto'),
        'msg'=>$request->input('msg')
        
    );
    
    Mail::send('email.contato', $dadosEmail, function($message){
        
        $message->from('alexandrveira@gmail.com', 'Formulário de contato');
        $message->subject('Mensagem enviada pelo formulário de contato');
        $message->to('alexandrveira@gmail.com');
        
        
                  
        
        
    });
    
     return redirect('contato')->with('success', 'Mensagem enviada com sucesso');
}
    
}
