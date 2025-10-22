<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banners;

class Bannercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
          $data = Banners::paginate(10);
        return view('admin.banners.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('admin.banners.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $credentials = $request->validate([
              'image' => ['required','image','mimes:jpeg,png,jpg,webp'],
        ]);

        $banner = new Banners;
        $banner->image = uploadImage($request->image,$banner);  
        $banner->save();
        return redirect('/admin/banners')->with('success','Created Successfully');
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
          $row = Banners::find($id);
        return view('admin.banners.edit',compact('row'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $credentials = $request->validate([
              'image' => ['image','mimes:jpeg,png,jpg,webp'],
        ]);

        $row = Banners::find($id);
         if ($request->image) {
            $row->image = updateImage($request->image,$row);
        }
        $row->save();
        return redirect('/admin/banners')->with('success','Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
