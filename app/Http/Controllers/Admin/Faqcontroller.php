<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;


class Faqcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (isset($_GET['type']) && !empty($_GET['type'])) {
            $data = Faq::where('type',$_GET['type'])->orderBy('id','desc')->get();
            return view('admin.pages.faq.shipping',compact('data'));
        }else{
            return redirect('/admin/dashboard');
        }


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {



                return view('admin.pages.faq.shipping_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $credentials = $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'type' => ['required'],
        ]);

        $help = new Faq;
        $help->title = $request->title;
        $help->description = $request->description;
        $help->type = $request->type;
        $help->save();
        return redirect('/admin/faq?type='.$request->type)->with('success','Created Successfully');
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
        $row = Faq::find($id);
        return view('admin.pages.faq.edit',compact('row'));
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
