<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Sentinel;
use Illuminate\Support\Facades\DB;
use App\Funcionario;
use App\Funcao;
use App\Avaliacao;
use App\Participante;
use App\Competencia;
use App\Nota;
use App\Equipe;
use App\Delegacao;
use App\Historicoequipe;
use App\Pessoa;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;

class AvaliacaoAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = Sentinel::getUser()->codequipe;
        $erro = 0;$teste = 0;  $todos = 0; $abertas=0; $fechadas=0; $ver= 0;
        $chefe = Sentinel::getUser()->chapa;
		$lider = Funcionario::where('CHAPA', '=', $chefe)->get();
       
        if (!Sentinel::getUser()->chapa or !Sentinel::getUser()->codequipe)
        {  
			$erro = "A chapa ou código da equipe do lider não está preenchida no cadastro da Intranet. 
			O dado é necessário para prosseguir. Entre em contato com o responsável pelas avaliações no setor de Recursos Humanos.";	
		}
		if (Sentinel::getUser()->chapa and Sentinel::getUser()->codequipe) {
		
			
			$todos =  DB::select('select E.NOME AS NOME,
								  E.CHAPA AS CHAPA, 
								  E.DATAADMISSAO AS DATAADMISSAO,
								  C.NOME AS CARGO
								  from funcionarios as E
								  inner join funcoes AS C on C.CODIGO = E.CODFUNCAO
								  where CODEQUIPE = '.$usuario.' and DATADEMISSAO is null order by E.NOME');
		 
			$abertas = DB::select('select * 
								  from avaliacoes as A
								  inner join veravaliacoes AS V on A.CODAVALIACAO = V.codigoavaliacao
								  where statuslider = 0 and DATAFECHAMENTO is null');
			
			//$abertas = DB::table('avaliacoes')->whereNull('DATAFECHAMENTO')->get(); 
			
			//$fechadas = DB::table('avaliacoes')->having('DATAFECHAMENTO', '>', 0)->get();
			
			$fechadas = DB::select('select * 
								  from avaliacoes as A
								  inner join veravaliacoes AS V on A.CODAVALIACAO = V.codigoavaliacao
								  where statuslider = 0 and DATAFECHAMENTO > 0 order by DATAABERTURA ASC');
			
			$ver = DB::table('veravaliacoes');
	    
	    } 
	   
	    return view('/avaliacao/index', [
	    
	        'erro'  => $erro,
            'lider' => $lider,
            'todos' => $todos,
			'abertas' => $abertas,
			'fechadas' => $fechadas, 
			'ver' => $ver
         ]);
         
        
    }

	
	
    
    public function valida()
    {
        return view('avaliacao.valida');
    }



	  public function update(Request $request, $id)
		{
			//
		}


	public function avaliacoes(){
			
			$chapa_filter = Request::exists('chapa') ? Request::input('chapa') : '';
			$nome_filter = Request::exists('nome') ? Request::input('nome') : '';
			$equipe_filter = Request::exists('codequipe') ? Request::input('codequipe') : '';
			
			/*$people = DB::table('funcionarios')->join('participantes', 'participantes.CHAPAAVALIADO', '=', 'funcionarios.CHAPA')->join('equipes', 'CODINTERNO', '=', 'CODEQUIPE')->whereNotNull('CHAPAAVALIADO')->groupBy('CHAPA')->orderBy('NOME')->get();*/

			$people = Funcionario::has('participante')->groupBy('CHAPA')->orderBy('NOME');

			if ($nome_filter) {
            $people = $people->where('NOME','like', '%' . "$nome_filter" . '%');
        	}

        	if ($chapa_filter) {
            $people = $people->where('CHAPA','=', "$chapa_filter");
        	}

        	if ($equipe_filter) {
            $people = $people->where('CODEQUIPE','=', "$equipe_filter");
        	}

        	$people = $people->paginate(20);

        	$equipes = Equipe::orderBy('DESCRICAO')->get();


			
			return view('admin.avaliacao.painel', [
		
			'people' => $people,
			'equipes' => $equipes
			
			]);
		
		
	}

	public function pessoa($id){

		$usuario = Sentinel::getUser()->codequipe;
		$chefe = Sentinel::getUser()->chapa;
		$lider = Funcionario::where('CHAPA', '=', $chefe)->get();
				
		$grupo = '';
		
		
		if ($chefe == $id) 
			$perm = "Você não pode ver suas próprias notas! =(";
		if ($chefe <> $id)  
		    $perm = '0';
		
		$compfuncao = DB::select('select * from vercargos AS V
								  inner join funcionarios AS F on V.codcargo = F.CODFUNCAO
								  where F.CHAPA = '.$id);

		$funcionario =  DB::select('select E.NOME AS NOME,
							  E.CHAPA AS CHAPA, 
							  E.DATAADMISSAO AS DATAADMISSAO,
							  C.NOME AS CARGO, 
							  I.IMAGEM AS IMAGEM, 
							  Q.DESCRICAO AS LIDER
							  from funcionarios as E
		                      inner join funcoes AS C on C.CODIGO = E.CODFUNCAO
							  left join pessoas AS P on P.CODIGO = E.CODPESSOA
							  left join fotos AS I on P.IDIMAGEM = I.IDIMAGEM
							  inner join equipes as Q ON Q.CODCLIENTE = E.CODEQUIPE
							  where E.CHAPA = '.$id);							  

		$licenciados = DB::select('select * from licenciados where CHAPAVALIADO = '.$id);
		$licencas = DB::select('select * from licencas where CHAPA = '.$id);

	    $notas =   DB::statement('create temporary table notas_temp
		            select 
				    N.CODITEMAVAL   AS ITEM,
					S.NOME           AS NOMECOMPETENCIA,  
					NOTAAVALIADOR    AS NOTA,  
					P.CHAPAAVALIADO  AS CHAPA,  
					N.CODAVALIACAO   AS AVALIACAO, 
					V.NOME           AS DESCRICAO, 
					V.DATAABERTURA   AS DATA, P.CODPARTICIPANTE, P.CODAVALIACAO, 
					N.COMENTARIO     AS OBS, 
					date_format(N.created_at, "%d/%m/%Y")  AS FEITAEM, 
					N.CODPARTICIPANTE  AS PARTICIPANTE, 
					P.CHAPAAVALIADOR  AS AVALIADOR
					from notas AS N
					inner join participantes AS P on N.CODAVALIACAO = P.CODAVALIACAO and N.CODPARTICIPANTE = P.CODPARTICIPANTE
					inner JOIN competencias AS S ON N.CODITEMAVAL = S.CODCOMPETENCIA
					inner JOIN avaliacoes AS  V ON V.CODAVALIACAO = N.CODAVALIACAO
					inner JOIN veravaliacoes AS VAV on V.CODAVALIACAO = VAV.codigoavaliacao
					where statuslider = 0 and P.CHAPAAVALIADO = '.$id);	
							  
		
		$resultado = DB::select('
						select
						AVALIACAO, 
						CHAPA,
						CODPARTICIPANTE,
						DESCRICAO,
						FEITAEM,
						PARTICIPANTE,
						AVALIADOR,
						MAX(IF(ITEM = "01", NOTA, 0)) AS NOTA1, 
						MAX(IF(ITEM = "01", OBS, " - "))  AS OBS1, 
						MAX(IF(ITEM = "02", NOTA, 0)) AS NOTA2,
						MAX(IF(ITEM = "03", NOTA, 0)) AS NOTA3,  
						MAX(IF(ITEM = "04", NOTA, 0)) AS NOTA4,
						MAX(IF(ITEM = "05", NOTA, 0)) AS NOTA5,  
						MAX(IF(ITEM = "06", NOTA, 0)) AS NOTA6, 
						MAX(IF(ITEM = "07", NOTA, 0)) AS NOTA7,  
						MAX(IF(ITEM = "08", NOTA, 0)) AS NOTA8,
						MAX(IF(ITEM = "09", NOTA, 0)) AS NOTA9,  
						MAX(IF(ITEM = "10", NOTA, 0)) AS NOTA10,
						MAX(IF(ITEM = "11", NOTA, 0)) AS NOTA11,  
						MAX(IF(ITEM = "12", NOTA, 0)) AS NOTA12,
						MAX(IF(ITEM = "13", NOTA, 0)) AS NOTA13,
						MAX(IF(ITEM = "14", NOTA, 0)) AS NOTA14,  
						MAX(IF(ITEM = "15", NOTA, 0)) AS NOTA15, 
						MAX(IF(ITEM = "02", OBS, " - ")) AS OBS2,
						MAX(IF(ITEM = "03", OBS, " - ")) AS OBS3,  
						MAX(IF(ITEM = "04", OBS, " - ")) AS OBS4,
						MAX(IF(ITEM = "05", OBS, " - ")) AS OBS5,  
						MAX(IF(ITEM = "06", OBS, " - ")) AS OBS6, 
						MAX(IF(ITEM = "07", OBS, " - ")) AS OBS7,  
						MAX(IF(ITEM = "08", OBS, " - ")) AS OBS8,
						MAX(IF(ITEM = "09", OBS, " - ")) AS OBS9,  
						MAX(IF(ITEM = "10", OBS, " - ")) AS OBS10,
						MAX(IF(ITEM = "11", OBS, " - ")) AS OBS11,  
						MAX(IF(ITEM = "12", OBS, " - ")) AS OBS12,
						MAX(IF(ITEM = "13", OBS, " - ")) AS OBS13,
						MAX(IF(ITEM = "14", OBS, " - ")) AS OBS14,  
						MAX(IF(ITEM = "15", OBS, " - ")) AS OBS15, 
						0 AS MEDIA 
						  
						from notas_temp
						GROUP BY AVALIACAO, CHAPA
						ORDER BY AVALIACAO*1');					  
	
		$aa = 0;
	
		$t = 1;
		$qt = 0;
		$total = 0;
		
		
		foreach ($resultado as $r) {
				While($t < 16)
				{
					$q = 'c'.$t;
					$nn = 'NOTA'.$t;
					if (($compfuncao[0]->$q) == 0) 
					{ 
						$total = $total + $r->$nn;
						$qt++;
						 } $t++; 
					} 
				$r->MEDIA = $total/$qt;	
				$total = 0;
				$t = 1; $qt = 0;
				
		}
	    return view('admin.avaliacao.pessoa', [
            'notas' => $notas,
			'funcionario' => $funcionario,
			'resultado' => $resultado,
			'compfuncao' => $compfuncao,
			'perm' => $perm,
			'qt' => $qt,
			'aa' => $aa,
			'm' => 0,
			'licencas' => $licencas,
			'licenciados' => $licenciados
         ]);

	}


	public function progressoAvaliacao(){
				 DB::statement('create temporary table media_temp
			 				select a.CODAVALIACAO as avaliacao, 
							count(CODPARTICIPANTE) as participantes 
							from participantes as p
							inner join avaliacoes as a
							on a.CODCOLIGADA = p.CODCOLIGADA
							and a.CODAVALIACAO = p.CODAVALIACAO
							group by p.CODAVALIACAO');
							
				$porcento = DB::select('select n.CODAVALIACAO, 
				a.NOME,
				count(n.CODPARTICIPANTE)/15 as feitos, participantes, 
				round((count(n.CODPARTICIPANTE)/15)*100/participantes,2) as total
				from participantes as p
				left join notas as n
				on n.CODCOLIGADA = p.CODCOLIGADA 
				and n.CODAVALIACAO = p.CODAVALIACAO
				and n.CODPARTICIPANTE = p.CODPARTICIPANTE
				inner join media_temp on p.CODAVALIACAO = media_temp.avaliacao
				inner join avaliacoes as a on a.CODCOLIGADA = p.CODCOLIGADA and a.CODAVALIACAO = p.CODAVALIACAO
				inner join veravaliacoes as v on p.CODAVALIACAO = v.codigoavaliacao
				where statusadmin = 0
				group by p.CODAVALIACAO;
				');
				
				return view('admin.avaliacao.progresso', [
				
				'porcento' => $porcento,
				
				]);
		}

		public function painelDelegar() {
			
			$equipes = DB::table('equipes')->distinct()->orderBy('DESCRICAO')->paginate(20);
			
			return view('admin.avaliacao.delegacao', [
					
					'equipes' => $equipes,
					'id' => '1'
					]); 
		}
		
		public function verTime(){
			
			$codequipe = Request::input('e'); 
			//$time = DB::table('funcionarios')->where('CODEQUIPE', '=', $codequipe)->whereNull('DATADEMISSAO')->orderBy('NOME')->get();
			
			$time = DB::select('select NOME, CHAPA, CODFILIAL, CODPESSOA, CODEQUIPE, DATADEMISSAO  From funcionarios AS F
							   where CODEQUIPE = "'.$codequipe.'"
							   and (DATADEMISSAO is null or DATADEMISSAO >= "01/12/2015")
							   order by NOME;');


			return view('admin.avaliacao.func', [
				'id' => '1',
				'time' => $time
				
				]); 
			}
		
    
    public function visao()
    {
		$usuario = Sentinel::getUser()->codequipe;
		//$participante = Request::input('pt');
		$id = Request::input('id');
		//$notas = Nota::where('CODPARTICIPANTE', '=', $participante)->get();
		$notas = DB::select('select C.CODCOMPETENCIA AS "ITEM", 
							S.NOME          AS "NOME",  
							NOTAAVALIADOR   AS "NOTA"  from notas AS N
							LEFT JOIN competenciasassociadas AS C 
							on C.CODAVALIACAO = N.CODAVALIACAO AND N.CODITEMAVAL= C.CODIGO
							INNER JOIN competencias AS S ON C.CODCOMPETENCIA = S.CODCOMPETENCIA
							where N.CODAVALIACAO = '.$id.' and N.CODPARTICIPANTE = '.$participante);
		
				
		$avaliado = Participante::where('CODPARTICIPANTE', '=', $participante)->get();
		$avaliacao = Avaliacao::where('CODAVALIACAO', '=', $id)->get();
			
		
           return view('/avaliacao/visao', [
            'id' => $id,
            'participante' => $participante,
            'notas' => $notas,
            'avaliado' => $avaliado
         ]);
    }
    
    
    public function avaliado(){
		
		$c = Request::input('c');
		$avaliado = DB::select("
					select F.CHAPA                              AS CHAPA, 
						   F.NOME                               AS NOME,  
						   MAX(P.CODPARTICIPANTE)               AS CODPARTICIPANTE,
						   P.CODAVALIACAO                       AS CODAVALIACAO,
						   A.NOME                               AS NOMEAVALIACAO,
						   P.CHAPAAVALIADOR                     AS CHAPAAVALIADOR, 
						   L.NOME                               AS NOMELIDER, 
						   IF(SUM(N.NOTAAVALIADOR)>0,'S','N')   AS TEMAVALIACAO, 
						   LICENCA                              AS LICENCA
					 from funcionarios AS F
					inner join participantes AS P
						ON F.CHAPA = P.CHAPAAVALIADO
					left join funcionarios AS L 
						ON L.CHAPA = P.CHAPAAVALIADOR
					left join avaliacoes AS A
						ON A.CODAVALIACAO = P.CODAVALIACAO
						   AND A.CODCOLIGADA = P.CODCOLIGADA
					left join notas as N 
						ON N.CODPARTICIPANTE = P.CODPARTICIPANTE AND
						   N.CODAVALIACAO = P.CODAVALIACAO
					left join pessoas AS PE on PE.CODIGO = F.CODPESSOA
					left join licenciados as LF ON LF.CHAPAVALIADO = F.CHAPA AND LF.CODAVALIACAO = P.CODAVALIACAO
					where F.CHAPA = ".$c." and A.DATAABERTURA > 20151231 and A.CODAVALIACAO > 24
					GROUP BY P.CODAVALIACAO
					ORDER BY A.CODAVALIACAO DESC;");
					
				
				$id = Request::input('id');
				
				$grupo = '';
													  
				$funcionario =  DB::select('select E.NOME AS NOME,
									  E.CHAPA AS CHAPA, 
									  E.DATAADMISSAO AS DATAADMISSAO,
									  E.DATADEMISSAO AS DATADEMISSAO,
									  C.NOME AS CARGO, 
									  I.IMAGEM AS IMAGEM,  
									  E.CODFILIAL AS LOJA,
									  E.CODEQUIPE AS CODEQUIPE, 
									  G.DESCRICAO AS LIDER
									  from funcionarios as E
									  inner join funcoes AS C on C.CODIGO = E.CODFUNCAO
									  left join pessoas AS P on P.CODIGO = E.CODPESSOA
									  left join fotos AS I on P.IDIMAGEM = I.IDIMAGEM
									  inner join equipes as G ON E.CODEQUIPE = G.CODINTERNO
									  where E.CHAPA = '.$c);							  

				$notas =   DB::statement('create temporary table notas_temp
							select 
							N.CODITEMAVAL   AS ITEM,
							S.NOME           AS NOMECOMPETENCIA,  
							NOTAAVALIADOR    AS NOTA,  
							P.CHAPAAVALIADO  AS CHAPA,  
							N.CODAVALIACAO   AS AVALIACAO, 
							V.NOME           AS DESCRICAO, 
							V.DATAABERTURA   AS DATA, P.CODPARTICIPANTE, P.CODAVALIACAO, 
							N.COMENTARIO     AS OBS, 
							date_format(N.created_at, "%d/%m/%Y")  AS FEITAEM, 
							N.CODPARTICIPANTE  AS PARTICIPANTE, 
							P.CHAPAAVALIADOR  AS AVALIADOR
							from notas AS N
							inner join participantes AS P on N.CODAVALIACAO = P.CODAVALIACAO and N.CODPARTICIPANTE = P.CODPARTICIPANTE
							inner JOIN competencias AS S ON N.CODITEMAVAL = S.CODCOMPETENCIA
							inner JOIN avaliacoes AS  V ON V.CODAVALIACAO = N.CODAVALIACAO
							inner JOIN veravaliacoes AS VAV on V.CODAVALIACAO = VAV.codigoavaliacao
							where statuslider = 0 and P.CHAPAAVALIADO = '.$c);	
								  
			
				$resultado = DB::select('
								select
								AVALIACAO, 
								CHAPA,
								CODPARTICIPANTE,
								DESCRICAO,
								FEITAEM,
								PARTICIPANTE,
								AVALIADOR,
								MAX(IF(ITEM = "01", NOTA, 0)) AS NOTA1, 
								MAX(IF(ITEM = "01", OBS, " - "))  AS OBS1, 
								MAX(IF(ITEM = "02", NOTA, 0)) AS NOTA2,
								MAX(IF(ITEM = "03", NOTA, 0)) AS NOTA3,  
								MAX(IF(ITEM = "04", NOTA, 0)) AS NOTA4,
								MAX(IF(ITEM = "05", NOTA, 0)) AS NOTA5,  
								MAX(IF(ITEM = "06", NOTA, 0)) AS NOTA6, 
								MAX(IF(ITEM = "07", NOTA, 0)) AS NOTA7,  
								MAX(IF(ITEM = "08", NOTA, 0)) AS NOTA8,
								MAX(IF(ITEM = "09", NOTA, 0)) AS NOTA9,  
								MAX(IF(ITEM = "10", NOTA, 0)) AS NOTA10,
								MAX(IF(ITEM = "11", NOTA, 0)) AS NOTA11,  
								MAX(IF(ITEM = "12", NOTA, 0)) AS NOTA12,
								MAX(IF(ITEM = "13", NOTA, 0)) AS NOTA13,
								MAX(IF(ITEM = "14", NOTA, 0)) AS NOTA14,  
								MAX(IF(ITEM = "15", NOTA, 0)) AS NOTA15, 
								MAX(IF(ITEM = "02", OBS, " - ")) AS OBS2,
								MAX(IF(ITEM = "03", OBS, " - ")) AS OBS3,  
								MAX(IF(ITEM = "04", OBS, " - ")) AS OBS4,
								MAX(IF(ITEM = "05", OBS, " - ")) AS OBS5,  
								MAX(IF(ITEM = "06", OBS, " - ")) AS OBS6, 
								MAX(IF(ITEM = "07", OBS, " - ")) AS OBS7,  
								MAX(IF(ITEM = "08", OBS, " - ")) AS OBS8,
								MAX(IF(ITEM = "09", OBS, " - ")) AS OBS9,  
								MAX(IF(ITEM = "10", OBS, " - ")) AS OBS10,
								MAX(IF(ITEM = "11", OBS, " - ")) AS OBS11,  
								MAX(IF(ITEM = "12", OBS, " - ")) AS OBS12,
								MAX(IF(ITEM = "13", OBS, " - ")) AS OBS13,
								MAX(IF(ITEM = "14", OBS, " - ")) AS OBS14,  
								MAX(IF(ITEM = "15", OBS, " - ")) AS OBS15, 
								0 AS MEDIA 
								  
								from notas_temp
								GROUP BY AVALIACAO, CHAPA
								ORDER BY AVALIACAO*1');					  
									
			
			return view('admin/avaliacao/avaliado', [
				'avaliado' => $avaliado,
				'notas' => $notas,
				'funcionario' => $funcionario,
				'resultado' => $resultado,
				'status' => 'status'
			 ]);
			
			}
		
    public function delega(){
		$a = Request::input('a');
		$p = Request::input('p');
		$xyz = Request::input('xyz');
		
		
		$lideres = DB::select('select CODPESSOA AS CODIGO, F.NOME AS NOME, F.CHAPA AS CHAPA from equipes as E
					inner join funcionarios as F ON E.CODCLIENTE = F.CODPESSOA
					WHERE DATADEMISSAO IS NULL order by F.NOME');
					
		
		$avaliacao = DB::select("
					select F.CHAPA                              AS CHAPA, 
						   F.NOME                               AS NOME,  
						   MAX(P.CODPARTICIPANTE)               AS CODPARTICIPANTE,
						   P.CODAVALIACAO                       AS CODAVALIACAO,
						   A.NOME                               AS NOMEAVALIACAO,
						   P.CHAPAAVALIADOR                     AS CHAPAAVALIADOR, 
						   L.NOME                               AS NOMELIDER, 
						   /*I.IMAGEM 							AS IMAGEM,*/
						   IF(SUM(N.NOTAAVALIADOR)>0,'S','N')   AS TEMAVALIACAO
					 from funcionarios AS F
					inner join participantes AS P
						ON F.CHAPA = P.CHAPAAVALIADO
					left join funcionarios AS L 
						ON L.CHAPA = P.CHAPAAVALIADOR
						left join avaliacoes AS A
						ON A.CODAVALIACAO = P.CODAVALIACAO
						   AND A.CODCOLIGADA = P.CODCOLIGADA
					left join notas as N 
						ON N.CODPARTICIPANTE = P.CODPARTICIPANTE AND
						   N.CODAVALIACAO = P.CODAVALIACAO
					left join pessoas AS PE on PE.CODIGO = F.CODPESSOA
					/*left join fotos as I
						ON PE.IDIMAGEM = I.IDIMAGEM*/
					where F.CHAPA = ".$xyz." and A.CODAVALIACAO = ".$a." and P.CODPARTICIPANTE = ".$p."
					GROUP BY P.CODAVALIACAO
					ORDER BY A.CODAVALIACAO DESC;");
		
		$funcionario =  DB::select('select E.NOME AS NOME,
									  E.CHAPA AS CHAPA, 
									  E.DATAADMISSAO AS DATAADMISSAO,
									  E.DATADEMISSAO AS DATADEMISSAO,
									  C.NOME AS CARGO, 
									  I.IMAGEM AS IMAGEM,  
									  E.CODFILIAL AS LOJA,
									  E.CODEQUIPE AS CODEQUIPE
									  from funcionarios as E
									  inner join funcoes AS C on C.CODIGO = E.CODFUNCAO
									  left join pessoas AS P on P.CODIGO = E.CODPESSOA
									  left join fotos AS I on P.IDIMAGEM = I.IDIMAGEM
									  where E.CHAPA = '.$xyz);		
		
		return view('admin/avaliacao/delega', [
				'avaliacao' => $avaliacao,
				'lideres' => $lideres,
				'funcionario' => $funcionario,
				'a' => $a,
				'p' => $p,
				'xyz' => $xyz
			 ]);
		
		}
    
    public function delegaUMa(){
		
		$a = Request::input('a');
		$p = Request::input('p');
		$xyz = Request::input('xyz');
		$avaliador = Request::input('avaliador');
		$obs = Request::input('obs');
		$user = Sentinel::getUser()->id;
		$aa = Request::input('chapaantigoavaliador');
		$av = Request::input('avaliacao');
		
		
		$lideres = DB::select('select CODPESSOA AS CODIGO, F.NOME AS NOME, F.CHAPA AS CHAPA from equipes as E
					inner join funcionarios as F ON E.CODCLIENTE = F.CODPESSOA
					WHERE DATADEMISSAO IS NULL order by F.NOME');
					
		$avaliacao = DB::select("
					select F.CHAPA                              AS CHAPA, 
						   F.NOME                               AS NOME,  
						   MAX(P.CODPARTICIPANTE)               AS CODPARTICIPANTE,
						   P.CODAVALIACAO                       AS CODAVALIACAO,
						   A.NOME                               AS NOMEAVALIACAO,
						   P.CHAPAAVALIADOR                     AS CHAPAAVALIADOR, 
						   L.NOME                               AS NOMELIDER, 
						   /*I.IMAGEM 							AS IMAGEM,*/
						   IF(SUM(N.NOTAAVALIADOR)>0,'S','N')   AS TEMAVALIACAO
					 from funcionarios AS F
					inner join participantes AS P
						ON F.CHAPA = P.CHAPAAVALIADO
					left join funcionarios AS L 
						ON L.CHAPA = P.CHAPAAVALIADOR
						left join avaliacoes AS A
						ON A.CODAVALIACAO = P.CODAVALIACAO
						   AND A.CODCOLIGADA = P.CODCOLIGADA
					left join notas as N 
						ON N.CODPARTICIPANTE = P.CODPARTICIPANTE AND
						   N.CODAVALIACAO = P.CODAVALIACAO
					left join pessoas AS PE on PE.CODIGO = F.CODPESSOA
					where F.CHAPA = ".$xyz." and A.CODAVALIACAO = ".$a." and P.CODPARTICIPANTE = ".$p."
					GROUP BY P.CODAVALIACAO
					ORDER BY A.CODAVALIACAO DESC;");
		
		$funcionario =  DB::select('select E.NOME AS NOME,
									  E.CHAPA AS CHAPA, 
									  E.DATAADMISSAO AS DATAADMISSAO,
									  E.DATADEMISSAO AS DATADEMISSAO,
									  C.NOME AS CARGO, 
									  I.IMAGEM AS IMAGEM,  
									  E.CODFILIAL AS LOJA,
									  E.CODEQUIPE AS CODEQUIPE
									  from funcionarios as E
									  inner join funcoes AS C on C.CODIGO = E.CODFUNCAO
									  left join pessoas AS P on P.CODIGO = E.CODPESSOA
									  left join fotos AS I on P.IDIMAGEM = I.IDIMAGEM
									  where E.CHAPA = '.$xyz);		
									  
		$avaliado = DB::select("
					select F.CHAPA                              AS CHAPA, 
						   F.NOME                               AS NOME,  
						   MAX(P.CODPARTICIPANTE)               AS CODPARTICIPANTE,
						   P.CODAVALIACAO                       AS CODAVALIACAO,
						   A.NOME                               AS NOMEAVALIACAO,
						   P.CHAPAAVALIADOR                     AS CHAPAAVALIADOR, 
						   L.NOME                               AS NOMELIDER, 
						   /*I.IMAGEM 							AS IMAGEM,*/
						   IF(SUM(N.NOTAAVALIADOR)>0,'S','N')   AS TEMAVALIACAO
					 from funcionarios AS F
					inner join participantes AS P
						ON F.CHAPA = P.CHAPAAVALIADO
					left join funcionarios AS L 
						ON L.CHAPA = P.CHAPAAVALIADOR
						left join avaliacoes AS A
						ON A.CODAVALIACAO = P.CODAVALIACAO
						   AND A.CODCOLIGADA = P.CODCOLIGADA
					left join notas as N 
						ON N.CODPARTICIPANTE = P.CODPARTICIPANTE AND
						   N.CODAVALIACAO = P.CODAVALIACAO
					left join pessoas AS PE on PE.CODIGO = F.CODPESSOA
					/*left join fotos as I
						ON PE.IDIMAGEM = I.IDIMAGEM*/
					where F.CHAPA = ".$xyz." and A.DATAABERTURA > 20151231 and A.CODAVALIACAO > 24
					GROUP BY P.CODAVALIACAO
					ORDER BY A.CODAVALIACAO DESC;");
	
				DB::statement('update participantes set CHAPAAVALIADOR = '."$avaliador".' Where CODAVALIACAO = '.$a.' AND CODPARTICIPANTE = '.$p.';');
				DB::statement('insert into delegacoes (user, codigoavaliacao, obs, created_at, updated_at, chapaavaliado, chapaantigoavaliador, chapanovoavaliador) 
				values ('.$user.','.$av.',"'.$obs.'","'.date("Y-m-d H:i:s").'","'.date("Y-m-d H:i:s").'","'.$xyz.'",'.$aa.','.$avaliador.')');
						
			 return redirect()->intended('admin/avaliacao/avaliado?c='.$xyz)->withInput()->with('status' , 'Avaliador(a) alterado(a) com sucesso');
		
		}
    
    public function delegaTodas(){
		
			$xyz = Request::input('xyz');
			$lideres = DB::select('select CODPESSOA AS CODIGO, F.NOME AS NOME, F.CHAPA AS CHAPA from equipes as E
					inner join funcionarios as F ON E.CODCLIENTE = F.CODPESSOA
					WHERE DATADEMISSAO IS NULL order by F.NOME');
					
			
			$funcionario =  DB::select('select E.NOME AS NOME,
									  E.CHAPA AS CHAPA, 
									  E.DATAADMISSAO AS DATAADMISSAO,
									  E.DATADEMISSAO AS DATADEMISSAO,
									  C.NOME AS CARGO, 
									  I.IMAGEM AS IMAGEM,  
									  E.CODFILIAL AS LOJA,
									  E.CODEQUIPE AS CODEQUIPE
									  from funcionarios as E
									  inner join funcoes AS C on C.CODIGO = E.CODFUNCAO
									  left join pessoas AS P on P.CODIGO = E.CODPESSOA
									  left join fotos AS I on P.IDIMAGEM = I.IDIMAGEM
									  where E.CHAPA = '.$xyz);		
		
			$avaliado = DB::select(
						  "select F.CHAPA                              AS CHAPA, 
						   F.NOME                               AS NOME,  
						   MAX(P.CODPARTICIPANTE)               AS CODPARTICIPANTE,
						   P.CODAVALIACAO                       AS CODAVALIACAO,
						   A.NOME                               AS NOMEAVALIACAO,
						   P.CHAPAAVALIADOR                     AS CHAPAAVALIADOR, 
						   L.NOME                               AS NOMELIDER, 
						   /*I.IMAGEM 							AS IMAGEM,*/
						   IF(SUM(N.NOTAAVALIADOR)>0,'S','N')   AS TEMAVALIACAO
					 from funcionarios AS F
					inner join participantes AS P
						ON F.CHAPA = P.CHAPAAVALIADO
					left join funcionarios AS L 
						ON L.CHAPA = P.CHAPAAVALIADOR
						left join avaliacoes AS A
						ON A.CODAVALIACAO = P.CODAVALIACAO
						   AND A.CODCOLIGADA = P.CODCOLIGADA
					left join notas as N 
						ON N.CODPARTICIPANTE = P.CODPARTICIPANTE AND
						   N.CODAVALIACAO = P.CODAVALIACAO
					left join pessoas AS PE on PE.CODIGO = F.CODPESSOA
					/*left join fotos as I
						ON PE.IDIMAGEM = I.IDIMAGEM*/
					where F.CHAPA = ".$xyz." and A.CODAVALIACAO > 24
					GROUP BY P.CODAVALIACAO
					ORDER BY A.CODAVALIACAO ASC;");
		
		return view('admin/avaliacao/delegaTodas', [
				'avaliado' => $avaliado,
				'lideres' => $lideres,
				'funcionario' => $funcionario,
				'xyz' => $xyz,
				'contador' => 1
				 ]);
		
		}
    
    public function delegaVarias(){
		
		$xyz = Request::input('xyz');
		$contador = Request::input('contador');
		$i = 1;
		$avaliador = Request::input('avaliador');
		
		$user = Sentinel::getUser()->id;
		
		
		while ($i < $contador) {
			
			$variavel = 'participante'.$i;
			$p[$i] = Request::input($variavel);
			$a = Request::input($variavel);
			$obs = Request::input('obs');
			$aa = Request::input('chapaantigoavaliador');
			if ($a > 0){
				$av = Request::input('avaliacao');
			
				DB::statement('update participantes set CHAPAAVALIADOR = '.$avaliador.' Where CODPARTICIPANTE = '.$a.';');
				DB::statement('insert into delegacoes (user, codigoavaliacao, obs, created_at, updated_at, chapaavaliado, chapaantigoavaliador, chapanovoavaliador) 
					values ('.$user.','.$av.',"'.$obs.'","'.date("Y-m-d H:i:s").'","'.date("Y-m-d H:i:s").'","'.$xyz.'",'.$aa.','.$avaliador.')');
			}
			
			$i++;
				
			}
		
		return redirect()->intended('admin/avaliacao/avaliado?c='.$xyz)->withInput()->with('status' , 'Avaliador(a) alterado(a) com sucesso');
		
		}
    
    
	public function historicoDelegacao(){
		
		//$historico = DB::table("delegacoes")->orderby('created_at','desc')->paginate(20);
        $func_filter = Request::exists('func_filter') ? Request::input('func_filter') : '';
        $lider_filter = Request::exists('lider_filter') ? Request::input('lider_filter') : '';

        if ($lider_filter != '') {
			$historico = Delegacao::where('user', '=', $lider_filter)->orderBy('created_at', 'desc')->paginate(20);
		}

		if ($lider_filter == '') {
			$historico = Delegacao::orderBy('created_at', 'desc')->paginate(20);
		}

		$lideres = Equipe::all();
		//$filtroselecionado = Request::input($filtro);		

		return view('admin/avaliacao/historicoDelegacao', [
				'historico' => $historico,
				'lideres' =>$lideres,
				//'filtroselecionado' =>$filtro, 
				'hasbusca' =>0
			
				 ]);
				
		}


	public function equipe(){
		
		$lideres = DB::table('equipes')->distinct()->orderBy('DESCRICAO')->paginate(20);
		
		return view('admin/avaliacao/equipe', [
				'lideres' => $lideres
			
				 ]);
		}
    	
	public function mudaEquipe(){
		
		$xyz = Request::input('xyz');

		$lideres = DB::table('equipes')->distinct()->orderBy('DESCRICAO')->get();
		
		$funcionario =  DB::select('select E.NOME AS NOME,
									  E.CHAPA AS CHAPA, 
									  E.DATAADMISSAO AS DATAADMISSAO,
									  E.DATADEMISSAO AS DATADEMISSAO,
									  C.NOME AS CARGO, 
									  I.IMAGEM AS IMAGEM,  
									  E.CODFILIAL AS LOJA,
									  E.CODEQUIPE AS CODEQUIPE
									  from funcionarios as E
									  inner join funcoes AS C on C.CODIGO = E.CODFUNCAO
									  left join pessoas AS P on P.CODIGO = E.CODPESSOA
									  left join fotos AS I on P.IDIMAGEM = I.IDIMAGEM
									  where E.CHAPA = '.$xyz);	

		$equipe = DB::select('select *
									  from equipes as E
									  where E.CODINTERNO = '.$funcionario[0]->CODEQUIPE);

		return view('admin/avaliacao/mudaequipe', [
				'xyz' => $xyz,
				'lideres' => $lideres, 
				'funcionario' => $funcionario,
				'equipe' => $equipe
			
				 ]);
		}	


		public function outraEquipe(){

			$xyz = Request::input('xyz');
			$equipe = Request::input('equipe');
			$antigaequipe = Request::input('antigaequipe');
			$user = Sentinel::getUser()->id;

			DB::statement('update funcionarios set CODEQUIPE = '.$equipe.' Where CHAPA = "'.$xyz.'";');

			DB::statement('insert into equipeshistoricos (user, chapa, codnovaequipe, codantigaequipe, created_at, updated_at) 
					values ('.$user.',"'.$xyz.'",'.$equipe.','.$antigaequipe.',"'.date("Y-m-d H:i:s").'","'.date("Y-m-d H:i:s").'")');
			return redirect()->intended('admin/avaliacao/avaliado?c='.$xyz)->withInput()->with('status' , 'Equipe alterada com sucesso');

		}


		public function delegaFiltro(){

		}

		public function delegaBusca(){

		}

    	public function mostraHistoricoEquipe(){
		
    		$historico = Historicoequipe::orderBy('created_at', 'desc')->paginate(20);

    		$lideres = Equipe::all();

			return view('admin/avaliacao/historicoEquipe', [
							'historico' => $historico, 
							'lideres' => $lideres
						
							 ]);
				}	

		public function mediaAvaliacao(){
			
			return view('admin.avaliacao.media2016', [
		
			'0' => 0
			
			]);
		}
	
	
}
