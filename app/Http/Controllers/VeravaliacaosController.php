<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Veravaliacao;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;
use App\User;

class VeravaliacaosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$veravaliacaos = Veravaliacao::latest()->get();
		return view('admin.veravaliacaos.index', compact('veravaliacaos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.veravaliacaos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		veravaliacao::create($request->all());
		return redirect('admin/veravaliacaos')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$veravaliacao = Veravaliacao::findOrFail($id);
		return view('admin.veravaliacaos.show', compact('veravaliacao'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$veravaliacao = Veravaliacao::findOrFail($id);
		return view('admin.veravaliacaos.edit', compact('veravaliacao'));
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
		$veravaliacao = Veravaliacao::findOrFail($id);
		$veravaliacao->update($request->all());
		return redirect('admin/veravaliacaos')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Veravaliacao.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error = '';
            $model = '';
            $confirm_route =  route('admin.veravaliacaos.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    	}

    	/**
    	 * Delete the given Veravaliacao.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
    		$veravaliacao = Veravaliacao::destroy($id);

            // Redirect to the group management page
            return redirect('admin/veravaliacaos')->with('success', Lang::get('message.success.delete'));

    	}

}
