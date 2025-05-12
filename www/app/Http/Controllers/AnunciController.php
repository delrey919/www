<?php

namespace App\Http\Controllers;

use App\Models\Anunci;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Categories;

class AnunciController extends Controller
{
    public function index()
    {
        return Inertia::render('ListAnunci', [
            'anuncis' => Anunci::with('category')->get()
        ]);
    }

    public function create()
    {
        $categories = Categories::all();
        return Inertia::render('CreateAnunci',[
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name'        => 'required|max:255',
            'description' => 'required|max:255',
            'date' => 'required|max:255',
            'hora' => 'required|max:255',
            'mail'      => 'required|max:255',
            'category_id' => 'required|max:255',
        ]);

        Anunci::create($validate);
        return redirect()->route('anunci.index');
    }

    public function show(Anunci $anunci)
    {
        return Inertia::render('ShowAnunci', [
            'anunci' => $anunci->load('category')
        ]);
    }

    public function edit(Anunci $anunci)
    {
        return Inertia::render('EditAnunci', [
            'anunci' => $anunci,
            'categories' => Categories::all()
        ]);
    }

    public function update(Request $request, Anunci $anunci)
    {
        $validate = $request->validate([
            'name'        => 'max:255',
            'description' => 'max:255',
            'date' => 'max:255',
            'hora' => 'max:255',
            'mail'      => 'max:255',
            'category_id' => 'max:255',
        ]);

        $anunci->update($validate);
        return redirect()->route('anunci.index');
    }

    public function destroy(Anunci $anunci)
    {
        $anunci->delete();
        return redirect()->route('anunci.index');
    }
}