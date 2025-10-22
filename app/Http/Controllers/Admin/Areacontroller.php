<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Areas;

class Areacontroller extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Areas::paginate(10);
        return view('admin.areas.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.areas.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required','unique:state,name'],
        ]);

        $brand = new Areas;
        $brand->name = $request->name;
        $brand->save();
        return redirect('/admin/areas')->with('success','Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $row = Areas::find($id);
        return view('admin.areas.edit',compact('row'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $credentials = $request->validate([
            'name' => ['required'],
        ]);
        $row = Areas::find($id);
        $row->name = $request->name;
        $row->save();
        return redirect('/admin/areas')->with('success','Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
