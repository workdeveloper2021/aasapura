<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sitesetting;

class Aboutuscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Sitesetting::find(2);
        $row  = json_decode($data->info_first);
        return view('admin.pages.about',compact('row','data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $find = Sitesetting::find(2);

        $credentials = $request->validate([
            'our_vision' => ['required'],
            'our_mission' => ['required'],
            'who_we_are' => ['required'],
            'meta_title' => ['required'],
            'meta_tag' => ['required'],
            'meta_description' => ['required'],
            'image' => ['image','mimes:jpeg,png,jpg,webp'],
            'image_back' => ['image','mimes:jpeg,png,jpg,webp'],
        ]);

        if ($find) {
            $data  = [
                'our_vision' => $request->our_vision,
                'our_mission' => $request->our_mission,
                'who_we_are' => $request->who_we_are,
            ];
            $info_first = json_encode($data);
            if ($request->image) {
            $find->image = updateimagedy($request->image,$find,'image');
        }
        if ($request->image_back) {
            $find->image_back = updateimagedy($request->image_back,$find,'image_back');
        }

        $find->info_first = $info_first;
        $find->meta_title = $request->meta_title;
        $find->meta_tag = $request->meta_tag;
        $find->meta_description = $request->meta_description;
        $find->save();
        return redirect()->back()->with('success','Updated Successfully');
        }else{
            return redirect('/admin/aboutus')->with('error','Please contact to developer asap');
        }

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
