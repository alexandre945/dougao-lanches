<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListRequest;
use App\Models\ListModel;
use Illuminate\Http\Request;

class ListModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = ListModel::all();

        return view('List.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ListRequest $request)
    {
        $list = $request->all();
        ListModel::create($list);

        return redirect()->back()->with('created', 'Item cadstrado com sucesso');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ListModel $listModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ListModel $listModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ListModel $listModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request, $id)
    {
      $list = ListModel::findOrFail($id);
       $list->delete();
       return redirect()->back()->with('deleted', 'item deletado com sucesso');
    }
}
