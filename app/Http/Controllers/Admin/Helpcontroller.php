<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Help;
use Illuminate\Support\Str;


class Helpcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Help::paginate(10);
        // $data['helping'] = Help::where('status','Y')->get();
        return view('admin.pages.help.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('admin.pages.help.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $credentials = $request->validate([
            'title' => ['required'],
            'short_title' => ['required'],
            'description' => ['required'],
            'image' => ['required','image','mimes:jpeg,png,jpg,webp'],
        ]);

        $help = new Help;
        $help->name = $request->title;
        $help->short_title = $request->short_title;
        $help->slug = Str::of($request->title)->slug('-');
        $help->description = $request->description;
        $help->image = uploadImage($request->image,$help);
        $help->save();
        return redirect('/admin/help')->with('success','Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
                $row = Help::find($id);
         return view('admin.pages.help.edit',compact('row'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $credentials = $request->validate([
            'title' => ['required'],
            'short_title' => ['required'],
            'description' => ['required'],
            'image' => ['image','mimes:jpeg,png,jpg,webp'],
        ]);

        $row = Help::find($id);
        $row->name = $request->title;
        $row->short_title = $request->short_title;
        $row->description = $request->description;
        if ($request->image) {
            $row->image = updateImage($request->image,$row);
        }
        $row->save();
        return redirect('/admin/help')->with('success','Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
