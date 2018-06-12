<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Abono;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;
use Sentinel;

class AbonosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$abonos = Abono::latest()->orderBy('codigo')->get();
		return view('admin.abonos.index', compact('abonos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.abonos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$abono = abono::create($request->all());
		$abono->idusuario = Sentinel::getUser()->id;
		$abono->save();
		return redirect('admin/abonos')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$abono = Abono::findOrFail($id);
		return view('admin.abonos.show', compact('abono'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		$abono = Abono::findOrFail($id);

		return view('admin.abonos.edit', compact('abono'));
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
		$abono = Abono::findOrFail($id);
		$abono->idusuario = Sentinel::getUser()->id;
		//$abono->updated_at = now();
		$abono->update($request->all());
		return redirect('admin/abonos')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Abono.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error = '';
            $model = '';
            $confirm_route =  route('admin.abonos.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    	}

    	/**
    	 * Delete the given Abono.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
    		$abono = Abono::destroy($id);

            // Redirect to the group management page
            return redirect('admin/abonos')->with('success', Lang::get('message.success.delete'));

    	}

}
