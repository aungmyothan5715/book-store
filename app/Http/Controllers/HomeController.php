<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;
//use Illuminate\Support\Facades\Storage;
use Storage; //This ok.

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $galleries = Gallery::all();

        return view('home', compact('galleries')); // compact() function no warini ['galleries' => $galleries] wa namae ga onaji desukara, compact() method wo tsukatta.
    }

    public function store(Request $request)
    {
        //Validate Image
        $request->validate([
            'image' => 'required',
            'image.*' => 'image'
        ]);

      // dd($request->all());
        if($request->hasFile('image')){
             // If you want to get Original Name of File.
            $file_name = time() . "_" . $request->file('image')->getClientOriginalName();

            // $request->file('image')->move(public_path('image'), $file_name );
            $request->file('image')->storeAs('upload', $file_name);
    
            $gallery = new Gallery();
            $gallery->name = $file_name;
            $gallery->save();
        }

       return back()->with('status', 'Post was uploaded successfully.');
    }

    public function destory($id)
    {
        $gallery = Gallery::findOrFail($id);
        Storage::delete('upload/' . $gallery->name); // This delete is delete in Storage path file.
        $gallery->delete();// This delete is delete database file.

        return back()->with('status', 'Post was deleted successfully.');
    }

    public function download($id)
    {
        $gallery = Gallery::findOrFail($id);
        return Storage::download('https://ok.ru/video/3670086191856' . $gallery->name);
    }
}
