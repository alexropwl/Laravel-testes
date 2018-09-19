<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContatoController extends Controller
{
    
public function index(){
    
    $data['titulo']  = "Alexandre 2018";
    
    
    return view('contato', $data);
    
} 
     
    
}
