<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Vercargo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;

class VercargosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$vercargos = Vercargo::orderBy('nome')->get();
		return view('admin.vercargos.index', compact('vercargos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.vercargos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		vercargo::create($request->all());
		return redirect('admin/vercargos')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$vercargo = Vercargo::findOrFail($id);
		return view('admin.vercargos.show', compact('vercargo'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$vercargo = Vercargo::findOrFail($id);
		return view('admin.vercargos.edit', compact('vercargo'));
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
		$vercargo = Vercargo::findOrFail($id);
		$vercargo->update($request->all());
		return redirect('admin/vercargos')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Vercargo.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error = '';
            $model = '';
            $confirm_route =  route('admin.vercargos.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    	}

    	/**
    	 * Delete the given Vercargo.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
    		$vercargo = Vercargo::destroy($id);

            // Redirect to the group management page
            return redirect('admin/vercargos')->with('success', Lang::get('message.success.delete'));

    	}

}
