<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AgendaPessoa;
use App\AgendaPessoaTipo;
use App\AgendaTelefone;
use App\AgendaEmpresa;
use App\AgendaEndereco;
use App\AgendaEmail;
use Illuminate\Support\Facades\DB;


class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/agenda/index'); 
    }


     public function busca()
    {

        $nome = Request::input('nome');
       // $pessoas = AgendaPessoa::where('nome', 'LIKE', '%'.$nome.'%')->get();
        //$telefone = AgendaPessoaTelefone::all();

        $telefones = DB::statement('create temporary table agenda
                           select p.id as id,
                           p.nome as nome, 
                           if (t.idtipo=4, numero, "") as "Celular_Corporativo",  
                           if (t.idtipo=4, ddd, "") as "DDDCelular_Corporativo",   
                           if (t.idtipo=2, numero, "") as "Comercial_Fixo",  
                           if (t.idtipo=2, ddd, "") as "DDDComercial_Fixo",  
                           if (t.idtipo=3, numero, "") as "Celular_Pessoal",  
                           if (t.idtipo=3, ddd, "") as "DDDCelular_Pessoal", 
                           e.email as email 
                           
                    from  agendaPessoas as p
                    left join agendaTelefones as t  on p.id = t.idpessoa
                    left join agendaEmails as e on e.idpessoa = p.id
                    where nome like "%'.$nome.'%";');

        $pessoas = DB::select('select id, nome, email, max(Celular_Corporativo) AS CC, 
                               max(Comercial_Fixo) as CF, 
                               max(Celular_Pessoal) as CP
                  from agenda group by id;');


        return view('/agenda/busca', [
        
            'pessoas'  => $pessoas
         ]); 
    }

  
    public function insere()
    {
         return view('/agenda/insere'); 
    }

    public function inserePessoa()
    {
         $tipoPessoas = AgendaPessoaTipo::all();
         $empresas = AgendaEmpresa::all();
         return view('/agenda/inserePessoa', [
        
            'tipoPessoas'  => $tipoPessoas,
            'empresas'    => $empresas
         ]); 
    }

    public function insereEmpresa()
    {
         return view('/agenda/insereEmpresa'); 
    }

    public function addPessoa()
    {
       
        $pessoa = AgendaPessoa::create(Request::all());
        $pessoa->save();
        
        return redirect()->intended('/agenda/')->with('status' , 'Pessoa cadastrada com sucesso');
    }



    public function pessoa($id)
    {
       
       $pessoa = AgendaPessoa::where('id', '=',$id)->get();
       $telefones = AgendaTelefone::where('idpessoa', '=',$id)->get();
       $enderecos = AgendaEndereco::where('idpessoa', '=',$id)->get();
       $emails = AgendaEmail::where('idpessoa', '=',$id)->get();

        return view('/agenda/pessoa', [
            'pessoa'     => $pessoa,
            'telefones'  => $telefones,  
            'enderecos'  => $enderecos, 
            'emails'     => $emails
         ]); 

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
