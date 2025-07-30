<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Photo;
use Auth;

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
            'image' => 'required|mimes:jpeg,png,gif,webp|max:5120',
        ]);


        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('images'), $imageName);

        $photo = new Photo;
        $photo->user_id = Auth::id();
        $photo->title = $request->input('title');
        $photo->filename = $imageName;
        $photo->save();

        return redirect('/photos')->with('status', 'Фотографія успішно завантажена!');
    }

    public function show($id)
    {
        $photo = Photo::with('user')->findOrFail($id);
        return view('photos.show', compact('photo'));
    }

    public function edit($id)
    {
        $photo = Photo::findOrFail($id);

        if (Auth::id() !== $photo->user_id) {
            return redirect('/photos')->with('error', 'Ви не маєте прав для редагування цієї фотографії.');
        }

        return view('photos.edit', compact('photo'));
    }

    public function update(Request $request, $id)
    {
        $photo = Photo::findOrFail($id);

        if (Auth::id() !== $photo->user_id) {
            return redirect('/photos')->with('error', 'Ви не маєте прав для оновлення цієї фотографії.');
        }

        $this->validate($request, [
            'title' => 'required|max:255',
            'image' => 'mimes:jpeg,png,gif,webp|max:5120',
        ]);

        $photo->title = $request->input('title');

        if ($request->hasFile('image')) {
            if (file_exists(public_path('images/' . $photo->filename))) {
                unlink(public_path('images/' . $photo->filename));
            }
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('images'), $imageName);
            $photo->filename = $imageName;
        }

        $photo->save();

        return redirect('/photos/' . $photo->id)->with('status', 'Фотографія успішно оновлена!');
    }

    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);

        if (Auth::id() !== $photo->user_id) {
            return redirect('/photos')->with('error', 'Ви не маєте прав для видалення цієї фотографії.');
        }

        if (file_exists(public_path('images/' . $photo->filename))) {
            unlink(public_path('images/' . $photo->filename));
        }

        $photo->delete();

        return redirect('/photos')->with('status', 'Фотографія успішно видалена!');
    }
}