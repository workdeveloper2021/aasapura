<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;

class Testimonials extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Testimonial::paginate(10);
        return view('admin.pages.testimonials.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          return view('admin.pages.testimonials.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $credentials = $request->validate([
            'name' => ['required'],
            'destination' => ['required'],
            'description' => ['required'],
            'image' => ['required','image','mimes:jpeg,png,jpg,webp'],
        ]);

        $testimonials = new Testimonial;
        $testimonials->name = $request->name;
        $testimonials->destination = $request->destination;
        $testimonials->description = $request->description;
        $testimonials->image = uploadImage($request->image,$testimonials);
        $testimonials->save();
        return redirect('/admin/testimonials')->with('success','Created Successfully');
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
        $row = Testimonial::find($id);
        return view('admin.pages.testimonials.edit',compact('row'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          $credentials = $request->validate([
            'name' => ['required'],
            'destination' => ['required'],
            'description' => ['required'],
            'image' => ['image','mimes:jpeg,png,jpg,webp'],
        ]);

         $row = Testimonial::find($id);
        $row->name = $request->name;
        $row->destination = $request->destination;
        $row->description = $request->description;
      if ($request->image) {
            $row->image = updateImage($request->image,$row);
        }
        $row->save();
        return redirect('/admin/testimonials')->with('success','Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
