<?php

namespace App\Http\Controllers;

use App\Models\Plataformas;
use Illuminate\Http\Request;

class PlataformasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plataformas = Plataformas::all();
        return view('plataformas', compact('plataformas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'url' => 'nullable|url|max:255',
        ]);

        Plataformas::create([
            'nombre' => $request->nombre,
            'url' => $request->url,
        ]);

        session()->flash('swal', [
    'icon' => 'success',
    'title' => 'Plataforma creada correctamente',
    'text' => 'La plataforma ha sido creada exitosamente.',
    'customClass' => [
        'confirmButton' => 'bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700'
    ],
    'buttonsStyling' => false
]);

        return redirect()->route('plataformas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plataformas $plataformas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plataformas $plataformas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plataformas $plataforma)
    {
       $data = $request->validate([
        'nombre' => 'required|string|max:255',
        'url' => 'nullable|url|max:255',
    ]);

    $plataforma->update($data);

    session()->flash('swal', [
        'icon' => 'success',
        'title' => 'Plataforma actualizada correctamente',
        'text' => 'La plataforma ha sido actualizada exitosamente.',
        'customClass' => [
            'confirmButton' => 'bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700'
        ],
        'buttonsStyling' => false
    ]);
    

        return redirect()->route('plataformas.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plataformas $plataformas)
    {
          $plataformas->delete();
        return redirect()->route('plataformas.index');
    }
}
