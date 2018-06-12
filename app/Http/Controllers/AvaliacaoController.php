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
use App\Licenciado;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Database\QueryException;
//use Illuminate\Support\Facades\Mail;
use Mail;


class AvaliacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


	public function cron(){

	$process = new Process('ls -lsa');
	$process->run();
	if (!$process->isSuccessful()) {
		throw new ProcessFailedException($process);
	}

	$resultado = $process->getOutput();

	return view('/cron');

	}

    public function index()
    {
        $usuario = Sentinel::getUser()->codequipe;
        $erro = 0;$teste = 0;  $todos = 0; $abertas=0; $fechadas=0; $ver= 0;
        $chefe = Sentinel::getUser()->chapa;
				$lider = Funcionario::where('CHAPA', '=', $chefe)->get();
				$chapa = Sentinel::getUser()->chapa;

        if (!Sentinel::getUser()->chapa or !Sentinel::getUser()->codequipe)
        {
					$erro = "A chapa ou código da equipe do lider não está preenchida no cadastro da Intranet.
					O dado é necessário para prosseguir. Entre em contato com o responsável pelas avaliações no setor de Recursos Humanos.";
				}
				if (Sentinel::getUser()->chapa and Sentinel::getUser()->codequipe) {


			$todos =  DB::select('select E.NOME AS NOME,
								  E.CHAPA AS CHAPA,
								  E.DATAADMISSAO AS DATAADMISSAO,
								  C.NOME AS CARGO,
								  E.DATADEMISSAO AS DATADEMISSAO,
								  E.CODFILIAL AS CODFILIAL,
								  E.CODPESSOA AS CODPESSOA
								  from funcionarios as E
								  inner join funcoes AS C on C.CODIGO = E.CODFUNCAO
								  where CODEQUIPE = '.$usuario.' and DATADEMISSAO is null order by E.NOME');

			$delegacao =  DB::select('select E.NOME AS NOME,
								  E.CHAPA AS CHAPA,
								  E.DATAADMISSAO AS DATAADMISSAO,
								  C.NOME AS CARGO,
								  E.DATADEMISSAO AS DATADEMISSAO,
								  E.CODFILIAL AS CODFILIAL,
								  E.CODPESSOA AS CODPESSOA
								  from funcionarios as E
								  inner join funcoes AS C on C.CODIGO = E.CODFUNCAO
								  where CODEQUIPE = '.$usuario.' order by E.NOME');

			/*$abertas = DB::select('select DATAABERTURA, NOME, A.CODAVALIACAO AS CODAVALIACAO, 0 AS valor
								  from avaliacoes as A
								  inner join veravaliacoes AS V on A.CODAVALIACAO = V.codigoavaliacao
								  inner join participantes AS P ON P.CODAVALIACAO = A.CODAVALIACAO AND P.CODCOLIGADA = A.CODCOLIGADA
								  where statuslider = 0 and CHAPAAVALIADOR = '.$chapa.' and DATAFECHAMENTO is null group by A.CODAVALIACAO');


			foreach($abertas as $aberta){
				$testa = DB::select('select sum(if(LICENCA ="S" OR NOTA="S",0, 1)) AS valor, CODAVALIACAO from testaavaliacao
							where AVALIADOR = '.$chapa.' AND CODAVALIACAO = '.$aberta->CODAVALIACAO.' and CODAVALIACAO > 36
							group by CODAVALIACAO, AVALIADOR; ');
				foreach ($testa as $t) {
					$aberta->valor = $t->valor;
				}



			}*/
			$abertas = DB::select('select A.DATAABERTURA as DATAABERTURA, A.NOME as NOME,
									A.CODAVALIACAO AS CODAVALIACAO, sum(if(LICENCA ="S" OR NOTA="S",0, 1)) AS valor
								  from avaliacoes as A
								  inner join veravaliacoes AS V on A.CODAVALIACAO = V.codigoavaliacao
								  inner join participantes AS P ON P.CODAVALIACAO = A.CODAVALIACAO
                                    AND P.CODCOLIGADA = A.CODCOLIGADA
                                  INNER JOIN testaavaliacao AS T on T.CODAVALIACAO = A.CODAVALIACAO
                                    AND T.AVALIADOR = CHAPAAVALIADOR
                                    AND T.NOME = A.NOME
								  where statuslider = 0 and CHAPAAVALIADOR = '.$chapa.' and DATAFECHAMENTO is null
                                  group by A.CODAVALIACAO');


			$feitos = DB::select('
							select
							F.NOME AS NOME, A.CHAPAAVALIADO AS CHAPA, A.CHAPAAVALIADOR AS CHAPAAVALIADOR,
							IF(SUM(N.NOTAAVALIADOR)>0,"S","N")   AS TEMAVALIACAO,
						    LICENCA                              AS LICENCA,
						    A.CODAVALIACAO                       AS CODAVALIACAO,
						    AVA.DATAABERTURA                     AS DATAABERTURA
							From participantes as A
 							inner join funcionarios AS F
 							on F.CHAPA = A.CHAPAAVALIADO
 							left join notas AS N
 							on N.CODPARTICIPANTE = A.CODPARTICIPANTE and N.CODAVALIACAO = A.CODAVALIACAO
							left join licenciados AS L
							ON A.CODPARTICIPANTE = L.CODPARTICIPANTE AND A.CODAVALIACAO = L.CODAVALIACAO
							INNER JOIN avaliacoes as AVA ON AVA.CODAVALIACAO = A.CODAVALIACAO AND AVA.CODCOLIGADA = A.CODCOLIGADA
 							where N.CODPARTICIPANTE is not null
 							AND A.CHAPAAVALIADOR = '.$chefe.' and A.CODCOLIGADA = 1 and L.LICENCA is null
  							GROUP BY (N.CODPARTICIPANTE)');

				$mostra = array();
			/*	foreach ($abertas as $a) {
				foreach ($feitos as $feito) {

						if($a->CODAVALIACAO == $feito->CODAVALIACAO){

							if($feito->TEMAVALIACAO=='N' and $feito->LICENCA=='N'){
								$passagem = new \stdClass();
								$passagem->CODAVALIACAO = $feito->CODAVALIACAO;
								$passagem->COMPLETO = 'N';
								array_push($mostra, $passagem);
							}
						}
					}
				}*/


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
					'delegacao' =>$delegacao,
					//'passagem' => $mostra,
					'ver' => $ver
         ]);


    }


	public function painel()
    {
    $usuario = Sentinel::getUser()->codequipe;
		$chefe = Sentinel::getUser()->chapa;
		$lider = Funcionario::where('CHAPA', '=', $chefe)->get();
		$id = Request::input('id');

		$grupo = '';


		if ($chefe == $id)
			$perm = "Você não pode ver suas próprias notas! =(";
		if ($chefe <> $id)
		    $perm = '0';

		$compfuncao = DB::select('select * from vercargos AS V
								  inner join funcionarios AS F on V.codcargo = F.CODFUNCAO
								  where F.CHAPA = '.$id);


		$todos =  DB::select('select E.NOME AS NOME,
							  E.CHAPA AS CHAPA,
							  E.DATAADMISSAO AS DATAADMISSAO,
							  C.NOME AS CARGO
							  from funcionarios as E
		                      inner join funcoes AS C on C.CODIGO = E.CODFUNCAO
							  where CODEQUIPE = '.$usuario.' and DATADEMISSAO is null order by E.NOME');

		$delegacao =  DB::select('select E.NOME AS NOME,
								  E.CHAPA AS CHAPA,
								  E.DATAADMISSAO AS DATAADMISSAO,
								  C.NOME AS CARGO,
								  E.DATADEMISSAO AS DATADEMISSAO,
								  E.CODFILIAL AS CODFILIAL,
								  E.CODPESSOA AS CODPESSOA
								  from funcionarios as E
								  inner join funcoes AS C on C.CODIGO = E.CODFUNCAO
								  where CODEQUIPE = '.$usuario.' order by E.NOME');


		$funcionario =  DB::select('select E.NOME AS NOME,
							  E.CHAPA AS CHAPA,
							  E.DATAADMISSAO AS DATAADMISSAO,
							  C.NOME AS CARGO,
							  I.IMAGEM AS IMAGEM
							  from funcionarios as E
		                      inner join funcoes AS C on C.CODIGO = E.CODFUNCAO
							  left join pessoas AS P on P.CODIGO = E.CODPESSOA
							  left join fotos AS I on P.IDIMAGEM = I.IDIMAGEM
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
								P.CHAPAAVALIADOR  AS AVALIADOR,
								P.CODPESSOA       AS CODPESSOA,
								YEAR(V.DATAABERTURA) AS ANO
								from notas AS N
								inner join participantes AS P on N.CODAVALIACAO = P.CODAVALIACAO and N.CODPARTICIPANTE = P.CODPARTICIPANTE
								inner JOIN competencias AS S ON N.CODITEMAVAL = S.CODCOMPETENCIA
								inner JOIN avaliacoes AS  V ON V.CODAVALIACAO = N.CODAVALIACAO
								inner JOIN veravaliacoes AS VAV on V.CODAVALIACAO = VAV.codigoavaliacao
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
						notas_temp.ANO AS ANO,
						MAX(IF(ITEM = "01", notas_temp.NOTA, 0)) AS NOTA1,
						MAX(IF(ITEM = "01", OBS, " - "))  AS OBS1,
						MAX(IF(ITEM = "02", notas_temp.NOTA, 0)) AS NOTA2,
						CASE
						WHEN (AE.atraso) BETWEEN "0" AND "1,99"    THEN 10
						WHEN (AE.atraso) BETWEEN "2,0" AND "4"     THEN 3
						WHEN (AE.atraso) BETWEEN "4,01" AND "8" 	 THEN 1
						WHEN (AE.atraso) BETWEEN "8,1" AND "100"   THEN 0
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
						ORDER BY AVALIACAO*1');

						$anos = DB::select('select ANO
																from notas_temp group by ANO');


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

								$aa = 0;
								}

	    return view('/avaliacao/painel', [
            'lider' => $lider,
            'notas' => $notas,
						'anos' => $anos,
						'funcionario' => $funcionario,
						'resultado' => $resultado,
						'compfuncao' => $compfuncao,
						'perm' => $perm,
						'qt' => $qt,
						'aa' => $aa,
						'm' => 0,
						'licenciados' => $licenciados,
						'licencas' => $licencas,
						'delegacao' => $delegacao


         ]);
    }

    public function mostra()
    {
		$id = Request::input('id');
		$participante = Request::input('pt');
		$usuario = Sentinel::getUser()->codequipe;
		$chefe = Sentinel::getUser()->chapa;
		$lider = Funcionario::where('CHAPA', '=', $chefe)->get();
		//$licenciados = Licenciado::where('CODAVALIACAO', '=', $id)->get();

		$avaliacao = Avaliacao::where('CODAVALIACAO', '=', $id)->get();

		$participantes = DB::select('
									select *
									from participantes as A
									inner join funcionarios AS F
									on F.CHAPA = A.CHAPAAVALIADO
									left join licenciados AS L
									ON A.CODPARTICIPANTE = L.CODPARTICIPANTE AND A.CODAVALIACAO = L.CODAVALIACAO
									where A.CODCOLIGADA = 1 and A.CODAVALIACAO = '.$id.' and CHAPAAVALIADOR = '.$chefe);

		$licenciados = DB::select('
									select DTINICIAL, DTFINAL, F.NOME AS FUNCIONARIO, F.CHAPA AS CHAPA
									from participantes as A
									inner join funcionarios AS F
									on F.CHAPA = A.CHAPAAVALIADO
									left join licenciados AS L
									ON A.CODPARTICIPANTE = L.CODPARTICIPANTE AND A.CODAVALIACAO = L.CODAVALIACAO
									where L.LICENCA = "S" AND A.CODCOLIGADA = 1 and A.CODAVALIACAO = '.$id.' and CHAPAAVALIADOR = '.$chefe);


		$equipe =  DB::select('select *
							  from participantes as P
		                      inner join funcionarios AS F on P.CHAPAAVALIADO = F.CHAPA
							  where P.CODCOLIGADA = 1 and F.CODEQUIPE = '.$usuario.' AND CODAVALIACAO = '.$id.' order by F.NOME');

		$invalidos =  DB::select('select *
							  from funcionarios as F
		                      left join participantes AS P on (P.CHAPAAVALIADO = F.CHAPA) AND CODAVALIACAO = '.$id.'
							  where F.CODCOLIGADA = 1 and F.CODEQUIPE = '.$usuario.' and CHAPAAVALIADO is null  order by F.NOME');

		$feitos = DB::select('
							select
							F.NOME AS NOME, A.CHAPAAVALIADO AS CHAPA, A.CHAPAAVALIADOR AS CHAPAAVALIADOR,
							IF(SUM(N.NOTAAVALIADOR)>0,"S","N")   AS TEMAVALIACAO,
						    LICENCA                              AS LICENCA
							From participantes as A
 							inner join funcionarios AS F
 							on F.CHAPA = A.CHAPAAVALIADO
 							left join notas AS N
 							on N.CODPARTICIPANTE = A.CODPARTICIPANTE and N.CODAVALIACAO = A.CODAVALIACAO
							left join licenciados AS L
							ON A.CODPARTICIPANTE = L.CODPARTICIPANTE AND A.CODAVALIACAO = L.CODAVALIACAO
 							where  A.CODAVALIACAO = '.$id.' and N.CODPARTICIPANTE is not null
 							AND A.CHAPAAVALIADOR = '.$chefe.' and A.CODCOLIGADA = 1 and L.LICENCA is null
  							GROUP BY (N.CODPARTICIPANTE)');

	/*	$faltantes = DB::select('select * From participantes as A
							  inner join funcionarios AS F
								on F.CHAPA = A.CHAPAAVALIADO
							  left join notas AS N
								on N.CODPARTICIPANTE = A.CODPARTICIPANTE and N.CODAVALIACAO = A.CODAVALIACAO
								where DATADEMISSAO is null and A.CODAVALIACAO = '.$id.' and N.CODPARTICIPANTE is null
								GROUP BY (N.CODPARTICIPANTE)
								');
		*/


		$faltantes = DB::select('
								select
								F.NOME as NOME,
								F.CHAPA  AS CHAPA,
								A.CODAVALIACAO AS CODAVALIACAO,
								A.CODPARTICIPANTE AS CODPARTICIPANTE,
								A.CHAPAAVALIADOR  AS CHAPAAVALIADOR,
								A.CHAPAAVALIADO   AS CHAPAAVALIADO
								From participantes as A
							  inner join funcionarios AS F
								on F.CHAPA = A.CHAPAAVALIADO
							  left join notas AS N
								on N.CODPARTICIPANTE = A.CODPARTICIPANTE
								and N.CODAVALIACAO = A.CODAVALIACAO
                                and A.CODCOLIGADA = N.CODCOLIGADA
                              inner join avaliacoes as AV
                                ON AV.CODCOLIGADA = A.CODCOLIGADA
                                AND AV.CODAVALIACAO = A.CODAVALIACAO
                                left join licenciados AS L
                                ON A.CODPARTICIPANTE = L.CODPARTICIPANTE AND A.CODAVALIACAO = L.CODAVALIACAO
							  where A.CODAVALIACAO = '.$id.'
							     and A.CHAPAAVALIADOR = '.$chefe.'
							     AND N.NOTAAVALIADOR is null
							     and A.CODCOLIGADA = 1
							     and (DATADEMISSAO is null or DATADEMISSAO >= DATAABERTURA)
                                 and L.LICENCA is null
							  group by A.CODPARTICIPANTE
						');

		$testaAvaliacao = DB::select('select F.CHAPA                              AS CHAPA,
						   F.NOME                               AS NOME,
						   MAX(P.CODPARTICIPANTE)               AS CODPARTICIPANTE,
						   P.CODAVALIACAO                       AS CODAVALIACAO,
						   A.NOME                               AS NOMEAVALIACAO,
						   P.CHAPAAVALIADOR                     AS CHAPAAVALIADOR,
						   L.NOME                               AS NOMELIDER,
						   IF(SUM(N.NOTAAVALIADOR)>0,"S","N")   AS TEMAVALIACAO,
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
					where A.DATAABERTURA > 20151231 and A.CODAVALIACAO > 24 and P.CHAPAAVALIADOR = '.$chefe.'
					GROUP BY P.CODPARTICIPANTE
					ORDER BY A.CODAVALIACAO DESC;');

		return view('avaliacao.mostra', [
			'avaliacao' => $avaliacao,
			'lider' => $lider,
			'participantes' => $participantes,
			'equipe' => $equipe,
			'feitos' => $feitos,
			'invalidos' => $invalidos,
			'faltantes' => $faltantes,
			'id' => $id,
			'chefe' => $chefe,
			'usuario' => $usuario,
			'licenciados' => $licenciados
		]);
    }


    public function insere()
    {
		$comps = Competencia::all();
		$chefe = Sentinel::getUser()->chapa;
		$id = Request::input('id');
		$pt = Request::input('pt');
		$usuario = Sentinel::getUser()->codequipe;
		$avaliacao = Avaliacao::where('CODAVALIACAO', '=', $id)->get();
		$lider = Funcionario::where('CODPESSOA', '=',$usuario)->whereNull('DATADEMISSAO')->get();
		$ch = Participante::where('CODPARTICIPANTE','=',$pt)->get();
		$chapa = $ch[0]->CHAPAAVALIADO;
		$avaliado = Funcionario::where('CHAPA', '=', $chapa)->get();



		$compfuncao = DB::select('select * from vercargos AS V
								  inner join funcionarios AS F on V.codcargo = F.CODFUNCAO
								  where F.CHAPA = '.$chapa);



		$participante = $participante = DB::select('select *
									from participantes as A
									inner join funcionarios AS F
									on F.CHAPA = A.CHAPAAVALIADO
									where CODAVALIACAO = '.$id.' and CODPARTICIPANTE = '.$pt);

		$feitos = DB::select('select * From participantes as A
							  inner join funcionarios AS F
								on F.CHAPA = A.CHAPAAVALIADO
							  left join notas AS N
								on N.CODPARTICIPANTE = A.CODPARTICIPANTE and N.CODAVALIACAO = A.CODAVALIACAO
								where A.CODAVALIACAO = '.$id.' and N.CODPARTICIPANTE is not null
								AND A.CHAPAAVALIADOR = '.$chefe.'
								GROUP BY (N.CODPARTICIPANTE)');

		$faltantes = DB::select('select
								F.NOME as NOME,
								F.CHAPA  AS CHAPA,
								A.CODAVALIACAO AS CODAVALIACAO,
								A.CODPARTICIPANTE AS CODPARTICIPANTE,
								A.CHAPAAVALIADOR  AS CHAPAAVALIADOR,
								A.CHAPAAVALIADO   AS CHAPAAVALIADO
								From participantes as A
							  inner join funcionarios AS F
								on F.CHAPA = A.CHAPAAVALIADO
							  left join notas AS N
								on N.CODPARTICIPANTE = A.CODPARTICIPANTE
								and N.CODAVALIACAO = A.CODAVALIACAO
                                and A.CODCOLIGADA = N.CODCOLIGADA
							  where A.CODAVALIACAO = '.$id.'
							     and A.CHAPAAVALIADOR = '.$chefe.'
							     AND N.NOTAAVALIADOR is null
							  group by A.CODPARTICIPANTE
						');

		$invalidos =  DB::select('select *
							  from funcionarios as F
		                      left join participantes AS P on (P.CHAPAAVALIADO = F.CHAPA) AND CODAVALIACAO = '.$id.'
							  where DATADEMISSAO is null and F.CODEQUIPE = '.$usuario.' and CHAPAAVALIADO is null  order by F.NOME');


		$imagem = DB::select('select * from fotos
				inner join funcionarios on funcionarios.CODPESSOA = fotos.CODPESSOA
				where funcionarios.CHAPA ='.$chapa );

		if(isset($compfuncao[0]->c1)) { $c1 = $compfuncao[0]->c1; }
		if(isset($compfuncao[0]->c2)) { $c2 = $compfuncao[0]->c2; }



      return view('avaliacao.insere', [
			'comps' => $comps,
			'lider' => $lider,
			'comps' => $comps,
			'avaliado' => $avaliado,
			'id' => $id,
			'contador' => 1,
			'avaliacao' => $avaliacao,
			'participante' => $participante,
			'feitos' => $feitos,
			'faltantes' => $faltantes,
			'invalidos' => $invalidos,
			'imagem' =>$imagem,
			'compfuncao' => $compfuncao,
			'pt' => $pt,
			'd1' => $compfuncao[0]->c1,
			'd2' => $compfuncao[0]->c2,
			'd3' => $compfuncao[0]->c3,
			'd4' => $compfuncao[0]->c4,
			'd5' => $compfuncao[0]->c5,
			'd6' => $compfuncao[0]->c6,
			'd7' => $compfuncao[0]->c7,
			'd8' => $compfuncao[0]->c8,
			'd9' => $compfuncao[0]->c9,
			'd10' => $compfuncao[0]->c10,
			'd11' => $compfuncao[0]->c11,
			'd12' => $compfuncao[0]->c12,
			'd13' => $compfuncao[0]->c13,
			'd14' => $compfuncao[0]->c14,
			'd15' => $compfuncao[0]->c15,
			'seq' => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15],
			'i' =>1
		]);
    }


	 public function inserenota()
    {
		$id = Request::input('avaliacao');
		$pt = Request::input('participante');
		$id1 = Request::input('id1');
		$id2 = Request::input('id2');
		$id3 = Request::input('id3');
		$id4 = Request::input('id4');
		$id5 = Request::input('id5');
		$id6 = Request::input('id6');
		$id7 = Request::input('id7');
		$id8 = Request::input('id8');
		$id9 = Request::input('id9');
		$id10 = Request::input('id10');
		$id11 = Request::input('id11');
		$id12 = Request::input('id12');
		$id13 = Request::input('id13');
		$id14 = Request::input('id14');
		$id15 = Request::input('id15');
		$NOTAS = [0,$id1, $id2,$id3,$id4, $id5, $id6, $id7, $id8, $id9, $id10, $id11, $id12, $id13, $id14, $id15];
		$COMENTARIOS = [0,Request::input('obs1'),Request::input('obs2'),Request::input('obs3'),Request::input('obs4'),Request::input('obs5'),
		Request::input('obs6'),Request::input('obs7'),Request::input('obs8'),Request::input('obs9'),Request::input('obs10'),
		Request::input('obs11'),Request::input('obs12'),Request::input('obs13'),Request::input('obs14'),Request::input('obs15')];


		$i = 1 ;
		$now = date("Y-m-d");
		$chefe = Sentinel::getUser()->chapa;

		while( $i < 16 )
		{

			$competencia = Request::input('$concat');

			try{
			        DB::statement('insert into notas (CODPARTICIPANTE, CODAVALIACAO, CODITEMAVAL, CODCOLIGADA, created_at,
							PESOITEMAVAL, NOTAAVALIADOR, COMENTARIO, RECCREATEDBY) VALUES
							(' .$pt.' , '.$id.' , '.$i.' , 1,  '.$now.' ,1 , '.$NOTAS[$i].' , " '. $COMENTARIOS[$i] .' " , "luiza.senna")');
			    }
			    catch (QueryException $e){
			        $error_code = $e->errorInfo[1];
			        if($error_code == 1062){
			           return redirect()->intended('avaliacao/mostra?id='.$id)->withInput()->with('status' , 'Calma, Você já inseriu esta Avaliação, não é possível inseri-la novamente. =)');
			            //return 'houston, we have a duplicate entry problem';
			        }
			    }

			$i++;
			}

		$usuario = Sentinel::getUser()->codequipe;

		$lider = Funcionario::where('CHAPA', '=', $chefe)->get();

		$avaliacao = Avaliacao::where('CODAVALIACAO', '=', $id)->get();

		$participantes = DB::select('select *
									from participantes as A
									inner join funcionarios AS F
									on F.CHAPA = A.CHAPAAVALIADO
									where CODAVALIACAO = '.$id.' and CHAPAAVALIADOR = '.$chefe);

		$equipe =  DB::select('select *
							  from participantes as P
		                      inner join funcionarios AS F on P.CHAPAAVALIADO = F.CHAPA
							  where F.CODEQUIPE = '.$usuario.' AND CODAVALIACAO = '.$id.' order by F.NOME');

		$feitos = DB::select('select * From participantes as A
							  inner join funcionarios AS F
								on F.CHAPA = A.CHAPAAVALIADO
							  left join notas AS N
								on N.CODPARTICIPANTE = A.CODPARTICIPANTE and N.CODAVALIACAO = A.CODAVALIACAO
								where DATADEMISSAO is null and A.CODAVALIACAO = '.$id.' and N.CODPARTICIPANTE is not null
								AND A.CHAPAAVALIADOR = '.$chefe.'
								GROUP BY (N.CODPARTICIPANTE)');

		$faltantes = DB::select('select
								F.NOME as NOME,
								F.CHAPA  AS CHAPA,
								A.CODAVALIACAO AS CODAVALIACAO,
								A.CODPARTICIPANTE AS CODPARTICIPANTE,
								A.CHAPAAVALIADOR  AS CHAPAAVALIADOR,
								A.CHAPAAVALIADO   AS CHAPAAVALIADO
								From participantes as A
							  inner join funcionarios AS F
								on F.CHAPA = A.CHAPAAVALIADO
							  left join notas AS N
								on N.CODPARTICIPANTE = A.CODPARTICIPANTE
								and N.CODAVALIACAO = A.CODAVALIACAO
                                and A.CODCOLIGADA = N.CODCOLIGADA
							  where DATADEMISSAO is null
							     and A.CODAVALIACAO = '.$id.'
							     and A.CHAPAAVALIADOR = '.$chefe.'
							     AND N.NOTAAVALIADOR is null
							  group by A.CODPARTICIPANTE
						');

		$invalidos =  DB::select('select *
							  from funcionarios as F
		                      left join participantes AS P on (P.CHAPAAVALIADO = F.CHAPA) AND CODAVALIACAO = '.$id.'
							  where DATADEMISSAO is null and F.CODEQUIPE = '.$usuario.' and CHAPAAVALIADO is null  order by F.NOME');

								$part = Participante::where('CODPARTICIPANTE','=',Request::input('participante'))->get();
								$func = Funcionario::where('CHAPA','=',$part[0]->CHAPAAVALIADO)->get();
								$data = [
										'avaliacao' => $avaliacao[0]->NOME,
										'avaliador' => $chefe,
										'nomeavaliado' => $func[0]->NOME,
										'chapaavaliado' => $func[0]->CHAPA
								];

								$emails = array(Sentinel::getUser()->email, "luiza@pintos.com.br");


								Mail::send('emails.avaliacaofeita', ["data1"=>$data], function($message) use($emails){
										//$message->to(Sentinel::getUser()->email, Sentinel::getUser()->first_name)
														//$message->subject('Avaliação Feita');
														foreach ($emails as $email) {
									            		$message->to($email, Sentinel::getUser()->first_name)
																					->subject('Avaliação Feita');
									        	}

								});



		return redirect()->intended('avaliacao/mostra?id='.$id)->withInput()->with('status' , 'Nota adicionada com sucesso');

    }


    public function valida()
    {
        return view('avaliacao.valida');
    }

	public function paineladmin(){

			//$avaliacoes = Avaliacao::all();
			$avaliacoes = DB::select('select * from avaliacoes as a
									inner join veravaliacoes as v
									on a.CODAVALIACAO = v.codigoavaliacao
									where statusadmin = 0;');

			$usuario = Sentinel::getUser();

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

			//$funcionarios = DB::select('select * from funcionarios where DATADEMISSAO is null')->paginate(15);

			$funcionarios = Funcionario::whereNull('DATADEMISSAO')->paginate(15);

			return view('admin.avaliacao.painel', [
			'avaliacoes' => $avaliacoes,
			'usuario' => $usuario,
			'porcento' => $porcento,
			'funcionarios' => $funcionarios

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

	public function verEquipes() {


		$equipes = DB::table('equipes')->distinct()->orderBy('DESCRICAO')->get();

		return view('admin.avaliacao.delegacao', [

				'equipes' => $equipes,
				'id' => '1'
				]);
		}

		function verTime($codequipe){

			//$codequipe = Request::input('ce');
			$mostraTime = DB::table('funcionarios')->where('CODEQUIPE', '=', $codequipe)->orderBy('DESCRICAO')->get();

			return view('admin.avaliacao.equipe', [
				'id' => '1',
				'mostraTime' => $mostraTime

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


    public function delegaUma(){

		$a = Request::input('id');
		$p = Request::input('pt');
		$c = Request::input('c');

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
					where A.CODAVALIACAO = ".$a." and P.CODPARTICIPANTE = ".$p."
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
									  where E.CHAPA = '.$c);

		  return view('/avaliacao/delegaUma', [
            'a' => $a,
            'p' => $p,
            'avaliacao' => $avaliacao,
            'lideres' => $lideres,
            'funcionario' => $funcionario,
            'c' => $c
            ]);
		}


	 public function delegaUmaAvaliacao(){
		$a = Request::input('a');
		$p = Request::input('p');
		$avaliador = Request::input('avaliador');
		$obs = Request::input('obs');
		$user = Sentinel::getUser()->id;
		$aa = Request::input('chapaantigoavaliador');
		$av = Request::input('avaliacao');
		$xyz = Request::input('xyz');


		DB::statement('update participantes set CHAPAAVALIADOR = '."$avaliador".' Where CODAVALIACAO = '.$a.' AND CODPARTICIPANTE = '.$p.';');
		DB::statement('insert into delegacoes (user, codigoavaliacao, obs, created_at, updated_at, chapaavaliado, chapaantigoavaliador, chapanovoavaliador)
				values ('.$user.','.$av.',"'.$obs.'","'.date("Y-m-d H:i:s").'","'.date("Y-m-d H:i:s").'","'.$xyz.'",'.$aa.','.$avaliador.')');


	 return redirect()->intended('/avaliacao/mostra?id='.$a)->withInput()->with('status' , 'Avaliador(a) alterado(a) com sucesso');

		}

	public function delegaTodas(){

			$xyz = Request::input('c');

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

		return view('/avaliacao/delegaTodas', [
				'avaliado' => $avaliado,
				'lideres' => $lideres,
				'funcionario' => $funcionario,
				'xyz' => $xyz,
				'contador' => 1
				 ]);

		}

    public function delegaVarias(){

		$c = Request::input('c');
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
			$av = Request::input('avaliacao');
			if ($a > 0){
				DB::statement('update participantes set CHAPAAVALIADOR = '.$avaliador.' Where CODPARTICIPANTE = '.$a.';');
				DB::statement('insert into delegacoes (user, codigoavaliacao, obs, created_at, updated_at, chapaavaliado, chapaantigoavaliador, chapanovoavaliador)
					values ('.$user.','.$av.',"'.$obs.'","'.date("Y-m-d H:i:s").'","'.date("Y-m-d H:i:s").'","'.$c.'",'.$aa.','.$avaliador.')');

				}
			$i++;
			}

		return redirect()->intended('/avaliacao/painel?id='.$c)->withInput()->with('status' , 'Avaliador(a) alterado(a) com sucesso. Você continuará como líder desta pessoa,
		porém as avaliações serão feitas por outra pessoa. Para a mudança definitiva, contatar RH paras futuras avaliações.');

		}

    public function avaliado(){

    	$c = Request::input('id');
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


			return view('/avaliacao/avaliado', [
				'avaliado' => $avaliado,
				'notas' => $notas,
				'funcionario' => $funcionario,
				'resultado' => $resultado,
				'status' => 'status'
			 ]);

    }

}
