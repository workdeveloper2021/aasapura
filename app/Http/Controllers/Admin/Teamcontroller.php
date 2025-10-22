<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use PhpParser\Node\Stmt\Return_;

class Teamcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Team::paginate(10);

        return view('admin.pages.teams.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.teams.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'destination' => ['required'],
            'about_team' => ['required'],
            'facebook' => ['required'],
            'instagram' => ['required'],
            'twitter' => ['required'],
            'image' => ['required','image','mimes:jpeg,png,jpg,webp'],
        ]);

        $new_team = new Team;
        $new_team->name = $request->name;
        $new_team->destination = $request->destination;
        $new_team->about_team = $request->about_team;
        $new_team->facebook = $request->facebook;
        $new_team->instagram = $request->instagram;
        $new_team->instagram = $request->instagram;
        $new_team->twitter = $request->twitter;
        $new_team->image = uploadImage($request->image,$new_team);
        $new_team->save();
        return redirect('/admin/teams')->with('success','Created Successfully');

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
        $row = Team::find($id);
        return view('admin.pages.teams.edit',compact('row'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $credentials = $request->validate([
            'name' => ['required'],
            'destination' => ['required'],
            'about_team' => ['required'],
            'facebook' => ['required'],
            'instagram' => ['required'],
            'twitter' => ['required'],
            'image' => ['image','mimes:jpeg,png,jpg,webp'],
        ]);

        // Team::updateOrcreate([
        //     'id'  => $request->id
        // ],[
        //     'name'  => $request->name
        // ]);


        $row = Team::find($id);
        $row->name = $request->name;
        $row->destination = $request->destination;
        $row->about_team = $request->about_team;
        $row->facebook = $request->facebook;
        $row->instagram = $request->instagram;
        $row->instagram = $request->instagram;
        $row->twitter = $request->twitter;
        if ($request->image) {
            $row->image = updateImage($request->image,$row);
        }

        $row->save();
        return redirect('/admin/teams')->with('success','Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
