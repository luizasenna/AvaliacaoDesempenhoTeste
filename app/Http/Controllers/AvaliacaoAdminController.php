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
use App\Assiduidade;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;

use DateTime;

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
								  left join funcoes AS C on C.CODIGO = E.CODFUNCAO
								  where CODEQUIPE = '.$usuario.' and DATADEMISSAO is null order by E.NOME');

			$abertas = DB::select('select *
								  from avaliacoes as A
								  inner join veravaliacoes AS V on A.CODAVALIACAO = V.codigoavaliacao
								  where statuslider = 0 and DATAFECHAMENTO is null');


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
    $codpessoa = Funcionario::where('CHAPA', '=', $id)->get();

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
							  Q.DESCRICAO AS LIDER,
                E.CODFILIAL AS FILIAL
							  from funcionarios as E
		            left join funcoes AS C on C.CODIGO = E.CODFUNCAO
                left join secoes as SC on E.CODSECAO = SC.CODIGO
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
      					MID(V.NOME,10,20)           AS DESCRICAO,
      					V.DATAABERTURA   AS DATA, P.CODPARTICIPANTE, P.CODAVALIACAO,
      					N.COMENTARIO     AS OBS,
      					date_format(N.created_at, "%d/%m/%Y")  AS FEITAEM,
      					N.CODPARTICIPANTE  AS PARTICIPANTE,
      					P.CHAPAAVALIADOR  AS AVALIADOR,
      					F.CODPESSOA     AS CODPESSOA,
								YEAR(V.DATAABERTURA) AS ANO
      					from notas AS N
      					inner join participantes AS P on N.CODAVALIACAO = P.CODAVALIACAO and N.CODPARTICIPANTE = P.CODPARTICIPANTE
      					inner JOIN competencias AS S ON N.CODITEMAVAL = S.CODCOMPETENCIA
      					inner JOIN avaliacoes AS  V ON V.CODAVALIACAO = N.CODAVALIACAO
      					inner JOIN veravaliacoes AS VAV on V.CODAVALIACAO = VAV.codigoavaliacao
      					inner JOIN funcionarios AS F ON F.CHAPA = P.CHAPAAVALIADO
      					where statuslider = 0 and P.CHAPAAVALIADO = '.$id);


		$resultado = DB::select('
						select
						AVALIACAO,
						notas_temp.CHAPA,
						CODPARTICIPANTE,
						DESCRICAO,
						FEITAEM,
						PARTICIPANTE,
						AVALIADOR,
            notas_temp.CODPESSOA,
            notas_temp.ANO AS ANO,
						MAX(IF(ITEM = "01", notas_temp.NOTA, 0)) AS NOTA1,
						MAX(IF(ITEM = "01", OBS, " - "))  AS OBS1,
						MAX(IF(ITEM = "02", notas_temp.NOTA, 0)) AS NOTA2,
						CASE
						WHEN (AE.atraso) BETWEEN "0" AND "1,99"    THEN 10
						WHEN (AE.atraso) BETWEEN "2,0" AND "4"     THEN 3
						WHEN (AE.atraso) BETWEEN "4,01" AND "8" 	       THEN 1
						WHEN (AE.atraso) BETWEEN "8,1" AND "100"     THEN 0
						ELSE 0 END
						AS	  	                        NOTA3,
						MAX(IF(ITEM = "04", notas_temp.NOTA, 0)) AS NOTA4,
						MAX(IF(ITEM = "05", notas_temp.NOTA, 0)) AS NOTA5,
						MAX(IF(ITEM = "06", notas_temp.NOTA, 0)) AS NOTA6,
						MAX(IF(ITEM = "07", notas_temp.NOTA, 0)) AS NOTA7,
						MAX(IF(ITEM = "08", notas_temp.NOTA, 0)) AS NOTA8,
						MAX(IF(ITEM = "09", notas_temp.NOTA, 0)) AS NOTA9,
						MAX(IF(ITEM = "10", notas_temp.NOTA, 0)) AS NOTA10,
						MAX(IF(ITEM = "11", notas_temp.NOTA, 0)) AS NOTA11,
						MAX(IF(ITEM = "12", notas_temp.NOTA, 0)) AS NOTA12,
						MAX(IF(ITEM = "13", notas_temp.NOTA, 0)) AS NOTA13,
						MAX(IF(ITEM = "14", notas_temp.NOTA, 0)) AS NOTA14,
						MAX(IF(ITEM = "15", notas_temp.NOTA, 0)) AS NOTA15,
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
						left join assiduidade AS AE on AE.codpessoa = notas_temp.CODPESSOA AND AE.codavaliacao = notas_temp.AVALIACAO
						GROUP BY AVALIACAO, CHAPA
						ORDER BY AVALIACAO');

            $anos = DB::select('select ANO
																from notas_temp group by ANO');

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
				$qt = $qt + 1; //considerando a assiduidade calculada automaticamente
				$total = $total + $r->NOTA3; //considerando a assiduidade calculada automaticamente
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
      			'licenciados' => $licenciados,
            'anos' => $anos,
            'codpessoa' => $codpessoa
         ]);

	}

  public function notasImpressao($ano, $codigo){

        $usuario = Sentinel::getUser()->codequipe;
        $chefe = Sentinel::getUser()->codpessoa;
        $lider = Funcionario::where('CODPESSOA', '=', $chefe)->get();
        $codpessoa = Funcionario::where('CODPESSOA', '=', $codigo)->get();

        $grupo = '';


        if ($chefe == $codigo)
          $perm = "Você não pode ver suas próprias notas! =(";
        if ($chefe <> $codigo)
            $perm = '0';

            $compfuncao = DB::select('select * from vercargos AS V
                          inner join funcionarios AS F on V.codcargo = F.CODFUNCAO
                          where F.CODPESSOA = '.$codigo);

            $funcionario =  DB::select('select E.NOME AS NOME,
                        E.CHAPA AS CHAPA,
                        E.DATAADMISSAO AS DATAADMISSAO,
                        C.NOME AS CARGO,
                        I.IMAGEM AS IMAGEM,
                        Q.DESCRICAO AS LIDER,
                        E.CODFILIAL AS FILIAL,
                        SC.CODIGO   AS CODSECAO,
                        SC.DESCRICAO AS NOMESECAO
                        from funcionarios as E
                                  left join funcoes AS C on C.CODIGO = E.CODFUNCAO
                        left join pessoas AS P on P.CODIGO = E.CODPESSOA
                        left join fotos AS I on P.IDIMAGEM = I.IDIMAGEM
                        left join secoes as SC on E.CODSECAO = SC.CODIGO
                        inner join equipes as Q ON Q.CODCLIENTE = E.CODEQUIPE
                        where E.CODPESSOA = '.$codigo);

            $licenciados = DB::select('select * from licenciados where CODPESSOA = '.$codigo);
            $licencas = DB::select('select * from licencas where CODPESSOA = '.$codigo);

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
                      P.CHAPAAVALIADOR  AS AVALIADOR,
                      F.CODPESSOA     AS CODPESSOA,
                      YEAR(V.DATAABERTURA) AS ANO
                      from notas AS N
                      inner join participantes AS P on N.CODAVALIACAO = P.CODAVALIACAO and N.CODPARTICIPANTE = P.CODPARTICIPANTE
                      inner JOIN competencias AS S ON N.CODITEMAVAL = S.CODCOMPETENCIA
                      inner JOIN avaliacoes AS  V ON V.CODAVALIACAO = N.CODAVALIACAO
                      inner JOIN veravaliacoes AS VAV on V.CODAVALIACAO = VAV.codigoavaliacao
                      inner JOIN funcionarios AS F ON F.CHAPA = P.CHAPAAVALIADO
                      where statuslider = 0 and P.CODPESSOA = '.$codigo.' and YEAR(V.DATAABERTURA) = '.$ano);

                      $resultado = DB::select('
                              select
                              AVALIACAO,
                              notas_temp.CHAPA,
                              CODPARTICIPANTE,
                              DESCRICAO,
                              FEITAEM,
                              PARTICIPANTE,
                              AVALIADOR,
                              notas_temp.CODPESSOA,
                              notas_temp.ANO AS ANO,
                              MAX(IF(ITEM = "01", notas_temp.NOTA, 0)) AS NOTA1,
                              MAX(IF(ITEM = "01", OBS, " - "))  AS OBS1,
                              MAX(IF(ITEM = "02", notas_temp.NOTA, 0)) AS NOTA2,
                              CASE
                              WHEN (AE.atraso) BETWEEN "0" AND "1,99"    THEN 10
                              WHEN (AE.atraso) BETWEEN "2,0" AND "4"     THEN 3
                              WHEN (AE.atraso) BETWEEN "4,01" AND "8" 	       THEN 1
                              WHEN (AE.atraso) BETWEEN "8,1" AND "100"     THEN 0
                              ELSE 0 END
                              AS	  	                        NOTA3,
                              MAX(IF(ITEM = "04", notas_temp.NOTA, 0)) AS NOTA4,
                              MAX(IF(ITEM = "05", notas_temp.NOTA, 0)) AS NOTA5,
                              MAX(IF(ITEM = "06", notas_temp.NOTA, 0)) AS NOTA6,
                              MAX(IF(ITEM = "07", notas_temp.NOTA, 0)) AS NOTA7,
                              MAX(IF(ITEM = "08", notas_temp.NOTA, 0)) AS NOTA8,
                              MAX(IF(ITEM = "09", notas_temp.NOTA, 0)) AS NOTA9,
                              MAX(IF(ITEM = "10", notas_temp.NOTA, 0)) AS NOTA10,
                              MAX(IF(ITEM = "11", notas_temp.NOTA, 0)) AS NOTA11,
                              MAX(IF(ITEM = "12", notas_temp.NOTA, 0)) AS NOTA12,
                              MAX(IF(ITEM = "13", notas_temp.NOTA, 0)) AS NOTA13,
                              MAX(IF(ITEM = "14", notas_temp.NOTA, 0)) AS NOTA14,
                              MAX(IF(ITEM = "15", notas_temp.NOTA, 0)) AS NOTA15,
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
                              left join assiduidade AS AE on AE.codpessoa = notas_temp.CODPESSOA AND AE.codavaliacao = notas_temp.AVALIACAO
                              GROUP BY AVALIACAO, CHAPA
                              ORDER BY AVALIACAO');

                              $anos = DB::select('select ANO
                                                  from notas_temp group by ANO');

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
                          $qt = $qt + 1; //considerando a assiduidade calculada automaticamente
                          $total = $total + $r->NOTA3; //considerando a assiduidade calculada automaticamente
                          $r->MEDIA = $total/$qt;
                          $total = 0;
                          $t = 1; $qt = 0;

                      }

    return view('admin.avaliacao.notasImpressao', [
          'notas' => $notas,
          'funcionario' => $funcionario,
          'resultado' => $resultado,
          'compfuncao' => $compfuncao,
          'perm' => $perm,
          'qt' => $qt,
          'aa' => $aa,
          'm' => 0,
          'licencas' => $licencas,
          'licenciados' => $licenciados,
          'ano' => $ano,
          'codpessoa' => $codpessoa
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
		$id = Request::input('id');
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
									  left join funcoes AS C on C.CODIGO = E.CODFUNCAO
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
							inner join participantes AS P
								on N.CODAVALIACAO = P.CODAVALIACAO
								and N.CODPARTICIPANTE = P.CODPARTICIPANTE
								and N.CODCOLIGADA = P.CODCOLIGADA
								inner JOIN avaliacoes AS  V
								ON V.CODAVALIACAO = N.CODAVALIACAO
								and V.CODCOLIGADA = N.CODCOLIGADA
							left JOIN competencias AS S ON N.CODITEMAVAL = S.CODCOMPETENCIA
							left JOIN veravaliacoes AS VAV on V.CODAVALIACAO = VAV.codigoavaliacao
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
								ORDER BY AVALIACAO');


			return view('admin/avaliacao/avaliado', [
				'avaliado' => $avaliado,
				'notas' => $notas,
				'funcionario' => $funcionario,
				'resultado' => $resultado,
				'status' => 'status',
        'codpessoa' => $codpessoa
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
									  left join funcoes AS C on C.CODIGO = E.CODFUNCAO
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
									  left join funcoes AS C on C.CODIGO = E.CODFUNCAO
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
									  left join funcoes AS C on C.CODIGO = E.CODFUNCAO
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

        $func_filter = Request::exists('func_filter') ? Request::input('func_filter') : '';
        $lider_filter = Request::exists('lider_filter') ? Request::input('lider_filter') : '';

        if ($lider_filter != '') {
			$historico = Delegacao::where('user', '=', $lider_filter)->orderBy('created_at', 'desc')->paginate(20);
		}

		if ($lider_filter == '') {
			$historico = Delegacao::orderBy('created_at', 'desc')->paginate(20);
		}

		$lideres = Equipe::all();

		return view('admin/avaliacao/historicoDelegacao', [
				'historico' => $historico,
				'lideres' =>$lideres,
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
									  left join funcoes AS C on C.CODIGO = E.CODFUNCAO
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


    	public function mostraHistoricoEquipe(){

    		$historico = Historicoequipe::orderBy('created_at', 'desc')->paginate(20);

    		$lideres = Equipe::all();

			return view('admin/avaliacao/historicoEquipe', [
							'historico' => $historico,
							'lideres' => $lideres
			]);
				}

		public function mediaAvaliacao(){

			$equipes = Equipe::orderBy('DESCRICAO','asc')->get();
			$equipe_filter = Request::Input('equipe');


			if (isset($equipe_filter)){

				DB::statement('drop table if exists notas_temp;');


					$query = 'create temporary table notas_temp
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
					F.NOME           AS NOME,
					FUN.NOME        AS FUNCAO,
					N.CODPARTICIPANTE  AS PARTICIPANTE,
					LIDER.NOME   AS AVALIADOR,
					F.CODPESSOA        AS CODPESSOA
					from notas AS N
					inner join participantes AS P on N.CODAVALIACAO = P.CODAVALIACAO and N.CODPARTICIPANTE = P.CODPARTICIPANTE
					inner JOIN competencias AS S ON N.CODITEMAVAL = S.CODCOMPETENCIA
					inner JOIN avaliacoes AS  V ON V.CODAVALIACAO = N.CODAVALIACAO
					inner JOIN veravaliacoes AS VAV on V.CODAVALIACAO = VAV.codigoavaliacao
					inner JOIN funcionarios AS F on F.CODPESSOA = P.CODPESSOA
					inner JOIN funcionarios AS LIDER ON LIDER.CODPESSOA = F.CODEQUIPE
					left JOIN funcoes AS FUN ON FUN.CODIGO = F.CODFUNCAO
					where statuslider = 0 and P.CODAVALIACAO BETWEEN 25 AND 36 and F.CODEQUIPE = '.$equipe_filter.'
					GROUP BY P.CODPESSOA, P.CODAVALIACAO, N.CODITEMAVAL';

				DB::statement($query);

				DB::statement('drop table if exists notasPessoa');
				DB::statement('CREATE TEMPORARY TABLE notasPessoa
                		select
						AVALIACAO,
						notas_temp.CHAPA AS CHAPA,
						CODPARTICIPANTE,
						DESCRICAO,
						PARTICIPANTE,
						AVALIADOR,
						NOME,
						FUNCAO,
						notas_temp.CODPESSOA AS CODPESSOA,
						MAX(IF(ITEM = "01", NOTA, 0)) AS NOTA1,
						MAX(IF(ITEM = "02", NOTA, 0)) AS NOTA2,
						MAX(IF(ITEM = "04", NOTA, 0)) AS NOTA4,
						CASE
						WHEN (AE.atraso) BETWEEN "0" AND "2"      THEN 10
						WHEN (AE.atraso) BETWEEN "2,01" AND "4"    THEN 3
						WHEN (AE.atraso) BETWEEN "4,01" AND "7,99" THEN 1
						WHEN (AE.atraso) BETWEEN "8" AND "20"      THEN 0
						ELSE 0 END
						AS	  	                        NOTA3,
						MAX(IF(ITEM = "05", NOTA, 0)) AS NOTA5,
						MAX(IF(ITEM = "06", NOTA, 0)) AS NOTA6,
						MAX(IF(ITEM = "07", NOTA, 0)) AS NOTA7,
						MAX(IF(ITEM = "08", NOTA, 0)) AS NOTA8,
						MAX(IF(ITEM = "09", NOTA, 0)) AS NOTA9,
						MAX(IF(ITEM = "10", NOTA, 0)) AS NOTA10,
						MAX(IF(ITEM = "12", NOTA, 0)) AS NOTA12,
						MAX(IF(ITEM = "13", NOTA, 0)) AS NOTA13,
						MAX(IF(ITEM = "14", NOTA, 0)) AS NOTA14,
						MAX(IF(ITEM = "15", NOTA, 0)) AS NOTA15
 						from notas_temp
						left join assiduidade AS AE on AE.codpessoa = notas_temp.CODPESSOA AND AE.codavaliacao = notas_temp.AVALIACAO
                        where NOTA != 0
						GROUP BY AVALIACAO, CODPESSOA
						ORDER BY AVALIACAO');

				$total = DB::select(DB::raw('select * from notasPessoa order by CODPESSOA'));
				$contador = 0;
				$soma = 0;

				DB::statement('Drop table if exists feitas');
				DB::statement('create temporary table feitas
							select p.CHAPAAVALIADO AS CHAPAAVALIADO,
								   p.CODPESSOA as CODPESSOA,
								   f.NOME AS NOME,
								   p.CODAVALIACAO AS CODAVALIACAO,
								  (if(n.CODITEMAVAL is not null, 1,0)) as EXISTE
							from participantes as p
							inner join funcionarios as f on f.CODPESSOA = p.CODPESSOA
							left join notas as n on n.CODPARTICIPANTE = p.CODPARTICIPANTE and n.CODCOLIGADA = p.CODCOLIGADA and n.CODAVALIACAO = p.CODAVALIACAO
							where f.CODEQUIPE = '.$equipe_filter.' and p.CODAVALIACAO between 25 and 36
							group by p.CODPESSOA, p.CODAVALIACAO');

				DB::statement('Drop table if exists totais');
				DB::statement('Create temporary table totais
							select count(CODAVALIACAO) AS QTDE, SUM(EXISTE) AS FEITAS, CHAPAAVALIADO,
				   CODPESSOA, NOME from feitas GROUP BY CODPESSOA');

				DB::statement('delete from mediageralano');
				foreach($total as $t){
					if($t->NOTA1 > 0) {
						$soma = $soma + $t->NOTA1;
						$contador++;
					}
					if($t->NOTA2 > 0) {
						$soma = $soma + $t->NOTA2;
						$contador++;
					}
					$soma = $soma + $t->NOTA3; //considerando a assiduidade
					$contador++; //considerando a assiduidade
					if($t->NOTA4 > 0) {
						$soma = $soma + $t->NOTA4;
						$contador++;
					}
					if($t->NOTA5 > 0) {
						$soma = $soma + $t->NOTA5;
						$contador++;
					}
					if($t->NOTA6 > 0) {
						$soma = $soma + $t->NOTA6;
						$contador++;
					}
					if($t->NOTA7 > 0) {
						$soma = $soma + $t->NOTA7;
						$contador++;
					}
					if($t->NOTA8 > 0) {
						$soma = $soma + $t->NOTA8;
						$contador++;
					}
					if($t->NOTA9 > 0) {
						$soma = $soma + $t->NOTA9;
						$contador++;
					}
					if($t->NOTA10 > 0) {
						$soma = $soma + $t->NOTA10;
						$contador++;
					}
					if($t->NOTA12 > 0) {
						$soma = $soma + $t->NOTA12;
						$contador++;
					}
					if($t->NOTA13 > 0) {
						$soma = $soma + $t->NOTA13;
						$contador++;
					}
					if($t->NOTA14 > 0) {
						$soma = $soma + $t->NOTA14;
						$contador++;
					}
					if($t->NOTA15 > 0) {
						$soma = $soma + $t->NOTA15;
						$contador++;
					}
					$t->mediames = ($soma/$contador);
					$contador = 0;
					$soma = 0;


				DB::table('mediageralano')->insert(
				array('CODPESSOA'=>$t->CODPESSOA, 'CHAPA'=>$t->CHAPA, 'AVALIACAO'=>$t->AVALIACAO, 'MEDIA'=>$t->mediames, 'NOME'=>$t->NOME, 'FUNCAO'=>$t->FUNCAO, 'AVALIADOR'=>$t->AVALIADOR));


				}
			}
			 else {
				$total = '';
				$medias = '';
			}

			if (isset($equipe_filter)){
			$medias = DB::select('select f.CHAPA as CHAPA,
			f.NOME as NOME,
			FUNCAO,
			f.DATAADMISSAO AS DATAADMISSAO,
			ROUND(SUM(MEDIA)/COUNT(f.CHAPA),2) as MEDIA,
			CASE(f.CODFILIAL)
			WHEN 1 THEN "PINTOS MAGAZINE"
			WHEN 3 THEN "PINTOS RIVERSIDE"
			WHEN 5 THEN "PINTOS RIO BRANCO"
			WHEN 6 THEN "PINTOS CD1"
			WHEN 8 THEN "PINTOS CALÇADOS"
			WHEN 9 THEN "PINTOS FREI SERAFIM"
			WHEN 10 THEN "PINTOS CD2"
			WHEN 11 THEN "PINTOS SHOPPING"
			WHEN 12 THEN "PINTOS RIO POTY" END AS LOJA,
			f.CODSECAO AS CODSECAO,
			s.DESCRICAO as SECAO,
			AVALIADOR AS AVALIADOR,
			(totais.QTDE) AS TOTAL,
			(totais.FEITAS) AS FEITAS
			FROM mediageralano
			inner join funcionarios as f on f.CHAPA = mediageralano.chapa
			LEFT JOIN secoes as s on s.CODIGO = f.CODSECAO
			LEFT JOIN totais on totais.CODPESSOA = mediageralano.CODPESSOA
			WHERE AVALIACAO between 25 and 36 group by mediageralano.CODPESSOA order by MEDIA desc');
			}
			return view('admin.avaliacao.media2016', [

			'equipes' => $equipes,
			'equipe_filter' => $equipe_filter,
			'total' => $total,
			'medias' => $medias

			]);
		}

		public function mediaImpressao(){


			$medias = DB::select('select f.CHAPA as CHAPA,
			f.NOME as NOME,
			FUNCAO,
			f.DATAADMISSAO AS DATAADMISSAO,
			replace(round(SUM(MEDIA)/COUNT(f.CHAPA),4),".",",") as MEDIA,
			CASE(f.CODFILIAL)
			WHEN 1 THEN "PINTOS MAGAZINE"
			WHEN 3 THEN "PINTOS RIVERSIDE"
			WHEN 5 THEN "PINTOS RIO BRANCO"
			WHEN 6 THEN "PINTOS CD1"
			WHEN 8 THEN "PINTOS CALÇADOS"
			WHEN 9 THEN "PINTOS FREI SERAFIM"
			WHEN 10 THEN "PINTOS CD2"
			WHEN 11 THEN "PINTOS SHOPPING"
			WHEN 12 THEN "PINTOS RIO POTY" END AS LOJA,
			f.CODSECAO AS CODSECAO,
			s.DESCRICAO as SECAO,
			AVALIADOR AS AVALIADOR
			FROM mediageralano
			inner join funcionarios as f on f.CHAPA = mediageralano.chapa
			LEFT JOIN secoes as s on s.CODIGO = f.CODSECAO
			WHERE AVALIACAO between 25 and 36 group by f.CHAPA order by MEDIA desc');
			$equipe = Request::Input('e');
			if ($equipe == 'all') {$lider = "Todos os avaliadores";}
			else{
			$lider = Funcionario::Where('CODPESSOA', '=', $equipe)->groupBy('CODPESSOA')->get();}

			return view('admin.avaliacao.mediaImpressao', [
			'medias' => $medias,
			'lider'=> $lider

			]);

		}

		public function pendente2016(){


			return view('admin.avaliacao.pendente2016', [
			'0' => 0

			]);

		}

  public function mediaAvaliacaoAno(){

      $di = Request::Input('dataInicial');
      $df = Request::Input('dataFinal');

      if($di<0) { $di = date(now()); }

      DB::statement('drop table if exists notas_temp_todas;');

      $query = 'create table notas_temp_todas
          (index PARTICIPANTE(PARTICIPANTE), index CODPESSOA(CODPESSOA))
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
          F.NOME           AS NOME,
          FUN.NOME        AS FUNCAO,
          N.CODPARTICIPANTE  AS PARTICIPANTE,
          LIDER.NOME   AS AVALIADOR,
          F.CODPESSOA        AS CODPESSOA
          from notas AS N
          inner join participantes AS P
                        on N.CODAVALIACAO = P.CODAVALIACAO
                        and N.CODPARTICIPANTE = P.CODPARTICIPANTE
                        and N.CODCOLIGADA = P.CODCOLIGADA
          inner JOIN competencias AS S ON N.CODITEMAVAL = S.CODCOMPETENCIA
          inner JOIN avaliacoes AS  V
                        ON V.CODAVALIACAO = N.CODAVALIACAO
                        and V.CODCOLIGADA = N.CODCOLIGADA
          inner JOIN veravaliacoes AS VAV on V.CODAVALIACAO = VAV.codigoavaliacao
          LEFT JOIN funcionarios AS F on F.CODPESSOA = P.CODPESSOA
          LEFT JOIN funcionarios AS LIDER ON LIDER.CODPESSOA = F.CODEQUIPE
          left JOIN funcoes AS FUN ON FUN.CODIGO = F.CODFUNCAO
          where statuslider = 0 and P.CODAVALIACAO BETWEEN 25 AND 36
          GROUP BY P.CODPESSOA, P.CODAVALIACAO, N.CODITEMAVAL';

        DB::statement($query);

        DB::statement('drop table if exists notasPessoaTodas');
        DB::statement('CREATE TABLE notasPessoaTodas
                    select
            AVALIACAO,
            todasAsNotas.CHAPA AS CHAPA,
            CODPARTICIPANTE,
            DESCRICAO,
            PARTICIPANTE,
            AVALIADOR,
            NOME,
            FUNCAO,
            todasAsNotas.CODPESSOA AS CODPESSOA,
            MAX(IF(ITEM = "01", NOTA, 0)) AS NOTA1,
            MAX(IF(ITEM = "02", NOTA, 0)) AS NOTA2,
            MAX(IF(ITEM = "04", NOTA, 0)) AS NOTA4,
            CASE
            WHEN (AE.atraso) BETWEEN "0" AND "2"       THEN 10
            WHEN (AE.atraso) BETWEEN "2,01" AND "4"    THEN 3
            WHEN (AE.atraso) BETWEEN "4,01" AND "7,99" THEN 1
            WHEN (AE.atraso) BETWEEN "8" AND "20"      THEN 0
            ELSE 0 END
            AS	  	                        NOTA3,
            MAX(IF(ITEM = "05", NOTA, 0)) AS NOTA5,
            MAX(IF(ITEM = "06", NOTA, 0)) AS NOTA6,
            MAX(IF(ITEM = "07", NOTA, 0)) AS NOTA7,
            MAX(IF(ITEM = "08", NOTA, 0)) AS NOTA8,
            MAX(IF(ITEM = "09", NOTA, 0)) AS NOTA9,
            MAX(IF(ITEM = "10", NOTA, 0)) AS NOTA10,
            MAX(IF(ITEM = "12", NOTA, 0)) AS NOTA12,
            MAX(IF(ITEM = "13", NOTA, 0)) AS NOTA13,
            MAX(IF(ITEM = "14", NOTA, 0)) AS NOTA14,
            MAX(IF(ITEM = "15", NOTA, 0)) AS NOTA15
            from todasAsNotas
            left join assiduidade AS AE on AE.codpessoa = todasAsNotas.CODPESSOA AND AE.codavaliacao = todasAsNotas.AVALIACAO
            where NOTA != 0
            GROUP BY AVALIACAO, CODPESSOA
            ORDER BY AVALIACAO');

        $total = DB::select(DB::raw('select * from notasPessoaTodas order by CODPESSOA'));
        $contador = 0;
        $soma = 0;

        DB::statement('delete from mediageralano');

        DB::statement('Drop table if exists feitas');
        DB::statement('create temporary table feitas
              select p.CHAPAAVALIADO AS CHAPAAVALIADO,
                   p.CODPESSOA as CODPESSOA,
                   f.NOME AS NOME,
                   p.CODAVALIACAO AS CODAVALIACAO,
                  (if(n.CODITEMAVAL is not null, 1,0)) as EXISTE
              from participantes as p
              inner join funcionarios as f on f.CODPESSOA = p.CODPESSOA
              left join notas as n on n.CODPARTICIPANTE = p.CODPARTICIPANTE and n.CODCOLIGADA = p.CODCOLIGADA and n.CODAVALIACAO = p.CODAVALIACAO
              where p.CODAVALIACAO between 25 and 36
              group by p.CODPESSOA, p.CODAVALIACAO');

        DB::statement('Drop table if exists totais');
        DB::statement('Create temporary table totais
              select count(CODAVALIACAO) AS QTDE, SUM(EXISTE) AS FEITAS, CHAPAAVALIADO,
           CODPESSOA, NOME from feitas GROUP BY CODPESSOA');


        foreach($total as $t){
          if($t->NOTA1 > 0) {
            $soma = $soma + $t->NOTA1;
            $contador++;
          }
          if($t->NOTA2 > 0) {
            $soma = $soma + $t->NOTA2;
            $contador++;
          }
          $soma = $soma + $t->NOTA3; //considerando a assiduidade
          $contador++; //considerando a assiduidade
          if($t->NOTA4 > 0) {
            $soma = $soma + $t->NOTA4;
            $contador++;
          }
          if($t->NOTA5 > 0) {
            $soma = $soma + $t->NOTA5;
            $contador++;
          }
          if($t->NOTA6 > 0) {
            $soma = $soma + $t->NOTA6;
            $contador++;
          }
          if($t->NOTA7 > 0) {
            $soma = $soma + $t->NOTA7;
            $contador++;
          }
          if($t->NOTA8 > 0) {
            $soma = $soma + $t->NOTA8;
            $contador++;
          }
          if($t->NOTA9 > 0) {
            $soma = $soma + $t->NOTA9;
            $contador++;
          }
          if($t->NOTA10 > 0) {
            $soma = $soma + $t->NOTA10;
            $contador++;
          }
          if($t->NOTA12 > 0) {
            $soma = $soma + $t->NOTA12;
            $contador++;
          }
          if($t->NOTA13 > 0) {
            $soma = $soma + $t->NOTA13;
            $contador++;
          }
          if($t->NOTA14 > 0) {
            $soma = $soma + $t->NOTA14;
            $contador++;
          }
          if($t->NOTA15 > 0) {
            $soma = $soma + $t->NOTA15;
            $contador++;
          }
          $t->mediames = ($soma/$contador);
          $contador = 0;
          $soma = 0;


        DB::table('mediageralano')->insert(
        array('CODPESSOA'=>$t->CODPESSOA, 'CHAPA'=>$t->CHAPA, 'AVALIACAO'=>$t->AVALIACAO, 'MEDIA'=>$t->mediames, 'NOME'=>$t->NOME, 'FUNCAO'=>$t->FUNCAO, 'AVALIADOR'=>$t->AVALIADOR));

        }


        $medias = DB::select('select f.CHAPA as CHAPA,
        f.NOME as NOME,
        FUNCAO,
        f.DATAADMISSAO AS DATAADMISSAO,
        replace(round(SUM(MEDIA)/COUNT(f.CHAPA),4),".",",") as MEDIA,
        CASE(f.CODFILIAL)
        WHEN 1 THEN "PINTOS MAGAZINE"
        WHEN 3 THEN "PINTOS RIVERSIDE"
        WHEN 5 THEN "PINTOS RIO BRANCO"
        WHEN 6 THEN "PINTOS CD1"
        WHEN 8 THEN "PINTOS CALÇADOS"
        WHEN 9 THEN "PINTOS FREI SERAFIM"
        WHEN 10 THEN "PINTOS CD2"
        WHEN 11 THEN "PINTOS SHOPPING"
        WHEN 12 THEN "PINTOS RIO POTY" END AS LOJA,
        f.CODSECAO AS CODSECAO,
        s.DESCRICAO as SECAO,
        AVALIADOR AS AVALIADOR,
        (totais.QTDE) AS TOTAL,
        (totais.FEITAS) AS FEITAS
        FROM mediageralano
        inner join funcionarios as f on f.CHAPA = mediageralano.chapa
        LEFT JOIN secoes as s on s.CODIGO = f.CODSECAO
        LEFT JOIN totais on totais.CODPESSOA = mediageralano.CODPESSOA
        WHERE AVALIACAO between 25 and 36 group by mediageralano.CODPESSOA order by MEDIA desc');

        return view('admin.avaliacao.media2016Geral', [
        'total' => $total,
        'medias' => $medias ]);

  }


	public function mediaAvaliacaoTodas(){

      $di = Request::exists('dataInicial') ? DateTime::createFromFormat('d/m/Y',Request::input('dataInicial')) : date('Y-m-d');
      $df = Request::exists('dataFinal') ? DateTime::createFromFormat('d/m/Y',Request::input('dataFinal')) : date('Y-m-d');

    Request::exists('dataInicial') ?  $di = date('Y-m-d', $di->getTimestamp()) : '';
    Request::exists('dataFinal') ? $df = date('Y-m-d', $df->getTimestamp()) : '';

      if(($di<>0)){
        			DB::statement('drop table if exists notas_temp_todas;');

        			$query = 'create table notas_temp_todas
        					(index PARTICIPANTE(PARTICIPANTE), index CODPESSOA(CODPESSOA))
        					select
        				   N.CODITEMAVAL   AS ITEM,
        					S.NOME           AS NOMECOMPETENCIA,
        					NOTAAVALIADOR    AS NOTAAVALIADOR,
        					P.CHAPAAVALIADO  AS CHAPA,
        					N.CODAVALIACAO   AS AVALIACAO,
        					V.NOME           AS DESCRICAO,
        					V.DATAABERTURA   AS DATA, P.CODPARTICIPANTE, P.CODAVALIACAO,
        					N.COMENTARIO     AS OBS,
        					date_format(N.created_at, "%d/%m/%Y")  AS FEITAEM,
        					F.NOME           AS NOME,
        					FUN.NOME         AS FUNCAO,
        					N.CODPARTICIPANTE  AS PARTICIPANTE,
        					LIDER.NOME       AS AVALIADOR,
        					F.CODPESSOA      AS CODPESSOA
        					from notas AS N
        					inner join participantes AS P
                                on N.CODAVALIACAO = P.CODAVALIACAO
                                and N.CODPARTICIPANTE = P.CODPARTICIPANTE
                                and N.CODCOLIGADA = P.CODCOLIGADA
        					inner JOIN competencias AS S ON N.CODITEMAVAL = S.CODCOMPETENCIA
        					inner JOIN avaliacoes AS  V
                                ON V.CODAVALIACAO = N.CODAVALIACAO
                                and V.CODCOLIGADA = N.CODCOLIGADA
        					inner JOIN veravaliacoes AS VAV on V.CODAVALIACAO = VAV.codigoavaliacao
        					LEFT JOIN funcionarios AS F on F.CODPESSOA = P.CODPESSOA
        					LEFT JOIN funcionarios AS LIDER ON LIDER.CODPESSOA = F.CODEQUIPE
        					left JOIN funcoes AS FUN ON FUN.CODIGO = F.CODFUNCAO
        					where statuslider = 0 and V.DATAABERTURA BETWEEN "'.$di.'"  and "'.$df.'"
        					 GROUP BY P.CODPESSOA, P.CODAVALIACAO, N.CODITEMAVAL';

        				DB::statement($query);

        				DB::statement('drop table if exists notasPessoaTodas');
        				DB::statement('CREATE TABLE notasPessoaTodas
                        		select
        						AVALIACAO,
        						todasAsNotas.CHAPA AS CHAPA,
        						CODPARTICIPANTE,
        						DESCRICAO,
        						PARTICIPANTE,
        						AVALIADOR,
        						NOME,
        						FUNCAO,
        						todasAsNotas.CODPESSOA AS CODPESSOA,
        						MAX(IF(ITEM = "01", NOTAAVALIADOR, 0)) AS NOTA1,
        						MAX(IF(ITEM = "02", NOTAAVALIADOR, 0)) AS NOTA2,
        						MAX(IF(ITEM = "04", NOTA, 0)) AS NOTA4,
        						CASE
        						WHEN (AE.atraso) BETWEEN "0" AND "2"       THEN 10
        						WHEN (AE.atraso) BETWEEN "2,01" AND "4"    THEN 3
        						WHEN (AE.atraso) BETWEEN "4,01" AND "7,99" THEN 1
        						WHEN (AE.atraso) BETWEEN "8" AND "20"      THEN 0
        						ELSE 0 END
        						AS	  	                                  NOTA3,
        						MAX(IF(ITEM = "05", NOTAAVALIADOR, 0)) AS NOTA5,
        						MAX(IF(ITEM = "06", NOTAAVALIADOR, 0)) AS NOTA6,
        						MAX(IF(ITEM = "07", NOTAAVALIADOR, 0)) AS NOTA7,
        						MAX(IF(ITEM = "08", NOTAAVALIADOR, 0)) AS NOTA8,
        						MAX(IF(ITEM = "09", NOTAAVALIADOR, 0)) AS NOTA9,
        						MAX(IF(ITEM = "10", NOTAAVALIADOR, 0)) AS NOTA10,
        						MAX(IF(ITEM = "12", NOTAAVALIADOR, 0)) AS NOTA12,
        						MAX(IF(ITEM = "13", NOTAAVALIADOR, 0)) AS NOTA13,
        						MAX(IF(ITEM = "14", NOTAAVALIADOR, 0)) AS NOTA14,
        						MAX(IF(ITEM = "15", NOTAAVALIADOR, 0)) AS NOTA15
         						from notas_temp_todas as todasAsNotas
        						left join assiduidade AS AE on AE.codpessoa = todasAsNotas.CODPESSOA AND AE.codavaliacao = todasAsNotas.AVALIACAO
                    where NOTA != 0
        						GROUP BY AVALIACAO, CODPESSOA
        						ORDER BY AVALIACAO');

        				$total = DB::select(DB::raw('select * from notasPessoaTodas order by CODPESSOA'));
        				$contador = 0;
        				$soma = 0;

        				DB::statement('delete from mediageralano');

        				DB::statement('Drop table if exists feitas');
        				DB::statement('create temporary table feitas
        							select p.CHAPAAVALIADO AS CHAPAAVALIADO,
        								   p.CODPESSOA as CODPESSOA,
        								   f.NOME AS NOME,
        								   p.CODAVALIACAO AS CODAVALIACAO,
        								  (if(n.CODITEMAVAL is not null, 1,0)) as EXISTE
        							from participantes as p
        							inner join funcionarios as f on f.CODPESSOA = p.CODPESSOA
                      inner join avaliacoes as av
                      on av.CODAVALIACAO = p.CODAVALIACAO
                      and av.CODCOLIGADA = p.CODCOLIGADA
        							left join notas as n
                      on n.CODPARTICIPANTE = p.CODPARTICIPANTE
                      and n.CODCOLIGADA = p.CODCOLIGADA
                      and n.CODAVALIACAO = p.CODAVALIACAO
        							where av.DATAABERTURA BETWEEN "'.$di.'"  and "'.$df.'"
        							group by p.CODPESSOA, p.CODAVALIACAO');

        				DB::statement('Drop table if exists totais');
        				DB::statement('Create temporary table totais
        							select count(CODAVALIACAO) AS QTDE, SUM(EXISTE) AS FEITAS, CHAPAAVALIADO,
        				   CODPESSOA, NOME from feitas GROUP BY CODPESSOA');


        				foreach($total as $t){
        					if($t->NOTA1 > 0) {
        						$soma = $soma + $t->NOTA1;
        						$contador++;
        					}
        					if($t->NOTA2 > 0) {
        						$soma = $soma + $t->NOTA2;
        						$contador++;
        					}
        					$soma = $soma + $t->NOTA3; //considerando a assiduidade
        					$contador++; //considerando a assiduidade
        					if($t->NOTA4 > 0) {
        						$soma = $soma + $t->NOTA4;
        						$contador++;
        					}
        					if($t->NOTA5 > 0) {
        						$soma = $soma + $t->NOTA5;
        						$contador++;
        					}
        					if($t->NOTA6 > 0) {
        						$soma = $soma + $t->NOTA6;
        						$contador++;
        					}
        					if($t->NOTA7 > 0) {
        						$soma = $soma + $t->NOTA7;
        						$contador++;
        					}
        					if($t->NOTA8 > 0) {
        						$soma = $soma + $t->NOTA8;
        						$contador++;
        					}
        					if($t->NOTA9 > 0) {
        						$soma = $soma + $t->NOTA9;
        						$contador++;
        					}
        					if($t->NOTA10 > 0) {
        						$soma = $soma + $t->NOTA10;
        						$contador++;
        					}
        					if($t->NOTA12 > 0) {
        						$soma = $soma + $t->NOTA12;
        						$contador++;
        					}
        					if($t->NOTA13 > 0) {
        						$soma = $soma + $t->NOTA13;
        						$contador++;
        					}
        					if($t->NOTA14 > 0) {
        						$soma = $soma + $t->NOTA14;
        						$contador++;
        					}
        					if($t->NOTA15 > 0) {
        						$soma = $soma + $t->NOTA15;
        						$contador++;
        					}
        					$t->mediames = ($soma/$contador);
        					$contador = 0;
        					$soma = 0;


        				DB::table('mediageralano')->insert(
        				array('CODPESSOA'=>$t->CODPESSOA, 'CHAPA'=>$t->CHAPA, 'AVALIACAO'=>$t->AVALIACAO, 'MEDIA'=>$t->mediames, 'NOME'=>$t->NOME, 'FUNCAO'=>$t->FUNCAO, 'AVALIADOR'=>$t->AVALIADOR));

        				}

        				$medias = DB::select('select f.CHAPA as CHAPA,
        				f.NOME as NOME,
        				FUNCAO,
        				f.DATAADMISSAO AS DATAADMISSAO,
        				replace(round(SUM(MEDIA)/COUNT(f.CHAPA),4),".",",") as MEDIA,
        				CASE(f.CODFILIAL)
        				WHEN 1 THEN "PINTOS MAGAZINE"
        				WHEN 3 THEN "PINTOS RIVERSIDE"
        				WHEN 5 THEN "PINTOS RIO BRANCO"
        				WHEN 6 THEN "PINTOS CD1"
        				WHEN 8 THEN "PINTOS CALÇADOS"
        				WHEN 9 THEN "PINTOS FREI SERAFIM"
        				WHEN 10 THEN "PINTOS CD2"
        				WHEN 11 THEN "PINTOS SHOPPING"
        				WHEN 12 THEN "PINTOS RIO POTY" END AS LOJA,
        				f.CODSECAO AS CODSECAO,
        				s.DESCRICAO as SECAO,
        				lider.NOME AS AVALIADOR,
        				(totais.QTDE) AS TOTAL,
        				(totais.FEITAS) AS FEITAS
        				FROM mediageralano
        				inner join funcionarios as f on f.CHAPA = mediageralano.chapa
                inner join funcionarios as lider on lider.CODPESSOA = f.CODEQUIPE
                inner join avaliacoes as av
                on av.CODAVALIACAO = AVALIACAO
        				LEFT JOIN secoes as s on s.CODIGO = f.CODSECAO
        				LEFT JOIN totais on totais.CODPESSOA = mediageralano.CODPESSOA
        				WHERE av.DATAABERTURA BETWEEN "'.$di.'"  and "'.$df.'"
                group by mediageralano.CODPESSOA order by AVALIADOR, MEDIA desc');


              } //fim anoMedia
              else {$total = 0; $medias = 0;}



			return view('admin.avaliacao.media2016Geral', [
			'total' => $total,
			'medias' => $medias,
      'dataInicial' => $di,
      'dataFinal' => $df

			]);


	}

  public function mostraAssiduidade(){

        $todas = Assiduidade::groupBy('ano','mes')->orderBy('ano','mes')->paginate(12);
        //  $todas = DB::table('assiduidade')->groupBy('ano','mes')->get();

          return view('admin.avaliacao.assiduidade.assiduidade', [
          'todas' => $todas

          ]);

  }

  public function insereAssiduidade(){

        //$todas = Assiduidade::groupBy('ano','mes')->orderBy('ano','mes')->paginate(12);
        //  $todas = DB::table('assiduidade')->groupBy('ano','mes')->get();

          $feitas = DB::select('select ava.CODAVALIACAO as cod, ava.NOME as nome
                               from avaliacoes as ava
                               inner join assiduidade as ass
                               on ava.CODAVALIACAO = ass.codavaliacao
                               group by ava.CODAVALIACAO');

          $novas = DB::select('select CAST(ava.CODAVALIACAO AS UNSIGNED)  as cod, ava.NOME as nome
                              from avaliacoes as ava
                              left join assiduidade as ass
                              on ava.CODAVALIACAO = ass.codavaliacao
                              where ass.codavaliacao is null and ava.CODAVALIACAO not in (9, 8,7,6,5,20,24,19,18,1)
                              and ava.DATAABERTURA > "2015-12-31"
                              group by ava.CODAVALIACAO
                              order by ava.CODAVALIACAO desc');

          return view('admin.avaliacao.assiduidade.insere', [
          'feitas' => $feitas,
          'novas' => $novas
          ]);


  }

  public function insereNovaAssiduidade(){
    $codigo = Request::input('novaAvaliacao');

    DB::statement("
                  Insert into assiduidade (codpessoa, atraso, chapa, nota, ano, mes, codavaliacao, idusuario)
                  select at.CODPESSOA as codpessoa,
                         round((at.MINUTOS + FALTA + IFNULL(ab.ABONO,0))/60,1) as atraso,
                         f.CHAPA as chapa,
                          CASE
                              WHEN (at.MINUTOS + FALTA + IFNULL(ab.ABONO,0))/60 BETWEEN 0 AND 1.99    THEN 10
                              WHEN (at.MINUTOS + FALTA + IFNULL(ab.ABONO,0))/60 BETWEEN 2 AND 4     THEN 3
                              WHEN (at.MINUTOS + FALTA + IFNULL(ab.ABONO,0))/60 BETWEEN 4.01 AND 8 	THEN 1
                              WHEN (at.MINUTOS + FALTA + IFNULL(ab.ABONO,0))/60 BETWEEN 8.1 AND 100   THEN 0
                              ELSE 0 END
                           AS	nota,
                          at.ANO as ano,
                          at.MES as mes,
                          av.CODAVALIACAO as codavaliacao,
                          3 as idusuario
                          from atrasosfaltas as at
                  left join abonoslancados as ab
                  on ab.CODPESSOA = at.CODPESSOA and at.ANO = ab.ANO and at.MES = ab.MES
                  inner join avaliacoes as av on at.ANO = YEAR(DATAABERTURA) and at.MES = MONTH(DATAABERTURA)
                  inner join funcionarios as f on f.CODPESSOA = at.codpessoa
                  where CODSITUACAO <> 'D' and av.CODAVALIACAO = ".$codigo."
                  group by at.CODPESSOA, at.ANO, at.MES, at.CODPESSOA;
    ");
    DB::statement("
                  insert into assiduidade(codpessoa, atraso, chapa, nota, ano, mes, codavaliacao, idusuario)
                  select p.CODPESSOA as codpessoa,
                   0 as atraso,
                   p.CHAPAAVALIADO as chapa,
                   10 as nota,
                   YEAR(DATAABERTURA) as ano,
                   MONTH(DATAABERTURA) as mes,
                   p.CODAVALIACAO as codavaliacao,
                   3 as idusuario
                  from participantes as p
                  left join assiduidade as a
                  on a.codpessoa = p.CODPESSOA
                  and a.codavaliacao = p.CODAVALIACAO
                  inner join avaliacoes as av
                  on av.CODCOLIGADA = p.CODCOLIGADA
                  and av.CODAVALIACAO = p.CODAVALIACAO
                  where p.CODAVALIACAO = ".$codigo." and a.codpessoa is null;
    ");

  return redirect()->intended(route('mostraAssiduidade'))->withInput()->with('status' , 'Assiduidade inserida com sucesso');



  }

  public function atualizaAssiduidade(){
    $codigo = Request::input('atualizaAvaliacao');

    DB::statement("delete from assiduidade where codavaliacao = ".$codigo);
    DB::statement("
                  Insert into assiduidade (codpessoa, atraso, chapa, nota, ano, mes, codavaliacao, idusuario)
                  select at.CODPESSOA as codpessoa,
                         round((at.MINUTOS + FALTA + IFNULL(ab.ABONO,0))/60,1) as atraso,
                         f.CHAPA as chapa,
                          CASE
                              WHEN (at.MINUTOS + FALTA + IFNULL(ab.ABONO,0))/60 BETWEEN 0 AND 1.99    THEN 10
                              WHEN (at.MINUTOS + FALTA + IFNULL(ab.ABONO,0))/60 BETWEEN 2 AND 4     THEN 3
                              WHEN (at.MINUTOS + FALTA + IFNULL(ab.ABONO,0))/60 BETWEEN 4.01 AND 8 	THEN 1
                              WHEN (at.MINUTOS + FALTA + IFNULL(ab.ABONO,0))/60 BETWEEN 8.1 AND 100   THEN 0
                              ELSE 0 END
                           AS	nota,
                          at.ANO as ano,
                          at.MES as mes,
                          av.CODAVALIACAO as codavaliacao,
                          3 as idusuario
                          from atrasosfaltas as at
                  left join abonoslancados as ab
                  on ab.CODPESSOA = at.CODPESSOA and at.ANO = ab.ANO and at.MES = ab.MES
                  inner join avaliacoes as av on at.ANO = YEAR(DATAABERTURA) and at.MES = MONTH(DATAABERTURA)
                  inner join funcionarios as f on f.CODPESSOA = at.codpessoa
                  where CODSITUACAO <> 'D' and av.CODAVALIACAO = ".$codigo."
                  group by at.CODPESSOA, at.ANO, at.MES, at.CODPESSOA;
    ");
    DB::statement("
                  insert into assiduidade(codpessoa, atraso, chapa, nota, ano, mes, codavaliacao, idusuario)
                  select p.CODPESSOA as codpessoa,
                   0 as atraso,
                   p.CHAPAAVALIADO as chapa,
                   10 as nota,
                   YEAR(DATAABERTURA) as ano,
                   MONTH(DATAABERTURA) as mes,
                   p.CODAVALIACAO as codavaliacao,
                   3 as idusuario
                  from participantes as p
                  left join assiduidade as a
                  on a.codpessoa = p.CODPESSOA
                  and a.codavaliacao = p.CODAVALIACAO
                  inner join avaliacoes as av
                  on av.CODCOLIGADA = p.CODCOLIGADA
                  and av.CODAVALIACAO = p.CODAVALIACAO
                  where p.CODAVALIACAO = ".$codigo." and a.codpessoa is null;
    ");



    return redirect()->intended(route('mostraAssiduidade'))->withInput()->with('status' , 'Assiduidade inserida com sucesso');



  }

}
