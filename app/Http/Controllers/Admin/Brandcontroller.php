<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brands;
use PhpParser\Node\Stmt\Return_;

class Brandcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Brands::orderBy('id','desc')->get();
        return view('admin.brand.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $credentials = $request->validate([
            'name' => ['required'],
            'image' => ['required','image','mimes:jpeg,png,jpg,webp'],
        ]);

        $brand = new Brands;
        $brand->name = $request->name;
        $brand->image = uploadImage($request->image,$brand);
        $brand->save();
        return redirect('/admin/brands')->with('success','Brand Created Successfully');
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
        $row = Brands::find($id);
        return view('admin.brand.edit',compact('row'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'image' => ['image','mimes:jpeg,png,jpg,webp'],
        ]);

        $row = Brands::find($id);
        $row->name = $request->name;
        if ($request->image) {
        $row->image = updateImage($request->image,$row);
    }
        $row->save();
        return redirect('/admin/brands')->with('success','Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
