<?php namespace App\Http\Controllers;


use App\Http\Controllers\Controller;

use App\Nota;
use Carbon\Carbon;
use Lang;

use Illuminate\Support\Facades\Request;
use Sentinel;
use Illuminate\Support\Facades\DB;
use App\Funcionario;
use App\Funcao;
use App\Avaliacao;
use App\Participante;
use App\Competencia;


class NotasController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//$notas = Nota::all()->get();
		$usuario = Sentinel::getUser()->codequipe;
		$notas =  DB::select('select * from notas limit 100');
		return view('admin.notas.index', [
			'notas' => $notas,
			'usuario' => $usuario
		]);
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.notas.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		nota::create($request->all());
		return redirect('admin/notas')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$nota = Nota::findOrFail($id);
		return view('admin.notas.show', compact('nota'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$nota = Nota::findOrFail($id);
		return view('admin.notas.edit', compact('nota'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$nota = Nota::findOrFail($id);
		$nota->update($request->all());
		return redirect('admin/notas')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Nota.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error = '';
            $model = '';
            $confirm_route =  route('admin.notas.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    	}

    	/**
    	 * Delete the given Nota.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
    		$nota = Nota::destroy($id);

            // Redirect to the group management page
            return redirect('admin/notas')->with('success', Lang::get('message.success.delete'));

    	}

}
