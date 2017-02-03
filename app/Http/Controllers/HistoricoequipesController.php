<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Historicoequipe;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;

class HistoricoequipesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$historicoequipes = Historicoequipe::latest()->get();
		return view('admin.historicoequipes.index', compact('historicoequipes'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.historicoequipes.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		historicoequipe::create($request->all());
		return redirect('admin/historicoequipes')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$historicoequipe = Historicoequipe::findOrFail($id);
		return view('admin.historicoequipes.show', compact('historicoequipe'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$historicoequipe = Historicoequipe::findOrFail($id);
		return view('admin.historicoequipes.edit', compact('historicoequipe'));
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
		$historicoequipe = Historicoequipe::findOrFail($id);
		$historicoequipe->update($request->all());
		return redirect('admin/historicoequipes')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Historicoequipe.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error = '';
            $model = '';
            $confirm_route =  route('admin.historicoequipes.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    	}

    	/**
    	 * Delete the given Historicoequipe.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
    		$historicoequipe = Historicoequipe::destroy($id);

            // Redirect to the group management page
            return redirect('admin/historicoequipes')->with('success', Lang::get('message.success.delete'));

    	}

}