<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use App\Models\Plataformas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CursosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $cursos = Cursos::all();
        $plataformas = Plataformas::all();  
        return view('cursos', compact('cursos', 'plataformas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
        'titulo' => 'required|string|max:255',
        'descripcion' => 'required|string|max:255',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'plataforma_id' => 'nullable|exists:plataformas,id',
    ]);

    $imagenPath = null;

    if ($request->hasFile('imagen')) {
        $imagenPath = $request->file('imagen')->store('imagenes-cursos', 'public');
    }

    Cursos::create([
        'titulo' => $request->titulo,
        'descripcion' => $request->descripcion,
        'imagen' => $imagenPath,
        'plataforma_id' => $request->plataforma_id,
    ]);

        return redirect()->route('cursos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cursos $cursos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cursos $cursos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cursos $curso)
    {
        // Validar datos
    $data = $request->validate([
        'titulo' => 'required|string|max:255',
        'plataforma_id' => 'required|exists:plataformas,id',
        'descripcion' => 'nullable|string',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Procesar imagen si se ha subido
    if ($request->hasFile('imagen')) {
        if ($curso->imagen && Storage::disk('public')->exists($curso->imagen)) {
            Storage::disk('public')->delete($curso->imagen);
        }

        $path = $request->file('imagen')->store('cursos', 'public');
        $data['imagen'] = $path; // ✅ Incluir en $data
    }

    // Actualizar datos del curso
    $curso->update($data);
        
        return redirect()->route('cursos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cursos $cursos)
    {
         if ($cursos->imagen && Storage::disk('public')->exists($cursos->imagen)) {
            Storage::disk('public')->delete($cursos->imagen);
            }

    // Eliminar el registro de la BD
         $cursos->delete();
         return redirect()->route('cursos.index');
    }
}
