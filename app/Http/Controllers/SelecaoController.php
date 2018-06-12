<?php

namespace App\Http\Controllers;


class SelecaoController extends Controller
{
    public function index()
    {
      return view('selecoes/index');
    }

    public function entrar(){

      return view('selecoes/entrar');
    }
}
?>
