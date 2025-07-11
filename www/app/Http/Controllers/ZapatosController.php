<?php

namespace App\Http\Controllers;

use App\Models\Zapatos;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Categories;

class ZapatosController extends Controller
{
    /**
     * Muestra la lista de todos los zapatos.
     */
    public function index()
    {
        // Devuelve la vista 'ListZapatos' con todos los zapatos y su categoría asociada
        return Inertia::render('ListZapatos', [
            'zapatos' => Zapatos::with('category')->get()
        ]);
    }

    /**
     * Muestra el formulario para crear un nuevo zapato.
     */
    public function create()
    {
        $categories = Categories::all();
        return Inertia::render('CreateZapatos',[
            'categories' => $categories
        ]);
    }

    /**
     * Guarda un nuevo zapato en la base de datos.
     */
    public function store(Request $request)
    {
        // Valida los datos recibidos del formulario
        $validate = $request->validate([
            'name'        => 'required|max:255',
            'description' => 'required|max:255',
            'date' => 'required|max:255',
            'hora' => 'required|max:255',
            'mail'      => 'required|max:255',
            'category_id' => 'required|max:255',
        ]);

        // Crea el zapato en la base de datos
        Zapatos::create($validate);
        // Redirige a la lista de zapatos
        return redirect()->route('zapatos.index');
    }

    /**
     * Muestra los detalles de un zapato específico.
     */
    public function show(Zapatos $zapato)
    {
        // Devuelve la vista con los detalles del zapato y su categoría asociada
        return Inertia::render('ShowZapatos', [
            'zapatos' => $zapato->load('category')
        ]);
    }

    /**
     * Muestra el formulario para editar un zapato.
     */
    public function edit(Zapatos $zapato)
    {
        // Devuelve la vista de edición con el zapato y todas las categorías
        return Inertia::render('EditZapatos', [
            'zapatos' => $zapato,
            'categories' => Categories::all()
        ]);
    }

    /**
     * Actualiza un zapato en la base de datos.
     */
    public function update(Request $request, Zapatos $zapato)
    {
        // Valida los datos recibidos del formulario
        $validate = $request->validate([
            'name'        => 'max:255',
            'description' => 'max:255',
            'date' => 'max:255',
            'hora' => 'max:255',
            'mail'      => 'max:255',
            'category_id' => 'max:255',
        ]);

        // Actualiza el zapato en la base de datos
        $zapato->update($validate);
        // Redirige a la lista de zapatos
        return redirect()->route('zapatos.index');
    }

    /**
     * Elimina un zapato de la base de datos.
     */
    public function destroy(Zapatos $zapato)
    {
        // Elimina el zapato
        $zapato->delete();
        // Redirige a la lista de zapatos
        return redirect()->route('zapatos.index');
    }

}
