<?php

namespace App\Http\Controllers; // Цей рядок дуже важливий!

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Photo; // Імпортуємо модель Photo
use Auth; // Імпортуємо фасад Auth

class PhotoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    public function index()
    {
        $photos = Photo::with('user')->orderBy('created_at', 'desc')->get();
        return view('photos.index', compact('photos'));
    }

    public function create()
    {
        return view('photos.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'nullable',
            'image' => 'required|mimes:jpeg,png,gif,webp|max:5120',
        ]);


        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('images'), $imageName);

        $photo = new Photo;
        $photo->user_id = Auth::id();
        $photo->title = $request->input('title');
        $photo->description = $request->input('description');
        $photo->filename = $imageName;
        $photo->save();

        return redirect('/photos')->with('status', 'Фотографія успішно завантажена!');
    }

    public function show($id)
    {
        $photo = Photo::with('user')->findOrFail($id);
        return view('photos.show', compact('photo'));
    }

}