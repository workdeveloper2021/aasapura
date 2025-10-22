<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Blogs;
use Illuminate\Support\Str;
class Blogcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data  = Blogs::orderBy('id','desc')->paginate(10);
        return view('admin.blogs.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $category = Category::where('parent_category',0)->where('status','Y')->get();
        return view('admin.blogs.create',compact('category'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'title' => ['required'],
            'short_description' => ['required'],
            'writer_name' => ['required'],
            'category' => ['required','numeric'],
            'description' => ['required'],
            'meta_title' => ['required'],
            'meta_tag' => ['required'],
            'meta_description' => ['required'],
            'image' => ['required','image','mimes:jpeg,png,jpg,webp'],
        ],[
            'category.numeric' => 'Category field can not be empty'
        ]);

        $new  = new Blogs;
        $new->title = $request->title;
        $new->slug =  Str::of($request->title)->slug('-');
        $new->short_description = $request->short_description;
        $new->writer_name = $request->writer_name;
        $new->category = $request->category;
        $new->description = $request->description;
        $new->meta_title = $request->meta_title;
        $new->meta_tag = $request->meta_tag;
        $new->meta_description = $request->meta_description;
        $new->image = uploadImage($request->image,$new);
        $new->save();
        return redirect('/admin/blogs')->with('success','Created Sussceesfuly');
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
        $category = Category::where('parent_category',0)->where('status','Y')->get();
        $row = Blogs::find($id);
        return view('admin.blogs.edit',compact('category','row'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $credentials = $request->validate([
            'title' => ['required'],
            'short_description' => ['required'],
            'writer_name' => ['required'],
            'category' => ['required','numeric'],
            'description' => ['required'],
            'meta_title' => ['required'],
            'meta_tag' => ['required'],
            'meta_description' => ['required'],
            'image' => ['image','mimes:jpeg,png,jpg,webp'],
        ],[
            'category.numeric' => 'Category field can not be empty'
        ]);

        $new  = Blogs::find($id);
        $new->title = $request->title;
        $new->short_description = $request->short_description;
        $new->writer_name = $request->writer_name;
        $new->category = $request->category;
        $new->description = $request->description;
        $new->meta_title = $request->meta_title;
        $new->meta_tag = $request->meta_tag;
        $new->meta_description = $request->meta_description;
        if ($request->image) {
            $new->image = updateImage($request->image,$new);
        }
        $new->save();
        return redirect('/admin/blogs')->with('success','Updated Sussceesfuly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
