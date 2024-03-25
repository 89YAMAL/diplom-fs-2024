<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Http\Requests\FilmsRequest;

class FilmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return view ('admin', ['films'=>Film::all()]); 
    }


    /**
     * Store a newly created resource in storage.
     */
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

        // $request->file('image')->store('uploads', 'public');
    }

    public function deleteFilm ($id) {
        Film::find($id)->delete();
        return redirect()->route('admin')->with('success', 'Фильм успешно удалён');
    }



}
