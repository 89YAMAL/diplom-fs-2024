<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Http\Requests\FilmsRequest;

class FilmsController extends Controller
{
    public function index() 
    {
        return view ('admin', ['films'=>Film::all()]); 
    }

    public function addFilm(FilmsRequest $request) 
    {
        $image = $request->file('image')->store('uploads', 'public');
        $film = new Film();
        $film->title = $request->input('title');
        $film->duration = $request->input('duration');
        $film->description = $request->input('description');
        $film->country = $request->input('country');
        $film->image = $image;
        $film->save();
        return redirect()->route('admin')->with('success', 'Фильм успешно добавлен');
    }

    public function deleteFilm($id) 
    {
        Film::find($id)->delete();
        return redirect()->route('admin')->with('success', 'Фильм успешно удалён');
    }
}
